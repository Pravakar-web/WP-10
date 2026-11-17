<?php
/**
 * Assignment 3 – Age-Based Website Authorization
 * Input Form (POST Submission)
 */

$page_title = 'Assignment 3 – Age-Based Authorization Form | PHP Web Applications';
$active_nav = 'assignment3';
$base_path = '../';

$error_param = $_GET['error'] ?? null;
$error_message = '';

if ($error_param === 'empty_name') {
    $error_message = 'Please provide a valid name.';
} elseif ($error_param === 'invalid_age') {
    $error_message = 'Please enter a valid non-negative integer for age.';
} elseif ($error_param === 'missing_data') {
    $error_message = 'Both Name and Age fields are required.';
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
    <span class="breadcrumb-current">Assignment 3 &ndash; Age Authorization</span>
  </nav>

  <!-- Authorization Form Card -->
  <div class="card" style="padding: 2.5rem 2rem;">
    <div style="text-align: center; margin-bottom: 2rem;">
      <div class="card-icon-wrapper" style="margin: 0 auto 1rem; width: 3.5rem; height: 3.5rem;">
        <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
        </svg>
      </div>
      <span class="assignment-badge">Assignment 03</span>
      <h2 style="margin-top: 0.75rem; font-size: 1.75rem;">Age Verification Portal</h2>
      <p style="margin-top: 0.35rem; font-size: 0.9375rem;">
        Submit your credentials using HTTP POST to evaluate age authorization clearance.
      </p>
    </div>

    <!-- Error Notice if redirected from result.php -->
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

    <!-- Requirement 1 & 2: HTML Form with Name, Age, and Submit sent via POST to result.php -->
    <form action="result.php" method="POST" data-validate novalidate>
      <!-- Name Field -->
      <div class="form-group">
        <label for="nameInput" class="form-label">
          Applicant Name <span class="required">*</span>
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
            id="nameInput" 
            name="user_name" 
            class="form-control" 
            placeholder="e.g. John Doe" 
            required 
            autofocus
            maxlength="60"
          >
        </div>
        <div class="form-hint">Name must not be empty.</div>
      </div>

      <!-- Age Field -->
      <div class="form-group">
        <label for="ageInput" class="form-label">
          Age (Years) <span class="required">*</span>
        </label>
        <div class="input-wrapper">
          <div class="input-icon">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
              <line x1="16" y1="2" x2="16" y2="6"></line>
              <line x1="8" y1="2" x2="8" y2="6"></line>
              <line x1="3" y1="10" x2="21" y2="10"></line>
            </svg>
          </div>
          <input 
            type="number" 
            id="ageInput" 
            name="user_age" 
            class="form-control" 
            placeholder="e.g. 21" 
            required 
            min="0" 
            max="125"
            step="1"
          >
        </div>
        <div class="form-hint">Must be a non-negative integer (Threshold: 18 years).</div>
      </div>

      <!-- Quick Preset Demo Buttons (Useful for quick live presentation testing) -->
      <div style="margin: 1.25rem 0; padding: 0.75rem 1rem; background: var(--bg-secondary); border: 1px solid var(--border-color); border-radius: var(--radius-sm); display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 0.5rem;">
        <span style="font-size: 0.8125rem; color: var(--text-muted); font-weight: 500;">
          Presentation Quick Fill:
        </span>
        <div style="display: flex; gap: 0.5rem;">
          <button type="button" class="btn btn-secondary btn-sm" onclick="document.getElementById('nameInput').value='Alex Miller'; document.getElementById('ageInput').value='16';">
            Minor (Age 16)
          </button>
          <button type="button" class="btn btn-secondary btn-sm" onclick="document.getElementById('nameInput').value='Sophia Turner'; document.getElementById('ageInput').value='24';">
            Adult (Age 24)
          </button>
        </div>
      </div>

      <!-- Submit Button -->
      <div style="margin-top: 1.75rem;">
        <button type="submit" class="btn btn-primary btn-block btn-lg">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="9 11 12 14 22 4"></polyline>
            <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
          </svg>
          <span>Verify Authorization</span>
        </button>
      </div>
    </form>
  </div>

  <!-- Policy Criteria Specification -->
  <div style="margin-top: 2rem; background: var(--bg-secondary); border: 1px solid var(--border-color); border-radius: var(--radius-md); padding: 1.25rem;">
    <h4 style="font-size: 0.875rem; margin-bottom: 0.5rem; display: flex; align-items: center; gap: 0.4rem;">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="var(--accent-secondary)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <circle cx="12" cy="12" r="10"></circle>
        <line x1="12" y1="16" x2="12" y2="12"></line>
        <line x1="12" y1="8" x2="12.01" y2="8"></line>
      </svg>
      Business Logic Criteria
    </h4>
    <div style="display: flex; flex-direction: column; gap: 0.4rem; font-size: 0.8125rem; color: var(--text-muted);">
      <div>&bull; <code>Age &lt; 18</code> &rarr; <span style="color: var(--color-danger);">"Hello, [Name], you are not authorized to visit the site."</span></div>
      <div>&bull; <code>Age &gt;= 18</code> &rarr; <span style="color: var(--color-success);">"Welcome to this site, [Name]!"</span></div>
    </div>
  </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
