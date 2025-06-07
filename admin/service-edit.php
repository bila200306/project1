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

// Fetch service data
$stmt = $pdo->prepare("SELECT * FROM services WHERE id = ?");
$stmt->execute([$serviceId]);
$service = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$service) {
    $_SESSION['error'] = 'Service not found';
    header('Location: services.php');
    exit();
}

// Fetch service images
$stmt = $pdo->prepare("SELECT * FROM service_images WHERE service_id = ?");
$stmt->execute([$serviceId]);
$images = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $content = $_POST['content'];
    $cta = $_POST['cta'];
    $category_id = $_POST['category_id'];
    
    try {
        // Update service
        $stmt = $pdo->prepare("UPDATE services SET name = ?, content = ?, cta = ?, category_id = ? WHERE id = ?");
        $stmt->execute([$name, $content, $cta, $category_id, $serviceId]);
        
        // Handle new image uploads
        if (!empty($_FILES['images']['name'][0])) {
            $uploadDir = '../uploads/services/';
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            
            foreach ($_FILES['images']['tmp_name'] as $key => $tmpName) {
                if ($_FILES['images']['error'][$key] === 0) {
                    $fileName = uniqid() . '_' . basename($_FILES['images']['name'][$key]);
                    $targetPath = $uploadDir . $fileName;
                    
                    if (move_uploaded_file($tmpName, $targetPath)) {
                        $imagePath = 'uploads/services/' . $fileName;
                        $stmt = $pdo->prepare("INSERT INTO service_images (service_id, image) VALUES (?, ?)");
                        $stmt->execute([$serviceId, $imagePath]);
                    }
                }
            }
        }
        
        $_SESSION['success'] = 'Service updated successfully!';
        header('Location: services.php');
        exit();
    } catch (PDOException $e) {
        $_SESSION['error'] = 'Error updating service: ' . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Service - Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.ckeditor.com/ckeditor5/41.2.0/classic/ckeditor.js"></script>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <?php include '../components/admin-sidebar.php'; ?>
        
        <div class="flex-1 overflow-y-auto">
            <div class="p-8">
                <div class="flex justify-between items-center mb-8">
                    <h1 class="text-2xl font-bold text-gray-800">Edit Service</h1>
                    <a href="services.php" class="text-gray-600 hover:text-gray-800">
                        <i class="fas fa-arrow-left mr-1"></i> Back to Services
                    </a>
                </div>

                <?php if (isset($_SESSION['error'])): ?>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <?php 
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                        ?>
                    </div>
                <?php endif; ?>

                <div class="bg-white rounded-lg shadow p-6">
                    <form id="serviceForm" action="" method="POST" enctype="multipart/form-data">
                        <div class="mb-4">
                            <label for="category_id" class="block text-gray-700 text-sm font-bold mb-2">Category</label>
                            <select id="category_id" name="category_id" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Select a category</option>
                                <?php
                                $catStmt = $pdo->query("SELECT id, name FROM categories ORDER BY name");
                                while ($category = $catStmt->fetch(PDO::FETCH_ASSOC)) {
                                    $selected = ($category['id'] == $service['category_id']) ? 'selected' : '';
                                    echo "<option value='" . htmlspecialchars($category['id']) . "' $selected>" . 
                                         htmlspecialchars($category['name']) . "</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Service Name</label>
                            <input type="text" id="name" name="name" required 
                                   value="<?php echo htmlspecialchars($service['name']); ?>"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div class="mb-4">
                            <label for="content" class="block text-gray-700 text-sm font-bold mb-2">Content</label>
                            <textarea id="content" name="content" rows="6"
                                     class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 editor"><?php echo htmlspecialchars($service['content']); ?></textarea>
                            <div id="content-error" class="text-red-500 text-sm mt-1 hidden">Content is required</div>
                        </div>

                        <div class="mb-4">
                            <label for="cta" class="block text-gray-700 text-sm font-bold mb-2">WhatsApp CTA Link</label>
                            <input type="url" id="cta" name="cta" required
                                   value="<?php echo htmlspecialchars($service['cta']); ?>"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   placeholder="https://wa.me/1234567890?text=Hello%20I'm%20interested%20in%20your%20service">
                        </div>

                        <?php if (!empty($images)): ?>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Current Images</label>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4">
                                <?php foreach ($images as $image): ?>
                                    <div class="relative group">
                                        <img src="../<?php echo htmlspecialchars($image['image']); ?>" alt="Service Image" class="w-full h-32 object-cover rounded">
                                        <a href="service-delete-image.php?id=<?php echo $image['image']; ?>" 
                                           class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity"
                                           onclick="return confirm('Are you sure you want to delete this image?')">
                                            <i class="fas fa-times text-xs"></i>
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <?php endif; ?>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Add More Images</label>
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600">
                                        <label for="images" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                            <span>Upload files</span>
                                            <input id="images" name="images[]" type="file" multiple class="sr-only">
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>
                                    <p class="text-xs text-gray-500">
                                        PNG, JPG, GIF up to 10MB
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end mt-6">
                            <button type="button" onclick="window.history.back()" class="mr-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded">
                                Cancel
                            </button>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                                Update Service
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Form validation
        document.getElementById('serviceForm').addEventListener('submit', function(e) {
            const editorContent = document.querySelector('.ck.ck-editor__editable').innerHTML.trim();
            const errorElement = document.getElementById('content-error');
            
            if (!editorContent) {
                e.preventDefault();
                errorElement.classList.remove('hidden');
                // Scroll to error
                errorElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
            } else {
                errorElement.classList.add('hidden');
            }
        });

        // Initialize CKEditor
        document.addEventListener('DOMContentLoaded', function() {
            const editors = document.querySelectorAll('.editor');
            editors.forEach(editor => {
                ClassicEditor
                    .create(editor, {
                        toolbar: [
                            'heading', '|',
                            'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|',
                            'undo', 'redo'
                        ],
                        height: '300px'
                    })
                    .catch(error => {
                        console.error('Error initializing CKEditor:', error);
                    });
            });
        });
    </script>
</body>
</html>
