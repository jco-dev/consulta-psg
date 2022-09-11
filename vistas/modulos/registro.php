<div class="register-box">
    <div class="register-logo">
        <a href="#"><b>Consultas</b>Posgrado</a>
    </div>

    <div class="card">
        <div class="card-body register-card-body">
            <p class="login-box-msg">Registrar una cuenta</p>

            <form action="#" method="post">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" autocomplete="off" placeholder="nombre" name="nombre" id="nombre" required />
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="paterno" name="paterno" id="paterno" required />
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>

                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="materno" name="materno" id="materno" />
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="email" class="form-control" placeholder="correo" name="correo" id="correo" required />
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="contraseña" name="clave" id="clave" required />
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="repita contraseña" name="repita_clave" id="repita_clave" required />
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Registro</button>
                    </div>
                </div>
                <?php
                    $registro = new ControladorUsuario();
                    $registro -> ctrRegistroUsuario();
                ?>
            </form>

            <div class="text-center mt-3">
                <a href="<?= BASE_URL . 'login' ?>" class="text-center">Ya tengo una cuenta</a>
            </div>
        </div>
        <!-- /.form-box -->
    </div><!-- /.card -->
</div>