<?php

namespace App\Services;

use App\Core\Registry;
use App\Model\User;
use App\Repositories\UserRepository;

class UserService extends Registry implements IUserService
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        parent::__construct();
        $this->userRepository = $userRepository;
    }

    public function updateUser(User $user)
    {
        return $this->userRepository->updateUser($user);
    }

    public function addUser(User $user)
    {
        return $this->userRepository->addUser($user);
    }

    public function getUser(int $user_id)
    {
        return $this->userRepository->getUser($user_id);
    }

    public function toggleUser()
    {
        if (isset($this->request->get["user_id"])) {
            $user = $this->getUser($this->request->get["user_id"]);

            $toggle = array(
                '0' => '1',
                '1' => '0'
            );

            $user->status = $toggle[$user->status];

            if ($this->updateUser($user) && $user->status == User::STATUS_ACTIVE) {
                EmialService::sendEmail(
                    'xpto@gmail.com',
                    'XPTO - OUTDOORS',
                    $user->email,
                    $user->email,
                    'Conta Activada',
                    $this->getHtml('mail/template1', [
                        'name' =>  '',
                        'message' => 'A sua conta na XPTO já encontra-se activa.<br>Obrigado!'
                    ])
                );
            }
        }
    }

    public function getAdmins()
    {
        return $this->userRepository->getAdmins();
    }

    public function getAll()
    {
        return $this->userRepository->getAll();
    }
}
