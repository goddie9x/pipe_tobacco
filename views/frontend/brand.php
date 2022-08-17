<?php if (count($brands) > 0): ?>
<div class="col-md-12 my-3">
    <h2 class="text-center">Thương hiệu</h2>
    <div class="brands-slide list-product swiper">
        <div class="swiper-wrapper">
            <?php foreach ($brands as $brand): ?>
            <div class="swiper-slide brand-slide">
                <img class="w-100 rounded" src="<?= url('public/images/products/' . $brand['brand_image']) ?>" alt="">
            </div>
            <?php endforeach; ?>
        </div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
        <div class="swiper-pagination"></div>
    </div>
</div>
<?php endif; ?>
