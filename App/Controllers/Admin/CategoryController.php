<?php
namespace App\Controllers\Admin;
use Core\Controller;
use App\Models\Category;
use App\Models\Nav;
class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::queryAllCategories();
        return view('admin.categories.index', compact('categories'));
    }
    public function create()
    {
        $navs = Nav::all();
        return view('admin.categories.store', compact('navs'));
    }
    public function store($request)
    {
        $category = new Category();
        $category->category_name = $request->category_name;
        $category->category_description = $request->category_description;
        $category->nav_id = $request->nav_id;
        $category->category_status = $request->category_status;
        $file_name;
        if (isset($request->category_image) && $request->category_image['name'] != '') {
            try {
                $file = $request->category_image;
                $file_name = $file['name'];
                $file_tmp = $file['tmp_name'];
                if (file_exists('public/images/products/' . $file_name)) {
                    $file_name = date('Y-m-d-H-i-s') . '-' . $file_name;
                }
                move_uploaded_file($file_tmp, 'public/images/products/' . $file_name);
            } catch (\Exception $e) {
                writeLog($e);
            }
        }
        $category->category_image = $file_name;
        $category->save();
        return redirect()->route('categories');
    }
    public function edit($request)
    {
        $navs = Nav::all();
        $category = Category::find($request->id);
        return view('admin.categories.store', compact('navs', 'category'));
    }
    public function update($request)
    {
        $dataUpdate = ['category_name' => $request->category_name, 'category_description' => $request->category_description, 'nav_id' => $request->nav_id, 'category_status' => $request->category_status];
        if (isset($request->category_image) && $request->category_image['name'] != '') {
            try {
                $file = $request->category_image;
                $file_name = $file['name'];
                $file_tmp = $file['tmp_name'];
                if (file_exists('public/images/products/' . $file_name)) {
                    $file_name = date('Y-m-d-H-i-s') . '-' . $file_name;
                }
                move_uploaded_file($file_tmp, 'public/images/products/' . $file_name);
                $dataUpdate['category_image'] = $file_name;
            } catch (\Exception $e) {
                writeLog($e);
            }
        }
        $idUpdated = (new Category())->where(['category_id' => $request->id])->update($dataUpdate);
        if (is_numeric($idUpdated)) {
            return redirect()->route('categories');
        } else {
            return redirect()->route('create_category');
        }
    }
    public function delete($request)
    {
        $category = Category::find($request->category_id);
        $category->delete();
        return redirect('admin/categories');
    }
}
