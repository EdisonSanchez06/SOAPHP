<?php
$host = "127.0.0.1"; // MySQL en mismo host
$dbname = "inventario";
$user = "root";
$pass = "";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    http_response_code(500);
    echo json_encode(["error" => "Error de conexión a BD: " . $e->getMessage()]);
    exit;
}