<?php
include_once "../include/layouts/header.php";

// Get all products from database
$stmt = $db->query("SELECT * FROM products");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-4">All Products</h1>

    <?php if (count($products) > 0): ?>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <?php foreach ($products as $product): ?>
                <?php include "../include/layouts/card_item.php"; ?>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p class="text-center text-gray-600 dark:text-gray-400">No products available!</p>
    <?php endif; ?>
</div>

<?php include_once "../include/layouts/footer.php"; ?>