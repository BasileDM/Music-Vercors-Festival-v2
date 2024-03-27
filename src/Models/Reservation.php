<?php

namespace src\Models;

class Reservation {
    private $id;
    private $nombreReservation;
    private $prixTotal;


public function __construct($id, $nombreReservation, $prixTotal){
    $this->id = $id;
    $this->nombreReservation = $nombreReservation;
    $this->prixTotal = $prixTotal;
}

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
}