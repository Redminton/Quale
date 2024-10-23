<?php
include 'config.php';

$pdo = $conn;



if ($conn->connect_error) {
    die('Erro de Conexão: ' . $conn->connect_error);
}

// Busca todas as tabelas do banco de dados
$query = "SHOW TABLES";
$result = $conn->query($query);

// Verifica e retorna as tabelas em formato JSON
if ($result->num_rows > 0) {
    $tables = [];
    while ($row = $result->fetch_array()) {
        $tables[] = $row[0];
    }
    echo json_encode($tables);
} else {
    echo json_encode(['error' => 'Nenhuma tabela encontrada.']);
}

// Fecha a conexão
$conn->close();
