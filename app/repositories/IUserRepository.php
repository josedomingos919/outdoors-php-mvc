<?php

namespace App\Repositories;

use App\Model\User;

interface IUserRepository
{
    public function addUser(User $user);
    public function getUser(int $user_id);
    public function updateUser(User $user);
    public function getAll(int $page);
    public function getUserByUsername(string $username);
    public function getAdmins();
    public function totalPage(): array;
}
