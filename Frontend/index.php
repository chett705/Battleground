<!DOCTYPE html>
<?php include "Header/header.php";
include "Config/connect.php";
$sql = "SELECT * FROM categories";
$result = mysqli_query($con, $sql);

$menu = "
    SELECT m.*, c.category_name
    FROM menu_items m
    JOIN categories c ON m.category_id = c.category_id
    ORDER BY m.description DESC
";
$menu_result = mysqli_query($con, $menu);
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffee Battleground</title>

    <link rel="stylesheet" href="Style/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body>

    <nav class="navbar">
        <div class="container">
            <div class="logo">
                <a href="#">Coffee Battleground</a>
            </div>

            <ul class="nav-links">
                <li><a href="#">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="#">Contact</a></li>
            </ul>

            <div class="button">
                <i class="bi bi-person"></i>
                <a href="/cart"><i class="bi bi-cart"></i></a>
            </div>
        </div>
    </nav>

    <!-- Hero -->
    <div class="hero-section">
        <div class="hero-overlay">
            <h1>Welcome to Coffee Battleground</h1>
            <p>Your ultimate destination for premium coffee experiences.</p>
            <a href="" class="hero-btn">Shop Now</a>
        </div>

    </div>
    <!-- Categories Section -->
    <div class="container mx-auto py-16 p-4">
        <h2 class="text-2xl font-mono mb-8">Our Categories</h2>
        <div class="flex flex-wrap mt-3 justify-between">

            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="w-[48%] h-[220px] md:w-[32.2%] md:h-[350px] lg:w-[15.9%] lg:h-[200px]
                rounded-2xl overflow-hidden relative my-1 
                hover:text-cyan-500 duration-150 
                border-2 border-gray-200 text-center
                flex items-center justify-center hover:scale-105 transition-transform">
                    <div class="grid">
                        <p class="z-10 text-xl font-bold">' . $row['category_name'] . '</p>
                     
                    </div>
                </div>';
            }
            ?>



        </div>


    </div>

    </div>
    <!-- get discount -->
    <div class="container">
        <div class="discount-overlay">
            <h2>Get 10% Off Your First Order!</h2>
            <div class=' flex flex-wrap mt-5 justify-between  gap-2 '>
                <div class='w-full sm:w-[48%] lg:w-[24%] mt-3 border overflow-hidden rounded-lg bg-yellow-100 '>
                    <div class='p-4'>
                        <p class='text-xl font-bold pb-2'>Save</p>
                        <p class='text-2xl font-bold mb-2'><sup>
                                $</sup>2.00</p>
                        <p class='text-[1rem] font-medium'>When you buy coffee 2 up</p>

                    </div>
                    <div class='w-full h-[220px]  overflow-hidden'>
                        <img src="https://png.pngtree.com/png-clipart/20231003/original/pngtree-cold-brewed-iced-latte-coffee-on-plastic-cup-side-view-generative-png-image_13245985.png" alt="" class=' w-full h-full object-cover hover:scale-105 duration-300' />

                    </div>

                </div>
                <div class='w-full sm:w-[48%] lg:w-[24%] border mt-3 overflow-hidden rounded-lg bg-blue-100 '>
                    <div class='p-4'>
                        <p class='text-xl font-bold pb-2'>Save</p>
                        <p class='text-2xl font-bold mb-2'><sup>
                                $</sup>2.50</p>
                        <p class='text-[1rem] font-medium'>You buy 2 Smoothie up</p>

                    </div>
                    <div class='w-full h-[220px]  overflow-hidden'>
                        <img src="https://file.aiquickdraw.com/imgcompressed/img/compressed_e8239efc058eb921696ef5d9d7c9a1bb.webp" alt="" class=' w-full h-full object-cover hover:scale-105 duration-300' />

                    </div>

                </div>
                <div class='w-full sm:w-[48%] lg:w-[24%] mt-3 border overflow-hidden rounded-lg bg-purple-100 '>
                    <div class='p-4'>
                        <p class='text-xl font-bold pb-2'>Save</p>
                        <p class='text-2xl font-bold mb-2'><sup>
                                $</sup>2.5</p>
                        <p class='text-[1rem] font-medium'>Buy 3 Bakery free 1 and get discount</p>

                    </div>
                    <div class='w-full h-[220px]  overflow-hidden'>
                        <img src="https://png.pngtree.com/png-clipart/20240518/original/pngtree-bakery-shop-desserts-sweet-cakes-and-cookies-png-image_15121469.png" alt="" class=' w-full h-full object-cover hover:scale-105 duration-300' />

                    </div>

                </div>
                <div class='w-full sm:w-[48%] lg:w-[24%] mt-3 border overflow-hidden rounded-lg bg-cyan-100 '>
                    <div class='p-4'>
                        <p class='text-xl font-bold pb-2'>Save</p>
                        <p class='text-2xl font-bold mb-2'><sup>
                                $</sup>3.00</p>
                        <p class='text-[1rem] font-medium'>Buy 2 Tea get discount</p>

                    </div>
                    <div class='w-full h-[220px]  overflow-hidden'>
                        <img src="https://png.pngtree.com/png-vector/20250805/ourmid/pngtree-taro-milk-tea-beverage-isolated-on-transparent-background-png-image_16836651.webp" alt="" class=' w-full h-full object-cover hover:scale-105 duration-300' />

                    </div>

                </div>

            </div>

        </div>
    </div>
    <!-- show products -->
    <div class="container">
        <h1> Today Best deals for you</h1>

        <ul class="nav nav-pills category-tabs mb-3">
            <li class="nav-item">
                <a class="nav-link btn-active" href="#" data-category="all">All</a>
            </li>

            <?php foreach ($result as $cat): ?>
                <li class="nav-item">
                    <a class="nav-link"
                        href="#"
                        data-category="<?= $cat['category_id'] ?>">
                        <?= htmlspecialchars($cat['category_name']) ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>


        <div class="menu-table d-flex flex-wrap gap-3">
            <!-- product rows will go here -->

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                <?php foreach ($menu_result as $product): ?>
                    <div class="rounded-xl px-3 py-3 border border-gray-200 overflow-hidden
                transition hover:shadow-lg hover:-translate-y-1 duration-200  menu-row" data-category="<?= $product['category_id'] ?>">

                        <img
                            src="<?= !empty($product['image'])
                                        ? '../../uploads/' . htmlspecialchars($product['image'])
                                        : 'https://developers.elementor.com/docs/assets/img/elementor-placeholder-image.png' ?>"
                            alt="<?= htmlspecialchars($product['item_name']) ?>"
                            class="w-full h-[180px] object-contain rounded-md" />

                        <div class="mt-4">
                            <div class="flex justify-between items-start gap-2">
                                <h2 class="text-base font-semibold line-clamp-2">
                                    <?= htmlspecialchars($product['item_name']) ?>
                                </h2>

                                <span class="text-lg font-mono text-cyan-600 whitespace-nowrap">
                                    <?= number_format($product['price'], 2) ?>$
                                </span>
                            </div>

                            <p class="text-sm line-clamp-1 text-gray-600 mt-1">
                                <?= htmlspecialchars($product['description']) ?>
                            </p>

                            <div class="flex items-center mt-2 mb-4 text-green-500 text-sm">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                            </div>

                            <button
                                class="w-full rounded-4 border hover:bg-cyan-200
                       text-black py-2 font-medium hover:text-white duration-300"
                                data-id="<?= $product['id'] ?>">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>
    </div>
    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 mt-16 p-5">
        
        <div class="max-w-7xl mx-auto px-6 py-12 grid grid-cols-1 md:grid-cols-4 gap-8">

            <!-- Brand -->
            <div>
                <h2 class="text-2xl font-bold text-white">Battleground Coffee</h2>
                <p class="mt-3 text-sm text-gray-400">
                   Your ultimate destination for premium coffee experiences
                </p>
            </div>

            <!-- Links -->
            <div>
                <h3 class="text-white font-semibold mb-4">Quick Links</h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="#" class="hover:text-white">Home</a></li>
                    <li><a href="#" class="hover:text-white">About</a></li>
                    <li><a href="#" class="hover:text-white">Services</a></li>
                    <li><a href="#" class="hover:text-white">Contact</a></li>
                </ul>
            </div>

            <!-- Support -->
            <div>
                <h3 class="text-white font-semibold mb-4">Support</h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="#" class="hover:text-white">Help Center</a></li>
                    <li><a href="#" class="hover:text-white">Privacy Policy</a></li>
                    <li><a href="#" class="hover:text-white">Terms of Service</a></li>
                </ul>
            </div>

            <!-- Social -->
            <div>
                <h3 class="text-white font-semibold mb-4">Follow Us</h3>
                <div class="flex space-x-4">
                    <a href="#" class="hover:text-white">Facebook</a>
                    <a href="#" class="hover:text-white">Twitter</a>
                    <a href="#" class="hover:text-white">Instagram</a>
                </div>
            </div>

        </div>

        <!-- Bottom -->
        <div class="border-t border-gray-700 text-center py-4 text-sm text-gray-400">
            © 2026 battleground. All rights reserved.
        </div>
    </footer>


</body>
<script>
    (function() {
        const container = document.querySelector('.menu-table');

        document.querySelectorAll('.category-tabs .nav-link').forEach(tab => {
            tab.addEventListener('click', function(e) {
                e.preventDefault();

                document.querySelectorAll('.category-tabs .nav-link')
                    .forEach(t => t.classList.remove('active'));
                this.classList.add('active');

                const cat = this.dataset.category;

                container.querySelectorAll('.menu-row').forEach(row => {
                    const rowCat = row.dataset.category;
                    row.style.display =
                        (cat === 'all' || cat === rowCat) ? 'block' : 'none';
                });
            });
        });
    })();
</script>


</html>