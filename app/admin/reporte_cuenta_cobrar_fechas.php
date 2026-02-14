<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<script src="../js/jquery.min.js" type="text/javascript"></script> 
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
<div class="breadcrumbs">
<a class="btn btn-primary" href="#"><h6>Reporte Ventas Por Rango de Fechas</h6></a>
</div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php include_once("../admin/menu_atendidos.php") ?>

<body id="pageBody">
<?php
$seleccionado                      = 0;
//*******************************************************************************************************************//
$cod_administrador_sesion    = $cod_administrador;

if ($cod_seguridad == '1') { $condicional_consulta_admin = ''; } else { $condicional_consulta_admin = 'WHERE cod_administrador = "'.$cod_administrador.'"'; }

if (($cod_estado_habilitar_tercero_por_usuario_global == '1')) {

    if ($cod_seguridad == '1') {
        $condicional_consulta_tercero = ''; 
    } else { 
        $condicional_consulta_tercero = 'WHERE cod_administrador = "'.$cod_administrador.'"'; 
    }

} else { 
$condicional_consulta_tercero = ''; 
}
//*******************************************************************************************************************//

if (isset($_GET['fecha_ymd_venta_producto_ini'])) {
$fecha_ymd_venta_producto_ini            = addslashes($_GET['fecha_ymd_venta_producto_ini']);
$fecha_ymd_venta_producto_fin            = addslashes($_GET['fecha_ymd_venta_producto_fin']);
$cod_administrador_get                   = intval($_GET['cod_administrador_get']);
$cod_tercero                             = intval($_GET['cod_tercero']);
$fecha                                   = date("Y-m-d");
} else {
$fecha_ymd_venta_producto_ini            = date("Y-m-d");
$fecha_ymd_venta_producto_fin            = date("Y-m-d");
$cod_administrador_get                   = 0;
$cod_tercero                             = 0;
$fecha                                   = date("Y-m-d");
}
if ($cod_administrador_get==0) {
$cuenta_get                                  = 'TODOS';
} else {
$sql_administrador = "SELECT cuenta FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador_get'";
$consulta_administrador = mysqli_query($conectar, $sql_administrador) or die(mysqli_error($conectar));
$datos_administrador = mysqli_fetch_assoc($consulta_administrador);

$cuenta_get                                  = $datos_administrador['cuenta'];
}

if ($cod_tercero==0) {
$nombre_cliente                                  = 'TODOS';
} else {
$sql_tercero = "SELECT identificacion_tercero, nombre1_tercero, nombre2_tercero, apellido2_tercero, apellido2_tercero FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero'";
$consulta_tercero = mysqli_query($conectar, $sql_tercero) or die(mysqli_error($conectar));
$datos_tercero = mysqli_fetch_assoc($consulta_tercero);

$nombre_cliente                                  = $datos_tercero['nombre1_tercero'].' '.$datos_tercero['apellido2_tercero'];
}

$resta                                   = 1516399999;
$time_seg                                = time();
$time_date_ymd                           = strtotime(date("Y-m-d"));
$hora                                    = date("His");
$fecha_venta_ymd                         = date("Ymd");
$hora_venta_his                          = date("His");
$fecha_impr                              = date("Ymd");
$hora_impr                               = date("His");
?>
<form action="" id="" method="GET">

<table class="table table-striped" cellspacing="0" cellpadding="20">
  <tr>
    <th style="text-align:center;">USUARIO</th>
    <th style="text-align:center;">TERCERO</th>
    <th style="text-align:center;">FECHA INICIAL</th>
    <th style="text-align:center;">FECHA FINAL</th>
  </tr>
  <td style="text-align:center;">
    <select name="cod_administrador_get" class="input-block-level" data-show-subtext="true" data-live-search="true" required>
        <?php if (isset($cod_administrador_sesion) && ($cod_seguridad == '1')) { echo "<option value='0' $seleccionado >TODOS</option>"; } else { echo ""; }
        $consulta2_sql = ("SELECT * FROM tbl15_administrador $condicional_consulta_admin");
        $consulta2 = mysqli_query($conectar, $consulta2_sql);
        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
        if(isset($cod_administrador_sesion) and $cod_administrador_sesion == $datos2['cod_administrador']) {
        $seleccionado = "selected"; } else { $seleccionado = ""; }
        $codigo = $datos2['cod_administrador'];
        $nombre = $datos2['nombres'].' '.$contenedor['apellidos'].' | '.$datos2['cuenta'];
        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
    </select>
</td>
    <td style="text-align:left;">
        <select name="cod_tercero" id="cod_tercero" class="chosen-select" data-show-subtext="true" data-live-search="true" style="width: 200px;" required>
            <?php if (isset($cod_tercero) && ($cod_seguridad == '1')) { echo "<option value='0' $seleccionado >TODOS</option>"; } else { echo  ""; }
            $consulta2_sql = ("SELECT cod_tercero, nombre_tipo_tercero, identificacion_tercero, nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero, cod_administrador FROM tbl15_tercero $condicional_consulta_tercero ORDER BY cod_tercero");
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($cod_tercero) and $cod_tercero == $datos2['cod_tercero']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['cod_tercero'];
            $cod_administrador = $datos2['cod_administrador'];

            $sql_info_adm = "SELECT * FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador'";
            $resultado_info_adm = mysqli_query($conectar, $sql_info_adm);
            $info_adm = mysqli_fetch_assoc($resultado_info_adm);

            $cuenta                                 = $info_adm['cuenta'];

            if (($cod_estado_habilitar_tercero_por_usuario_global == '1')) {
            $nombre = $datos2['nombre1_tercero'].' '.$datos2['nombre2_tercero'].' '.$datos2['apellido1_tercero'].' '.$datos2['apellido2_tercero'].' | '.$datos2['identificacion_tercero'].' | '.$cuenta.' | '.$datos2['nombre_tipo_tercero'];
            } else {
            $nombre = $datos2['nombre1_tercero'].' '.$datos2['nombre2_tercero'].' '.$datos2['apellido1_tercero'].' '.$datos2['apellido2_tercero'].' | '.$datos2['identificacion_tercero'].' | '.$datos2['nombre_tipo_tercero'];
            }
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
    </td>
    <td style="text-align:center;"><input class="input-block-level" name="fecha_ymd_venta_producto_ini" type="date" value="<?php echo $fecha_ymd_venta_producto_ini ?>" required/></td>
    <td style="text-align:center;"><input class="input-block-level" name="fecha_ymd_venta_producto_fin" type="date" value="<?php echo $fecha_ymd_venta_producto_fin ?>" required/></td>
  </tr>
</table>
<div class="actions">
<input type="submit" value="Ver Registros" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" />
</div>
</form>
<?php
if (isset($_GET['fecha_ymd_venta_producto_ini'])) {
$motivo                                  = 'TODOS';
$fecha_ymd_venta_producto_ini            = addslashes($_GET['fecha_ymd_venta_producto_ini']);
$fecha_ymd_venta_producto_fin            = addslashes($_GET['fecha_ymd_venta_producto_fin']);
$fecha                                   = date("Y/m/d");
$pagina                                  = $_SERVER['PHP_SELF'];
$contado                                 = '1';
$credito                                 = '2';
$efectivo                                = '1';
$cod_servicio_propina                    = '22222222';
$cod_producto_barra                      = $cod_servicio_propina;
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
if ($cod_administrador_get==0) {
$filtro_consulta_vendedor = "";
$filtro_consulta_vendedor_rel = "";
} else {
$filtro_consulta_vendedor = "AND (cod_administrador = '$cod_administrador_get')";
$filtro_consulta_vendedor_rel = "AND (tbl15_cuentas_cobrar.cod_administrador = '$cod_administrador_get')";
}
if ($cod_tercero==0) {
$filtro_consulta_tercero = "";
$filtro_consulta_tercero_rel = "";
} else {
$filtro_consulta_tercero = "AND (cod_tercero = '$cod_tercero')";
$filtro_consulta_tercero_rel = "AND (tbl15_cuentas_cobrar.cod_tercero = '$cod_tercero')";
}
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
?>
<table class="table table-striped">
<tr>
<td style="text-align:left;">USUARIO: <?php echo $cuenta_get ?></td>
<td style="text-align:left;">TERCERO: <?php echo $nombre_cliente ?></td>
<td style="text-align:left;">FECHA INICAL: <?php echo $fecha_ymd_venta_producto_ini ?></td>
<td style="text-align:left;">FECHA FINAL: <?php echo $fecha_ymd_venta_producto_fin ?></td>
</tr>
</table>
<!-- ********************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************* -->
<hr>
<table class="table table-striped">
<tr>
<td style="text-align:center;"><a href="#"><strong>CONSOLIDADO DE PRESTAMOS</strong></a></td>
</tr>
</table>

<table class="table table-striped">
<tr>
<td style="text-align:center;"><a href="javascript:void(0);" id="foco_btn_imprimir" onclick="printPageArea('area_imprimible_invisible')"><img src="../imagenes/imprimir_directa_pos.png" alt="imprimir"></a></td>
</tr>
</table>

<table class="table table-striped">
<tr>
<th style="text-align:center;"><a href="#">TERCERO</a></th>
<th style="text-align:center;"><a href="#">TOTAL PRESTAMO</a></th>
<th style="text-align:center;"><a href="#">TOTAL ABONADO</a></th>
<th style="text-align:center;"><a href="#">TOTAL PENDIENTE</a></th>
</tr>
<?php
$calcular_datos_cuenta_cobrar = "SELECT tbl15_cuentas_cobrar.cod_cuentas_cobrar, tbl15_cuentas_cobrar.cod_factura, 
tbl15_tercero.nombre1_tercero, tbl15_tercero.apellido1_tercero, tbl15_cuentas_cobrar.cod_tercero, tbl15_cuentas_cobrar.cod_administrador, 
Sum(tbl15_cuentas_cobrar.monto_deuda) AS monto_deuda, Sum(tbl15_cuentas_cobrar.subtotal) AS 
subtotal, Sum(tbl15_cuentas_cobrar.abonado) AS abonado, tbl15_tercero.direccion_tercero, 
tbl15_tercero.nombre_departamento, tbl15_tercero.nombre_ciudad, tbl15_tercero.telefono1_tercero, tbl15_tercero.identificacion_tercero
FROM tbl15_tercero RIGHT JOIN tbl15_cuentas_cobrar ON tbl15_tercero.cod_tercero = tbl15_cuentas_cobrar.cod_tercero
WHERE (tbl15_cuentas_cobrar.fecha_pago BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') 
$filtro_consulta_vendedor_rel $filtro_consulta_tercero_rel
GROUP BY tbl15_cuentas_cobrar.cod_tercero ORDER BY tbl15_tercero.nombre1_tercero";
$consulta_datos_cuenta_cobrar = mysqli_query($conectar, $calcular_datos_cuenta_cobrar);
while ($datos_cuenta_cobrar = mysqli_fetch_assoc($consulta_datos_cuenta_cobrar)) {

$cod_cuentas_cobrar            = $datos_cuenta_cobrar['cod_cuentas_cobrar'];
$monto_deuda                   = $datos_cuenta_cobrar['monto_deuda'];
$subtotal                      = $datos_cuenta_cobrar['subtotal'];
$abonado                       = $datos_cuenta_cobrar['abonado'];
$cod_tercero                   = $datos_cuenta_cobrar['cod_tercero'];
$cod_factura                   = $datos_cuenta_cobrar['cod_factura'];
$cliente                       = $datos_cuenta_cobrar['nombre1_tercero']." ".$datos_cuenta_cobrar['apellido1_tercero'];
$direccion_tercero             = $datos_cuenta_cobrar['direccion_tercero'];
$telefono1_tercero             = $datos_cuenta_cobrar['telefono1_tercero'];
$identificacion_tercero        = $datos_cuenta_cobrar['identificacion_tercero'];
$nombre_departamento           = $datos_cuenta_cobrar['nombre_departamento'];
$nombre_ciudad                 = $datos_cuenta_cobrar['nombre_ciudad'];
$cod_administrador             = $datos_cuenta_cobrar['cod_administrador'];

$sql_usuario_admin = "SELECT * FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador')";
$resultado_usuario_admin = mysqli_query($conectar, $sql_usuario_admin);
$info_usuario_admin = mysqli_fetch_assoc($resultado_usuario_admin);
    
$cedula                        = $info_usuario_admin['cedula'];
$nombres                       = $info_usuario_admin['nombres'];
$apellidos                     = $info_usuario_admin['apellidos'];
$cuenta                        = $info_usuario_admin['cuenta'];
$usuario                       = $nombres.' '.$apellidos.' | '.$cuenta;
?>
<tr>
<td style="text-align:left;"><?php echo $cliente?></td>
<td style="text-align:right;"><?php echo number_format($monto_deuda, 0, ",", ".") ?></td>
<td style="text-align:right;"><?php echo number_format($abonado, 0, ",", ".") ?></td>
<td style="text-align:right;"><?php echo number_format($subtotal, 0, ",", ".") ?></td>
</tr>
<?php } ?>
</table>
<!-- ********************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************* -->
<hr>
<table class="table table-striped">
<tr>
<td style="text-align:center;"><a href="#"><strong>ABONOS</strong></a></td>
</tr>
</table>
<table class="table table-striped">
<tr>
<th style="text-align: center;"># CUOTA</th>
<th style="text-align:center;">TERCERO</th>
<th style="text-align: center;">ABONOS</th>
<th style="text-align: center;">PAGO A</th>
<th style="text-align: center;">MENSAJE</th>
<th style="text-align: center;">FECHA</th>
<th style="text-align: center;">HORA</th>
<th style="text-align: center;">VER SOPORTE</th>
<th style="text-align: center;">CAMBIAR SOPORTE</th>
<!--<th style="text-align: center;">IMP</th>-->
</tr>
<?php
$sql = "SELECT * FROM tbl15_cuentas_cobrar_abonos WHERE (fecha_pago BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') 
$filtro_consulta_vendedor $filtro_consulta_tercero ORDER BY cod_cuentas_cobrar_abonos DESC";
$consulta = mysqli_query($conectar, $sql) or die(mysqli_error($conectar));
$total_datos = mysqli_num_rows($consulta);
while ($datos = mysqli_fetch_assoc($consulta)) {

$cod_cuentas_cobrar_abonos  = $datos['cod_cuentas_cobrar_abonos'];
$abonado                    = $datos['abonado'];
//$cuenta                     = $datos['cuenta'];
$mensaje                    = $datos['mensaje'];
$fecha_pago                 = $datos['fecha_pago'];
$hora                       = $datos['hora'];
$numero_alerta              = $datos['numero_alerta'];
$url_img_orig_producto      = $datos['url_img_orig_producto'];
$url_img_min_producto       = $datos['url_img_min_producto'];
$cod_administrador          = $datos['cod_administrador'];
$cod_tercero                = $datos['cod_tercero'];

$sql_usuario_admin = "SELECT * FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
$resultado_usuario_admin = mysqli_query($conectar, $sql_usuario_admin);
$info_usuario_admin = mysqli_fetch_assoc($resultado_usuario_admin);
  
$nombre_tercero                = $info_usuario_admin['nombre1_tercero']." ".$info_usuario_admin['apellido1_tercero'];

$sql_usuario_admin = "SELECT * FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador')";
$resultado_usuario_admin = mysqli_query($conectar, $sql_usuario_admin);
$info_usuario_admin = mysqli_fetch_assoc($resultado_usuario_admin);
  
$cedula                        = $info_usuario_admin['cedula'];
$nombres                       = $info_usuario_admin['nombres'];
$apellidos                     = $info_usuario_admin['apellidos'];
$cuenta                        = $info_usuario_admin['cuenta'];
$usuario                       = $cuenta;

if ($url_img_orig_producto == '') { $imagen_cargar = "../imagenes/img_nodisponible.png"; } else { $imagen_cargar = "../imagenes/img_disponible.png"; }
?>
<tr>
<td style="text-align: center;"><font size="3px"><?php echo $numero_alerta; ?></font></td>
<td style="text-align: left;"><font size="3px"><?php echo $nombre_tercero; ?></font></td>
<td style="text-align: right;"><font size='3'><?php echo number_format($abonado, 0, ",", "."); ?></font></td>
<td style="text-align: center;"><font size="3px"><?php echo $usuario; ?></font></td>
<td style="text-align: left;"><font size="3px"><?php echo $mensaje; ?></font></td>
<td style="text-align: center;"><font size="3px"><?php echo $fecha_pago; ?></font></td>
<td style="text-align: center;"><font size="3px"><?php echo $hora; ?></font></td>
<td style="text-align: center;"><font size='3'><a href="<?php echo $url_img_orig_producto; ?>" target="_blank" ><img src="<?php echo $imagen_cargar; ?>" alt=""></a></font></td>
<td style="text-align: center;"><font size='3'><a href="../admin/edit_soporte_cuenta_cobrar_abonos_prestamo.php?cod_cuentas_cobrar_abonos=<?php echo $cod_cuentas_cobrar_abonos; ?>&cod_cuentas_cobrar=<?php echo $cod_cuentas_cobrar; ?>&cod_tercero=<?php echo $cod_tercero; ?>&cod_factura=<?php echo $cod_factura; ?>&cliente=<?php echo $cliente; ?>"><img src="../imagenes/adjuntar_archivo.png" alt=""></a></font></td>
</tr>
<?php } ?>
</table>

<table class="table table-striped">
<input name="fecha_ymd_venta_producto_ini" type="hidden" value='<?php echo $fecha_ymd_venta_producto_ini;?>'>
<input name="fecha_ymd_venta_producto_fin" type="hidden" value='<?php echo $fecha_ymd_venta_producto_fin;?>'>
<input name="cod_administrador" type="hidden" value='<?php echo $cod_administrador;?>'>
<input name="cod_tercero" type="hidden" value='<?php echo $cod_tercero;?>'>
<input name="pagina" type="hidden" value='<?php echo $pagina;?>'>
</table>
</form>
<!-- ********************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************* -->

<script>
function printPageArea(areaID){

var printContent = document.getElementById(areaID);
var WinPrint = window.open('', '', 'width=400,height=1000');
WinPrint.document.write(printContent.innerHTML);
WinPrint.document.close();
WinPrint.focus();
WinPrint.print();
WinPrint.close();
}
</script>

<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<div id="wrapper" style="width: 99%;">

<div id="area_imprimible_invisible" style="width: 99%;text-align: center;"><div>

<?php if ($cod_estado_img_impimir_factura_global == '1') { ?>
<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center; width: 98%; font-family: Courier; font-size:12pt;"><img src="../imagenes/logo_empresa_factura_pos_blanco_negro.jpg" width="100px"></td>
</tr>
</table>
<?php } ?>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center; width: 99%; font-family: Courier; font-size:8pt;"><strong><?php echo $nombre_emp; ?></strong></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center; width: 99%; font-family: Courier; font-size:8pt;"><strong><?php echo $localidad_emp; ?></strong></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center; width: 99%; font-family: Courier; font-size:8pt;"><strong>NIT: <?php echo $nit_empresa_emp; ?></strong></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center; width: 99%; font-family: Courier; font-size:8pt;"><strong>DIRECCION: <?php echo $direccion_emp; ?></strong></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center; width: 99%; font-family: Courier; font-size:8pt;"><strong>TELEFONO: <?php echo $telefono_emp; ?></strong></td>
</tr>
</table>


<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center;"><=======================================></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
  <tr>
    <td style="text-align: center; width: 98%; font-family: Courier; font-size:8pt;"><strong>REPORTE VENTAS</strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong>USUARIO: <?php echo $cuenta_get; ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong>TERCERO: <?php echo $nombre_cliente; ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong>FECHA INI: <?php echo $fecha_ymd_venta_producto_ini; ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong>FECHA FIN: <?php echo $fecha_ymd_venta_producto_fin; ?></strong></td>
  </tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center;"><=======================================></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
  <tr>
    <td style="text-align: center; width: 98%; font-family: Courier; font-size:8pt;"><strong>Software <?php echo $titulo_emp ?> Version <?php echo $version_emp ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: center; width: 98%; font-family: Courier; font-size:8pt;"><strong><?php echo $desarrollador_emp ?> : <?php echo $pag_desarrollador_emp ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: center; width: 99%; font-family: Courier; font-size:8pt;"><strong><?php echo $fecha_impr.$hora_impr.'_'?></strong>_imp_repvent</td>
  </tr>
</table>
</div>
<?php } ?>
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
<?php //include_once('../admin/04_modulo_footer.php'); ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include_once('../admin/05_modulo_js_sin_jquery.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
</body>
</html>