<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    <i class="ti-settings"></i>
                    Setting
                </h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <form class="col-8 general-setting" action="<?= url('admin/settings/save') ?>" method="post">
                        <div class="form-group my-3">
                            <label for="site_name">Site Name</label>
                            <input type="text" class="form-control" id="site_name" name="site_name"
                                value="<?= @$site['site_name'] ?>">
                        </div>
                        <div class="form-group my-3">
                            <label for="site_email">Site Email</label>
                            <input type="text" class="form-control" id="site_email" name="site_email"
                                value="<?= @$site['site_email'] ?>">
                        </div>
                        <div class="form-group my-3">
                            <label for="site_phone">Site Phone</label>
                            <input type="text" class="form-control" id="site_phone" name="site_phone"
                                value="<?= @$site['site_phone'] ?>">
                        </div>
                        <div class="form-group my-3">
                            <label for="site_address">Site Address</label>
                            <input type="text" class="form-control" id="site_address" name="site_address"
                                value="<?= @$site['site_address'] ?>">
                        </div>
                        <div class="form-group my-3">
                            <label for="site_description">Site Description</label>
                            <textarea class="form-control" id="site_description" name="site_description"><?= @$site['site_description'] ?></textarea>
                        </div>
                        <div class="form-group my-3">
                            <label for="site_keywords">Site Keywords</label>
                            <input type="text" class="form-control" id="site_keywords" name="site_keywords"
                                value="<?= @$site['site_keywords'] ?>">
                        </div>
                        <div class="form-group my-3">
                            <label for="site_copyright">Site Copyright</label>
                            <input type="text" class="form-control" id="site_copyright" name="site_copyright"
                                value="<?= @$site['site_copyright'] ?>">
                        </div>
                        <div class="form-group my-3">
                            <label for="site_map">Site Map</label>
                            <textarea class="form-control" id="site_map" name="site_map"><?= @$site['site_map'] ?></textarea>
                        </div>
                        <button type="submit" name="submit_common" class="btn btn-primary">Save</button>
                    </form>
                    <div class="col-4 images-setting">
                        <form action="<?= url('admin/settings/save') ?>" method="post" enctype="multipart/form-data">
                            <div class="preview-logo image-lg">
                                <img class="w-100" src="<?= url('public/images/' . @$site['site_logo']) ?>"
                                    alt="">
                            </div>
                            <div class="form-group my-3">
                                <label for="logo">Logo</label>
                                <input type="file" class="form-control" id="logo" name="site_logo"
                                    accept="image/*">
                            </div>
                            <button type="submit" name="submit-logo" class="btn btn-primary">Save</button>
                        </form>
                        <form class="my-3" action="<?= url('admin/settings/save') ?>" method="post" enctype="multipart/form-data">
                            <div class="preview-favicon image-xs">
                                <img class="w-50" src="<?= url('public/images/' . @$site['site_favicon']) ?>"
                                    alt="">
                            </div>
                            <div class="form-group my-3">
                                <label for="favicon">Favicon</label>
                                <input type="file" class="form-control" id="favicon" name="site_favicon"
                                    accept="image/*">
                            </div>
                            <button type="submit" name="submit-favicon" class="btn btn-primary">Save</button>
                        </form>
                        <form action="<?= url('admin/settings/save') ?>" method="post">
                            <div class="form-group my-3">
                                <label for="facebook">Facebook</label>
                                <input type="text" class="form-control" id="facebook" name="site_facebook"
                                    value="<?= @$site['site_facebook'] ?>">
                            </div>
                            <div class="form-group my-3">
                                <label for="twitter">Twitter</label>
                                <input type="text" class="form-control" id="twitter" name="site_twitter"
                                    value="<?= @$site['site_twitter'] ?>">
                            </div>
                            <div class="form-group my-3">
                                <label for="google">Google</label>
                                <input type="text" class="form-control" id="google" name="site_google"
                                    value="<?= @$site['site_google'] ?>">
                            </div>
                            <div class="form-group my-3">
                                <label for="youtube">Youtube</label>
                                <input type="text" class="form-control" id="youtube" name="site_youtube"
                                    value="<?= @$site['site_youtube'] ?>">
                            </div>
                            <button type="submit" name="submit_social" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    window.onload = function () {
        CKEDITOR.editorConfig = function(config) {
            config.image_previewText = '';
        };
        CKEDITOR.replace('site_description', {
            filebrowserBrowseUrl: '<?= @url('admin/images-public') ?>',
            filebrowserImageBrowseUrl: '<?= @url('admin/images-public') ?>',
            filebrowserUploadUrl: '<?= @url('admin/upload') ?>',
            filebrowserImageUploadUrl: '<?= @url('admin/upload') ?>',
            config: {
                image_previewText: ''
            }
        });
    }
</script>
