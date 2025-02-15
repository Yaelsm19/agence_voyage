document.addEventListener("DOMContentLoaded", function () {
    const boutonFiltrer = document.querySelector("input[type='button']"); // Bouton "Filtrer"
    const fenetreFiltre = document.getElementById("fenetreFiltre"); // Fenêtre modale
    const boutonFermer = document.getElementById("fermerFiltre"); // Bouton de fermeture

    // Ouvrir la fenêtre
    boutonFiltrer.addEventListener("click", function () {
        fenetreFiltre.style.display = "block";
    });

    // Fermer la fenêtre
    boutonFermer.addEventListener("click", function () {
        fenetreFiltre.style.display = "none";
    });

    // Fermer la fenêtre si on clique en dehors
    window.addEventListener("click", function (event) {
        if (event.target === fenetreFiltre) {
            fenetreFiltre.style.display = "none";
        }
    });
});
