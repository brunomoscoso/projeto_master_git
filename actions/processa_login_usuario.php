<?php
session_start();

require_once '../includes/conexao.php';

$email = $_POST['email'];
$senha = $_POST['senha'];

$sql = "SELECT * FROM usuarios WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
  $usuario = $result->fetch_assoc();

  if (password_verify($senha, $usuario['senha'])) {
    $_SESSION['user_email'] = $usuario['email'];
    header("Location: ../pages/area_cliente.php");
    exit();
  } else {
    echo "<script>alert('Senha incorreta'); window.location.href='../pages/login.php';</script>";
  }
} else {
  echo "<script>alert('Usuário não encontrado'); window.location.href='../pages/login.php';</script>";
}

$conn->close();
?>
