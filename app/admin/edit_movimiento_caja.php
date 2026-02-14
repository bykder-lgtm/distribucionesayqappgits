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
<?php $pagina = addslashes($_GET['pagina']); ?>
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">
<div class="breadcrumbs"><a href="<?php echo $pagina; ?>"><h4>Editar Movimiento Caja</h4></a></div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$cod_movimiento_caja             = intval($_GET['cod_movimiento_caja']);

    $mostrar_datos_sql = "SELECT * FROM tbl15_movimiento_caja WHERE (cod_movimiento_caja = '$cod_movimiento_caja')";
    $consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
    $existe_reg = mysqli_num_rows($consulta);
    $matriz_consulta = mysqli_fetch_assoc($consulta);

    $cod_movimiento_caja                   = $matriz_consulta['cod_movimiento_caja'];
    $total_venta_producto                  = $matriz_consulta['total_venta_producto'];
    $total_saldo                           = $matriz_consulta['total_saldo'];
    $fecha_ymd_movimiento_caja             = $matriz_consulta['fecha_ymd_movimiento_caja'];

if ($existe_reg == '0') {
    $sql_data = "INSERT INTO tbl15_movimiento_caja (cod_movimiento_caja) VALUES ('1')";
    $exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/edit_movimiento_caja.php?cod_movimiento_caja=1&pagina=<?php echo $pagina ?>">
<?php } ?>

<form name="formulario_edicion" accept-charset="utf-8" method="post" action="../admin/edit_movimiento_caja_reg.php">
<fieldset>

<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
        <tr>
            <th style="text-align:center">ID</th>
            <th style="text-align:center">TOTAL VENTA</th>
            <th style="text-align:center">TOTAL SALDO</th>
            <th style="text-align:center">FECHA</th>
        </tr>
	</thead>
    <tbody>
    	<tr>
            <td style="text-align:center"><?php echo ($cod_movimiento_caja) ?></td>
            <td style="text-align:center"><input type="number" name="total_venta_producto" value="<?php echo ($total_venta_producto) ?>"  class="input-block-level" required/></td>
            <td style="text-align:center"><input type="number" name="total_saldo" value="<?php echo ($total_saldo) ?>"  class="input-block-level" required/></td>
            <td style="text-align:center"><input type="date" name="fecha_ymd_movimiento_caja" value="<?php echo ($fecha_ymd_movimiento_caja) ?>"  class="input-block-level" required/></td>
    	</tr>
    	</tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<hr>
<input type="hidden" name="cod_movimiento_caja" value="<?php echo $cod_movimiento_caja ?>"/>
<input type="hidden" name="pagina" value="<?php echo $pagina ?>"/>
<input type="hidden" name="ins_edit" value="formulario_insert_edit">

<div class="actions"><td><input type="submit" value="Actualizar Información" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" /></td></div>
</fieldset>
</form>
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