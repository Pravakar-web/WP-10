# PHP Web Applications – Practical Lab Suite

[![PHP Version](https://img.shields.io/badge/PHP-8.1%20%7C%208.2%20%7C%208.3-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net/)
[![License](https://img.shields.io/badge/License-MIT-blue.svg?style=for-the-badge)](LICENSE)
[![Interface](https://img.shields.io/badge/UI-Dark%20%2F%20Light%20Modern-6366F1?style=for-the-badge)](assets/css/style.css)
[![Responsive](https://img.shields.io/badge/Design-Mobile%20First%20Responsive-10B981?style=for-the-badge)](assets/css/style.css)

A modern, technology-inspired PHP web application suite consolidating three core laboratory assignments into a unified, developer-grade portal. Engineered with pure native PHP (no bulky external framework dependencies), semantic HTML5, modern CSS3 variables with dark/light themes, and vanilla JavaScript.

---

## 📑 Table of Contents

- [Project Overview](#-project-overview)
- [Key Features & Design Philosophy](#-key-features--design-philosophy)
- [Laboratory Assignments](#-laboratory-assignments)
  - [Assignment 1: Session-Based Login and Logout](#1-assignment-1--session-based-login-and-logout-system)
  - [Assignment 2: Date, Time, and Day Engine](#2-assignment-2--display-current-date-time-and-day)
  - [Assignment 3: Age-Based Website Authorization](#3-assignment-3--age-based-website-authorization)
- [Project Folder Structure](#-project-folder-structure)
- [Local Setup & Development Guide](#-local-setup--development-guide)
- [Important Hosting & Deployment Guide](#-important-hosting--deployment-guide)
- [Testing & Quality Verification](#-testing--quality-verification)
- [Security & Engineering Practices](#-security--engineering-practices)

---

## 🚀 Project Overview

The **PHP Web Applications – Practical Lab** is designed to demonstrate key server-side programming concepts in a polished, real-world user interface rather than a basic academic exercise.

The project features a sleek, technology-inspired central dashboard (`index.php`) offering navigation across three autonomous modules:
1. **State Persistence**: Managing user identity and tracking usage duration using server sessions.
2. **Temporal Systems**: Generating and formatting dynamic calendar, time, and timezone information.
3. **Authorization & Gatekeeping**: Validating user input and enforcing access control rules via HTTP POST.

---

## 🎨 Key Features & Design Philosophy

- **Modern Glassmorphic & Cyber-Inspired Theme**: Custom dark mode by default with glowing accent gradients, glass backdrop filters, and subtle border radius tokens.
- **Dual Theme Support**: Interactive Dark/Light mode toggle switch in the navigation bar with instant `localStorage` persistence.
- **Pure Native Stack**: Zero external JavaScript or CSS libraries (No Bootstrap, No jQuery, No Tailwind). 100% vanilla CSS custom properties and lightweight vanilla JS.
- **Clean Responsive Layout**: Fluid Flexbox and CSS Grid architecture adapting seamlessly to desktops, tablets, and smartphones.
- **Relative Portability**: Built with strictly relative directory paths. Runs out of the box in subfolders or domain roots without hardcoded localhost URLs.

---

## 🧪 Laboratory Assignments

### 1. Assignment 1 – Session-Based Login and Logout System
* **Objective:** Capture user identity, maintain persistent state across requests, monitor session lifespan, and securely wipe server memory upon exit.
* **Key Implementation Details:**
  - `session_start()` initializes a session context and assigns a secure `PHPSESSID`.
  - Captures `$_POST['user_name']` and stores it alongside the login timestamp (`time()`) in `$_SESSION`.
  - **Protected Welcome Page (`welcome.php`)**:
    - Gatekept: Unauthorized direct requests without an active session are intercepted and redirected to `index.php?error=unauthorized`.
    - Displays personalized header: `Hello, [Name]!`
    - Displays session start time prominently at the top-right corner.
    - Features a live elapsed session ticker synchronized with server epoch time.
  - **Secure Logout Engine (`logout.php`)**:
    - Calculates total elapsed session duration: `$duration = $logout_time - $login_time`.
    - Displays a receipt card with `"Thank You, [Name]!"`, formatted login time, logout time, and human-readable duration (hours, minutes, seconds).
    - Nullifies `$_SESSION`, clears the client cookie, and executes `session_destroy()`.

### 2. Assignment 2 – Display Current Date, Time, and Day
* **Objective:** Leverage PHP's built-in `date()` function and timezone subsystems to render dynamic temporal telemetry.
* **Key Implementation Details:**
  - Three distinct, modern gradient cards:
    - **Current Date Card**: Formatted as `date('d F Y')` (e.g., `17 November 2026`). Also displays ISO-8601 formatting.
    - **Current Time Card**: Formatted as `date('h:i:s A')` (12-hour clock with AM/PM & seconds) alongside 24-hour military clock.
    - **Current Day Card**: Formatted as `date('l')` (e.g., `Monday` or `Tuesday`) alongside day-of-year and calendar week.
  - **Server Timezone Indicator**: Displays active server timezone retrieved via `date_default_timezone_get()` and UTC offset (`date('P')`).
  - **Instant Refresh Action**: Interactive refresh button triggering dynamic server timestamp recalculation.

### 3. Assignment 3 – Age-Based Website Authorization
* **Objective:** Implement an age gatekeeper validating user input via HTTP POST and branching access clearance.
* **Key Implementation Details:**
  - HTML form accepting Applicant Name and numerical Age.
  - Strict server-side validation:
    - Verifies name is non-empty and sanitized.
    - Validates age is a non-negative integer using `filter_var($age, FILTER_VALIDATE_INT)`.
  - **Conditional Access Logic**:
    - If `Age < 18`: Displays `"Hello, [Name], you are not authorized to visit the site."` with access-denied shield badge and red ambient theme.
    - If `Age >= 18`: Displays `"Welcome to this site, [Name]!"` with verified authorization shield and emerald green ambient theme.
  - Form presets enabling 1-click evaluation of both outcomes during live presentations.
  - Button to return to the form and re-test with different values.

---

## 📂 Project Folder Structure

```
WP-LAB-10/
│
├── index.php                 # Master Portal & Landing Page
├── README.md                 # Complete Project & Deployment Documentation
├── .gitignore                # Git Exclusions for OS & Runtime Files
│
├── assets/
│   ├── css/
│   │   └── style.css         # Modern Design System (Dark/Light tokens, Grid, UI)
│   ├── js/
│   │   └── script.js         # Theme Switcher, Mobile Nav, Live Session Timer
│   └── images/
│       └── favicon.svg       # SVG Logo / Favicon
│
├── includes/
│   ├── header.php            # Shared Responsive Navbar, Brand & Header
│   └── footer.php            # Shared Diagnostics, Modal Dialog & Footer
│
├── assignment1/              # Session-Based Login & Duration Tracking
│   ├── index.php             # Session Initiation & Input Form
│   ├── welcome.php           # Protected Dashboard (Session Start at Top-Right)
│   └── logout.php            # Session Duration Calc & Secure Destruction
│
├── assignment2/              # Dynamic Temporal & Timezone Engine
│   └── index.php             # 3 Modern Cards (Date, Time, Day) & Refresh
│
└── assignment3/              # Age-Based Website Authorization
    ├── index.php             # POST Input Form & Presentation Presets
    └── result.php            # Access Clearance Decision & Visual Indicators
```

---

## 💻 Local Setup & Development Guide

### Prerequisites
- **PHP 8.1, 8.2, 8.3, or later** installed on your system.
- Terminal / Command Prompt / PowerShell.

### Method 1: Using PHP's Built-In Development Server (Fastest & Recommended)
1. Clone or extract this repository into your working folder:
   ```bash
   cd WP-LAB-10
   ```
2. Start the built-in PHP web server:
   ```bash
   php -S localhost:8000
   ```
3. Open your web browser and navigate to:
   ```
   http://localhost:8000
   ```

### Method 2: Using XAMPP / WampServer / LAMP / MAMP
1. Copy or clone the `WP-LAB-10` folder into your web server's root directory:
   - **XAMPP (Windows)**: `C:\xampp\htdocs\WP-LAB-10`
   - **MAMP (macOS)**: `/Applications/MAMP/htdocs/WP-LAB-10`
   - **Linux (Apache)**: `/var/www/html/WP-LAB-10`
2. Start the Apache module from your control panel.
3. Open your browser and navigate to:
   ```
   http://localhost/WP-LAB-10
   ```

---

## 🌐 Important Hosting & Deployment Guide

> [!WARNING]
> **CRITICAL DEPLOYMENT NOTE ON GITHUB PAGES:**
> GitHub Pages **ONLY** hosts static files (HTML, CSS, client JS, images). It **DOES NOT** have a PHP interpreter and cannot execute PHP scripts.
> If you upload PHP files to GitHub Pages, the server will either display the raw source code or serve 404/download prompts.
> 
> **The GitHub repository should contain the full PHP source code for version control, code review, and presentation evaluation.** For live interactive deployment, use any of the PHP-supported hosting platforms detailed below.

### Free & Cloud PHP Hosting Options

#### Option A: Deploy to Render (Recommended Free Cloud Hosting)
1. Push this repository to your GitHub account.
2. Sign in to [Render.com](https://render.com).
3. Click **New +** &rarr; **Web Service**.
4. Connect your GitHub repository.
5. In the service settings:
   - **Environment:** `PHP` or `Docker`
   - **Build Command:** *(Leave blank)*
   - **Start Command:** `php -S 0.0.0.0:$PORT`
6. Click **Create Web Service**. Your application is live with free SSL!

#### Option B: Deploy to Railway
1. Sign in to [Railway.app](https://railway.app).
2. Click **New Project** &rarr; **Deploy from GitHub repo**.
3. Select this repository. Railway automatically detects PHP and starts the web service.

#### Option C: Free Shared Web Hosting (InfinityFree / 000webhost / AwardSpace)
1. Sign up for a free PHP hosting account (e.g., [InfinityFree](https://www.infinityfree.net/)).
2. Connect to the server via the Web File Manager or FTP (FileZilla).
3. Upload all files into the `htdocs/` or `public_html/` folder.
4. Access your live website URL immediately.

---

## 🔍 Testing & Quality Verification Checklist

### Automated Test Suite Execution
An automated test runner (`test_suite.php`) is provided to verify all 27 core criteria and assertions end-to-end:

```bash
# Start your local server in one terminal
php -S localhost:8000

# Run the automated verification suite in another terminal (defaults to port 8000)
php test_suite.php
# Or specify a custom port: php test_suite.php 8080
```

### Verification Checklist Table

| Test Item | Expected Result | Verified Status |
| :--- | :--- | :---: |
| **Assignment 1: Empty Name Submission** | Displays friendly error: *"Please enter your name to proceed."* | ✅ Pass |
| **Assignment 1: Valid Session Creation** | Stores name and timestamp in `$_SESSION`, redirects to `welcome.php`. | ✅ Pass |
| **Assignment 1: Direct Access Protection** | Navigating to `welcome.php` without active session redirects to `index.php`. | ✅ Pass |
| **Assignment 1: Session Start Time** | Visible in top-right status bar as required. | ✅ Pass |
| **Assignment 1: Session Duration Calc** | Computes exact difference (`$logout_time - $login_time`) in readable format. | ✅ Pass |
| **Assignment 1: Session Destruction** | Wipes `$_SESSION`, clears cookie, and terminates server session. | ✅ Pass |
| **Assignment 2: Date Formatting** | Renders exact format `17 November 2026` via `date('d F Y')`. | ✅ Pass |
| **Assignment 2: Time Formatting** | Renders 12-hour time with AM/PM (`date('h:i:s A')`). | ✅ Pass |
| **Assignment 2: Day Formatting** | Renders full weekday name clearly (`date('l')`). | ✅ Pass |
| **Assignment 2: Refresh Action** | Reloads current page and updates timestamp dynamically. | ✅ Pass |
| **Assignment 2: Server Timezone** | Displays configured timezone via `date_default_timezone_get()`. | ✅ Pass |
| **Assignment 3: Form Submission** | Sends name & age via HTTP POST to `result.php`. | ✅ Pass |
| **Assignment 3: Age < 18 Condition** | Renders *"Hello, [Name], you are not authorized to visit the site."* + red badge. | ✅ Pass |
| **Assignment 3: Age >= 18 Condition** | Renders *"Welcome to this site, [Name]!"* + green badge. | ✅ Pass |
| **Assignment 3: Input Validation** | Traps non-integer or negative ages with descriptive error screen. | ✅ Pass |
| **Navigation & Links** | All relative navigation links work seamlessly across subdirectories. | ✅ Pass |
| **Dark / Light Theme** | Smooth toggle switch functioning on all pages with local persistence. | ✅ Pass |

---

## 🛡️ Security & Engineering Practices

1. **XSS Prevention**: Every user-supplied variable rendered in the HTML DOM is escaped through `htmlspecialchars($var, ENT_QUOTES, 'UTF-8')`.
2. **Type Safety & Filter Superglobals**: Numerical parameters are verified using PHP's native `filter_var(..., FILTER_VALIDATE_INT)` rather than loose regex or blind typecasting.
3. **Session Hardening**: Sessions are cleared by resetting `$_SESSION = []`, invalidating the client session cookie with negative expiration (`time() - 42000`), and executing `session_destroy()`.
4. **Accessible Semantics**: High-contrast typography, ARIA labels, semantic landmark elements (`<header>`, `<main>`, `<nav>`, `<article>`, `<footer>`).

---

## 👨‍💻 Author & Academic Presentation

- **Project Name:** PHP Web Applications – Practical Lab
- **Coursework:** Web Programming Laboratory (Practical Examination & Project Showcase)
- **Framework:** Pure Vanilla PHP 8.1+ &bull; HTML5 &bull; Modern CSS3 &bull; Vanilla JavaScript
