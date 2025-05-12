<?php
include_once("conexao.php");

if (isset($_GET['id'])){
    $id = $_GET['id'];
} else {
    echo "ERRO: especifique um id";
}


// Run the query
$sql = "delete from sistema where id = $id";
$conn->query($sql);

header("Location: ../simulacoes.php");
?>

