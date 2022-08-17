<?php include_once './views/frontend/products/renderItem.php'; ?>
<?php foreach ($categories as $category): ?>
<?php if (count($products[$category['category_id']]) > 0): ?>
<div class="col-md-12 my-3">
    <div class="list-product list-product-<?= $category['category_id'] ?> swiper">
        <h2 class="text-center title-product"><?= $category['category_name'] ?></h2>
        <div class="swiper-wrapper">
            <?php foreach ($products[$category['category_id']] as $item): ?>
            <div class="swiper-slide">
                <?= renderProductItem($item) ?>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
        <div class="swiper-pagination"></div>
        <div class="view-more text-center">
            <a href="<?= url($category['category_path']) ?>">Xem thêm <i class="fa fa-angle-double-right"></i></a>  
        </div>
    </div>
</div>
<?php endif; ?>
<?php endforeach; ?>
