<?php

namespace App\Core;

class Request
{
    public $post;
    public $get;
    public $session;

    public function __construct()
    {
        $this->get = $_GET;
        $this->post = $_POST;
        $this->session = $_SESSION;
    }

    public function clearSession()
    {
        session_unset();
        session_destroy();
    }
}
