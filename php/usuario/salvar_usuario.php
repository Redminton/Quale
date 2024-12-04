<?php
include '../config.php';
include 'Usuario.php';
$usuario = new usuario($pdo);
$usuario->setIdusuario($_POST['id_usuario'] ?? null);
$usuario->setNomeusuario($_POST['nome_usuario']);
$usuario->setSenhaUsuario($_POST['senha_usuario']);
$usuario->setTipoUsuario($_POST['tipo_usuario']);
$usuario->setIdMotorista($_POST['id_motorista2']);
$usuario->save();
