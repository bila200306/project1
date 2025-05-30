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
<div class="flex justify-center mt-6">
<a href="<?php echo ($service['cta']); ?>" target="_blank" rel="noopener noreferrer"
   class="inline-flex items-center gap-2 bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-lg shadow transition duration-300">
  <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
    <path d="M20.52 3.48A11.9 11.9 0 0012.01.03C6.47.03 1.87 4.63 1.87 10.17c0 1.79.46 3.55 1.33 5.09L.03 24l8.9-2.28a11.87 11.87 0 003.07.41c5.54 0 10.13-4.6 10.13-10.14 0-2.7-1.05-5.24-2.81-7.01zm-8.5 17.65a9.48 9.48 0 01-2.8-.41l-.2-.06-5.25 1.34 1.4-5.09-.1-.21a9.49 9.49 0 01-1.3-4.87c0-5.25 4.27-9.52 9.52-9.52 2.54 0 4.92.99 6.71 2.78a9.45 9.45 0 012.78 6.72c0 5.25-4.27 9.52-9.52 9.52zm5.26-7.16c-.29-.14-1.73-.85-2-1.01-.27-.15-.46-.14-.66.14-.19.27-.76 1.01-.93 1.22-.17.2-.34.23-.63.08-.29-.14-1.24-.46-2.36-1.47-.87-.77-1.46-1.72-1.63-2-.17-.29-.02-.45.13-.59.13-.13.29-.34.44-.51.15-.17.2-.29.29-.48.1-.19.05-.36-.02-.51-.07-.14-.66-1.58-.9-2.15-.24-.57-.49-.49-.66-.5-.17-.01-.36-.01-.55-.01-.19 0-.5.07-.76.36s-1 1-.97 2.45c.03 1.44 1.03 2.84 1.17 3.04.14.2 2.03 3.13 4.93 4.39.69.3 1.23.48 1.65.62.69.22 1.32.19 1.82.12.55-.08 1.73-.71 1.98-1.39.25-.68.25-1.27.17-1.39-.08-.12-.26-.19-.54-.32z" />
  </svg>
  Chat via WhatsApp
</a>
</div>
<br>
    <?php include 'components/footer.php'; ?>
</body>

</html>