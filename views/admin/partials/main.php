<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?=url('public/images/'.$site['site_favicon'])?>" type="image/x-icon">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pipe Tobacco</title>
    <link rel="stylesheet" href="<?=@url('public/assets/css/all.min.css');?>">
    <link rel="stylesheet" href="<?=@url('public/assets/css/bootstrap.min.css');?>">
    <link rel="stylesheet" href="<?=@url('public/assets/css/select2.min.css');?>">
    <link rel="stylesheet" href="<?=@url('public/assets/css/index.css');?>">
    <link rel="stylesheet" href="<?=@url('public/assets/css/admin.css');?>">
    
</head>

<body>
    <?php include_once './views/admin/partials/header.php'; ?>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-3 d-none d-sm-flex flex-column admin-left-menu">
                <?php include_once './views/admin/partials/left_menu.php'; ?>
            </div>
            <div class="col-md-8 col-sm-9">
                <?php isset($view) ? include_once $view : include_once './views/404.php'; ?>
            </div>
        </div>
    </div>
    <?php include_once './views/admin/partials/footer.php'; ?>
</body>

</html>
