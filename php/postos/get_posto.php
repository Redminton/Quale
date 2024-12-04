<?php
include '../config.php';
include 'Usuario.php';

$usuario = new Usuario($pdo);
$id_usuario = $_GET['id_usuario'];

$dados_usuario = $usuario->getById($id_usuario);

echo json_encode($dados_usuario);
