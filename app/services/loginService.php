<?php

namespace App\Services;

use App\Core\Registry;
use App\Model\User;
use App\Repositories\IUserRepository;

class LoginService extends Registry implements ILoginService
{
    private $userRepository;

    public function __construct(IUserRepository $userRepository)
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

        if (!empty(@$responseUser) && $password == $responseUser->password && $responseUser->status == User::STATUS_ACTIVE) {
            $this->setSession("user", $responseUser);
            $this->redirect('/outdoors/home');
        } else {
            $data['error_message'] = 'Falha no login, tente novamente mais tarde!';
        }
    }
}
