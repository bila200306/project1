<?php 
require_once __DIR__ . '/../includes/functions.php';
?>
<nav class="w-full border-b border-gray-300">
    <div class="max-w-7xl mx-auto flex items-center justify-between px-4 py-3 sm:px-6 lg:px-8">
        <a href="index.php" class="flex items-center space-x-1">
            <div class="text-xs font-bold leading-none">
                Pentra
            </div>
            <div class="text-xs">
                Studio
            </div>
        </a>
        <ul class="hidden md:flex items-center space-x-6 text-xs font-normal text-gray-700">
            <li>
                <a class="hover:text-black" href="#">
                    Home
                </a>
            </li>
                <a class="hover:text-black" href="#">
                    Kreatif dan Berkualitas
                </a>
                <a class="hover:text-black" href="#">
                    Layanan Kami
                </a>
                <a class="hover:text-black" href="#">
                    Galeri Karya Kami
                </a>
                <a class="hover:text-black" href="#">
                    Tim Kami
                </a>
                
            <?php if (isset($_SESSION['user_id'])): ?>
            <li>
                <a class="hover:text-black" href="dashboard.php">
                    Dashboard
                </a>
            </li>
            <?php endif; ?>
        </ul>
        <div class="flex items-center space-x-4">
            <?php if (isset($_SESSION['user_id'])): ?>
                <span class="text-xs hidden md:block">Welcome, <?= htmlspecialchars($_SESSION['username']) ?></span>
                <a href="logout.php" class="bg-black text-white text-xs font-semibold px-4 py-2 rounded hover:bg-gray-800">
                    Logout
                </a>
           
            <?php endif; ?>
        </div>
    </div>
</nav>