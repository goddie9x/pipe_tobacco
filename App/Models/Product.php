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
    public static function getProductHotByCategoryPathAndPage($category_path, $page=1, $limit = 8)
    {
        $category = Category::getCategoryByPath('categories/'.$category_path);
        return self::select('*')
            ->where(['hot' => 1, 'product_status' => 1, 'category_id' => $category['category_id']])
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
        $category = Category::getCategoryByPath('categories/'.$path);
        return self::select('*')
            ->where(['category_id' => $category['category_id'], 'product_status' => 1])
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
    public static function getProductsByKeyword($keyword)
    {
        return self::select('*')
            ->where([['product_name' ,'like', "%{$keyword}%"], ['product_status','=', 1]])
            ->get();
    }
}