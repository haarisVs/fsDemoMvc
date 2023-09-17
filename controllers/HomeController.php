<?php

namespace app\controllers;

use app\base\controller;
use app\base\traits\Response;
class HomeController extends controller
{

    public function index()
    {
        self::redirect('/login');
    }
}