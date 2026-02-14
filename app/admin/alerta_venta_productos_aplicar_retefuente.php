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
<!--
<div class="breadcrumbs">
<a href="#"><h4></a>
</div>
-->
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
if (isset($_GET['cod_info_factura_venta'])) {

    $cod_info_factura_venta                                         = intval($_GET['cod_info_factura_venta']);
    $cod_tipo_pago                                                  = intval($_GET['cod_tipo_pago']);
    $total_precio_venta                                             = addslashes($_GET['total_precio_venta']);
    $vlr_cancelado                                                  = addslashes($_GET['vlr_cancelado']);
    $cuenta                                                         = addslashes($_GET['cuenta']);
    $cod_caja_virtual                                               = intval($_GET['cod_caja_virtual']);
    $modo_venta_por_defecto                                         = addslashes($_GET['modo_venta_por_defecto']);
    $pagina                                                         = addslashes($_GET['pagina']);
    $pagina_local                                                   = $_SERVER['PHP_SELF'];

    $cod_servicio_propina                                           = '22222222';
    $cod_servicio_cava                                              = '55555555';
    $cod_servicio_domicilio                                         = '44444444';
    $cod_servicio_descuento_punto_redimible                         = '11112222';
    $cod_servicio_descuento                                         = '33333333';
    $cod_servicio_imp_bolsa                                         = '11111111';
    $cod_servicio_retefuente                                        = '11113333';

    $sql_info_imp_factura = "SELECT cod_tercero FROM tbl15_info_factura_venta WHERE cod_info_factura_venta = '$cod_info_factura_venta'";
    $modificar_info_imp_factura = mysqli_query($conectar, $sql_info_imp_factura) or die(mysqli_error($conectar));
    $total_encontrado_info_imp_factura = mysqli_num_rows($modificar_info_imp_factura);
    $matriz_info_imp_factura  = mysqli_fetch_assoc($modificar_info_imp_factura);

    $cod_tercero                                                   = $matriz_info_imp_factura['cod_tercero'];

    $sql_tercero = "SELECT identificacion_tercero, nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero, digito_tercero, 
    retefuente_ptj, reteica_ptj, reteiva_ptj FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero'";
    $resultado_tercero = mysqli_query($conectar, $sql_tercero) or die(mysqli_error($conectar));
    $info_tercero = mysqli_fetch_assoc($resultado_tercero);

    $retefuente_ptj                                                 = $info_tercero['retefuente_ptj'];
    $reteica_ptj                                                    = $info_tercero['reteica_ptj'];
    $reteiva_ptj                                                    = $info_tercero['reteiva_ptj'];
    $nit_cliente                                                    = $info_tercero['identificacion_tercero'];
    $nombres_clientes                                               = $info_tercero['nombre1_tercero'].' '.$info_tercero['nombre2_tercero'].' '.$info_tercero['apellido1_tercero'].' '.$info_tercero['apellido2_tercero'];
    $digito                                                         = $info_tercero['digito_tercero'];

    $suma_temporal = "SELECT Sum(total_venta_producto) As total_precio_venta_info, Sum(total_costo_producto) As total_compra FROM tbl15_venta_producto_temporal WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
    $consulta_temporal = mysqli_query($conectar, $suma_temporal);
    $matriz_temporal = mysqli_fetch_assoc($consulta_temporal);

    $total_precio_venta_info      = $matriz_temporal['total_precio_venta_info'];

    $sql_retefuente_en_factura = "SELECT Sum((total_venta_producto)/((iva_ptj/100)+(100/100))) As subtotal_base 
    FROM tbl15_venta_producto_temporal WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (cod_producto_barra <> '$cod_servicio_propina') 
    AND (cod_producto_barra <> '$cod_servicio_domicilio') AND (cod_producto_barra <> '$cod_servicio_descuento_punto_redimible') AND (cod_producto_barra <> '$cod_servicio_retefuente')";
    $resultado_retefuente_en_factura  = mysqli_query($conectar, $sql_retefuente_en_factura);
    $info_retefuente_en_factura = mysqli_fetch_assoc($resultado_retefuente_en_factura);

    $subtotal_base                                                 = $info_retefuente_en_factura['subtotal_base'];
    $retefuente_aplicar                                            = $subtotal_base * ($retefuente_ptj/100);

    //$foco                                                = $nombre_foco;
    $paginar_edirect                                                = $pagina.'?cuenta='.$cuenta.'&cod_caja_virtual='.$cod_caja_virtual.'&cod_info_factura_venta='.$cod_info_factura_venta.'&modo_venta_por_defecto='.$modo_venta_por_defecto;
?>
    <div class="table-responsive">
    <table class="table table-striped">
        <tr>
            <th style="text-align:center;"><img src=../imagenes/advertencia.gif alt='Advertencia'><a href="<?php echo $paginar_edirect;?>">AL CLIENTE ALCTUAL SE LE DEBE APLICAR RETE FUENTE</a><img src=../imagenes/advertencia.gif alt='Advertencia'></th>
        </tr>
        <tr>
            <td style="text-align:justify;">Si este no es el caso, por favor ir a terceros, editar el registro del cliente respectivo y colocar en aplicar rete fuente en 0%, de esta forma este mensaje no volverá a desplegarse y podrá facturar de forma normal sin aplicar rete fuente a la factura. En caso contrario por favor dar clic en el  botón aplicar rete fuente.</td>
        </tr>
    </table>

    <form name="formulario_insersion" accept-charset="utf-8" method="post" action="../admin/alerta_venta_productos_aplicar_retefuente_reg.php">
        <table class="table table-striped">
            <tr>
                <th style="text-align:right; width:50%;">CLIENTE:</th>
                <th style="text-align:left; width:50%;"><?php echo $nombres_clientes;?></th>
            </tr>
            <tr>
                <th style="text-align:right; width:50%;">TOTAL DE LA FACTURA:</th>
                <th style="text-align:left; width:50%;"><?php echo number_format($total_precio_venta_info, 0, ",", ".");?></th>
            </tr>
            <tr>
                <th style="text-align:right; width:50%;">BASE DE LA FACTURA:</th>
                <th style="text-align:left; width:50%;"><?php echo number_format($subtotal_base, 0, ",", ".");?></th>
            </tr>
            <tr>
                <th style="text-align:right; width:50%;">RETEFUENTE:</th>
                <th style="text-align:left; width:50%;">
                    <select name="retefuente_ptj" id="retefuente_ptj" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 120px;" tabindex="1">
                        <?php if (isset($retefuente_ptj)) { echo "<option value='0'>0%</option>"; } else { echo "<option value='0'>0%</option>"; }
                        $consulta2_sql = "SELECT cod_tipo_retefuente, retefuente_ptj FROM tbl15_tipo_retefuente WHERE (cod_estado = '1') ORDER BY retefuente_ptj ASC";
                        $consulta2 = mysqli_query($conectar, $consulta2_sql);
                        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                        if(isset($retefuente_ptj) AND $retefuente_ptj == $datos2['retefuente_ptj']) {
                        $seleccionado = "selected"; } else { $seleccionado = ""; }
                        $codigo = $datos2['retefuente_ptj'];
                        $nombre = $datos2['retefuente_ptj'];
                        echo "<option value='".$codigo."' $seleccionado >".$nombre."%</option>"; } ?>
                    </select>
                </th>
            </tr>
            <tr>
                <th style="text-align:right; width:50%;">TOTAL RETEFUENTE:</th>
                <th style="text-align:left; width:50%;"><?php echo number_format($retefuente_aplicar, 0, ",", ".");?></th>
            </tr>
        </table>

        <table class="table table-striped">
            <tr>
                <td style="text-align:center;"><input type="submit" value="Aplicar Rete Fuente" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para Aplicar Rete Fuente" /></td>
            </tr>
        </table>
        <input class="input-block-level" name="cod_info_factura_venta" type="hidden" value="<?php echo $cod_info_factura_venta;?>"/>
        <input class="input-block-level" name="cod_tipo_pago" type="hidden" value="<?php echo $cod_tipo_pago;?>"/>
        <input class="input-block-level" name="total_precio_venta" type="hidden" value="<?php echo $total_precio_venta;?>"/>
        <input class="input-block-level" name="vlr_cancelado" type="hidden" value="<?php echo $vlr_cancelado;?>"/>
        <input class="input-block-level" name="cuenta" type="hidden" value="<?php echo $cuenta;?>"/>
        <input class="input-block-level" name="cod_caja_virtual" type="hidden" value="<?php echo $cod_caja_virtual;?>"/>
        <input class="input-block-level" name="modo_venta_por_defecto" type="hidden" value="<?php echo $modo_venta_por_defecto;?>"/>
        <input class="input-block-level" name="pagina" type="hidden" value="<?php echo $pagina;?>"/>
    </form>
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

<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script language="javascript">
var url_retorno_confirmacion_transaccion = document.getElementById("url_retorno_confirmacion_transaccion");
url_retorno_confirmacion_transaccion.style.display = "none";

$(document).ready(function(){
    $("input").on('change', function () {
        var valor = $(this).val();
        var campo = $(this).attr("name");
        var campo_respuesta = "estado";
        var cod_seguridad = <?php echo $cod_seguridad;?>;
        var cod_info_factura_venta = document.getElementById("cod_info_factura_venta");

        
        var tipo_ajax = "tbl15_venta_producto_temporal";
        var id = $(this).attr("class");
        var cod_seguridad = <?php echo $cod_seguridad;?>;
        var cod_estado_modificar_und_venta_una_sola_vez_global = <?php echo $cod_estado_modificar_und_venta_una_sola_vez_global;?>;
        var cod_estado_bascula_balanza_electronica_pesar_producto_global = <?php echo $cod_estado_bascula_balanza_electronica_pesar_producto_global;?>;
        var pagina_local = "<?php echo $pagina_local;?>";
        var foco = '';

        var nombre_campo_incre = $(this).attr("id");
        let framentador_nombre = nombre_campo_incre.split("und_venta");
        var nombre_campo = framentador_nombre[0];
        var increm = framentador_nombre[1];

        var datos_url_ajax = 'valor='+valor+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'id='+id+'&'+'cod_info_factura_venta='+cod_info_factura_venta+'&'+'foco='+foco+'&'+'nombre_campo_incre='+nombre_campo_incre;

        $.ajax({
            type: "POST",
            url: "../admin/guardar_producto_unidad_venta_cero_info_factura_y_venta_producto_temporal_ajax.php",
            data: datos_url_ajax,
            //dataType: 'json',
            beforeSend: function(objeto){
                $('#'+campo_respuesta+''+id).html('<img src="../imagenes/loading.gif">');
            },
            success:function(respuesta){
                var afectado = respuesta.afectado;
                var campo = respuesta.emisor;
                var mensaje = respuesta.mensaje;
                var cod_venta_producto_temporal = respuesta.id;
                var existe_unidad_venta_en_cero_venta_temp = respuesta.existe_unidad_venta_en_cero_venta_temp;

                if ((afectado == 'SI')) {
                    $('#'+campo_respuesta+''+id).html('');
                    $('#'+campo_respuesta+''+id).html('<img src="../imagenes/spam_reg.png">');
                    if (existe_unidad_venta_en_cero_venta_temp == '0') {
                        url_retorno_confirmacion_transaccion.style.display = "block";
                    }
                } else {
                    $('#'+campo_respuesta+''+id).html('');
                    $('#'+campo_respuesta+''+id).html('Error');
                    url_retorno_confirmacion_transaccion.style.display = "none";
                }
            }
        });
    });
});
</script>