<?php
include '../config.php';
include 'Veiculo.php';

$veiculo = new Veiculo($pdo);
$id_veiculo = $_GET['id_veiculo'];

$dados_veiculo = $veiculo->getById($id_veiculo);

echo json_encode($dados_veiculo);
