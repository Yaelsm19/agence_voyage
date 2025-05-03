document.addEventListener("DOMContentLoaded", function () {
    function ajouterCompteurCaracteres(champId) {
        const champ = document.getElementById(champId);
        const compteur = document.getElementById(`${champId}-compteur`);
        const max = champ.getAttribute('maxlength') || 255;

        function majCompteur() {
            const longueur = champ.value.length;
            compteur.textContent = longueur + " / " + max + " caractères";
        }

        champ.addEventListener('input', majCompteur);

        majCompteur();
    }

    ajouterCompteurCaracteres('password');
    ajouterCompteurCaracteres('email');
    if (document.getElementById('telephone')){
        ajouterCompteurCaracteres('telephone');
    }
    if (document.getElementById('prenom')){
        ajouterCompteurCaracteres('prenom');
    }
    if(document.getElementById('nom')){
        ajouterCompteurCaracteres('nom');
    }
    if(document.getElementById('confirmation-password')){
        ajouterCompteurCaracteres('confirmation-password');
    }
});
