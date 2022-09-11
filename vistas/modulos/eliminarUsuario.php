<?php 
$ruta = explode('/', $_GET['ruta']);
$id_usuario = isset($ruta[1]) &&  $ruta[1] != "" ? $ruta[1] : null;

$usuario = new ControladorUsuario();
$usuario->ctrEliminarUsuario($id_usuario);


?>