<?php

namespace App\Controller;

use App\Core\Registry;
use App\Services\CustomerService;

use App\Model\Customer;
use App\Model\Manager;
use App\Model\Outdoor;
use App\Model\User;
use App\Services\CommuneService;
use App\Services\EmialService;
use App\Services\LoginService;
use App\Services\ManagerService;
use App\Services\MunicipalityService;
use App\Services\OutdoorService;
use App\Services\ProvinceService;
use App\Services\UserService;

class OutdoorController extends Registry
{
    private $outdoorService;
    private $loginService;
    private $communeService;
    private $municipalityService;
    private $provinceService;
    private $userService;
    private $managerService;

    public function __construct(
        OutdoorService $outdoorService,
        LoginService $loginService,
        CommuneService $communeService,
        MunicipalityService $municipalityService,
        ProvinceService $provinceService,
        UserService $userService,
        ManagerService $managerService
    ) {
        parent::__construct();

        $this->managerService = $managerService;
        $this->userService = $userService;
        $this->communeService = $communeService;
        $this->municipalityService = $municipalityService;
        $this->provinceService = $provinceService;
        $this->loginService = $loginService;
        $this->outdoorService = $outdoorService;
    }

    public function add()
    {
        $data = array();

        $this->outdoorService->fillRegisterForm($data);

        if (!empty($this->request->post)) {
            $data = array_merge($this->request->post['data'], $data);

            $this->outdoorService->execAddRegitry(
                new Outdoor(
                    NULL,
                    @$this->request->post["data"]['tipoId'],
                    @$this->request->post["data"]['price'],
                    Outdoor::STATUS_AVALIABLE,
                    @$this->request->post["data"]['commune_id'],
                ),
                $data
            );
        }

        $this->getView('site/add_outdoors', $data);
    }

    public function update()
    {
        $this->getView('error/not_found');
    }

    public function remove()
    {
        $this->getView('error/not_found');
    }

    public function list()
    {
        $this->getView('error/not_found');
    }

    public function request()
    {
        $this->getView('error/not_found');
    }
}
