<div class="create-news">
    <?php if (isset($error)): ?>
    <div class="alert alert-danger">
        <?= $error ?>
    </div>
    <?php endif; ?>
    <div class="create-news-header my-3">
        <h3><?= isset($news) ? 'Edit News' : 'Create News' ?></h3>
    </div>
    <div class="create-news-body my-3">
        <form class="row"
            action="<?= isset($news) ? url('admin/news/update/') . $news['news_id'] : route('store_news') ?>"
            method="POST" enctype="multipart/form-data">
            <div class="col-8">
                <div class="form-group my-3">
                    <label for="news_title">News Name</label>
                    <input type="text" class="form-control" id="news_title" name="news_title" placeholder="News Name"
                        value="<?= @$news['news_title'] ?>">
                </div>
                <div class="form-group my-3">
                    <label for="news_path">News Path</label>
                    <input type="text" class="form-control" id="news_path" name="news_path" placeholder="News Path"
                        value="<?= @$news['news_path']?>" disabled >
                </div>
                <div class="form-group col-6 my-3 d-flex justify-content-between">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="news_status" id="news_status1"
                            value="0" <?= @$news['news_status'] == 0 ? 'checked' : '' ?>>
                        <label class="form-check-label" for="news_status1">
                            ẩn
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="news_status" id="news_status2"
                            value="1" <?= @$news['news_status'] == 1 ? 'checked' : '' ?>>
                        <label class="form-check-label" for="news_status2">
                            hiện
                        </label>
                    </div>
                </div>
                <div class="form-group my-3">
                    <label for="news_title">News Title</label>
                    <input type="text" class="form-control" id="news_title" name="news_title"
                        placeholder="News Title" value="<?= @$news['news_title'] ?>">
                </div>
                <div class="form-group my-3">
                    <label for="news_keyword">News Keyword</label>
                    <input type="text" class="form-control" id="news_keyword" name="news_keyword"
                        placeholder="News Keyword" value="<?= @$news['news_keyword'] ?>">
                </div>
                <div class="form-group my-3">
                    <label for="news_description">News Description</label>
                    <input type="text" class="form-control" id="news_description" name="news_description"
                        placeholder="News Description" value="<?= @$news['news_description'] ?>">
                </div>
                <div class="form-group my-3">
                    <label for="news_content">News Content</label>
                    <textarea class="form-control" id="news_content" name="news_content" rows="3" placeholder="News Content"><?= @$news['news_content'] ?></textarea>
                </div>
                <button type="submit" name="create_common" class="btn btn-primary">
                    <?= isset($news) ? 'Update' : 'Create' ?>
                </button>
            </div>
            <div class="col-4">
                <div class="preview-logo image-lg">
                    <img class="w-100" src="<?= url('public/images/news/' . @$news['news_image']) ?>"
                        alt="">
                </div>
                <div class="form-group my-3">
                    <label for="news_image">News Image</label>
                    <input type="file" class="form-control" id="news_image" name="news_image"
                        placeholder="News Image" value="<?= @$news['news_image'] ?>">
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
        CKEDITOR.replace('news_content', {
            filebrowserBrowseUrl: '<?= @url('admin/images-news') ?>',
            filebrowserImageBrowseUrl: '<?= @url('admin/images-news') ?>',
            filebrowserUploadUrl: '<?= @url('admin/upload-news') ?>',
            filebrowserImageUploadUrl: '<?= @url('admin/upload-news') ?>',
            config: {
                image_previewText: ''
            }
        });
    }
</script>
