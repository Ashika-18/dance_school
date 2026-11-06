<?php
/**
 * Generic Page Template for SUNNY KIDS DANCE ACADEMY
 *
 * @package SunnyKidsDanceAcademy
 * @author  AshikaWorks
 * @version 1.0.0
 */

defined('ABSPATH') || exit;

get_header();

// スラッグによる下層固定ページの判定
$current_slug = get_post_field('post_name', get_post());
?>

<main id="primary" class="site-main skd-page-main" role="main">

    <!-- 固定ページ共通ヘッダー（パンくず＋タイトル） -->
    <header class="skd-page-header">
        <div class="skd-container">
            <nav class="skd-breadcrumb" aria-label="<?php esc_attr_e('パンくずリスト', 'sunny-kids-dance'); ?>">
                <ol itemscope itemtype="https://schema.org/BreadcrumbList">
                    <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                        <a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>">
                            <span itemprop="name"><?php esc_html_e('ホーム', 'sunny-kids-dance'); ?></span>
                        </a>
                        <meta itemprop="position" content="1">
                    </li>
                    <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                        <span itemprop="name" aria-current="page"><?php the_title(); ?></span>
                        <meta itemprop="position" content="2">
                    </li>
                </ol>
            </nav>

            <span class="skd-section-label-en">
                <?php
                switch ($current_slug) {
                    case 'curriculum':
                        echo 'CURRICULUM & PROGRESS';
                        break;
                    case 'instructors':
                        echo 'QUALIFIED INSTRUCTORS';
                        break;
                    case 'facility-safety':
                        echo 'FACILITY & SAFETY DESIGN';
                        break;
                    case 'tuition-policy':
                        echo 'TUITION & POLICY';
                        break;
                    case 'trial-guide':
                        echo 'TRIAL LESSON GUIDE';
                        break;
                    case 'access':
                        echo 'STUDIO ACCESS & ROUTE';
                        break;
                    case 'trial-reservation':
                        echo 'RESERVATION & BOOKING';
                        break;
                    default:
                        echo 'INFORMATION';
                        break;
                }
                ?>
            </span>
            <h1 class="skd-section-heading-h2"><?php the_title(); ?></h1>
        </div>
    </header>

    <!-- 12カラム非対称レイアウト（メイン8カラム / サブ4カラム） -->
    <div class="skd-page-layout">
        <div class="skd-container">
            <div class="skd-page-grid">

                <!-- メインコンテンツ領域（8カラム） -->
                <article id="post-<?php the_ID(); ?>" <?php post_class('skd-page-article'); ?>>
                    <?php
                    // エディタにコンテンツがある場合はそれを表示
                    if (have_posts()) :
                        while (have_posts()) :
                            the_post();
                            $content = get_the_content();
                            if (!empty(trim($content))) :
                                echo '<div class="skd-page-content-body">';
                                the_content();
                                echo '</div>';
                            else :
                                // エディタが空の場合、Step 3設計の各下層ページ完全原稿をフォールバック展開
                    ?>
                                <div class="skd-page-fallback-content">

                                    <?php if ('curriculum' === $current_slug) : ?>
                                        <!-- ① カリキュラム詳細フォールバック -->
                                        <section class="skd-page-section">
                                            <h2 class="skd-page-h2">「Step-by-Step 12段階進度管理シート」による着実な成長設計</h2>
                                            <p class="skd-page-lead">
                                                サニーキッズダンスアカデミーでは、感覚的な指導や怒声による強制を完全に排除しています。全講師が幼少年身体運動指導士としての知見に基づき、リズム感や身体操作の習熟度を12段階で可視化。3ヶ月に1回の定期シートフィードバックにより、保護者様もお子様の小さな成長を客観的に実感いただけます。
                                            </p>

                                            <h3 class="skd-page-h3">レッスン50分間の分単位タイムスケジュール</h3>
                                            <div class="skd-timeline-table-wrap">
                                                <table class="skd-specs-table">
                                                    <tbody>
                                                        <tr>
                                                            <th scope="row">00〜10分</th>
                                                            <td><strong>ご挨拶＆リズムウォームアップ</strong><br>靴の揃え方や元気な挨拶からスタート。心拍数を穏やかに上げ、二重弾性木床の上で足首・膝・股関節をほぐします。</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">10〜25分</th>
                                                            <td><strong>基礎アイソレーション＆リズム取り</strong><br>首・肩・胸・腰を独立して動かす基礎練習。8カウントのビートに合わせて「アップ」「ダウン」の身体操作を反復します。</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">25〜45分</th>
                                                            <td><strong>今月のコンビネーション振付</strong><br>月替わりの楽曲に合わせてステップを組み合わせます。講師2名体制により、後列で迷っている生徒にも即座に伴走します。</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">45〜50分</th>
                                                            <td><strong>ミニ発表＆クールダウン・振り返り</strong><br>全員で音に合わせて踊りきり、達成感を共有。「今日できたこと」を講師が一人ひとりの目を見て具体的に褒めて終了します。</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </section>

                                    <?php elseif ('instructors' === $current_slug) : ?>
                                        <!-- ② 指導陣・専門資格紹介フォールバック -->
                                        <section class="skd-page-section">
                                            <h2 class="skd-page-h2">全員が公認指導資格・救命技能を保持するプロフェッショナル</h2>
                                            <p class="skd-page-lead">
                                                「ダンスが上手なダンサー」と「子どもの心身を正しく育てる指導者」は異なります。当アカデミーでは、現役の実績に加え、発育発達学・小児運動生理学を修めた専任講師のみを採用。怒声や感情的な指導を徹底排除し、肯定的な対話でお子様の自尊心を育みます。
                                            </p>

                                            <div class="skd-instructor-card">
                                                <div class="skd-instructor-card__img">
                                                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/about-teacher-child.jpg'); ?>" alt="主任インストラクター 佐々木 優香" width="400" height="400" loading="lazy">
                                                </div>
                                                <div class="skd-instructor-card__content">
                                                    <span class="skd-instructor-role">主任インストラクター / 吉祥寺校統括</span>
                                                    <h3 class="skd-instructor-name">佐々木 優香 <span>（Sasaki Yuka）</span></h3>
                                                    <p class="skd-instructor-creds">
                                                        保有資格：幼少年身体運動指導士 / 日本ダンス医科学研究会公認インストラクター / 上級救命講習修了
                                                    </p>
                                                    <p class="skd-instructor-msg">
                                                        「ダンスは他人と競い合うためのものではなく、自分自身を解放し表現する最高のコミュニケーションです。内気なお子様が初めて音楽に合わせてジャンプできた瞬間の笑顔を、私たちは何よりも大切にしています。」
                                                    </p>
                                                </div>
                                            </div>
                                        </section>

                                    <?php elseif ('facility-safety' === $current_slug) : ?>
                                        <!-- ③ 施設設備・安全対策フォールバック -->
                                        <section class="skd-page-section">
                                            <h2 class="skd-page-h2">成長期の骨と関節を守る、特注の劇場舞台構造二重床</h2>
                                            <p class="skd-page-lead">
                                                一般的なテナントビルに多い「コンクリート直床＋塩ビシート」のスタジオは、成長過程にある未発達な関節や腰骨に過度な負担を与えます。サニーキッズダンスアカデミーでは、専用の防振ゴムと二重合板、天然無垢フローリングを組み合わせた二重構造弾性木床を全面施工。着地衝撃を40%低減し、成長痛や怪我のリスクを構造レベルで予防しています。
                                            </p>

                                            <h3 class="skd-page-h3">保護者専用・完全防音ガラス張り見学ラウンジ（15席）</h3>
                                            <p>
                                                スタジオ内に併設された見学ラウンジは、D-60等級の遮音ガラスで仕切られた静かな空間です。高速Wi-Fi、作業用電源カウンター、ゆったりとしたソファを完備。小さなお子様連れでも気兼ねなく、レッスンに集中する我が子の姿を間近で見守りながら、リモートワークや読書にお使いいただけます。
                                            </p>
                                        </section>

                                    <?php elseif ('tuition-policy' === $current_slug) : ?>
                                        <!-- ④ 料金・規約・振替制度フォールバック -->
                                        <section class="skd-page-section">
                                            <h2 class="skd-page-h2">不透明な隠れコストを完全撤廃。安心の明朗会計規約</h2>
                                            <p class="skd-page-lead">
                                                「月謝は安いが発表会で数十万円請求される」「チケットノルマを買い取らされる」といったダンス業界の不文律を一切排除しました。かかる費用は月謝と規定の発表会参加費のみ。共働きのご家庭でも安心して続けられる透明性を保証します。
                                            </p>

                                            <div class="skd-specs-table-wrap">
                                                <table class="skd-specs-table">
                                                    <tbody>
                                                        <tr>
                                                            <th scope="row">入会金</th>
                                                            <td><strong>11,000円（税込）</strong>（初回のみ・兄妹入会の場合は2人目無料）</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">月額受講費</th>
                                                            <td><strong>10,800円（税込）</strong>（月4回・週1回50分・教材費等すべて内包）</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">発表会参加規定</th>
                                                            <td><strong>参加費：22,000円（税込・指定共通衣装費込み）</strong><br>※チケットノルマ完全ゼロ（買取り義務なし）。追加衣装代の上限は4,000円以内と規約化。</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">振替受講制度</th>
                                                            <td><strong>レッスン開始1時間前までスマホ完結で申請可能</strong><br>当月内および翌月末まで振替有効（振替受講消化率98.4%）。学校行事や急な発熱でも月謝が無駄になりません。</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </section>

                                    <?php elseif ('trial-guide' === $current_slug) : ?>
                                        <!-- ⑤ 体験レッスン完全ガイドフォールバック -->
                                        <section class="skd-page-section">
                                            <h2 class="skd-page-h2">初めてのスタジオでも緊張しない、当日の入室から退出まで</h2>
                                            <p class="skd-page-lead">
                                                初めての場所に足を踏み入れるお子様の不安を先回りして取り除くため、当日のタイムラインと持ち物をすべて公開しています。事前の無理な準備は必要ありません。
                                            </p>

                                            <h3 class="skd-page-h3">当日の持ち物（3点のみでOK）</h3>
                                            <ul class="skd-check-list">
                                                <li>動きやすい服装（Tシャツ、伸縮性のあるレギンス・ジャージ等）</li>
                                                <li>室内履き用スニーカー（底が綺麗なスニーカーで結構です）</li>
                                                <li>水分補給用の水筒・汗拭きタオル</li>
                                            </ul>

                                            <h3 class="skd-page-h3">強引な当日勧誘の禁止宣言</h3>
                                            <p>
                                                体験レッスン当日の無理な入会勧誘や、当日限定割引による即決の強要は一切行いません。ご帰宅後にお子様本人の「また行きたい！」という意志を一番にご確認いただき、ご納得いただいた場合のみWeb上でお手続きいただけます。
                                            </p>
                                        </section>

                                    <?php elseif ('access' === $current_slug) : ?>
                                        <!-- ⑥ アクセス・道順案内フォールバック -->
                                        <section class="skd-page-section">
                                            <h2 class="skd-page-h2">吉祥寺駅公園口から徒歩3分。ベビーカーでも安心の歩道直結ルート</h2>
                                            <p class="skd-page-lead">
                                                JR中央線・総武線・京王井の頭線「吉祥寺駅」南口（公園口）より徒歩3分。井の頭通りを直進する明るく見通しの良いメインストリート沿いです。エレベーターを完備したビルの3階にあり、ベビーカーのままスタジオフロアまで段差なくお越しいただけます。
                                            </p>

                                            <div class="skd-specs-table-wrap">
                                                <table class="skd-specs-table">
                                                    <tbody>
                                                        <tr>
                                                            <th scope="row">スタジオ所在地</th>
                                                            <td>〒180-0005 東京都武蔵野市吉祥寺南町2丁目 サニービル 3F</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">最寄り駅</th>
                                                            <td>JR中央線・総武線・京王井の頭線「吉祥寺駅」公園口 徒歩3分</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">開校時間</th>
                                                            <td>火〜金 14:00〜19:30 / 土日祝 09:30〜18:00（月曜定休）</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">駐輪・駐車</th>
                                                            <td>ビル1階に受講者専用ベビーカー置き場完備。近隣コインパーキング多数あり。</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </section>

                                    <?php elseif ('trial-reservation' === $current_slug) : ?>
                                        <!-- ⑦ Web予約フォールバック -->
                                        <section class="skd-page-section">
                                            <h2 class="skd-page-h2">無料体験レッスン Web空席予約フォーム</h2>
                                            <p class="skd-page-lead">
                                                ご希望のクラス（定員8名）をお選びいただき、必要事項をご入力ください。当日の持ち物案内メールを即時自動送信いたします。
                                            </p>

                                            <form class="skd-form-card" method="post" action="#">
                                                <div class="skd-form-group">
                                                    <label class="skd-form-label"><?php esc_html_e('ご希望の受講クラス', 'sunny-kids-dance'); ?><span class="skd-req">必須</span></label>
                                                    <select class="skd-form-select" required>
                                                        <option value=""><?php esc_html_e('クラスを選択してください', 'sunny-kids-dance'); ?></option>
                                                        <option value="little"><?php esc_html_e('リトルリズムクラス（4〜6歳未就学児）', 'sunny-kids-dance'); ?></option>
                                                        <option value="kids"><?php esc_html_e('キッズベーシッククラス（小1〜小3）', 'sunny-kids-dance'); ?></option>
                                                        <option value="junior"><?php esc_html_e('ジュニアアドバンスクラス（小4〜小6）', 'sunny-kids-dance'); ?></option>
                                                    </select>
                                                </div>

                                                <div class="skd-form-group">
                                                    <label class="skd-form-label"><?php esc_html_e('保護者様のお名前', 'sunny-kids-dance'); ?><span class="skd-req">必須</span></label>
                                                    <input type="text" class="skd-form-input" placeholder="例: 松永 彩香" required>
                                                </div>

                                                <div class="skd-form-group">
                                                    <label class="skd-form-label"><?php esc_html_e('お子様のお名前・年齢', 'sunny-kids-dance'); ?><span class="skd-req">必須</span></label>
                                                    <input type="text" class="skd-form-input" placeholder="例: 結菜（5歳・年長）" required>
                                                </div>

                                                <div class="skd-form-group">
                                                    <label class="skd-form-label"><?php esc_html_e('メールアドレス', 'sunny-kids-dance'); ?><span class="skd-req">必須</span></label>
                                                    <input type="email" class="skd-form-input" placeholder="example@email.com" required>
                                                </div>

                                                <div class="skd-form-group">
                                                    <label class="skd-form-label"><?php esc_html_e('電話番号', 'sunny-kids-dance'); ?><span class="skd-req">必須</span></label>
                                                    <input type="tel" class="skd-form-input" placeholder="090-0000-0000" required>
                                                </div>

                                                <div class="skd-form-group">
                                                    <label class="skd-form-label"><?php esc_html_e('お子様の運動経験や気になる点（任意）', 'sunny-kids-dance'); ?></label>
                                                    <textarea class="skd-form-textarea" rows="3" placeholder="例: 人見知りがあり、集団の中で緊張しやすい傾向があります。"></textarea>
                                                </div>

                                                <button type="button" class="skd-btn-trial-primary" style="width: 100%; border: none;">
                                                    <?php esc_html_e('上記の内容で体験レッスンを予約する', 'sunny-kids-dance'); ?>
                                                </button>
                                            </form>
                                        </section>

                                    <?php else : ?>
                                        <!-- 一般固定ページフォールバック -->
                                        <section class="skd-page-section">
                                            <p class="skd-page-lead">
                                                サニーキッズダンスアカデミー 吉祥寺校の公式情報ページです。詳細はお気軽にお問い合わせください。
                                            </p>
                                        </section>
                                    <?php endif; ?>

                                </div>
                    <?php
                            endif;
                        endwhile;
                    endif;
                    ?>
                </article>

                <!-- サブサイドバー領域（4カラム：案内・CTA） -->
                <aside class="skd-page-sidebar" role="complementary">
                    <div class="skd-sidebar-card">
                        <h3 class="skd-sidebar-title"><?php esc_html_e('少人数制 無料体験レッスン', 'sunny-kids-dance'); ?></h3>
                        <p class="skd-sidebar-desc">
                            実際の定員8名クラスに混ざり、スタジオの弾性木床フロアと講師の丁寧な目線を体験いただけます。
                        </p>
                        <a href="<?php echo esc_url(home_url('/trial-reservation/')); ?>" class="skd-sidebar-btn">
                            <?php esc_html_e('空席カレンダーを見る', 'sunny-kids-dance'); ?>
                        </a>
                    </div>

                    <div class="skd-sidebar-card skd-sidebar-card--sub">
                        <h4 class="skd-sidebar-subtitle"><?php esc_html_e('お電話でのご相談・見学', 'sunny-kids-dance'); ?></h4>
                        <p class="skd-sidebar-tel">
                            <a href="tel:0422298815">0422-29-8815</a>
                        </p>
                        <p class="skd-sidebar-hours">
                            受付: 火〜金 14:00〜19:30<br>
                            土日祝 09:30〜18:00（月曜休校）
                        </p>
                    </div>

                    <div class="skd-sidebar-menu-card">
                        <h4 class="skd-sidebar-subtitle"><?php esc_html_e('アカデミー案内', 'sunny-kids-dance'); ?></h4>
                        <ul class="skd-sidebar-links">
                            <li><a href="<?php echo esc_url(home_url('/curriculum/')); ?>"><?php esc_html_e('カリキュラム・進度管理', 'sunny-kids-dance'); ?></a></li>
                            <li><a href="<?php echo esc_url(home_url('/instructors/')); ?>"><?php esc_html_e('指導陣・専門資格紹介', 'sunny-kids-dance'); ?></a></li>
                            <li><a href="<?php echo esc_url(home_url('/facility-safety/')); ?>"><?php esc_html_e('施設設備・安全対策', 'sunny-kids-dance'); ?></a></li>
                            <li><a href="<?php echo esc_url(home_url('/tuition-policy/')); ?>"><?php esc_html_e('料金一覧・振替受講制度', 'sunny-kids-dance'); ?></a></li>
                            <li><a href="<?php echo esc_url(home_url('/trial-guide/')); ?>"><?php esc_html_e('体験レッスン完全ガイド', 'sunny-kids-dance'); ?></a></li>
                            <li><a href="<?php echo esc_url(home_url('/access/')); ?>"><?php esc_html_e('アクセス・駅からの道順', 'sunny-kids-dance'); ?></a></li>
                        </ul>
                    </div>
                </aside>

            </div>
        </div>
    </div>

</main>

<style>
/* 固定ページ汎用スタイル */
.skd-page-header {
    padding-top: calc(var(--header-height-desktop) + 48px);
    padding-bottom: 40px;
    background-color: var(--color-bg-sub);
    text-align: center;
    border-bottom: 1px solid var(--color-border);
}
.skd-page-layout {
    padding-top: var(--space-section);
    padding-bottom: var(--space-section);
    background-color: var(--color-bg-base);
}
.skd-page-grid {
    display: grid;
    grid-template-columns: 68% 32%;
    gap: 48px;
    align-items: start;
}
.skd-page-article {
    min-width: 0;
}
.skd-page-h2 {
    font-family: var(--font-serif);
    font-size: clamp(1.375rem, 2.0vw, 1.75rem);
    font-weight: 600;
    line-height: 1.45;
    color: var(--color-text-primary);
    margin-bottom: 24px;
    padding-bottom: 12px;
    border-bottom: 2px solid var(--color-accent);
}
.skd-page-h3 {
    font-family: var(--font-sans);
    font-size: 1.125rem;
    font-weight: 700;
    color: var(--color-text-primary);
    margin-top: 36px;
    margin-bottom: 16px;
}
.skd-page-lead {
    font-size: 1.0rem;
    line-height: 2.0;
    color: var(--color-text-secondary);
    margin-bottom: 32px;
}
.skd-check-list {
    margin-bottom: 32px;
}
.skd-check-list li {
    position: relative;
    padding-left: 28px;
    margin-bottom: 12px;
    font-size: 0.9375rem;
    line-height: 1.8;
}
.skd-check-list li::before {
    content: "✓";
    position: absolute;
    left: 0;
    color: var(--color-accent);
    font-weight: 700;
}
.skd-instructor-card {
    display: flex;
    gap: 28px;
    background: var(--color-bg-sub);
    border-radius: var(--radius-card);
    padding: 32px;
    border: 1px solid var(--color-border);
    margin-top: 24px;
}
.skd-instructor-card__img img {
    width: 140px;
    height: 140px;
    border-radius: var(--radius-round);
    object-fit: cover;
    box-shadow: var(--shadow-card);
}
.skd-instructor-role {
    font-size: 0.75rem;
    font-weight: 700;
    color: var(--color-accent);
    display: block;
    margin-bottom: 4px;
}
.skd-instructor-name {
    font-family: var(--font-serif);
    font-size: 1.375rem;
    font-weight: 600;
    color: var(--color-text-primary);
    margin-bottom: 12px;
}
.skd-instructor-name span {
    font-size: 0.875rem;
    color: var(--color-text-sub-muted);
}
.skd-instructor-creds {
    font-size: 0.8125rem;
    font-weight: 600;
    color: var(--color-text-secondary);
    margin-bottom: 12px;
    padding-bottom: 12px;
    border-bottom: 1px dashed var(--color-border);
}
.skd-instructor-msg {
    font-size: 0.875rem;
    line-height: 1.8;
    color: var(--color-text-secondary);
}
.skd-form-card {
    background: #FFFFFF;
    border: 1px solid var(--color-border);
    border-radius: var(--radius-card);
    padding: 36px;
    box-shadow: var(--shadow-card);
}
.skd-form-group {
    margin-bottom: 24px;
}
.skd-form-label {
    display: block;
    font-size: 0.875rem;
    font-weight: 700;
    color: var(--color-text-primary);
    margin-bottom: 8px;
}
.skd-req {
    background: var(--color-accent-sub);
    color: #FFF;
    font-size: 10px;
    padding: 2px 6px;
    border-radius: 4px;
    margin-left: 8px;
}
.skd-form-input,
.skd-form-select,
.skd-form-textarea {
    width: 100%;
    padding: 12px 16px;
    font-size: 0.9375rem;
    border: 1px solid var(--color-border);
    border-radius: 8px;
    background: var(--color-bg-sub);
}
.skd-page-sidebar {
    display: flex;
    flex-direction: column;
    gap: 24px;
}
.skd-sidebar-card {
    background: var(--color-bg-sub);
    border: 1px solid var(--color-border);
    border-radius: var(--radius-card);
    padding: 28px;
}
.skd-sidebar-title {
    font-family: var(--font-serif);
    font-size: 1.125rem;
    color: var(--color-text-primary);
    margin-bottom: 12px;
}
.skd-sidebar-desc {
    font-size: 0.8125rem;
    line-height: 1.7;
    color: var(--color-text-secondary);
    margin-bottom: 20px;
}
.skd-sidebar-btn {
    display: block;
    text-align: center;
    background: var(--color-accent);
    color: #FFF;
    font-weight: 700;
    font-size: 0.875rem;
    padding: 12px;
    border-radius: var(--radius-pill);
    box-shadow: 0 4px 12px rgba(197, 155, 39, 0.25);
}
.skd-sidebar-subtitle {
    font-size: 0.875rem;
    font-weight: 700;
    color: var(--color-text-primary);
    margin-bottom: 8px;
}
.skd-sidebar-tel a {
    font-family: var(--font-en);
    font-size: 1.375rem;
    font-weight: 700;
    color: var(--color-text-primary);
}
.skd-sidebar-hours {
    font-size: 0.75rem;
    color: var(--color-text-sub-muted);
    line-height: 1.6;
    margin-top: 6px;
}
.skd-sidebar-links li {
    border-bottom: 1px solid var(--color-border);
}
.skd-sidebar-links a {
    display: block;
    padding: 10px 0;
    font-size: 0.8125rem;
    color: var(--color-text-secondary);
}
.skd-sidebar-links a:hover {
    color: var(--color-accent);
}

@media screen and (max-width: 1023px) {
    .skd-page-grid {
        grid-template-columns: 1fr;
        gap: 40px;
    }
}
@media screen and (max-width: 767px) {
    .skd-instructor-card {
        flex-direction: column;
        align-items: center;
        text-align: center;
    }
    .skd-form-card {
        padding: 24px 16px;
    }
}
</style>

<?php
get_footer();
```eof