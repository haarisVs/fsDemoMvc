<?php

use app\base\Init;

class H1_user
{
    public function up()
    {
        $conn = Init::$self->db;
        $SQL = "CREATE TABLE users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            firstname VARCHAR(255) NOT NULL,
            lastname VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            password VARCHAR(255) NOT NULL,
            status TINYINT NOT NULL DEFAULT 1,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=INNODB;";
        $conn->pdo->exec($SQL);
    }

    public function down()
    {
        $db = Init::$self->db;
        $SQL = "DROP TABLE users;";
        $db->pdo->exec($SQL);
    }
}