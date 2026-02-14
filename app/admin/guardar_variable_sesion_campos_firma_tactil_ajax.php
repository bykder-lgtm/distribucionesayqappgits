<?php
if (isset($_POST['cod_grupo_area_cargo']) && ($_POST['cod_grupo_area_cargo'] <> '')) {
session_start();
date_default_timezone_set("America/Bogota");

if (isset($_POST['cod_cliente'])) { $cod_cliente = intval($_POST['cod_cliente']); } else { $cod_cliente = 0; }
if (isset($_POST['cedula'])) { $cedula = intval($_POST['cedula']); } else { $cedula = 0; }
if (isset($_POST['cod_grupo_area_cargo'])) { $cod_grupo_area_cargo = intval($_POST['cod_grupo_area_cargo']); } else { $cod_grupo_area_cargo = 0; }

$_SESSION['cod_grupo_area_cargo_sesion']            = $cod_grupo_area_cargo;
$_SESSION['cod_cliente_sesion']                     = $cod_cliente;
}
?>