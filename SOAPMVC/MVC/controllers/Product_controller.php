<?php
include_once "../utils/api_client.php";

class ProductoController {
    public function listar() {
        $productos = getProductos();
        include "../views/listar.php";
    }

    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nombre' => $_POST['nombre'],
                'precio' => $_POST['precio'],
                'stock'  => $_POST['stock']
            ];
            crearProducto($data);
            header("Location: ../index.php");
        } else {
            include "../views/crear.php";
        }
    }

    public function editar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'id'     => $_POST['id'],
                'nombre' => $_POST['nombre'],
                'precio' => $_POST['precio'],
                'stock'  => $_POST['stock']
            ];
            editarProducto($data);
            header("Location: ../index.php");
        } else {
            $producto = getProducto($_GET['id']);
            include "../views/editar.php";
        }
    }
}
?>
