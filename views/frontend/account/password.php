<div class="container account-edit">
    <div class="row">
        <div class="col-md-3">
            <div class="account-edit-left">
                <div class="account-edit-left-title">
                    <h3>Tài khoản</h3>
                </div>
                <div class="account-edit-left-content">
                    <ul>
                        <li><a href="<?= url('account') ?>">Thông tin cá nhân</a></li>
                        <li><a href="<?= url('account/order') ?>">Đơn hàng</a></li>
                        <li><a href="<?= url('account/password') ?>">Đổi mật khẩu</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="account-edit-right">
                <div class="account-edit-right-title">
                    <h3>Thông tin cá nhân</h3>
                    <h6 class="text-danger">*Lưu ý: những thông tin của bạn dùng để mua hàng, vui lòng nhập đúng và đầy
                        đủ thông tin để đảm bảo lợi ích cho chính bản thân mình</h6>
                </div>
                <div class="account-edit-right-content">
                    <form action="<?= url('account/update') ?>" method="post" enctype="multipart/form-data">
                        <div class="general-info">
                            <div class="form-group my-3">
                                <label for="old_password">Old password</label>
                                <input type="old_password" class="form-control" id="old_password" name="password">
                            </div>
                            <div class="form-group my-3">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                            <div class="form-group my-3">
                                <label for="re_password">Nhập lại password</label>
                                <input type="password" class="form-control" id="re_password" name="re_password">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
