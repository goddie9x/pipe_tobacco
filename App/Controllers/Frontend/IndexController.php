<?php
namespace App\Controllers\Frontend;
use Core\Controller;
use App\Middlewares\Auth;
class IndexController extends Controller
{
    public function index()
    {
        return view('frontend.home');
    }
}