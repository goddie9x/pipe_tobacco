<?php
namespace App\Controllers\Admin;
use Core\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use App\Models\Page;
use App\Models\Brand;
class AdminController extends Controller{
    public function index(){
        $amountProducts = Product::count();
        $amountCategories = Category::count();
        $amountUsers = User::count();
        $amountPages = Page::count();
        $amountBrands = Brand::count();
        return view('admin.dashboard',compact('amountProducts',
        'amountCategories',
        'amountUsers',
        'amountPages',
        'amountBrands'));
    }
}