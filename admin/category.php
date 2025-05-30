<?php
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Include required files
require_once '../includes/functions.php';

// Check if user is logged in
if (!isLoggedIn()) {
    $_SESSION['redirect_after_login'] = $_SERVER['REQUEST_URI'];
    header('Location: login.php');
    exit();
}

// Update last activity time
$_SESSION['last_activity'] = time();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Your Site Name</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="bg-gray-100">
    <!-- Sidebar -->
    <div class="flex h-screen">
        <!-- Sidebar -->
        <?php include '../components/admin-sidebar.php'; ?>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Navigation -->
            <header class="bg-white shadow-sm z-10">
                <div class="flex items-center justify-between p-4">
                    <div class="flex items-center">
                        <button class="md:hidden text-gray-500 focus:outline-none">
                            <i class="fas fa-bars"></i>
                        </button>
                        <h1 class="text-xl font-semibold text-gray-800 ml-4">Dashboard</h1>
                    </div>
                    <div class="flex items-center space-x-4">
                        <button class="p-2 text-gray-500 rounded-full hover:bg-gray-100">
                            <i class="fas fa-bell"></i>
                        </button>
                        <div class="relative">
                            <button class="flex items-center space-x-2 focus:outline-none">
                                <div
                                    class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center text-white font-semibold">
                                    <?= strtoupper(substr($_SESSION['username'], 0, 1)) ?>
                                </div>
                                <span
                                    class="hidden md:inline text-gray-700"><?= htmlspecialchars($_SESSION['username']) ?></span>
                                <i class="fas fa-chevron-down text-xs text-gray-500"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
                <div class="max-w-7xl mx-auto">
                    <div class="bg-white rounded-lg shadow overflow-hidden">

                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        // Mobile menu toggle
        document.addEventListener('DOMContentLoaded', function () {
            const mobileMenuButton = document.querySelector('.mobile-menu-button');
            const sidebar = document.querySelector('.sidebar');

            mobileMenuButton.addEventListener('click', function () {
                sidebar.classList.toggle('-translate-x-full');
            });
        });
    </script>
</body>

</html>