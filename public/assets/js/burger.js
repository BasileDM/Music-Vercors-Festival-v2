const dashboardColumn = document.getElementById("colonne");
const burgerButton = document.getElementById("burger");
burgerButton.addEventListener("click", afficherColonne);
// dashboardColumn.style.display = "none";

function afficherColonne() {
  if (dashboardColumn.classList.contains("flex")) {
    dashboardColumn.classList.remove("flex");
    dashboardColumn.classList.add("invis");
  } else {
    dashboardColumn.classList.add("flex");
    dashboardColumn.classList.remove("invis");
  }
}
