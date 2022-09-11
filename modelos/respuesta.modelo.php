<?php

require_once 'conexion.php';

class ModeloRespuesta
{

    static public function mdlMostrarRespuestas($tabla, $item, $valor)
    {
        if($item != null)
        {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
            $stmt->bindParam(":".$item,$valor,PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll();
        }else{
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
            $stmt->execute();
            return $stmt->fetchAll();
        }
        $stmt = null;
    }

    static public function mdlCrearRespuesta($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(descripcion_respuesta, id_pregunta, fecha, foto_respuesta, id_usuario) VALUES (:descripcion_respuesta, :id_pregunta, :fecha, :foto_respuesta, :id_usuario)");
        $stmt->bindParam(":descripcion_respuesta", $datos['descripcion_respuesta'], PDO::PARAM_STR);
        $stmt->bindParam(":id_pregunta", $datos['id_pregunta'], PDO::PARAM_INT);
        $stmt->bindParam(":fecha", $datos['fecha'], PDO::PARAM_STR);
        $stmt->bindParam(":foto_respuesta", $datos['foto_respuesta'], PDO::PARAM_STR);
        $stmt->bindParam(":id_usuario", $datos['id_usuario'], PDO::PARAM_INT);
        if($stmt->execute())
            return "ok";
        else
            return "error";
        $stmt = null;
    }

}