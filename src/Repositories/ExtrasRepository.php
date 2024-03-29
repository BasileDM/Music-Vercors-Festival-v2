<?php
namespace src\Repositories;

use PDO;
use src\Models\Database;

class ExtrasRepository {
  private $db;

  public function __construct() {
    $newDatabase = new Database;
    $this->db = $newDatabase->getDb();

    require_once __DIR__ . '/../../config.php';
  }

  public function getAll() {
    $sql = "SELECT * FROM " . PREFIXE . "extras;";
    return $this->db->query($sql)->fetchAll(PDO::FETCH_OBJ);
  }

  public function getIdByName($name){
    $sql = "SELECT id FROM " . PREFIXE . "extras WHERE NOM = :name;";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetchColumn();
    
  }
}
