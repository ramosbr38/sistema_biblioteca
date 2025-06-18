<?php
require_once '../../controle/LivroControle.php';
$controle = new LivroControle();
$livros = $controle->listar();
?>
<link rel="stylesheet" href="../../css/estilo.css">
<div class="container">
  <div id="welcome" style="margin-bottom: 15px; font-weight: bold;"></div>
  <h2>Livros</h2>
  <a href="form.php">Novo Livro</a>
  <div id="weather" style="margin-bottom: 15px; font-weight: bold;"></div>
  <table border="1" style="width:100%; margin-top:20px;">
    <tr><th>ID</th><th>Título</th><th>Ano</th><th>Editora</th><th>Status</th><th>Autor</th><th>Ações</th></tr>
    <?php foreach ($livros as $livro): ?>
      <tr>
        <td><?= $livro['id'] ?></td>
        <td><?= $livro['titulo'] ?></td>
        <td><?= $livro['ano_publicacao'] ?></td>
        <td><?= $livro['editora'] ?></td>
        <td><?= $livro['status_leitura'] ?></td>
        <td><?= $livro['nome_autor'] ?></td>
        <td>
          <a href="form.php?id=<?= $livro['id'] ?>">Editar</a> |
          <a href="form.php?excluir=<?= $livro['id'] ?>" onclick="return confirm('Excluir livro?')">Excluir</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>
  <a href="../../public/index.php">Voltar à tela inicial</a>
  <script src="../../js/script.js"></script>
</div>
