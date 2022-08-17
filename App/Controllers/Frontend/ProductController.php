<?php
namespace App\Controllers\Frontend;
use Core\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\News;
class ProductController extends Controller
{
    public function detail($request)
    {
        $news = News::getNewsByPage();
        $productsHot = Product::getProductHotByPage();
        $categories = Category::queryAllCategoriesActive();
        $brands = (new Brand)->where(['brand_status' => 1])->get();
        $product = Product::getProductByPath($request->slug);
        $productsRelative = Product::getProductsByCategoryID($product['category_id']);
        return view('frontend.products.detail', compact('productsHot', 'categories', 'product', 'productsRelative', 'brands', 'news'));
    }
    public function index($request)
    {
        $productsHot = Product::getProductHotByPage();
        $categories = Category::queryAllCategoriesActive();
        $brands = (new Brand)->where(['brand_status' => 1])->get();
        $products=[];
        foreach ($categories as $category) {
            $products[$category['category_id']] = Product::getProductsByCategoryID($category['category_id']);
        }
        $isCategories = true;
        return view('frontend.products.categories.index', compact('products', 'categories', 'brands', 'productsHot','isCategories'));
    }
    public function category($request)
    {
        $productsHot = Product::getProductHotByCategoryPathAndPage($request->category);
        $categories = Category::queryAllCategoriesActive();
        $category = Category::getCategoryByPath('categories/'.$request->category);
        $products = Product::getProductsByCategoryPath($request->category);
        $brands = (new Brand)->where(['brand_status' => 1])->get();
        $isCategories = false;
        return view('frontend.products.categories.index', compact('products', 'categories', 'brands', 'productsHot','category','isCategories'));
    }
}