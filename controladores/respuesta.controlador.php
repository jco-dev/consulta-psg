<?php

class ControladorRespuesta {
    
    static public function ctrMostrarRespuestas($tabla, $item, $valor)
    {
        $respuesta = ModeloRespuesta::mdlMostrarRespuestas($tabla, $item, $valor);
        return $respuesta;
    }

    static public function ctrCrearRespuesta()
    {
        if(isset($_POST['descripcion_respuesta']) && $_POST['descripcion_respuesta'] !== "")
        {
            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ¿?!¡,.() ]+$/', $_POST['descripcion_respuesta']))
            {
                // subir imagen
                if(isset($_FILES['foto']['name']) && $_FILES['foto']['name'] !== ""){
                    // subir imagen
                    $directorio = "vistas/uploads/respuesta/";
                    $ruta = $directorio . basename($_FILES['foto']['name']);
                    $tipoArchivo = strtolower(pathinfo($ruta, PATHINFO_EXTENSION));
                    $verificarSiImagen = getimagesize($_FILES['foto']['tmp_name']);

                    if($tipoArchivo == 'jpg' || $tipoArchivo == 'jpeg' || $tipoArchivo == 'png')
                    {
                        move_uploaded_file($_FILES['foto']['tmp_name'], $ruta);
                    }

                }else{
                    $ruta = null;
                }

                $tabla = "respuesta";
                $datos = array(
                    "descripcion_respuesta" => $_POST['descripcion_respuesta'],
                    "id_pregunta" => $_POST['id_pregunta'],
                    'fecha'       => date('Y-m-d H:i:s'),
                    'foto_respuesta' => $ruta,
                    'id_usuario'  => $_SESSION['id']
                );
                
                $respuesta = ModeloRespuesta::mdlCrearRespuesta($tabla, $datos);
                if($respuesta == "ok")
                {
                    echo '<script>
                    Swal.fire({
                        title: "¡Éxito!",
                        text: "La respuesta ha sido guardado correctamente",	
                        icon: "success",
                        showCancelButton: false,
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "Ok"
                      }).then((result) => {
                        if (result.isConfirmed) {
                            window.location = "'.BASE_URL.'respuesta/'.$_POST['id_pregunta'].'/";
                        }
                      })
                    </script>';
                }else{
                    echo '<script>
                    Swal.fire({
                        title: "¡Error!",
                        text: "La respuesta no ha sido guardado correctamente",	
                        icon: "error",
                        showCancelButton: false,
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "Ok"
                      }).then((result) => {
                        if (result.isConfirmed) {
                            window.location = "'.BASE_URL.'respuesta/'.$_POST['id_pregunta'].'/";
                        }
                      })
                    </script>';
                }
                
            }else{
                echo '<script>
                Swal.fire({
                    title: "¡Error!",
                    text: "¡La respuesta no puede ir vacía o llevar caracteres especiales!",	
                    icon: "error",
                    showCancelButton: false,
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "Ok"
                  }).then((result) => {
                    if (result.isConfirmed) {
                        window.location = "'.BASE_URL.'respuesta/'.$_POST['id_pregunta'].'/";
                    }
                  })
                </script>';
                return;
            }
        }
    }
}