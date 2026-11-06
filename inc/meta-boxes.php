<?php
/**
 * Native Custom Fields and Meta Boxes Management
 *
 * @package SunnyKidsDanceAcademy
 * @author  AshikaWorks
 * @version 1.0.0
 */

defined('ABSPATH') || exit;

/* ==========================================================================
   01. メディアアップローダー用スクリプト・スタイルのエンキュー（管理画面）
   ========================================================================== */
if (!function_exists('skda_admin_meta_box_scripts')) {
    function skda_admin_meta_box_scripts($hook) {
        global $post_type;
        if (('post.php' === $hook || 'post-new.php' === $hook) && 'class' === $post_type) {
            // WordPress標準メディアアップローダー用アセットの読み込み
            wp_enqueue_media();
        }
    }
}
add_action('admin_enqueue_scripts', 'skda_admin_meta_box_scripts');

/* ==========================================================================
   02. メタボックス登録
   ========================================================================== */
if (!function_exists('skda_register_class_meta_box')) {
    function skda_register_class_meta_box() {
        add_meta_box(
            'skda_class_specs_metabox',
            esc_html__('開講クラス詳細スペック＆募集ステータス設定（Step 3 厳格仕様）', 'sunny-kids-dance'),
            'skda_render_class_specs_metabox',
            'class',
            'normal',
            'high'
        );
    }
}
add_action('add_meta_boxes', 'skda_register_class_meta_box');

/* ==========================================================================
   03. メタボックスHTMLレンダリング（ネイティブUI・12項目完全実装）
   ========================================================================== */
if (!function_exists('skda_render_class_specs_metabox')) {
    function skda_render_class_specs_metabox($post) {
        // 暗号学的Nonceフィールドの出力
        wp_nonce_field('skda_class_meta_action', 'skda_class_meta_nonce_field');

        // 保存済みメタデータの取得
        $sub_en           = get_post_meta($post->ID, '_class_sub_en', true);
        $target_age       = get_post_meta($post->ID, '_class_target_age', true);
        $capacity         = get_post_meta($post->ID, '_class_capacity', true);
        $instructor_ratio = get_post_meta($post->ID, '_class_instructor_ratio', true);
        $price_monthly    = get_post_meta($post->ID, '_class_price_monthly', true);
        $duration_min     = get_post_meta($post->ID, '_class_duration_min', true);
        $vacancy_status   = get_post_meta($post->ID, '_class_vacancy_status', true);
        $vacancy_note     = get_post_meta($post->ID, '_class_vacancy_note', true);
        $curriculum_level = get_post_meta($post->ID, '_class_curriculum_level', true);
        $requirements     = get_post_meta($post->ID, '_class_requirements', true);
        $gallery_images   = get_post_meta($post->ID, '_class_gallery_images', true);
        $assigned_teacher = get_post_meta($post->ID, '_class_assigned_teacher', true);

        // デフォルト値フォールバック
        if ('' === $vacancy_status) {
            $vacancy_status = 'open';
        }
        ?>
        <style>
            .skda-mb-table { width: 100%; border-collapse: collapse; margin-top: 8px; }
            .skda-mb-table th { width: 220px; padding: 14px 16px; background: #FAF8F4; border: 1px solid #E2DED5; font-size: 13px; font-weight: 700; color: #222222; text-align: left; vertical-align: top; line-height: 1.5; }
            .skda-mb-table td { padding: 12px 16px; border: 1px solid #E2DED5; background: #FFFFFF; vertical-align: middle; }
            .skda-mb-input-text { width: 100%; max-width: 520px; height: 38px; padding: 0 12px; font-size: 13px; border: 1px solid #C8C3B8; border-radius: 4px; }
            .skda-mb-input-number { width: 140px; height: 38px; padding: 0 12px; font-size: 13px; border: 1px solid #C8C3B8; border-radius: 4px; }
            .skda-mb-select { width: 240px; height: 38px; font-size: 13px; border: 1px solid #C8C3B8; border-radius: 4px; }
            .skda-mb-textarea { width: 100%; max-width: 640px; padding: 10px 12px; font-size: 13px; border: 1px solid #C8C3B8; border-radius: 4px; resize: vertical; }
            .skda-mb-desc { font-size: 11px; color: #666666; margin-top: 6px; line-height: 1.4; }
            .skda-mb-unit { margin-left: 6px; font-size: 12px; color: #555555; }
            .skda-gallery-preview { display: flex; flex-wrap: wrap; gap: 10px; margin-top: 10px; }
            .skda-gallery-thumb { width: 80px; height: 53px; border-radius: 4px; object-fit: cover; border: 1px solid #DDD; }
            .skda-btn-upload { background: #B9852B; color: #FFFFFF; border: none; padding: 8px 16px; font-size: 12px; font-weight: 600; border-radius: 4px; cursor: pointer; }
            .skda-btn-upload:hover { background: #9E6F1F; color: #FFFFFF; }
            .skda-btn-clear { background: #F0EDE6; color: #444; border: 1px solid #CCC; padding: 8px 14px; font-size: 12px; border-radius: 4px; cursor: pointer; margin-left: 6px; }
        </style>

        <table class="skda-mb-table">
            <!-- 01. 英字サブタイトル -->
            <tr>
                <th><label for="_class_sub_en"><?php esc_html_e('英字サブタイトル', 'sunny-kids-dance'); ?></label></th>
                <td>
                    <input type="text" id="_class_sub_en" name="_class_sub_en" class="skda-mb-input-text" value="<?php echo esc_attr($sub_en); ?>" placeholder="例: LITTLE RHYTHM CLASS">
                    <p class="skda-mb-desc"><?php esc_html_e('クラス英名。カード上部および個別ページのセクション見出し上に表示されます。', 'sunny-kids-dance'); ?></p>
                </td>
            </tr>

            <!-- 02. 対象年齢・学年 -->
            <tr>
                <th><label for="_class_target_age"><?php esc_html_e('対象年齢・学年', 'sunny-kids-dance'); ?></label></th>
                <td>
                    <input type="text" id="_class_target_age" name="_class_target_age" class="skda-mb-input-text" value="<?php echo esc_attr($target_age); ?>" placeholder="例: 4歳〜6歳（年中・年長）">
                    <p class="skda-mb-desc"><?php esc_html_e('カード上部バッジおよびスペック一覧に明記される対象年齢です。', 'sunny-kids-dance'); ?></p>
                </td>
            </tr>

            <!-- 03. 定員上限人数 -->
            <tr>
                <th><label for="_class_capacity"><?php esc_html_e('定員上限人数', 'sunny-kids-dance'); ?></label></th>
                <td>
                    <input type="number" id="_class_capacity" name="_class_capacity" class="skda-mb-input-number" value="<?php echo esc_attr($capacity); ?>" min="1" max="50" placeholder="8">
                    <span class="skda-mb-unit"><?php esc_html_e('名（定員制）', 'sunny-kids-dance'); ?></span>
                    <p class="skda-mb-desc"><?php esc_html_e('1クラスあたりの最大受講上限人数。安心エビデンス（定員8名限定）の論拠数値となります。', 'sunny-kids-dance'); ?></p>
                </td>
            </tr>

            <!-- 04. 指導体制 -->
            <tr>
                <th><label for="_class_instructor_ratio"><?php esc_html_e('指導体制・比率', 'sunny-kids-dance'); ?></label></th>
                <td>
                    <input type="text" id="_class_instructor_ratio" name="_class_instructor_ratio" class="skda-mb-input-text" value="<?php echo esc_attr($instructor_ratio); ?>" placeholder="例: 講師1名＋アシスタント1名（2名体制）">
                    <p class="skda-mb-desc"><?php esc_html_e('後列で戸惑うお子様を放置しないための指導員配置体制を明記します。', 'sunny-kids-dance'); ?></p>
                </td>
            </tr>

            <!-- 05. 月額受講料（税込） -->
            <tr>
                <th><label for="_class_price_monthly"><?php esc_html_e('月額受講料（税込）', 'sunny-kids-dance'); ?></label></th>
                <td>
                    <input type="number" id="_class_price_monthly" name="_class_price_monthly" class="skda-mb-input-number" value="<?php echo esc_attr($price_monthly); ?>" step="100" placeholder="10800">
                    <span class="skda-mb-unit"><?php esc_html_e('円（月4回・週1回）', 'sunny-kids-dance'); ?></span>
                    <p class="skda-mb-desc"><?php esc_html_e('半角数字で入力してください。サイト上では「¥10,800（税込）/月」と自動フォーマット出力されます。', 'sunny-kids-dance'); ?></p>
                </td>
            </tr>

            <!-- 06. 1コマ所要時間 -->
            <tr>
                <th><label for="_class_duration_min"><?php esc_html_e('1コマ所要時間', 'sunny-kids-dance'); ?></label></th>
                <td>
                    <input type="number" id="_class_duration_min" name="_class_duration_min" class="skda-mb-input-number" value="<?php echo esc_attr($duration_min); ?>" min="10" max="180" step="5" placeholder="50">
                    <span class="skda-mb-unit"><?php esc_html_e('分', 'sunny-kids-dance'); ?></span>
                    <p class="skda-mb-desc"><?php esc_html_e('1レッスンあたりの集中継続時間（標準：50分）。', 'sunny-kids-dance'); ?></p>
                </td>
            </tr>

            <!-- 07. 空席ステータス -->
            <tr>
                <th><label for="_class_vacancy_status"><?php esc_html_e('空席ステータス', 'sunny-kids-dance'); ?></label></th>
                <td>
                    <select id="_class_vacancy_status" name="_class_vacancy_status" class="skda-mb-select">
                        <option value="open" <?php selected($vacancy_status, 'open'); ?>><?php esc_html_e('残席あり (open)', 'sunny-kids-dance'); ?></option>
                        <option value="few" <?php selected($vacancy_status, 'few'); ?>><?php esc_html_e('残席わずか (few)', 'sunny-kids-dance'); ?></option>
                        <option value="wait" <?php selected($vacancy_status, 'wait'); ?>><?php esc_html_e('満席・キャンセル待ち受付中 (wait)', 'sunny-kids-dance'); ?></option>
                    </select>
                    <p class="skda-mb-desc"><?php esc_html_e('クラス一覧カードおよび予約導線に表示される募集ステータスバッジです。', 'sunny-kids-dance'); ?></p>
                </td>
            </tr>

            <!-- 08. 空席実数テキスト -->
            <tr>
                <th><label for="_class_vacancy_note"><?php esc_html_e('空席実数テキスト', 'sunny-kids-dance'); ?></label></th>
                <td>
                    <input type="text" id="_class_vacancy_note" name="_class_vacancy_note" class="skda-mb-input-text" value="<?php echo esc_attr($vacancy_note); ?>" placeholder="例: 土曜10:00枠 残り2席 / 水曜16:00枠 満席">
                    <p class="skda-mb-desc"><?php esc_html_e('予約ボタンの上部またはカード内に表示されるリアルタイムの残枠案内テキストです。', 'sunny-kids-dance'); ?></p>
                </td>
            </tr>

            <!-- 09. 進度管理基準 -->
            <tr>
                <th><label for="_class_curriculum_level"><?php esc_html_e('進度管理基準・到達目標', 'sunny-kids-dance'); ?></label></th>
                <td>
                    <input type="text" id="_class_curriculum_level" name="_class_curriculum_level" class="skda-mb-input-text" value="<?php echo esc_attr($curriculum_level); ?>" placeholder="例: Step 1〜Step 4 基礎リズム操作・動物模倣">
                    <p class="skda-mb-desc"><?php esc_html_e('「Step-by-Step 12段階進度管理シート」に基づく当該クラスの到達指標です。', 'sunny-kids-dance'); ?></p>
                </td>
            </tr>

            <!-- 10. 準備物・指定規格 -->
            <tr>
                <th><label for="_class_requirements"><?php esc_html_e('準備物・指定規格', 'sunny-kids-dance'); ?></label></th>
                <td>
                    <textarea id="_class_requirements" name="_class_requirements" class="skda-mb-textarea" rows="3" placeholder="動きやすい服装（Tシャツ・スパッツ等）、室内用スニーカー、水筒、タオル&#10;※高額な指定ウェアの購入義務は一切ございません。"><?php echo esc_textarea($requirements); ?></textarea>
                    <p class="skda-mb-desc"><?php esc_html_e('体験レッスン受講時および入会後の持ち物規定を改行区切りで記述します。', 'sunny-kids-dance'); ?></p>
                </td>
            </tr>

            <!-- 11. ギャラリー画像ID群（メディアアップローダー連携） -->
            <tr>
                <th><label for="_class_gallery_images"><?php esc_html_e('練習風景ギャラリー画像', 'sunny-kids-dance'); ?></label></th>
                <td>
                    <input type="hidden" id="_class_gallery_images" name="_class_gallery_images" value="<?php echo esc_attr($gallery_images); ?>">
                    <button type="button" class="skda-btn-upload" id="skda_upload_gallery_btn"><?php esc_html_e('メディアライブラリから画像を選択', 'sunny-kids-dance'); ?></button>
                    <button type="button" class="skda-btn-clear" id="skda_clear_gallery_btn"><?php esc_html_e('選択解除', 'sunny-kids-dance'); ?></button>
                    <p class="skda-mb-desc"><?php esc_html_e('クラス紹介スライダーまたは詳細ページに掲載する写真（アスペクト比 3:2 推奨、最大4枚）。', 'sunny-kids-dance'); ?></p>
                    <div class="skda-gallery-preview" id="skda_gallery_preview_container">
                        <?php
                        if (!empty($gallery_images)) {
                            $image_ids = array_filter(explode(',', $gallery_images));
                            foreach ($image_ids as $img_id) {
                                $thumb_url = wp_get_attachment_image_url((int)$img_id, 'thumbnail');
                                if ($thumb_url) {
                                    echo '<img src="' . esc_url($thumb_url) . '" class="skda-gallery-thumb" alt="">';
                                }
                            }
                        }
                        ?>
                    </div>
                </td>
            </tr>

            <!-- 12. 担当講師プロフィール参照 -->
            <tr>
                <th><label for="_class_assigned_teacher"><?php esc_html_e('担当講師名・保有指導資格', 'sunny-kids-dance'); ?></label></th>
                <td>
                    <input type="text" id="_class_assigned_teacher" name="_class_assigned_teacher" class="skda-mb-input-text" value="<?php echo esc_attr($assigned_teacher); ?>" placeholder="例: 佐々木 優香（幼少年身体運動指導士・日本ダンス医科学研究会公認）">
                    <p class="skda-mb-desc"><?php esc_html_e('クラス詳細下部に表示するメイン担当講師の氏名および保有公認資格です。', 'sunny-kids-dance'); ?></p>
                </td>
            </tr>
        </table>

        <!-- WordPressネイティブ・メディアアップローダー連動JavaScript -->
        <script>
        (function() {
            var uploadBtn = document.getElementById('skda_upload_gallery_btn');
            var clearBtn = document.getElementById('skda_clear_gallery_btn');
            var hiddenInput = document.getElementById('_class_gallery_images');
            var previewContainer = document.getElementById('skda_gallery_preview_container');
            var customUploader;

            if (uploadBtn && hiddenInput && previewContainer) {
                uploadBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    if (customUploader) {
                        customUploader.open();
                        return;
                    }
                    customUploader = wp.media({
                        title: '<?php echo esc_js(__('クラスギャラリー画像を選択（複数選択可）', 'sunny-kids-dance')); ?>',
                        button: { text: '<?php echo esc_js(__('選択した画像を挿入', 'sunny-kids-dance')); ?>' },
                        multiple: true,
                        library: { type: 'image' }
                    });

                    customUploader.on('select', function() {
                        var selection = customUploader.state().get('selection');
                        var ids = [];
                        previewContainer.innerHTML = '';

                        selection.each(function(attachment) {
                            var json = attachment.toJSON();
                            ids.push(json.id);
                            var thumbUrl = json.sizes && json.sizes.thumbnail ? json.sizes.thumbnail.url : json.url;
                            var img = document.createElement('img');
                            img.src = thumbUrl;
                            img.className = 'skda-gallery-thumb';
                            previewContainer.appendChild(img);
                        });

                        hiddenInput.value = ids.join(',');
                    });

                    customUploader.open();
                });

                if (clearBtn) {
                    clearBtn.addEventListener('click', function(e) {
                        e.preventDefault();
                        hiddenInput.value = '';
                        previewContainer.innerHTML = '';
                    });
                }
            }
        })();
        </script>
        <?php
    }
}

/* ==========================================================================
   04. メタボックス保存処理（Nonce暗号化検証・権限チェック・ディープサニタイズ）
   ========================================================================== */
if (!function_exists('skda_save_class_specs_metabox_data')) {
    function skda_save_class_specs_metabox_data($post_id) {
        // 1. Nonceの存在確認および暗号学的整合性チェック
        if (!isset($_POST['skda_class_meta_nonce_field']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['skda_class_meta_nonce_field'])), 'skda_class_meta_action')) {
            return $post_id;
        }

        // 2. 自動保存（AutoSave）処理の除外
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return $post_id;
        }

        // 3. 投稿タイプの合致確認
        if (isset($_POST['post_type']) && 'class' !== $_POST['post_type']) {
            return $post_id;
        }

        // 4. ユーザー編集権限の厳格チェック
        if (!current_user_can('edit_post', $post_id)) {
            return $post_id;
        }

        // 5. テキスト型項目のディープサニタイズ保存
        $string_fields = array(
            '_class_sub_en',
            '_class_target_age',
            '_class_instructor_ratio',
            '_class_vacancy_note',
            '_class_curriculum_level',
            '_class_assigned_teacher',
        );
        foreach ($string_fields as $field_key) {
            if (isset($_POST[$field_key])) {
                $sanitized_value = sanitize_text_field(wp_unslash($_POST[$field_key]));
                update_post_meta($post_id, $field_key, $sanitized_value);
            } else {
                delete_post_meta($post_id, $field_key);
            }
        }

        // 6. 数値型項目（整数）の厳格キャスト保存
        $int_fields = array(
            '_class_capacity',
            '_class_price_monthly',
            '_class_duration_min',
        );
        foreach ($int_fields as $field_key) {
            if (isset($_POST[$field_key]) && '' !== trim($_POST[$field_key])) {
                $int_value = absint($_POST[$field_key]);
                update_post_meta($post_id, $field_key, $int_value);
            } else {
                delete_post_meta($post_id, $field_key);
            }
        }

        // 7. セレクトボックス（空席ステータス）のホワイトリスト検証
        if (isset($_POST['_class_vacancy_status'])) {
            $allowed_statuses = array('open', 'few', 'wait');
            $status = sanitize_key($_POST['_class_vacancy_status']);
            if (in_array($status, $allowed_statuses, true)) {
                update_post_meta($post_id, '_class_vacancy_status', $status);
            } else {
                update_post_meta($post_id, '_class_vacancy_status', 'open');
            }
        }

        // 8. テキストエリア（準備物・指定規格）の改行保持サニタイズ
        if (isset($_POST['_class_requirements'])) {
            $textarea_value = sanitize_textarea_field(wp_unslash($_POST['_class_requirements']));
            update_post_meta($post_id, '_class_requirements', $textarea_value);
        } else {
            delete_post_meta($post_id, '_class_requirements');
        }

        // 9. ギャラリー画像ID群（カンマ区切り数値列の検証）
        if (isset($_POST['_class_gallery_images'])) {
            $raw_gallery = sanitize_text_field(wp_unslash($_POST['_class_gallery_images']));
            $ids = array_filter(explode(',', $raw_gallery));
            $clean_ids = array();
            foreach ($ids as $id) {
                $valid_id = absint(trim($id));
                if ($valid_id > 0) {
                    $clean_ids[] = $valid_id;
                }
            }
            update_post_meta($post_id, '_class_gallery_images', implode(',', array_slice($clean_ids, 0, 4)));
        } else {
            delete_post_meta($post_id, '_class_gallery_images');
        }

        return $post_id;
    }
}
add_action('save_post_class', 'skda_save_class_specs_metabox_data');