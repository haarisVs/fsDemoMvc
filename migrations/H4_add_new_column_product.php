<?php

use app\base\Init;

class H4_add_new_column_product
{
    public function up()
    {
        $db = Init::$self->db;
        $db->pdo->exec("ALTER TABLE products ADD COLUMN `image` VARCHAR(255) DEFAULT NULL AFTER `description`");
    }
}