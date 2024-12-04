<?php
include '../config.php';
include 'Ponto.php';

$ponto = new Ponto($pdo);
$id_ponto = $_GET['id_ponto'];

$dados_ponto = $ponto->getById($id_ponto);

echo json_encode($dados_ponto);
