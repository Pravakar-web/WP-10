<?php
/**
 * Assignment 3 – Age-Based Website Authorization
 * Result & Verification Engine
 */

$page_title = 'Authorization Decision | Assignment 3';
$active_nav = 'assignment3';
$base_path = '../';

// Determine if request was submitted via HTTP POST
$is_post = ($_SERVER['REQUEST_METHOD'] === 'POST');

$errors = [];
$name = '';
$age = null;
$is_authorized = false;

if ($is_post) {
    // 1. Extract & Sanitize Name
    $raw_name = $_POST['user_name'] ?? '';
    $name = trim($raw_name);

    if ($name === '') {
        $errors[] = 'Applicant Name is required and cannot be empty.';
    } elseif (strlen($name) < 2) {
        $errors[] = 'Applicant Name must contain at least 2 characters.';
    }

    // 2. Extract & Validate Age (Must be a valid non-negative integer)
    $raw_age = $_POST['user_age'] ?? '';
    
    // Check if integer
    if ($raw_age === '' || filter_var($raw_age, FILTER_VALIDATE_INT) === false) {
        $errors[] = 'Age must be a valid whole number (integer).';
    } else {
        $age_val = (int)$raw_age;
        if ($age_val < 0) {
            $errors[] = 'Age cannot be a negative value.';
        } elseif ($age_val > 130) {
            $errors[] = 'Please provide a realistic age value (0 - 130).';
        } else {
            $age = $age_val;
        }
    }

    // 3. Implement Authorization Condition
    if (empty($errors)) {
        // Requirement 4: Age < 18 unauthorized, Age >= 18 authorized
        $is_authorized = ($age >= 18);
    }
} else {
    // Direct GET access without form submission
    $errors[] = 'No verification data received. Please submit the authorization form.';
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
    <a href="index.php">Assignment 3</a>
    <span class="breadcrumb-separator">/</span>
    <span class="breadcrumb-current">Verification Result</span>
  </nav>

  <?php if (!empty($errors)): ?>
    <!-- Validation Errors Card -->
    <div class="card" style="padding: 2.5rem 2rem; text-align: center;">
      <div class="receipt-icon" style="background: var(--color-danger-bg); border-color: var(--color-danger-border); color: var(--color-danger);">
        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="12" cy="12" r="10"></circle>
          <line x1="12" y1="8" x2="12" y2="12"></line>
          <line x1="12" y1="16" x2="12.01" y2="16"></line>
        </svg>
      </div>

      <h2 style="font-size: 1.6rem; margin-bottom: 0.75rem;">Input Validation Failed</h2>
      <p style="color: var(--text-secondary); margin-bottom: 1.5rem;">
        The submitted parameters could not be processed due to the following validation constraints:
      </p>

      <div style="background: var(--bg-secondary); border: 1px solid var(--border-color); border-radius: var(--radius-md); padding: 1.25rem; text-align: left; margin-bottom: 2rem;">
        <ul style="color: var(--color-danger); padding-left: 1.25rem; display: flex; flex-direction: column; gap: 0.4rem; font-size: 0.9375rem;">
          <?php foreach ($errors as $err): ?>
            <li><?php echo htmlspecialchars($err, ENT_QUOTES, 'UTF-8'); ?></li>
          <?php endforeach; ?>
        </ul>
      </div>

      <div>
        <a href="index.php" class="btn btn-primary btn-lg">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="15 18 9 12 15 6"></polyline>
          </svg>
          <span>Return &amp; Try Again</span>
        </a>
      </div>
    </div>

  <?php else: ?>
    <!-- Requirement 5: Display Result on Beautifully Designed Result Page -->
    <div class="auth-result-card <?php echo $is_authorized ? 'authorized' : 'unauthorized'; ?>">
      
      <!-- Requirement 6: Icons & Visual Indicators for Both Outcomes -->
      <?php if ($is_authorized): ?>
        <!-- Authorized Badge & Icon -->
        <div class="auth-status-badge">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="20 6 9 17 4 12"></polyline>
          </svg>
          <span>Authorized &bull; Clearance Level 18+</span>
        </div>

        <div class="auth-icon-circle">
          <svg width="44" height="44" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
            <polyline points="9 12 11 14 15 10"></polyline>
          </svg>
        </div>

        <!-- Requirement 4: "Welcome to this site, [Name]!" -->
        <h1 class="auth-message-primary">
          Welcome to this site, <?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?>!
        </h1>

        <p class="auth-message-detail">
          Access clearance granted. Your age (<?php echo (int)$age; ?> years old) meets the required threshold of 18 or above. You may proceed to explore the platform.
        </p>

      <?php else: ?>
        <!-- Unauthorized Badge & Icon -->
        <div class="auth-status-badge">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"></circle>
            <line x1="4.93" y1="4.93" x2="19.07" y2="19.07"></line>
          </svg>
          <span>Access Denied &bull; Under Minimum Age</span>
        </div>

        <div class="auth-icon-circle">
          <svg width="44" height="44" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
          </svg>
        </div>

        <!-- Requirement 4: "Hello, [Name], you are not authorized to visit the site." -->
        <h1 class="auth-message-primary">
          Hello, <?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?>, you are not authorized to visit the site.
        </h1>

        <p class="auth-message-detail">
          Access restricted. The security policy strictly enforces a minimum age of 18 years. At <?php echo (int)$age; ?> years of age, you do not meet the minimum requirement.
        </p>
      <?php endif; ?>

      <!-- Evaluation Parameter Breakdown -->
      <div class="auth-meta-box">
        <div>
          <div class="auth-meta-item-label">Applicant Name</div>
          <div class="auth-meta-item-val"><?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?></div>
        </div>
        <div>
          <div class="auth-meta-item-label">Submitted Age</div>
          <div class="auth-meta-item-val"><?php echo (int)$age; ?> years old</div>
        </div>
        <div>
          <div class="auth-meta-item-label">Threshold Policy</div>
          <div class="auth-meta-item-val">&ge; 18 Years</div>
        </div>
        <div>
          <div class="auth-meta-item-label">Evaluation Result</div>
          <div class="auth-meta-item-val" style="color: <?php echo $is_authorized ? 'var(--color-success)' : 'var(--color-danger)'; ?>;">
            <?php echo $is_authorized ? 'ACCESS GRANTED' : 'ACCESS DENIED'; ?>
          </div>
        </div>
      </div>

      <!-- Requirement 7: Button to Return to the Form and Try Again -->
      <div style="display: flex; justify-content: center; gap: 1rem; flex-wrap: wrap;">
        <a href="index.php" class="btn btn-primary btn-lg">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="1 4 1 10 7 10"></polyline>
            <path d="M3.51 15a9 9 0 1 0 2.13-9.36L1 10"></path>
          </svg>
          <span>Try Again / Test Another Age</span>
        </a>

        <a href="../index.php" class="btn btn-secondary btn-lg">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
            <polyline points="9 22 9 12 15 12 15 22"></polyline>
          </svg>
          <span>Return to Lab Portal</span>
        </a>
      </div>
    </div>
  <?php endif; ?>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
