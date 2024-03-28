<?php

namespace src\Services;

final class Auth {

  public static function isAuth() {
    if (isset($_SESSION['connected']) && $_SESSION['connected'] === true) {
      return true;
    }
    return false;
  }

  public static function logout() {
    $_SESSION['connected'] = false;
    session_destroy();
    header('Location: ' . HOME_URL);
  }
}
