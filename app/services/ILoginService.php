<?php

namespace App\Services;

interface ILoginService
{
    public function login($email, $password, &$data);
}
