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
<a href="#"><h4>Saldo Cuentas Cajas Activas&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
<a href="../admin/lista_egreso_movimiento_caja_fisica_inactiva.php">Cuentas Cajas Inactivas</h4></a>
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

$sql_movimiento_caja = "SELECT SUM(total_saldo) AS total_saldo_movimiento_caja FROM tbl15_movimiento_caja WHERE (cod_estado = '1')";
$consulta_movimiento_caja = mysqli_query($conectar, $sql_movimiento_caja) or die(mysqli_error($conectar));
$matriz_movimiento_caja = mysqli_fetch_assoc($consulta_movimiento_caja);

$total_saldo_movimiento_caja                 = $matriz_movimiento_caja['total_saldo_movimiento_caja'];
?>
<script type="text/javascript">
function hacer_busqueda() {
    var xmlhttp;

    var valor_buscar = document.getElementById('busqueda').value;
    var pagina = "<?php echo $pagina_local ?>";

    if(valor_buscar=='') { document.getElementById("logo_cargador").innerHTML=""; return; }

    if (window.XMLHttpRequest) { xmlhttp=new XMLHttpRequest(); } else { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); }
    xmlhttp.onreadystatechange=function() {
      if (xmlhttp.readyState==4 && xmlhttp.status==200) { document.getElementById("logo_cargador").innerHTML=xmlhttp.responseText; } else { document.getElementById("logo_cargador").innerHTML='<center><img src="../imagenes/loader.gif"/></center>'; }
    }
    xmlhttp.open("POST","../admin/busqueda_inmediata_puc_movimiento_caja_fisica_php.php",true);
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttp.send("buscar="+valor_buscar+"&pagina="+pagina);
}
</script>

<div class="table-responsive">

<form action="" id="" method="GET">
	<table class="table table-striped" cellspacing="0" cellpadding="20">
	  <tr>
	    <th style="text-align:right;"><input type="text" id="busqueda" name="busqueda" onkeyup="hacer_busqueda()" class="input-block-level" placeholder="Cargar otros registros"/><div id="logo_cargador"></div></th>
	  </tr>
	</table>
</form>

<table class="table table-striped">
	<thead>
		<tr>
            <!--<th style="text-align:center; background-color:#DBE0F3; color:#000;">ELIM</th>-->
            <th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 20px;">ID</th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 20px;">ID PUC</th>
			<th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 20px;">CODIGO PUC</th>
			<th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 20px;">CUENTA PUC</th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 20px;">TIPO FORMA PAGO</th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 20px;">SALDO</th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 20px;">FECHA</th>
            <?php if ($cod_estado_egreso_editar == '1') { ?><th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 20px;">EDIT</th><?php } ?>
		</tr>
	</thead>
	<tbody>
<?php
$mostrar_datos_sql = "SELECT * FROM tbl15_movimiento_caja WHERE (cod_estado = '1') ORDER BY cod_movimiento_caja";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
while ($matriz_consulta = mysqli_fetch_assoc($consulta)) {

    $cod_movimiento_caja                 = $matriz_consulta['cod_movimiento_caja'];
    $total_compra_producto               = $matriz_consulta['total_compra_producto'];
    $total_venta_producto                = $matriz_consulta['total_venta_producto'];
    $total_saldo                         = $matriz_consulta['total_saldo'];
    $fecha_ymd_movimiento_caja           = $matriz_consulta['fecha_ymd_movimiento_caja'];
    $fecha_mes_movimiento_caja           = $matriz_consulta['fecha_mes_movimiento_caja'];
    $fecha_anyo_movimiento_caja          = $matriz_consulta['fecha_anyo_movimiento_caja'];
    $fecha_hora_movimiento_caja          = $matriz_consulta['fecha_hora_movimiento_caja'];
    $fecha_seg_movimiento_caja           = $matriz_consulta['fecha_seg_movimiento_caja'];
    $fecha_creacion                      = $matriz_consulta['fecha_creacion'];
    $fecha_modificacion                  = $matriz_consulta['fecha_modificacion'];
    $ip                                  = $matriz_consulta['ip'];
    $cuenta                              = $matriz_consulta['cuenta'];
    $cod_puc                             = $matriz_consulta['cod_puc'];
    $codigo_puc                          = $matriz_consulta['codigo_puc'];
    $nombre_puc                          = $matriz_consulta['nombre_puc'];
    $tipo_puc                            = $matriz_consulta['tipo_puc'];
    $saldo_inicial_puc                   = $matriz_consulta['saldo_inicial_puc'];
    $subtotal_puc                        = $matriz_consulta['subtotal_puc'];
    $saldo_actual_puc                    = $matriz_consulta['saldo_actual_puc'];
    $nombre_modulo_puc                   = $matriz_consulta['nombre_modulo_puc'];
    $cod_tipo_forma_pago                 = $matriz_consulta['cod_tipo_forma_pago'];

    $sql_tipo_forma_pago = "SELECT * FROM tbl15_tipo_forma_pago WHERE (cod_tipo_forma_pago = '$cod_tipo_forma_pago')";
    $resultado_tipo_forma_pago = mysqli_query($conectar, $sql_tipo_forma_pago) or die(mysqli_error($conectar));
    $info_tipo_forma_pago = mysqli_fetch_assoc($resultado_tipo_forma_pago);

    $nombre_tipo_forma_pago                               = $info_tipo_forma_pago['nombre_tipo_forma_pago'];
?>
		<tr>
            <!--<td style="text-align:center;"><a href="../admin/eliminar_parametrizacion_puc_movimiento_contable.php?cod_parametrizacion_puc_movimiento_contable=<?php echo $cod_parametrizacion_puc_movimiento_contable?>&nombre_modulo_puc=<?php echo $nombre_modulo_puc?>&cod_tipo_forma_pago=<?php echo $cod_tipo_forma_pago ?>&pagina=<?php echo $pagina_local ?>"><img src="../imagenes/eliminar.png" class="img-polaroid" alt=""></a></td>-->
			<td style="text-align:center; font-size: 20px;"><?php echo $cod_movimiento_caja ?></td>
			<td style="text-align:center; font-size: 20px;"><?php echo $cod_puc ?></td>
			<td style="text-align:center; font-size: 20px;"><?php echo $codigo_puc ?></td>
            <td style="text-align:left; font-size: 20px;"><?php echo $nombre_puc ?></td>
            <td style="text-align:center; font-size: 20px;"><?php echo $nombre_tipo_forma_pago ?></td>
            <td style="text-align:right; font-size: 20px;"><?php echo number_format($total_saldo, 0, ",", "."); ?></td>
            <td style="text-align:center; font-size: 20px;"><?php echo $fecha_ymd_movimiento_caja ?></td>
            <?php if ($cod_estado_egreso_editar == '1') { ?><td style="text-align:center; font-size: 20px;"><a href="../admin/edit_egreso_movimiento_caja_fisica.php?cod_movimiento_caja=<?php echo $cod_movimiento_caja?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/editar.png" class="img-polaroid" alt=""></a></td><?php } ?>
		</tr>
	<?php } ?>

            <th style="text-align:center; font-size: 20px;"></th>
            <th style="text-align:center; font-size: 20px;"></th>
            <th style="text-align:center; font-size: 20px;"></th>
            <th style="text-align:center; font-size: 20px;"></th>
            <th style="text-align:left; font-size: 30px;">TOTAL SALDO CUENTAS:</th>
            <th style="text-align:right; font-size: 30px;"><?php echo number_format($total_saldo_movimiento_caja, 0, ",", "."); ?></th>
            <th style="text-align:center; font-size: 20px;"></th>
            <?php if ($cod_estado_egreso_editar == '1') { ?><th style="text-align:center; font-size: 20px;"></th><?php } ?>

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