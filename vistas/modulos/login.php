
    <div class="login-box">
      <div class="login-logo">
        <a href="#"><b>Consultas</b>Posgrado</a>
      </div>
      <div class="card">
        <div class="card-body login-card-body">
          <p class="login-box-msg">Bienvenido</p>

          <form action="" method="post">
            <div class="input-group mb-3">
              <input
                type="email"
                class="form-control"
                placeholder="correo"
                name="usuario"
                id="usuario"
                required
              />
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input
                type="password"
                class="form-control"
                placeholder="contraseña"
                name="clave"
                id="clave"
                required
              />
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <!-- <div class="col-8">
                <div class="icheck-primary">
                  <input type="checkbox" id="remember" />
                  <label for="remember"> Recordarme </label>
                </div>
              </div> -->
              <div class="col-12 mt-1">
                <button type="submit" class="btn btn-primary btn-block">
                  Ingresar
                </button>
              </div>
            </div>
            <?php
              $login = new ControladorUsuario();
              $login -> ctrIngresoUsuario();
            ?>
          </form>

          <p class="mb-1 mt-4 text-center">
            <a href="<?= BASE_URL ?>preguntas"> Volver a Inicio</a>
          </p>
        </div>
      </div>
    </div>
