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

$diagnostico = isset($_POST['diagnostico']) ? $_POST['diagnostico'] : null;
$proceso = isset($_POST['proceso']) ? $_POST['proceso'] : null;
$cliente = isset($_POST['cliente']) ? $_POST['cliente'] : null;
$equipo = isset($_POST['equipo']) ? $_POST['equipo'] : null;

$btnOpt = isset($_POST['btn-action']) ? $_POST['btn-action'] : null;

$idToDelete = isset($_POST['id_to_delete']) ? $_POST['id_to_delete'] : null;

// ELIMINACIÖN
if ($idToDelete != null) {
    if ($newConnect->modifiquedDataOnDB("DELETE FROM tbl_diagnostico WHERE diag_id = ?", [$idToDelete])) {
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

    header("Location:" . APP_ROUTER_CONTROLLER_TO_VIEWS . ROUTES_VIEWS['home']);
}


if ($btnOpt != null) {
    switch ($btnOpt) {
        case 'save':
            if ($newConnect->modifiquedDataOnDB("INSERT INTO tbl_diagnostico (diag_diag, diag_proceso, diag_fk_cliente, diag_fk_equipo, diag_fk_user) VALUES (?, ?, ?, ?, ?)", [$diagnostico, $proceso, $cliente, $equipo, $_SESSION[SESSION_USER_DATA]['usr_id']])) {
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
            if ($newConnect->modifiquedDataOnDB("UPDATE tbl_diagnostico SET diag_diag = ?, diag_proceso = ?, diag_fk_cliente = ?, diag_fk_equipo = ? WHERE diag_id = ?", [$diagnostico, $proceso, $cliente, $equipo, $idToUpdate])) {
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
    header("Location:" . APP_ROUTER_CONTROLLER_TO_VIEWS . ROUTES_VIEWS['home']);
}
