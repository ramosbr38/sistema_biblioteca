<?php
require_once __DIR__ . '/../modelo/Emprestimo.php';
require_once __DIR__ . '/../conexao/Conexao.php';

class EmprestimoControle {
    private $conn;

    public function __construct() {
        $this->conn = Conexao::getConexao();
    }

    public function listar() {
        $sql = "SELECT e.*, l.titulo AS titulo_livro, a.nome AS nome_autor
                FROM emprestimos e
                JOIN livros l ON e.id_livro = l.id
                JOIN autores a ON e.id_autor = a.id";
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function salvar($emprestimo) {
        if (!empty($emprestimo->id)) {
            $sql = "UPDATE emprestimos
                      SET id_livro = ?, id_autor = ?, nome_usuario = ?, data_emprestimo = ?, data_devolucao = ?
                      WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([
                $emprestimo->id_livro,
                $emprestimo->id_autor,
                $emprestimo->nome_usuario,
                $emprestimo->data_emprestimo,
                $emprestimo->data_devolucao,
                $emprestimo->id
            ]);
        } else {
            $sql = "INSERT INTO emprestimos (id_livro, id_autor, nome_usuario, data_emprestimo, data_devolucao)
                      VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([
                $emprestimo->id_livro,
                $emprestimo->id_autor,
                $emprestimo->nome_usuario,
                $emprestimo->data_emprestimo,
                $emprestimo->data_devolucao
            ]);
        }
    }

    public function excluir($id) {
        $stmt = $this->conn->prepare("DELETE FROM emprestimos WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function buscarPorId($id) {
        $stmt = $this->conn->prepare("SELECT * FROM emprestimos WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function listarLivros() {
        $stmt = $this->conn->query("SELECT * FROM livros");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listarAutores() {
        $stmt = $this->conn->query("SELECT * FROM autores");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}