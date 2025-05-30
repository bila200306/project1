<?php
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Include required files
require_once 'includes/functions.php';

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
        <div class="bg-gray-800 text-white w-64 space-y-6 py-7 px-2 inset-y-0 left-0 transform -translate-x-full md:translate-x-0 transition duration-200 ease-in-out fixed md:relative">
            <div class="text-white flex items-center space-x-2 px-4">
                <span class="text-2xl font-extrabold">Pentra</span>
                <span class="text-sm text-gray-300">Studio</span>
            </div>
            
            <nav>
                <a href="#" class="flex items-center px-4 py-3 text-gray-100 bg-gray-700 rounded-lg mx-2">
                    <i class="fas fa-home w-6"></i>
                    <span class="ml-3">Dashboard</span>
                </a>
                <a href="#" class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-700 hover:text-gray-100 rounded-lg mx-2 mt-2">
                    <i class="fas fa-user w-6"></i>
                    <span class="ml-3">Profile</span>
                </a>
                <a href="#" class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-700 hover:text-gray-100 rounded-lg mx-2 mt-2">
                    <i class="fas fa-cog w-6"></i>
                    <span class="ml-3">Settings</span>
                </a>
                <a href="#" class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-700 hover:text-gray-100 rounded-lg mx-2 mt-2">
                    <i class="fas fa-chart-bar w-6"></i>
                    <span class="ml-3">Analytics</span>
                </a>
                <a href="logout.php" class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-700 hover:text-gray-100 rounded-lg mx-2 mt-2">
                    <i class="fas fa-sign-out-alt w-6"></i>
                    <span class="ml-3">Logout</span>
                </a>
            </nav>
        </div>

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
                                <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center text-white font-semibold">
                                    <?= strtoupper(substr($_SESSION['username'], 0, 1)) ?>
                                </div>
                                <span class="hidden md:inline text-gray-700"><?= htmlspecialchars($_SESSION['username']) ?></span>
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
                        <div class="p-6">
                            <h2 class="text-2xl font-semibold text-gray-800 mb-2">Welcome back, <?= htmlspecialchars(explode(' ', $_SESSION['username'])[0]) ?>! 👋</h2>
                            <p class="text-gray-600 mb-6">Here's what's happening with your dashboard today.</p>
                            
                            <!-- Stats Cards -->
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                                <div class="bg-blue-50 p-6 rounded-lg">
                                    <div class="flex items-center">
                                        <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                                            <i class="fas fa-users"></i>
                                        </div>
                                        <div class="ml-4">
                                            <p class="text-sm font-medium text-gray-600">Total Users</p>
                                            <p class="text-2xl font-semibold text-gray-900">2,503</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-green-50 p-6 rounded-lg">
                                    <div class="flex items-center">
                                        <div class="p-3 rounded-full bg-green-100 text-green-600">
                                            <i class="fas fa-chart-line"></i>
                                        </div>
                                        <div class="ml-4">
                                            <p class="text-sm font-medium text-gray-600">Total Sales</p>
                                            <p class="text-2xl font-semibold text-gray-900">$12,345</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-purple-50 p-6 rounded-lg">
                                    <div class="flex items-center">
                                        <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                                            <i class="fas fa-shopping-cart"></i>
                                        </div>
                                        <div class="ml-4">
                                            <p class="text-sm font-medium text-gray-600">Total Orders</p>
                                            <p class="text-2xl font-semibold text-gray-900">1,234</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Recent Activity -->
                            <div class="bg-white rounded-lg shadow overflow-hidden">
                                <div class="px-6 py-4 border-b border-gray-200">
                                    <h3 class="text-lg font-medium text-gray-900">Recent Activity</h3>
                                </div>
                                <div class="divide-y divide-gray-200">
                                    <!-- Activity Item -->
                                    <div class="p-6 hover:bg-gray-50">
                                        <div class="flex items-start">
                                            <div class="flex-shrink-0">
                                                <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">
                                                    <i class="fas fa-user-plus"></i>
                                                </div>
                                            </div>
                                            <div class="ml-4">
                                                <p class="text-sm font-medium text-gray-900">New user registered</p>
                                                <p class="text-sm text-gray-500">A new user has registered on the platform</p>
                                                <p class="mt-1 text-xs text-gray-400">5 minutes ago</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Activity Item -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        // Mobile menu toggle
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.querySelector('.mobile-menu-button');
            const sidebar = document.querySelector('.sidebar');
            
            mobileMenuButton.addEventListener('click', function() {
                sidebar.classList.toggle('-translate-x-full');
            });
        });
    </script>
</body>
</html>