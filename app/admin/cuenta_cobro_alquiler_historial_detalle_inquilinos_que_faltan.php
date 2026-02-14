<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include_once('../admin/05_modulo_js.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<script type="text/javascript" src="js/jquery-barcode.js"></script>
<link rel="stylesheet" type="text/css" href="../estilo_css/area_imprimible_invisible.css">
</head>
<body id="pageBody">
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php //$pagina = addslashes($_GET['pagina']); ?>
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">
<?php
$pagina_local                         = $_SERVER['PHP_SELF'];
$fecha_mes                            = addslashes($_GET['fecha_mes']);
$nombre_tabla_anyo                    = addslashes($_GET['nombre_tabla_anyo']);
$cod_estado_pago                      = intval($_GET['cod_estado_pago']);
$cod_estado_envio_correo_cuenta_cobro = intval($_GET['cod_estado_envio_correo_cuenta_cobro']);
$nombre_tabla_mes                     = addslashes($_GET['nombre_tabla_mes']);
$pagina                               = addslashes($_GET['pagina']);

if (isset($_GET['cod_estado_hoy'])) { $cod_estado_hoy = addslashes($_GET['cod_estado_hoy']); } else { $cod_estado_hoy = '1'; }
if (isset($_GET['buscar_por'])) { $buscar_por = addslashes($_GET['buscar_por']); } else { $buscar_por = 'documento_nombre_inquilino'; }
?>
<div class="breadcrumbs">
<h4>
<a class="btn btn-primary" href="../admin/lista_cuenta_cobro_alquiler_historial.php?fecha_mes=<?php echo $fecha_mes ?>&nombre_tabla_anyo=<?php echo $nombre_tabla_anyo ?>&cod_estado_pago=<?php echo $cod_estado_pago ?>&cod_estado_envio_correo_cuenta_cobro=<?php echo $cod_estado_envio_correo_cuenta_cobro ?>&nombre_tabla_mes=<?php echo $nombre_tabla_mes ?>&cod_estado_hoy=<?php echo $cod_estado_hoy ?>&buscar_por=<?php echo $buscar_por ?>">Regresar</a>
</h4>
</div>

<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$mostrar_datos_sql = "SELECT nombre_letra_tabla_mes FROM tbl15_tabla_mes WHERE nombre_tabla_mes  = '$nombre_tabla_mes'";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
$matriz_consulta = mysqli_fetch_assoc($consulta);

$nombre_letra_tabla         = $matriz_consulta['nombre_letra_tabla_mes'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
if ($cod_estado_pago == '-1') {
$filtro_consulta_estado_pago = "";
$filtro_consulta_estado_pago_rel = "";
} else {
$filtro_consulta_estado_pago = "AND ((cod_estado = '$cod_estado_pago'))";
$filtro_consulta_estado_pago_rel = "AND ((tbl15_cuentas_cobrar_alerta.cod_estado = '$cod_estado_pago'))";
}

if ($cod_estado_envio_correo_cuenta_cobro == '-1') {
$filtro_consulta_estado_envio_correo = "";
$filtro_consulta_estado_envio_correo_rel = "";
} else {
$filtro_consulta_estado_envio_correo = "AND ((cod_estado_envio_correo_cuenta_cobro = '$cod_estado_envio_correo_cuenta_cobro'))";
$filtro_consulta_estado_envio_correo_rel = "AND ((tbl15_cuentas_cobrar_alerta.cod_estado_envio_correo_cuenta_cobro = '$cod_estado_envio_correo_cuenta_cobro'))";
}


//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_consulta_estado_pago = "SELECT nombre_estado_pago FROM tbl15_estado_pago WHERE cod_estado_pago = '$cod_estado_pago'";
$consulta_estado_pago = mysqli_query($conectar, $sql_consulta_estado_pago) or die(mysqli_error($conectar));
$total_estado_pago = mysqli_fetch_assoc($consulta_estado_pago);

$nombre_estado_pago                     = $total_estado_pago['nombre_estado_pago'];

$sql_consulta_estado_envio_correo = "SELECT nombre_estado_envio_correo FROM tbl15_estado_envio_correo WHERE cod_estado_envio_correo = '$cod_estado_envio_correo_cuenta_cobro'";
$consulta_estado_envio_correo = mysqli_query($conectar, $sql_consulta_estado_envio_correo) or die(mysqli_error($conectar));
$total_estado_envio_correo = mysqli_fetch_assoc($consulta_estado_envio_correo);

$nombre_estado_envio_correo                     = $total_estado_envio_correo['nombre_estado_envio_correo'];

if ($cod_estado_envio_correo_cuenta_cobro == '-1') { $nombre_estado_envio_correo = 'TODO'; } else { $nombre_estado_envio_correo = $total_estado_envio_correo['nombre_estado_envio_correo']; }
if ($cod_estado_pago == '-1') { $nombre_estado_pago = 'TODO'; } else { $nombre_estado_pago = $total_estado_pago['nombre_estado_pago']; } 

//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$fecha_impr                     = date("Ymd");
$hora_impr                      = date("His");
$fecha_hoy                      = date("Y-m-d");
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
?>
<div class="table-responsive">
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
    <thead>
        <tr>
            <th style="text-align:center">MES - AÑO</th>
        </tr>
        <tr>
            <td style="text-align:center"><?php echo $nombre_letra_tabla ?> - <?php echo $nombre_tabla_anyo ?></td>
        </tr>
    </thead>
</table>
</fieldset>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<fieldset>
<legend>REGISTROS DE INQUILINOS FALTANTES</legend>
<table class="table table-striped">
<tr>
<td style="text-align: center;"><strong>#</strong></td>
<td style="text-align: center;"><strong>VER</strong></td>
<td style="text-align: center;"><strong>INQUILINO</strong></td>
<td style="text-align: center;"><strong>DOCUMENTO</strong></td>
<td style="text-align: center;"><strong>CORREO</strong></td>
<td style="text-align: center;"><strong>ID</strong></td>
</tr>
<?php
$cuentas_cobrar_viejas_concat             = '';
$contador                                 = 0;

$calcular_datos_cuenta_cobrar = "SELECT * FROM tbl15_tercero WHERE (tbl15_tercero.nombre_tipo_tercero = 'INQUILINO') AND (tbl15_tercero.cod_estado = '1') AND  
NOT EXISTS (SELECT NULL FROM tbl15_cuentas_cobrar_alerta WHERE (tbl15_cuentas_cobrar_alerta.cod_tercero = tbl15_tercero.cod_tercero) AND (tbl15_cuentas_cobrar_alerta.fecha_mes = '$fecha_mes') $filtro_consulta_estado_pago_rel)";
$consulta_datos_cuenta_cobrar = mysqli_query($conectar, $calcular_datos_cuenta_cobrar);
while ($datos_cuenta_cobrar = mysqli_fetch_assoc($consulta_datos_cuenta_cobrar)) {

$cod_tercero                              = $datos_cuenta_cobrar['cod_tercero'];
$identificacion_tercero_inquilino         = $datos_cuenta_cobrar['identificacion_tercero'];
$nombre1_tercero_inquilino                = $datos_cuenta_cobrar['nombre1_tercero'];
$nombre2_tercero_inquilino                = $datos_cuenta_cobrar['nombre2_tercero'];
$apellido1_tercero_inquilino              = $datos_cuenta_cobrar['apellido1_tercero'];
$apellido2_tercero_inquilino              = $datos_cuenta_cobrar['apellido2_tercero'];
$nombre_cliente_inquilino                 = $nombre1_tercero_inquilino.' '.$nombre2_tercero_inquilino.' '.$apellido1_tercero_inquilino.' '.$apellido2_tercero_inquilino;
$cliente_inquilino                        = $nombre1_tercero_inquilino.' '.$nombre2_tercero_inquilino.' '.$apellido1_tercero_inquilino.' '.$apellido2_tercero_inquilino;
$nombre_tipo_identificacion_inquilino     = $datos_cuenta_cobrar['nombre_tipo_identificacion'];
$telefono1_tercero_inquilino              = $datos_cuenta_cobrar['telefono1_tercero'];
$correo_tercero_inquilino                 = $datos_cuenta_cobrar['correo_tercero'];
$nombre_pais_inquilino                    = $datos_cuenta_cobrar['nombre_pais'];
$palabra                                  = $nombre1_tercero_inquilino;
$contador++;
?>
<tr>
<td style="text-align: center;"><font size='3'><?php echo $contador;?></font></td>
<td style="text-align: center;"><font size='3'><a href="../admin/lista_cuentas_cobrar_agrupado_historial_alquiler.php?palabra=<?php echo $palabra; ?>&pagina=<?php echo $pagina_local; ?>"><img src="../imagenes/ver.png" class="img-polaroid" alt=""></a></font></td>
<td style="text-align: left;"><font size='3'><?php echo $nombre1_tercero_inquilino;?></font></td>
<td style="text-align: left;"><font size='3'><?php echo $identificacion_tercero_inquilino ;?></font></td>
<td style="text-align: left;"><font size='3'><?php echo $correo_tercero_inquilino ;?></font></td>
<td style="text-align: center;"><font size='3'><?php echo $cod_tercero;?></font></td>
</tr>
<?php } ?>
</table>
</fieldset>
<br>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
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
</body>
</html>