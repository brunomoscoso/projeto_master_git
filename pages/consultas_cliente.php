<?php
session_start();
if (!isset($_SESSION['admin_user'])) {
  header("Location: login.php");
  exit();
}

if (!isset($_GET['id'])) {
  echo "Cliente não especificado.";
  exit();
}

$cliente_id = intval($_GET['id']);

require_once '../includes/conexao.php';

$stmtCliente = $conn->prepare("SELECT nome, sobrenome FROM usuarios WHERE id = ?");
$stmtCliente->bind_param("i", $cliente_id);
$stmtCliente->execute();
$resCliente = $stmtCliente->get_result();
$cliente = $resCliente->fetch_assoc();

$stmtConsultas = $conn->prepare("
  SELECT c.id, e.nome AS especialidade, c.data_consulta, c.motivo, c.status
  FROM consultas c
  JOIN especialidades e ON c.especialidade_id = e.id
  WHERE c.usuario_id = ?
  ORDER BY c.data_consulta ASC
");
$stmtConsultas->bind_param("i", $cliente_id);
$stmtConsultas->execute();
$resConsultas = $stmtConsultas->get_result();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Consultas do Cliente</title>
  <link rel="stylesheet" href="../assets/css/admin.css">
</head>

<body>
  <main class="admin-area">
    <div class="topo-area">
      <a href="area_admin.php" class="btn-voltar">← Voltar</a>
      <a href="../logout/logout_admin.php" class="btn-sair">Sair</a>
    </div>

    <h2>Consultas de <?= htmlspecialchars($cliente['nome'] . ' ' . $cliente['sobrenome']) ?></h2>

    <?php if (isset($_GET['status']) && $_GET['status'] === 'cancelado'): ?>
      <div class="msg-sucesso" id="mensagem-sucesso">
        Consulta cancelada com sucesso.
      </div>
    <?php endif; ?>

    <section class="box">
      <?php if ($resConsultas->num_rows > 0): ?>
        <?php while ($consulta = $resConsultas->fetch_assoc()): ?>
          <div class="consulta-item" id="consulta-<?= $consulta['id'] ?>">
            <p><strong>Especialidade:</strong> <?= htmlspecialchars($consulta['especialidade']) ?></p>
            <p><strong>Data:</strong> <?= date("d/m/Y", strtotime($consulta['data_consulta'])) ?></p>
            <?php if (!empty($consulta['motivo'])): ?>
              <p><strong>Observações:</strong> <?= htmlspecialchars($consulta['motivo']) ?></p>
            <?php endif; ?>

            <?php if ($consulta['status'] === 'ativa'): ?>
              <button class="btn-excluir" onclick="cancelarConsulta(<?= $consulta['id'] ?>, <?= $cliente_id ?>)">Cancelar</button>
            <?php else: ?>
              <p class="cancelada">⚠️ Consulta cancelada pelo administrador.</p>
            <?php endif; ?>
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <p>Este cliente não tem consultas marcadas.</p>
      <?php endif; ?>
    </section>
  </main>

  <script>
    function cancelarConsulta(consultaId, usuarioId) {
      if (!confirm("Deseja cancelar esta consulta?")) return;

      fetch('../actions/cancelar_consulta_admin.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `consulta_id=${consultaId}&usuario_id=${usuarioId}`
      })
      .then(response => response.text())
      .then(result => {
        if (result.trim() === 'ok') {
          const consultaBox = document.getElementById('consulta-' + consultaId);
          if (consultaBox) {
            const btn = consultaBox.querySelector('.btn-excluir');
            if (btn) btn.remove();

            const p = document.createElement('p');
            p.classList.add('cancelada');
            p.innerText = '⚠️ Consulta cancelada pelo administrador.';
            consultaBox.appendChild(p);
          }
        } else {
          alert("Erro ao cancelar a consulta.");
        }
      })
      .catch(() => alert("Erro na requisição."));
    }
  </script>
</body>
</html>
