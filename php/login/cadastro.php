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
    <title>Qualé Cadastro</title>
    <link rel="shortcut icon" type="imagex/png" href="../../img/logo.png">
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

        .form-container {
            display: block;
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
        <div class="container-fluid"><br>
            <!-- Alerta de boas-vindas -->
            <div id="welcomeMessage" class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Bem-vindo!</strong> A session ID é: <strong><?php echo strtoupper(session_id()); ?></strong><br>
                Seja bem-vindo, <strong><?php echo $_SESSION['nome_usuario']; ?></strong>!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div><br>

            <div class="row">
                <!-- Menu Lateral -->
                <div class="col-md-2" id="sidebar" style="background-color: #D3F8E2; height: 100vh; display: flex; flex-direction: column; align-items: center; padding: 20px;">
                    <h4 class="text-center mb-4">Acessar Tabelas</h4>
                    <ul class="nav flex-column w-100">
                        <li class="nav-item mb-3">
                            <button class="btn btn-success w-100" onclick="toggleContent('#formVeiculo')">Gerenciar Veículos</button>
                        </li>
                        <li class="nav-item">
                            <button class="btn btn-primary w-100" onclick="toggleContent('#formMotorista')">Gerenciar Motoristas</button>
                        </li>
                    </ul>
                </div>


                <!-- Conteúdo Principal -->
                <div class="col-md-10">


                    <!-- Formulário de Veículo -->
                    <div id="formVeiculo" class="form-container">
                        <h2>Gerenciar Veículos</h2>
                        <form id="veiculoForm">
                            <div class="mb-3" style="display: none;">
                                <label for="id_veiculo" class="form-label">ID do Veículo:</label>
                                <input type="hidden" id="id_veiculo" name="id_veiculo" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="id_categoria" class="form-label">Categoria:</label>
                                <select id="id_categoria" name="id_categoria" class="form-select" required>
                                    <option value="">Escolha uma categoria</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="ano_modelo" class="form-label">Ano Modelo:</label>
                                <input type="date" id="ano_modelo" name="ano_modelo" class="form-control" min="1950-01-01" required>
                            </div>
                            <div class="mb-3">
                                <label for="nome_veiculo" class="form-label">Nome Veiculo:</label>
                                <input type="text" id="nome_veiculo" name="nome_veiculo" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="placa_veiculo" class="form-label">Placa Veiculo:</label>
                                <input type="text" id="placa_veiculo" name="placa_veiculo" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="media_veiculo" class="form-label">media veiculo:</label>
                                <input type="text" id="media_veiculo" name="media_veiculo" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Salvar</button>
                            <br>
                        </form>
                        <table id="tabelaVeiculos" class="table table-hover mt-4">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Categoria</th>
                                    <th>Ano Modelo</th>
                                    <th>Nome Veiculo</th>
                                    <th>Placa Veiculo</th>
                                    <th>Media veiculo</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Veiculos serão inseridos aqui via AJAX -->
                            </tbody>
                        </table>
                    </div>

                    <div id="formMotorista" class="form-container">
                        <h2>Gerenciar Motoristas</h2>
                        <form id="motoristaForm">
                            <div class="mb-3" style="display: none;">
                                <label for="id_motorista" class="form-label">ID do Motorista:</label>
                                <input type="hidden" id="id_motorista" name="id_motorista" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="nome_motorista" class="form-label">Nome do Motorista:</label>
                                <input type="text" id="nome_motorista" name="nome_motorista" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="idade_motorista" class="form-label">Idade do Motorista:</label>
                                <input type="number" id="idade_motorista" name="idade_motorista" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="cnh" class="form-label">CNH:</label>
                                <input type="number" id="cnh" name="cnh" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="id_veiculo2" class="form-label">Veículo:</label>
                                <select id="id_veiculo2" name="id_veiculo2" class="form-select" required>
                                    <option value="" disabled selected>Escolha um veículo</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </form>

                        <h3 class="mt-4">Lista de Motoristas</h3>
                        <table id="tabelaMotoristas" class="table table-hover mt-3">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Idade</th>
                                    <th>CNH</th>
                                    <th>Veículo</th>

                                </tr>
                            </thead>
                            <tbody>
                                <!-- Motoristas serão inseridos aqui via AJAX -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="rodape">
            <h5>Confira mais projetos By <a href="https://redminton.github.io" target="_blank">redminton.cloud!</a></h5>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            carregarCategorias();
            carregarVeiculos();

            // Função para carregar categorias no select
            function carregarCategorias() {
                $.ajax({
                    url: '../veiculo/categorias.php',
                    method: 'GET',
                    dataType: 'json',
                    success: function(categorias) {

                        $('#id_categoria').empty();

                        $('#id_categoria').append(new Option('Escolha uma categoria', '', true, false));




                        categorias.forEach(function(categoria) {
                            $('#id_categoria').append(new Option(categoria.nome_categoria, categoria.id_categoria));
                        });
                    }
                });
            }

            function carregarVeiculos() {
                $.ajax({
                    url: '../veiculo/veiculos.php',
                    method: 'GET',
                    dataType: 'json',
                    success: function(veiculos) {
                        setTimeout(function() {
                            carregarVeiculos()
                        }, 5000)
                        let linhas = '';
                        veiculos.forEach(function(veiculo) {
                            linhas += `<tr>
                        <td>${veiculo.id_veiculo}</td>
                        <td>${veiculo.nome_categoria}</td>
                        <td>${veiculo.ano_modelo}</td>
                        <td>${veiculo.nome_veiculo}</td>
                        <td>${veiculo.placa_veiculo}</td>
                        <td>${veiculo.media_veiculo}</td>
                        
                    </tr>`;
                        });
                        $('#tabelaVeiculos tbody').html(linhas);
                    }
                });
            }
            $('#veiculoForm').on('submit', function(e) {
                e.preventDefault();
                let dados = $(this).serialize();
                $.ajax({
                    url: '../veiculo/salvarveiculo.php',
                    method: 'POST',
                    data: dados,
                    success: function(response) {
                        carregarVeiculos();
                        $('#veiculoForm')[0].reset(); // Limpar o formulário

                    },
                    error: function(response) {
                        console.log(response);
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            carregarVeiculos2();
            carregarMotoristas();

            function carregarVeiculos2() {
                $.ajax({
                    url: '../veiculo/veiculos.php',
                    method: 'GET',
                    dataType: 'json',
                    success: function(categorias) {

                        $('#id_veiculo2').empty();

                        $('#id_veiculo2').append(new Option('Escolha um veiculo', '', true, false));

                        console.log('teste')

                        categorias.forEach(function(veiculo) {

                            const descricaoVeiculo = `${veiculo.nome_veiculo} (${veiculo.placa_veiculo})`;
                            $('#id_veiculo2').append(new Option(descricaoVeiculo, veiculo.id_veiculo));
                        });
                    },
                    error: function(xhr, status, error) {
                        console.log('Erro ao carregar os veículos:', error);
                    }
                });
            }

            function carregarMotoristas() {
                $.ajax({
                    url: '../motorista/motoristas.php',
                    method: 'GET',
                    dataType: 'json',
                    success: function(motoristas) {
                        let linhas = '';
                        motoristas.forEach(function(motorista) {
                            linhas += `<tr>
                        <td>${motorista.id_motorista}</td>
                        <td>${motorista.nome_motorista}</td>
                        <td>${motorista.idade_motorista}</td>
                        <td>${motorista.cnh}</td>
                        <td>${motorista.placa_veiculo}</td>
                        
                    </tr>`;
                        });
                        $('#tabelaMotoristas tbody').html(linhas);
                    }
                });
            }
            $('#motoristaForm').on('submit', function(e) {
                e.preventDefault();
                let dados = $(this).serialize();
                $.ajax({
                    url: '../motorista/salvar_motorista.php',
                    method: 'POST',
                    data: dados,
                    success: function(response) {
                        carregarMotoristas();
                        $('#motoristaForm')[0].reset(); // Limpa o formulário
                        console.log(id_veiculo2);
                    },
                    error: function(response) {
                        console.log('Erro:', response);
                    }
                });
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script>
        function toggleContent(contentId) {
            $(".form-container").hide();
            $(contentId).toggle();
        }
        $(document).ready(function() {
            toggleContent('#formVeiculo');
        });
    </script>
</body>

</html>