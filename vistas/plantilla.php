<?php
session_start();
require_once 'config/config.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Consultas | Posgrado</title>
  <!-- CSS -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
  <link rel="stylesheet" href="<?= BASE_URL ?>vistas/plugins/fontawesome-free/css/all.min.css" />
  <link rel="stylesheet" href="<?= BASE_URL ?>vistas/dist/css/adminlte.min.css" />
  <!-- SCRIPTS    -->
  <script src="<?= BASE_URL ?>vistas/plugins/jquery/jquery.min.js"></script>
  <script src="<?= BASE_URL ?>vistas/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= BASE_URL ?>vistas/dist/js/adminlte.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<?php
if (isset($_GET['ruta'])) {
  $vista = explode('/', $_GET['ruta']);
  if ($vista[0] == 'login') {
    $clase = 'login-page';
  }
  if ($vista[0] == 'registro') {
    $clase = 'register-page';
  }
} else {
  $clase = '';
}
?>

<body class="hold-transition layout-top-nav <?= $clase ?>">

  <?php
  if (isset($_GET['ruta'])) {
    $vista = explode('/', $_GET['ruta']);
    if ($vista[0] != "login" && $vista[0] != "registro") {

      echo '<div class="wrapper">';
      include "modulos/header.php";
    }

    if (
      $vista[0] == "preguntas" ||
      $vista[0] == "pregunta" ||
      $vista[0] == "respuesta" ||
      ($vista[0] == "perfil" && isset($_SESSION["id"])) ||
      ($vista[0] == "admin" && isset($_SESSION["rol"]) && $_SESSION["rol"]=="admin" ) ||
      $vista[0] == "login" ||
      $vista[0] == "salir" ||
      $vista[0] == "registro" ||
      $vista[0] == "pdf" ||
      $vista[0] == "editarUsuario" ||
      $vista[0] == "crearUsuario" ||
      $vista[0] == "eliminarUsuario"
    ) {
      include "modulos/" . $vista[0] . ".php";
    } else {
      include 'modulos/404.php';
    }
  } else {
    include 'modulos/preguntas.php';
  }

  if ($vista[0] != "login" && $vista[0] != "registro") {
    include "modulos/footer.php";
    echo ' </div>';
  }
  ?>


</body>

</html>