<?php

session_start();

// Vérification que la base de données est bien existante
require_once __DIR__ . "/../config.php";

if (DB_INITIALIZED == FALSE) {
  $db = new src\Models\Database();
  echo $db->init();
}