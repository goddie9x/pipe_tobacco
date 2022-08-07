<?php
namespace App\Providers;
class Provider{
    protected $app;
    public function __construct($app)
    {
        $this->app = $app;
    }
    public function boot(){
    }
    public function register(){

    }
    public function bind($abstract, $concrete){
        $this->app->bind($abstract, $concrete);
    }
}