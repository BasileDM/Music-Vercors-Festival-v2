<?php isset($_GET['section']) ? $section = $_GET['section'] : $section = false ?>
<div id="colonne">
    <h2>Bonjour <?= $_SESSION['user'] ?> !</h2>
    <ul>
        <li onclick="location.href='?section=compte'" id="compte-item"
        <?= $section == 'compte' ? 'class="actif"' : 'class=""' ?> >Mon compte</li>
        <?php if ($_SESSION['user'] == 'admin') { ?>
            <li onclick="location.href='?section=reservations'" id="reservations-item"
            <?= $section == 'reservations' ? 'class="actif"' : '' ?> >Réservations</li>
        <?php } ?>
    </ul>
</div>
    