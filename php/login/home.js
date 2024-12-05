
let map;
let directionsService;
let directionsRenderer;

function initMap() {
    map = new google.maps.Map(document.getElementById("map"), {
        zoom: 14,
        center: { lat: -23.55052, lng: -46.633308 }, // São Paulo como valor inicial
    });
    directionsService = new google.maps.DirectionsService();
    directionsRenderer = new google.maps.DirectionsRenderer();
    directionsRenderer.setMap(map);
    function center() {
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
                    setTimeout(center, 20000);
                    console.log("Moveu");
                },
                () => {
                    handleLocationError(true, infoWindow, map.getCenter());
                }
            );
        } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, infoWindow, map.getCenter());
        }
    }
    loadPoints(map);
    center();


}

function getCurrentLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            const lat = position.coords.latitude;
            const lng = position.coords.longitude;
            const origin = new google.maps.LatLng(lat, lng);

            document.getElementById("origin").value = `Latitude: ${lat}, Longitude: ${lng}`;
            createRoute(origin); // Calcula a rota a partir da localização atual
        });
    } else {
        alert("Geolocalização não é suportada por este navegador.");
    }
}

function createRoute(origin) {
    const destination = document.getElementById("destination").value;

    const request = {
        origin: origin,
        destination: destination,
        travelMode: "DRIVING",
    };

    directionsService.route(request, function (response, status) {
        if (status === "OK") {
            directionsRenderer.setDirections(response);

            // Extrair as informações relevantes da rota
            const leg = response.routes[0].legs[0];
            const originCoords = { lat: leg.start_location.lat(), lng: leg.start_location.lng() };
            const destinationCoords = { lat: leg.end_location.lat(), lng: leg.end_location.lng() };

            // Exibir informações e preparar dados para salvar
            displayRouteInfo(leg, originCoords, destinationCoords);
        } else {
            console.log("Erro ao calcular a rota: " + status);
        }
    });
}

// Exibir informações sobre a rota
let viagemData = null; // Variável global para armazenar os dados da viagem

function displayRouteInfo(leg, originCoords, destinationCoords) {
    const distance = leg.distance.text;
    const duration = leg.duration.text;
    console.log(1);
    document.getElementById("routeInfo").style.display = "block";
    // Verifica se o elemento #distance existe antes de tentar modificar seu conteúdo
    const distanceElement = document.getElementById("distance");
    if (distanceElement) {
        distanceElement.textContent = distance;
    } else {
        console.error('Elemento #distance não encontrado.');
    }

    // Verifica se o elemento #duration existe antes de tentar modificar seu conteúdo
    const durationElement = document.getElementById("duration");
    if (durationElement) {
        durationElement.textContent = duration;
    } else {
        console.error('Elemento #duration não encontrado.');
    }

    // Tornar a seção de informações visível


    // Preparar os dados para envio ao servidor
    viagemData = {
        origemLat: originCoords.lat,         // Latitude de origem
        origemLng: originCoords.lng,         // Longitude de origem
        destLat: destinationCoords.lat,      // Latitude de destino
        destLng: destinationCoords.lng,      // Longitude de destino
        distancia: distance,                 // Distância
        duracao: duration                    // Duração
    };

    console.log("Dados preparados para salvar:", viagemData);
}

// Função para salvar os dados
function salvarViagem() {
    if (viagemData) {
        // Obter o tipo de combustível selecionado
        const fuelType = $('#fuelType').val(); // 'preco1', 'preco2', etc.

        // Adicionar o tipo de combustível e preço ao objeto viagemData
        viagemData.fuelType = fuelType;

        // Agora, fazer a requisição AJAX com a viagemData incluindo o preço do combustível
        $.ajax({
            url: '../calc/salvar_viagem.php',
            type: 'POST',
            data: viagemData,
            success: function (response) {
                alert('Viagem salva com sucesso!');
                console.log(response); // Exibe a resposta do servidor no console
            },
            error: function (xhr, status, error) {
                console.error('Erro ao salvar a viagem:', error);
            }
        });
    } else {
        alert("Nenhuma viagem disponível para salvar.");
    }
}


// Adicionar evento ao botão "Salvar Viagem"
document.getElementById("saveButton").addEventListener("click", salvarViagem);

// Submissão do formulário (quando o usuário calcula a rota)
document.getElementById("routeForm").addEventListener("submit", function (event) {
    event.preventDefault();

    const origin = document.getElementById("origin").value;
    if (origin) {
        createRoute(origin);
    }
});









function loadPoints(map) {
    let markers = []; // Armazena os marcadores adicionados ao mapa

    function updatePoints() {
        $.ajax({
            url: "../ponto/pontos2.php", // URL do arquivo PHP que gera o XML
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

    updatePoints();
}


window.onload = initMap; 