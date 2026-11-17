<?php
/**
 * Assignment 1 – Session-Based Login and Logout System
 * Login Page
 */

// Initialize PHP Session
session_start();

$page_title = 'Assignment 1 – Session Login | PHP Web Applications';
$active_nav = 'assignment1';
$base_path = '../';

$error_message = '';
$info_message = '';

// Check if user came from an unauthorized attempt or logout
if (isset($_GET['error']) && $_GET['error'] === 'unauthorized') {
    $error_message = 'Access denied. Please start a session with your name first.';
}

// Check for active existing session
$existing_user = $_SESSION['user_name'] ?? null;

// Handle Form Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $raw_name = $_POST['user_name'] ?? '';
    $trimmed_name = trim($raw_name);

    // Validation
    if ($trimmed_name === '') {
        $error_message = 'Please enter your name to proceed.';
    } elseif (strlen($trimmed_name) < 2) {
        $error_message = 'Name must be at least 2 characters long.';
    } elseif (strlen($trimmed_name) > 60) {
        $error_message = 'Name cannot exceed 60 characters.';
    } else {
        // Sanitize & Store into PHP Session
        $_SESSION['user_name'] = $trimmed_name;
        $_SESSION['login_time'] = time();
        $_SESSION['login_time_formatted'] = date('d M Y, h:i:s A');

        // Redirect to personalized welcome page
        header('Location: welcome.php');
        exit;
    }
}

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
    <span class="breadcrumb-current">Assignment 1 &ndash; Session Login</span>
  </nav>

  <!-- Login Card -->
  <div class="card" style="padding: 2.5rem 2rem;">
    <div style="text-align: center; margin-bottom: 2rem;">
      <div class="card-icon-wrapper" style="margin: 0 auto 1rem; width: 3.5rem; height: 3.5rem;">
        <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
          <polyline points="10 17 15 12 10 7"></polyline>
          <line x1="15" y1="12" x2="3" y2="12"></line>
        </svg>
      </div>
      <span class="assignment-badge">Assignment 01</span>
      <h2 style="margin-top: 0.75rem; font-size: 1.75rem;">Session Authentication</h2>
      <p style="margin-top: 0.35rem; font-size: 0.9375rem;">
        Enter your name below to instantiate a persistent server-side PHP session.
      </p>
    </div>

    <!-- Active Session Notice (if already logged in) -->
    <?php if ($existing_user): ?>
      <div class="alert alert-info">
        <div class="alert-icon">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"></circle>
            <line x1="12" y1="16" x2="12" y2="12"></line>
            <line x1="12" y1="8" x2="12.01" y2="8"></line>
          </svg>
        </div>
        <div style="flex: 1;">
          You already have an active session as <strong><?php echo htmlspecialchars($existing_user, ENT_QUOTES, 'UTF-8'); ?></strong>.
          <div style="margin-top: 0.6rem; display: flex; gap: 0.6rem; flex-wrap: wrap;">
            <a href="welcome.php" class="btn btn-primary btn-sm">Resume Welcome Page &rarr;</a>
            <a href="logout.php" class="btn btn-secondary btn-sm">Terminate Session</a>
          </div>
        </div>
      </div>
    <?php endif; ?>

    <!-- Error Alert -->
    <?php if (!empty($error_message)): ?>
      <div class="alert alert-danger" role="alert">
        <div class="alert-icon">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"></circle>
            <line x1="15" y1="9" x2="9" y2="15"></line>
            <line x1="9" y1="9" x2="15" y2="15"></line>
          </svg>
        </div>
        <div><?php echo htmlspecialchars($error_message, ENT_QUOTES, 'UTF-8'); ?></div>
      </div>
    <?php endif; ?>

    <!-- Form -->
    <form action="index.php" method="POST" data-validate novalidate>
      <div class="form-group">
        <label for="userNameInput" class="form-label">
          Full Name <span class="required">*</span>
        </label>
        <div class="input-wrapper">
          <div class="input-icon">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
              <circle cx="12" cy="7" r="4"></circle>
            </svg>
          </div>
          <input 
            type="text" 
            id="userNameInput" 
            name="user_name" 
            class="form-control" 
            placeholder="e.g. Alexander Fleming" 
            value="<?php echo isset($_POST['user_name']) ? htmlspecialchars($_POST['user_name'], ENT_QUOTES, 'UTF-8') : ''; ?>"
            required 
            autofocus
            maxlength="60"
          >
        </div>
        <div class="form-hint">
          Your name will be stored in the <code>$_SESSION</code> superglobal along with the current server timestamp.
        </div>
      </div>

      <div style="margin-top: 2rem;">
        <button type="submit" class="btn btn-primary btn-block btn-lg">
          <span>Start Session &amp; Login</span>
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="5" y1="12" x2="19" y2="12"></line>
            <polyline points="12 5 19 12 12 19"></polyline>
          </svg>
        </button>
      </div>
    </form>
  </div>

  <!-- Technical Note Box -->
  <div style="margin-top: 2rem; background: var(--bg-secondary); border: 1px solid var(--border-color); border-radius: var(--radius-md); padding: 1.25rem;">
    <h4 style="font-size: 0.875rem; margin-bottom: 0.4rem; display: flex; align-items: center; gap: 0.4rem;">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="var(--accent-secondary)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <circle cx="12" cy="12" r="10"></circle>
        <line x1="12" y1="16" x2="12" y2="12"></line>
        <line x1="12" y1="8" x2="12.01" y2="8"></line>
      </svg>
      PHP Session Mechanism
    </h4>
    <p style="font-size: 0.8125rem; color: var(--text-muted);">
      Upon form submission, <code>session_start()</code> generates a cryptographically random session identifier sent to the browser via the <code>PHPSESSID</code> cookie. The user's name and login epoch timestamp are stored in server memory.
    </p>
  </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
