<?php
include '../config.php';
include 'Usuario.php';

$usuario = new Usuario($pdo);
$usuario->setIdusuario($_POST['id_usuario']);
$usuario->delete($_POST['id_usuario']);
