<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./assets/style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@200&family=Montserrat:ital,wght@0,100..900;1,100..900&family=PT+Sans+Narrow:wght@400;700&display=swap" rel="stylesheet">
  <title>Formulaire de réservation Music Vercos Festival</title>
</head>

<body>
  <?php

  include './includes/header.php';
  if (isset($_SESSION['connected'])) {
    header('location:dashboard.php');
    exit;
  }

  ?>

    <form action="./src/authentication.php" method="post" id="loginForm">
      <h1>Connexion</h1>
      <label for="password">Mot de passe :</label>
      <input type="password" id="password" name="password" required>
      <input type="submit" name="soumission" class="bouton" value="Connexion" id="submitButton">
      <?php if(isset($_GET['error']) && $_GET['error'] == 21) { ?>
        <div class="message echec"><p>Mot de passe incorrect.</p></div>
      <?php } ?>
    </form>
</body>
</html>