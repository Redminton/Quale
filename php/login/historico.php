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
    <title>Qualé Histórico</title>

    <style>
        body {
            padding: 20px;
            background-color: #D3F8E2;
        }

        h1 {
            margin-bottom: 30px;
        }

        .rodape {
            background-color: #198754;
            border-radius: 3%;
            text-align: center;
            padding: 10px;
            color: white;
            bottom: 0;
            width: 100%;
        }

        .rodape a {
            color: white;
            text-decoration: none;
        }

        .rodape h5 {
            margin: 0;
        }

        .navbar-brand img {
            max-width: 50px;
            height: auto;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <nav class="navbar navbar-expand-lg ">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="../../index.html">
                            <img src="../../img/logo.png" alt="Logo">
                            <span>Qualé</span>
                        </a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="home.php">Voltar</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="logout.php">Sair</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <h3>Histórico de Viagens</h3>
                <table class="table table-bordered table-striped" id="tabelaHistorico">
                    <thead class="table-dark">
                        <tr>
                            <th>ID Viagem</th>
                            <th>Origem (Lat, Lng)</th>
                            <th>Destino (Lat, Lng)</th>
                            <th>Distância</th>
                            <th>Duração</th>
                            <th>Data e Hora</th>
                            <th>Valor Combustível</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- As viagens serão carregadas aqui dinamicamente -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="rodape">
        <h5>Confira mais projetos By <a href="https://redminton.github.io" target="_blank">redminton.cloud!</a></h5>
    </div>

    <script>
        $(document).ready(function() {
            // Função para carregar o histórico de viagens
            function carregarHistorico() {
                $.ajax({
                    url: '../calc/get_historico.php', // A página PHP que irá buscar as viagens do banco
                    method: 'GET',
                    dataType: 'json',
                    success: function(viagens) {
                        let linhas = '';
                        viagens.forEach(function(viagem) {
                            linhas += `<tr>
                                <td>${viagem.id_viagem}</td>
                                <td>${viagem.origemLat}, ${viagem.origemLng}</td>
                                <td>${viagem.destLat}, ${viagem.destLng}</td>
                                <td>${viagem.distancia}</td>
                                <td>${viagem.duracao}</td>
                                <td>${viagem.data_hora}</td>
                                <td>${viagem.val_combustivel}</td>
                                <td>
                                    <a href="../calc/mapa_viagem.php?id_viagem=${viagem.id_viagem}" class="btn btn-primary">Ver Mapa</a>
                                </td>
                            </tr>`;
                        });
                        $('#tabelaHistorico tbody').html(linhas);
                    },
                    error: function() {
                        alert('Erro ao carregar o histórico de viagens');
                    }
                });
            }

            // Carregar o histórico assim que a página carregar
            carregarHistorico();
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>