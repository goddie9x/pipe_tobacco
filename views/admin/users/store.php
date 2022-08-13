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
<div class="user-edit">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><?= isset($user) ? 'Cập nhật người dùng' : 'Thêm người dùng mới' ?></h3>
        </div>
        <div class="card-body">
            <form class="row"
                action="<?= isset($user)?url('admin/users/edit/'.$user['user_id']):url('admin/users/create') ?>"
                method="POST" enctype="multipart/form-data">
                <div class="col-8">
                    <div class="form-group my-3">
                        <label for="user_name">Tên người dùng</label>
                        <input type="text" class="form-control" id="user_name" name="user_name"
                            value="<?=@$user['user_name']?>">
                    </div>
                    <div class="form-group my-3">
                        <label for="account">Tài khoản</label>
                        <input type="text" class="form-control" id="account" name="account"
                            value="<?=@$user['account']?>">
                    </div>
                    <div class="form-group my-3">
                        <label for="address">Địa chỉ</label>
                        <input type="text" class="form-control" id="address" name="address"
                            value="<?=@$user['address']?>">
                    </div>
                    <div class="form-group my-3">
                        <label for="phone">Số điện thoại</label>
                        <input type="text" class="form-control" id="phone" name="phone"
                            value="<?=@$user['phone']?>">
                    </div>
                    <div class="form-group my-3">
                        <label for="role">Quyền</label>
                        <select class="form-control" id="role" name="role">
                            <option value="0" <?= isset($user) && $user['role'] == 0 ? 'selected':''?>>Admin
                            </option>
                            <option value="1" <?= isset($user) && $user['role'] == 1 ? 'selected':''?>>Người dùng
                            </option>
                        </select>
                    </div>
                    <div class="form-group my-3">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" name="email"
                            value="<?=@$user['email']?>">
                    </div>
                </div>
                <div class="col-4">
                    <div class="preview-logo">
                        <img class="w-100" src="<?=url('public/images/users/'.@$user['avatar'])?>" alt="">
                    </div>
                    <div class="form-group my-3">
                        <label for="avatar">Ảnh đại diện</label>
                        <input type="file" class="form-control" id="avatar" name="user_image">
                    </div>
                    <div class="form-group my-3">
                        <label for="gender">Giới tính</label>
                        <select class="form-control" id="gender" name="gender">
                            <option>--Vui lòng chọn--</option>
                            <option value="1" <?= isset($user['gender'])&&$user['gender']==1?'selected':''?>>Nữ</option>
                            <option value="2" <?= isset($user['gender'])&&$user['gender']==2?'selected':''?>>Nam</option>
                            <option value="3" <?= isset($user['gender'])&&$user['gender']==3?'selected':''?>>Khác</option>
                        </select>
                    </div>
                    <div class="form-group my-3">
                        <label for="password">Mật khẩu</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <div class="form-group my-3">
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </div>
                </div>
                <div class="form-group my-3">
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
            </form>
        </div>
    </div>
</div>
