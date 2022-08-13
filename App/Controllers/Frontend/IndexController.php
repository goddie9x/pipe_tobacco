<?php
namespace App\Controllers\Frontend;
use Core\Controller;
use App\Middlewares\Auth;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
class IndexController extends Controller
{
    public function index()
    {
        $productsHot = Product::getProductHotByPage();
        $categorys = (new Category)->where(['category_status' => 1])->get();
        $brands = (new Brand)->where(['brand_status' => 1])->get();
        $products=[];
        foreach ($categorys as $category) {
            $products[$category['category_id']] = Product::getProductsByCategoryID($category['category_id']);
        }
        return view('frontend.home', compact('productsHot', 'categorys', 'brands', 'products'));
    }
}