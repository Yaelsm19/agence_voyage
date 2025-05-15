function deleteReservation(id_reservation) {
    if (!confirm("Es-tu sûr de vouloir supprimer cette réservation ?")) {
        return;
    }

    fetch('supprimer_reservation.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'id_reservation=' + encodeURIComponent(id_reservation)
    })
    .then(response => {
        if (!response.ok) throw new Error('Erreur réseau : ' + response.statusText);
        return response.text();
    })
    .then(data => {
        const voyageElement = document.getElementById('voyage_' + id_reservation);
        if (voyageElement) voyageElement.remove();
        alert(data);
    })
    .catch(error => alert('Erreur lors de la suppression : ' + error.message));
}
