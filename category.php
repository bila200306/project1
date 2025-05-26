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
    $query=$pdo->prepare("SELECT * FROM services");
        $query->execute();
        $services = $query->fetchAll();
        foreach ($services as $services){
    ?>
    <div class="container mx-auto my-8">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-bold mb-4"><?php echo $services['name']; ?></h2>
            <a href="service.php?id=<?php echo $services['id']; ?>" class="text-blue-500 hover:underline">View Details</a>
        </div>
    </div>
    <?php } ?>


    <?php include 'components/footer.php'; ?>
</body>

</html>