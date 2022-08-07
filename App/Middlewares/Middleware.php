<?php
namespace App\Middlewares;
class Middleware{
    public static $except = [];
    public static function handle($action, $requestData, $next){
        return $next($action, $requestData);
    }
    public function except($except){
        $this->except = $except;
    }
}