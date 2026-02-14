<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<script src="js/jquery-1.12.3.js"></script>
<link rel="stylesheet" href="../estilo_css/jquery-ui.css">
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
</head>
<body id="pageBody">
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php $pagina = addslashes($_GET['pagina']); ?>
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">
<div class="breadcrumbs"><a href="<?php echo $pagina ?>"><h4>ACTUALIZAR REGISTRO INVENTARIO</h4></a></div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina = $_SERVER['PHP_SELF'];

if (isset($_GET['cod_producto_copia_inventario'])) {

//$cod_producto_copia_inventario                = intval($_GET['cod_producto_copia_inventario']);
$cod_info_producto_copia_inventario           = intval($_GET['cod_info_producto_copia_inventario']);
$cod_producto_barra                           = addslashes($_GET['cod_producto_barra']);
$buscar_por                                   = addslashes($_GET['buscar_por']);
$nombre_tipo_cargue_factura                   = addslashes($_GET['nombre_tipo_cargue_factura']);
$nombre_tipo_moneda                           = addslashes($_GET['nombre_tipo_moneda']);
$nombre_tipo_factura                          = addslashes($_GET['nombre_tipo_factura']);
$foco                                         = addslashes($_GET['foco']);
$cod_estado_vacuna                            = addslashes($_GET['cod_estado_vacuna']);
$pagina                                       = addslashes($_GET['pagina']);
$pagina_redirect                              = $pagina.'?cod_info_producto_copia_inventario='.$cod_info_producto_copia_inventario.'&pagina='.$pagina.

$sql_cliente = "SELECT * FROM tbl15_producto_copia_inventario WHERE (cod_info_producto_copia_inventario = '$cod_info_producto_copia_inventario') AND (cod_producto_barra = '$cod_producto_barra')";
$consulta_cliente = mysqli_query($conectar, $sql_cliente) or die(mysqli_error($conectar));
$info_cliente = mysqli_fetch_assoc($consulta_cliente);

$cod_producto_copia_inventario = $info_cliente['cod_producto_copia_inventario'];
$cod_producto_barra            = $info_cliente['cod_producto_barra'];
$nombre_producto               = $info_cliente['nombre_producto'];
$precio_compra_producto        = $info_cliente['precio_compra_producto'];
$precio_venta_producto         = $info_cliente['precio_venta_producto'];
$und_producto_viejo            = $info_cliente['und_producto_viejo'];
$und_producto_nuevo            = $info_cliente['und_producto_nuevo'];

if ($cod_tipo_sistema_numeracion_und_compra == '2') { $und_producto_viejo = intval($und_producto_viejo); } else { $und_producto_viejo = $und_producto_viejo; }
if ($cod_tipo_sistema_numeracion_precio_compra == '2') { $precio_compra_producto = intval($precio_compra_producto); } else { $precio_compra_producto = $precio_compra_producto; }
if ($cod_tipo_sistema_numeracion_precio_venta == '2') { $precio_venta_producto = intval($precio_venta_producto); } else { $precio_venta_producto = $precio_venta_producto; }

$sql_cliente = "SELECT * FROM tbl15_producto_copia_inventario WHERE (cod_info_producto_copia_inventario = '$cod_info_producto_copia_inventario') AND (cod_producto_barra = '$cod_producto_barra') AND (fecha_actualizacion <> '')";
$consulta_cliente = mysqli_query($conectar, $sql_cliente) or die(mysqli_error($conectar));
$resultado = mysqli_num_rows($consulta_cliente);
$info_cliente = mysqli_fetch_assoc($consulta_cliente);
?>

<table border="1" class="table table-responsive">
	<tbody>
		<tr>
			<th style="text-align:center"><a href="<?php echo $pagina_redirect?>">REGRESAR</a></th>
		</tr>
    </tbody>
</table>

<?php if ($resultado <> 0) { ?>
<table border="1" class="table table-responsive">
	<tbody>
		<tr>
			<th style="text-align:center"><img src=../imagenes/repetir.gif alt="repetir"> ESTE PRODUCTO YA FUE CARGADO SE VA A ACTUALIZAR<img src=../imagenes/repetir.gif alt="repetir"></th>
		</tr>
    </tbody>
</table>
<?php } ?>
<form name="formulario_insersion" accept-charset="utf-8" method="post" action="../admin/reg_cargar_producto_copia_inventario_reg.php">
<fieldset>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<tbody>
		<tr>
			<th style="text-align:center">CODIGO</th>
			<th style="text-align:center">PRODUCTO</th>
			<th style="text-align:center">UND INV</th>
			<th style="text-align:center">UND</th>
			<th style="text-align:center">P.VENTA</th>
		</tr>
		<tr>
			<th style="text-align:center"><?php echo $cod_producto_barra?></th>
			<th style="text-align:center"><?php echo $nombre_producto?></th>
			<th style="text-align:center"><?php echo $und_producto_viejo?></th>
			<td style="text-align:center"><input onblur="validar_codigo(this);" type="number" name="und_producto_nuevo" value="" id="und_producto_nuevo" min="0" oninput="validity.valid||(value='');" class="input-block-level" required autofocus/></td>
			<th style="text-align:center"><?php echo number_format($precio_venta_producto, 0, ",", "."); ?></th>

		</tr>
    </tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<input type="hidden" name="cod_producto_copia_inventario" value="<?php echo $cod_producto_copia_inventario ?>">
<input type="hidden" name="cod_info_producto_copia_inventario" value="<?php echo $cod_info_producto_copia_inventario ?>">
<input type="hidden" name="cod_producto_barra" value="<?php echo $cod_producto_barra ?>">
<input type="hidden" name="buscar_por" value="<?php echo $buscar_por ?>">
<input type="hidden" name="nombre_tipo_cargue_factura" value="<?php echo $nombre_tipo_cargue_factura ?>">
<input type="hidden" name="nombre_tipo_moneda" value="<?php echo $nombre_tipo_moneda ?>">
<input type="hidden" name="nombre_tipo_factura" value="<?php echo $nombre_tipo_factura ?>">
<input type="hidden" name="foco" value="<?php echo $foco ?>">
<input type="hidden" name="cod_estado_vacuna" value="<?php echo $cod_estado_vacuna ?>">
<input type="hidden" name="pagina" value="<?php echo $pagina ?>">
<input type="hidden" name="ins_edit" value="formulario_insert_edit">
<hr>
<div class="actions">
<input type="submit" value="Registrar Información" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" />
</div>
</fieldset>
</form>
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
<?php include_once('../admin/04_modulo_footer.php'); ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include_once('../admin/05_modulo_js_sin_jquery.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->

<script src="../js/prototype.js" type="text/javascript"></script>

<script type="text/javascript">
function validar_codigo(usuario)        {
//var url = 'validar_signo_positivo.php';
//var parametros='und_producto_nuevo='+und_producto_nuevo.value;
//var ajax = new Ajax.Updater('envio_mensaje',url,{method: 'get', parameters: parametros});
var ret = "";
}
</script>
</body>
</html>