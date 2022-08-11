<?php
namespace App\Models;
use Core\Model;
class Page extends Model
{
    protected $table = 'page';
    protected $primaryKey = 'page_id';
    public static function getAllPages()
    {
        return self::select('*')->get();
    }
    public static function getPageByPath($page_path)
    {
        return self::select('*')->where(['page_path' => $page_path])->first();
    }
}