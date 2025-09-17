<?php
header('Content-Type: application/json');
include 'conexion.php';

$method = $_SERVER['REQUEST_METHOD'];

try {
    switch ($method) {
        case 'GET':
            if (isset($_GET['id'])) {
                $id = intval($_GET['id']);
                $stmt = $conn->prepare("SELECT * FROM productos WHERE id = ?");
                $stmt->execute([$id]);
                $producto = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($producto) {
                    echo json_encode($producto);
                } else {
                    http_response_code(404);
                    echo json_encode(["error" => "Producto no encontrado"]);
                }
            } else {
                http_response_code(400);
                echo json_encode(["error" => "ID requerido"]);
            }
            break;

        case 'POST':
            $data = json_decode(file_get_contents("php://input"), true);
            $nombre = $data['nombre'] ?? '';
            $precio = $data['precio'] ?? 0;
            $stock  = $data['stock'] ?? 0;

            if (!$nombre || !$precio || !$stock) {
                http_response_code(400);
                echo json_encode(["error" => "Datos incompletos"]);
                exit;
            }

            $stmt = $conn->prepare("INSERT INTO productos (nombre, precio, stock) VALUES (?, ?, ?)");
            $stmt->execute([$nombre, $precio, $stock]);
            echo json_encode(["success" => true]);
            break;

        case 'PUT':
            parse_str(file_get_contents("php://input"), $data);
            $id     = intval($data['id'] ?? 0);
            $nombre = $data['nombre'] ?? '';
            $precio = $data['precio'] ?? 0;
            $stock  = $data['stock'] ?? 0;

            $stmt = $conn->prepare("SELECT * FROM productos WHERE id = ?");
            $stmt->execute([$id]);
            if ($stmt->rowCount() === 0) {
                http_response_code(404);
                echo json_encode(["error" => "Producto no encontrado"]);
                exit;
            }

            $stmt = $conn->prepare("UPDATE productos SET nombre = ?, precio = ?, stock = ? WHERE id = ?");
            $stmt->execute([$nombre, $precio, $stock, $id]);
            echo json_encode(["success" => true]);
            break;

        case 'DELETE':
            parse_str(file_get_contents("php://input"), $data);
            $id = intval($data['id'] ?? 0);

            $stmt = $conn->prepare("SELECT * FROM productos WHERE id = ?");
            $stmt->execute([$id]);
            if ($stmt->rowCount() === 0) {
                http_response_code(404);
                echo json_encode(["error" => "Producto no encontrado"]);
                exit;
            }

            $stmt = $conn->prepare("DELETE FROM productos WHERE id = ?");
            $stmt->execute([$id]);
            echo json_encode(["success" => true]);
            break;

        default:
            http_response_code(405);
            echo json_encode(["error" => "Método no permitido"]);
    }
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["error" => "Error en el servidor"]);
}
?>
