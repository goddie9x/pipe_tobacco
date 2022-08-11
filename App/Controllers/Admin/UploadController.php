<?php
namespace App\Controllers\Admin;
use Core\Controller;

class UploadController extends Controller{
    public function index(){
        return view('admin.upload.index');
    }
    public function upload($request){
        try{
            $file = $request->upload;
            $file_name = $file['name'];
            $file_tmp = $file['tmp_name'];
            if(file_exists('public/images/'.$file_name)){
                $file_name = date('Y-m-d-H-i-s').'-'.$file_name;
            }
            move_uploaded_file($file_tmp, 'public/images/' . $file_name);
            return response()->json(['success' => true, 'file_name' => $file_name]);
        }
        catch(\Exception $e){
            writeLog($e);
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
    public function uploadPages($request){
        try{
            $file = $request->upload;
            $file_name = $file['name'];
            $file_tmp = $file['tmp_name'];
            if(file_exists('public/images/pages/'.$file_name)){
                $file_name = date('Y-m-d-H-i-s').'-'.$file_name;
            }
            move_uploaded_file($file_tmp, 'public/images/pages/' . $file_name);
            return response()->json(['success' => true, 'file_name' => $file_name]);
        }
        catch(\Exception $e){
            writeLog($e);
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
    public function uploadProducts($request){
        try{
            $file = $request->upload;
            $file_name = $file['name'];
            $file_tmp = $file['tmp_name'];
            if(file_exists('public/images/products/'.$file_name)){
                $file_name = date('Y-m-d-H-i-s').'-'.$file_name;
            }
            move_uploaded_file($file_tmp, 'public/images/products/' . $file_name);
            return response()->json(['success' => true, 'file_name' => $file_name]);
        }
        catch(\Exception $e){
            writeLog($e);
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}