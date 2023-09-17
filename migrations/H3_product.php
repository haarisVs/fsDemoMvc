<?php

use app\base\Init;

class h3_product
{
    public function up()
    {
        $conn = Init::$self->db;
        $SQL = "CREATE TABLE products (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            description TEXT,
            price DECIMAL(10, 2) NOT NULL,
            category_id INT NOT NULL,
            active TINYINT NOT NULL DEFAULT 1,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (category_id) REFERENCES categories(id)
        ) ENGINE=INNODB;";
        $conn->pdo->exec($SQL);
    }

    public function down()
    {
        $db = Init::$self->db;
        $SQL = "DROP TABLE product;";
        $db->pdo->exec($SQL);
    }
}