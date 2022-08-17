<?php
require_once 'route/Route.php';
use Routes\Route;
Route::group(
    [
        'prefix' => 'auth',
        'namespace' => 'Auth',
        'middleware' => ['AuthLogin'],
    ],
    function ($route) {
        $route->get('/login', 'LoginController@index')->name('login');
        $route->post('/login', 'LoginController@login')->name('login');
        $route->get('/register', 'RegisterController@index')->name('register');
        $route->post('/register', 'RegisterController@register')->name('register');
        $route->get('/logout', 'LoginController@logout')->name('logout');
    },
);
Route::group(
    [
        'prefix' => 'admin',
        'namespace' => 'Admin',
        'middleware' => ['AuthAdmin'],
    ],
    function ($route) {
        $route->get('/', 'AdminController@index')->name('admin');
        $route->get('/images-public', 'CkfinderController@index')->name('get_images_public');
        $route->get('/images-pages', 'CkfinderController@pages')->name('get_images_pages');
        $route->get('/images-products', 'CkfinderController@products')->name('get_images_products');
        $route->post('/upload', 'UploadController@upload')->name('upload');
        $route->post('/upload-pages', 'UploadController@uploadPages')->name('upload_pages');
        $route->post('/upload-products', 'UploadController@uploadProducts')->name('upload_image_products');
        $route->subGroup(
            [
                'prefix' => 'users',
            ],
            function ($route) {
                $route->get('/', 'UserController@index')->name('users');
                $route->get('/create', 'UserController@create')->name('users.create');
                $route->post('/create', 'UserController@create')->name('users.create');
                $route->get('/edit/{id}', 'UserController@edit')->name('users.edit');
                $route->post('/edit/{id}', 'UserController@update')->name('users.edit');
                $route->get('/ban/{id}', 'UserController@ban')->name('users.band');
                $route->get('/delete/{id}', 'UserController@delete')->name('users.delete');
            },
        );
        $route->subGroup(
            [
                'prefix' => 'categories',
            ],
            function ($route) {
                $route->get('/', 'CategoryController@index')->name('categories');
                $route->get('/create', 'CategoryController@create')->name('create_category');
                $route->post('/create', 'CategoryController@store')->name('create_category');
                $route->get('/edit/{id}', 'CategoryController@edit')->name('edit_category');
                $route->post('/update/{id}', 'CategoryController@update')->name('update_category');
                $route->get('/delete/{id}', 'CategoryController@delete')->name('delete_category');
            },
        );
        $route->subGroup(
            [
                'prefix' => 'brands',
            ],
            function ($route) {
                $route->get('/', 'BrandController@index')->name('brands');
                $route->get('/create', 'BrandController@create')->name('create_brand');
                $route->post('/create', 'BrandController@store')->name('create_brand');
                $route->get('/edit/{id}', 'BrandController@edit')->name('edit_brand');
                $route->post('/update/{id}', 'BrandController@update')->name('update_brand');
                $route->get('/delete/{id}', 'BrandController@delete')->name('delete_brand');
            },
        );
        $route->subGroup(
            [
                'prefix' => 'products',
            ],
            function ($route) {
                $route->get('/', 'ProductController@index')->name('products');
                $route->get('/create', 'ProductController@create')->name('create_product');
                $route->post('/create', 'ProductController@store')->name('create_product');
                $route->get('/edit/{id}', 'ProductController@edit')->name('edit_product');
                $route->post('/update/{id}', 'ProductController@update')->name('edit_product');
                $route->get('/delete/{id}', 'ProductController@delete')->name('delete_product');
                $route->get('/{pageNumber}', 'ProductController@index')->name('products_page');
            },
        );
        $route->subGroup(
            [
                'prefix' => 'orders',
            ],
            function ($route) {
                $route->get('/', 'OrderController@index')->name('orders');
                $route->get('/create', 'OrderController@create')->name('create_order');
                $route->post('/create', 'OrderController@create')->name('create_order');
                $route->get('/edit/{id}', 'OrderController@edit')->name('edit_order');
                $route->post('/edit/{id}', 'OrderController@edit')->name('edit_order');
                $route->get('/delete/{id}', 'OrderController@delete')->name('delete_order');
            },
        );
        $route->subGroup(
            [
                'prefix' => 'slides',
            ],
            function ($route) {
                $route->get('/', 'SlideController@index')->name('slides');
                $route->get('/create', 'SlideController@create')->name('create_slide');
                $route->post('/create', 'SlideController@store')->name('create_slide');
                $route->get('/edit/{id}', 'SlideController@edit')->name('edit_slide');
                $route->post('/edit/{id}', 'SlideController@update')->name('edit_slide');
                $route->get('/delete/{id}', 'SlideController@delete')->name('delete_slide');
            },
        );
        $route->subGroup(
            [
                'prefix' => 'news',
            ],
            function ($route) {
                $route->get('/', 'NewsController@index')->name('news');
                $route->get('/create', 'NewsController@create')->name('create_news');
                $route->post('/store', 'NewsController@store')->name('store_news');
                $route->get('/edit/{news_id}', 'NewsController@edit')->name('edit_news');
                $route->post('/update/{news_id}', 'NewsController@update')->name('update_news');
                $route->get('/delete/{news_id}', 'NewsController@delete')->name('delete_news');
            },
        );
        $route->subGroup(
            [
                'prefix' => 'pages',
            ],
            function ($route) {
                $route->get('/', 'PageController@index')->name('pages');
                $route->get('/create', 'PageController@create')->name('create_page');
                $route->post('/store', 'PageController@store')->name('store_page');
                $route->get('/edit/{page_id}', 'PageController@edit')->name('edit_page');
                $route->post('/update/{page_id}', 'PageController@update')->name('update_page');
                $route->get('/delete/{page_id}', 'PageController@delete')->name('delete_page');
            },
        );
        $route->subGroup(
            [
                'prefix' => 'settings',
            ],
            function ($route) {
                $route->get('/', 'SettingController@index')->name('site_settings');
                $route->post('/save', 'SettingController@save')->name('save_site_settings');
                $route->subGroup(
                    [
                        'prefix' => 'navs',
                    ],
                    function ($route) {
                        $route->get('/', 'NavController@index')->name('navs_manager');
                        $route->get('/create', 'NavController@create')->name('create_nav');
                        $route->post('/save', 'NavController@save')->name('create_nav');
                        $route->get('/edit/{id}', 'NavController@edit')->name('edit_nav');
                        $route->post('/edit/{id}', 'NavController@update')->name('edit_nav');
                        $route->get('/delete/{id}', 'NavController@delete')->name('delete_nav');
                    },
                );
            },
        );
    },
);
Route::group(
    [
        'namespace' => 'Frontend',
        'middleware' => ['Auth'],
    ],
    function ($route) {
        $route->get('/', 'IndexController@index')->name('home');
        $route->subGroup(
            [
                'prefix' => 'account',
            ],
            function ($route) {
                $route->get('/', 'IndexController@account')->name('home');
                $route->get('/password', 'IndexController@password')->name('account_password');
                $route->post('/update', 'IndexController@updateAccount')->name('account_update');
            },
        );
        $route->subGroup(
            [
                'prefix' => 'categories',
            ],
            function ($route) {
                $route->get('/{category}', 'ProductController@category')->name('show_category');
                $route->get('/', 'ProductController@index')->name('categories');
            },
        );
        $route->subGroup(
            [
                'prefix' => 'products',
            ],
            function ($route) {
                $route->get('/', 'ProductController@index')->name('products');
                $route->get('/{slug}', 'ProductController@detail')->name('show_product');
            },
        );
        $route->subGroup(
            [
                'prefix' => 'news',
            ],
            function ($route) {
                $route->get('/', 'NewsController@index')->name('news');
                $route->get('/{slug}', 'NewsController@detail')->name('show_news');
            },
        );
        $route->subGroup(
            [
                'prefix' => 'cart',
            ],
            function ($route) {
                $route->get('/', 'InvoiceController@index')->name('cart');
                $route->post('/add', 'InvoiceController@addCart')->name('add_to_cart');
                $route->get('/remove/{id}', 'InvoiceController@removeCart')->name('delete_from_cart');
            },
        );
        $route->get('/search', 'IndexController@search')->name('search');
        $route->get('/{page}', 'PageController@index')->name('page');
    },
);
