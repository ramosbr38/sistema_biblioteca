<?php
require_once '../../controle/EmprestimoControle.php';
$controle = new EmprestimoControle();

$id = $_GET['id'] ?? null;
$emprestimo = [
  'id' => '',
  'id_livro' => '',
  'id_autor' => '',
  'nome_usuario' => '',
  'data_emprestimo' => '',
  'data_devolucao' => ''
];

$livros = $controle->listarLivros();
$autores = $controle->listarAutores();

if ($id) {
    $emprestimo = $controle->buscarPorId($id);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $novo = new stdClass();
    $novo->id = $_POST['id'] ?? null;
    $novo->id_livro = $_POST['id_livro'];
    $novo->id_autor = $_POST['id_autor'];
    $novo->nome_usuario = $_POST['nome_usuario'];
    $novo->data_emprestimo = $_POST['data_emprestimo'];
    $novo->data_devolucao = $_POST['data_devolucao'];
    $controle->salvar($novo);
    header('Location: listar.php');
    exit;
}

if (isset($_GET['excluir'])) {
    $controle->excluir($_GET['excluir']);
    header('Location: listar.php');
    exit;
}
?>

<link rel="stylesheet" href="../../css/estilo.css">
<div class="container">
    <div id="welcome" style="margin-bottom: 15px; font-weight: bold;"></div>
  <h2><?= $id ? 'Editar Empréstimo' : 'Cadastro de Empréstimo' ?></h2>
  <div id="weather" style="margin-bottom: 15px; font-weight: bold;"></div>
  <form method="post">
    <input type="hidden" name="id" value="<?= $emprestimo['id'] ?>">

    <select name="id_livro" required>
      <option value="">Selecione um livro</option>
      <?php foreach ($livros as $livro): ?>
        <option value="<?= $livro['id'] ?>" <?= $livro['id'] == $emprestimo['id_livro'] ? 'selected' : '' ?>>
          <?= htmlspecialchars($livro['titulo']) ?>
        </option>
      <?php endforeach; ?>
    </select>

    <select name="id_autor" required>
      <option value="">Selecione um autor</option>
      <?php foreach ($autores as $autor): ?>
        <option value="<?= $autor['id'] ?>" <?= $autor['id'] == $emprestimo['id_autor'] ? 'selected' : '' ?>>
          <?= htmlspecialchars($autor['nome']) ?>
        </option>
      <?php endforeach; ?>
    </select>

    <input type="text" name="nome_usuario" placeholder="Nome do Usuário" value="<?= htmlspecialchars($emprestimo['nome_usuario']) ?>" required>
    <input type="date" name="data_emprestimo" value="<?= $emprestimo['data_emprestimo'] ?>" required>
    <input type="date" name="data_devolucao" value="<?= $emprestimo['data_devolucao'] ?>" required>

    <button type="submit">Salvar</button>
  </form>
  <a href="listar.php">Voltar à tela inicial</a>
  <script src="../../js/script.js"></script>
</div>