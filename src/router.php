<?php

use src\Controllers\HomeController;

$route = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

$homeController = new HomeController();

switch ($route) {
    case HOME_URL:
        $homeController->index();
        break;
    default:
        $homeController->notFound();
        break;
}