<div class="create-brand">
    <h1><?=isset($brand) ? 'Edit Brand' : 'Create Brand';?></h1>
    <?php if (isset($error)): ?>
        <div class="alert alert-danger">
            <?=$error; ?>
        </div>
    <?php endif; ?>
    <form class="row" action="<?= isset($brand)?url('admin/brands/update/'.$brand['brand_id']):route('create_brand')?>" method="post" enctype="multipart/form-data">
        <div class="col-8">
            <div class="form-group my-3">
                <label for="brand_name">Brand Name</label>
                <input type="text" class="form-control" id="brand_name" name="brand_name" placeholder="Brand Name" value="<?=@$brand['brand_name']?>">
            </div>
            <div class="form-group my-3">
                <label for="brand_description">Brand Description</label>
                <input type="text" class="form-control" id="brand_description" name="brand_description" placeholder="Brand Description" value="<?=@$brand['brand_description']?>">
            </div>
        </div>
        <div class="col-4">
            <div class="preview-logo">
                <img class="w-100 image-lg"
                    src="<?= isset($brand) ? url('public/images/products/') . $brand['brand_image'] : '' ?>"
                    alt="">
            </div>
            <div class="form-group my-3 my-3">
                <label for="brand_image">brand Image</label>
                <input type="file" class="form-control" id="brand_image" name="brand_image" value="<?=@$brand['brand_image']?>">
            </div>
            <div class="form-group my-3">
                <label for="brand_status">Brand Status</label>
                <select class="form-control" id="brand_status" name="brand_status">
                    <option value="1" <?=@$brand['brand_status'] == 1 ? 'selected' : ''?>>Active</option>
                    <option value="0" <?=@$brand['brand_status'] == 0 ? 'selected' : ''?>>Inactive</option>
                </select>
            </div>
        </div>
        <div class="form-group my-3">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>