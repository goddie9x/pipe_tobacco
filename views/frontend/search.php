<?php include_once './views/frontend/products/renderItem.php'; ?>
<div class="container search-result my-5">
    <?php if(count($products) > 0||count($news) > 0): ?>
    <div class="row">
        <div class="col-md-12">
            <div class="search-result-title">
                <h3>Kết quả tìm kiếm cho: <span><?= $keyword ?></span></h3>
            </div>
        </div>
    </div>
    <?php if(count($products) > 0): ?>
    <h3 class="text-center my-5 title-product">Danh sách sản phẩm</h3>
    <div class="d-flex my-5">
        <?php foreach ($products as $item): ?>
        <div class="col-lg-3 col-md-4 col-6">
            <?= renderProductItem($item) ?>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
    <?php if($news!=null&&count($news) > 0):?>
    <?php include_once './views/frontend/news/index.php'; ?>
    <?php endif; ?>
    <?php else: ?>
    <div class="row">
        <div class="col-md-12">
            <div class="search-result-title">
                <h3>Không tìm thấy kết quả nào cho: <span><?= $keyword ?></span></h3>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>
