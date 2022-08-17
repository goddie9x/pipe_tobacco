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
                    <form class="row" action="<?= url('account/update') ?>" method="post" enctype="multipart/form-data">
                        <div class="col-md-9 col-12 general-info">
                            <div class="form-group my-3">
                                <label for="user_name">Họ và tên</label>
                                <input type="text" class="form-control" id="user_name" name="user_name"
                                    value="<?= $currentUser['user_name'] ?>">
                            </div>
                            <div class="form-group my-3">
                                <label for="address">Địa chỉ</label>
                                <input type="text" class="form-control" id="address" name="address"
                                    value="<?= $currentUser['address'] ?>">
                            </div>
                            <div class="form-group my-3">
                                <label for="phone">Số điện thoại</label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                    value="<?= $currentUser['phone'] ?>">
                            </div>
                            <div class="form-group my-3">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" name="email"
                                    value="<?= $currentUser['email'] ?>">
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <div class="preview-logo">
                                <img class="w-100" src="<?= url('public/images/users/' . $currentUser['user_image']) ?>"
                                    alt="">
                            </div>
                            <div class="form-group my-3 my-3">
                                <label for="avatar">Ảnh đại diện</label>
                                <input type="file" class="form-control" id="avatar" name="user_image">
                            </div>
                            <div class="form-group my-3 my-3">
                                <label for="gender">Giới tính</label>
                                <select class="form-control" id="gender" name="gender">
                                    <option>--Vui lòng chọn--</option>
                                    <option value="1"
                                        <?= isset($currentUser['gender']) && $currentUser['gender'] == 1 ? 'selected' : '' ?>>Nữ
                                    </option>
                                    <option value="2"
                                        <?= isset($currentUser['gender']) && $currentUser['gender'] == 2 ? 'selected' : '' ?>>Nam
                                    </option>
                                    <option value="3"
                                        <?= isset($currentUser['gender']) && $currentUser['gender'] == 3 ? 'selected' : '' ?>>Khác
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
