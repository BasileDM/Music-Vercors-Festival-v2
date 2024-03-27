<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
</head>

<body>
    <header>
        <img src="/../../../public/assets/img/vercorsLogo.png" id="logo" alt="Vercors_Music_Festival_Logo" onclick="location.href='./index.php'">

        <?php
        session_start();
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