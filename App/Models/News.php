<?php
namespace App\Models;
use Core\Model;
class News extends Model
{
    protected $table = 'news';
    protected $primaryKey = 'news_id';

    public static function getNewsByPage($page = 1, $limit = 10)
    {
        $offset = ($page - 1) * $limit;
        $news = self::select('*')->where(['news_status' => 1])->orderBy('news_id', 'desc')->limit($limit)->offset($offset)->get();
        return $news;
    }
    public static function getNewsByPath($path)
    {
        $news = self::select('*')->where(['news_status' => 1, 'news_path' => $path])->first();
        return $news;
    }
    public static function getNewsByKeyword($keyword)
    {
        $news = self::select('*')->where([['news_status' ,'=', 1], ['news_title' ,'like',"%{$keyword}%"]])->get();
        return $news;
    }
}