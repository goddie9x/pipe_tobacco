<?php
namespace App\Controllers\Admin;
use Core\Controller;
use App\Models\News;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::all();
        return view('admin.news.index', compact('news'));
    }
    public function create()
    {
        return view('admin.news.store');
    }
    public function store($request)
    {
        $dataStore = [
            'news_keyword' => $request->news_keyword,
            'news_title' => $request->news_title,
            'news_path' => str_slug($request->news_title),
            'news_content' => $request->news_content,
            'news_description' => $request->news_description,
            'news_status' => $request->news_status,
            'created_at' => date('Y-m-d H:i:s'),
        ];
        if (isset($request->news_image)&&$request->news_image['name']!='') {
            try {
                $file = $request->news_image;
                $file_name = $file['name'];
                $file_tmp = $file['tmp_name'];
                if (file_exists('public/images/news/' . $file_name)) {
                    $file_name = date('Y-m-d-H-i-s') . '-' . $file_name;
                }
                move_uploaded_file($file_tmp, 'public/images/news/' . $file_name);
                $dataStore['news_image'] = $file_name;
            } catch (\Exception $e) {
                writeLog($e);
            }
        }
        $news = (new News())->insert($dataStore);
        if (is_numeric($news)) {
            return redirect()->to('admin/news');
        } else {
            return redirect()->back(['errors' => 'Lỗi không thể lưu dữ liệu']);
        }
    }
    public function edit($request)
    {
        $news = News::find($request->news_id);
        return view('admin.news.store', compact('news'));
    }
    public function update($request)
    {
        $newsDetail = News::find($request->news_id);
        $dataStore = [
            'news_path' => str_slug($request->news_title),
            'news_keyword' => $request->news_keyword,
            'news_title' => $request->news_title,
            'news_content' => $request->news_content,
            'news_description' => $request->news_description,
            'news_status' => $request->news_status,
            'created_at' => date('Y-m-d H:i:s'),
        ];
        if (isset($request->news_image)&&$request->news_image['name']!='') {
            try {
                $file = $request->news_image;
                $file_name = $file['name'];
                $file_tmp = $file['tmp_name'];
                if (file_exists('public/images/news/' . $file_name)) {
                    $file_name = date('Y-m-d-H-i-s') . '-' . $file_name;
                }
                move_uploaded_file($file_tmp, 'public/images/news/' . $file_name);
                $dataStore['news_image'] = $file_name;
            } catch (\Exception $e) {
                writeLog($e);
            }
        }
        if (count($newsDetail) > 0) {
            if(count($newsDetail)>0&&$newsDetail['news_image']!=''&&isset($request->news_image)&&$request->news_image['name']!=''){
                unlink('public/images/news/' . $newsDetail['news_image']);
            }
            $news = (new News())->where(['news_id' => $request->news_id])->update($dataStore);
        } else {
            $dataStore['news_id'] = $request->news_id;
            $news = (new News())->insert($dataStore);
        }
        if (is_numeric($news)) {
            return redirect()->to('admin/news');
        } else {
            return redirect()->back(['errors' => 'Lỗi không thể lưu dữ liệu']);
        }
    }
    public function delete($request)
    {
        $newsDetail = News::find($request->news_id);
        if(count($newsDetail)>0&&$newsDetail['news_image']!=''){
            unlink('public/images/news/' . $newsDetail['news_image']);
        }
        $isDeletedNews = (new News())->where(['news_id' => $request->news_id])->delete();
        if ($isDeletedNews) {
            return redirect()->to('admin/news');
        } else {
            return redirect()->back(['errors' => 'Lỗi không thể xóa dữ liệu']);
        }
    }
}
