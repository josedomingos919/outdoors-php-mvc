<?php

namespace App\Services;

use App\Model\User;
use App\Repositories\UserRepository;

class UserService implements IUserService
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function addUser(User $user)
    {
        return $this->userRepository->addUser($user);
    }

    public function getUser(int $user_id)
    {
        return $this->userRepository->getUser($user_id);
    }
}
