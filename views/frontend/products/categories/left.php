<div class="left-categories">
    <div class="list-categories">
        <h2 class="text-center title-product">Danh mục sản phẩm</h2>
        <ul class="list-group">
            <?php foreach ($categories as $category): ?>
            <li class="list-group-item">
                <a
                    href="<?= url($category['category_path']) ?>"><?= $category['category_name'] ?></a>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="list-brands">
        <h2 class="text-center title-product">Thương hiệu</h2>
        <ul class="list-group">
            <?php foreach ($brands as $brand): ?>
            <li class="list-group-item">
                <a href="<?= url('products/brand/' . $brand['brand_id']) ?>"><?= $brand['brand_name'] ?></a>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
