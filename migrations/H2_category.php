<?php

use app\base\Init;

class H2_category
{
    public function up()
    {
        $conn = Init::$self->db;
        $SQL = "CREATE TABLE categories (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            description TEXT,
            active TINYINT NOT NULL DEFAULT 1,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=INNODB;";
        $conn->pdo->exec($SQL);
    }

    public function down()
    {
        $conn = Init::$self->db;
        $SQL = "DROP TABLE categories;";
        $conn->pdo->exec($SQL);
    }
}