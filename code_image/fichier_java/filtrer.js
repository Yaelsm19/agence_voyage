document.addEventListener("DOMContentLoaded", function () {
    const boutonFiltrer = document.getElementById("ouvrirFiltre");
    const fenetreFiltre = document.getElementById("fenetreFiltre");
    const boutonFermer = document.getElementById("fermerFiltre");
    const formulaireFiltres = document.getElementById("formulaireFiltres");
    const inputBudget = document.getElementById("budget");

    boutonFiltrer.addEventListener("click", () => {
        fenetreFiltre.style.display = "block";
    });

    boutonFermer.addEventListener("click", () => {
        fenetreFiltre.style.display = "none";
    });

    window.addEventListener("click", (event) => {
        if (event.target === fenetreFiltre) {
            fenetreFiltre.style.display = "none";
        }
    });

    formulaireFiltres.addEventListener("submit", function (event) {
        event.preventDefault();

        const voyages = document.querySelectorAll(".voyage");
        const budgetMax = parseFloat(inputBudget.value);
        const danger = document.getElementById("niveau_danger").value;
        const confort = document.getElementById("niveau_confort").value;
        const type = document.getElementById("typeVoyage").value;
        const epoque = document.getElementById("periode").value;

        voyages.forEach(voyage => {
            const prix = parseFloat(voyage.dataset.prix);
            const voyageDanger = voyage.dataset.danger;
            const voyageConfort = voyage.dataset.confort;
            const voyageType = voyage.dataset.type;
            const voyageEpoque = voyage.dataset.epoque

            let visible = true;

            if (!isNaN(budgetMax) && prix > budgetMax) {
                visible = false;
            }

            if (danger !== "0" && voyageDanger !== danger) {
                visible = false;
            }

            if (confort !== "0" && voyageConfort !== confort) {
                visible = false;
            }

            if (type !== "0" && voyageType !== type) {
                visible = false;
            }

            if (epoque !== "0" && voyageEpoque !== epoque) {
                visible = false;
            }

            voyage.style.display = visible ? "block" : "none";
        });

        fenetreFiltre.style.display = "none";
    });
});
