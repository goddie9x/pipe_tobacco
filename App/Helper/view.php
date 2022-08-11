<?php
function view($view, $data = [])
{
    global $viewShare;
    $viewSplitPath = explode('.', $view);
    $view = './views/' . implode('/', $viewSplitPath) . '.php';
    if (count($viewSplitPath) > 1) {
        $viewPartials = './views/' . $viewSplitPath[0] . '/partials/main.php';
        if (file_exists($viewPartials)) {
            extract($viewShare);
            extract($data);
            include_once $viewPartials;
        }
        else{
            view('errors/404');
        }
    } else {
        $viewPartials = './views/frontend/partials/main.php';
        if (file_exists($view)) {
            extract($viewShare);
            extract($data);
            include_once $viewPartials;
        }
        else{
            view('errors/404');
        }
    }
}
function viewShare($key, $value)
{
    global $viewShare;
    $viewShare[$key] = $value;
}

function url($path = '',$is_route=false)
{
    if($is_route){
        global $listRoutePath;
        return url($listRoutePath[$path]);
    }
    $url = '/' . env('APP_PATH');
    if ($path) {
        $url .= '/' . $path;
    }
    return $url;
}
