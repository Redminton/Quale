let map, info, marker; // Variável global para o mapa

// Função para inicializar o mapa
function initialize() {
    var mapOptions = {
        center: new google.maps.LatLng(-28.2670623, -54.2263399),
        zoom: 8,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
    carregarPontos();
    local();
    info = new google.maps.InfoWindow();

}

function local() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition, showError);
    } else {
        alert("Geolocalização não é suportada neste navegador.");
    }
}
function showPosition(position) {
    const latitude = position.coords.latitude;
    const longitude = position.coords.longitude;

    // Define a posição do usuário no mapa
    const userLocation = { lat: latitude, lng: longitude };
    console.log(userLocation);
    //map.setCenter(userLocation);


    info.setPosition(userLocation);
    info.setContent("Location found.");
    info.open(map);
    map.setCenter(userLocation);
}

function showError(error) {
    switch (error.code) {
        case error.PERMISSION_DENIED:
            alert("Usuário negou a solicitação de geolocalização.");
            break;
        case error.POSITION_UNAVAILABLE:
            alert("Informação de localização não disponível.");
            break;
        case error.TIMEOUT:
            alert("A solicitação expirou.");
            break;
        case error.UNKNOWN_ERROR:
            alert("Ocorreu um erro desconhecido.");
            break;
    }
}





// Função para carregar os pontos do arquivo JSON
function carregarPontos() {
    $.getJSON('./pontos.json', function (pontos) {
        $.each(pontos, function (index, ponto) {
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(ponto.Latitude, ponto.Longitude),
                title: "Meu ponto personalizado! :-D",
                map: map // O mapa já foi inicializado aqui
            });
        });
    }).fail(function (jqxhr, textStatus, error) {
        console.log("Erro ao carregar o JSON: " + textStatus + ", " + error);
    });
}

// Função de depuração para verificar os dados do JSON
function debug() {
    $.getJSON('./pontos.json', function (data) {
        //console.log(data); // Exibe os dados no console
    }).fail(function (jqxhr, textStatus, error) {
        console.log("Erro ao carregar o JSON: " + textStatus + ", " + error);
    });
}

/* Inicialize o mapa quando o documento estiver pronto
$(document).ready(function () {
    initialize(); // Inicializa o mapa e carrega os pontos
    debug();      // Debug para verificar o conteúdo do JSON
    local();
}); */
