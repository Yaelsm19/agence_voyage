function changementgrade(event) {
    const button  = event.currentTarget;
    const userId  = button.dataset.userId;
    const image   = button.querySelector("img");
    const backup  = image.src;
    const row     = button.closest("tr");
    
    const allButtons = row.querySelectorAll("button");
    allButtons.forEach(btn => btn.disabled = true);

    image.src = "../Image/image_icône/barre-de-chargement.png";

    fetch("../fichier_php/modifier_grade.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: "user_id=" + encodeURIComponent(userId),
    })
    .then(response => { 
        if (!response) throw new Error("Erreur serveur"); 
        return response.json(); 
    })
    .then(response => {
        if (!response.success) throw new Error(response.message);

        let src, alt;
        switch (response.grade) {
            case "admin":  src = "../Image/image_icône/niveau_admin.png";  alt = "Admin";  break;
            case "VIP":    src = "../Image/image_icône/niveau_VIP.png";    alt = "VIP";    break;
            case "membre": src = "../Image/image_icône/niveau_membre.png"; alt = "Membre"; break;
            case "bloqué": src = "../Image/image_icône/niveau_bloqué.png"; alt = "Bloqué"; break;
            default:       src = backup; alt = image.alt;
        }
        image.src = src;
        image.alt = alt;

        const gradeCell = document.querySelector(`td.grade-cell[data-user-id="${userId}"]`);
        if (gradeCell) {
            gradeCell.textContent = response.grade;
            gradeCell.className   = `grade-cell grade-${response.grade}`;
        }
    })
    .catch(err => {
        console.error(err);
        image.src = backup;
    })
    .finally(() => {
        allButtons.forEach(btn => btn.disabled = false);
    });
}


function Blocage(event) {
    const button = event.currentTarget;
    const userId = button.dataset.userId;
    const image = button.querySelector("img");
    const backup = image.src;
    const row = button.closest("tr");
    
    const allButtons = row.querySelectorAll("button");
    allButtons.forEach(btn => btn.disabled = true);

    image.src = "../Image/image_icône/barre-de-chargement.png";

    fetch("../fichier_php/bloquer_debloquer_utilisateur.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: "user_id=" + encodeURIComponent(userId)
    })
    .then(res => res.json())
    .then(data => {
        if (!data.success) throw new Error(data.message);

        image.src = "../Image/image_icône/" + (data.grade === "bloqué" ? "debloquer" : "bloquer") + ".png";
        image.alt = (data.grade === "bloqué" ? "debloquer" : "bloquer");

        const gradeCell = document.querySelector(`td.grade-cell[data-user-id="${userId}"]`);
        if (gradeCell) {
            gradeCell.textContent = data.grade;
            gradeCell.className = `grade-cell grade-${data.grade}`;
        }

        const gradeButtonImg = document.querySelector(`button.bouton-grade[data-user-id="${userId}"] img`);
        if (gradeButtonImg) {
            switch (data.grade) {
                case "admin": gradeButtonImg.src = "../Image/image_icône/niveau_admin.png"; break;
                case "VIP": gradeButtonImg.src = "../Image/image_icône/niveau_VIP.png"; break;
                case "membre": gradeButtonImg.src = "../Image/image_icône/niveau_membre.png"; break;
                case "bloqué": gradeButtonImg.src = "../Image/image_icône/niveau_bloqué.png"; break;
            }
        }
    })
    .catch(err => {
        console.error(err);
        image.src = backup;
    })
    .finally(() => {
        allButtons.forEach(btn => btn.disabled = false);
    });
}


function SupprimerUtilisateur(event) {
    event.preventDefault();

    const button = event.currentTarget;
    const userId = button.dataset.userId;
    const row = button.closest("tr");
    const image = button.querySelector("img");
    const backup = image.src;

    if (!confirm("Confirmer la suppression de l'utilisateur ?")) return;

    const allButtons = row.querySelectorAll("button");
    allButtons.forEach(btn => btn.disabled = true);

    image.src = "../Image/image_icône/barre-de-chargement.png";

    fetch("../fichier_php/supprimer_utilisateur.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: "user_id=" + encodeURIComponent(userId),
        credentials: 'same-origin'
    })
    .then(res => {
        const contentType = res.headers.get('content-type');
        if (contentType && contentType.includes('application/json')) {
            return res.json().then(data => {
                if (!data.success) {
                    throw new Error(data.message || "Une erreur est survenue");
                }
                row.remove();
                return data;
            });
        } else {
            return res.text().then(text => {
                console.error("Réponse non-JSON reçue:", text.substring(0, 100) + "...");
                throw new Error("Le serveur a renvoyé une réponse non-JSON");
            });
        }
    })
    .catch(err => {
        console.error("Erreur complète:", err);
        alert("Erreur lors de la suppression: " + err.message);
        image.src = backup;
        
        allButtons.forEach(btn => btn.disabled = false);
    });
}

function lockUserActions(userId, lock = true) {
    const buttons = document.querySelectorAll(`button[data-user-id="${userId}"]`);
    buttons.forEach(btn => {
        btn.disabled = lock;
    });
}