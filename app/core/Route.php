<?php

use App\Controller\CommuneController;
use App\Controller\CustomerTypeController;
use App\Controller\HomeController;
use App\Controller\ErrorController;
use App\Controller\MunicipalityController;
use App\Controller\NationalityController;
use App\Controller\ProvinceController;
use App\Model\User;

$container = new DI\Container();

$homeController = $container->get(HomeController::class);
$errorController = $container->get(ErrorController::class);
$communeController = $container->get(CommuneController::class);
$provinceController = $container->get(ProvinceController::class);
$municipalityController = $container->get(MunicipalityController::class);
$nationalityController = $container->get(NationalityController::class);
$customerTypeController =  $container->get(CustomerTypeController::class);

$route = @$_REQUEST['route'];
$user  = @$_SESSION['user'];

if (empty($route) || $route == 'index.php') {
    return header('location: /outdoors/home');
}

//public
switch ($route) {
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
if (isset($user) && $user->access == User::ACCESS_ADMIN) {
    switch ($route) {
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
if (isset($user) && $user->access == User::ACCESS_NORMAL) {
    switch ($route) {
        case "profile":
            return $homeController->profile();

        case "logout":
            return $homeController->logout();
    }
}

//visitante
if (!isset($user)) {
    switch ($route) {
        case "login":
            return $homeController->login();

        case "registry":
            return $homeController->registry();
    }
}

$errorController->notFound();
