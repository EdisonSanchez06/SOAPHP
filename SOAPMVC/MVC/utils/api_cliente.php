<?php
function getProductos() {
    $json = file_get_contents("http://192.168.100.42/soa_api/productos.php");
    return json_decode($json, true);
}

function getProducto($id) {
    $json = file_get_contents("http://192.168.100.42/soa_api/producto.php?id=$id");
    return json_decode($json, true);
}

function crearProducto($data) {
    $options = [
        'http' => [
            'header'  => "Content-Type: application/json",
            'method'  => 'POST',
            'content' => json_encode($data)
        ]
    ];
    $context = stream_context_create($options);
    return file_get_contents("http://192.168.100.42/soa_api/producto.php", false, $context);
}

function editarProducto($data) {
    $options = [
        'http' => [
            'header'  => "Content-Type: application/x-www-form-urlencoded",
            'method'  => 'PUT',
            'content' => http_build_query($data)
        ]
    ];
    $context = stream_context_create($options);
    return file_get_contents("http://192.168.100.42/soa_api/producto.php", false, $context);
}
?>
