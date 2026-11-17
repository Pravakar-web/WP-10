<?php
/**
 * PHP Web Applications – Practical Lab
 * Main Landing Page & Hub
 */

$page_title = 'PHP Web Applications – Practical Lab';
$active_nav = 'home';
$base_path = './';

require_once __DIR__ . '/includes/header.php';
?>

<div class="container">
  <!-- Hero Section -->
  <section class="hero">
    <div class="hero-pill">
      <span class="hero-pill-dot"></span>
      <span>PHP 8.1+ Production Ready Lab Suite</span>
    </div>

    <h1 class="hero-title">
      PHP <span class="gradient-text">Web Applications</span>
    </h1>

    <p class="hero-subtitle">
      Practical Implementation of PHP Concepts &mdash; A modern, responsive demonstration of server-side session lifecycles, temporal functions, and authorization controls.
    </p>

    <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap; margin-bottom: 2rem;">
      <a href="#assignments" class="btn btn-primary btn-lg">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <polygon points="5 3 19 12 5 21 5 3"></polygon>
        </svg>
        Explore Assignments
      </a>
      <a href="#about" class="btn btn-secondary btn-lg" data-open-about>
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="12" cy="12" r="10"></circle>
          <line x1="12" y1="16" x2="12" y2="12"></line>
          <line x1="12" y1="8" x2="12.01" y2="8"></line>
        </svg>
        System Architecture
      </a>
    </div>

    <div class="hero-meta">
      <div class="hero-meta-item">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
        </svg>
        <span>Zero External Runtime Dependencies</span>
      </div>
      <div class="hero-meta-item">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <polyline points="20 6 9 17 4 12"></polyline>
        </svg>
        <span>Strict Input Sanitization &amp; Escaping</span>
      </div>
      <div class="hero-meta-item">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
          <line x1="8" y1="21" x2="16" y2="21"></line>
          <line x1="12" y1="17" x2="12" y2="21"></line>
        </svg>
        <span>Mobile-First Fluid Layout</span>
      </div>
    </div>
  </section>

  <!-- Interactive Assignments Grid -->
  <section id="assignments" style="scroll-margin-top: 5rem;">
    <div class="section-header">
      <div class="section-tag">Laboratory Portfolio</div>
      <h2>Interactive Applications</h2>
      <p style="max-width: 550px; margin: 0.5rem auto 0;">
        Select any assignment below to launch the dedicated web module. Each application functions autonomously with complete backend logic.
      </p>
    </div>

    <div class="assignments-grid">
      <!-- Card 1: Session Management -->
      <article class="card">
        <div class="card-header-flex">
          <span class="assignment-badge">Assignment 01</span>
          <div class="card-icon-wrapper">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
              <circle cx="12" cy="7" r="4"></circle>
            </svg>
          </div>
        </div>

        <h3 class="card-title">Session-Based Login &amp; Logout</h3>
        <p class="card-description">
          Accepts a user's name, initiates a persistent PHP session, logs the precise start timestamp, renders a personalized dashboard, and calculates total duration upon termination.
        </p>

        <div class="card-tags">
          <span class="tag">session_start()</span>
          <span class="tag">$_SESSION</span>
          <span class="tag">Duration Calc</span>
          <span class="tag">session_destroy()</span>
        </div>

        <div class="card-footer">
          <a href="assignment1/index.php" class="btn btn-primary btn-block">
            <span>Try Application</span>
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <line x1="5" y1="12" x2="19" y2="12"></line>
              <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
          </a>
        </div>
      </article>

      <!-- Card 2: Date, Time & Day Engine -->
      <article class="card">
        <div class="card-header-flex">
          <span class="assignment-badge">Assignment 02</span>
          <div class="card-icon-wrapper">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="12" cy="12" r="10"></circle>
              <polyline points="12 6 12 12 16 14"></polyline>
            </svg>
          </div>
        </div>

        <h3 class="card-title">Dynamic Date, Time &amp; Day</h3>
        <p class="card-description">
          Presents real-time server date, time, and day across three modern aesthetic cards using PHP's native temporal functions, server timezone detection, and manual refresh triggers.
        </p>

        <div class="card-tags">
          <span class="tag">date('d F Y')</span>
          <span class="tag">date('h:i:s A')</span>
          <span class="tag">date('l')</span>
          <span class="tag">Timezone Engine</span>
        </div>

        <div class="card-footer">
          <a href="assignment2/index.php" class="btn btn-primary btn-block">
            <span>Try Application</span>
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <line x1="5" y1="12" x2="19" y2="12"></line>
              <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
          </a>
        </div>
      </article>

      <!-- Card 3: Age-Based Authorization -->
      <article class="card">
        <div class="card-header-flex">
          <span class="assignment-badge">Assignment 03</span>
          <div class="card-icon-wrapper">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
            </svg>
          </div>
        </div>

        <h3 class="card-title">Age-Based Authorization</h3>
        <p class="card-description">
          Evaluates user name and numerical age via POST form handling. Applies server-side validation and conditional branching to determine authorized vs unauthorized access states.
        </p>

        <div class="card-tags">
          <span class="tag">$_POST</span>
          <span class="tag">FILTER_VALIDATE_INT</span>
          <span class="tag">Conditional Logic</span>
          <span class="tag">State Indicators</span>
        </div>

        <div class="card-footer">
          <a href="assignment3/index.php" class="btn btn-primary btn-block">
            <span>Try Application</span>
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <line x1="5" y1="12" x2="19" y2="12"></line>
              <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
          </a>
        </div>
      </article>
    </div>
  </section>

  <!-- Technical Highlights Section -->
  <section class="features-section">
    <div class="section-header">
      <div class="section-tag">Engineering Quality</div>
      <h2>Engineered for Presentation &amp; Deployment</h2>
    </div>

    <div class="features-grid">
      <div class="feature-box">
        <h4>
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--accent-secondary)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
          </svg>
          Clean PHP Architecture
        </h4>
        <p style="font-size: 0.875rem;">
          Pure native PHP 8.1+ code with structured superglobal handling, strict data sanitization via <code>htmlspecialchars()</code>, and robust error trapping.
        </p>
      </div>

      <div class="feature-box">
        <h4>
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--accent-secondary)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="5"></circle>
            <line x1="12" y1="1" x2="12" y2="3"></line>
            <line x1="12" y1="21" x2="12" y2="23"></line>
          </svg>
          Dual Theme Design System
        </h4>
        <p style="font-size: 0.875rem;">
          Built with responsive CSS custom properties featuring an ultra-sleek dark theme default, seamless light mode switch, and localStorage persistence.
        </p>
      </div>

      <div class="feature-box">
        <h4>
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--accent-secondary)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
          </svg>
          Cloud &amp; Git Ready
        </h4>
        <p style="font-size: 0.875rem;">
          Completely free of hardcoded paths or ports. Perfectly structured for GitHub repository presentation and instant hosting on any PHP platform.
        </p>
      </div>
    </div>
  </section>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
