<div class="create-category">
    <?php if (isset($error)): ?>
        <div class="alert alert-danger">
            <?=$error; ?>
        </div>
    <?php endif; ?>
    <h1><?= isset($category)? 'Edit Category' : 'Create Category' ?></h1>
    <form class="row"
        action="<?= isset($category) ? url('admin/categories/update/') . $category['category_id'] : route('create_category') ?>"
        method="POST" enctype="multipart/form-data">
        <div class="col-8">
            <div class="form-group my-3">
                <label for="category_name">Category Name</label>
                <input type="text" class="form-control" id="category_name" name="category_name"
                    placeholder="Enter Category Name"
                    <?= isset($category) ? 'value="' . $category['category_name'] . '"' : '' ?>>
            </div>
            <div class="form-group my-3">
                <label for="nav_id">Category path</label>
                <select class="form-control" id="nav_id" name="nav_id">
                    <?php foreach($navs as $nav): ?>
                    <option value="<?= $nav['nav_id'] ?>"
                        <?= isset($category) && $category['nav_id'] == $nav['nav_id'] ? 'selected' : '' ?>>
                        <?= $nav['nav_path'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group my-3">
                <label for="category_description">Category Description</label>
                <textarea class="form-control" id="category_description" name="category_description" rows="3"
                    placeholder="Enter Category Description"><?= isset($category) ? $category['category_description'] : '' ?></textarea>
            </div>
        </div>
        <div class="col-4">
            <div class="preview-logo image-lg my-3">
                <img class="w-100"
                    src="<?= isset($category) ? url('public/images/products/') . $category['category_image'] : '' ?>"
                    alt="">
            </div>
            <div class="form-group my-3">
                <label for="category_image">Category Image</label>
                <input type="file" class="form-control" id="category_image" name="category_image">
            </div>
            <div class="form-group my-3">
                <label for="category_status">Category Status</label>
                <select class="form-control" id="category_status" name="category_status">
                    <option value="1"
                        <?= isset($category) && $category['category_status'] == 1 ? 'selected' : '' ?>>Active</option>
                    <option value="0"
                        <?= isset($category) && $category['category_status'] == 0 ? 'selected' : '' ?>>Inactive</option>
                </select>
            </div>
        </div>
        <div class="form-group my-3">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
