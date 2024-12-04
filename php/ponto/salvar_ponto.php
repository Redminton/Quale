<?php
include '../config.php';
include 'Ponto.php'; // Incluindo a classe Ponto

// Criando uma instância da classe Ponto
$ponto = new Ponto($pdo);

// Atribuindo os valores dos campos do formulário
$ponto->setIdPonto($_POST['id_ponto'] ?? null);       // ID do ponto (caso seja uma atualização)
$ponto->setNomePonto($_POST['nome_ponto']);            // Nome do ponto
$ponto->setAnoAdicao($_POST['ano_adicao']);            // Ano de adição
$ponto->setCidade($_POST['cidade']);                   // Cidade
$ponto->setLongitude($_POST['longitude']);             // Longitude
$ponto->setLatitude($_POST['latitude']);               // Latitude
$ponto->setEndereco($_POST['endereco']);               // Endereço
$ponto->setPreco1($_POST['preco1']);                   // Preço 1
$ponto->setPreco2($_POST['preco2']);                   // Preço 2
$ponto->setPreco3($_POST['preco3']);                   // Preço 3
$ponto->setPreco4($_POST['preco4']);                   // Preço 4
$ponto->setPreco5($_POST['preco5']);                   // Preço 5

// Salvando ou atualizando os dados do ponto
$ponto->save();
