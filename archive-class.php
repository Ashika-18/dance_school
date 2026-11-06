<?php
/**
 * Archive Template for Class Programs (開講クラス一覧)
 *
 * @package SunnyKidsDanceAcademy
 * @author  AshikaWorks
 * @version 1.0.0
 */

defined('ABSPATH') || exit;

get_header();

// URLパラメータの安全検証およびサニタイズ（3軸タクソノミー動的絞り込み）
$selected_age_group = isset($_GET['age_group']) ? sanitize_key($_GET['age_group']) : '';
$selected_schedule  = isset($_GET['schedule']) ? sanitize_key($_GET['schedule']) : '';
$selected_feature   = isset($_GET['feature']) ? sanitize_key($_GET['feature']) : '';

// タクソノミークエリ配列の構築
$tax_query = array('relation' => 'AND');

if (!empty($selected_age_group)) {
    $tax_query[] = array(
        'taxonomy' => 'class_age_group',
        'field'    => 'slug',
        'terms'    => $selected_age_group,
    );
}
if (!empty($selected_schedule)) {
    $tax_query[] = array(
        'taxonomy' => 'class_schedule',
        'field'    => 'slug',
        'terms'    => $selected_schedule,
    );
}
if (!empty($selected_feature)) {
    $tax_query[] = array(
        'taxonomy' => 'class_features',
        'field'    => 'slug',
        'terms'    => $selected_feature,
    );
}

// ページ番号の取得
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

// メインクエリアーギュメント
$archive_args = array(
    'post_type'      => 'class',
    'posts_per_page' => 9,
    'paged'          => $paged,
    'orderby'        => 'menu_order title',
    'order'          => 'ASC',
);

if (count($tax_query) > 1) {
    $archive_args['tax_query'] = $tax_query;
}

$class_archive_query = new WP_Query($archive_args);
?>

<main id="primary" class="site-main skd-archive-main" role="main">

    <!-- アーカイブヘッダー -->
    <header class="skd-archive-header">
        <div class="skd-container">
            <span class="skd-section-label-en">CLASS PROGRAMS</span>
            <h1 class="skd-section-heading-h2">開講クラス・カリキュラム一覧</h1>
            <p class="skd-archive-header__desc">
                お子様の発育段階・骨格・性格特性に寄り添う少人数定員制（上限8名・講師2名体制）。<br>
                完全未経験から安心してステップアップできる、全3段階の専用カリキュラムをご案内いたします。
            </p>
        </div>
    </header>

    <!-- 3軸タクソノミー動的絞り込みフォーム -->
    <section class="skd-filter-section" aria-label="<?php esc_attr_e('開講クラスの絞り込み検索', 'sunny-kids-dance'); ?>">
        <div class="skd-container skd-container--narrow">
            <form method="get" action="<?php echo esc_url(get_post_type_archive_link('class')); ?>" class="skd-filter-form">
                <div class="skd-filter-form__grid">
                    <!-- 1. 対象年齢区分 -->
                    <div class="skd-filter-item">
                        <label for="filter-age-group" class="skd-filter-item__label"><?php esc_html_e('対象年齢・学年', 'sunny-kids-dance'); ?></label>
                        <select name="age_group" id="filter-age-group" class="skd-filter-item__select">
                            <option value=""><?php esc_html_e('すべての年齢区分', 'sunny-kids-dance'); ?></option>
                            <?php
                            $age_terms = get_terms(array('taxonomy' => 'class_age_group', 'hide_empty' => false));
                            if (!empty($age_terms) && !is_wp_error($age_terms)) :
                                foreach ($age_terms as $term) :
                            ?>
                                <option value="<?php echo esc_attr($term->slug); ?>" <?php selected($selected_age_group, $term->slug); ?>>
                                    <?php echo esc_html($term->name); ?>
                                </option>
                            <?php
                                endforeach;
                            endif;
                            ?>
                        </select>
                    </div>

                    <!-- 2. 開講スケジュール -->
                    <div class="skd-filter-item">
                        <label for="filter-schedule" class="skd-filter-item__label"><?php esc_html_e('曜日・時間帯', 'sunny-kids-dance'); ?></label>
                        <select name="schedule" id="filter-schedule" class="skd-filter-item__select">
                            <option value=""><?php esc_html_e('すべての時間帯', 'sunny-kids-dance'); ?></option>
                            <?php
                            $schedule_terms = get_terms(array('taxonomy' => 'class_schedule', 'hide_empty' => false));
                            if (!empty($schedule_terms) && !is_wp_error($schedule_terms)) :
                                foreach ($schedule_terms as $term) :
                            ?>
                                <option value="<?php echo esc_attr($term->slug); ?>" <?php selected($selected_schedule, $term->slug); ?>>
                                    <?php echo esc_html($term->name); ?>
                                </option>
                            <?php
                                endforeach;
                            endif;
                            ?>
                        </select>
                    </div>

                    <!-- 3. 指導特性・仕様 -->
                    <div class="skd-filter-item">
                        <label for="filter-feature" class="skd-filter-item__label"><?php esc_html_e('指導特性・設備', 'sunny-kids-dance'); ?></label>
                        <select name="feature" id="filter-feature" class="skd-filter-item__select">
                            <option value=""><?php esc_html_e('すべての特性', 'sunny-kids-dance'); ?></option>
                            <?php
                            $feature_terms = get_terms(array('taxonomy' => 'class_features', 'hide_empty' => false));
                            if (!empty($feature_terms) && !is_wp_error($feature_terms)) :
                                foreach ($feature_terms as $term) :
                            ?>
                                <option value="<?php echo esc_attr($term->slug); ?>" <?php selected($selected_feature, $term->slug); ?>>
                                    <?php echo esc_html($term->name); ?>
                                </option>
                            <?php
                                endforeach;
                            endif;
                            ?>
                        </select>
                    </div>
                </div>

                <div class="skd-filter-form__actions">
                    <button type="submit" class="skd-filter-btn-submit">
                        <?php esc_html_e('条件で絞り込む', 'sunny-kids-dance'); ?>
                    </button>
                    <?php if (!empty($selected_age_group) || !empty($selected_schedule) || !empty($selected_feature)) : ?>
                        <a href="<?php echo esc_url(get_post_type_archive_link('class')); ?>" class="skd-filter-btn-reset">
                            <?php esc_html_e('条件をクリア', 'sunny-kids-dance'); ?>
                        </a>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </section>

    <!-- クラスカタロググリッド（12カラム秩序） -->
    <section class="skd-archive-catalog">
        <div class="skd-container">
            <div class="skd-class-grid">
                <?php
                if ($class_archive_query->have_posts()) :
                    while ($class_archive_query->have_posts()) : $class_archive_query->the_post();
                        $target_age       = get_post_meta(get_the_ID(), '_class_target_age', true);
                        $capacity         = get_post_meta(get_the_ID(), '_class_capacity', true);
                        $instructor_ratio = get_post_meta(get_the_ID(), '_class_instructor_ratio', true);
                        $duration_min     = get_post_meta(get_the_ID(), '_class_duration_min', true);
                        $sub_en           = get_post_meta(get_the_ID(), '_class_sub_en', true);
                        $status           = get_post_meta(get_the_ID(), '_class_vacancy_status', true);
                        $note             = get_post_meta(get_the_ID(), '_class_vacancy_note', true);
                ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('skd-class-card'); ?>>
                        <div class="skd-class-card__thumb-wrap">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('skda-card-thumb', array('alt' => the_title_attribute(array('echo' => false)))); ?>
                            <?php else : ?>
                                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/class-thumb-default.jpg'); ?>" alt="<?php the_title_attribute(); ?>" width="800" height="530" loading="lazy">
                            <?php endif; ?>

                            <?php if (!empty($target_age)) : ?>
                                <span class="skd-class-card__badge-target"><?php echo esc_html($target_age); ?></span>
                            <?php endif; ?>

                            <!-- 空席ステータスバッジ -->
                            <?php if (function_exists('skda_get_vacancy_badge')) : ?>
                                <div class="skd-class-card__status-overlay">
                                    <?php echo skda_get_vacancy_badge(get_the_ID()); ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="skd-class-card__content">
                            <?php if (!empty($sub_en)) : ?>
                                <span class="skd-section-label-en" style="text-align: left; font-size: 0.6875rem; margin-bottom: 4px;"><?php echo esc_html($sub_en); ?></span>
                            <?php endif; ?>

                            <h2 class="skd-class-card__title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>

                            <div class="skd-class-card__spec-pills">
                                <?php if (!empty($capacity)) : ?>
                                    <span class="skd-class-card__spec-pill"><?php printf(esc_html__('定員%d名限定', 'sunny-kids-dance'), absint($capacity)); ?></span>
                                <?php endif; ?>
                                <?php if (!empty($instructor_ratio)) : ?>
                                    <span class="skd-class-card__spec-pill"><?php echo esc_html($instructor_ratio); ?></span>
                                <?php endif; ?>
                                <?php if (!empty($duration_min)) : ?>
                                    <span class="skd-class-card__spec-pill"><?php printf(esc_html__('週1回%d分', 'sunny-kids-dance'), absint($duration_min)); ?></span>
                                <?php endif; ?>
                            </div>

                            <p class="skd-class-card__excerpt">
                                <?php echo wp_strip_all_tags(get_the_excerpt()); ?>
                            </p>

                            <?php if (!empty($note)) : ?>
                                <p class="skd-class-card__vacancy-note">
                                    <span class="skd-dot-indicator"></span><?php echo esc_html($note); ?>
                                </p>
                            <?php endif; ?>

                            <div class="skd-class-card__footer">
                                <div class="skd-class-card__price">
                                    <?php echo function_exists('skda_get_formatted_price') ? skda_get_formatted_price(get_the_ID()) : '¥10,800<span>（税込）/月</span>'; ?>
                                </div>
                                <a href="<?php the_permalink(); ?>" class="skd-class-card__btn">
                                    <?php esc_html_e('詳細を見る', 'sunny-kids-dance'); ?>
                                </a>
                            </div>
                        </div>
                    </article>
                <?php
                    endwhile;
                else :
                    // 検索ヒット0件時の完全原稿フォールバック
                ?>
                    <!-- フォールバック1：リトルリズムクラス -->
                    <article class="skd-class-card">
                        <div class="skd-class-card__thumb-wrap">
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/class-01.jpg'); ?>" alt="リトルリズムクラスの練習風景" width="800" height="530" loading="lazy">
                            <span class="skd-class-card__badge-target">対象：4歳〜6歳（年中・年長）</span>
                        </div>
                        <div class="skd-class-card__content">
                            <span class="skd-section-label-en" style="text-align: left; font-size: 0.6875rem; margin-bottom: 4px;">LITTLE RHYTHM CLASS</span>
                            <h2 class="skd-class-card__title">リトルリズムクラス（未就学児）</h2>
                            <div class="skd-class-card__spec-pills">
                                <span class="skd-class-card__spec-pill">定員8名限定</span>
                                <span class="skd-class-card__spec-pill">講師2名体制</span>
                                <span class="skd-class-card__spec-pill">週1回50分</span>
                            </div>
                            <p class="skd-class-card__excerpt">
                                音楽に合わせて跳ねる・止まるといった基礎的な身体操作を楽しみながら習得します。先生やお友達との心地よい関わりを通じて、集団行動のルールや挨拶の習慣を自然と身につけ、運動への前向きな意欲を芽生えさせます。
                            </p>
                            <div class="skd-class-card__footer">
                                <div class="skd-class-card__price">¥10,800<span>（税込）/月</span></div>
                                <a href="#trial" class="skd-class-card__btn">体験に申し込む</a>
                            </div>
                        </div>
                    </article>

                    <!-- フォールバック2：キッズベーシッククラス -->
                    <article class="skd-class-card">
                        <div class="skd-class-card__thumb-wrap">
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/class-02.jpg'); ?>" alt="キッズベーシッククラスの練習風景" width="800" height="530" loading="lazy">
                            <span class="skd-class-card__badge-target">対象：小学1年生〜小学3年生</span>
                        </div>
                        <div class="skd-class-card__content">
                            <span class="skd-section-label-en" style="text-align: left; font-size: 0.6875rem; margin-bottom: 4px;">KIDS BASIC CLASS</span>
                            <h2 class="skd-class-card__title">キッズベーシッククラス（小学校低学年）</h2>
                            <div class="skd-class-card__spec-pills">
                                <span class="skd-class-card__spec-pill">定員8名限定</span>
                                <span class="skd-class-card__spec-pill">講師2名体制</span>
                                <span class="skd-class-card__spec-pill">週1回50分</span>
                            </div>
                            <p class="skd-class-card__excerpt">
                                首・肩・腰を独立して動かすアイソレーションや、リズムの「アップ・ダウン」の基本を丁寧に分解指導。できた動きを講師がその場で具体的に褒めて認めることで、内気なお子様も主体的にステップを踏める自信を育みます。
                            </p>
                            <div class="skd-class-card__footer">
                                <div class="skd-class-card__price">¥10,800<span>（税込）/月</span></div>
                                <a href="#trial" class="skd-class-card__btn">体験に申し込む</a>
                            </div>
                        </div>
                    </article>

                    <!-- フォールバック3：ジュニアアドバンスクラス -->
                    <article class="skd-class-card">
                        <div class="skd-class-card__thumb-wrap">
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/class-03.jpg'); ?>" alt="ジュニアアドバンスクラスの練習風景" width="800" height="530" loading="lazy">
                            <span class="skd-class-card__badge-target">対象：小学4年生〜小学6年生</span>
                        </div>
                        <div class="skd-class-card__content">
                            <span class="skd-section-label-en" style="text-align: left; font-size: 0.6875rem; margin-bottom: 4px;">JUNIOR ADVANCE CLASS</span>
                            <h2 class="skd-class-card__title">ジュニアアドバンスクラス（小学校高学年）</h2>
                            <div class="skd-class-card__spec-pills">
                                <span class="skd-class-card__spec-pill">定員8名限定</span>
                                <span class="skd-class-card__spec-pill">講師2名体制</span>
                                <span class="skd-class-card__spec-pill">週1回50分</span>
                            </div>
                            <p class="skd-class-card__excerpt">
                                音楽のビートを立体的に捉え、仲間と息を合わせたフォーメーションダンスに挑戦します。自らの感情を身体全体で表現する力を高め、学校生活や将来のあらゆる場面で活きる確固たるプレゼンスとリーダーシップを養います。
                            </p>
                            <div class="skd-class-card__footer">
                                <div class="skd-class-card__price">¥10,800<span>（税込）/月</span></div>
                                <a href="#trial" class="skd-class-card__btn">体験に申し込む</a>
                            </div>
                        </div>
                    </article>
                <?php endif; ?>
            </div>

            <!-- ページネーション -->
            <?php if ($class_archive_query->max_num_pages > 1) : ?>
                <div class="skd-pagination">
                    <?php
                    echo paginate_links(array(
                        'base'      => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
                        'format'    => '?paged=%#%',
                        'current'   => max(1, get_query_var('paged')),
                        'total'     => $class_archive_query->max_num_pages,
                        'prev_text' => '&larr; 前へ',
                        'next_text' => '次へ &rarr;',
                        'type'      => 'list',
                    ));
                    ?>
                </div>
            <?php endif; ?>

            <?php wp_reset_postdata(); ?>
        </div>
    </section>

</main>

<style>
/* アーカイブ固有のレイアウトスタイル */
.skd-archive-header {
    padding-top: calc(var(--header-height-desktop) + 48px);
    padding-bottom: 40px;
    background-color: var(--color-bg-sub);
    text-align: center;
    border-bottom: 1px solid var(--color-border);
}
.skd-archive-header__desc {
    font-size: 0.9375rem;
    line-height: 1.85;
    color: var(--color-text-secondary);
    max-width: 680px;
    margin: 16px auto 0;
}
.skd-filter-section {
    padding: 32px 0;
    background-color: #FFFFFF;
    border-bottom: 1px solid var(--color-border);
}
.skd-filter-form__grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 16px;
    margin-bottom: 20px;
}
.skd-filter-item__label {
    display: block;
    font-size: 0.75rem;
    font-weight: 700;
    color: var(--color-text-primary);
    margin-bottom: 6px;
}
.skd-filter-item__select {
    width: 100%;
    height: 42px;
    padding: 0 12px;
    font-size: 0.8125rem;
    color: var(--color-text-secondary);
    background-color: var(--color-bg-sub);
    border: 1px solid var(--color-border);
    border-radius: 8px;
    cursor: pointer;
}
.skd-filter-form__actions {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 16px;
}
.skd-filter-btn-submit {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    height: 42px;
    padding: 0 32px;
    background-color: var(--color-accent);
    color: #FFFFFF;
    font-size: 0.8125rem;
    font-weight: 700;
    border-radius: var(--radius-pill);
    box-shadow: 0 4px 12px rgba(197, 155, 39, 0.25);
    transition: all var(--transition-base);
}
.skd-filter-btn-submit:hover {
    transform: translateY(-2px);
    background-color: #A8811A;
}
.skd-filter-btn-reset {
    font-size: 0.75rem;
    color: var(--color-text-sub-muted);
    text-decoration: underline;
}
.skd-archive-catalog {
    padding-top: var(--space-section);
    padding-bottom: var(--space-section);
    background-color: var(--color-bg-base);
}
.skd-class-card__status-overlay {
    position: absolute;
    top: 14px;
    right: 14px;
}
.skd-class-card__vacancy-note {
    font-size: 0.75rem;
    font-weight: 600;
    color: var(--color-accent-sub);
    margin-bottom: 16px;
    display: flex;
    align-items: center;
    gap: 6px;
}
.skd-dot-indicator {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background-color: var(--color-accent-sub);
    display: inline-block;
}
.skd-pagination {
    margin-top: 56px;
    display: flex;
    justify-content: center;
}
.skd-pagination ul {
    display: flex;
    gap: 8px;
}
.skd-pagination li span,
.skd-pagination li a {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 40px;
    height: 40px;
    padding: 0 12px;
    border-radius: 8px;
    border: 1px solid var(--color-border);
    font-size: 0.8125rem;
    font-weight: 600;
    color: var(--color-text-primary);
    background-color: #FFFFFF;
}
.skd-pagination li span.current {
    background-color: var(--color-accent);
    color: #FFFFFF;
    border-color: var(--color-accent);
}

@media screen and (max-width: 767px) {
    .skd-filter-form__grid {
        grid-template-columns: 1fr;
        gap: 12px;
    }
}
</style>

<?php
get_footer();