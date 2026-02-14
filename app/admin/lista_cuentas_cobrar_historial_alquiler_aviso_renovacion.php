<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
</head>
<body id="pageBody">
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php //$pagina = addslashes($_GET['pagina']); ?>
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">

<div class="breadcrumbs">
<h4><a href="#">Alerta Para Renovacion de Contrato</a></h4>
</div>
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina                     = $_SERVER['PHP_SELF'];
$fecha_hoy                  = date("Y-m-d");
$fecha_limite_inferior      = date('Y-m-d', strtotime($fecha_hoy.'-30 day'));
$fecha_limite_superior      = date('Y-m-d', strtotime($fecha_hoy.'+60 day'));

if (isset($_POST['palabra'])) { $palabra = addslashes($_POST['palabra']); } else { $palabra = ''; }
//-----------------------------------------------------------------------------------------------------------------//
if (($cod_estado_habilitar_tercero_por_usuario_global == '1')) {

    if ($cod_seguridad == '1') {
        $condicional_consulta_tercero = ''; 
        $condicional_consulta_tercero_rel = '';
        $condicional_consulta_cuenta_cobrar = '';
    } else { 
        $condicional_consulta_tercero = 'AND tbl15_tercero.cod_administrador = "'.$cod_administrador.'"';
        $condicional_consulta_tercero_rel = 'WHERE tbl15_tercero.cod_administrador = "'.$cod_administrador.'"';
        $condicional_consulta_cuenta_cobrar = 'WHERE tbl15_cuentas_cobrar.cod_administrador = "'.$cod_administrador.'"';
    }

} else { 
$condicional_consulta_tercero = ''; 
$condicional_consulta_tercero_rel = '';
$condicional_consulta_cuenta_cobrar = '';
}
//-----------------------------------------------------------------------------------------------------------------//
$sql_total_cuenta_cobrar = "SELECT Sum(tbl15_cuentas_cobrar.subtotal) AS total_subtotal
FROM tbl15_tercero RIGHT JOIN tbl15_cuentas_cobrar ON tbl15_tercero.cod_tercero = tbl15_cuentas_cobrar.cod_tercero
$condicional_consulta_cuenta_cobrar";
$consulta_total_cuenta_cobrar = mysqli_query($conectar, $sql_total_cuenta_cobrar);
$datos_total_cuenta_cobrar = mysqli_fetch_assoc($consulta_total_cuenta_cobrar);

$total_subtotal               = $datos_total_cuenta_cobrar['total_subtotal'];
?>
<div class="table-responsive">

<table class="table table-striped">
<tr>
<form action="../admin/lista_cuentas_cobrar_historial_alquiler_aviso_renovacion.php" method="post">
<input id="foco" name="palabra" value="<?php echo $palabra ?>" />
<input type="submit" name="buscador" value="Buscar Inquilino" />
</form>
</tr>
</table>

<table class="table table-striped">
<thead>
<tr>
<th style="text-align:center">VER</th>
<th style="text-align:center">CODIGO CONTRATO</th>
<th style="text-align:center">NOMBRE INQUILINO</th>
<th style="text-align:center">DOCUMENTO INQUILINO</th>
<th style="text-align:center">CODIGO INMUEBLE</th>
<!--<th style="text-align:center">NOMBRE INMUEBLE</th>-->
<th style="text-align:center">TIPO INMUEBLE</th>
<th style="text-align:center">FECHA ULTIMO PAGO CONTRATO</th>
<th style="text-align:center">DIAS</th>
<th style="text-align:center">FECHA ALERTA RENOVACION</th>
<th style="text-align:center">ID</th>
</tr>
</thead>
<tbody>
<?php
$tipo_cobro                     = 'month';

if (isset($_POST['palabra'])) { 
$palabra                        = addslashes($_POST['palabra']);

$calcular_datos_cuenta_cobrar = "SELECT * 
FROM (SELECT tbl15_cuentas_cobrar_alerta.fecha_pago_periodo_orig, tbl15_cuentas_cobrar_alerta.numero_cuota, 
tbl15_cuentas_cobrar_alerta.cod_cuentas_cobrar, tbl15_cuentas_cobrar_alerta.cod_factura, tbl15_cuentas_cobrar_alerta.cod_tercero, tbl15_cuentas_cobrar_alerta.cod_producto, 
tbl15_tercero.identificacion_tercero, tbl15_tercero.nombre1_tercero, tbl15_cuentas_cobrar_alerta.monto_deuda, tbl15_cuentas_cobrar_alerta.cod_administrador, 
tbl15_cuentas_cobrar_alerta.subtotal, tbl15_cuentas_cobrar_alerta.abonado, tbl15_tercero.direccion_tercero, tbl15_tercero.telefono1_tercero,  
tbl15_cuentas_cobrar_alerta.cod_estado_renovacio_contrato, tbl15_cuentas_cobrar_alerta.cod_cuentas_cobrar_alerta
FROM tbl15_tercero
INNER JOIN ((tbl15_tipo_producto INNER JOIN tbl15_producto ON tbl15_tipo_producto.nombre_tipo_producto = tbl15_producto.nombre_tipo_producto)
INNER JOIN tbl15_cuentas_cobrar_alerta ON tbl15_producto.cod_producto = tbl15_cuentas_cobrar_alerta.cod_producto) ON tbl15_tercero.cod_tercero = tbl15_cuentas_cobrar_alerta.cod_tercero
WHERE (tbl15_cuentas_cobrar_alerta.cod_estado_renovacio_contrato = '0') AND (tbl15_cuentas_cobrar_alerta.cod_estado_archivado = '0') AND (tbl15_tercero.nombre1_tercero LIKE '%$palabra%')
ORDER BY fecha_pago_periodo_orig DESC) AS t1 GROUP BY cod_factura";
} 
else { 
$calcular_datos_cuenta_cobrar = "SELECT * 
FROM (SELECT tbl15_cuentas_cobrar_alerta.fecha_pago_periodo_orig, tbl15_cuentas_cobrar_alerta.numero_cuota, 
tbl15_cuentas_cobrar_alerta.cod_cuentas_cobrar, tbl15_cuentas_cobrar_alerta.cod_factura, tbl15_cuentas_cobrar_alerta.cod_tercero, tbl15_cuentas_cobrar_alerta.cod_producto, 
tbl15_tercero.identificacion_tercero, tbl15_tercero.nombre1_tercero, tbl15_cuentas_cobrar_alerta.monto_deuda, tbl15_cuentas_cobrar_alerta.cod_administrador, 
tbl15_cuentas_cobrar_alerta.subtotal, tbl15_cuentas_cobrar_alerta.abonado, tbl15_tercero.direccion_tercero, tbl15_tercero.telefono1_tercero,  
tbl15_cuentas_cobrar_alerta.cod_estado_renovacio_contrato, tbl15_cuentas_cobrar_alerta.cod_cuentas_cobrar_alerta
FROM tbl15_tercero
INNER JOIN ((tbl15_tipo_producto INNER JOIN tbl15_producto ON tbl15_tipo_producto.nombre_tipo_producto = tbl15_producto.nombre_tipo_producto)
INNER JOIN tbl15_cuentas_cobrar_alerta ON tbl15_producto.cod_producto = tbl15_cuentas_cobrar_alerta.cod_producto) ON tbl15_tercero.cod_tercero = tbl15_cuentas_cobrar_alerta.cod_tercero
WHERE (tbl15_cuentas_cobrar_alerta.cod_estado_renovacio_contrato = '0') AND (tbl15_cuentas_cobrar_alerta.cod_estado_archivado = '0')
ORDER BY fecha_pago_periodo_orig DESC) AS t1 GROUP BY cod_factura";
}
//Mostrar ultimo registro de cada grupo
//traer ultimo registro de cada grupo
//SELECT * FROM (SELECT * FROM gps ORDER BY hora DESC) AS t1 GROUP BY usuario
$consulta_datos_cuenta_cobrar = mysqli_query($conectar, $calcular_datos_cuenta_cobrar);
while ($datos_cuenta_cobrar = mysqli_fetch_assoc($consulta_datos_cuenta_cobrar)) {

    $cod_cuentas_cobrar_alerta              = $datos_cuenta_cobrar['cod_cuentas_cobrar_alerta'];
    $cod_cuentas_cobrar                     = $datos_cuenta_cobrar['cod_cuentas_cobrar'];
    $monto_deuda                            = $datos_cuenta_cobrar['monto_deuda'];
    $subtotal                               = $datos_cuenta_cobrar['subtotal'];
    $abonado                                = $datos_cuenta_cobrar['abonado'];
    $cod_tercero                            = $datos_cuenta_cobrar['cod_tercero'];
    $cod_factura                            = $datos_cuenta_cobrar['cod_factura'];
    $cliente                                = $datos_cuenta_cobrar['nombre1_tercero'];
    $direccion_tercero                      = $datos_cuenta_cobrar['direccion_tercero'];
    $telefono1_tercero                      = $datos_cuenta_cobrar['telefono1_tercero'];
    $identificacion_tercero                 = $datos_cuenta_cobrar['identificacion_tercero'];
    $cod_producto                           = $datos_cuenta_cobrar['cod_producto'];
    $cod_administrador                      = $datos_cuenta_cobrar['cod_administrador'];
    $numero_cuota                           = $datos_cuenta_cobrar['numero_cuota'];
    $fecha_pago_periodo_orig                = $datos_cuenta_cobrar['fecha_pago_periodo_orig'];
    $fecha_pago_periodo_orig_mas_un_mes     = date('Y-m-d', strtotime($fecha_pago_periodo_orig.'+1 month'));
    $fecha_pago_periodo_orig_dmy            = date("d-m-Y", strtotime($fecha_pago_periodo_orig));

    $sql_producto = "SELECT cod_producto_barra, nombre_producto, nombre_tipo_producto FROM tbl15_producto WHERE (cod_producto = '$cod_producto')";
    $resultado_producto = mysqli_query($conectar, $sql_producto);
    $info_producto = mysqli_fetch_assoc($resultado_producto);
        
    $cod_producto_barra                     = $info_producto['cod_producto_barra'];
    $nombre_producto                        = $info_producto['nombre_producto'];
    $nombre_tipo_producto                   = $info_producto['nombre_tipo_producto'];

    $dias_atraso_seg                        = strtotime($fecha_hoy) - strtotime($fecha_pago_periodo_orig_mas_un_mes);
    $dias_atraso                            = $dias_atraso_seg/(60*60*24);

    if ($dias_atraso < 0) { $titulo_alerta  = 'FALTAN '.abs($dias_atraso).' DIAS '; } elseif ($dias_atraso > 0) { $titulo_alerta  = 'SE PASO POR '.abs($dias_atraso).' DIAS '; } else { $titulo_alerta  = 'ES HOY'; }


    if (($fecha_pago_periodo_orig_mas_un_mes >= $fecha_limite_inferior) && ($fecha_pago_periodo_orig_mas_un_mes <= $fecha_limite_superior)) { ?>
<tr>
    <td style="text-align: center;"><font size='3'><a href="../admin/cuentas_cobrar_agrupado_detalle_factura_alquiler_aviso_renovacion.php?cod_cuentas_cobrar=<?php echo $cod_cuentas_cobrar; ?>&cod_tercero=<?php echo $cod_tercero; ?>&cod_factura=<?php echo $cod_factura; ?>&pagina=<?php echo $pagina; ?>"><img src="../imagenes/ver.png" class="img-polaroid" alt=""></a></font></td>
    <td style="text-align: center;"><font size='3'><?php echo $cod_factura;?></font></td>
    <td style="text-align: left;"><font size='3'><?php echo $cliente; ?></font></td>
    <td style="text-align: center;"><font size='3'><?php echo $identificacion_tercero;?></font></td>
    <td style="text-align: center;"><font size='3'><?php echo $cod_producto_barra; ?></font></td>
    <!--<td style="text-align: center;"><font size='3'><?php echo $nombre_producto; ?></font></td>-->
    <td style="text-align: center;"><font size='3'><?php echo $nombre_tipo_producto ; ?></font></td>
    <td style="text-align: center;"><font size='3'><?php echo $fecha_pago_periodo_orig_dmy; ?></font></td>
    <td style="text-align: center;"><font size='3'><?php echo $titulo_alerta;?></font></td>
    <td style="text-align: center;"><font size='3'><?php echo date('d-m-Y', strtotime($fecha_pago_periodo_orig_mas_un_mes)) ; ?></font></td>
    <td style="text-align: center;"><font size='3'><?php echo $cod_cuentas_cobrar_alerta; ?></font></td>
</tr>
    <?php } ?>
<?php } ?>
</tbody>
</table>
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
</body>
</html>