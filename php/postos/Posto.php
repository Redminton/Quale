<?php
class Posto
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAll()
    {
        $query = "SELECT id, nome, ano_adicao, cidade, longitude, latitude, endereco, preco1, preco2, preco3, preco4, preco5 FROM ponto";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
