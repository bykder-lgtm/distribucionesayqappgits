<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<script src="js/jquery.min.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/chosen.jquery.js" type="text/javascript"></script>
<script src="js/init.js" type="text/javascript" charset="utf-8"></script>
<script src="js/json2.min.js"></script>

<link rel="stylesheet" type="text/css" href="../estilo_css/estilo_modal.css">
<link rel="stylesheet" href="../estilo_css/chosen.css">
<link rel="stylesheet" href="../estilo_css/jquery-ui.css">
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
<a class="btn btn-primary" href="#"><h6>Editar</h6></a>
</div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina                      = $_SERVER['PHP_SELF'];
$tab                         = 'tbl15_gastos_tabla';
$tipo                        = 'eliminar';
$campo                       = 'cod_gastos_tabla';
//$fecha_dmy                   = date("Y-m-d");
$origen                      = 'PARACLINICOS';

if (isset($_GET['cod_gastos_tabla'])) {
$cod_gastos_tabla                     = intval($_GET['cod_gastos_tabla']);

$sql_info_factura = "SELECT * FROM tbl15_gastos_tabla WHERE (cod_gastos_tabla = '$cod_gastos_tabla')";
$resultado_info_factura = mysqli_query($conectar, $sql_info_factura) or die(mysqli_error($conectar));
$info_info_factura = mysqli_fetch_assoc($resultado_info_factura);

$conceptos                           = $info_info_factura['conceptos'];
$cod_estado                          = $info_info_factura['cod_estado'];
?>
<br>
<table class="table table-striped">
    <tr>
        <th style="text-align:left"><a href="../admin/lista_egreso_ingreso_movimiento_caja_inmobiliaria.php"><font size='+2'>EDITAR CONCEPTO DE EGRESOS</font></a></th>
    </tr>
</table>

<div class="table-responsive">
<form name="formulario_insersion" accept-charset="utf-8" method="post" action="../admin/edit_concepto_egreso_ingreso_movimiento_caja_inmobiliaria_reg.php">
<table class="table table-striped">
<thead>
<tr>
<th style="text-align:center">CONCEPTO</th>
<th style="text-align:center">ESTADO</th>
</tr>
</thead>
<tbody>
<tr>
<td style="text-align:center"><input class="input-block-level" name="conceptos" type="text" value="<?php echo $conceptos ?>" /></td>
<td>
	<select id="cod_estado" name="cod_estado" class="input-block-level"  style="font-size:15px">
        <?php if (isset($cod_estado)) { echo ""; } else { echo  ""; }
        $consulta2_sql = "SELECT cod_estado, nombre_estado FROM tbl15_estado";
        $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysql_error());
        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
        if(isset($cod_estado) and $cod_estado == $datos2['cod_estado']) {
        $seleccionado = "selected"; } else { $seleccionado = ""; }
        $codigo = $datos2['cod_estado'];
        $nombre = $datos2['nombre_estado'];
        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
		</select>
</td>
</tr>
</tbody>
</table>

<hr>
<input type="hidden" name="cod_gastos_tabla" value="<?php echo $cod_gastos_tabla ?>">
<input type="hidden" name="pagina" value="<?php echo $pagina ?>">
<input type="hidden" name="insersion" value="formulario_de_insersion">
<div class="actions">
<input type="submit" value="Editar Información" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" />
</div>
</form>
</div>
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
<?php include_once('../admin/05_modulo_js_sin_jquery.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
</body>
</html>