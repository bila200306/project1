<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'config/db.php';
require_once 'includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_SESSION['error'] = 'Invalid request method';
    header('Location: login.php');
    exit();
}

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

if (empty($username) || empty($password)) {
    $_SESSION['error'] = 'Username and password are required';
    header('Location: login.php');
    exit();
}

try {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username LIMIT 1");
    $stmt->execute([':username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($user && password_verify($password, $user['password'])) {
        session_regenerate_id(true);
        
        $_SESSION = []; 
        $_SESSION['user_id'] = (int)$user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['last_activity'] = time();
        $_SESSION['created'] = time();
        
        $_SESSION['success'] = 'Login successful!';
        
        $redirectTo = $_SESSION['redirect_after_login'] ?? 'admin/dashboard.php';
        unset($_SESSION['redirect_after_login']);
        
        session_write_close();
        
        header('Location: ' . $redirectTo);
        exit();
    } else {
        usleep(rand(100000, 200000)); 
        
        $_SESSION['error'] = 'Invalid username or password';
        header('Location: login.php');
        exit();
    }
} catch (PDOException $e) {
    error_log('Login error: ' . $e->getMessage());
    
    $_SESSION['error'] = 'A system error occurred. Please try again later.';
    header('Location: login.php');
    exit();
}
