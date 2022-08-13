<?php
namespace App\Controllers\Frontend;
use Core\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

class ProductController extends Controller
{
    public function detail($request)
    {
        $product = Product::getProductByPath($request->slug);
        $productsRelative = Product::getProductsByCategoryID($product->category_id);
        return view('frontend.products.detail', compact('product', 'productsRelative'));
    }
}