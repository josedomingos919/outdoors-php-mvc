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

    public function validateFormData($password, $confirm_password, &$data): bool
    {
        if (empty(@$password) || (empty(@$confirm_password))) {
            $data['error_message'] = "Senha não podem ser nula!";
            return false;
        }

        if ($password != $confirm_password) {
            $data['error_message'] = "As senhas são diferentes!";
            return false;
        }

        if ($password == $this->getSession('user')->password) {
            $data['error_message'] = "Senha precisa ser diferente da existente!";
            return false;
        }

        return true;
    }


    public function updateUserPassword(User $user, $password, $confirm_password, &$data)
    {
        if (!$this->validateFormData($password, $confirm_password, $data)) return;

        $user->setPassword($password);
        $user->setStatus(User::STATUS_ACTIVE);

        return $this->userRepository->updateUser($user);
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

    public function getAll($page)
    {
        return $this->userRepository->getAll($page);
    }

    public function totalPage(): array
    {
        return $this->userRepository->totalPage();
    }
}
