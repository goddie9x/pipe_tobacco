<?php
require_once 'route/Route.php';
use \Routes\Route;
Route::group([
    'prefix' => 'admin',
    'namespace' => 'Admin',
    'middleware' => ['auth']
], function(){
    Route::get('/', function(){
        echo 'Admin';
    });
});
Route::get('/', function(){
    echo 'Home';
});