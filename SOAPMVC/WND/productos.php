<?php
header('Content-Type: application/json');
include 'conexion.php';

try {
    $stmt = $conn->query("SELECT * FROM productos");
    $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($productos);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["error" => "Error al consultar productos"]);
}
?>
