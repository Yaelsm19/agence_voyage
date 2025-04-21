console.log("✅ Le fichier modifier_profil.js est bien chargé !");
alert("Le fichier JS est bien chargé après le body !");


document.addEventListener("DOMContentLoaded", function () {
    const originalValues = {};

    window.enableEdit = function(id) {
        const input = document.getElementById(id);
        const controls = document.getElementById('controls-' + id);
    
        originalValues[id] = input.value;
        input.disabled = false;
        input.focus();
        controls.style.display = 'inline';
    }

    window.saveEdit = function(id) {
        const input = document.getElementById(id);
        const controls = document.getElementById('controls-' + id);
    
        input.disabled = true;
        controls.style.display = 'none';
    }

    window.cancelEdit = function(id) {
        const input = document.getElementById(id);
        const controls = document.getElementById('controls-' + id);
    
        input.value = originalValues[id];
        input.disabled = true;
        controls.style.display = 'none';
    }
});
