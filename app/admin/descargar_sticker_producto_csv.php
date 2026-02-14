<?php
include_once('../conexiones/conexione.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
//include_once('../admin/fecha_en_espanol.php');
include_once("../session/funciones_admin.php");
//include("../tbl15_notificacion_alerta/mostrar_noficacion_alerta.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
  } else { header("Location:../index.php");
}

$fecha                               = date("Ymd");
$hora                                = date("His");
$salida                              = "";

if (isset($_GET['cod_info_factura_sticker'])) {

$cod_info_factura_sticker            = intval($_GET['cod_info_factura_sticker']);
$nombre_archivo                      = "STICKER_BARRAS_".$cod_info_factura_sticker.'_'.$fecha.'_'.$hora.'.csv';

header("Content-type: application/vnd.ms-excel" ) ;
header("Content-Disposition: attachment; filename=$nombre_archivo" );

$salida .='CODIGO_BARRAS'.',';
$salida .='NOMBRE_PRODUCTO'.',';
$salida .='UNIDADES'.',';
$salida .='PRECIO_COMPRA'.',';
$salida .='PRECIO_VENTA'.',';
$salida .='PRECIO_COMPRA_CODIF'.',';
$salida .='PRECIO_VENTA_CODIF'.',';
$salida .='FECHA_COMPRA'.',';
$salida .='COD_PROVEEDOR'.'';
$salida .="\n";

$incremento                 = 0;
$arrayCodigos               = array();
$cod_letra_numero_compra    = 0;
$cod_letra_numero_venta     = 0;
$nombre_letra_numero_compra = 0;
$nombre_letra_numero_venta  = 0;

$mostrar_datos_sql = "SELECT und_venta, nombre_producto, cod_producto_barra, precio_compra_producto, precio_venta_producto, cod_tercero
FROM tbl15_sticker_producto WHERE cod_info_factura_sticker = '$cod_info_factura_sticker' ORDER BY cod_sticker_producto ASC";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
while ($datos = mysqli_fetch_assoc($consulta)) {

$und_venta                  = $datos['und_venta'];
$nombre_producto            = substr($datos['nombre_producto'], 0, 80);
$cod_producto_barra         = $datos['cod_producto_barra'];
$precio_compra_producto     = intval($datos['precio_compra_producto']);
$precio_venta_producto      = intval($datos['precio_venta_producto']);
//$fecha_ult_compra           = $datos['fecha_ult_compra'];
$arrayCodigos[]             = (string)$cod_producto_barra; 
$cantidad_contadores        = substr_count($precio_compra_producto, '0');
$contar_palabra             = str_word_count($precio_compra_producto, 1, '0');
$cantidad_separaciones      = count($contar_palabra);

$cantidad_digitos_compra    = strlen($precio_compra_producto);
$matriz_digitos_compra      = str_split($precio_compra_producto);
$codif_letra_precio_compra  = "";

$cantidad_digitos_venta     = strlen($precio_venta_producto);
$matriz_digitos_venta       = str_split($precio_venta_producto);
$codif_letra_precio_venta   = "";

$total_caracteres           = strlen($nombre_producto);
$contar_ceros_compra        = 0;
$contar_ceros_venta         = 0;

for ($i=0; $i < $cantidad_digitos_compra; $i++) { 
$cod_letra_numero_compra    = $matriz_digitos_compra[$i];

$sql_letra_numero_compra = "SELECT cod_letra_numero, nombre_letra_numero FROM tbl15_letra_numero WHERE cod_letra_numero = '$cod_letra_numero_compra '";
$consulta_letra_numero_compra = mysqli_query($conectar, $sql_letra_numero_compra) or die(mysqli_error($conectar));
$datos_letra_numero_compra = mysqli_fetch_assoc($consulta_letra_numero_compra);

if ($cod_letra_numero_compra == '0') {
$nombre_letra_numero_compra = $contar_ceros_compra++;
} else {
$nombre_letra_numero_compra = $datos_letra_numero_compra['nombre_letra_numero'];
}
$codif_letra_precio_compra   = $codif_letra_precio_compra.$nombre_letra_numero_compra;
}

for ($i=0; $i < $cantidad_digitos_venta; $i++) { 

$cod_letra_numero_venta     = $matriz_digitos_venta[$i];

$sql_letra_numero = "SELECT cod_letra_numero, nombre_letra_numero FROM tbl15_letra_numero WHERE cod_letra_numero = '$cod_letra_numero_venta '";
$consulta_letra_numero = mysqli_query($conectar, $sql_letra_numero) or die(mysqli_error($conectar));
$datos_letra_numero = mysqli_fetch_assoc($consulta_letra_numero);

if ($cod_letra_numero_venta == '0') { 
$nombre_letra_numero_venta = $contar_ceros_venta++;
} else {
$nombre_letra_numero_venta = $datos_letra_numero['nombre_letra_numero'];
}
$codif_letra_precio_venta   = $codif_letra_precio_venta.$nombre_letra_numero_venta;
}

$sql_producto = "SELECT cod_tercero, fecha_ult_compra FROM tbl15_producto WHERE cod_producto_barra = '$cod_producto_barra'";
$consulta_producto = mysqli_query($conectar, $sql_producto) or die(mysqli_error($conectar));
$datos_producto = mysqli_fetch_assoc($consulta_producto);

$cod_tercero                = $datos_producto['cod_tercero'];
$fecha_ult_compra           = $datos_producto['fecha_ult_compra'];
$fecha_compra               = date("mY", strtotime($fecha_ult_compra));

$salida .=''.$cod_producto_barra.',';
$salida .=''.$nombre_producto.',';
$salida .=''.$und_venta.',';
$salida .=''.$precio_compra_producto.',';
$salida .=''.$precio_venta_producto.',';
$salida .=''.$codif_letra_precio_compra.',';
$salida .=''.$codif_letra_precio_venta.',';
$salida .=''.$fecha_ult_compra.',';
$salida .=''.$cod_tercero.'';
$salida .="\n";
}
echo $salida;
}
?>

