<?php
/**
 * Assignment 2 – Display Current Date, Time, and Day
 * Dynamic PHP Temporal Engine & Dashboard
 */

// Retrieve Server Timezone and Current Timestamp
$server_timezone = date_default_timezone_get();
$unix_timestamp = time();

// Requirement 2 & 4: Current date in readable format (e.g. "17 November 2026")
$current_date = date('d F Y', $unix_timestamp);
$iso_date = date('Y-m-d', $unix_timestamp);

// Requirement 2: Current time (12-hour format with AM/PM & seconds)
$current_time = date('h:i:s A', $unix_timestamp);
$military_time = date('H:i:s', $unix_timestamp);

// Requirement 2 & 5: Current day displayed clearly (e.g. "Monday" or "Tuesday")
$current_day = date('l', $unix_timestamp);
$day_of_year = (int)date('z', $unix_timestamp) + 1;
$week_number = date('W', $unix_timestamp);
$is_leap_year = date('L', $unix_timestamp) ? 'Yes' : 'No';
$utc_offset = date('P', $unix_timestamp);

$page_title = 'Assignment 2 – Date, Time & Day Dashboard | PHP Web Applications';
$active_nav = 'assignment2';
$base_path = '../';

require_once __DIR__ . '/../includes/header.php';
?>

<div class="container">
  <!-- Breadcrumb -->
  <nav class="breadcrumb" aria-label="Breadcrumb">
    <a href="../index.php">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
      </svg>
      Home
    </a>
    <span class="breadcrumb-separator">/</span>
    <span class="breadcrumb-current">Assignment 2 &ndash; Date, Time &amp; Day Engine</span>
  </nav>

  <!-- Page Header -->
  <div class="section-header" style="margin-bottom: 2rem;">
    <span class="assignment-badge">Assignment 02</span>
    <h1 style="margin-top: 0.75rem; font-size: clamp(1.8rem, 3.5vw, 2.5rem);">
      Server Date, Time &amp; Day <span class="gradient-text">Dashboard</span>
    </h1>
    <p style="max-width: 600px; margin: 0.5rem auto 0; font-size: 0.95rem;">
      Real-time server clock rendered dynamically through PHP's native <code>date()</code> temporal subsystem.
    </p>
  </div>

  <!-- Requirement 7: Show Server's Configured Timezone Banner -->
  <div class="timezone-banner">
    <div class="timezone-details">
      <div class="card-icon-wrapper" style="width: 2.5rem; height: 2.5rem; border-radius: var(--radius-sm);">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="12" cy="12" r="10"></circle>
          <line x1="2" y1="12" x2="22" y2="12"></line>
          <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
        </svg>
      </div>
      <div>
        <div style="font-size: 0.75rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.05em;">
          Server Configured Timezone
        </div>
        <div style="font-size: 1.05rem; font-weight: 700; color: var(--text-primary); font-family: var(--font-mono);">
          <?php echo htmlspecialchars($server_timezone, ENT_QUOTES, 'UTF-8'); ?>
          <span style="font-size: 0.8125rem; font-weight: 500; color: var(--accent-secondary); margin-left: 0.35rem;">
            (UTC <?php echo htmlspecialchars($utc_offset, ENT_QUOTES, 'UTF-8'); ?>)
          </span>
        </div>
      </div>
    </div>

    <!-- Requirement 6: Refresh Button to Reload Latest PHP-Generated Date & Time -->
    <div style="display: flex; align-items: center; gap: 0.75rem;">
      <a href="index.php?t=<?php echo time(); ?>" class="btn btn-primary" title="Reload fresh PHP timestamp from server">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <polyline points="23 4 23 10 17 10"></polyline>
          <polyline points="1 20 1 14 7 14"></polyline>
          <path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path>
        </svg>
        <span>Refresh Server Time</span>
      </a>
    </div>
  </div>

  <!-- Requirement 3: Three Separate Modern Cards -->
  <div class="clock-grid">
    <!-- Card 1: Current Date -->
    <div class="clock-card date-card">
      <div class="clock-card-icon">
        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
          <line x1="16" y1="2" x2="16" y2="6"></line>
          <line x1="8" y1="2" x2="8" y2="6"></line>
          <line x1="3" y1="10" x2="21" y2="10"></line>
        </svg>
      </div>
      <div class="clock-card-label">Current Date</div>
      <!-- Requirement 4: Format date in readable format, e.g. 17 November 2026 -->
      <div class="clock-card-value gradient-text">
        <?php echo htmlspecialchars($current_date, ENT_QUOTES, 'UTF-8'); ?>
      </div>
      <div class="clock-card-subvalue">
        ISO Format: <code><?php echo htmlspecialchars($iso_date, ENT_QUOTES, 'UTF-8'); ?></code>
      </div>
    </div>

    <!-- Card 2: Current Time -->
    <div class="clock-card time-card">
      <div class="clock-card-icon">
        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="12" cy="12" r="10"></circle>
          <polyline points="12 6 12 12 16 14"></polyline>
        </svg>
      </div>
      <div class="clock-card-label">Current Time</div>
      <div class="clock-card-value" style="color: var(--accent-secondary); font-family: var(--font-mono);">
        <?php echo htmlspecialchars($current_time, ENT_QUOTES, 'UTF-8'); ?>
      </div>
      <div class="clock-card-subvalue">
        24-Hour Military: <code><?php echo htmlspecialchars($military_time, ENT_QUOTES, 'UTF-8'); ?></code>
      </div>
    </div>

    <!-- Card 3: Current Day -->
    <div class="clock-card day-card">
      <div class="clock-card-icon">
        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
        </svg>
      </div>
      <div class="clock-card-label">Current Day</div>
      <!-- Requirement 5: Display day clearly, e.g. Monday or Tuesday -->
      <div class="clock-card-value" style="color: var(--color-success);">
        <?php echo htmlspecialchars($current_day, ENT_QUOTES, 'UTF-8'); ?>
      </div>
      <div class="clock-card-subvalue">
        Day <?php echo (int)$day_of_year; ?> of the Year &bull; Week <?php echo htmlspecialchars($week_number, ENT_QUOTES, 'UTF-8'); ?>
      </div>
    </div>
  </div>

  <!-- Developer Insights: PHP date() Format Reference -->
  <div class="card" style="margin-top: 1rem;">
    <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 0.5rem; margin-bottom: 1.25rem;">
      <div>
        <h3 style="font-size: 1.15rem; margin-bottom: 0.25rem;">PHP Temporal API Diagnostics</h3>
        <p style="font-size: 0.8125rem;">Backend mapping of native <code>date()</code> format parameters to active outputs.</p>
      </div>
      <span class="tag">Unix Epoch: <?php echo $unix_timestamp; ?></span>
    </div>

    <div style="overflow-x: auto;">
      <table class="tech-details-table">
        <thead>
          <tr>
            <th>Parameter / Expression</th>
            <th>PHP Format Specifier</th>
            <th>Computed Output</th>
            <th>Description</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><code>date('d F Y')</code></td>
            <td><code>d</code> (day 2-digit), <code>F</code> (full month), <code>Y</code> (4-digit year)</td>
            <td><strong style="color: var(--text-primary);"><?php echo htmlspecialchars($current_date, ENT_QUOTES, 'UTF-8'); ?></strong></td>
            <td>Human-readable standard calendar date</td>
          </tr>
          <tr>
            <td><code>date('h:i:s A')</code></td>
            <td><code>h</code> (12-hr), <code>i</code> (mins), <code>s</code> (secs), <code>A</code> (AM/PM)</td>
            <td><strong style="color: var(--accent-secondary); font-family: var(--font-mono);"><?php echo htmlspecialchars($current_time, ENT_QUOTES, 'UTF-8'); ?></strong></td>
            <td>Standard 12-hour precision clock</td>
          </tr>
          <tr>
            <td><code>date('l')</code></td>
            <td><code>l</code> (lowercase 'L' for full textual day)</td>
            <td><strong style="color: var(--color-success);"><?php echo htmlspecialchars($current_day, ENT_QUOTES, 'UTF-8'); ?></strong></td>
            <td>Full textual representation of the day</td>
          </tr>
          <tr>
            <td><code>date_default_timezone_get()</code></td>
            <td>Configuration directive / Environment default</td>
            <td><code><?php echo htmlspecialchars($server_timezone, ENT_QUOTES, 'UTF-8'); ?></code></td>
            <td>Configured PHP server timezone offset (<?php echo htmlspecialchars($utc_offset, ENT_QUOTES, 'UTF-8'); ?>)</td>
          </tr>
          <tr>
            <td><code>date('L')</code></td>
            <td><code>L</code> (boolean for leap year)</td>
            <td><code><?php echo $is_leap_year; ?></code></td>
            <td>Leap year calendar indicator</td>
          </tr>
        </tbody>
      </table>
    </div>

    <div style="margin-top: 1.5rem; display: flex; justify-content: flex-end; gap: 0.75rem;">
      <a href="../index.php" class="btn btn-secondary">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
          <polyline points="9 22 9 12 15 12 15 22"></polyline>
        </svg>
        <span>Return to Lab Portal</span>
      </a>
      <a href="index.php?refreshed=1" class="btn btn-primary">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <polyline points="23 4 23 10 17 10"></polyline>
          <polyline points="1 20 1 14 7 14"></polyline>
          <path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path>
        </svg>
        <span>Refresh Timestamp</span>
      </a>
    </div>
  </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
