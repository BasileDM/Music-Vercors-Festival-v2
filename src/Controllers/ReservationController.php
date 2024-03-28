<?php
namespace src\Controllers;

use DateTime;
use DateTimeZone;
use src\Models\User;
use src\Repositories\UserRepository;

final class ReservationController {

  public function registerUser() {
    $newUser = new User();
    $newUser->setNom($_POST['nom']);
    $newUser->setPrenom($_POST['prenom']);
    $newUser->setTelephone($_POST['telephone']);
    $newUser->setAdresse($_POST['adressePostale']);
    $newUser->setRole('user');
    $newUser->setEmail($_POST['email']);

    $date = new DateTime();
    $date = $date->setTimezone(new DateTimeZone('Europe/Paris'));
    $newUser->setRGPD($date);
    var_dump($newUser);

    $userRepo = new UserRepository();
    var_dump($userRepo->create($newUser));

    return;
  }
}
