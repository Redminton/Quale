<?php
include './testa_sessao.php';
?>
<!DOCTYPE html>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../../style.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Painel de Controle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body {
            padding: 20px;
        }

        h1 {
            margin-bottom: 30px;
        }

        .form-container {
            display: none;
            /* Esconde os formulários inicialmente */
            animation: slideIn 0.5s forwards;
        }

        /* Animação para os formulários deslizantes */
        @keyframes slideIn {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
    </style>

    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="../../index.html">Menu inicial</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link " href="home.php">Voltar</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " href="logout.php">Sair</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <h1>Histórico de Viagens</h1>
                <table class="table table-bordered table-striped" id="tabelaHistorico">
                    <thead>
                        <tr>
                            <th>ID Viagem</th>
                            <th>Origem (Lat, Lng)</th>
                            <th>Destino (Lat, Lng)</th>
                            <th>Distância</th>
                            <th>Duração</th>
                            <th>Data e Hora</th>
                            <th>Valor Combustível</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- As viagens serão carregadas aqui dinamicamente -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!--<div class="row d-flex ">
            <div class="col-md-12    ">
                <h3>

                    Confira mais projetos By <a href="https://redminton.github.io"> redminton.cloud!
                    </a>
                </h3>
            </div>
        </div>
    </div>-->






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
                        $('#tabelaHistorico').html(linhas);
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