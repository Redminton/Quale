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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Qualé Home</title>
    <link rel="shortcut icon" type="imagex/png" href="../../img/logo.png">
    <style>
        body {
            background-color: #D3F8E2;
        }

        #map {
            width: 100%;
            height: 100%;
        }

        .sidebar {
            height: 100vh;
            background-color: #adc4db;
            padding: 20px;
            overflow-y: auto;
            background-color: #D3F8E2;
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

        .rodape {
            background-color: #198754;
            border-radius: 3%
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Coluna da esquerda -->
            <div class="col-2 sidebar" style="padding-top: 0px;">
                <!-- Formulário para criar rota -->
                <div class=" form-container mt-3">
                    <form id="routeForm">
                        <div class="mb-3">
                            <label for="origin" class="form-label">Cidade de Origem</label>
                            <input type="text" class="form-control" id="origin" placeholder="Digite a cidade">
                        </div>
                        <div class="mb-3">
                            <label for="destination" class="form-label">Cidade de Destino</label>
                            <input type="text" class="form-control" id="destination" placeholder="Digite o destino">
                        </div>

                        <!-- Select para Tipo de Gasolina -->
                        <div class="mb-3">
                            <label for="fuelType" class="form-label">Tipo de Gasolina</label>
                            <select class="form-select" id="fuelType">
                                <option value="preco1">Gasolina Comum</option>
                                <option value="preco2">Gasolina Aditivada</option>
                                <option value="preco3">Etanol</option>
                                <option value="preco4">Diesel 500</option>
                                <option value="preco5">Diesel 10</option>
                            </select>
                        </div>

                        <!-- Select para Pontos de Interesse -->
                        <div class="mb-3">
                            <label for="poi" class="form-label">Escolha o Posto de Gasolina</label>
                            <select class="form-select" id="poi">
                                <option value="">Selecione</option>
                                <!-- As opções de postos serão carregadas aqui dinamicamente -->
                            </select>
                        </div>


                        <div class="d-flex flex-wrap gap-2">
                            <button type="submit" class="btn btn-primary">Criar Rota</button>
                            <button type="button" class="btn btn-success" onclick="getCurrentLocation()">Usar Localização Atual</button>
                            <button type="button" class="btn btn-success" id="saveButton">Salvar Viagem</button>
                        </div>
                    </form>
                </div>
                <br>
                <div id="routeInfo" class="route-info" style="display:none;">
                    <h5>Informações da Rota</h5>
                    <p><strong>Kilometragem:</strong> <span id="distance"></span></p>
                    <p><strong>Duração Estimada:</strong> <span id="duration"></span></p>
                </div>
            </div>

            <!-- Mapa central -->
            <div class="col-8 map-container" style="padding: 0;">
                <div id="map"></div>
            </div>

            <!-- Coluna da direita -->
            <div class="col-2 sidebar">
                <div class="d-flex align-items-center justify-content-center w-100">
                    <img src="../../img/logo.png" alt="Logo" style="height: auto;  max-width: 50px;">
                    <h5 class="ms-2 mb-0">Qualé</h5>
                </div>
                <br>
                <a href="historico.php"><button class="btn btn-primary mb-2">Histórico de Viagens</button></a>
                <button class="btn btn-success mb-2" onclick="togglePriceTable()">Ver Preços</button>
                <a href="cadastro.php"><button class="btn btn-success mb-2">Cadastrar Veículo/Motorista</button></a>
                <a href="logout.php"><button class="btn btn-success mb-2">Desconectar Sessão</button></a>
                <footer class="text-white text-center py-3">
                    <div class="rodape">
                        <br>
                        <h5>
                            Confira mais projetos By <a href="https://redminton.github.io"
                                class="text-white">redminton.cloud!</a>
                        </h5>
                        <br>
                    </div>
                </footer>
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



    <script>
        $(document).ready(function() {
            // Carregar os postos ao carregar a página com o tipo de combustível inicial selecionado
            carregarPostosList($('#fuelType').val());

            // Evento para carregar os postos quando o tipo de combustível for selecionado
            $('#fuelType').change(function() {
                var tipoCombustivelSelecionado = $(this).val();
                carregarPostosList(tipoCombustivelSelecionado); // Carregar postos de acordo com o combustível
            });

            // Função para carregar os postos de gasolina com base no tipo de combustível
            function carregarPostosList(fuelType) {
                $.ajax({
                    url: '../ponto/pontos.php', // URL que retorna a lista de postos
                    method: 'GET',
                    dataType: 'json',
                    data: {
                        fuel_type: fuelType
                    }, // Passando o tipo de combustível (preco1, preco2, etc.)
                    success: function(postos) {
                        let options = '<option value="">Selecione um posto</option>'; // Opção padrão

                        postos.forEach(function(posto) {
                            // Preencher o select com os postos e preços dinâmicos
                            options += `
                        <option value="${posto.id_ponto}">
                            ${posto.nome_ponto} - R$ ${posto[fuelType]}
                        </option>
                    `;
                        });

                        // Atualiza o conteúdo do select com as opções dos postos
                        $('#poi').html(options);
                    },
                    error: function(xhr, status, error) {
                        console.log('Erro ao carregar postos:', error);
                    }
                });
            }
        });
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCilGvyLOyIkVM6UqxNZdg4XhIXEbyM0j4"></script>
    <script src="home2.js"></script>
    <script src="home.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>