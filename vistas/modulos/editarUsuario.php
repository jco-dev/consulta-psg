<?php
$ruta = explode('/', $_GET['ruta']);
$id_usuario = isset($ruta[1]) &&  $ruta[1]  ? $ruta[1] : 0;
$id_usuario = (int) $id_usuario;

if ($id_usuario != 0 && is_int($id_usuario)) {
    $usuario = ControladorUsuario::ctrMostrarUsuarios("id_usuario", $id_usuario);
} else {
    $usuario = null;
}

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
                        <li class="breadcrumb-item"><a href="<?= BASE_URL ?>preguntas">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="<?= BASE_URL ?>admin">Admin</a></li>

                        <li class="breadcrumb-item">Editar Contraseña</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="row">

            <div class="col-md-6">

                <a href="<?= BASE_URL ?>admin" class="btn btn-warning mb-2"><i class="fas fa-arrow-left "></i> Volver </a>
                <div class="card card-primary">
                    <?php if ($usuario != null) : ?>
                        <div class="card-header">
                            <h3 class="card-title">Recuperar Contraseña de Usuario</h3>
                        </div>

                        <?php
                        $actualizar = new ControladorUsuario();

                        $actualizar->ctrActualizarUsuario();

                        ?>
                        <form action="#" method="POST">
                            <div class="card-body">


                                <div class="form-group">
                                    <label>Nombre (S):</label>
                                    <input type="email" class="form-control" disabled value="<?= $usuario["nombre"] ?>">
                                </div>
                                <div class="form-group">
                                    <label>Paterno</label>
                                    <input type="email" class="form-control" disabled value="<?= $usuario["paterno"] ?>">
                                </div>
                                <div class="form-group">
                                    <label>Materno</label>
                                    <input type="email" class="form-control" disabled value="<?= $usuario["materno"] ?>">
                                </div>
                                <div class="form-group">
                                    <label>Correo</label>
                                    <input type="email" class="form-control" disabled value="<?= $usuario["usuario"] ?>">
                                </div>

                                <div class="form-group">
                                    <label for="contrasenia">Nueva Contraseña </label>
                                    <input type="password" class="form-control" id="contrasenia" name="contrasenia" value="<?= $_POST["contrasenia"] ?? "" ?>" required minlength="8">
                                </div>

                                <div class="form-group">
                                    <label for="confirmarContrasenia">Confirmar Contraseña </label>
                                    <input type="password" class="form-control" id="confirmarContrasenia" name="confirmarContrasenia" value="<?= $_POST["confirmarContrasenia"] ?? "" ?>" required minlength="8">
                                </div>

                                <input type="hidden" name="id_usuario" value="<?= $usuario["id_usuario"] ?>">

                            </div>


                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Actualizar</button>
                            </div>



                        </form>
                    <?php else : ?>
                        <div class="card-header">
                            <h3 class="card-title">No se encontro el usuario</h3>
                        </div>
                    <?php endif ?>
                </div>




            </div>
        </div>
    </div>

</div>