<?php
namespace src\Models;

class User {
    private $id;
    private $nom;
    private $prenom;
    private $telephone;
    private $adresse;
    private $password;
    private $role;
    private $RGPD;
    private $email;

public function __construct($id, $nom, $prenom, $telephone, $adresse, $password, $role, $RGPD, $email){
    $this->id = $id;
    $this->nom = $nom;
    $this->prenom = $prenom;
    $this->telephone = $telephone;
    $this->adresse = $adresse;
    $this->password = $password;
    $this->role = $role;
    $this->RGPD = $RGPD;
    $this->email = $email;
}

public function getId(){
    return $this->id;
}

public function getNom(){
    return $this->nom;
}
public function setNom($nom){
    return $this->nom = $nom;
}

public function getPenom(){
    return $this->prenom;
}
public function setPrenom($prenom){
    return $this->prenom = $prenom;
}

public function getTelephone(){
    return $this->telephone;
}
public function setTelephone($telephone){
    return $this->telephone = $telephone;
}

public function getAdresse(){
    return $this->adresse;
}
public function setAdresse($adresse){
    return $this->adresse = $adresse;
}

public function getPassword(){
    return $this->password;
}
public function setPassword($password){
    return $this->password = $password;
}
public function getRole($role){
    return $this->role;
}
public function setRole($role){
    return $this->role = $role;
}
public function getRGPD(){
    return $this->RGPD;
}
public function setRGPD($RGPD){
    return $this->RGPD = $RGPD;
}
public function getEmail(){
    return $this->email;
}
public function setEmail($email){
    return $this->email = $email;
}
}