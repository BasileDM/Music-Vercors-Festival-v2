<?php
include __DIR__ . '/includes/header.php';
?>

<div id="dashboard-container">
  <?php
  include __DIR__ . '/includes/colonne.php';
  use src\Repositories\ReservationRepository;
  $resaRepo = new ReservationRepository();
  $reservation = $resaRepo->getById($_GET['id']);
  if ($_SESSION['role'] === 'admin' || $_SESSION['userId'] === $reservation->ID_UTILISATEUR) {
    var_dump($reservation);
  } else {
    header('Location: ' . HOME_URL . '404');
  }
  ?>

</div>

<?php
include __DIR__ . '/includes/footer.php';
?>