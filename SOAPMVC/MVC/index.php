<?php
include "controllers/ProductoController.php";
$controller = new ProductoController();

$action = $_GET['action'] ?? 'listar';

switch ($action) {
    case 'crear':
        $controller->crear();
        break;
    case 'editar':
        $controller->editar();
        break;
    default:
        $controller->listar();
}
?>
