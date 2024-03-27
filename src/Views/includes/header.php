<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/dashboard.css">
    <script src="./assets/js/section-display.js" defer></script>
    <script src="./assets/js/form-field-checker.js" defer></script>
</head>

<body>
    <header>
        <img src="./assets/img/vercorsLogo.png" id="logo" alt="Vercors_Music_Festival_Logo" onclick="location.href='./index.php'">

        <?php
        if (isset($_SESSION['connected'])) {
        ?>
            <div id='dashboard' class="bouton">
                <a href="./dashboard.php">Tableau de bord</a>
            </div>
            <div id='deconnexion' class="bouton">
                <a href="./src/deconnexion.php">Deconnexion</a>
            </div>
        <?php } else { ?>
            <div id='connexion' class="bouton">
                <a href="./connexion.php">Connexion</a>
            </div>
        <?php } ?>
    </header>