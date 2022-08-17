<div class="categories">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Categories</h4>
            <a href="<?=route('create_category')?>" class="btn btn-primary btn-round">
                <i class="fa fa-plus"></i>
                Add New
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead class=" text-primary">
                        <th>ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Status</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php foreach($categories as $category):?>
                            <tr>
                                <td><?=@$category['category_id']?></td>
                                <td class="image-lg"><img class="w-100" src="<?=url('public/images/products/' . $category['category_image'])?>" alt="<?=@$category['category_name']?>"></td>
                                <td><?=@$category['category_name']?></td>
                                <td><?=@$category['category_path']?></td>
                                <td><?=isset($category['category_status']) && $category['category_status'] == 1 ? 'Active' : 'Inactive'?></td>
                                <td>
                                    <a href="<?=url('admin/categories/edit/' . $category['category_id'])?>" class="btn btn-primary btn-round my-2">
                                        <i class="fa fa-edit"></i>
                                        Edit
                                    </a>
                                    <a href="<?=url('admin/categories/delete/' . $category['category_id'])?>" class="btn btn-danger btn-round my-2">
                                        <i class="fa fa-trash"></i>
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>  
</div>
