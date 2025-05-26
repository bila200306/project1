<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>
        Pentra Studio
    </title>
    <script src="https://cdn.tailwindcss.com">
    </script>
    <?php include 'components/style.php'; ?>
</head>

<body class="bg-white text-black">
    <!-- Navbar -->
    <?php include 'components/navbar.php'; ?>

    <?php

    require_once 'config/db.php';
    if (isset($_GET['id'])) {
        $serviceId = $_GET['id'];
        $query = $pdo->prepare("SELECT * FROM services WHERE id = :id");
        $query->bindParam(':id', $serviceId, PDO::PARAM_INT);
        $query->execute();
        $service = $query->fetch();
        
        $query = $pdo->prepare("SELECT * FROM service_images WHERE service_id = :id");
        $query->bindParam(':id', $serviceId, PDO::PARAM_INT);
        $query->execute();
        $image = $query->fetchAll();
    ?>
    <div class="container mx-auto my-8">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-bold mb-4"><?php echo htmlspecialchars($service['name']); ?></h2>

        <div class="grid grid-cols-4 md:grid-cols-4 gap-2">
    <?php 
    foreach 
($image as $img) {
    ?>
    <img src="<?php echo htmlspecialchars($img['image']); ?>" alt="<?php echo htmlspecialchars($service['name']); ?>" class="w-full h-auto rounded-lg mb-4" >
    <?php }
    ?>
    </div>

    <p class="text-gray-700 mb-4"><?php echo ($service['content']); ?></p>

<?php
    }
    ?>


    <?php include 'components/footer.php'; ?>
</body>

</html>