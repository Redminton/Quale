<?php
include '../config.php';
include 'Posto.php';



$ponto = new Posto($pdo);
$pontos = $ponto->getAll();





// Gerar XML
header("Content-type: text/xml");
echo "<?xml version='1.0' ?>";
echo "<markers>";

foreach ($pontos as $row) {
    echo "<marker ";
    echo "id='" . htmlspecialchars($row['id']) . "' ";
    echo "name='" . htmlspecialchars($row['nome']) . "' ";
    echo "year_added='" . htmlspecialchars($row['ano_adicao']) . "' ";
    echo "city='" . htmlspecialchars($row['cidade']) . "' ";
    echo "lat='" . $row['latitude'] . "' ";
    echo "lng='" . $row['longitude'] . "' ";
    echo "address='" . htmlspecialchars($row['endereco']) . "' ";
    echo "price1='" . $row['preco1'] . "' ";
    echo "price2='" . $row['preco2'] . "' ";
    echo "price3='" . $row['preco3'] . "' ";
    echo "price4='" . $row['preco4'] . "' ";
    echo "price5='" . $row['preco5'] . "' ";
    echo "/>";
}

echo "</markers>";
