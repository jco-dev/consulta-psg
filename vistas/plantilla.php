<?php
  require_once 'config/config.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Consultas | Posgrado</title>
    <!-- CSS -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
    <link rel="stylesheet" href="<?= BASE_URL ?>vistas/plugins/fontawesome-free/css/all.min.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>vistas/dist/css/adminlte.min.css" />
    <!-- SCRIPTS    -->
    <script src="<?= BASE_URL ?>vistas/plugins/jquery/jquery.min.js"></script>
    <script src="<?= BASE_URL ?>vistas/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= BASE_URL ?>vistas/dist/js/adminlte.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">
        <?php
          include "modulos/header.php";
          if (isset($_GET['ruta'])) {

            $vista = explode('/', $_GET['ruta']);
            
            if ($vista[0] == "preguntas" || 
                $vista[0] == "pregunta" ||
                $vista[0] == "respuesta" ||
                $vista[0] == "perfil" ||
                $vista[0] == "admin"||
                $vista[0] == "pdf"||
                $vista[0] == "editarUsuario"||
                $vista[0] == "crearUsuario" ||
                $vista[0] == "eliminarUsuario" 
                ) 
            {
              include "modulos/".$vista[0].".php";
            }else{
              include 'modulos/404.php';
            }
          }else{
            include 'modulos/preguntas.php';
          }

          include "modulos/footer.php";
        ?>
    </div>

</body>

</html>