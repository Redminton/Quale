<?php
include 'config.php';


try {
    $query = "SHOW TABLES";
    $stmt = $pdo->query($query);

    // Verifica e retorna as tabelas em formato JSON
    if ($stmt->rowCount() > 0) {
        $tables = [];
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $tables[] = $row[0];
        }
        echo json_encode($tables);
    } else {
        echo json_encode(['error' => 'Nenhuma tabela encontrada.']);
    }
} catch (PDOException $e) {
    echo json_encode(['error' => 'Erro de Conexão: ' . $e->getMessage()]);
}

$pdo = null;
