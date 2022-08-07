<?php
require_once 'route/Route.php';
use \Routes\Route;
Route::group([
    'prefix' => 'auth',
    'namespace' => 'Auth',
    'middleware' => ['AuthLogin']
], function($route){
    $route->get('/login', 'LoginController@index')->name('login');
    $route->post('/login', 'LoginController@login')->name('login');
    $route->get('/register', 'RegisterController@index')->name('register');
    $route->post('/register', 'RegisterController@register')->name('register');
    $route->get('/logout', 'LoginController@logout')->name('logout');
});
Route::group([
    'prefix' => 'admin',
    'namespace' => 'Admin',
    'middleware' => ['Auth']
], function($route){
    $route->subGroup([
        'prefix' => 'users',
        'namespace' => 'User'
    ], function($route){
        $route->get('/', function(){
            return view('frontend.home');
        });
        $route->get('/create', 'create');
        $route->post('/create', 'create');
        $route->get('/edit/{id}', 'edit');
        $route->post('/edit/{id}', 'edit');
        $route->get('/delete/{id}', 'delete');
    });
    $route->get('/', function(){
        echo 'Admin';
    });
});
Route::group([
    'namespace' => 'Frontend',
    'middleware' => ['Auth']
], function($route){
    $route->get('/', 'IndexController@index');
    $route->get('/test', function(){
        echo 'Test';
    });
    $route->get('/test/{slug}', function($request){
        echo $request['slug'];
    });
});

Route::notFound();