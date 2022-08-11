<?php
namespace App\Models;
use Core\Model;
class Brand extends Model{
    protected $table = 'brand';
    protected $primaryKey = 'brand_id';
    public function getAll()
    {
       return $this->select('*')
            ->where(['status' => 1])
            ->get();
    }
}