<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['nome_usuario'])) {
    echo json_encode([]); // Retorna um array vazio se o usuário não estiver logado
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
        echo json_encode([]); // Retorna um array vazio se o motorista não for encontrado
        exit;
    }

    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
    $idMotorista = $usuario['id_motorista'];

    // Buscar o histórico de viagens
    $query = "SELECT id_viagem, origemLat, origemLng, destLat, destLng, distancia, duracao, data_hora, val_combustivel
              FROM viagens WHERE id_motorista = :id_motorista ORDER BY data_hora DESC"; // Ordenando por data_hora
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id_motorista', $idMotorista, PDO::PARAM_INT);
    $stmt->execute();

    $viagens = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($viagens); // Retorna as viagens no formato JSON

} catch (PDOException $e) {
    echo json_encode([]); // Retorna um array vazio em caso de erro
}
