
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
<a href="../admin/lista_parametrizacion_modulos_movimiento_contable_cuenta_personal_tipo_forma_pago.php"><h4>Agregar cuentas al modulo</a></h4>
</div>
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
if (isset($_GET['nombre_modulo_puc'])) {
    $nombre_modulo_puc               = addslashes($_GET['nombre_modulo_puc']);
    $cod_tipo_forma_pago             = intval($_GET['cod_tipo_forma_pago']);
    $pagina                          = addslashes($_GET['pagina']);
    $pagina_local                    = $_SERVER['PHP_SELF'];
    $pagina_redirect                 = $pagina_local.'?nombre_modulo_puc='.$nombre_modulo_puc.'&cod_tipo_forma_pago='.$cod_tipo_forma_pago.'&pagina='.$pagina;

    $sql_tipo_forma_pago = "SELECT * FROM tbl15_tipo_forma_pago WHERE (cod_tipo_forma_pago = '$cod_tipo_forma_pago')";
    $resultado_tipo_forma_pago = mysqli_query($conectar, $sql_tipo_forma_pago);
    $info_tipo_forma_pago = mysqli_fetch_assoc($resultado_tipo_forma_pago);
                    
    $nombre_tipo_forma_pago                     = $info_tipo_forma_pago['nombre_tipo_forma_pago'];
}
?>
<script type="text/javascript">
function hacer_busqueda() {
    var xmlhttp;

    var valor_buscar = document.getElementById('busqueda').value;
    var nombre_modulo_puc = "<?php echo $nombre_modulo_puc ?>";
    var cod_tipo_forma_pago = "<?php echo $cod_tipo_forma_pago ?>";
    var pagina = "<?php echo $pagina_local ?>";

    if(valor_buscar=='') { document.getElementById("logo_cargador").innerHTML=""; return; }

    if (window.XMLHttpRequest) { xmlhttp=new XMLHttpRequest(); } else { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); }
    xmlhttp.onreadystatechange=function() {
      if (xmlhttp.readyState==4 && xmlhttp.status==200) { document.getElementById("logo_cargador").innerHTML=xmlhttp.responseText; } else { document.getElementById("logo_cargador").innerHTML='<center><img src="../imagenes/loader.gif"/></center>'; }
    }
    xmlhttp.open("POST","../admin/busqueda_inmediata_puc_movimiento_contable_cuenta_personal_php.php",true);
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttp.send("buscar="+valor_buscar+"&nombre_modulo_puc="+nombre_modulo_puc+"&cod_tipo_forma_pago="+cod_tipo_forma_pago+"&pagina="+pagina);
}
</script>

<?php
if (isset($_GET['nombre_modulo_puc'])) {
?>
<div class="table-responsive">

<form action="" id="" method="GET">
	<table class="table table-striped" cellspacing="0" cellpadding="20">
	  <tr>
	    <th style="text-align:right;"><input type="text" id="busqueda" name="busqueda" onkeyup="hacer_busqueda()" class="input-block-level" placeholder="Cargar otros registros"/><div id="logo_cargador"></div></th>
	  </tr>
	</table>
</form>

<table class="table table-striped">
    <tr>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;">MODULO</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;">FORMA DE PAGO</th>
    </tr>
    <tr>
        <td style="text-align:center; background-color:#DBE0F3; color:#000;"><?php echo $nombre_modulo_puc ?></td>
        <td style="text-align:center; background-color:#DBE0F3; color:#000;"><?php echo $nombre_tipo_forma_pago ?></td>
    </tr>
</table>

<table class="table table-striped">
	<thead>
		<tr>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;">ELIM</th>
			<th style="text-align:left; background-color:#DBE0F3; color:#000;">CODIGO PUC</th>
			<th style="text-align:left; background-color:#DBE0F3; color:#000;">CUENTA PUC</th>
			<th style="text-align:center; background-color:#DBE0F3; color:#000;">TIPO</th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;">FECHA</th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;">PREDERM</th>
		</tr>
	</thead>
	<tbody>
<?php
$sql_movimiento_contable_cuenta_personal = "SELECT * FROM tbl15_movimiento_contable_cuenta_personal WHERE (nombre_modulo_puc = '$nombre_modulo_puc' AND cod_tipo_forma_pago = '$cod_tipo_forma_pago') ORDER BY cod_movimiento_contable_cuenta_personal DESC";
$resultado_movimiento_contable_cuenta_personal = mysqli_query($conectar, $sql_movimiento_contable_cuenta_personal);
while ($info_movimiento_contable_cuenta_personal = mysqli_fetch_assoc($resultado_movimiento_contable_cuenta_personal)) {

	$cod_movimiento_contable_cuenta_personal          = $info_movimiento_contable_cuenta_personal['cod_movimiento_contable_cuenta_personal'];
    $cod_puc                                          = $info_movimiento_contable_cuenta_personal['cod_puc'];
	$codigo_puc                                       = $info_movimiento_contable_cuenta_personal['codigo_puc'];
	$nombre_puc                                       = $info_movimiento_contable_cuenta_personal['nombre_puc'];
	$tipo_puc                                         = $info_movimiento_contable_cuenta_personal['tipo_puc'];
	$cod_estado                                       = $info_movimiento_contable_cuenta_personal['cod_estado'];
    $saldo_inicial_puc                                = $info_movimiento_contable_cuenta_personal['saldo_inicial_puc'];
    $subtotal_puc                                     = $info_movimiento_contable_cuenta_personal['subtotal_puc'];
    $saldo_actual_puc                                 = $info_movimiento_contable_cuenta_personal['saldo_actual_puc'];
    $fecha_creacion                                   = $info_movimiento_contable_cuenta_personal['fecha_creacion'];
    $cod_estado_puc                                   = $info_movimiento_contable_cuenta_personal['cod_estado_puc'];

    if ($cod_estado_puc == '1') { $imagen_predetern = '../imagenes/active.png'; } else { $imagen_predetern = '../imagenes/inactive.png'; }
?>
		<tr>
            <td style="text-align:center;"><a href="../admin/eliminar_parametrizacion_puc_movimiento_contable_cuenta_personal.php?cod_movimiento_contable_cuenta_personal=<?php echo $cod_movimiento_contable_cuenta_personal?>&nombre_modulo_puc=<?php echo $nombre_modulo_puc?>&cod_tipo_forma_pago=<?php echo $cod_tipo_forma_pago ?>&pagina=<?php echo $pagina_local ?>"><img src="../imagenes/eliminar.png" class="img-polaroid" alt=""></a></td>
			<td style="text-align:left;"><?php echo $codigo_puc ?></td>
			<td style="text-align:left;"><?php echo $nombre_puc ?></td>
			<td style="text-align:center;"><?php echo $tipo_puc ?></td>
            <td style="text-align:center;"><?php echo $fecha_creacion ?></td>
            <td style="text-align:center;"><a href="../admin/reg_predeterm_movimiento_contable_cuenta_personal_reg.php?cod_movimiento_contable_cuenta_personal=<?php echo $cod_movimiento_contable_cuenta_personal?>&nombre_modulo_puc=<?php echo $nombre_modulo_puc?>&cod_tipo_forma_pago=<?php echo $cod_tipo_forma_pago ?>&pagina=<?php echo $pagina_local ?>"><img src="<?php echo $imagen_predetern ?>" class="img-polaroid" alt=""></a></td>
		</tr>
	<?php } ?>
	</tbody>
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
<?php include_once('../admin/04_modulo_footer.php'); ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include_once('../admin/05_modulo_js.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
</body>
</html>