<?php
header('Content-Type: application/json; charset=utf-8');
include_once("conexao.php");

// Verifica se os parâmetros foram fornecidos
if (!isset($_GET['id']) || !isset($_GET['titulo'])) {
    http_response_code(400);
    echo json_encode(["error" => "ERRO: especifique id e titulo"]);
    exit;
}

$id = $_GET['id'];
$titulo = $_GET['titulo'];

// Atualiza o título diretamente com SQL simples
$sql = "UPDATE sistema SET titulo = '$titulo' WHERE id = $id;";
$result = $conn->query($sql);

if (!$result) {
    http_response_code(500);
    echo json_encode(["error" => "Erro ao executar update: " . $conn->error]);
    $conn->close();
    exit;
}

$conn->close();
?>

