<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'includes/functions.php';

$_SESSION = [];

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

session_destroy();

if (isset($_COOKIE[session_name()])) {
    unset($_COOKIE[session_name()]);
    setcookie(session_name(), '', time() - 3600, '/');
}

session_start();
$_SESSION['success'] = 'You have been successfully logged out.';
session_write_close();
header('Location: ../login.php');
exit();
