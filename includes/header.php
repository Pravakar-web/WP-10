<?php
/**
 * PHP Web Applications – Practical Lab
 * Shared Header Component
 */

// Determine base path relative to calling script if not already set
if (!isset($base_path)) {
    $base_path = './';
}

if (!isset($page_title)) {
    $page_title = 'PHP Web Applications – Practical Lab';
}

if (!isset($active_nav)) {
    $active_nav = 'home';
}
?>
<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title><?php echo htmlspecialchars($page_title, ENT_QUOTES, 'UTF-8'); ?></title>
  
  <!-- Meta SEO & Social -->
  <meta name="description" content="A modern, responsive PHP practical laboratory application demonstrating Sessions, Date & Time manipulation, and Age-based authorization.">
  <meta name="author" content="Full-Stack Engineer & Lab Team">
  <link rel="icon" type="image/svg+xml" href="<?php echo $base_path; ?>assets/images/favicon.svg">
  
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
  
  <!-- Main Stylesheet -->
  <link rel="stylesheet" href="<?php echo $base_path; ?>assets/css/style.css">
</head>
<body>

  <!-- Top Sticky Navigation Bar -->
  <header class="navbar" role="banner">
    <div class="nav-container">
      <a href="<?php echo $base_path; ?>index.php" class="nav-brand" aria-label="PHP Lab Home">
        <div class="nav-logo-icon">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="16 18 22 12 16 6"></polyline>
            <polyline points="8 6 2 12 8 18"></polyline>
          </svg>
        </div>
        <span>PHP Lab<span style="color: var(--accent-secondary);">.</span></span>
        <span class="nav-badge">v1.0</span>
      </a>

      <!-- Desktop & Mobile Menu -->
      <nav id="navMenu" class="nav-menu" role="navigation" aria-label="Main Navigation">
        <a href="<?php echo $base_path; ?>index.php" class="nav-link <?php echo $active_nav === 'home' ? 'active' : ''; ?>">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
            <polyline points="9 22 9 12 15 12 15 22"></polyline>
          </svg>
          Home
        </a>
        <a href="<?php echo $base_path; ?>assignment1/index.php" class="nav-link <?php echo $active_nav === 'assignment1' ? 'active' : ''; ?>">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
            <circle cx="12" cy="7" r="4"></circle>
          </svg>
          Lab 1: Sessions
        </a>
        <a href="<?php echo $base_path; ?>assignment2/index.php" class="nav-link <?php echo $active_nav === 'assignment2' ? 'active' : ''; ?>">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"></circle>
            <polyline points="12 6 12 12 16 14"></polyline>
          </svg>
          Lab 2: Date & Time
        </a>
        <a href="<?php echo $base_path; ?>assignment3/index.php" class="nav-link <?php echo $active_nav === 'assignment3' ? 'active' : ''; ?>">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
          </svg>
          Lab 3: Authorization
        </a>
        <a href="#about" class="nav-link" data-open-about>
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"></circle>
            <line x1="12" y1="16" x2="12" y2="12"></line>
            <line x1="12" y1="8" x2="12.01" y2="8"></line>
          </svg>
          About
        </a>
      </nav>

      <!-- Action Items: Theme Toggle & Mobile Trigger -->
      <div class="nav-actions">
        <button id="themeToggleBtn" class="theme-toggle" type="button" aria-label="Toggle Dark/Light Theme" title="Toggle theme">
          <!-- Moon icon for light mode (shows when dark is active) -->
          <svg class="theme-icon-light" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
          </svg>
          <!-- Sun icon for dark mode (shows when light is active) -->
          <svg class="theme-icon-dark" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="5"></circle>
            <line x1="12" y1="1" x2="12" y2="3"></line>
            <line x1="12" y1="21" x2="12" y2="23"></line>
            <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
            <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
            <line x1="1" y1="12" x2="3" y2="12"></line>
            <line x1="21" y1="12" x2="23" y2="12"></line>
            <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
            <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
          </svg>
        </button>

        <button id="mobileNavToggle" class="mobile-toggle" type="button" aria-label="Toggle navigation menu">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="3" y1="12" x2="21" y2="12"></line>
            <line x1="3" y1="6" x2="21" y2="6"></line>
            <line x1="3" y1="18" x2="21" y2="18"></line>
          </svg>
        </button>
      </div>
    </div>
  </header>

  <!-- Main Content Container -->
  <main class="main-content" role="main">
