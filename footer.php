<?php
/**
 * Footer Template for SUNNY KIDS DANCE ACADEMY
 *
 * @package SunnyKidsDanceAcademy
 * @author  AshikaWorks
 * @version 1.0.0
 */

defined('ABSPATH') || exit;
?>

<!-- フッター直前スナップショットギャラリー（5枚横並び） -->
<section class="skd-snap-gallery-container" aria-label="<?php esc_attr_e('スタジオの日常スナップ', 'sunny-kids-dance'); ?>">
    <div class="skd-snap-gallery">
        <div class="skd-snap-gallery__item">
            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/gallery-01.jpg'); ?>" alt="ダンスレッスンのウォーミングアップ風景" width="600" height="600" loading="lazy">
        </div>
        <div class="skd-snap-gallery__item">
            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/gallery-02.jpg'); ?>" alt="笑顔でステップを踏む子どもたち" width="600" height="600" loading="lazy">
        </div>
        <div class="skd-snap-gallery__item">
            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/gallery-03.jpg'); ?>" alt="先生と生徒のハイタッチ" width="600" height="600" loading="lazy">
        </div>
        <div class="skd-snap-gallery__item">
            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/gallery-04.jpg'); ?>" alt="二重弾性木床フロアでのリズム練習" width="600" height="600" loading="lazy">
        </div>
        <div class="skd-snap-gallery__item">
            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/gallery-05.jpg'); ?>" alt="レッスン終わりの集合スナップ" width="600" height="600" loading="lazy">
        </div>
    </div>
</section>

<!-- フッター本体 -->
<footer id="colophon" class="skd-footer" role="contentinfo">
    <div class="skd-container">
        <!-- 上段：大判エディトリアルブランドステートメント＆所在地・ナビゲーション -->
        <div class="skd-footer__layout">
            <!-- 左列：ブランドステートメント＆店舗情報メタデータ -->
            <div class="skd-footer__brand-col">
                <p class="skd-footer__brand-title">SUNNY KIDS DANCE ACADEMY</p>
                <p class="skd-footer__brand-tagline">認めて、育てる。少人数制で笑顔が咲くキッズダンス。</p>

                <div class="skd-footer__meta-info">
                    <p class="skd-footer__address">
                        〒180-0005 東京都武蔵野市吉祥寺南町2丁目（吉祥寺駅公園口 徒歩3分）<br>
                        サニービル 3F（エレベーター完備・ベビーカー来校可）
                    </p>
                    <p class="skd-footer__contact">
                        TEL: <a href="tel:0422298815" class="skd-footer__tel">0422-29-8815</a><br>
                        受付時間: 火〜金 14:00〜19:30 / 土日祝 09:30〜18:00（月曜定休）
                    </p>
                </div>

                <!-- 公式SNSリンク -->
                <div class="skd-footer__sns-links">
                    <a href="https://instagram.com" class="skd-footer__sns-link" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
                    </a>
                    <a href="https://line.me" class="skd-footer__sns-link" target="_blank" rel="noopener noreferrer" aria-label="LINE公式アカウント">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M19.365 9.863c.349 0 .63.285.63.631 0 .345-.281.63-.63.63H17.61v1.125h1.755c.349 0 .63.283.63.63 0 .344-.281.629-.63.629h-2.386c-.345 0-.627-.285-.627-.629V8.108c0-.345.282-.63.63-.63h2.386c.346 0 .627.285.627.63 0 .349-.281.63-.63.63H17.61v1.125h1.755zm-3.855 3.016c0 .27-.174.51-.432.596-.064.021-.133.031-.199.031-.211 0-.391-.09-.51-.25l-2.443-3.317v2.94c0 .344-.279.629-.631.629-.346 0-.626-.285-.626-.629V8.108c0-.27.173-.51.43-.595.06-.023.136-.033.194-.033.195 0 .375.104.477.254l2.486 3.37V8.108c0-.345.282-.63.63-.63.345 0 .625.285.625.63v4.771zm-5.741 0c0 .344-.282.629-.631.629-.345 0-.627-.285-.627-.629V8.108c0-.345.282-.63.63-.63.346 0 .628.285.628.63v4.771zm-2.466.629H4.917c-.345 0-.63-.285-.63-.629V8.108c0-.345.285-.63.63-.63.348 0 .63.285.63.63v4.141h1.756c.348 0 .629.283.629.63 0 .344-.282.629-.629.629M24 10.314C24 4.943 18.615.572 12 .572S0 4.943 0 10.314c0 4.811 4.27 8.842 10.035 9.608.391.082.923.258 1.058.59.12.301.079.766.038 1.08l-.164 1.02c-.045.301-.24 1.186 1.049.645 1.291-.539 6.916-4.078 9.436-6.975C23.176 14.393 24 12.458 24 10.314"/></svg>
                    </a>
                </div>
            </div>

            <!-- 右列：体系的ナビゲーションリンク -->
            <div class="skd-footer__nav-col">
                <div class="skd-footer__links-grid">
                    <div class="skd-footer__links-group">
                        <p class="skd-footer__group-title"><?php esc_html_e('アカデミー案内', 'sunny-kids-dance'); ?></p>
                        <ul class="skd-footer__menu-list">
                            <li><a href="<?php echo esc_url(home_url('/#philosophy')); ?>"><?php esc_html_e('教育理念・指導方針', 'sunny-kids-dance'); ?></a></li>
                            <li><a href="<?php echo esc_url(home_url('/#commitment')); ?>"><?php esc_html_e('3つの安心ポイント', 'sunny-kids-dance'); ?></a></li>
                            <li><a href="<?php echo esc_url(home_url('/curriculum/')); ?>"><?php esc_html_e('カリキュラム・進度基準', 'sunny-kids-dance'); ?></a></li>
                            <li><a href="<?php echo esc_url(home_url('/instructors/')); ?>"><?php esc_html_e('指導陣・専門資格紹介', 'sunny-kids-dance'); ?></a></li>
                            <li><a href="<?php echo esc_url(home_url('/facility-safety/')); ?>"><?php esc_html_e('施設設備・安全対策', 'sunny-kids-dance'); ?></a></li>
                        </ul>
                    </div>

                    <div class="skd-footer__links-group">
                        <p class="skd-footer__group-title"><?php esc_html_e('受講・システム', 'sunny-kids-dance'); ?></p>
                        <ul class="skd-footer__menu-list">
                            <li><a href="<?php echo esc_url(home_url('/#classes')); ?>"><?php esc_html_e('開講クラス一覧', 'sunny-kids-dance'); ?></a></li>
                            <li><a href="<?php echo esc_url(home_url('/#specifications')); ?>"><?php esc_html_e('施設仕様・利用規程データ', 'sunny-kids-dance'); ?></a></li>
                            <li><a href="<?php echo esc_url(home_url('/tuition-policy/')); ?>"><?php esc_html_e('料金一覧・振替受講制度', 'sunny-kids-dance'); ?></a></li>
                            <li><a href="<?php echo esc_url(home_url('/trial-guide/')); ?>"><?php esc_html_e('体験レッスン完全ガイド', 'sunny-kids-dance'); ?></a></li>
                            <li><a href="<?php echo esc_url(home_url('/access/')); ?>"><?php esc_html_e('アクセス・駅からの道順', 'sunny-kids-dance'); ?></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- 下段：法務・利用規程・コピーライト -->
        <div class="skd-footer__bottom">
            <ul class="skd-footer__legal-links">
                <li><a href="<?php echo esc_url(home_url('/privacy-policy/')); ?>"><?php esc_html_e('プライバシーポリシー', 'sunny-kids-dance'); ?></a></li>
                <li><a href="<?php echo esc_url(home_url('/terms/')); ?>"><?php esc_html_e('受講規約・キャンセル規定', 'sunny-kids-dance'); ?></a></li>
                <li><a href="<?php echo esc_url(home_url('/commercial-transaction/')); ?>"><?php esc_html_e('特定商取引法に基づく表記', 'sunny-kids-dance'); ?></a></li>
            </ul>

            <p class="skd-footer__copyright">
                &copy; <?php echo esc_html(gmdate('Y')); ?> SUNNY KIDS DANCE ACADEMY. All Rights Reserved.
            </p>
        </div>
    </div>
</footer>

<!-- 画面右下追従UI群 -->
<!-- 1. お子様クラス適性診断ポップアップ（フローティングカード） -->
<aside class="skd-floating-diagnostic js-floating-diagnostic" aria-label="<?php esc_attr_e('おすすめクラス診断', 'sunny-kids-dance'); ?>">
    <button type="button" class="skd-floating-diagnostic__close js-floating-close" aria-label="<?php esc_attr_e('診断バナーを閉じる', 'sunny-kids-dance'); ?>">&times;</button>
    <span class="skd-floating-diagnostic__question">お子様にぴったりのクラスは？</span>
    <a href="<?php echo esc_url(home_url('/trial-guide/#diagnosis')); ?>" class="skd-floating-diagnostic__btn">
        <span>30秒かんたん診断</span>
        <span aria-hidden="true">&rarr;</span>
    </a>
</aside>

<!-- 2. スクロールトップ戻るボタン（円形ゴールド） -->
<button type="button" class="skd-scroll-top js-scroll-top" aria-label="<?php esc_attr_e('ページ上部へ戻る', 'sunny-kids-dance'); ?>">
    <svg viewBox="0 0 24 24" aria-hidden="true">
        <line x1="12" y1="19" x2="12" y2="5"></line>
        <polyline points="5 12 12 5 19 12"></polyline>
    </svg>
</button>

<?php wp_footer(); ?>
</body>
</html>