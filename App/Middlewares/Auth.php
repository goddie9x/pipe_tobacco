<?php
namespace App\Middlewares;
use Core\Middleware;
use App\Helper\JWT;
use App\Models\User;
use App\Helper\Session;
class Auth extends Middleware
{
    public static function check()
    {
        $token = isset($_COOKIE['token']) ? $_COOKIE['token'] : Session::get('token');
        if(isset($token)){
            return JWT::decode($token, env('APP_KEY'));
        }
        return false;
    }
    public static function user(){
        $user_id = self::check();
        if($user_id){
            return (new User)->where(['user_id'=>$user_id,'banned'=>0])->first();
        }
        return null;
    }
    public static function handle($action, $requestData, $next){
        $requestUrl = $requestData->REQUEST_URI;
        if(!self::check()){
            redirect()->route('login');
        }
        else{
            $next($action, $requestData);
        }
    }
}
?>