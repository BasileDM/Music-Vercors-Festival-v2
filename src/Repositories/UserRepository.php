<?php

namespace src\Repositories;

use PDO;
use src\Models\Database;
use src\Models\User;

class UserRepository {
  private $db;
  public function __construct() {
    $newDatabase = new Database;
    $this->db = $newDatabase->getDb();

    require_once __DIR__ . '/../../config.php';
  }

  public function getAll() {
    $sql = "SELECT * FROM " . PREFIXE . "vercors_utilisateurs;";
    $this->db->query($sql);

    return  $this->db->query($sql)->fetchAll(PDO::FETCH_CLASS, User::class);
  }

  public function create($newUser) {
    $sql = "INSERT INTO " . PREFIXE . "utilisateurs (NOM, PRENOM, TELEPHONE, ADRESSE, PASSWORD, ROLE, RGPD, MAIL) 
    VALUES (:nom, :prenom, :telephone, :adresse, :password, :role, :rgpd, :mail)";
    $statement = $this->db->prepare($sql);
    $statement->execute([
      'nom' => $newUser->getNom(),
      'prenom' => $newUser->getPrenom(),
      'telephone' => $newUser->getTelephone(),
      'adresse' => $newUser->getAdresse(),
      'password' => password_hash('aaa', PASSWORD_DEFAULT),
      'role' => $newUser->getRole(),
      'rgpd' => $newUser->getRgpdToString(),
      'mail' => $newUser->getEmail()
    ]);
    return $this->db->lastInsertId();
  }

  public function getByMail($mail) {
    $sql = "SELECT * FROM " . PREFIXE . "utilisateurs WHERE MAIL = :mail";
    $statement = $this->db->prepare($sql);
    $statement->execute(['mail' => $mail]);
    $user = $statement->fetch(PDO::FETCH_OBJ);
    return $user;
  }
}
