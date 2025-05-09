<?php
error_reporting(E_ERROR | E_WARNING);
// Define as informações de conexão com o banco de dados
$host = "localhost";
$user = "root";
$pass = "aurora";
$dbname = "novilho";

// Cria a conexão com o banco usando MySQLi orientado a objetos
$link = new mysqli($host, $user, $pass, $dbname);

/* 
// Código para depuração (opcional) que mostra detalhes da conexão
echo "<pre>";
var_dump($link);
echo "</pre>"; 
*/
?>
