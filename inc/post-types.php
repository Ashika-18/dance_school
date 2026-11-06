<?php
/**
 * Custom Post Types and Taxonomies Registration
 *
 * @package SunnyKidsDanceAcademy
 * @author  AshikaWorks
 * @version 1.0.0
 */

defined('ABSPATH') || exit;

/* ==========================================================================
   01. カスタム投稿タイプ「開講クラス管理 (class)」登録
   ========================================================================== */
if (!function_exists('skda_register_class_cpt')) {
    function skda_register_class_cpt() {
        $labels = array(
            'name'                  => _x('開講クラス管理', 'Post Type General Name', 'sunny-kids-dance'),
            'singular_name'         => _x('開講クラス', 'Post Type Singular Name', 'sunny-kids-dance'),
            'menu_name'             => __('開講クラス', 'sunny-kids-dance'),
            'name_admin_bar'        => __('開講クラス', 'sunny-kids-dance'),
            'archives'              => __('開講クラス一覧', 'sunny-kids-dance'),
            'attributes'            => __('クラス属性', 'sunny-kids-dance'),
            'parent_item_colon'     => __('親クラス:', 'sunny-kids-dance'),
            'all_items'             => __('開講クラス一覧', 'sunny-kids-dance'),
            'add_new_item'          => __('新規開講クラスを追加', 'sunny-kids-dance'),
            'add_new'               => __('新規追加', 'sunny-kids-dance'),
            'new_item'              => __('新しい開講クラス', 'sunny-kids-dance'),
            'edit_item'             => __('開講クラスを編集', 'sunny-kids-dance'),
            'update_item'           => __('開講クラスを更新', 'sunny-kids-dance'),
            'view_item'             => __('開講クラスを表示', 'sunny-kids-dance'),
            'view_items'            => __('開講クラス一覧を表示', 'sunny-kids-dance'),
            'search_items'          => __('開講クラスを検索', 'sunny-kids-dance'),
            'not_found'             => __('開講クラスが見つかりませんでした。', 'sunny-kids-dance'),
            'not_found_in_trash'    => __('ゴミ箱に開講クラスはありません。', 'sunny-kids-dance'),
            'featured_image'        => __('クラスアイキャッチ画像 (推奨 800×530px)', 'sunny-kids-dance'),
            'set_featured_image'    => __('クラス画像を設定', 'sunny-kids-dance'),
            'remove_featured_image' => __('クラス画像を削除', 'sunny-kids-dance'),
            'use_featured_image'    => __('クラス画像として使用', 'sunny-kids-dance'),
        );

        $args = array(
            'label'                 => __('開講クラス', 'sunny-kids-dance'),
            'description'           => __('サニーキッズダンスアカデミーの開講カリキュラムおよび募集情報', 'sunny-kids-dance'),
            'labels'                => $labels,
            'supports'              => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'revisions'),
            'taxonomies'            => array('class_age_group', 'class_schedule', 'class_features'),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 5,
            'menu_icon'             => 'dashicons-groups',
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'capability_type'       => 'post',
            'show_in_rest'          => true,
            'rest_base'             => 'class',
            'rest_controller_class' => 'WP_REST_Posts_Controller',
            'rewrite'               => array('slug' => 'class', 'with_front' => false),
        );

        register_post_type('class', $args);
    }
}
add_action('init', 'skda_register_class_cpt', 0);

/* ==========================================================================
   02. カスタムタクソノミー（3種）登録
   ========================================================================== */
if (!function_exists('skda_register_class_taxonomies')) {
    function skda_register_class_taxonomies() {
        // 1. 対象年齢・学年区分 (class_age_group / 階層あり)
        $labels_age = array(
            'name'              => _x('対象年齢区分', 'taxonomy general name', 'sunny-kids-dance'),
            'singular_name'     => _x('対象年齢区分', 'taxonomy singular name', 'sunny-kids-dance'),
            'search_items'      => __('年齢区分を検索', 'sunny-kids-dance'),
            'all_items'         => __('すべての年齢区分', 'sunny-kids-dance'),
            'parent_item'       => __('親の年齢区分', 'sunny-kids-dance'),
            'parent_item_colon' => __('親の年齢区分:', 'sunny-kids-dance'),
            'edit_item'         => __('年齢区分を編集', 'sunny-kids-dance'),
            'update_item'       => __('年齢区分を更新', 'sunny-kids-dance'),
            'add_new_item'      => __('新規年齢区分を追加', 'sunny-kids-dance'),
            'new_item_name'     => __('新規年齢区分名', 'sunny-kids-dance'),
            'menu_name'         => __('対象年齢区分', 'sunny-kids-dance'),
        );
        register_taxonomy('class_age_group', array('class'), array(
            'hierarchical'      => true,
            'labels'            => $labels_age,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'show_in_rest'      => true,
            'rest_base'         => 'class_age_group',
            'rewrite'           => array('slug' => 'age-group', 'with_front' => false),
        ));

        // 2. 開講曜日・時間帯 (class_schedule / 階層あり)
        $labels_sched = array(
            'name'              => _x('開講スケジュール', 'taxonomy general name', 'sunny-kids-dance'),
            'singular_name'     => _x('開講スケジュール', 'taxonomy singular name', 'sunny-kids-dance'),
            'search_items'      => __('スケジュールを検索', 'sunny-kids-dance'),
            'all_items'         => __('すべてのスケジュール', 'sunny-kids-dance'),
            'parent_item'       => __('親のスケジュール', 'sunny-kids-dance'),
            'parent_item_colon' => __('親のスケジュール:', 'sunny-kids-dance'),
            'edit_item'         => __('スケジュールを編集', 'sunny-kids-dance'),
            'update_item'       => __('スケジュールを更新', 'sunny-kids-dance'),
            'add_new_item'      => __('新規スケジュールを追加', 'sunny-kids-dance'),
            'new_item_name'     => __('新規スケジュール名', 'sunny-kids-dance'),
            'menu_name'         => __('開講スケジュール', 'sunny-kids-dance'),
        );
        register_taxonomy('class_schedule', array('class'), array(
            'hierarchical'      => true,
            'labels'            => $labels_sched,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'show_in_rest'      => true,
            'rest_base'         => 'class_schedule',
            'rewrite'           => array('slug' => 'schedule', 'with_front' => false),
        ));

        // 3. 指導特性・対応仕様 (class_features / 階層なしタグ型)
        $labels_feat = array(
            'name'                       => _x('指導特性・仕様', 'taxonomy general name', 'sunny-kids-dance'),
            'singular_name'              => _x('指導特性・仕様', 'taxonomy singular name', 'sunny-kids-dance'),
            'search_items'               => __('特性を検索', 'sunny-kids-dance'),
            'popular_items'              => __('人気の特性', 'sunny-kids-dance'),
            'all_items'                  => __('すべての特性', 'sunny-kids-dance'),
            'edit_item'                  => __('特性を編集', 'sunny-kids-dance'),
            'update_item'                => __('特性を更新', 'sunny-kids-dance'),
            'add_new_item'               => __('新規特性を追加', 'sunny-kids-dance'),
            'new_item_name'              => __('新規特性名', 'sunny-kids-dance'),
            'separate_items_with_commas' => __('カンマで区切ってください', 'sunny-kids-dance'),
            'add_or_remove_items'        => __('特性を追加または削除', 'sunny-kids-dance'),
            'choose_from_most_used'      => __('よく使われている特性から選択', 'sunny-kids-dance'),
            'menu_name'                  => __('指導特性・仕様', 'sunny-kids-dance'),
        );
        register_taxonomy('class_features', array('class'), array(
            'hierarchical'      => false,
            'labels'            => $labels_feat,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'show_in_rest'      => true,
            'rest_base'         => 'class_features',
            'rewrite'           => array('slug' => 'features', 'with_front' => false),
        ));
    }
}
add_action('init', 'skda_register_class_taxonomies', 0);

/* ==========================================================================
   03. 管理画面一覧テーブルのカスタムカラム追加
   ========================================================================== */
if (!function_exists('skda_manage_class_columns')) {
    function skda_manage_class_columns($columns) {
        $new_columns = array();
        foreach ($columns as $key => $title) {
            if ('title' === $key) {
                $new_columns['thumb'] = esc_html__('写真', 'sunny-kids-dance');
                $new_columns[$key]    = $title;
                $new_columns['age']   = esc_html__('対象年齢', 'sunny-kids-dance');
                $new_columns['price'] = esc_html__('月額受講料', 'sunny-kids-dance');
                $new_columns['status']= esc_html__('空席状況', 'sunny-kids-dance');
            } else {
                $new_columns[$key] = $title;
            }
        }
        return $new_columns;
    }
}
add_filter('manage_class_posts_columns', 'skda_manage_class_columns');

if (!function_exists('skda_render_class_custom_columns')) {
    function skda_render_class_custom_columns($column, $post_id) {
        switch ($column) {
            case 'thumb':
                if (has_post_thumbnail($post_id)) {
                    echo get_the_post_thumbnail($post_id, array(60, 40), array('style' => 'border-radius: 4px; object-fit: cover;'));
                } else {
                    echo '<span style="color: #999; font-size: 11px;">' . esc_html__('未設定', 'sunny-kids-dance') . '</span>';
                }
                break;

            case 'age':
                $age = get_post_meta($post_id, '_class_target_age', true);
                echo !empty($age) ? esc_html($age) : '<span style="color: #999;">—</span>';
                break;

            case 'price':
                $price = get_post_meta($post_id, '_class_price_monthly', true);
                echo !empty($price) ? '¥' . esc_html(number_format_i18n((int)$price)) . '<span style="font-size:10px;">(税込)</span>' : '<span style="color: #999;">—</span>';
                break;

            case 'status':
                $status = get_post_meta($post_id, '_class_vacancy_status', true);
                if ('open' === $status) {
                    echo '<span style="display:inline-block; padding:2px 8px; border-radius:10px; background:#e6f4ea; color:#137333; font-weight:600; font-size:11px;">' . esc_html__('残席あり', 'sunny-kids-dance') . '</span>';
                } elseif ('few' === $status) {
                    echo '<span style="display:inline-block; padding:2px 8px; border-radius:10px; background:#fef7e0; color:#b06000; font-weight:600; font-size:11px;">' . esc_html__('残席わずか', 'sunny-kids-dance') . '</span>';
                } elseif ('wait' === $status) {
                    echo '<span style="display:inline-block; padding:2px 8px; border-radius:10px; background:#fce8e6; color:#c5221f; font-weight:600; font-size:11px;">' . esc_html__('満席・待機', 'sunny-kids-dance') . '</span>';
                } else {
                    echo '<span style="color: #999;">—</span>';
                }
                break;
        }
    }
}
add_action('manage_class_posts_custom_column', 'skda_render_class_custom_columns', 10, 2);

/* ==========================================================================
   04. 初期ターム自動シード（テーマ有効化時に自動実行）
   ========================================================================== */
if (!function_exists('skda_seed_initial_terms')) {
    function skda_seed_initial_terms() {
        // 一度だけ実行するためのオプションフラグ
        if (get_option('skda_terms_seeded_v1')) {
            return;
        }

        // 1. 対象年齢区分 (class_age_group)
        $age_terms = array(
            'リトル（4〜6歳未就学児）'   => 'little',
            '低学年キッズ（小1〜小3）'  => 'kids-junior',
            '高学年ジュニア（小4〜小6）' => 'kids-advance',
            '中学生アドバンス'           => 'teen',
        );
        foreach ($age_terms as $name => $slug) {
            if (!term_exists($slug, 'class_age_group')) {
                wp_insert_term($name, 'class_age_group', array('slug' => $slug));
            }
        }

        // 2. 開講スケジュール (class_schedule)
        $schedule_terms = array(
            '平日夕方（15:00〜17:00）' => 'weekday-evening-early',
            '平日夜（17:00〜19:00）'   => 'weekday-evening-late',
            '土曜午前'                 => 'saturday-morning',
            '日曜午後'                 => 'sunday-afternoon',
        );
        foreach ($schedule_terms as $name => $slug) {
            if (!term_exists($slug, 'class_schedule')) {
                wp_insert_term($name, 'class_schedule', array('slug' => $slug));
            }
        }

        // 3. 指導特性・仕様 (class_features)
        $feature_terms = array(
            '完全未経験推奨'   => 'beginner-welcome',
            'リズム基礎重視'   => 'rhythm-focus',
            '保護者見学可能'   => 'parent-viewing',
            '2名指導体制'      => 'two-instructors',
            '弾性木床適用'     => 'sprung-floor',
        );
        foreach ($feature_terms as $name => $slug) {
            if (!term_exists($slug, 'class_features')) {
                wp_insert_term($name, 'class_features', array('slug' => $slug));
            }
        }

        // 完了フラグ保存
        update_option('skda_terms_seeded_v1', true);
    }
}
add_action('after_switch_theme', 'skda_seed_initial_terms');
add_action('init', 'skda_seed_initial_terms', 20);
