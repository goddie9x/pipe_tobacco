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
<div class="product-edit">
    <div class="create-product">
        <h1><?php if(isset($product)): ?> Edit Product <?php else: ?> Create Product <?php endif; ?></h1>
        <form class="row"
            action="<?= isset($product) ? url('admin/products/update/') . $product['product_id'] : route('create_product') ?>"
            method="POST" enctype="multipart/form-data">
            <div class="col-8">
                <div class="form-group my-3">
                    <label for="product_name">Product Name</label>
                    <input type="text" class="form-control" id="product_name" name="product_name"
                        placeholder="Enter Product Name" <?php if(isset($product)): ?> value="<?= $product['product_name'] ?>"
                        <?php endif; ?>>
                </div>
                <div class="form-group my-3">
                    <label for="product_name">Product path</label>
                    <input type="text" class="form-control" id="product_path"
                        disabled <?php if(isset($product)): ?> value="<?= $product['product_path'] ?>"
                        <?php endif; ?>>
                </div>
                <div class="form-group my-3">
                    <label for="brand_id">Brand</label>
                    <select class="form-control" id="brand_id" name="brand_id">
                        <option>-- Select Brand --</option>
                        <?php foreach($brands as $brand): ?>
                        <option value="<?= $brand['brand_id'] ?>"
                            <?= isset($product) && $product['brand_id'] == $brand['brand_id'] ? 'selected' : '' ?>>
                            <?= $brand['brand_name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group my-3">
                    <label for="category_id">Category</label>
                    <select class="form-control" id="category_id" name="category_id">
                        <option>-- Select Category --</option>
                        <?php foreach($categories as $category): ?>
                        <option value="<?= $category['category_id'] ?>"
                            <?= isset($product) && $product['category_id'] == $category['category_id'] ? 'selected' : '' ?>>
                            <?= $category['category_name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group my-3">
                    <label for="hot">Hot</label>
                    <select class="form-control" id="hot" name="hot">
                        <option value="0" <?= isset($product) && $product['hot'] == 0 ? 'selected' : '' ?>>No
                        </option>
                        <option value="1" <?= isset($product) && $product['hot'] == 1 ? 'selected' : '' ?>>Yes
                        </option>
                    </select>
                </div>
                <div class="form-group my-3">
                    <label for="weight">Weight</label>
                    <input type="number" class="form-control" id="weight" name="weight" placeholder="Enter Weight"
                        <?php if(isset($product)): ?> value="<?= $product['weight'] ?>" <?php endif; ?>>
                </div>
                <div class="form-group my-3">
                    <label for="unit_cost">Unit Cost</label>
                    <input type="number" class="form-control" id="unit_cost" name="unit_cost"
                        placeholder="Enter Unit Cost" <?php if(isset($product)): ?> value="<?= $product['unit_cost'] ?>"
                        <?php endif; ?>>
                </div>
                <div class="form-group my-3">
                    <label for="product_title">Product Title</label>
                    <input type="text" class="form-control" id="product_title" name="product_title"
                        placeholder="Enter Product Title" <?php if(isset($product)): ?> value="<?= $product['product_title'] ?>"
                        <?php endif; ?>>
                </div>
                <div class="form-group my-3">
                    <label for="product_description">Product Description</label>
                    <textarea class="form-control" id="product_description" name="product_description" rows="3"><?php if(isset($product)): ?><?= $product['product_description'] ?><?php endif; ?></textarea>
                </div>
                <div class="form-group my-3">
                    <label for="product_content">Product Content</label>
                    <textarea class="form-control" id="product_content" name="product_content" rows="3"><?php if(isset($product)): ?><?= $product['product_content'] ?><?php endif; ?></textarea>
                </div>
            </div>
            <div class="col-4">
                <div class="preview-logo">
                    <img class="w-100" src="<?= url('public/images/products/' . @$product['product_image']) ?>"
                        alt="">
                </div>
                <div class="form-group my-3">
                    <label for="product_image">Product Image</label>
                    <input type="file" class="form-control" id="product_image" name="product_image">
                </div>
                <div class="preview-list-image row">
                    <?php if(isset($product)&&$product['product_image_slide']): $listImageSlide = explode(',', $product['product_image_slide']); ?>
                    <?php foreach($listImageSlide as $imageSlide): ?>
                    <div class="my-2 col-md-6 col-12">
                        <img class="w-100" src="<?= url('public/images/products/' . $imageSlide) ?>" alt="">
                    </div>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <div class="form-group my-3">
                    <label for="product_image_slide">Product Image Slide</label>
                    <input type="file" class="form-control" id="product_image_slide" name="product_image_slide[]"
                        multiple>
                </div>
                <div class="form-group my-3">
                    <label for="product_status">Product Status</label>
                    <select class="form-control" id="product_status" name="product_status">
                        <option value="1"
                            <?= isset($product) && $product['product_status'] == 1 ? 'selected' : '' ?>>Active
                        </option>
                        <option value="0"
                            <?= isset($product) && $product['product_status'] == 0 ? 'selected' : '' ?>>Inactive
                        </option>
                    </select>
                </div>
                <div class="form-group my-3">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
            <div class="form-group my-3">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
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
