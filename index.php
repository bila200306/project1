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
    <!-- Hero Section -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6 relative">
        <div class="flex flex-col md:flex-row md:items-center md:space-x-12">
            <div class="flex flex-col space-y-1 md:w-1/4">
                <div class="flex space-x-1 mb-2">
                    <div class="w-4 h-8 bg-gray-400 rounded-tl-md rounded-bl-md">
                    </div>
                    <div class="w-4 h-8 bg-gray-500">
                    </div>
                    <div class="w-4 h-8 bg-gray-400">
                    </div>
                    <div class="w-4 h-8 bg-gray-300 rounded-tr-md rounded-br-md">
                    </div>
                </div>
                <div class="font-bold text-lg tracking-widest leading-none">
                    PENTRA
                </div>
                <div class="text-xs tracking-widest">
                    STUDIO
                </div>
            </div>
            <div class="md:w-3/4 relative">
                <h1
                    class="text-3xl sm:text-4xl md:text-5xl font-semibold leading-tight drop-shadow-[0_2px_2px_rgba(0,0,0,0.4)]">
                    Shaping Ideas Through
                </h1>
                <h2 class="text-xl sm:text-2xl md:text-3xl font-semibold -mt-2 drop-shadow-[0_2px_2px_rgba(0,0,0,0.4)]">
                    Five Dimensions of Innovation
                </h2>
                <p class="mt-6 text-xs tracking-widest">
                    Logo &amp; Creative Solution | Web Design | Media Social Creative |
                </p>
                <!-- Ellipse and sparkle -->
                <svg aria-hidden="true" class="absolute top-0 left-1/4 w-[400px] h-[200px] -z-10" fill="none"
                    viewbox="0 0 400 200" xmlns="http://www.w3.org/2000/svg">
                    <ellipse cx="200" cy="100" fill="none" rx="190" ry="60" stroke="black" stroke-width="0.5">
                    </ellipse>
                    <circle cx="320" cy="80" fill="url(#grad)" fill-opacity="0.3" r="60">
                    </circle>
                    <defs>
                        <radialgradient cx="0" cy="0" gradienttransform="translate(320 80) rotate(90) scale(60)"
                            gradientunits="userSpaceOnUse" id="grad" r="1">
                            <stop stop-color="#D9D9D9" stop-opacity="0.6">
                            </stop>
                            <stop offset="1" stop-color="#D9D9D9" stop-opacity="0">
                            </stop>
                        </radialgradient>
                    </defs>
                    <!-- sparkle -->
                    <g fill="#FDE047" filter="url(#sparkle)" stroke="#FDE047" stroke-width="0.5">
                        <circle cx="280" cy="40" r="3">
                        </circle>
                        <path d="M280 33v14M273 40h14" stroke-linecap="round">
                        </path>
                    </g>
                    <filter color-interpolation-filters="sRGB" filterunits="userSpaceOnUse" height="20" id="sparkle"
                        width="20" x="270" y="30">
                        <fedropshadow dx="0" dy="0" flood-color="#FDE047" stddeviation="0.5">
                        </fedropshadow>
                    </filter>
                </svg>
                <!-- Arrow up right -->
                <svg aria-hidden="true" class="absolute top-10 right-0 w-12 h-12 stroke-gray-400" fill="none"
                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewbox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M17 7l4 4m0 0l-4 4m4-4H7">
                    </path>
                </svg>
            </div>
        </div>
        <!-- Social icons left side -->
        <div class="absolute left-4 top-40 flex flex-col space-y-2 text-xs text-gray-600">
            <div class="flex items-center space-x-2">
                <i class="fab fa-instagram">
                </i>
                <span>
                    @PENTRA_fix
                </span>
            </div>
            <div class="flex items-center space-x-2">
                <i class="fab fa-facebook-f">
                </i>
                <span>
                    @PENTRA_live
                </span>
            </div>
        </div>
        <!-- WhatsApp floating button right side -->
        <a aria-label="WhatsApp contact"
            class="fixed bottom-20 right-6 bg-green-600 hover:bg-green-700 text-white rounded-full w-12 h-12 flex items-center justify-center shadow-lg"
            href="#">
            <i class="fab fa-whatsapp fa-lg">
            </i>
        </a>
    </section>
    <!-- Section Kreatif dan Berkualitas -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-20 text-center">
        <p class="text-xs text-gray-500 mb-1">
            Mengapa Pentra Studio?
        </p>
        <h3 class="text-2xl font-normal mb-2">
            Kreatif dan Berkualitas
        </h3>
        <p class="text-xs text-gray-400 max-w-xl mx-auto">
            We adhere to the highest standards of quality in all our products and
            services. From design and development to manufacturing.
        </p>
    </section>
    <!-- Kreatif, Solutif, Kualitas Tinggi, Kolaboratif -->
    <section
        class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-12 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8 text-center">
        <div>
            <div class="mx-auto mb-3 w-10 h-10 rounded-full bg-gray-300 flex items-center justify-center text-gray-600">
                <i class="fas fa-palette">
                </i>
            </div>
            <h4 class="font-semibold mb-1">
                Kreatif
            </h4>
            <p class="text-xs text-gray-500 max-w-[180px] mx-auto">
                Kami menggabungkan unsur seni dan strategi untuk menghasilkan Karya yang
                menghidupkan identities brand Anda.
            </p>
        </div>
        <div>
            <div class="mx-auto mb-3 w-10 h-10 rounded-full bg-gray-300 flex items-center justify-center text-gray-600">
                <i class="fas fa-lightbulb">
                </i>
            </div>
            <h4 class="font-semibold mb-1">
                Solutif
            </h4>
            <p class="text-xs text-gray-500 max-w-[180px] mx-auto">
                Setiap bisnis itu unik. Karena itu, kami menciptakan konten yang berbeda
            </p>
        </div>
        <div>
            <div class="mx-auto mb-3 w-10 h-10 rounded-full bg-gray-300 flex items-center justify-center text-gray-600">
                <i class="fas fa-check-circle">
                </i>
            </div>
            <h4 class="font-semibold mb-1">
                Kualitas Tinggi
            </h4>
            <p class="text-xs text-gray-500 max-w-[180px] mx-auto">
                Mulai dari konsep hingga hasil akhir, kami selalu menjunjung tinggi
                kualitas.
            </p>
        </div>
        <div>
            <div class="mx-auto mb-3 w-10 h-10 rounded-full bg-gray-300 flex items-center justify-center text-gray-600">
                <i class="fas fa-users">
                </i>
            </div>
            <h4 class="font-semibold mb-1">
                Kolaboratif
            </h4>
            <p class="text-xs text-gray-500 max-w-[180px] mx-auto">
                Kami menjalin komunikasi yang terbuka dan aktif dengan klien.
            </p>
        </div>
    </section>
    <!-- Layanan Kami -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-20">
        <h3 class="text-center text-xl font-normal mb-1">
            Layanan Kami
        </h3>
        <p class="text-center text-xs text-gray-500 max-w-3xl mx-auto mb-8">
            Karena kami berkomitmen untuk memberikan layanan yang solutif dan
            menyeluruh (end-to-end), kami menghadirkan ketiga layanan—Desain Grafis,
            <?php
            require_once 'config/db.php';
            $query = $pdo->prepare("SELECT * FROM categories");
            $query->execute();
            $categories = $query->fetchAll();
            foreach ($categories as $category) {
                ?> Videografi, dan Fotografi—sekaligus dalam satu atap untuk memenuhi
            berbagai kebutuhan visual brand Anda.
        </p>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            <!-- Graphic Design -->

           
                <article>
                    <img alt="<?php echo $category['name']; ?>" class="rounded-lg w-full object-cover h-72" height="300"
                        src="<?php echo $category['image']; ?>" width="400" />
                    <h4 class="font-semibold mt-4 mb-2">
                        <?php echo $category['name']; ?>
                    </h4>
                    <p class="text-xs text-gray-600 mb-2">
                        <?php echo $category['description']; ?>

                    </p>
                    <a class="text-xs font-semibold flex items-center space-x-1 hover:underline"
                        href="category.php?id=<?php echo $category['id']; ?>">
                        <span>
                            Read More
                        </span>
                        <i class="fas fa-arrow-right">
                        </i>
                    </a>
                </article>
                <?php
            }
            ?>
            <!-- Videography -->
            <!-- <article>
     <img alt="Woman in yellow sweater posing in graffiti alley, representing videography" class="rounded-lg w-full object-cover h-72" height="300" src="https://storage.googleapis.com/a1aa/image/bc0b4a33-311f-4e6d-5cf4-e28f23dd7524.jpg" width="400"/>
     <h4 class="font-semibold mt-4 mb-2">
      Videography
     </h4>
     <p class="text-xs text-gray-600 mb-2">
      Kami memproduksi video yang mampu menyampaikan cerita dan pesan
          brand Anda secara kuat dan emosional, cocok untuk kebutuhan promosi,
          profil perusahaan, hingga konten media sosial.
     </p>
     <a class="text-xs font-semibold flex items-center space-x-1 hover:underline" href="#">
      <span>
       Read More
      </span>
      <i class="fas fa-arrow-right">
      </i>
     </a>
    </article> -->
            <!-- Photography -->
            <!-- <article>
     <img alt="Man on escalator with blue background, representing photography" class="rounded-lg w-full object-cover h-72" height="300" src="https://storage.googleapis.com/a1aa/image/d2d0bcb1-2bfa-414b-ac49-8934d5a4b91c.jpg" width="400"/>
     <h4 class="font-semibold mt-4 mb-2">
      Photography
     </h4>
     <p class="text-xs text-gray-600 mb-2">
      Kami menghadirkan foto berkualitas tinggi yang mampu menangkap momen,
          produk, atau suasana dengan estetika yang kuat dan sesuai dengan
          karakter brand Anda.
     </p>
     <a class="text-xs font-semibold flex items-center space-x-1 hover:underline" href="#">
      <span>
       Read More
      </span>
      <i class="fas fa-arrow-right">
      </i>
     </a>
    </article> -->
        </div>
    </section>
    <!-- gallery -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-20">
        <h3 class="text-center text-xl font-normal mb-1">
            Galeri Karya Kami
        </h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            <?php

            $query = $pdo->prepare("
    SELECT si.image, c.name AS category_name
    FROM service_images si
    JOIN services s ON si.service_id = s.id
    JOIN categories c ON s.category_id = c.id
    ORDER BY c.name
");
            $query->execute();
            $results = $query->fetchAll();

            $current_category = null;

            foreach ($results as $row) {
                if ($current_category !== $row['category_name']) {
                    // Tampilkan nama kategori di awal grup baru
                    $current_category = $row['category_name'];
                    echo '<h2 class="text-2xl font-bold mb-4 mt-8">' . htmlspecialchars($current_category) . '</h2>';
                }
                // Tampilkan gambar
                echo '<img alt="" class="rounded-lg w-full object-cover h-72 mb-4" src="' . htmlspecialchars($row['image']) . '"/>';
            }
            ?>
        </div>

        </div>
        <!-- Tim Kami -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-20 mb-20">
            <h3 class="text-xl font-normal mb-2">
                Tim Kami
            </h3>
            <p class="text-xs text-gray-600 max-w-md mb-8">
                Secara efektif Kami memberikan layanan yang solutif bagi klien Kami.
            </p>
            <div class="flex space-x-12">
                <div class="flex flex-col items-center text-center space-y-2">
                    <img alt="Portrait of a woman wearing headscarf, team member" class="rounded-full" height="80"
                        src="https://storage.googleapis.com/a1aa/image/b21171ce-2bd8-4d8d-60de-26822db11e22.jpg"
                        width="80" />
                    <p class="text-xs font-semibold">
                        Nadia Irwan
                    </p>
                    <p class="text-xs text-gray-400">
                        Creative Strategic
                    </p>
                </div>
                <div class="flex flex-col items-center text-center space-y-2">
                    <img alt="Portrait of a man with short hair, team member" class="rounded-full" height="80"
                        src="https://storage.googleapis.com/a1aa/image/9aff6efa-eafe-4bbd-7234-0be9be05e9cc.jpg"
                        width="80" />
                    <p class="text-xs font-semibold">
                        Zacky Zaifa
                    </p>
                    <p class="text-xs text-gray-400">
                        Product Strategic
                    </p>
                </div>
            </div>
        </section>
        <!-- Footer -->
        <?php include 'components/footer.php'; ?>
</body>

</html>