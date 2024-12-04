<?php
include './testa_sessao.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../../style.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Quale</title>
    <style>
        #map {
            width: 100%;
            height: 100vh;
        }

        .sidebar {
            height: 100vh;
            background-color: #adc4db;
            padding: 20px;
            position: fixed;
            width: 300px;
        }

        .sidebar .form-container {
            margin-top: 20px;
        }

        .content {
            margin-left: 320px;
            /* Para não sobrepor a barra lateral */
        }

        .route-info {
            margin-top: 20px;
            padding: 15px;
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
    </style>
</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <!-- Barra lateral -->
            <div class="col-3 sidebar d-flex flex-column">
                <h5>Menu de Navegação</h5>
                <a href="historico.php"><button class="btn btn-primary mb-2">Histórico de Viagens</button></a>
                <button class="btn btn-secondary mb-2" onclick="precos()">Ver Preços</button>
                <a href="cadastro.php"><button class="btn btn-success mb-2">Cadastrar Veiculo/Motorista</button></a>
                <a href="logout.php"><button class="btn btn-success mb-2">Desconectar Sessão</button></a>

                <!-- Formulário para criar rota -->
                <div class="form-container">
                    <form id="routeForm">
                        <div class="mb-3">
                            <label for="origin" class="form-label">Cidade de Origem</label>
                            <input type="text" class="form-control" id="origin" placeholder="Digite a cidade ou deixe vazio para usar sua localização atual">
                        </div>
                        <div class="mb-3">
                            <label for="destination" class="form-label">Cidade de Destino</label>
                            <input type="text" class="form-control" id="destination" placeholder="Digite a cidade de destino">
                        </div>
                        <div style="display: flex; gap: 10px;">
                            <button type="submit" class="btn btn-primary">Criar Rota</button>
                            <button type="button" class="btn btn-secondary" onclick="getCurrentLocation()">Usar Localização Atual</button>
                            <button type="button" class="btn btn-secondary" id="saveButton">Salvar Viagem</button>
                        </div>
                    </form>
                </div>
                <!-- Informações da Rota -->
                <div id="routeInfo" class="route-info" style="display:none;">
                    <h5>Informações da Rota</h5>
                    <p><strong>Kilometragem:</strong> <span id="distance"></span></p>
                    <p><strong>Duração Estimada:</strong> <span id="duration"></span></p>
                </div>
            </div>

            <!-- Mapa -->
            <div class="col-9 content">
                <div id="map"></div>
            </div>
        </div>
    </div>



    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCilGvyLOyIkVM6UqxNZdg4XhIXEbyM0j4"></script>
    <script src="home.js">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>