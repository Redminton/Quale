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

    // Recuperar o id da viagem inserida
    $idViagem = $conn->lastInsertId();

    // Recuperar os dados necessários para o cálculo do valor do combustível
    $stmt = $conn->prepare("SELECT ve.media_veiculo, p.preco1
FROM veiculo ve
JOIN motorista m ON ve.id_veiculo = m.id_veiculo
JOIN ponto p ON 1 = 1 -- Ajuste isso conforme a lógica do seu sistema (ex: buscar um ponto específico)
WHERE m.id_motorista = :id_motorista");
    $stmt->bindParam(':id_motorista', $idMotorista, PDO::PARAM_INT);
    $stmt->execute();

    if ($stmt->rowCount() == 0) {
        echo "Dados do veículo ou ponto de combustível não encontrados.";
        exit;
    }

    $dados = $stmt->fetch(PDO::FETCH_ASSOC);
    $mediaVeiculo = $dados['media_veiculo'];
    $precoCombustivel = $dados['preco1'];

    // Calcular o valor do combustível
    $distanciaNumerica = floatval(str_replace(' km', '', $distancia)); // Remove " km" e converte para número
    $valorCombustivel = ($distanciaNumerica / $mediaVeiculo) * $precoCombustivel;

    // Atualizar o valor do combustível na tabela viagens
    $updateQuery = "UPDATE viagens SET val_combustivel = :val_combustivel WHERE id_viagem = :id_viagem";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bindParam(':val_combustivel', $valorCombustivel, PDO::PARAM_STR);
    $stmt->bindParam(':id_viagem', $idViagem, PDO::PARAM_INT);
    $stmt->execute();

    echo "Viagem salva e valor do combustível calculado com sucesso!";
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
