<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

$estudiantes = [
    ["id" => 1, "nombre" => "Dennis", "apellido" => "Chimborazo"],
    ["id" => 2, "nombre" => "Michelle", "apellido" => "Tunja"],
    ["id" => 3, "nombre" => "Eduardo", "apellido" => "Punina"],
    ["id" => 4, "nombre" => "Edison", "apellido" => "Sanchez"]

];

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo json_encode($estudiantes);
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents("php://input"), true);
    $estudiantes[] = $input;
    echo json_encode(["message" => "Estudiante agregado", "data" => $input]);
}
?>