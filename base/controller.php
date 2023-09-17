<?php

namespace app\base;

use app\base\middlewares\BaseMiddleware;
use app\base\traits\Response;

class controller
{
    use Response;

    /**
     * @var \app\base\middlewares\BaseMiddleware[]
     */

    public array $middleware = [];

    public ?string $action = '';
    public static string $layout = 'app';

    /**
     * @return string
     */

    /**
     * @param string $layout
     */
    public function setLayout(string $layout): void
    {
        self::$layout = $layout;
    }
    public static function view($view, $params = [])
    {
        return self::view_path($view, $params);
    }

    public function RegisterMiddleware(BaseMiddleware $middleware)
    {
        $this->middleware[] = $middleware;
    }

    /**
     * @return array
     */
    public function getMiddleware(): array
    {
        return $this->middleware;
    }

}