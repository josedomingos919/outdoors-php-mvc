<?php

namespace App\Services;

use App\Model\User;
use App\Core\Registry;
use App\Model\Manager;
use App\Repositories\ManagerRepository;

class ManagerService extends Registry implements IManagerService
{
    private $communeService;
    private $provinceService;
    private $municipalityService;
    private $userService;
    private $managerRepository;

    public function __construct(
        UserService $userService,
        CommuneService $communeService,
        ProvinceService $provinceService,
        ManagerRepository $managerRepository,
        MunicipalityService $municipalityService
    ) {
        parent::__construct();

        $this->userService     = $userService;
        $this->communeService  = $communeService;
        $this->provinceService = $provinceService;
        $this->managerRepository  = $managerRepository;
        $this->municipalityService = $municipalityService;
    }

    public function fillSelectData(&$data)
    {
        $data['provinces'] = $this->provinceService->getAll();
    }

    public function fillRegisterForm(&$data)
    {
        $formData = @$this->request->post['data'];

        $this->fillSelectData($data);

        if (isset($formData)) {
            $data['data'] = $formData;
            $data['communes'] = $this->communeService->getAll((int) @$formData['municipality_id']);
            $data['municipalities'] = $this->municipalityService->getAll((int) @$formData['province_id']);
        }
    }

    public function validateFormData(User $user, Manager $manager, &$data): bool
    {
        if (empty(@$manager->name)) {
            $data['error_message'] = "O nome não foi definido!";
            return false;
        }

        if (empty(@$manager->phone)) {
            $data['error_message'] = "O Telefone não foi definido!";
            return false;
        }

        if (empty(@$manager->communeId)) {
            $data['error_message'] = "A comuna não foi definida!";
            return false;
        }

        if (empty(@$manager->address)) {
            $data['error_message'] = "A morada não foi definida!";
            return false;
        }


        if (empty(@$user->email)) {
            $data['error_message'] = "O email não foi definido!";
            return false;
        }

        if (!filter_var(@$user->email, FILTER_VALIDATE_EMAIL)) {
            $data['error_message'] = "O email é inválido!";
            return false;
        }

        if (!in_array(@$user->status, array("0", "1"))) {
            $data['error_message'] = "O Status não foi definido!";
            return false;
        }

        if (empty(@$user->password)) {
            $data['error_message'] = "A senha não foi definida!";
            return false;
        }

        if (empty(@$user->username)) {
            $data['error_message'] = "Nome de usuário não foi definido!";
            return false;
        }

        if (empty(@$this->request->post['data']['password_confirm'])) {
            $data['error_message'] = "A senha de conformação não foi definida!";
            return false;
        }

        if ($user->password !== @$this->request->post['data']['password_confirm']) {
            $data['error_message'] = "As senhas são diferentes!";
            return false;
        }

        return true;
    }

    public function execAddRegitry(User $user, Manager $manager, &$data)
    {
        try {
            if (!$this->validateFormData($user, $manager, $data)) return false;

            $responseUser = $this->userService->addUser($user);

            if (!isset($responseUser)) {
                $data['error_message'] = "Falha, Tente novamente mais tarde!";
                return false;
            }

            $manager->userId = $responseUser->id;
            $responseManager = $this->managerRepository->addManager($manager);

            if (isset($responseManager)) {
                $data = array();

                $data['success_message'] = "Registrado com sucesso!";
                $data['provinces'] = $this->provinceService->getAll();

                EmialService::sendEmail(
                    'xpto@gmail.com',
                    'XPTO - OUTDOORS',
                    $responseUser->email,
                    $responseManager->name,
                    'Novo gestor XPTO',
                    $this->getHtml('mail/template1', [
                        'name' => $responseManager->name,
                        'message' => '
                            Você foi adicionado para ser um gestor na XPTO, 
                            aqui estão as suas credenciais
                            <hr>
                            Username: <b>' .  $responseUser->username . '</b> 
                            <br>Senha: <b>' . $responseUser->password . '</b>
                            <hr>
                            <br>
                            Obrigado!
                        '
                    ])
                );

                return true;
            } else {
                $data['error_message'] = "Falha, Tente novamente mais tarde!";
                return false;
            }
        } catch (\Exception $error) {
            $data['error_message'] = "Falha ao registar, verifque se todos os campos estão correctamente preenchidos e tente novamente!";
            return false;
        }
    }

    public function execUpdateRegitry(User $user, Manager $manager, &$data)
    {
        try {
            if (!$this->validateFormData($user, $manager, $data)) return false;

            $responseUser = $this->userService->updateUser($user);

            if (!$responseUser) {
                $data['error_message'] = "Falha ao atualizar, Tente novamente mais tarde!";
                return false;
            }

            $responseManager = $this->managerRepository->updateManager($manager);

            if ($responseManager) {
                $this->redirect('/outdoors/profile');
                return true;
            } else {
                $data['error_message'] = "Falha ao atualizar, Tente novamente mais tarde!";
                return false;
            }
        } catch (\Exception $error) {
            $data['error_message'] = "Falha ao atualizar, verifque se todos os campos estão correctamente preenchidos e tente novamente!";
            return false;
        }
    }

    public function getManagerByUserId(int $user_id)
    {
        return $this->managerRepository->getManagerByUserId($user_id);
    }
}
