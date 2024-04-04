const dashboardColumn = document.getElementById("colonne");
const burgerButton = document.getElementById("burger");
const reservationSection = document.getElementById("reservations-section");
burgerButton.addEventListener("click", afficherColonne);
// dashboardColumn.style.display = "none";

function afficherColonne() {
  if (dashboardColumn.classList.contains("flex")) {
    dashboardColumn.classList.remove("flex");
    dashboardColumn.classList.add("invis");
    reservationSection.classList.remove("invis");
  } else {
    dashboardColumn.classList.add("flex");
    dashboardColumn.classList.remove("invis");
    reservationSection.classList.add("invis");
  }
}
