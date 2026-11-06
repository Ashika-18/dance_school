<?php
/**
 * Theme Setup and Assets Management
 *
 * @package SunnyKidsDanceAcademy
 * @author  AshikaWorks
 * @version 1.0.0
 */

defined('ABSPATH') || exit;

/* ==========================================================================
   01. テーマ基本機能セットアップ
   ========================================================================== */
if (!function_exists('skda_setup_theme_features')) {
    function skda_setup_theme_features() {
        load_theme_textdomain('sunny-kids-dance', get_template_directory() . '/languages');

        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');

        set_post_thumbnail_size(800, 530, true);

        add_image_size('skda-hero-desktop', 1920, 1080, true);
        add_image_size('skda-hero-mobile', 750, 1100, true);
        add_image_size('skda-portrait', 800, 1060, true);
        add_image_size('skda-card-thumb', 800, 530, true);
        add_image_size('skda-square-thumb', 600, 600, true);
        add_image_size('skda-icon-retina', 200, 200, true);

        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
            'navigation-widgets'
        ));

        add_theme_support('custom-logo', array(
            'height'      => 120,
            'width'       => 480,
            'flex-height' => true,
            'flex-width'  => true,
            'header-text' => array('site-title', 'site-description'),
        ));

        add_theme_support('responsive-embeds');
        add_theme_support('align-wide');

        register_nav_menus(array(
            'global-nav'  => esc_html__('グローバルナビゲーション', 'sunny-kids-dance'),
            'drawer-nav'  => esc_html__('モバイルドロワーナビゲーション', 'sunny-kids-dance'),
            'footer-nav'  => esc_html__('フッターナビゲーション', 'sunny-kids-dance'),
            'sub-nav'     => esc_html__('ユーティリティ・法的表記リンク', 'sunny-kids-dance'),
        ));
    }
}
add_action('after_setup_theme', 'skda_setup_theme_features');

/* ==========================================================================
   02. Google Fonts用 Preconnect リソースヒント
   ========================================================================== */
if (!function_exists('skda_resource_hints')) {
    function skda_resource_hints($urls, $relation_type) {
        if ('preconnect' === $relation_type) {
            $urls[] = array('href' => 'https://fonts.googleapis.com');
            $urls[] = array('href' => 'https://fonts.gstatic.com', 'crossorigin' => 'anonymous');
        }
        return $urls;
    }
}
add_filter('wp_resource_hints', 'skda_resource_hints', 10, 2);

/* ==========================================================================
   03. CSS・JavaScript アセットの適正登録＆エンキュー
   ========================================================================== */
if (!function_exists('skda_enqueue_theme_assets')) {
    function skda_enqueue_theme_assets() {
        $theme_version = defined('SKDA_THEME_VERSION') ? SKDA_THEME_VERSION : '1.0.0';

        // 1. Google Fonts
        wp_enqueue_style(
            'skda-google-fonts',
            'https://fonts.googleapis.com/css2?family=Cinzel:wght@500;600;700&family=Noto+Serif+JP:wght@400;500;600;700&family=Zen+Kaku+Gothic+New:wght@400;500;700&display=swap',
            array(),
            null
        );

        // 2. テーマ直下の style.css を強制読み込み
        wp_enqueue_style(
            'skda-theme-root-style',
            get_stylesheet_uri(),
            array('skda-google-fonts'),
            $theme_version
        );

        // assets/css/main.css が存在する場合はそちらも読み込み
        $main_css_path = get_template_directory() . '/assets/css/main.css';
        if (file_exists($main_css_path)) {
            wp_enqueue_style(
                'skda-main-style',
                get_template_directory_uri() . '/assets/css/main.css',
                array('skda-theme-root-style'),
                $theme_version
            );
        }

        // 3. バニラJavaScript (assets/js/main.js)
        $main_js_uri = get_template_directory_uri() . '/assets/js/main.js';
        wp_enqueue_script(
            'skda-theme-main-script',
            $main_js_uri,
            array(),
            $theme_version,
            true
        );

        // 4. JS側への環境パラメータ受け渡し
        wp_localize_script('skda-theme-main-script', 'skdaSiteData', array(
            'homeUrl'      => esc_url(home_url('/')),
            'ajaxUrl'      => esc_url(admin_url('admin-ajax.php')),
            'themeDirUri'  => esc_url(get_template_directory_uri()),
            'securityNonce'=> wp_create_nonce('skda_site_public_nonce'),
            'headerHeight' => array(
                'desktop'  => 74,
                'mobile'   => 60,
            ),
        ));
    }
}
add_action('wp_enqueue_scripts', 'skda_enqueue_theme_assets');