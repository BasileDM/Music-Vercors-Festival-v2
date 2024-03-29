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
        // Extras
        $sqlExtras = "INSERT INTO " . PREFIXE . "relation_reservation_extras (ID_RESERVATION, ID_EXTRAS) VALUES (:ID_RESERVATION, :ID_EXTRAS)";
        $extraRepo = new ExtrasRepository;
        $casquesId = $extraRepo->getIdByName('casques');
        $lugesId = $extraRepo->getIdByName('luges');

        $statement = $this->db->prepare($sqlExtras);
        $statement->execute([
            'ID_RESERVATION' => $this->db->lastInsertId(),
            'ID_EXTRAS' => $casquesId
        ]);
        $statement = $this->db->prepare($sqlExtras);
        $statement->execute([
            'ID_RESERVATION' => $this->db->lastInsertId(),
            'ID_EXTRAS' => $lugesId
        ]);
        // 
    }

    public function getAll() {
        $sql = "SELECT * FROM " . PREFIXE . "reservations;";
        return  $this->db->query($sql)->fetchAll(PDO::FETCH_CLASS, Reservation::class);
    }
}
