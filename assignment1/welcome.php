<?php
/**
 * Assignment 1 – Session-Based Login and Logout System
 * Personalized Welcome Page (Protected Route)
 */

session_start();

// Enforce Session Gatekeeping: Redirect unauthorized users
if (!isset($_SESSION['user_name']) || !isset($_SESSION['login_time'])) {
    header('Location: index.php?error=unauthorized');
    exit;
}

$user_name = $_SESSION['user_name'];
$login_time_epoch = $_SESSION['login_time'];
$login_time_formatted = $_SESSION['login_time_formatted'] ?? date('d M Y, h:i:s A', $login_time_epoch);

$page_title = 'Welcome, ' . htmlspecialchars($user_name, ENT_QUOTES, 'UTF-8') . ' | Assignment 1';
$active_nav = 'assignment1';
$base_path = '../';

require_once __DIR__ . '/../includes/header.php';
?>

<div class="container container-narrow">
  <!-- Breadcrumb -->
  <nav class="breadcrumb" aria-label="Breadcrumb">
    <a href="../index.php">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
      </svg>
      Home
    </a>
    <span class="breadcrumb-separator">/</span>
    <a href="index.php">Assignment 1</a>
    <span class="breadcrumb-separator">/</span>
    <span class="breadcrumb-current">Personalized Welcome</span>
  </nav>

  <!-- Session Status Bar (Displays Start Time at Top-Right as required) -->
  <div class="session-bar">
    <div class="session-info-badge">
      <span class="hero-pill-dot"></span>
      <span>Session Status: <strong style="color: var(--color-success);">ACTIVE</strong></span>
    </div>

    <!-- Required: Session start time at top-right corner -->
    <div class="session-info-badge" style="margin-left: auto;">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <circle cx="12" cy="12" r="10"></circle>
        <polyline points="12 6 12 12 16 14"></polyline>
      </svg>
      <span>Session Start Time:</span>
      <span class="session-start-tag"><?php echo htmlspecialchars($login_time_formatted, ENT_QUOTES, 'UTF-8'); ?></span>
    </div>
  </div>

  <!-- Main Welcome Card -->
  <div class="welcome-box">
    <!-- User Avatar Graphic -->
    <div class="user-avatar" title="<?php echo htmlspecialchars($user_name, ENT_QUOTES, 'UTF-8'); ?>">
      <?php 
        // Display initial of user's name
        $initial = function_exists('mb_substr') ? mb_substr($user_name, 0, 1, 'UTF-8') : substr($user_name, 0, 1);
        echo htmlspecialchars(strtoupper($initial), ENT_QUOTES, 'UTF-8'); 
      ?>
    </div>

    <!-- Required Heading: "Hello, [Name]!" -->
    <h1 style="font-size: clamp(1.8rem, 3.5vw, 2.5rem); margin-bottom: 0.75rem;">
      Hello, <span class="gradient-text"><?php echo htmlspecialchars($user_name, ENT_QUOTES, 'UTF-8'); ?></span>!
    </h1>

    <!-- Required: A welcome message -->
    <p style="font-size: 1.1rem; color: var(--text-secondary); max-width: 580px; margin: 0 auto 2rem;">
      Welcome to your secure student dashboard! Your credentials have been successfully authenticated and your user state is maintained in server-side memory via PHP sessions.
    </p>

    <!-- Real-time Live Duration Counter -->
    <div style="background: var(--bg-secondary); border: 1px solid var(--border-color); border-radius: var(--radius-lg); padding: 1.25rem; max-width: 400px; margin: 0 auto 2.5rem;">
      <div style="font-size: 0.75rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.25rem;">
        Live Elapsed Session Time
      </div>
      <div id="liveSessionTimer" data-start-time="<?php echo (int)$login_time_epoch; ?>" style="font-family: var(--font-mono); font-size: 1.75rem; font-weight: 700; color: var(--accent-secondary);">
        00m 00s
      </div>
      <div style="font-size: 0.75rem; color: var(--text-muted); margin-top: 0.25rem;">
        Synchronized with server epoch timestamp
      </div>
    </div>

    <!-- Session Diagnostics Table -->
    <div style="margin-bottom: 2.5rem; text-align: left; background: var(--bg-secondary); border: 1px solid var(--border-color); border-radius: var(--radius-md); padding: 1.25rem;">
      <div style="font-size: 0.8125rem; font-weight: 700; text-transform: uppercase; color: var(--text-muted); margin-bottom: 0.75rem; letter-spacing: 0.05em;">
        Active Session Parameters
      </div>
      <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 1rem; font-size: 0.875rem;">
        <div>
          <span style="color: var(--text-muted); display: block;">Session ID (Masked):</span>
          <code style="color: var(--accent-secondary);"><?php echo htmlspecialchars(substr(session_id(), 0, 10) . '...', ENT_QUOTES, 'UTF-8'); ?></code>
        </div>
        <div>
          <span style="color: var(--text-muted); display: block;">Storage Superglobal:</span>
          <code style="color: var(--accent-secondary);">$_SESSION['user_name']</code>
        </div>
        <div>
          <span style="color: var(--text-muted); display: block;">Client Remote Address:</span>
          <code><?php echo htmlspecialchars($_SERVER['REMOTE_ADDR'] ?? '127.0.0.1', ENT_QUOTES, 'UTF-8'); ?></code>
        </div>
      </div>
    </div>

    <!-- Required: Logout Button -->
    <div style="display: flex; justify-content: center; gap: 1rem; flex-wrap: wrap;">
      <a href="logout.php" class="btn btn-danger btn-lg">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
          <polyline points="16 17 21 12 16 7"></polyline>
          <line x1="21" y1="12" x2="9" y2="12"></line>
        </svg>
        <span>Logout &amp; End Session</span>
      </a>

      <a href="../index.php" class="btn btn-secondary btn-lg">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
          <polyline points="9 22 9 12 15 12 15 22"></polyline>
        </svg>
        <span>Back to Portal</span>
      </a>
    </div>
  </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
