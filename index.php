<?php

require_once "controladores/plantilla.controlador.php";
require_once "controladores/pregunta.controlador.php";
require_once "controladores/respuesta.controlador.php";
require_once "controladores/usuario.controlador.php";


require_once "modelos/pregunta.modelo.php";
require_once "modelos/respuesta.modelo.php";
require_once "modelos/usuario.modelo.php";


$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();