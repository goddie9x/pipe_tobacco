<?php if(count($slide)>0): ?>
<div class="col-md-12 my-3">
    <div class="main-slide swiper">
        <div class="swiper-wrapper">
            <?php foreach ($slide as $item): ?>
            <div class="swiper-slide">
                <img class="w-100 rounded" src="<?= url('public/images/products/' . $item['slide_image']) ?>" alt="">
            </div>
            <?php endforeach; ?>
        </div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    </div>
</div>
<?php endif; ?>
