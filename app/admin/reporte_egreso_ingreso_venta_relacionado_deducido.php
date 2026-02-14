<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<?php include_once('../admin/02_modulo_estilo_css_chosen_600px.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<script src="js/jquery.min.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/chosen.jquery.js" type="text/javascript"></script>
<script src="js/init.js" type="text/javascript" charset="utf-8"></script>
<script src="js/json2.min.js"></script>
<link rel="stylesheet" href="../estilo_css/jquery-ui.css">

<script>
    $(document).ready(function(){
        $("#cod_tercero_propietario").chosen();
   });
</script>
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
<!--<a class="btn btn-primary" href="#"><h6>Lista Facturas</h6></a>-->
</div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$seleccionado = 1;
$pagina_local = '';

if (isset($_GET['fecha_gasto_inmueble_detalle_ini'])) {
$fecha_gasto_inmueble_detalle_ini            = addslashes($_GET['fecha_gasto_inmueble_detalle_ini']);
$fecha_gasto_inmueble_detalle_fin            = addslashes($_GET['fecha_gasto_inmueble_detalle_fin']);
$cod_tercero_propietario                     = intval($_GET['cod_tercero_propietario']);
$cod_factura                                 = intval($_GET['cod_factura']);
$fecha                                       = date("Y-m-d");


if ($cod_tercero_propietario==0) {
$filtro_consulta_tercero = "";
$filtro_consulta_tercero_rel = "";
} else {
$filtro_consulta_tercero = "AND (cod_tercero_propietario = '$cod_tercero_propietario')";
$filtro_consulta_tercero_rel = "AND (tbl15_venta_producto.cod_tercero_propietario = '$cod_tercero_propietario')";
}

if ($cod_factura=='0' || $cod_factura=='') {
$filtro_consulta_cod_factura = "";
$filtro_consulta_cod_factura_rel = "";
$fecha_gasto_inmueble_detalle_ini            = addslashes($_GET['fecha_gasto_inmueble_detalle_ini']);
} else {
$filtro_consulta_cod_factura = "AND (cod_factura = '$cod_factura')";
$filtro_consulta_cod_factura_rel = "AND (tbl15_venta_producto.cod_factura = '$cod_factura')";
$fecha_gasto_inmueble_detalle_ini            = "2010-01-01";
}

} else {
$fecha_gasto_inmueble_detalle_ini            = date("Y-m-d");
$fecha_gasto_inmueble_detalle_fin            = date("Y-m-d");
$cod_tercero_propietario                             = 0;
$cod_factura                             = "";
$fecha                                   = date("Y-m-d");

if ($cod_tercero_propietario==0) {
$filtro_consulta_tercero = "";
$filtro_consulta_tercero_rel = "";
} else {
$filtro_consulta_tercero = "";
$filtro_consulta_tercero_rel = "";
}

if ($cod_factura=='0' || $cod_factura=='') {
$filtro_consulta_cod_factura = "";
$filtro_consulta_cod_factura_rel = "";
} else {
$filtro_consulta_cod_factura = "";
$filtro_consulta_cod_factura_rel = "";
}

}

if ($cod_tercero_propietario==0) {
$nombre_cliente                                  = 'TODOS';
} else {
$sql_tercero = "SELECT identificacion_tercero, nombre1_tercero, nombre2_tercero, apellido2_tercero, apellido2_tercero FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero_propietario'";
$consulta_tercero = mysqli_query($conectar, $sql_tercero) or die(mysqli_error($conectar));
$datos_tercero = mysqli_fetch_assoc($consulta_tercero);

$nombre_cliente                                  = $datos_tercero['nombre1_tercero'].' '.$datos_tercero['apellido2_tercero'];
}

if ($cod_factura=='0') {
$nombre_dependencia_get                             = 'TODOS';
} else {
$nombre_dependencia_get                             = $cod_factura;
}

$pagina                      = $_SERVER['PHP_SELF'];
$tab                         = 'tbl15_informe_condiciones_salud';
$tipo                        = 'eliminar';
$campo                       = 'cod_informe_condiciones_salud';
$fecha                       = date("Y/m/d");
$origen                      = 'PARACLINICOS';
?>
<br>
<table class="table table-striped">
    <tr>
        <th style="text-align:left"><a href="#"><font size='+2'>Lista Gastos a propietario de Inmuebles deducidos</font></a></th>
        <th style="text-align:right"><a href="../admin/buscar_por_cod_factura_venta_egreso_ingreso_detalle.php"><font size='+2'>Buscar Por Contrato</font></a></th>
        <th style="text-align:right"><a href="../admin/lista_egreso_ingreso_detalle_temporal_virtual.php"><font size='+2'>Crear Nuevo Gasto</font></a></th>
    </tr>
</table>

<form action="" id="" method="GET">

<table class="table table-striped" cellspacing="0" cellpadding="20">
  <tr>
    <th style="text-align:center; width:100px;">CONTRATO</th>
    <th style="text-align:center;">PROPIETARIO</th>
    <th style="text-align:center;">FECHA INICIAL</th>
    <th style="text-align:center;">FECHA FINAL</th>
  </tr>
    <td style="text-align:center;"><input type="text" id="cod_factura" name="cod_factura" style="width:80px;" autofocus/></td>

    <td style="text-align:left;">
        <select name="cod_tercero_propietario" id="cod_tercero_propietario" class="chosen-select" data-show-subtext="true" data-live-search="true" required>
            <?php if (isset($cod_tercero_propietario)) { echo "<option value='0' $seleccionado >TODOS</option>"; } else { echo  "<option value='0' $seleccionado >TODOS</option>"; }
            $consulta2_sql = "SELECT cod_tercero, nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero FROM tbl15_tercero WHERE nombre_tipo_tercero = 'PROPIETARIO' ORDER BY nombre1_tercero ASC";
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($cod_tercero_propietario) AND $cod_tercero_propietario == $datos2['cod_tercero']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['cod_tercero'];
            $nombre = $datos2['nombre1_tercero'].' '.$datos2['nombre2_tercero'].' '.$datos2['apellido1_tercero'].' '.$datos2['apellido2_tercero'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
    </td>
    <td style="text-align:center;"><input class="input-block-level" name="fecha_gasto_inmueble_detalle_ini" type="date" value="<?php echo $fecha_gasto_inmueble_detalle_ini ?>" style="width:150px;" required/></td>
    <td style="text-align:center;"><input class="input-block-level" name="fecha_gasto_inmueble_detalle_fin" type="date" value="<?php echo $fecha_gasto_inmueble_detalle_fin ?>" style="width:150px;" required/></td>
  </tr>
</table>
<div class="actions">
<input type="submit" value="Ver Registros" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" />
</div>
</form>

<div class="table-responsive">
<div id="eliminar-ok" style="display:none;">&nbsp;</div>

<table class="table table-striped">
<thead>
<tr>
<!--<th style="text-align:center">Elm</th>-->
<!--<?php if ($cod_estado_facturacion_venta_editar == '1') { ?><th style="text-align:center; font-size:13pt;">Edit</th><?php } ?>-->
<th style="text-align:center; font-size:13pt;">Contrato</th>
<th style="text-align:center; font-size:13pt;">Propietario | Inmueble</th>
<th style="text-align:center; font-size:13pt;">Concepto</th>
<th style="text-align:center; font-size:13pt;">Descripcion</th>
<th style="text-align:center; font-size:13pt;">Costo Gasto</th>
<th style="text-align:center; font-size:13pt;">Fecha</th>
<th style="text-align:center; font-size:13pt;">Imp</th>
<th style="text-align:center; font-size:13pt;">ID</th>
<!--<?php if ($cod_estado_facturacion_venta_imprimir == '1') { ?><th style="text-align:center; font-size:13pt;">Imp</th><?php } ?>-->
</tr>
</thead>
<tbody>
<?php
$fecha_hoy                           = date("Y-m-d");

$sql_total_tipo_factura = "SELECT * FROM tbl15_gasto_inmueble_detalle_venta 
WHERE (fecha_gasto_inmueble_detalle BETWEEN '$fecha_gasto_inmueble_detalle_ini' AND '$fecha_gasto_inmueble_detalle_fin') 
$filtro_consulta_tercero $filtro_consulta_cod_factura ORDER BY cod_info_gasto_inmueble_detalle_venta DESC LIMIT 0, 800";
$consulta_total_tipo_factura = mysqli_query($conectar, $sql_total_tipo_factura) or die(mysqli_error($conectar));
while ($datos_total_tipo_factura = mysqli_fetch_assoc($consulta_total_tipo_factura)) {

$cod_gasto_inmueble_detalle_venta                  = $datos_total_tipo_factura['cod_gasto_inmueble_detalle_venta'];
$cod_info_gasto_inmueble_detalle_venta             = $datos_total_tipo_factura['cod_info_gasto_inmueble_detalle_venta'];
$cod_factura                                       = $datos_total_tipo_factura['cod_factura'];
$cod_tercero_propietario                           = $datos_total_tipo_factura['cod_tercero_propietario'];
$fecha_gasto_inmueble_detalle                      = $datos_total_tipo_factura['fecha_gasto_inmueble_detalle'];
$cod_administrador                                 = $datos_total_tipo_factura['cod_administrador'];
$nombre_gasto_inmueble_detalle                     = $datos_total_tipo_factura['nombre_gasto_inmueble_detalle'];
$descripcion_gasto_inmueble_detalle                = $datos_total_tipo_factura['descripcion_gasto_inmueble_detalle'];
$nombre_producto                                   = $datos_total_tipo_factura['nombre_producto'];
$precio_venta_producto                             = $datos_total_tipo_factura['precio_venta_producto'];
$precio_compra_producto                            = $datos_total_tipo_factura['precio_compra_producto'];

$cod_cuentas_cobrar_factura_comision_propietario   = $datos_total_tipo_factura['cod_cuentas_cobrar_factura_comision_propietario'];
$cod_cuentas_cobrar_alerta                         = $datos_total_tipo_factura['cod_cuentas_cobrar_alerta'];
$fecha_mes                                         = '';
$nombre_tabla_mes                                  = '';
$nombre_tabla_anyo                                 = '';
$cod_estado_pago                                   = '';
$cod_estado_aprobado                               = 1;
$pagina                                            = '';

$sql_dependencia = "SELECT nombre1_tercero, apellido1_tercero FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero_propietario'";
$consulta_dependencia = mysqli_query($conectar, $sql_dependencia) or die(mysqli_error($conectar));
$datos_dependencia = mysqli_fetch_assoc($consulta_dependencia);

$nombre_tercero                               = $datos_dependencia['nombre1_tercero'].' '.$datos_dependencia['apellido1_tercero'];

$sql_administrador = "SELECT cuenta FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador'";
$consulta_administrador = mysqli_query($conectar, $sql_administrador) or die(mysqli_error($conectar));
$datos_administrador = mysqli_fetch_assoc($consulta_administrador);

$cuenta                        = $datos_administrador['cuenta'];

$obtener_cliente = "SELECT * FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero_propietario')";
$resultado_cliente = mysqli_query($conectar, $obtener_cliente) or die(mysqli_error($conectar));
$matriz_cliente = mysqli_fetch_assoc($resultado_cliente);

$cliente                             = $matriz_cliente['nombre1_tercero'].' '.$matriz_cliente['apellido1_tercero'];
$cedula_cli                          = $matriz_cliente['identificacion_tercero'];
$direccion_cli                       = $matriz_cliente['direccion_tercero'];
$nombre_tipo_identificacion          = $matriz_cliente['nombre_tipo_identificacion'];
$digito_tercero                      = $matriz_cliente['digito_tercero'];
if (($digito_tercero == '0') || ($digito_tercero == '')) { $digito_tercero = ''; } else { $digito_tercero = '-'.$matriz_cliente['digito_tercero']; }
?>
<tr id="<?php echo $cod_info_gasto_inmueble_detalle_venta;?>">
<?php if ($cod_estado_facturacion_venta_editar == '1') { ?>
<!--<td id="edit<?php echo $cod_info_gasto_inmueble_detalle_venta;?>" style="text-align:center"><a href="../admin/edit_factura_venta.php?cod_info_gasto_inmueble_detalle_venta=<?php echo $cod_info_gasto_inmueble_detalle_venta ?>"><img src="../imagenes/editar.png" class="img-polaroid" alt=""></a></td>-->
<?php } ?>
<td style="text-align:center; font-size:13pt;" id="cod_factura<?php echo $cod_info_gasto_inmueble_detalle_venta;?>"><?php echo ($cod_factura)?></td>
<td style="text-align:left; font-size:13pt;" id="nombre_tercero<?php echo $cod_info_gasto_inmueble_detalle_venta;?>"><?php echo $nombre_tercero?> | <?php echo $nombre_producto?></td>
<td style="text-align:left; font-size:13pt;" id="nombre_gasto_inmueble_detalle<?php echo $cod_info_gasto_inmueble_detalle_venta;?>"><?php echo $nombre_gasto_inmueble_detalle?></td>
<td style="text-align:left; font-size:13pt;" id="descripcion_gasto_inmueble_detalle<?php echo $cod_info_gasto_inmueble_detalle_venta;?>"><?php echo $descripcion_gasto_inmueble_detalle?></td>
<td style="text-align:right; font-size:13pt;" id="precio_venta_producto<?php echo $cod_info_gasto_inmueble_detalle_venta;?>"><?php echo number_format($precio_venta_producto, 0, ",", ".") ?></td>
<td style="text-align:center; font-size:13pt;" id="fecha_gasto_inmueble_detalle<?php echo $cod_info_gasto_inmueble_detalle_venta;?>"><?php echo date("d-m-Y", strtotime($fecha_gasto_inmueble_detalle))?></td>
<td style="text-align: center;"><a href="../admin/cuentas_cobrar_abonos_alquiler_comprobante_gasto_inmueble_detalle_imprimir_pdf.php?cod_cuentas_cobrar_factura_comision_propietario=<?php echo $cod_cuentas_cobrar_factura_comision_propietario;?>&cod_cuentas_cobrar_alerta=<?php echo $cod_cuentas_cobrar_alerta;?>&fecha_mes=<?php echo $fecha_mes;?>&nombre_tabla_mes=<?php echo $nombre_tabla_mes;?>&nombre_tabla_anyo=<?php echo $nombre_tabla_anyo;?>&cod_estado_pago=<?php echo $cod_estado_pago;?>&cod_estado_aprobado=1&pagina=<?php echo $pagina_local;?>" target="_blank"><img src=../imagenes/pdf_peq.png alt="Adjuntar"></a></td>
<td style="text-align:center; font-size:13pt;" id="cod_info_gasto_inmueble_detalle_venta<?php echo $cod_info_gasto_inmueble_detalle_venta;?>"><?php echo $cod_info_gasto_inmueble_detalle_venta?></td>
<?php if ($cod_estado_facturacion_venta_imprimir == '1') { ?>
<!--<td style="text-align:center;" id="edit<?php echo $cod_info_gasto_inmueble_detalle_venta;?>"><a href="../admin/venta_productos_opcion_imprimir.php?cod_info_gasto_inmueble_detalle_venta=<?php echo $cod_info_gasto_inmueble_detalle_venta ?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/imprimir_directa_pos_peq2.png" class="img-polaroid" alt=""></a></td>-->
<?php } ?>
</tr id="<?php echo $cod_info_gasto_inmueble_detalle_venta;?>">
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
<?php include_once('../admin/05_modulo_js_sin_jquery.php'); ?>

<script type="text/javascript">
$(document).ready(function() {

    $('.eliminar').click(function(){
    
        var parent = $(this).parent().attr('id');
        var cod_info_gasto_inmueble_detalle_venta = $(this).parent().attr('data');
        var dataString = 'llave='+cod_info_gasto_inmueble_detalle_venta+'&'+'tab='+'<?php echo $tab ?>'+'&'+'campo='+'<?php echo $campo ?>'+'&'+'tipo='+'<?php echo $tipo ?>';

        $.ajax({
            type: "POST",
            url: "../admin/eliminar_ajax.php",
            data: dataString,
            success: function() {           
                $('#eliminar-ok').empty();
                $('#eliminar-ok').append('<div align="center" class="correcto">Se ha eliminado correctamente el codigo = '+cod_info_gasto_inmueble_detalle_venta+'.</div>').fadeIn("slow");
                $('#'+parent).fadeOut("slow");
                $('#cod_info_factura_'+cod_info_gasto_inmueble_detalle_venta).fadeOut("slow");
                $('#cod_factura'+cod_info_gasto_inmueble_detalle_venta).fadeOut("slow");
                $('#nombre_empresa'+cod_info_gasto_inmueble_detalle_venta).fadeOut("slow");
                $('#fecha_anyo'+cod_info_gasto_inmueble_detalle_venta).fadeOut("slow");
                $('#fecha_hora'+cod_info_gasto_inmueble_detalle_venta).fadeOut("slow");
                $('#nombre_tipo_producto'+cod_info_gasto_inmueble_detalle_venta).fadeOut("slow");
                $('#edit'+cod_info_gasto_inmueble_detalle_venta).fadeOut("slow");
                $('#excel'+cod_info_gasto_inmueble_detalle_venta).fadeOut("slow");
                $('#imp'+cod_info_gasto_inmueble_detalle_venta).fadeOut("slow");
                $('#lista'+cod_info_gasto_inmueble_detalle_venta).fadeOut("slow");
                $('#tr'+cod_info_gasto_inmueble_detalle_venta).fadeOut("slow");
                //$('#'+parent).remove();
            }
        });
    });

});
</script>

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