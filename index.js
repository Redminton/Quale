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
    let markers = []; // Armazena os marcadores adicionados ao mapa

    function updatePoints() {
        $.ajax({
            url: "./php/ponto/pontos2.php", // URL do arquivo PHP que gera o XML
            method: "GET",
            dataType: "xml", // O retorno do PHP é esperado no formato XML
            success: function (data) {
                // Remover marcadores antigos antes de adicionar novos
                markers.forEach(marker => marker.setMap(null));
                markers = [];

                // Processar os dados do XML
                $(data).find("marker").each(function () {
                    const id = $(this).attr("id");
                    const name = $(this).attr("name");
                    const yearAdded = $(this).attr("year_added");
                    const city = $(this).attr("city");
                    const lat = parseFloat($(this).attr("lat"));
                    const lng = parseFloat($(this).attr("lng"));
                    const address = $(this).attr("address");
                    const price1 = $(this).attr("price1");
                    const price2 = $(this).attr("price2");
                    const price3 = $(this).attr("price3");
                    const price4 = $(this).attr("price4");
                    const price5 = $(this).attr("price5");

                    // Criar marcador no mapa
                    const marker = new google.maps.Marker({
                        position: { lat, lng },
                        map: map,
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

                    // Adicionar evento para abrir InfoWindow ao clicar no marcador
                    marker.addListener("click", () => {
                        infoWindow.open(map, marker);
                    });

                    // Adicionar marcador ao array de marcadores
                    markers.push(marker);
                });

                // Agendar a próxima atualização em 10 segundos
                setTimeout(updatePoints, 10000);
                console.log('Atualizou');
            },
            error: function () {
                console.error("Erro ao carregar os pontos de interesse.");
                // Tentar novamente após 10 segundos em caso de erro
                setTimeout(updatePoints, 10000);
                console.log('Atualizou com erro');
            },
        });
    }

    // Primeira chamada para carregar os pontos
    updatePoints();
}










window.onload = initMap; 