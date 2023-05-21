<?php

// Rutas de las vistas
const APP_ROUTER_PREFIX = "./app/views/";
const APP_ROUTER_CONTROLLER_TO_VIEWS = "../../";

const ROUTES_VIEWS = [
    "login" => "../index.php",
    "home" => APP_ROUTER_PREFIX,
    "clientes" => APP_ROUTER_PREFIX . "?page=clientes",
    "equipos" => APP_ROUTER_PREFIX . "?page=equipos",
    "nav_home" => "./",
    "nav_clientes" => "?page=clientes",
    "nav_equipos" =>  "?page=equipos",
];

// Rudas de los controladores
const LOGIN_CONTROLLER_ROUTER_PREFIX = "./app/controllers/";
const CONTROLLER_ROUTER_PREFIX = "../controllers/";

const ROUTES_CONTROLLERS = [
    "login" => LOGIN_CONTROLLER_ROUTER_PREFIX . "LoginController.php",
    "clientes" => CONTROLLER_ROUTER_PREFIX . "ClientesController.php",
    "equipos" => CONTROLLER_ROUTER_PREFIX . "EquiposController.php",
    "home" => CONTROLLER_ROUTER_PREFIX . "HomeController.php",
    "app_to_login" => "../controllers/LoginController.php",
    "layout_to_login" => "../controllers/LoginController.php",
];
