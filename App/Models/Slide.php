<?php
namespace App\Models;
use Core\Model;

class Slide extends Model
{
    protected $table = 'slide';
    protected $primaryKey = 'slide_id';

    public static function getSlidesByPage($page){
        return self::select('*')->where('for_page', $page)->get();
    }
}