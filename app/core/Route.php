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
use App\Repositories\MunicipalityReposity;
use App\Repositories\NationalistyReposity;
use App\Repositories\ProvinceRepository;
use App\Repositories\UserRepository;
use App\Services\CommuneService;
use App\Services\CustomerService;
use App\Services\CustomerTypeService;
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


$errorController = new ErrorController();
$homeController = new HomeController($customerService);
$communeController = new CommuneController($communeService);
$provinceController = new ProvinceController($provinceService);
$municipalityController = new MunicipalityController($municipalityService);
$nationalityController = new NationalityController($nationalityService);
$customerTypeController = new CustomerTypeController($customerTypeService);


if (empty(@$_REQUEST['route']) || $_REQUEST['route'] == 'index.php') {
    return header('location: /outdoors/home');
}

switch ($_REQUEST['route']) {
    case "home":
        return $homeController->index();

    case "login":
        return $homeController->login();

    case "registry":
        return $homeController->registry();

    case "province/all":
        return $provinceController->all();

    case "municipality/all":
        return $municipalityController->all();

    case "commune/all":
        return $communeController->all();

    case "nationality/all":
        return  $nationalityController->all();

    case "customer-type/all":
        return  $customerTypeController->all();

    case "logout":
        return $homeController->logout();

    default:
        return $errorController->notFound();
}
