<?php
/**
 * Assignment 1 – Session-Based Login and Logout System
 * Logout Page & Session Invalidation
 */

session_start();

// Check if an active session exists to calculate duration
$has_session_data = isset($_SESSION['user_name']) && isset($_SESSION['login_time']);

if ($has_session_data) {
    // 1. Capture session details before destruction
    $user_name = $_SESSION['user_name'];
    $login_time = $_SESSION['login_time'];
    $logout_time = time();

    // 2. Calculate Total Session Duration
    $duration_seconds = max(0, $logout_time - $login_time);

    $login_formatted = date('d M Y, h:i:s A', $login_time);
    $logout_formatted = date('d M Y, h:i:s A', $logout_time);

    // Format duration into readable text
    $hours = floor($duration_seconds / 3600);
    $minutes = floor(($duration_seconds % 3600) / 60);
    $seconds = $duration_seconds % 60;

    $duration_parts = [];
    if ($hours > 0) {
        $duration_parts[] = $hours . ' hour' . ($hours > 1 ? 's' : '');
    }
    if ($minutes > 0) {
        $duration_parts[] = $minutes . ' minute' . ($minutes > 1 ? 's' : '');
    }
    $duration_parts[] = $seconds . ' second' . ($seconds !== 1 ? 's' : '');

    $duration_readable = implode(', ', $duration_parts);

    // 3. Properly Destroy PHP Session
    $_SESSION = [];

    // Clear session cookie from client browser
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]
        );
    }

    // Terminate server session record
    session_destroy();
} else {
    // Fallback if accessed after session was already destroyed
    $user_name = 'Student';
    $login_formatted = 'Session expired';
    $logout_formatted = date('d M Y, h:i:s A');
    $duration_readable = 'Not available (session terminated)';
    $duration_seconds = 0;
}

$page_title = 'Session Terminated | Assignment 1';
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
    <span class="breadcrumb-current">Logout Summary</span>
  </nav>

  <!-- Logout Summary Card -->
  <div class="receipt-card">
    <div class="receipt-icon">
      <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
        <polyline points="22 4 12 14.01 9 11.01"></polyline>
      </svg>
    </div>

    <!-- Required: "Thank You, [Name]!" -->
    <h2 style="font-size: clamp(1.6rem, 3vw, 2.2rem); margin-bottom: 0.5rem;">
      Thank You, <span class="gradient-text"><?php echo htmlspecialchars($user_name, ENT_QUOTES, 'UTF-8'); ?></span>!
    </h2>

    <p style="color: var(--text-secondary); font-size: 0.9375rem; margin-bottom: 2rem;">
      Your session has been securely closed and all memory handles have been cleared from the PHP runtime.
    </p>

    <!-- Session Usage Metrics Table -->
    <table class="receipt-table" aria-label="Session Duration Metrics">
      <tbody>
        <tr>
          <td>
            <span style="display: flex; align-items: center; gap: 0.5rem; color: var(--text-secondary);">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <polyline points="12 6 12 12 16 14"></polyline>
              </svg>
              Login Timestamp
            </span>
          </td>
          <td><?php echo htmlspecialchars($login_formatted, ENT_QUOTES, 'UTF-8'); ?></td>
        </tr>
        <tr>
          <td>
            <span style="display: flex; align-items: center; gap: 0.5rem; color: var(--text-secondary);">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                <polyline points="16 17 21 12 16 7"></polyline>
                <line x1="21" y1="12" x2="9" y2="12"></line>
              </svg>
              Logout Timestamp
            </span>
          </td>
          <td><?php echo htmlspecialchars($logout_formatted, ENT_QUOTES, 'UTF-8'); ?></td>
        </tr>
        <tr>
          <td>
            <span style="display: flex; align-items: center; gap: 0.5rem; color: var(--text-secondary);">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <polyline points="12 6 12 12 8 14"></polyline>
              </svg>
              Total Usage Duration
            </span>
          </td>
          <td class="duration-highlight">
            <?php echo htmlspecialchars($duration_readable, ENT_QUOTES, 'UTF-8'); ?>
            <span style="display: block; font-size: 0.75rem; font-weight: normal; color: var(--text-muted);">
              (<?php echo (int)$duration_seconds; ?> total elapsed seconds)
            </span>
          </td>
        </tr>
        <tr>
          <td>
            <span style="display: flex; align-items: center; gap: 0.5rem; color: var(--text-secondary);">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
              </svg>
              Session State
            </span>
          </td>
          <td>
            <span class="tag" style="background: var(--color-danger-bg); color: var(--color-danger); border-color: var(--color-danger-border);">
              DESTROYED &bull; NULLIFIED
            </span>
          </td>
        </tr>
      </tbody>
    </table>

    <!-- Action Buttons -->
    <div style="display: flex; justify-content: center; gap: 1rem; flex-wrap: wrap;">
      <!-- Required: Return to Home Page button -->
      <a href="../index.php" class="btn btn-primary btn-lg">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
          <polyline points="9 22 9 12 15 12 15 22"></polyline>
        </svg>
        <span>Return to Home Page</span>
      </a>

      <a href="index.php" class="btn btn-secondary btn-lg">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
          <polyline points="10 17 15 12 10 7"></polyline>
          <line x1="15" y1="12" x2="3" y2="12"></line>
        </svg>
        <span>Login Again</span>
      </a>
    </div>
  </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
