<?php

class ControladorUsuario
{
    static public function ctrIngresoUsuario()
    {
        if (isset($_POST['usuario']) && isset($_POST['clave'])) {
            if (preg_match('/^[a-zA-Z0-9@.]+$/', $_POST["usuario"])) {
                $tabla = "usuario";

                $item = "usuario";
                $valor = $_POST["usuario"];

                $respuesta = ModeloUsuario::MdlMostrarUsuarios($tabla, $item, $valor);
                if ($respuesta) {
                    if ($respuesta['usuario'] == $_POST['usuario'] && $respuesta['clave'] == $_POST['clave']) {
                        $_SESSION["iniciarSesion"] = "ok";
                        $_SESSION["id"] = $respuesta['id_usuario'];
                        $_SESSION["nombre"] = $respuesta['nombre'];
                        $_SESSION["paterno"] = $respuesta['paterno'];
                        $_SESSION["rol"] = $respuesta['rol'];

                        echo '<script>
                            window.location = "' . BASE_URL . 'preguntas/";
					    </script>';
                    } else {
                        echo '<br><div class="alert alert-danger">Error al ingresar, vuelve a intentarlo</div>';
                    }
                }else{
                    echo '<br><div class="alert alert-danger">Error al ingresar, vuelve a intentarlo</div>';
                }
            }
        }
    }
}
