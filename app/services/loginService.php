<?php

namespace App\Services;

use App\Core\Registry;
use App\Model\User;
use App\Repositories\UserRepository;

class LoginService extends Registry implements ILoginService
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function logout()
    {
        $this->unsetSession();
        $this->redirect('/outdoors/home');
    }

    public function login($username, $password, &$data)
    {
        if (empty($username)) {
            return $data['error_message'] = 'Username é obrigatório!';
        }

        if (empty($password)) {
            return $data['error_message'] = 'Senha é obrigatório!';
        }

        $responseUser = $this->userRepository->getUserByUsername($username);

        $isLogged = !empty(@$responseUser) && $password == $responseUser->password;

        if ($isLogged == true && $responseUser->status == User::STATUS_ACTIVE || $isLogged == true && $responseUser->access == 'manager') {
            $this->setSession("user", $responseUser);

            if ($responseUser->access == 'manager' && $responseUser->status == User::STATUS_INACTIVE) {
                $this->redirect('/outdoors/manager-update-password');
            } else {
                $this->redirect('/outdoors/home');
            }
        } else {
            $data['error_message'] = 'Falha no login, tente novamente mais tarde!';
        }
    }
}
