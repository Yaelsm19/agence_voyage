const originalValues = {};
let hasValidatedChanges = false;

function enableAllInputs() {
    const inputs = document.querySelectorAll('input[disabled]');
    inputs.forEach(input => {
        input.disabled = false;
    });
}

function enableEdit(id) {
    const input = document.getElementById(id);
    const controls = document.getElementById('controls-' + id);

    originalValues[id] = input.value;
    input.disabled = false;
    input.focus();
    controls.style.display = 'inline';
    console.log("Edition activée pour : " + id);
}

function saveEdit(id) {
    const input = document.getElementById(id);
    const controls = document.getElementById('controls-' + id);

    input.disabled = true;
    controls.style.display = 'none';
    console.log("Valeur validée : " + input.value);

    if (input.value !== originalValues[id]) {
        hasValidatedChanges = true;
        showSubmitButton();
    }
}

function cancelEdit(id) {
    const input = document.getElementById(id);
    const controls = document.getElementById('controls-' + id);

    input.value = originalValues[id];
    input.disabled = true;
    controls.style.display = 'none';
    console.log("Modification annulée pour : " + id);
}

function showSubmitButton() {
    const submitBtn = document.getElementById('submit-button');
    if (hasValidatedChanges) {
        submitBtn.style.display = 'inline-block'; 
    }
}


document.getElementById('submit-button').addEventListener('click', function(event) {
    event.preventDefault();

    enableAllInputs();

    const form = document.querySelector('form[action="modifier_profil.php"]');
    form.submit();
});
