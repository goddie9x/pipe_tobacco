<?php
namespace App\Models;
use Core\Model;
class Nav extends Model
{
    protected $table = 'nav';
    protected $primaryKey = 'nav_id';
    public static function getAllAndMergeChildrentNavs()
    {
        $listNav = self::select('*')
            ->where(['status' => 1])
            ->get();
        $navs = getChildren(0, $listNav);
        return $navs;
    }
}

function getChildren($parentId, &$listNav)
{
    $children = [];
    foreach ($listNav as $key => $nav) {
        if ($nav['parent_id'] == $parentId) {
            $crrNav = $nav;
            $crrNav['children'] = getChildren($nav['nav_id'],$listNav);
            $children[] = $crrNav;
            unset($listNav[$key]);
        }
    }
    return $children;
}
