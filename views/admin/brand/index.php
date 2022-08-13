<div class="brands">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Brands</h4>
                    <a href="<?=@route('create_brand'); ?>" class="btn btn-primary btn-sm">Add</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                                <th>ID</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                <?php foreach($brands as $brand): ?>
                                    <tr>
                                        <td><?=$brand['brand_id']; ?></td>
                                        <td><?=$brand['brand_name']; ?></td>
                                        <td><img src="<?=@url('public/images/products/'.$brand['brand_image']); ?>" alt="<?=$brand['brand_name']; ?>" width="100"></td>
                                        <td><?=$brand['brand_status'] == 1 ? 'Active' : 'Inactive'; ?></td>
                                        <td>
                                            <a href="<?=@url('admin/brands/edit/'.$brand['brand_id']); ?>" class="btn btn-primary btn-sm">Edit</a>
                                            <a href="<?=@url('admin/brands/delete/'.$brand['brand_id']); ?>" class="btn btn-danger btn-sm">Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>