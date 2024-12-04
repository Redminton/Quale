<?php
include '../config.php';
include 'Motorista.php';
$motorista = new Motorista($pdo);
$motorista->setIdMotorista($_POST['id_motorista'] ?? null);
$motorista->setNomeMotorista($_POST['nome_motorista']);
$motorista->setIdadeMotorista($_POST['idade_motorista']);
$motorista->setCNH($_POST['cnh']);
$motorista->setIdVeiculo($_POST['id_veiculo2']);
$motorista->save();
