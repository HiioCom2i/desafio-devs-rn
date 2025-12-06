<?php
$host = "db";
$user = "root";
$pass = "root";
$dbname = "devs_rn";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("erro de conexão: " . $conn->connect_error);
}
?>