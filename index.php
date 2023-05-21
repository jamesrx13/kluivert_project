<?php

session_start();
include './imports/constains.php';
include './imports/routes.php';
include './imports/db/connexion.php';

$newConnect = new ConnexionClass();
if (!$newConnect->getConnection()) {
    $msg = MSG_DB_ERROR;
    $_SESSION[SESSION_SCRIPTS] = <<<EX
        toastr["error"]("{$msg}");
EX;
}

if (isset($_SESSION[SESSION_USER_DATA])) {
    header("Location:" . ROUTES_VIEWS['home']);
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./imports/vendor/css/bootstrap.css">
    <link rel="stylesheet" href="./imports/vendor/css/toastr.css">
    <script src="./imports/vendor/js/jquery.js"></script>
    <title><?= APP_NAME ?> - Login</title>
</head>

<body>

    <section class="vh-100" style="background-color: #A7E89F;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card" style="border-radius: 1rem;">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5 d-none d-md-block">
                                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/img1.webp" alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">

                                    <form method="POST" action="<?= ROUTES_CONTROLLERS['login'] ?>">

                                        <div class="d-flex align-items-center mb-3 pb-1">
                                            <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                                            <span class="h1 fw-bold mb-0"><?= APP_NAME ?></span>
                                        </div>

                                        <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Inicia sesión con
                                            tu cuenta</h5>

                                        <div class="form-outline mb-4">
                                            <input type="email" name="userEmail" class="form-control form-control-lg" required />
                                            <label class="form-label" for="userEmail">Usuario</label>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input type="password" name="userPassword" class="form-control form-control-lg" required />
                                            <label class="form-label" for="userPassword">Contraseña</label>
                                        </div>

                                        <div class="pt-1 mb-4">
                                            <button class="btn btn-dark btn-lg btn-block" type="submit">Iniciar</button>
                                        </div>

                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script src="./imports/vendor/js/bootstrap.js"></script>
    <script src="./imports/vendor/js/toastr.min.js"></script>

    <!-- Ejecutar scripts eviados por la sesión -->
    <script>
        <?php
        echo $_SESSION[SESSION_SCRIPTS];
        $_SESSION[SESSION_SCRIPTS] = null;
        ?>
    </script>
</body>

</html>