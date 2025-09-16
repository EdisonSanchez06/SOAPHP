<?php
class EstudiantesController {
    public function listar() {
        $url = "http://192.168.100.42/SoaDistrbuidas/servicio.php";
        $json = file_get_contents($url);
        $data = json_decode($json, true);
        include "views/estudiantes.php";
    }
}
?>
