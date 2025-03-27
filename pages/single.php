<?php
include_once "../include/layouts/header.php";

if (isset($_GET['id'])) {
    $productId = (int) $_GET['id'];
    $productData = $db->prepare("SELECT * FROM products WHERE id = :id ;");
    $productData->execute(['id' => $productId]);
    $productData = $productData->fetch();
}

?>

<body class="bg-white dark:bg-gray-900 text-gray-900 dark:text-white p-6">
    <div class="max-w-3xl mx-auto border border-gray-200 rounded-lg p-4 dark:border-gray-600">
        <!-- بخش تصویر و اطلاعات محصول -->
        <div class="flex flex-col md:flex-row gap-4">
            <div class="flex-shrink-0 w-full">
                <img
                    src="../upload/img.jpeg"
                    alt="<?= $productData['title'] ?>"
                    class="w-full md:w-64 h-auto object-cover rounded" />
            </div>

            <!-- توضیحات محصول -->
            <div class="flex flex-col justify-between">
                <div>
                    <h2 class="text-lg md:text-xl font-semibold mb-2">
                        <?= $productData['title'] ?>
                    </h2>
                    <p class="text-xl font-bold mb-2">$ <?= $productData['price'] ?></p>

                    <!-- بخش امتیاز و تعداد نظرات -->
                    <div class="flex items-center gap-2 mb-2">
                        <span class="text-yellow-300">
                            <?php
                            for ($i = 0; $i < round($productData['rate']); $i++) {
                                echo "⭐";
                            }
                            ?>
                        </span>
                        <span class="text-gray-500 dark:text-gray-400 text-sm"><?= $productData['rate'] ?></span>
                        <span class="text-gray-500 dark:text-gray-400 text-sm">(<?= $productData['sell_count'] ?> Customer) </span>
                    </div>

                    <!-- توضیحات تکمیلی محصول -->
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">
                        <?= $productData['description'] ?>
                    </p>
                </div>

                <!-- دکمه‌ها -->
                <div class="mt-4 flex gap-2">
                    <button
                        id="favoriteBtn"
                        type="button"
                        class="cursor-pointer px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded
                   hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-100
                   dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600
                   dark:hover:text-white dark:hover:bg-gray-700">
                        Add to favorites
                    </button>
                    <button
                        id="addToCardBtn"
                        type="button"
                        class="cursor-pointer px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded
                   hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-100
                   dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600
                   dark:hover:text-white dark:hover:bg-gray-700">
                        Add to cart
                    </button>
                </div>
            </div>
        </div>
    </div>
</body>
<?php
include_once "../include/layouts/footer.php"
?>

<!-- Javascript -->
<script>
    let favoriteBtn = document.getElementById('favoriteBtn');
    let favorites = JSON.parse(localStorage.getItem('favorites')) || [];

    // چک کردن وضعیت اولیه دکمه
    if (favorites.some(product => product.id === <?= $productData['id'] ?>)) {
        favoriteBtn.textContent = "Remove from Favorites";
    }

    favoriteBtn.addEventListener("click", () => {
        let favorites = JSON.parse(localStorage.getItem('favorites')) || [];
        let productIndex = favorites.findIndex(product => product.id === <?= $productData['id'] ?>);

        if (productIndex === -1) {
            // اضافه کردن به علاقه‌مندی‌ها
            favorites.push({
                id: <?= $productData['id'] ?>,
                title: "<?= $productData['title'] ?>"
            });

            Swal.fire({
                title: 'Added to Favorites!',
                text: 'This item has been added to your favorites.',
                icon: 'success',
                confirmButtonText: 'Awesome!',
                timer: 2000,
                timerProgressBar: true
            });

            favoriteBtn.textContent = "Remove from Favorites";
        } else {
            // حذف از علاقه‌مندی‌ها
            favorites.splice(productIndex, 1);

            Swal.fire({
                title: 'Removed from Favorites!',
                text: 'This item has been removed from your favorites.',
                icon: 'warning',
                confirmButtonText: 'Ok',
                timer: 2700,
                timerProgressBar: true
            });

            favoriteBtn.textContent = "Add to Favorites";
        }

        localStorage.setItem('favorites', JSON.stringify(favorites));
    });

    // ! Add To Card 

    let addToCardBtn = document.getElementById('addToCardBtn');
    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    // چک کردن وضعیت اولیه دکمه
    if (cart.some(product => product.id === <?= $productData['id'] ?>)) {
        addToCardBtn.textContent = "Remove from Cart";
    }

    addToCardBtn.addEventListener("click", () => {
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        let productIndex = cart.findIndex(product => product.id === <?= $productData['id'] ?>);

        if (productIndex === -1) {
            // اضافه کردن به سبد خرید
            cart.push({
                id: <?= $productData['id'] ?>,
                title: "<?= $productData['title'] ?>"
            });

            Swal.fire({
                title: 'Added to Cart!',
                text: 'This item has been added to your cart.',
                icon: 'success',
                confirmButtonText: 'Ok',
                timer: 2000,
                timerProgressBar: true
            });

            addToCardBtn.textContent = "Remove from Cart";
        } else {
            // حذف از سبد خرید
            cart.splice(productIndex, 1);

            Swal.fire({
                title: 'Removed from Cart!',
                text: 'This item has been removed from your cart.',
                icon: 'warning',
                confirmButtonText: 'Ok',
                timer: 2700,
                timerProgressBar: true
            });

            addToCardBtn.textContent = "Add to Cart";
        }

        localStorage.setItem('cart', JSON.stringify(cart));
    });
</script>