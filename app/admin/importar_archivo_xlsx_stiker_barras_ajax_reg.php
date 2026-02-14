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

require_once('class_php/ImportarExcel/php-excel-reader/excel_reader2.php');
require_once('class_php/ImportarExcel/SpreadsheetReader.php');

$sql_info_impuesto_facturas = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_info_factura_sticker'";
$exec_info_impuesto_facturas = mysqli_query($conectar, $sql_info_impuesto_facturas) or die(mysqli_error($conectar));
$datos_info_impuesto_facturas = mysqli_fetch_assoc($exec_info_impuesto_facturas);

$cod_info_factura_sticker           = $datos_info_impuesto_facturas['AUTO_INCREMENT'];
$cod_factura                        = $cod_info_factura_sticker;
$contador                           = '0';
$fecha                              = date("d/m/Y");
$fecha_invert                       = date("Y/m/d");
$hora                               = date("H:i:s");
$fecha_cargue_import                = date("Y-m-d");
$fecha_cargue                       = date("Y/m/d - H:i:s");
$fecha_llegada                      = date("d/m/Y");
$respuesta_ajax                     = array();
$contador                           = '0';
$contador_alter                     = '0';
$fecha_cargue_import                = date("Y-m-d");

//header('Content-Type: application/json');

if (isset($_POST["import"])) {
$allowedFileType                    = array('application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

  if(in_array($_FILES["csv"]["type"], $allowedFileType)){

    $targetPath = '../archivador/'.$_FILES['csv']['name'];
    move_uploaded_file($_FILES['csv']['tmp_name'], $targetPath);
    
    $Reader = new SpreadsheetReader($targetPath);
    
    $sheetCount = count($Reader->sheets());
    for($i=0;$i<$sheetCount;$i++) {
        
        $Reader->ChangeSheet($i);
        
        foreach ($Reader as $Row) {
          $contador++;

          if ($contador > 1) {

              if(isset($Row[0])) { $cod_producto_barra = mysqli_real_escape_string($conectar, $Row[0]); }
              if(isset($Row[1])) { $nombre_producto = mysqli_real_escape_string($conectar, $Row[1]); }
              if(isset($Row[2])) { $und_venta = mysqli_real_escape_string($conectar, $Row[2]); }
              if(isset($Row[3])) { $precio_compra_producto = mysqli_real_escape_string($conectar, $Row[3]); }
              if(isset($Row[4])) { $precio_venta_producto = mysqli_real_escape_string($conectar, $Row[4]); }
              if(isset($Row[5])) { $codif_letra_precio_compra = mysqli_real_escape_string($conectar, $Row[5]); }
              if(isset($Row[6])) { $codif_letra_precio_venta = mysqli_real_escape_string($conectar, $Row[6]); }
              if(isset($Row[7])) { $fecha_ult_compra = mysqli_real_escape_string($conectar, $Row[7]); }
              if(isset($Row[8])) { $cod_tercero = mysqli_real_escape_string($conectar, $Row[8]); }

                  echo "<br>cod_producto_barra - ".$cod_producto_barra;
                  echo "<br>Row0 - ".$Row['0'];

              if (!empty($cod_producto_barra)) {


                $sql = "INSERT INTO tbl15_sticker_producto (cod_producto_barra, nombre_producto, und_venta, precio_compra_producto, precio_venta_producto, 
                codif_letra_precio_compra, codif_letra_precio_venta, fecha_ult_compra, cod_tercero, cod_info_factura_sticker) 
                VALUES ('$cod_producto_barra', '$nombre_producto', '$und_venta', '$precio_compra_producto', '$precio_venta_producto', 
                '$codif_letra_precio_compra','$codif_letra_precio_venta', '$fecha_ult_compra', '$cod_tercero', '$cod_info_factura_sticker')";
                $consulta_sql = mysqli_query($conectar, $sql) or die(mysqli_error($conectar));
              }
            }
         }
     }
      $cod_tercero               = 1;
      $cod_caja_virtual          = 1;
      $nombre_estado_factura     = 'CERRADA';
      $fecha_ymdhis              = date("Y-m-d H:i:s");
      $cuenta                    = $cuenta_actual;
      $cod_estado_factura        = 0;
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

      $sql = "INSERT INTO tbl15_info_factura_sticker (cod_factura, cod_tercero, cod_caja_virtual, nombre_estado_factura, 
      fecha_ymdhis, cuenta, cod_estado_factura, fecha_dia, fecha_mes, fecha_anyo, anyo, fecha_hora, cod_tipo_pago, 
      cod_administrador, cod_dependencia, cod_tipo_forma_pago, nombre_tipo_factura, nombre_tipo_moneda, fecha_modificacion, 
      cod_info_factura_sticker) 
      VALUES ('$cod_factura', '$cod_tercero', '$cod_caja_virtual', '$nombre_estado_factura', 
      '$fecha_ymdhis', '$cuenta', '$cod_estado_factura', '$fecha_dia', '$fecha_mes', '$fecha_anyo', '$anyo', '$fecha_hora', '$cod_tipo_pago', 
      '$cod_administrador', '$cod_dependencia', '$cod_tipo_forma_pago', '$nombre_tipo_factura', '$nombre_tipo_moneda', '$fecha_modificacion', 
      '$cod_info_factura_sticker')";
      $consulta_sql = mysqli_query($conectar, $sql) or die(mysqli_error($conectar));

      $contador_alter = $contador -1;
      //echo '{';
      //echo '"estado":"OK",';
      //echo '"total_reg":'.($contador_alter).',';
      //echo '"cod_info_factura_sticker":'.$cod_info_factura_sticker.',';
      //echo '"mensaje":"Datos cargados correctamente."';
      //echo '}';
?>
<!--<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/edit_facturacion_sticker_producto_barras_pos.php?cod_info_factura_sticker=<?php echo $cod_info_factura_sticker ?>">-->
<?php
  }
  else
  { 
      //echo '{';
      //echo '"estado":"ERROR",';
      //echo '"estado":"0",';
      //echo '"cod_info_factura_sticker":"0",';
      //echo '"mensaje":"ERROR: Datos no guardados."';
      //echo '}';
  }
}
?>