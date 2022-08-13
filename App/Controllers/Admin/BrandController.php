<?php
namespace App\Controllers\Admin;
use Core\Controller;
use App\Models\Brand;

class BrandController extends Controller
{
    public function index($request)
    {
        $brands = Brand::all();
        return view('admin.brand.index', ['brands' => $brands]);
    }
    public function create()
    {
        return view('admin.brand.store');
    }
    public function store($request)
    {
        $brand = new Brand();
        $brand->brand_name = $request->brand_name;
        $brand->brand_description = $request->brand_description;
        $brand->brand_status = $request->brand_status;
        $filename;
        if (isset($request->brand_image) && $request->brand_image != '') {
            try {
                $file = $request->brand_image;
                $file_name = $file['name'];
                $file_tmp = $file['tmp_name'];
                if (file_exists('public/images/products/' . $file_name)) {
                    $file_name = date('Y-m-d-H-i-s') . '-' . $file_name;
                }
                move_uploaded_file($file_tmp, 'public/images/products/' . $file_name);
            } catch (\Exception $e) {
                writeLog($e);
                return redirect()->route('create_brand', ['errors' => 'Lỗi upload ảnh']);
            }
        }
        $brand->brand_image = $file_name;
        $idSaved = $brand->save();
        if (is_numeric($idSaved)) {
            return redirect()->route('brands');
        } else {
            return redirect()->route('create_brand');
        }
    }
    public function edit($request)
    {
        $brand = Brand::find($request->id);
        return view('admin.brand.store', ['brand' => $brand]);
    }
    public function update($request)
    {
        $brand = Brand::find($request->id);
        if (count($brand) > 0) {
            $dataUpdate = ['brand_name' => $request->brand_name, 'brand_description' => $request->brand_description, 'brand_status' => $request->brand_status];
            if (isset($request->brand_image) && $request->brand_image['name'] != '') {
                try {
                    if (file_exists('public/images/products/' . $brand['brand_image'])) {
                        unlink('public/images/products/' . $brand['brand_image']);
                    }
                    $file = $request->brand_image;
                    $file_name = $file['name'];
                    $file_tmp = $file['tmp_name'];
                    if (file_exists('public/images/products/' . $file_name)) {
                        $file_name = date('Y-m-d-H-i-s') . '-' . $file_name;
                    }
                    move_uploaded_file($file_tmp, 'public/images/products/' . $file_name);
                    $dataUpdate['brand_image'] = $file_name;
                } catch (\Exception $e) {
                    writeLog($e);
                }
            }
            $idUpdated = (new Brand())->where(['brand_id' => $request->id])->update($dataUpdate);
            if (is_numeric($idUpdated)) {
                return redirect()->route('brands');
            } else {
                return redirect()->route('brands/update/' . $request->brand_id);
            }
        } else {
            return redirect()->route('brands');
        }
    }
    public function delete($request)
    {
        $brand = Brand::find($request->id);
        if (count($brand) > 0) {
            if (file_exists('public/images/products/' . $brand['brand_image'])) {
                unlink('public/images/products/' . $brand['brand_image']);
            }
            $isDeleted = Brand::where(['brand_id' => $request->id])->delete();
            if ($isDeleted) {
                return redirect()->route('brands', ['messages' => 'Xóa thành công']);
            } else {
                return redirect()->route('brands', ['errors' => 'Xóa không thành công']);
            }
        } else {
            return redirect()->route('brands', ['errors' => 'Thương hiệu không tồn tại']);
        }
    }
}
