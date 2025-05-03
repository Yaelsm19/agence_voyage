document.addEventListener("DOMContentLoaded", function () {
    const loadingSrc = "../Image/image_icône/barre-de-chargement.png";

    const boutonsGrade = document.querySelectorAll(".bouton-grade");
    boutonsGrade.forEach((bouton) => {
        bouton.addEventListener("click", function (e) {
            const image = this.querySelector("img");
            const originalSrc = image.src;
            image.src = loadingSrc;
            e.preventDefault();
            setTimeout(() => {
                image.src = originalSrc;
                this.closest("form").submit();
            }, 3000);
        });
    });

    const liensBlocage = document.querySelectorAll("a.action.bloquer");
    liensBlocage.forEach((lien) => {
        lien.addEventListener("click", function (e) {
            const image = this.querySelector("img");
            const originalSrc = image.src;
            image.src = loadingSrc;
            e.preventDefault();
            setTimeout(() => {
                window.location.href = this.href;
            }, 3000);
        });
    });
});
