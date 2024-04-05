<div id="reservations-section">
        <?php

        use src\Repositories\ReservationRepository;

        $resaRepo = new ReservationRepository();

        if ($_SESSION['role'] === 'admin') {
            foreach ($resaRepo->getAllBasic() as $reservation) {
                echo '
                    <div class="reservation-item">
            <div class="voir"><a title="Voir détails" href="reservation?id=' . $reservation->ID . '">🔎</a><a title="Supprimer la réservation" href="delete?id=' . $reservation->ID . '">❌</a></div>
            <div><strong>Nom:</strong> ' . $reservation->NOM . '</div>
            <div><strong>Prénom:</strong> ' . $reservation->PRENOM . '</div>
            <div><strong>Date:</strong> ' . $reservation->JOUR . '</div>
            <div><strong>Pass:</strong> ' . $reservation->PASS_NAME . '</div>
        </div>
            ';
            }
        } else {
            foreach ($resaRepo->getAllBasicById($_SESSION['userId']) as $reservation) {
                echo '
                    <div class="reservation-item">
            <div class="voir"><a href="reservation?id=' . $reservation->ID . '">🔎</a></div>
            <div><strong>Nom:</strong> ' . $reservation->NOM . '</div>
            <div><strong>Prénom:</strong> ' . $reservation->PRENOM . '</div>
            <div><strong>Date:</strong> ' . $reservation->JOUR . '</div>
            <div><strong>Pass:</strong> ' . $reservation->PASS_NAME . '</div>
        </div>
            ';
            }
        }
        
        ?>
</div>