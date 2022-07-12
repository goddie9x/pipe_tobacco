<?php
namespace Routes;
class Route{
    protected $routes = [];
    protected $params = [];
    protected $prefix = '';
    protected $namespace = '';
    protected $middleware = [];

    public function __construct(){
        $this->routes = [];
    }
    public function get($url, $action){
        $this->routes['GET'][$url] = $action;
    }
    public function post($url, $action){
        $this->routes['POST'][$url] = $action;
    }
    public function put($url, $action){
        $this->routes['PUT'][$url] = $action;
    }
    public function delete($url, $action){
        $this->routes['DELETE'][$url] = $action;
    }
    public function patch($url, $action){
        $this->routes['PATCH'][$url] = $action;
    }
    public function options($url, $action){
        $this->routes['OPTIONS'][$url] = $action;
    }
    public function any($url, $action){
        $this->routes['ANY'][$url] = $action;
    }
    public function run(){
        $url = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];
        if(isset($this->routes[$method][$url])){
            $action = $this->routes[$method][$url];
            $action();
        }
    }
    public function redirect($url){
        header('Location: ' . $url);
    }
    public function redirectBack(){
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    public function group($arrayOptions, $callback){
        if(isset($arrayOptions['prefix'])){
            $this->prefix = $arrayOptions['prefix'];
        }
        if(isset($arrayOptions['namespace'])){
            $this->namespace = $arrayOptions['namespace'];
        }
        if(isset($arrayOptions['middleware'])){
            $this->middleware = $arrayOptions['middleware'];
        }
        if(isset($arrayOptions['routes'])){
            $this->routes = $arrayOptions['routes'];
        }
        $callback();
    }
    public function middleware($middleware){
        $middleware = str_replace('.', '/', $middleware);
        $middleware = __DIR__ . '/../middlewares/' . $middleware . '.php';
        if(file_exists($middleware)){
            include_once $middleware;
        }
        else{
            writeLog('Middleware '.$middleware.' not found');
        }
    }
}