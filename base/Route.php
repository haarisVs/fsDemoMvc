<?php

namespace app\base;

use app\base\traits\Response AS HttpStatus;

class Route
{
    use HttpStatus;
    public ?object $request;
    protected ?array $routes = [];

    /**
     * @param object|null $request
     */
    public function __construct($request)
    {
        $this->request = $request;
    }

    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;

    }

    public function resolve()
    {
       $path = $this->request->path();
       $method = $this->request->method();

       $callback = $this->routes[$method][$path] ?? false;

        if (is_array($callback)) {
            $callback[0] = new $callback[0];
            return call_user_func($callback, $this->request);
        }

       return (!$callback ? self::_404('_404')
            : (is_string($callback) ? $this->renderUI($callback)
            : call_user_func($callback)));
    }

    public function renderUI($pageUI)
    {
       $layout = $this->app_layout();
       $view = $this->pageView($pageUI);
       return str_replace('{{content}}', $view, $layout);
    }

    protected function app_layout()
    {
        ob_start();
        require_once Init::$ABS_DIR.'/views/layout/app.php';
        return ob_get_clean();
    }

    protected function pageView($pageIU)
    {
        ob_start();
        require_once Init::$ABS_DIR."/views/$pageIU.php";
        return ob_get_clean();
    }

}