<?php
session_start(); //php, eu quero trabalhar com sessão, caso exista
// Verifica se o usuário está logado
if ($_SESSION['nome_usuario'] == null) {
    // Se não estiver, redireciona de volta para a página de login
    header("Location: conectar.php");
    exit();
}
