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
            <th style="text-align:center">ESTADO PAGO</th>
            <th style="text-align:center">ESTADO ENVIO CORREO</th>
            <th style="text-align:center">VER INQUILINOS QUE FALTAN</th>
        </tr>
        <tr>
            <td style="text-align:center"><?php echo $nombre_letra_tabla ?> - <?php echo $nombre_tabla_anyo ?></td>
            <td style="text-align:center"><?php echo $nombre_estado_pago ?></td>
            <td style="text-align:center"><?php echo $nombre_estado_envio_correo ?></td>
            <td style="text-align:center"><a href="../admin/cuenta_cobro_alquiler_historial_detalle_inquilinos_que_faltan.php?fecha_mes=<?php echo $fecha_mes; ?>&nombre_tabla_mes=<?php echo $nombre_tabla_mes; ?>&nombre_tabla_anyo=<?php echo $nombre_tabla_anyo; ?>&cod_estado_pago=<?php echo $cod_estado_pago; ?>&cod_estado_envio_correo_cuenta_cobro=<?php echo $cod_estado_envio_correo_cuenta_cobro; ?>&pagina=<?php echo $pagina; ?>&cod_estado_hoy=<?php echo $cod_estado_hoy; ?>&buscar_por=<?php echo $buscar_por; ?>">VER REGISTROS</a></td>
        </tr>
    </thead>
</table>
</fieldset>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<fieldset>
<legend>HISTORIAL DE PAGO</legend>
<table class="table table-bordered table-hover table-sm">
    <tr>
        <td style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px"><strong>#</strong></td>
        <td style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px"><strong>EDIT</strong></td>
        <td style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px"><strong>INQUILINO</strong></td>
        <td style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px"><strong>CORREO</strong></td>
        <td style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px"><strong>NUMERO DE PERIODO</strong></td>
        <td style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px"><strong>MES</strong></td>
        <td style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px"><strong>PRECIO ALQUILER</strong></td>
        <td style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px"><strong>FECHA LIMITE PAGO</strong></td>
        <td style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px"><strong>ESTADO PAGO</strong></td>
        <td style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px"><strong>PERIODOS TRASADOS</strong></td>
        <td style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px"><strong>VER</strong></td>
        <td style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px"><strong>ENVIAR</strong></td>
        <td style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px"><strong>ID</strong></td>
        <td style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px"><strong>ID INQ</strong></td>
    </tr>
<?php
$cuentas_cobrar_viejas_concat                  = '';
$contador                                      = 0;

$calcular_datos_cuenta_cobrar = "SELECT * FROM tbl15_cuentas_cobrar_alerta WHERE (fecha_mes = '$fecha_mes') AND (cod_estado_archivado = '0') $filtro_consulta_estado_pago $filtro_consulta_estado_envio_correo";
$consulta_datos_cuenta_cobrar = mysqli_query($conectar, $calcular_datos_cuenta_cobrar);
while ($datos_cuenta_cobrar = mysqli_fetch_assoc($consulta_datos_cuenta_cobrar)) {

$cuentas_cobrar_viejas_concat                  = '';
$cod_cuentas_cobrar_alerta                     = $datos_cuenta_cobrar['cod_cuentas_cobrar_alerta'];
$cod_cuentas_cobrar                            = $datos_cuenta_cobrar['cod_cuentas_cobrar'];
$cod_tercero                                   = $datos_cuenta_cobrar['cod_tercero'];

$numero_alerta                                 = $datos_cuenta_cobrar['numero_alerta'];
$fecha_pago                                    = $datos_cuenta_cobrar['fecha_pago'];
$monto_cuota                                   = $datos_cuenta_cobrar['monto_cuota'];
$cod_producto_barra                            = $datos_cuenta_cobrar['cod_producto_barra'];
$nombre_producto                               = $datos_cuenta_cobrar['nombre_producto'];
$cod_factura                                   = $datos_cuenta_cobrar['cod_factura'];
$cod_estado_envio_correo_cuenta_cobro          = $datos_cuenta_cobrar['cod_estado_envio_correo_cuenta_cobro'];
$cod_estado                                    = $datos_cuenta_cobrar['cod_estado'];
$fecha_pago_dmy                                = date("d-m-Y", strtotime($fecha_pago));

$sql_cuentas_cobrar_viejas = "SELECT * FROM tbl15_cuentas_cobrar_alerta WHERE (cod_tercero = '$cod_tercero') AND (fecha_mes < '$fecha_mes') AND (cod_estado <> '1') AND (cod_estado_archivado = '0')";
$consulta_cuentas_cobrar_viejas = mysqli_query($conectar, $sql_cuentas_cobrar_viejas);
while ($datos_cuentas_cobrar_viejas = mysqli_fetch_assoc($consulta_cuentas_cobrar_viejas)) {

$cod_cuentas_cobrar_alerta_concat              = $datos_cuentas_cobrar_viejas['cod_cuentas_cobrar_alerta'];
$monto_cuota_concat                            = $datos_cuentas_cobrar_viejas['monto_cuota'];
$fecha_pago_concat                             = $datos_cuentas_cobrar_viejas['fecha_pago'];
$fecha_pago_concat_dmy                         = date("d-m-Y", strtotime($fecha_pago_concat));
$cuentas_cobrar_viejas_concat                 .= "".number_format($monto_cuota_concat, 0, ",", ".")."|".$fecha_pago_concat_dmy.''.'<br>';
}

$sql_consulta_inquilino = "SELECT * FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
$consulta_inquilino = mysqli_query($conectar, $sql_consulta_inquilino) or die(mysqli_error($conectar));
$total_inquilino = mysqli_fetch_assoc($consulta_inquilino);

$identificacion_tercero_inquilino              = $total_inquilino['identificacion_tercero'];
$nombre1_tercero_inquilino                     = $total_inquilino['nombre1_tercero'];
$nombre2_tercero_inquilino                     = $total_inquilino['nombre2_tercero'];
$apellido1_tercero_inquilino                   = $total_inquilino['apellido1_tercero'];
$apellido2_tercero_inquilino                   = $total_inquilino['apellido2_tercero'];
$nombre_cliente_inquilino                      = $nombre1_tercero_inquilino.' '.$nombre2_tercero_inquilino.' '.$apellido1_tercero_inquilino.' '.$apellido2_tercero_inquilino;
$cliente_inquilino                             = $nombre1_tercero_inquilino.' '.$nombre2_tercero_inquilino.' '.$apellido1_tercero_inquilino.' '.$apellido2_tercero_inquilino;
$nombre_tipo_identificacion_inquilino          = $total_inquilino['nombre_tipo_identificacion'];
$telefono1_tercero_inquilino                   = $total_inquilino['telefono1_tercero'];
$correo_tercero_inquilino                      = $total_inquilino['correo_tercero'];
$nombre_pais_inquilino                         = $total_inquilino['nombre_pais'];
$cod_estado_inquilino                          = $total_inquilino['cod_estado'];

$fecha_mes                                     = $datos_cuenta_cobrar['fecha_mes'];
$fecha_mes_complet                             = $fecha_mes.'-01';
$nombre_tabla_mes                              = date("m", strtotime($fecha_mes_complet));

$mostrar_datos_sql = "SELECT nombre_letra_tabla_mes FROM tbl15_tabla_mes WHERE nombre_tabla_mes  = '$nombre_tabla_mes'";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
$matriz_consulta = mysqli_fetch_assoc($consulta);

$nombre_letra_tabla_mes                        = $matriz_consulta['nombre_letra_tabla_mes'];

$sql_estado_pago = "SELECT * FROM tbl15_estado_pago WHERE cod_estado_pago = '$cod_estado'";
$consulta_estado_pago = mysqli_query($conectar, $sql_estado_pago) or die(mysqli_error($conectar));
$matriz_estado_pago = mysqli_fetch_assoc($consulta_estado_pago);

$nombre_estado_pago                            = $matriz_estado_pago['nombre_estado_pago'];
$color_fondo_celda_estado_pago                 = $matriz_estado_pago['color_fondo_celda_estado_pago'];
$color_letra_celda_estado_pago                 = $matriz_estado_pago['color_letra_celda_estado_pago'];

$contador++;

    if ($cod_estado_inquilino == '1') {
    ?>
    <tr>
        <td style="text-align: center; <?php echo $color_fondo_celda_estado_pago;?>; <?php echo $color_letra_celda_estado_pago;?>; font-size: 15px"><?php echo $contador;?></td>
        <td style="text-align: center; <?php echo $color_fondo_celda_estado_pago;?>; <?php echo $color_letra_celda_estado_pago;?>; font-size: 15px"><a href="../admin/edit_cuentas_cobro_agrupado_detalle_factura_alquiler.php?cod_cuentas_cobrar=<?php echo $cod_cuentas_cobrar;?>&cod_cuentas_cobrar_alerta=<?php echo $cod_cuentas_cobrar_alerta;?>&fecha_mes=<?php echo $fecha_mes;?>&nombre_tabla_mes=<?php echo $nombre_tabla_mes;?>&nombre_tabla_anyo=<?php echo $nombre_tabla_anyo;?>&cod_estado_envio_correo_cuenta_cobro=<?php echo $cod_estado_envio_correo_cuenta_cobro;?>&cod_estado_pago=<?php echo $cod_estado_pago;?>&cod_factura=<?php echo $cod_factura;?>&numero_alerta=<?php echo $numero_alerta;?>&cod_tercero=<?php echo $cod_tercero;?>&cliente=<?php echo $cliente_inquilino;?>&pagina=<?php echo $pagina_local;?>"><img src=../imagenes/editar.png alt="editar"></a></td>
        <td style="text-align: left; <?php echo $color_fondo_celda_estado_pago;?>; <?php echo $color_letra_celda_estado_pago;?>; font-size: 15px"><?php echo $nombre1_tercero_inquilino;?></td>
        <td style="text-align: left; <?php echo $color_fondo_celda_estado_pago;?>; <?php echo $color_letra_celda_estado_pago;?>; font-size: 15px"><?php echo $correo_tercero_inquilino ;?></td>
        <td style="text-align: center; <?php echo $color_fondo_celda_estado_pago;?>; <?php echo $color_letra_celda_estado_pago;?>; font-size: 15px"><?php echo $numero_alerta ;?></td>
        <td style="text-align: center; <?php echo $color_fondo_celda_estado_pago;?>; <?php echo $color_letra_celda_estado_pago;?>; font-size: 15px"><?php echo $nombre_letra_tabla_mes ;?></td>
        <td style="text-align: center; <?php echo $color_fondo_celda_estado_pago;?>; <?php echo $color_letra_celda_estado_pago;?>; font-size: 15px"><?php echo number_format($monto_cuota, 0, ",", ".") ?></td>
        <td style="text-align: center; <?php echo $color_fondo_celda_estado_pago;?>; <?php echo $color_letra_celda_estado_pago;?>; font-size: 15px"><?php echo $fecha_pago_dmy;?></td>
        <td style="text-align: center; <?php echo $color_fondo_celda_estado_pago;?>; <?php echo $color_letra_celda_estado_pago;?>; font-size: 15px"><?php echo $nombre_estado_pago;?></td>
        <td style="text-align: right; <?php echo $color_fondo_celda_estado_pago;?>; <?php echo $color_letra_celda_estado_pago;?>; font-size: 15px"><?php echo $cuentas_cobrar_viejas_concat;?></td>
        <td style="text-align: center; <?php echo $color_fondo_celda_estado_pago;?>; <?php echo $color_letra_celda_estado_pago;?>; font-size: 15px"><a href="../admin/cuentas_cobrar_abonos_alquiler_comprobante_cuenta_cobro_imprimir_pdf.php?cod_cuentas_cobrar_alerta=<?php echo $cod_cuentas_cobrar_alerta;?>&fecha_mes=<?php echo $fecha_mes;?>&nombre_tabla_mes=<?php echo $nombre_tabla_mes;?>&nombre_tabla_anyo=<?php echo $nombre_tabla_anyo;?>&cod_estado_envio_correo_cuenta_cobro=<?php echo $cod_estado_envio_correo_cuenta_cobro;?>&cod_estado_pago=<?php echo $cod_estado_pago;?>&pagina=<?php echo $pagina_local;?>" target="_blank"><img src=../imagenes/pdf_peq.png alt="Adjuntar"></a></td>
        <td style="text-align: center; <?php echo $color_fondo_celda_estado_pago;?>; <?php echo $color_letra_celda_estado_pago;?>; font-size: 15px"><a href="../admin/enviar_cuenta_cobro_alquiler_correo_inquilino_reg.php?cod_cuentas_cobrar_alerta=<?php echo $cod_cuentas_cobrar_alerta;?>&fecha_mes=<?php echo $fecha_mes;?>&nombre_tabla_mes=<?php echo $nombre_tabla_mes;?>&nombre_tabla_anyo=<?php echo $nombre_tabla_anyo;?>&cod_estado_envio_correo_cuenta_cobro=<?php echo $cod_estado_envio_correo_cuenta_cobro;?>&cod_estado_pago=<?php echo $cod_estado_pago;?>&pagina=<?php echo $pagina_local;?>"><img src=../imagenes/enviar_historia_clinica_correo.png alt="Adjuntar"><?php echo $cod_estado_envio_correo_cuenta_cobro;?></a></td>
        <td style="text-align: center; <?php echo $color_fondo_celda_estado_pago;?>; <?php echo $color_letra_celda_estado_pago;?>; font-size: 15px"><?php echo $cod_cuentas_cobrar_alerta;?></td>
        <td style="text-align: center; <?php echo $color_fondo_celda_estado_pago;?>; <?php echo $color_letra_celda_estado_pago;?>; font-size: 15px"><?php echo $cod_tercero;?></td>
    </tr>
    <?php } ?>
<?php } ?>
</table>
</fieldset>
<br>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<div id="wrapper" style="width: 99%;">

<div id="area_imprimible_invisible" style="width: 99%;text-align: left;"><div>

<?php if ($cod_estado_img_impimir_factura_global == '1') { ?>
<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
<tr>
<td style="text-align: center; width: 95%; font-family: Courier; font-size:12pt;"><img src="../imagenes/logo_empresa_factura_pos_blanco_negro.jpg" width="100px"></td>
</tr>
</table>
<?php } ?>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
<tr>
<td style="text-align: center; width: 95%; font-family: Courier; font-size:11pt;"><strong><?php echo $nombre_emp; ?></strong></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
<tr>
<td style="text-align: center; width: 95%; font-family: Courier; font-size:10pt;"><strong><?php echo $localidad_emp; ?></strong></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
<tr>
<td style="text-align: center; width: 95%; font-family: Courier; font-size:10pt;"><strong>NIT: <?php echo $nit_empresa_emp; ?></strong></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
<tr>
<td style="text-align: center; width: 95%; font-family: Courier; font-size:10pt;"><strong>DIRECCION: <?php echo $direccion_emp; ?></strong></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
<tr>
<td style="text-align: center; width: 95%; font-family: Courier; font-size:10pt;"><strong>TELEFONO: <?php echo $telefono_emp; ?></strong></td>
</tr>
</table>


<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
<tr>
<td style="text-align: center;">----------------------------------</td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
<tr>
<td style="text-align: center; width: 90%; font-family: Courier; font-size:10pt;"><strong>PRESTAMOS (POR TERCERO)</strong></td>
</tr>
</table>


<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
<tr>
<td style="text-align: center;">----------------------------------</td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
  <tr>
    <td style="text-align: left; width: 50%; font-family: Courier; font-size:10pt;"><strong>NIT TERCERO: <?php echo $identificacion_tercero_inquilino; ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 50%; font-family: Courier; font-size:10pt;"><strong>NOMBRE TERCERO: <?php echo $nombre_cliente_inquilino; ?></strong></td>
  </tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
<tr>
<td style="text-align: center;">----------------------------------</td>
</tr>
</table>

<table border="1" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:9pt;">
<tr>
<td style="text-align: center; width:10%; font-family: Courier; font-size:10pt;"><strong>FACT</strong></td>
<td style="text-align: center; width:50%; font-family: Courier; font-size:10pt;"><strong>CREDIT</strong></td>
<td style="text-align: center; width:15%; font-family: Courier; font-size:10pt;"><strong>ABONAD</strong></td>
<td style="text-align: center; width:5%; font-family: Courier; font-size:10pt;"><strong>PENDIENTE</strong></td>
<td style="text-align: center; width:5%; font-family: Courier; font-size:10pt;"><strong>FECHA</strong></td>
<td style="text-align: center; width:5%; font-family: Courier; font-size:10pt;"><strong></strong></td>
<tr>
</tr>
<?php
$monto_deuda_smtr_1              = 0;
$abonado_smtr_1                  = 0;
$subtotal_smtr_1                 = 0;

$calcular_datos_cuenta_cobrar = "SELECT tbl15_cuentas_cobrar.cod_cuentas_cobrar, tbl15_cuentas_cobrar.cod_factura, tbl15_cuentas_cobrar.cod_tercero, 
tbl15_cuentas_cobrar.monto_deuda, tbl15_cuentas_cobrar.abonado, tbl15_cuentas_cobrar.subtotal, tbl15_tercero.nombre1_tercero, tbl15_tercero.apellido1_tercero, 
tbl15_cuentas_cobrar.mensaje, tbl15_cuentas_cobrar.fecha_pago, tbl15_cuentas_cobrar.vendedor
FROM tbl15_tercero RIGHT JOIN tbl15_cuentas_cobrar ON tbl15_tercero.cod_tercero = tbl15_cuentas_cobrar.cod_tercero 
WHERE (tbl15_cuentas_cobrar.cod_tercero='$cod_tercero') ORDER BY tbl15_cuentas_cobrar.fecha_invert DESC";
$consulta_datos_cuenta_cobrar = mysqli_query($conectar, $calcular_datos_cuenta_cobrar);
$total_datos = mysqli_num_rows($consulta_datos_cuenta_cobrar);
while ($datos_cuenta_cobrar = mysqli_fetch_assoc($consulta_datos_cuenta_cobrar)) {

$cod_cuentas_cobrar            = $datos_cuenta_cobrar['cod_cuentas_cobrar'];
$cod_factura                   = $datos_cuenta_cobrar['cod_factura'];
$cliente                       = $datos_cuenta_cobrar['nombre1_tercero']." ".$datos_cuenta_cobrar['apellido1_tercero'];
$monto_deuda                   = $datos_cuenta_cobrar['monto_deuda'];
$abonado                       = $datos_cuenta_cobrar['abonado'];
$subtotal                      = $datos_cuenta_cobrar['subtotal'];
$mensaje                       = $datos_cuenta_cobrar['mensaje'];
$fecha_pago                    = $datos_cuenta_cobrar['fecha_pago'];
$vendedor                      = $datos_cuenta_cobrar['vendedor'];
$monto_deuda_smtr_1            = $monto_deuda_smtr_1 + $monto_deuda;
$abonado_smtr_1                = $abonado_smtr_1 + $abonado;
$subtotal_smtr_1               = $subtotal_smtr_1 + $subtotal;
?>
<tr>
<td style="text-align: center; width:10%; font-family: Courier; font-size:10pt;"><strong><?php echo $cod_factura ?></strong></td>
<td style="text-align: right; width:50%; font-family: Courier; font-size:10pt;"><strong><?php echo number_format($monto_deuda, 0, ",", ".") ?></strong></td>
<td style="text-align: right; width:50%; font-family: Courier; font-size:10pt;"><strong><?php echo number_format($abonado, 0, ",", ".") ?></strong></td>
<td style="text-align: right; width:50%; font-family: Courier; font-size:10pt;"><strong><?php echo number_format($subtotal, 0, ",", ".") ?></strong></td>
<td style="text-align: right; width:15%; font-family: Courier; font-size:10pt;"><strong><?php echo $fecha_pago ?></strong></td>
<td style="text-align: center; width:5%; font-family: Courier; font-size:10pt;"><strong></strong></td>
</tr>
<?php } ?>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
<tr>
<td style="text-align: center;">----------------------------------</td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
  <tr>
    <td style="text-align: left; width: 99%; font-family: Courier; font-size:10pt;"><strong>TOTAL CREDITO:</strong></td>
    <td style="text-align: right; width: 99%; font-family: Courier; font-size:10pt;"><strong><?php echo number_format($monto_deuda_smtr_1, 0, ",", ".") ?></strong></td>
    <td style="text-align: center; width: 5%; font-family: Courier; font-size:10pt;"></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 99%; font-family: Courier; font-size:10pt;"><strong>TOTAL ABONADO:</strong></td>
    <td style="text-align: right; width: 99%; font-family: Courier; font-size:10pt;"><strong><?php echo number_format($abonado_smtr_1, 0, ",", ".") ?></strong></td>
    <td style="text-align: center; width: 5%; font-family: Courier; font-size:10pt;"></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 99%; font-family: Courier; font-size:10pt;"><strong>TOTAL PENDIENTE:</strong></td>
    <td style="text-align: right; width: 99%; font-family: Courier; font-size:10pt;"><strong><?php echo number_format($subtotal_smtr_1, 0, ",", ".") ?></strong></td>
    <td style="text-align: center; width: 5%; font-family: Courier; font-size:10pt;"></td>
  </tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
<tr>
<td style="text-align: center;">----------------------------------</td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
  <tr>
    <td style="text-align: center; width: 98%; font-family: Courier; font-size:8pt;"><strong>Software <?php echo $titulo_emp ?> Version <?php echo $version_emp ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: center; width: 95%; font-family: Courier; font-size:8pt;"><strong><?php echo $desarrollador_emp ?> : <?php echo $pag_desarrollador_emp ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: center; width: 95%;" id="barcodeTarget" class="barcodeTarget"></td>
    <!--<td style="text-align: center; width: 95%;" id="barcodeTarget" class="barcodeTarget"><div id="barcodeTarget" class="barcodeTarget"></div></td>-->
  </tr>
  <tr>
    <td style="text-align: center; width: 95%; font-family: Courier; font-size:8pt;"><strong><?php echo $fecha_impr.$hora_impr.'-'.$cod_tercero ?></strong>_imp_cobdetallfact</td>
  </tr>
</table>

		</div>
	</div>
</div>
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