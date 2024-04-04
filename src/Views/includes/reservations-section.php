<div id="reservations-section">
    <table>
        <tr>
            <th>Voir</th>
            <th>Nom</th>
            <th>Prenom</th>
            <th>Date</th>
            <th>Pass</th>
        </tr>
        <?php

        use src\Repositories\ReservationRepository;

        $resaRepo = new ReservationRepository();
        if ($_SESSION['role'] === 'admin') {
            foreach ($resaRepo->getAllBasic() as $reservation) {
                echo '
                    <tr>
                        <td> <a href="reservation?id=' . $reservation->ID . '">🔎</a> </td>
                        <td>' . $reservation->NOM . '</td>
                        <td>' . $reservation->PRENOM . '</td>
                        <td>' . $reservation->JOUR . '</td>
                        <td>' . $reservation->PASS_NAME . '</td>
                    </tr>
            ';
            }
        } else {
            foreach ($resaRepo->getAllBasicById($_SESSION['userId']) as $reservation) {
                echo '
                    <tr>
                        <td> <a href="reservation?id=' . $reservation->ID . '">🔎</a> </td>
                        <td>' . $reservation->NOM . '</td>
                        <td>' . $reservation->PRENOM . '</td>
                        <td>' . $reservation->JOUR . '</td>
                        <td>' . $reservation->PASS_NAME . '</td>
                    </tr>
            ';
            }
        }
        
        ?>
    </table>
</div>