<?php
/**
 * Obtiene el detalle de una pregunta especificada por
 * su identificador "idPregunta"
 */

require 'Preguntas.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (isset($_GET['idPregunta'])) {

        // Obtener parámetro idPregunta
        $parametro = $_GET['idPregunta'];

        // Tratar retorno
        $retorno = Pregunta::getById($parametro);


        if ($retorno) {

            $pregunta["estado"] = "1";
            $pregunta["pregunta"] = $retorno;
            // Enviar objeto json de la pregunta
            print json_encode($pregunta);
        } else {
            // Enviar respuesta de error general
            print json_encode(
                array(
                    'estado' => '2',
                    'mensaje' => 'No se obtuvo el registro'
                )
            );
        }

    } else {
        // Enviar respuesta de error
        print json_encode(
            array(
                'estado' => '3',
                'mensaje' => 'Se necesita un identificador'
            )
        );
    }
}