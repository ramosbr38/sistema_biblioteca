<?php
require_once(__DIR__ . "/../modelo/Autor.php");
require_once __DIR__ . '/../conexao/Conexao.php';


class AutorControle {
    private $conn;

    public function __construct() {
        $this->conn = Conexao::getConexao();
    }

    public function listar() {
        $sql = "SELECT * FROM autores";
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function salvar($autor) {
        if ($autor->id) {
            $sql = "UPDATE autores SET nome=?, nacionalidade=?, data_nascimento=? WHERE id=?";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([$autor->nome, $autor->nacionalidade, $autor->data_nascimento, $autor->id]);
        } else {
            $sql = "INSERT INTO autores (nome, nacionalidade, data_nascimento) VALUES (?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([$autor->nome, $autor->nacionalidade, $autor->data_nascimento]);
        }
    }

    public function excluir($id) {
        $stmt = $this->conn->prepare("DELETE FROM autores WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function buscarPorId($id) {
        $stmt = $this->conn->prepare("SELECT * FROM autores WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
