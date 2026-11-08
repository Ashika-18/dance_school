<?php
/**
 * Core Fallback Template for SUNNY KIDS DANCE ACADEMY
 *
 * @package SunnyKidsDanceAcademy
 * @author  AshikaWorks
 * @version 1.0.0
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="primary" class="site-main" role="main">

    <!-- ① TOP VIEW (Hero View) -->
    <section id="hero" class="skd-hero" aria-label="<?php esc_attr_e('メインビジュアル', 'sunny-kids-dance'); ?>">
        <div class="skd-hero__media-layer">
            <video class="skd-hero__video" autoplay muted loop playsinline poster="<?php echo esc_url(get_template_directory_uri() . '/assets/images/hero-fallback.jpg'); ?>">
                <source src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/hero-video.mp4'); ?>" type="video/mp4">
            </video>
            <div class="skd-hero__overlay" aria-hidden="true"></div>
        </div>

        <div class="skd-hero__content">
            <div class="skd-hero__statement-box">
                <span class="skd-hero__sub-en">Be Free, Be Yourself. With Confidence.</span>
                <h1 class="skd-hero__h1">
                    <span>もっと自由に、</span>
                    <span>もっと自分らしく。</span>
                    <span>音に合わせて、笑顔が咲く。</span>
                </h1>
                <p class="skd-hero__sub-ja">
                    定員8名の丁寧な目配り。未経験から自己肯定感を育む、吉祥寺の少人数制キッズダンスアカデミー。
                </p>
            </div>
        </div>
    </section>

    <!-- ② PHILOSOPHY (哲学・もてなしの心) -->
    <section id="philosophy" class="skd-section-philosophy skd-glow-canvas" aria-labelledby="heading-philosophy">
        <div class="skd-container">
            <div class="skd-philosophy__layout">
                <div class="skd-philosophy__visual-wrap">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/about-teacher-child.jpg'); ?>" alt="目線を合わせて優しく指導する講師と生徒" class="skd-philosophy__img-primary" width="800" height="1060" loading="lazy">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/art-dancer-line.png'); ?>" alt="" class="skd-philosophy__art-overlay" aria-hidden="true" width="440" height="440" loading="lazy">
                </div>

                <div class="skd-philosophy__text-wrap">
                    <span class="skd-section-label-en">ABOUT OUR PHILOSOPHY</span>
                    <h2 id="heading-philosophy" class="skd-section-heading-h2">
                        比較しない。急かさない。<br>
                        「できた！」の積み重ねが、一生モノの自信になる。
                    </h2>
                    <p class="skd-philosophy__lead">
                        サニーキッズダンスアカデミーが目指すのは、画一的なステップの速習ではありません。周囲と比べられることなく、自分の身体を自由にコントロールし、リズムに合わせて自己を解放する喜びを知ることです。有資格の指導陣が一人ひとりの骨格・運動習熟度を把握し、小さな変化も見逃さず肯定します。失敗を恐れず挑戦できる安心安全な環境の中で、集団行動における協調性と、生涯揺らがない自己肯定感をじっくりと育みます。
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- ③ FEATURES (スタジオの特徴5点) -->
    <section id="features" class="skd-section-features" aria-labelledby="heading-features">
        <div class="skd-container">
            <span class="skd-section-label-en">STUDIO FEATURES</span>
            <h2 id="heading-features" class="skd-section-heading-h2">
                サニーキッズダンスアカデミーの特徴
            </h2>

            <div class="skd-features__grid">
                <div class="skd-feature-item">
                    <div class="skd-feature-item__circle" aria-hidden="true">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/icon-beginner.png'); ?>" alt="" width="96" height="96" loading="lazy">
                    </div>
                    <h3 class="skd-feature-item__title">未経験・運動苦手OK</h3>
                    <p class="skd-feature-item__desc">在籍生の82%が未経験スタート。基礎のリズム遊びから丁寧に進行。</p>
                </div>

                <div class="skd-feature-item">
                    <div class="skd-feature-item__circle" aria-hidden="true">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/icon-group.png'); ?>" alt="" width="96" height="96" loading="lazy">
                    </div>
                    <h3 class="skd-feature-item__title">完全定員制（上限8名）</h3>
                    <p class="skd-feature-item__desc">講師1名＋アシスタント1名の2名体制。後列の生徒も絶対放置ゼロ。</p>
                </div>

                <div class="skd-feature-item">
                    <div class="skd-feature-item__circle" aria-hidden="true">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/icon-growth.png'); ?>" alt="" width="96" height="96" loading="lazy">
                    </div>
                    <h3 class="skd-feature-item__title">4歳〜小6まで対応</h3>
                    <p class="skd-feature-item__desc">骨格・発育段階に準拠した12段階進度管理シートで着実に成長。</p>
                </div>

                <div class="skd-feature-item">
                    <div class="skd-feature-item__circle" aria-hidden="true">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/icon-station.png'); ?>" alt="" width="96" height="96" loading="lazy">
                    </div>
                    <h3 class="skd-feature-item__title">吉祥寺駅 徒歩3分</h3>
                    <p class="skd-feature-item__desc">公園口から直進の好立地。エレベーター完備でベビーカー来校可。</p>
                </div>

                <div class="skd-feature-item">
                    <div class="skd-feature-item__circle" aria-hidden="true">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/icon-lounge.png'); ?>" alt="" width="96" height="96" loading="lazy">
                    </div>
                    <h3 class="skd-feature-item__title">防音見学ラウンジ完備</h3>
                    <p class="skd-feature-item__desc">Wi-Fi・電源付き15席の専用席からガラス越しに快適に見学可能。</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ④ COMMITMENT (3つの安心ポイント・流儀) -->
    <section id="commitment" class="skd-section-commitment" aria-labelledby="heading-commitment">
        <div class="skd-container">
            <span class="skd-section-label-en" style="color: rgba(255,255,255,0.85);">OUR COMMITMENT</span>
            <h2 id="heading-commitment" class="skd-section-heading-h2 skd-section-heading-h2--inverse">
                お子様の心身を守り、親御様の不安をゼロにする3つの流儀
            </h2>
            <p class="skd-commitment__lead-banner">
                お客様の<span>82%以上が完全未経験</span>からスタート。敷居を下げ、安心を高める体制づくり。
            </p>

            <div class="skd-point-cards">
                <!-- Point 01 -->
                <article class="skd-point-card">
                    <div class="skd-point-card__text-col">
                        <span class="skd-point-card__number">Point 01</span>
                        <h3 class="skd-point-card__title">全講師が運動指導有資格者・1クラス上限8名と2名指導体制</h3>
                        <p class="skd-point-card__body">
                            指導にあたる全インストラクターが幼少年身体運動指導士等の専門資格を保持。主担当に加え補助スタッフが常時伴走する2名体制を敷き、後列で戸惑うお子様を一人も取り残しません。身体の使い方から情緒面のケアまで濃密な目配りを行き届かせます。
                        </p>
                    </div>
                    <div class="skd-point-card__media-col">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/point-01.jpg'); ?>" alt="講師と生徒の2名指導体制によるレッスン" width="800" height="530" loading="lazy">
                    </div>
                </article>

                <!-- Point 02 -->
                <article class="skd-point-card skd-point-card--reverse">
                    <div class="skd-point-card__text-col">
                        <span class="skd-point-card__number">Point 02</span>
                        <h3 class="skd-point-card__title">膝や関節への衝撃を40%低減する専用二重構造弾性木床フロア</h3>
                        <p class="skd-point-card__body">
                            成長過程にあるお子様の未発達な関節や骨を守るため、劇場の舞台構造に準拠した特注の二重弾性木床を全面採用。一般的なコンクリート直床スタジオと比較して着地衝撃を40%緩和し、疲労の蓄積や運動障害のリスクを構造レベルで遮断しています。
                        </p>
                    </div>
                    <div class="skd-point-card__media-col">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/point-02.jpg'); ?>" alt="二重構造弾性木床フロアのスタジオ" width="800" height="530" loading="lazy">
                    </div>
                </article>

                <!-- Point 03 -->
                <article class="skd-point-card">
                    <div class="skd-point-card__text-col">
                        <span class="skd-point-card__number">Point 03</span>
                        <h3 class="skd-point-card__title">高額衣装代・チケットノルマ・保護者会当番の完全撤廃規約</h3>
                        <p class="skd-point-card__body">
                            年1回の成果発表会において、十数万円に及ぶ高額衣装代やチケットの強制買取りノルマは一切ございません。指定共通衣装（実費上限4,000円以内）を規定し、お茶汲みや引率等の保護者負担も完全撤廃。共働きのご家庭でも心から純粋に応援いただけます。
                        </p>
                    </div>
                    <div class="skd-point-card__media-col">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/point-03.jpg'); ?>" alt="保護者がリラックスして見守る発表会の様子" width="800" height="530" loading="lazy">
                    </div>
                </article>
            </div>
        </div>
    </section>

    <!-- ⑤ CLASS CURRICULUM (WP_Query動的ループ＆静的フォールバック内蔵) -->
    <section id="classes" class="skd-section-classes" aria-labelledby="heading-classes">
        <div class="skd-container">
            <span class="skd-section-label-en">CLASS CURRICULUM</span>
            <h2 id="heading-classes" class="skd-section-heading-h2">
                年齢と発育に合わせた3つの少人数カリキュラム
            </h2>

            <div class="skd-class-grid">
                <?php
                $class_query_args = array(
                    'post_type'      => 'class',
                    'posts_per_page' => 3,
                    'orderby'        => 'menu_order title',
                    'order'          => 'ASC',
                    'no_found_rows'  => true,
                );
                $class_loop = new WP_Query($class_query_args);

                if ($class_loop->have_posts()) :
                    while ($class_loop->have_posts()) : $class_loop->the_post();$target_age       = get_post_meta(get_the_ID(), '_class_target_age', true);
                        $capacity         = get_post_meta(get_the_ID(), '_class_capacity', true);$instructor_ratio = get_post_meta(get_the_ID(), '_class_instructor_ratio', true);
                        $duration_min     = get_post_meta(get_the_ID(), '_class_duration_min', true);$sub_en           = get_post_meta(get_the_ID(), '_class_sub_en', true);
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
                        </div>

                        <div class="skd-class-card__content">
                            <?php if (!empty($sub_en)) : ?>
                                <span class="skd-section-label-en" style="text-align: left; font-size: 0.6875rem; margin-bottom: 4px;"><?php echo esc_html($sub_en); ?></span>
                            <?php endif; ?>

                            <h3 class="skd-class-card__title"><?php the_title(); ?></h3>

                            <div class="skd-class-card__spec-pills">
                                <?php if (!empty($capacity)) : ?>
                                    <span class="skd-class-card__spec-pill"><?php printf(esc_html__('定員%d名', 'sunny-kids-dance'), absint($capacity)); ?></span>
                                <?php endif; ?>
                                <?php if (!empty($instructor_ratio)) : ?>
                                    <span class="skd-class-card__spec-pill"><?php echo esc_html($instructor_ratio); ?></span>
                                <?php endif; ?>
                                <?php if (!empty($duration_min)) : ?>
                                    <span class="skd-class-card__spec-pill"><?php printf(esc_html__('1回%d分', 'sunny-kids-dance'), absint($duration_min)); ?></span>
                                <?php endif; ?>
                            </div>

                            <p class="skd-class-card__excerpt">
                                <?php echo wp_strip_all_tags(get_the_excerpt()); ?>
                            </p>

                            <div class="skd-class-card__footer">
                                <div class="skd-class-card__price">
                                    <?php echo function_exists('skda_get_formatted_price') ? skda_get_formatted_price(get_the_ID()) : '¥10,800<span>（税込）/月</span>';