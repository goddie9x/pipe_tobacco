<?php
namespace App\Models;
use Core\Model;

class Category extends Model
{
    protected $table = 'category';
    protected $primaryKey = 'category_id';

    public static function queryAllCategories()
    {
        return self::select('category_id,category_name,category_description,category_status,category_image,nav.nav_path as category_path')
            ->join('nav', 'category.nav_id = nav.nav_id')
            ->get();
    }
    public static function queryAllCategoriesActive()
    {
        return self::select('category_id,category_name,category_description,category_status,category_image,nav.nav_path as category_path')
            ->join('nav', 'category.nav_id = nav.nav_id')
            ->where(['category_status' => 1])
            ->get();
    }
    public static function getCategoryByPath($path)
    {
        return self::select('category_id,category_name,category_description,category_status,category_image,nav.nav_path as category_path')
            ->join('nav', 'category.nav_id = nav.nav_id')
            ->where(['nav.nav_path' => $path])
            ->first();
    }
}