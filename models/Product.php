<?php

namespace app\models;

use app\base\ORM;

class Product extends ORM
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    public string $name = '';
    public string $description = '';

    public int $price = 0;

    public int $category_id = 0;

    public ?string $image = '';

    public int $active = self::STATUS_ACTIVE;

    public function rules(): array
    {
        return [
            'name' => [self::RULE_REQUIRED],
            'description' => [self::RULE_REQUIRED],
            'price' => [self::RULE_REQUIRED],
            'category_id' => [self::RULE_REQUIRED],
        ];
    }

    public static function tableName(): string
    {
       return 'products';
    }

    public function attributes(): array
    {
        return ['name', 'price', 'category_id', 'description', 'image', 'active'];
    }

    public static function primaryKey(): string
    {
        return 'id';
    }

    public function hasError($attribute)
    {
        return $this->errors[$attribute] ?? false;
    }

    public function getFirstError($attribute)
    {
        return $this->errors[$attribute][0] ?? false;
    }


    public function labels(): array
    {
        return [
            'name' => 'Name',
             'price' => 'Price',
             'description' => 'Description',
        ];
    }

    public function getAllProducts()
    {
        return self::findAll(['active' => self::STATUS_ACTIVE]);
    }

    public function getProductById($id)
    {
        return self::findOne(['id' => $id]);
    }

    public function updateProduct($id)
    {
        return self::update($id, ['name' => $this->name, 'price' => $this->price, 'category_id' => $this->category_id, 'description' => $this->description]);
    }

    public function deleteProduct($id)
    {
        return self::update($id, ['active' => self::STATUS_INACTIVE]);
    }

}