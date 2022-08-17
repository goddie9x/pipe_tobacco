<?php include_once './views/frontend/products/renderItem.php'; ?>
<?php if (count($products) > 0): ?>
<div class="col-md-12 my-3">
    <div class="list-product list-product-<?= $category['category_id'] ?> swiper">
        <h2 class="text-center title-product"><?= $category['category_name'] ?></h2>
        <div class="d-flex">
            <?php foreach ($products as $item): ?>
            <div class="col-lg-3 col-md-4 col-6">
                <?= renderProductItem($item) ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php endif; ?>
