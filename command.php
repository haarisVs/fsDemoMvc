<?php

use app\base\Init;

require_once __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();


$config = [
    'UserClass' => \app\models\User::class,
    'db' => [
        'dsn' => $_ENV['db_dns'],
        'user' => $_ENV['db_user'],
        'password' => $_ENV['db_pass']
    ]
];


$init = new Init(__DIR__, $config);

$init->db->applyMigrations();
