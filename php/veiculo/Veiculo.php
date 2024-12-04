<?php
class Veiculo
{
    private $pdo;
    private $id_veiculo;
    private $id_categoria;
    private $ano_modelo;
    private $nome_veiculo;
    private $placa_veiculo;
    private $media_veiculo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Getters e Setters
    public function getIdVeiculo()
    {
        return $this->id_veiculo;
    }

    public function setIdVeiculo($id_veiculo)
    {
        $this->id_veiculo = $id_veiculo;
    }

    public function getIdCategoria()
    {
        return $this->id_categoria;
    }

    public function setIdCategoria($id_categoria)
    {
        $this->id_categoria = $id_categoria;
    }

    public function getAnoModelo()
    {
        return $this->ano_modelo;
    }

    public function setAnoModelo($ano_modelo)
    {
        $this->ano_modelo = $ano_modelo;
    }

    public function getNomeVeiculo()
    {
        return $this->nome_veiculo;
    }

    public function setNomeVeiculo($nome_veiculo)
    {
        $this->nome_veiculo = $nome_veiculo;
    }

    public function getPlacaVeiculo()
    {
        return $this->placa_veiculo;
    }

    public function setPlacaVeiculo($placa_veiculo)
    {
        $this->placa_veiculo = $placa_veiculo;
    }

    public function getMediaVeiculo()
    {
        return $this->media_veiculo;
    }

    public function setMediaVeiculo($media_veiculo)
    {
        $this->media_veiculo = $media_veiculo;
    }

    // Método para obter todos os veículos (JOIN com categoria para nome da categoria)
    public function getAll()
    {
        $query = $this->pdo->query("SELECT veiculo.id_veiculo, categoriaVeiculo.nome_categoria, veiculo.ano_modelo, veiculo.nome_veiculo, veiculo.placa_veiculo, veiculo.media_veiculo
                                    FROM veiculo
                                    JOIN categoriaVeiculo ON veiculo.id_categoria = categoriaVeiculo.id_categoria");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getAll2()
    {
        $query = $this->pdo->query("SELECT SELECT id_veiculo, placa_veiculo FROM veiculo");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }



    public function save()
    {
        if ($this->getIdVeiculo()) {
            $stmt = $this->pdo->prepare("UPDATE  veiculo SET id_categoria = ?, ano_modelo = ?, nome_veiculo= ?, placa_veiculo= ?, media_veiculo= ? WHERE id_veiculo = ?");
            return $stmt->execute([$this->id_categoria, $this->ano_modelo, $this->nome_veiculo, $this->placa_veiculo, $this->media_veiculo, $this->id_veiculo]);
        } else {
            $stmt = $this->pdo->prepare("INSERT INTO veiculo (id_categoria, ano_modelo, nome_veiculo, placa_veiculo, media_veiculo) VALUES (?, ?, ?, ?, ?)");
            return $stmt->execute([$this->id_categoria, $this->ano_modelo, $this->nome_veiculo, $this->placa_veiculo, $this->media_veiculo]);
        }
    }
    // Método para editar um veículo existente
    public function update($id_veiculo)
    {
        $stmt = $this->pdo->prepare("UPDATE veiculo SET id_categoria = ?, ano_modelo = ?, nome_veiculo = ?, placa_veiculo = ?, media_veiculo = ? WHERE id_veiculo = ?");
        return $stmt->execute([$this->id_categoria, $this->ano_modelo, $this->nome_veiculo, $this->placa_veiculo, $this->media_veiculo, $id_veiculo]);
    }

    // Método para deletar um veículo
    public function delete($id_veiculo)
    {
        $stmt = $this->pdo->prepare("DELETE FROM veiculo WHERE id_veiculo = ?");
        return $stmt->execute([$id_veiculo]);
    }

    // Método para obter um veículo pelo ID
    public function getById($id_veiculo)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM veiculo WHERE id_veiculo = ?");
        $stmt->execute([$id_veiculo]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
