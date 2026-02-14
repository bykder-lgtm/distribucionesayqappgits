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
<a class="btn btn-primary" href="#"><h6>Lista Auditoria</h6></a>
</div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina                      = $_SERVER['PHP_SELF'];
$pagina_local                = $_SERVER['PHP_SELF'];
$tab                         = 'tbl15_info_factura_auditoria';
$tipo                        = 'eliminar';
$campo                       = 'cod_info_factura_auditoria';
$fecha                       = date("Y/m/d");
$origen                      = 'PARACLINICOS';
?>
<br>
<table class="table table-striped">
    <tr>
        <th style="text-align:left"><a href="#"><font size='+2'>Lista de Auditoria</font></a></th>
        <th style="text-align:left"><a href="../admin/lista_info_factura_auditoria_mensaje.php"><font size='+2'>Lista de Auditoria Masiva</font></a></th>
		<?php if ($cod_estado_prod_auditoria_registrar == '1') { ?><th style="text-align:right"><a href="../admin/facturacion_auditoria_temporal_producto_manual_pos.php"><font size='+2'>Crear Nueva Auditoria</font></a></th><?php } ?>
    </tr>
</table>

<div class="table-responsive">
<div id="eliminar-ok" style="display:none;">&nbsp;</div>

<?php if ($cod_estado_prod_auditoria == '1') { ?>
<table class="table table-striped">
<thead>
<tr>
<?php if ($cod_estado_prod_auditoria_eliminar == '1') { ?>
<th style="text-align:center">ELIM</th>
<?php } ?>
<th style="text-align:center">COD AUDIT</th>
<th style="text-align:center">CUENTA</th>
<th style="text-align:center">RESULT AUDIT</th>
<th style="text-align:center">REG AUDIT</th>
<th style="text-align:center">REG NO AUDIT</th>
<th style="text-align:center">FECHA</th>
<th style="text-align:center">HORA</th>
</tr>
</thead>
<tbody>
<?php
$sql_info_factura = "SELECT * FROM tbl15_info_factura_auditoria WHERE (nombre_estado_factura = 'CERRADA') ORDER BY cod_info_factura_auditoria DESC";
$resultado_info_factura = mysqli_query($conectar, $sql_info_factura) or die(mysqli_error($conectar));
while ($info_info_factura = mysqli_fetch_assoc($resultado_info_factura)) {
    
$cod_info_factura_auditoria            = $info_info_factura['cod_info_factura_auditoria'];
$cod_factura                           = $info_info_factura['cod_factura'];
$nombre_empresa                        = $info_info_factura['nombre_empresa'];
$razonsocial_empresa                   = $info_info_factura['razonsocial_empresa'];
$cuenta                                = $info_info_factura['cuenta'];
$cod_estado_factura                    = $info_info_factura['cod_estado_factura'];
$fecha_anyo                            = $info_info_factura['fecha_anyo'];
$fecha_hora                            = $info_info_factura['fecha_hora'];
$cod_administrador                     = $info_info_factura['cod_administrador'];
$nombre_tipo_producto                  = $info_info_factura['nombre_tipo_producto'];
$total_factura_compra_retefuente       = $info_info_factura['total_factura_compra_retefuente'];
$cod_tipo_forma_pago                   = $info_info_factura['cod_tipo_forma_pago'];
$nombre_tipo_factura                   = $info_info_factura['nombre_tipo_factura'];
$cod_tercero                           = $info_info_factura['cod_tercero'];
$cod_tipo_inventario                   = $info_info_factura['cod_tipo_inventario'];
$nombre_tipo_cargue_factura            = $info_info_factura['nombre_tipo_cargue_factura'];

$obtener_cliente = "SELECT * FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
$resultado_cliente = mysqli_query($conectar, $obtener_cliente) or die(mysqli_error($conectar));
$matriz_cliente = mysqli_fetch_assoc($resultado_cliente);

$nombre_cliente                        = $matriz_cliente['nombre1_tercero'].' '.$matriz_cliente['apellido1_tercero'];
?>
<tr>
<?php if ($cod_estado_prod_auditoria_eliminar == '1') { ?>
<td style="text-align:center;"><a href="../admin/eliminar_auditoria.php?llave=<?php echo $cod_info_factura_auditoria?>&tab=<?php echo $tab ?>&tipo=<?php echo $tipo ?>&campo=<?php echo $campo ?>&pagina=<?php echo $pagina_local ?>"><img src="../imagenes/eliminar.png" class="img-polaroid" alt=""></a></td>
<?php } ?>
<td style="text-align:center"><?php echo $cod_info_factura_auditoria?></td>
<td style="text-align:left"><?php echo $cuenta?></td>
<td style="text-align:center"><a href="../admin/resultado_auditoria_producto_manual_pos.php?cod_info_factura_auditoria=<?php echo $cod_info_factura_auditoria ?>"><img src="../imagenes/cruze.gif" class="img-polaroid" alt=""></a></td>
<td style="text-align:center"><a href="../admin/registro_si_auditoria_producto.php?cod_info_factura_auditoria=<?php echo $cod_info_factura_auditoria ?>"><img src="../imagenes/ver.png" class="img-polaroid" alt=""></a></td>
<td style="text-align:center"><a href="../admin/registro_no_auditoria_producto.php?cod_info_factura_auditoria=<?php echo $cod_info_factura_auditoria ?>"><img src="../imagenes/ver3.png" class="img-polaroid" alt=""></a></td>
<td style="text-align:center"><?php echo $fecha_anyo?></td>
<td style="text-align:center"><?php echo $fecha_hora?></td>
</tr>
<?php } ?>
</tbody>
</table>
<?php } ?>
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