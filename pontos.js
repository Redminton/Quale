let map, info; // Variável global para o mapa

// Função para inicializar o mapa
function initialize() {
    var mapOptions = {
        center: new google.maps.LatLng(-28.2670623, -54.2263399),
        zoom: 8,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);






















    // Após inicializar o mapa, carregar os pontos
    carregarPontos();
}

// Função para carregar os pontos do arquivo JSON
function carregarPontos() {
    $.getJSON('./pontos.json', function (pontos) {
        $.each(pontos, function (index, ponto) {
            var marker = new google.maps.Marker({
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
        console.log(data); // Exibe os dados no console
    }).fail(function (jqxhr, textStatus, error) {
        console.log("Erro ao carregar o JSON: " + textStatus + ", " + error);
    });
}

// Inicialize o mapa quando o documento estiver pronto
$(document).ready(function () {
    initialize(); // Inicializa o mapa e carrega os pontos
    debug();      // Debug para verificar o conteúdo do JSON
});
