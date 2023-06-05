<?php

namespace App\Controller;

use App\Core\Registry;
use App\Model\Customer;
use App\Model\User;
use App\Services\CustomerService;

class HomeController extends Registry
{

    private $customerService;

    public function __construct(CustomerService $customerService)
    {
        parent::__construct();

        $this->customerService = $customerService;
    }

    public function index()
    {
        $this->getView('site/home', [
            'teste' => 'Olá 839'
        ]);
    }

    public function login()
    {
        $this->getView('site/login');
    }

    public function registry()
    {
        $data = array();

        $this->customerService->fillRegisterForm($data);

        if (!empty($this->request->post))
            $this->customerService->execAddRegitry(
                new User(
                    NULL,
                    @$this->request->post['data']['email'],
                    @$this->request->post['data']['password'],
                    @$this->request->post['data']['username'],
                    User::STATUS_INACTIVE
                ),
                new Customer(
                    NULL,
                    @$this->request->post['data']['type_id'],
                    @$this->request->post['data']['name'],
                    NULL,
                    @$this->request->post['data']['activity'],
                    @$this->request->post['data']['address'],
                    @$this->request->post['data']['commune_id'],
                    @$this->request->post['data']['nationality_id'],
                    @$this->request->post['data']['phone'],
                ),
                $data
            );

        $this->getView('site/registry', $data);
    }

    public function logout()
    {
        $this->getView('error/not_found');
    }
}
