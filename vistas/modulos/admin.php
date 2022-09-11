<?php

$ruta = explode('/', $_GET['ruta']);
$pagina = isset($ruta[1]) &&  $ruta[1] != "" ? $ruta[1] : 1;



$usuario = new  ControladorUsuario();
$datosListar = $usuario->ctrMostrarUsuariosPaginar($pagina);

$listaUsuarios = $datosListar['usuarios'];
$paginador = $datosListar['paginador'];
$contador = 1 + ($pagina == 1 ? 0 : ($pagina-1) * 10);


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
                        <li class="breadcrumb-item">Admin</li>
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

                        <a href="<?= BASE_URL ?>crearUsuario" class="btn btn-primary"><i class="fas fa-plus"></i> Crear Usuario</a>


                    </div>
                    <hr>
                    <div class="card-body">
                        <div class="d-flex justify-content-start">

                            <form action="<?= BASE_URL ?>controladores/reportes/excel.php" target="_blank" method="POST">
                                <button class="btn btn-success" type="submit" name="excel" value="crear"><i class="fas fa-file-excel"></i> EXCEL</button>

                            </form>
                            <form action="<?= BASE_URL ?>controladores/reportes/pdf.php" target="_blank" method="POST">
                                <button class="btn btn-danger" type="submit" name="pdf" value="crear"><i class="fas fa-file-pdf"></i> PDF</button>

                            </form>

                        </div>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Paterno</th>
                                    <th>Materno</th>
                                    <th>Correo</th>
                                    <th>Tipo</th>

                                    <th>Estado</th>
                                    <th>.::Acciones::.</th>

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
                                        <td><?= $user["rol"] ?></td>

                                        <td><?= $user["estado"] ?></td>
                                        <td>
                                            <a href="<?= BASE_URL ?>editarUsuario/<?= $user["id_usuario"] ?>" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                            <a href="<?= BASE_URL ?>eliminarUsuario/<?= $user["id_usuario"] ?>" class="btn btn-danger" onclick="return confirm('Esta Seguro de Desactivar Este Usuario')"><i class="fas fa-times"></i></a>
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