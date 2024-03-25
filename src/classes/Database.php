<?php
require_once ('Reservation.php'); 

class Database {
  private $_DBPath;

  public function __construct(){
    $this->_DBPath = __DIR__ . '/../csv/reservations.csv';
  }

  public function getDatabase() : string {
    return $this->_DBPath;
  }

  public function setDatabase(string $database) {
    $this->_DBPath = $database;
  }

  public function getAllReservations(): array {
    $connexion = fopen($this->_DBPath, 'r');
    $reservations = [];

    while (($reservation = fgetcsv($connexion, 1000, ","))) {
      if (empty($reservation[0])) continue;
      $reservations[] = new Reservation(
        $reservation[0], 
        $reservation[1], 
        $reservation[2], 
        $reservation[3],
        $reservation[4], 
        $reservation[5], 
        $reservation[6], 
        $reservation[7], 
        $reservation[8], 
        $reservation[9], 
        $reservation[10], 
        $reservation[11]);
    }
    fclose($connexion);
    return $reservations;
  }

  public function saveReservation(Reservation $reservation): bool {
    $connexion = fopen($this->_DBPath, 'ab');
    $retour = fputcsv($connexion, $reservation->getObjectToArray());
    fclose($connexion);
    return $retour;
  }
}
?>