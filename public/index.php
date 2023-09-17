<?php

require_once __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();



use app\controllers\AuthController;
use app\controllers\CategoryController;
use app\base\Init;
use app\controllers\HomeController;
use app\controllers\ProductController;

$config = ['UserClass' => \app\models\User::class, 'db' => [ 'dsn' => $_ENV['db_dns'],  'user' => $_ENV['db_user'], 'password' => $_ENV['db_pass']]];

$init = new Init(dirname(__DIR__), $config);

$init->route->get('/',[HomeController::class, 'index']);

$init->route->get('/login', [AuthController::class, 'login']);
$init->route->get('/register', [AuthController::class, 'register']);

$init->route->post('/login', [AuthController::class, 'login']);
$init->route->post('/register', [AuthController::class, 'register']);
$init->route->get('/logout', [AuthController::class, 'logout']);

Init::isGuest() ?: $init->route->get('/profile', [AuthController::class, 'profile']);
Init::isGuest() ?: $init->route->get('/category', [CategoryController::class, 'index']);
Init::isGuest() ?: $init->route->post('/category', [CategoryController::class, 'create']);
Init::isGuest() ?: $init->route->get('/category/show', [CategoryController::class, 'show']);
Init::isGuest() ?: $init->route->post('/category/update', [CategoryController::class, 'update']);
Init::isGuest() ?: $init->route->get('/category/delete', [CategoryController::class, 'delete']);

Init::isGuest() ?: $init->route->get('/product', [ProductController::class, 'index']);
Init::isGuest() ?: $init->route->post('/product', [ProductController::class, 'create']);
Init::isGuest() ?: $init->route->get('/product/show', [ProductController::class, 'show']);
Init::isGuest() ?: $init->route->post('/product/update', [ProductController::class, 'update']);
Init::isGuest() ?: $init->route->get('/product/delete', [ProductController::class, 'delete']);

$init->BaseInit();

