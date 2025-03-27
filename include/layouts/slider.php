<?php
function renderSlider($products)
{
?>
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            <?php foreach ($products as $product): ?>
                <div class="swiper-slide">
                    <?php include dirname(__FILE__) . "/card_item.php"; ?>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="swiper-pagination"></div>
    </div>
<?php
}
?>