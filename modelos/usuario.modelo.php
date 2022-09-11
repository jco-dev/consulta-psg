<?php
require_once 'conexion.php';
class ModeloUsuario
{
    static public function MdlMostrarUsuarios($tabla, $item, $valor)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla u JOIN persona p on u.id_usuario=p.id_persona  WHERE $item = :$item");

        $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetch();
    }

    static public function mdlRegistrarPersona($tabla, $persona)
    {
        // return insert last id
        $dbh = new PDO('mysql:host=localhost;dbname=con', 'root', '');

        $stmt = $dbh->prepare("INSERT INTO $tabla (nombre, paterno, materno) VALUES (:nombre, :paterno, :materno)");
        $stmt->bindParam(":nombre", $persona['nombre'], PDO::PARAM_STR);
        $stmt->bindParam(":paterno", $persona['paterno'], PDO::PARAM_STR);
        $stmt->bindParam(":materno", $persona['materno'], PDO::PARAM_STR);

        $dbh->beginTransaction();
        if ($stmt->execute()) {
            $id_persona = $dbh->lastInsertId();
            $dbh->commit();
            return $id_persona;
            $dbh->commit();
        } else {
            $dbh->rollBack();
            return false;
        }
    }

    static public function mdlRegistrarUsuario($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (id_usuario, usuario, clave, rol) VALUES (:id_usuario, :usuario, :clave, :rol)");

        $stmt->bindParam(":id_usuario", $datos['id_usuario'], PDO::PARAM_INT);
        $stmt->bindParam(":usuario", $datos['usuario'], PDO::PARAM_STR);
        $stmt->bindParam(":clave", $datos['clave'], PDO::PARAM_STR);
        $stmt->bindParam(":rol", $datos['rol'], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
