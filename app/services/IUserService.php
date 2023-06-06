<?php

namespace App\Services;

use App\Model\User;

interface IUserService
{
    public function updateUser(User $user);
    public function addUser(User $user);
    public function getUser(int $user_id);
    public function getAdmins();
    public function toggleUser();
}
