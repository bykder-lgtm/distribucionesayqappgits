<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->

<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!--
<script src="js/jquery-1.12.3.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="../estilo_css/jquery.dataTables.min.css">
-->
<!--<link href="../estilo_css/custom.min.css" rel="stylesheet">-->
<link rel="stylesheet" href="../estilo_css/micss.css">
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->

<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->

<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">

<div class="breadcrumbs">
<!--
<a class="btn btn-info" href="../admin/menu_lista.php">Lista de Productos</a>
<?php if ($cod_estado_prod_reg_producto == '1') { ?>
<a class="btn btn-warning" href="../admin/lista_cuentas_cobrar_alerta_historial_alquiler_inquilino_detalle.php">Reporte Alquiler Viejo</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a class="btn btn-success" href="../admin/lista_cuentas_cobrar_alerta_agrupado_historial_alquiler_inquilino_detalle.php">Reporte Alquiler Nuevo</a>
<?php } ?>
<br>
-->
</div>

<div class="row-fluid">
<div class="span12" id="divMain">

<?php 
$pagina = $_SERVER['PHP_SELF']; 
$cod_estado_pago = 0;
$buscar_por = 10;
?>
<div class="container body">
    <div class="right_col" role="main"> <!-- page content -->
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->              
<!-- Form search -->
<table class="table table-bordered table-hover table-sm">
    <tr>
        <th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px">FECHA COBRO INQ</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px">TIPO</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px">FECHA PAGO PROP ALERT</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px">FORMA PAGO</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px">ID</th>
    </tr>
<?php
$calcular_datos_cuenta_cobrar = "SELECT tbl15_cuentas_cobrar_alerta.cod_cuentas_cobrar_alerta, 
tbl15_cuentas_cobrar_alerta.cod_cuentas_cobrar, tbl15_cuentas_cobrar_alerta.cod_cuentas_cobrar_abonos, 
tbl15_cuentas_cobrar_alerta.cod_tercero, tbl15_cuentas_cobrar_alerta.cod_tercero_propietario, tbl15_cuentas_cobrar_alerta.cod_factura, tbl15_cuentas_cobrar_alerta.numero_alerta, 
tbl15_cuentas_cobrar_alerta.cod_producto, tbl15_cuentas_cobrar_alerta.cod_producto_barra, tbl15_cuentas_cobrar_alerta.nombre_producto, tbl15_cuentas_cobrar_alerta.monto_deuda, 
tbl15_cuentas_cobrar_alerta.monto_cuota, tbl15_cuentas_cobrar_alerta.total_pendiente, tbl15_cuentas_cobrar_alerta.total_recibido, tbl15_cuentas_cobrar_alerta.fecha_pago, 
tbl15_cuentas_cobrar_alerta.fecha_pago_reg, tbl15_cuentas_cobrar_alerta.cod_estado_pago_propietario, tbl15_cuentas_cobrar_alerta.cod_cuentas_cobrar_factura_comision_propietario, 
tbl15_producto.dia_pago_propietario_inmueble, tbl15_producto.nombre_tipo_cobro_propietario_inmueble, tbl15_producto.cod_tipo_forma_pago, 
tbl15_cuentas_cobrar_alerta.fecha_mes, tbl15_cuentas_cobrar_alerta.anyo, tbl15_cuentas_cobrar_alerta.cod_estado_envio_correo_cuenta_cobro, 
tbl15_cuentas_cobrar_alerta.cod_estado_envio_correo_comision_propietario, tbl15_cuentas_cobrar_alerta.fecha_pago_periodo_orig
FROM tbl15_producto RIGHT JOIN tbl15_cuentas_cobrar_alerta ON tbl15_producto.cod_producto = tbl15_cuentas_cobrar_alerta.cod_producto
WHERE (tbl15_cuentas_cobrar_alerta.mes_alerta_pago_comision_prop >= '2023-08') AND (tbl15_cuentas_cobrar_alerta.fecha_alerta_pago_comision_prop = '')";
$consulta_datos_cuenta_cobrar = mysqli_query($conectar, $calcular_datos_cuenta_cobrar);
while ($datos_cuenta_cobrar = mysqli_fetch_assoc($consulta_datos_cuenta_cobrar)) {

$cod_cuentas_cobrar_alerta                         = $datos_cuenta_cobrar['cod_cuentas_cobrar_alerta'];
$dia_pago_propietario_inmueble                     = $datos_cuenta_cobrar['dia_pago_propietario_inmueble'];
$nombre_tipo_cobro_propietario_inmueble            = $datos_cuenta_cobrar['nombre_tipo_cobro_propietario_inmueble'];
$cod_tipo_forma_pago                               = $datos_cuenta_cobrar['cod_tipo_forma_pago'];
$fecha_pago_periodo_orig                           = $datos_cuenta_cobrar['fecha_pago_periodo_orig'];
$dia_pago_propietario                              = date("d", strtotime($dia_pago_propietario_inmueble));
$fecha_alerta_mes                                  = date('Y-m-d', strtotime($fecha_pago_periodo_orig.'+1 month'));

$sql_consulta_tipo_forma_pago = "SELECT nombre_tipo_forma_pago FROM tbl15_tipo_forma_pago WHERE cod_tipo_forma_pago = '$cod_tipo_forma_pago'";
$consulta_tipo_forma_pago = mysqli_query($conectar, $sql_consulta_tipo_forma_pago) or die(mysqli_error($conectar));
$total_tipo_forma_pago = mysqli_fetch_assoc($consulta_tipo_forma_pago);

$nombre_tipo_forma_pago                           = $total_tipo_forma_pago['nombre_tipo_forma_pago'];


if ($nombre_tipo_cobro_propietario_inmueble == 'MES VENCIDO') { $fecha_alerta_pago_comision_prop = date('Y-m', strtotime($fecha_alerta_mes)).'-'.$dia_pago_propietario; } else { $fecha_alerta_pago_comision_prop = $fecha_pago_periodo_orig; }

$sql_data = sprintf("UPDATE tbl15_cuentas_cobrar_alerta SET fecha_alerta_pago_comision_prop = '$fecha_alerta_pago_comision_prop' WHERE cod_cuentas_cobrar_alerta = '$cod_cuentas_cobrar_alerta'");
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
?>
    <tr id="cod_cuentas_cobrar_alerta<?php echo $cod_cuentas_cobrar_alerta ?>">
        <td style="text-align: center;" id="cod_cuentas_cobrar_alerta<?php echo $cod_cuentas_cobrar_alerta ?>"><font size='3'><?php echo date("d-m-Y", strtotime($fecha_pago_periodo_orig)) ;?></font></td>
        <td style="text-align: center;" id="cod_cuentas_cobrar_alerta<?php echo $cod_cuentas_cobrar_alerta ?>"><font size='3'><?php echo $nombre_tipo_cobro_propietario_inmueble ?></font></a></td>
        <td style="text-align: center;" id="cod_cuentas_cobrar_alerta<?php echo $cod_cuentas_cobrar_alerta ?>"><font size='3'><?php echo  date("d-m-Y", strtotime($fecha_alerta_pago_comision_prop)) ?></font></a></td>
        <td style="text-align: center;" id="cod_cuentas_cobrar_alerta<?php echo $cod_cuentas_cobrar_alerta ?>"><font size='3'><?php echo $nombre_tipo_forma_pago ;?></font></td>
        <td style="text-align: center;" id="cod_cuentas_cobrar_alerta<?php echo $cod_cuentas_cobrar_alerta ?>"><font size='3'><?php echo $cod_cuentas_cobrar_alerta ;?></font></td>
    </tr id="cod_cuentas_cobrar_alerta<?php echo $cod_cuentas_cobrar_alerta ?>">
<?php } ?>
</table>
<!-- end Form search -->

    </div><!-- /page content -->
</div>
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* FIN MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->

</div>
</div>
<div id="footerInnerSeparator"></div>
</div>
</div>
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* FIN MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->

  <!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<?php include_once('../admin/04_modulo_footer.php'); ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->

<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<script src="../js/jquery.min.js" type="text/javascript"></script> 
<?php include_once('../admin/05_modulo_js_sin_jquery.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<script src="../js/custom.min.js"></script>
<script type="text/javascript" src="../admin/busqueda_paginacion_alerta_alquiler_comision_propietario_ajax.js"></script>

</body>
</html>