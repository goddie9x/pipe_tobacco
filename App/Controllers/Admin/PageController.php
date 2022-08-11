<?php
namespace App\Controllers\Admin;
use Core\Controller;
use App\Models\Page;
use App\Models\PageDetail;
class PageController extends Controller{
    public function index(){
        $pages = Page::getAllPages();
        return view('admin.pages.index',['pages' => $pages]);
    }
    public function create(){
        return view('admin.pages.store');
    }
    public function store($request){
        $page = new Page();
        $page_detail = new PageDetail();
        $page->page_name = $request->page_name;
        $page->page_path = $request->page_path;
        $page_detail->page_title = $request->page_title;
        $page_detail->page_keyword = $request->page_keyword;
        $page_detail->page_description = $request->page_description;
        $page_detail->page_image = $request->page_image;
        $page_detail->page_status = $request->page_status;
        $isSavedPage = $page->save();
        $isSavedPageDetail = $page_detail->save();
        if($isSavedPage && $isSavedPageDetail){
            return redirect()->to('pages');
        }
        else{
            return redirect()->to('admin.pages.create', ['errors' => 'Lỗi không thể lưu dữ liệu']);
        }
    }
    public function edit($request){
        $page_id = $request->page_id;
        $page = Page::find($page_id);
        $page_detail = PageDetail::getPageDetailByPageId($page_id);
        if(!$page_detail){
            $page_detail = [];
        }
        $page_info = array_merge($page, $page_detail);
        return view('admin.pages.store', ['page_info' => $page_info]);
    }
    public function update($request){
        $isUpdatedPage = (new Page)
        ->where(['page_id' => $request->page_id])
        ->update([
            'page_name' => $request->page_name,
            'page_path' => $request->page_path,
        ]);
        $isPageDetailExit = PageDetail::getPageDetailByPageId($request->page_id);
        $isUpdatedPageDetail;
        if($isPageDetailExit){
            $isUpdatedPageDetail = (new PageDetail)
            ->where(['page_id' => $request->page_id])
            ->update([
                'page_title' => $request->page_title,
                'page_keyword' => $request->page_keyword,
                'page_description' => $request->page_description,
                'page_image' => $request->page_image,
                'page_content'=> $request->page_content,
                'page_status' => $request->page_status,
            ]);
        }
        else{
            $isUpdatedPageDetail = (new PageDetail)
            ->insert([
                'page_id' => $request->page_id,
                'page_title' => $request->page_title,
                'page_keyword' => $request->page_keyword,
                'page_description' => $request->page_description,
                'page_image' => $request->page_image,
                'page_content'=>$request->page_content,
                'page_status' => $request->page_status,
            ]);
        }
        if($isUpdatedPage && $isUpdatedPageDetail){
            return redirect()->to('admin/pages');
        }
        else{
            return redirect()->to('admin/pages/edit/'.$request->page_id, ['errors' => 'Lỗi không thể lưu dữ liệu']);
        }
    }
    public function delete($request){
        $isDeletedPage = Page::where(['page_id' => $request->page_id])->delete();
        $isDeletedPageDetail = PageDetail::where(['page_id' => $request->page_id])->delete();
        if($isDeletedPage && $isDeletedPageDetail){
            return redirect()->to('admin.pages');
        }
        else{
            return redirect()->to('admin.pages', ['errors' => 'Lỗi không thể xóa dữ liệu']);
        }
    }
}