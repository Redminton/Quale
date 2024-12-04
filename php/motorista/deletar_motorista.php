<?php
include '../config.php';
include 'Motorista.php';

$motorista = new Motorista($pdo);
$motorista->setIdMotorista($_POST['id_motorista']);
$motorista->delete($_POST['id_motorista']);
