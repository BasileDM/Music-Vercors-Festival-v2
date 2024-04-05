<?php

namespace src\Models;

use src\Services\Hydration;

class Reservation {
    private int $id;
    private int $nombreReservation;
    private int $prixTotal;
    private int $idUtilisateur;

    private string $passSelection;
    private string $emplacementTente;
    private string $emplacementVan;
    private string $casques;
    private string $luges;


    use Hydration;
    

    /**
     * Get the value of id
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @param   int  $id  
     * 
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * Get the value of nombreReservation
     */
    public function getNombreReservation(): int
    {
        return $this->nombreReservation;
    }

    /**
     * Set the value of nombreReservation
     *
     * @param   int  $nombreReservation  
     * 
     */
    public function setNombreReservation(int $nombreReservation)
    {
        $this->nombreReservation = $nombreReservation;
    }

    /**
     * Get the value of prixTotal
     */
    public function getPrixTotal(): int
    {
        return $this->prixTotal;
    }

    /**
     * Set the value of prixTotal
     *
     * @param   int  $prixTotal  
     * 
     */
    public function setPrixTotal(int $prixTotal)
    {
        $this->prixTotal = $prixTotal;
    }

    /**
     * Get the value of idUtilisateur
     */
    public function getIdUtilisateur(): int
    {
        return $this->idUtilisateur;
    }

    /**
     * Set the value of idUtilisateur
     *
     * @param   int  $idUtilisateur  
     * 
     */
    public function setIdUtilisateur(int $idUtilisateur)
    {
        $this->idUtilisateur = $idUtilisateur;
    }

    /**
     * Get the value of passSelection
     */
    public function getPassSelection(): string
    {
        return $this->passSelection;
    }

    /**
     * Set the value of passSelection
     *
     * @param   string  $passSelection  
     * 
     */
    public function setPassSelection(string $passSelection)
    {
        $this->passSelection = $passSelection;
    }

    /**
     * Get the value of emplacementTente
     */
    public function getEmplacementTente(): string
    {
        return $this->emplacementTente;
    }

    /**
     * Set the value of emplacementTente
     *
     * @param   string  $emplacementTente  
     * 
     */
    public function setEmplacementTente(string $emplacementTente)
    {
        $this->emplacementTente = $emplacementTente;
    }

    /**
     * Get the value of emplacementVan
     */
    public function getEmplacementVan(): string
    {
        return $this->emplacementVan;
    }

    /**
     * Set the value of emplacementVan
     *
     * @param   string  $emplacementVan  
     * 
     */
    public function setEmplacementVan(string $emplacementVan)
    {
        $this->emplacementVan = $emplacementVan;
    }

    /**
     * Get the value of casques
     */
    public function getCasques(): string
    {
        return $this->casques;
    }

    /**
     * Set the value of casques
     *
     * @param   string  $casques  
     * 
     */
    public function setCasques(string $casques)
    {
        $this->casques = $casques;
    }

    /**
     * Get the value of luges
     */
    public function getLuges(): string
    {
        return $this->luges;
    }

    /**
     * Set the value of luges
     *
     * @param   string  $luges  
     * 
     */
    public function setLuges(string $luges)
    {
        $this->luges = $luges;
    }
}
