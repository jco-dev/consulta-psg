
<?php

class ControladorUsuario
{

    static public function ctrMostrarUsuarios($item, $valor)
    {

        $respuesta = ModeloUsuario::mdlMostrarUsuarios($item, $valor);
        return $respuesta;
    }


    public function ctrMostrarUsuariosPaginar($pagina = null)
    {
        $ofset = null;
        if ($pagina != null) {
            $ofset = ($pagina - 1) * 10;
        } else {
            $pagina = 1;
        }

        $usuarios = ModeloUsuario::mdlMostrarUsuarios(null, null, $ofset);
        $cantidad = ModeloUsuario::mdlContarTablaPaginar('usuario');

        $cantidad = ceil($cantidad / 10);
        $datos = array(
            'usuarios' => $usuarios,
            'paginador' => $this->ctrCrearPaginador($cantidad, $pagina),

        );
        return $datos;
    }

    static public function ctrMostrarPreguntas($tabla, $campo, $condicion, $valor)
    {
        $respuesta = ModeloUsuario::mdlContarTabla($tabla, $campo, $condicion, $valor);
        return $respuesta;
    }




    private function ctrCrearPaginador($nroPaginas, $paginaActual)
    {

        $botones = '';

        for ($i = 1; $i <= $nroPaginas; $i++) {
            if ($paginaActual != $i) {
                $botones .= "<li class=\"page-item\"><a class=\"page-link\" href=\"" . BASE_URL . "admin/$i\">$i</a></li>";
            } else {
                $botones .= "
                <li class=\"page-item active\" aria-current=\"page\">
                    <span class=\"page-link\" >$i</span>
                </li>";
            }
        }
        $paginador = "
            <nav aria-label=\"...\">
                <ul class=\"pagination\">
                    $botones
                </ul>
            </nav>
            ";
        return $paginador;
    }

    public function ctrCrearUsuario()
    {
        if (isset($_POST['accion'])) {

            if ($this->validarCampos()) {

                $datos = [
                    "nombre" => strtoupper($this->post('nombre')),
                    "paterno" => strtoupper($this->post('paterno')),
                    "materno" => strtoupper($this->post('materno')),

                ];
                $id_persona = ModeloUsuario::mdlCrearPersona($datos);

                if ($id_persona > 0) {
                    $datosUsuario = [
                        "id_usuario" => $id_persona,
                        "usuario" => strtolower($this->post('correo')),
                        "rol" => $this->post('rol'),
                        "clave" => md5($this->post('nombre')),
                    ];
                    $respuesta = ModeloUsuario::mdlCrearUsuario($datosUsuario);
                    if ($respuesta > 0) {
                        echo '<script>
                        Swal.fire({
                            type: "success",
                            icon: "success",
                            title: "¡El Usuario se Creo Correctamente...",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                            }).then(function(result){
                                if (result.value) {
                                window.location = "' . BASE_URL . 'admin";
                                }
                            })
                        </script>';
                    } else {
                        echo '<script>
                        Swal.fire({
                            type: "error",
                            title: "¡Error al Crear Usuario",
                            icon: "error",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                            })
                        </script>';
                    }
                } else {
                    echo '<script>
                    Swal.fire({
                        type: "error",
                        title: "¡Error al registrar Persona",
                        icon:"error",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                        })
                    </script>';
                }
            }
        }
    }


    public function ctrEliminarUsuario($id_usuario)
    {
        if ($id_usuario != null) {
            $respuesta = ModeloUsuario::mdlEliminarUsuario($id_usuario);
        }
        header('location:' . BASE_URL . 'admin');
    }
    public function ctrActualizarUsuario()
    {
        if (isset($_POST["contrasenia"])) {
            $contrasenia = $_POST["contrasenia"];
            $confimarContrasenia = $_POST["confirmarContrasenia"];
            if ($contrasenia == $confimarContrasenia) {
                $id_usuario = $_POST["id_usuario"];
                $datos = array(
                    "clave" => md5($contrasenia),
                );
                $respuesta = ModeloUsuario::mdlActualizarUsuario($datos, $id_usuario);
                if ($respuesta) {

                    unset($_POST["contrasenia"]);
                    unset($_POST["confirmarContrasenia"]);
                    echo '<script>
                    Swal.fire({
                        type: "error",
                        icon: "warning",
                        title: "¡El Usuario se actualizo Correctamente...",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                        }).then(function(result){
                            if (result.value) {
                            window.location = "' . BASE_URL . 'admin";
                            }
                        })
                    </script>';
                } else {
                    echo '<script>
                    Swal.fire({
                        type: "error",
                        title: "¡No se pudo procesar su solicitud",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                        })
                    </script>';
                }
            } else {
                echo '<script>
                Swal.fire({
                    type: "error",
                    icon: "warning",
                    title: "¡Las contraseñas no coinciden, intente nuevamente!",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"
                    })
                </script>';
            }
        }
    }


    private function validarCampos()
    {
        require "libraries/validacion.php";


        $campos = [
            'nombre' => $this->post('nombre'),
            'paterno' => $this->post('paterno'),
            'materno' => $this->post('materno'),
            'usuario' => $this->post('correo'),
            'contrasenia' => $this->post('contrasenia'),
            'confirmarContrasenia' => $this->post('confirmarContrasenia'),
            'rol' => $this->post('rol'),
        ];
        $reglas = [
            'nombre' => 'required',
            'paterno' => 'required',
            'materno' => 'required',
            'usuario' => 'required|email|unique:usuario',
            'contrasenia' => 'required|password|passwordConfirm:confirmarContrasenia',
            'confirmarContrasenia' => 'required',
            'rol' => 'required',
        ];
        $validacion = Validation::validate($campos, $reglas);


        if (!empty($validacion)) {
            $errores = "";
            foreach ($validacion as $error) {
                $errores .= $error;
            }
            // var_dump($errores);die();

            echo '<script>
            Swal.fire({
                type: "error",
                icon: "warning",
                title: "¡Error!...",
                html: "' . $errores . '",
                showConfirmButton: true,
                confirmButtonText: "Cerrar"
                })
            </script>';
            return false;
        } else {
            return true;
        }
    }



    private function post($campo)
    {
        if (isset($_POST[$campo]) && !empty($_POST[$campo])) {
            return $_POST[$campo];
        } else {
            return null;
        }
    }
}
