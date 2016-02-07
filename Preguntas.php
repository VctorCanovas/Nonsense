<?php

/**
 * Representa el la estructura de las preguntas
 * almacenadas en la base de datos
 */
require 'Database.php';

class Pregunta
{
    function __construct()
    {
    }

    /**
     * Retorna en la fila especificada de la tabla 'meta'
     *
     * @param $idMeta Identificador del registro
     * @return array Datos del registro
     */
    public static function getAll()
    {
        $consulta = "SELECT * FROM DATA";
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute();

            return $comando->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Obtiene los campos de una pregunta con un identificador
     * determinado
     *
     * @param $idPregunta Identificador de la pregunta
     * @return mixed
     */
    public static function getById($idPregunta)
    {
        // Consulta de la meta
        $consulta = "SELECT idPregunta,
                            pregunta,
                             respuesta,
                             categoria,
                             FROM DATA
                             WHERE idPregunta = ?";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($idPregunta));
            // Capturar primera fila del resultado
            $row = $comando->fetch(PDO::FETCH_ASSOC);
            return $row;

        } catch (PDOException $e) {
            // Aquí puedes clasificar el error dependiendo de la excepción
            // para presentarlo en la respuesta Json
            return -1;
        }
    }

    /**
     * Actualiza un registro de la bases de datos basado
     * en los nuevos valores relacionados con un identificador
     *
     * @param $idPregunta      identificador
     * @param $pregunta      nuevo pregunta
     * @param $respuesta nueva respuesta
     * @param $categoria   nueva categoria
     */
    public static function update(
        $idPregunta,
        $pregunta,
        $respuesta,
        $categoria,
    )
    {
        // Creando consulta UPDATE
        $consulta = "UPDATE DATA" .
            " SET pregunta=?, respuesta=?, categoria=? " .
            "WHERE idPregunta=?";

        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);

        // Relacionar y ejecutar la sentencia
        $cmd->execute(array($pregunta, $respuesta, $categoria, $idPregunta));

        return $cmd;
    }

    /**
     * Insertar una nueva meta
     *
     * @param $pregunta      pregunta del nuevo registro
     * @param $respuesta    respuesta del nuevo registro
     * @param $categoria   categoria del nuevo registro
     * @return PDOStatement
     */
    public static function insert(
        $pregunta,
        $respuesta,
        $categoria,
    )
    {
        // Sentencia INSERT
        $comando = "INSERT INTO DATA ( " .
            "pregunta," .
            " respuesta," .
            " categoria)" .
            " VALUES( ?,?,?)";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
            array(
                $pregunta,
                $respuesta,
                $categoria,
            )
        );

    }

    /**
     * Eliminar el registro con el identificador especificado
     *
     * @param $idPregunta identificador de la pregunta
     * @return bool Respuesta de la eliminación
     */
    public static function delete($idPregunta)
    {
        // Sentencia DELETE
        $comando = "DELETE FROM DATA WHERE idPregunta=?";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(array($idPregunta));
    }
}

?>