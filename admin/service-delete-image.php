<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth.php');
    exit();
}

require_once '../config/db.php';

if (!isset($_GET['id'])) {
    $_SESSION['error'] = 'No image ID provided';
    header('Location: services.php');
    exit();
}

$imageId = $_GET['id'];

try {
    // Get the image path before deleting
    $stmt = $pdo->prepare("SELECT * FROM service_images WHERE image = ?");
    $stmt->execute([$imageId]);
    $image = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($image) {
        // Delete the physical file
        $filePath = '../' . $image['image'];
        if (file_exists($filePath)) {
            unlink($filePath);
        }
        
        // Delete the image record
        $stmt = $pdo->prepare("DELETE FROM service_images WHERE image = ?");
        $stmt->execute([$imageId]);
        
        $_SESSION['success'] = 'Image deleted successfully!';
    } else {
        $_SESSION['error'] = 'Image not found';
    }
} catch (PDOException $e) {
    $_SESSION['error'] = 'Error deleting image: ' . $e->getMessage();
}

// Redirect back to the edit page if referrer is set
if (isset($_SERVER['HTTP_REFERER'])) {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
} else {
    header('Location: services.php');
}
exit();
?>
