<?php
namespace App\Controllers\Frontend;
use Core\Controller;
use App\Models\PageDetail;
class PageController extends Controller
{
    public function index($request)
    {
        $page = (new PageDetail)->getFullPageDetailByPath($request->page);
        if(!$page){
            return view('errors/404');
        }
        else{
            $page = $page->toArray();
            return view('frontend.pages.index', $page);
        }
    }
}