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
<h4>Prestamos - <a href="../admin/reg_cuentas_cobrar_manual_prestamo.php">Crear nuevo prestamo</a></h4>
</div>
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina = $_SERVER['PHP_SELF'];

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
<form action="../admin/lista_cuentas_cobrar_prestamo.php" method="post">
<input id="foco" name="palabra" value="<?php echo $palabra ?>" />
<input type="submit" name="buscador" value="Buscar Clientes" />
</form>
</tr>
</table>

<table class="table table-striped">
<tr>
<td align="center"><strong><font size='4'>TOTAL</font></strong></td>
<td align="center"><strong><font size='4'><?php echo number_format($total_subtotal, 0, ",", ".") ?></font></strong></td>
<!--<td align="center"><a href="../admin/descargar_cuentas_cobrar_xls.php" target="_blank"><img src=../imagenes/btn_xls.png alt="imprimir"></a></td>-->
</tr>
</table>

<table class="table table-striped">
<thead>
<tr>
<th style="text-align:center">NIT</th>
<th style="text-align:center">TERCERO</th>
<th style="text-align:center">TOTAL PRESTAMO</th>
<th style="text-align:center">TOTAL ABONADO</th>
<th style="text-align:center">PENDIENTE</th>
<th style="text-align:center">CIUDAD</th>
<th style="text-align:center">DIRECCION</th>
<th style="text-align:center">TELEFONO</th>
<?php if ($cod_estado_habilitar_tercero_por_usuario_global == '1') { ?><th style="text-align:center">USUARIO</th><?php } ?>
<th style="text-align:center">OK</th>
</tr>
</thead>
<tbody>
<?php
if (isset($_POST['palabra'])) { 
$palabra = addslashes($_POST['palabra']);

$calcular_datos_cuenta_cobrar = "SELECT tbl15_cuentas_cobrar.cod_cuentas_cobrar, tbl15_cuentas_cobrar.cod_factura, 
tbl15_tercero.nombre1_tercero, tbl15_tercero.apellido1_tercero, tbl15_cuentas_cobrar.cod_tercero, tbl15_cuentas_cobrar.cod_administrador, 
Sum(tbl15_cuentas_cobrar.monto_deuda) AS monto_deuda, Sum(tbl15_cuentas_cobrar.subtotal) AS 
subtotal, Sum(tbl15_cuentas_cobrar.abonado) AS abonado, tbl15_tercero.direccion_tercero, 
tbl15_tercero.nombre_departamento, tbl15_tercero.nombre_ciudad, tbl15_tercero.telefono1_tercero, tbl15_tercero.identificacion_tercero
FROM tbl15_tercero RIGHT JOIN tbl15_cuentas_cobrar ON tbl15_tercero.cod_tercero = tbl15_cuentas_cobrar.cod_tercero
WHERE (tbl15_tercero.nombre1_tercero LIKE '%$palabra%') OR (tbl15_tercero.apellido1_tercero LIKE '%$palabra%') GROUP BY tbl15_cuentas_cobrar.cod_tercero 
$condicional_consulta_tercero
ORDER BY tbl15_tercero.nombre1_tercero";
$consulta_datos_cuenta_cobrar = mysqli_query($conectar, $calcular_datos_cuenta_cobrar);
} 
else { 
$calcular_datos_cuenta_cobrar = "SELECT tbl15_cuentas_cobrar.cod_cuentas_cobrar, tbl15_cuentas_cobrar.cod_factura, 
tbl15_tercero.nombre1_tercero, tbl15_tercero.apellido1_tercero, tbl15_cuentas_cobrar.cod_tercero, tbl15_cuentas_cobrar.cod_administrador, 
Sum(tbl15_cuentas_cobrar.monto_deuda) AS monto_deuda, Sum(tbl15_cuentas_cobrar.subtotal) AS 
subtotal, Sum(tbl15_cuentas_cobrar.abonado) AS abonado, tbl15_tercero.direccion_tercero, 
tbl15_tercero.nombre_departamento, tbl15_tercero.nombre_ciudad, tbl15_tercero.telefono1_tercero, tbl15_tercero.identificacion_tercero
FROM tbl15_tercero RIGHT JOIN tbl15_cuentas_cobrar ON tbl15_tercero.cod_tercero = tbl15_cuentas_cobrar.cod_tercero
$condicional_consulta_tercero_rel
GROUP BY tbl15_cuentas_cobrar.cod_tercero ORDER BY tbl15_tercero.nombre1_tercero";
$consulta_datos_cuenta_cobrar = mysqli_query($conectar, $calcular_datos_cuenta_cobrar);
} 
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
<td><font size='4'><a href="../admin/cuentas_cobrar_detalle_factura_tercero_prestamo.php?cod_tercero=<?php echo $cod_tercero; ?>"><?php echo $identificacion_tercero;?></a></font></td>
<td><font size='4'><a href="../admin/cuentas_cobrar_detalle_factura_tercero_prestamo.php?cod_tercero=<?php echo $cod_tercero; ?>"><?php echo $cliente;?></a></font></td>
<td style="text-align: right;"><font size='4'><?php echo number_format($monto_deuda, 0, ",", "."); ?></font></td>
<td style="text-align: right;"><font size='4'><?php echo number_format($abonado, 0, ",", "."); ?></font></td>

<?php if ($subtotal <= 0) { ?> <td style="text-align: right;"><font size='4'><?php echo number_format($subtotal, 0, ",", "."); ?></font></td>
<?php } else { ?> <td style="text-align: right;"><font size='4'><?php echo number_format($subtotal, 0, ",", "."); ?></font></td> <?php } ?>

<td style="text-align: center;"><font size='4'><?php echo $nombre_ciudad; ?></font></td>
<td style="text-align: right;"><font size='4'><?php echo $direccion_tercero; ?></font></td>
<td style="text-align: right;"><font size='4'><?php echo $telefono1_tercero; ?></font></td>
<?php if ($cod_estado_habilitar_tercero_por_usuario_global == '1') { ?><td style="text-align: center;"><font size='4'><?php echo $usuario; ?></font></td><?php } ?>
<td style="text-align: center;"><font size='4'><a href="../admin/cuentas_cobrar_cliente_actualizar.php?cod_tercero=<?php echo $cod_tercero; ?>&pagina=<?php echo $pagina; ?>"><img src="../imagenes/correcto.png"></a></font></td>
</tr>
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