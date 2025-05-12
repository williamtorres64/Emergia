<?php
include_once("conexao.php");

if (isset($_GET['sid']) && isset($_GET['cid'])){
    $sid = $_GET['sid'];
    $cid = $_GET['cid'];
} else {
    echo "ERRO: especifique os ids";
}


// Run the query
$sql = "delete from sistema_componente where sistemaId = $sid and componenteId = $cid";
$conn->query($sql);

header("Location: ../editarSimulador.php?sistemaId=$sid");
?>
