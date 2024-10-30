<?php
include 'config.php';
include 'Motorista.php';
$motorista = new Motorista($pdo);
$motoristas = $motorista->getAll();
echo json_encode($motoristas);
