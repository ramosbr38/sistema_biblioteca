<?php
require_once '../../controle/EmprestimoControle.php';
$controle = new EmprestimoControle();
$emprestimos = $controle->listar();
?>
<link rel="stylesheet" href="../../css/estilo.css">
<div class="container">
    <div id="welcome" style="margin-bottom: 15px; font-weight: bold;"></div>
  <h2>Empréstimos</h2>
  <div id="weather" style="margin-bottom: 15px; font-weight: bold;"></div>
  <a href="form.php">Novo Empréstimo</a>
  <table border="1" style="width:100%; margin-top:20px;">
    <tr>
      <th>ID</th>
      <th>Livro</th>
      <th>Autor</th>
      <th>Usuário</th>
      <th>Data Empréstimo</th>
      <th>Data Devolução</th>
      <th>Ações</th>
    </tr>
    <?php foreach ($emprestimos as $e): ?>
      <tr>
        <td><?= $e['id'] ?></td>
        <td><?= htmlspecialchars($e['titulo_livro']) ?></td>
        <td><?= htmlspecialchars($e['nome_autor']) ?></td>
        <td><?= htmlspecialchars($e['nome_usuario']) ?></td>
        <td><?= $e['data_emprestimo'] ?></td>
        <td><?= $e['data_devolucao'] ?></td>
        <td>
          <a href="form.php?id=<?= $e['id'] ?>">Editar</a> |
          <a href="form.php?excluir=<?= $e['id'] ?>" onclick="return confirm('Excluir empréstimo?')">Excluir</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>
  <a href="../../public/index.php">Voltar à tela inicial</a>
  <script src="../../js/script.js"></script>
</div>
