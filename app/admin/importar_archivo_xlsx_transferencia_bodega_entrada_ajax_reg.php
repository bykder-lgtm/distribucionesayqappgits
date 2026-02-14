<?php
include_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
//include_once('../admin/fecha_en_espanol.php');
include_once("../session/funciones_admin.php");
//include("../tbl15_notificacion_alerta/mostrar_noficacion_alerta.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
  } else { header("Location:../index.php");
}
$cuenta_actual                           = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$cod_administrador                       = ($_SESSION['cod_administrador']);

//require_once('class_php/ImportarExcel/php-excel-reader/excel_reader2.php');
//require_once('class_php/ImportarExcel/SpreadsheetReader.php');

$sql_info_impuesto_facturas = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_info_factura_transferencia_bodega_entrada'";
$exec_info_impuesto_facturas = mysqli_query($conectar, $sql_info_impuesto_facturas) or die(mysqli_error($conectar));
$datos_info_impuesto_facturas = mysqli_fetch_assoc($exec_info_impuesto_facturas);

$cod_info_factura_transferencia_bodega_entrada           = $datos_info_impuesto_facturas['AUTO_INCREMENT'];
$cod_factura                                             = $cod_info_factura_transferencia_bodega_entrada;
$fecha                                                   = date("d-m-Y");
$fecha_invert                                            = date("Y-m-d");
$hora                                                    = date("H:i:s");
$fecha_cargue_import                                     = date("Y-m-d");
$fecha_cargue                                            = date("Y/m/d - H:i:s");
$fecha_llegada                                           = date("d/m/Y");
$respuesta_ajax                                          = array();
$contador                                                = '0';
$contador_alter                                          = '0';
$fecha_cargue_import                                     = date("Y-m-d");
$fecha_ymd_venta_producto                                = date("Y-m-d");
$fecha_hora_venta_producto                               = date("H:i:s");
$nombre_empresa                                          = "";
$razonsocial_empresa                                     = "";
$datos_reg_excel                                         = "0";
$cod_tipo_origen_factura_compra                          = "4";
$total_precio_costo                                      = 0;
$total_precio_compra                                     = 0;
$total_precio_venta                                      = 0;
//header('Content-Type: application/json');

if (isset($_POST["import"])) {
$file                                                    = $_FILES['csv']['tmp_name'];
$handle                                                  = fopen($file,"r");

  do {
    if ($datos_reg_excel[0]) {
    $contador++;

      if ($contador > '1') {

        if(isset($datos_reg_excel[0])) { $cod_transferencia_bodega_producto = mysqli_real_escape_string($conectar, $datos_reg_excel[0]); }
        if(isset($datos_reg_excel[1])) { $cod_info_factura_transferencia_bodega = mysqli_real_escape_string($conectar, $datos_reg_excel[1]); }
        if(isset($datos_reg_excel[2])) { $cod_factura = mysqli_real_escape_string($conectar, $datos_reg_excel[2]); }
        if(isset($datos_reg_excel[3])) { $cod_producto = mysqli_real_escape_string($conectar, $datos_reg_excel[3]); }
        if(isset($datos_reg_excel[4])) { $cod_producto_barra = mysqli_real_escape_string($conectar, $datos_reg_excel[4]); }
        if(isset($datos_reg_excel[5])) { $und_venta = mysqli_real_escape_string($conectar, $datos_reg_excel[5]); }
        if(isset($datos_reg_excel[6])) { $precio_compra_producto = mysqli_real_escape_string($conectar, $datos_reg_excel[6]); }
        if(isset($datos_reg_excel[7])) { $precio_venta_producto = mysqli_real_escape_string($conectar, $datos_reg_excel[7]); }
        if(isset($datos_reg_excel[8])) { $nombre_tipo_producto = mysqli_real_escape_string($conectar, $datos_reg_excel[8]); }
        if(isset($datos_reg_excel[9])) { $nombre_tipo_unidad_medida = mysqli_real_escape_string($conectar, $datos_reg_excel[9]); }
        //if(isset($datos_reg_excel[10])) { $fecha_ymd_venta_producto = mysqli_real_escape_string($conectar, $datos_reg_excel[10]); }
        //if(isset($datos_reg_excel[11])) { $fecha_hora_venta_producto = mysqli_real_escape_string($conectar, $datos_reg_excel[11]); }
        if(isset($datos_reg_excel[12])) { $nombre_tipo_precio_venta = mysqli_real_escape_string($conectar, $datos_reg_excel[12]); }
        if(isset($datos_reg_excel[13])) { $nombre_cliente = mysqli_real_escape_string($conectar, $datos_reg_excel[13]); $nombre_empresa = $nombre_cliente; $razonsocial_empresa = $nombre_cliente; }
        if(isset($datos_reg_excel[14])) { $nombre_producto = mysqli_real_escape_string($conectar, $datos_reg_excel[14]); }

        $total_costo_producto  = $und_venta * $precio_compra_producto;
        $total_compra_producto = $und_venta * $precio_compra_producto;
        $total_venta_producto  = $und_venta * $precio_venta_producto;

        $total_precio_costo   += $total_costo_producto;
        $total_precio_compra  += $total_compra_producto;
        $total_precio_venta   += $total_venta_producto;
        
        if (!empty($cod_producto_barra)) {
          $sql = "INSERT INTO tbl15_transferencia_bodega_entrada_producto_temporal (cod_producto, cod_producto_barra, nombre_producto, und_venta, precio_compra_producto, precio_venta_producto, 
          nombre_tipo_producto, nombre_tipo_unidad_medida, fecha_ymd_venta_producto, nombre_tipo_precio_venta, 
          nombre_cliente, cod_info_factura_transferencia_bodega_entrada, cod_tipo_origen_factura_compra, total_costo_producto, total_compra_producto, total_venta_producto) 
          VALUES ('$cod_producto', '$cod_producto_barra', '$nombre_producto', '$und_venta', '$precio_compra_producto', '$precio_venta_producto', 
          '$nombre_tipo_producto','$nombre_tipo_unidad_medida', '$fecha_ymd_venta_producto', '$nombre_tipo_precio_venta', 
          '$nombre_cliente', '$cod_info_factura_transferencia_bodega_entrada', '$cod_tipo_origen_factura_compra', '$total_costo_producto', '$total_compra_producto', '$total_venta_producto')";
          $consulta_sql = mysqli_query($conectar, $sql) or die(mysqli_error($conectar));
        }
      }
    }
  } while ($datos_reg_excel = fgetcsv($handle,1000,";","'"));

  $cod_tercero               = 1;
  $cod_caja_virtual          = 1;
  $nombre_estado_factura     = 'ABIERTA';
  $fecha_ymdhis              = date("Y-m-d H:i:s");
  $cuenta                    = $cuenta_actual;
  $cod_estado_factura        = 1;
  $fecha_dia                 = date("Y-m-d");
  $fecha_mes                 = date("m-Y");
  $fecha_anyo                = date("Y-m-d");
  $anyo                      = date("Y");
  $fecha_hora                = date("H:i:s");
  $cod_tipo_pago             = 1;
  $cod_administrador         = $cod_administrador;
  $cod_dependencia           = 1;
  $cod_tipo_forma_pago       = 1;
  $nombre_tipo_factura       = 'POS';
  $nombre_tipo_moneda        = 'COP';
  $fecha_modificacion        = date("Y-m-d H:i:s");

  $sql = "INSERT INTO tbl15_info_factura_transferencia_bodega_entrada (cod_factura, cod_tercero, cod_caja_virtual, nombre_estado_factura, 
  fecha_ymdhis, cuenta, cod_estado_factura, fecha_dia, fecha_mes, fecha_anyo, anyo, fecha_hora, cod_tipo_pago, 
  cod_administrador, cod_dependencia, cod_tipo_forma_pago, nombre_tipo_factura, nombre_tipo_moneda, fecha_modificacion, 
  cod_info_factura_transferencia_bodega_entrada, nombre_empresa, razonsocial_empresa, cod_tipo_origen_factura_compra, total_precio_costo, total_precio_compra, total_precio_venta) 
  VALUES ('$cod_factura', '$cod_tercero', '$cod_caja_virtual', '$nombre_estado_factura', 
  '$fecha_ymdhis', '$cuenta', '$cod_estado_factura', '$fecha_dia', '$fecha_mes', '$fecha_anyo', '$anyo', '$fecha_hora', '$cod_tipo_pago', 
  '$cod_administrador', '$cod_dependencia', '$cod_tipo_forma_pago', '$nombre_tipo_factura', '$nombre_tipo_moneda', '$fecha_modificacion', 
  '$cod_info_factura_transferencia_bodega_entrada', '$nombre_empresa', '$razonsocial_empresa', '$cod_tipo_origen_factura_compra', '$total_precio_costo', '$total_precio_compra', '$total_precio_venta')";
  $consulta_sql = mysqli_query($conectar, $sql) or die(mysqli_error($conectar));

  $contador_alter = $contador -1;
  //echo '{';
  //echo '"estado":"OK",';
  //echo '"total_reg":'.($contador_alter).',';
  //echo '"cod_info_factura_transferencia_bodega_entrada":'.$cod_info_factura_transferencia_bodega_entrada.',';
  //echo '"mensaje":"Datos cargados correctamente."';
  //echo '}';
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/facturacion_transferencia_bodega_entrada_temporal_producto_manual_pos.php?cod_info_factura_transferencia_bodega_entrada=<?php echo $cod_info_factura_transferencia_bodega_entrada ?>">
<?php } ?>