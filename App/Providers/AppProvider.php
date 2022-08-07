<?php
namespace App\Providers;
use App\Middlewares\Auth;
class AppProvider extends Provider{
    public function boot(){
        viewShare('currenUser',Auth::user());
    }
}