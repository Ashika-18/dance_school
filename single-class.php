<?php
/**
 * Single Template for Class Programs (開講クラス個別詳細)
 *
 * @package SunnyKidsDanceAcademy
 * @author  AshikaWorks
 * @version 1.0.0
 */

defined('ABSPATH') || exit;

get_header();

while (have_posts()) :
    the_post();

    // Step 3 定義のカスタムフィールド（12項目）取得
    $post_id          = get_the_ID();
    $sub_en           = get_post_meta($post_id, '_class_sub_en', true);
    $target_age       = get_post_meta($post_id, '_class_target_age', true);
    $capacity         = get_post_meta($post_id, '_class_capacity', true);
    $instructor_ratio = get_post_meta($post_id, '_class_instructor_ratio', true);
    $price_monthly    = get_post_meta($post_id, '_class_price_monthly', true);
    $duration_min     = get_post_meta($post_id, '_class_duration_min', true);
    $vacancy_status   = get_post_meta($post_id, '_class_vacancy_status', true);
    $vacancy_note     = get_post_meta($post_id, '_class_vacancy_note', true);
    $curriculum_level = get_post_meta($post_id, '_class_curriculum_level', true);
    $requirements     = get_post_meta($post_id, '_class_requirements', true);
    $gallery_images   = get_post_meta($post_id, '_class_gallery_images', true);
    $assigned_teacher = get_post_meta($post_id, '_class_assigned_teacher', true);

    // タクソノミー（所属ターム）取得
    $age_terms    = get_the_terms($post_id, 'class_age_group');
    $sched_terms  = get_the_terms($post_id, 'class_schedule');
    $feat_terms   = get_the_terms($post_id, 'class_features');
?>

<main id="primary" class="site-main skd-single-main" role="main">

    <!-- クラス詳細ヘッダー（パンくず＋タイトル） -->
    <header class="skd-single-header">
        <div class="skd-container">
            <!-- パンくずリスト -->
            <nav class="skd-breadcrumb" aria-label="<?php esc_attr_e('パンくずリスト', 'sunny-kids-dance'); ?>">
                <ol itemscope itemtype="https://schema.org/BreadcrumbList">
                    <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                        <a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>">
                            <span itemprop="name"><?php esc_html_e('ホーム', 'sunny-kids-dance'); ?></span>
                        </a>
                        <meta itemprop="position" content="1">
                    </li>
                    <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                        <a itemprop="item" href="<?php echo esc_url(get_post_type_archive_link('class')); ?>">
                            <span itemprop="name"><?php esc_html_e('開講クラス一覧', 'sunny-kids-dance'); ?></span>
                        </a>
                        <meta itemprop="position" content="2">
                    </li>
                    <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                        <span itemprop="name" aria-current="page"><?php the_title(); ?></span>
                        <meta itemprop="position" content="3">
                    </li>
                </ol>
            </nav>

            <?php if (!empty($sub_en)) : ?>
                <span class="skd-section-label-en"><?php echo esc_html($sub_en); ?></span>
            <?php endif; ?>

            <h1 class="skd-section-heading-h2"><?php the_title(); ?></h1>

            <div class="skd-single-header__meta">
                <?php if (!empty($target_age)) : ?>
                    <span class="skd-badge-target-large"><?php echo esc_html($target_age); ?></span>
                <?php endif; ?>
                <?php if (function_exists('skda_get_vacancy_badge')) : ?>
                    <?php echo skda_get_vacancy_badge($post_id); ?>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <!-- クラス本文・ビジュアル・ギャラリーエリア -->
    <article class="skd-single-content">
        <div class="skd-container skd-container--narrow">

            <!-- メインアイキャッチビジュアル -->
            <div class="skd-single-hero-media">
                <?php if (has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail('skda-hero-desktop', array('alt' => the_title_attribute(array('echo' => false)), 'class' => 'skd-single-hero-img')); ?>
                <?php else : ?>
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/hero-fallback.jpg'); ?>" alt="<?php the_title_attribute(); ?>" class="skd-single-hero-img" width="1200" height="630">
                <?php endif; ?>
            </div>

            <!-- クラス概要・本文（エディタ内容） -->
            <section class="skd-single-body" aria-label="<?php esc_attr_e('クラスの概要と指導方針', 'sunny-kids-dance'); ?>">
                <?php the_content(); ?>
            </section>

            <!-- 練習風景ギャラリー（最大4枚・モーダル連動） -->
            <?php
            $gallery_ids = !empty($gallery_images) ? array_filter(explode(',', $gallery_images)) : array();
            if (!empty($gallery_ids)) :
            ?>
                <section class="skd-single-gallery-section" aria-label="<?php esc_attr_e('練習風景ギャラリー', 'sunny-kids-dance'); ?>">
                    <h2 class="skd-single-subheading"><?php esc_html_e('レッスン風景・スタジオの様子', 'sunny-kids-dance'); ?></h2>
                    <div class="skd-single-gallery-grid">
                        <?php foreach ($gallery_ids as $img_id) :
                            $full_url  = wp_get_attachment_image_url((int)$img_id, 'large');
                            $thumb_url = wp_get_attachment_image_url((int)$img_id, 'skda-card-thumb');
                            $alt_text  = get_post_meta((int)$img_id, '_wp_attachment_image_alt', true);
                            if ($thumb_url) :
                        ?>
                            <div class="skd-single-gallery-item">
                                <a href="<?php echo esc_url($full_url); ?>" class="js-lightbox-trigger" data-full="<?php echo esc_url($full_url); ?>" aria-label="<?php esc_attr_e('画像を拡大表示する', 'sunny-kids-dance'); ?>">
                                    <img src="<?php echo esc_url($thumb_url); ?>" alt="<?php echo esc_attr($alt_text ? $alt_text : get_the_title()); ?>" width="800" height="530" loading="lazy">
                                    <span class="skd-gallery-zoom-icon" aria-hidden="true">&#x1F50D;</span>
                                </a>
                            </div>
                        <?php
                            endif;
                        endforeach;
                        ?>
                    </div>
                </section>
            <?php endif; ?>

            <!-- Step 3 仕様：12項目完全メタデータマトリクス表 -->
            <section class="skd-single-spec-section" aria-label="<?php esc_attr_e('開講クラス詳細スペック一覧', 'sunny-kids-dance'); ?>">
                <h2 class="skd-single-subheading"><?php esc_html_e('クラス詳細スペック・利用規程データ', 'sunny-kids-dance'); ?></h2>
                <div class="skd-specs-table-wrap">
                    <table class="skd-specs-table">
                        <tbody>
                            <!-- 01. 対象年齢・学年 -->
                            <tr>
                                <th scope="row"><?php esc_html_e('対象年齢・学年', 'sunny-kids-dance'); ?></th>
                                <td><?php echo !empty($target_age) ? esc_html($target_age) : '—'; ?></td>
                            </tr>

                            <!-- 02. 定員・指導体制 -->
                            <tr>
                                <th scope="row"><?php esc_html_e('定員・指導体制', 'sunny-kids-dance'); ?></th>
                                <td>
                                    <?php if (!empty($capacity)) : ?>
                                        <strong><?php printf(esc_html__('1クラス最大%d名限定（完全定員制）', 'sunny-kids-dance'), absint($capacity)); ?></strong>
                                    <?php endif; ?>
                                    <?php if (!empty($instructor_ratio)) : ?>
                                        <span><?php echo esc_html($instructor_ratio); ?></span>
                                    <?php endif; ?>
                                </td>
                            </tr>

                            <!-- 03. 1コマ所要時間 -->
                            <tr>
                                <th scope="row"><?php esc_html_e('1コマ所要時間', 'sunny-kids-dance'); ?></th>
                                <td>
                                    <?php if (!empty($duration_min)) : ?>
                                        <?php printf(esc_html__('1回 %d分（ウォーミングアップ・アイソレーション・振付・クールダウン）', 'sunny-kids-dance'), absint($duration_min)); ?>
                                    <?php else : ?>
                                        50分
                                    <?php endif; ?>
                                </td>
                            </tr>

                            <!-- 04. 月額受講料（税込） -->
                            <tr>
                                <th scope="row"><?php esc_html_e('月額受講料', 'sunny-kids-dance'); ?></th>
                                <td>
                                    <strong class="skd-spec-price">
                                        <?php echo function_exists('skda_get_formatted_price') ? skda_get_formatted_price($post_id) : '¥10,800（税込）/月'; ?>
                                    </strong>
                                    <span class="skd-spec-note"><?php esc_html_e('※月4回受講。月謝制・クレジットカード決済または口座振替。', 'sunny-kids-dance'); ?></span>
                                </td>
                            </tr>

                            <!-- 05. 空席募集状況 -->
                            <tr>
                                <th scope="row"><?php esc_html_e('募集・空席状況', 'sunny-kids-dance'); ?></th>
                                <td>
                                    <?php
                                    if (function_exists('skda_get_vacancy_badge')) {
                                        echo skda_get_vacancy_badge($post_id);
                                    }
                                    if (!empty($vacancy_note)) {
                                        echo '<p class="skd-spec-vacancy-text">' . esc_html($vacancy_note) . '</p>';
                                    }
                                    ?>
                                </td>
                            </tr>

                            <!-- 06. 進度管理基準 -->
                            <tr>
                                <th scope="row"><?php esc_html_e('進度管理基準', 'sunny-kids-dance'); ?></th>
                                <td><?php echo !empty($curriculum_level) ? esc_html($curriculum_level) : esc_html__('独自カリキュラム「Step-by-Step 12段階進度管理シート」準拠', 'sunny-kids-dance'); ?></td>
                            </tr>

                            <!-- 07. 準備物・指定規格 -->
                            <tr>
                                <th scope="row"><?php esc_html_e('準備物・指定規格', 'sunny-kids-dance'); ?></th>
                                <td><?php echo !empty($requirements) ? nl2br(esc_html($requirements)) : esc_html__('動きやすい服装（Tシャツ等）、室内用スニーカー、水筒、タオル&#10;※指定衣装の強制購入や高額ウェア指定は一切ございません。', 'sunny-kids-dance'); ?></td>
                            </tr>

                            <!-- 08. 担当講師・指導資格 -->
                            <tr>
                                <th scope="row"><?php esc_html_e('メイン担当講師', 'sunny-kids-dance'); ?></th>
                                <td>
                                    <?php if (!empty($assigned_teacher)) : ?>
                                        <strong><?php echo esc_html($assigned_teacher); ?></strong>
                                    <?php else : ?>
                                        <strong><?php esc_html_e('有資格専属インストラクター＋アシスタント', 'sunny-kids-dance'); ?></strong>
                                    <?php endif; ?>
                                    <span class="skd-spec-note"><?php esc_html_e('（全講師が幼少年身体運動指導士・日本ダンス医科学研究会公認資格保有）', 'sunny-kids-dance'); ?></span>
                                </td>
                            </tr>

                            <!-- 09. 開講スケジュール枠 -->
                            <?php if (!empty($sched_terms) && !is_wp_error($sched_terms)) : ?>
                                <tr>
                                    <th scope="row"><?php esc_html_e('開講時間枠', 'sunny-kids-dance'); ?></th>
                                    <td>
                                        <?php
                                        $sched_names = wp_list_pluck($sched_terms, 'name');
                                        echo esc_html(implode(' / ', $sched_names));
                                        ?>
                                    </td>
                                </tr>
                            <?php endif; ?>

                            <!-- 10. 指導特性・仕様タグ -->
                            <?php if (!empty($feat_terms) && !is_wp_error($feat_terms)) : ?>
                                <tr>
                                    <th scope="row"><?php esc_html_e('指導特性・設備仕様', 'sunny-kids-dance'); ?></th>
                                    <td>
                                        <div class="skd-spec-tag-list">
                                            <?php foreach ($feat_terms as $feat) : ?>
                                                <span class="skd-class-card__spec-pill"><?php echo esc_html($feat->name); ?></span>
                                            <?php endforeach; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- 前後ナビゲーション -->
            <nav class="skd-single-pagination" aria-label="<?php esc_attr_e('前後のクラス案内', 'sunny-kids-dance'); ?>">
                <div class="skd-single-pagination__prev">
                    <?php previous_post_link('%link', '&larr; %title'); ?>
                </div>
                <div class="skd-single-pagination__archive">
                    <a href="<?php echo esc_url(get_post_type_archive_link('class')); ?>">
                        <?php esc_html_e('クラス一覧へ戻る', 'sunny-kids-dance'); ?>
                    </a>
                </div>
                <div class="skd-single-pagination__next">
                    <?php next_post_link('%link', '%title &rarr;'); ?>
                </div>
            </nav>

        </div>
    </article>

    <!-- 画面下部固定：予約エスコートドック（Sticky Reservation Dock） -->
    <aside class="skd-reservation-dock js-reservation-dock" aria-label="<?php esc_attr_e('体験レッスン予約窓口', 'sunny-kids-dance'); ?>">
        <div class="skd-container skd-reservation-dock__inner">
            <div class="skd-reservation-dock__info">
                <span class="skd-reservation-dock__class-title"><?php the_title(); ?></span>
                <span class="skd-reservation-dock__price">
                    <?php echo function_exists('skda_get_formatted_price') ? skda_get_formatted_price($post_id) : '¥10,800（税込）/月'; ?>
                </span>
                <?php if (!empty($vacancy_note)) : ?>
                    <span class="skd-reservation-dock__note"><?php echo esc_html($vacancy_note); ?></span>
                <?php endif; ?>
            </div>
            <div class="skd-reservation-dock__action">
                <a href="<?php echo esc_url(home_url('/trial/?class_id=' . $post_id)); ?>" class="skd-btn-dock-primary">
                    <?php esc_html_e('このクラスの無料体験を予約する', 'sunny-kids-dance'); ?>
                </a>
            </div>
        </div>
    </aside>

    <!-- 画像拡大ライトボックスモーダルコンテナ -->
    <div id="skd-lightbox-modal" class="skd-lightbox-modal" aria-hidden="true" role="dialog">
        <div class="skd-lightbox-modal__backdrop js-lightbox-close"></div>
        <div class="skd-lightbox-modal__dialog">
            <button type="button" class="skd-lightbox-modal__close js-lightbox-close" aria-label="<?php esc_attr_e('閉じる', 'sunny-kids-dance'); ?>">&times;</button>
            <img src="" alt="" class="skd-lightbox-modal__img js-lightbox-img">
        </div>
    </div>

</main>

<style>
/* 個別詳細固有スタイル */
.skd-single-header {
    padding-top: calc(var(--header-height-desktop) + 40px);
    padding-bottom: 32px;
    background-color: var(--color-bg-sub);
    text-align: center;
    border-bottom: 1px solid var(--color-border);
}
.skd-breadcrumb {
    margin-bottom: 16px;
}
.skd-breadcrumb ol {
    display: inline-flex;
    flex-wrap: wrap;
    gap: 8px;
    font-size: 0.75rem;
    color: var(--color-text-sub-muted);
}
.skd-breadcrumb li::after {
    content: "/";
    margin-left: 8px;
}
.skd-breadcrumb li:last-child::after {
    content: "";
}
.skd-single-header__meta {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 12px;
    margin-top: 16px;
}
.skd-badge-target-large {
    background-color: #222B35;
    color: #FFFFFF;
    font-size: 0.8125rem;
    font-weight: 600;
    padding: 6px 16px;
    border-radius: var(--radius-pill);
}
.skd-single-content {
    padding-top: 48px;
    padding-bottom: 120px;
}
.skd-single-hero-media {
    border-radius: var(--radius-card);
    overflow: hidden;
    box-shadow: var(--shadow-card);
    margin-bottom: 40px;
}
.skd-single-hero-img {
    width: 100%;
    aspect-ratio: 16 / 9;
    object-fit: cover;
}
.skd-single-body {
    font-size: 1.0rem;
    line-height: 2.0;
    color: var(--color-text-secondary);
    margin-bottom: 56px;
}
.skd-single-body p {
    margin-bottom: 24px;
}
.skd-single-subheading {
    font-family: var(--font-serif);
    font-size: 1.375rem;
    font-weight: 600;
    color: var(--color-text-primary);
    margin-bottom: 24px;
    padding-bottom: 12px;
    border-bottom: 2px solid var(--color-accent);
}
.skd-single-gallery-section {
    margin-bottom: 64px;
}
.skd-single-gallery-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
}
.skd-single-gallery-item {
    border-radius: 16px;
    overflow: hidden;
    position: relative;
    box-shadow: var(--shadow-card);
}
.skd-single-gallery-item img {
    width: 100%;
    aspect-ratio: 3 / 2;
    object-fit: cover;
    transition: transform var(--transition-base);
}
.skd-single-gallery-item:hover img {
    transform: scale(1.04);
}
.skd-gallery-zoom-icon {
    position: absolute;
    bottom: 12px;
    right: 12px;
    background: rgba(0,0,0,0.6);
    color: #FFF;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
}
.skd-single-spec-section {
    margin-bottom: 64px;
}
.skd-spec-price {
    font-size: 1.25rem;
    color: var(--color-text-primary);
}
.skd-spec-note {
    display: block;
    font-size: 0.8125rem;
    color: var(--color-text-sub-muted);
    margin-top: 4px;
}
.skd-spec-vacancy-text {
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--color-accent-sub);
    margin-top: 6px;
}
.skd-spec-tag-list {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}
.skd-single-pagination {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 32px;
    border-top: 1px solid var(--color-border);
    font-size: 0.875rem;
}
.skd-single-pagination a {
    color: var(--color-text-primary);
    font-weight: 600;
}
.skd-single-pagination a:hover {
    color: var(--color-accent);
}

/* 下部固定予約ドック */
.skd-reservation-dock {
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    background: rgba(255, 255, 255, 0.96);
    backdrop-filter: blur(12px);
    border-top: 1px solid var(--color-border);
    box-shadow: 0 -4px 20px rgba(0,0,0,0.08);
    z-index: 95;
    padding: 14px 0;
}
.skd-reservation-dock__inner {
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.skd-reservation-dock__info {
    display: flex;
    align-items: center;
    gap: 16px;
}
.skd-reservation-dock__class-title {
    font-family: var(--font-sans);
    font-weight: 700;
    font-size: 1.0rem;
    color: var(--color-text-primary);
}
.skd-reservation-dock__price {
    font-size: 1.0625rem;
    font-weight: 700;
    color: var(--color-accent);
}
.skd-reservation-dock__note {
    font-size: 0.75rem;
    color: var(--color-accent-sub);
    font-weight: 600;
}
.skd-btn-dock-primary {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background-color: var(--color-accent);
    color: #FFFFFF;
    font-weight: 700;
    font-size: 0.9375rem;
    padding: 12px 32px;
    border-radius: var(--radius-pill);
    box-shadow: 0 4px 14px rgba(197, 155, 39, 0.35);
    transition: all var(--transition-base);
}
.skd-btn-dock-primary:hover {
    transform: translateY(-2px);
    background-color: #B58B1E;
}

/* ライトボックスモーダル */
.skd-lightbox-modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 1000;
    display: none;
    align-items: center;
    justify-content: center;
}
.skd-lightbox-modal.is-active {
    display: flex;
}
.skd-lightbox-modal__backdrop {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.85);
}
.skd-lightbox-modal__dialog {
    position: relative;
    z-index: 1001;
    max-width: 90vw;
    max-height: 85vh;
}
.skd-lightbox-modal__img {
    max-width: 100%;
    max-height: 85vh;
    border-radius: 8px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.5);
}
.skd-lightbox-modal__close {
    position: absolute;
    top: -44px;
    right: 0;
    font-size: 36px;
    color: #FFF;
    cursor: pointer;
    line-height: 1;
}

@media screen and (max-width: 767px) {
    .skd-single-gallery-grid {
        grid-template-columns: 1fr;
    }
    .skd-reservation-dock__inner {
        flex-direction: column;
        gap: 10px;
    }
    .skd-btn-dock-primary {
        width: 100%;
    }
}
</style>

<script>
// ライトボックスモーダル制御
document.addEventListener('DOMContentLoaded', function() {
    var modal = document.getElementById('skd-lightbox-modal');
    var modalImg = modal ? modal.querySelector('.js-lightbox-img') : null;
    var triggers = document.querySelectorAll('.js-lightbox-trigger');
    var closers = document.querySelectorAll('.js-lightbox-close');

    if (modal && modalImg) {
        triggers.forEach(function(trigger) {
            trigger.addEventListener('click', function(e) {
                e.preventDefault();
                var fullUrl = trigger.getAttribute('data-full');
                modalImg.src = fullUrl;
                modal.classList.add('is-active');
                modal.setAttribute('aria-hidden', 'false');
                document.body.style.overflow = 'hidden';
            });
        });

        closers.forEach(function(closer) {
            closer.addEventListener('click', function() {
                modal.classList.remove('is-active');
                modal.setAttribute('aria-hidden', 'true');
                modalImg.src = '';
                document.body.style.removeProperty('overflow');
            });
        });
    }
});
</script>

<?php
endwhile;

get_footer();