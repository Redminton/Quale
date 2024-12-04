<?php
include '../config.php';
include 'Usuario.php';
$usuario = new Usuario($pdo);
$usuarios = $usuario->getAll();
echo json_encode($usuarios);
