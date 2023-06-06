<?php

namespace App\Controller;

use App\Core\Registry;
use App\Model\Customer;
use App\Model\Manager;
use App\Model\User;
use App\Services\ICommuneService;
use App\Services\ICustomerService;
use App\Services\ILoginService;
use App\Services\IManagerService;
use App\Services\IMunicipalityService;
use App\Services\IProvinceService;
use App\Services\IUserService;

class HomeController extends Registry
{
    private $customerService;
    private $loginService;
    private $communeService;
    private $municipalityService;
    private $provinceService;
    private $userService;
    private $managerService;

    public function __construct(
        ICustomerService $customerService,
        ILoginService $loginService,
        ICommuneService $communeService,
        IMunicipalityService $municipalityService,
        IProvinceService $provinceService,
        IUserService $userService,
        IManagerService $managerService
    ) {
        parent::__construct();

        $this->managerService = $managerService;
        $this->userService = $userService;
        $this->communeService = $communeService;
        $this->municipalityService = $municipalityService;
        $this->provinceService = $provinceService;
        $this->loginService = $loginService;
        $this->customerService = $customerService;
    }

    public function index()
    {
        $this->getView('site/home');
    }


    public function email()
    {
        $data = array('name' => 'José', 'message' => 'Message');
        $this->getView('mail/template1', $data);
    }

    public function profile()
    {
        $data = array();
        $user = $this->request->session['user'];
        $customer = $this->customerService->getCustomerByUserId($user->id);

        $this->customerService->fillRegisterForm($data);

        if (isset($this->request->post["data"])) {
            $this->customerService->execUpdateRegitry(
                new User(
                    $user->id,
                    @$this->request->post["data"]['email'],
                    @$this->request->post["data"]['password'],
                    @$this->request->post["data"]['username'],
                    $user->status
                ),
                new Customer(
                    $customer->id,
                    @$this->request->post["data"]['type_id'],
                    @$this->request->post["data"]['name'],
                    $user->id,
                    @$this->request->post["data"]['activity'],
                    @$this->request->post["data"]['address'],
                    @$this->request->post["data"]['commune_id'],
                    @$this->request->post["data"]['nationality_id'],
                    @$this->request->post["data"]['phone'],
                ),
                $data
            );
        } else {
            $commune  = $this->communeService->getOne($customer->communeId);
            $municipality = $this->municipalityService->getOne($commune->municipality_id);
            $province = $this->provinceService->getOne($municipality->province_id);

            $data['municipalities'] = $this->municipalityService->getAll($province->id);
            $data['communes'] = $this->communeService->getAll($municipality->id);

            $data["data"] = array(
                'email' => $user->email,
                'username' => $user->username,
                'password' => $user->password,
                'password_confirm' => $user->password,
                'name' => $customer->name,
                'type_id' => $customer->typeId,
                'activity' => $customer->activity,
                'province_id' => $province->id,
                'municipality_id' => $municipality->id,
                'commune_id' => $commune->id,
                'nationality_id' => $customer->nationalityId,
                'address' => $customer->address,
                'phone' => $customer->phone
            );
        }

        $this->getView('site/profile', $data);
    }

    public function login()
    {
        $data = array();

        if (!empty($this->request->post["data"])) {
            $data["data"] = $this->request->post["data"];

            $this->loginService->login(
                $this->request->post["data"]["username"],
                $this->request->post["data"]["password"],
                $data
            );
        }

        $this->getView('site/login', $data);
    }

    public function manager()
    {
        $data = array();

        $this->managerService->fillRegisterForm($data);

        if (isset($this->request->post["data"]))
            $this->managerService->execAddRegitry(
                new User(
                    NULL,
                    $this->request->post["data"]["email"],
                    $this->request->post["data"]["password"],
                    $this->request->post["data"]["username"],
                    User::STATUS_INACTIVE,
                    USER::ACCESS_MANAGER
                ),
                new Manager(
                    NULL,
                    $this->request->post["data"]["name"],
                    NULL,
                    $this->request->post["data"]["address"],
                    $this->request->post["data"]["commune_id"],
                    $this->request->post["data"]["phone"],
                ),
                $data
            );

        $this->getView('site/manager', $data);
    }

    public function registry()
    {
        $data = array();

        $this->customerService->fillRegisterForm($data);

        if (!empty($this->request->post))
            $this->customerService->execAddRegitry(
                new User(
                    NULL,
                    @$this->request->post["data"]['email'],
                    @$this->request->post["data"]['password'],
                    @$this->request->post["data"]['username'],
                    User::STATUS_INACTIVE
                ),
                new Customer(
                    NULL,
                    @$this->request->post["data"]['type_id'],
                    @$this->request->post["data"]['name'],
                    NULL,
                    @$this->request->post["data"]['activity'],
                    @$this->request->post["data"]['address'],
                    @$this->request->post["data"]['commune_id'],
                    @$this->request->post["data"]['nationality_id'],
                    @$this->request->post["data"]['phone'],
                ),
                $data
            );

        $this->getView('site/registry', $data);
    }

    public function users()
    {
        $data = array();

        $data['users'] = $this->userService->getAll();

        $this->getView('site/users', $data);
    }

    public function toggleUser()
    {
        $this->userService->toggleUser();
        $this->redirect('/outdoors/users');
    }

    public function logout()
    {
        $this->loginService->logout();
    }
}
