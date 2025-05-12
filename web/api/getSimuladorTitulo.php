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

$row = $result->fetch_assoc(); 

// Output JSON
echo $row['titulo'];

?>
