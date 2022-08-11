<?php
namespace App\Middlewares;
use Core\Middleware;

class AuthAdmin extends Auth
{
    public static function checkAdmin()
    {
        $user = self::user();
        if($user){
            return $user['role'] == 0;
        }
        return false;
    }
    public static function handle($action, $requestData, $next){
        $requestUrl = $requestData->REQUEST_URI;
        if(!self::checkAdmin()){
            redirect()->route('home');
        }
        else{
            $next($action, $requestData);
        }
    }
}