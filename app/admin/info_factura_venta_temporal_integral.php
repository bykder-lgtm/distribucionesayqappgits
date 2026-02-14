<?php if ($total_datos <> 0) { 

    $suma_temporal = "SELECT Sum(total_venta_producto) As total_precio_venta_info, Sum(total_costo_producto) As total_compra, Sum(peso_producto * und_venta) As total_peso_producto, Count(cod_venta_producto_temporal) As total_art_temp 
    FROM tbl15_venta_producto_temporal WHERE (cuenta = '$cuenta_actual') AND (cod_caja_virtual = '$cod_caja_virtual')";
    $consulta_temporal = mysqli_query($conectar, $suma_temporal);
    $matriz_temporal = mysqli_fetch_assoc($consulta_temporal);

    $total_precio_venta_info      = $matriz_temporal['total_precio_venta_info'];
    $total_venta                  = $matriz_temporal['total_precio_venta_info'];
    $total_peso_producto          = $matriz_temporal['total_peso_producto'];
    $total_art_temp               = $matriz_temporal['total_art_temp'];

    $sql_base_iva = "SELECT Sum((total_venta_producto)/((iva_ptj/100)+(100/100))) As subtotal_base_iva
    FROM tbl15_venta_producto_temporal WHERE (cuenta = '$cuenta_actual') AND (cod_caja_virtual = '$cod_caja_virtual')";
    $consulta_base_iva = mysqli_query($conectar, $sql_base_iva);
    $matriz_base_iva = mysqli_fetch_assoc($consulta_base_iva);

    $subtotal_base_iva            = $matriz_base_iva['subtotal_base_iva'];

    $datos_data_info_factura = "SELECT * FROM tbl15_info_factura_venta WHERE (nombre_estado_factura = 'ABIERTA') AND (cuenta = '$cuenta_actual') AND (cod_caja_virtual = '$cod_caja_virtual')";
    $consulta_data_info_factura = mysqli_query($conectar, $datos_data_info_factura);
    $data_info_factura = mysqli_fetch_assoc($consulta_data_info_factura);
    $factura_ocupada = mysqli_num_rows($consulta_data_info_factura);

    $cod_info_factura_venta                                      = $data_info_factura['cod_info_factura_venta'];
    $cod_factura                                                 = $data_info_factura['cod_factura'];
    $cod_tercero                                                 = $data_info_factura['cod_tercero'];
    $cod_historia_clinica                                        = $data_info_factura['cod_historia_clinica'];
    $fecha_ini                                                   = $data_info_factura['fecha_ini'];
    $fecha_fin                                                   = $data_info_factura['fecha_fin'];
    $cod_empresa                                                 = $data_info_factura['cod_empresa'];
    $nombre_empresa                                              = $data_info_factura['nombre_empresa'];
    $razonsocial_empresa                                         = $data_info_factura['razonsocial_empresa'];
    $total_motivo                                                = $data_info_factura['total_motivo'];
    $total_muestra                                               = $data_info_factura['total_muestra'];
    $fecha_ymdhis                                                = $data_info_factura['fecha_ymdhis'];
    $cuenta                                                      = $data_info_factura['cuenta'];
    $cod_estado_factura                                          = $data_info_factura['cod_estado_factura'];
    $cod_base_caja                                               = $data_info_factura['cod_base_caja'];
    $descuento_ptj                                               = $data_info_factura['descuento_ptj'];
    $iva_ptj                                                     = $data_info_factura['iva_ptj'];
    $flete_ptj                                                   = $data_info_factura['flete_ptj'];
    $cod_cliente                                                 = $data_info_factura['cod_cliente'];
    $vlr_cancelado                                               = $data_info_factura['vlr_cancelado'];
    $vlr_vuelto                                                  = $data_info_factura['vlr_vuelto'];
    $fecha_dia                                                   = $data_info_factura['fecha_dia'];
    $fecha_mes                                                   = $data_info_factura['fecha_mes'];
    $fecha_anyo                                                  = $data_info_factura['fecha_anyo'];
    $anyo                                                        = $data_info_factura['anyo'];
    $fecha_hora                                                  = $data_info_factura['fecha_hora'];
    $fecha_remision                                              = $data_info_factura['fecha_remision'];
    $nombre_ccosto                                               = $data_info_factura['nombre_ccosto'];
    $garantia_meses                                              = $data_info_factura['garantia_meses'];
    $observacion                                                 = $data_info_factura['observacion'];
    $cod_tipo_pago                                               = $data_info_factura['cod_tipo_pago'];
    $cod_administrador                                           = $data_info_factura['cod_administrador'];
    $nombre_tipo_producto                                        = $data_info_factura['nombre_tipo_producto'];
    $total_precio_compra                                         = $data_info_factura['total_precio_compra'];
    $total_precio_venta                                          = $data_info_factura['total_precio_venta'];
    $cod_dependencia                                             = $data_info_factura['cod_dependencia'];
    $servicio                                                    = $data_info_factura['servicio'];
    $cod_tipo_forma_pago                                         = $data_info_factura['cod_tipo_forma_pago'];
    $nombre_tipo_forma_pago                                      = $data_info_factura['nombre_tipo_forma_pago'];
    $descripcion_tipo_forma_pago                                 = $data_info_factura['descripcion_tipo_forma_pago'];
    $nombre_tipo_factura                                         = $data_info_factura['nombre_tipo_factura'];
    $nombre_tipo_moneda                                          = $data_info_factura['nombre_tipo_moneda'];
    $cod_cierre_caja                                             = $data_info_factura['cod_cierre_caja'];
    $fecha_creacion                                              = $data_info_factura['fecha_creacion'];
    $fecha_modificacion                                          = $data_info_factura['fecha_modificacion'];
    $nombre_maquina                                              = $data_info_factura['nombre_maquina'];
    $cod_tipo_cobrar                                             = $data_info_factura['cod_tipo_cobrar'];
    $cod_estado_vacuna                                           = $data_info_factura['cod_estado_vacuna'];
    $cod_resolucion_facturacion                                  = $data_info_factura['cod_resolucion_facturacion'];
    $cod_tipo_inventario                                         = $data_info_factura['cod_tipo_inventario'];
    $observacion_tercero                                         = $data_info_factura['observacion_tercero'];
    $cod_tipo_metodo_envio                                       = $data_info_factura['cod_tipo_metodo_envio'];
    $nombre1_tercero_ext                                         = $data_info_factura['nombre1_tercero'];
    $nombre_factura_remision                                     = $data_info_factura['nombre_factura_remision'];
    $nombre_tipo_pendiente                                       = $data_info_factura['nombre_tipo_pendiente'];
    $descripcion_tipo_pendiente                                  = $data_info_factura['descripcion_tipo_pendiente'];
    $fecha_entrega                                               = $data_info_factura['fecha_entrega'];
    $hora_entrega                                                = $data_info_factura['hora_entrega'];
    $nombre_elaboro                                              = $data_info_factura['nombre_elaboro'];
    $fecha_pago                                                  = $data_info_factura['fecha_pago'];
    $cod_domiciliario                                            = $data_info_factura['cod_domiciliario'];
    $cod_puc                                                     = $data_info_factura['cod_puc'];
    $cod_sino_crear_mov_contable                                 = $data_info_factura['cod_sino_crear_mov_contable'];
    $cod_puntos_redimibles_campanya                              = $data_info_factura['cod_puntos_redimibles_campanya'];
    $cod_movimiento_contable_cuenta_personal                     = $data_info_factura['cod_movimiento_contable_cuenta_personal'];
    $cod_movimiento_caja                                         = $data_info_factura['cod_movimiento_caja'];
    $retefuente_ptj                                              = $data_info_factura['retefuente_ptj'];
    $reteica_ptj                                                 = $data_info_factura['reteica_ptj'];
    $reteiva_ptj                                                 = $data_info_factura['reteiva_ptj'];
    $cod_estado_alquiler_renta                                   = $data_info_factura['cod_estado_alquiler_renta'];
    $fecha_ini_renta_alquiler                                    = $data_info_factura['fecha_ini_renta_alquiler'];
    $fecha_fin_renta_alquiler                                    = $data_info_factura['fecha_fin_renta_alquiler'];
    $cod_tipo_servicio                                           = $data_info_factura['cod_tipo_servicio'];
    $total_retefuente                                            = $data_info_factura['total_retefuente'];
    $cod_info_factura_strpad                                     = str_pad($cod_info_factura_venta, 6, "0", STR_PAD_LEFT);
    $cod_estado_ignorar_venta                                    = $data_info_factura['cod_estado_ignorar_venta'];
    //---------------------------------------------------------------------------------------------------------------------------------//
    //---------------------------------------------------------------------------------------------------------------------------------//
    $sql_maxima_factura = "SELECT Max(cod_factura) AS cod_factura FROM tbl15_info_factura_venta WHERE (nombre_tipo_factura = 'ELECTRONICA') AND (nombre_estado_factura = 'CERRADA') AND (cod_estado_check_factura_electronica = '1')";
    $consulta_maxima_factura = mysqli_query($conectar, $sql_maxima_factura) or die(mysqli_error($conectar));
    $maxima_factura = mysqli_fetch_assoc($consulta_maxima_factura);

    $cod_ultima_factura_electronica_marcada     = $maxima_factura['cod_factura'];

    $sql_user_vendedor = "SELECT nombres, apellidos FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador')";
    $consulta_user_vendedor = mysqli_query($conectar, $sql_user_vendedor);
    $matriz_user_vendedor = mysqli_fetch_assoc($consulta_user_vendedor);

    $nombres_vendedor            = $matriz_user_vendedor['nombres'].' '.$matriz_user_vendedor['apellidos'];
    //---------------------------------------------------------------------------------------------------------------------------------//
    //---------------------------------------------------------------------------------------------------------------------------------//
    $sql_venta_factura_temporal = "SELECT SUM(total_venta_producto) AS total_precio_factura_venta FROM tbl15_venta_producto_temporal 
    WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (cod_producto_barra <> '33333333') AND (cod_producto_barra <> '22222222') AND (cod_producto_barra <> '11112222')";
    $consulta_venta_factura_temporal = mysqli_query($conectar, $sql_venta_factura_temporal) or die(mysqli_error($conectar));
    $info_venta_factura_temporal = mysqli_fetch_assoc($consulta_venta_factura_temporal);

    $total_precio_factura_venta                                  = $info_venta_factura_temporal['total_precio_factura_venta'];

    $obtener_puntos_redimibles_campanya = "SELECT * FROM tbl15_puntos_redimibles_campanya WHERE (cod_puntos_redimibles_campanya = '$cod_puntos_redimibles_campanya')";
    $resultado_puntos_redimibles_campanya = mysqli_query($conectar, $obtener_puntos_redimibles_campanya) or die(mysqli_error($conectar));
    $info_puntos_redimibles_campanya = mysqli_fetch_assoc($resultado_puntos_redimibles_campanya);

    $valor_puntos_redimibles_campanya                            = intval($info_puntos_redimibles_campanya['valor_puntos_redimibles_campanya']);
    $cantidad_puntos_x_valor_redimibles_campanya                 = intval($info_puntos_redimibles_campanya['cantidad_puntos_x_valor_redimibles_campanya']);
    if ($valor_puntos_redimibles_campanya == '0') { $valor_puntos_redimibles_campanya = '1'; } else { $valor_puntos_redimibles_campanya = $valor_puntos_redimibles_campanya; }

    $obtener_info_cliente = "SELECT total_puntos_redimibles_campanya_tercero FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
    $resultado_info_cliente = mysqli_query($conectar, $obtener_info_cliente) or die(mysqli_error($conectar));
    $info_cliente = mysqli_fetch_assoc($resultado_info_cliente);

    $total_puntos_redimibles_campanya_factura_actual             = ($total_precio_factura_venta / $valor_puntos_redimibles_campanya) * $cantidad_puntos_x_valor_redimibles_campanya;
    $total_puntos_redimibles_campanya_tercero_acumulado          = $info_cliente['total_puntos_redimibles_campanya_tercero'];
    $total_puntos_redimibles_campanya_factura_mas_acumulado      = intval($total_puntos_redimibles_campanya_factura_actual + $total_puntos_redimibles_campanya_tercero_acumulado);
    //---------------------------------------------------------------------------------------------------------------------------------//
    //---------------------------------------------------------------------------------------------------------------------------------//
    $tab                                                         = 'tbl15_venta_producto_temporal';
    $tipo                                                        = 'eliminar';
    $campo                                                       = 'cod_venta_producto_temporal';
    //---------------------------------------------------------------------------------------------------------------------------------//
    //---------------------------------------------------------------------------------------------------------------------------------//
    if ($cod_seguridad == '1') { $condicion_inventario = 'cod_tipo_inventario = "1" OR cod_tipo_inventario = "2"'; } else { $condicion_inventario = 'cod_tipo_inventario = "1"'; }
    if ($cod_estado_cambiar_vendedor_al_vender == '1') { $condicion_vendedor = ''; } else { $condicion_vendedor = 'WHERE cod_administrador = '.$cod_administrador; }
    if (isset($_GET['vlr_cancelado_get'])) { $vlr_cancelado_get = addslashes($_GET['vlr_cancelado_get']); } else { $vlr_cancelado_get = ''; }
    $pagina_redirect_valor_cancelado = $pagina_local."?"."cuenta=".$cuenta_actual."&"."cod_caja_virtual=".$cod_caja_virtual."&"."cod_info_factura_venta=".$cod_info_factura_venta."&"."vlr_cancelado_get=".intval($total_precio_venta_info)."&"."foco=vlr_cancelado";
?>
<script language="javascript">
$(document).ready(function(){
    $("#fecha_anyo").on('change', function () {
            var valor = $(this).val();
            var campo = "fecha_anyo";
            var tipo_ajax = "tbl15_info_factura_venta";
            $.post("guardar_info_factura_y_venta_producto_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, nombre_modulo_puc:"<?php echo $nombre_modulo_puc; ?>", id:<?php echo $cod_info_factura_venta; ?> }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>

<script language="javascript">
$(document).ready(function(){
    $("#nombre_tipo_moneda").on('change', function () {
            var valor = $(this).val();
            var campo = "nombre_tipo_moneda";
            var tipo_ajax = "tbl15_info_factura_venta";
            $.post("guardar_info_factura_y_venta_producto_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, nombre_modulo_puc:"<?php echo $nombre_modulo_puc; ?>", id:<?php echo $cod_info_factura_venta; ?> }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>

<script language="javascript">
$(document).ready(function(){
    $("#nombre_tipo_factura").on('change', function () {
            var valor = $(this).val();
            var campo = "nombre_tipo_factura";
            var tipo_ajax = "tbl15_info_factura_venta";
            $.post("guardar_info_factura_y_venta_producto_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, nombre_modulo_puc:"<?php echo $nombre_modulo_puc; ?>", id:<?php echo $cod_info_factura_venta; ?> }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>

<script language="javascript">
$(document).ready(function(){
    $("#nombre_tipo_forma_pago").on('change', function () {
            var valor = $(this).val();
            var campo = "nombre_tipo_forma_pago";
            var tipo_ajax = "tbl15_info_factura_venta";
            $.post("guardar_info_factura_y_venta_producto_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, nombre_modulo_puc:"<?php echo $nombre_modulo_puc; ?>", id:<?php echo $cod_info_factura_venta; ?> }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>

<script language="javascript">
$(document).ready(function(){
    $("#cod_tipo_inventario").on('change', function () {
            var valor = $(this).val();
            var campo = "cod_tipo_inventario";
            var tipo_ajax = "tbl15_info_factura_venta";
            $.post("guardar_info_factura_y_venta_producto_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, nombre_modulo_puc:"<?php echo $nombre_modulo_puc; ?>", id:<?php echo $cod_info_factura_venta; ?> }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>

<script language="javascript">
$(document).ready(function(){
    $("#cod_domiciliario").on('change', function () {
            var valor = $(this).val();
            var campo = "cod_domiciliario";
            var tipo_ajax = "tbl15_info_factura_venta";
            $.post("guardar_info_factura_y_venta_producto_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, nombre_modulo_puc:"<?php echo $nombre_modulo_puc; ?>", id:<?php echo $cod_info_factura_venta; ?> }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>

<script language="javascript">
$(document).ready(function(){
    $("#cod_administrador").on('change', function () {
        var valor = $(this).val();
        var campo = "cod_administrador";
        var tipo_ajax = "tbl15_info_factura_venta";
        var id = "<?php echo $cod_info_factura_venta; ?>";
        var pagina_local = "<?php echo $pagina_local; ?>";

        var datos_url_ajax = 'valor='+valor+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'id='+id;

        $.ajax({
            type: "POST",
            url: "../admin/guardar_info_factura_y_venta_producto_temporal_ajax.php",
            data: datos_url_ajax,
            //dataType: 'json',
            beforeSend: function(objeto){
                $('#loader').html('<img src="../imagenes/ajax-loader.gif"> Cargando...');
            },
            success:function(respuesta){
                var cuenta = respuesta.cuenta;
                var cod_caja_virtual = respuesta.cod_caja_virtual;
                var cod_info_factura_venta = respuesta.cod_info_factura_venta;
                var afectado = respuesta.afectado;
                var ok_ajax = respuesta.ok_ajax;

                if (afectado == 'SI') { 
                    window.location.href = pagina_local+"?cuenta="+cuenta+"&cod_caja_virtual="+cod_caja_virtual+"&cod_info_factura_venta="+cod_info_factura_venta;
                }
            }
        });

   });
});
</script>

<script language="javascript">
$(document).ready(function(){
    $("#cod_tercero").on('change', function () {
        $("#cod_tercero option:selected").each(function () {
            var valor = $(this).val();
            var campo = "cod_tercero";
            var tipo_ajax = "tbl15_info_factura_venta";
            $.post("guardar_info_factura_y_venta_producto_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, nombre_modulo_puc:"<?php echo $nombre_modulo_puc; ?>", id:<?php echo $cod_info_factura_venta; ?> }, function(data){
                //$("#cod_cliente").html(data);
                $("#"+"observacion_tercero").val(data);
            });     
        });
   });
});
</script>

<script language="javascript">
$(document).ready(function(){
    $("#cod_tipo_metodo_envio").on('change', function () {
            var valor = $(this).val();
            var campo = "cod_tipo_metodo_envio";
            var tipo_ajax = "tbl15_info_factura_venta";
            $.post("guardar_info_factura_y_venta_producto_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, nombre_modulo_puc:"<?php echo $nombre_modulo_puc; ?>", id:<?php echo $cod_info_factura_venta; ?> }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>

<script language="javascript">
$(document).ready(function(){
    $("#nombre1_tercero").on('change', function () {
            var valor = $(this).val();
            var campo = "nombre1_tercero";
            var tipo_ajax = "tbl15_info_factura_venta";
            $.post("guardar_info_factura_y_venta_producto_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, nombre_modulo_puc:"<?php echo $nombre_modulo_puc; ?>", id:<?php echo $cod_info_factura_venta; ?> }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>

<script language="javascript">
$(document).ready(function(){
    $("#fecha_entrega").on('change', function () {
            var valor = $(this).val();
            var campo = "fecha_entrega";
            var tipo_ajax = "tbl15_info_factura_venta";
            $.post("guardar_info_factura_y_venta_producto_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, nombre_modulo_puc:"<?php echo $nombre_modulo_puc; ?>", id:<?php echo $cod_info_factura_venta; ?> }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>

<script language="javascript">
$(document).ready(function(){
    $('select[name="cod_origen_produccion"]').change(function(){  
    //$("#cod_origen_produccion").on('change', function () {
        var valor = $(this).val();
        var campo = $(this).attr("name");
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

        var datos_url_ajax = 'valor='+valor+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'id='+id+'&'+'foco='+foco+'&'+'nombre_campo_incre='+nombre_campo_incre;

        $.ajax({
            type: "POST",
            url: "../admin/guardar_info_factura_y_venta_producto_temporal_ajax.php",
            data: datos_url_ajax,
            //dataType: 'json',
            beforeSend: function(objeto){
                $('#loader').html('<img src="../imagenes/ajax-loader.gif"> Cargando...');
            },
            success:function(respuesta){
                var ok_ajax = respuesta.ok_ajax;
            }
        });
   });
});
</script>

<script language="javascript">
$(document).ready(function(){
    $('select[name="nombre_tipo_cobro"]').change(function(){  
    //$("#nombre_tipo_cobro").on('change', function () {
        var valor = $(this).val();
        var campo = $(this).attr("name");
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

        var datos_url_ajax = 'valor='+valor+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'id='+id+'&'+'foco='+foco+'&'+'nombre_campo_incre='+nombre_campo_incre;

        $.ajax({
            type: "POST",
            url: "../admin/guardar_info_factura_y_venta_producto_temporal_ajax.php",
            data: datos_url_ajax,
            //dataType: 'json',
            beforeSend: function(objeto){
                $('#loader').html('<img src="../imagenes/ajax-loader.gif"> Cargando...');
            },
            success:function(respuesta){
                var ok_ajax = respuesta.ok_ajax;
            }
        });
   });
});
</script>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script language="javascript">
$(document).ready(function(){
    $("input").on('change', function () {
        var valor = $(this).val();
        var campo = $(this).attr("name");
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

        var datos_url_ajax = 'valor='+valor+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'id='+id+'&'+'foco='+foco+'&'+'nombre_campo_incre='+nombre_campo_incre;

        $.ajax({
            type: "POST",
            url: "../admin/guardar_info_factura_y_venta_producto_temporal_ajax.php",
            data: datos_url_ajax,
            //dataType: 'json',
            beforeSend: function(objeto){
                $('#loader').html('<img src="../imagenes/ajax-loader.gif"> Cargando...');
            },
            success:function(respuesta){
                var und_venta = respuesta.und_venta;
                var und_caja_sobre = respuesta.und_caja_sobre;
                var total_venta = respuesta.total_venta;
                var total_venta_producto = respuesta.total_venta_producto;
                var incre = respuesta.incre;
                var ok_ajax = respuesta.ok_ajax;


                $("#total_venta").html(total_venta);
                $("#div_und_caja_sobre"+incre).html(und_venta);
                $("#total_venta_producto"+incre).html(total_venta_producto);
                $("#und_venta"+incre).val(und_venta);
                $("#error_identificacion_repetida").html(respuesta);

                if ((cod_estado_modificar_und_venta_una_sola_vez_global == '1') && (cod_seguridad != '1')) {
                    if (nombre_campo == "") {
                        $("#"+nombre_campo_incre).attr("disabled",true);
                        console.log("increm = "+increm);
                        $("#cod_estado_componente_und_venta"+increm).val("1");
                    }
                }

                if (ok_ajax == 'REFRESCAR_BASCULA') { 
                    window.location.href = pagina_local;
                }
            }
        });
    });
});
</script>

<script language="javascript">
$(document).ready(function(){
    $('input[name="comentario_producto"]').keydown(function(){  
    //$("#cod_origen_produccion").on('change', function () {
        var valor = $(this).val();
        var campo = $(this).attr("name");
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

        var datos_url_ajax = 'valor='+valor+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'id='+id+'&'+'foco='+foco+'&'+'nombre_campo_incre='+nombre_campo_incre;

        $.ajax({
            type: "POST",
            url: "../admin/guardar_info_factura_y_venta_producto_temporal_ajax.php",
            data: datos_url_ajax,
            //dataType: 'json',
            beforeSend: function(objeto){
                $('#loader').html('<img src="../imagenes/ajax-loader.gif"> Cargando...');
            },
            success:function(respuesta){
                var ok_ajax = respuesta.ok_ajax;
            }
        });
   });
});
</script>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script language="javascript">
$(document).ready(function(){
    $("#observacion_tercero").on('change', function () {
            var valor = $(this).val();
            var campo = "observacion_tercero";
            var tipo_ajax = "tbl15_info_factura_venta";
            $.post("guardar_info_factura_y_venta_producto_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, nombre_modulo_puc:"<?php echo $nombre_modulo_puc; ?>", id:<?php echo $cod_info_factura_venta; ?> }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script language="javascript">
$(document).ready(function(){
    $("#cod_base_caja").on('change', function () {
            var valor = $(this).val();
            var campo = "cod_base_caja";
            var tipo_ajax = "tbl15_info_factura_venta";
            $.post("guardar_info_factura_y_venta_producto_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, nombre_modulo_puc:"<?php echo $nombre_modulo_puc; ?>", id:<?php echo $cod_info_factura_venta; ?> }, function(data){
                $("#mensaje_caja_mesa").html(data);
        });
   });
});
</script>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script language="javascript">
$(document).ready(function(){
    $("#descripcion_tipo_forma_pago").on('change', function () {
            var valor = $(this).val();
            var campo = "descripcion_tipo_forma_pago";
            var tipo_ajax = "tbl15_info_factura_venta";
            var id = $(this).attr("class");
            $.post("guardar_info_factura_y_venta_producto_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:id }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script language="javascript">
$(document).ready(function(){
    $("#fecha_pago").on('change', function () {
            var valor = $(this).val();
            var campo = "fecha_pago";
            var tipo_ajax = "tbl15_info_factura_venta";
            var id = $(this).attr("class");
            $.post("guardar_info_factura_y_venta_producto_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:id }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script language="javascript">
$(document).ready(function(){
    $("#cod_tipo_pago").on('change', function () {
        var valor = $(this).val();
        var campo = "cod_tipo_pago";
        var tipo_ajax = "tbl15_info_factura_venta";
        var pagina_local = "<?php echo $pagina_local;?>";

        $.post("guardar_info_factura_y_venta_producto_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, nombre_modulo_puc:"<?php echo $nombre_modulo_puc; ?>", id:<?php echo $cod_info_factura_venta; ?> }, function(data){
            $("#modelo").html(data);
            window.location.href = pagina_local;
        });
   });
});
</script>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script>
$(document).ready(function(){
    var cod_tipo_pago = $("#cod_tipo_pago").val();

        if (cod_tipo_pago == '1') {
            document.getElementById("fecha_pago").style.display = 'none';
        } else {
            document.getElementById("fecha_pago").style.display = 'block';
        }

    $("#cod_tipo_pago").change(function(){
    var cod_tipo_pago = document.getElementById('cod_tipo_pago').value;

        if (cod_tipo_pago == "1") {
            document.getElementById('fecha_pago').style.display = 'none';
        } else {
            document.getElementById('fecha_pago').style.display = 'block';
        }
    });

});
</script>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script language="javascript">
$(document).ready(function(){
    $("#cod_tipo_forma_pago").on('change', function () {
        var valor = $(this).val();
        var campo = "cod_tipo_forma_pago";
        var tipo_ajax = "tbl15_info_factura_venta";
        var pagina_local = "<?php echo $pagina_local;?>";

        $.post("guardar_info_factura_y_venta_producto_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, nombre_modulo_puc:"<?php echo $nombre_modulo_puc; ?>", id:<?php echo $cod_info_factura_venta; ?> }, function(data){
            $("#modelo").html(data);

            window.location.href = pagina_local;
        });
   });
});
</script>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script>
$(document).ready(function(){
    var cod_tipo_forma_pago = $("#cod_tipo_forma_pago").val();

        if (cod_tipo_forma_pago == '1') {
            document.getElementById("<?php echo $cod_info_factura_venta ?>").style.display = 'none';
        } else {
            document.getElementById("<?php echo $cod_info_factura_venta ?>").style.display = 'block';
        }

    $("#cod_tipo_forma_pago").change(function(){
    var cod_tipo_forma_pago = document.getElementById('cod_tipo_forma_pago').value;

        if (cod_tipo_forma_pago == "1") {
            document.getElementById('<?php echo $cod_info_factura_venta ?>').style.display = 'none';
        } else {
            document.getElementById('<?php echo $cod_info_factura_venta ?>').style.display = 'block';
        }
    });

});
</script>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<?php if ($cod_estado_generar_movimiento_contable_automatico_global == '1') { ?>
    <script language="javascript">
    $(document).ready(function(){
        $("#cod_sino_crear_mov_contable").on('change', function () {
                var valor = $(this).val();
                var campo = "cod_sino_crear_mov_contable";
                var tipo_ajax = "tbl15_info_factura_venta";
                $.post("guardar_info_factura_y_venta_producto_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, nombre_modulo_puc:"<?php echo $nombre_modulo_puc; ?>", id:<?php echo $cod_info_factura_venta; ?> }, function(data){
                    $("#modelo").html(data);
            });
       });
    });
    </script>
<?php } ?>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script language="javascript">
$(document).ready(function(){
    $("#cod_puc").on('change', function () {
        var valor = $(this).val();
        var campo = "cod_puc";
        var tipo_ajax = "tbl15_info_factura_venta";
        $.post("guardar_info_factura_y_venta_producto_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, nombre_modulo_puc:"<?php echo $nombre_modulo_puc; ?>", id:<?php echo $cod_info_factura_venta; ?> }, function(data){
            $("#modelo").html(data);
        });
   });
});
</script>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script language="javascript">
$(document).ready(function(){
    $(".cod_movimiento_contable_cuenta_personal").on('change', function () {
        var valor = $(this).val();
        var campo = "cod_movimiento_contable_cuenta_personal";
        var tipo_ajax = "tbl15_info_factura_venta";
        var pagina_local = "<?php echo $pagina_local;?>";

        $.post("guardar_info_factura_y_venta_producto_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, nombre_modulo_puc:"<?php echo $nombre_modulo_puc; ?>", id:<?php echo $cod_info_factura_venta; ?> }, function(data){
            $("#modelo").html(data);
            //window.location.href = pagina_local;
        });
   });
});
</script>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script language="javascript">
$(document).ready(function(){
    $(".cod_movimiento_caja").on('change', function () {
        var valor = $(this).val();
        var campo = "cod_movimiento_caja";
        var tipo_ajax = "tbl15_info_factura_venta";
        var pagina_local = "<?php echo $pagina_local;?>";

        $.post("guardar_info_factura_y_venta_producto_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, nombre_modulo_puc:"<?php echo $nombre_modulo_puc; ?>", id:<?php echo $cod_info_factura_venta; ?> }, function(data){
            $("#modelo").html(data);
            //window.location.href = pagina_local;
        });
   });
});
</script>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script language="javascript">
$(document).ready(function(){
    $("#cod_resolucion_facturacion").on('change', function () {
        var valor = $(this).val();
        var campo = "cod_resolucion_facturacion";
        var tipo_ajax = "tbl15_info_factura_venta";
        var pagina_local = "<?php echo $pagina_local;?>";

        $.post("guardar_info_factura_y_venta_producto_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, nombre_modulo_puc:"<?php echo $nombre_modulo_puc; ?>", id:<?php echo $cod_info_factura_venta; ?> }, function(data){
            //$("#modelo").html(data);
        });
   });
});
</script>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<?php if ($cod_estado_retefuente_global == '1') { ?>
<script language="javascript">
$(document).ready(function(){
    $("#retefuente_ptj").on('change', function () {
        var valor = $(this).val();
        var campo = "retefuente_ptj";
        var tipo_ajax = "tbl15_info_factura_venta";
        var pagina_local = "<?php echo $pagina_local;?>";

        $.post("guardar_info_factura_y_venta_producto_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, nombre_modulo_puc:"<?php echo $nombre_modulo_puc; ?>", id:<?php echo $cod_info_factura_venta; ?> }, function(data){
            $("#modelo").html(data);
            window.location.href = pagina_local;
        });
   });
});
</script>
<?php } ?>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<?php if ($cod_estado_reteica_global == '1') { ?>
<script language="javascript">
$(document).ready(function(){
    $("#reteica_ptj").on('change', function () {
            var valor = $(this).val();
            var campo = "reteica_ptj";
            var tipo_ajax = "tbl15_info_factura_venta";
            $.post("guardar_info_factura_y_venta_producto_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, nombre_modulo_puc:"<?php echo $nombre_modulo_puc; ?>", id:<?php echo $cod_info_factura_venta; ?> }, function(data){
                //$("#mensaje_caja_mesa").html(data);
        });
   });
});
</script>
<?php } ?>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<?php if ($cod_estado_reteiva_global == '1') { ?>
<script language="javascript">
$(document).ready(function(){
    $("#reteiva_ptj").on('change', function () {
            var valor = $(this).val();
            var campo = "reteiva_ptj";
            var tipo_ajax = "tbl15_info_factura_venta";
            $.post("guardar_info_factura_y_venta_producto_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, nombre_modulo_puc:"<?php echo $nombre_modulo_puc; ?>", id:<?php echo $cod_info_factura_venta; ?> }, function(data){
                $("#mensaje_caja_mesa").html(data);
        });
   });
});
</script>
<?php } ?>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<?php if ($cod_estado_puntos_redimibles_campanya_global == '1') { ?>
    <script language="javascript">
    $(document).ready(function(){
        $("#cod_puntos_redimibles_campanya").on('change', function () {
            var valor = $(this).val();
            var campo = "cod_puntos_redimibles_campanya";
            var tipo_ajax = "tbl15_info_factura_venta";
            var pagina_local = "<?php echo $pagina_local;?>";

            var datos_url_ajax = 'valor='+valor+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'id='+<?php echo $cod_info_factura_venta; ?>;

            $.ajax({
                type: "POST",
                url: "../admin/guardar_info_factura_y_venta_producto_temporal_ajax.php",
                data: datos_url_ajax,
                //dataType: 'json',
                beforeSend: function(objeto){
                    $('#loader').html('<img src="../imagenes/ajax-loader.gif"> Cargando...');
                },
                success:function(respuesta){
                    var incre = respuesta.incre;
                    var total_puntos_redimibles_campanya_factura_actual = respuesta.total_puntos_redimibles_campanya_factura_actual;
                    var total_puntos_redimibles_campanya_tercero_acumulado = respuesta.total_puntos_redimibles_campanya_tercero_acumulado;
                    var total_puntos_redimibles_campanya_factura_mas_acumulado = respuesta.total_puntos_redimibles_campanya_factura_mas_acumulado;
                    var afectado = respuesta.afectado;
                    var ok_ajax = respuesta.ok_ajax;
                    $("#total_puntos_redimibles_campanya_factura_actual").html("PRF: "+total_puntos_redimibles_campanya_factura_actual);
                    $("#total_puntos_redimibles_campanya_tercero_acumulado").html("PRA: "+total_puntos_redimibles_campanya_tercero_acumulado);
                    $("#total_puntos_redimibles_campanya_factura_mas_acumulado").html("PRT: "+total_puntos_redimibles_campanya_factura_mas_acumulado);
                }
            });
       });
    });
    </script>
<?php } ?>

<?php if ($cod_estado_renta_alquiler_global == '1') { ?>
    <script language="javascript">
    $(document).ready(function(){
        var cod_estado_alquiler_renta = $("#cod_estado_alquiler_renta").val();
        if (cod_estado_alquiler_renta == '1') {
            document.getElementById("fechas_alquiler").style.display = 'block';
        } else {
            document.getElementById("fechas_alquiler").style.display = 'none';
        }

        $("#cod_estado_alquiler_renta").on('change', function () {
                var valor = $(this).val();
                var cod_estado_alquiler_renta = $("#cod_estado_alquiler_renta").val();
                if (cod_estado_alquiler_renta == "1") {
                    document.getElementById("fechas_alquiler").style.display = 'block';
                } else {
                    document.getElementById("fechas_alquiler").style.display = 'none';
                }
                var campo = "cod_estado_alquiler_renta";
                var tipo_ajax = "tbl15_info_factura_venta";
                $.post("guardar_info_factura_y_venta_producto_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, nombre_modulo_puc:"<?php echo $nombre_modulo_puc; ?>", id:<?php echo $cod_info_factura_venta; ?> }, function(data){
                    $("#modelo").html(data);
            });
       });
    });
    </script>

    <script language="javascript">
    $(document).ready(function(){
        $("#fecha_ini_renta_alquiler").on('change', function () {
                var valor = $(this).val();
                var campo = "fecha_ini_renta_alquiler";
                var tipo_ajax = "tbl15_info_factura_venta";
                $.post("guardar_info_factura_y_venta_producto_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, nombre_modulo_puc:"<?php echo $nombre_modulo_puc; ?>", id:<?php echo $cod_info_factura_venta; ?> }, function(data){
                    $("#modelo").html(data);
            });
       });
    });
    </script>

    <script language="javascript">
    $(document).ready(function(){
        $("#fecha_fin_renta_alquiler").on('change', function () {
                var valor = $(this).val();
                var campo = "fecha_fin_renta_alquiler";
                var tipo_ajax = "tbl15_info_factura_venta";
                $.post("guardar_info_factura_y_venta_producto_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, nombre_modulo_puc:"<?php echo $nombre_modulo_puc; ?>", id:<?php echo $cod_info_factura_venta; ?> }, function(data){
                    $("#modelo").html(data);
            });
       });
    });
    </script>
<?php } ?>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<?php if ($cod_estado_ignorar_venta_global == '1') { ?>
<script language="javascript">
$(document).ready(function(){
    $("#cod_estado_ignorar_venta").on('change', function () {
        var valor = $(this).val();
        var campo = "cod_estado_ignorar_venta";
        var tipo_ajax = "tbl15_info_factura_venta";
        var pagina_local = "<?php echo $pagina_local_redirect_tipo_pago;?>";

        $.post("guardar_info_factura_y_venta_producto_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, nombre_modulo_puc:"<?php echo $nombre_modulo_puc; ?>", id:<?php echo $cod_info_factura_venta; ?> }, function(data){
            $("#modelo").html(data);
        });
   });
});
</script>
<?php } ?>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<form name="formulario" method="post" enctype="multipart/form-data" action="../admin/venta_producto_reg.php" onsubmit="return EvitarDobleClicAlVender();">
<?php if ($tipo_dispositivo == 'PC') { ?>
    <table class="table table-striped" border="1" cellspacing="0" cellpadding="20">
      <tr>
        <td style="text-align:center;"></td>
        <?php if ($cod_estado_preventa_global == '1') { ?><th style="text-align:center;">PREVEN</th><?php } ?>
        <!--<th style="text-align:center;">BOLSA</th>-->
        <th style="text-align:center;">ID</th>
        <!--<th style="text-align:center;">ART</th>-->

        <th style="text-align:center;"><?php echo $nombre_concepto_multi_virtual; ?></th>
        
        <?php if ($cod_estado_inventario_bodega_global == '1') { ?><th style="text-align:center;">TIPO INVENTARIO</th><?php } ?>
        <th style="text-align:center;">FECHA VENTA</th>

        <?php if ($cod_estado_renta_alquiler_global == '1') { ?><th style="text-align:center;">ALQUILER - RENTA</th><?php } ?>

        <th style="text-align:center;">VENDEDOR</th>

        <?php if ($cod_estado_puntos_redimibles_campanya_global == '1') { ?><th style="text-align:center;">PUNTOS REDIM</th><?php } ?>

        <?php if ($cod_estado_tipo_metodo_envio_global == '1') { ?><th style="text-align:center;">METODO ENVIO</th><?php } ?>
        <!--<th style="text-align:center;">MONEDA</th>-->
        <!--<th style="text-align:center;">TIPO FACTURA</th>-->
        <th style="text-align:center;">FORMA PAGO</th>
        <th style="text-align:center;">TIPO PAGO</th>

        <?php if ($cod_estado_observacion_tercero_venta_global == '1') { ?><th style="text-align:center;">OBSERVACION</th><?php } ?>

        <th style="text-align:center;">TERCERO</th>

        <?php if ($cod_estado_peso_producto_global == '1') { ?>
        <th style="text-align:center">TOTAL PESO (KG)</th>
        <?php } ?>

        <?php if ($cod_estado_habilitar_total_venta_ventatemp == '0') { ?><th style="text-align:center;">TOTAL FACTURA</th><?php } ?>

        <?php if ($cod_estado_habilitar_btn_facturar_mod_venta == '0') { ?>
        <th style="text-align:center;">RECIBIDO</th>
        <th style="text-align:center;">FACTURAR</th>
        <?php } ?>

        <td style="text-align:center;"></td>
      </tr>
      <tr>
        <td style="text-align:center;"></td>
        <!--<td style="text-align:center;"><a href="javascript:void(0);" id="foco_btn_imprimir" onclick="printPageArea('area_imprimible_invisible')"><img src="../imagenes/imprimir_directa_pos.png" alt="imprimir"></a></td>-->
        <?php if ($cod_estado_preventa_global == '1') { ?>
        <td style="text-align:center;"><a href="../admin/preventa_facturacion_venta_temporal_producto_manual_pos.php?cuenta=<?php echo $cuenta_actual ?>&cod_caja_virtual=<?php echo $cod_caja_virtual ?>&pagina=<?php echo $pagina ?>" tabindex="1"><img src="../imagenes/btn_preventa.png" alt="Listo" tabindex="1"></a></td>
        <?php } ?>
       <td style="text-align:center;"><?php echo $cod_info_factura_venta ?><br><b>ART:</b> <?php echo $total_art_temp ?></td>

       <?php if ($cod_estado_cambiar_caja_mesa_venta_temp == '1') { ?>
       <td style="text-align:center;">
        <input name="cod_base_caja" id="cod_base_caja" type="number" value="<?php echo $cod_base_caja ?>" class="input-block-level" style="width: 50px;" tabindex="1" required/><div id="mensaje_caja_mesa"></div>
        <b>TIPO FACTURA: </b>
        <br>
            <select name="cod_resolucion_facturacion" id="cod_resolucion_facturacion" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 100px;" required>
                <?php if (isset($cod_resolucion_facturacion)) { echo ""; } else { echo ""; }
                $consulta2_sql = "SELECT * FROM tbl15_resolucion_facturacion WHERE (cod_origen_resolucion_facturacion = '1') AND (nombre_tipo_estado = 'ACTIVO')";
                $consulta2 = mysqli_query($conectar, $consulta2_sql);
                while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                if(isset($cod_resolucion_facturacion) AND $cod_resolucion_facturacion == $datos2['cod_resolucion_facturacion']) {
                $seleccionado = "selected"; } else { $seleccionado = ""; }
                $codigo = $datos2['cod_resolucion_facturacion'];
                $nombre = $datos2['nombre_tipo_resolucion_facturacion'].' | '.$datos2['numero_resolucion_facturacion'].' | '.$datos2['prefijo_resolucion_facturacion'].' | '.$datos2['cod_resolucion_facturacion'];
                echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
            </select>
            <?php if ($cod_estado_generar_movimiento_contable_automatico_global == '1') { ?>
                <br><b>CREAR MOV CONTABLE:</b>
                <select name="cod_sino_crear_mov_contable" id="cod_sino_crear_mov_contable" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 70px;" required>
                    <?php if (isset($cod_sino_crear_mov_contable)) { echo ""; } else { echo ""; }
                    $consulta2_sql = "SELECT cod_sino, nombre_sino FROM tbl15_sino ORDER BY cod_sino ASC";
                    $consulta2 = mysqli_query($conectar, $consulta2_sql);
                    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                    if(isset($cod_sino_crear_mov_contable) AND $cod_sino_crear_mov_contable == $datos2['cod_sino']) {
                    $seleccionado = "selected"; } else { $seleccionado = ""; }
                    $codigo = $datos2['cod_sino'];
                    $nombre = $datos2['nombre_sino'];
                    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                </select>
            <?php } ?>
       </td>
        <?php } else { ?>
       <td style="text-align:center;">
        <?php echo $cod_base_caja ?>
        <b>TIPO FACTURA: </b>
        <br>
            <select name="cod_resolucion_facturacion" id="cod_resolucion_facturacion" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 100px;" required>
                <?php if (isset($cod_resolucion_facturacion)) { echo ""; } else { echo ""; }
                $consulta2_sql = "SELECT * FROM tbl15_resolucion_facturacion WHERE (cod_origen_resolucion_facturacion = '1') AND (nombre_tipo_estado = 'ACTIVO')";
                $consulta2 = mysqli_query($conectar, $consulta2_sql);
                while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                if(isset($cod_resolucion_facturacion) AND $cod_resolucion_facturacion == $datos2['cod_resolucion_facturacion']) {
                $seleccionado = "selected"; } else { $seleccionado = ""; }
                $codigo = $datos2['cod_resolucion_facturacion'];
                $nombre = $datos2['nombre_tipo_resolucion_facturacion'].' | '.$datos2['numero_resolucion_facturacion'].' | '.$datos2['prefijo_resolucion_facturacion'].' | '.$datos2['cod_resolucion_facturacion'];
                echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
            </select>
            <?php if ($cod_estado_generar_movimiento_contable_automatico_global == '1') { ?>
                <br>CREAR MOV CONTABLE:
                <select name="cod_sino_crear_mov_contable" id="cod_sino_crear_mov_contable" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 70px;" required>
                    <?php if (isset($cod_sino_crear_mov_contable)) { echo ""; } else { echo ""; }
                    $consulta2_sql = "SELECT cod_sino, nombre_sino FROM tbl15_sino ORDER BY cod_sino ASC";
                    $consulta2 = mysqli_query($conectar, $consulta2_sql);
                    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                    if(isset($cod_sino_crear_mov_contable) AND $cod_sino_crear_mov_contable == $datos2['cod_sino']) {
                    $seleccionado = "selected"; } else { $seleccionado = ""; }
                    $codigo = $datos2['cod_sino'];
                    $nombre = $datos2['nombre_sino'];
                    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                </select>
            <?php } ?>
        </td>
       <?php } ?>

        <?php if ($cod_estado_inventario_bodega_global == '1') { ?>
        <td style="text-align:center;">
            <select name="cod_tipo_inventario" id="cod_tipo_inventario" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 190px;" tabindex="1" required>
                <?php if (isset($cod_tipo_inventario)) { echo ""; } else { echo ""; }
                $consulta2_sql = "SELECT nombre_tipo_inventario, cod_tipo_inventario FROM tbl15_tipo_inventario WHERE ($condicion_inventario) ORDER BY cod_tipo_inventario ASC";
                $consulta2 = mysqli_query($conectar, $consulta2_sql);
                while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                if(isset($cod_tipo_inventario) AND $cod_tipo_inventario == $datos2['cod_tipo_inventario']) {
                $seleccionado = "selected"; } else { $seleccionado = ""; }
                $codigo = $datos2['cod_tipo_inventario'];
                $nombre = $datos2['nombre_tipo_inventario'];
                echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
            </select>
        </td>
        <?php } ?>

        <?php if ($cod_seguridad==1) { ?>
           <td style="text-align:center;">
            <input name="fecha_anyo" id="fecha_anyo" type="date" value="<?php echo $fecha_anyo ?>" class="input-block-level" style="width: 105px;" tabindex="1" required/>
            <?php if ($cod_estado_fecha_entrega_venta_global == '1') { ?><br><b>FECHA ENTREGA:</b> <input name="fecha_entrega" id="fecha_entrega" type="date" value="<?php echo $fecha_entrega ?>" style="width: 105px;" tabindex="1" /><?php } ?>
          </td>
        <?php } else { ?>
           <td style="text-align:center;">
            <?php echo $fecha_anyo ?>
            <?php if ($cod_estado_fecha_entrega_venta_global == '1') { ?><br><b>FECHA ENTREGA:</b> <input name="fecha_entrega" id="fecha_entrega" type="date" value="<?php echo $fecha_entrega ?>" style="width: 105px;" tabindex="1" /><?php } ?>
          </td>
           <input name="fecha_anyo" id="fecha_anyo" type="hidden" value="<?php echo $fecha_anyo ?>" tabindex="1" required/>
        <?php } ?>
        
        <?php if ($cod_estado_renta_alquiler_global == '1') { ?>
        <td style="text-align:center;">
            <select name="cod_estado_alquiler_renta" id="cod_estado_alquiler_renta" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 70px;" tabindex="1">
                <?php if (isset($cod_estado_alquiler_renta)) { echo ""; } else { echo ""; }
                $consulta2_sql = "SELECT codigo_sino, nombre_sino FROM tbl15_sino ORDER BY nombre_sino ASC";
                $consulta2 = mysqli_query($conectar, $consulta2_sql);
                while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                if(isset($cod_estado_alquiler_renta) AND $cod_estado_alquiler_renta == $datos2['codigo_sino']) {
                $seleccionado = "selected"; } else { $seleccionado = ""; }
                $codigo = $datos2['codigo_sino'];
                $nombre = $datos2['nombre_sino'];
                echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
            </select>
            <br>
            <div id="fechas_alquiler">
            <strong>INICIO:</strong><input name="fecha_ini_renta_alquiler" id="fecha_ini_renta_alquiler" type="date" value="<?php echo $fecha_ini_renta_alquiler ?>" class="input-block-level" style="width: 120px;" tabindex="1"/>
            <br>
            <strong>FINAL:</strong><input name="fecha_fin_renta_alquiler" id="fecha_fin_renta_alquiler" type="date" value="<?php echo $fecha_fin_renta_alquiler ?>" class="input-block-level" style="width: 120px;" tabindex="1"/>
            </div>
        </td>
        <?php } ?>
        <!--
           <td style="text-align:center;"><?php echo $nombre_tipo_moneda ?></td>
           <td style="text-align:center;"><?php echo $nombre_tipo_factura ?></td>

            <input name="nombre_tipo_moneda" id="nombre_tipo_moneda" type="hidden" value="COP" style="width: 100px;" required/>
            <input name="nombre_tipo_factura" id="nombre_tipo_factura" type="hidden" value="POS" style="width: 100px;" required/>
        -->

        <td style="text-align:center;">
            <select name="cod_administrador" id="cod_administrador" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 130px;" tabindex="1" required>
                <?php if (isset($cod_administrador)) { echo ""; } else { echo ""; }
                $consulta2_sql = "SELECT cod_administrador, cuenta FROM tbl15_administrador $condicion_vendedor ORDER BY cod_administrador ASC";
                $consulta2 = mysqli_query($conectar, $consulta2_sql);
                while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                if(isset($cod_administrador) AND $cod_administrador == $datos2['cod_administrador']) {
                $seleccionado = "selected"; } else { $seleccionado = ""; }
                $codigo = $datos2['cod_administrador'];
                $nombre = $datos2['cuenta'];
                echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
            </select>
            <?php if ($cod_estado_domiciliario_global == '1') { ?>
            <select name="cod_domiciliario" id="cod_domiciliario" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 130px;" tabindex="1">
                <?php if (isset($cod_domiciliario)) { echo "<option value='' selected >ESCOGER</option>"; } else { echo "<option value='' selected >ESCOGER</option>"; }
                $consulta2_sql = "SELECT cod_domiciliario, nombres_domiciliario, apellidos_domiciliario FROM tbl15_domiciliario WHERE (cod_estado = '1') ORDER BY cod_domiciliario ASC";
                $consulta2 = mysqli_query($conectar, $consulta2_sql);
                while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                if(isset($cod_domiciliario) AND $cod_domiciliario == $datos2['cod_domiciliario']) {
                $seleccionado = "selected"; } else { $seleccionado = ""; }
                $codigo = $datos2['cod_domiciliario'];
                $nombre = $datos2['nombres_domiciliario'].' '.$datos2['apellidos_domiciliario'];
                echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
            </select>
            <?php } ?>
            <br><b>MONEDA: </b>
            <select name="nombre_tipo_moneda" id="nombre_tipo_moneda" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 70px;" tabindex="1" required>
                <?php if (isset($nombre_tipo_moneda)) { echo ""; } else { echo ""; }
                $consulta2_sql = "SELECT * FROM tbl15_tipo_moneda WHERE (nombre_tipo_moneda='COP')";
                $consulta2 = mysqli_query($conectar, $consulta2_sql);
                while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                if(isset($nombre_tipo_moneda) AND $nombre_tipo_moneda == $datos2['nombre_tipo_moneda']) {
                $seleccionado = "selected"; } else { $seleccionado = ""; }
                $codigo = $datos2['nombre_tipo_moneda'];
                $nombre = $datos2['nombre_tipo_moneda'];
                echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
            </select>
            <?php if ($cod_estado_soporte_factura_venta_global == '1') { ?>
            <br><a href="../admin/cargar_soporte_archivo_adjunto_info_factura_venta_nota_observacion.php?cod_info_factura_venta=<?php echo $cod_info_factura_venta;?>&cuenta=<?php echo $cuenta_actual;?>&cod_caja_virtual=<?php echo $cod_caja_virtual;?>&pagina=<?php echo $pagina_local;?>">CARGAR SOPORTE<a/>
            <?php } ?>
        </td>

        <?php if ($cod_estado_puntos_redimibles_campanya_global == '1') { ?>
        <td style="text-align:center;">
            <select name="cod_puntos_redimibles_campanya" id="cod_puntos_redimibles_campanya" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 100px;" tabindex="1">
                <?php if (isset($cod_domiciliario)) { echo "<option value='0' selected ></option>"; } else { echo "<option value='0' selected ></option>"; }
                $consulta2_sql = "SELECT cod_puntos_redimibles_campanya, nombre_puntos_redimibles_campanya FROM tbl15_puntos_redimibles_campanya WHERE (cod_estado = '1') ORDER BY cod_puntos_redimibles_campanya ASC";
                $consulta2 = mysqli_query($conectar, $consulta2_sql);
                while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                if(isset($cod_puntos_redimibles_campanya) AND $cod_puntos_redimibles_campanya == $datos2['cod_puntos_redimibles_campanya']) {
                $seleccionado = "selected"; } else { $seleccionado = ""; }
                $codigo = $datos2['cod_puntos_redimibles_campanya'];
                $nombre = $datos2['nombre_puntos_redimibles_campanya'];
                echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
            </select>
            <div id="total_puntos_redimibles_campanya_factura_actual">PRF: <?php echo $total_puntos_redimibles_campanya_factura_actual ?></div>
            <div id="total_puntos_redimibles_campanya_tercero_acumulado">PRA: <?php echo $total_puntos_redimibles_campanya_tercero_acumulado ?></div>
            <div id="total_puntos_redimibles_campanya_factura_mas_acumulado"><a href="../admin/preventa_facturacion_venta_temporal_producto_manual_pos.php?cuenta=<?php echo $cuenta_actual ?>&cod_caja_virtual=<?php echo $cod_caja_virtual ?>&pagina=<?php echo $pagina ?>" tabindex="1">PRT: <?php echo $total_puntos_redimibles_campanya_factura_mas_acumulado ?></a></div>
        </td>
        <?php } ?>

        <?php if ($cod_estado_tipo_metodo_envio_global == '1') { ?>
        <td style="text-align:center;">
            <select name="cod_tipo_metodo_envio" id="cod_tipo_metodo_envio" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 140px;" tabindex="1" required>
                <?php if (isset($cod_administrador)) { echo ""; } else { echo ""; }
                $consulta2_sql = "SELECT cod_tipo_metodo_envio, nombre_tipo_metodo_envio FROM tbl15_tipo_metodo_envio ORDER BY cod_tipo_metodo_envio ASC";
                $consulta2 = mysqli_query($conectar, $consulta2_sql);
                while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                if(isset($cod_tipo_metodo_envio) AND $cod_tipo_metodo_envio == $datos2['cod_tipo_metodo_envio']) {
                $seleccionado = "selected"; } else { $seleccionado = ""; }
                $codigo = $datos2['cod_tipo_metodo_envio'];
                $nombre = $datos2['nombre_tipo_metodo_envio'];
                echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
            </select>
        </td>
        <?php } ?>

<!--
        <td style="text-align:center;">
            <select name="nombre_tipo_factura" id="nombre_tipo_factura" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 120px;" tabindex="1" required>
                <?php if (isset($nombre_tipo_factura)) { echo ""; } else { echo ""; }
                $consulta2_sql = "SELECT * FROM tbl15_tipo_factura WHERE (cod_estado = '1')";
                $consulta2 = mysqli_query($conectar, $consulta2_sql);
                while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                if(isset($nombre_tipo_factura) AND $nombre_tipo_factura == $datos2['nombre_tipo_factura']) {
                $seleccionado = "selected"; } else { $seleccionado = ""; }
                $codigo = $datos2['nombre_tipo_factura'];
                $nombre = $datos2['nombre_tipo_factura'];
                echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
            </select>
            <?php if ($nombre_tipo_factura == 'ELECTRONICA') { echo '<br><img src="../imagenes/auxilio.gif"> Ultima Factura Electronica Marcada #'.$cod_ultima_factura_electronica_marcada.' - (Base: '.number_format($subtotal_base_iva, 0, ",", ".").')'; } ?>
        </td>
-->
        <td style="text-align:center;">
            <select name="cod_tipo_forma_pago" id="cod_tipo_forma_pago" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 120px;" tabindex="1" required>
                <?php if (isset($cod_tipo_forma_pago)) { echo ""; } else { echo ""; }
                $consulta2_sql = "SELECT cod_tipo_forma_pago, nombre_tipo_forma_pago FROM tbl15_tipo_forma_pago WHERE (cod_estado = '1') ORDER BY cod_tipo_forma_pago ASC";
                $consulta2 = mysqli_query($conectar, $consulta2_sql);
                while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                if(isset($cod_tipo_forma_pago) AND $cod_tipo_forma_pago == $datos2['cod_tipo_forma_pago']) {
                $seleccionado = "selected"; } else { $seleccionado = ""; }
                $codigo = $datos2['cod_tipo_forma_pago'];
                $nombre = $datos2['nombre_tipo_forma_pago'];
                echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
            </select>
            <?php if ($cod_estado_modulo_puc_global == '1') { ?>
            <br>
            <select name="cod_puc" id="cod_puc" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 120px;" tabindex="1">
                <?php if (isset($cod_puc)) { echo "<option value='' >...</option>"; } else { echo "<option value='' selected ></option>"; }
                $consulta2_sql = "SELECT cod_puc, codigo_puc, nombre_puc, tipo_puc FROM tbl15_parametrizacion_puc_movimiento_contable WHERE ((nombre_modulo_puc = '$nombre_modulo_puc') AND (cod_tipo_forma_pago = '$cod_tipo_forma_pago')) ORDER BY nombre_puc ASC";
                $consulta2 = mysqli_query($conectar, $consulta2_sql);
                while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                if(isset($cod_puc) AND $cod_puc == $datos2['cod_puc']) {
                $seleccionado = "selected"; } else { $seleccionado = ""; }
                $codigo = $datos2['cod_puc'];
                $nombre = $datos2['codigo_puc'].' | '.$datos2['nombre_puc'].' | '.$datos2['tipo_puc'];
                echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
            </select>
            <?php } ?>

            <?php if ($cod_estado_movimiento_contable_cuenta_personal_global == '1') { ?>
            <br><b>CUENTA PERSONAL:</b><br>
            <select name="cod_movimiento_contable_cuenta_personal" id="cod_puc" class="cod_movimiento_contable_cuenta_personal" data-show-subtext="true" data-live-search="true" style="width: 170px;" tabindex="1">
                <?php if (isset($cod_movimiento_contable_cuenta_personal)) { echo "<option value='' >...</option>"; } else { echo "<option value='' selected ></option>"; }
                $consulta2_sql = "SELECT cod_movimiento_contable_cuenta_personal, codigo_puc, nombre_puc, tipo_puc FROM tbl15_movimiento_contable_cuenta_personal WHERE (cod_tipo_forma_pago = '$cod_tipo_forma_pago') AND (cod_estado = '1') ORDER BY nombre_puc ASC";
                $consulta2 = mysqli_query($conectar, $consulta2_sql);
                while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                if(isset($cod_movimiento_contable_cuenta_personal) AND $cod_movimiento_contable_cuenta_personal == $datos2['cod_movimiento_contable_cuenta_personal']) {
                $seleccionado = "selected"; } else { $seleccionado = ""; }
                $codigo = $datos2['cod_movimiento_contable_cuenta_personal'];
                $nombre = $datos2['codigo_puc'].' | '.$datos2['nombre_puc'].' | '.$datos2['tipo_puc'];
                echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
            </select>
            <?php } ?>

            <input name="descripcion_tipo_forma_pago" id="<?php echo $cod_info_factura_venta ?>" class="<?php echo $cod_info_factura_venta ?>" type="text" value="<?php echo $descripcion_tipo_forma_pago ?>" style="width: 110px;" tabindex="1"/>
        </td>

        <td style="text-align:center;">
            <select name="cod_tipo_pago" id="cod_tipo_pago" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 120px;" tabindex="1" required>
                <?php if (isset($cod_tipo_pago)) { echo ""; } else { echo ""; }
                $consulta2_sql = "SELECT cod_tipo_pago, nombre_tipo_pago FROM tbl15_tipo_pago ORDER BY cod_tipo_pago ASC";
                $consulta2 = mysqli_query($conectar, $consulta2_sql);
                while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                if(isset($cod_tipo_pago) AND $cod_tipo_pago == $datos2['cod_tipo_pago']) {
                $seleccionado = "selected"; } else { $seleccionado = ""; }
                $codigo = $datos2['cod_tipo_pago'];
                $nombre = $datos2['nombre_tipo_pago'];
                echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
            </select>
            <input name="fecha_pago" id="fecha_pago" class="<?php echo $cod_info_factura_venta ?>" type="date" value="<?php echo $fecha_pago ?>" style="width: 110px;" tabindex="1"/>
            <?php if ($cod_estado_retefuente_global == '1') { ?>
                <br><b>RETEFUENTE:</b> 
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
             <?php } ?>
            <?php if ($cod_estado_reteica_global == '1') { ?>
                <br>
                <b>RETEICA:</b> <input name="retefuente_ptj" id="retefuente_ptj" type="number" value="<?php echo $retefuente_ptj ?>" class="input-block-level" style="width: 80px;" tabindex="1" />
            <?php } ?>
            <?php if ($cod_estado_reteiva_global == '1') { ?>
                <br>
                <b>RETEIVA:</b> <input name="retefuente_ptj" id="retefuente_ptj" type="number" value="<?php echo $retefuente_ptj ?>" class="input-block-level" style="width: 80px;" tabindex="1" />
            <?php } ?>
            <?php if ($cod_tipo_pago == '2' && $cod_estado_saldo_pendiente_cuenta_cobrar_mod_venta_global == '1') { ?>
                <br><b>SALDO PENDIENTE:</b> <?php echo number_format($saldo_pendiente_cuenta_cobrar, 0, ",", ".") ?> 
            <?php } ?>
        </td>

        <?php if ($cod_estado_observacion_tercero_venta_global == '1') { ?><td style="text-align:center;"><textarea name="observacion_tercero" id="observacion_tercero" class="input-block-level" rows="3" cols="20" tabindex="1"><?php echo $observacion_tercero ?></textarea></td><?php } else { ?> <input type="hidden" name="observacion_tercero" id="observacion_tercero" value="<?php echo $observacion_tercero ?>"><?php } ?>

        <td style="text-align:left; width:300px">
            <select name="cod_tercero" id="cod_tercero" class="chosen-select" data-show-subtext="true" data-live-search="true" style="width: 200px;" tabindex="1" required>
                <?php if (isset($cod_tercero)) { echo "<option value='' >...</option>"; } else { echo "<option value='' selected ></option>"; }
                $consulta2_sql = "SELECT cod_tercero, identificacion_tercero, nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero 
                FROM tbl15_tercero WHERE (nombre_tipo_tercero='CLIENTE') OR (nombre_tipo_tercero='AMBOS') ORDER BY nombre1_tercero ASC";
                $consulta2 = mysqli_query($conectar, $consulta2_sql);
                while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                if(isset($cod_tercero) AND $cod_tercero == $datos2['cod_tercero']) {
                $seleccionado = "selected"; } else { $seleccionado = ""; }
                $codigo = $datos2['cod_tercero'];
                $nombre = $datos2['nombre1_tercero'].' '.$datos2['nombre2_tercero'].' '.$datos2['apellido1_tercero'].' '.$datos2['apellido2_tercero'].' - '.$datos2['identificacion_tercero'];
                echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
            </select>
            <p><a href="#" id="modal_abrir" tabindex="1"><img src="../imagenes/boton_mas_blanco.png"></a></p>
            <?php if ($cod_estado_opcion_escribir_nombre_cliente_venta_global == '1') { ?>
            <p><input name="nombre1_tercero" id="nombre1_tercero" type="text" value="<?php echo $nombre1_tercero_ext ?>" style="width: 220px;" tabindex="1" /></p>
            <?php } ?>
            <?php if ($cod_estado_ignorar_venta_global == '1') { ?>
                <span><strong>Ignorar:</strong>
                <select name="cod_estado_ignorar_venta" id="cod_estado_ignorar_venta" class="" style="width: 50px;">
                    <?php if (isset($cod_estado_ignorar_venta)) { echo ""; } else { echo ""; }
                    $consulta2_sql = "SELECT codigo_sino, nombre_sino FROM tbl15_sino";
                    $consulta2 = mysqli_query($conectar, $consulta2_sql);
                    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                    if(isset($cod_estado_ignorar_venta) AND $cod_estado_ignorar_venta == $datos2['codigo_sino']) {
                    $seleccionado = "selected"; } else { $seleccionado = ""; }
                    $codigo = $datos2['codigo_sino'];
                    $nombre = $datos2['nombre_sino'];
                    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                </select>
                </span>
            <?php } ?>
        </td>

        <?php if ($cod_estado_peso_producto_global == '1') { ?>
        <td style="text-align:center"><br><br><?php echo number_format($total_peso_producto, 0, ",", "."); ?></td>
        <?php } ?>

        <?php if ($cod_estado_habilitar_total_venta_ventatemp == '0') { ?><td style="text-align:center; font-size:30;"><br><h2><div id="total_venta"><a href="<?php echo $pagina_redirect_valor_cancelado ?>"><?php echo number_format($total_precio_venta_info, 0, ",", "."); ?></a></div></h2></td><?php } ?>

        <?php if ($cod_estado_habilitar_btn_facturar_mod_venta == '0') { ?>
        <td style="text-align:center;"><input name="vlr_cancelado_number" id="vlr_cancelado_number" type="text" value="<?php echo $vlr_cancelado_get ?>" style="width: 150px; font-size:30px; height: 50px;" required/></td>
        <input type="hidden" name="vlr_cancelado" id="vlr_cancelado" value="">
        <td style="text-align:center;"><input type="image" src="../imagenes/guardar.png" name="vender" id="btn_facturar_venta" value="Guardar" /></td>
        <?php } ?>

        <td style="text-align:center;"></td>

        <?php 
        $sql_temporal = "SELECT cod_venta_producto_temporal FROM tbl15_venta_producto_temporal WHERE (cuenta = '$cuenta_actual') AND (cod_caja_virtual = '$cod_caja_virtual')";
        $consulta_temporal = mysqli_query($conectar, $sql_temporal);
        $total_datos = mysqli_num_rows($consulta_temporal);
        while ($datos_temporal = mysqli_fetch_assoc($consulta_temporal)) { ?>
        <input type="hidden" name="cod_venta_producto_temporal[]" value="<?php echo $datos_temporal['cod_venta_producto_temporal']; ?>">
        <?php } ?>

        <?php $pagina ='facturacion_venta_temporal_producto_manual_pos.php'; ?>
        <input type="hidden" name="cod_info_factura_venta" value="<?php echo $cod_info_factura_venta ?>" size="10">
        <input type="hidden" name="total_datos" value="<?php echo $total_datos; ?>" size="4">
        <input type="hidden" name="pagina" value="<?php echo $pagina_local?>" size="15">
        <input type="hidden" name="flete" value="0" size="15">
        <input type="hidden" name="verificacion_envio" value="1" size="15">
        <input type="hidden" name="cod_estado_vacuna" value="0" size="15">
        </tr>
    </table>
<?php } else { ?>
    <table class="table table-condensed" border="" cellspacing="0" cellpadding="0">
      <tr>
        <td style="text-align:center;"></td>
        <?php if ($cod_estado_preventa_global == '1') { ?><th style="text-align:center;">PREVEN</th><?php } ?>
        <!--<th style="text-align:center;">BOLSA</th>-->
        <th style="text-align:center;"><?php echo $nombre_concepto_multi_virtual; ?></th>
        <?php if ($cod_estado_inventario_bodega_global == '1') { ?><th style="text-align:center;">TIPO INVENTARIO</th><?php } ?>
        <th style="text-align:center;">FECHA VENTA</th>

        <?php if ($cod_estado_fecha_entrega_venta_global == '1') { ?><th style="text-align:center;">FECHA ENTREGA</th><?php } ?>

        <th style="text-align:center;">TERCERO</th>

        <?php if ($cod_estado_peso_producto_global == '1') { ?>
        <th style="text-align:center">TOTAL PESO (KG)</th>
        <?php } ?>

        <?php if ($cod_estado_habilitar_total_venta_ventatemp == '0') { ?><th style="text-align:center;">TOTAL FACTURA</th><?php } ?>

        <?php if ($cod_estado_habilitar_btn_facturar_mod_venta == '0') { ?>
        <th style="text-align:center;">RECIBIDO</th>
        <th style="text-align:center;">FACTURAR</th>
        <?php } ?>
        <th style="text-align:center;"></th>
      </tr>
      <tr>
        <td style="text-align:center;"></td>
        <!--<td style="text-align:center;"><a href="javascript:void(0);" id="foco_btn_imprimir" onclick="printPageArea('area_imprimible_invisible')"><img src="../imagenes/imprimir_directa_pos.png" alt="imprimir"></a></td>-->
        <?php if ($cod_estado_preventa_global == '1') { ?>
        <td style="text-align:center;"><a href="../admin/preventa_facturacion_venta_temporal_producto_manual_pos.php?cuenta=<?php echo $cuenta_actual ?>&cod_caja_virtual=<?php echo $cod_caja_virtual ?>&pagina=<?php echo $pagina ?>" tabindex="1"><img src="../imagenes/btn_preventa.png" alt="Listo" tabindex="1"></a></td>
        <?php } ?>
        <!--<td style="text-align:center;"><a href="../admin/actualizar_bolsa_temporal_producto.php?cuenta=<?php echo $cuenta_actual ?>&cod_caja_virtual=<?php echo $cod_caja_virtual ?>&pagina=<?php echo $pagina ?>&pagina_local=<?php echo $pagina ?>" tabindex="1"><img src="../imagenes/btn_bolsa_plastica.png" alt="Listo" tabindex="1"></a></td>-->
       <td style="text-align:center;"><input name="cod_base_caja" id="cod_base_caja" type="number" value="<?php echo $cod_base_caja ?>" style="width: 40px;" tabindex="1" required/></td>

        <?php if ($cod_estado_inventario_bodega_global == '1') { ?>
        <td style="text-align:center;">
            <select name="cod_tipo_inventario" id="cod_tipo_inventario" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 190px;" tabindex="1" required>
                <?php if (isset($cod_tipo_inventario)) { echo ""; } else { echo ""; }
                $consulta2_sql = "SELECT nombre_tipo_inventario, cod_tipo_inventario FROM tbl15_tipo_inventario WHERE ($condicion_inventario) ORDER BY cod_tipo_inventario ASC";
                $consulta2 = mysqli_query($conectar, $consulta2_sql);
                while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                if(isset($cod_tipo_inventario) AND $cod_tipo_inventario == $datos2['cod_tipo_inventario']) {
                $seleccionado = "selected"; } else { $seleccionado = ""; }
                $codigo = $datos2['cod_tipo_inventario'];
                $nombre = $datos2['nombre_tipo_inventario'];
                echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
            </select>
        </td>
        <?php } ?>

        <?php if ($cod_seguridad==1) { ?>
           <td style="text-align:center;"><input name="fecha_anyo" id="fecha_anyo" type="date" value="<?php echo $fecha_anyo ?>" style="width: 105px;" tabindex="1" required/></td>
        <?php } else { ?>
           <td style="text-align:center;"><?php echo $fecha_anyo ?></td>
           <input name="fecha_anyo" id="fecha_anyo" type="hidden" value="<?php echo $fecha_anyo ?>" tabindex="1" required/>
        <?php } ?>

        <?php if ($cod_estado_fecha_entrega_venta_global == '1') { ?><td style="text-align:center;"><input name="fecha_entrega" id="fecha_entrega" type="date" value="<?php echo $fecha_entrega ?>" style="width: 105px;" tabindex="1"/></td><?php } ?>

        <td style="text-align:left; width:300px">
            <select name="cod_tercero" id="cod_tercero" class="chosen-select" data-show-subtext="true" data-live-search="true" style="width: 200px;" tabindex="1" required>
                <?php if (isset($cod_tercero)) { echo "<option value='' >...</option>";
                } else { echo "<option value='' selected ></option>"; }
                $consulta2_sql = "SELECT cod_tercero, identificacion_tercero, nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero 
                FROM tbl15_tercero WHERE (nombre_tipo_tercero='CLIENTE') OR (nombre_tipo_tercero='AMBOS') ORDER BY nombre1_tercero ASC";
                $consulta2 = mysqli_query($conectar, $consulta2_sql);
                while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                if(isset($cod_tercero) AND $cod_tercero == $datos2['cod_tercero']) {
                $seleccionado = "selected"; } else { $seleccionado = ""; }
                $codigo = $datos2['cod_tercero'];
                $nombre = $datos2['nombre1_tercero'].' '.$datos2['nombre2_tercero'].' '.$datos2['apellido1_tercero'].' '.$datos2['apellido2_tercero'].' - '.$datos2['identificacion_tercero'];
                echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
            </select>
            <p><a href="#" id="modal_abrir" tabindex="1"><img src="../imagenes/boton_mas_blanco.png"></a></p>

            <?php if ($cod_estado_domiciliario_global == '1') { ?>
            <select name="cod_domiciliario" id="cod_domiciliario" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 140px;" tabindex="1" required>
                <?php if (isset($cod_domiciliario)) { echo ""; } else { echo ""; }
                $consulta2_sql = "SELECT cod_domiciliario, nombres_domiciliario, apellidos_domiciliario FROM tbl15_domiciliario WHERE (cod_estado = '1') ORDER BY cod_domiciliario ASC";
                $consulta2 = mysqli_query($conectar, $consulta2_sql);
                while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                if(isset($cod_domiciliario) AND $cod_domiciliario == $datos2['cod_domiciliario']) {
                $seleccionado = "selected"; } else { $seleccionado = ""; }
                $codigo = $datos2['cod_domiciliario'];
                $nombre = $datos2['nombres_domiciliario'].' '.$datos2['apellidos_domiciliario'];
                echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
            </select>
            <?php } ?>
        </td>

        <?php if ($cod_estado_peso_producto_global == '1') { ?>
        <td style="text-align:center"><br><br><?php echo number_format($total_peso_producto, 0, ",", "."); ?></td>
        <?php } ?>

        <?php if ($cod_estado_habilitar_total_venta_ventatemp == '0') { ?><td style="text-align:center; font-size:30;"><h2><div id="total_venta"><a href="<?php echo $pagina_redirect_valor_cancelado ?>"><?php echo number_format($total_venta, 0, ",", "."); ?></a></div></h2></td><?php } ?>

        <?php if ($cod_estado_habilitar_btn_facturar_mod_venta == '0') { ?>
        <td style="text-align:center;"><input name="vlr_cancelado_number" id="vlr_cancelado_number" type="text" value="<?php echo $vlr_cancelado_get ?>" style="width: 150px; font-size:30px; height: 50px;" required/></td>
        <input type="hidden" name="vlr_cancelado" id="vlr_cancelado" value="">
        <td style="text-align:center;"><input type="image" src="../imagenes/guardar.png" name="vender" id="btn_facturar_venta" value="Guardar" /></td>
        <?php } ?>
        <td style="text-align:center;"></td>
      </tr>
    </table>




    <table <table class="table table-condensed" border="" cellspacing="0" cellpadding="0">
      <tr>
        <td style="text-align:center;"></td>
        <th style="text-align:center;">ID</th>
        <?php if ($cod_estado_inventario_bodega_global == '1') { ?><th style="text-align:center;">TIPO INVENTARIO</th><?php } ?>
        <th style="text-align:center;">VENDEDOR</th>
        <?php if ($cod_estado_tipo_metodo_envio_global == '1') { ?><th style="text-align:center;">METODO ENVIO</th><?php } ?>
        <th style="text-align:center;">MONEDA</th>
        <th style="text-align:center;">TIPO FACTURA</th>
        <th style="text-align:center;">FORMA PAGO</th>
        <th style="text-align:center;">TIPO PAGO</th>
        <?php if ($cod_estado_observacion_tercero_venta_global == '1') { ?><th style="text-align:center;">OBSERVACION</th><?php } ?>
        <td style="text-align:center;"></td>
      </tr>
      <tr>
        <td style="text-align:center;"></td>
        <!--<td style="text-align:center;"><a href="javascript:void(0);" id="foco_btn_imprimir" onclick="printPageArea('area_imprimible_invisible')"><img src="../imagenes/imprimir_directa_pos.png" alt="imprimir"></a></td>-->
       <td style="text-align:center;"><?php echo $cod_info_factura_venta ?></td>

        <?php if ($cod_estado_inventario_bodega_global == '1') { ?>
        <td style="text-align:center;">
            <select name="cod_tipo_inventario" id="cod_tipo_inventario" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 190px;" tabindex="1" required>
                <?php if (isset($cod_tipo_inventario)) { echo ""; } else { echo ""; }
                $consulta2_sql = "SELECT nombre_tipo_inventario, cod_tipo_inventario FROM tbl15_tipo_inventario WHERE ($condicion_inventario) ORDER BY cod_tipo_inventario ASC";
                $consulta2 = mysqli_query($conectar, $consulta2_sql);
                while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                if(isset($cod_tipo_inventario) AND $cod_tipo_inventario == $datos2['cod_tipo_inventario']) {
                $seleccionado = "selected"; } else { $seleccionado = ""; }
                $codigo = $datos2['cod_tipo_inventario'];
                $nombre = $datos2['nombre_tipo_inventario'];
                echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
            </select>
        </td>
        <?php } ?>

        <td style="text-align:center;">
            <select name="cod_administrador" id="cod_administrador" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 140px;" tabindex="1" required>
                <?php if (isset($cod_administrador)) { echo ""; } else { echo ""; }
                $consulta2_sql = "SELECT cod_administrador, cuenta FROM tbl15_administrador $condicion_vendedor ORDER BY cod_administrador ASC";
                $consulta2 = mysqli_query($conectar, $consulta2_sql);
                while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                if(isset($cod_administrador) AND $cod_administrador == $datos2['cod_administrador']) {
                $seleccionado = "selected"; } else { $seleccionado = ""; }
                $codigo = $datos2['cod_administrador'];
                $nombre = $datos2['cuenta'];
                echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
            </select>
        </td>

        <?php if ($cod_estado_tipo_metodo_envio_global == '1') { ?>
        <td style="text-align:center;">
            <select name="cod_tipo_metodo_envio" id="cod_tipo_metodo_envio" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 140px;" tabindex="1" required>
                <?php if (isset($cod_administrador)) { echo ""; } else { echo ""; }
                $consulta2_sql = "SELECT cod_tipo_metodo_envio, nombre_tipo_metodo_envio FROM tbl15_tipo_metodo_envio ORDER BY cod_tipo_metodo_envio ASC";
                $consulta2 = mysqli_query($conectar, $consulta2_sql);
                while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                if(isset($cod_tipo_metodo_envio) AND $cod_tipo_metodo_envio == $datos2['cod_tipo_metodo_envio']) {
                $seleccionado = "selected"; } else { $seleccionado = ""; }
                $codigo = $datos2['cod_tipo_metodo_envio'];
                $nombre = $datos2['nombre_tipo_metodo_envio'];
                echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
            </select>
        </td>
        <?php } ?>
    
        <td style="text-align:center;">
            <select name="nombre_tipo_moneda" id="nombre_tipo_moneda" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 70px;" tabindex="1" required>
                <?php if (isset($nombre_tipo_moneda)) { echo ""; } else { echo ""; }
                $consulta2_sql = "SELECT * FROM tbl15_tipo_moneda WHERE (nombre_tipo_moneda='COP')";
                $consulta2 = mysqli_query($conectar, $consulta2_sql);
                while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                if(isset($nombre_tipo_moneda) AND $nombre_tipo_moneda == $datos2['nombre_tipo_moneda']) {
                $seleccionado = "selected"; } else { $seleccionado = ""; }
                $codigo = $datos2['nombre_tipo_moneda'];
                $nombre = $datos2['nombre_tipo_moneda'];
                echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
            </select>
        </td>


        <td style="text-align:center;">
            <select name="nombre_tipo_factura" id="nombre_tipo_factura" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 140px;" tabindex="1" required>
                <?php if (isset($nombre_tipo_factura)) { echo ""; } else { echo ""; }
                $consulta2_sql = "SELECT * FROM tbl15_tipo_factura";
                $consulta2 = mysqli_query($conectar, $consulta2_sql);
                while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                if(isset($nombre_tipo_factura) AND $nombre_tipo_factura == $datos2['nombre_tipo_factura']) {
                $seleccionado = "selected"; } else { $seleccionado = ""; }
                $codigo = $datos2['nombre_tipo_factura'];
                $nombre = $datos2['nombre_tipo_factura'];
                echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
            </select>
        </td>

        <td style="text-align:center;">
            <select name="cod_tipo_forma_pago" id="cod_tipo_forma_pago" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 120px;" tabindex="1" required>
                <?php if (isset($cod_tipo_forma_pago)) { echo ""; } else { echo ""; }
                $consulta2_sql = "SELECT cod_tipo_forma_pago, nombre_tipo_forma_pago FROM tbl15_tipo_forma_pago WHERE (cod_estado = '1') ORDER BY cod_tipo_forma_pago ASC";
                $consulta2 = mysqli_query($conectar, $consulta2_sql);
                while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                if(isset($cod_tipo_forma_pago) AND $cod_tipo_forma_pago == $datos2['cod_tipo_forma_pago']) {
                $seleccionado = "selected"; } else { $seleccionado = ""; }
                $codigo = $datos2['cod_tipo_forma_pago'];
                $nombre = $datos2['nombre_tipo_forma_pago'];
                echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
            </select>
            <input name="descripcion_tipo_forma_pago" id="<?php echo $cod_info_factura_venta ?>" class="<?php echo $cod_info_factura_venta ?>" type="text" value="<?php echo $descripcion_tipo_forma_pago ?>" style="width: 110px;" tabindex="1"/>
        </td>

        <td style="text-align:center;">
            <select name="cod_tipo_pago" id="cod_tipo_pago" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 120px;" tabindex="1" required>
                <?php if (isset($cod_tipo_pago)) { echo ""; } else { echo ""; }
                $consulta2_sql = "SELECT cod_tipo_pago, nombre_tipo_pago FROM tbl15_tipo_pago ORDER BY cod_tipo_pago ASC";
                $consulta2 = mysqli_query($conectar, $consulta2_sql);
                while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                if(isset($cod_tipo_pago) AND $cod_tipo_pago == $datos2['cod_tipo_pago']) {
                $seleccionado = "selected"; } else { $seleccionado = ""; }
                $codigo = $datos2['cod_tipo_pago'];
                $nombre = $datos2['nombre_tipo_pago'];
                echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
            </select>
            <input name="fecha_pago" id="fecha_pago" class="<?php echo $cod_info_factura_venta ?>" type="date" value="<?php echo $fecha_pago ?>" style="width: 110px;" tabindex="1"/>
        </td>

        <?php if ($cod_estado_observacion_tercero_venta_global == '1') { ?><td style="text-align:center;"><textarea name="observacion_tercero" id="observacion_tercero" class="input-block-level" rows="3" cols="20" tabindex="1"><?php echo $observacion_tercero ?></textarea></td><?php } else { ?> <input type="hidden" name="observacion_tercero" id="observacion_tercero" value="<?php echo $observacion_tercero ?>"><?php } ?>

        <td style="text-align:center;"></td>

        <?php 
        $sql_temporal = "SELECT cod_venta_producto_temporal FROM tbl15_venta_producto_temporal WHERE (cuenta = '$cuenta_actual') AND (cod_caja_virtual = '$cod_caja_virtual')";
        $consulta_temporal = mysqli_query($conectar, $sql_temporal);
        $total_datos = mysqli_num_rows($consulta_temporal);
        while ($datos_temporal = mysqli_fetch_assoc($consulta_temporal)) { ?>
        <input type="hidden" name="cod_venta_producto_temporal[]" value="<?php echo $datos_temporal['cod_venta_producto_temporal']; ?>">
        <?php } ?>

        <?php $pagina ='facturacion_venta_temporal_producto_manual_pos.php'; ?>
        <input type="hidden" name="cod_info_factura_venta" value="<?php echo $cod_info_factura_venta ?>" size="10">
        <input type="hidden" name="total_datos" value="<?php echo $total_datos; ?>" size="4">
        <input type="hidden" name="pagina" value="<?php echo $pagina_local?>" size="15">
        <input type="hidden" name="flete" value="0" size="15">
        <input type="hidden" name="verificacion_envio" value="1" size="15">
        <input type="hidden" name="cod_estado_vacuna" value="0" size="15">
        </tr>
    </table>
<?php } ?>
</form>

<table class="table table-striped">


<?php if ($cod_estado_venta_bolsa == '1') { ?>
        <td style="text-align:right;"><a href="../admin/actualizar_bolsa_temporal_producto.php?cod_producto_auxiliar=4&cod_producto_barra=11111111&cuenta=<?php echo $cuenta_actual ?>&cod_caja_virtual=<?php echo $cod_caja_virtual ?>&pagina=<?php echo $pagina ?>&pagina_local=<?php echo $pagina ?>" tabindex="1"><img src="../imagenes/btn_bolsa_plastica.png" alt="Listo" tabindex="1"></a></td>
<?php } ?>


<?php if ($cod_estado_escoger_precio_venta_automatico_global == '1') { ?>
    <td style="text-align:center;">
        <?php for ($i=1; $i <= $numero_precio_user; $i++) { ?>
        <a href="../admin/actualizar_precio_venta_automatico_masivo_temporal_producto.php?nombre_tipo_precio_venta=PV<?php echo $i?>&cod_info_factura_venta=<?php echo $cod_info_factura_venta?>&cuenta=<?php echo $cuenta_actual?>&cod_caja_virtual=<?php echo $cod_caja_virtual?>&pagina=<?php echo $pagina?>&pagina_local=<?php echo $pagina?>"><img src="<?php echo "../imagenes/PV$i.png"; ?>"></a>
        <?php } ?>
     </td>
<?php } ?>
</table>

<?php } else { } ?>

