<nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
        <a href="/preguntas" class="navbar-brand">
            <img src="<?= BASE_URL ?>vistas/dist/images/logo.png" alt="logo posgrado" class="brand-image img-circle elevation-3" style="opacity: 0.8" />
            <span class="brand-text font-weight-light">Consultas PSG</span>
        </a>

        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="<?= BASE_URL ?>preguntas" class="nav-link">Inicio</a>
                </li>
                <?php if (isset($_SESSION["id"])) : ?>
                    <li class="nav-item">
                        <a href="<?= BASE_URL ?>perfil" class="nav-link">Perfil</a>
                    </li>
                <?php endif; ?>

                <?php if (isset($_SESSION["id"]) && $_SESSION["rol"] == "admin") : ?>

                    <li class="nav-item">
                        <a href="<?= BASE_URL ?>admin" class="nav-link">Usuarios</a>
                    </li>
                <?php endif; ?>
            </ul>

            <!-- SEARCH FORM -->
            <form class="form-inline ml-0 ml-md-3 d-none">
                <div class="input-group input-group-sm">
                    <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search" />
                    <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Right navbar links -->
        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
            <li class="nav-item dropdown"></li>
            <?php
            if (!isset($_SESSION['iniciarSesion'])) {
            ?>
                <a href="<?= BASE_URL . 'login' ?>" class="btn btn-outline-primary btn-sm">
                    Iniciar sesi??n
                </a>
                <a href="<?= BASE_URL . 'registro' ?>" class="btn btn-primary btn-sm ml-1">Reg??strate</a>
            <?php
            }
            if (isset($_SESSION['iniciarSesion']) && $_SESSION['iniciarSesion'] == 'ok') {
            ?>
                <div class="image">
                    <img src="<?= BASE_URL . 'vistas/dist/images/user.png' ?>" class="img-circle" width="30" alt="Imagen de usuario">
                </div>
                <?= '  ' . $_SESSION['nombre'] . ' ' . $_SESSION['paterno'] ?>
                <a href="<?= BASE_URL . 'salir' ?>" class="btn btn-outline-danger ml-1 btn-sm">
                    salir
                </a>

            <?php } ?>

        </ul>
    </div>
</nav>