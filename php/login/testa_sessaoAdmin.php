<?php
session_start(); //php, eu quero trabalhar com sessão, caso exista
// Verifica se o usuário está logado
if (!isset($_SESSION['nome_usuario']) || !isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] !== 'admin') {
    // Redireciona para a página de login ou inicial do usuário comum
    header("Location: conectar.php");
    exit();
}
