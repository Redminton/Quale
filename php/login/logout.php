<?php
session_start();
// Destroi a sessão
session_destroy();  //"mata a session e as variaveis vinculadas"
session_unset(); //tira as variáveis da memória
// Redireciona para a página de login
header("Location: conectar.php");
exit();
