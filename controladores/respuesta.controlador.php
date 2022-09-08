<?php

class ControladorRespuesta {
    
    static public function ctrMostrarRespuestas($tabla, $item, $valor)
    {
        $respuesta = ModeloRespuesta::mdlMostrarRespuestas($tabla, $item, $valor);
        return $respuesta;
    }
}