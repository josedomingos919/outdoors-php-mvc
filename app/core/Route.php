<?php

use App\Controller\CommuneController;
use App\Controller\CustomerTypeController;
use App\Controller\HomeController;
use App\Controller\ErrorController;
use App\Controller\MunicipalityController;
use App\Controller\NationalityController;
use App\Controller\ProvinceController;
use App\Repositories\CommuneReposity;
use App\Repositories\CustomerRepository;
use App\Repositories\CustomerTypeRepository;
use App\Repositories\ManagerRepository;
use App\Repositories\MunicipalityReposity;
use App\Repositories\NationalistyReposity;
use App\Repositories\ProvinceRepository;
use App\Repositories\UserRepository;
use App\Services\CommuneService;
use App\Services\CustomerService;
use App\Services\CustomerTypeService;
use App\Services\LoginService;
use App\Services\ManagerService;
use App\Services\MunicipalityService;
use App\Services\NationalityService;
use App\Services\ProvinceService;
use App\Services\UserService;

$userService = new UserService(new UserRepository);
$communeService = new CommuneService(new CommuneReposity);
$provinceService = new ProvinceService(new ProvinceRepository);
$municipalityService = new MunicipalityService(new MunicipalityReposity);
$customerTypeService = new CustomerTypeService(new CustomerTypeRepository);
$nationalityService = new NationalityService(new NationalistyReposity);
$customerService = new CustomerService(
    $userService,
    $communeService,
    $provinceService,
    $nationalityService,
    new CustomerRepository,
    $municipalityService,
    $customerTypeService,
);
$loginService = new LoginService(new UserRepository);
$managerService = new ManagerService($userService, $communeService, $provinceService, new ManagerRepository, $municipalityService);

$errorController = new ErrorController();
$homeController = new HomeController(
    $customerService,
    $loginService,
    $communeService,
    $municipalityService,
    $provinceService,
    $userService,
    $managerService
);
$communeController = new CommuneController($communeService);
$provinceController = new ProvinceController($provinceService);
$municipalityController = new MunicipalityController($municipalityService);
$nationalityController = new NationalityController($nationalityService);
$customerTypeController = new CustomerTypeController($customerTypeService);


if (empty(@$_REQUEST['route']) || $_REQUEST['route'] == 'index.php') {
    return header('location: /outdoors/home');
}

//public
switch ($_REQUEST['route']) {
    case "home":
        return $homeController->index();

    case "province/all":
        return $provinceController->all();

    case "email":
        return $homeController->email();

    case "municipality/all":
        return $municipalityController->all();

    case "commune/all":
        return $communeController->all();

    case "nationality/all":
        return  $nationalityController->all();

    case "customer-type/all":
        return  $customerTypeController->all();
}

//admin
if (isset($_SESSION['user']) && $_SESSION['user']->access == 'admin') {
    switch ($_REQUEST['route']) {
        case "manager":
            return $homeController->manager();

        case "toogle-user":
            return $homeController->toggleUser();

        case "users":
            return $homeController->users();

        case "logout":
            return $homeController->logout();
    }
}

//normal
if (isset($_SESSION['user']) && $_SESSION['user']->access == 'normal') {
    switch ($_REQUEST['route']) {
        case "home":
            return $homeController->index();

        case "profile":
            return $homeController->profile();

        case "logout":
            return $homeController->logout();
    }
}

//visitante
if (!isset($_SESSION['user'])) {
    switch ($_REQUEST['route']) {
        case "login":
            return $homeController->login();

        case "registry":
            return $homeController->registry();
    }
}

$errorController->notFound();
