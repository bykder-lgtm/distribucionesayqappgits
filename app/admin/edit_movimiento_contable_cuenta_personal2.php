
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
<div class="breadcrumbs"><a href="<?php echo $pagina; ?>"><h4>Editar Cuenta Personal</h4></a></div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$cod_movimiento_contable_cuenta_personal             = intval($_GET['cod_movimiento_contable_cuenta_personal']);

$mostrar_datos_sql = "SELECT * FROM tbl15_movimiento_contable_cuenta_personal WHERE (cod_movimiento_contable_cuenta_personal = '$cod_movimiento_contable_cuenta_personal')";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
$matriz_consulta = mysqli_fetch_assoc($consulta);

    $cod_movimiento_contable_cuenta_personal                   = $matriz_consulta['cod_movimiento_contable_cuenta_personal'];
    $nombre_movimiento_contable_cuenta_personal                = $matriz_consulta['nombre_movimiento_contable_cuenta_personal'];
    $valor_movimiento_contable_cuenta_personal                 = $matriz_consulta['valor_movimiento_contable_cuenta_personal'];
    $fecha_movimiento_contable_cuenta_personal                 = $matriz_consulta['fecha_movimiento_contable_cuenta_personal'];
    $cupo_disponible_movimiento_contable_cuenta_personal       = $matriz_consulta['cupo_disponible_movimiento_contable_cuenta_personal'];
    $disponible_avances_movimiento_contable_cuenta_personal    = $matriz_consulta['disponible_avances_movimiento_contable_cuenta_personal'];
    $ptj_tasa_interes                                          = $matriz_consulta['ptj_tasa_interes'];
    $nombre_tipo_puc                                           = $matriz_consulta['nombre_tipo_puc'];
    $fecha_hora_modificacion                                   = $matriz_consulta['fecha_hora_modificacion'];
    $cuenta                                                    = $matriz_consulta['cuenta'];
    $cod_administrador                                         = $matriz_consulta['cod_administrador'];
    $cod_banco                                                 = $matriz_consulta['cod_banco'];
    $cod_estado                                                = $matriz_consulta['cod_estado'];
?>
<form name="formulario_edicion" accept-charset="utf-8" method="post" action="../admin/edit_movimiento_contable_cuenta_personal_reg.php">
<fieldset>

<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
        <tr>
            <th style="text-align:center">Cod</th>
            <th style="text-align:center">Nombre</th>
            <th style="text-align:center">Valor</th>
            <th style="text-align:center">Banco</th>
            <th style="text-align:center">Estado</th>
        </tr>
	</thead>
    <tbody>
    	<tr>
            <td style="text-align:center"><?php echo ($cod_movimiento_contable_cuenta_personal) ?></td>
            <td style="text-align:center"><input type="text" name="nombre_movimiento_contable_cuenta_personal" value="<?php echo ($nombre_movimiento_contable_cuenta_personal) ?>"  class="input-block-level" required/></td>
            <td style="text-align:center"><input type="text" name="valor_movimiento_contable_cuenta_personal" value="<?php echo ($valor_movimiento_contable_cuenta_personal) ?>"  class="input-block-level" required/></td>
            <td style="text-align:center">        
            <select name="cod_banco" id="cod_banco" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 150px;">
                <?php if (isset($cod_banco)) { echo ""; } else { echo ""; }
                $consulta2_sql = "SELECT * FROM tbl15_banco WHERE (cod_estado = '1') ORDER BY nombre_banco ASC";
                $consulta2 = mysqli_query($conectar, $consulta2_sql);
                while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                if(isset($cod_banco) AND $cod_banco == $datos2['cod_banco']) {
                $seleccionado = "selected"; } else { $seleccionado = ""; }
                $codigo = $datos2['cod_banco'];
                $nombre = $datos2['nombre_banco'];
                echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
            </select>
            </td>
            <td style="text-align:center">        
            <select name="cod_estado" id="cod_estado" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 150px;">
                <?php if (isset($cod_estado)) { echo ""; } else { echo ""; }
                $consulta2_sql = "SELECT cod_estado, nombre_estado FROM tbl15_estado ORDER BY nombre_estado ASC";
                $consulta2 = mysqli_query($conectar, $consulta2_sql);
                while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                if(isset($cod_estado) AND $cod_estado == $datos2['cod_estado']) {
                $seleccionado = "selected"; } else { $seleccionado = ""; }
                $codigo = $datos2['cod_estado'];
                $nombre = $datos2['nombre_estado'];
                echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
            </select>
            </td>
    	</tr>
    	</tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<hr>
<input type="hidden" name="cod_movimiento_contable_cuenta_personal" value="<?php echo $cod_movimiento_contable_cuenta_personal ?>"/>
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