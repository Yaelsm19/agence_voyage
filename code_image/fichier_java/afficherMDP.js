function afficherMDP() {
    const mdpInput = document.getElementById("password");
    mdpInput.type = (mdpInput.type === "password") ? "text" : "password";
}