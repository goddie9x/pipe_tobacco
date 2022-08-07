<?php
namespace App\Models;
class User extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'user_id';
    public function getUser($id)
    {
        return $this->find($id);
    }
    public function getUsers()
    {
        return $this->get();
    }
}