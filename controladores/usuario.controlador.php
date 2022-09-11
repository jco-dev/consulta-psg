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
                    if ($respuesta['usuario'] == $_POST['usuario'] && $respuesta['clave'] == crypt(trim($_POST["clave"]), '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$')) {
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
                } else {
                    echo '<br><div class="alert alert-danger">Error al ingresar, vuelve a intentarlo</div>';
                }
            }
        }
    }

    static public function ctrRegistroUsuario()
    {
        if (isset($_POST['nombre']) && isset($_POST['paterno']) && isset($_POST['correo']) && isset($_POST['clave'])) {
            if ($_POST['clave'] == $_POST['repita_clave']) {
                if (
                    preg_match('/^[a-zA-Z0-9]+$/', $_POST["nombre"]) && preg_match('/^[a-zA-Z0-9]+$/', $_POST["paterno"])
                    && preg_match('/^[a-zA-Z0-9]+$/', $_POST["materno"]) && preg_match('/^[a-zA-Z0-9-@.]+$/', $_POST["correo"])
                    && preg_match('/^[a-zA-Z0-9]+$/', $_POST["clave"])
                ) {

                    $tabla = "persona";
                    $datos = array(
                        "nombre" => trim($_POST['nombre']),
                        "paterno" => trim($_POST['paterno']),
                        "materno" => trim($_POST['materno']),
                    );

                    $id_persona = ModeloUsuario::mdlRegistrarPersona($tabla, $datos);
                    if ($id_persona === false) {
                        echo '<br><div class="alert alert-danger">Error al registrar, vuelve a intentarlo</div>';
                    } else {
                        $tabla = "usuario";
                        $datos = array(
                            "id_usuario" => $id_persona,
                            "usuario" => trim($_POST['correo']),
                            "clave" => crypt(trim($_POST["clave"]), '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$'),
                            "rol" => "usuario"
                        );
                        $respuesta = ModeloUsuario::mdlRegistrarUsuario($tabla, $datos);
                        if ($respuesta === false) {
                            echo '<br><div class="alert alert-danger">Error al registrar, vuelve a intentarlo más tarde</div>';
                        } else {
                            $tabla = "usuario";
                            $item = "id_usuario";
                            $valor = $id_persona;
                            $respuesta = ModeloUsuario::MdlMostrarUsuarios($tabla, $item, $valor);
                            if ($respuesta) {
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
                        }
                    }
                }else{
                    echo '<br><div class="alert alert-danger">Error al registrar, vuelve a intentarlo</div>';
                }
            }else{
                echo '<br><div class="alert alert-danger">Las contraseñas no coinciden</div>';
            }
        }
    }
}
