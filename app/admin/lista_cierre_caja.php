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
function Focus(elemento, valor) {
$(elemento).className = 'inputon';
last = valor;
}
function Blur(elemento, valor, campo, id) {
$(elemento).className = 'inputoff';
if (last != valor) {
myajax.Link('cierre_caja_editable_ajax_reg.php?valor='+valor+'&campo='+campo+'&id='+id);
}
}
</script>
</head>
<body onLoad="myajax = new isiAJAX();" id="pageBody">
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

if ($cod_seguridad=='1') {
    $filtro_cod_administrador = '';
    $option_administrador = '<option value="0" '.$seleccionado.' >TODOS</option>';
} else {
    $filtro_cod_administrador = 'WHERE cod_administrador = '.$cod_administrador;
    $option_administrador = '';
}

if (isset($_GET['fecha_ymd_venta_producto_ini'])) {
    $fecha_ymd_venta_producto_ini            = addslashes($_GET['fecha_ymd_venta_producto_ini']);
    $fecha_ymd_venta_producto_fin            = addslashes($_GET['fecha_ymd_venta_producto_fin']);
    $cod_administrador                       = intval($_GET['cod_administrador']);
    $fecha                                   = date("Y-m-d");

    if ($cod_administrador==0) {
        $filtro_consulta_vendedor = "";
        $filtro_consulta_vendedor_rel = "";
    } else {
        $filtro_consulta_vendedor = "AND (cod_administrador = '$cod_administrador')";
        $filtro_consulta_vendedor_rel = "AND (tbl15_cierre_caja.cod_administrador = '$cod_administrador')";
    }

} else {
    $fecha_ymd_venta_producto_ini            = date("Y-m-d");
    $fecha_ymd_venta_producto_fin            = date("Y-m-d");
    $cod_administrador                       = 0;
    $cod_tercero                             = 0;
    $cod_tipo_pago                           = 0;
    $cod_tipo_forma_pago                     = 0;
    $cod_factura                             = "";
    $nombre_tipo_factura                     = "0";
    $fecha                                   = date("Y-m-d");

    if ($cod_administrador==0) {
        $filtro_consulta_vendedor                = "";
        $filtro_consulta_vendedor_rel            = "";
    } else {
        $filtro_consulta_vendedor                = "";
        $filtro_consulta_vendedor_rel            = "";
    }
}

if ($cod_administrador==0) {
    $cuenta_get                                  = 'TODOS';
} else {
    $sql_administrador = "SELECT cuenta FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador'";
    $consulta_administrador = mysqli_query($conectar, $sql_administrador) or die(mysqli_error($conectar));
    $datos_administrador = mysqli_fetch_assoc($consulta_administrador);

    $cuenta_get                              = $datos_administrador['cuenta'];
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
        <th style="text-align:left"><a href="#"><font size='+2'>Lista Cierres de Caja</font></a></th>
        <?php if ($cod_estado_cierre_caja_registrar == '1') { ?>
            <?php if ($cod_tipo_cierre_caja_global == '0') { ?>
                <th style="text-align:right"><a href="../admin/reg_cierre_caja_ultima_version.php"><font size='+2'>Cerrar Caja</font></a></th>
            <?php } else { ?>
                <th style="text-align:right"><a href="../admin/reg_cierre_caja_valor_total.php"><font size='+2'>Cerrar Caja</font></a></th>
            <?php } ?>
        <?php } ?>
    </tr>
</table>

<form action="" id="" method="GET">

<table class="table table-striped" cellspacing="0" cellpadding="20">
  <tr>
    <th style="text-align:center;">VENDEDOR</th>
    <th style="text-align:center;">FECHA INICIAL</th>
    <th style="text-align:center;">FECHA FINAL</th>
  </tr>

    <td style="text-align:center;">
        <select name="cod_administrador" id="cod_administrador" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
            <?php if (isset($cod_administrador)) { echo $option_administrador; } else { echo $option_administrador; }
            $consulta2_sql = "SELECT cod_administrador, cuenta FROM tbl15_administrador $filtro_cod_administrador ORDER BY cod_administrador ASC";
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($cod_administrador) AND $cod_administrador == $datos2['cod_administrador']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['cod_administrador'];
            $nombre = $datos2['cuenta'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
    </td>
    <td style="text-align:center;"><input class="input-block-level" name="fecha_ymd_venta_producto_ini" type="date" value="<?php echo $fecha_ymd_venta_producto_ini ?>" required/></td>
    <td style="text-align:center;"><input class="input-block-level" name="fecha_ymd_venta_producto_fin" type="date" value="<?php echo $fecha_ymd_venta_producto_fin ?>" required/></td>
  </tr>
</table>
<div class="actions">
<input type="submit" value="Ver Registros" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" />
</div>
</form>

<div class="table-responsive">
<div id="eliminar-ok" style="display:none;">&nbsp;</div>

<?php if ($cod_estado_cierre_caja == '1') { ?>

<table class="table table-striped">
    <thead>
    <tr>
        <!--<th style="text-align:center">Elm</th>-->
        <?php if ($cod_seguridad=='1') { ?><!--<th style="text-align:center">EDIT</th>--><?php } ?>
        <th style="text-align:center">CIERRE #</th>
        <th style="text-align:center">USUARIO</th>
        <th style="text-align:center">TOTAL VENTA CAJA SISTEMA</th>
        <th style="text-align:center">TOTAL VENTA CAJA SISTEMA EN EFECTIVO</th>
        <th style="text-align:center">TOTAL BASE</th>
        <th style="text-align:center">TOTAL VENTA CAJA FISICA</th>
        <th style="text-align:center">RESULTADO</th>
        <th style="text-align:center">OBSERVACION</th>
        <th style="text-align:center">FECHA</th>
        <th style="text-align:center">HORA</th>
        <th style="text-align:center">ID</th>
        <?php if ($cod_estado_cierre_caja_imprimir == '1') { ?>
        <th style="text-align:center">IMP</th>
        <?php } ?>
    </tr>
    </thead>
    <tbody>
<?php
$sql_total_tipo_factura = "SELECT * FROM tbl15_cierre_caja 
WHERE (fecha_anyo BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') $filtro_consulta_vendedor 
ORDER BY cod_cierre_cajas DESC LIMIT 0, 800";
$consulta_total_tipo_factura = mysqli_query($conectar, $sql_total_tipo_factura) or die(mysqli_error($conectar));
while ($datos_total_tipo_factura = mysqli_fetch_assoc($consulta_total_tipo_factura)) {

    $cod_cierre_cajas                            = $datos_total_tipo_factura['cod_cierre_cajas'];
    $total_fisico_cierre_caja                    = $datos_total_tipo_factura['total_fisico_cierre_caja'];
    $total_sistema_cierre_caja                   = $datos_total_tipo_factura['total_sistema_cierre_caja'];
    $total_sistema_contado_efectivo_cierre_caja  = $datos_total_tipo_factura['total_sistema_contado_efectivo_cierre_caja'];
    $total_sistema_credito_cierre_caja           = $datos_total_tipo_factura['total_sistema_credito_cierre_caja'];
    $total_base_cierre_caja                      = $datos_total_tipo_factura['total_base_cierre_caja'];
    $total_abono_cuenta_cobrar                   = $datos_total_tipo_factura['total_abono_cuenta_cobrar'];
    $moneda_50                                   = $datos_total_tipo_factura['moneda_50'];
    $moneda_100                                  = $datos_total_tipo_factura['moneda_100'];
    $moneda_200                                  = $datos_total_tipo_factura['moneda_200'];
    $moneda_500                                  = $datos_total_tipo_factura['moneda_500'];
    $moneda_1000                                 = $datos_total_tipo_factura['moneda_1000'];
    $moneda_2000                                 = $datos_total_tipo_factura['moneda_2000'];
    $moneda_5000                                 = $datos_total_tipo_factura['moneda_5000'];
    $moneda_10000                                = $datos_total_tipo_factura['moneda_10000'];
    $moneda_20000                                = $datos_total_tipo_factura['moneda_20000'];
    $moneda_50000                                = $datos_total_tipo_factura['moneda_50000'];
    $moneda_100000                               = $datos_total_tipo_factura['moneda_100000'];
    $comentario                                  = $datos_total_tipo_factura['comentario'];
    $vendedor                                    = $datos_total_tipo_factura['vendedor'];
    $fecha_anyo                                  = $datos_total_tipo_factura['fecha_anyo'];
    $fecha_mes                                   = $datos_total_tipo_factura['fecha_mes'];
    $fecha_cierre_caja                           = $datos_total_tipo_factura['fecha_cierre_caja'];
    $hora_cierre_caja                            = $datos_total_tipo_factura['hora_cierre_caja'];
    $fecha_time_cierre_caja                      = $datos_total_tipo_factura['fecha_time_cierre_caja'];
    $cod_cierre_caja                             = $datos_total_tipo_factura['cod_cierre_caja'];
    $cod_administrador                           = $datos_total_tipo_factura['cod_administrador'];
    $resultado                                   = $total_fisico_cierre_caja - $total_sistema_contado_efectivo_cierre_caja;
     
    $sql_administrador = "SELECT cuenta FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador'";
    $consulta_administrador = mysqli_query($conectar, $sql_administrador) or die(mysqli_error($conectar));
    $datos_administrador = mysqli_fetch_assoc($consulta_administrador);

    $cuenta                        = $datos_administrador['cuenta'];
?>
        <tr>
            <?php if ($cod_seguridad=='1') { ?>
            <!--<td id="edit<?php echo $cod_cierre_caja;?>" style="text-align:center"><a href="../admin/edit_factura_venta.php?cod_cierre_cajas=<?php echo $cod_cierre_cajas ?>"><img src="../imagenes/editar.png" class="img-polaroid" alt=""></a></td>-->
            <?php } ?>
            <td style="text-align:center"><?php echo $cod_cierre_caja ?></td>
            <td style="text-align:center"><?php echo $cuenta ?></td>
            <td style="text-align:right"><?php echo number_format($total_sistema_cierre_caja, 0, ",", ".") ?></td>
            <td style="text-align:right"><?php echo number_format($total_sistema_contado_efectivo_cierre_caja, 0, ",", ".") ?></td>
            <td style="text-align:right"><?php echo number_format($total_base_cierre_caja, 0, ",", ".") ?></td>
            <td style="text-align:right"><?php echo number_format($total_fisico_cierre_caja, 0, ",", ".") ?></td>
            <td style="text-align:right"><?php echo number_format($resultado, 0, ",", ".") ?></td>
            <td style="text-align:center"><input type="text" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'comentario', <?php echo $cod_cierre_cajas;?>)" id="<?php echo $cod_cierre_cajas;?>" value="<?php echo $comentario;?>" class="input-block-level" style="width: 200px;"></td>
            <td style="text-align:center"><?php echo $fecha_anyo ?></td>
            <td style="text-align:center"><?php echo $hora_cierre_caja ?></td>
            <td style="text-align:center"><?php echo $cod_cierre_cajas ?></td>
            <?php if ($cod_estado_cierre_caja_imprimir == '1') { ?>
            <td id="edit<?php echo $cod_cierre_caja;?>" style="text-align:center"><a href="../admin/factura_cierre_caja_opcion_imprimir.php?cod_cierre_cajas=<?php echo $cod_cierre_cajas ?>"><img src="../imagenes/imprimir_directa_pos_peq2.png" class="img-polaroid" alt=""></a></td>
            <?php } ?>
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

<script type="text/javascript">
$(document).ready(function() {

    $('.eliminar').click(function(){
    
        var parent = $(this).parent().attr('id');
        var cod_info_factura_venta = $(this).parent().attr('data');
        var dataString = 'llave='+cod_info_factura_venta+'&'+'tab='+'<?php echo $tab ?>'+'&'+'campo='+'<?php echo $campo ?>'+'&'+'tipo='+'<?php echo $tipo ?>';

        $.ajax({
            type: "POST",
            url: "../admin/eliminar_ajax.php",
            data: dataString,
            success: function() {           
                $('#eliminar-ok').empty();
                $('#eliminar-ok').append('<div align="center" class="correcto">Se ha eliminado correctamente el codigo = '+cod_info_factura_venta+'.</div>').fadeIn("slow");
                $('#'+parent).fadeOut("slow");
                $('#cod_info_factura_'+cod_info_factura_venta).fadeOut("slow");
                $('#cod_factura'+cod_info_factura_venta).fadeOut("slow");
                $('#nombre_empresa'+cod_info_factura_venta).fadeOut("slow");
                $('#fecha_anyo'+cod_info_factura_venta).fadeOut("slow");
                $('#fecha_hora'+cod_info_factura_venta).fadeOut("slow");
                $('#nombre_tipo_producto'+cod_info_factura_venta).fadeOut("slow");
                $('#edit'+cod_info_factura_venta).fadeOut("slow");
                $('#excel'+cod_info_factura_venta).fadeOut("slow");
                $('#imp'+cod_info_factura_venta).fadeOut("slow");
                $('#lista'+cod_info_factura_venta).fadeOut("slow");
                $('#tr'+cod_info_factura_venta).fadeOut("slow");
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