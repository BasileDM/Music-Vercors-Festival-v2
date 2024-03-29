<?php

use src\Models\Database;

session_start();
// Vérification que la base de données est bien existante
require_once __DIR__ . "/autoload.php";
require_once __DIR__ . "/../config.php";
require_once __DIR__ . "/../errorConfig.php";
require_once __DIR__ . "/router.php";

if (DB_INITIALIZED == FALSE) {
  $db = new Database();
  if ($db->init() == TRUE) {
    header("Location: " . HOME_URL . "?success=101");
    die();
  } else {
    header("Location: " . HOME_URL . "?error=101");
    die();
  }
}