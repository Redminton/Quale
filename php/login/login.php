<?php

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conexão com o banco de dados (substitua as informações conforme necessário)
    $host = 'localhost';
    $db = 'quale';
    $user = 'root';
    $senha = '';

    try {
        $conn = new PDO("mysql:host=$host;dbname=$db", $user, $senha);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Recupera os dados do formulário
        $nome = $_POST['nome'];
        $senha = $_POST['senha'];

        // Consulta SQL para verificar se o usuário e senha correspondem
        echo $query = "SELECT * FROM usuario WHERE nome_usuario = '$nome' AND senha = '$senha'";
        $stmt = $conn->prepare($query);
        $stmt->execute();

        // Verifica se há algum resultado retornado
        if ($stmt->rowCount() > 0) {  //se usuario e senha ok
            // Usuário autenticado com sucesso, redireciona para a página inicial
            session_start(); //cria a session no servidor
            $_SESSION['nome'] = $nome; //vinculando 

            header("Location: home.php");
            //exit();
        } else {
            // Caso contrário, exibe uma mensagem de erro
            $_SESSION['error'] = "Usuário ou senha incorretos";
            header("Location: conectar.php");
            exit();
        }
    } catch (PDOException $e) {
        // Em caso de erro na conexão ou consulta, exibe o erro
        echo "Erro: " . $e->getMessage();
    }
} else {
    // Se alguém tentar acessar este arquivo diretamente, redireciona para a página de login
    //header("Location: index.php");
    exit();
}
