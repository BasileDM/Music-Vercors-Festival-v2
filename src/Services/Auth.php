<?php

namespace src\Services;

use src\Repositories\UserRepository;

final class Auth {

  public static function isAuth() {
    if (isset($_SESSION['connected']) && $_SESSION['connected'] === true) {
      return true;
    }
    return false;
  }

  public static function login($pass, $mail) {
    $userRepo = new UserRepository();
    $user = $userRepo->getByMail($mail);
    
    if ($user && password_verify($pass, $user->PASSWORD)) {
      $_SESSION['connected'] = true;
      $_SESSION['userId'] = $user->ID;
      $_SESSION['user'] = $user->NOM;
      $_SESSION['role'] = $user->ROLE;
      header('Location: ' . HOME_URL . 'dashboard');
    } else {
      header('Location: ' . HOME_URL . 'login?error=21');
    }
    die();
  }

  public static function logout() {
    $_SESSION['connected'] = false;
    session_destroy();
    header('Location: ' . HOME_URL);
  }
}
