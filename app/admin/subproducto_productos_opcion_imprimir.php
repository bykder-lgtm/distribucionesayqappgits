<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="../js/qrcode.js"></script>

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
</div>
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina_local = $_SERVER['PHP_SELF'];

$cod_info_factura_subproducto               = intval($_GET['cod_info_factura_subproducto']);
$cod_producto_barra_madre                   = addslashes($_GET['cod_producto_barra_madre']);
$pagina                                     = '../admin/lista_subproducto.php'.'?cod_info_factura_subproducto='.$cod_info_factura_subproducto;
$cod_info_factura_subproducto_codif         = DAXCODIFCRYPTOR::encodifdax($cod_info_factura_subproducto);
$cod_info_factura_subproducto_codif_cryp    = DAXCODIFCRYPTOR::encriptardax($cod_info_factura_subproducto_codif);

$obtener_informacion = "SELECT * FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$consultar_informacion = mysqli_query($conectar, $obtener_informacion) or die(mysqli_error($conectar));
$info_emp = mysqli_fetch_assoc($consultar_informacion);

$titulo_emp                          = $info_emp['titulo'];
$desarrollador_emp                   = $info_emp['desarrollador'];
$pag_desarrollador_emp               = $info_emp['pag_desarrollador'];
$correo_desarrollador_emp            = $info_emp['correo_desarrollador'];
$anyo_emp                            = $info_emp['anyo'];
$nombre_emp                          = $info_emp['nombre'];
$eslogan_emp                         = $info_emp['eslogan'];
$nombre_propietario_emp              = $info_emp['nombre_propietario'];
$cedula_propietario_emp              = $info_emp['cedula_propietario'];
$res_emp                             = $info_emp['res'];
$res1_emp                            = $info_emp['res1'];
$res2_emp                            = $info_emp['res2'];
$fecha_res_emp                       = $info_emp['fecha_res'];
$prefijo_res_emp                     = $info_emp['prefijo_res'];
$pais_emp                            = $info_emp['pais'];
$departamento_emp                    = $info_emp['departamento'];
$ciudad_emp                          = $info_emp['ciudad'];
$localidad_emp                       = $info_emp['localidad'];
$direccion_emp                       = $info_emp['direccion'];
$correo_emp                          = $info_emp['correo'];
$cabecera_emp                        = $info_emp['cabecera'];
$telefono_emp                        = $info_emp['telefono'];
$nit_empresa_emp                     = $info_emp['nit_empresa'];
$regimen_emp                         = $info_emp['regimen'];
$propietario_nombres_apellidos_emp   = $info_emp['propietario_nombres_apellidos'];
$propietario_nit_emp                 = $info_emp['propietario_nit'];
$propietario_url_firma_emp           = $info_emp['propietario_url_firma'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$obtener_info_fact = "SELECT * FROM tbl15_info_factura_subproducto WHERE (cod_info_factura_subproducto = '$cod_info_factura_subproducto')";
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
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$obtener_producto_principal = "SELECT cod_producto_barra, nombre_producto FROM tbl15_producto WHERE (cod_producto_barra = '$cod_producto_barra_madre')";
$resultado_producto_principal = mysqli_query($conectar, $obtener_producto_principal) or die(mysqli_error($conectar));
$producto_principal = mysqli_fetch_assoc($resultado_producto_principal);

$cod_producto_barra_princ            = $producto_principal['cod_producto_barra'];
$nombre_producto_princ               = $producto_principal['nombre_producto'];
?>
<table border="1" width="100%" cellspacing="0" cellpadding="20">
<thead>
<tr>
<th style="text-align:center;">NOMBRE PRODUCTO PRINCIPAL: <?php echo $nombre_producto_princ.' | '.$cod_producto_barra_princ ?></th>
</tr>
</table>

<table class="table table-striped" border="1" cellspacing="0" cellpadding="20">
<thead>
	<tr>
		<td style="text-align:center;"></td>
		<th style="text-align:center;">CODIGO SUBPRODUCTO</th>
		<th style="text-align:center;">NOMBRE SUBPRODUCTO</th>
		<th style="text-align:center;">CANTIDAD</th>
		<th style="text-align:center;">MED</th>
		<td style="text-align:center;"></td>
	</tr>
</thead>
<tbody>
<?php
$sql_subproducto = "SELECT * FROM tbl15_subproducto WHERE (cod_producto_barra_madre = '$cod_producto_barra_madre') ORDER BY cod_subproducto DESC";
$consulta_subproducto = mysqli_query($conectar, $sql_subproducto);
while ($datos_subproducto = mysqli_fetch_assoc($consulta_subproducto)) {

$cod_subproducto                   = $datos_subproducto['cod_subproducto'];
$cod_producto                      = $datos_subproducto['cod_producto'];
$cod_producto_barra                = $datos_subproducto['cod_producto_barra'];
$nombre_producto                   = $datos_subproducto['nombre_producto'];
$und_producto                      = $datos_subproducto['und_producto'];
$nombre_tipo_unidad_medida         = $datos_subproducto['nombre_tipo_unidad_medida'];
$cod_info_factura_subproducto      = $datos_subproducto['cod_info_factura_subproducto'];
?>
	<tr>
		<td style="text-align:center;"></td>
		<td style="text-align:center;"><?php echo $cod_producto_barra ?></td>
		<td style="text-align:left;"><?php echo $nombre_producto ?></td>
		<td style="text-align:center;" id="nphp echo $incre;?>"><?php echo $und_producto;?></td>
		<td style="text-align:center;"><?php echo $nombre_tipo_unidad_medida;?></td>
	</tr>
<?php } ?>
</tbody>
</table>


<table class="table table-striped">
  <tr>
    <td style="text-align:center;"><a href="<?php echo $pagina?>" id="listo"><img src="../imagenes/listo.png" alt="listo"></a></td>
  </tr>
</table>
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
<?php include_once('../admin/05_modulo_js.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->

</body>
</html>