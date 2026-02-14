<?php
include_once('../conexiones/conexione.php'); 
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include ("../session/funciones_admin.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
    } else { header("Location:../index.php");
}
$cuenta_actual                                 = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$cuenta                                        = $_SESSION['usuario'];
$tipo_ajax                                     = addslashes($_POST['tipo_ajax']);
$campo                                         = addslashes($_POST['campo']);

$retorno_array                                 = array();
$retorno_array2                                = array();
$codigoHTML_menu                               = '';
$codigoHTML_menu_total_reg                     = '';
$respuesta_ajax                                = array();
$fecha_actualizacion                           = date("Y-m-d");
// ------------------------------------------------------------------------------------------------- //
if (($tipo_ajax=='tbl15_producto_copia_inventario') && ($campo=='comentario_copia_inventario')) {
	$cod_producto_copia_inventario          = intval($_POST['id']);
	$comentario_copia_inventario            = addslashes($_POST['valor']);

	$data_sql = ("UPDATE tbl15_producto_copia_inventario SET comentario_copia_inventario = '$comentario_copia_inventario' WHERE cod_producto_copia_inventario = '$cod_producto_copia_inventario'");
	$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

	if (mysqli_affected_rows($conectar) > 0) { $afectado = "SI"; } else { $afectado = "NO"; }
	header('Content-Type: application/json');
	$respuesta_ajax['afectado']                        = $afectado;
	$respuesta_ajax['emisor']                          = $campo;
	$respuesta_ajax['incre']                           = $cod_producto_copia_inventario;
	$respuesta_ajax['mensaje']                         = "";

	echo json_encode($respuesta_ajax);
}
// ------------------------------------------------------------------------------------------------- //
if (($tipo_ajax=='tbl15_producto_copia_inventario') && ($campo=='und_producto_nuevo')) {
	$cod_producto_copia_inventario          = intval($_POST['id']);
	$und_producto_nuevo                     = addslashes($_POST['valor']);
	$cod_estado                             = 1;
	$cod_estado_check                       = 0;

	$data_sql = ("UPDATE tbl15_producto_copia_inventario SET und_producto_nuevo = '$und_producto_nuevo', cod_estado = '$cod_estado', cod_estado_check = '$cod_estado_check', fecha_actualizacion = '$fecha_actualizacion' 
	WHERE cod_producto_copia_inventario = '$cod_producto_copia_inventario'");
	$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

	$sql_productos_cargados = "SELECT * FROM tbl15_producto_copia_inventario WHERE (cod_producto_copia_inventario = '$cod_producto_copia_inventario')";
	$resultado_productos_cargados = mysqli_query($conectar, $sql_productos_cargados) or die(mysqli_error($conectar));
	$info_productos_cargados = mysqli_fetch_assoc($resultado_productos_cargados);

	$und_producto_nuevo                     = $info_productos_cargados['und_producto_nuevo'];
	$und_producto_viejo                     = $info_productos_cargados['und_producto_viejo'];
	$resta                                  = ($und_producto_viejo - $und_producto_nuevo) * -1;
    if ($resta < 0 && $cod_estado == '1') { $titulo_resultado = abs($resta)." UNDS FALTAN"; } elseif ($resta > 0 && $cod_estado == '1') { $titulo_resultado = abs($resta)." UNDS SOBRAN"; } elseif ($resta == 0 && $cod_estado == '1') { $titulo_resultado = "BIEN"; } else { $titulo_resultado = ""; }

    $sql_estado = "SELECT * FROM tbl15_estado WHERE cod_estado = '$cod_estado'";
    $resultado_estado = mysqli_query($conectar, $sql_estado);
    $info_estado = mysqli_fetch_assoc($resultado_estado);

    $nombre_estado                  = $info_estado['nombre_estado'];
    $color_fondo_celda_estado       = $info_estado['color_fondo_celda_estado'];
    $color_letra_celda_estado       = $info_estado['color_letra_celda_estado'];
    $color_fondo_celda              = $info_estado['color_fondo_celda'];
    $color_letra_celda              = $info_estado['color_letra_celda'];

   if (mysqli_affected_rows($conectar) > 0) { $afectado = "SI"; } else { $afectado = "NO"; }
	header('Content-Type: application/json');
	$respuesta_ajax['afectado']                        = $afectado;
	$respuesta_ajax['emisor']                          = $campo;
	$respuesta_ajax['incre']                           = $cod_producto_copia_inventario;
	$respuesta_ajax['color_fondo_celda_estado']        = $color_fondo_celda_estado;
	$respuesta_ajax['color_letra_celda_estado']        = $color_letra_celda_estado;
	$respuesta_ajax['color_fondo_celda']               = $color_fondo_celda;
	$respuesta_ajax['color_letra_celda']               = $color_letra_celda;
	$respuesta_ajax['mensaje']                         = $titulo_resultado;
	$respuesta_ajax['foco']                            = 'cod_producto_barra'.$cod_producto_copia_inventario;

	echo json_encode($respuesta_ajax);
}
?>