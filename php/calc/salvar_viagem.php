<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['nome_usuario'])) {
    echo "Usuário não autenticado";
    exit;
}

// Conexão com o banco de dados
$host = 'localhost';
$db = 'quale';
$user = 'root';
$senha = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $senha);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Recuperar o id_motorista a partir do nome_usuario na tabela usuario
    $nomeUsuario = $_SESSION['nome_usuario'];
    $stmt = $conn->prepare("SELECT id_motorista FROM usuario WHERE nome_usuario = :nome");
    $stmt->bindParam(':nome', $nomeUsuario, PDO::PARAM_STR);
    $stmt->execute();

    if ($stmt->rowCount() == 0) {
        echo "Motorista não encontrado.";
        exit;
    }

    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
    $idMotorista = $usuario['id_motorista'];

    // Recuperar dados enviados pelo AJAX
    $origemLat = $_POST['origemLat'];
    $origemLng = $_POST['origemLng'];
    $destLat = $_POST['destLat'];
    $destLng = $_POST['destLng'];
    $distancia = $_POST['distancia'];
    $duracao = $_POST['duracao'];

    // Inserir a viagem no banco de dados
    $query = "INSERT INTO viagens (id_motorista, origemLat, origemLng, destLat, destLng, distancia, duracao) 
              VALUES (:id_motorista, :origemLat, :origemLng, :destLat, :destLng, :distancia, :duracao)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id_motorista', $idMotorista, PDO::PARAM_INT);
    $stmt->bindParam(':origemLat', $origemLat, PDO::PARAM_STR);
    $stmt->bindParam(':origemLng', $origemLng, PDO::PARAM_STR);
    $stmt->bindParam(':destLat', $destLat, PDO::PARAM_STR);
    $stmt->bindParam(':destLng', $destLng, PDO::PARAM_STR);
    $stmt->bindParam(':distancia', $distancia, PDO::PARAM_STR);
    $stmt->bindParam(':duracao', $duracao, PDO::PARAM_STR);
    $stmt->execute();

    echo "Viagem salva com sucesso!";
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
