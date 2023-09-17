<?php

namespace app\models;

use app\base\ORM;

class Category extends ORM
{

    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    public string $name = '';
    public string $description = '';

    public int $active = self::STATUS_ACTIVE;
    public function rules(): array
    {
        return [
            'name' => [self::RULE_REQUIRED],
            'description' => [self::RULE_REQUIRED],
        ];
    }
    public static function tableName(): string
    {
        return 'categories';
    }

    public function attributes(): array
    {
        return ['name', 'description', 'active'];
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
            'description' => 'Description',
        ];
    }

    public function getAllCategories()
    {
        return self::findAll([$this->active => self::STATUS_ACTIVE]);

    }

    public function getCategoryById($id)
    {
        return self::findOne(['id' => $id]);
    }

    public function updateCategory($id)
    {
        return self::update($id, ['name' => $this->name, 'description' => $this->description]);
    }

    public function deleteCategory($id)
    {
        return self::delete($id);
    }

      // write query not ORM

//    public function getAllCategories()
//    {
//        $statement = self::prepare("SELECT * FROM categories WHERE active = :status");
//        $statement->bindValue(":status", self::STATUS_ACTIVE);
//        $statement->execute();
//        return $statement->fetchAll(\PDO::FETCH_CLASS, self::class);
//    }
}