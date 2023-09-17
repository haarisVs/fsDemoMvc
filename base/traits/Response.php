<?php

namespace app\base\traits;

use app\base\Init;
use app\base\controller;

trait Response
{

    public static function HttpCode($code)
    {
        $httpStatusCodes = [
            100 => 'Continue',
            101 => 'Switching Protocols',
            200 => 'OK',
            201 => 'Created',
            202 => 'Accepted',
            204 => 'No Content',
            404 => 'Not Found',
        ];

        if (array_key_exists($code, $httpStatusCodes)) {
            $statusText = $httpStatusCodes[$code];
            header("HTTP/1.1 $code $statusText");
        } else {
            // Default to a generic status text if the code is not recognized
            header("HTTP/1.1 $code Unknown Status");
        }
    }

    public static function view_path($pageUI, $params = [])
    {
        $layout = self::app_layout_view();
        $view =  self::page_view($pageUI,  $params);
        return str_replace('{{content}}', $view, $layout);
    }

    protected static function app_layout_view()
    {
        $template = controller::$layout;
        ob_start();
        require_once Init::$ABS_DIR."/views/layout/$template.php";
        return ob_get_clean();
    }

    protected static function page_view($pageIU,  $params = [])
    {
        if(!is_array($params))  $params = [];
        foreach ($params as $key => $value) $$key = $value;
        ob_start();
        require_once Init::$ABS_DIR."/views/$pageIU.php";
        return ob_get_clean();
    }

    public static function _404($pageIU)
    {
        ob_start();
        self::HttpCode(404);
        require_once Init::$ABS_DIR."/views/$pageIU.php";
        return ob_get_clean();
    }

    public static function redirect($url)
    {
        header("Location: $url");
        exit;
    }
}