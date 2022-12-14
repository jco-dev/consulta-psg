<?php

require_once 'conexion.php';

class ModeloPregunta
{
    static public function mdlCrearPregunta($tabla , $datos)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (titulo,descripcion,foto_pregunta, id_usuario) VALUES (:titulo,:descripcion,:foto_pregunta, :id_usuario)");
        $stmt->bindParam(":titulo",$datos['titulo'],PDO::PARAM_STR);
        $stmt->bindParam(":descripcion",$datos['descripcion'],PDO::PARAM_STR);
        $stmt->bindParam(":foto_pregunta",$datos['foto_pregunta'],PDO::PARAM_STR);
        $stmt->bindParam(":id_usuario",$datos['id_usuario'],PDO::PARAM_INT);
        if($stmt->execute())
        {
            return "ok";
        }else{
            return "error";
        }
        $stmt = null;
    }

    static public function mdlMostrarPregunta($tabla, $item, $valor)
    {
        if($item != null)
        {
            $stmt = Conexion::conectar()->prepare("SELECT t.*,(SELECT CONCAT_WS(' ', p.nombre, p.paterno) as usuario FROM persona p WHERE p.id_persona=t.id_usuario ) as usuario   FROM $tabla t  WHERE $item = :$item");
            $stmt->bindParam(":".$item,$valor,PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
        }else{
            $stmt = Conexion::conectar()->prepare("SELECT t.*, (SELECT CONCAT_WS(' ', p.nombre, p.paterno) as usuario FROM persona p WHERE p.id_persona=t.id_usuario ) as usuario FROM $tabla t");
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