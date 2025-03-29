<?php
$image1 = !empty($voyage['image_reservation1']) ? $voyage['image_reservation1'] : 'default_image1.jpg';
$image2 = !empty($voyage['image_reservation2']) ? $voyage['image_reservation2'] : 'default_image2.jpg';
$image3 = !empty($voyage['image_reservation3']) ? $voyage['image_reservation3'] : 'default_image3.jpg';
?>

<script>
let images = [
    "../Image/image_voyage_réservation/<?= htmlspecialchars($image1) ?>",
    "../Image/image_voyage_réservation/<?= htmlspecialchars($image2) ?>",
    "../Image/image_voyage_réservation/<?= htmlspecialchars($image3) ?>"
];

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
</script>
