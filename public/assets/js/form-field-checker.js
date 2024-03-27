let errorMessage;
//#region General functions
// Display error, stylize the field and return false
function displayError(field, errorMessage, borderBool = true) {
    borderBool ? (field.style.border = "2px solid red") : null;

    if (!document.querySelector(".error-message-" + field.id)) {
        const error = document.createElement("p");
        error.classList.add("error-message-" + field.id);
        error.textContent = errorMessage;
        error.style.color = "red";
        field.parentNode.insertBefore(error, field.nextSibling);
    } else {
        document.querySelector(".error-message-" + field.id).textContent = errorMessage;
    }
    return false;
}

// Validate field, stylize the field and return true
function validateField(field, borderBool = true) {
    borderBool ? (field.style.border = "2px solid green") : null;
    if (document.querySelector(".error-message-" + field.id))
        document.querySelector(".error-message-" + field.id).remove();
    return true;
}

// Basic number check
function isStringInvalid(number) {
    if (number == "e" || number == "" || number == null || number == undefined) {
        return true;
    } else {
        return false;
    }
}
//#endregion

//#region Fields section 1
// Complete reservation section check
const tarifReduitCheckbox = document.getElementById("tarifReduit");

const pass1jour = document.getElementById("pass1jour");
const choixJour1 = document.getElementById("choixJour1");
const choixJour2 = document.getElementById("choixJour2");
const choixJour3 = document.getElementById("choixJour3");

const pass2jours = document.getElementById("pass2jours");
const choixJour12 = document.getElementById("choixJour12");
const choixJour23 = document.getElementById("choixJour23");

const pass3jours = document.getElementById("pass3jours");

const pass1jourreduit = document.getElementById("pass1jourreduit");
const pass2joursreduit = document.getElementById("pass2joursreduit");
const pass3joursreduit = document.getElementById("pass3joursreduit");
const boutonReservation = document.getElementById("boutonReservation");

// Hide next section button untill everything is validated
function checkIfSection1IsValid() {
    if (
        (!choixJour1.checked &&
            !choixJour2.checked &&
            !choixJour3.checked &&
            !choixJour12.checked &&
            !choixJour23.checked &&
            !pass3jours.checked &&
            !pass3joursreduit.checked) ||
        !isReservationFieldValid
    ) {
        boutonReservation.style.display = "none";
        if (!document.querySelector(".error-message-reservation")) {
            let nextSectionPlaceholder = document.createElement("p");
            nextSectionPlaceholder.classList.add("error-message-reservation");
            nextSectionPlaceholder.id = "nextSectionPlaceholder";
            nextSectionPlaceholder.innerHTML = "<p style='color: red;'>Veuillez valider les champs requis.</p>";
            boutonReservation.parentNode.insertBefore(nextSectionPlaceholder, boutonReservation.nextSibling);
        }
    } else if (isReservationFieldValid) {
        boutonReservation.style.display = "flex";
        document.getElementById("nextSectionPlaceholder")
            ? document.getElementById("nextSectionPlaceholder").remove()
            : null;
    }
}

function uncheckEveryDay() {
    choixJour1.checked = false;
    choixJour2.checked = false;
    choixJour3.checked = false;
    choixJour12.checked = false;
    choixJour23.checked = false;
}
// Nombre de réservations
const reservationField = document.getElementById("NombrePlaces");
reservationField.value = 1;
let isReservationFieldValid = true;
const minPlaces = 1;
const maxPlaces = 99;
reservationField.setAttribute("min", minPlaces);
reservationField.setAttribute("max", maxPlaces);

reservationField.onchange = () => {
    reservationField.value = Math.round(reservationField.value);
    if (
        isStringInvalid(reservationField.value) ||
        parseInt(reservationField.value) < minPlaces ||
        parseInt(reservationField.value) > maxPlaces
    ) {
        errorMessage = "Le nombre de places doit être compris entre " + minPlaces + " et " + maxPlaces + ".";
        isReservationFieldValid = displayError(reservationField, errorMessage);
        checkIfSection1IsValid();
    } else {
        isReservationFieldValid = validateField(reservationField);
        checkIfSection1IsValid();
    }
};

tarifReduitCheckbox.onchange = () => {
    pass1jour.checked = false;
    pass2jours.checked = false;
    pass3jours.checked = false;
    pass1jourreduit.checked = false;
    pass2joursreduit.checked = false;
    pass3joursreduit.checked = false;
    uncheckEveryDay();
    checkIfSection1IsValid();
};
pass1jour.onchange = () => {
    uncheckEveryDay();
    checkIfSection1IsValid();
};
pass2jours.onchange = () => {
    uncheckEveryDay();
    checkIfSection1IsValid();
};
pass3jours.onchange = () => {
    uncheckEveryDay();
    checkIfSection1IsValid();
};
pass1jourreduit.onchange = () => {
    uncheckEveryDay();
    checkIfSection1IsValid();
};
pass2joursreduit.onchange = () => {
    uncheckEveryDay();
    checkIfSection1IsValid();
};
pass3joursreduit.onchange = () => {
    uncheckEveryDay();
    checkIfSection1IsValid();
};
choixJour1.onchange = () => {
    checkIfSection1IsValid();
};
choixJour2.onchange = () => {
    checkIfSection1IsValid();
};
choixJour3.onchange = () => {
    checkIfSection1IsValid();
};
choixJour12.onchange = () => {
    checkIfSection1IsValid();
};
choixJour23.onchange = () => {
    checkIfSection1IsValid();
};

checkIfSection1IsValid();
//#endregion

//#region Fields section 2
let isNoiseReductionFieldValid = false;
let isSummerSledFieldValid = false;
let isEnfantsCheckboxValid = false;
const boutonOptions = document.getElementById("boutonOptions");
const enfantsCheckboxOui = document.getElementById("enfantsOui");
const enfantsCheckboxNon = document.getElementById("enfantsNon");
const noiseReductionField = document.getElementById("nombreCasquesEnfants");
const summerSledField = document.getElementById("NombreLugesEte");
const tenteNuit1 = document.getElementById("tenteNuit1");
const tenteNuit2 = document.getElementById("tenteNuit2");
const tenteNuit3 = document.getElementById("tenteNuit3");
const tente3Nuits = document.getElementById("tente3Nuits");
const vanNuit1 = document.getElementById("vanNuit1");
const vanNuit2 = document.getElementById("vanNuit2");
const vanNuit3 = document.getElementById("vanNuit3");
const van3Nuits = document.getElementById("van3Nuits");

function checkIfSection2IsValid() {
    if (!isNoiseReductionFieldValid || !isSummerSledFieldValid || !isEnfantsCheckboxValid) {
        boutonOptions.style.display = "none";
        if (!document.querySelector(".error-message-options")) {
            let optionsSectionPlaceholder = document.createElement("p");
            optionsSectionPlaceholder.classList.add("error-message-options");
            optionsSectionPlaceholder.id = "nextSectionPlaceholder";
            optionsSectionPlaceholder.innerHTML = "<p style='color: red;'>Veuillez valider les champs requis.</p>";
            boutonOptions.parentNode.insertBefore(optionsSectionPlaceholder, boutonOptions.nextSibling);
        }
    } else {
        boutonOptions.style.display = "flex";
        document.getElementById("nextSectionPlaceholder")
            ? document.getElementById("nextSectionPlaceholder").remove()
            : null;
    }
}
let enfantsNonLabel = document.querySelector('label[for="enfantsNon"]');
if (!enfantsCheckboxOui.checked || !enfantsCheckboxNon.checked) {
    displayError(enfantsNonLabel, "Veuillez choisir une option pour les enfants.", false);
} else {
    validateField(enfantsNonLabel, false);
}
//Uncheck tentes if 3 days is selected
tente3Nuits.onchange = () => {
    tenteNuit1.checked = false;
    tenteNuit2.checked = false;
    tenteNuit3.checked = false;
}
tenteNuit1.onchange = () => {
    tente3Nuits.checked = false;
}
tenteNuit2.onchange = () => {
    tente3Nuits.checked = false;
}
tenteNuit3.onchange = () => {
    tente3Nuits.checked = false;
}

//Uncheck vans if 3 days is selected
van3Nuits.onchange = () => {
    vanNuit1.checked = false;
    vanNuit2.checked = false;
    vanNuit3.checked = false;
}
vanNuit1.onchange = () => {
    van3Nuits.checked = false;
}
vanNuit2.onchange = () => {
    van3Nuits.checked = false;
}
vanNuit3.onchange = () => {
    van3Nuits.checked = false;
}

// Enfants
enfantsCheckboxOui.onchange = () => {
    enfantsCheckboxOui.checked || enfantsCheckboxNon.checked
        ? (isEnfantsCheckboxValid = validateField(enfantsNonLabel, false))
        : (isEnfantsCheckboxValid = displayError(
              enfantsNonLabel,
              "Veuillez choisir une option pour les enfants.",
              false
          ));
    checkIfSection2IsValid();
};

enfantsCheckboxNon.onchange = () => {
    noiseReductionField.value = 0;
    isNoiseReductionFieldValid = validateField(noiseReductionField);
    enfantsCheckboxOui.checked || enfantsCheckboxNon.checked
        ? (isEnfantsCheckboxValid = validateField(enfantsNonLabel, false))
        : (isEnfantsCheckboxValid = displayError(
              enfantsNonLabel,
              "Veuillez choisir une option pour les enfants.",
              false
          ));
    checkIfSection2IsValid();
};

// Casques anti-bruit
noiseReductionField.value = '0';
isNoiseReductionFieldValid = true;
let headphonesStock = 42;
noiseReductionField.setAttribute("min", 0);
noiseReductionField.setAttribute("max", headphonesStock);

noiseReductionField.onchange = () => {
    noiseReductionField.value = Math.round(noiseReductionField.value);

    if (isStringInvalid(noiseReductionField.value) || parseInt(noiseReductionField.value) < 0) {
        errorMessage = "Le nombre de casques doit être positif.";
        isNoiseReductionFieldValid = displayError(noiseReductionField, errorMessage);
    } else if (noiseReductionField.value > headphonesStock) {
        errorMessage = "Il ne reste que " + headphonesStock + " casques en stock.";
        isNoiseReductionFieldValid = displayError(noiseReductionField, errorMessage);
    } else {
        isNoiseReductionFieldValid = validateField(noiseReductionField);
    }
    checkIfSection2IsValid();
};

// Descentes en luge d'été
summerSledField.value = 0;
isSummerSledFieldValid = true;
summerSledField.setAttribute("min", 0);
summerSledField.setAttribute("max", 99);

summerSledField.onchange = () => {
    summerSledField.value = Math.round(summerSledField.value);
    if (
        isStringInvalid(summerSledField.value) ||
        parseInt(summerSledField.value) < parseInt(summerSledField.min) ||
        parseInt(summerSledField.value) > parseInt(summerSledField.max)
    ) {
        errorMessage = "Le nombre de descentes doit être compris entre 0 et 99.";
        isSummerSledFieldValid = displayError(summerSledField, errorMessage);
    } else {
        isSummerSledFieldValid = validateField(summerSledField);
    }
    checkIfSection2IsValid();
};
//#endregion

//#region Field section 3
const lastNameField = document.getElementById("nom");
const firstNameField = document.getElementById("prenom");
const emailField = document.getElementById("email");
const phoneField = document.getElementById("telephone");
const addressField = document.getElementById("adressePostale");
const submitButton = document.getElementById("submitButton");
let islastNameValid = false;
let isFirstNameValid = false;
let isEmailValid = false;
let isPhoneValid = false;
let isAddressValid = false;

function checkIfSection3IsValid() {
    if (!islastNameValid || !isFirstNameValid || !isEmailValid || !isPhoneValid || !isAddressValid) {
        submitButton.style.display = "none";
        if (!document.querySelector(".error-message-submit")) {
            let submitSectionPlaceholder = document.createElement("p");
            submitSectionPlaceholder.classList.add("error-message-submit");
            submitSectionPlaceholder.id = "nextSectionPlaceholder";
            submitSectionPlaceholder.innerHTML = "<p style='color: red;'>Veuillez valider les champs requis.</p>";
            submitButton.parentNode.insertBefore(submitSectionPlaceholder, submitButton.nextSibling);
        }
    } else {
        submitButton.style.display = "flex";
        document.getElementById("nextSectionPlaceholder")
            ? document.getElementById("nextSectionPlaceholder").remove()
            : null;
    }
}
lastNameField.onchange = () => {
    lastNameField.value = lastNameField.value.replace(/6/g, "-").replace(/[^a-zA-Z\-ç\u00E0-\u00FF]/g, "");
    lastNameField.value = lastNameField.value.trim();
    lastNameField.value = lastNameField.value.charAt(0).toUpperCase() + lastNameField.value.slice(1).toLowerCase();
    lastNameField.value = lastNameField.value.replace(/\-(\w)/g, function (match, group1) {
        return "-" + group1.toUpperCase();
    });
    if (isStringInvalid(lastNameField.value) || lastNameField.value.length < 2 || lastNameField.value.length > 50) {
        errorMessage = "Veuillez renseigner un nom valide.";
        islastNameValid = displayError(lastNameField, errorMessage);
    } else {
        islastNameValid = validateField(lastNameField);
    }
    checkIfSection3IsValid();
};

firstNameField.onchange = () => {
    firstNameField.value = firstNameField.value.replace(/6/g, "-").replace(/[^a-zA-Z\-ç\u00E0-\u00FF]/g, "");
    firstNameField.value = firstNameField.value.trim();
    firstNameField.value = firstNameField.value.charAt(0).toUpperCase() + firstNameField.value.slice(1).toLowerCase();
    firstNameField.value = firstNameField.value.replace(/\-(\w)/g, function (match, group1) {
        return "-" + group1.toUpperCase();
    });
    if (isStringInvalid(firstNameField.value) || firstNameField.value.length < 2 || firstNameField.value.length > 50) {
        errorMessage = "Veuillez renseigner un prenom valide.";
        isFirstNameValid = displayError(firstNameField, errorMessage);
    } else {
        isFirstNameValid = validateField(firstNameField);
    }
    checkIfSection3IsValid();
};

emailField.onchange = () => {
    emailField.value = emailField.value.replace(/[^a-zA-Z0-9\.\-\_@]/g, "");
    emailField.value = emailField.value.trim();
    emailField.value = emailField.value.toLowerCase();
    // verify if email actually has a email format
    const regex = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (!regex.test(String(emailField.value)) 
    || emailField.value.length < 3 
    || emailField.value.length > 50 
    || isStringInvalid(emailField.value)) {
        errorMessage = "Veuillez renseigner une adresse email valide.";
        isEmailValid = displayError(emailField, errorMessage);
    } else {
        isEmailValid = validateField(emailField);
    }
    checkIfSection3IsValid();
}

phoneField.onchange = () => {
    phoneField.value = phoneField.value.replace(/[^0-9+]/g, "");
    phoneField.value = phoneField.value.trim();
    if (phoneField.value.length <= 12 && phoneField.value.length >= 10 && !isStringInvalid(phoneField.value)) {
        const regex = /^[+](\d{3})\)?(\d{3})(\d{5,6})$|^(\d{10,10})$/; 
        if (regex.test(phoneField.value)) {
            isPhoneValid = validateField(phoneField);
        } else {
            errorMessage = "Veuillez renseigner un numéro de téléphone valide.";
            isPhoneValid = displayError(phoneField, errorMessage);
        }
    } else {
        errorMessage = "Veuillez renseigner un numéro de téléphone valide.";
        isPhoneValid = displayError(phoneField, errorMessage);
    }
    checkIfSection3IsValid();
}

addressField.onchange = () => {
    addressField.value = addressField.value.replace(/[^[a-zA-Z0-9\s\,\''\-]*$]/g, "");
    addressField.value = addressField.value.trim();
    addressField.value = addressField.value.charAt(0).toUpperCase() + addressField.value.slice(1).toLowerCase();
    addressField.value = addressField.value.replace(/\-(\w)/g, function (match, group1) {
        return "-" + group1.toUpperCase();
    })
    if (isStringInvalid(addressField.value) || addressField.value.length < 2 || addressField.value.length > 50) {
        errorMessage = "Veuillez renseigner une adresse valide.";
        isAddressValid = displayError(addressField, errorMessage);
    } else {
        isAddressValid = validateField(addressField);
    }
    checkIfSection3IsValid();
}

checkIfSection3IsValid();
//#endregion

function finalCheck(event) {
    if (
        isReservationFieldValid
        && isSummerSledFieldValid
        && isEnfantsCheckboxValid
        && isNoiseReductionFieldValid
        && islastNameValid
        && isFirstNameValid 
        && isEmailValid 
        && isPhoneValid
        && isAddressValid
        ) {
        return true;
    } else {
        return false;
    }
}