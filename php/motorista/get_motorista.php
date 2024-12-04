<?php
include '../config.php';
include 'Motorista.php';

$motorista = new Motorista($pdo);
$id_motorista = $_GET['id_motorista'];

$dados_motorista = $motorista->getById($id_motorista);

echo json_encode($dados_motorista);
