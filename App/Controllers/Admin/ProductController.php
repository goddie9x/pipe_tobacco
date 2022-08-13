<?php
namespace App\Controllers\Admin;
use Core\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
class ProductController extends Controller
{
    public function index($request)
    {
        $perPage = $request->perPage ?? 10;
        $pageNumber = $request->pageNumber ?? 1;
        $products = Product::getProductsByPage($pageNumber, $perPage);
        $total = Product::count();
        $totalPage = ceil($total / $perPage);
        return view('admin.products.index', compact('products', 'totalPage', 'pageNumber'));
    }
    public function create()
    {
        $brands = Brand::all();
        $categories = Category::all();
        return view('admin.products.store', compact('brands', 'categories'));
    }
    public function store($request)
    {
        $product = new Product();
        $product->product_name = $request->product_name;
        $product->brand_id = $request->brand_id;
        $product->category_id = $request->category_id;
        $product->hot = $request->hot;
        $product->weight = $request->weight;
        $product->unit_cost = $request->unit_cost;
        $product->product_title = $request->product_title;
        $product->product_description = $request->product_description;
        $product->product_status = $request->product_status;
        $product->product_content = $request->product_content;
        if (isset($request->product_image) && $request->product_image['name'] != '') {
            try {
                $file = $request->product_image;
                $file_name = $file['name'];
                $file_tmp = $file['tmp_name'];
                if (file_exists('public/images/products/' . $file_name)) {
                    $file_name = date('Y-m-d-H-i-s') . '-' . $file_name;
                }
                move_uploaded_file($file_tmp, 'public/images/products/' . $file_name);
                $product->product_image = $file_name;
            } catch (\Exception $e) {
                writeLog($e);
            }
        }
        if (isset($request->product_image_slide)) {
            $listImage='';
            $amountImage = count($request->product_image_slide['name']);
            for ($i = 0; $i < $amountImage; $i++) {
                try{
                    $file = $request->product_image_slide;
                    $file_name = $file['name'][$i];
                    $file_tmp = $file['tmp_name'][$i];
                    if (file_exists('public/images/products/' . $file_name)) {
                        $file_name = date('Y-m-d-H-i-s') . '-' . $file_name;
                    }
                    move_uploaded_file($file_tmp, 'public/images/products/' . $file_name);
                    if($listImage!=''){
                        $listImage .= ','.$file_name;
                    }
                    else{
                        $listImage .= $file_name;
                    }
                }
                catch (\Exception $e) {
                    writeLog($e);
                }
            }
            $product->product_image_slide = $listImage;
        }
        $idSaved = $product->save();
        if(is_numeric($idSaved)){
            return redirect()->route('products',['message' => 'Thêm sản phẩm thành công']);
        }
        else{
            return redirect()->back([
                'errors' => 'Lỗi khi thêm sản phẩm'
            ]);
        }
    }
    public function edit($request)
    {
        $brands = Brand::all();
        $product = Product::find($request->id);
        $categories = Category::all();
        return view('admin.products.store', compact('product', 'brands', 'categories'));
    }
    public function update($request)
    {
        $dataUpdate = [
            'product_name' => $request->product_name,
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'hot' => $request->hot,
            'weight' => $request->weight,
            'unit_cost' => $request->unit_cost,
            'product_title' => $request->product_title,
            'product_description' => $request->product_description,
            'product_status' => $request->product_status,
            'product_content' => $request->product_content,
        ];
        if (isset($request->product_image) && $request->product_image['name'] != '') {
            try {
                $file = $request->product_image;
                $file_name = $file['name'];
                $file_tmp = $file['tmp_name'];
                if (file_exists('public/images/products/' . $file_name)) {
                    $file_name = date('Y-m-d-H-i-s') . '-' . $file_name;
                }
                move_uploaded_file($file_tmp, 'public/images/products/' . $file_name);
            } catch (\Exception $e) {
                writeLog($e);
            }
            $dataUpdate['product_image'] = $file_name;
        }
        if (isset($request->product_image_slide)&&count($request->product_image_slide['name'])>0) {
            $listImage = '';
            $amountImage = count($request->product_image_slide['name']);
            for ($i = 0; $i < $amountImage; $i++) {
                try{
                    $file = $request->product_image_slide;
                    $file_name = $file['name'][$i];
                    $file_tmp = $file['tmp_name'][$i];
                    if (file_exists('public/images/products/' . $file_name)) {
                        $file_name = date('Y-m-d-H-i-s') . '-' . $file_name;
                    }
                    move_uploaded_file($file_tmp, 'public/images/products/' . $file_name);
                    if($listImage!=''){
                        $listImage .= ','.$file_name;
                    }
                    else{
                        $listImage = $file_name;
                    }
                }
                catch (\Exception $e) {
                    writeLog($e);
                }
            }
            $dataUpdate['product_image_slide'] = $listImage;
        }
        $idUpdated = (new Product())->where(['product_id'=> $request->id])->update($dataUpdate);
        if (is_numeric($idUpdated)) {
            return redirect()->route('products', ['message' => 'Cập nhật thành công']);
        } else {
            return redirect()->back(['errors' => 'Cập nhật thất bại']);
        }
    }
    public function delete($request)
    {
        $isDeleted = (new Product())->where(['product_id'=> $request->id])->delete();
        if($isDeleted){
            return redirect()->route('products',['message' => 'Xóa sản phẩm thành công']);
        }
        else{
            return redirect()->back(['errors' => 'Xóa sản phẩm thất bại']);
        }
    }
}
