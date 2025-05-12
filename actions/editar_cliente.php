<?php
session_start();
if (!isset($_SESSION['admin_user'])) {
  header("Location: ../pages/login.php");
  exit();
}

if (!isset($_GET['id'])) {
  echo "Cliente não especificado.";
  exit();
}

$cliente_id = intval($_GET['id']);

require_once '../includes/conexao.php';

$stmt = $conn->prepare("SELECT * FROM usuarios WHERE id = ?");
$stmt->bind_param("i", $cliente_id);
$stmt->execute();
$result = $stmt->get_result();
$cliente = $result->fetch_assoc();

if (!$cliente) {
  echo "Cliente não encontrado.";
  exit();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Editar Cliente</title>
  <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
  <main class="admin-area">
    <div class="topo-area">
      <a href="../pages/area_admin.php" class="btn-voltar">← Voltar</a>
      <a href="../logout/logout_admin.php" class="btn-sair">Sair</a>
    </div>

    <h2>Editar Cliente</h2>

    <section class="box">
      <form action="atualiza_cliente_admin.php" method="POST" class="form-usuario">
        <input type="hidden" name="id" value="<?= $cliente['id'] ?>">
        <input type="text" name="nome" value="<?= htmlspecialchars($cliente['nome']) ?>" required>
        <input type="text" name="sobrenome" value="<?= htmlspecialchars($cliente['sobrenome']) ?>" required>
        <input type="tel" name="telefone" value="<?= htmlspecialchars($cliente['telefone']) ?>" required>
        <input type="email" name="email" value="<?= htmlspecialchars($cliente['email']) ?>" required>
        <input type="date" name="data_nascimento" value="<?= $cliente['data_nascimento'] ?>" required>
        <input type="text" name="endereco" value="<?= htmlspecialchars($cliente['endereco']) ?>" required>
        <select name="plano" required>
          <option value="basic" <?= $cliente['plano'] === 'basic' ? 'selected' : '' ?>>Basic</option>
          <option value="plus" <?= $cliente['plano'] === 'plus' ? 'selected' : '' ?>>Plus</option>
          <option value="premium" <?= $cliente['plano'] === 'premium' ? 'selected' : '' ?>>Premium</option>
        </select>
        <button type="submit">Salvar Alterações</button>
      </form>
    </section>
  </main>
</body>
</html>
