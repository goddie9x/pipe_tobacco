<?php
namespace App\Models;
use Core\Model;
class Site extends Model{
    protected $table = 'site';
    protected $primaryKey = 'site_id';

    public static function getSite(){
        return self::select('*')->first();
    }
}