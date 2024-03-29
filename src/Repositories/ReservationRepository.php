<?php

namespace src\Repositories;

use src\Models\Database;
use PDO;
use Reservation;

class ReservationRepository {
    private $db;
    public function __construct() {
        $newDatabase = new Database;
        $this->db = $newDatabase->getDb();

        require_once __DIR__ . '/../../config.php';
    }

    public function create($newReservation) {
        $sql = "INSERT INTO " . PREFIXE . "reservations (NOMBRE_RESERVATIONS, PRIX_TOTAL, ID_UTILISATEUR) VALUES (:NOMBRE_RESERVATIONS, :PRIX_TOTAL, :ID_UTILISATEUR)";
        $statement = $this->db->prepare($sql);
        $statement->execute([
            'NOMBRE_RESERVATIONS' => $newReservation->getNombreReservation(),
            'PRIX_TOTAL' => $newReservation->getPrixTotal(),
            'ID_UTILISATEUR' => $newReservation->getIdUtilisateur()
        ]);
    }

    public function getAll() {
        $sql = "SELECT * FROM " . PREFIXE . "vercors_reservations;";
        return  $this->db->query($sql)->fetchAll(PDO::FETCH_CLASS, Reservation::class);
    }
}
