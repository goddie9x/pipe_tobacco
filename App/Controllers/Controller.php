<?php
namespace App\Controllers;
use App\Middlewares;
class Controller{
    public function middleware($middleware){
        return new $middleware();
    }
}