<?php
include '../login/testa_sessao.php';
// Verifica se o parâmetro 'id_viagem' foi passado
if (!isset($_GET['id_viagem'])) {
    echo "ID da viagem não informado.";
    exit;
}

$id_viagem = $_GET['id_viagem'];

// Conectar ao banco de dados e obter a viagem específica
$host = 'localhost';
$db = 'quale';
$user = 'root';
$senha = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $senha);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("SELECT * FROM viagens WHERE id_viagem = :id_viagem");
    $stmt->bindParam(':id_viagem', $id_viagem, PDO::PARAM_INT);
    $stmt->execute();

    $viagem = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$viagem) {
        echo "Viagem não encontrada.";
        exit;
    }

    // Dados da viagem
    $origemLat = $viagem['origemLat'];
    $origemLng = $viagem['origemLng'];
    $destLat = $viagem['destLat'];
    $destLng = $viagem['destLng'];
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mapa da Viagem</title>
    <link rel="shortcut icon" type="imagex/png" href="../../img/logo.png">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCilGvyLOyIkVM6UqxNZdg4XhIXEbyM0j4&callback=initMap" async defer></script>
    <style>
        #map {
            width: 100%;
            height: 100vh;
        }

        body {
            background-color: #D3F8E2;
            margin: 0;
        }
    </style>
</head>

<body>
    <div class="container mt-5 " style="padding: 0;">

        <div id="map"></div>
    </div>

    <script>
        let map;
        let directionsService;
        let directionsRenderer;

        function initMap() {
            // Inicializa o mapa
            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 14,
                center: {
                    lat: <?php echo $origemLat; ?>,
                    lng: <?php echo $origemLng; ?>
                }
            });

            // Cria o serviço de direções
            directionsService = new google.maps.DirectionsService();

            // Cria o renderizador de direções
            directionsRenderer = new google.maps.DirectionsRenderer();
            directionsRenderer.setMap(map);

            // Solicita a rota entre origem e destino
            const request = {
                origin: {
                    lat: <?php echo $origemLat; ?>,
                    lng: <?php echo $origemLng; ?>
                },
                destination: {
                    lat: <?php echo $destLat; ?>,
                    lng: <?php echo $destLng; ?>
                },
                travelMode: google.maps.TravelMode.DRIVING
            };

            // Calcula a rota e a exibe no mapa
            directionsService.route(request, function(result, status) {
                if (status === google.maps.DirectionsStatus.OK) {
                    directionsRenderer.setDirections(result);
                } else {
                    alert('Erro ao calcular a rota: ' + status);
                }
            });
        }
    </script>
</body>

</html>