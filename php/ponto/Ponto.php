<?php
class Ponto
{
    private $pdo;
    private $id_ponto;
    private $nome_ponto;
    private $ano_adicao;
    private $cidade;
    private $longitude;
    private $latitude;
    private $endereco;
    private $preco1;
    private $preco2;
    private $preco3;
    private $preco4;
    private $preco5;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Getters e Setters
    public function getIdPonto()
    {
        return $this->id_ponto;
    }

    public function setIdPonto($id_ponto)
    {
        $this->id_ponto = $id_ponto;
    }

    public function getNomePonto()
    {
        return $this->nome_ponto;
    }

    public function setNomePonto($nome_ponto)
    {
        $this->nome_ponto = $nome_ponto;
    }

    public function getAnoAdicao()
    {
        return $this->ano_adicao;
    }

    public function setAnoAdicao($ano_adicao)
    {
        $this->ano_adicao = $ano_adicao;
    }

    public function getCidade()
    {
        return $this->cidade;
    }

    public function setCidade($cidade)
    {
        $this->cidade = $cidade;
    }

    public function getLongitude()
    {
        return $this->longitude;
    }

    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }

    public function getLatitude()
    {
        return $this->latitude;
    }

    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    }

    public function getEndereco()
    {
        return $this->endereco;
    }

    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;
    }

    public function getPreco1()
    {
        return $this->preco1;
    }

    public function setPreco1($preco1)
    {
        $this->preco1 = $preco1;
    }

    public function getPreco2()
    {
        return $this->preco2;
    }

    public function setPreco2($preco2)
    {
        $this->preco2 = $preco2;
    }

    public function getPreco3()
    {
        return $this->preco3;
    }

    public function setPreco3($preco3)
    {
        $this->preco3 = $preco3;
    }

    public function getPreco4()
    {
        return $this->preco4;
    }

    public function setPreco4($preco4)
    {
        $this->preco4 = $preco4;
    }

    public function getPreco5()
    {
        return $this->preco5;
    }

    public function setPreco5($preco5)
    {
        $this->preco5 = $preco5;
    }

    // Método para obter todos os pontos
    public function getAll()
    {
        $query = $this->pdo->query("SELECT * FROM ponto");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para salvar um novo ponto ou atualizar um existente
    public function save()
    {
        if ($this->getIdPonto()) {

            $stmt = $this->pdo->prepare("UPDATE ponto SET
nome_ponto = ?,
ano_adicao = ?,
cidade = ?,
longitude = ?,
latitude = ?,
endereco = ?,
preco1 = ?,
preco2 = ?,
preco3 = ?,
preco4 = ?,
preco5 = ?
WHERE id_ponto = ?");

            return $stmt->execute([
                $this->nome_ponto, // Nome do ponto
                $this->ano_adicao, // Ano de adição do ponto
                $this->cidade, // Cidade
                $this->longitude, // Longitude
                $this->latitude, // Latitude
                $this->endereco, // Endereço
                $this->preco1, // Preço 1
                $this->preco2, // Preço 2
                $this->preco3, // Preço 3
                $this->preco4, // Preço 4
                $this->preco5, // Preço 5
                $this->id_ponto // ID do ponto a ser atualizado
            ]);
        } else {
            // Inserir novo ponto
            $stmt = $this->pdo->prepare("INSERT INTO ponto
(nome_ponto, ano_adicao, cidade, longitude, latitude, endereco, preco1, preco2, preco3, preco4, preco5)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

            return $stmt->execute([
                $this->nome_ponto, // Nome do ponto
                $this->ano_adicao, // Ano de adição do ponto
                $this->cidade, // Cidade
                $this->longitude, // Longitude
                $this->latitude, // Latitude
                $this->endereco, // Endereço
                $this->preco1, // Preço 1
                $this->preco2, // Preço 2
                $this->preco3, // Preço 3
                $this->preco4, // Preço 4
                $this->preco5 // Preço 5
            ]);
        }
    }

    // Método para deletar um ponto
    public function delete($id_ponto)
    {
        $stmt = $this->pdo->prepare("DELETE FROM ponto WHERE id_ponto = ?");
        return $stmt->execute([$id_ponto]);
    }

    // Método para obter um ponto pelo ID
    public function getById($id_ponto)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM ponto WHERE id_ponto = ?");
        $stmt->execute([$id_ponto]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
