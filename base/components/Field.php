<?php

namespace app\base\components;

use app\base\Model;

class Field
{
    const TYPE_TEXT = 'text';
    const TYPE_PASSWORD = 'password';
    const TYPE_FILE = 'file';

    public string $type;
    public Model $model;
    public string $attribute;

    public function __construct($model, $attribute, $value = '')
    {
        $this->type = self::TYPE_TEXT;
        $this->model = $model;
        $this->attribute = $attribute;
        $this->value = $value;
    }


    public function __toString(): string
    {
//        echo sprintf('<div class="form-group">');
//        echo sprintf('<label>%s</label>', $model->getLabel($attribute));
//        echo sprintf('<input type="text" name="%s" value="%s" class="form-control %s">',
//            $attribute,
//            $model->{$attribute},
//            $model->hasError($attribute) ? 'is-invalid' : ''
//        );
//        echo sprintf('<div class="invalid-feedback">%s</div>', $model->getFirstError($attribute));
//        echo sprintf('</div>');

        return sprintf('
            <div class="mb-3">
                <label  class="form-label">%s</label>
                <input type="%s" name="%s" value="%s" class="form-control %s" >
                <div class="invalid-feedback">%s</div>
            </div>',
            $this->model->labels()[$this->attribute] ?? $this->attribute,
            $this->type,
            $this->attribute,
            $this->value,
            $this->model->hasError($this->attribute) ? 'is-invalid' : '',
            $this->model->getFirstError($this->attribute)
        );

    }

    public function passwordField()
    {
        $this->type = self::TYPE_PASSWORD;
        return $this;
    }

       public function fileField()
        {
            $this->type = self::TYPE_FILE;
            return $this;
        }

}