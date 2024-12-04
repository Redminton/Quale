let infoWindow;
function initMap() {
    const map = new google.maps.Map(document.getElementById("map"), {
        center: { lat: -23.55052, lng: -46.633308 }, // Localização inicial (São Paulo)
        zoom: 15,
    });
    infoWindow = new google.maps.InfoWindow();
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            (position) => {
                const pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude,
                };

                const marker = new google.maps.Marker({
                    position: pos,
                    map: map,
                    icon: {
                        url: "https://maps.google.com/mapfiles/kml/paddle/ylw-stars.png", // URL do ícone personalizado
                        scaledSize: new google.maps.Size(40, 40), // Tamanho do ícone
                    },
                });




                // infoWindow.setPosition(pos);
                // infoWindow.setContent("Seu endereço.");
                // infoWindow.open(map);
                map.setCenter(pos);
            },
            () => {
                handleLocationError(true, infoWindow, map.getCenter());
            }
        );
    } else {
        // Browser doesn't support Geolocation
        handleLocationError(false, infoWindow, map.getCenter());
    }

    loadPoints(map);

}

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
    infoWindow.setPosition(pos);
    infoWindow.setContent(
        browserHasGeolocation
            ? "Error: The Geolocation service failed."
            : "Error: Your browser doesn't support geolocation."
    );
    infoWindow.open(map);
}

function loadPoints(map) {
    const xmlUrl = "./php/postos.php"; // URL do arquivo PHP que gera o XML
    fetch(xmlUrl)
        .then((response) => response.text())
        .then((data) => {
            const parser = new DOMParser();
            const xml = parser.parseFromString(data, "text/xml");
            const markers = xml.getElementsByTagName("marker");

            for (let i = 0; i < markers.length; i++) {
                const id = markers[i].getAttribute("id");
                const name = markers[i].getAttribute("name");
                const yearAdded = markers[i].getAttribute("year_added");
                const city = markers[i].getAttribute("city");
                const lat = parseFloat(markers[i].getAttribute("lat"));
                const lng = parseFloat(markers[i].getAttribute("lng"));
                const address = markers[i].getAttribute("address");
                const price1 = markers[i].getAttribute("price1");
                const price2 = markers[i].getAttribute("price2");
                const price3 = markers[i].getAttribute("price3");
                const price4 = markers[i].getAttribute("price4");
                const price5 = markers[i].getAttribute("price5");

                // Criar marcador no mapa
                const marker = new google.maps.Marker({
                    position: { lat, lng },
                    map,
                    title: name,
                });

                // Conteúdo do InfoWindow
                const infoContent = `
                    <div>
                        <h5>${name}</h5>
                        <p><strong>Endereço:</strong> ${address}</p>
                        <p><strong>Cidade:</strong> ${city}</p>
                        <p><strong>Ano de Adição:</strong> ${yearAdded}</p>
                        <p><strong>Preços:</strong></p>
                        <ul>
                            <li>Preço 1: R$ ${price1}</li>
                            <li>Preço 2: R$ ${price2}</li>
                            <li>Preço 3: R$ ${price3}</li>
                            <li>Preço 4: R$ ${price4}</li>
                            <li>Preço 5: R$ ${price5}</li>
                        </ul>
                    </div>
                `;

                const infoWindow = new google.maps.InfoWindow({
                    content: infoContent,
                });

                // Exibir InfoWindow ao clicar no marcador
                marker.addListener("click", () => {
                    infoWindow.open(map, marker);
                });
            }
        })
        .catch((error) => console.error("Erro ao carregar os pontos:", error));
}










window.onload = initMap; 