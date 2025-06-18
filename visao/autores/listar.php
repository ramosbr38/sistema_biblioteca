<?php
require_once '../../controle/AutorControle.php';
$controle = new AutorControle();
$autores = $controle->listar();
?>
<link rel="stylesheet" href="../../css/estilo.css">
<div class="container">
  <div id="welcome" style="margin-bottom: 15px; font-weight: bold;"></div>
  <h2>Autores</h2>
  <div id="weather" style="margin-bottom: 15px; font-weight: bold;"></div>
  <a href="form.php">Novo Autor</a>
  <table border="1" style="width:100%; margin-top:20px;">
    <tr><th>ID</th><th>Nome</th><th>Ações</th></tr>
    <?php foreach ($autores as $autor): ?>
      <tr>
        <td><?= $autor['id'] ?></td>
        <td><?= $autor['nome'] ?></td>
        <td>
          <a href="form.php?id=<?= $autor['id'] ?>">Editar</a> |
          <a href="form.php?excluir=<?= $autor['id'] ?>" onclick="return confirm('Excluir autor?')">Excluir</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>
  <a href="../../public/index.php">Voltar à tela inicial</a>
  <script src="../../js/script.js"></script>
</div>
