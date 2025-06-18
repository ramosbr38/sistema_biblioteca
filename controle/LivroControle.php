<?php
require_once __DIR__ . '/../modelo/Livro.php';
require_once __DIR__ . '/../conexao/Conexao.php';
class LivroControle {
    private $conn;

    public function __construct() {
        $this->conn = Conexao::getConexao();
    }

    public function listar() {
        $sql = "SELECT livros.*, autores.nome as nome_autor FROM livros 
                JOIN autores ON livros.id_autor = autores.id";
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function salvar($livro) {
        if ($livro->id) {
            $sql = "UPDATE livros SET titulo=?, ano_publicacao=?, editora=?, status_leitura=?, id_autor=? WHERE id=?";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([
                $livro->titulo, $livro->ano_publicacao, $livro->editora,
                $livro->status_leitura, $livro->id_autor, $livro->id
            ]);
        } else {
            $sql = "INSERT INTO livros (titulo, ano_publicacao, editora, status_leitura, id_autor) VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([
                $livro->titulo, $livro->ano_publicacao, $livro->editora,
                $livro->status_leitura, $livro->id_autor
            ]);
        }
    }

    public function excluir($id) {
        $stmt = $this->conn->prepare("DELETE FROM livros WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function buscarPorId($id) {
        $stmt = $this->conn->prepare("SELECT * FROM livros WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function listarAutores() {
        $stmt = $this->conn->query("SELECT * FROM autores");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
