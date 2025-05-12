<?php
session_start();
if (!isset($_SESSION['user_email'])) {
  header("Location: ../pages/login.php");
  exit();
}

require_once '../includes/conexao.php';

$consulta_id = $_POST['consulta_id'];
$email = $_SESSION['user_email'];

$sql = "DELETE c FROM consultas c
        JOIN usuarios u ON c.usuario_id = u.id
        WHERE c.id = ? AND u.email = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $consulta_id, $email);

if ($stmt->execute()) {
  echo "<script>alert('Consulta cancelada com sucesso.'); window.location.href='../pages/area_cliente.php';</script>";
} else {
  echo "<script>alert('Erro ao cancelar consulta.'); window.history.back();</script>";
}

$stmt->close();
$conn->close();
?>
