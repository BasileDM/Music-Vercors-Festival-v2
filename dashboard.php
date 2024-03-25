<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/style.css">
    <link rel="stylesheet" href="./assets/dashboard.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@200&family=Montserrat:ital,wght@0,100..900;1,100..900&family=PT+Sans+Narrow:wght@400;700&display=swap" rel="stylesheet">
    <title>Formulaire de réservation Music Vercors Festival</title>
</head>

<body>
    <?php
    include './includes/header.php';
    ?>
    <div id="dashboard-container">
        <?php
        include './includes/colonne.php';

        if (isset($_GET['section'])) {
            switch ($_GET['section']) {
                case 'compte':
                    include './includes/account-section.php';
                    break;
                case 'reservations':
                    include './includes/reservations-section.php';
                    break;
                default:
                    break;
            }
        } else {
            echo "<p id= dashboard_message>" . 'Bienvenue sur le tableau de bord.' . "</p>";
        }
        ?>
    </div>
</body>

</html>