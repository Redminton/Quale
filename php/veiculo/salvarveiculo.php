<?php
include '../config.php';
include 'Veiculo.php';
$veiculo = new Veiculo($pdo);

$veiculo->setIdVeiculo($_POST['id_veiculo'] ?? null);
$veiculo->setIdCategoria($_POST['id_categoria']);
$veiculo->setAnoModelo($_POST['ano_modelo']);
$veiculo->setNomeVeiculo($_POST['nome_veiculo']);
$veiculo->setPlacaVeiculo($_POST['placa_veiculo']);
$veiculo->setMediaVeiculo($_POST['media_veiculo']);

$veiculo->save();
