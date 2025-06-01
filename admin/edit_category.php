<?php
require_once '../config/db.php';
if (!isset($_GET['id'])) {
  header("Location: category.php?status=error&message=Invalid ID");
  exit();
}

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM categories WHERE id = :id");
$stmt->bindParam(':id', $id);
$stmt->execute();
$category = $stmt->fetch();
if (!$category) {
  header("Location: category.php?status=error&message=Category not found");
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
    <div class="flex-1 flex flex-col overflow-y-auto">
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

            <?php include '../components/alerts.php'; ?>

            <form action="update_category.php" method="POST" enctype="multipart/form-data" class="p-6 max-w-xl mx-auto">
              <input type="hidden" name="id" value="<?= $category['id'] ?>">

              <div class="mb-4">
                <label for="name" class="block text-gray-700 font-semibold mb-2">Name</label>
                <input type="text" name="name" id="name" required value="<?= htmlspecialchars($category['name']) ?>"
                  class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" />
              </div>

              <div class="mb-4">
                <label for="description" class="block text-gray-700 font-semibold mb-2">Description</label>
                <input type="text" name="description" id="description"
                  value="<?= htmlspecialchars($category['description']) ?>"
                  class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" />
              </div>

              <div class="mb-4">
                <label for="image" class="block text-gray-700 font-semibold mb-2">Image</label>
                <?php if (!empty($category['image'])): ?>
                  <div class="mb-2">
                    <p class="text-sm text-gray-600 mb-1">Current Image:</p>
                    <img src="../uploads/<?= htmlspecialchars($category['image']) ?>" alt="Current Image"
                      class="max-w-xs h-auto border rounded mb-3">
                    <input type="hidden" name="current_image" value="<?= htmlspecialchars($category['image']) ?>">
                  </div>
                <?php endif; ?>

                <div class="flex items-center">
                  <div class="relative flex-1">
                    <input type="file" name="image" id="image" accept="image/*"
                      class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" onchange="previewImage(this)" />
                    <div class="w-full px-4 py-2 border rounded bg-white text-gray-500">
                      <span id="file-name"><?= !empty($category['image']) ? 'Ganti gambar' : 'Pilih gambar' ?></span>
                    </div>
                  </div>
                </div>
                <div id="image-preview" class="mt-4 <?= empty($category['image']) ? 'hidden' : '' ?>">
                  <p class="text-sm text-gray-600 mb-2">New Preview:</p>
                  <img id="preview" class="max-w-xs h-auto border rounded" <?= empty($category['image']) ? '' : 'style="display:none;"' ?> />
                </div>
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
  <script>
    // Image preview function
    function previewImage(input) {
      const preview = document.getElementById('preview');
      const fileName = document.getElementById('file-name');
      const imagePreview = document.getElementById('image-preview');

      if (input.files && input.files[0]) {
        const file = input.files[0];

        // Check if file is an image
        if (!file.type.match('image.*')) {
          alert('Silakan pilih file gambar');
          input.value = '';
          return;
        }

        // Check file size (max 2MB)
        if (file.size > 2 * 1024 * 1024) {
          alert('Ukuran file maksimal 2MB');
          input.value = '';
          return;
        }

        const reader = new FileReader();

        reader.onload = function (e) {
          if (preview) {
            preview.src = e.target.result;
            preview.style.display = 'block';
          }
          fileName.textContent = file.name;
          imagePreview.classList.remove('hidden');
        }

        reader.readAsDataURL(file);
      } else {
        if (preview) {
          preview.src = '';
          preview.style.display = 'none';
        }
        fileName.textContent = '<?= !empty($category['image']) ? 'Gunakan gambar saat ini' : 'Pilih gambar' ?>';
        if (!input.files || input.files.length === 0) {
          imagePreview.classList.add('hidden');
        }
      }
    }
  </script>
</body>

</html>