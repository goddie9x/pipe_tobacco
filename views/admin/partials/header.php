<div class="container-fluid admin-header header bg-secondary p-1 rounded shadow">
    <div class="row mx-0">
        <div class="col-md-1">
            <a href="<?=@url('admin')?>">
                <img src="<?=@url('public/images/logo.png')?>" class="img-fluid" alt="">
            </a>
        </div>
        <div class="col-md-11 d-flex justify-content-between align-items-center">
            <ul class="admin-menu d-flex justify-content-around align-items-center col-8">
            </ul>
            <div class="admin-user col-4 align-items-center">
                <span class="admin-user-name"><?=@$currenUser['user_name']?></span>
                <a href="<?=@url('admin/logout')?>" class="btn btn-primary">Logout</a>
            </div>
        </div>
    </div>
</div>
