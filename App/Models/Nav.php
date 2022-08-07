<?php
namespace App\Models;
class Nav extends Model{
    protected $table = 'nav';
    public function getAll()
    {
        $listNav = $this->select('*')
            ->where(['status' => 1])
            ->orderBy('nav_id ', 'asc')
            ->get();
        $navs = [];
        foreach ($listNav as $nav) {
            $navs[$nav->nav_id] = $nav;
        }
        foreach ($navs as $nav) {
            if($nav->parent_id){
                if(isset($navs[$nav->parent_id])){
                    $navs[$nav->parent_id]->children[] = $nav;
                    unset($navs[$nav->nav_id]);
                }
            }
        }
        return $navs;
    }
}