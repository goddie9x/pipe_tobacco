<?php
namespace App\Middlewares;
use Core\Middleware;
class AuthLogin extends Auth
{
    public static $except = ['/pipe_tobacco/auth/logout'];

    public static function handle($action, $requestData, $next){
        $requestUrl = $requestData->REQUEST_URI;
        if(self::check()&&!in_array($requestUrl, self::$except)){
            redirect()->to('');
        }
        else{
            $next($action, $requestData);
        }
    }
}
?>