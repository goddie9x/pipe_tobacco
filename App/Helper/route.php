<?php
function route($name) {
    global $listRoutePath;
    return $listRoutePath[$name];
}

class Redirect{
    public function back(){
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        return $this;
    }
    public function to($path){
        header('Location: ' . url($path));
        return $this;
    }
    public function route($route){
        header('Location: ' . route($route));
        return $this;
    }
    public function with($key, $value){
        Session::put($key, $value);
    }
}

function redirect() {
    return new Redirect();
}