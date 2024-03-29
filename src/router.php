<?php

use src\Controllers\HomeController;
use src\Controllers\ReservationController;
use src\Services\Auth;

$route = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

$homeController = new HomeController();
$ReservationController = new ReservationController();

switch ($route) {

    case HOME_URL:
        if ($method === 'GET') {
                if (Auth::isAuth()) {
                header('Location: ' . HOME_URL . 'dashboard');
                die();
            } else {
                $homeController->index();
            }
        } else if ($method === 'POST') {
            $ReservationController->registerReseversation();
        }
        
        break;

    case HOME_URL . 'dashboard':
        if (!Auth::isAuth()) {
            header('Location: ' . HOME_URL);
            die();
        } else {
            $homeController->dashboard();
        }
        break;

    case HOME_URL . 'login':
        $homeController->login();
        break;

    case HOME_URL . 'logout':
        echo 'hello';
        Auth::logout();
        echo 'hello';
        die();
        break;

    case HOME_URL . 'receipt':
        $homeController->receipt();
        break;

    default:
        $homeController->notFound();
        break;
}
