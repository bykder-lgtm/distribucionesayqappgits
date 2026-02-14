<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<script language="javascript" src="isiAJAX.js"></script>
<script language="javascript">
var last;
var nombre_pagina = document.getElementById('nombre_pagina').value;
var cod_cuentas_facturas = document.getElementById('cod_cuentas_facturas').value;
function Focus(elemento, valor) {
$(elemento).className = 'activo';
last = valor;
}
function Blur(elemento, valor, campo, id) {
$(elemento).className = 'inactivo';
if (last != valor)
myajax.Link('guardar_cargar_factura_temporal.php?valor='+valor+'&campo='+campo+'&id='+id+'&nombre_pagina='+nombre_pagina+'&cod_cuentas_facturas='+cod_cuentas_facturas);
}
</script>
</head>
<body id="pageBody" onLoad="myajax = new isiAJAX();">
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php //$pagina = addslashes($_GET['pagina']); ?>
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">

<div class="breadcrumbs">
<a href="#"><h4>Cuentas por Cobrar</a>
</div>
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$nombre_pagina                     = "cargar_factura_temporal.php";
$nombre_tipo_compra                = "NORMAL";
$nombre_tipo_cargue_factura        = "FACTURA_COMPRA_NORMAL";

$datos_info_factura_compra = "SELECT cod_cuentas_facturas FROM cuentas_facturas WHERE (estado = 'abierto') AND (vendedor = '$cuenta_actual') AND (nombre_tipo_cargue_factura = '$nombre_tipo_cargue_factura')";
$consulta_info_factura_compra = mysql_query($datos_info_factura_compra, $conectar) or die(mysql_error());
$info_factura_compra = mysql_fetch_assoc($consulta_info_factura_compra);

$cod_cuentas_facturas              = $info_factura_compra['cod_cuentas_facturas'];

$sql = "SELECT * FROM cargar_factura_temporal WHERE (cod_cuentas_facturas = '$cod_cuentas_facturas') ORDER BY cod_cargar_factura_temporal DESC";
$consulta = mysql_query($sql, $conectar) or die(mysql_error());
$total_datos = mysql_num_rows($consulta);
?>
<input type="hidden" id="nombre_pagina" value="<?php echo $nombre_pagina;?>">
<input type="hidden" id="nombre_tipo_compra" value="<?php echo $nombre_tipo_compra;?>">
<input type="hidden" id="nombre_tipo_cargue_factura" value="<?php echo $nombre_tipo_cargue_factura;?>">
<input type="hidden" id="cod_cuentas_facturas" value="<?php echo $cod_cuentas_facturas;?>">

<div class="table-responsive">
<table class="table table-striped">
	
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