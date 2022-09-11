<?php

require_once 'conexion.php';

class ModeloUsuario
{



    static public function mdlMostrarUsuarios($item = null, $valor = null, $ofset = null)
    {
        if ($item != null) {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM persona p JOIN usuario u ON p.id_persona=u.id_usuario WHERE $item = :$item ");
            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
        } else {
            $consulta="SELECT * FROM persona p JOIN usuario u ON p.id_persona=u.id_usuario ".( $ofset !==null ? " LIMIT 10 OFFSET $ofset": "");
            $stmt = Conexion::conectar()->prepare($consulta);
            $stmt->execute();
            return $stmt->fetchAll();
        }

        $stmt = null;
    }

    static public function mdlContarTablaPaginar($tabla)
    {

        $stmt = Conexion::conectar()->prepare("SELECT COUNT(*) cantidad FROM $tabla");
        $stmt->execute();
        $resultado= $stmt->fetch();
        $stmt = null;

        return $resultado['cantidad'];

    }

    static public function mdlContarTabla($tabla, $campo, $condicion, $valor)
    {
        $stmt = Conexion::conectar()->prepare("SELECT COUNT($campo) cantidad FROM $tabla WHERE $condicion = :$condicion");
        $stmt->bindParam(":" . $condicion, $valor, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $resultado = $stmt->fetch();
            return $resultado['cantidad'];
        } else {
            return false;
        }

        $stmt = null;
    }
}
