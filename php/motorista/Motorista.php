<?php

class Motorista
{
    private $pdo;
    private $id_motorista;
    private $nome_motorista;
    private $idade_motorista;
    private $cnh;
    private $id_veiculo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Getters e Setters
    public function getIdMotorista()
    {
        return $this->id_motorista;
    }

    public function setIdMotorista($id_motorista)
    {
        $this->id_motorista = $id_motorista;
    }

    public function getNomeMotorista()
    {
        return $this->nome_motorista;
    }

    public function setNomeMotorista($nome_motorista)
    {
        $this->nome_motorista = $nome_motorista;
    }

    public function getIdadeMotorista()
    {
        return $this->idade_motorista;
    }

    public function setIdadeMotorista($idade_motorista)
    {
        $this->idade_motorista = $idade_motorista;
    }

    public function getCnh()
    {
        return $this->cnh;
    }

    public function setCnh($cnh)
    {
        $this->cnh = $cnh;
    }

    public function getIdVeiculo()
    {
        return $this->id_veiculo;
    }

    public function setIdVeiculo($id_veiculo)
    {
        $this->id_veiculo = $id_veiculo;
    }

    // Método para obter todos os motoristas
    public function getAll()
    {
        $query = $this->pdo->query("SELECT motorista.*, veiculo.placa_veiculo 
                                    FROM motorista 
                                    LEFT JOIN veiculo ON motorista.id_veiculo = veiculo.id_veiculo");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para salvar um novo motorista ou atualizar um existente
    public function save()
    {
        if ($this->getIdMotorista()) {
            // Atualizar motorista, incluindo a associação com o veículo
            $stmt = $this->pdo->prepare("UPDATE motorista SET 
            nome_motorista = ?, 
            idade_motorista = ?, 
            cnh = ?, 
            id_veiculo = ? 
            WHERE id_motorista = ?");

            return $stmt->execute([
                $this->nome_motorista,  // Nome do motorista
                $this->idade_motorista, // Idade do motorista
                $this->cnh,             // CNH do motorista
                $this->id_veiculo,     // Veículo associado ao motorista
                $this->id_motorista     // Identificador do motorista a ser atualizado
            ]);
        } else {
            // Inserir novo motorista, com associação a um veículo
            $stmt = $this->pdo->prepare("INSERT INTO motorista 
            (nome_motorista, idade_motorista, cnh, id_veiculo) 
            VALUES (?, ?, ?, ?)");

            return $stmt->execute([
                $this->nome_motorista,  // Nome do motorista
                $this->idade_motorista, // Idade do motorista
                $this->cnh,             // CNH do motorista
                $this->id_veiculo      // Veículo associado ao motorista
            ]);
        }
    }

    // Método para deletar um motorista
    public function delete($id_motorista)
    {
        $stmt = $this->pdo->prepare("DELETE FROM motorista WHERE id_motorista = ?");
        return $stmt->execute([$id_motorista]);
    }

    // Método para obter um motorista pelo ID
    public function getById($id_motorista)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM motorista WHERE id_motorista = ?");
        $stmt->execute([$id_motorista]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
