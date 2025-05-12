<?php
error_reporting(E_ERROR | E_WARNING);

// Database connection settings
$servername = "127.0.0.1";
$username = "root";
$password = "aurora";
$dbname = "emergia";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    http_response_code(500);

    echo "Database connection failed: " . $conn->connect_error;
    exit;
}

?>
