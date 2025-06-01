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
    $id = (int)$_POST['id'];
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $currentImage = $_POST['current_image'] ?? '';
    $uploadDir = '../uploads/categories/';
    $imageName = $currentImage; // Default to current image
    
    // Validate input
    if (empty($name) || empty($description)) {
        $_SESSION['error'] = 'Nama dan deskripsi harus diisi';
        header("Location: edit_category.php?id=$id");
        exit();
    }

    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
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
            header("Location: edit_category.php?id=$id");
            exit();
        }

        $maxFileSize = 2 * 1024 * 1024; // 2MB
        if ($fileSize > $maxFileSize) {
            $_SESSION['error'] = 'Ukuran file maksimal 2MB';
            header("Location: edit_category.php?id=$id");
            exit();
        }

        if (move_uploaded_file($fileTmpPath, $destPath)) {
            $imageName = 'categories/' . $newFileName;
            
            if (!empty($currentImage) && file_exists('../uploads/' . $currentImage)) {
                unlink('../uploads/' . $currentImage);
            }
        } else {
            $_SESSION['error'] = 'Gagal mengunggah gambar';
            header("Location: edit_category.php?id=$id");
            exit();
        }
    }

    try {
        $sql = "UPDATE categories SET name = :name, description = :description, image = :image, updated_at = NOW() WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $success = $stmt->execute([
            ':name' => $name,
            ':description' => $description,
            ':image' => $imageName,
            ':id' => $id
        ]);

        if ($success && $stmt->rowCount() > 0) {
            $_SESSION['success'] = 'Kategori berhasil diperbarui';
            header('Location: category.php');
        } else {
            if ($imageName !== $currentImage && file_exists($uploadDir . basename($imageName))) {
                unlink($uploadDir . basename($imageName));
            }
            $_SESSION['error'] = 'Tidak ada perubahan data';
            header("Location: edit_category.php?id=$id");
        }
        exit();
    } catch (PDOException $e) {
        if ($imageName !== $currentImage && file_exists($uploadDir . basename($imageName))) {
            unlink($uploadDir . basename($imageName));
        }
        
        $_SESSION['error'] = 'Terjadi kesalahan: ' . $e->getMessage();
        header("Location: edit_category.php?id=$id");
        exit();
    }
} else {
    $_SESSION['error'] = 'Permintaan tidak valid';
    header('Location: category.php');
    exit();
}
?>
