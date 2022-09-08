<?php

class Conexion
{
    static public function conectar()
    {
        $link = new PDO('mysql:host=localhost;dbname=consulta', 'root', '');
        $link->exec('set name utf-8');
        return $link;
    }

    // funcion para cerrar la conexion
    public function cerrar()
    {
        $link = null;
    }
    
    static public function insertar(string $tabla, array $datos)
    {
        $link = Conexion::conectar();
        $campos = implode(',', array_keys($datos));
        $valores = implode("','", array_values($datos));
        $sql = "INSERT INTO $tabla ($campos) VALUES ('$valores')";
        $link->exec($sql);
        $link = null;
    }

    public function actualizar(string $tabla, array $datos, array $condicion)
    {
        $link = $this->conectar();
        $campos = implode(',', array_keys($datos));
        $valores = implode(',', array_values($datos));
        $sql = "UPDATE $tabla SET $campos = $valores WHERE $condicion";
        $link->query($sql);
        $this->cerrar();
    }

    public function eliminar(string $tabla, array $condicion)
    {
        $link = $this->conectar();
        $sql = "DELETE FROM $tabla WHERE $condicion";
        $link->query($sql);
        $this->cerrar();
    }

    public function consultar(string $tabla, array $campos, array $condicion)
    {
        $link = $this->conectar();
        $campos = implode(',', array_keys($campos));
        $sql = "SELECT $campos FROM $tabla WHERE $condicion";
        $resultado = $link->query($sql);
        $this->cerrar();
        return $resultado;
    }
    
}
