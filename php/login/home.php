<?php
// Se o usuário estiver logado, exibe a página de boas-vindas
include './testa_sessao.php';
echo "A session ID é: ".strtoupper(session_id());
echo "<br> Seja bem vindo: -> " . $_SESSION['nome'];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bem-vindo</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                    <div class="card-body">
                        <p>Você está logado com sucesso.</p>
                        <a href="logout.php" class="btn btn-danger">Sair</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
