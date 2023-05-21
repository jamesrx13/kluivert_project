<?php
session_start();

include './../../imports/constains.php';
include './../../imports/routes.php';
include './../../imports/db/connexion.php';

if (!isset($_SESSION[SESSION_USER_DATA])) {
    header("Location:" . ROUTES_VIEWS['login']);
}

$newConnect = new ConnexionClass();
if (!$newConnect->getConnection()) {
    $msg = MSG_DB_ERROR;
    $_SESSION[SESSION_SCRIPTS] = <<<EX
        toastr["error"]("{$msg}");
EX;
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./../../imports/vendor/css/bootstrap.css">
    <link rel="stylesheet" href="./../../imports/vendor/css/toastr.css">
    <link rel="stylesheet" href="./../../imports/vendor/css/dataTable.css">
    <link rel="stylesheet" href="./../../imports/vendor/css/select2.css">
    <script src="./../../imports/vendor/js/jquery.js"></script>
    <title><?= APP_NAME ?></title>
</head>

<body>