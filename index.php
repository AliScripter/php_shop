<?php
include_once "./clients/include/layouts/header.php";
include "./clients/include/layouts/slider.php";
?>


<!-- Most popular -->
<h3 class="text-center my-10 text-2xl font-bold text-gray-900">
    Most Popular Products
</h3>

<?php
$popular = $db->query("SELECT * FROM products WHERE rate >= 3.5 ORDER BY rate DESC LIMIT 5 ;");
$popularProducts = $popular->fetchAll(PDO::FETCH_ASSOC);
renderSlider($popularProducts);
?>


<!-- Bestsellers -->
<h3 class="text-center my-10 pt-5 text-2xl font-bold text-gray-900">
    Best Seller Products
</h3>

<?php
$bestSellers = $db->query("SELECT * FROM products WHERE sell_count > 0 ORDER BY sell_count DESC LIMIT 5 ;");
$bestSellerProducts = $bestSellers->fetchAll(PDO::FETCH_ASSOC);
renderSlider($bestSellerProducts);
?>

<!-- Show All Products Btn -->
<div class="blur-text-container">
    <p class="blur-text">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Harum, expedita minus eaque qui aliquid veniam tempora sint non corporis in autem sapiente? Dicta illum maxime omnis culpa explicabo fugit exercitationem.
    </p>
    <div class="fade-overlay"></div>
    <a
        href="#"
        class="inline-flex items-center w-fit px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        All Products
    </a>
</div>




<!-- Import Footer -->
<?php
include_once "./clients/include/layouts/footer.php";
?>