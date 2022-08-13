<div class="slides-manager">
    <div class="slides-manager-header">
        <div class="slides-manager-header-title">
            <h2>Slides</h2>
        </div>
        <div class="slides-manager-header-action">
            <a href="<?= route('create_slide') ?>" class="btn btn-primary">Create Slide</a>
        </div>
    </div>
    <div class="slides-manager-body">
        <div class="slides-manager-body-table">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($slides as $slide): ?>
                    <tr>
                        <td><?=$slide['slide_id'] ?></td>
                        <td>
                            <img class="w-100" src="<?= url('public/images/products/') . $slide['slide_image'] ?>" alt="">
                        </td>
                        <td><?=$slide['slide_name'] ?></td>
                        <td><?=$slide['slide_status']==1?'Yes':'No' ?></td>
                        <td>
                            <a href="<?=url('admin/slides/edit/'.$slide['slide_id']) ?>" class="btn btn-primary">Edit</a>
                            <a href="<?=url('admin/slides/delete/'.$slide['slide_id']) ?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>