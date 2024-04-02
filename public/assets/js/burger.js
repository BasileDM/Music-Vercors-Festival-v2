const dashboardColumn = document.getElementById('colonne');
const burgerButton = document.getElementById('burger');
burgerButton.addEventListener('click', afficherColonne);
// dashboardColumn.style.display = 'flex';

function afficherColonne() {
    dashboardColumn.classList.add = 'colonne-invisible';
}