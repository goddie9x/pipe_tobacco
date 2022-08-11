<?php
namespace App\Models;
use Core\Model;
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