<?php
namespace App\Models;
use Core\Model;
class PageDetail extends Model{
    protected $table = 'page_detail';
    public static function getPageDetailByPageId($page_id)
    {
        $page_detail = new PageDetail();
        return $page_detail->where(['page_id' => $page_id])->first();
    }
    public function getFullPageDetailByPath($page_path)
    {
        return $this->join('page', ['page_detail.page_id', 'page.page_id'])
            ->join('nav', ['page.nav_id', 'nav.nav_id'])
            ->where(['nav.nav_path' => $page_path, 'page_detail.page_status' => 1])
            ->first();
    }
}