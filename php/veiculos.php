<?php
include 'config.php';
include 'Veiculo.php';
$veiculo = new Veiculo($pdo);
$veiculos = $veiculo->getAll();
echo json_encode($veiculos);
