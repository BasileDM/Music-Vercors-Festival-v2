<div id="reservations-section">
    <?php

    use src\Repositories\ReservationRepository;

    $resaRepo = new ReservationRepository();
    foreach ($resaRepo->getAll() as $reservation) {
        echo
        '<div class="reservation-card">
                <h3> Nom : ' . $reservation->getNom() . '</h3>
                <div class="reservation-column">
                    <p> Prenom : </p>
                    <p> Mail : </p>
                    <p> Telephone : </p>
                    <p> Adresse : </p>
                    <p> Nombre de places : </p>
                    <p> Prix total : </p>
                    <p> Date : </p>
                    <p> Casques enfants : </p>
                    <p> Luges d\'ete : </p>
                    <p> Tente : </p>
                    <p> Van : </p>
                </div>
                <div class="reservation-column">
                    <p>' . $reservation->getPrenom() . '</p>
                    <p>' . $reservation->getMail() . '</p>
                    <p>' . $reservation->getTelephone() . '</p>
                    <p>' . $reservation->getAdresse() . '</p>
                    <p>' . $reservation->getNbPersonnes() . '</p>
                    <p>' . $reservation->getPrixTotal() . '€</p>
                    <p>' . $reservation->getDate() . '</p>
                    <p>' . $reservation->getNbCasquesEnfants() . '</p>
                    <p>' . $reservation->getNbLugesEte() . '</p>
                    <p>' . $reservation->getTente() . '</p>
                    <p>' . $reservation->getVan() . '</p>
                </div>
            </div>';
    }
    ?>
</div>