<?php
namespace Routes;
class Route
{
    protected $routes = [];
    protected $prefix = [];
    protected $namespace = [];
    protected $middleware = [];
    protected $currentUrl = '';
    public static $is_match = false;

    public function __construct()
    {
        $this->routes = [];
    }
    public function get($url, $action)
    {
        return $this->addRoute('GET', $url, $action);
    }
    public function post($url, $action)
    {
        return $this->addRoute('POST', $url, $action);
    }
    public function put($url, $action)
    {
        return $this->addRoute('PUT', $url, $action);
    }
    public function delete($url, $action)
    {
        return $this->addRoute('DELETE', $url, $action);
    }
    public function patch($url, $action)
    {
        return $this->addRoute('PATCH', $url, $action);
    }
    public function options($url, $action)
    {
        return $this->addRoute('OPTIONS', $url, $action);
    }
    public function any($url, $action)
    {
        return $this->addRoute('GET|POST|PUT|DELETE|PATCH|OPTIONS', $url, $action);
    }
    public function addRoute($method, $url, $action)
    {
        global $listRoutePath;
        $params = [];
        $url = trim($url, '/');
        if (strpos($url, '{') !== false) {
            $url = preg_replace_callback(
                '/\{([^}]+)\}/',
                function ($matches) use (&$params) {
                    $params[] = $matches[1];
                    return '(.+)';
                },
                $url,
            );
        }
        foreach ($this->prefix as $prefix) {
            $url = $prefix . '/' . $url;
        }
        $url = trim($url, '/');
        $url = $url == '' ? '/' : $url;
        $this->routes[$method][] = [
            'url' => $url,
            'action' => $action,
            'params' => $params,
        ];
        $listRoutePath[$url] = $this->currentUrl;
        $this->currentUrl = $url;
        return $this;
    }
    public function redirect($url)
    {
        header('Location: ' . $url);
    }

    public static function group($arrayOptions, $callback)
    {
        $route = new Route();
        if (isset($arrayOptions['prefix'])) {
            array_unshift($route->prefix, $arrayOptions['prefix']);
        }
        if (isset($arrayOptions['namespace'])) {
            array_unshift($route->namespace, $arrayOptions['namespace']);
        }
        if (isset($arrayOptions['middleware'])) {
            if (is_array($arrayOptions['middleware'])) {
                $route->middleware = array_merge($arrayOptions['middleware'], $route->middleware);
            } else {
                array_unshift($route->middleware, $arrayOptions['middleware']);
            }
        }
        $callback($route);
        $route->run();
    }
    public function subGroup($arrayOptions, $callback)
    {
        if (isset($arrayOptions['prefix'])) {
            array_unshift($this->prefix, $arrayOptions['prefix']);
        }
        if (isset($arrayOptions['namespace'])) {
            array_unshift($this->namespace, $arrayOptions['namespace']);
        }
        if (isset($arrayOptions['middleware'])) {
            if (is_array($arrayOptions['middleware'])) {
                $this->middleware = array_merge($arrayOptions['middleware'], $this->middleware);
            } else {
                array_unshift($this->middleware, $arrayOptions['middleware']);
            }
        }
        $callback($this);
        $this->run();
        array_shift($this->prefix);
    }
    public function run()
    {
        if (Route::$is_match) {
            return;
        }
        $url = $this->getUrl();
        $method = $_SERVER['REQUEST_METHOD'];
        if (isset($this->routes[$method])) {
            $routeInfo = $this->routes[$method];
            foreach ($routeInfo as $route) {
                if ($route['url'] == $url) {
                    Route::$is_match = true;
                    return $this->runMiddlewares($route['action'], $this->getRequestData());
                } else {
                    $pattern = '#^' . $route['url'] . '$#';
                    $matches = [];
                    if (preg_match($pattern, $url, $matches)) {
                        Route::$is_match = true;
                        foreach ($matches as $key => $value) {
                            if ($key > 0) {
                                $_GET[$route['params'][$key - 1]] = $value;
                            }
                        }
                        return $this->runMiddlewares($route['action'], $this->getRequestData());
                    }
                }
            }
        }
    }
    public function runMiddlewares($action, $requestData)
    {
        $middleware = array_shift($this->middleware);
        if (!$middleware) {
            return $this->getActionAndRun($action, $requestData);
        } else {
            $middleware = 'App\\Middlewares\\' . $middleware;
            $middleware = new $middleware();
            $middleware->handle($action, $requestData, [$this, 'runMiddlewares']);
        }
    }
    public function getUrl()
    {
        $rootFolder = realpath(__DIR__ . '../../');
        $rootFolderName = basename($rootFolder);
        $url = str_replace($rootFolderName, '', $_SERVER['REQUEST_URI']);
        $url = str_replace('//', '', $url);
        $url = preg_replace('/\?.*/', '', $url);
        if ($url == '') {
            $url = '/';
        }
        return $url;
    }
    public function getRequestData()
    {
        return (object) array_merge($_GET, $_POST, $_FILES, $_COOKIE, $_SERVER, $_REQUEST);
    }
    public static function notFound()
    {
        if (!Route::$is_match) {
            view('errors/404');
        }
    }
    public function getActionAndRun($actionInfo, $requestData)
    {
        $actionInfo = explode('@', $actionInfo);
        $controllerPath = $actionInfo[0];
        $action = $actionInfo[1];
        $controllerPath = str_replace('\\', '/', $controllerPath);
        $controllerWithNamespace = $controllerPath;
        foreach ($this->namespace as $namespace) {
            $controllerWithNamespace = $namespace . '/' . $controllerWithNamespace;
        }
        $controllerWithNamespace = 'App/Controllers/' . $controllerWithNamespace;

        $controllerPath = './' . $controllerWithNamespace . '.php';
        if (file_exists($controllerPath)) {
            include_once $controllerPath;
            $controllerWithNamespace = str_replace('/', '\\', $controllerWithNamespace);
            $controller = new $controllerWithNamespace();
            return $controller->$action($requestData);
        } else {
            writeLog('Controller ' . $controllerPath . ' not found');
        }
    }
    public static function permanentRedirect($currentUrl, $newUrl)
    {
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: ' . $newUrl);
    }
    public function name($name)
    {
        global $listRoutePath;
        $listRoutePath[$name] = $this->currentUrl;
    }
}
