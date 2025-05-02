function deleteReservation(id_reservation) {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "supprimer_reservation.php?id_reservation=" + id_reservation, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var voyageElement = document.getElementById('voyage_' + id_reservation);
            if (voyageElement) {
                voyageElement.remove(); 
            }
        }
    };
    xhr.send();
}
