<?php

class ControladorPregunta {

    static public  function ctrCrearPregunta()
    {
        if(isset($_POST['titulo']))
        {
            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ¿?,. ]+$/',$_POST['titulo']) && preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ¿?,. ]+$/',$_POST['descripcion']))
            {
                
                // subir file 
                $directorio = "vistas/uploads/pregunta/";
                $archivo = $directorio . basename($_FILES['foto']['name']);
                $tipoArchivo = strtolower(pathinfo($archivo, PATHINFO_EXTENSION));
                $verificarSiImagen = getimagesize($_FILES['foto']['tmp_name']);

                if($verificarSiImagen != false)
                {
                    // validando la imagen del archivo
                    $tamanio = $_FILES['foto']['size'];
                    if($tamanio > 500000)
                    {
                        $msg = "La imagen debe ser menos a 500 KB";
                    }

                    if($tipoArchivo == 'jpg' || $tipoArchivo == 'jpeg' || $tipoArchivo == 'png')
                    {
                        if(move_uploaded_file($_FILES['foto']['tmp_name'], $archivo)){
                            $tabla = "pregunta";
                            $datos = array(
                                "titulo"        => $_POST['titulo'],
                                "descripcion"   => $_POST['descripcion'],
                                "foto_pregunta" => $archivo,
                            );

                            $respuesta = ModeloPregunta::mdlCrearPregunta($tabla,$datos);
                            if($respuesta == "ok")
                            {
                                echo '<script>
                                Swal.fire({
                                    title: "¡Éxito!",
                                    text: "La pregunta ha sido guardado correctamente",	
                                    icon: "success",
                                    showCancelButton: false,
                                    confirmButtonColor: "#3085d6",
                                    confirmButtonText: "Ok"
                                  }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location = "preguntas";
                                    }
                                  })
                                </script>';
                            }else{
                                echo '<script>
                                Swal.fire({
                                    title: "¡Error!",
                                    text: "¡La pregunta no se pudo guardar!",	
                                    icon: "error",
                                    showCancelButton: false,
                                    confirmButtonColor: "#3085d6",
                                    confirmButtonText: "Ok"
                                  }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location = "pregunta";
                                    }
                                  })
                                </script>';
                            }              
                        }
                     }else{
                        echo '<script>
                                Swal.fire({
                                    title: "¡Error!",
                                    text: "Solo se admiten archivos jpg, jpeg y png",	
                                    icon: "error",
                                    showCancelButton: false,
                                    confirmButtonColor: "#3085d6",
                                    confirmButtonText: "Ok"
                                  }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location = "pregunta";
                                    }
                                  })
                                </script>';
                    }

                }else{
                    echo '<script>
                                Swal.fire({
                                    title: "¡Error!",
                                    text: "El archivo no es una imagen",	
                                    icon: "error",
                                    showCancelButton: false,
                                    confirmButtonColor: "#3085d6",
                                    confirmButtonText: "Ok"
                                  }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location = "pregunta";
                                    }
                                  })
                                </script>';
                }

            }else{
                echo '<script>
                Swal.fire({
                    title: "Advertencia!",
                    text: "El titulo y la descripcion no pueden ir vacios o llevar caracteres especiales",	
                    icon: "warning",
                    showCancelButton: false,
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "Ok"
                  }).then((result) => {
                    if (result.isConfirmed) {
                        window.location = "pregunta";
                    }
                  })
                </script>';
            }
        }
    }

    static public function ctrMostrarPreguntas($tabla, $item,$valor)
    {
        $respuesta = ModeloPregunta::mdlMostrarPregunta($tabla,$item,$valor);
        return $respuesta;
    }

    static public function ctrMostrarPreguntasUsuario($valor)
    {
        $respuesta = ModeloPregunta::mdlMostrarPreguntasUsuario($valor);
        return $respuesta;
    }
    

}