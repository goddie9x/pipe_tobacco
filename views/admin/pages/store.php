<div class="create-page">
    <?php if (isset($error)): ?>
    <div class="alert alert-danger">
        <?= $error ?>
    </div>
    <?php endif; ?>
    <div class="create-page-header my-3">
        <h3><?= isset($page_info) ? 'Edit Page' : 'Create Page' ?></h3>
    </div>
    <div class="create-page-body my-3">
        <form class="row"
            action="<?= isset($page_info) ? url('admin/pages/update/') . $page_info['page_id'] : route('store_page') ?>"
            method="POST" enctype="multipart/form-data">
            <div class="col-8">
                <div class="form-group my-3">
                    <label for="page_name">Page Name</label>
                    <input type="text" class="form-control" id="page_name" name="page_name" placeholder="Page Name"
                        value="<?= @$page_info['page_name'] ?>">
                </div>
                <div class="form-group my-3">
                    <label for="page_path">Page Path</label>
                    <select class="form-control" id="page_path" name="nav_id">
                        <?php foreach ($navs as $nav) : ?>
                        <option value="<?= $nav['nav_id'] ?>"
                            <?= @$page_info['nav_id'] == $nav['nav_id'] ? 'selected' : '' ?>><?= $nav['nav_path'] ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group col-6 my-3 d-flex justify-content-between">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="page_status" id="page_status1"
                            value="0" <?= @$page_info['page_status'] == 0 ? 'checked' : '' ?>>
                        <label class="form-check-label" for="page_status1">
                            ẩn
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="page_status" id="page_status2"
                            value="1" <?= @$page_info['page_status'] == 1 ? 'checked' : '' ?>>
                        <label class="form-check-label" for="page_status2">
                            hiện
                        </label>
                    </div>
                </div>
                <div class="form-group my-3">
                    <label for="page_title">Page Title</label>
                    <input type="text" class="form-control" id="page_title" name="page_title"
                        placeholder="Page Title" value="<?= @$page_info['page_title'] ?>">
                </div>
                <div class="form-group my-3">
                    <label for="page_keyword">Page Keyword</label>
                    <input type="text" class="form-control" id="page_keyword" name="page_keyword"
                        placeholder="Page Keyword" value="<?= @$page_info['page_keyword'] ?>">
                </div>
                <div class="form-group my-3">
                    <label for="page_description">Page Description</label>
                    <input type="text" class="form-control" id="page_description" name="page_description"
                        placeholder="Page Description" value="<?= @$page_info['page_description'] ?>">
                </div>
                <div class="form-group my-3">
                    <label for="page_content">Page Content</label>
                    <textarea class="form-control" id="page_content" name="page_content" rows="3" placeholder="Page Content"><?= @$page_info['page_content'] ?></textarea>
                </div>
                <button type="submit" name="create_common" class="btn btn-primary">
                    <?= isset($page_info) ? 'Update' : 'Create' ?>
                </button>
            </div>
            <div class="col-4">
                <div class="preview-logo">
                    <img class="w-100" src="<?= url('public/images/pages/' . @$page_info['page_image']) ?>"
                        alt="">
                </div>
                <div class="form-group my-3">
                    <label for="page_image">Page Image</label>
                    <input type="file" class="form-control" id="page_image" name="page_image"
                        placeholder="Page Image" value="<?= @$page_info['page_image'] ?>">
                </div>
            </div>
        </form>
    </div>
</div>
</div>
<script>
    window.onload = function() {
        CKEDITOR.editorConfig = function(config) {
            config.image_previewText = '';
        };
        CKEDITOR.replace('page_content', {
            filebrowserBrowseUrl: '<?= @url('admin/images-pages') ?>',
            filebrowserImageBrowseUrl: '<?= @url('admin/images-pages') ?>',
            filebrowserUploadUrl: '<?= @url('admin/upload-pages') ?>',
            filebrowserImageUploadUrl: '<?= @url('admin/upload-pages') ?>',
            config: {
                image_previewText: ''
            }
        });
    }
</script>
