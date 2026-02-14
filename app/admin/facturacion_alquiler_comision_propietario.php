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
<h4><a href="#">Historial del Propietario</a></h4>
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

if (isset($_GET['palabra'])) { $palabra = addslashes($_GET['palabra']); } else { $palabra = ''; }
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
<form action="../admin/facturacion_alquiler_comision_propietario.php" method="GET">
<input id="foco" name="palabra" value="<?php echo $palabra ?>" />
<input type="submit" name="buscador" value="Buscar Propietario" />
</form>
</tr>
</table>

<table class="table table-striped">
<thead>
<tr>
<th style="text-align:center">#</th>
<th style="text-align:center">VER</th>
<th style="text-align:center">CODIGO CONTRATO</th>
<th style="text-align:center">NOMBRE PROPIETARIO</th>
<th style="text-align:center">DOCUMENTO PROPIETARIO</th>
<th style="text-align:center">NOMBRE INQUILINO</th>
<th style="text-align:center">DOCUMENTO INQUILINO</th>
<th style="text-align:center">CODIGO INMUEBLE</th>
<!--<th style="text-align:center">NOMBRE INMUEBLE</th>-->
<th style="text-align:center">TIPO INMUEBLE</th>
<th style="text-align:center">ID</th>
</tr>
</thead>
<tbody>
<?php
$contador = 0;

if (isset($_GET['palabra'])) { 
$palabra = addslashes($_GET['palabra']);

$calcular_datos_cuenta_cobrar = "SELECT tbl15_cuentas_cobrar.cod_cuentas_cobrar, tbl15_cuentas_cobrar.cod_factura, tbl15_cuentas_cobrar.cod_tercero_propietario,
tbl15_tercero.nombre1_tercero, tbl15_tercero.apellido1_tercero, tbl15_cuentas_cobrar.cod_tercero, tbl15_cuentas_cobrar.cod_administrador, 
tbl15_cuentas_cobrar.monto_deuda, tbl15_cuentas_cobrar.subtotal, tbl15_cuentas_cobrar.abonado, tbl15_tercero.direccion_tercero, 
tbl15_cuentas_cobrar.cod_producto, tbl15_cuentas_cobrar.nombre_producto, tbl15_cuentas_cobrar.cod_estado_contrato, tbl15_cuentas_cobrar.nombre_tipo_cobro, 
tbl15_tercero.nombre_departamento, tbl15_tercero.nombre_ciudad, tbl15_tercero.telefono1_tercero, tbl15_tercero.identificacion_tercero
FROM tbl15_tercero RIGHT JOIN tbl15_cuentas_cobrar ON tbl15_tercero.cod_tercero = tbl15_cuentas_cobrar.cod_tercero_propietario
WHERE ((tbl15_tercero.nombre1_tercero LIKE '%$palabra%') OR (tbl15_cuentas_cobrar.cod_factura LIKE '$palabra')) AND (tbl15_cuentas_cobrar.cod_estado_archivado = '0') GROUP BY tbl15_cuentas_cobrar.cod_factura DESC";
$consulta_datos_cuenta_cobrar = mysqli_query($conectar, $calcular_datos_cuenta_cobrar);
} 
else { 
$calcular_datos_cuenta_cobrar = "SELECT tbl15_cuentas_cobrar.cod_cuentas_cobrar, tbl15_cuentas_cobrar.cod_factura, tbl15_cuentas_cobrar.cod_tercero_propietario,
tbl15_tercero.nombre1_tercero, tbl15_tercero.apellido1_tercero, tbl15_cuentas_cobrar.cod_tercero, tbl15_cuentas_cobrar.cod_administrador, 
tbl15_cuentas_cobrar.monto_deuda, tbl15_cuentas_cobrar.subtotal, tbl15_cuentas_cobrar.abonado, tbl15_tercero.direccion_tercero, 
tbl15_cuentas_cobrar.cod_producto, tbl15_cuentas_cobrar.nombre_producto, tbl15_cuentas_cobrar.cod_estado_contrato, tbl15_cuentas_cobrar.nombre_tipo_cobro, 
tbl15_tercero.nombre_departamento, tbl15_tercero.nombre_ciudad, tbl15_tercero.telefono1_tercero, tbl15_tercero.identificacion_tercero
FROM tbl15_tercero RIGHT JOIN tbl15_cuentas_cobrar ON tbl15_tercero.cod_tercero = tbl15_cuentas_cobrar.cod_tercero_propietario
WHERE (tbl15_cuentas_cobrar.cod_estado_archivado = '0') GROUP BY tbl15_cuentas_cobrar.cod_factura DESC";
$consulta_datos_cuenta_cobrar = mysqli_query($conectar, $calcular_datos_cuenta_cobrar);
} 
while ($datos_cuenta_cobrar = mysqli_fetch_assoc($consulta_datos_cuenta_cobrar)) {
	
$cod_cuentas_cobrar                      = $datos_cuenta_cobrar['cod_cuentas_cobrar'];
$monto_deuda                             = $datos_cuenta_cobrar['monto_deuda'];
$subtotal                                = $datos_cuenta_cobrar['subtotal'];
$abonado                                 = $datos_cuenta_cobrar['abonado'];
$cod_tercero                             = $datos_cuenta_cobrar['cod_tercero'];
$cod_factura                             = $datos_cuenta_cobrar['cod_factura'];
$nombre1_tercero_propietario             = $datos_cuenta_cobrar['nombre1_tercero'];
$direccion_tercero                       = $datos_cuenta_cobrar['direccion_tercero'];
$telefono1_tercero                       = $datos_cuenta_cobrar['telefono1_tercero'];
$identificacion_tercero_propietario      = $datos_cuenta_cobrar['identificacion_tercero'];
$nombre_departamento                     = $datos_cuenta_cobrar['nombre_departamento'];
$nombre_ciudad                           = $datos_cuenta_cobrar['nombre_ciudad'];
$cod_producto                            = $datos_cuenta_cobrar['cod_producto'];
$nombre_producto                         = $datos_cuenta_cobrar['nombre_producto'];
$cod_estado_contrato                     = $datos_cuenta_cobrar['cod_estado_contrato'];
$nombre_tipo_cobro                       = $datos_cuenta_cobrar['nombre_tipo_cobro'];
$cod_administrador                       = $datos_cuenta_cobrar['cod_administrador'];
$cod_tercero_propietario                 = $datos_cuenta_cobrar['cod_tercero_propietario'];

$sql_estado_contrato = "SELECT nombre_estado_contrato FROM tbl15_estado_contrato WHERE (cod_estado_contrato = '$cod_estado_contrato')";
$resultado_estado_contrato = mysqli_query($conectar, $sql_estado_contrato);
$info_estado_contrato = mysqli_fetch_assoc($resultado_estado_contrato);
    
$nombre_estado_contrato        = $info_estado_contrato['nombre_estado_contrato'];

$sql_producto = "SELECT cod_producto_barra, nombre_tipo_producto, cod_tercero FROM tbl15_producto WHERE (cod_producto = '$cod_producto')";
$resultado_producto = mysqli_query($conectar, $sql_producto);
$info_producto = mysqli_fetch_assoc($resultado_producto);
    
$cod_producto_barra                      = $info_producto['cod_producto_barra'];
$nombre_tipo_producto                    = $info_producto['nombre_tipo_producto'];

$sql_consulta_inquilino = "SELECT * FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero'";
$consulta_inquilino = mysqli_query($conectar, $sql_consulta_inquilino) or die(mysqli_error($conectar));
$datos_inquilino = mysqli_fetch_assoc($consulta_inquilino);

$identificacion_tercero_inquilino         = $datos_inquilino['identificacion_tercero'];
$nombre1_tercero_inquilino                = $datos_inquilino['nombre1_tercero'];
$nombre2_tercero_inquilino                = $datos_inquilino['nombre2_tercero'];
$apellido1_tercero_inquilino              = $datos_inquilino['apellido1_tercero'];
$apellido2_tercero_inquilino              = $datos_inquilino['apellido2_tercero'];

$contador++;
?>
<tr>
<td style="text-align: center;"><font size='3'><?php echo $contador;?></font></td>
<td style="text-align: center;"><font size='3'><a href="../admin/comision_propietario_detalle_factura_alquiler.php?cod_cuentas_cobrar=<?php echo $cod_cuentas_cobrar; ?>&cod_tercero=<?php echo $cod_tercero; ?>&cod_factura=<?php echo $cod_factura; ?>&pagina=<?php echo $pagina; ?>&palabra=<?php echo $palabra; ?>"><img src="../imagenes/ver.png" class="img-polaroid" alt=""></a></font></td>
<td style="text-align: center;"><font size='3'><?php echo $cod_factura;?></font></td>
<td style="text-align: left;"><font size='3'><?php echo $nombre1_tercero_propietario;?></font></td>
<td style="text-align: center;"><font size='3'><?php echo $identificacion_tercero_propietario; ?></font></td>
<td style="text-align: left;"><font size='3'><?php echo $nombre1_tercero_inquilino; ?></font></td>
<td style="text-align: center;"><font size='3'><?php echo $identificacion_tercero_inquilino;?></font></td>
<td style="text-align: center;"><font size='3'><?php echo $cod_producto_barra; ?></font></td>
<!--<td style="text-align: center;"><font size='3'><?php echo $nombre_producto; ?></font></td>-->
<td style="text-align: center;"><font size='3'><?php echo $nombre_tipo_producto ; ?></font></td>
<td style="text-align: center;"><font size='3'><?php echo $cod_cuentas_cobrar; ?></font></td>
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

<script>  
$(document).ready(function(){  
  document.getElementById("foco").focus();  
});  
</script>