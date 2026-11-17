/**
 * PHP Web Applications – Practical Lab
 * Client-side Interactivity & Theme Manager
 */

(function () {
  'use strict';

  // --- Theme Management ---
  const THEME_STORAGE_KEY = 'php_lab_theme';
  const rootElement = document.documentElement;

  function initTheme() {
    const savedTheme = localStorage.getItem(THEME_STORAGE_KEY);
    if (savedTheme) {
      setTheme(savedTheme);
    } else {
      // Default to dark theme as requested
      setTheme('dark');
    }
  }

  function setTheme(theme) {
    rootElement.setAttribute('data-theme', theme);
    localStorage.setItem(THEME_STORAGE_KEY, theme);
  }

  function toggleTheme() {
    const currentTheme = rootElement.getAttribute('data-theme') || 'dark';
    const nextTheme = currentTheme === 'dark' ? 'light' : 'dark';
    setTheme(nextTheme);
  }

  // --- Mobile Navigation Toggle ---
  function initMobileNav() {
    const mobileToggle = document.getElementById('mobileNavToggle');
    const navMenu = document.getElementById('navMenu');

    if (mobileToggle && navMenu) {
      mobileToggle.addEventListener('click', () => {
        navMenu.classList.toggle('open');
        const isOpen = navMenu.classList.contains('open');
        mobileToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
      });

      // Close menu when clicking outside
      document.addEventListener('click', (e) => {
        if (!mobileToggle.contains(e.target) && !navMenu.contains(e.target)) {
          navMenu.classList.remove('open');
          mobileToggle.setAttribute('aria-expanded', 'false');
        }
      });
    }
  }

  // --- About Modal Management ---
  function initAboutModal() {
    const openBtns = document.querySelectorAll('[data-open-about]');
    const modal = document.getElementById('aboutModal');
    const closeBtn = document.getElementById('closeAboutModal');

    if (!modal) return;

    openBtns.forEach((btn) => {
      btn.addEventListener('click', (e) => {
        e.preventDefault();
        modal.classList.add('active');
        document.body.style.overflow = 'hidden';
      });
    });

    const closeModal = () => {
      modal.classList.remove('active');
      document.body.style.overflow = '';
    };

    if (closeBtn) closeBtn.addEventListener('click', closeModal);

    modal.addEventListener('click', (e) => {
      if (e.target === modal) closeModal();
    });

    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && modal.classList.contains('active')) {
        closeModal();
      }
    });
  }

  // --- Assignment 1: Live Duration Counter (Enhancement) ---
  function initSessionTimer() {
    const timerElement = document.getElementById('liveSessionTimer');
    if (!timerElement) return;

    const startTimeEpoch = parseInt(timerElement.getAttribute('data-start-time'), 10);
    if (isNaN(startTimeEpoch)) return;

    function formatDuration(seconds) {
      const hrs = Math.floor(seconds / 3600);
      const mins = Math.floor((seconds % 3600) / 60);
      const secs = seconds % 60;

      const pad = (n) => String(n).padStart(2, '0');
      if (hrs > 0) {
        return `${pad(hrs)}h ${pad(mins)}m ${pad(secs)}s`;
      }
      return `${pad(mins)}m ${pad(secs)}s`;
    }

    function update() {
      const nowEpoch = Math.floor(Date.now() / 1000);
      const elapsed = Math.max(0, nowEpoch - startTimeEpoch);
      timerElement.textContent = formatDuration(elapsed);
    }

    update();
    setInterval(update, 1000);
  }

  // --- Assignment 2: Live Client Clock Comparison (Optional helper) ---
  function initLiveClockSync() {
    const liveClockDisplay = document.getElementById('clientLiveClock');
    if (!liveClockDisplay) return;

    function tick() {
      const now = new Date();
      liveClockDisplay.textContent = now.toLocaleTimeString([], {
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit',
        hour12: true
      });
    }

    tick();
    setInterval(tick, 1000);
  }

  // --- Form Enhancements ---
  function initFormValidation() {
    const forms = document.querySelectorAll('form[data-validate]');
    forms.forEach((form) => {
      form.addEventListener('submit', (e) => {
        let isValid = true;
        const requiredInputs = form.querySelectorAll('input[required]');

        requiredInputs.forEach((input) => {
          if (!input.value.trim()) {
            isValid = false;
            input.classList.add('input-error');
          } else {
            input.classList.remove('input-error');
          }
        });

        const ageInput = form.querySelector('input[type="number"][name="age"]');
        if (ageInput) {
          const val = parseInt(ageInput.value, 10);
          if (isNaN(val) || val < 0 || val > 130) {
            isValid = false;
            ageInput.classList.add('input-error');
          }
        }

        if (!isValid) {
          e.preventDefault();
        }
      });
    });
  }

  // --- Document Ready Initialization ---
  document.addEventListener('DOMContentLoaded', () => {
    initTheme();
    initMobileNav();
    initAboutModal();
    initSessionTimer();
    initLiveClockSync();
    initFormValidation();

    const themeToggleBtn = document.getElementById('themeToggleBtn');
    if (themeToggleBtn) {
      themeToggleBtn.addEventListener('click', toggleTheme);
    }
  });
})();
