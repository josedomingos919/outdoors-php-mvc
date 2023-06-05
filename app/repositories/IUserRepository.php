<?php

namespace App\Repositories;

use App\Model\User;

interface IUserRepository
{
    public function addUser(User $user);
    public function getUser(int $user_id);
}
