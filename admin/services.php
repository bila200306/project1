<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Services - Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <?php include '../components/admin-sidebar.php'; ?>
        
        <div class="flex-1 overflow-y-auto">
            <div class="p-8">
                <div class="flex justify-between items-center mb-8">
                    <h1 class="text-2xl font-bold text-gray-800">Manage Services</h1>
                    <a href="service-create.php" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg flex items-center">
                        <i class="fas fa-plus mr-2"></i> Add New Service
                    </a>
                </div>

                <?php
                if (isset($_SESSION['success'])) {
                    echo '<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">' . $_SESSION['success'] . '</div>';
                    unset($_SESSION['success']);
                }
                if (isset($_SESSION['error'])) {
                    echo '<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">' . $_SESSION['error'] . '</div>';
                    unset($_SESSION['error']);
                }
                ?>

                <div class="bg-white rounded-lg shadow overflow-y-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php
                            require_once '../config/db.php';
                            $query = $pdo->query("SELECT * FROM services ORDER BY id DESC");
                            while ($service = $query->fetch(PDO::FETCH_ASSOC)) {
                                $shortDesc = strlen($service['content']) > 100 ? substr($service['content'], 0, 100) . '...' : $service['content'];
                                echo '<tr>';
                                echo '<td class="px-6 py-4 whitespace-nowrap">' . htmlspecialchars($service['name']) . '</td>';
                                echo '<td class="px-6 py-4">' . htmlspecialchars($shortDesc) . '</td>';
                                echo '<td class="px-6 py-4 whitespace-nowrap text-sm font-medium">';
                                echo '<a href="service-edit.php?id=' . $service['id'] . '" class="text-indigo-600 hover:text-indigo-900 mr-3"><i class="fas fa-edit"></i> Edit</a>';
                                echo '<a href="service-delete.php?id=' . $service['id'] . '" class="text-red-600 hover:text-red-900" onclick="return confirm(\'Are you sure you want to delete this service?\')"><i class="fas fa-trash"></i> Delete</a>';
                                echo '</td>';
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
