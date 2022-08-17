<footer class="container-fluid admin-footer bg-secondary rounded shadow">
    <div class="row">
        <div class="col-md-12">
            <div class="footer-copyright py-2 text-center">
                <img height="45" src="<?=@url('public/images/logo.png')?>" alt="">
                <span class="text-white">Copyright &copy; <?= date('Y') ?> <?= @$site['site_name'] ?></span>
            </div>
        </div>
    </div>
</footer>
  
<script src="<?=@url('public/assets/js/jquery-3.6.0.min.js');?>"></script>
<script src="<?=@url('public/assets/js/popper.min.js');?>"></script>
<script src="<?=@url('public/assets/js/bootstrap.min.js');?>"></script>
<script src="<?=@url('public/assets/js/select2.min.js');?>"></script>
<script src="https://cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>
<script src="<?=@url('public/assets/js/index.js');?>"></script>
<?php include_once './views/errors/toasts.php'; ?>
