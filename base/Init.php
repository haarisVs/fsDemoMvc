<?php

namespace app\base;

class Init
{
    public static ?string $ABS_DIR = null;

    public static ?Init $self = null;
    public ?object $route;
    public ?object $request;
    public ?Controller $controller = null;

    public ?object $db;

    public ?object $user;

    public ?object $session;

    public function __construct($absolutePath, array $config)
    {
        $this->userClass = $config['UserClass'];
        self::$self = $this;
        self::$ABS_DIR = $absolutePath;
        $this->request = new Request();
        $this->route = new Route($this->request);
        $this->db = new Database($config['db']);
        $this->session = new Session();

        $primaryValue = $this->session->get('user');
        if($primaryValue)
        {
            $primarykey = $this->userClass::primaryKey();
            $this->user = $this->userClass::findOne([$primarykey => $primaryValue]);
        }
        else
        {
            $this->user = null;
        }
    }

    public function BaseInit()
    {
        echo $this->route->resolve();
    }

    public function login($user)
    {
        $this->user = $user;
        $primaryKey = $user->primaryKey();
        $primaryKey = $user->{$primaryKey};
        $this->session->set('user', $primaryKey);

        return true;
    }

    public function logout()
    {
        $this->user = null;
        $this->session->remove('user');
    }

    public static function isGuest()
    {
        return !self::$self->user;
    }


}