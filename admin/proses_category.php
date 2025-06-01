<?php
require_once '../config/db.php'; // Pastikan ini meng-include file yang mengandung $pdo

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $image = $_POST['file']['name'] ?? null; // Ambil nama file jika ada
    $created_at = $_POST['created_at'];

    try {
        $sql = "INSERT INTO categories (name, description, image, created_at) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $description, $image, $created_at]);

        echo "Data berhasil ditambahkan!";
        // Bisa juga redirect pakai:
        // header('Location: category.php');
        // exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
