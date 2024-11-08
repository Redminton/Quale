<?php

class Motorista
{
    private $pdo;
    private $id_motorista;
    private $nome_motorista;
    private $cpf_motorista;
    private $cnh_motorista;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

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

    public function getCpfMotorista()
    {
        return $this->cpf_motorista;
    }

    public function setCpfMotorista($cpf_motorista)
    {
        $this->cpf_motorista = $cpf_motorista;
    }

    public function getCnhMotorista()
    {
        return $this->cnh_motorista;
    }

    public function setCnhMotorista($cnh_motorista)
    {
        $this->cnh_motorista = $cnh_motorista;
    }

    // Método para obter todos os motoristas
    public function getAll()
    {
        $query = $this->pdo->query("SELECT * FROM motorista");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para salvar um novo motorista
    public function save()
    {
        $stmt = $this->pdo->prepare("INSERT INTO motorista (nome_motorista, cpf_motorista, cnh_motorista) VALUES (?, ?, ?)");
        return $stmt->execute([$this->nome_motorista, $this->cpf_motorista, $this->cnh_motorista]);
    }

    // Método para editar um motorista existente
    public function update($id_motorista)
    {
        $stmt = $this->pdo->prepare("UPDATE motorista SET nome_motorista = ?, cpf_motorista = ?, cnh_motorista = ? WHERE id_motorista = ?");
        return $stmt->execute([$this->nome_motorista, $this->cpf_motorista, $this->cnh_motorista, $id_motorista]);
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
