<?php
namespace App\Controllers\Admin;
use Core\Controller;
use App\Models\Nav;
use App\Models\Page;
use App\Models\PageDetail;
class PageController extends Controller
{
    public function index()
    {
        $pages = Page::getAllPages();
        return view('admin.pages.index', ['pages' => $pages]);
    }
    public function create()
    {
        $navs = Nav::all();
        return view('admin.pages.store', ['navs' => $navs]);
    }
    public function store($request)
    {
        $page = new Page();
        $page->page_name = $request->page_name;
        $page->nav_id = $request->nav_id;
        $page_id = $page->save();
        if (is_numeric($page_id)) {
            $page_detail = new PageDetail();
            $page_detail->page_id = $page_id;
            $page_detail->page_title = $request->page_title;
            $page_detail->page_keywords = $request->page_keywords;
            $page_detail->page_description = $request->page_description;
            $page_detail->page_content = $request->page_content;
            $page_detail->status = $request->status;
            $file_name;
            if (isset($request->page_image)&&$request->page_image['name']!='') {
                try {
                    $file = $request->page_image;
                    $file_name = $file['name'];
                    $file_tmp = $file['tmp_name'];
                    if (file_exists('public/images/pages/' . $file_name)) {
                        $file_name = date('Y-m-d-H-i-s') . '-' . $file_name;
                    }
                    move_uploaded_file($file_tmp, 'public/images/pages/' . $file_name);
                } catch (\Exception $e) {
                    writeLog($e);
                }
            }
            $page_detail->page_image = $file_name;
            $page_detail->save();
            return redirect()->route('pages');
        } else {
            return redirect()->route('create_page');
        }
    }
    public function edit($request)
    {
        $page_id = $request->page_id;
        $page = Page::find($page_id);
        $page_detail = PageDetail::getPageDetailByPageId($page_id);
        if (!$page_detail) {
            $page_detail = [];
        }
        $navs = Nav::all();
        $page_info = array_merge($page, $page_detail);
        return view('admin.pages.store', compact('page_info', 'navs'));
    }
    public function update($request)
    {
        $isUpdatedPage = (new Page())->where(['page_id' => $request->page_id])->update([
            'page_name' => $request->page_name,
            'nav_id' => $request->nav_id,
        ]);
        $PageDetailExit = PageDetail::getPageDetailByPageId($request->page_id);
        $isUpdatedPageDetail;
        $dataStore = [
            'page_title' => $request->page_title,
            'page_keywords' => $request->page_keywords,
            'page_description' => $request->page_description,
            'page_content' => $request->page_content,
            'status' => $request->status,
        ];
        if (isset($request->page_image)&&$request->page_image['name']!='') {
            try {
                $file = $request->page_image;
                $file_name = $file['name'];
                $file_tmp = $file['tmp_name'];
                if (file_exists('public/images/pages/' . $file_name)) {
                    $file_name = date('Y-m-d-H-i-s') . '-' . $file_name;
                }
                move_uploaded_file($file_tmp, 'public/images/pages/' . $file_name);
                $dataStore['page_image'] = $file_name;
            } catch (\Exception $e) {
                writeLog($e);
            }
        }
        
        if (count($PageDetailExit) > 0) {
            $isUpdatedPageDetail = (new PageDetail())->where(['page_id' => $request->page_id])->update($dataStore);
        } else {
            $dataStore['page_id'] = $request->page_id;
            $isUpdatedPageDetail = (new PageDetail())->insert($dataStore);
        }
        if ($isUpdatedPage && $isUpdatedPageDetail) {
            return redirect()->to('admin/pages');
        } else {
            return redirect()->back(['errors' => 'Lỗi không thể lưu dữ liệu']);
        }
    }
    public function delete($request)
    {
        $isDeletedPage = (new Page())->where(['page_id' => $request->page_id])->delete();
        $isDeletedPageDetail = (new PageDetail())->where(['page_id' => $request->page_id])->delete();
        if ($isDeletedPage && $isDeletedPageDetail) {
            return redirect()->to('admin/pages');
        } else {
            return redirect()->back(['errors' => 'Lỗi không thể xóa dữ liệu']);
        }
    }
}
