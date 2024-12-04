<?php
include '../config.php';
include 'Ponto.php';



$ponto = new Ponto($pdo);
$pontos = $ponto->getAll();
echo json_encode($pontos);
