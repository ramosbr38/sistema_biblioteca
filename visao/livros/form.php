<?php
require_once '../../controle/LivroControle.php';
$controle = new LivroControle();

$id = $_GET['id'] ?? null;
$livro = ['id' => '', 'titulo' => '', 'ano_publicacao' => '', 'editora' => '', 'status_leitura' => '', 'id_autor' => ''];
$autores = $controle->listarAutores();

if ($id) {
    $livro = $controle->buscarPorId($id);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $novo = new stdClass();
    $novo->id = $_POST['id'] ?? null;
    $novo->titulo = $_POST['titulo'];
    $novo->ano_publicacao = $_POST['ano_publicacao'];
    $novo->editora = $_POST['editora'];
    $novo->status_leitura = $_POST['status_leitura'];
    $novo->id_autor = $_POST['id_autor'];
    $controle->salvar($novo);
    header('Location: listar.php');
}

if (isset($_GET['excluir'])) {
    $controle->excluir($_GET['excluir']);
    header('Location: listar.php');
}
?>
<link rel="stylesheet" href="../../css/estilo.css">
<div class="container">
  <div id="welcome" style="margin-bottom: 15px; font-weight: bold;"></div>
  <h2>Cadastro de Livro</h2>
  <div id="weather" style="margin-bottom: 15px; font-weight: bold;"></div>
  <form method="post">
    <input type="hidden" name="id" value="<?= $livro['id'] ?>">
    <input type="text" name="titulo" placeholder="Título" value="<?= $livro['titulo'] ?>" required>
    <input type="number" name="ano_publicacao" placeholder="Ano de Publicação" value="<?= $livro['ano_publicacao'] ?>" required>
    <input type="text" name="editora" placeholder="Editora" value="<?= $livro['editora'] ?>" required>
    <input type="text" name="status_leitura" placeholder="Status de Leitura" value="<?= $livro['status_leitura'] ?>" required>
    <select name="id_autor">
      <?php foreach ($autores as $autor): ?>
        <option value="<?= $autor['id'] ?>" <?= $autor['id'] == $livro['id_autor'] ? 'selected' : '' ?>>
          <?= $autor['nome'] ?>
        </option>
      <?php endforeach; ?>
    </select>
    <button type="submit">Salvar</button>
  </form>
  <a href="../../public/index.php">Voltar à tela inicial</a>
  <script src="../../js/script.js"></script>
</div>
