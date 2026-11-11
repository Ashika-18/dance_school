<?php
/**
 * SUNNY KIDS DANCE ACADEMY Theme Engine & Core Initializer
 *
 * @package SunnyKidsDanceAcademy
 * @author  AshikaWorks
 * @version 1.0.0
 */

defined('ABSPATH') || exit;

/* ==========================================================================
   01. テーマ定数定義（Theme Constants）
   ========================================================================== */
define('SKDA_THEME_VERSION', '1.0.0');
define('SKDA_THEME_DIR', get_template_directory());
define('SKDA_THEME_URI', get_template_directory_uri());
define('SKDA_THEME_INC', SKDA_THEME_DIR . '/inc');

/* ==========================================================================
   02. inc/ モジュール一括読み込み＆エラーハンドリング
   ========================================================================== */
$skda_inc_modules = array(
    'security.php',    // HTTPヘッダー・セキュリティ・REST制限
    'setup.php',       // テーマ機能サポート・アセット読み込み・画像サイズ
    'post-types.php',  // カスタム投稿タイプ(class)・タクソノミー・初期シード
    'pages.php',       // 回遊用固定ページの自動生成
    'meta-boxes.php',  // 12項目のメタデータ入力UI・保存処理
);

foreach ($skda_inc_modules as $module_file) {
    $filepath = SKDA_THEME_INC . '/' . $module_file;
    if (file_exists($filepath)) {
        require_once $filepath;
    } else {
        // 開発環境時のファイル欠損通知
        if (defined('WP_DEBUG') && WP_DEBUG) {
            wp_die(
                sprintf(
                    esc_html__('テーマの基幹モジュールファイルが見つかりません: %s', 'sunny-kids-dance'),
                    esc_html('inc/' . $module_file)
                )
            );
        }
    }
}

/* ==========================================================================
   03. Step 3 メタデータ整形ヘルパー関数群（View層向け）
   ========================================================================== */

/**
 * 月額受講料を「¥10,800（税込）/月」形式に整形出力
 *
 * @param int|null $post_id
 * @return string
 */
if (!function_exists('skda_get_formatted_price')) {
    function skda_get_formatted_price($post_id = null) {
        $post_id = $post_id ? $post_id : get_the_ID();
        $price   = get_post_meta($post_id, '_class_price_monthly', true);

        if ('' === $price || false === $price) {
            return esc_html__('料金要問い合わせ', 'sunny-kids-dance');
        }

        return '¥' . number_format_i18n(absint($price)) . '<span class="skd-price-unit">' . esc_html__('（税込）/月', 'sunny-kids-dance') . '</span>';
    }
}

/**
 * 募集ステータスバッジのHTMLを出力
 *
 * @param int|null $post_id
 * @return string
 */
if (!function_exists('skda_get_vacancy_badge')) {
    function skda_get_vacancy_badge($post_id = null) {
        $post_id = $post_id ? $post_id : get_the_ID();
        $status  = get_post_meta($post_id, '_class_vacancy_status', true);
        $note    = get_post_meta($post_id, '_class_vacancy_note', true);

        $badge_class = 'skd-badge--open';
        $badge_label = esc_html__('残席あり', 'sunny-kids-dance');

        if ('few' === $status) {
            $badge_class = 'skd-badge--few';
            $badge_label = esc_html__('残席わずか', 'sunny-kids-dance');
        } elseif ('wait' === $status) {
            $badge_class = 'skd-badge--wait';
            $badge_label = esc_html__('満席・キャンセル待ち', 'sunny-kids-dance');
        }

        $html  = '<span class="skd-vacancy-badge ' . esc_attr($badge_class) . '">';
        $html .= $badge_label;
        if (!empty($note)) {
            $html .= '<span class="skd-vacancy-note">' . esc_html($note) . '</span>';
        }
        $html .= '</span>';

        return $html;
    }
}

/**
 * クラスのスペック一覧（定員・時間・指導比率）を配列で取得
 *
 * @param int|null $post_id
 * @return array
 */
if (!function_exists('skda_get_class_specs')) {
    function skda_get_class_specs($post_id = null) {
        $post_id = $post_id ? $post_id : get_the_ID();

        return array(
            'sub_en'           => get_post_meta($post_id, '_class_sub_en', true),
            'target_age'       => get_post_meta($post_id, '_class_target_age', true),
            'capacity'         => get_post_meta($post_id, '_class_capacity', true),
            'instructor_ratio' => get_post_meta($post_id, '_class_instructor_ratio', true),
            'duration_min'     => get_post_meta($post_id, '_class_duration_min', true),
            'curriculum_level' => get_post_meta($post_id, '_class_curriculum_level', true),
            'requirements'     => get_post_meta($post_id, '_class_requirements', true),
            'assigned_teacher' => get_post_meta($post_id, '_class_assigned_teacher', true),
        );
    }
}

/**
 * ギャラリー画像ID群から画像URL配列を取得
 *
 * @param int|null $post_id
 * @param string $size
 * @return array
 */
if (!function_exists('skda_get_class_gallery_urls')) {
    function skda_get_class_gallery_urls($post_id = null, $size = 'skda-card-thumb') {
        $post_id    = $post_id ? $post_id : get_the_ID();
        $gallery_ids = get_post_meta($post_id, '_class_gallery_images', true);
        $urls       = array();

        if (!empty($gallery_ids)) {
            $ids = array_filter(explode(',', $gallery_ids));
            foreach ($ids as $id) {
                $image_url = wp_get_attachment_image_url(absint($id), $size);
                if ($image_url) {
                    $urls[] = $image_url;
                }
            }
        }

        return $urls;
    }
}

/* ==========================================================================
   04. 予約・問い合わせAJAXハンドラー（フロントエンド非同期処理）
   ========================================================================== */

/**
 * 体験レッスン空席確認AJAXハンドラー
 */
if (!function_exists('skda_handle_check_vacancy_ajax')) {
    function skda_handle_check_vacancy_ajax() {
        // Nonceチェック
        check_ajax_referer('skda_site_public_nonce', 'nonce');

        $class_id = isset($_POST['class_id']) ? absint($_POST['class_id']) : 0;

        if (!$class_id || 'class' !== get_post_type($class_id)) {
            wp_send_json_error(array('message' => esc_html__('指定されたクラスが見つかりません。', 'sunny-kids-dance')));
        }

        $status = get_post_meta($class_id, '_class_vacancy_status', true);
        $note   = get_post_meta($class_id, '_class_vacancy_note', true);

        wp_send_json_success(array(
            'class_id' => $class_id,
            'status'   => $status ? $status : 'open',
            'note'     => $note ? esc_html($note) : '',
            'badge'    => skda_get_vacancy_badge($class_id),
        ));
    }
}
add_action('wp_ajax_skda_check_vacancy', 'skda_handle_check_vacancy_ajax');
add_action('wp_ajax_nopriv_skda_check_vacancy', 'skda_handle_check_vacancy_ajax');