let images = ["journey_to_versailles_1789.jpg", "création de l'assemblé national.jpeg", "déclaration des droits de l'homme.jpeg"];
let currentIndex = 0;

function changeImage(index) {
    currentIndex = index;
    document.getElementById("mainImage").src = images[currentIndex];
    updateActiveThumbnail();
}

function nextImage() {
    currentIndex = (currentIndex + 1) % images.length;
    document.getElementById("mainImage").src = images[currentIndex];
    updateActiveThumbnail();
}

function prevImage() {
    currentIndex = (currentIndex - 1 + images.length) % images.length;
    document.getElementById("mainImage").src = images[currentIndex];
    updateActiveThumbnail();
}

function updateActiveThumbnail() {
    document.querySelectorAll(".thumbnail").forEach((thumb, index) => {
        thumb.classList.toggle("active", index === currentIndex);
    });
}