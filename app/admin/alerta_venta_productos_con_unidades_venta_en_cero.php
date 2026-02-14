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
$cod_info_factura_venta               = intval($_GET['cod_info_factura_venta']);
$cod_tipo_pago                        = intval($_GET['cod_tipo_pago']);
$total_precio_venta                   = addslashes($_GET['total_precio_venta']);
$vlr_cancelado                        = addslashes($_GET['vlr_cancelado']);
$cuenta                               = addslashes($_GET['cuenta']);
$cod_caja_virtual                     = intval($_GET['cod_caja_virtual']);
$modo_venta_por_defecto               = addslashes($_GET['modo_venta_por_defecto']);
$pagina                               = addslashes($_GET['pagina']);
$pagina_local                         = $_SERVER['PHP_SELF'];

if ($cod_estado_sumar_producto_repetido_venta_temporal_global == '1') { $ordenamiento_venta_temp = 'cod_venta_producto_temporal DESC'; } else { $ordenamiento_venta_temp = 'cod_venta_producto_temporal DESC'; }
//if ($cod_estado_sumar_producto_repetido_venta_temporal_global == '1') { $ordenamiento_venta_temp = 'fecha_modificacion DESC'; } else { $ordenamiento_venta_temp = 'cod_venta_producto_temporal DESC'; }

//if ($nombre_tipo_unidad_medida == 'PVAR') { $nombre_foco = 'precio_venta_producto'.$incre; } else { $nombre_foco = 'precio_venta_producto'.$incre; }
//$foco                                 = $nombre_foco;
$paginar_edirect                      = $pagina.'?cuenta='.$cuenta.'&cod_caja_virtual='.$cod_caja_virtual.'&cod_info_factura_venta='.$cod_info_factura_venta.'&modo_venta_por_defecto='.$modo_venta_por_defecto;
?>
<div class="table-responsive">
<table class="table table-striped">
    <tr>
        <th style="text-align:center;"><img src=../imagenes/advertencia.gif alt='Advertencia'><a href="<?php echo $paginar_edirect;?>">PRODUTOS CON UNIDADES DE VENTA EN CERO</a>.<img src=../imagenes/advertencia.gif alt='Advertencia'></th>
    </tr>
</table>

<table <table class="table table-hover" border="" cellspacing="0" cellpadding="0">
<thead>
    <tr>
        <th style="text-align:center;">CODIGO</th>
        <th style="text-align:center;">NOMBRE CONCEPTO</th>
        <th style="text-align:center;">CANTIDAD</th>
        <th style="text-align:center;">MED</th>
        <th style="text-align:center;">TP</th>
        <th style="text-align:center;">PRECIO VENTA UNITARIO</th>
        <!--<th style="text-align:center;">PRECIO VENTA TOTAL</th>-->
        <th style="text-align:center;">ID</th>
        <th style="text-align:center;"></th>
    </tr>
</thead>
<tbody>
<?php
$incre = 0;

$sql_verificar_unidad_venta_en_cero_venta_temp = "SELECT * FROM tbl15_venta_producto_temporal WHERE (cod_info_factura_venta = '$cod_info_factura_venta') ORDER BY $ordenamiento_venta_temp";
$consulta_verificar_unidad_venta_en_cero_venta_temp = mysqli_query($conectar, $sql_verificar_unidad_venta_en_cero_venta_temp);
while ($datos_verificar_unidad_venta_en_cero_venta_temp = mysqli_fetch_assoc($consulta_verificar_unidad_venta_en_cero_venta_temp)) {

    $cod_venta_producto_temporal       = $datos_verificar_unidad_venta_en_cero_venta_temp['cod_venta_producto_temporal'];
    $cod_producto                      = $datos_verificar_unidad_venta_en_cero_venta_temp['cod_producto'];
    $cod_producto_barra                = $datos_verificar_unidad_venta_en_cero_venta_temp['cod_producto_barra'];
    $nombre_producto                   = $datos_verificar_unidad_venta_en_cero_venta_temp['nombre_producto'];
    $cedula                            = $datos_verificar_unidad_venta_en_cero_venta_temp['cedula'];
    $nombre_cliente                    = $datos_verificar_unidad_venta_en_cero_venta_temp['nombre_cliente'];
    $und_venta                         = $datos_verificar_unidad_venta_en_cero_venta_temp['und_venta'];
    $precio_costo_producto             = $datos_verificar_unidad_venta_en_cero_venta_temp['precio_costo_producto'];
    $precio_compra_producto            = $datos_verificar_unidad_venta_en_cero_venta_temp['precio_compra_producto'];
    $total_costo_producto              = $datos_verificar_unidad_venta_en_cero_venta_temp['total_costo_producto'];
    $precio_venta_producto             = $datos_verificar_unidad_venta_en_cero_venta_temp['precio_venta_producto'];
    $total_venta_producto              = $datos_verificar_unidad_venta_en_cero_venta_temp['total_venta_producto'];
    ///if ($cod_tipo_sistema_numeracion_und_compra == '2') { $und_compra = intval($und_compra); } else { $und_compra = $und_compra; }
    if ($cod_tipo_sistema_numeracion_und_venta == '2') { $und_venta = intval($und_venta); } else { $und_venta = $und_venta; }
    if ($cod_tipo_sistema_numeracion_precio_compra == '2') { $precio_compra_producto = intval($precio_compra_producto); } else { $precio_compra_producto = $precio_compra_producto; }
    if ($cod_tipo_sistema_numeracion_precio_venta == '2') { $precio_venta_producto = intval($precio_venta_producto); } else { $precio_venta_producto = $precio_venta_producto; }
    if ($cod_tipo_sistema_numeracion_precio_venta == '2') { $total_venta_producto = intval($total_venta_producto); } else { $total_venta_producto = $total_venta_producto; }

    //$nombre_tipo_producto              = $datos_verificar_unidad_venta_en_cero_venta_temp['nombre_tipo_producto'];
    $nombre_tipo_unidad_medida         = $datos_verificar_unidad_venta_en_cero_venta_temp['nombre_tipo_unidad_medida'];
    $posologia_cantidad                = $datos_verificar_unidad_venta_en_cero_venta_temp['posologia_cantidad'];
    $posologia_peso                    = $datos_verificar_unidad_venta_en_cero_venta_temp['posologia_peso'];
    $nombre_tipo_presentacion          = $datos_verificar_unidad_venta_en_cero_venta_temp['nombre_tipo_presentacion'];
    $nombre_via_administracion         = $datos_verificar_unidad_venta_en_cero_venta_temp['nombre_via_administracion'];
    $nombre_frec_duracion              = $datos_verificar_unidad_venta_en_cero_venta_temp['nombre_frec_duracion'];
    $cod_tipo_cobrar                   = $datos_verificar_unidad_venta_en_cero_venta_temp['cod_tipo_cobrar'];
    $cod_info_factura_venta            = $datos_verificar_unidad_venta_en_cero_venta_temp['cod_info_factura_venta'];
    $nombre_tipo_precio_venta          = $datos_verificar_unidad_venta_en_cero_venta_temp['nombre_tipo_precio_venta'];
    $cod_estado_permitir_venta         = $datos_verificar_unidad_venta_en_cero_venta_temp['cod_estado_permitir_venta'];
    //$und_producto                      = $datos_verificar_unidad_venta_en_cero_venta_temp['und_producto'];
    //$cajas_sobre                       = $datos_verificar_unidad_venta_en_cero_venta_temp['cajas_sobre'];
    //$und_sobre                         = $datos_verificar_unidad_venta_en_cero_venta_temp['und_sobre'];
    $fecha_seg_venta_producto          = $datos_verificar_unidad_venta_en_cero_venta_temp['fecha_seg_venta_producto'];
    $hora_cargue                       = date("H:i:s", $fecha_seg_venta_producto);

    $comentario_producto               = $datos_verificar_unidad_venta_en_cero_venta_temp['comentario_producto'];
    $placa_producto                    = $datos_verificar_unidad_venta_en_cero_venta_temp['placa_producto'];
    $fecha_ymd_parqueo_ini             = $datos_verificar_unidad_venta_en_cero_venta_temp['fecha_ymd_parqueo_ini'];
    $fecha_hora_parqueo_ini            = $datos_verificar_unidad_venta_en_cero_venta_temp['fecha_hora_parqueo_ini'];
    $fecha_ymd_parqueo_fin             = $datos_verificar_unidad_venta_en_cero_venta_temp['fecha_ymd_parqueo_fin'];
    $fecha_hora_parqueo_fin            = $datos_verificar_unidad_venta_en_cero_venta_temp['fecha_hora_parqueo_fin'];
    $cod_estado_componente_und_venta   = $datos_verificar_unidad_venta_en_cero_venta_temp['cod_estado_componente_und_venta'];
    $cod_estado_revisado               = $datos_verificar_unidad_venta_en_cero_venta_temp['cod_estado_revisado'];
    $peso_producto                     = $datos_verificar_unidad_venta_en_cero_venta_temp['peso_producto'];
    $unidad_medida_peso                = $datos_verificar_unidad_venta_en_cero_venta_temp['unidad_medida_peso'];
    $cod_origen_produccion             = $datos_verificar_unidad_venta_en_cero_venta_temp['cod_origen_produccion'];
    $und_caja_sobre                    = $datos_verificar_unidad_venta_en_cero_venta_temp['und_caja_sobre'];
    $nombre_tipo_und_caja_sobre        = $datos_verificar_unidad_venta_en_cero_venta_temp['nombre_tipo_und_caja_sobre'];
    $total_dias                        = $datos_verificar_unidad_venta_en_cero_venta_temp['total_dias'];
    $total_horas                       = $datos_verificar_unidad_venta_en_cero_venta_temp['total_horas'];
    $nombre_tipo_cobro                 = $datos_verificar_unidad_venta_en_cero_venta_temp['nombre_tipo_cobro'];
    $comision_ptj                      = $datos_verificar_unidad_venta_en_cero_venta_temp['comision_ptj'];
    
    $total_cajas_disponibles           = $datos_verificar_unidad_venta_en_cero_venta_temp['total_cajas_disponibles'];
    $total_sobres_disponibles          = $datos_verificar_unidad_venta_en_cero_venta_temp['total_sobres_disponibles'];

    $sqlr_consulta = "SELECT und_producto, cajas_sobre, und_sobre FROM tbl15_producto WHERE (cod_producto_barra = '$cod_producto_barra')";
    $modificar_consulta = mysqli_query($conectar, $sqlr_consulta) or die(mysqli_error($conectar));
    $datos_prod = mysqli_fetch_assoc($modificar_consulta);

    $und_producto                               = $datos_prod['und_producto'];
    $cajas_sobre                                = $datos_prod['cajas_sobre'];
    $und_sobre                                  = $datos_prod['und_sobre'];

    if ($cajas_sobre == 0) { $cajas_sobre = 1; } else { $cajas_sobre =  $cajas_sobre; }
    if ($cod_estado_permitir_venta == 1) { $imagen = '<img src=../imagenes/incorrecto.png alt="Listo">'; } else { $imagen = '<img src=../imagenes/correctok.png alt="Listo">'; }
    if ($cod_estado_venta_prod_en_cero_global == '1') { $max_und_venta = "max=".$und_producto; } else { $max_und_venta = ""; }
    if ($cod_estado_venta_prod_en_cero_global == '1') { $max_und_venta_caja = "max=".$und_producto/$cajas_sobre; } else { $max_und_venta_caja = ""; }

    if ($cod_estado_venta_precio_min_venta_global == '1') { $min_precio_venta = "min=".$precio_compra_producto; } else { $min_precio_venta = ""; }
    if ($cod_estado_revisado == '0') { $img_estado_revisado = "<img src=../imagenes/btn_revisado_no.gif>"; } else { $img_estado_revisado = "<img src=../imagenes/btn_revisado.gif>"; }

    if ($nombre_tipo_und_caja_sobre == 'CAJA') { $img_caja = "../imagenes/und_caja_R.png"; } else { $img_caja = "../imagenes/und_caja.png"; }
    if ($nombre_tipo_und_caja_sobre == 'SOBRE') { $img_sobre = "../imagenes/und_sobre_R.png"; } else { $img_sobre = "../imagenes/und_sobre.png"; }
    if (($nombre_tipo_und_caja_sobre=='UND') || ($nombre_tipo_und_caja_sobre=='')) { $img_und = "../imagenes/und_und_R.png"; } else { $img_und = "../imagenes/und_und.png"; }
    if ($cod_estado_mostrar_venta_por_caja_global == '1') { $nombre_tipo_precio_medida_contidad  = '<br>('.$und_caja_sobre.')'; } else { $nombre_tipo_unidad_medida_contidad  = ""; }

    $incre++;

    if ($precio_venta_producto <= '0' && $nombre_tipo_precio_venta == 'PVAR') { $color_fondo_celda = '#FF2B2B'; $color_letra_celda = '#FFFFFF'; $estado_componente = ""; } else { $color_fondo_celda = ''; $color_letra_celda = ''; $estado_componente = "readonly"; }
?>
        <tr id="tr<?php echo $cod_venta_producto_temporal;?>">
            <td style="text-align:center; background-color:<?php echo $color_fondo_celda ?>;" id="cod_producto_barra_<?php echo $incre;?>"><span style="color:<?php echo $color_letra_celda ?>;"><?php echo $cod_producto_barra ?></span></td>
            <td style="text-align:left; background-color:<?php echo $color_fondo_celda ?>;"  id="nombre_producto_<?php echo $incre;?>"><span style="color:<?php echo $color_letra_celda ?>;"><?php echo $nombre_producto ?></span></td>

            <?php if (($nombre_tipo_und_caja_sobre=='CAJA') || ($nombre_tipo_und_caja_sobre=='SOBRE')) { ?>
                <td style="text-align:center;" id="und_caja_sobre_<?php echo $incre;?>"><input name="und_caja_sobre" type="number" id="und_caja_sobre<?php echo $incre;?>" class="<?php echo $cod_venta_producto_temporal;?>" value="<?php echo $und_caja_sobre;?>" step="any" lang="en" style="width: 70px;" lang="en" min=1 <?php echo $max_und_venta_caja;?> oninput="validity.valid||(value='');"/></td>
                <input name="und_venta" type="hidden" id="und_venta<?php echo $incre;?>" class="<?php echo $cod_venta_producto_temporal;?>" value="<?php echo $und_venta;?>" />
            <?php } else { ?>
                <?php if ($cod_estado_deshabilitar_und_venta_temp == '0') { ?>
                <td style="text-align:center;" id="und_venta_<?php echo $incre;?>"><input name="und_venta" type="<?php echo $nombre_tipo_campo_componente_html_und_venta;?>" id="und_venta<?php echo $incre;?>" class="<?php echo $cod_venta_producto_temporal;?>" value="<?php echo $und_venta;?>" step="<?php echo $estado_step_und_venta;?>" lang="en" min=0 <?php echo $max_und_venta;?> oninput="validity.valid||(value='');" style="width: 70px; height: 29px;" /></td>
                <?php } else { 
                    if ($cod_estado_componente_und_venta == '0') { ?>
                        <td style="text-align:center;" id="und_venta_<?php echo $incre;?>"><input name="und_venta" type="<?php echo $nombre_tipo_campo_componente_html_und_venta;?>" id="und_venta<?php echo $incre;?>" class="<?php echo $cod_venta_producto_temporal;?>" value="<?php echo $und_venta;?>" step="<?php echo $estado_step_und_venta;?>" lang="en" min=0 <?php echo $max_und_venta;?> oninput="validity.valid||(value='');" style="width: 70px; height: 29px;" /></td>
                    <?php } else { ?>
                        <td style="text-align:center;" id="und_venta_<?php echo $incre;?>"><?php echo $und_venta;?></td>
                 <?php } ?>
                <?php } ?>
            <?php } ?>

            <td style="text-align:center; background-color:<?php echo $color_fondo_celda ?>;" id="nombre_tipo_unidad_medida_<?php echo $incre;?>"><span style="color:<?php echo $color_letra_celda ?>;"><?php echo $nombre_tipo_unidad_medida;?></span></td>
            <td style="text-align:center; background-color:<?php echo $color_fondo_celda ?>;" id="nombre_tipo_precio_venta_<?php echo $incre;?>"><span style="color:<?php echo $color_letra_celda ?>;"><?php echo $nombre_tipo_precio_venta;?></span></td>
            <!--<td style="text-align:right; background-color:<?php echo $color_fondo_celda ?>;" id="precio_venta_producto_<?php echo $incre;?>"><span style="color:<?php echo $color_letra_celda ?>;"><?php echo number_format($precio_venta_producto, 0, ",", "."); ?></span></td>-->
            <td style="text-align:right; background-color:<?php echo $color_fondo_celda ?>;" id="precio_venta_producto_<?php echo $incre;?>"><input name="precio_venta_producto" type="<?php echo $nombre_tipo_campo_componente_html_precio_venta;?>" id="precio_venta_producto<?php echo $incre;?>" class="<?php echo $cod_venta_producto_temporal;?>" value="<?php echo $precio_venta_producto;?>" <?php echo $estado_componente;?> step="any" style="width: 100px; height: 20px;" /></td>
            <!--<td style="text-align:right; background-color:<?php echo $color_fondo_celda ?>;" id="total_venta_producto<?php echo $incre;?>"><span style="color:<?php echo $color_letra_celda ?>;"><?php echo number_format($total_venta_producto, 0, ",", ".");?></span></td>-->
            <td style="text-align:center; background-color:<?php echo $color_fondo_celda ?>;" id="cod_venta_producto_temporal_<?php echo $incre;?>"><span style="color:<?php echo $color_letra_celda ?>;"><?php echo $cod_venta_producto_temporal ?></span></td>
            <td style="text-align:center; background-color:<?php echo $color_fondo_celda ?>;" id="estado<?php echo $cod_venta_producto_temporal;?>"></td>
        </tr id="tr<?php echo $cod_venta_producto_temporal;?>">
<?php } ?>
</tbody>
</table>

<table class="table table-striped">
    <tr>
        <td style="text-align:center;"><div id="url_retorno_confirmacion_transaccion"><a href="<?php echo $paginar_edirect;?>"><img src='../imagenes/regresar.png'></a></div></td>
    </tr>
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