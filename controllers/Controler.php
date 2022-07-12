<?php
namespace Controllers;
class Controller{
    public function view($view, $data = []){
        $view = str_replace('.', '/', $view);
        $view = __DIR__ . '/../views/' . $view . '.php';
        if(file_exists($view)){
            include_once $view;
        }
        else{
            echo 'View not found';
        }
    }
    public function middleware($middleware){
        $middleware = str_replace('.', '/', $middleware);
        $middleware = __DIR__ . '/../middlewares/' . $middleware . '.php';
        if(file_exists($middleware)){
            include_once $middleware;
        }
        else{
            echo 'Middleware not found';
        }
    }
}