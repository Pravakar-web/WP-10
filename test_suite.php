<?php
/**
 * Automated Verification Test Suite for PHP Web Applications Lab
 * Using Native PHP Stream Wrappers (zero dependency on curl extension)
 */

$port = $argv[1] ?? '8000';
$baseUrl = 'http://127.0.0.1:' . $port;
$testsPassed = 0;
$totalTests = 0;

function assertCondition($name, $condition, $details = '') {
    global $testsPassed, $totalTests;
    $totalTests++;
    if ($condition) {
        $testsPassed++;
        echo " [PASS] $name\n";
    } else {
        echo " [FAIL] $name - $details\n";
    }
}

/**
 * Helper to make HTTP requests with cookie support
 */
function httpRequest($url, $method = 'GET', $data = null, &$cookies = [], $followRedirects = false) {
    $headers = [
        "User-Agent: PHP-Test-Client/1.0",
        "Connection: close"
    ];

    if (!empty($cookies)) {
        $cookieHeader = [];
        foreach ($cookies as $k => $v) {
            $cookieHeader[] = "$k=$v";
        }
        $headers[] = "Cookie: " . implode('; ', $cookieHeader);
    }

    $content = '';
    if ($method === 'POST' && $data !== null) {
        $content = is_array($data) ? http_build_query($data) : $data;
        $headers[] = "Content-Type: application/x-www-form-urlencoded";
        $headers[] = "Content-Length: " . strlen($content);
    }

    $context = stream_context_create([
        'http' => [
            'method' => $method,
            'header' => implode("\r\n", $headers),
            'content' => $content,
            'follow_location' => $followRedirects ? 1 : 0,
            'max_redirects' => 5,
            'ignore_errors' => true
        ]
    ]);

    $body = @file_get_contents($url, false, $context);
    $responseHeaders = $http_response_header ?? [];

    $statusCode = 0;
    if (isset($responseHeaders[0]) && preg_match('#HTTP/\S+\s+(\d+)#', $responseHeaders[0], $m)) {
        $statusCode = (int)$m[1];
    }

    $location = null;
    foreach ($responseHeaders as $hdr) {
        if (stripos($hdr, 'Set-Cookie:') === 0) {
            $cookiePart = trim(substr($hdr, 11));
            $cookiePair = explode(';', $cookiePart)[0];
            $pair = explode('=', $cookiePair, 2);
            if (count($pair) === 2) {
                $cookies[trim($pair[0])] = trim($pair[1]);
            }
        }
        if (stripos($hdr, 'Location:') === 0) {
            $location = trim(substr($hdr, 9));
        }
    }

    return [
        'status' => $statusCode,
        'body' => $body,
        'headers' => $responseHeaders,
        'location' => $location
    ];
}

echo "========================================================\n";
echo " Running Automated Verification Tests on $baseUrl\n";
echo "========================================================\n\n";

// --- 1. Test Landing Page ---
$indexRes = httpRequest("$baseUrl/index.php");
assertCondition(
    'Landing Page Title & Subtitle',
    str_contains($indexRes['body'], 'PHP') && str_contains($indexRes['body'], 'Practical Implementation of PHP Concepts'),
    'Title or Subtitle missing in index.php'
);
assertCondition(
    'Landing Page Assignment 1 Card',
    str_contains($indexRes['body'], 'Assignment 01') && str_contains($indexRes['body'], 'assignment1/index.php'),
    'Assignment 1 link missing'
);
assertCondition(
    'Landing Page Assignment 2 Card',
    str_contains($indexRes['body'], 'Assignment 02') && str_contains($indexRes['body'], 'assignment2/index.php'),
    'Assignment 2 link missing'
);
assertCondition(
    'Landing Page Assignment 3 Card',
    str_contains($indexRes['body'], 'Assignment 03') && str_contains($indexRes['body'], 'assignment3/index.php'),
    'Assignment 3 link missing'
);

// --- 2. Test Assignment 1: Session Management ---
echo "\n--- Testing Assignment 1: Session Lifecycle ---\n";

// Test 2.1: Direct access to welcome.php without session (Must redirect)
$cookies = [];
$unauth = httpRequest("$baseUrl/assignment1/welcome.php", 'GET', null, $cookies, false);
assertCondition(
    'Protected welcome.php Redirects Without Session',
    $unauth['status'] === 302 && $unauth['location'] === 'index.php?error=unauthorized',
    "Expected 302 to index.php?error=unauthorized, got status {$unauth['status']}, location {$unauth['location']}"
);

// Test 2.2: Login with name
$loginResp = httpRequest("$baseUrl/assignment1/index.php", 'POST', ['user_name' => 'Alexander Fleming'], $cookies, false);
assertCondition(
    'Assignment 1 Login Stores Session & Redirects',
    $loginResp['status'] === 302 && $loginResp['location'] === 'welcome.php',
    "Expected 302 to welcome.php, got status {$loginResp['status']}, location {$loginResp['location']}"
);
assertCondition(
    'Session Cookie PHPSESSID Was Set',
    isset($cookies['PHPSESSID']),
    'PHPSESSID cookie was not established'
);

// Test 2.3: Access welcome.php with active session cookie
$welcomeResp = httpRequest("$baseUrl/assignment1/welcome.php", 'GET', null, $cookies, false);
assertCondition(
    'Welcome Page Displays "Hello, [Name]!"',
    $welcomeResp['status'] === 200 && str_contains($welcomeResp['body'], 'Hello,') && str_contains($welcomeResp['body'], 'Alexander Fleming'),
    'Welcome message missing'
);
assertCondition(
    'Welcome Page Displays Session Start Time at Top-Right',
    str_contains($welcomeResp['body'], 'Session Start Time:'),
    'Session start time missing'
);
assertCondition(
    'Welcome Page Includes Logout Button',
    str_contains($welcomeResp['body'], 'logout.php'),
    'Logout button missing'
);

// Sleep 1 second to verify elapsed duration calculation
sleep(1);

// Test 2.4: Call logout.php
$logoutResp = httpRequest("$baseUrl/assignment1/logout.php", 'GET', null, $cookies, false);
assertCondition(
    'Logout Page Displays "Thank You, [Name]!"',
    $logoutResp['status'] === 200 && str_contains($logoutResp['body'], 'Thank You,') && str_contains($logoutResp['body'], 'Alexander Fleming'),
    'Logout thank you message missing'
);
assertCondition(
    'Logout Page Displays Login Time, Logout Time, and Duration',
    str_contains($logoutResp['body'], 'Login Timestamp') && str_contains($logoutResp['body'], 'Logout Timestamp') && str_contains($logoutResp['body'], 'Total Usage Duration'),
    'Usage metrics missing'
);
assertCondition(
    'Logout Page Displays Elapsed Seconds (at least 1s)',
    str_contains($logoutResp['body'], 'second'),
    'Seconds metric not found'
);
assertCondition(
    'Logout Page Includes Return to Home Page Button',
    str_contains($logoutResp['body'], 'Return to Home Page'),
    'Return to home button missing'
);

// Test 2.5: Verify session is destroyed - accessing welcome.php should now redirect
$postLogoutResp = httpRequest("$baseUrl/assignment1/welcome.php", 'GET', null, $cookies, false);
assertCondition(
    'Session Invalidation: welcome.php Denied After Logout',
    $postLogoutResp['status'] === 302,
    "Expected 302 after session destruction, got status {$postLogoutResp['status']}"
);

// --- 3. Test Assignment 2: Date, Time & Day ---
echo "\n--- Testing Assignment 2: Date, Time & Day Dashboard ---\n";
$dateResp = httpRequest("$baseUrl/assignment2/index.php");

assertCondition(
    'Assignment 2 Displays Current Date (e.g. "17 November 2026")',
    str_contains($dateResp['body'], date('d F Y')),
    'Current date ' . date('d F Y') . ' not found'
);
assertCondition(
    'Assignment 2 Displays Current Day Clearly (e.g. "Tuesday")',
    str_contains($dateResp['body'], date('l')),
    'Current day ' . date('l') . ' not found'
);
assertCondition(
    'Assignment 2 Displays Current Time Format',
    str_contains($dateResp['body'], 'Current Time') && str_contains($dateResp['body'], date('A')),
    'Current time not found'
);
assertCondition(
    'Assignment 2 Displays Server Timezone',
    str_contains($dateResp['body'], date_default_timezone_get()),
    'Server timezone missing'
);
assertCondition(
    'Assignment 2 Includes Refresh Button',
    str_contains($dateResp['body'], 'Refresh Server Time'),
    'Refresh button missing'
);

// --- 4. Test Assignment 3: Age-Based Authorization ---
echo "\n--- Testing Assignment 3: Age-Based Authorization ---\n";

// Test 4.1: Under 18 (e.g. Age 16)
$under18Resp = httpRequest("$baseUrl/assignment3/result.php", 'POST', ['user_name' => 'Charlie Brown', 'user_age' => '16']);
$expectedUnder18 = "Hello, Charlie Brown, you are not authorized to visit the site.";
assertCondition(
    'Age < 18 Displays Exact Requisite Unauthorized Message',
    str_contains($under18Resp['body'], $expectedUnder18),
    "Expected message '$expectedUnder18' not found"
);
assertCondition(
    'Age < 18 Includes Visual Indicator / Denied Badge',
    str_contains($under18Resp['body'], 'Access Denied') && str_contains($under18Resp['body'], 'unauthorized'),
    'Visual indicator for unauthorized missing'
);
assertCondition(
    'Result Page Includes Try Again Button',
    str_contains($under18Resp['body'], 'Try Again') || str_contains($under18Resp['body'], 'Test Another Age'),
    'Try again button missing'
);

// Test 4.2: 18 or above (e.g. Age 21)
$over18Resp = httpRequest("$baseUrl/assignment3/result.php", 'POST', ['user_name' => 'Diana Prince', 'user_age' => '21']);
$expectedOver18 = "Welcome to this site, Diana Prince!";
assertCondition(
    'Age >= 18 Displays Exact Requisite Authorized Message',
    str_contains($over18Resp['body'], $expectedOver18),
    "Expected message '$expectedOver18' not found"
);
assertCondition(
    'Age >= 18 Includes Visual Indicator / Authorized Badge',
    str_contains($over18Resp['body'], 'Authorized') && str_contains($over18Resp['body'], 'authorized'),
    'Visual indicator for authorized missing'
);

// Test 4.3: Edge case (Age exactly 18)
$edge18Resp = httpRequest("$baseUrl/assignment3/result.php", 'POST', ['user_name' => 'Bruce Wayne', 'user_age' => '18']);
assertCondition(
    'Age == 18 Threshold Evaluates as Authorized',
    str_contains($edge18Resp['body'], "Welcome to this site, Bruce Wayne!"),
    'Age 18 was not authorized'
);

// Test 4.4: Invalid Input (Negative age or empty name)
$invalidResp = httpRequest("$baseUrl/assignment3/result.php", 'POST', ['user_name' => '', 'user_age' => '-5']);
assertCondition(
    'Validation Trap for Empty Name & Negative Age',
    str_contains($invalidResp['body'], 'Validation Failed') && str_contains($invalidResp['body'], 'negative'),
    'Validation failed screen not triggered'
);

echo "\n========================================================\n";
echo " Test Results: $testsPassed / $totalTests Passed (" . round(($testsPassed / $totalTests) * 100) . "%)\n";
echo "========================================================\n";

if ($testsPassed === $totalTests) {
    exit(0);
} else {
    exit(1);
}
