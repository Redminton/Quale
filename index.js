let infoWindow;
let markers = []; // Armazena os marcadores no mapa
let pontosInteresse = []; // Armazena os pontos de interesse para ordenação

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

    loadPoints(map); // Carregar os pontos de interesse no mapa
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
    function updatePoints() {
        $.ajax({
            url: "./php/ponto/pontos2.php", // URL do arquivo PHP que gera o XML
            method: "GET",
            dataType: "xml", // O retorno do PHP é esperado no formato XML
            success: function (data) {
                // Remover marcadores antigos antes de adicionar novos
                markers.forEach(marker => marker.setMap(null));
                markers = [];
                pontosInteresse = []; // Limpa os pontos de interesse antes de carregar novos

                // Processar os dados do XML
                $(data).find("marker").each(function () {
                    const id = $(this).attr("id");
                    const name = $(this).attr("name");
                    const yearAdded = $(this).attr("year_added");
                    const city = $(this).attr("city");
                    const lat = parseFloat($(this).attr("lat"));
                    const lng = parseFloat($(this).attr("lng"));
                    const address = $(this).attr("address");
                    const price1 = parseFloat($(this).attr("price1"));
                    const price2 = parseFloat($(this).attr("price2"));
                    const price3 = parseFloat($(this).attr("price3"));
                    const price4 = parseFloat($(this).attr("price4"));
                    const price5 = parseFloat($(this).attr("price5"));

                    // Armazenar o ponto de interesse
                    pontosInteresse.push({
                        id, name, yearAdded, city, lat, lng, address, price1, price2, price3, price4, price5
                    });

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
                       ` ;

                    // Evento de clique no marcador
                    google.maps.event.addListener(marker, "click", () => {
                        infoWindow.setContent(infoContent);
                        infoWindow.open(map, marker);
                    });

                    markers.push(marker);
                });
            }
        });
    }

    updatePoints(); // Carregar os pontos inicialmente
}

function Tabela() {
    const tipoPreco = document.getElementById('gasolinaTipo').value;
    const tabela = document.getElementById('tabelaPontos').getElementsByTagName('tbody')[0];
    tabela.innerHTML = '';

    // Ordenar os pontos com base no tipo de gasolina
    const sortedPoints = pontosInteresse.sort((a, b) => a[tipoPreco] - b[tipoPreco]);

    // Preencher a tabela com os pontos ordenados
    sortedPoints.forEach(ponto => {
        const row = tabela.insertRow();
        row.innerHTML = `
            <td>${ponto.name}</td>
            <td>${ponto.city}</td>
            <td>${ponto.address}</td>
            <td>R$ ${ponto[tipoPreco]}</td>
        `;
    });
}

window.onload = initMap;
