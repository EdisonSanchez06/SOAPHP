<?php
require 'config.php';
require 'producto.php';

header("Content-Type: application/json");

$method = $_SERVER['REQUEST_METHOD'];
$path = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
$id = $path[1] ?? null;

switch($method) {
    case 'GET':
        if($id) {
            $stmt = $pdo->prepare("SELECT * FROM productos WHERE id = ?");
            $stmt->execute([$id]);
            $producto = $stmt->fetch(PDO::FETCH_ASSOC);
            if($producto) echo json_encode($producto);
            else { http_response_code(404); echo json_encode(["error"=>"Producto no encontrado"]); }
        } else {
            $stmt = $pdo->query("SELECT * FROM productos");
            echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
        }
        break;

    case 'POST':
        $data = json_decode(file_get_contents("php://input"), true);
        $stmt = $pdo->prepare("INSERT INTO productos (nombre, descripcion, precio, stock) VALUES (?, ?, ?, ?)");
        $stmt->execute([$data['nombre'], $data['descripcion'], $data['precio'], $data['stock']]);
        http_response_code(201);
        echo json_encode(["message" => "Producto creado", "id" => $pdo->lastInsertId()]);
        break;

    case 'PUT':
        if(!$id) { http_response_code(400); exit; }
        $data = json_decode(file_get_contents("php://input"), true);
        $stmt = $pdo->prepare("UPDATE productos SET nombre=?, descripcion=?, precio=?, stock=? WHERE id=?");
        $stmt->execute([$data['nombre'], $data['descripcion'], $data['precio'], $data['stock'], $id]);
        echo json_encode(["message" => "Producto actualizado"]);
        break;

    case 'DELETE':
        if(!$id) { http_response_code(400); exit; }
        $stmt = $pdo->prepare("DELETE FROM productos WHERE id=?");
        $stmt->execute([$id]);
        echo json_encode(["message" => "Producto eliminado"]);
        break;

    default:
        http_response_code(405);
        echo json_encode(["error"=>"Método no permitido"]);
}
