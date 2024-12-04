<?php
include '../config.php';
include 'Veiculo.php';

$veiculo = new Veiculo($pdo);
$veiculo->setIdVeiculo($_POST['id_veiculo']);
$veiculo->delete($_POST['id_veiculo']);
