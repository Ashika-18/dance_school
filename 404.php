<?php
/**
 * 404 Error Handler Template for SUNNY KIDS DANCE ACADEMY
 *
 * @package SunnyKidsDanceAcademy
 * @author  AshikaWorks
 * @version 1.0.0
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="primary" class="site-main skd-404-main" role="main">

    <!-- 404専用ヘッダー -->
    <header class="skd-404-header">
        <div class="skd-container">
            <span class="skd-section-label-en">404 NOT FOUND</span>
            <h1 class="skd-section-heading-h2">お探しのページが見つかりませんでした</h1>
            <p class="skd-404-header__desc">
                アクセスいただいたページは、削除されたかURLが変更された可能性がございます。<br>
                お手数ですが、以下のサイト内検索または主要ページ一覧よりご希望のコンテンツをお探しください。
            </p>
        </div>
    </header>

    <!-- 12カラム非対称レイアウト（メイン8カラム / サブ4カラム：回遊離脱防止） -->
    <div class="skd-404-layout">
        <div class="skd-container">
            <div class="skd-404-grid">

                <!-- メイン案内領域（8カラム） -->
                <div class="skd-404-content">
                    
                    <!-- サイト内キーワード検索フォーム -->
                    <section class="skd-404-search-box" aria-label="<?php esc_attr_e('サイト内キーワード検索', 'sunny-kids-dance'); ?>">
                        <h2 class="skd-404-subheading"><?php esc_html_e('キーワードから探す', 'sunny-kids-dance'); ?></h2>
                        <form role="search" method="get" class="skd-404-search-form" action="<?php echo esc_url(home_url('/')); ?>">
                            <div class="skd-404-search-input-wrap">
                                <input type="search" class="skd-404-search-input" placeholder="<?php esc_attr_e('例: リトルリズム、見学ラウンジ、月謝、振替', 'sunny-kids-dance'); ?>" value="<?php echo get_search_query(); ?>" name="s" required>
                                <button type="submit" class="skd-404-search-submit" aria-label="<?php esc_attr_e('検索を実行', 'sunny-kids-dance'); ?>">
                                    <?php esc_html_e('検索', 'sunny-kids-dance'); ?>
                                </button>
                            </div>
                        </form>
                    </section>

                    <!-- 主要下層ページ・コンテンツ案内グリッド -->
                    <section class="skd-404-sitemap-section" aria-label="<?php esc_attr_e('主要ページのご案内', 'sunny-kids-dance'); ?>">
                        <h2 class="skd-404-subheading"><?php esc_html_e('主要なご案内ページ', 'sunny-kids-dance'); ?></h2>
                        <div class="skd-404-links-grid">
                            
                            <a href="<?php echo esc_url(home_url('/')); ?>" class="skd-404-link-card">
                                <span class="skd-404-link-card__label">TOP PAGE</span>
                                <strong class="skd-404-link-card__title">トップページへ戻る</strong>
                                <p class="skd-404-link-card__text">サニーキッズダンスアカデミーの最新情報と教育理念の全体像をご覧いただけます。</p>
                            </a>

                            <a href="<?php echo esc_url(get_post_type_archive_link('class')); ?>" class="skd-404-link-card">
                                <span class="skd-404-link-card__label">CLASS PROGRAMS</span>
                                <strong class="skd-404-link-card__title">開講クラス・カリキュラム一覧</strong>
                                <p class="skd-404-link-card__text">年齢や発育段階に合わせた3つの少人数クラスの料金・定員・空席状況をご確認いただけます。</p>
                            </a>

                            <a href="<?php echo esc_url(home_url('/facility/')); ?>" class="skd-404-link-card">
                                <span class="skd-404-link-card__label">FACILITY & SAFETY</span>
                                <strong class="skd-404-link-card__title">施設設備・安全対策</strong>
                                <p class="skd-404-link-card__text">膝関節への衝撃を40%低減する専用二重構造弾性木床フロアと見学ラウンジの仕様です。</p>
                            </a>

                            <a href="<?php echo esc_url(home_url('/pricing/')); ?>" class="skd-404-link-card">
                                <span class="skd-404-link-card__label">TUITION & POLICY</span>
                                <strong class="skd-404-link-card__title">料金・規約・振替制度</strong>
                                <p class="skd-404-link-card__text">不透明な追加費用を完全撤廃した明朗会計と、柔軟な振替受講ルールを完全開示しています。</p>
                            </a>

                            <a href="<?php echo esc_url(home_url('/instructors/')); ?>" class="skd-404-link-card">
                                <span class="skd-404-link-card__label">INSTRUCTORS</span>
                                <strong class="skd-404-link-card__title">指導陣・専門資格紹介</strong>
                                <p class="skd-404-link-card__text">全講師が幼少年身体運動指導士などの専門資格を保有。目線を合わせた指導体制をご紹介します。</p>
                            </a>

                            <a href="<?php echo esc_url(home_url('/#access')); ?>" class="skd-404-link-card">
                                <span class="skd-404-link-card__label">ACCESS & ROUTE</span>
                                <strong class="skd-404-link-card__title">アクセス・道順案内</strong>
                                <p class="skd-404-link-card__text">JR吉祥寺駅南口（公園口）徒歩3分。ベビーカーでも安心な駅からの詳細ルートです。</p>
                            </a>

                        </div>
                    </section>

                </div>

                <!-- サブサイドバー領域（4カラム：無料体験・電話直通エスコート） -->
                <aside class="skd-404-sidebar" role="complementary">
                    
                    <div class="skd-sidebar-card">
                        <h3 class="skd-sidebar-title"><?php esc_html_e('少人数制 無料体験レッスン', 'sunny-kids-dance'); ?></h3>
                        <p class="skd-sidebar-desc">
                            実際の定員8名限定クラスにご参加いただけます。当日の無理な勧誘は一切ございません。
                        </p>
                        <a href="<?php echo esc_url(home_url('/trial/')); ?>" class="skd-sidebar-btn">
                            <?php esc_html_e('体験レッスン空席確認・予約', 'sunny-kids-dance'); ?>
                        </a>
                    </div>

                    <div class="skd-sidebar-card skd-sidebar-card--sub">
                        <h4 class="skd-sidebar-subtitle"><?php esc_html_e('お電話でのご相談・総合案内', 'sunny-kids-dance'); ?></h4>
                        <p class="skd-sidebar-tel">
                            <a href="tel:0422298815">0422-29-8815</a>
                        </p>
                        <p class="skd-sidebar-hours">
                            サニーキッズダンスアカデミー 吉祥寺校<br>
                            受付: 火〜金 14:00〜19:30<br>
                            土日祝 09:30〜18:00（月曜休校）
                        </p>
                    </div>

                    <div class="skd-sidebar-card skd-sidebar-card--inquiry">
                        <h4 class="skd-sidebar-subtitle"><?php esc_html_e('Webからのお問い合わせ', 'sunny-kids-dance'); ?></h4>
                        <p class="skd-sidebar-desc">
                            ご不明点やご見学のご希望は専用フォームより24時間受付中です。
                        </p>
                        <a href="<?php echo esc_url(home_url('/contact-inquiry/')); ?>" class="skd-sidebar-btn-outline">
                            <?php esc_html_e('お問い合わせフォームへ', 'sunny-kids-dance'); ?>
                        </a>
                    </div>

                </aside>

            </div>
        </div>
    </div>

</main>

<style>
/* 404エラーハンドラー固有スタイル */
.skd-404-header {
    padding-top: calc(var(--header-height-desktop) + 48px);
    padding-bottom: 40px;
    background-color: var(--color-bg-sub);
    text-align: center;
    border-bottom: 1px solid var(--color-border);
}
.skd-404-header__desc {
    font-size: 0.9375rem;
    line-height: 1.85;
    color: var(--color-text-secondary);
    max-width: 680px;
    margin: 16px auto 0;
}
.skd-404-layout {
    padding-top: var(--space-section);
    padding-bottom: var(--space-section);
    background-color: var(--color-bg-base);
}
.skd-404-grid {
    display: grid;
    grid-template-columns: 68% 32%;
    gap: 48px;
    align-items: start;
}
.skd-404-content {
    min-width: 0;
}
.skd-404-subheading {
    font-family: var(--font-serif);
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--color-text-primary);
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 2px solid var(--color-accent);
}
.skd-404-search-box {
    margin-bottom: 48px;
}
.skd-404-search-form {
    width: 100%;
}
.skd-404-search-input-wrap {
    display: flex;
    gap: 12px;
}
.skd-404-search-input {
    flex: 1;
    height: 48px;
    padding: 0 16px;
    font-size: 0.9375rem;
    background-color: var(--color-bg-sub);
    border: 1px solid var(--color-border);
    border-radius: 8px;
    color: var(--color-text-primary);
}
.skd-404-search-input:focus {
    border-color: var(--color-accent);
    background-color: #FFFFFF;
}
.skd-404-search-submit {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    height: 48px;
    padding: 0 28px;
    background-color: var(--color-text-primary);
    color: #FFFFFF;
    font-size: 0.875rem;
    font-weight: 700;
    border-radius: 8px;
    transition: background-color var(--transition-base);
}
.skd-404-search-submit:hover {
    background-color: var(--color-accent);
}
.skd-404-links-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
}
.skd-404-link-card {
    display: block;
    padding: 24px;
    background-color: var(--color-bg-sub);
    border: 1px solid var(--color-border);
    border-radius: 16px;
    box-shadow: var(--shadow-card);
    transition: transform var(--transition-base), box-shadow var(--transition-base), border-color var(--transition-base);
}
.skd-404-link-card:hover {
    transform: translateY(-3px);
    border-color: var(--color-accent);
    box-shadow: 0 12px 28px rgba(0, 0, 0, 0.08);
}
.skd-404-link-card__label {
    display: block;
    font-family: var(--font-en);
    font-size: 0.6875rem;
    font-weight: 600;
    letter-spacing: 0.12em;
    color: var(--color-accent);
    margin-bottom: 6px;
}
.skd-404-link-card__title {
    display: block;
    font-size: 1.0rem;
    font-weight: 700;
    color: var(--color-text-primary);
    margin-bottom: 8px;
    line-height: 1.4;
}
.skd-404-link-card__text {
    font-size: 0.8125rem;
    color: var(--color-text-secondary);
    line-height: 1.6;
}
.skd-404-sidebar {
    display: flex;
    flex-direction: column;
    gap: 24px;
}
.skd-sidebar-btn-outline {
    display: block;
    text-align: center;
    border: 1px solid var(--color-text-primary);
    color: var(--color-text-primary);
    font-weight: 700;
    font-size: 0.875rem;
    padding: 10px;
    border-radius: var(--radius-pill);
    transition: all var(--transition-base);
}
.skd-sidebar-btn-outline:hover {
    background-color: var(--color-text-primary);
    color: #FFFFFF;
}

@media screen and (max-width: 1023px) {
    .skd-404-grid {
        grid-template-columns: 1fr;
        gap: 40px;
    }
}
@media screen and (max-width: 767px) {
    .skd-404-search-input-wrap {
        flex-direction: column;
        gap: 8px;
    }
    .skd-404-search-submit {
        width: 100%;
    }
    .skd-404-links-grid {
        grid-template-columns: 1fr;
        gap: 16px;
    }
}
</style>

<?php
get_footer();