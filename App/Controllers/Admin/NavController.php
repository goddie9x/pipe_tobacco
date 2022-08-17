<?php 
namespace App\Controllers\Admin;
use Core\Controller;
use App\Models\Nav;
class NavController extends Controller
{
    public function index()
    {
        $navs = Nav::getAllAndMergeChildrentNavs();
        return view('admin.navs.list', compact('navs'));
    }
    public function create()
    {
        $navs = (new Nav())->where(['status' => 1])->get();
        return view('admin.navs.create', compact('navs'));
    }
    public function save($request)
    {
        $nav = new Nav();
        $nav->nav_name = $request->nav_name;
        $nav->nav_path = $request->nav_path;
        $nav->order_nth = $request->order_nth;
        $nav->status = $request->status;
        $nav->parent_id = $request->parent_id;
        $nav->save();
        return redirect()->route('navs_manager');
    }
    public function edit($request)
    {
        $id = $request->id;
        $nav = (new Nav())->find($id);
        $navs = (new Nav())->where(['status' => 1])->get();
        return view('admin.navs.create', compact('nav', 'navs'));
    }
    public function update($request)
    {
        $id = $request->id;
        $nav = (new Nav())->find($id);
        if($nav){
            $isSuccess = (new Nav())->where(['nav_id' => $id])->update([
                'nav_name' => $request->nav_name,
                'nav_path' => $request->nav_path,
                'order_nth' => $request->order_nth,
                'status' => $request->status,
                'parent_id' => ($request->parent_id) ? $request->parent_id : 'NULL',
            ]);
            if($isSuccess){
                return redirect()->route('navs_manager');
            }else{
                return redirect()->back(['errors' => 'Không tìm thấy menu cần sửa']);
            }
        }
        else{
            return redirect()->back(['errors' => 'Không tìm thấy menu cần sửa']);
        }
    }
    public function delete($request)
    {
        $id = $request->id;
        $isDeleteSuccess = (new Nav())->where(['nav_id' => $id])->delete();
        if ($isDeleteSuccess) {
            return redirect()->route('navs_manager');
        }
        else {
            return redirect()->route('navs_manager', ['error' => 'Delete failed']);
        }
    }
}