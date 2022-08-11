<div class="pages-manager">
    <div class="pages-manager-header my-3">
        <h3>Pages Manager</h3>
        <a href="<?=@url('admin/pages/create')?>" class="btn btn-primary btn-sm">Create New Page</a>
    </div>
    <div class="pages-manager-body my-3">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($pages as $page):?>
                    <tr>
                        <td><?=$page['page_id']?></td>
                        <td><?=$page['page_name']?></td>
                        <td><?=$page['page_path']?></td>
                        <td>
                            <a href="<?=url('admin/pages/edit/' . $page['page_id'])?>" class="btn btn-primary btn-sm">Edit</a>
                            <a href="<?=url('admin/pages/delete/' . $page['page_id'])?>" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>