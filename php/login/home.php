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
            overflow-y: auto;
        }

        .content {
            height: 100vh;
            padding: 0;
        }

        .map-container {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .sidebar .btn {
            width: 100%;
        }

        .sidebar .form-control {
            width: 100%;
        }

        #priceTableContainer {
            position: absolute;
            top: 10%;
            left: 10%;
            right: 10%;

            background-color: white;
            border: 1px solid #ddd;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            padding: 15px;
            border-radius: 8px;
            z-index: 1000;
            display: none;
            /* Oculto inicialmente */
        }

        #priceTableContainer table {
            width: 100%;
        }

        #closeTable {
            float: right;
            cursor: pointer;
            color: red;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Coluna da esquerda -->
            <div class="col-2 sidebar">
                <!-- Formulário para criar rota -->
                <div class="form-container mt-3">
                    <form id="routeForm">
                        <div class="mb-3">
                            <label for="origin" class="form-label">Cidade de Origem</label>
                            <input type="text" class="form-control" id="origin" placeholder="Digite a cidade">
                        </div>
                        <div class="mb-3">
                            <label for="destination" class="form-label">Cidade de Destino</label>
                            <input type="text" class="form-control" id="destination" placeholder="Digite a cidade de destino">
                        </div>
                        <div class="d-flex flex-wrap gap-2">
                            <button type="submit" class="btn btn-primary">Criar Rota</button>
                            <button type="button" class="btn btn-secondary" onclick="getCurrentLocation()">Usar Localização Atual</button>
                            <button type="button" class="btn btn-secondary" id="saveButton">Salvar Viagem</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Mapa central -->
            <div class="col-8 map-container">
                <div id="map"></div>
            </div>

            <!-- Coluna da direita -->
            <div class="col-2 sidebar">
                <a href="historico.php"><button class="btn btn-primary mb-2">Histórico de Viagens</button></a>
                <button class="btn btn-secondary mb-2" onclick="togglePriceTable()">Ver Preços</button>
                <a href="cadastro.php"><button class="btn btn-success mb-2">Cadastrar Veículo/Motorista</button></a>
                <a href="logout.php"><button class="btn btn-success mb-2">Desconectar Sessão</button></a>
            </div>
        </div>
    </div>

    <!-- Container da Tabela -->
    <div id="priceTableContainer">
        <span id="closeTable" onclick="togglePriceTable()">✖</span>
        <h5 class="mb-3">Tabela de Preços</h5>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Posto</th>
                    <th>Endereço</th>
                    <th>Gasolina</th>
                    <th>G. Aditivada</th>
                    <th>Etanol</th>
                    <th>Diesel 500</th>
                    <th>Diesel 10</th>
                </tr>
            </thead>
            <tbody id="priceTableBody">
                <!-- Linhas serão preenchidas dinamicamente -->
            </tbody>
        </table>
    </div>




    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCilGvyLOyIkVM6UqxNZdg4XhIXEbyM0j4"></script>
    <script src="home2.js"></script>
    <script src="home.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>