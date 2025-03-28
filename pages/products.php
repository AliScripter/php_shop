<?php
include_once "../include/layouts/header.php";


// Start of Selection
if (isset($_GET['id'])) {
    $categoryId = (int) $_GET['id'];
    $stmt = $db->prepare("SELECT * FROM products WHERE category_id = :id ;");
    $stmt->execute(['id' => $categoryId]);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    //! Displaying products from a specific category
    $categoryStmt = $db->prepare("SELECT name FROM categories WHERE id = :id");
    $categoryStmt->execute(['id' => $categoryId]);
    $category = $categoryStmt->fetch(PDO::FETCH_ASSOC);
} else {
    // Get all products from database
    $stmt = $db->query("SELECT * FROM products");
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<div class="container mx-auto px-4 py-8">
    <?php if (isset($_GET['id'])) : ?>
        <h1 class="text-2xl font-bold capitalize mb-4"><?= htmlspecialchars($category['name']) ?> Products</h1>
    <?php else : ?>
        <h1 class="text-2xl font-bold capitalize mb-4">All Products</h1>
    <?php endif ?>

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