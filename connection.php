<?php
// Conexão com o banco de dados (db.php)
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'tab_info';

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}
