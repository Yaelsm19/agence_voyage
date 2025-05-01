document.addEventListener("DOMContentLoaded", function () {
    const basePrice = parseFloat(document.querySelector(".main-content .prix").innerText.replace(/\s|€/g, ""));
    const totalDisplay = document.createElement("h2");
    totalDisplay.id = "prixTotal";
    totalDisplay.textContent = `Total : ${basePrice.toLocaleString()} €`;
    document.querySelector(".info-box2").appendChild(totalDisplay);

    function calculerPrixTotal() {

        const nbAdultes = parseInt(document.getElementById("adulte").value) || 0;
        const nbEnfants = parseInt(document.getElementById("enfant").value) || 0;
        const totalParticipants = nbAdultes + nbEnfants;
        let total = basePrice*totalParticipants;

        document.querySelectorAll(".option").forEach(optionDiv => {
            const input = optionDiv.querySelector("input[type='number']");
            const prix = parseFloat(optionDiv.querySelector(".prix").innerText.replace(/\s|€/g, ""));
            const nb = parseInt(input.value) || 0;
            total += prix * nb;
        });

        const transport = document.querySelector("input[name='choix']:checked");
        if (transport) {
            const prixTransport = parseFloat(transport.parentElement.querySelector(".prix").innerText.replace(/\s|€/g, ""));
            total += prixTransport * totalParticipants;
        }

        const guide = document.querySelector("input[name='choix2']:checked");
        if (guide) {
            const prixGuide = parseFloat(guide.parentElement.querySelector(".prix").innerText.replace(/\s|€/g, ""));
            total += prixGuide * totalParticipants;
        }

        totalDisplay.textContent = `Total : ${total.toLocaleString()} €`;
    }

    document.querySelectorAll("input").forEach(input => {
        input.addEventListener("input", calculerPrixTotal);
        input.addEventListener("change", calculerPrixTotal);
    });

    calculerPrixTotal();
});
