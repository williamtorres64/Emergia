<?php
header('Content-Type: application/json; charset=utf-8');
include_once("conexao.php");

if (isset($_GET['id'])){
    $id = $_GET['id'];
} else {
    echo "ERRO: especifique um id";
}

$sql = "SELECT titulo from sistema s
where s.id=$id;";
$result = $conn->query($sql);
if (!$result) {
    http_response_code(500);
    echo json_encode(["error" => "Query failed: " . $conn->error]);
    $conn->close();
    exit;
}

$rows = [];
while ($row = $result->fetch_assoc()) {
    $rows[] = $row;
}

$sql = "SELECT c.titulo, transformidade, u.nome unidade, p.nome periodo, dias from sistema s
inner join sistema_componente sc on sc.sistemaId = s.id
inner join componente c on c.id = sc.componenteId
inner join periodo p on p.id = c.periodoId
inner join unidade u on u.id = c.unidadeId
where s.id=$id;";
$result = $conn->query($sql);
if (!$result) {
    http_response_code(500);
    echo json_encode(["error" => "Query failed: " . $conn->error]);
    $conn->close();
    exit;
}

while ($row = $result->fetch_assoc()) {
    $rows[] = $row;
}



// Output JSON
echo json_encode($rows, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
?>
