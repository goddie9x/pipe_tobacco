<?php
namespace App\Helper;
class Session{
    public static function set($key, $value){
        
        $_SESSION[$key] = $value;
    }
    public static function get($key){
        if(isset($_SESSION[$key])){
            return $_SESSION[$key];
        }
        else{
            return null;
        }
    }
    public static function take($key){
        if(isset($_SESSION[$key])){
            $value = $_SESSION[$key];
            unset($_SESSION[$key]);
            return $value;
        }
        else{
            return null;
        }
    }
    public static function has($key){
        return isset($_SESSION[$key]);
    }
    public static function destroy(){
        session_destroy();
    }
    public static function forget($key){
        unset($_SESSION[$key]);
    }
}