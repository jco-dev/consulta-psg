<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Consultas | Posgrado</title>
  <!-- CSS -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
  <link rel="stylesheet" href="vistas/plugins/fontawesome-free/css/all.min.css" />
  <link rel="stylesheet" href="vistas/dist/css/adminlte.min.css" />
  <!-- SCRIPTS    -->
  <script src="vistas/plugins/jquery/jquery.min.js"></script>
  <script src="vistas/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vistas/dist/js/adminlte.min.js"></script>

</head>

<body class="hold-transition layout-top-nav">
  <div class="wrapper">

    <?php
    include "modulos/header.php";
    if (isset($_GET['ruta'])) {
      if ($_GET['ruta'] == "inicio") {
        include 'modulos/consulta.php';
      }
    }
    include "modulos/footer.php";
    ?>

  </div>

</body>

</html>