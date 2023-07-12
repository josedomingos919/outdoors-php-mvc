<?php

namespace App\Services;

use App\Core\Registry;
use App\Model\Customer;
use App\Model\User;
use App\Repositories\CustomerRepository;
use App\Repositories\OutdoorRepository;

class OutdoorService extends Registry implements IOutdoorService
{
    private $communeService;
    private $provinceService;
    private $nationalityService;
    private $municipalityService;
    private $customerTypeService;
    private $userService;
    private $customerRepository;
    private $outdoorRepository;

    public function __construct(
        UserService $userService,
        CommuneService $communeService,
        ProvinceService $provinceService,
        NationalityService $nationalityService,
        CustomerRepository $customerRepository,
        MunicipalityService $municipalityService,
        CustomerTypeService $customerTypeService,
        OutdoorRepository $outdoorRepository
    ) {
        parent::__construct();

        $this->outdoorRepository = $outdoorRepository;
        $this->userService     = $userService;
        $this->communeService  = $communeService;
        $this->provinceService = $provinceService;
        $this->nationalityService  = $nationalityService;
        $this->customerRepository  = $customerRepository;
        $this->municipalityService = $municipalityService;
        $this->customerTypeService = $customerTypeService;
    }

    public function fillSelectData(&$data)
    {
        $data['provinces'] = $this->provinceService->getAll();
        $data['nationalities'] = $this->nationalityService->getAll();
        $data['outdoor_types'] = $this->outdoorRepository->getAllTypes();
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

    public function validateFormData($outdoor, &$data): bool
    {
        if (empty(@$outdoor->price)) {
            $data['error_message'] = "O preço não foi definido!";
            return false;
        }

        if (empty(@$outdoor->tipoId)) {
            $data['error_message'] = "O tipo de outdoor não foi definido!";
            return false;
        }

        if (empty(@$outdoor->communeId)) {
            $data['error_message'] = "A comuna não foi definida!";
            return false;
        }

        return true;
    }

    public function execAddRegitry($outdoor, &$data)
    {
        try {
            if (!$this->validateFormData($outdoor, $data)) return false;

            $response = $this->outdoorRepository->add($outdoor);

            var_dump($response);
            if (empty($response)) {
                $data['error_message'] = "Falha, Tente novamente mais tarde!";
                return false;
            }

            $data = array();

            $data['success_message'] = "Registrado com sucesso!";
            $data['provinces'] = $this->provinceService->getAll();
            $data['nationalities'] = $this->nationalityService->getAll();
            $data['outdoor_types'] = $this->outdoorRepository->getAllTypes();

            return true;
        } catch (\Exception $error) {
            $data['error_message'] = "Falha ao registar, verifque se todos os campos estão correctamente preenchidos e tente novamente!";
            return false;
        }
    }

    public function notifyAdmin()
    {
        $admins = $this->userService->getAdmins();

        foreach ($admins as $admin) {
            EmialService::sendEmail(
                'xpto@gmail.com',
                'XPTO - OUTDOORS',
                $admin->email,
                $admin->email,
                'Activação de Conta',
                $this->getHtml('mail/template1', [
                    'name' => '',
                    'message' => 'Temos novo usuário na aplicação, e precisa fazer a ativação da conta dele para que ele posssa beneficiar dos recursos da aplicação, Obrigado!'
                ])
            );
        }
    }
    public function execUpdateRegitry(User $user, Customer $customer, &$data)
    {
        try {
            if (!$this->validateFormData($user, $customer, $data)) return false;

            $responseUser = $this->userService->updateUser($user);

            if (!$responseUser) {
                $data['error_message'] = "Falha ao atualizar, Tente novamente mais tarde!";
                return false;
            }

            $responseCustomer = $this->customerRepository->updateCustomer($customer);

            if ($responseCustomer) {
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

    public function getCustomerByUserId(int $user_id)
    {
        return $this->customerRepository->getCustomerByUserId($user_id);
    }
}
