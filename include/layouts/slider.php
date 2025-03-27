<?php
function renderSlider($products)
{
?>
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            <?php foreach ($products as $product): ?>
                <div class="swiper-slide shrink-0">
                    <div
                        class="h-full shrink-0 max-w-sm bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                        <a href="/../php_shop/pages/single.php?id=<?= $product['id']; ?>">
                            <img
                                class="rounded-t-lg"
                                src="./upload/img.jpeg"
                                alt="image of <?php echo $product['title']; ?>" />
                        </a>
                        <div class="p-5 text-left">
                            <div>
                                <a href="/../php_shop/pages/single.php?id=<?= $product['id']; ?>">
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                        <?php
                                        $titleWords = explode(' ', $product['title']);
                                        echo implode(' ', array_slice($titleWords, 0, 3)) . (count($titleWords) > 3 ? " ..." : "");
                                        ?>
                                    </h5>
                                </a>

                                <p class="mb-3 font-normal text-justify text-gray-700 dark:text-gray-400">
                                    <?=
                                    substr($product['description'], 0, 200)
                                    ?>
                                </p>
                            </div>
                            <a
                                href="/../php_shop/pages/single.php?id=<?= $product['id']; ?>"
                                class="inline-flex items-center w-fit px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                More Details
                                <svg
                                    class="rtl:rotate-180 w-3.5 h-3.5 ms-2"
                                    aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 14 10">
                                    <path
                                        stroke="currentColor"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M1 5h12m0 0L9 1m4 4L9 9" />
                                </svg>
                            </a>

                        </div>
                    </div>
                </div>
            <?php endforeach  ?>
        </div>
        <div class="swiper-pagination"></div>
    </div>
<?php
}
?>