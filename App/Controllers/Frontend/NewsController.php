<?php
namespace App\Controllers\Frontend;
use Core\Controller;
use App\Models\News;

class NewsController extends Controller
{
    public function index($request)
    {
        $page = $request->page ?? 1;
        $perPage = $request->perPage ?? 10;
        $news = News::getNewsByPage($page, $perPage);
        return view('frontend.news.index', compact('news'));
    }
    public function detail($request)
    {
        $news = News::getNewsByPath($request->slug);
        $newsRelated = News::getNewsByPage();
        return view('frontend.news.detail', compact('news', 'newsRelated'));
    }
}