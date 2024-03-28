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

    public function getAll() {
        $sql = "SELECT * FROM " . PREFIXE . "vercors_reservations;";
        $this->db->query($sql);
    
        return  $this->db->query($sql)->fetchAll(PDO::FETCH_CLASS, Reservation::class);
      }
}
