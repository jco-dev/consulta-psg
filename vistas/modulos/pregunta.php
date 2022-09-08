<div class="content-wrapper">
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Formular una pregunta <small></small></h1>
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

    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <form method="POST" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="titulo">Título</label>
                                    <input type="text" class="form-control" id="titulo" name="titulo"
                                        placeholder="titulo de la pregunta" required />
                                </div>
                                <div class="form-group">
                                    <label for="descripcion">Descripción</label>
                                    <textarea name="descripcion" id="descripcion" rows="5" class="form-control" required></textarea>
                                </div>
                                        
                                <div class="form-group">
                                    <label for="exampleInputFile">Cargar Imagen o captura</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="foto" name="foto"
                                                required />
                                            <label class="custom-file-label" for="foto">seleccione la foto</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-save"></i>
                                    Guardar
                                </button>
                            </div>
                            <?php
                                $crearPregunta = new ControladorPregunta();
                                $crearPregunta->ctrCrearPregunta();
                            ?>
                        </form>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title m-0">Paso 1: Redacta tu pregunta</h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                La comunidad está aquí para ayudarlo con problemas
                                específicos de codificación, algoritmos o lenguaje.
                            </p>
                            <ul>
                                <li>Resuma el problema</li>
                                <li>Describa lo que has probado</li>
                                <li>Si es necesario suba una captura del problema</li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>