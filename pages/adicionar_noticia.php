<?php
session_start();
if (!isset($_SESSION['admin_user'])) {
  header("Location: ../pages/login.php");
  exit();
}

if (!isset($_POST['titulo'], $_POST['link'])) {
  echo "Dados incompletos.";
  exit();
}
$titulo = $_POST['titulo'];
$link = $_POST['link'];

require_once '../includes/conexao.php';
$stmt = $conn->prepare("INSERT INTO noticias_rss (titulo, link) VALUES (?, ?)");
$stmt->bind_param("ss", $titulo, $link);

if ($stmt->execute()) {
  header("Location: ../pages/area_admin.php");
} else {
  echo "Erro ao adicionar notícia.";
}
