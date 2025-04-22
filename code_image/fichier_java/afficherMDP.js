function afficherMDP() {
    const mdpInput = document.getElementById("password");
    if (mdpInput.type === "password") {
        mdpInput.type = "text";
    } else {
        mdpInput.type = "password";
    }    
}