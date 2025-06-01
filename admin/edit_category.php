<?php
require_once '../config/db.php';
if (!isset($_GET['id'])) {
    header("Location: categories.php?status=error&message=Invalid ID");
    exit();
}

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM categories WHERE id = :id");
$stmt->bindParam(':id', $id);
$stmt->execute();
$category = $stmt->fetch();
if (!$category) {
    header("Location: categories.php?status=error&message=Category not found");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Category - Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100">
  <div class="flex h-screen">
    <!-- Sidebar -->
    <?php include '../components/admin-sidebar.php'; ?>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col overflow-hidden">
      <!-- Top Navbar -->
      <header class="bg-white shadow-sm z-10">
        <div class="flex items-center justify-between p-4">
          <h1 class="text-xl font-semibold text-gray-800 ml-4">Edit Category</h1>
        </div>
      </header>

      <!-- Page Content -->
      <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
        <div class="max-w-7xl mx-auto">
          <div class="card shadow mb-4 bg-white rounded-lg">
            <div class="card-header py-2 flex items-center justify-between my-6 px-6">
              <strong class="text-xl font-bold text-blue-700">Edit Data Category</strong>
            </div>

            <form action="update_category.php" method="POST" class="p-6 max-w-xl mx-auto">
              <input type="hidden" name="id" value="<?= $category['id'] ?>">

              <div class="mb-4">
                <label for="name" class="block text-gray-700 font-semibold mb-2">Name</label>
                <input type="text" name="name" id="name" required value="<?= htmlspecialchars($category['name']) ?>"
                  class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" />
              </div>

              <div class="mb-4">
                <label for="description" class="block text-gray-700 font-semibold mb-2">Description</label>
                <input type="text" name="description" id="description" value="<?= htmlspecialchars($category['description']) ?>"
                  class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" />
              </div>

              <div class="mb-4">
                <label for="image" class="block text-gray-700 font-semibold mb-2">Image</label>
                <input type="text" name="image" id="image" value="<?= htmlspecialchars($category['image']) ?>"
                  class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" />
              </div>

              <div class="mb-6">
                <label for="created_at" class="block text-gray-700 font-semibold mb-2">Created At</label>
                <input type="date" name="created_at" id="created_at" value="<?= htmlspecialchars($category['created_at']) ?>"
                  class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" />
              </div>

              <button type="submit"
                class="bg-blue-600 text-white font-semibold py-2 px-6 rounded hover:bg-blue-700 transition duration-200">
                Update
              </button>
            </form>
          </div>
        </div>
      </main>
    </div>
  </div>
</body>
</html>
