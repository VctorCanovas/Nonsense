<?php
/**
 * Obtiene todas las preguntas de la base de datos
 */

require 'Meta.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    // Manejar petición GET
    $preguntas = Pregunta::getAll();

    if ($preguntas) {

        $datos["estado"] = 1;
        $datos["preguntas"] = $preguntas;

        print json_encode($datos);
    } else {
        print json_encode(array(
            "estado" => 2,
            "mensaje" => "Ha ocurrido un error"
        ));
    }
}