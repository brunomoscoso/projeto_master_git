<?php
session_start();

if (!isset($_POST['usuario'], $_POST['senha'])) {
  echo "<script>alert('Preencha todos os campos.'); window.location.href='../pages/login.php';</script>";
  exit();
}

$usuario = $_POST['usuario'];
$senha = $_POST['senha'];

$conn = new mysqli("localhost", "root", "", "clinica");

if ($conn->connect_error) {
  die("Erro na conexão: " . $conn->connect_error);
}

$sql = "SELECT * FROM administradores WHERE usuario = ? AND senha = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $usuario, $senha);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
  $_SESSION['admin_user'] = $usuario;
  header("Location: ../pages/area_admin.php");
  exit();
} else {
  echo "<script>alert('Usuário ou senha incorretos.'); window.location.href='../pages/login.php';</script>";
}

$stmt->close();
$conn->close();
?>
