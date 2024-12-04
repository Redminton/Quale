<?php

class Usuario
{
    private $pdo;
    private $id_usuario;
    private $nome_usuario;
    private $senha_usuario;
    private $tipo_usuario;
    private $id_motorista;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Getters e Setters
    public function getIdUsuario()
    {
        return $this->id_usuario;
    }

    public function setIdUsuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;
    }

    public function getNomeUsuario()
    {
        return $this->nome_usuario;
    }

    public function setNomeUsuario($nome_usuario)
    {
        $this->nome_usuario = $nome_usuario;
    }

    public function getSenhaUsuario()
    {
        return $this->senha_usuario;
    }

    public function setSenhaUsuario($senha_usuario)
    {
        $this->senha_usuario = $senha_usuario;
    }

    public function getTipoUsuario()
    {
        return $this->tipo_usuario;
    }

    public function setTipoUsuario($tipo_usuario)
    {
        $this->tipo_usuario = $tipo_usuario;
    }

    public function getIdMotorista()
    {
        return $this->id_motorista;
    }

    public function setIdMotorista($id_motorista)
    {
        $this->id_motorista = $id_motorista;
    }

    // Método para obter todos os usuários
    public function getAll()
    {
        $query = $this->pdo->query("SELECT * FROM usuario");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para salvar um novo usuário ou atualizar um existente
    public function save()
    {
        if ($this->getIdUsuario()) {
            // Atualizar usuário, incluindo a associação com o motorista (caso exista)
            $stmt = $this->pdo->prepare("UPDATE usuario SET 
            nome_usuario = ?, 
            senha_usuario = ?, 
            tipo_usuario = ?, 
            id_motorista = ? 
            WHERE id_usuario = ?");

            return $stmt->execute([
                $this->nome_usuario,      // Nome do usuário
                $this->senha_usuario,     // Senha do usuário
                $this->tipo_usuario,      // Tipo do usuário
                $this->id_motorista,      // Motorista associado (se houver)
                $this->id_usuario         // Identificador do usuário a ser atualizado
            ]);
        } else {
            // Inserir novo usuário, com possível associação a um motorista
            $stmt = $this->pdo->prepare("INSERT INTO usuario 
            (nome_usuario, senha_usuario, tipo_usuario, id_motorista) 
            VALUES (?, ?, ?, ?)");

            return $stmt->execute([
                $this->nome_usuario,      // Nome do usuário
                $this->senha_usuario,     // Senha do usuário
                $this->tipo_usuario,      // Tipo do usuário
                $this->id_motorista       // Motorista associado ao usuário (se houver)
            ]);
        }
    }

    // Método para deletar um usuário
    public function delete($id_usuario)
    {
        $stmt = $this->pdo->prepare("DELETE FROM usuario WHERE id_usuario = ?");
        return $stmt->execute([$id_usuario]);
    }

    // Método para obter um usuário pelo ID
    public function getById($id_usuario)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM usuario WHERE id_usuario = ?");
        $stmt->execute([$id_usuario]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
