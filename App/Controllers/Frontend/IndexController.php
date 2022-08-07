<?php
namespace App\Controllers\Frontend;
use App\Controllers\Controller;
use App\Middlewares\Auth;
class IndexController extends Controller
{
    public function index()
    {
        return view('frontend.home');
    }
}