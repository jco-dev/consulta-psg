<?php

require_once 'conexion.php';

class ModeloPregunta
{
    static public function mdlCrearPregunta($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (titulo,descripcion,foto_pregunta) VALUES (:titulo,:descripcion,:foto_pregunta)");
        $stmt->bindParam(":titulo", $datos['titulo'], PDO::PARAM_STR);
        $stmt->bindParam(":descripcion", $datos['descripcion'], PDO::PARAM_STR);
        $stmt->bindParam(":foto_pregunta", $datos['foto_pregunta'], PDO::PARAM_STR);
        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
        $stmt = null;
    }

    static public function mdlMostrarPregunta($tabla, $item, $valor)
    {
        if ($item != null) {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
        } else {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
            $stmt->execute();
            return $stmt->fetchAll();
        }
        $stmt = null;
    }

    static public function mdlMostrarPreguntasUsuario($valor)
    {

        $subconsulta="SELECT COUNT(*) cantidad FROM respuesta WHERE respuesta.id_pregunta=pregunta.id_pregunta";
        $consulta="SELECT *,($subconsulta) as nro_respuestas FROM pregunta WHERE id_usuario = :id_usuario";


        $stmt = Conexion::conectar()->prepare($consulta);
        $stmt->bindParam(":id_usuario", $valor, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();

        $stmt = null;
    }
}
