<?php
$ruta = explode('/', $_GET['ruta']);
$id_pregunta = $ruta[1];
?>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Inicio <small></small></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Inicio</a></li>
                        <li class="breadcrumb-item">Respuesta</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="activity ">
                                    <!-- Post -->
                                    <?php
                                    $item = "id_pregunta";
                                    $valor = $id_pregunta;
                                    $tabla = "pregunta";
                                    $respuesta = ControladorPregunta::ctrMostrarPreguntas($tabla, $item, $valor);
                                    $date = new DateTime($respuesta['fecha']);
                                    ?>
                                    <div class="post">
                                        <div class="user-block">
                                            <img class="img-circle img-bordered-sm" src="<?= BASE_URL ?>/vistas/dist/images/user.png" width="128px" alt="user image ">
                                            <span class="username">
                                                <a href="#"><?= $respuesta['titulo'] ?></a>
                                                <p>Willy Huanca</p>
                                            </span>
                                            <span class="description">Compartido públicamente -
                                                <?= $date->format('d/m/y h:i A') ?> </span>
                                        </div>
                                        <!-- /.user-block -->
                                        <p>
                                            <?= $respuesta['descripcion'] ?>
                                        </p>
                                        <img class="img-fluid pad" src="<?= BASE_URL . $respuesta['foto_pregunta'] ?>" alt="Photo">

                                    </div>
                                    <!-- /.post -->

                                    <!-- Respuestas -->
                                    <?php
                                    $tabla = 'respuesta';
                                    $item = 'id_pregunta';
                                    $valor = $id_pregunta;
                                    $respuesta = ControladorRespuesta::ctrMostrarRespuestas($tabla, $item, $valor);

                                    if ($respuesta) {
                                        echo '<h3>' . count($respuesta) . ' Respuestas</h3><hr>';
                                        foreach ($respuesta as  $value) { ?>
                                            <div class="post clearfix">
                                                <!-- /.user-block -->
                                                <p>
                                                    <?= $value['descripcion_respuesta'] ?>
                                                </p>

                                                <div class="border float-right ml-5 p-1  mb-2">
                                                    <?php if ($value['foto_respuesta'] !=  NULL) { ?>
                                                        <img class="img-fluid pad" src="<?= BASE_URL . $value['foto_respuesta'] ?>" alt="respuesta">
                                                    <?php } ?>
                                                </div>

                                                <div class="row d-flex justify-content-end">
                                                    <div class="col-md-6">
                                                        <!-- <p class="float-left ml-2">
                                                            <a href="# " class="link-black text-primary">
                                                                <i class="fa fa-thumbs-up mr-1"></i> </a>
                                                            10 Like
                                                        </p> -->
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="user-block">
                                                            <img class="img-circle img-bordered-sm" src="<?= BASE_URL.'/vistas/dist/images/user.png' ?>" alt="User Image" />
                                                            <span class="username">
                                                                <small class="text-sm text-muted">Respondido el <?= $value['fecha']; ?> por:</small>
                                                                <p>juanca</p>
                                                            </span>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    <?php  }
                                    } else {
                                        echo '<h3>0 Respuestas</h3>';
                                    }
                                    ?>

                                    <div class="card card-primary card-outline">
                                        <div class="card-header">
                                            <h3 class="card-title">Tu respuesta</h3>
                                        </div>
                                        <!-- /.card-header -->
                                        <form method="POST" enctype="multipart/form-data">
                                            <div class="card-body">
                                                <h5>Escribe tu respuesta:</h5>
                                                <div class="form-group">
                                                    <input type="hidden" name="id_pregunta" id="id_pregunta" value="<?= $id_pregunta ?>">
                                                    <textarea name="descripcion_respuesta" id="descripcion_respuesta" class="form-control" rows="5" required></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <div class="btn btn-default btn-file">
                                                        <i class="fas fa-paperclip"></i> Subir una captura de la respuesta
                                                        <input type="file" name="foto" id="foto" accept="image/png, image/jpg, image/jpeg" />
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.card-body -->
                                            <div class="card-footer">
                                                <div class="float-right">
                                                    <button type="submit" class="btn btn-primary"> Publicar tu respuesta</button>
                                                </div>
                                            </div>
                                            <!-- /.card-footer -->
                                            <?php
                                            $crearRespuesta = new ControladorRespuesta();
                                            $crearRespuesta->ctrCrearRespuesta();
                                            ?>
                                        </form>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Otras Preguntas</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <ul class="nav nav-pills flex-column">
                                <?php
                                $tabla = 'pregunta';
                                $item = null;
                                $valor = null;
                                $respuesta = ControladorPregunta::ctrMostrarPreguntas($tabla, $item, $valor);
                                for ($i = count($respuesta) - 1; $i >= 0; $i--) {
                                    $url = BASE_URL . 'respuesta/' . $respuesta[$i]['id_pregunta'] . '/';
                                ?>
                                    <li class="nav-item active">
                                        <a href="<?= $url ?>" class="nav-link">
                                            <?= $respuesta[$i]['titulo'] ?>
                                        </a>
                                    </li>
                                <?php
                                }
                                ?>
                            </ul>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>