<?php
session_start();
if (!isset($_SESSION['user_email'])) {
  header("Location: login.php");
  exit();
}

require_once '../includes/conexao.php';

$email = $_SESSION['user_email'];
$sql = "SELECT * FROM usuarios WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$usuario = $result->fetch_assoc();

$especialidades = $conn->query("SELECT * FROM especialidades");
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Área do Cliente</title>
  <link rel="stylesheet" href="../assets/css/cliente.css">
</head>
<body>
  <main class="cliente-area">
    <div class="topo-area">
      <a href="../logout/logout_cliente.php" class="btn-sair">Sair</a>
    </div>
      <h2>Bem-vindo, <?php echo htmlspecialchars($usuario['nome']); ?>!</h2>
    <section class="box">
      <h3>Seus Dados Cadastrais</h3>
      <form action="../actions/atualiza_usuario.php" method="POST" class="form-usuario">
        <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">
        <input type="text" name="nome" value="<?php echo $usuario['nome']; ?>" required>
        <input type="text" name="sobrenome" value="<?php echo $usuario['sobrenome']; ?>" required>
        <input type="tel" name="telefone" value="<?php echo $usuario['telefone']; ?>" required>
        <input type="email" name="email" value="<?php echo $usuario['email']; ?>" required readonly>
        <input type="date" name="data_nascimento" value="<?php echo $usuario['data_nascimento']; ?>" required>
        <input type="text" name="endereco" value="<?php echo $usuario['endereco']; ?>" required>
        <select name="plano" required>
          <option value="basic" <?php if($usuario['plano'] === 'basic') echo 'selected'; ?>>Basic</option>
          <option value="plus" <?php if($usuario['plano'] === 'plus') echo 'selected'; ?>>Plus</option>
          <option value="premium" <?php if($usuario['plano'] === 'premium') echo 'selected'; ?>>Premium</option>
        </select>
        <button type="submit">Atualizar Dados</button>
      </form>
    </section>

    <section class="box">
      <h3>Marcar Nova Consulta</h3>
      <form action="../actions/marcar_consulta.php" method="POST" class="form-consulta">
        <input type="hidden" name="usuario_id" value="<?= $usuario['id']; ?>">
        <select name="especialidade_id" required>
          <option value="">Selecione uma especialidade</option>
          <?php while ($esp = $especialidades->fetch_assoc()) { ?>
            <option value="<?= $esp['id']; ?>"><?= $esp['nome']; ?></option>
          <?php } ?>
        </select>
        <input type="date" name="data_consulta" min="<?= date('Y-m-d') ?>" required>
        <textarea name="motivo" placeholder="Observações (ex: alergias, restrições, etc)"></textarea>
        <button type="submit">Marcar Consulta</button>
      </form>
    </section>

    <section class="box">
      <h3>Suas Consultas Marcadas</h3>
      <?php
        $sql = "SELECT c.id, e.nome AS especialidade, c.data_consulta, c.motivo, c.status
                FROM consultas c
                JOIN especialidades e ON c.especialidade_id = e.id
                WHERE c.usuario_id = ?
                ORDER BY c.data_consulta ASC";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $usuario['id']);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
          while ($consulta = $result->fetch_assoc()) {
            echo "<div class='consulta-item'>";
            echo "<strong>Especialidade:</strong> " . htmlspecialchars($consulta['especialidade']) . "<br>";
            echo "<strong>Data:</strong> " . date("d/m/Y", strtotime($consulta['data_consulta'])) . "<br>";
            if (!empty($consulta['motivo'])) {
              echo "<strong>Observações:</strong> " . htmlspecialchars($consulta['motivo']) . "<br>";
            }

            if ($consulta['status'] === 'cancelada') {
              echo "<p class='cancelada'>⚠️ Consulta cancelada pelo administrador.</p>";
            } else {
              $dataConsulta = new DateTime($consulta['data_consulta']);
              $agora = new DateTime();
              $horasRestantes = ($dataConsulta->getTimestamp() - $agora->getTimestamp()) / 3600;

              if ($horasRestantes > 72) {
                echo "<form action='../actions/cancelar_consulta.php' method='POST' onsubmit='return confirm(\"Deseja realmente cancelar esta consulta?\");'>";
                echo "<input type='hidden' name='consulta_id' value='" . $consulta['id'] . "'>";
                echo "<button type='submit' class='btn-cancelar'>Cancelar</button>";
                echo "</form>";
              } else {
                echo "<p class='nao-cancelavel'>⏱️ Cancelamento indisponível a menos de 72h da consulta.</p>";
              }
            }
            echo "</div>";
          }
        } else {
          echo "<p>Você ainda não marcou nenhuma consulta.</p>";
        }
        $stmt->close();
      ?>
    </section>
  </main>
</body>
</html>
