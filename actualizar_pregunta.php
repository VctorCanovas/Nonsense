<?php
/**
 * Actualiza una pregunta especificada por su identificador
 */

require 'Preguntas.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Decodificando formato Json
    $body = json_decode(file_get_contents("php://input"), true);

    // Actualizar meta
    $retorno = Pregunta::update(
        $body['idPregunta'],
        $body['pregunta'],
        $body['respuesta'],
        $body['categoria']);

    if ($retorno) {
        // Código de éxito
        print json_encode(
            array(
                'estado' => '1',
                'mensaje' => 'Actualización exitosa')
        );
    } else {
        // Código de falla
        print json_encode(
            array(
                'estado' => '2',
                'mensaje' => 'Actualización fallida')
        );
    }
}