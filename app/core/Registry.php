<?php

namespace App\Core;

class Registry
{
    public $teste;
    protected $request;

    public function __construct()
    {
        $this->request = new Request();
    }

    public function unsetSession()
    {
        session_unset();
    }

    public function setSession($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function redirect($url)
    {
        header('location: ' . $url);
    }

    public function getView($path = "", $data = [])
    {
        Twig::render($path, $data);
    }

    public function getHtml($path = "", $data = [])
    {
        return Twig::getHtml($path, $data);
    }
}
