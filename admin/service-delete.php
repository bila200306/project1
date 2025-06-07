<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth.php');
    exit();
}

require_once '../config/db.php';

if (!isset($_GET['id'])) {
    $_SESSION['error'] = 'No service ID provided';
    header('Location: services.php');
    exit();
}

$serviceId = $_GET['id'];

try {
    // Begin transaction
    $pdo->beginTransaction();
    
    // First, delete service images from the database and filesystem
    $stmt = $pdo->prepare("SELECT * FROM service_images WHERE service_id = ?");
    $stmt->execute([$serviceId]);
    $images = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($images as $image) {
        // Delete the physical file
        $filePath = '../' . $image['image'];
        if (file_exists($filePath)) {
            unlink($filePath);
        }
        // Delete the image record
        $stmt = $pdo->prepare("DELETE FROM service_images WHERE id = ?");
        $stmt->execute([$image['id']]);
    }
    
    // Delete the service
    $stmt = $pdo->prepare("DELETE FROM services WHERE id = ?");
    $stmt->execute([$serviceId]);
    
    // Commit the transaction
    $pdo->commit();
    
    $_SESSION['success'] = 'Service deleted successfully!';
} catch (PDOException $e) {
    // Rollback the transaction on error
    $pdo->rollBack();
    $_SESSION['error'] = 'Error deleting service: ' . $e->getMessage();
}

header('Location: services.php');
exit();
?>
