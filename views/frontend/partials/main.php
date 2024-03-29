<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?= url('public/images/' . $site['site_favicon']) ?>" type="image/x-icon">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pipe Tobacco</title>
    <link rel="stylesheet" href="<?= @url('public/assets/css/all.min.css') ?>">
    <link rel="stylesheet" href="<?= @url('public/assets/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= @url('public/assets/css/select2.min.css') ?>">
    <link rel="stylesheet" href="<?= @url('public/assets/css/index.css') ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
</head>

<body>
    <?php include_once './views/frontend/partials/header.php'; ?>
    <div class="min-vh-100 my-3">
        <?php isset($view) ? include_once $view : include_once './views/404.php'; ?>
    </div>
    <?php include_once './views/frontend/partials/footer.php'; ?>
</body>

</html>
