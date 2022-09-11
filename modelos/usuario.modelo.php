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


    static public function mdlMostrarUsuariosW($item = null, $valor = null, $ofset = null)
    {
        if ($item != null) {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM persona p LEFT JOIN usuario u ON p.id_persona=u.id_usuario WHERE $item = :$item ");
            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
        } else {
            $consulta = "SELECT * FROM persona p JOIN usuario u ON p.id_persona=u.id_usuario " . ($ofset !== null ? " LIMIT 10 OFFSET $ofset" : "");
            $stmt = Conexion::conectar()->prepare($consulta);
            $stmt->execute();
            return $stmt->fetchAll();
        }

        $stmt = null;
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

    static public function mdlContarTablaPaginar($tabla)
    {

        $stmt = Conexion::conectar()->prepare("SELECT COUNT(*) cantidad FROM $tabla");
        $stmt->execute();
        $resultado = $stmt->fetch();
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



    static public function mdlActualizarUsuario($datos, $id_usuario)
    {
        $consulta = "UPDATE usuario SET  clave = :clave  WHERE id_usuario = :id_usuario";
        $stmt = Conexion::conectar()->prepare($consulta);


        $stmt->bindParam(":clave", $datos["clave"], PDO::PARAM_STR);

        $stmt->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }

        $stmt = null;
    }


    static public function mdlCrearPersona( $campos)
    {
        $consulta = "INSERT INTO persona  (nombre, paterno, materno) VALUES ( :nombre, :paterno, :materno)";
        $con = Conexion::conectar();
        $stmt=$con->prepare($consulta);
        $stmt->bindParam(":nombre", $campos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":paterno", $campos["paterno"], PDO::PARAM_STR);
        $stmt->bindParam(":materno", $campos["materno"], PDO::PARAM_STR);
        
        if($stmt->execute()){
            return $con->lastInsertId();
        }else{
            return false;
        }
        $con=null;
        $stmt=null;
    }


    
    static public function mdlCrearUsuario($campos)
    {

        $consulta = "INSERT INTO usuario (id_usuario, usuario, clave, rol) VALUES (:id_usuario, :usuario, :clave, :rol)";
        $con = Conexion::conectar();
        $stmt = $con->prepare($consulta);
        $stmt->bindParam(":id_usuario", $campos["id_usuario"], PDO::PARAM_INT);
        $stmt->bindParam(":usuario", $campos["usuario"], PDO::PARAM_STR);
        $stmt->bindParam(":clave", $campos["clave"], PDO::PARAM_STR);
        $stmt->bindParam(":rol", $campos["rol"], PDO::PARAM_STR);

        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
        $con=null;
        $stmt=null;
    }

    static public function mdlEliminarUsuario($id_usuario)
    {
        $consulta = "UPDATE usuario SET estado = 'INACTIVO' WHERE id_usuario = :id_usuario";
        $con = Conexion::conectar();
        $stmt = $con->prepare($consulta);
        $stmt->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);

        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }
}
