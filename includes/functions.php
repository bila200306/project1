<?php
function startSecureSession()
{
    if (session_status() === PHP_SESSION_NONE) {
        // Set session cookie parameters
        session_set_cookie_params([
            'lifetime' => 86400, // 1 day
            'path' => '/',
            'domain' => $_SERVER['HTTP_HOST'] ?? '',
            'secure' => isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on',
            'httponly' => true,
            'samesite' => 'Lax' // Changed from Strict to Lax for better compatibility
        ]);

        // Set session name
        session_name('PENTRA_SESSION');

        // Start the session
        if (!session_start()) {
            error_log('Failed to start session');
            return false;
        }

        // Initialize session variables if they don't exist
        if (empty($_SESSION['last_activity'])) {
            $_SESSION['last_activity'] = time();
        }

        if (empty($_SESSION['created'])) {
            $_SESSION['created'] = time();
        }

        // Regenerate session ID periodically to prevent session fixation
        if (time() - $_SESSION['created'] > 1800) { // 30 minutes
            session_regenerate_id(true);
            $_SESSION['created'] = time();
        }

        return true;
    }
    return true;
}

startSecureSession();

function isLoggedIn()
{
    if (isset($_SESSION['user_id'], $_SESSION['last_activity'])) {
        if (time() - $_SESSION['last_activity'] > 3600) {
            session_unset();
            session_destroy();
            return false;
        }
        $_SESSION['last_activity'] = time();
        return true;
    }
    return false;
}

function requireLogin($redirectTo = '../login.php')
{
    if (!isLoggedIn()) {
        $_SESSION['redirect_after_login'] = $_SERVER['REQUEST_URI'];
        $_SESSION['error'] = 'Please log in to access this page.';
        header('Location: ' . $redirectTo);
        exit();
    }
}

function requireGuest($redirectTo = 'dashboard.php')
{
    if (isLoggedIn()) {
        header('Location: ' . $redirectTo);
        exit();
    }
}

function destroySession()
{
    // Clear all session variables
    $_SESSION = [];

    // Get session parameters
    $params = session_get_cookie_params();

    // Delete the actual cookie
    setcookie(
        session_name(),
        '',
        time() - 86400,  // Set expiration to past
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );

    // Destroy session data in storage
    session_destroy();

    // Clear session cookie in the browser
    if (isset($_COOKIE[session_name()])) {
        unset($_COOKIE[session_name()]);
    }
}
