<?php

namespace App\Services;

use App\Model\User;

interface IUserService
{
    public function addUser(User $user);
    public function getUser(int $user_id);
}
