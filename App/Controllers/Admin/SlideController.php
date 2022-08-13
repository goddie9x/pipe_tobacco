<?php
namespace App\Controllers\Admin;
use Core\Controller;
use App\Models\Slide;

class SlideController extends Controller
{
    public function index()
    {
        $slides = Slide::all();
        return view('admin.slides.index', compact('slides'));
    }
    public function create()
    {
        return view('admin.slides.store');
    }
    public function store($request)
    {
        $slide = new Slide();
        $slide->for_page = $request->for_page;
        $slide->slide_name = $request->slide_name;
        $slide->slide_status = $request->slide_status;
        if(isset($request->slide_image) && $request->slide_image['name'] != '') {
            try {
                $file = $request->slide_image;
                $file_name = $file['name'];
                $file_tmp = $file['tmp_name'];
                if (file_exists('public/images/products/' . $file_name)) {
                    $file_name = date('Y-m-d-H-i-s') . '-' . $file_name;
                }
                move_uploaded_file($file_tmp, 'public/images/products/' . $file_name);
                $slide->slide_image = $file_name;
            } catch (\Exception $e) {
                writeLog($e);
            }
        }
        $isSaved = $slide->save();
        if ($isSaved) {
            return redirect()->route('slides', ['message' => 'Thêm mới thành công']);
        }
        else{
            return redirect()->back(['errors' => 'Thêm mới thất bại']);
        }
    }
    public function edit($request)
    {
        $slide = Slide::find($request->id);
        if(count($slide) > 0) {
            return view('admin.slides.store', compact('slide'));
        }
        else {
            return redirect()->back(['errors' => 'Không tìm thấy slide']);
        }
    }
    public function update($request)
    {
        $slide = Slide::find($request->id);
        if(count($slide) > 0) {
            $updateData = [];
            $updateData['for_page'] = $request->for_page;
            $updateData['slide_name'] = $request->slide_name;
            $updateData['slide_status'] = $request->slide_status;
            if(isset($request->slide_image) && $request->slide_image['name'] != '') {
                try {
                    $file = $request->slide_image;
                    $file_name = $file['name'];
                    $file_tmp = $file['tmp_name'];
                    if (file_exists('public/images/products/' . $file_name)) {
                        $file_name = date('Y-m-d-H-i-s') . '-' . $file_name;
                    }
                    move_uploaded_file($file_tmp, 'public/images/products/' . $file_name);
                    $updateData['slide_image'] = $file_name;
                    if($slide['slide_image'] != '') {
                        unlink('public/images/products/' . $slide['slide_image']);
                    }
                } catch (\Exception $e) {
                    writeLog($e);
                }
            }
            $idUpdated = (new Slide)->where(['slide_id'=> $request->id])->update($updateData);
            if (is_numeric($idUpdated)) {
                return redirect()->route('slides', ['message' => 'Cập nhật thành công']);
            }
            else{
                return redirect()->back(['errors' => 'Cập nhật thất bại']);
            }
        }
        else {
            return redirect()->back(['errors' => 'Không tìm thấy slide']);
        }
    }
    public function delete($request)
    {
        $slide = Slide::find($request->id);
        if(count($slide) > 0) {
            $isDeleted = Slide::where([['slide_id'=> $request->id]])->delete();
            if ($isDeleted) {
                if($slide['slide_image'] != '') {
                        unlink('public/images/products/' . $slide['slide_image']);
                }
                return redirect()->back(['message' => 'Xóa thành công']);
            }
            else{
                return redirect()->back(['errors' => 'Xóa thất bại']);
            }
        }
        else {
            return redirect()->back(['errors' => 'Không tìm thấy slide']);
        }
    }
}