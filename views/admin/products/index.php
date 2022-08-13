<div class="product-manager">
    <div class="product-manager-header">
        <div class="product-manager-header-title">
            <h2>Products</h2>
        </div>
        <div class="product-manager-header-action">
            <a href="<?= route('create_product') ?>" class="btn btn-primary">Create Product</a>
        </div>
    </div>
    <div class="product-manager-body">
        <div class="product-manager-body-table">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Is Hot</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?=$product['product_id'] ?></td>
                        <td>
                            <img class="w-100" src="<?= url('public/images/products/') . $product['product_image'] ?>" alt="">
                        </td>
                        <td><?=$product['product_name'] ?></td>
                        <td><?=$product['unit_cost'] ?></td>
                        <td><?=$product['hot']==1?'Yes':'No' ?></td>
                        <td>
                            <a href="<?=url('admin/products/edit/'.$product['product_id']) ?>" class="btn btn-primary">Edit</a>
                            <a href="<?=url('admin/products/delete/'.$product['product_id']) ?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5">
                            <ul class="pagination">
                                <?php if($pageNumber - 1 > 0):?>
                                <li class="page-item <?= $pageNumber == 1 ? 'disabled' : '' ?>">
                                    <a class="page-link"
                                        href="<?= url('admin/products?pageNumber=') . ($pageNumber) ?>">Previous</a>
                                </li>
                                <li class="page-item <?= $pageNumber == 1 ? 'disabled' : '' ?>">
                                    <a class="page-link"
                                        href="<?= url('admin/products?pageNumber=') . ($pageNumber) ?>">1</a>
                                </li>
                                <?php endif; ?>
                                <?php if($pageNumber+1>0): ?>
                                <li class="page-item <?= $pageNumber == 1 ? 'disabled' : '' ?>">
                                    <a class="page-link"
                                        href="<?= url('admin/products?pageNumber=') . ($pageNumber) ?>"><?= $pageNumber ?></a>
                                </li>
                                <?php endif; ?>
                                <?php if($totalPage>1): ?>
                                <li class="page-item <?= $pageNumber == $totalPage ? 'disabled' : '' ?>">
                                    <a class="page-link"
                                        href="<?= url('admin/products?pageNumber=') . ($pageNumber + 1) ?>">Next</a>
                                </li>
                                <li class="page-item <?= $pageNumber == $totalPage ? 'disabled' : '' ?>">
                                    <a class="page-link"
                                        href="<?= url('admin/products?pageNumber=') . $totalPage ?>"><?= $totalPage ?></a>
                                </li>
                                </li>
                                <?php endif; ?>
                            </ul>
                        </td>
                </tfoot>
            </table>
        </div>
    </div>
</div>
