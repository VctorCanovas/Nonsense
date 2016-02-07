<?php
/**
 * Elimina una pregunta de la base de datos
 * distinguida por su identificador
 */

require 'Preguntas.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Decodificando formato Json
    $body = json_decode(file_get_contents("php://input"), true);

    $retorno = Pregunta::delete($body['idPregunta']);

    if ($retorno) {
        print json_encode(
            array(
                'estado' => '1',
                'mensaje' => 'Eliminación exitosa')
        );
    } else {
        print json_encode(
            array(
                'estado' => '2',
                'mensaje' => 'Eliminación fallida')
        );
    }
}