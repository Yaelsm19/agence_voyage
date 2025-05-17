var originalValues = {}; 
var hasValidatedChanges = false;

function modifierProfil() {
    const email = document.getElementById('email').value;
    const prenom = document.getElementById('prenom').value;
    const nom = document.getElementById('nom').value;
    const numero = document.getElementById('tel').value;
    const submitBtn = document.getElementById('submit-button');
    
    submitBtn.disabled = true;
    submitBtn.textContent = 'Envoi en cours...';
    
    const formData = new FormData();
    formData.append('email', email);
    formData.append('prenom', prenom);
    formData.append('nom', nom);
    formData.append('numero', numero);
    formData.append('autorisation', 'true');
    
    fetch('../fichier_php/modifier_profil.php', {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`Erreur HTTP: ${response.status}`);
        }
        
        const contentType = response.headers.get('content-type');
        if (contentType && contentType.includes('application/json')) {
            return response.json();
        } else {
            return response.text().then(text => {
                throw new Error('Réponse non-JSON reçue: ' + text.substring(0, 100) + '...');
            });
        }
    })
    .then(data => {
        if (data.success) {
            alert("Modification réussie !");
            
            originalValues.email = email;
            originalValues.prenom = prenom;
            originalValues.nom = nom;
            originalValues.tel = numero;
            
            submitBtn.style.display = 'none';
            hasValidatedChanges = false;
        } else {
            alert("Erreur : " + data.message);
            
            document.getElementById('email').value = originalValues.email || '';
            document.getElementById('prenom').value = originalValues.prenom || '';
            document.getElementById('nom').value = originalValues.nom || '';
            document.getElementById('tel').value = originalValues.tel || '';
        }
    })
    .catch(error => {
        console.error("Erreur détaillée:", error);
        alert("Une erreur technique est survenue : " + error.message);
    })
    .finally(() => {
        submitBtn.disabled = false;
        submitBtn.textContent = 'Soumettre';
    });
    
    return false;
}

function enableEdit(id) {
    const input = document.getElementById(id);
    const controls = document.getElementById('controls-' + id);
    originalValues[id] = input.value;
    input.readOnly = false;
    input.focus();
    controls.style.display = 'inline';
    
    removeErrorMessages();
}

function showError(input, message) {
    removeErrorMessage(input);
    
    const error = document.createElement('div');
    error.classList.add('error-message');
    error.style.color = 'red';
    error.style.fontSize = '12px';
    error.style.marginTop = '5px';
    error.textContent = message;

    const container = input.closest('.form-group');
    container.appendChild(error);
}

function removeErrorMessages() {
    const errorMessages = document.querySelectorAll('.error-message');
    errorMessages.forEach(error => error.remove());
}

function removeErrorMessage(input) {
    const container = input.closest('.form-group');
    const errorMessage = container.querySelector('.error-message');
    if (errorMessage) {
        errorMessage.remove();
    }
}

function validateInput(id) {
    const input = document.getElementById(id);
    const value = input.value.trim();
    
    switch(id) {
        case 'email':
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(value)) {
                showError(input, "Adresse email invalide.");
                return false;
            }
            break;
        case 'prenom':
            if (value.length < 3) {
                showError(input, "Le prénom doit contenir au moins 3 caractères.");
                return false;
            }
            break;
        case 'nom':
            if (value.length < 2) {
                showError(input, "Le nom doit contenir au moins 2 caractères.");
                return false;
            }
            break;
        case 'tel':
            const phoneRegex = /^[0-9]{10}$/;
            if (!phoneRegex.test(value)) {
                showError(input, "Le numéro de téléphone doit comporter 10 chiffres.");
                return false;
            }
            break;
    }
    
    return true;
}

function saveEdit(id) {
    const input = document.getElementById(id);
    const controls = document.getElementById('controls-' + id);
    
    if (!validateInput(id)) {
        input.value = originalValues[id];
        return;
    }
    
    removeErrorMessage(input);
    
    input.readOnly = true;
    controls.style.display = 'none';
    
    if (input.value !== originalValues[id]) {
        hasValidatedChanges = true;
        showSubmitButton();
    }
}

function cancelEdit(id) {
    const input = document.getElementById(id);
    const controls = document.getElementById('controls-' + id);
    input.value = originalValues[id];
    input.readOnly = true;
    controls.style.display = 'none';
    
    removeErrorMessage(input);
}

function showSubmitButton() {
    const submitBtn = document.getElementById('submit-button');
    if (hasValidatedChanges) {
        submitBtn.style.display = 'inline-block';
    }
}

function initializeValues() {
    if (document.getElementById('email')) {
        originalValues.email = document.getElementById('email').value;
        originalValues.prenom = document.getElementById('prenom').value;
        originalValues.nom = document.getElementById('nom').value;
        originalValues.tel = document.getElementById('tel').value;
    }
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initializeValues);
} else {
    initializeValues();
}