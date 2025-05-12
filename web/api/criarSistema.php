<?php
include_once("conexao.php");
$sql = "INSERT INTO sistema (titulo) VALUES ('')";
if ($conn->query($sql) === TRUE) {
    $newId = $conn->insert_id;

    header("Location: ../editarSimulador.php?sistemaId=" . $newId);
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

