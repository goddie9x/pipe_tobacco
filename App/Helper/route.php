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

function str_slug($str) {
    $str = trim(mb_strtolower($str));
    $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
    $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
    $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
    $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
    $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
    $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
    $str = preg_replace('/(đ)/', 'd', $str);
    $str = preg_replace('/[^a-z0-9-\s]/', '', $str);
    $str = preg_replace('/([\s]+)/', '-', $str);
    return $str;
}