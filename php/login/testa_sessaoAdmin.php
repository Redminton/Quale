<?php
session_start(); //php, eu quero trabalhar com sessão, caso exista
// Verifica se o usuário está logado
if (!isset($_SESSION['nome']) || !isset($_SESSION['tipo']) || $_SESSION['tipo'] !== 'admin') {
    // Redireciona para a página de login ou inicial do usuário comum
    header("Location: conectar.php");
    exit();
}
