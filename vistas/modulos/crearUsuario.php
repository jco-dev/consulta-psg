<?php



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
                        <li class="breadcrumb-item"><a href="<?= BASE_URL ?>">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="<?= BASE_URL ?>admin">Admin</a></li>
                        <li class="breadcrumb-item">Crear Usuario</li>

                    </ol>
                </div>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="row">

            <div class="col-sm-12 co-lg-8 col-md-10">

                <a href="<?= BASE_URL ?>admin" class="btn btn-warning btn-sm mb-2"><i class="fas fa-arrow-left "></i> Volver </a>
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Crear Nuevo Usuario</h3>
                    </div>

                    <?php
                    $usuario = new ControladorUsuario();

                    $usuario->ctrCrearUsuario();

                    ?>
                    <form action="#" method="POST">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="nombre">Nombre(s):</label>
                                        <input type="text" class="form-control" name="nombre" id="nombre" value="<?= $_POST["nombre"] ?? "" ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="paterno">Apellido Paterno </label>
                                        <input type="text" class="form-control" name="paterno" id="paterno" value="<?= $_POST["paterno"] ?? "" ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="materno">Apellido Materno </label>
                                        <input type="text" class="form-control" name="materno" id="materno" value="<?= $_POST["paterno"] ?? "" ?>" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="correo">Correo (Usuario)</label>
                                        <input type="email" class="form-control" name="correo" id="correo" value="<?= $_POST["correo"] ?? "" ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="rol">Rol</label>

                                    <select name="rol" id="rol" class="form-control"  required>
                                    <option value=""></option>
                                        <option value="admin" <?= isset($_POST["rol"]) && $_POST["rol"] == "admin" ? "selected": "" ?> >Administrador</option>
                                        <option value="usuario" <?= isset($_POST["rol"]) && $_POST["rol"] == "usuario" ? "selected": "" ?> >Usuario</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="contrasenia">Contraseña </label>
                                        <input type="password" class="form-control" name="contrasenia" id="contrasenia" value="<?= $_POST["contrasenia"] ?? "" ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="confirmarContrasenia">Confirmar Contraseña </label>
                                        <input type="password" class="form-control" name="confirmarContrasenia" id="confirmarContrasenia" value="<?= $_POST["confirmarContrasenia"] ?? "" ?>" required>
                                    </div>
                                </div>
                            </div>



                        </div>
                        <input type="hidden" name="accion" value="crearUsuario">


                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Crear Usuario</button>
                        </div>



                    </form>

                </div>




            </div>
        </div>
    </div>

</div>