<div class="content-wrapper">
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Inicio <small></small></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= BASE_URL . 'preguntas' ?>">Inicio</a></li>
                        <li class="breadcrumb-item">Preguntas</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container">
        <div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <div class="tab-content">
                    <div class="active tab-pane" id="activity ">

                        <?php
                            $item = null;
                            $valor = null;
                            $tabla = "pregunta";
                            $respuesta = ControladorPregunta::ctrMostrarPreguntas($tabla,$item,$valor);
                           foreach($respuesta as $value)
                           {
                                $date = new DateTime($value['fecha']);
                                $url = BASE_URL . 'respuesta/' . $value['id_pregunta'] . '/';
                                echo '<div class="post clearfix">
                                <div class="user-block">
                                    <img class="img-circle img-bordered-sm" src="'.BASE_URL.'vistas/dist/images/user.png" alt="Imagen de usuario">
                                    <span class="username">
                                        <a href="'.$url.'"">'.$value['titulo'].'</a>
                                        <p>juanca</p>
                                    </span>
                                    <span class="description">Compartido públicamente - '.$date->format('d/m/Y H:i A').'</span>
                                </div>
                                <!-- /.user-block -->
                                <p>
                                    '.$value['descripcion'].'
                                </p>

                            </div>';
                           }
                        ?>
                        
                    </div>

                </div>
                <!-- /.tab-content -->
            </div>
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col-md-6 -->
    <div class="col-lg-4">

        <div class="card">
            <div class="card-body">
                <a class="btn btn-primary btn-block" href="<?= BASE_URL . 'pregunta'?>">
                    Preguntar
                </a>
            </div>
        </div>
        <!-- <div class="card">
            <div class="card-body login-card-body">
                <fieldset >
                    <p class="login-box-msg">Iniciar Sesion</p>

                    <form action="" method="post">
                        <div class="input-group mb-3">
                            <input type="email" class="form-control" placeholder="correo" name="usuario" id="usuario" required="">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" placeholder="contraseña" name="clave" id="clave" required="">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-12 mt-1">
                                <button type="submit" class="btn btn-primary btn-block">
                                    Ingresar
                                </button>
                            </div>
                        </div>
                    </form>
                </fieldset>
            </div>
        </div> -->




    </div>
    <!-- /.col-md-6 -->
</div>
        </div>
    </div>
</div>