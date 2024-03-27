<?php

namespace src\Repositories;

use src\Models\Database;

class ReservationRepository {
    private $db;
    public function __construct() {
        $newDatabase = new Database;
        $this->db = $newDatabase->getDb();

        require_once __DIR__ . '/../../config.php';
    }

    public function getAll(){
        
    }
}
