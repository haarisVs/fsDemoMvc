<?php

namespace app\base\components;

use app\base\Model;

class Form
{
    public static function open($action, $method)
    {
        echo sprintf('<form action="%s" method="%s" enctype="multipart/form-data">', $action, $method);
        return new Form();
    }

    public static function close()
    {
        echo '</form>';
    }

    public function field(Model $model, $attribute, $value = '')
    {
        return new Field($model, $attribute, $value);
    }
}