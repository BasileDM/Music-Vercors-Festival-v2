<?php
include __DIR__ . '/includes/header.php';
?>

<div id="dashboard-container">
  <?php
  include __DIR__ . '/includes/colonne.php';

use src\Repositories\NuiteeRepository;
use src\Repositories\ReservationRepository;

  $resaRepo = new ReservationRepository();
  $nuiteeRepo = new NuiteeRepository();
  $reservation = $resaRepo->getById($_GET['id']);
  if ($_SESSION['role'] === 'admin' || $_SESSION['userId'] === $reservation->ID_UTILISATEUR) {
    $resaDetails = $resaRepo->getAllInfoByResaId($reservation->ID);
    $resaNuitees = $nuiteeRepo->getByResaId($reservation->ID);
    echo '<div id="reservations-section" style="display: block ">';
    echo '<h2>Réservation ' . $reservation->ID . '</h2>';
    echo '<table>';
    foreach ($resaDetails as $key => $value) {
      $key = strtolower($key);
      $key = ucfirst($key);
      $key = str_replace('_', ' ', $key);
      echo '<tr><td>' . $key . '</td><td>' . $value . '</td><td></td></tr>';
    }
    foreach ($resaNuitees as $nuitees) {
      echo '<tr><td>Nuitées</td><td>' . $nuitees->NOM . '</td><td>'.$nuitees->JOUR.'</td></tr>';
    }
    echo '</div>';
    echo '</table>';
  } else {
    header('Location: ' . HOME_URL . 'dashboard');
    die();
  }
  ?>

</div>

<?php
include __DIR__ . '/includes/footer.php';
?>