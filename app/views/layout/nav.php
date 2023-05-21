<nav class="navbar bg-dark navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= ROUTES_VIEWS['nav_home'] ?>"><?= APP_NAME ?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?= ROUTES_VIEWS['nav_clientes'] ?>">Clientes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?= ROUTES_VIEWS['nav_equipos'] ?>">Equipos</a>
                </li>
            </ul>
            <form class="d-flex" method="POST" action="<?= ROUTES_CONTROLLERS['layout_to_login'] ?>">
                <input type="hidden" name="delete-session" value="1">
                <div class="text-light me-2 mt-1">
                    <?= $_SESSION[SESSION_USER_DATA]['usr_nombre'] ?>
                </div>
                <button class="btn btn-outline-success" type="submit">Salir</button>
            </form>
        </div>
    </div>
</nav>