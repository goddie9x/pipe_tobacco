<?php
$app = include_once './config/app.php';
include_once './App/Helper/view.php';

$providers = $app['providers'];
foreach ($providers as $provider) {
    $provider = new $provider($app);
    $provider->boot();
    $provider->register();
}