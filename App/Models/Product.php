<?php
namespace App\Models;
use Core\Model;

class Product extends Model
{
    protected $table = 'product';
    protected $primaryKey = 'product_id ';
    public static function getProductHotByPage($page=1, $limit = 8)
    {
        return self::select('*')
            ->where(['hot' => 1, 'product_status' => 1])
            ->orderBy('product_id', 'DESC')
            ->limit($limit)
            ->offset(($page - 1) * $limit)
            ->get();
    }
    public static function getProductsByPage($page=1, $limit = 8)
    {
        return self::select('*')
            ->where(['product_status' => 1])
            ->orderBy('product_id', 'DESC')
            ->limit($limit)
            ->offset(($page - 1) * $limit)
            ->get();
    }
    public static function getProductsByCategoryID($category_id, $page=1, $limit = 8)
    {
        return self::select('*')
            ->where(['category_id' => $category_id, 'product_status' => 1])
            ->orderBy('product_id', 'DESC')
            ->limit($limit)
            ->offset(($page - 1) * $limit)
            ->get();
    }
    public static function getProductsByCategoryPath($path, $page=1, $limit = 8)
    {
        return self::select('products.*')
            ->join('category', ['category.category_id', 'products.category_id'])
            ->join('nav', ['nav.category_id', 'category.category_id'])
            ->where(['nav.nav_path' => $path, 'product_status' => 1])
            ->orderBy('product_id', 'DESC')
            ->limit($limit)
            ->offset(($page - 1) * $limit)
            ->get();
    }
    public static function getProductByBrand($brand_id, $page=1, $limit = 8)
    {
        return self::select('*')
            ->where(['brand_id' => $brand_id, 'product_status' => 1])
            ->orderBy('product_id', 'DESC')
            ->limit($limit)
            ->offset(($page - 1) * $limit)
            ->get();
    }
    public static function getProductByPath($path)
    {
        return self::select('*')
            ->where(['product_path' => $path, 'product_status' => 1])
            ->first();
    }
}