<?php
// Configuraciones génerales
const APP_NAME = "Tecnoexpertos";

// Configuraciones de uso del sofware
const SESSION_SCRIPTS = "customs_scripts_session_" . APP_NAME;
const SESSION_USER_DATA = "current_user_data_" . APP_NAME;

// Configuraciones de la base de datos
const DB_NAME = "db_tecnoexpertos";
const DB_USER = "root";
const DB_PASSWORD = "";
const DB_HOST = "localhost";

// Mensajes
const MSG_DB_ERROR = "Error al establecer conexión con la base de datos.";
const MSG_FORM_DATA_ERROR = "Los campos requeridos no se han completado.";
const MSG_WELCOME = "Bienvenido, ";
const MSG_USER_NOT_FOUND = "Las credenciales ingresadas no coinciden.";
const MSG_USER_EXIT = "Sesión cerrada";
const MSG_NO_HAS_PERMISSION = "No puede ver este archivo";
const MSG_REGISTER_NOT_FOUND = "Registro no encontrado";
const MSG_SUCCESS_OPERATION = "Operación realizada con exito";
const MSG_ERROR_OPERATION = "Operación no realizada";
const MSG_ACCION_CONFIRM = "Confirmar esta acción";
const MSG_ACCION_UNKNOW = "Opereción desconocida";