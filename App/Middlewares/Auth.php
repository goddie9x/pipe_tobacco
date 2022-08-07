<?php
namespace App\Middlewares;
use App\Helper\JWT;
use App\Models\User;
use App\Helper\Session;
class Auth extends Middleware
{
    public static function check()
    {
        $token = Session::get('token');
        if(isset($token)){
            return JWT::decode($token, env('APP_KEY'));
        }
        return false;
    }
    public static function user(){
        $user_id = self::check();
        if($user_id){
            return User::find($user_id);
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