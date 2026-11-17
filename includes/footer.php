<?php
/**
 * PHP Web Applications – Practical Lab
 * Shared Footer Component
 */

if (!isset($base_path)) {
    $base_path = './';
}
?>
  </main>

  <!-- Global Footer -->
  <footer class="footer" role="contentinfo">
    <div class="container">
      <div class="footer-grid">
        <div class="footer-col">
          <div class="nav-brand footer-brand">
            <div class="nav-logo-icon" style="width: 1.8rem; height: 1.8rem;">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="16 18 22 12 16 6"></polyline>
                <polyline points="8 6 2 12 8 18"></polyline>
              </svg>
            </div>
            <span>PHP Web Applications</span>
          </div>
          <p style="margin-bottom: 1rem; max-width: 420px;">
            A responsive, modern engineering showcase demonstrating core PHP paradigms: session state lifecycles, temporal functions, and rule-based authorization workflows.
          </p>
          <div class="footer-badges">
            <span class="tag">PHP <?php echo PHP_VERSION; ?></span>
            <span class="tag">Vanilla JS</span>
            <span class="tag">CSS3 Custom Tokens</span>
            <span class="tag">HTML5 Semantic</span>
          </div>
        </div>

        <div class="footer-col">
          <h5>Lab Modules</h5>
          <ul class="footer-links">
            <li><a href="<?php echo $base_path; ?>assignment1/index.php">Lab 1: Session Login & Logout</a></li>
            <li><a href="<?php echo $base_path; ?>assignment2/index.php">Lab 2: Date, Time & Day Engine</a></li>
            <li><a href="<?php echo $base_path; ?>assignment3/index.php">Lab 3: Age-Based Authorization</a></li>
          </ul>
        </div>

        <div class="footer-col">
          <h5>System Diagnostics</h5>
          <ul class="footer-links" style="font-family: var(--font-mono); font-size: 0.8125rem;">
            <li>Server Timezone: <strong><?php echo htmlspecialchars(date_default_timezone_get(), ENT_QUOTES, 'UTF-8'); ?></strong></li>
            <li>Protocol: <strong>HTTP/<?php echo isset($_SERVER['SERVER_PROTOCOL']) ? htmlspecialchars($_SERVER['SERVER_PROTOCOL'], ENT_QUOTES, 'UTF-8') : '1.1'; ?></strong></li>
            <li>Interface: <strong><?php echo htmlspecialchars(php_sapi_name(), ENT_QUOTES, 'UTF-8'); ?></strong></li>
            <li><a href="#about" data-open-about style="color: var(--accent-primary);">View Architecture Docs &rarr;</a></li>
          </ul>
        </div>
      </div>

      <div class="footer-bottom">
        <div>
          &copy; <?php echo date('Y'); ?> PHP Web Applications Practical Lab. Built for academic excellence & production presentation.
        </div>
        <div>
          Compatible with PHP 8.1+ &bull; Ready for Cloud Hosting
        </div>
      </div>
    </div>
  </footer>

  <!-- About System Modal -->
  <div id="aboutModal" class="modal-overlay" role="dialog" aria-modal="true" aria-labelledby="modalTitle">
    <div class="modal-dialog">
      <button id="closeAboutModal" class="modal-close" type="button" aria-label="Close modal">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <line x1="18" y1="6" x2="6" y2="18"></line>
          <line x1="6" y1="6" x2="18" y2="18"></line>
        </svg>
      </button>

      <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1rem;">
        <div class="nav-logo-icon" style="width: 2.2rem; height: 2.2rem;">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"></circle>
            <line x1="12" y1="16" x2="12" y2="12"></line>
            <line x1="12" y1="8" x2="12.01" y2="8"></line>
          </svg>
        </div>
        <div>
          <h3 id="modalTitle" style="font-size: 1.25rem; margin: 0;">Project Architecture & Overview</h3>
          <span style="font-size: 0.8125rem; color: var(--text-muted);">PHP Web Applications – Practical Lab</span>
        </div>
      </div>

      <div style="margin-bottom: 1.5rem; font-size: 0.9375rem; line-height: 1.6; color: var(--text-secondary);">
        <p style="margin-bottom: 1rem;">
          This practical project consolidates three core web programming assignments into a unified, technology-inspired dashboard with production-grade engineering principles:
        </p>

        <ul style="padding-left: 1.25rem; margin-bottom: 1.25rem; display: flex; flex-direction: column; gap: 0.6rem;">
          <li>
            <strong style="color: var(--text-primary);">Assignment 1:</strong> Demonstrates persistent server-side state using native PHP session superglobals (<code>$_SESSION</code>), calculating precise session duration down to the second, and handling secure session invalidation.
          </li>
          <li>
            <strong style="color: var(--text-primary);">Assignment 2:</strong> Leverages PHP temporal APIs (<code>date()</code>, <code>date_default_timezone_get()</code>) to dynamically render formatted dates, times, days of week, and astronomical/calendar metadata.
          </li>
          <li>
            <strong style="color: var(--text-primary);">Assignment 3:</strong> Implements secure HTTP POST parameter handling, sanitization (<code>trim</code>, <code>htmlspecialchars</code>), integer verification with filters, and conditional business logic for website gatekeeping.
          </li>
        </ul>

        <h4 style="font-size: 1rem; color: var(--text-primary); margin-bottom: 0.5rem;">Hosting & Execution Note</h4>
        <p style="font-size: 0.875rem;">
          PHP requires a server-side execution runtime (such as Apache, Nginx with PHP-FPM, or the built-in development server <code>php -S localhost:8000</code>). GitHub Pages only serves static HTML/CSS/JS and does not execute PHP scripts. For live cloud deployment, services such as Render, Railway, Heroku, or standard PHP hosting providers (cPanel / InfinityFree / Shared Hosting) are recommended.
        </p>
      </div>

      <div style="text-align: right;">
        <button type="button" class="btn btn-secondary btn-sm" onclick="document.getElementById('aboutModal').classList.remove('active'); document.body.style.overflow = '';">
          Close Overview
        </button>
      </div>
    </div>
  </div>

  <!-- JavaScript Bundle -->
  <script src="<?php echo $base_path; ?>assets/js/script.js"></script>
</body>
</html>
