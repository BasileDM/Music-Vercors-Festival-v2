<?php

namespace src\Repositories;

use src\Models\Database;
use src\Models\Reservation;
use PDO;

class ReservationRepository {
    private $db;
    public function __construct() {
        $newDatabase = new Database;
        $this->db = $newDatabase->getDb();

        require_once __DIR__ . '/../../config.php';
    }

    public function create($newReservation) {
        $sql = "INSERT INTO " . PREFIXE . "reservations (NOMBRE_RESERVATIONS, PRIX_TOTAL, ID_UTILISATEUR) VALUES (:NOMBRE_RESERVATIONS, :PRIX_TOTAL, :ID_UTILISATEUR)";
        $statement = $this->db->prepare($sql);
        $statement->execute([
            'NOMBRE_RESERVATIONS' => $newReservation->getNombreReservation(),
            'PRIX_TOTAL' => $newReservation->getPrixTotal(),
            'ID_UTILISATEUR' => $newReservation->getIdUtilisateur()
        ]);
        $lastReservationId = $this->db->lastInsertId();

        // Extras
        $sqlExtras = "INSERT INTO " . PREFIXE . "relation_reservation_extras (ID_RESERVATION, ID_EXTRAS, QUANTITY)
        VALUES (:ID_RESERVATION, :ID_EXTRAS, :QUANTITY1), (:ID_RESERVATION, :ID_EXTRAS2, :QUANTITY2)";
        $extraRepo = new ExtrasRepository;
        $casquesId = $extraRepo->getIdByName('casques');
        $lugesId = $extraRepo->getIdByName('luges');

        $statement = $this->db->prepare($sqlExtras);
        $statement->execute([
            'ID_RESERVATION' => $lastReservationId,
            'ID_EXTRAS' => $casquesId,
            'ID_EXTRAS2' => $lugesId,
            'QUANTITY1' => $newReservation->getCasques(),
            'QUANTITY2' => $newReservation->getLuges()
        ]);

        // Nuitees
        if (isset($_POST['emplacementTente']) && $_POST['emplacementTente'][0] == 'choix3Nuits') {
            $sql = "INSERT INTO " . PREFIXE . "relation_reservation_nuitee (ID_NUITEE, ID_RESERVATION, JOUR) VALUES (:ID_NUITEE, :ID_RESERVATION, :JOUR)";
            $nuiteesId = 4;
            $statement = $this->db->prepare($sql);
            $statement->execute([
                'ID_RESERVATION' => $lastReservationId,
                'ID_NUITEE' => $nuiteesId,
                'JOUR' => '2024-07-01'
            ]);
        } else if (isset($_POST['emplacementTente'])) {
            foreach (explode(',', $newReservation->getEmplacementTente()) as $tente) {
                if ($tente == 'choixNuit1') {
                    $jour = '2024-07-01';
                    $nuiteesId = 1;
                } elseif ($tente == 'choixNuit2') {
                    $jour = '2024-07-02';
                    $nuiteesId = 2;
                } elseif ($tente == 'choixNuit3') {
                    $jour = '2024-07-03';
                    $nuiteesId = 3;
                }

                $sql = "INSERT INTO " . PREFIXE . "relation_reservation_nuitee (ID_NUITEE, ID_RESERVATION, JOUR) VALUES (:ID_NUITEE, :ID_RESERVATION, :JOUR)";
                $statement = $this->db->prepare($sql);
                $statement->execute([
                    'ID_RESERVATION' => $lastReservationId,
                    'ID_NUITEE' => $nuiteesId,
                    'JOUR' => $jour
                ]);
            }
        }

        // Vans
        if (isset($_POST['emplacementVan']) && $_POST['emplacementVan'][0] == 'choixVan3Nuits') {
            $sql = "INSERT INTO " . PREFIXE . "relation_reservation_nuitee (ID_NUITEE, ID_RESERVATION, JOUR) VALUES (:ID_NUITEE, :ID_RESERVATION, :JOUR)";
            $nuiteesId = 8;
            $statement = $this->db->prepare($sql);
            $statement->execute([
                'ID_RESERVATION' => $lastReservationId,
                'ID_NUITEE' => $nuiteesId,
                'JOUR' => '2024-07-01'
            ]);
        } else if (isset($_POST['emplacementVan'])) {
            foreach (explode(',', $newReservation->getEmplacementVan()) as $van) {
                if ($van == 'choixVanNuit1') {
                    $jour = '2024-07-01';
                    $nuiteesId = 5;
                } elseif ($van == 'choixVanNuit2') {
                    $jour = '2024-07-02';
                    $nuiteesId = 6;
                } elseif ($van == 'choixVanNuit3') {
                    $jour = '2024-07-03';
                    $nuiteesId = 7;
                }

                $sql = "INSERT INTO " . PREFIXE . "relation_reservation_nuitee (ID_NUITEE, ID_RESERVATION, JOUR) VALUES (:ID_NUITEE, :ID_RESERVATION, :JOUR)";
                $statement = $this->db->prepare($sql);
                $statement->execute([
                    'ID_RESERVATION' => $lastReservationId,
                    'ID_NUITEE' => $nuiteesId,
                    'JOUR' => $jour
                ]);
            }
        }

        // Pass
        $passId = 0;
        $passDate = '';
        switch ($_POST['passSelection']) {
            case 'pass1jour':
                $passId = 1;
                if ($_POST['pass1jour'] == 'choixJour1') {
                    $passDate = '2024-07-01';
                } elseif ($_POST['pass1jour'] == 'choixJour2') {
                    $passDate = '2024-07-02';
                } elseif ($_POST['pass1jour'] == 'choixJour3') {
                    $passDate = '2024-07-03';
                }
                break;
            case 'pass2jours':
                $passId = 2;
                if ($_POST['pass2jours'] == 'choixJour12') {
                    $passDate = '2024-07-01';
                } elseif ($_POST['pass2jours'] == 'choixJour23') {
                    $passDate = '2024-07-02';
                }
                break;
            case 'pass3jours':
                $passId = 3;
                $passDate = '2024-07-01';
                break;
            case 'pass1jourreduit':
                $passId = 4;
                if ($_POST['pass1jour'] == 'choixJour1') {
                    $passDate = '2024-07-01';
                } elseif ($_POST['pass1jour'] == 'choixJour2') {
                    $passDate = '2024-07-02';
                } elseif ($_POST['pass1jour'] == 'choixJour3') {
                    $passDate = '2024-07-03';
                }
                break;
            case 'pass2joursreduit':
                $passId = 5;
                if ($_POST['pass2jours'] == 'choixJour12') {
                    $passDate = '2024-07-01';
                } elseif ($_POST['pass2jours'] == 'choixJour23') {
                    $passDate = '2024-07-02';
                }
                break;
            case 'pass3joursreduit':
                $passId = 6;
                if ($_POST['pass3jours'] == 'choixJour123') {
                    $passDate = '2024-07-01';
                }
                break;
        }
        $sql = "INSERT INTO " . PREFIXE . "relation_reservation_pass (ID_PASS, ID_RESERVATION, JOUR) VALUES (:ID_PASS, :ID_RESERVATION, :JOUR)";
        $statement = $this->db->prepare($sql);
        $statement->execute([
            'ID_RESERVATION' => $lastReservationId,
            'ID_PASS' => $passId,
            'JOUR' => $passDate
        ]);

        return $lastReservationId;
    }

    public function getAll() {
        $sql = "SELECT * FROM " . PREFIXE . "reservations;";
        return  $this->db->query($sql)->fetchAll(PDO::FETCH_OBJ);
    }

    public function getAllBasic() {
        $sql = "SELECT vercors_reservations.ID, vercors_utilisateurs.NOM, vercors_utilisateurs.PRENOM, vercors_pass.NOM AS PASS_NAME, vercors_relation_reservation_pass.JOUR FROM `vercors_reservations`
        JOIN vercors_utilisateurs ON vercors_reservations.ID_UTILISATEUR = vercors_utilisateurs.ID
        JOIN vercors_relation_reservation_pass ON vercors_relation_reservation_pass.ID_RESERVATION = vercors_reservations.ID
        JOIN vercors_pass ON vercors_relation_reservation_pass.ID_PASS = vercors_pass.ID
        ";

        return  $this->db->query($sql)->fetchAll(PDO::FETCH_OBJ);
    }

    public function getAllBasicById($userId) {
        $sql = "SELECT vercors_reservations.ID, vercors_utilisateurs.NOM, vercors_utilisateurs.PRENOM, vercors_pass.NOM AS PASS_NAME, vercors_relation_reservation_pass.JOUR FROM `vercors_reservations`
        JOIN vercors_utilisateurs ON vercors_reservations.ID_UTILISATEUR = vercors_utilisateurs.ID
        JOIN vercors_relation_reservation_pass ON vercors_relation_reservation_pass.ID_RESERVATION = vercors_reservations.ID
        JOIN vercors_pass ON vercors_relation_reservation_pass.ID_PASS = vercors_pass.ID
        WHERE vercors_utilisateurs.ID = :userId";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getById($id) {
        $sql = "SELECT * FROM " . PREFIXE . "reservations WHERE ID = :id;";
        $statement = $this->db->prepare($sql);
        $statement->execute(['id' => $id]);
        return $statement->fetch(PDO::FETCH_OBJ);
    }

    public function getAllInfoByResaId($id) {
        $sql = "SELECT 
        ID, 
        NOM, 
        PRENOM, 
        MAIL, 
        ADRESSE, 
        TELEPHONE, 
        PRIX_TOTAL, 
        PASS_NAME, 
        JOUR, 
        SUM(CASE WHEN NOM_EXTRA = 'casques' THEN QUANTITY_EXTRAS ELSE 0 END) AS CASQUES_QUANTITY,
        SUM(CASE WHEN NOM_EXTRA = 'luges' THEN QUANTITY_EXTRAS ELSE 0 END) AS LUGES_QUANTITY
    FROM 
        (SELECT 
            vercors_reservations.ID, 
            vercors_utilisateurs.NOM, 
            vercors_utilisateurs.PRENOM, 
            vercors_utilisateurs.MAIL, 
            vercors_utilisateurs.ADRESSE, 
            vercors_utilisateurs.TELEPHONE, 
            vercors_reservations.PRIX_TOTAL, 
            vercors_pass.NOM AS PASS_NAME, 
            vercors_relation_reservation_pass.JOUR, 
            vercors_relation_reservation_extras.QUANTITY AS QUANTITY_EXTRAS, 
            vercors_extras.NOM AS NOM_EXTRA
        FROM vercors_reservations
        JOIN vercors_utilisateurs ON vercors_reservations.ID_UTILISATEUR = vercors_utilisateurs.ID
        JOIN vercors_relation_reservation_pass ON vercors_relation_reservation_pass.ID_RESERVATION = vercors_reservations.ID
        JOIN vercors_pass ON vercors_relation_reservation_pass.ID_PASS = vercors_pass.ID
        JOIN vercors_relation_reservation_extras ON vercors_relation_reservation_extras.ID_RESERVATION = vercors_reservations.ID
        JOIN vercors_extras ON vercors_relation_reservation_extras.ID_EXTRAS = vercors_extras.ID
        JOIN vercors_relation_reservation_nuitee ON vercors_relation_reservation_nuitee.ID_RESERVATION = vercors_reservations.ID
        JOIN vercors_nuitees on vercors_nuitees.ID = vercors_relation_reservation_nuitee.ID_NUITEE
        WHERE vercors_reservations.ID = :id) AS src
    GROUP BY 
        ID, 
        NOM, 
        PRENOM, 
        MAIL, 
        ADRESSE, 
        TELEPHONE, 
        PRIX_TOTAL, 
        PASS_NAME, 
        JOUR;
    ";

        $statement = $this->db->prepare($sql);
        $statement->execute(['id' => $id]);
        return $statement->fetch(PDO::FETCH_OBJ);
    }

    public function deleteById($id) {
        $sql = "
        DELETE FROM " . PREFIXE . "relation_reservation_pass WHERE ID_RESERVATION = :id;
        DELETE FROM " . PREFIXE . "relation_reservation_extras WHERE ID_RESERVATION = :id;
        DELETE FROM " . PREFIXE . "relation_reservation_nuitee WHERE ID_RESERVATION = :id;
        DELETE FROM " . PREFIXE . "reservations WHERE ID = :id;
        ";
        $statement = $this->db->prepare($sql);
        $statement->execute(['id' => $id]);
        return 'success';
    }
}
