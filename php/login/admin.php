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
                            <button class="btn btn-link" onclick="toggleContent('#formUsuario')">Gerenciar Usuários</button>
                        </li>
                        <li class="nav-item">
                            <button class="btn btn-link" onclick="toggleContent('#formPontos')">Gerenciar Pontos de Interesse</button>
                        </li>
                    </ul>
                </div>

                <!-- Conteúdo Principal -->
                <div class="col-md-10">
                    <h1 class="text-center">Painel de Controle</h1>

                    <!-- Formulário de Veículo -->
                    <div id="formVeiculo" class="form-container">
                        <h2>Gerenciar Veículos</h2>
                        <form id="veiculoForm">
                            <div class="mb-3">
                                <label for="id_veiculo" class="form-label">ID do Veículo:</label>
                                <input type="number" id="id_veiculo" name="id_veiculo" class="form-control">
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
                            <div class="mb-3">
                                <label for="id_motorista" class="form-label">ID do Motorista:</label>
                                <input type="number" id="id_motorista" name="id_motorista" class="form-control" required>
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
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Motoristas serão inseridos aqui via AJAX -->
                            </tbody>
                        </table>
                    </div>









                    <div id="formUsuario" class="form-container">
                        <h2>Gerenciar Usuários</h2>
                        <form id="UsuarioForm">
                            <div class="mb-3">
                                <label for="id_usuario" class="form-label">ID do Usuario:</label>
                                <input type="number" id="id_usuario" name="id_usuario" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for="nome_usuario" class="form-label">Nome do Usuario:</label>
                                <input type="text" id="nome_usuario" name="nome_usuario" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="senha_usuario" class="form-label">Senha do Usuario:</label>
                                <input type="password" id="senha_usuario" name="senha_usuario" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="tipo_usuario" class="form-label">Tipo do Usuário:</label>
                                <select id="tipo_usuario" name="tipo_usuario" class="form-select" required>
                                    <option value="" disabled selected>Escolha o tipo de usuário</option>
                                    <option value="ADMIN">ADMIN</option>
                                    <option value="USER">USER</option>
                                </select>
                            </div>



                            <div class="mb-3">
                                <label for="id_motorista2" class="form-label">Motorista (opcional):</label>
                                <select id="id_motorista2" name="id_motorista2" class="form-select">
                                    <option value="" disabled selected>Escolha um Usuário</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </form>

                        <h3 class="mt-4">Lista de Usuarios</h3>
                        <table id="tabelaUsuarios" class="table table-hover mt-3">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Senha</th>
                                    <th>Tipo</th>
                                    <th>Motorista</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Usuarios serão inseridos aqui via AJAX -->
                            </tbody>
                        </table>
                    </div>






                    <div id="formPontos" class="form-container">
                        <h2>Gerenciar Pontos</h2>
                        <form id="PontoForm">
                            <div class="mb-3">
                                <label for="id_ponto" class="form-label">ID do Ponto:</label>
                                <input type="number" id="id_ponto" name="id_ponto" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for="nome_ponto" class="form-label">Nome do Ponto:</label>
                                <input type="text" id="nome_ponto" name="nome_ponto" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="ano_adicao" class="form-label">Ano de Adição:</label>
                                <input type="number" id="ano_adicao" name="ano_adicao" class="form-control" min="1900" max="2099" step="1" required>
                            </div>

                            <div class="mb-3">
                                <label for="cidade" class="form-label">Cidade:</label>
                                <input type="text" id="cidade" name="cidade" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="longitude" class="form-label">Longitude:</label>
                                <input type="number" id="longitude" name="longitude" class="form-control" step="0.00000001" required>
                            </div>

                            <div class="mb-3">
                                <label for="latitude" class="form-label">Latitude:</label>
                                <input type="number" id="latitude" name="latitude" class="form-control" step="0.00000001" required>
                            </div>

                            <div class="mb-3">
                                <label for="endereco" class="form-label">Endereço:</label>
                                <input type="text" id="endereco" name="endereco" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="preco1" class="form-label">Preço 1:</label>
                                <input type="number" id="preco1" name="preco1" class="form-control" step="0.01" required>
                            </div>

                            <div class="mb-3">
                                <label for="preco2" class="form-label">Preço 2:</label>
                                <input type="number" id="preco2" name="preco2" class="form-control" step="0.01" required>
                            </div>

                            <div class="mb-3">
                                <label for="preco3" class="form-label">Preço 3:</label>
                                <input type="number" id="preco3" name="preco3" class="form-control" step="0.01" required>
                            </div>

                            <div class="mb-3">
                                <label for="preco4" class="form-label">Preço 4:</label>
                                <input type="number" id="preco4" name="preco4" class="form-control" step="0.01" required>
                            </div>

                            <div class="mb-3">
                                <label for="preco5" class="form-label">Preço 5:</label>
                                <input type="number" id="preco5" name="preco5" class="form-control" step="0.01" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </form>

                        <h3 class="mt-4">Lista de Pontos</h3>
                        <table id="tabelaPontos" class="table table-hover mt-3">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Ano de Adição</th>
                                    <th>Cidade</th>
                                    <th>Longitude</th>
                                    <th>Latitude</th>
                                    <th>Endereço</th>
                                    <th>Preços</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Pontos serão inseridos aqui via AJAX -->
                            </tbody>
                        </table>








                    </div>

                    <!-- Tabelas -->
                    <div id="tabelas" class="form-container">
                        <h2>Listagem de Tabelas do Banco de Dados</h2>
                        <ul id="tablesList"></ul>
                    </div>
                </div>
            </div>
        </div>

    </div>







































    <br>
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

            // Função para carregar veículos na tabela
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

            // Salvar veículo
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

        function editarVeiculo(id_veiculo) {
            $.ajax({
                url: '../veiculo/get_veiculo.php',
                method: 'GET',
                data: {
                    id_veiculo: id_veiculo
                },
                dataType: 'json',
                success: function(veiculo) {

                    $('#id_veiculo').val(veiculo.id_veiculo);
                    $('#ano_modelo').val(veiculo.ano_modelo);
                    $('#nome_veiculo').val(veiculo.nome_veiculo);
                    $('#placa_veiculo').val(veiculo.placa_veiculo);
                    $('#media_veiculo').val(veiculo.media_veiculo);

                    // Atualizar o select de categorias para a categoria do veículo
                    $('#id_categoria').val(veiculo.id_categoria); // Seleciona a categoria do veículo no select
                }
            });
        }


        // Função para deletar o veículo
        function deletarVeiculo(id_veiculo) {
            if (confirm("Tem certeza que deseja deletar este Veiculo?")) {
                $.ajax({
                    url: '../veiculo/deletar_veiculo.php',
                    method: 'POST',
                    data: {
                        id_veiculo: id_veiculo
                    },
                    success: function(response) {
                        console.log('Veículo deletado com sucesso!');
                    },
                    error: function(response) {
                        console.log('Erro ao deletar o veículo:', response);
                    }
                });
            }
        }
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








            // Função para carregar a lista de motoristas
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
                        <td>
                            <button class="btn btn-sm btn-warning me-1" onclick="editarMotorista(${motorista.id_motorista})">Editar</button>
                            <button class="btn btn-sm btn-danger" onclick="deletarMotorista(${motorista.id_motorista})">Deletar</button>
                        </td>
                    </tr>`;
                        });
                        $('#tabelaMotoristas tbody').html(linhas);
                    }
                });
            }

            // Função para salvar motorista (adicionar ou editar)
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

            // Função para editar motorista
            window.editarMotorista = function(id_motorista) {
                $.ajax({
                    url: '../motorista/get_motorista.php',
                    method: 'GET',
                    data: {
                        id_motorista: id_motorista
                    },
                    dataType: 'json',
                    success: function(motorista) {
                        $('#id_motorista').val(motorista.id_motorista);
                        $('#nome_motorista').val(motorista.nome_motorista);
                        $('#idade_motorista').val(motorista.idade_motorista);
                        $('#cnh').val(motorista.cnh);
                        $('#id_veiculo').val(motorista.id_veiculo); // Seleciona o veículo correto
                    }
                });
            };

            // Função para deletar motorista
            window.deletarMotorista = function(id_motorista) {
                if (confirm('Tem certeza que deseja deletar este motorista?')) {
                    $.ajax({
                        url: '../motorista/deletar_motorista.php',
                        method: 'POST',
                        data: {
                            id_motorista: id_motorista
                        },
                        success: function(response) {
                            carregarMotoristas();
                        },
                        error: function(response) {
                            console.log('Erro:', response);
                        }
                    });
                }
            };
        });
    </script>










    <script>
        $(document).ready(function() {
            carregarMotoristas2(); // Carregar motoristas para o select de motoristas no formulário de usuários
            carregarUsuarios();
            // Função para carregar a lista de motoristas
            function carregarMotoristas2() {
                $.ajax({
                    url: '../motorista/motoristas.php', // URL que retorna a lista de motoristas
                    method: 'GET',
                    dataType: 'json',
                    success: function(motoristas) {
                        // Preenche o select com motoristas
                        $('#id_motorista2').empty();
                        $('#id_motorista2').append(new Option('Escolha um motorista', '', true, false));

                        motoristas.forEach(function(motorista) {
                            $('#id_motorista2').append(new Option(`${motorista.nome_motorista} (${motorista.id_motorista})`, motorista.id_motorista));
                        });
                    },
                    error: function(xhr, status, error) {
                        console.log('Erro ao carregar os motoristas:', error);
                    }
                });
            }

            // Função para salvar ou editar usuário (com associação de motorista, se houver)
            $('#UsuarioForm').on('submit', function(e) {
                e.preventDefault();
                let dados = $(this).serialize(); // Serializa o formulário para envio

                $.ajax({
                    url: '../usuario/salvar_usuario.php', // URL que processa o salvar de um usuário
                    method: 'POST',
                    data: dados,
                    success: function(response) {
                        // Após salvar, pode-se recarregar a lista de usuários ou fornecer feedback
                        alert('Usuário salvo com sucesso!');
                        carregarUsuarios(); // Opcional: carregar a lista de usuários
                        $('#UsuarioForm')[0].reset(); // Limpa o formulário
                    },
                    error: function(response) {
                        console.log('Erro:', response);
                    }
                });
            });

            // Função para carregar a lista de usuários
            function carregarUsuarios() {
                $.ajax({
                    url: '../usuario/usuarios.php', // URL que retorna a lista de usuários
                    method: 'GET',
                    dataType: 'json',
                    success: function(usuarios) {
                        let linhas = '';
                        usuarios.forEach(function(usuario) {
                            // Aqui você exibe a tabela de usuários, incluindo o motorista associado
                            let motorista = usuario.id_motorista ? usuario.id_motorista : 'Não associado';
                            linhas += `<tr>
                            <td>${usuario.id_usuario}</td>
                            <td>${usuario.nome_usuario}</td>
                            <td>${usuario.senha_usuario}</td>
                            <td>${usuario.tipo_usuario}</td>
                            <td>${motorista}</td>
                            <td>
                                <button class="btn btn-sm btn-warning me-1" onclick="editarUsuario(${usuario.id_usuario})">Editar</button>
                                <button class="btn btn-sm btn-danger" onclick="deletarUsuario(${usuario.id_usuario})">Deletar</button>
                            </td>
                        </tr>`;
                        });
                        $('#tabelaUsuarios tbody').html(linhas);
                    },
                    error: function(xhr, status, error) {
                        console.log('Erro ao carregar usuários:', error);
                    }
                });
            }

            // Função para editar usuário
            window.editarUsuario = function(id_usuario) {
                $.ajax({
                    url: '../usuario/get_usuario.php',
                    method: 'GET',
                    data: {
                        id_usuario: id_usuario
                    },
                    dataType: 'json',
                    success: function(usuario) {
                        $('#id_usuario').val(usuario.id_usuario);
                        $('#nome_usuario').val(usuario.nome_usuario);
                        $('#senha_usuario').val(usuario.senha_usuario);
                        $('#tipo_usuario').val(usuario.tipo_usuario); // Pode ser ajustado conforme a lógica do tipo de usuário
                        $('#id_motorista2').val(usuario.id_motorista); // Preenche o select de motorista com a opção associada
                    }
                });
            };

            // Função para deletar usuário
            window.deletarUsuario = function(id_usuario) {
                if (confirm('Tem certeza que deseja deletar este usuário?')) {
                    $.ajax({
                        url: '../usuario/deletar_usuario.php',
                        method: 'POST',
                        data: {
                            id_usuario: id_usuario
                        },
                        success: function(response) {
                            carregarUsuarios();
                        },
                        error: function(response) {
                            console.log('Erro:', response);
                        }
                    });
                }
            };
        });
    </script>

















    <script>
        $(document).ready(function() {

            carregarPontosList();

            // Função para salvar ou editar ponto
            $('#PontoForm').on('submit', function(e) {
                e.preventDefault();
                let dados = $(this).serialize(); // Serializa o formulário para envio

                $.ajax({
                    url: '../ponto/salvar_ponto.php', // URL que processa o salvar de um ponto
                    method: 'POST',
                    data: dados,
                    success: function(response) {
                        // Após salvar, pode-se recarregar a lista de pontos ou fornecer feedback
                        alert('Ponto salvo com sucesso!');
                        carregarPontosList(); // Opcional: carregar a lista de pontos
                        $('#PontoForm')[0].reset(); // Limpa o formulário
                    },
                    error: function(response) {
                        console.log('Erro:', response);
                    }
                });
            });

            // Função para carregar a lista de pontos
            function carregarPontosList() {
                $.ajax({
                    url: '../ponto/pontos.php', // URL que retorna a lista de pontos
                    method: 'GET',
                    dataType: 'json',
                    success: function(pontos) {
                        let linhas = '';
                        pontos.forEach(function(ponto) {
                            // Exibe a tabela de pontos
                            linhas += `<tr>
                        <td>${ponto.id_ponto}</td>
                        <td>${ponto.nome_ponto}</td>
                        <td>${ponto.ano_adicao}</td>
                        <td>${ponto.cidade}</td>
                        <td>${ponto.longitude}</td>
                        <td>${ponto.latitude}</td>
                        <td>${ponto.endereco}</td>
                        <td>Preço 1: ${ponto.preco1}, Preço 2: ${ponto.preco2}, Preço 3: ${ponto.preco3}, Preço 4: ${ponto.preco4}, Preço 5: ${ponto.preco5}</td>
                        <td>
                            <button class="btn btn-sm btn-warning me-1" onclick="editarPonto(${ponto.id_ponto})">Editar</button>
                            <button class="btn btn-sm btn-danger" onclick="deletarPonto(${ponto.id_ponto})">Deletar</button>
                        </td>
                    </tr>`;
                        });
                        $('#tabelaPontos tbody').html(linhas);
                    },
                    error: function(xhr, status, error) {
                        console.log('Erro ao carregar pontos:', error);
                    }
                });
            }

            // Função para editar ponto
            window.editarPonto = function(id_ponto) {
                $.ajax({
                    url: '../ponto/get_ponto.php',
                    method: 'GET',
                    data: {
                        id_ponto: id_ponto
                    },
                    dataType: 'json',
                    success: function(ponto) {
                        $('#id_ponto').val(ponto.id_ponto);
                        $('#nome_ponto').val(ponto.nome_ponto);
                        $('#ano_adicao').val(ponto.ano_adicao);
                        $('#cidade').val(ponto.cidade);
                        $('#longitude').val(ponto.longitude);
                        $('#latitude').val(ponto.latitude);
                        $('#endereco').val(ponto.endereco);
                        $('#preco1').val(ponto.preco1);
                        $('#preco2').val(ponto.preco2);
                        $('#preco3').val(ponto.preco3);
                        $('#preco4').val(ponto.preco4);
                        $('#preco5').val(ponto.preco5);
                    }
                });
            };

            // Função para deletar ponto
            window.deletarPonto = function(id_ponto) {
                if (confirm('Tem certeza que deseja deletar este ponto?')) {
                    $.ajax({
                        url: '../ponto/deletar_ponto.php',
                        method: 'POST',
                        data: {
                            id_ponto: id_ponto
                        },
                        success: function(response) {
                            carregarPontosList();
                        },
                        error: function(response) {
                            console.log('Erro:', response);
                        }
                    });
                }
            };
        });
    </script>
















    <script>
        $(document).ready(function() {
            function carregartables() {
                //  $('#loadTables').on('click', function () {
                $.ajax({
                    url: '../tabelas/php2.php',
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