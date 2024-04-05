<?php

namespace src\Controllers;

use DateTime;
use DateTimeZone;
use src\Models\Reservation;
use src\Models\User;
use src\Repositories\ReservationRepository;
use src\Repositories\UserRepository;
use src\Services\Render;

final class ReservationController {

  use Render;

  public function registerUser() {
    try {
      $newUser = new User();
      $newUser->setNom(htmlspecialchars($_POST['nom']));
      $newUser->setPrenom(htmlspecialchars($_POST['prenom']));
      $newUser->setTelephone(htmlspecialchars($_POST['telephone']));
      $newUser->setAdresse(htmlspecialchars($_POST['adressePostale']));
      $newUser->setRole('user');
      $newUser->setEmail(htmlspecialchars($_POST['email']));
      $newUser->setPassword($_POST['password']);


      $date = new DateTime();
      $date = $date->setTimezone(new DateTimeZone('Europe/Paris'));
      $newUser->setRGPD($date);

      $userRepo = new UserRepository();
      $existingUser = $userRepo->getByMail($newUser->getEmail());

      // WIP
      if ($existingUser) {
        var_dump($existingUser);
        $newUserId = $existingUser->ID;
        var_dump($newUserId);
      } else {
        $newUserId = $userRepo->create($newUser);
        $newUser->setId($newUserId);
      }
      return 'success';
    } catch (\Exception $e) {
      echo $e->getMessage();
      die();
    }
  }

  public function registerReseversation() {
    $newReservation = new Reservation();
    $newReservation->setNombreReservation($_POST['nombrePlaces']);
    $newReservation->setPrixTotal($this->calculateTotalPrice());
    $newReservation->setPassSelection($_POST['passSelection']);
    if (isset($_POST['emplacementTente'])) {
      $newReservation->setEmplacementTente(implode(',', $_POST['emplacementTente']));
    }
    if (isset($_POST['emplacementVan'])) {
      $newReservation->setEmplacementVan(implode(',', $_POST['emplacementVan']));
    }
    $newReservation->setCasques($_POST['nombreCasquesEnfants']);
    $newReservation->setLuges($_POST['NombreLugesEte']);

    if (!isset($_SESSION['connected']) || !$_SESSION['connected']) {

      if ($this->registerUser() == 'success') {
        $userRepo = new UserRepository();
        $user = $userRepo->getByMail($_POST['email']);
        $newReservation->setIdUtilisateur($user->ID);
      }
    } else if (isset($_SESSION['userId'])) {
      $newReservation->setIdUtilisateur($_SESSION['userId']);
    }
    $resaRepo = new ReservationRepository();
    $newReservationID = $resaRepo->create($newReservation);
    $this->sendMail($_POST['email']);
    header('Location: ' . HOME_URL . 'receipt?id=' . $newReservationID);
  }

  public function calculateTotalPrice() {
    $prixTotal = 0;
    // Checking pass selection cost
    if (isset($_POST['tarifReduit'])) {
      if ($_POST['passSelection'] === 'pass1jourreduit') {
        $prixTotal += 25;
      } elseif ($_POST['passSelection'] === 'pass2joursreduit') {
        $prixTotal += 50;
      } elseif ($_POST['passSelection'] === 'pass3joursreduit') {
        $prixTotal += 65;
      }
    } elseif ($_POST['passSelection'] === 'pass1jour') {
      $prixTotal += 40;
    } elseif ($_POST['passSelection'] === 'pass2jours') {
      $prixTotal += 70;
    } elseif ($_POST['passSelection'] === 'pass3jours') {
      $prixTotal += 100;
    }

    // Checking tent cost
    if (isset($_POST['emplacementTente'])) {
      switch ($_POST['emplacementTente']) {
        case 'choixNuit1':
          $prixTotal += 5;
          break;
        case 'choixNuit2':
          $prixTotal += 5;
          break;
        case 'choixNuit3':
          $prixTotal += 5;
          break;
        case 'choixNuits12':
          $prixTotal += 10;
          break;
        case 'choixNuits23':
          $prixTotal += 10;
          break;
        case 'choix3Nuits':
          $prixTotal += 12;
          break;
        default:
          break;
      }
    }
    // Checking van cost
    if (isset($_POST['emplacementVan'])) {
      switch ($_POST['emplacementVan']) {
        case 'choixVanNuit1':
          $prixTotal += 5;
          break;
        case 'choixVanNuit2':
          $prixTotal += 5;
          break;
        case 'choixVanNuit3':
          $prixTotal += 5;
          break;
        case 'choixVanNuits12':
          $prixTotal += 10;
          break;
        case 'choixVanNuits23':
          $prixTotal += 10;
          break;
        case 'choixVan3Nuits':
          $prixTotal += 12;
          break;
        default:
          break;
      }
    }

    // Multiplying passes, tents and vans by number of people
    $prixTotal *= $_POST['nombrePlaces'];

    // Checking price of headphones and sleds
    $prixTotal += $_POST['nombreCasquesEnfants'] * 2;
    $prixTotal += $_POST['NombreLugesEte'] * 5;

    return $prixTotal;
  }

  public function seeDetails() {
    $this->render('reservationDetails');
  }

  public function sendMail($mail) {
    $to      = $mail . ", tom.delorme.simplon@gmail.com";
    $subject = 'Confirmation de réservation';
    $message = 'Merci de votre réservation !';
    $headers = 'From: laura.carraro.simplon@gmail.com' . "\r\n" .
      'Reply-To: laura.carraro.simplon@gmail.com' . "\r\n" .
      'X-Mailer: PHP/' . phpversion();

    $test = mail($to, $subject, $message, $headers);

    if ($test) {
      echo "le mail a bien été envoyé.";
    } else {
      var_dump($test); 
      die();
    }
  }
}
