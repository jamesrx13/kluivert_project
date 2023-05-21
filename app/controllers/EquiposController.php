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

$marca = isset($_POST['marca']) ? $_POST['marca'] : null;
$serial = isset($_POST['serial']) ? $_POST['serial'] : null;
$description = isset($_POST['description']) ? $_POST['description'] : null;
$ram = isset($_POST['ram']) ? $_POST['ram'] : null;
$discoDuro = isset($_POST['disco_duro']) ? $_POST['disco_duro'] : null;
$procesador = isset($_POST['procesador']) ? $_POST['procesador'] : null;

$btnOpt = isset($_POST['btn-action']) ? $_POST['btn-action'] : null;

$idToDelete = isset($_POST['id_to_delete']) ? $_POST['id_to_delete'] : null;

// ELIMINACIÖN
if ($idToDelete != null) {
    if ($newConnect->modifiquedDataOnDB("DELETE FROM tbl_equipo WHERE eqp_id = ?", [$idToDelete])) {
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

    header("Location:" . APP_ROUTER_CONTROLLER_TO_VIEWS . ROUTES_VIEWS['equipos']);
}


if ($btnOpt != null) {
    switch ($btnOpt) {
        case 'save':
            if ($newConnect->modifiquedDataOnDB("INSERT INTO tbl_equipo (eqp_marca, eqp_sereal, eqp_descripcion, eqp_ram, eqp_tipo_disco_duro, eqp_procesador) VALUES (?, ?, ?, ?, ?, ?)", [$marca, $serial, $description, $ram, $discoDuro, $procesador])) {
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
            if ($newConnect->modifiquedDataOnDB("UPDATE tbl_equipo SET eqp_marca = ?, eqp_sereal = ?, eqp_descripcion = ?, eqp_ram = ?, eqp_tipo_disco_duro = ?, eqp_procesador = ? WHERE eqp_id = ?", [$marca, $serial, $description, $ram, $discoDuro, $procesador, $idToUpdate])) {
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
    header("Location:" . APP_ROUTER_CONTROLLER_TO_VIEWS . ROUTES_VIEWS['equipos']);
}
