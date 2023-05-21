<?php
session_start();

include "../../imports/constains.php";
include "../../imports/routes.php";
include "../../imports/db/connexion.php";

$newConnect = new ConnexionClass();

if (!isset($_SESSION[SESSION_USER_DATA])) {
    $msg = MSG_NO_HAS_PERMISSION;
    $_SESSION[SESSION_SCRIPTS] = <<<EX
    toastr["error"]("{$msg}");
    EX;
    header("Location:" . ROUTES_VIEWS['login']);
}

if (!$newConnect->getConnection()) {
    $msg = MSG_DB_ERROR;
    $_SESSION[SESSION_SCRIPTS] = <<<EX
    toastr["error"]("{$msg}");
    EX;
    header("Location:" . ROUTES_VIEWS['login']);
}

$idToUpdate = isset($_POST['id_to_update']) ? $_POST['id_to_update'] : null;

$name = isset($_POST['name']) ? $_POST['name'] : null;
$ccNit = isset($_POST['cc_nit']) ? $_POST['cc_nit'] : null;
$phone = isset($_POST['phone']) ? $_POST['phone'] : null;
$email = isset($_POST['email']) ? $_POST['email'] : null;
$address = isset($_POST['addres']) ? $_POST['addres'] : null;

$btnOpt = isset($_POST['btn-action']) ? $_POST['btn-action'] : null;

$idToDelete = isset($_POST['id_to_delete']) ? $_POST['id_to_delete'] : null;

// ELIMINACIÖN
if ($idToDelete != null) {
    if ($newConnect->modifiquedDataOnDB("DELETE FROM tbl_clientes WHERE cli_id = ?", [$idToDelete])) {
        $msg = MSG_SUCCESS_OPERATION;
        $_SESSION[SESSION_SCRIPTS] = <<<EX
        toastr["success"]("{$msg}");
        EX;
    } else {
        $msg = MSG_ERROR_OPERATION;
        $_SESSION[SESSION_SCRIPTS] = <<<EX
        toastr["error"]("{$msg}");
        EX;
    }

    header("Location:" . APP_ROUTER_CONTROLLER_TO_VIEWS . ROUTES_VIEWS['clientes']);
}


if ($btnOpt != null) {
    switch ($btnOpt) {
        case 'save':
            if ($newConnect->modifiquedDataOnDB("INSERT INTO tbl_clientes (cli_nombre, cli_cc_nit, cli_telefono, cli_correo, cli_direccion) VALUES (?, ?, ?, ?, ?)", [$name, $ccNit, $phone, $email, $address])) {
                $msg = MSG_SUCCESS_OPERATION;
                $_SESSION[SESSION_SCRIPTS] = <<<EX
                toastr["success"]("{$msg}");
                EX;
            } else {
                $msg = MSG_ERROR_OPERATION;
                $_SESSION[SESSION_SCRIPTS] = <<<EX
                toastr["error"]("{$msg}");
                EX;
            }
            break;
        case 'update':
            if ($newConnect->modifiquedDataOnDB("UPDATE tbl_clientes SET cli_nombre = ?, cli_cc_nit = ?, cli_telefono = ?, cli_correo = ?, cli_direccion = ? WHERE cli_id = ?", [$name, $ccNit, $phone, $email, $address, $idToUpdate])) {
                $msg = MSG_SUCCESS_OPERATION;
                $_SESSION[SESSION_SCRIPTS] = <<<EX
                toastr["success"]("{$msg}");
                EX;
            } else {
                $msg = MSG_ERROR_OPERATION;
                $_SESSION[SESSION_SCRIPTS] = <<<EX
                toastr["error"]("{$msg}");
                EX;
            }
            break;

        default:
            $msg = MSG_ACCION_UNKNOW;
            $_SESSION[SESSION_SCRIPTS] = <<<EX
                toastr["error"]("{$msg}");
            EX;
            break;
    }
    header("Location:" . APP_ROUTER_CONTROLLER_TO_VIEWS . ROUTES_VIEWS['clientes']);
}