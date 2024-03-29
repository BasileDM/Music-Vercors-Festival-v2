<?php

namespace src\Models;

use DateTime;
use src\Services\Hydration;

final class User {
    private int $id;
    private string $nom;
    private string $prenom;
    private string $telephone;
    private string $adresse;
    private string $password;
    private string $role;
    private DateTime $RGPD;
    private string $email;

    use Hydration;

    public function getId() {
        return $this->id;
    }
    
    public function setId($id) {
        return $this->id = $id;
    }

    public function getNom() {
        return $this->nom;
    }
    public function setNom($nom) {
        return $this->nom = $nom;
    }

    public function getPrenom() {
        return $this->prenom;
    }
    public function setPrenom($prenom) {
        return $this->prenom = $prenom;
    }

    public function getTelephone() {
        return $this->telephone;
    }
    public function setTelephone($telephone) {
        return $this->telephone = $telephone;
    }

    public function getAdresse() {
        return $this->adresse;
    }
    public function setAdresse($adresse) {
        return $this->adresse = $adresse;
    }

    public function getPassword() {
        return $this->password;
    }
    public function setPassword($password) {
        return $this->password = $password;
    }
    public function getRole() {
        return $this->role;
    }
    public function setRole($role) {
        return $this->role = $role;
    }
    public function getRGPD() {
        return $this->RGPD;
    }
    public function setRGPD($RGPD) {
        return $this->RGPD = $RGPD;
    }
    public function getEmail() {
        return $this->email;
    }
    public function setEmail($email) {
        return $this->email = $email;
    }

    public function getRgpdToString() {
        return $this->RGPD->format('Y-m-d');
    }
}
