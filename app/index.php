<?php
require_once("InicializadorDeModulos.php");
require_once("Router.php");

    session_start();

    $modulo = isset($_GET["module"]) ? $_GET["module"] : "holamundo";
    $accion = isset($_GET["action"]) ? $_GET["action"] : "index";

    $inicializadorDeModulos = new InicializadorDeModulos();
    Router::ejecutarAccionDeControlador($inicializadorDeModulos, $modulo, $accion);
?>
