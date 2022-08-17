<?php if(isset($errors)): ?>
<?php foreach($errors as $error): ?>
<div class="alert alert-danger">
    <?php echo $error; ?>
</div>
<?php endforeach; ?>
<?php endif; ?>
<div class="create-category">
    <?php if (isset($error)): ?>
    <div class="alert alert-danger">
        <?= $error ?>
    </div>
    <?php endif; ?>
</div>
<script>
    window.onload = function() {
        CKEDITOR.editorConfig = function(config) {
            config.image_previewText = '';
        };

        CKEDITOR.replace('product_description', {
            filebrowserBrowseUrl: '<?= @url('admin/images-products') ?>',
            filebrowserImageBrowseUrl: '<?= @url('admin/images-products') ?>',
            filebrowserUploadUrl: '<?= @url('admin/upload-products') ?>',
            filebrowserImageUploadUrl: '<?= @url('admin/upload-products') ?>',
            config: {
                image_previewText: ''
            }
        });
        CKEDITOR.replace('product_content', {
            filebrowserBrowseUrl: '<?= @url('admin/images-products') ?>',
            filebrowserImageBrowseUrl: '<?= @url('admin/images-products') ?>',
            filebrowserUploadUrl: '<?= @url('admin/upload-products') ?>',
            filebrowserImageUploadUrl: '<?= @url('admin/upload-products') ?>',
            config: {
                image_previewText: ''
            }
        });
    }
</script>
<div class="slide-edit my-5">
    <h3>
        <?php if (isset($slide)): ?>
        Edit Slide
        <?php else: ?>
        Create Slide
        <?php endif; ?>
    </h3>
    <form action="<?=isset($slide)?url('admin/slides/edit/'.$slide['slide_id']):url('admin/slides/create')?>" method="POST" enctype="multipart/form-data">
        <div class="form-group my-3">
            <label for="slide_name">Slide Title</label>
            <input type="text" class="form-control" id="slide_name" name="slide_name"
                value="<?= isset($slide) ? $slide['slide_name'] : '' ?>">
        </div>
        <?php if(isset($slide['slide_image'])) : ?>
        <div class="preview-logo my-3 image-lg">
            <img class="w-100" src="<?= url('public/images/products/' . $slide['slide_image']) ?>"
                alt="">
        </div>
        <?php endif; ?>
        <div class="form-group my-3">
            <label for="slide_image">Slide Image</label>
            <input type="file" class="form-control" id="slide_image" name="slide_image">
        </div>
        <div class="form-group my-3">
            <label for="for_page">For page</label>
            <input type="text" class="form-control" id="for_page" name="for_page"
                value="<?= isset($slide) ? $slide['for_page'] : '' ?>">
        </div>
        <div class="form-group my-3">
            <label for="slide_status">Slide Status</label>
            <select class="form-control" id="slide_status" name="slide_status">
                <option value="1"
                    <?= isset($slide) && $slide['slide_status'] == 1 ? 'selected' : '' ?>>Active
                </option>
                <option value="0"
                    <?= isset($slide) && $slide['slide_status'] == 0 ? 'selected' : '' ?>>Inactive
                </option>
            </select>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
    