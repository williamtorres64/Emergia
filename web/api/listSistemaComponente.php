<?php
include_once("conexao.php");
header('Content-Type: application/json');
$id = $_GET['sistemaId'];
// Run the query
$sql = "select componenteId, c.titulo from sistema s
inner join sistema_componente sc on sc.sistemaId = s.id
inner join componente c on c.id = sc.componenteId
where sistemaId = $id";
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

