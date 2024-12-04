<?php
include '../config.php';
include 'Ponto.php';

$ponto = new Ponto($pdo);
$ponto->setIdponto($_POST['id_ponto']);
$ponto->delete($_POST['id_ponto']);
