<?php

namespace src\Repositories;

use PDO;
use src\Models\Database;

final class NuiteeRepository {
  private $db;

  public function __construct() {
    $newDatabase = new Database;
    $this->db = $newDatabase->getDb();

    require_once __DIR__ . '/../../config.php';
  }

  public function getIdByName($name) {
    $sql = "SELECT id FROM " . PREFIXE . "nuitees WHERE NOM = :name;";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetchColumn();
  }

  public function getByResaId($id) {

    $sql = "
      SELECT * FROM vercors_nuitees
      JOIN vercors_relation_reservation_nuitee ON vercors_relation_reservation_nuitee.ID_NUITEE = vercors_nuitees.ID
      WHERE vercors_relation_reservation_nuitee.ID_RESERVATION = :id;";

    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);

  }
}
