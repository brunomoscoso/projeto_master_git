<?php
session_start();
if (!isset($_SESSION['user_email'])) {
  header("Location: ../pages/login.php");
  exit();
}

if (!isset($_POST['id'], $_POST['nome'], $_POST['sobrenome'], $_POST['telefone'], $_POST['email'], $_POST['data_nascimento'], $_POST['endereco'], $_POST['plano'])) {
  echo "Dados incompletos.";
  exit();
}

$id = intval($_POST['id']);
$nome = $_POST['nome'];
$sobrenome = $_POST['sobrenome'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];
$data_nascimento = $_POST['data_nascimento'];
$endereco = $_POST['endereco'];
$plano = $_POST['plano'];

require_once '../includes/conexao.php';

$stmt = $conn->prepare("UPDATE usuarios SET nome = ?, sobrenome = ?, telefone = ?, email = ?, data_nascimento = ?, endereco = ?, plano = ? WHERE id = ?");
$stmt->bind_param("sssssssi", $nome, $sobrenome, $telefone, $email, $data_nascimento, $endereco, $plano, $id);

if ($stmt->execute()) {
  header("Location: ../pages/area_cliente.php?status=atualizado");
  exit();
} else {
  echo "Erro ao atualizar os dados.";
}

$stmt->close();
$conn->close();
