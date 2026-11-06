<?php
/**
 * Header Template for SUNNY KIDS DANCE ACADEMY
 *
 * @package SunnyKidsDanceAcademy
 * @author  AshikaWorks
 * @version 1.0.0
 */

defined('ABSPATH') || exit;
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="format-detection" content="telephone=no, address=no, email=no">

    <!-- SEO & SNS Meta Fallback -->
    <?php if (is_front_page() || is_home()) : ?>
        <meta name="description" content="<?php echo esc_attr('吉祥寺駅徒歩3分。少人数定員制（上限8名・講師2名体制）によるキッズダンススクール。二重弾性木床完備、発表会チケットノルマ完全ゼロ規定で安心してお通いいただけます。'); ?>">
        <meta property="og:type" content="website">
        <meta property="og:title" content="<?php bloginfo('name'); ?> | <?php bloginfo('description'); ?>">
        <meta property="og:description" content="<?php echo esc_attr('認めて、育てる。少人数制で笑顔が咲くキッズダンス。未経験から自己肯定感を育む吉祥寺校。'); ?>">
        <meta property="og:url" content="<?php echo esc_url(home_url('/')); ?>">
        <meta property="og:site_name" content="<?php bloginfo('name'); ?>">
    <?php endif; ?>

    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- アクセシビリティ・スキップリンク -->
<a class="skd-skip-link screen-reader-text" href="#primary">
    <?php esc_html_e('メインコンテンツへスキップ', 'sunny-kids-dance'); ?>
</a>

<!-- 固定グローバルヘッダー（透過〜スクロール連動磨りガラス） -->
<header id="masthead" class="skd-header js-header" role="banner">
    <div class="skd-container skd-header__inner">
        <!-- ロゴ＆ブランドステートメント -->
        <div class="skd-header__brand-group">
            <div class="skd-header__logo">
                <?php if (has_custom_logo()) : ?>
                    <?php the_custom_logo(); ?>
                <?php else : ?>
                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                        <span class="skd-header__logo-main">SUNNY KIDS DANCE</span>
                        <span class="skd-header__logo-sub">吉祥寺校</span>
                    </a>
                <?php endif; ?>
            </div>

            <!-- 多言語切替UI（日本語・英語表示シミュレーション） -->
            <div class="skd-header__lang" aria-label="<?php esc_attr_e('Language Switcher', 'sunny-kids-dance'); ?>">
                <span>JA</span>
                <span class="skd-header__lang-arrow">▾</span>
            </div>
        </div>

        <!-- デスクトップ用エディトリアルナビゲーション -->
        <nav id="site-navigation" class="skd-header__nav-desktop" role="navigation" aria-label="<?php esc_attr_e('メインメニュー', 'sunny-kids-dance'); ?>">
            <?php
            if (has_nav_menu('global-nav')) :
                wp_nav_menu(array(
                    'theme_location' => 'global-nav',
                    'menu_class'     => 'skd-header__nav-list',
                    'container'      => false,
                    'fallback_cb'    => false,
                    'depth'          => 1,
                    'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                ));
            else :
            ?>
                <ul class="skd-header__nav-list">
                    <li><a href="#philosophy" class="skd-header__nav-link">教育理念</a></li>
                    <li><a href="#commitment" class="skd-header__nav-link">3つの特徴</a></li>
                    <li><a href="#classes" class="skd-header__nav-link">開講クラス</a></li>
                    <li><a href="#specifications" class="skd-header__nav-link">施設・利用規約</a></li>
                    <li><a href="#access" class="skd-header__nav-link">アクセス</a></li>
                </ul>
            <?php endif; ?>

            <!-- ヘッダー右端CTAピルボタン -->
            <a href="#trial" class="skd-header__cta-btn">
                <?php esc_html_e('体験レッスン予約', 'sunny-kids-dance'); ?>
            </a>
        </nav>

        <!-- モバイルハンバーガートグルボタン -->
        <button type="button" class="skd-header__hamburger js-drawer-toggle" aria-controls="mobile-drawer" aria-expanded="false" aria-label="<?php esc_attr_e('メニューを開閉する', 'sunny-kids-dance'); ?>">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>
</header>

<!-- モバイル全画面ドロワーメニュー -->
<div id="mobile-drawer" class="skd-drawer js-drawer" aria-hidden="true">
    <div class="skd-drawer__inner">
        <nav class="skd-drawer__nav" role="navigation">
            <?php
            if (has_nav_menu('drawer-nav')) :
                wp_nav_menu(array(
                    'theme_location' => 'drawer-nav',
                    'menu_class'     => 'skd-drawer__menu',
                    'container'      => false,
                    'fallback_cb'    => false,
                    'depth'          => 1,
                ));
            else :
            ?>
                <ul class="skd-drawer__menu">
                    <li><a href="#philosophy">教育理念</a></li>
                    <li><a href="#commitment">3つの安心ポイント</a></li>
                    <li><a href="#classes">開講クラス案内</a></li>
                    <li><a href="#specifications">施設仕様・費用開示</a></li>
                    <li><a href="#access">アクセス・道順</a></li>
                </ul>
            <?php endif; ?>

            <div class="skd-drawer__cta">
                <a href="#trial" class="skd-btn-trial-primary" style="width: 100%; text-align: center;">
                    <?php esc_html_e('無料体験レッスンを予約する', 'sunny-kids-dance'); ?>
                </a>
                <p class="skd-drawer__tel">
                    TEL: <a href="tel:0422298815">0422-29-8815</a>
                </p>
            </div>
        </nav>
    </div>
</div>