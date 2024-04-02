<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vercors Music Festival</title>
    <link rel="stylesheet" href="./assets/css/style.css">
    <?php if (isset($_SESSION['connected']) && $_SESSION['connected'] === true) { ?>
        <link rel="stylesheet" href="./assets/css/dashboard.css">
        <link rel="stylesheet" href="./assets/css/colonne.css">
        <script src="./assets/js/burger.js" defer></script>
    <?php } ?>
    <script src="./assets/js/section-display.js" defer></script>
    <script src="./assets/js/form-field-checker.js" defer></script>
</head>

<body>
    <header>
        <img src="./assets/img/vercorsLogo.png" id="logo" alt="Vercors_Music_Festival_Logo" onclick="location.href='./'">
        <?php if (isset($_SESSION['connected']) && $_SESSION['connected'] === true) {?>
            <div id='dashboard' class="bouton">
                <a href="/dashboard">Tableau de bord</a>
            </div>
            <div id='deconnexion' class="bouton">
                <a href="./logout">Deconnexion</a>
            </div>
        <?php } else {?>
            <div id='connexion' class="bouton">
                <a href="/login">Connexion</a>
            </div>
        <?php }?>
    </header>