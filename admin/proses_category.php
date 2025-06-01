<?php
require_once '../config/db.php';
require_once '../includes/functions.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// if (!isLoggedIn()) {
//     $_SESSION['error'] = 'Anda harus login terlebih dahulu';
//     header('Location: ../login.php');
//     exit();
// }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $imageName = '';
    $uploadDir = '../uploads/categories/';
    
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    if (empty($name) || empty($description)) {
        $_SESSION['error'] = 'Nama dan deskripsi harus diisi';
        header('Location: tmbh_category.php');
        exit();
    }

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['image']['tmp_name'];
        $fileName = $_FILES['image']['name'];
        $fileSize = $_FILES['image']['size'];
        $fileType = $_FILES['image']['type'];
        
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $newFileName = uniqid() . '.' . $fileExtension;
        $destPath = $uploadDir . $newFileName;
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        if (!in_array($fileType, $allowedTypes)) {
            $_SESSION['error'] = 'Hanya file gambar (JPEG, PNG, GIF, WebP) yang diizinkan';
            header('Location: tmbh_category.php');
            exit();
        }

        $maxFileSize = 2 * 1024 * 1024; // 2MB
        if ($fileSize > $maxFileSize) {
            $_SESSION['error'] = 'Ukuran file maksimal 2MB';
            header('Location: tmbh_category.php');
            exit();
        }

        if (move_uploaded_file($fileTmpPath, $destPath)) {
            $imageName = 'categories/' . $newFileName;
        } else {
            $_SESSION['error'] = 'Gagal mengunggah gambar';
            header('Location: tmbh_category.php');
            exit();
        }
    } else {
        $_SESSION['error'] = 'Silakan pilih gambar';
        header('Location: tmbh_category.php');
        exit();
    }

    try {
        $sql = "INSERT INTO categories (name, description, image, created_at) VALUES (?, ?, ?, NOW())";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $description, $imageName]);

        $_SESSION['success'] = 'Kategori berhasil ditambahkan';
        header('Location: category.php');
        exit();
    } catch (PDOException $e) {
        if (!empty($imageName) && file_exists($uploadDir . $imageName)) {
            unlink($uploadDir . $imageName);
        }
        
        $_SESSION['error'] = 'Terjadi kesalahan: ' . $e->getMessage();
        header('Location: tmbh_category.php');
        exit();
    }
} else {
    header('Location: tmbh_category.php');
    exit();
}
?>
