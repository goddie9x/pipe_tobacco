<?php
namespace App\Providers;
use Core\Provider;
use App\Middlewares\Auth;
use App\Models\Nav;
use App\Models\Site;
class AppProvider extends Provider{
    public function boot(){
        viewShare('currenUser',Auth::user());
        viewShare('headerNav',Nav::getAllAndMergeChildrentNavs());
        viewShare('site',Site::getSite());
    }
}