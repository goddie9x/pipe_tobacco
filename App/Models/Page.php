<?php
namespace App\Models;
use Core\Model;
class Page extends Model
{
    protected $table = 'page';
    protected $primaryKey = 'page_id';
    public static function getAllPages()
    {
        return self::select('page_id,page_name,nav.nav_path as page_path')
        ->join('nav', 'page.nav_id = nav.nav_id')->get();
    }
    public static function getPageByPath($page_path)
    {
        return self::select('*')->join('nav', 'page.nav_id = nav.nav_id')->where(['page.page_path' => $page_path])->first();
    }
}