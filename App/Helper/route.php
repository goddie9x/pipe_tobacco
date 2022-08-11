<?php
use App\Helper\Session;
function route($name) {
    global $listRoutePath;
    return url($listRoutePath[$name]);
}

class Redirect{
    public function back($options=[]){
        if(!empty($options)){
            foreach($options as $key => $value){
                Session::set($key, $value);
            }
        }
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        return $this;
    }
    public function to($path,$options=[]){
        if(!empty($options)){
            foreach($options as $key => $value){
                Session::set($key, $value);
            }
        }
        header('Location: ' . url($path));
        return $this;
    }
    public function route($route,$options=[]){
        if(!empty($options)){
            foreach($options as $key => $value){
                Session::set($key, $value);
            }
        }
        header('Location: ' . route($route));
        return $this;
    }
    public static function permanentRedirect($path,$newPath){
        header('Location: ' . url($path), true, 301);
        header('Location: ' . url($newPath));
        return $this;
    }
}

function redirect() {
    return new Redirect();
}

function csrf_token() {
    return Session::get('csrf_token');
}
function generate_csrf_token() {
    return Session::set('csrf_token', md5(rand()));
}