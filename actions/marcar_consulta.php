<?php
session_start();
if (!isset($_SESSION['user_email'])) {
  header("Location: ../pages/login.php");
  exit();
}
require_once '../includes/conexao.php';

$usuario_id = $_POST['usuario_id'];
$especialidade_id = $_POST['especialidade_id'];
$data_consulta = $_POST['data_consulta'];
$motivo = isset($_POST['motivo']) && !empty(trim($_POST['motivo'])) ? $_POST['motivo'] : NULL;

$stmt = $conn->prepare("INSERT INTO consultas (usuario_id, especialidade_id, data_consulta, motivo, hora_consulta) VALUES (?, ?, ?, ?, CURTIME())");
$stmt->bind_param("iiss", $usuario_id, $especialidade_id, $data_consulta, $motivo);

if ($stmt->execute()) {
  echo "<script>alert('Consulta marcada com sucesso!'); window.location.href='../pages/area_cliente.php';</script>";
} else {
  echo "<script>alert('Erro ao marcar consulta: " . $conn->error . "'); window.history.back();</script>";
}

$stmt->close();
$conn->close();
?>
