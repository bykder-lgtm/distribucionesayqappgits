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
$cuenta_actual                         = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$cuenta                                = $_SESSION['usuario'];

if (isset($_REQUEST['cod_info_factura_compra'])) {
$cod_info_factura_compra               = intval($_REQUEST['cod_info_factura_compra']);
$tab                                   = addslashes($_REQUEST['tab']);
$tipo                                  = addslashes($_REQUEST['tipo']);
$campo                                 = addslashes($_REQUEST['campo']);
$pagina                                = addslashes($_REQUEST['pagina']);
$url_redirect                          = $pagina.'?'.'cod_info_factura_compra='.$cod_info_factura_compra;

$datos_info_temporal = "SELECT cod_tercero FROM tbl15_info_factura_compra WHERE (cod_info_factura_compra = '$cod_info_factura_compra')";
$consulta_info_temporal = mysqli_query($conectar, $datos_info_temporal) or die(mysqli_error($conectar));
$info_temporal = mysqli_fetch_assoc($consulta_info_temporal);

$cod_tercero                           = $info_temporal['cod_tercero'];

$suma_factura = "SELECT SUM(total_compra_producto) AS total_compra_producto, SUM(valor_iva * und_compra) AS valor_iva, SUM(precio_costo_producto * und_compra) AS total_precio_costo,
SUM(precio_ipc_total) AS total_precio_ipc, SUM((precio_compra_producto * und_compra) / ((iva_ptj/100)+1)) AS subtotal, SUM((precio_compra_producto * und_compra)) AS con_iva, SUM(total_dto) AS total_dto, 
SUM((precio_compra_producto_ant_desc * und_compra) / ((iva_ptj/100)+1)) AS base_valor_iva_ant_desc, SUM(precio_compra_producto_ant_desc * und_compra) AS total_compra_producto_ant_desc
FROM tbl15_factura_compra_producto WHERE (cod_info_factura_compra = '$cod_info_factura_compra')";
$consulta_suma = mysqli_query($conectar, $suma_factura) or die(mysqli_error($conectar));
$suma = mysqli_fetch_assoc($consulta_suma);

$total                                  = round($suma['total_compra_producto'], 2);
$total_precio_costo                     = round($suma['total_precio_costo'], 2);
//$valor_iva                              = round($suma['valor_iva'], 2);
$subtotal                               = round($suma['subtotal'], 2);
$total_sin_iva                          = $subtotal;
$total_con_iva                          = round($suma['con_iva'], 2);
$valor_iva                              = $total_con_iva - $total_sin_iva;
$total_precio_ipc                       = $suma['total_precio_ipc'];
$valor_neto                             = $total;
$total_rete_fuente                      = $subtotal * ($nombre_rete_fuente_ptj/100);
$total_ret_ica                          = $subtotal * ($ret_ica_ptj/1000);
$total_factura_compra_retefuente        = ($total - ($total_rete_fuente + $total_ret_ica));
$total_factura_compra                   = $total; 
$total_descuento                        = round($suma['total_dto'], 2);
$total_compra_imp                       = $total;
$base_valor_iva_ant_desc                = round($suma['base_valor_iva_ant_desc'], 2);
$total_compra_producto_ant_desc         = round($suma['total_compra_producto_ant_desc'], 2);

$datos_tercero = "SELECT cod_estado_dto_tercero FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
$consulta_tercero = mysqli_query($conectar, $datos_tercero) or die(mysqli_error($conectar));
$dato_tercero = mysqli_fetch_assoc($consulta_tercero);

$cod_estado_dto_tercero                 = $dato_tercero['cod_estado_dto_tercero'];

//if ($cod_estado_dto_tercero == '1') { $valor_iva = $total_compra_producto_ant_desc - $base_valor_iva_ant_desc; } else { $valor_iva = $valor_iva; }

$data_sql = ("UPDATE tbl15_info_factura_compra SET subtotal = '$subtotal', total_precio_ipc = '$total_precio_ipc', valor_iva = '$valor_iva', total = '$total', valor_neto = '$valor_neto', 
total_rete_fuente = '$total_rete_fuente', total_ret_ica = '$total_ret_ica', total_factura_compra_retefuente = '$total_factura_compra_retefuente', total_factura_compra = '$total_factura_compra', 
total_descuento = '$total_descuento', total_compra_imp = '$total_compra_imp' WHERE cod_info_factura_compra = '$cod_info_factura_compra'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $url_redirect?>">
<?php } ?>