<?php
namespace Models;
class Brand extends Model{
    protected $table = 'brand';
    public function getAll()
    {
       return $this->select('*')
            ->where(['status' => 1])
            ->get();
    }
}