<?php
namespace App\Controllers\Admin;
use Core\Controller;
class AdminController extends Controller{
    public function index(){
        return view('admin.dashboard');
    }
}