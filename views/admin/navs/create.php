<div class="create-nav">
    <?php if (isset($error)): ?>
        <div class="alert alert-danger">
            <?=$error; ?>
        </div>
    <?php endif; ?>
    <form action="<?= isset($nav)?url('admin/settings/navs/edit/'.$nav['nav_id']):url('admin/settings/navs/save')?>" method="post">
        <div class="form-group my-3">
            <label for="title">Title</label>
            <input type="text" name="nav_name" value="<?=@$nav['nav_name']?>" id="title" class="form-control" placeholder="Title">
        </div>
        <div class="form-group my-3">
            <label for="url">Nav path</label>
            <input type="text" name="nav_path" id="url" value="<?=@$nav['nav_path']?>" class="form-control" placeholder="URL">
        </div>
        <div class="form-group my-3">
            <label for="parent_id">Parent</label>
            <select name="parent_id" id="parent_id" class="form-control">
                <option value="">None</option>
                <?php foreach ($navs as $crrNav): ?>
                    <option value="<?= $crrNav['nav_id'] ?>" <?=@$crrNav['nav_id'] == @$nav['nav_id']?'selected':''?>><?= $crrNav['nav_name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group my-3">
            <label for="order_nth">Order</label>
            <input type="number" name="order_nth" id="order_nth"value="<?=@$nav['order_nth']?>" class="form-control" placeholder="Order">
        </div>
        <div class="form-group my-3">
            <label for="status">Show: </label>
            <input class="ms-3" type="checkbox" name="status" id="status" value="1" <?=@$nav['status']==1?'checked':''?>>
        </div>
        <div class="form-group my-3">
            <button type="submit" class="btn btn-primary"><?php echo isset($nav)? 'Update':'Create'?></button>
        </div>
    </form>
</div>