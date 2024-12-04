<?php
// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conexão com o banco de dados
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

        // Consulta SQL para verificar usuário, senha e tipo
        $query = "SELECT nome_usuario, tipo FROM usuario WHERE nome_usuario = :nome AND senha = :senha";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':senha', $senha, PDO::PARAM_STR);
        $stmt->execute();

        // Verifica se há algum resultado retornado
        if ($stmt->rowCount() > 0) {  // Usuário e senha estão corretos
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            session_start(); // Inicia a sessão
            $_SESSION['nome'] = $nome;  // Vincula o nome do usuário na sessão
            $_SESSION['tipo'] = $user['tipo'];  // Armazena o tipo do usuário na sessão

            // Redireciona com base no tipo de usuário
            if ($user['tipo'] === 'admin') {
                header("Location: admin.php");  // Página inicial do administrador
            } else {
                header("Location: home.php");  // Página inicial do usuário comum
            }
            exit();
        } else {
            // Usuário ou senha incorretos
            session_start();
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
    header("Location: index.php");
    exit();
}
