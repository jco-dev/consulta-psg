<?php

require_once "controladores/plantilla.controlador.php";
require_once "controladores/pregunta.controlador.php";
require_once "controladores/respuesta.controlador.php";

require_once "modelos/pregunta.modelo.php";
require_once "modelos/respuesta.modelo.php";

$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();