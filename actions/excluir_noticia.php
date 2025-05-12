<?php
session_start();
if (!isset($_SESSION['admin_user'])) {
  header("Location: ../pages/area_admin.php");
  exit();
}

if (!isset($_POST['id'])) {
  exit("ID inválido.");
}

$id = intval($_POST['id']);

require_once '../includes/conexao.php';

$conn->query("DELETE FROM noticias_rss WHERE id = $id");
header("Location: ../pages/area_admin.php");
