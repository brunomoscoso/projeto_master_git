<?php

require_once '../includes/conexao.php';
$nome = $_POST['nome'];
$sobrenome = $_POST['sobrenome'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];
$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); $data_nascimento = $_POST['data_nascimento'];
$endereco = $_POST['endereco'];
$plano = $_POST['plano'];

$stmt = $conn->prepare("INSERT INTO usuarios (nome, sobrenome, telefone, email, senha, data_nascimento, endereco, plano) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssss", $nome, $sobrenome, $telefone, $email, $senha, $data_nascimento, $endereco, $plano);

if ($stmt->execute()) {
  echo "<script>alert('Cadastro realizado com sucesso!'); window.location.href='../pages/login.php';
;</script>";
} else {
  echo "<script>alert('Erro ao cadastrar: " . $conn->error . "'); window.history.back();</script>";
}

$stmt->close();
$conn->close();
?>
