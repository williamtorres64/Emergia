<?php
include_once("conexao.php");

$id = intval($_POST['id']);
$titulo = $_POST['titulo'];
$transformidade = floatval($_POST['transformidade']);
$unidadeId = intval($_POST['unidadeId']);
$periodoId = intval($_POST['periodoId']);

if ($id === 0) {
    $stmt = $conn->prepare("INSERT INTO componente (titulo, transformidade, unidadeId, periodoId) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sdii", $titulo, $transformidade, $unidadeId, $periodoId);
} else {
    $stmt = $conn->prepare("UPDATE componente SET titulo = ?, transformidade = ?, unidadeId = ?, periodoId = ? WHERE id = ?");
    $stmt->bind_param("sdiii", $titulo, $transformidade, $unidadeId, $periodoId, $id);
}

$stmt->execute();
header("Location: ../componentes.php");
exit;

