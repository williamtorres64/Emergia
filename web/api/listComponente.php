<?php
include_once("conexao.php");
header('Content-Type: application/json');

// Run the query
$sql = "select c.id, c.titulo, transformidade, u.nome as unidade, p.nome as periodo from componente c
inner join periodo p on p.id = c.periodoId
inner join unidade u on u.id = c.unidadeId
order by id;";
$result = $conn->query($sql);

if (!$result) {
    http_response_code(500);
    echo json_encode(["error" => "Query failed: " . $conn->error]);
    $conn->close();
    exit;
}

// Collect rows into array
$rows = [];
while ($row = $result->fetch_assoc()) {
    $rows[] = $row;
}

// Output JSON
echo json_encode($rows, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

?>

