<?php
namespace src\Controllers;

use src\Services\Render;

class HomeController {

    use Render;

    public function index() {
        $succes = isset($_GET['succes']) ? $_GET['succes'] : null;
        $error  = isset($_GET['error']) ? $_GET['error'] : null;
        $this->render('home', ['error' => $error, 'succes' => $succes]);
    }

    public function dashboard() {
        $this->render('dashboard');
    }

    public function login() {
        $this->render('login');
    }
    
    public function notFound() {
        $this->render('404');
    }

    public function receipt() {
        $this->render('receipt');
    }
}