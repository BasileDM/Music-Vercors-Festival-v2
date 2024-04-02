// qaund on arrive sur le formulaire : affichage que de la section Réservation


const fieldsetReservation = document.getElementById("reservation");
const fieldsetOptions = document.getElementById("options");
const fieldsetCoordonnees = document.getElementById("coordonnees");
const sectionCasques = document.getElementById("casques");

const boutonPassUnJour = document.getElementById("pass1jour");
const labelPassUnJour = document.querySelector('label[for="pass1jour"]');
const boutonUnJourReduit = document.getElementById("pass1jourreduit");
const choixUnJour = document.getElementById("pass1jourDate");

const boutonPassDeuxJours = document.getElementById("pass2jours");
const labelPassDeuxJours = document.querySelector('label[for="pass2jours"]');
const boutonDeuxJoursReduit = document.getElementById("pass2joursreduit");
const choixDeuxJours = document.getElementById("pass2joursDate");

const boutonPassTroisJours = document.getElementById("pass3jours");
const labelPassTroisJours = document.querySelector('label[for="pass3jours"]');
const pass3JoursReduit = document.getElementById("pass3joursreduit");



fieldsetReservation.style.display = "block";
fieldsetOptions.style.display = "none";
fieldsetCoordonnees.style.display = "none";
sectionCasques.style.display = "none";



function resetDisplayedFields() { 
    choixUnJour.style.display = "none";
    choixDeuxJours.style.display = "none";
}

// afficher les choix du jour pour pass 1 jour

function afficherChoixUnJour() {
    if (boutonPassUnJour.checked || boutonUnJourReduit.checked) {
        choixUnJour.style.display = "block";
        choixDeuxJours.style.display = "none";
    } else {
        choixUnJour.style.display = "none";
    }
}

// afficher les choix des jours pour pass 2 jours

function afficherChoixDeuxJours() {
    if (boutonPassDeuxJours.checked || boutonDeuxJoursReduit.checked) {
        choixDeuxJours.style.display = "block";
        choixUnJour.style.display = "none";
    } else {
        choixDeuxJours.style.display = "none";
    }
}

function afficherChoixTroisJours() {
    if (boutonPassTroisJours.checked || pass3JoursReduit.checked) {
        choixUnJour.style.display = "none";
        choixDeuxJours.style.display = "none";
    }
}

// afficher les tarif réduits

function afficherTarifReduit() {
    let boutonTarifReduit = document.getElementById("tarifReduit");
    let sectiontarifReduit = document.getElementById("sectiontarifReduit");

    if (boutonTarifReduit.checked) {
        sectiontarifReduit.style.display = "block";
        boutonPassUnJour.style.display = "none";
        labelPassUnJour.style.display = "none";
        boutonPassDeuxJours.style.display = "none";
        labelPassDeuxJours.style.display = "none";
        boutonPassTroisJours.style.display = "none";
        labelPassTroisJours.style.display = "none";
        resetDisplayedFields();
    } else {
        sectiontarifReduit.style.display = "none";
        boutonPassUnJour.style.display = "inline";
        labelPassUnJour.style.display = "inline";
        boutonPassDeuxJours.style.display = "inline";
        labelPassDeuxJours.style.display = "inline";
        boutonPassTroisJours.style.display = "inline";
        labelPassTroisJours.style.display = "inline";
        resetDisplayedFields();
    }
}

// afficher casque pour enfant

const boutonEnfantsOui = document.getElementById("enfantsOui");
const boutonEnfantsNon = document.getElementById("enfantsNon");

boutonEnfantsNon.addEventListener("change", () => {
    if (boutonEnfantsNon.checked) {
        sectionCasques.style.display = "none";
        document.getElementById("nombreCasquesEnfants").value = 0;
    } else {
        sectionCasques.style.display = "block";
        document.getElementById("nombreCasquesEnfants").value = 0;
    }
})
boutonEnfantsOui.addEventListener("change", () => {
    if (boutonEnfantsOui.checked) {
        sectionCasques.style.display = "block";
        document.getElementById("nombreCasquesEnfants").value = 0;
    } else {
        sectionCasques.style.display = "none";
        document.getElementById("nombreCasquesEnfants").value = 0;
    }
});

// animation bouton suivant réservation, quand on clic sur suivant : affichage que de la section Options

function suivant(elementId) {
    let elementAAfficher = document.getElementById(elementId);

    switch (elementId) {
        case "options":
            fieldsetReservation.style.display = "none";
            break;
        case "coordonnees":
            fieldsetOptions.style.display = "none";
            break;
    }
    if (elementId == "coordonnees") {
        fieldsetCoordonnees.style.display = "flex";
    } else {
        elementAAfficher.style.display = "block";
    }
}
