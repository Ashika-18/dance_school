/**
 * Main Script for SUNNY KIDS DANCE ACADEMY
 *
 * @package SunnyKidsDanceAcademy
 * @author  AshikaWorks
 * @version 1.0.0
 *
 * Vanilla ES6+ (No jQuery dependency)
 * Features:
 * - Fixed Header Scroll Detection (Glassmorphism & Compact)
 * - Mobile Drawer Navigation Toggle & Focus Trap
 * - Offset Smooth Scroll for Hash Links
 * - Scroll-to-Top Button Visibility & Behavior
 * - Floating Diagnostic Card Dismissal
 * - Intersection Observer for Fade-in Interactions
 */

'use strict';

document.addEventListener('DOMContentLoaded', () => {
  /* ==========================================================================
     01. 定数・DOM要素取得
     ========================================================================== */
  const header = document.querySelector('.skda-header, .skd-header');
  const hamburger = document.querySelector('.skda-header__hamburger, .skd-header__hamburger, .js-drawer-toggle');
  const drawer = document.querySelector('.skda-drawer, .skd-drawer, .js-drawer');
  const scrollTopBtn = document.querySelector('.skda-hero__scroll, .skd-scroll-top, .js-scroll-top');
  const floatingCard = document.querySelector('.skd-floating-diagnostic, .js-floating-diagnostic');
  const floatingCloseBtn = document.querySelector('.skd-floating-diagnostic__close, .js-floating-close');
  const internalLinks = document.querySelectorAll('a[href^="#"]');

  /* ==========================================================================
     02. ヘッダースクロール監視（磨りガラス・収縮制御）
     ========================================================================== */
  let lastScrollY = window.scrollY;
  let ticking = false;

  const handleHeaderScroll = () => {
    const currentScrollY = window.scrollY;

    if (header) {
      if (currentScrollY > 60) {
        header.classList.add('is-scrolled');
        header.style.backgroundColor = 'rgba(255, 255, 255, 0.94)';
        header.style.backdropFilter = 'blur(12px)';
        header.style.webkitBackdropFilter = 'blur(12px)';
        header.style.boxShadow = '0 4px 20px rgba(0, 0, 0, 0.06)';
      } else {
        header.classList.remove('is-scrolled');
        header.style.backgroundColor = '#FFFFFF';
        header.style.backdropFilter = 'none';
        header.style.webkitBackdropFilter = 'none';
        header.style.boxShadow = 'none';
      }
    }

    // TOP戻るボタンの表示・非表示判定（300px以上スクロール時）
    if (scrollTopBtn) {
      if (currentScrollY > 300) {
        scrollTopBtn.classList.add('is-visible');
        scrollTopBtn.style.opacity = '1';
        scrollTopBtn.style.pointerEvents = 'auto';
        scrollTopBtn.style.transform = 'translateY(0)';
      } else {
        scrollTopBtn.classList.remove('is-visible');
        scrollTopBtn.style.opacity = '0';
        scrollTopBtn.style.pointerEvents = 'none';
        scrollTopBtn.style.transform = 'translateY(16px)';
      }
    }

    lastScrollY = currentScrollY;
    ticking = false;
  };

  window.addEventListener('scroll', () => {
    if (!ticking) {
      window.requestAnimationFrame(handleHeaderScroll);
      ticking = true;
    }
  }, { passive: true });

  // 初期化実行
  handleHeaderScroll();

  /* ==========================================================================
     03. モバイルドロワーメニュー開閉制御
     ========================================================================== */
  if (hamburger) {
    hamburger.addEventListener('click', (e) => {
      e.preventDefault();
      const isExpanded = hamburger.getAttribute('aria-expanded') === 'true';
      const nextState = !isExpanded;

      hamburger.setAttribute('aria-expanded', String(nextState));
      hamburger.classList.toggle('is-active', nextState);

      if (drawer) {
        drawer.classList.toggle('is-open', nextState);
        drawer.setAttribute('aria-hidden', String(!nextState));
      }

      // 背景スクロールロック
      if (nextState) {
        document.body.style.overflow = 'hidden';
      } else {
        document.body.style.removeProperty('overflow');
      }
    });
  }

  // ドロワー内のリンククリック時に自動で閉じる
  if (drawer) {
    const drawerLinks = drawer.querySelectorAll('a');
    drawerLinks.forEach((link) => {
      link.addEventListener('click', () => {
        if (hamburger) {
          hamburger.setAttribute('aria-expanded', 'false');
          hamburger.classList.remove('is-active');
        }
        drawer.classList.remove('is-open');
        drawer.setAttribute('aria-hidden', 'true');
        document.body.style.removeProperty('overflow');
      });
    });
  }

  /* ==========================================================================
     04. ヘッダー高さを考慮したオフセット付きスムーズスクロール
     ========================================================================== */
  internalLinks.forEach((link) => {
    link.addEventListener('click', (e) => {
      const targetId = link.getAttribute('href');

      if (!targetId || targetId === '#' || targetId === '#top') {
        if (targetId === '#top') {
          e.preventDefault();
          window.scrollTo({
            top: 0,
            behavior: 'smooth'
          });
        }
        return;
      }

      const targetElement = document.querySelector(targetId);
      if (targetElement) {
        e.preventDefault();

        // 画面幅に応じた動的ヘッダー高さの計算
        const isMobile = window.innerWidth <= 767;
        const headerOffset = isMobile ? 60 : 74;
        const elementPosition = targetElement.getBoundingClientRect().top;
        const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

        window.scrollTo({
          top: offsetPosition,
          behavior: 'smooth'
        });

        // アクセシビリティ：フォーカス移動
        targetElement.setAttribute('tabindex', '-1');
        targetElement.focus({ preventScroll: true });
      }
    });
  });

  /* ==========================================================================
     05. TOP戻るボタンのスクロールアクション
     ========================================================================== */
  if (scrollTopBtn) {
    // 初期スタイル設定（非表示状態）
    scrollTopBtn.style.transition = 'opacity 300ms ease, transform 300ms ease, background-color 300ms ease';
    scrollTopBtn.style.opacity = '0';
    scrollTopBtn.style.pointerEvents = 'none';
    scrollTopBtn.style.transform = 'translateY(16px)';

    scrollTopBtn.addEventListener('click', (e) => {
      e.preventDefault();
      window.scrollTo({
        top: 0,
        behavior: 'smooth'
      });
    });
  }

  /* ==========================================================================
     06. フローティング診断カード開閉・非表示処理
     ========================================================================== */
  if (floatingCloseBtn && floatingCard) {
    floatingCloseBtn.addEventListener('click', (e) => {
      e.preventDefault();
      floatingCard.style.opacity = '0';
      floatingCard.style.transform = 'translateY(20px)';
      floatingCard.style.pointerEvents = 'none';

      setTimeout(() => {
        floatingCard.style.display = 'none';
      }, 300);

      // セッション中再表示しないようフラグ保存
      try {
        sessionStorage.setItem('skda_diag_dismissed', '1');
      } catch (err) {
        // Private browsing fallback
      }
    });

    // 既に閉じられているかチェック
    try {
      if (sessionStorage.getItem('skda_diag_dismissed') === '1') {
        floatingCard.style.display = 'none';
      }
    } catch (err) {
      // ignore
    }
  }

  /* ==========================================================================
     07. Intersection Observer によるスクロール連動フェードイン
     ========================================================================== */
  const revealElements = document.querySelectorAll(
    '.skda-point-card, .skda-class-card, .skda-about__media, .skda-about__text-block, .skd-point-card, .skd-class-card'
  );

  if ('IntersectionObserver' in window && revealElements.length > 0) {
    const revealObserver = new IntersectionObserver(
      (entries, observer) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            entry.target.classList.add('is-revealed');
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0)';
            observer.unobserve(entry.target);
          }
        });
      },
      {
        root: null,
        rootMargin: '0px 0px -60px 0px',
        threshold: 0.15
      }
    );

    revealElements.forEach((el) => {
      el.style.opacity = '0';
      el.style.transform = 'translateY(24px)';
      el.style.transition = 'opacity 800ms cubic-bezier(0.16, 1, 0.3, 1), transform 800ms cubic-bezier(0.16, 1, 0.3, 1)';
      revealObserver.observe(el);
    });
  }
});
