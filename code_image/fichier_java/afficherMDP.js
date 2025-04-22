function afficherMDP(id) {
    const mdpInput = document.getElementById(id);
    if (mdpInput.type === "password") {
        mdpInput.type = "text";
    } else {
        mdpInput.type = "password";
    }    
}