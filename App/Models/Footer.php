<?php
namespace App\Models;
use Core\Model;
class Footer extends Model{
    protected $table = 'footer';
    public function getAll()
    {
       return $this->select('*')
            ->where(['status' => 1])
            ->get();
    }
}