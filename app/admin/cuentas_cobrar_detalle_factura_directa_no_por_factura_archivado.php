<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="js/jquery-barcode.js"></script>
<link rel="stylesheet" type="text/css" href="../estilo_css/area_imprimible_invisible.css">

<script language="javascript" src="isiAJAX.js"></script>
<script language="javascript">
var last;
function Focus(elemento, valor) {
	$(elemento).className = 'inputon';
	last = valor;
}
function Blur(elemento, valor, campo, id) {
	$(elemento).className = 'inputoff';
	if (last != valor)
	myajax.Link('guardar_cuentas_cobrar_abonos_editable.php?valor='+valor+'&campo='+campo+'&id='+id);
}
</script>
</head>
<body id="pageBody" onLoad="myajax = new isiAJAX();">
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php //$pagina = addslashes($_GET['pagina']); ?>
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">

<div class="breadcrumbs">
<a href="#"><h4>Cuentas por Cobrar Archivada</h4></a>
</div>
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina                            = $_SERVER['PHP_SELF'];
$cod_tercero                       = intval($_GET['cod_tercero']);

$tab1                              = 'tbl15_cuentas_cobrar_por_factura_directa';
$tab2                              = 'tbl15_cuentas_cobrar_por_abono_directa';

$campo1                            = 'cod_cuentas_cobrar';
$campo2                            = 'cod_cuentas_cobrar_abonos';
$tipo                              = 'eliminar';
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$fecha_impr                        = date("Ymd");
$hora_impr                         = date("His");
$fecha_hoy                         = date("Y-m-d");
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$calcular_datos_cuenta_cobrar = "SELECT identificacion_tercero, nombre1_tercero, apellido1_tercero, total_monto_deuda_cuenta_cobrar, total_subtotal_cuenta_cobrar, total_abonado_cuenta_cobrar 
FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
$consulta_datos_cuenta_cobrar = mysqli_query($conectar, $calcular_datos_cuenta_cobrar);
$datos_cuenta_cobrar = mysqli_fetch_assoc($consulta_datos_cuenta_cobrar);

$total_monto_deuda_cuenta_cobrar                   = $datos_cuenta_cobrar['total_monto_deuda_cuenta_cobrar'];
$total_subtotal_cuenta_cobrar                      = $datos_cuenta_cobrar['total_subtotal_cuenta_cobrar'];
$total_abonado_cuenta_cobrar                       = $datos_cuenta_cobrar['total_abonado_cuenta_cobrar'];
$identificacion_tercero                            = $datos_cuenta_cobrar['identificacion_tercero'];
$nombre1_tercero                                   = $datos_cuenta_cobrar['nombre1_tercero'];
$apellido1_tercero                                 = $datos_cuenta_cobrar['apellido1_tercero'];
$nombre_cliente                                    = $nombre1_tercero.' '.$apellido1_tercero;
$cliente                                           = $nombre1_tercero.' '.$apellido1_tercero;

$monto_deuda_smtr                                  = 0;
$abonado_smtr                                      = 0;
$subtotal_smtr                                     = 0;
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
?>
<div class="table-responsive">
<table class="table table-striped">
<tr>
<td style="text-align: center;"><strong><a href="../admin/lista_cuentas_cobrar_archivado.php"><font size="5px">REGRESAR</font></a></strong></td>
</tr>
<tr>
<td style="text-align: center;"><strong><font size="5">CUENTAS POR COBRAR ARCHIVADA<br><br>
</tr>
<tr>
<td style="text-align: center;"><strong><font size="5">FACTURAS EN CREDITO - <?php echo $cliente;?><br><br>
</tr>
</table>
</table>

<table class="table table-striped">
	<tr>
		<td style="text-align: center;"><strong>FACTURA</strong></td>
		<td style="text-align: center;"><strong>TOTAL CREDITO</strong></td>
		<td style="text-align: center;"><strong>VER PROD</strong></td>
		<td style="text-align: center;"><strong>FECHA REG</strong></td>
		<td style="text-align: center;"><strong>FECHA PAGO</strong></td>
		<td style="text-align: center;"><strong>VENDEDOR</strong></td>
		<td style="text-align: center;"></td>
		<td style="text-align: center;"><strong>ID</strong></td>
	</tr>
<?php
$calcular_datos_cuenta_cobrar = "SELECT tbl15_cuentas_cobrar_copia.cod_cuentas_cobrar, tbl15_cuentas_cobrar_copia.cod_factura, tbl15_cuentas_cobrar_copia.cod_tercero, 
tbl15_cuentas_cobrar_copia.monto_deuda, tbl15_cuentas_cobrar_copia.abonado, tbl15_cuentas_cobrar_copia.subtotal, tbl15_tercero.nombre1_tercero, tbl15_tercero.apellido1_tercero, 
tbl15_cuentas_cobrar_copia.mensaje, tbl15_cuentas_cobrar_copia.fecha_pago, tbl15_cuentas_cobrar_copia.fecha, tbl15_cuentas_cobrar_copia.vendedor, tbl15_cuentas_cobrar_copia.cod_info_factura_venta
FROM tbl15_tercero RIGHT JOIN tbl15_cuentas_cobrar_copia ON tbl15_tercero.cod_tercero = tbl15_cuentas_cobrar_copia.cod_tercero 
WHERE (tbl15_cuentas_cobrar_copia.cod_tercero='$cod_tercero') ORDER BY tbl15_cuentas_cobrar_copia.cod_cuentas_cobrar DESC";
$consulta_datos_cuenta_cobrar = mysqli_query($conectar, $calcular_datos_cuenta_cobrar);
$total_datos = mysqli_num_rows($consulta_datos_cuenta_cobrar);
while ($datos_cuenta_cobrar = mysqli_fetch_assoc($consulta_datos_cuenta_cobrar)) {

	$cod_cuentas_cobrar             = $datos_cuenta_cobrar['cod_cuentas_cobrar'];
	$cod_info_factura_venta         = $datos_cuenta_cobrar['cod_info_factura_venta'];
	$cod_factura                    = $datos_cuenta_cobrar['cod_factura'];
	$cliente                        = $datos_cuenta_cobrar['nombre1_tercero']." ".$datos_cuenta_cobrar['apellido1_tercero'];
	$monto_deuda                    = $datos_cuenta_cobrar['monto_deuda'];
	$abonado                        = $datos_cuenta_cobrar['abonado'];
	$subtotal                       = $datos_cuenta_cobrar['subtotal'];
	$mensaje                        = $datos_cuenta_cobrar['mensaje'];
	$fecha                          = $datos_cuenta_cobrar['fecha'];
	$fecha_pago                     = $datos_cuenta_cobrar['fecha_pago'];
	$vendedor                       = $datos_cuenta_cobrar['vendedor'];
	$monto_deuda_smtr               = $monto_deuda_smtr + $monto_deuda;
	$abonado_smtr                   = $abonado_smtr + $abonado;
	$subtotal_smtr                  = $subtotal_smtr + $subtotal;

	if (($fecha_hoy > $fecha_pago) && ($subtotal > '0')) { $boton_alerta_caducidad = '<img src="../imagenes/sem_no_atendido_peq.png">'; } else { $boton_alerta_caducidad = ''; }
?>
	<tr>
		<td style="text-align: center;"><font size='3'><?php echo $cod_factura;?></font></td>
		<td style="text-align: right;"><font size='3'><?php echo number_format($monto_deuda, 0, ",", ".")?></font></a></td>
		<td style="text-align: center;"><a href="../admin/edit_factura_venta.php?cod_cuentas_cobrar=<?php echo $cod_cuentas_cobrar;?>&cod_factura=<?php echo $cod_factura;?>&cod_info_factura_venta=<?php echo $cod_info_factura_venta;?>&cod_tercero=<?php echo $cod_tercero;?>&cliente=<?php echo $cliente;?>"><img src=../imagenes/ver_lista_peq.png alt="Abonar"></a></td>
		<td style="text-align: center;"><font size='3'><?php echo $fecha;?></font></td>
		<td style="text-align: center;"><font size='3'><?php echo $fecha_pago;?></font></td>
		<td style="text-align: center;"><font size='3'><?php echo $vendedor; ?></font></td>
		<td style="text-align: left;"><?php echo $mensaje;?></td>
		<td style="text-align: center;"><font size='3'><?php echo $cod_cuentas_cobrar; ?></font></td>
	</tr>
<?php } ?>
</table>

<table class="table table-striped">
	<tr>
		<td style="text-align: center;"><strong>ABONOS</strong></td>
		<td style="text-align: center;"><strong>PAGO A</strong></td>
		<td style="text-align: center;"><strong>MENSAJE</strong></td>
		<td style="text-align: center;"><strong>FORMA PAGO</strong></td>
		<td style="text-align: center;"><strong>FECHA</strong></td>
		<td style="text-align: center;"><strong>HORA</strong></td>
		<td style="text-align: center;"><strong>ID</strong></td>
	</tr>
<?php
$sql = "SELECT * FROM tbl15_cuentas_cobrar_abonos_copia WHERE (cod_tercero = '$cod_tercero') ORDER BY cod_cuentas_cobrar_abonos DESC";
$consulta = mysqli_query($conectar, $sql) or die(mysqli_error($conectar));
$total_datos = mysqli_num_rows($consulta);
while ($datos = mysqli_fetch_assoc($consulta)) {

	$cod_cuentas_cobrar_abonos  = $datos['cod_cuentas_cobrar_abonos'];
	$abonado                    = $datos['abonado'];
	$cuenta                     = $datos['cuenta'];
	$mensaje                    = $datos['mensaje'];
	$fecha_pago                 = $datos['fecha_pago'];
	$hora                       = $datos['hora'];
	$cod_dependencia            = $datos['cod_dependencia'];
	$cod_tipo_forma_pago        = $datos['cod_tipo_forma_pago'];

	$sql_datos_cuenta_cobrar = "SELECT nombre_tipo_forma_pago FROM tbl15_tipo_forma_pago WHERE (cod_tipo_forma_pago = '$cod_tipo_forma_pago')";
	$consulta_datos_cuenta_cobrar = mysqli_query($conectar, $sql_datos_cuenta_cobrar);
	$datos_cuenta_cobrar = mysqli_fetch_assoc($consulta_datos_cuenta_cobrar);

	$nombre_tipo_forma_pago       = $datos_cuenta_cobrar['nombre_tipo_forma_pago'];
?>
	<tr>
		<?php if ($cod_seguridad== '1') { ?><td style="text-align: center;"><font size="4px"><?php echo number_format($abonado, 0, ",", "."); ?></font></td><?php } ?>
		<td style="text-align: center;"><font size="4px"><?php echo $cuenta; ?></font></td>
		<td align="left"><font size="4px"><?php echo $mensaje; ?></font></td>
		<td style="text-align: center;"><font size="4px"><?php echo $nombre_tipo_forma_pago; ?></font></td>
		<td style="text-align: center;"><font size="4px"><?php echo $fecha_pago; ?></font></td>
		<td style="text-align: center;"><font size="4px"><?php echo $hora; ?></font></td>
		<td style="text-align: center;"><font size="4px"><?php echo $cod_cuentas_cobrar_abonos; ?></font></td>
	</tr>
<?php } ?>
</table>
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
</div>
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* FIN MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
</div>
<!--End Main Content Area-->
</div>
<div id="footerInnerSeparator"></div>
</div>
</div>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<?php include_once('../admin/04_modulo_footer.php'); ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->

<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include_once('../admin/05_modulo_js.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->

<script>  
 $(document).ready(function(){  

  $('select[name="cod_dependencia"]').change(function(){ 
  var cod_dependencia = $(this).val();  
  let id = this.id;
    $.ajax({ url:"cuentas_cobrar_abonos_dependencia_ajax.php", method:"GET", data:{valor:cod_dependencia, campo:"cod_dependencia", id:id }, success:function(data){ $('#result').html(data); }  
    });  
  });
 });  
 </script>

   <script>  
  $(document).ready(function(){  
    $('#btnImprimirCreditoAbonoCuentaCobrar').click(function(){
    var cod_tercero = <?php echo $cod_tercero ?>;
    var origen = "0";  
      $.ajax({ url:"../admin/imprimir_abono_y_cuenta_cobrar_todo_ticket_pos.php", method:"GET", data:{cod_tercero:cod_tercero, campo:"cod_tercero", id:cod_tercero, origen:origen }, 
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
  
</body>
</html>