<?php

namespace src\Models;

use src\Services\Hydration;

class Reservation {
    private int $id;
    private int $nombreReservation;
    private int $prixTotal;
    private int $idUtilisateur;


use Hydration;

public function getId(){
    return $this->id; 
}
public function getNombreReservation(){
    return $this->nombreReservation;
}
public function setNombreReservation($nombreReservation){
    $this->nombreReservation = $nombreReservation;
}
public function getPrixTotal(){
    return $this->prixTotal;
}
public function setPrixTotal($prixTotal){
    $this->prixTotal = $prixTotal;
}

public function getIdUtilisateur(){
    return $this->idUtilisateur;
}
public function setIdUtilisateur($idUtilisateur){
    $this->idUtilisateur = $idUtilisateur;
}
}