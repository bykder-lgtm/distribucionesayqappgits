<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior_caja_registradora.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<meta charset="utf-8">
<title><?php echo $nombre_emp;?></title>
<meta name="description" content="">
<meta name="author" content="">
<link href="<?php echo $icono_emp;?>" type="image/x-icon" rel="shortcut icon" />

<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link href="../estilo_css/caja_registradora_jqueryscripttop.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="../estilo_css/caja_registradora_bootstrap.min.css">
<script src="../js/caja_registradora_math.min.js"></script>
<script src="../js/caja_registradora_jquery-3.2.1.min.js"></script>
<script src="../js/caja_registradora_popper.min.js"></script>
<script src="../js/caja_registradora_bootstrap.min.js"></script>

<script src="../js/default.js" type="text/javascript"></script>
<script type="text/javascript" src="js/chosen.jquery.js"></script>
<script src="../js/init.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" href="../estilo_css/chosen_600px.css">

<link rel="stylesheet" href="../estilo_css/caja_registradora_font-awesome.min.css">
<link rel="stylesheet" href="../estilo_css/estilo_caja_registradora.css">
</head>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php
if (isset($_GET['cuenta'])) { $cuenta_actual = addslashes($_GET['cuenta']); } else { $cuenta_actual = $cuenta_actual; }
if (isset($_GET['cod_caja_virtual'])) { $cod_caja_virtual = addslashes($_GET['cod_caja_virtual']); } else { $cod_caja_virtual = $cod_caja_virtual; }
if (isset($_GET['cuenta'])) { $url_visit_user_extern = '?cuenta='.$cuenta_actual.'&cod_caja_virtual='.$cod_caja_virtual; } else { $url_visit_user_extern = ""; }

$pagina                            = $_SERVER['PHP_SELF'];
$pagina_local                      = $_SERVER['PHP_SELF'];
$incre                             = 0;
$tab                               = 'tbl15_venta_producto_temporal';
$campo                             = 'cod_venta_producto_temporal';
$tipo                              = 'eliminar';
$nombre_tipo_moneda                = "COP";
$nombre_tipo_factura               = "POS";
$cod_estado_vacuna                 = "0";

$time_seg                          = time();
$fecha                             = date("Ymd");
$hora                              = date("His");

if (isset($_GET['foco'])) { $foco = addslashes($_GET['foco']); } else { $foco = 'busqueda'; }
if (isset($_GET['buscar_por'])) { $buscar_por = addslashes($_GET['buscar_por']); } else { $buscar_por = $nombre_buscar_por; }

$sql_datos_factura = "SELECT cod_info_factura_venta FROM tbl15_info_factura_venta WHERE (cuenta = '$cuenta_actual') AND (cod_caja_virtual = '$cod_caja_virtual') AND (nombre_estado_factura = 'ABIERTA')";
$consulta = mysqli_query($conectar, $sql_datos_factura);
$total_datos = mysqli_num_rows($consulta);
$datos_factura = mysqli_fetch_assoc($consulta);

$cod_info_factura_venta             = $datos_factura['cod_info_factura_venta'];
?>
<body>
<?php if ($total_datos <> 0) { ?>
<style>body { background-color:#333; }</style>
<!--
<table class="table table-striped">
  <tr>
    <td style="text-align:center;"><a href="../session/salir_caja_registradora.php?token=<?php echo $token ?>" class="btn btn-danger">Salir</a></td>
  </tr>
</table>
-->
        <div class="container">
              <tr class="button-row_tema_caja_registradora">
                <td colspan="2">
                  <select name="cod_tipo_forma_pago" id="cod_tipo_forma_pago" class="selectpicker" data-show-subtext="true" data-live-search="true" tabindex="1" style="text-align:center; font-size:15pt; width: 150px;" required>
                      <?php if (isset($cod_tipo_forma_pago)) { echo ""; } else { echo ""; }
                      $consulta2_sql = "SELECT cod_tipo_forma_pago, nombre_tipo_forma_pago FROM tbl15_tipo_forma_pago WHERE (cod_estado = '1') ORDER BY cod_tipo_forma_pago ASC";
                      $consulta2 = mysqli_query($conectar, $consulta2_sql);
                      while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                      if(isset($cod_tipo_forma_pago) AND $cod_tipo_forma_pago == $datos2['cod_tipo_forma_pago']) {
                      $seleccionado = "selected"; } else { $seleccionado = ""; }
                      $codigo = $datos2['cod_tipo_forma_pago'];
                      $nombre = $datos2['nombre_tipo_forma_pago'];
                      echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                  </select>
                </td>
                <td colspan="2">
                  <select name="cod_tipo_pago" id="cod_tipo_pago" class="selectpicker" data-show-subtext="true" data-live-search="true" tabindex="1" style="text-align:center; font-size:15pt; width: 150px;" required>
                      <?php if (isset($cod_tipo_pago)) { echo ""; } else { echo ""; }
                      $consulta2_sql = "SELECT cod_tipo_pago, nombre_tipo_pago FROM tbl15_tipo_pago ORDER BY cod_tipo_pago ASC";
                      $consulta2 = mysqli_query($conectar, $consulta2_sql);
                      while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                      if(isset($cod_tipo_pago) AND $cod_tipo_pago == $datos2['cod_tipo_pago']) {
                      $seleccionado = "selected"; } else { $seleccionado = ""; }
                      $codigo = $datos2['cod_tipo_pago'];
                      $nombre = $datos2['nombre_tipo_pago'];
                      echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                  </select>
                </td>
              </tr>
              <hr>
              <tr class="button-row_tema_caja_registradora">
                <td colspan="4">
                  <select name="cod_tercero" id="cod_tercero" class="chosen-select" data-show-subtext="true" data-live-search="true" style="text-align:center; font-size:15pt; width: 400px;" required>
                      <?php if (isset($nombre_cod_tercero_defec_global)) { echo "<option value='' >...</option>"; } else { echo "<option value='' selected ></option>"; }
                      $consulta2_sql = "SELECT cod_tercero, identificacion_tercero, nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero 
                      FROM tbl15_tercero WHERE (nombre_tipo_tercero='CLIENTE') OR (nombre_tipo_tercero='AMBOS') ORDER BY nombre1_tercero ASC";
                      $consulta2 = mysqli_query($conectar, $consulta2_sql);
                      while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                      if(isset($nombre_cod_tercero_defec_global) AND $nombre_cod_tercero_defec_global == $datos2['cod_tercero']) {
                      $seleccionado = "selected"; } else { $seleccionado = ""; }
                      $codigo = $datos2['cod_tercero'];
                      $nombre = $datos2['nombre1_tercero'].' '.$datos2['nombre2_tercero'].' '.$datos2['apellido1_tercero'].' '.$datos2['apellido2_tercero'].' - '.$datos2['identificacion_tercero'];
                      echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                  </select>
                </td>
              </tr>

            <label class="switch_tema_caja_registradora">
                <input type="checkbox">
                <span class="slider_tema_caja_registradora"></span>
            </label>
            <form>
                <input readonly id="display_superior" type="text" class="form-control-lg text-right">
                <input readonly id="display_inferior" type="text" class="form-control-lg text-right">
            </form>

            <table>
              <tr class="button-row_tema_caja_registradora">
                <td><button id="btn_borrar_todo" type="button">&#67;</button></td><!-- C -->
                <td colspan="2"><button id="btn_borrar_numero" type="button">&#9003;</button></td>
                <!--<td rowspan="2"><button id="btn_agregar_registro" type="button" class="operator-group5">PLU</button></td>-->
              </tr>
              <tr class="button-row_tema_caja_registradora">
                <td><button id="btn_numero_siete" type="button" class="operand-group">&#55;</button><!-- 7 --></td>
                <td><button id="btn_numero_ocho" type="button" class="operand-group">&#56;</button><!-- 8 --></td>
                <td><button id="btn_numero_nueve" type="button" class="operand-group">&#57;</button><!-- 9 --></td>
              </tr>
              <tr class="button-row_tema_caja_registradora">
                <td><button id="btn_numero_cuatro" type="button" class="operand-group">&#52;</button><!-- 4 --></td>
                <td><button id="btn_numero_cinco" type="button" class="operand-group">&#53;</button> <!-- 5 --></td>
                <td><button id="btn_numero_seis" type="button" class="operand-group">&#54;</button> <!-- 6 --></td>
                <!--<td rowspan="2"><button id="btn_recibido" type="button" class="operator-group5">REC</button></td>-->
              </tr>
              <tr class="button-row_tema_caja_registradora">
                <td><button id="btn_numero_uno" type="button" class="operand-group">&#49;</button><!--  1--></td>
                <td><button id="btn_numero_dos" type="button" class="operand-group">&#50;</button><!-- 2 --></td>
                <td><button id="btn_numero_tres" type="button" class="operand-group">&#51;</button><!-- 3 --></td>
              </tr>
              <tr class="button-row_tema_caja_registradora">
                <td colspan="2"><button id="btn_numero_cero" type="button" class="operand-group">0</button><!-- 0 --></td>
                <td colspan="2"><button id="btn_guardar" type="button">ENTER</button><!-- = --></td>
              </tr>
              <tr class="button-row_tema_caja_registradora">
                <td>------</td>
                <td>------</td>
                <td>------</td>
              </tr>
            </table>
            <div id="refrescar_sonido"></div>
        </div>

<hr>

<table class="table table-striped">
  <tr>
    <td style="text-align:center;"><a href="../admin/lista_info_factura_venta.php?cuenta=<?php echo $cuenta_actual?>&cod_caja_virtual=<?php echo $cod_caja_virtual?>&pagina=<?php echo $pagina_local?>" class="btn btn-warning">Lista Venta</a></td>
    <td style="text-align:center;"><a href="../admin/reporte_venta_fechas.php?cuenta=<?php echo $cuenta_actual?>&cod_caja_virtual=<?php echo $cod_caja_virtual?>&pagina=<?php echo $pagina_local?>" class="btn btn-info">Reporte Venta</a></td>
    <td style="text-align:center;"><a href="../admin/facturacion_compra_temporal_producto_manual_caja_registradora_pos.php" class="btn btn-warning">Cargar Compra</a></td>
  </tr>
</table>

<?php } else { ?>
<table class="table table-striped">
  <tr>
    <?php if ($total_datos == 0) { ?>
    <td style="text-align:center;"><a href="../admin/reg_venta_temporal_producto_caja_registradora_reg.php?cuenta=<?php echo $cuenta_actual?>&cod_caja_virtual=<?php echo $cod_caja_virtual?>&pagina=<?php echo $pagina_local?>" class="btn btn-primary">Cargar Venta</a></td>
    <?php } else { ?>
    <td style="text-align:center;"><a href="../admin/facturacion_venta_temporal_producto_manual_caja_registradora_pos.php?cuenta=<?php echo $cuenta_actual?>&cod_caja_virtual=<?php echo $cod_caja_virtual?>&pagina=<?php echo $pagina_local?>" class="btn btn-primary">Cargar Venta</a></td>
    <?php } ?>
    <td style="text-align:center;"><a href="../admin/lista_info_factura_venta.php" class="btn btn-warning">Lista Venta</a></td>
    <td style="text-align:center;"><a href="../admin/reporte_venta_fechas.php" class="btn btn-info">Reporte Venta</a></td>
    <td style="text-align:center;"><a href="../admin/lista_cuentas_cobrar_caja_registradora.php" class="btn btn-info">Cuenta Cobrar</a></td>
    <td style="text-align:center;"><a href="../admin/facturacion_compra_temporal_producto_manual_caja_registradora_pos.php" class="btn btn-warning">Ir a Compras</a></td>
    <td style="text-align:center;"><a href="../session/salir_caja_registradora.php?token=<?php echo $token ?>" class="btn btn-danger">Salir</a></td>
  </tr>
</table>
<?php } ?>

<?php if (isset($_GET['cod_info_factura_venta'])) { 
$cod_info_factura_venta             = intval($_GET['cod_info_factura_venta']);

$obtener_info_fact = "SELECT * FROM tbl15_info_factura_venta WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
$resultado_info_fact = mysqli_query($conectar, $obtener_info_fact) or die(mysqli_error($conectar));
$info_fact = mysqli_fetch_assoc($resultado_info_fact);

$cod_factura                         = $info_fact['cod_factura'];
$fecha_anyo                          = $info_fact['fecha_anyo'];
$fecha_hora                          = substr($info_fact['fecha_hora'], 0, 5);
$total_precio_compra                 = $info_fact['total_precio_compra'];
$total_precio_venta                  = $info_fact['total_precio_venta'];
$total_datos_data                    = $info_fact['total_datos_data'];
$cod_tercero                         = $info_fact['cod_tercero'];
$cuenta                              = $info_fact['cuenta'];
$vlr_cancelado                       = $info_fact['vlr_cancelado'];
$vlr_vuelto                          = $info_fact['vlr_vuelto'];
$cod_tipo_pago                       = $info_fact['cod_tipo_pago'];
$cod_administrador                   = $info_fact['cod_administrador'];
$cod_tipo_forma_pago                 = $info_fact['cod_tipo_forma_pago'];
$nombre_tipo_factura                 = $info_fact['nombre_tipo_factura'];
$nombre_tipo_moneda                  = $info_fact['nombre_tipo_moneda'];
$cod_resolucion_facturacion          = $info_fact['cod_resolucion_facturacion'];
$descuento_ptj                       = $info_fact['descuento_ptj'];
$cod_caja_virtual                    = $info_fact['cod_caja_virtual'];
$cod_base_caja                       = $info_fact['cod_base_caja'];
$vlr_cambio                          = ($vlr_cancelado - $total_precio_venta);
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_tipo_forma_pago = "SELECT * FROM tbl15_tipo_forma_pago WHERE (cod_tipo_forma_pago = '$cod_tipo_forma_pago')";
$resultado_tipo_forma_pago = mysqli_query($conectar, $sql_tipo_forma_pago) or die(mysqli_error($conectar));
$info_tipo_forma_pago = mysqli_fetch_assoc($resultado_tipo_forma_pago);

$nombre_tipo_forma_pago                         = $info_tipo_forma_pago['nombre_tipo_forma_pago'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_resolucion_facturacion = "SELECT * FROM tbl15_resolucion_facturacion WHERE (cod_resolucion_facturacion = '$cod_resolucion_facturacion')";
$consulta_resolucion_facturacion = mysqli_query($conectar, $sql_resolucion_facturacion) or die(mysqli_error($conectar));
$matriz_resolucion_facturacion = mysqli_fetch_assoc($consulta_resolucion_facturacion);

$cod_tipo_resolucion_facturacion        = $matriz_resolucion_facturacion['cod_tipo_resolucion_facturacion'];
$nombre_tipo_resolucion_facturacion     = $matriz_resolucion_facturacion['nombre_tipo_resolucion_facturacion'];
$numero_resolucion_facturacion          = $matriz_resolucion_facturacion['numero_resolucion_facturacion'];
$ini_resolucion_facturacion             = $matriz_resolucion_facturacion['ini_resolucion_facturacion'];
$fin_resolucion_facturacion             = $matriz_resolucion_facturacion['fin_resolucion_facturacion'];
$prefijo_resolucion_facturacion         = $matriz_resolucion_facturacion['prefijo_resolucion_facturacion'];
$fecha_resolucion_facturacion           = $matriz_resolucion_facturacion['fecha_resolucion_facturacion'];
$vigencia_meses_resolucion_facturacion  = $matriz_resolucion_facturacion['vigencia_meses_resolucion_facturacion'];
$nombre_tipo_estado                     = $matriz_resolucion_facturacion['nombre_tipo_estado'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$obtener_diseno_usario_vendedor = "SELECT nombres, apellidos, cod_caja FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador')";
$resultado_diseno_usario_vendedor = mysqli_query($conectar, $obtener_diseno_usario_vendedor) or die(mysqli_error($conectar));
$matriz_usario_vendedor = mysqli_fetch_assoc($resultado_diseno_usario_vendedor);

$usario_vendedor                     = $matriz_usario_vendedor['nombres'].' '.$matriz_usario_vendedor['apellidos'];
$cod_caja                            = $matriz_usario_vendedor['cod_caja'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$obtener_cliente = "SELECT * FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
$resultado_cliente = mysqli_query($conectar, $obtener_cliente) or die(mysqli_error($conectar));
$matriz_cliente = mysqli_fetch_assoc($resultado_cliente);

$nombre_cliente                      = $matriz_cliente['nombre1_tercero'].' '.$matriz_cliente['apellido1_tercero'];
$cedula_cli                          = $matriz_cliente['identificacion_tercero'];
$direccion_cli                       = $matriz_cliente['direccion_tercero'];
$nombre_tipo_identificacion          = $matriz_cliente['nombre_tipo_identificacion'];
$digito_tercero                      = $matriz_cliente['digito_tercero'];
if (($digito_tercero == '0') || ($digito_tercero == '')) { $digito_tercero = ''; } else { $digito_tercero = '-'.$matriz_cliente['digito_tercero']; }
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$suma_temporal = "SELECT Sum(total_venta_producto -(total_venta_producto*(descuento_ptj/100))) As total_venta, 
Sum((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100))) As subtotal_base, 
Sum(((und_venta*precio_venta_producto_orig) - ((descuento_ptj/100)*(und_venta*precio_venta_producto_orig)))/((iva_ptj/100)+(100/100))) As subtotal_base_sin_descuento, 
Sum(((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100)))*(iva_ptj/100)) As total_iva, 
Sum(total_venta_producto*(descuento_ptj/100)) AS total_desc, Sum(total_venta_producto) AS total_venta_neta, Sum(und_venta*precio_venta_producto_orig) AS total_venta_sin_descuento 
FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
$consulta_temporal = mysqli_query($conectar, $suma_temporal) or die(mysqli_error($conectar));
$suma = mysqli_fetch_assoc($consulta_temporal);

$total_venta_neta                    = ($suma['total_venta_neta']);
$subtotal_base                       = ($suma['subtotal_base']);
$subtotal_base_sin_descuento         = ($suma['subtotal_base_sin_descuento']);
$total_desc                          = ($suma['total_desc']);
$total_iva                           = ($suma['total_iva']);
$total_venta_temp                    = ($suma['total_venta']);
$total_venta_sin_descuento           = ($suma['total_venta_sin_descuento']);
$total_descuento_venta               = ($total_venta_sin_descuento - $total_venta_neta);
$descuento_ptj_dif                   = ($total_descuento_venta / $total_venta_sin_descuento) * 100;
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$obtener_tipo_pago = "SELECT nombre_tipo_pago FROM tbl15_tipo_pago WHERE (cod_tipo_pago = '$cod_tipo_pago')";
$resultado_tipo_pago = mysqli_query($conectar, $obtener_tipo_pago) or die(mysqli_error($conectar));
$data_tipo_pago = mysqli_fetch_assoc($resultado_tipo_pago);

$nombre_tipo_pago                     = $data_tipo_pago['nombre_tipo_pago'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$cod_factura_strpad                   = str_pad($cod_factura, 3, "0", STR_PAD_LEFT);
$cod_info_factura_strpad              = str_pad($cod_info_factura_venta, 3, "0", STR_PAD_LEFT);
?>
<table class="table table-striped">
  <tr>
    <td><font color='black' size= "+3">TIPO FACTURA:</font></td>
    <td style="text-align:right;" colspan="2"><font color='black' size= "+3"><?php echo $nombre_tipo_factura; ?></font></td>
  </tr>
  <tr>
    <td><font color='black' size= "+3">FACTURA NO:</font></td>
    <td style="text-align:right;" colspan="2"><font color='black' size= "+3"><?php echo $cod_factura; ?></font></td>
  </tr>
<!--
  <tr>
    <td><font color='black' size= "+3">TIPO DE PAGO:</font></td>
    <td style="text-align:right;" colspan="2"><font color='black' size= "+3"><?php echo $nombre_tipo_pago; ?></font></td>
  </tr>
  <tr>
    <td><font color='black' size= "+3">CLIENTE:</font></td>
    <td style="text-align:right;" colspan="2"><font color='black' size= "+3"><?php echo $nombre_cliente; ?></font></td>
  </tr>
-->
  <tr>
    <td><font color='black' size= "+3">SUBTOTAL:</font></td>
    <td style="text-align:right;" colspan="2"><font color='black' size= "+3"><?php echo number_format($subtotal_base_sin_descuento, 0, ",", "."); ?></font></td>
  </tr>
<!--
  <tr>
    <td><font color='green' size= "+2">%DESCUENTO:</font></td>
    <td style="text-align:right;" colspan="2"><font color='green' size= "+2"><?php echo intval($descuento_ptj_dif).'%'; ?></font></td>
  </tr>
  <tr>
    <td><font color='green' size= "+2">$DESCUENTO:</font></td>
    <td style="text-align:right;" colspan="2"><font color='green' size= "+2"><?php echo number_format($total_descuento_venta, 0, ",", "."); ?></font></td>
  </tr>
  <tr>
    <td><font color='green' size= "+2">IVA:</font></td>
    <td style="text-align:right;" colspan="2"><font color='green' size= "+2"><?php echo number_format($total_iva, 0, ",", "."); ?></font></td>
  </tr>
-->
  <tr>
    <td><font color='black' size= "+3">TOTAL VENTA:</font></td>
    <td style="text-align:right;" colspan="2"><font color='black' size= "+3"><?php echo number_format($total_venta_temp, 0, ",", "."); ?></font></td>
  </tr>
<?php if ($cod_tipo_pago == '1') { ?>
  <tr>
    <td><font color='black' size= "+3">RECIBIDO:</font></td>
    <td style="text-align:right;" colspan="2"><font color='black' size= "+3"><?php echo number_format($vlr_cancelado, 0, ",", "."); ?></font></td>
  </tr>
  <tr>
    <td><font color='black' size= "+4">CAMBIO:</font></td>
    <td style="text-align:right;" colspan="2"><font color='black' size= "+4"><?php echo number_format($vlr_cambio, 0, ",", "."); ?></font></td>
  </tr>
<?php } ?>
</table>


<table class="table table-striped">
  <tr>
    <?php if ($cod_estado_habilitar_btn_imp_venta_direct_driv_global == '0') { ?>
    <td style="text-align:center;"><button id="btnImprimir"><img src="../imagenes/imprimir_2.png" alt="imprimir"></button></td>
    <?php } ?>
  </tr>
</table>

<?php } ?>
</body>
<script type="text/javascript" src="js/chosen.jquery.js"></script>
</html>

<script>  
$(document).ready(function(){  
  $('#btnImprimir').click(function(){
  var cod_info_factura_venta = <?php echo $cod_info_factura_venta ?>;
  var origen = "1";  
    $.ajax({ url:"imprimir_factura_venta_ticket_pos.php", method:"GET", data:{cod_info_factura_venta:cod_info_factura_venta, campo:"cod_info_factura_venta", id:cod_info_factura_venta, origen:origen }, 
     success: function(response){
         if(response==1){
             //alert('Imprimiendo....');
         }else{
             //alert('Error');
         }
     }
    });  
  });
});  
</script>

<?php if ($total_datos <> 0) { ?>
<script type="text/javascript">
// Standard Priority Calculator

var display_superior = {
    operation: "",
    evaluation: "",
    answer: ""
};

// default flag values
var flag = {
    ansAllowed: false, // Initially do not allow the use of Ans button
    /*
    decimalPointAllowed: true,
    pctAllowed: false,
    ansAllowed: false,
    digitAllowed: true
    */
};

// default display values
$('#display_superior').val("");
$('#display_inferior').val("");

// Set default theme (light)
$(".contenedor_caja_registradora").addClass("contenedor_caja_registradora-light");
$("form").addClass("form-light");
$("form input").addClass("form-input-light");
$(".operand-group").addClass("operand-group-light");
$(".operator-group").addClass("operator-group-light");
$("#btn_guardar").addClass("equal-light");
$("#btn_borrar_todo").addClass("btn_borrar_todo-light");
$("#btn_borrar_numero").addClass("btn_borrar_numero-light");

function evaluate() {
    try {
        math.eval(display_superior.operation);
        display_superior.evaluation = math.eval(display_superior.operation);
        return true; // no exception occured
    } catch (e) {
        if (e instanceof SyntaxError) { // Syntax error exception
            display_superior.evaluation = "E";
            return false; // exception occured
        }
        else {// Unspecified exceptions
            display_superior.evaluation = "UE";
            return false; // exception occured
        }
    }
}

// Digits
$('#btn_numero_cero').on('click', function () {
    $('#refrescar_sonido').html('<audio autoplay><source src="../sonidos/pitido_calc0.mp3" type="audio/mp3">Tu navegador no soporta HTML5 audio.</audio>');
    display_superior.operation = display_superior.operation + "0";
    $('#display_superior').val($('#display_superior').val() + '\u0030');
    //evaluate();
    //$('#display_inferior').val(display_superior.evaluation);
    var valor = $('#display_superior').val();
    var tipo_ajax = "tbl15_venta_producto_temporal";
    var campo = "precio_venta_producto";
    var opcion = "0";
    var cod_info_factura_venta = "<?php echo $cod_info_factura_venta?>";

    $.post("guardar_info_factura_y_venta_producto_temporal_caja_registradora_numeros_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, opcion:opcion, cod_info_factura_venta:cod_info_factura_venta }, function(data){
      $('#display_inferior').val(data);
    });
})

$('#btn_numero_uno').on('click', function () {
    $('#refrescar_sonido').html('<audio autoplay><source src="../sonidos/pitido_calc0.mp3" type="audio/mp3">Tu navegador no soporta HTML5 audio.</audio>');
    display_superior.operation = display_superior.operation + "1";
    $('#display_superior').val($('#display_superior').val() + '\u0031');
    //evaluate();
    //$('#display_inferior').val(display_superior.evaluation);
    var valor = $('#display_superior').val();
    var tipo_ajax = "tbl15_venta_producto_temporal";
    var campo = "precio_venta_producto";
    var opcion = "0";
    var cod_info_factura_venta = "<?php echo $cod_info_factura_venta?>";

    $.post("guardar_info_factura_y_venta_producto_temporal_caja_registradora_numeros_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, opcion:opcion, cod_info_factura_venta:cod_info_factura_venta }, function(data){
      $('#display_inferior').val(data);
    });
})

$('#btn_numero_dos').on('click', function () {
    $('#refrescar_sonido').html('<audio autoplay><source src="../sonidos/pitido_calc0.mp3" type="audio/mp3">Tu navegador no soporta HTML5 audio.</audio>');
    display_superior.operation = display_superior.operation + "2";
    $('#display_superior').val($('#display_superior').val() + '\u0032');
    //evaluate();
    //$('#display_inferior').val(display_superior.evaluation);
    var valor = $('#display_superior').val();
    var tipo_ajax = "tbl15_venta_producto_temporal";
    var campo = "precio_venta_producto";
    var opcion = "0";
    var cod_info_factura_venta = "<?php echo $cod_info_factura_venta?>";

    $.post("guardar_info_factura_y_venta_producto_temporal_caja_registradora_numeros_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, opcion:opcion, cod_info_factura_venta:cod_info_factura_venta }, function(data){
      $('#display_inferior').val(data);
    });
})

$('#btn_numero_tres').on('click', function () {
    $('#refrescar_sonido').html('<audio autoplay><source src="../sonidos/pitido_calc0.mp3" type="audio/mp3">Tu navegador no soporta HTML5 audio.</audio>');
    display_superior.operation = display_superior.operation + "3";
    $('#display_superior').val($('#display_superior').val() + '\u0033');
    //evaluate();
    //$('#display_inferior').val(display_superior.evaluation);
    var valor = $('#display_superior').val();
    var tipo_ajax = "tbl15_venta_producto_temporal";
    var campo = "precio_venta_producto";
    var opcion = "0";
    var cod_info_factura_venta = "<?php echo $cod_info_factura_venta?>";

    $.post("guardar_info_factura_y_venta_producto_temporal_caja_registradora_numeros_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, opcion:opcion, cod_info_factura_venta:cod_info_factura_venta }, function(data){
      $('#display_inferior').val(data);
    });
})

$('#btn_numero_cuatro').on('click', function () {
    $('#refrescar_sonido').html('<audio autoplay><source src="../sonidos/pitido_calc0.mp3" type="audio/mp3">Tu navegador no soporta HTML5 audio.</audio>');
    display_superior.operation = display_superior.operation + "4";
    $('#display_superior').val($('#display_superior').val() + '\u0034');
    //evaluate();
    //$('#display_inferior').val(display_superior.evaluation);
    var valor = $('#display_superior').val();
    var tipo_ajax = "tbl15_venta_producto_temporal";
    var campo = "precio_venta_producto";
    var opcion = "0";
    var cod_info_factura_venta = "<?php echo $cod_info_factura_venta?>";

    $.post("guardar_info_factura_y_venta_producto_temporal_caja_registradora_numeros_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, opcion:opcion, cod_info_factura_venta:cod_info_factura_venta }, function(data){
      $('#display_inferior').val(data);
    });
})

$('#btn_numero_cinco').on('click', function () {
    $('#refrescar_sonido').html('<audio autoplay><source src="../sonidos/pitido_calc0.mp3" type="audio/mp3">Tu navegador no soporta HTML5 audio.</audio>');
    display_superior.operation = display_superior.operation + "5";
    $('#display_superior').val($('#display_superior').val() + '\u0035');
    //evaluate();
    //$('#display_inferior').val(display_superior.evaluation);
    var valor = $('#display_superior').val();
    var tipo_ajax = "tbl15_venta_producto_temporal";
    var campo = "precio_venta_producto";
    var opcion = "0";
    var cod_info_factura_venta = "<?php echo $cod_info_factura_venta?>";

    $.post("guardar_info_factura_y_venta_producto_temporal_caja_registradora_numeros_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, opcion:opcion, cod_info_factura_venta:cod_info_factura_venta }, function(data){
      $('#display_inferior').val(data);
    });
})

$('#btn_numero_seis').on('click', function () {
    $('#refrescar_sonido').html('<audio autoplay><source src="../sonidos/pitido_calc0.mp3" type="audio/mp3">Tu navegador no soporta HTML5 audio.</audio>');
    display_superior.operation = display_superior.operation + "6";
    $('#display_superior').val($('#display_superior').val() + '\u0036');
    //evaluate();
    //$('#display_inferior').val(display_superior.evaluation);
    var valor = $('#display_superior').val();
    var tipo_ajax = "tbl15_venta_producto_temporal";
    var campo = "precio_venta_producto";
    var opcion = "0";
    var cod_info_factura_venta = "<?php echo $cod_info_factura_venta?>";

    $.post("guardar_info_factura_y_venta_producto_temporal_caja_registradora_numeros_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, opcion:opcion, cod_info_factura_venta:cod_info_factura_venta }, function(data){
      $('#display_inferior').val(data);
    });
})

$('#btn_numero_siete').on('click', function () {
    $('#refrescar_sonido').html('<audio autoplay><source src="../sonidos/pitido_calc0.mp3" type="audio/mp3">Tu navegador no soporta HTML5 audio.</audio>');
    display_superior.operation = display_superior.operation + "7";
    $('#display_superior').val($('#display_superior').val() + '\u0037');
    //evaluate();
    //$('#display_inferior').val(display_superior.evaluation);
    var valor = $('#display_superior').val();
    var tipo_ajax = "tbl15_venta_producto_temporal";
    var campo = "precio_venta_producto";
    var opcion = "0";
    var cod_info_factura_venta = "<?php echo $cod_info_factura_venta?>";

    $.post("guardar_info_factura_y_venta_producto_temporal_caja_registradora_numeros_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, opcion:opcion, cod_info_factura_venta:cod_info_factura_venta }, function(data){
      $('#display_inferior').val(data);
    });
})

$('#btn_numero_ocho').on('click', function () {
    $('#refrescar_sonido').html('<audio autoplay><source src="../sonidos/pitido_calc0.mp3" type="audio/mp3">Tu navegador no soporta HTML5 audio.</audio>');
    display_superior.operation = display_superior.operation + "8";
    $('#display_superior').val($('#display_superior').val() + '\u0038');
    //evaluate();
    //$('#display_inferior').val(display_superior.evaluation);
    var valor = $('#display_superior').val();
    var tipo_ajax = "tbl15_venta_producto_temporal";
    var campo = "precio_venta_producto";
    var opcion = "0";
    var cod_info_factura_venta = "<?php echo $cod_info_factura_venta?>";

    $.post("guardar_info_factura_y_venta_producto_temporal_caja_registradora_numeros_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, opcion:opcion, cod_info_factura_venta:cod_info_factura_venta }, function(data){
      $('#display_inferior').val(data);
    });
})

$('#btn_numero_nueve').on('click', function () {
    $('#refrescar_sonido').html('<audio autoplay><source src="../sonidos/pitido_calc0.mp3" type="audio/mp3">Tu navegador no soporta HTML5 audio.</audio>');
    display_superior.operation = display_superior.operation + "9";
    $('#display_superior').val($('#display_superior').val() + '\u0039');
    //evaluate();
    //$('#display_inferior').val(display_superior.evaluation);
    var valor = $('#display_superior').val();
    var tipo_ajax = "tbl15_venta_producto_temporal";
    var campo = "precio_venta_producto";
    var opcion = "0";
    var cod_info_factura_venta = "<?php echo $cod_info_factura_venta?>";

    $.post("guardar_info_factura_y_venta_producto_temporal_caja_registradora_numeros_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, opcion:opcion, cod_info_factura_venta:cod_info_factura_venta }, function(data){
      $('#display_inferior').val(data);
    });
})

$('#btn_agregar_registro').on('click', function () {
    $('#refrescar_sonido').html('<audio autoplay><source src="../sonidos/pitido_calc3.mp3" type="audio/mp3">Tu navegador no soporta HTML5 audio.</audio>');
    display_superior.operation = display_superior.operation + "+";
    $('#display_superior').val($('#display_superior').val() + '\u002b');
    //evaluate();
    //$('#display_inferior').val(display_superior.evaluation);
    var valor = $('#display_superior').val();
    var tipo_ajax = "tbl15_venta_producto_temporal";
    var campo = "precio_venta_producto";
    var opcion = "btn_agregar_registro";
})


$('#btn_recibido').on('click', function () {
    $('#refrescar_sonido').html('<audio autoplay><source src="../sonidos/pitido_calc1.mp3" type="audio/mp3">Tu navegador no soporta HTML5 audio.</audio>');
    display_superior.operation = display_superior.operation + "|";
    $('#display_superior').val($('#display_superior').val() + '\u007c');
    //evaluate();
    //$('#display_inferior').val(display_superior.evaluation);
    $('#display_inferior').val("");
    var valor = $('#display_superior').val();
    var tipo_ajax = "tbl15_venta_producto_temporal";
    var campo = "precio_venta_producto";
    var opcion = "btn_agregar_registro";
})



// Equal
$('#btn_guardar').on('click', function () {
    $('#refrescar_sonido').html('<audio autoplay><source src="../sonidos/pitido_calc4.mp3" type="audio/mp3">Tu navegador no soporta HTML5 audio.</audio>');
    display_superior.answer = display_superior.evaluation; // Store the answer (Ans button)
    var valores_separados = $('#display_superior').val();
    var cod_tipo_forma_pago = $('#cod_tipo_forma_pago').val();
    var cod_tipo_pago = $('#cod_tipo_pago').val();
    var cod_tercero = $('#cod_tercero').val();

    var valor_total = display_superior.answer;
    var valor = valores_separados;
    var tipo_ajax = "tbl15_venta_producto_temporal";
    var campo = "precio_venta_producto";
    var opcion = "btn_guardar";
    var cod_info_factura_venta = "<?php echo $cod_info_factura_venta?>";
    var parametros = { valor:valor, campo:campo, tipo_ajax:tipo_ajax, opcion:opcion, cod_info_factura_venta:cod_info_factura_venta, cod_tipo_forma_pago:cod_tipo_forma_pago, cod_tipo_pago:cod_tipo_pago, cod_tercero:cod_tercero };

    $.ajax({
      type: "POST",
      url: "../admin/guardar_info_factura_y_venta_producto_temporal_caja_registradora_ajax.php",
      data: parametros,
      dataType: "json",
      //contentType: false,
      //processData: false,
      beforeSend: function(entrada){
          //$("#icono_estado").html('<img src="../imagenes/cargador.gif">');
          //$("#estado").html('Cargando...');
        },
      success: function(respuesta){
        var cod_info_factura_venta = respuesta.llave;
        var total_precio_venta = respuesta.total_precio_venta;
        var vlr_cancelado = respuesta.vlr_cancelado;
        var vlr_vuelto = respuesta.vlr_vuelto;
        var estado = respuesta.estado;

        if (estado == '1') {
          $('#display_superior').val(total_precio_venta.toLocaleString()); // Update display_superior
          $('#display_inferior').val(vlr_vuelto.toLocaleString()); // Update display_inferior
          display_superior.operation = display_superior.answer; // Current operation equals the answer
          flag.ansAllowed = true; // Allow the use of Ans button
          window.location.replace("../admin/facturacion_venta_temporal_producto_manual_caja_registradora_pos.php?cod_info_factura_venta="+cod_info_factura_venta);
        } else {
          window.location.replace("../admin/facturacion_venta_temporal_producto_manual_caja_registradora_pos.php");
        }

      }
    });

})

// btn_borrar_numero
$('#btn_borrar_numero').on('click', function () {   
    $('#refrescar_sonido').html('<audio autoplay><source src="../sonidos/pitido_calc2.mp3" type="audio/mp3">Tu navegador no soporta HTML5 audio.</audio>');
    display_superior.operation = display_superior.operation.slice(0, display_superior.operation.length-1);
    $('#display_superior').val($('#display_superior').val().slice(0, $('#display_superior').val().length-1));
    evaluate();
    $('#display_inferior').val(display_superior.evaluation);
})

// btn_borrar_todo
$('#btn_borrar_todo').on('click', function () {
    $('#refrescar_sonido').html('<audio autoplay><source src="../sonidos/pitido_calc2.mp3" type="audio/mp3">Tu navegador no soporta HTML5 audio.</audio>');
    display_superior.operation = "",
    display_superior.evaluation = "",
    $('#display_superior').val("");
    $('#display_inferior').val("");
})

// Theme system
$("input[type='checkbox']").change(function () {
    // dark theme
    if (this.checked) {
        //alert("dark");
        $(".contenedor_caja_registradora").removeClass("contenedor_caja_registradora-light");
        $(".contenedor_caja_registradora").addClass("contenedor_caja_registradora-dark");
        $("form").removeClass("form-light");
        $("form").addClass("form-dark");
        $("form input").removeClass("form-input-light");
        $("form input").addClass("form-input-dark");
        $(".operand-group").removeClass("operand-group-light");
        $(".operand-group").addClass("operand-group-dark");
        $(".operator-group").removeClass("operator-group-light");
        $(".operator-group").addClass("operator-group-dark");
        $("#btn_guardar").removeClass("equal-light");
        $("#btn_guardar").addClass("equal-dark");
        $("#btn_borrar_todo").removeClass("btn_borrar_todo-light");
        $("#btn_borrar_todo").addClass("btn_borrar_todo-dark");
        $("#btn_borrar_numero").removeClass("btn_borrar_numero-light");
        $("#btn_borrar_numero").addClass("btn_borrar_numero-dark");
    }
    // light theme (default)
    else {
        //alert("light");
        $(".contenedor_caja_registradora").removeClass("contenedor_caja_registradora-dark");
        $(".contenedor_caja_registradora").addClass("contenedor_caja_registradora-light");
        $("form").removeClass("form-dark");
        $("form").addClass("form-light");
        $("form input").removeClass("form-input-dark");
        $("form input").addClass("form-input-light");
        $(".operand-group").removeClass("operand-group-dark");
        $(".operand-group").addClass("operand-group-light");
        $(".operator-group").removeClass("operator-group-dark");
        $(".operator-group").addClass("operator-group-light");
        $("#btn_guardar").removeClass("equal-dark");
        $("#btn_guardar").addClass("equal-light");
        $("#btn_borrar_todo").removeClass("btn_borrar_todo-dark");
        $("#btn_borrar_todo").addClass("btn_borrar_todo-light");
        $("#btn_borrar_numero").removeClass("btn_borrar_numero-dark");
        $("#btn_borrar_numero").addClass("btn_borrar_numero-light");
    }
})
</script>
<?php } ?>