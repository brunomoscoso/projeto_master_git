<?php
session_start();
if (!isset($_SESSION['admin_user'])) {
  header("Location: login.php");
  exit();
}
require_once '../includes/conexao.php';

$clientes = $conn->query("SELECT * FROM usuarios ORDER BY nome ASC");
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Área do Administrador</title>
  <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
  <main class="admin-area">
    <div class="topo-area">
      <a href="../logout/logout_admin.php" class="btn-sair">Sair</a>
    </div>

    <h2>Clientes Cadastrados</h2>
    <?php if (isset($_GET['status']) && $_GET['status'] === 'atualizado'): ?>
      <div class="msg-sucesso">Dados do cliente atualizados com sucesso!</div>
    <?php endif; ?>

    <section class="box">
      <?php while ($cliente = $clientes->fetch_assoc()): ?>
        <div class="cliente-item">
          <p><strong><?= htmlspecialchars($cliente['nome'] . ' ' . $cliente['sobrenome']) ?></strong> (<?= htmlspecialchars($cliente['email']) ?>)</p>
          <p>Telefone: <?= htmlspecialchars($cliente['telefone']) ?> | Plano: <?= $cliente['plano'] ?></p>

          <a href="../actions/editar_cliente.php?id=<?= $cliente['id'] ?>" class="btn-editar">Editar dados</a>
          <a href="consultas_cliente.php?id=<?= $cliente['id'] ?>" class="btn-ver">Ver consultas</a>
        </div>
      <?php endwhile; ?>
    </section>
    
    <section class="box">
      <h3>Gerenciar Notícias RSS</h3>
      <form action="adicionar_noticia.php" method="POST">
        <input type="text" name="titulo" placeholder="Título da notícia" required>
        <input type="url" name="link" placeholder="Link da notícia" required>
        <button type="submit">Adicionar Notícia</button>
      </form>
      <hr style="margin: 20px 0;">
      <?php
      $noticias = $conn->query("SELECT * FROM noticias_rss ORDER BY data_publicacao DESC");
      if ($noticias->num_rows > 0) {
        while ($n = $noticias->fetch_assoc()) {
          echo "<div class='consulta-item'>";
          echo "<p><strong>" . htmlspecialchars($n['titulo']) . "</strong></p>";
          echo "<p><a href='" . htmlspecialchars($n['link']) . "' target='_blank'>" . htmlspecialchars($n['link']) . "</a></p>";
          echo "<form action='../actions/excluir_noticia.php' method='POST' onsubmit='return confirm(\"Deseja excluir esta notícia?\");'>";
          echo "<input type='hidden' name='id' value='" . $n['id'] . "'>";
          echo "<button type='submit' class='btn-excluir'>Excluir</button>";
          echo "</form>";
          echo "</div>";
        }
      } else {
        echo "<p>Nenhuma notícia cadastrada.</p>";
      }
      ?>
    </section>
  </main>
</body>
</html>
