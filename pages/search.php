<?php
// Check empty query before including header
$search_query = isset($_GET['q']) ? trim($_GET['q']) : '';

if (empty($search_query)) {
    header("Location: ../index.php");
    exit;
}

// Include header after redirect check
include_once "../include/layouts/header.php";

// Search in database
$stmt = $db->prepare("SELECT * FROM products WHERE title LIKE :query OR description LIKE :query");
$stmt->execute(['query' => '%' . $search_query . '%']);
$results = $stmt->fetchAll();
?>

<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-4">Search Results for: <?= htmlspecialchars($search_query) ?></h1>

    <?php if (count($results) > 0): ?>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <?php foreach ($results as $product): ?>
                <?php include "../include/layouts/card_item.php"; ?>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p class="text-center text-gray-600 dark:text-gray-400">No results found!</p>
    <?php endif; ?>
</div>

<?php include_once "../include/layouts/footer.php"; ?>