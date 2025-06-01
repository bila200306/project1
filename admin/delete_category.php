 <?php
require_once '../config/db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        $stmt = $pdo->prepare("DELETE FROM categories WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        header("Location: categories.php?status=success");
    } catch (PDOException $e) {
        // Misalnya terjadi error foreign key
        header("Location: categories.php?status=error&message=" . urlencode($e->getMessage()));
    }
} else {
    header("Location: categories.php?status=error&message=Invalid ID");
}
?>
 