document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('.form-container');
    if (!form) return;

    const email = document.getElementById('email');
    const password = document.getElementById('password');
    const prenom = document.getElementById('prenom');
    const nom = document.getElementById('nom');
    const telephone = document.getElementById('telephone');
    const confirmPassword = document.getElementById('confirmation-password');

    form.addEventListener('submit', (e) => {
        e.preventDefault();
        let isValid = true;

        document.querySelectorAll('.error-message').forEach(error => error.remove());

        function showError(input, message) {
            const error = document.createElement('div');
            error.classList.add('error-message');
            error.style.color = 'red';
            error.textContent = message;
    
            const container = input.closest('.form-group');
            container.appendChild(error);
        
            isValid = false;
        }
        

        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (email && !emailRegex.test(email.value.trim())) {
            showError(email, "Adresse email invalide.");
        }

        if (password && password.value.length < 8) {
            showError(password, "Le mot de passe doit contenir au moins 8 caractères.");
        }

        if (prenom && prenom.value.trim().length < 3) {
            showError(prenom, "Le prénom doit contenir au moins 3 caractères.");
        }

        if (nom && nom.value.trim().length < 2) {
            showError(nom, "Le nom doit contenir au moins 2 caractères.");
        }

        const phoneRegex = /^[0-9]{10}$/;
        if (telephone && !phoneRegex.test(telephone.value.trim())) {
            showError(telephone, "Le numéro de téléphone doit comporter 10 chiffres.");
        }

        if (confirmPassword && password && password.value !== confirmPassword.value) {
            showError(confirmPassword, "Les mots de passe ne correspondent pas.");
        }

        if (isValid) {
            form.submit();
        }
    });
});
