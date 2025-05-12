<?php
session_start();
if (!isset($_SESSION['admin_user'])) exit("unauthorized");

if (!isset($_POST['consulta_id'], $_POST['usuario_id'])) exit("erro");

$consulta_id = intval($_POST['consulta_id']);
$usuario_id = intval($_POST['usuario_id']);

require_once '../includes/conexao.php';

$stmt = $conn->prepare("UPDATE consultas SET status = 'cancelada' WHERE id = ? AND usuario_id = ?");
$stmt->bind_param("ii", $consulta_id, $usuario_id);

if ($stmt->execute()) {
  echo "ok";
} else {
  echo "erro";
}

$stmt->close();
$conn->close();
?>
