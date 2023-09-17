<?php

namespace app\base;

use PDO;

abstract class ORM extends Model
{
    abstract public static function tableName(): string;

    abstract public function attributes(): array;

    abstract public static function primaryKey(): string;

    public function save()
    {
        $tableName = $this->tableName();
        $attributes = $this->attributes();
        $params = array_map(fn($attr) => ":$attr", $attributes);
        $statement = self::prepare("INSERT INTO $tableName (".implode(',', $attributes).") VALUES (".implode(',', $params).")");
        foreach ($attributes as $attribute) {
            $statement->bindValue(":$attribute", $this->{$attribute});
        }
        $statement->execute();
        return true;
    }

    public static function findOne($where)
    {
        $tableName = static::tableName();
        $attributes = array_keys($where);
        $sql = implode("AND ", array_map(fn($attr) => "$attr = :$attr", $attributes));
        $statement = self::prepare("SELECT * FROM $tableName WHERE $sql");
        foreach ($where as $key => $item) {
            $statement->bindValue(":$key", $item);
        }
        $statement->execute();
        return $statement->fetchObject(static::class);
    }

    public static function findAll($where = [])
    {
        $tableName = static::tableName();
        $sql = "SELECT * FROM $tableName ";

        if (!empty($where)) {
            $attributes = array_keys($where);
            $conditions = [];
            foreach ($attributes as $attr) {
                $conditions[] = "$attr = :$attr";
            }
            $sql .= " WHERE " . implode(" AND ", $conditions);
        }

        $statement = self::prepare($sql);

        foreach ($where as $key => $item) {
            $statement->bindValue(":$key", $item);
        }

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_CLASS, static::class);
    }

    public static function update($where, $data)
    {
        $tableName = static::tableName();
        $attributes = array_keys($data);
        $sql = implode(", ", array_map(fn($attr) => "$attr = :$attr", $attributes));
        $statement = self::prepare("UPDATE $tableName SET $sql WHERE id = :id");
        foreach ($data as $key => $item) {
            $statement->bindValue(":$key", $item);
        }
        $statement->bindValue(":id", $where);
        $statement->execute();
        return true;
    }

    public static function delete($where)
    {
        $tableName = static::tableName();
        $statement = self::prepare("DELETE FROM $tableName WHERE id = :id");
        $statement->bindValue(":id", $where);
        $statement->execute();
        return true;
    }


    public static function prepare($sql)
    {
        return Init::$self->db->pdo->prepare($sql);
    }
}