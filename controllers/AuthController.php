<?php

namespace app\controllers;

use app\base\controller;
use app\base\Init;
use app\base\Request;
use app\models\Auth\Login;
use app\models\User;
use app\base\traits\Response;


class AuthController extends controller
{
    use Response;
    public function login()
    {
        $login = new Login();
        if(Init::$self->request->isPost()) {
            $login->loadData(Init::$self->request->payload());
            if ($login->validate() && $login->login()) {

                self::redirect('/profile');
            }
            else
            {
                $this->setLayout('auth');
                return $this->view('login', ['model' => $login ]);
            }
        }
        else
        {
            $this->setLayout('auth');
            return $this->view('login',['model' => $login]);
        }

    }

    public function register(Request $request)
    {
        $register = new User();
        if($request->isPost()) {
            $register->loadData($request->payload());
            if ($register->validate() && $register->register()) {
                Init::$self->session->setFlash('success', 'Successfully registered');
                self::redirect('/login');
            }
            $this->setLayout('auth');
            return $this->view('register', [
                'model' => $register
            ]);
        }

        $this->setLayout('auth');
        return $this->view('register', [
            'model' => $register
        ]);
    }

    public function logout()
    {
        Init::$self->logout();
        self::redirect('/');
    }

    public function profile()
    {
        $this->setLayout('app');
        return $this->view('profile');
    }
}