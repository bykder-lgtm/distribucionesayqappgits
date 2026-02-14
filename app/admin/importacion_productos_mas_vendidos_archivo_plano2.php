<?php
require_once('../conexiones/conexione.php');
date_default_timezone_set("America/Bogota");
mysql_select_db($base_datos, $conectar);
include ("../session/funciones_admin.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
	} else { header("Location:../index.php");
}
$cuenta_actual                   = addslashes($_SESSION['usuario']);
//$tamano_archivo = $_FILES['csv']['size'];

//$obtener_informacion = "SELECT nombre FROM informacion_almacen WHERE cod_informacion_almacen = '1'";
//$consultar_informacion = mysql_query($obtener_informacion, $conectar) or die(mysql_error());
//$matriz_informacion = mysql_fetch_assoc($consultar_informacion);
//$nombre_empresa                 = $matriz_informacion['nombre'];


$vendedor                       = $cuenta_actual;
$fecha                          = time();
$fecha_anyo                     = date("d/m/Y");
$anyo                           = date("Y");
$fecha_hora                     = date("H:i:s");
$ip                             = $_SERVER['REMOTE_ADDR'];

$sql_max_cod_guia = "SELECT MAX(cod_guia) AS cod_guia FROM productos_mas_vendidos";
$consulta_max_cod_guia = mysql_query($sql_max_cod_guia, $conectar) or die(mysql_error());
$dato_max_cod_guia = mysql_fetch_assoc($consulta_max_cod_guia);

$cod_guia                       = $dato_max_cod_guia['cod_guia']+1;
$confirm                        = '1';

if ($confirm == '1') {
//get the csv file
$file                           = $_FILES[csv][tmp_name];
$handle                         = fopen($file,"r");
//loop through the csv file and insert into database
do {
if ($data[0]) {

$cod_productos                  = $data[0];
$nombre_productos               = $data[1];
$unidades_faltantes             = $data[2];
$unidades_vendidas              = $data[3];
$precio_venta                   = $data[4];
$vlr_total_venta                = $data[5];
$fecha_mes                      = $data[6];
$cuenta                         = $data[7];
$nombre_empresa                 = $data[8];

$data_sql = "INSERT INTO productos_mas_vendidos (cod_guia, cod_productos, nombre_productos, unidades_faltantes, unidades_vendidas, precio_venta, vlr_total_venta, 
fecha_mes, nombre_empresa, vendedor, fecha, fecha_anyo, anyo, fecha_hora, ip, cuenta)
VALUES ('".$cod_guia."', '".$cod_productos."', '".$nombre_productos."', '".$unidades_faltantes."', '".$unidades_vendidas."', '".$precio_venta."', '".$vlr_total_venta."', 
'".$fecha_mes."', '".$nombre_empresa."', '".$vendedor."', '".$fecha."', '".$fecha_anyo."', '".$anyo."', '".$fecha_hora."', '".$ip."', '".$cuenta."')";
$exec_data = mysql_query($data_sql, $conectar) or die(mysql_error());
}
} while ($data = fgetcsv($handle,1000,",","'"));

//redirect
header("Location: productos_mas_vendidos_lista_cargada.php?cod_guia=$cod_guia&fecha_mes=$fecha_mes");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
</head>
<body>
<?php //if (!empty($_GET[success])) { echo "<b>Your file has been imported.</b><br><br>"; } //generic success notice ?>
</body>
</html> 