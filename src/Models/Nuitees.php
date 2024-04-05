<?php

namespace src\Models;

use src\Services\Hydration;

class Nuitees {
    private $id;
    private $prix;
    private $nom;

use Hydration;

public function getId() {
    return $this->id;
}

public function getPrix() {
    return $this->prix;
}
public function setPrix($prix) {
    $this->prix = $prix;
}

public function getNom(){
    return $this->nom;
}
public function setNom($nom){
    $this->nom = $nom;
}
}