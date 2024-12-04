<?php
include './testa_sessaoAdmin.php';
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
                                    <a class="nav-link " href="logout.php">Sair</a>
                                </li>
                            </ul>

                        </div>
                    </div>
                </nav>
            </div>
        </div>



        <div class="container-fluid">
            <!-- Alerta de boas-vindas -->
            <div id="welcomeMessage" class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Bem-vindo!</strong> A session ID é: <strong><?php echo strtoupper(session_id()); ?></strong><br>
                Seja bem-vindo, <strong><?php echo $_SESSION['nome']; ?></strong>!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            <div class="row">
                <!-- Menu Lateral -->
                <div class="col-md-2" id="sidebar">
                    <h4>Acessar Tabelas</h4>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <button class="btn btn-link" onclick="toggleContent('#tabelas')">Ver Tabelas</button>
                        </li>
                        <li class="nav-item">
                            <button class="btn btn-link" onclick="toggleContent('#formVeiculo')">Gerenciar Veículos</button>
                        </li>
                        <li class="nav-item">
                            <button class="btn btn-link" onclick="toggleContent('#formMotorista')">Gerenciar Motoristas</button>
                        </li>
                        <li class="nav-item">
                            <button class="btn btn-link" onclick="toggleContent('#formCategoria')">Gerenciar Categorias</button>
                        </li>
                    </ul>
                </div>

                <!-- Conteúdo Principal -->
                <div class="col-md-10">
                    <h1 class="text-center">Painel de Controle</h1>

                    <!-- Formulário de Veículo -->
                    <div id="formVeiculo" class="form-container">
                        <form id="veiculoForm">
                            <input type="hidden" id="id_veiculo" name="id_veiculo">
                            <div class="mb-3">
                                <label for="id_categoria" class="form-label">Categoria:</label>
                                <select id="id_categoria" name="id_categoria" class="form-select" required>
                                    <option value="" disabled selected>Escolha uma categoria</option>
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
                        </form>
                    </div>

                    <!-- Formulário de Motorista (exemplo) -->
                    <div id="formMotorista" class="form-container">
                        <p>Formulário de motoristas será exibido aqui...</p>
                    </div>

                    <!-- Formulário de Categoria (exemplo) -->
                    <div id="formCategoria" class="form-container">
                        <p>Formulário de categorias será exibido aqui...</p>
                    </div>

                    <!-- Tabelas -->
                    <div id="tabelas" class="form-container">
                        <h2>Listagem de Tabelas do Banco de Dados</h2>
                        <ul id="tablesList"></ul>
                    </div>
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
                carregarCategorias();
                carregarVeiculos();
                //     carregarMotoristas();

                // Função para carregar categorias no select
                function carregarCategorias() {
                    $.ajax({
                        url: '../categorias.php',
                        method: 'GET',
                        dataType: 'json',
                        success: function(categorias) {
                            categorias.forEach(function(categoria) {
                                $('#id_categoria').append(new Option(categoria.nome_categoria, categoria.id_categoria));
                            });
                        }
                    });
                }
                $('#veiculoForm').on('submit', function(e) {
                    e.preventDefault();
                    let dados = $(this).serialize();
                    $.ajax({
                        url: '../salvarveiculo.php',
                        method: 'POST',
                        data: dados,
                        success: function(response) {
                            console.log("Foi");
                            carregarVeiculos();
                            $('#veiculoForm')[0].reset(); // Limpar o formulário
                        },
                        error: function(response) {
                            console.log(response);
                        }

                    });
                });

                function carregarVeiculos() {
                    $.ajax({
                        url: '../veiculos.php',
                        method: 'GET',
                        dataType: 'json',
                        success: function(veiculos) {
                            let linhas = '';
                            veiculos.forEach(function(veiculo) {
                                linhas += `<tr>
                                <td>${veiculo.id_veiculo}</td>
                                <td>${veiculo.nome_categoria}</td>
                                <td>${veiculo.ano_modelo}</td>
                                <td>${veiculo.nome_veiculo}</td>
                                <td>${veiculo.placa_veiculo}</td>
                                 <td>${veiculo.media_veiculo}</td>
                                <td>
                                    <button class="btn btn-sm btn-warning me-1" onclick="editarVeiculo(${veiculo.id_veiculo})">Editar</button>
                                    <button class="btn btn-sm btn-danger" onclick="deletarVeiculo(${veiculo.id_veiculo})">Deletar</button>
                                </td>
                            </tr>`;
                            });
                            $('#tabelaVeiculos tbody').html(linhas);
                        }
                    });
                }







            });

            function editarVeiculo(id_veiculo) {
                $.ajax({
                    url: '../get_veiculo.php',
                    method: 'GET',
                    data: {
                        id_veiculo: id_veiculo
                    },
                    dataType: 'json',
                    success: function(veiculo) {
                        $('#id_veiculo').val(veiculo.id_veiculo);
                        $('#id_categoria').val(veiculo.id_categoria);
                        $('#ano_modelo').val(veiculo.ano_modelo);
                        $('#nome_veiculo').val(veiculo.nome_veiculo);
                        $('#placa_veiculo').val(veiculo.placa_veiculo);
                        $('#media_veiculo').val(veiculo.media_veiculo);
                    }
                });
            }




            function deletarVeiculo(id_veiculo) {
                if (confirm("Tem certeza que deseja deletar este Veiculo?")) {
                    $.ajax({
                        url: '../deletar_veiculo.php',
                        method: 'POST',
                        data: {
                            id_veiculo: id_veiculo
                        },
                        success: function(response) {
                            console.log('delete');
                            carregarVeiculos();

                        }
                    });
                }
            }
        </script>

















        <script>
            $(document).ready(function() {
                function carregartables() {
                    //  $('#loadTables').on('click', function () {
                    $.ajax({
                        url: '../php2.php',
                        method: 'GET',
                        dataType: 'json',
                        success: function(response) {
                            setTimeout(function() {
                                carregartables()
                            }, 10000)

                            $('#tablesList').empty();

                            if (response.error) {
                                $('#tablesList').append('<li>' + response.error + '</li>');
                            } else {
                                $.each(response, function(index, table) {
                                    $('#tablesList').append('<li>' + table + '</li>');
                                });
                            }
                        },
                        error: function() {
                            alert('Erro ao buscar as tabelas.');
                        }
                    });
                    //   });


                    console.log('teste 10 segundos');
                }
                carregartables();




            });
        </script>









        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>

        <script>
            // Função para alternar entre abrir e fechar os formulários e tabelas
            function toggleContent(contentId) {
                // Esconde todos os formulários
                $(".form-container").hide();
                // Exibe o conteúdo desejado
                $(contentId).toggle();
            }

            // Quando a página carrega, oculta todos os formulários
            $(document).ready(function() {
                $(".form-container").hide();
            });
        </script>
</body>

</html>