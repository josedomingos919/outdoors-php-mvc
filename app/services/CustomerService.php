<?php

namespace App\Services;

use App\Core\Registry;
use App\Model\Customer;
use App\Model\User;
use App\Repositories\CustomerRepository;

class CustomerService extends Registry implements ICustomerService
{
    private $communeService;
    private $provinceService;
    private $nationalityService;
    private $municipalityService;
    private $customerTypeService;
    private $userService;
    private $customerRepository;

    public function __construct(
        UserService $userService,
        CommuneService $communeService,
        ProvinceService $provinceService,
        NationalityService $nationalityService,
        CustomerRepository $customerRepository,
        MunicipalityService $municipalityService,
        CustomerTypeService $customerTypeService
    ) {
        parent::__construct();

        $this->userService     = $userService;
        $this->communeService  = $communeService;
        $this->provinceService = $provinceService;
        $this->nationalityService  = $nationalityService;
        $this->customerRepository  = $customerRepository;
        $this->municipalityService = $municipalityService;
        $this->customerTypeService = $customerTypeService;
    }

    public function fillRegisterForm(&$data)
    {
        $formData = @$this->request->post['data'];

        $data['provinces'] = $this->provinceService->getAll();
        $data['nationalities'] = $this->nationalityService->getAll();
        $data['customer_types'] = $this->customerTypeService->getAll();

        if (isset($formData)) {
            $data['data'] = $formData;
            $data['communes'] = $this->communeService->getAll((int) @$formData['municipality_id']);
            $data['municipalities'] = $this->municipalityService->getAll((int) @$formData['province_id']);
        }
    }

    public function validateFormData(User $user, Customer $customer, &$data): bool
    {
        if (empty(@$customer->name)) {
            $data['error_message'] = "O nome não foi definido!";
            return false;
        }

        if (empty(@$customer->typeId)) {
            $data['error_message'] = "O tipo de cliente não foi definido!";
            return false;
        }

        if (empty(@$customer->communeId)) {
            $data['error_message'] = "A comuna não foi definida!";
            return false;
        }

        if (empty(@$customer->address)) {
            $data['error_message'] = "A morada não foi definida!";
            return false;
        }

        if (empty(@$customer->nationalityId)) {
            $data['error_message'] = "A nacionalidade não foi definida!";
            return false;
        }

        if (empty(@$customer->phone)) {
            $data['error_message'] = "O Telefone não foi definido!";
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

    public function execAddRegitry(User $user, Customer $customer, &$data)
    {
        try {
            if (!$this->validateFormData($user, $customer, $data)) return false;

            $responseUser = $this->userService->addUser($user);

            if (!isset($responseUser)) {
                $data['error_message'] = "Falha, Tente novamente mais tarde!";
                return false;
            }

            $customer->userId = $responseUser->id;
            $responseCustomer = $this->customerRepository->addCustomer($customer);

            if (isset($responseCustomer)) {
                $data = array();

                $data['success_message'] = "Registrado com sucesso, pode inicar secção <a href='/outdoors/login'>Clique Aqui</a>!";
                $data['provinces'] = $this->provinceService->getAll();
                $data['nationalities'] = $this->nationalityService->getAll();
                $data['customer_types'] = $this->customerTypeService->getAll();

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
}
