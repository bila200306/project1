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
    header('Location: ../login.php');
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
        <div class="flex-1 flex flex-col overflow-y-auto">
            <!-- Top Navigation -->
            <header class="bg-white shadow-sm z-10">
                <div class="flex items-center justify-between p-4">
                    <div class="flex items-center">
                        <button class="md:hidden text-gray-500 focus:outline-none">
                            <i class="fas fa-bars"></i>
                        </button>
                        <h1 class="text-xl font-semibold text-gray-800 ml-4">Category</h1>
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
            <div id="content">
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->

                    <?php include '../components/alerts.php'; ?>


                    <!-- Content Row -->
                    <div class="row">

                        <!-- Content Column -->
                        <div class="col-lg-12 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-2 flex items-center justify-between my-6">
                                    <strong class="text-xl font-bold text-blue-700 px-4">Input Data Category</strong>
                                </div>
                                <div class="card-body">
                                </div>
                            </div>

                            <form action="proses_category.php" method="POST" enctype="multipart/form-data"
                                class="p-6 bg-white rounded shadow-md max-w-xl mx-auto">
                                <div class="mb-4">
                                    <label for="name" class="block text-gray-700 font-semibold mb-2">Name</label>
                                    <input type="text" name="name" id="name" placeholder="Masukkan Nama Anda" required
                                        class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" />
                                </div>

                                <div class="mb-4">
                                    <label for="description"
                                        class="block text-gray-700 font-semibold mb-2">Description</label>
                                    <input type="text" name="description" id="description"
                                        placeholder="Tambahkan Deskripsi Anda"
                                        class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" />
                                </div>

                                <div class="mb-4">
                                    <label for="image" class="block text-gray-700 font-semibold mb-2">Image</label>
                                    <div class="flex items-center">
                                        <div class="relative flex-1">
                                            <input type="file" name="image" id="image" accept="image/*"
                                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                                                onchange="previewImage(this)" required />
                                            <div class="w-full px-4 py-2 border rounded bg-white text-gray-500">
                                                <span id="file-name">Pilih gambar</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="image-preview" class="mt-4 hidden">
                                        <p class="text-sm text-gray-600 mb-2">Preview:</p>
                                        <img id="preview" class="max-w-xs h-auto border rounded" />
                                    </div>
                                </div>

                                <button type="submit"
                                    class="bg-blue-600 text-white font-semibold py-2 px-6 rounded hover:bg-blue-700 transition duration-200">
                                    Submit
                                </button>
                            </form>
                            <!-- </select>
                                </div><br>
                                <input type="submit" class="btn btn-success" value="simpan">

                                <div class="col-lg-6 mb-4">
 
                            </div>
                            -->
                            <!-- Main Content -->
                            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
                                <div class="max-w-7xl mx-auto">
                                    <div class="bg-white rounded-lg shadow overflow-y-auto">

                                    </div>
                                </div>
                            </main>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Mobile menu toggle
        document.addEventListener('DOMContentLoaded', function () {
            const mobileMenuButton = document.querySelector('.mobile-menu-button');
            const sidebar = document.querySelector('.sidebar');

            if (mobileMenuButton && sidebar) {
                mobileMenuButton.addEventListener('click', function () {
                    sidebar.classList.toggle('-translate-x-full');
                });
            }
        });

        // Image preview function
        function previewImage(input) {
            const preview = document.getElementById('preview');
            const fileName = document.getElementById('file-name');
            const imagePreview = document.getElementById('image-preview');

            if (input.files && input.files[0]) {
                const file = input.files[0];

                // Check if file is an image
                if (!file.type.match('image.*')) {
                    alert('Please select an image file');
                    input.value = '';
                    return;
                }

                // Check file size (max 2MB)
                if (file.size > 2 * 1024 * 1024) {
                    alert('File size should be less than 2MB');
                    input.value = '';
                    return;
                }

                const reader = new FileReader();

                reader.onload = function (e) {
                    preview.src = e.target.result;
                    fileName.textContent = file.name;
                    imagePreview.classList.remove('hidden');
                }

                reader.readAsDataURL(file);
            } else {
                preview.src = '';
                fileName.textContent = 'Pilih gambar';
                imagePreview.classList.add('hidden');
            }
        }
    </script>
</body>

</html>