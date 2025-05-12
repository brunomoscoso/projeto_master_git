document.addEventListener("DOMContentLoaded", function () {
    var latitude = -23.55052;
    var longitude = -46.63331;
    var mapa = L.map('map').setView([latitude, longitude], 15);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap contributors'
    }).addTo(mapa);

    L.marker([latitude, longitude]).addTo(mapa)
    .bindPopup('Clínica Saúde<br>Rua das Flores, 123')
    .openPopup();
});