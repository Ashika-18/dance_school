<?php
/**
 * Core pages seeder
 *
 * 管理画面を開かずに、サイト回遊で使う固定ページを一度だけ公開する。
 *
 * @package SunnyKidsDanceAcademy
 */

defined('ABSPATH') || exit;

/**
 * 不足している固定ページを作成し、パーマリンクを一度だけ再構築する。
 */
if (!function_exists('skda_seed_core_pages')) {
    function skda_seed_core_pages() {
        if (get_option('skda_core_pages_seeded_v2')) {
            return;
        }

        $pages = array(
            'curriculum'     => 'カリキュラム・進度基準',
            'instructors'    => '指導陣・専門資格者紹介',
            'facility'       => '施設設備・安全対策',
            'system'         => '受講システム',
            'pricing'        => '料金一覧・振替受講制度',
            'trial'          => '体験レッスン完全ガイド',
            'privacy-policy' => 'プライバシーポリシー',
            'terms'          => '受講規約・キャンセル規定',
            'tokusho'        => '特定商取引法に基づく表記',
        );

        foreach ($pages as $slug => $title) {
            $existing = get_page_by_path($slug, OBJECT, 'page');
            if ($existing instanceof WP_Post) {
                $update = array('ID' => $existing->ID);
                $needs_update = false;

                if ('publish' !== $existing->post_status) {
                    $update['post_status'] = 'publish';
                    $needs_update = true;
                }
                if ($existing->post_title !== $title) {
                    $update['post_title'] = $title;
                    $needs_update = true;
                }
                if (false !== strpos((string) $existing->post_content, 'privacy-policy-tutorial')) {
                    $update['post_content'] = '';
                    $needs_update = true;
                }
                if ($needs_update) {
                    wp_update_post($update);
                }
                continue;
            }

            wp_insert_post(array(
                'post_title'     => $title,
                'post_name'      => $slug,
                'post_status'    => 'publish',
                'post_type'      => 'page',
                'post_content'   => '',
                'comment_status' => 'closed',
                'ping_status'    => 'closed',
            ));
        }

        flush_rewrite_rules(false);
        update_option('skda_core_pages_seeded_v2', 1, false);
    }
}
add_action('after_switch_theme', 'skda_seed_core_pages');
add_action('init', 'skda_seed_core_pages', 30);
