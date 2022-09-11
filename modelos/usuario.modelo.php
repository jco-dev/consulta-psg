<?php
require_once 'conexion.php';
class ModeloUsuario
{
    static public function MdlMostrarUsuarios($tabla, $item, $valor)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla u JOIN persona p on u.id_usuario=p.id_persona  WHERE $item = :$item");

		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetch();
    }
}
