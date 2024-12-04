<?php
// Configuração da conexão com o banco de dados
include 'config.php'; // Este arquivo deve conter as configurações de conexão com o banco de dados

class Ponto
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Método para buscar todos os pontos de interesse
    public function getAll()
    {
        $query = "SELECT id, nome, ano_adicao, cidade, longitude, latitude, endereco, preco1, preco2, preco3, preco4, preco5 FROM ponto";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

// Criar a instância da classe Ponto e buscar os dados
$ponto = new Ponto($pdo);
$pontos = $ponto->getAll();

// Gerar XML com os dados dos pontos
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
