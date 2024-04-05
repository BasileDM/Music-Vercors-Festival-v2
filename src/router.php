<?php

use src\Controllers\HomeController;
use src\Controllers\ReservationController;
use src\Services\Auth;

$route = $_SERVER['REDIRECT_URL'];
$method = $_SERVER['REQUEST_METHOD'];

$homeController = new HomeController();
$ReservationController = new ReservationController();

switch ($route) {

    case HOME_URL:
        if ($method === 'GET') {
            $homeController->index();
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
        if ($method === 'POST') {
            $pass = $_POST['password'];
            $email = $_POST['email'];
            Auth::login($pass, $email);
        } else {
            if (Auth::isAuth()) {
                header('Location: ' . HOME_URL . 'dashboard');
                die();
            } else {
                $homeController->login();
            }
        }
        break;

    case HOME_URL . 'logout':
        Auth::logout();
        die();
        break;

    case HOME_URL . 'receipt':
        $homeController->receipt();
        break;

    case HOME_URL . 'reservation':
        if (!Auth::isAuth()) {
            header('Location: ' . HOME_URL . 'login');
            die();
        } else {
            $ReservationController->seeDetails();
        }
        break;

        case HOME_URL . 'delete':
        if (!Auth::isAuth()) {
            header('Location: ' . HOME_URL . 'login');
            die();
        } elseif ($_SESSION['role'] == 'admin') {
            $ReservationController->deleteById($_GET['id']);
        }
        break;

    default:
        $homeController->notFound();
        break;
}
