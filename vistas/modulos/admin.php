<?php

$ruta = explode('/', $_GET['ruta']);
$pagina = isset($ruta[1]) &&  $ruta[1] != "" ? $ruta[1] : 1;



$usuario = new  ControladorUsuario();
$datosListar = $usuario->ctrMostrarUsuariosPaginar($pagina);

$listaUsuarios = $datosListar['usuarios'];
$paginador = $datosListar['paginador'];
$contador = 1 + ($pagina == 1 ? 0 : $pagina * 10);


// var_dump($contador);
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Admin<small></small></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Inicio</a></li>
                        <li class="breadcrumb-item">Pregunta</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class=" p-2 d-flex justify-content-between">
                        <h2>Usuarios Registrados</h2>

                        <div class="d-flex justify-content-between">

                            <form action="<?= BASE_URL ?>controladores/reportes/excel.php" target="_blank" method="POST">
                                <button class="btn btn-success" type="submit" name="excel" value="crear"><i class="fas fa-file-excel"></i> EXCEL</button>

                            </form>
                            <form action="<?= BASE_URL ?>controladores/reportes/pdf.php" target="_blank" method="POST">
                                <button class="btn btn-danger" type="submit" name="pdf" value="crear"><i class="fas fa-file-pdf"></i> PDF</button>

                            </form>

                        </div>

                    </div>
                    <hr>
                    <div class="card-body">

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <td>#</td>
                                    <td>Nombre</td>
                                    <td>Paterno</td>
                                    <td>Materno</td>
                                    <td>Correo</td>
                                    <td>.::Acciones::.</td>

                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($listaUsuarios as $user) :  ?>
                                    <tr>
                                        <td><?= $contador ?></td>
                                        <td><?= $user["nombre"] ?></td>
                                        <td><?= $user["paterno"] ?></td>
                                        <td><?= $user["materno"] ?></td>
                                        <td><?= $user["usuario"] ?></td>
                                        <td>
                                            <a href="<?= BASE_URL ?>/usuario/editar/<?= $user["id_usuario"] ?>" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                            <a href="<?= BASE_URL ?>/usuario/eliminar/<?= $user["id_usuario"] ?>" class="btn btn-danger" onclick="return confirm('Esta Seguro de Eliminar Este Item')"><i class="fas fa-trash"></i></a>
                                        </td>


                                    </tr>
                                <?php
                                    $contador++;
                                endforeach
                                ?>

                                <?php if (empty($listaUsuarios)) :  ?>
                                    <tr>
                                        <td colspan="10" class="text-center">No se Encontraron Resultados</td>
                                    </tr>
                                <?php endif ?>

                            <tbody>

                        </table>
                        <div class="mt-2">
                            <?= $paginador ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>