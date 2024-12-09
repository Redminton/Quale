<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Qualé Login</title>
    <link rel="shortcut icon" type="imagex/png" href="../../img/logo.png">
    <style>
        body {
            background-color: #D3F8E2;
        }

        .card-header {
            text-align: center;
        }

        .card-body {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .d-flex {
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .rodape {
            background-color: #198754;
            text-align: center;
            padding: 10px;
            color: white;
            position: fixed;
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
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Login</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-center w-100">
                            <img src="../../img/logo.png" alt="Logo" style="height: auto; max-width: 50px;">
                            <h5 class="ms-2 mb-0">Qualé</h5>
                        </div>

                        <form action="login.php" method="POST" class="w-100">
                            <div class="form-group">
                                <label for="nome">Usuário</label>
                                <input type="text" name="nome" id="nome" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="senha">Senha</label>
                                <input type="password" name="senha" id="senha" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Entrar</button>
                        </form>
                        <a href="../usuario/usuario.html" class="w-100">
                            <button class="btn btn-secondary w-100 mt-2">Cadastrar</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="rodape">
        <h5>Confira mais projetos By <a href="https://redminton.github.io" target="_blank">redminton.cloud!</a></h5>
    </div>

</body>

</html>