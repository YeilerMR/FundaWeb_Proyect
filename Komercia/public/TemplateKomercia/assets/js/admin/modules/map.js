// Módulo: Mapa Leaflet + Geocoding
const MapModule = (() => {

    let map, marker, $latInput, $lngInput;

    async function geocode(query) {
        const url = `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}&limit=1`;
        const res = await fetch(url, { headers: { "Accept-Language": "es" } });
        const data = await res.json();
        if (!data?.length) return null;
        return { lat: parseFloat(data[0].lat), lng: parseFloat(data[0].lon) };
    }

    function setLatLng(latlng) {
        marker.setLatLng(latlng);
        map.panTo(latlng);
        $latInput.val(Number(latlng.lat).toFixed(6));
        $lngInput.val(Number(latlng.lng).toFixed(6));
    }

    function bindGeocodeButtons() {
        $("#btnMyLocation").on("click", function () {
            if (!navigator.geolocation) return alert("Geolocalización no soportada.");
            navigator.geolocation.getCurrentPosition(
                pos => setLatLng({ lat: pos.coords.latitude, lng: pos.coords.longitude }),
                () => alert("No se pudo obtener tu ubicación.")
            );
        });

        $("#btnGeocode").on("click", async function () {
            const q = $("#geocodeQuery").val().trim() || $("#addressInput").val().trim();
            if (!q) return;
            const ll = await geocode(q);
            if (!ll) return alert("Dirección no encontrada.");
            setLatLng(ll);
        });
    }

    function init(targetId, latInputSelector, lngInputSelector) {
        $latInput = $(latInputSelector);
        $lngInput = $(lngInputSelector);

        const valLat = parseFloat(($latInput.val() || "").toString().replace(",", "."));
        const valLng = parseFloat(($lngInput.val() || "").toString().replace(",", "."));
        const hasCoords = !isNaN(valLat) && !isNaN(valLng);

        const start = hasCoords ? { lat: valLat, lng: valLng } : { lat: 9.9281, lng: -84.0907 };
        const startZoom = hasCoords ? 16 : 13;

        map = L.map(targetId, { zoomControl: true }).setView([start.lat, start.lng], startZoom);

        L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
            attribution: "&copy; OpenStreetMap"
        }).addTo(map);

        marker = L.marker([start.lat, start.lng], { draggable: true }).addTo(map);

        marker.on("dragend", e => setLatLng(e.target.getLatLng()));

        setLatLng(start);

        bindGeocodeButtons();
    }

    return { init, setLatLng };

})();