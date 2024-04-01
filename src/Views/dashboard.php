<?php
include __DIR__ . '/includes/header.php';
?>
<div id="dashboard-container">
    <?php
    include __DIR__ . '/includes/colonne.php';

    if (isset($_GET['section'])) {
        switch ($_GET['section']) {
            case 'compte':
                include __DIR__ . '/includes/account-section.php';
                break;
            case 'reservations':
                include __DIR__ . '/includes/reservations-section.php';
                break;
            default:
                break;
        }
    } else {
        echo "<p id= dashboard_message>" . 'Bienvenue sur le tableau de bord.' . "</p>";
    }
    ?>
</div>