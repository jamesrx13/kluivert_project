<?php
session_start();

include "../../imports/constains.php";
include "../../imports/routes.php";
include "../../imports/db/connexion.php";

$newConnect = new ConnexionClass();

if (!$newConnect->getConnection()) {
    $msg = MSG_DB_ERROR;
    $_SESSION[SESSION_SCRIPTS] = <<<EX
    toastr["error"]("{$msg}");
    EX;
    header("Location:" . ROUTES_VIEWS['login']);
}

$email = isset($_POST['userEmail']) ? $_POST['userEmail'] : null;
$password = isset($_POST['userPassword']) ? $_POST['userPassword'] : null;
$deleteSession = isset($_POST['delete-session']) ? $_POST['delete-session'] : null;

if ($deleteSession != null) {
    header("Location:" . APP_ROUTER_CONTROLLER_TO_VIEWS . ROUTES_VIEWS['home']);
    session_destroy();
}

if ($email != null && $password != null) {
    $user = $newConnect->getDataExecuteSQL("SELECT * FROM tbl_usuarios WHERE usr_correo = ? AND usr_pass = ?", [$email, $password]);
    if ($user != []) {
        $_SESSION[SESSION_USER_DATA] = $user;
        $msg = MSG_WELCOME;
        $userName = $_SESSION[SESSION_USER_DATA]['usr_nombre'];
        $_SESSION[SESSION_SCRIPTS] = <<<EX
            toastr["success"]("{$msg} {$userName}");
        EX;
        header("Location:" . APP_ROUTER_CONTROLLER_TO_VIEWS . ROUTES_VIEWS['home']);
    } else {
        $msg = MSG_USER_NOT_FOUND;
        $_SESSION[SESSION_SCRIPTS] = <<<EX
            toastr["error"]("{$msg}");
        EX;
        header("Location:" . ROUTES_VIEWS['login']);
    }
} else {
    $msg = MSG_FORM_DATA_ERROR;
    $_SESSION[SESSION_SCRIPTS] = <<<EX
        toastr["error"]("{$msg}");
    EX;
    header("Location:" . ROUTES_VIEWS['login']);
}
