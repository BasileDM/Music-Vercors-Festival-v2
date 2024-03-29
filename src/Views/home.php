<?php
  include __DIR__ . '/includes/header.php';
?>

<body>
  <?php if (isset($_GET['error']) && $_GET['error'] === 101) {?>
    <div class="messageError">Une erreur est survenue lors de l'initialisation de la base de données.</div>
  <?php } else if (isset($_GET['success']) && $_GET['success'] === 101) { ?>
    <div class="messageSuccess">La base de données a été correctement initialisée.</div>
  <?php } ?>
  <form onsubmit="return finalCheck(event)" action="#" id="inscription" method="POST">
    <fieldset id="reservation">
      <legend>Réservation</legend>
      <h3>Nombre de réservation(s) :</h3>
      <input type="number" name="nombrePlaces" id="NombrePlaces" value="1" required>
      <?php if (isset($errorCode) && $errorCode === 1) { ?>
        <div class="messageError">Le nombre de places n'est pas valide.</div>
      <?php } ?>
      <h3>Réservation(s) en tarif réduit</h3>
      <input type="checkbox" name="tarifReduit" id="tarifReduit" onclick="afficherTarifReduit()">
      <label for="tarifReduit">Ma réservation sera en tarif réduit</label>

      <h3>Choisissez votre formule :</h3>

      <!-- tarifs réduits : à n'afficher que si tarif réduit est sélectionné -->
      <section id="sectiontarifReduit">
        <input type="radio" name="passSelection" id="pass1jourreduit" value="pass1jourreduit" onclick="afficherChoixUnJour()">
        <label for="pass1jourreduit">Pass 1 jour : 25€</label>
        <input type="radio" name="passSelection" id="pass2joursreduit" value="pass2joursreduit" onclick="afficherChoixDeuxJours()">
        <label for="pass2joursreduit">Pass 2 jours : 50€</label>
        <input type="radio" name="passSelection" id="pass3joursreduit" value="pass3joursreduit" onclick="afficherChoixTroisJours()">
        <label for="pass3joursreduit">Pass 3 jours : 65€</label>
      </section>

      <input type="radio" name="passSelection" id="pass1jour" value="pass1jour" onclick="afficherChoixUnJour()">
      <label for="pass1jour">Pass 1 jour : 40€</label>

      <!-- Si case cochée, afficher le choix du jour -->
      <section id="pass1jourDate">
        <input type="radio" name="pass1jour" id="choixJour1" value="choixJour1">
        <label for="choixJour1">Pass pour la journée du 01/07</label>
        <input type="radio" name="pass1jour" id="choixJour2" value="choixJour2">
        <label for="choixJour2">Pass pour la journée du 02/07</label>
        <input type="radio" name="pass1jour" id="choixJour3" value="choixJour3">
        <label for="choixJour3">Pass pour la journée du 03/07</label>
      </section>

      <input type="radio" name="passSelection" id="pass2jours" value="pass2jours" onclick="afficherChoixDeuxJours()">
      <label for="pass2jours">Pass 2 jours : 70€</label>

      <!-- Si case cochée, afficher le choix des jours -->
      <section id="pass2joursDate">
        <input type="radio" name="pass2jours" id="choixJour12" value="choixJour12">
        <label for="choixJour12">Pass pour deux journées du 01/07 au 02/07</label>
        <input type="radio" name="pass2jours" id="choixJour23" value="choixJour23">
        <label for="choixJour23">Pass pour deux journées du 02/07 au 03/07</label>
      </section>

      <input type="radio" name="passSelection" id="pass3jours" value="pass3jours" onclick="afficherChoixTroisJours()">
      <label for="pass3jours">Pass 3 jours : 100€</label>


      <!-- FACULTATIF : ajouter un pass groupe (5 adultes : 150€ / jour) uniquement pass 1 jour -->

      <p id="boutonReservation" class="bouton" onclick="suivant('options'); checkIfSection2IsValid();">Suivant</p>
    </fieldset>
    <fieldset id="options">
      <legend>Options</legend>
      <h3>Réserver un emplacement de tente : </h3>
      <input type="checkbox" id="tenteNuit1" name="emplacementTente[]" value="choixNuit1" onchange="cocherTente3nuits()">
      <label for="tenteNuit1">Pour la nuit du 01/07 (5€)</label>
      <input type="checkbox" id="tenteNuit2" name="emplacementTente[]" value="choixNuit2" onchange="cocherTente3nuits()">
      <label for="tenteNuit2">Pour la nuit du 02/07 (5€)</label>
      <input type="checkbox" id="tenteNuit3" name="emplacementTente[]" value="choixNuit3" onchange="cocherTente3nuits()">
      <label for="tenteNuit3">Pour la nuit du 03/07 (5€)</label>
      <br>
      <input type="checkbox" id="tente3Nuits" name="emplacementTente[]" value="choix3Nuits" onchange="cocherTente3nuits()">
      <label for="tente3Nuits">Pour les 3 nuits (12€)</label>

      <h3>Réserver un emplacement de camion aménagé : </h3>
      <input type="checkbox" id="vanNuit1" name="emplacementVan[]" value="choixVanNuit1" onchange="cocherVan3nuits()">
      <label for="vanNuit1">Pour la nuit du 01/07 (5€)</label>
      <input type="checkbox" id="vanNuit2" name="emplacementVan[]" value="choixVanNuit2" onchange="cocherVan3nuits()">
      <label for="vanNuit2">Pour la nuit du 02/07 (5€)</label>
      <input type="checkbox" id="vanNuit3" name="emplacementVan[]" value="choixVanNuit3" onchange="cocherVan3nuits()">
      <label for="vanNuit3">Pour la nuit du 03/07 (5€)</label>
      <br>
      <input type="checkbox" id="van3Nuits" name="emplacementVan[]" value="choixVan3Nuits" onchange="cocherVan3nuits()">
      <label for="van3Nuits">Pour les 3 nuits (12€)</label>

      <h3>Venez-vous avec des enfants ?</h3>
      <input type="radio" id="enfantsOui" name="enfants"><label for="enfantsOui">Oui</label>
      <input type="radio" id="enfantsNon" name="enfants"><label for="enfantsNon">Non</label>

      <!-- Si oui, afficher : -->
      <section id="casques">
        <h4>Voulez-vous louer un casque antibruit pour enfants* (2€ / casque) ?</h4>
        <label for="nombreCasquesEnfants">Nombre de casques souhaités :</label>
        <input type="number" name="nombreCasquesEnfants" id="nombreCasquesEnfants" value='0'>
        <?php if (isset($errorCode) && $errorCode === 2) { ?>
          <div class="messageError">Ajouter le nombre de casques.</div>
        <?php } ?>
        <p>*Dans la limite des stocks disponibles.</p>
      </section>

      <h3>Profitez de descentes en luge d'été à tarifs avantageux ! (5€ / descente)</h3>
      <label for="NombreLugesEte">Nombre de descentes en luge d'été : </label>
      <input type="number" name="NombreLugesEte" id="NombreLugesEte" value='0'>

      <p id="boutonOptions" class="bouton" onclick="suivant('coordonnees')">Suivant</p>
    </fieldset>
    <fieldset id="coordonnees">
      <legend>Coordonnées</legend>
      <label for="nom">Nom :</label>
      <input type="text" name="nom" id="nom" required>
      <br>
      <label for="prenom">Prénom :</label>
      <input type="text" name="prenom" id="prenom" required>
      <br>
      <label for="email">Email :</label>
      <input type="email" name="email" id="email" required>
      <br>
      <?php if (isset($errorCode) && $errorCode === 4) { ?>
        <div class="message error">Saisir l'adresse mail.</div>
      <?php } ?>
      <label for="telephone">Téléphone :</label>
      <input type="text" name="telephone" id="telephone" required>
      <?php if (isset($errorCode) && $errorCode === 5) { ?>
        <div class="messageError">.</div>
      <?php } ?>
      <label for="adressePostale">Adresse Postale :</label>
      <input type="text" name="adressePostale" id="adressePostale" required>
      <?php if (isset($errorCode) && $errorCode === 6) { ?>
        <div class="messageError">Ajouter adresse postale.</div>
      <?php } ?>
      <label for="password">Mot de passe :</label>
    <input type="password" id="password" name="password" required>
    <label for="password">Vérifier votre mot de passe :</label>
    <input type="password" id="verifPassword" name="password" required>
    <label for="CGU">J'accepte les conditions générales d'utilisation</label>
    <input id="CGU" name="CGU" type="checkbox">
      <input type="submit" name="soumission" class="bouton" value="Réserver" id="submitButton">
    </fieldset>
  </form>

<?php
  include __DIR__ . '/includes/footer.php';
?>