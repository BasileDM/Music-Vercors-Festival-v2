<div>
<div id="burger" title="Menu">
    <div class="line"></div>
    <div class="line"></div>
    <div class="line"></div>
</div>
<br>
<?php isset($_GET['section']) ? $section = $_GET['section'] : $section = false ?>
<div id="colonne" class="invis">
    <h2>Bonjour <?= $_SESSION['user'] ?> !</h2>
    <ul>
        <li onclick="location.href='dashboard?section=compte'" id="compte-item" <?= $section == 'compte' ? 'class="actif"' : 'class=""' ?>>Mon compte</li>
        <?php if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'user') { ?>
            <li onclick="location.href='dashboard?section=reservations'" id="reservations-item" <?= $section == 'reservations' ? 'class="actif"' : '' ?>>Réservations</li>
        <?php } ?>
    </ul>
</div>
</div>

