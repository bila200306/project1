<?php
require_once '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' ) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $image = $_POST['image'];
    $created_at = $_POST['created_at'];
    $updated_at = $_POST['updated_at'];
    // Pastikan $image sudah diupload sebelumnya, jika tidak, bisa di-set null atau tetap dengan nilai sebelumnya
    if (empty($image)) {
        $image = null; // Atau bisa juga ambil dari database jika tidak ada upload baru
    }

    try {
        $stmt = $pdo->prepare("UPDATE categories SET name = :name, description = :description, image = :image, created_at = :created_at, updated_at = :updated_at WHERE id = :id");
        $stmt->execute([
            ':name' => $name,
            ':description' => $description,
            ':image' => $image,
            ':created_at' => $created_at,
            ':updated_at' => $updated_at,
            ':id' => $id
        ]);

        header("Location: category.php?message=success_update");
    } catch (PDOException $e) {
        header("Location: category.php?status=error&message=" . urlencode($e->getMessage()));
    }
} else {
    header("Location: category.php?status=invalid_request");
}
