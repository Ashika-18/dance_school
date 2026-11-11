<?php
/**
 * Template Name: Front Page Template
 *
 * @package SunnyKidsDanceAcademy
 * @author  AshikaWorks
 * @version 1.0.0
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="primary" class="site-main" role="main">

    <!-- ==========================================================================
       ① Top View（ファーストビュー / Hero View）
       ========================================================================== -->
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

    <!-- ==========================================================================
       お知らせ（最新投稿 3件）
       ========================================================================== -->
    <section id="news" class="skd-section-news" aria-labelledby="heading-news">
        <div class="skd-container">
            <?php
            $news_page_id = (int) get_option('page_for_posts');
            $news_url     = $news_page_id ? get_permalink($news_page_id) : home_url('/news/');
            $news_query   = new WP_Query(array(
                'post_type'           => 'post',
                'posts_per_page'      => 3,
                'ignore_sticky_posts' => true,
                'no_found_rows'       => true,
            ));
            ?>
            <div class="skd-news__head">
                <div>
                    <span class="skd-section-label-en">NEWS</span>
                    <h2 id="heading-news" class="skd-section-heading-h2">お知らせ</h2>
                </div>
                <a class="skd-text-link" href="<?php echo esc_url($news_url); ?>">お知らせ一覧を見る →</a>
            </div>

            <?php if ($news_query->have_posts()) : ?>
                <ul class="skd-news__list">
                    <?php
                    while ($news_query->have_posts()) :
                        $news_query->the_post();
                        $news_cats = get_the_category();
                        $news_cat  = !empty($news_cats) ? $news_cats[0]->name : '';
                    ?>
                        <li class="skd-news__item">
                            <time class="skd-news__date" datetime="<?php echo esc_attr(get_the_date('c')); ?>"><?php echo esc_html(get_the_date('Y.m.d')); ?></time>
                            <?php if ($news_cat !== '') : ?>
                                <span class="skd-news__cat"><?php echo esc_html($news_cat); ?></span>
                            <?php else : ?>
                                <span class="skd-news__cat">お知らせ</span>
                            <?php endif; ?>
                            <a class="skd-news__title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </li>
                    <?php endwhile; ?>
                </ul>
            <?php else : ?>
                <p class="skd-news__empty">現在、掲載中のお知らせはありません。</p>
            <?php endif; ?>
            <?php wp_reset_postdata(); ?>
        </div>
    </section>

    <!-- ==========================================================================
       ② 哲学・もてなしの心（ABOUT OUR PHILOSOPHY）
       ========================================================================== -->
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

    <!-- ==========================================================================
       ③ スタジオの特徴（STUDIO FEATURES）
       ========================================================================== -->
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

    <!-- ==========================================================================
       ④ 素材・空間・職人の流儀（OUR COMMITMENT）
       ========================================================================== -->
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

    <!-- ==========================================================================
       ⑤ 代表メニュー（CLASS CURRICULUM）
       ========================================================================== -->
    <section id="classes" class="skd-section-classes" aria-labelledby="heading-classes">
        <div class="skd-container">
            <span class="skd-section-label-en">CLASS CURRICULUM</span>
            <h2 id="heading-classes" class="skd-section-heading-h2">
                年齢と発育に合わせた3つの少人数カリキュラム
            </h2>

            <div class="skd-class-grid">
                <?php
                $class_query = new WP_Query(array(
                    'post_type'      => 'class',
                    'posts_per_page' => 3,
                    'orderby'        => 'menu_order title',
                    'order'          => 'ASC',
                    'no_found_rows'  => true,
                ));

                if ($class_query->have_posts()) :
                    while ($class_query->have_posts()) : $class_query->the_post();
                        $target_age       = get_post_meta(get_the_ID(), '_class_target_age', true);
                        $capacity         = get_post_meta(get_the_ID(), '_class_capacity', true);
                        $instructor_ratio = get_post_meta(get_the_ID(), '_class_instructor_ratio', true);
                        $duration_min     = get_post_meta(get_the_ID(), '_class_duration_min', true);
                        $sub_en           = get_post_meta(get_the_ID(), '_class_sub_en', true);
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

                            <div class="skd-class-card__footer">
                                <div class="skd-class-card__price">
                                    <?php echo function_exists('skda_get_formatted_price') ? skda_get_formatted_price(get_the_ID()) : '¥10,800<span>（税込）/月</span>'; ?>
                                </div>
                                <div class="skd-class-card__actions">
                                    <a href="<?php echo esc_url(get_permalink()); ?>" class="skd-class-card__btn">
                                        <?php esc_html_e('クラス詳細を見る →', 'sunny-kids-dance'); ?>
                                    </a>
                                    <a href="<?php echo esc_url(home_url('/trial/')); ?>" class="skd-class-card__btn skd-class-card__btn--trial">
                                        <?php esc_html_e('体験に申し込む', 'sunny-kids-dance'); ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </article>
                <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                ?>
                    <!-- 項目1：リトルリズムクラス -->
                    <article class="skd-class-card">
                        <div class="skd-class-card__thumb-wrap">
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/class-01.jpg'); ?>" alt="リトルリズムクラスの練習風景" width="800" height="530" loading="lazy">
                            <span class="skd-class-card__badge-target">対象：4歳〜6歳（年中・年長）</span>
                        </div>
                        <div class="skd-class-card__content">
                            <span class="skd-section-label-en" style="text-align: left; font-size: 0.6875rem; margin-bottom: 4px;">LITTLE RHYTHM CLASS</span>
                            <h3 class="skd-class-card__title">リトルリズムクラス（未就学児）</h3>
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
                                <div class="skd-class-card__actions">
                                    <a href="<?php echo esc_url(home_url('/class/little-rhythm/')); ?>" class="skd-class-card__btn">クラス詳細を見る →</a>
                                    <a href="<?php echo esc_url(home_url('/trial/')); ?>" class="skd-class-card__btn skd-class-card__btn--trial">体験に申し込む</a>
                                </div>
                            </div>
                        </div>
                    </article>

                    <!-- 項目2：キッズベーシッククラス -->
                    <article class="skd-class-card">
                        <div class="skd-class-card__thumb-wrap">
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/class-02.jpg'); ?>" alt="キッズベーシッククラスの練習風景" width="800" height="530" loading="lazy">
                            <span class="skd-class-card__badge-target">対象：小学1年生〜小学3年生</span>
                        </div>
                        <div class="skd-class-card__content">
                            <span class="skd-section-label-en" style="text-align: left; font-size: 0.6875rem; margin-bottom: 4px;">KIDS BASIC CLASS</span>
                            <h3 class="skd-class-card__title">キッズベーシッククラス（小学校低学年）</h3>
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
                                <div class="skd-class-card__actions">
                                    <a href="<?php echo esc_url(home_url('/class/kids-basic/')); ?>" class="skd-class-card__btn">クラス詳細を見る →</a>
                                    <a href="<?php echo esc_url(home_url('/trial/')); ?>" class="skd-class-card__btn skd-class-card__btn--trial">体験に申し込む</a>
                                </div>
                            </div>
                        </div>
                    </article>

                    <!-- 項目3：ジュニアアドバンスクラス -->
                    <article class="skd-class-card">
                        <div class="skd-class-card__thumb-wrap">
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/class-03.jpg'); ?>" alt="ジュニアアドバンスクラスの練習風景" width="800" height="530" loading="lazy">
                            <span class="skd-class-card__badge-target">対象：小学4年生〜小学6年生</span>
                        </div>
                        <div class="skd-class-card__content">
                            <span class="skd-section-label-en" style="text-align: left; font-size: 0.6875rem; margin-bottom: 4px;">JUNIOR ADVANCE CLASS</span>
                            <h3 class="skd-class-card__title">ジュニアアドバンスクラス（小学校高学年）</h3>
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
                                <div class="skd-class-card__actions">
                                    <a href="<?php echo esc_url(home_url('/class/junior-advance/')); ?>" class="skd-class-card__btn">クラス詳細を見る →</a>
                                    <a href="<?php echo esc_url(home_url('/trial/')); ?>" class="skd-class-card__btn skd-class-card__btn--trial">体験に申し込む</a>
                                </div>
                            </div>
                        </div>
                    </article>
                <?php endif; ?>
            </div>

            <p class="skd-section-more">
                <a class="skd-text-link" href="<?php echo esc_url(get_post_type_archive_link('class') ?: home_url('/class/')); ?>">すべてのクラス一覧を見る →</a>
            </p>
        </div>
    </section>

    <!-- ==========================================================================
       ⑥ 空間仕様・利用案内・透明性データ（SPECIFICATIONS & TRANSPARENCY）
       ========================================================================== -->
    <section id="specifications" class="skd-section-specs" aria-labelledby="heading-specs">
        <div class="skd-container">
            <span class="skd-section-label-en">SPECIFICATIONS & TRANSPARENCY</span>
            <h2 id="heading-specs" class="skd-section-heading-h2">
                安心してお通いいただくための施設仕様・利用規約・費用開示
            </h2>

            <div class="skd-specs-summary">
                <article class="skd-specs-summary__item">
                    <h3>受講の規模</h3>
                    <p>1クラス最大8名。講師とアシスタントの2名体制で、後列のお子様も見落としません。</p>
                </article>
                <article class="skd-specs-summary__item">
                    <h3>月謝の目安</h3>
                    <p>入会金 11,000円、月謝 10,800円（税込）。発表会のチケットノルマはありません。</p>
                </article>
                <article class="skd-specs-summary__item">
                    <h3>通いやすさ</h3>
                    <p>吉祥寺駅公園口から徒歩3分。防音の見学ラウンジがあり、エレベーターでベビーカーのまま入れます。</p>
                </article>
            </div>
            <p class="skd-section-more">
                <a class="skd-text-link" href="<?php echo esc_url(home_url('/pricing/')); ?>">利用規約・料金詳細をすべて見る →</a>
            </p>
        </div>
    </section>

    <!-- ==========================================================================
       ⑦ 予約・来店・購入窓口（TRIAL RESERVATION CTA）
       ========================================================================== -->
    <section id="trial" class="skd-section-trial" aria-labelledby="heading-trial">
        <div class="skd-container">
            <div class="skd-trial-box">
                <span class="skd-trial-box__tag">強引な勧誘は一切行いません</span>
                <h2 id="heading-trial" class="skd-trial-box__heading">
                    まずは、音に合わせて弾む楽しさを。<br>
                    少人数制・無料体験レッスンのご案内
                </h2>
                <p class="skd-trial-box__lead">
                    実際のクラス（定員8名）にご参加いただき、講師の目線合わせ指導とスタジオの居心地をじっくりお確かめください。<br>
                    当日の無理な入会勧誘は一切行いません。ご帰宅後にお子様のお気持ちを一番にご確認いただけます。
                </p>

                <div class="skd-trial-steps">
                    <div class="skd-trial-step">
                        <span class="skd-trial-step__num">STEP 01</span>
                        <span>WEB予約</span>
                    </div>
                    <span class="skd-trial-step__arrow" aria-hidden="true">&rarr;</span>
                    <div class="skd-trial-step">
                        <span class="skd-trial-step__num">STEP 02</span>
                        <span>スタジオへ来校</span>
                    </div>
                    <span class="skd-trial-step__arrow" aria-hidden="true">&rarr;</span>
                    <div class="skd-trial-step">
                        <span class="skd-trial-step__num">STEP 03</span>
                        <span>体験レッスン（50分）</span>
                    </div>
                    <span class="skd-trial-step__arrow" aria-hidden="true">&rarr;</span>
                    <div class="skd-trial-step">
                        <span class="skd-trial-step__num">STEP 04</span>
                        <span>ご帰宅・じっくり検討</span>
                    </div>
                </div>

                <div class="skd-trial-actions">
                    <a href="<?php echo esc_url(home_url('/trial/')); ?>" class="skd-btn-trial-primary">
                        無料体験レッスンを予約する（空席カレンダー）
                    </a>
                    <a href="<?php echo esc_url(home_url('/contact-inquiry/')); ?>" class="skd-btn-trial-sub">
                        保護者様向け個別相談・見学を予約
                    </a>
                </div>

                <p class="skd-trial-box__contact-direct">
                    お電話でのお問い合わせ・ご相談: 
                    <a href="tel:0422298815">0422-29-8815</a>
                    （受付時間: 火〜金 14:00〜19:30 / 土日祝 09:30〜18:00・月曜休校）
                </p>
            </div>
        </div>
    </section>

    <!-- ==========================================================================
       ⑧ アクセス・道順案内（STUDIO ACCESS）
       ========================================================================== -->
    <section id="access" class="skd-section-access" aria-labelledby="heading-access">
        <div class="skd-container">
            <span class="skd-section-label-en">STUDIO ACCESS</span>
            <h2 id="heading-access" class="skd-section-heading-h2">
                スタジオ所在地・道順案内
            </h2>

            <div class="skd-access-card">
                <div class="skd-access-card__route">
                    <h3 class="skd-access-card__title">
                        <svg class="skd-access-card__pin" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M12 21s7-6.2 7-11a7 7 0 1 0-14 0c0 4.8 7 11 7 11z"></path>
                            <circle cx="12" cy="10" r="2.4"></circle>
                        </svg>
                        吉祥寺駅からの道順（徒歩約3分）
                    </h3>
                    <p class="skd-access-card__lead">初めての方でも迷わないように、駅からの道順をご案内しております。</p>
                    <p class="skd-access-card__steps">改札を出て右手の公園口（南口）より地上へ、横断歩道を渡り、吉祥寺通りを井の頭公園方面へ直進約200m。1階にベーカリーの入るビルの3階です。</p>
                    <p class="skd-access-card__note">※ビル内エレベーター完備。ベビーカーのままスタジオフロアまでお越しいただけます。</p>
                    <a class="skd-access-card__map-link" href="<?php echo esc_url('https://www.google.com/maps/dir/?api=1&origin=吉祥寺駅&destination=東京都武蔵野市吉祥寺南町2丁目&travelmode=walking'); ?>" target="_blank" rel="noopener noreferrer">
                        Googleマップでルートを見る
                    </a>
                </div>

                <figure class="skd-access-card__photo">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/route-guide-thumb.jpg'); ?>" alt="吉祥寺駅公園口からスタジオ方面へ続く道" width="480" height="640" loading="lazy">
                    <figcaption class="skd-access-card__caption">1Fのベーカリーが目印です</figcaption>
                </figure>
            </div>
        </div>
    </section>

</main>

<?php
get_footer();