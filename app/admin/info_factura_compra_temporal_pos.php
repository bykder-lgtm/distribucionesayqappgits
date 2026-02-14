<?php if ($total_datos <> 0) { ?>

    <?php
    $suma_temporal = "SELECT Sum(total_compra_producto) As total_compra FROM tbl15_compra_producto_temporal WHERE (cuenta = '$cuenta_actual') AND (cod_caja_virtual = '$cod_caja_virtual')";
    $consulta_temporal = mysqli_query($conectar, $suma_temporal);
    $matriz_temporal = mysqli_fetch_assoc($consulta_temporal);

    $total_compra                = $matriz_temporal['total_compra'];

    $datos_data_info_factura = "SELECT * FROM tbl15_info_factura_compra WHERE (nombre_estado_factura = 'ABIERTA') AND (cuenta = '$cuenta_actual') AND (cod_caja_virtual = '$cod_caja_virtual')";
    $consulta_data_info_factura = mysqli_query($conectar, $datos_data_info_factura);
    $data_info_factura = mysqli_fetch_assoc($consulta_data_info_factura);
    $factura_ocupada = mysqli_num_rows($consulta_data_info_factura);

    $cod_info_factura_compra                  = $data_info_factura['cod_info_factura_compra'];
    $cod_factura                              = $data_info_factura['cod_factura'];
    $cod_tercero                              = $data_info_factura['cod_tercero'];
    //$cod_caja_virtual                         = $data_info_factura['cod_caja_virtual'];
    $nombre_estado_factura                    = $data_info_factura['nombre_estado_factura'];
    $nombre_tipo_cargue_factura               = $data_info_factura['nombre_tipo_cargue_factura'];
    $nombre_tipo_compra                       = $data_info_factura['nombre_tipo_compra'];
    $cod_empresa                              = $data_info_factura['cod_empresa'];
    $nombre_empresa                           = $data_info_factura['nombre_empresa'];
    $razonsocial_empresa                      = $data_info_factura['razonsocial_empresa'];
    $total_muestra                            = $data_info_factura['total_muestra'];
    $fecha_ymdhis                             = $data_info_factura['fecha_ymdhis'];
    $cuenta                                   = $data_info_factura['cuenta'];
    $cod_estado_factura                       = $data_info_factura['cod_estado_factura'];
    $cod_base_caja                            = $data_info_factura['cod_base_caja'];
    $descuento_ptj                            = $data_info_factura['descuento_ptj'];
    $iva_ptj                                  = $data_info_factura['iva_ptj'];
    $flete_ptj                                = $data_info_factura['flete_ptj'];
    $subtotal                                 = $data_info_factura['subtotal'];
    $valor_iva                                = $data_info_factura['valor_iva'];
    $cod_cliente                              = $data_info_factura['cod_cliente'];
    $vlr_cancelado                            = $data_info_factura['vlr_cancelado'];
    $vlr_vuelto                               = $data_info_factura['vlr_vuelto'];
    $fecha_dia                                = $data_info_factura['fecha_dia'];
    $fecha_mes                                = $data_info_factura['fecha_mes'];
    $fecha_anyo                               = $data_info_factura['fecha_anyo'];
    $anyo                                     = $data_info_factura['anyo'];
    $fecha_hora                               = $data_info_factura['fecha_hora'];
    $fecha_remision                           = $data_info_factura['fecha_remision'];
    $nombre_ccosto                            = $data_info_factura['nombre_ccosto'];
    $garantia_meses                           = $data_info_factura['garantia_meses'];
    $observacion                              = $data_info_factura['observacion'];
    $cod_tipo_pago                            = $data_info_factura['cod_tipo_pago'];
    $cod_administrador                        = $data_info_factura['cod_administrador'];
    $nombre_tipo_producto                     = $data_info_factura['nombre_tipo_producto'];
    $total_precio_costo                       = $data_info_factura['total_precio_costo'];
    $total_precio_compra                      = $data_info_factura['total_precio_compra'];
    $total_precio_venta                       = $data_info_factura['total_precio_venta'];
    $cod_dependencia                          = $data_info_factura['cod_dependencia'];
    $servicio                                 = $data_info_factura['servicio'];
    $cod_tipo_forma_pago                      = $data_info_factura['cod_tipo_forma_pago'];
    $nombre_tipo_forma_pago                   = $data_info_factura['nombre_tipo_forma_pago'];
    $descripcion_tipo_forma_pago              = $data_info_factura['descripcion_tipo_forma_pago'];
    $nombre_tipo_factura                      = $data_info_factura['nombre_tipo_factura'];
    $nombre_tipo_moneda                       = $data_info_factura['nombre_tipo_moneda'];
    $cod_cierre_caja                          = $data_info_factura['cod_cierre_caja'];
    $fecha_creacion                           = $data_info_factura['fecha_creacion'];
    $fecha_modificacion                       = $data_info_factura['fecha_modificacion'];
    $nombre_maquina                           = $data_info_factura['nombre_maquina'];
    $cod_tipo_cobrar                          = $data_info_factura['cod_tipo_cobrar'];
    $cod_estado_vacuna                        = $data_info_factura['cod_estado_vacuna'];
    $cod_resolucion_facturacion               = $data_info_factura['cod_resolucion_facturacion'];
    $total_datos_data                         = $data_info_factura['total_datos_data'];
    $tiempo_ejecucion                         = $data_info_factura['tiempo_ejecucion'];
    $ipc_ptj                                  = $data_info_factura['ipc_ptj'];
    $precio_ipc                               = $data_info_factura['precio_ipc'];
    $precio_ipc_total                         = $data_info_factura['precio_ipc_total'];
    $ret_ica_ptj                              = $data_info_factura['ret_ica_ptj'];
    $total_ret_ica                            = $data_info_factura['total_ret_ica'];
    $iva_teorico_ptj                          = $data_info_factura['iva_teorico_ptj'];
    $total_iva_teorico                        = $data_info_factura['total_iva_teorico'];
    $tarifa_rete_vigente_ptj                  = $data_info_factura['tarifa_rete_vigente_ptj'];
    $total_tarifa_rete_vigente                = $data_info_factura['total_tarifa_rete_vigente'];
    $rete_iva_asumido_ptj                     = $data_info_factura['rete_iva_asumido_ptj'];
    $total_rete_iva_asumido                   = $data_info_factura['total_rete_iva_asumido'];
    $iva_19                                   = $data_info_factura['iva_19'];
    $iva_5                                    = $data_info_factura['iva_5'];
    $nombre_rete_fuente_ptj                   = $data_info_factura['nombre_rete_fuente_ptj'];
    $total_compra_imp                         = $data_info_factura['total_compra_imp'];
    $total_precio_ipc                         = $data_info_factura['total_precio_ipc'];
    $total_descuento                          = $data_info_factura['total_descuento'];
    $total_rete_fuente                        = $data_info_factura['total_rete_fuente'];
    $total_factura_compra_retefuente          = $data_info_factura['total_factura_compra_retefuente'];
    $total_factura_compra                     = $data_info_factura['total_factura_compra'];
    $cod_doc_soporte                          = $data_info_factura['cod_doc_soporte'];
    $total_inv_precio_costo                   = $data_info_factura['total_inv_precio_costo'];
    $total_inv_precio_compra                  = $data_info_factura['total_inv_precio_compra'];
    $total_inv_precio_venta                   = $data_info_factura['total_inv_precio_venta'];
    $total_compra_precio_costo                = $data_info_factura['total_compra_precio_costo'];
    $total_compra_precio_compra               = $data_info_factura['total_compra_precio_compra'];
    $total_compra_precio_venta                = $data_info_factura['total_compra_precio_venta'];
    $total_inv_compra_desp_factura            = $data_info_factura['total_inv_compra_desp_factura'];
    $cod_estado                               = $data_info_factura['cod_estado'];
    $subtotal_total_precio_compra             = $data_info_factura['subtotal_total_precio_compra'];
    $subtotal_total_precio_costo              = $data_info_factura['subtotal_total_precio_costo'];
    $cod_tipo_inventario                      = $data_info_factura['cod_tipo_inventario'];
    $cod_tipo_producto_consumo                = $data_info_factura['cod_tipo_producto_consumo'];
    $fecha_entrega                            = $data_info_factura['fecha_entrega'];
    $url_img_orig_producto                    = $data_info_factura['url_img_orig_producto'];
    $cod_puc                                  = $data_info_factura['cod_puc'];
    $cod_sino_crear_mov_contable              = $data_info_factura['cod_sino_crear_mov_contable'];
    $cod_estado_mov_contable_antes_de_guardar = $data_info_factura['cod_estado_mov_contable_antes_de_guardar'];
    $cod_movimiento_contable_cuenta_personal  = $data_info_factura['cod_movimiento_contable_cuenta_personal'];
    $fecha_pago                               = $data_info_factura['fecha_pago'];

    $tab                                      = 'tbl15_compra_producto_temporal';
    $tipo                                     = 'eliminar';
    $campo                                    = 'cod_compra_producto_temporal';
    $cod_sino                                 = 2;

    if ($cod_estado_deshabilitar_edicion_totales_factura_compra_global == '1') { $readonly_html = 'readonly'; } else { $readonly_html = ''; }
    ?>
    <script language="javascript">
    $(document).ready(function(){
        $("#fecha_anyo").on('change', function () {
            var id = "<?php echo $cod_info_factura_compra; ?>";
            var valor = $(this).val();
            var campo = "fecha_anyo";
            var tipo_ajax = "tbl15_info_factura_compra";
            var campo_incre = campo;
            var pagina = "<?php echo $pagina; ?>";
            var nombre_modulo_puc = "<?php echo $nombre_modulo_puc; ?>";

            var datos_url_ajax = 'id='+id+'&'+'valor='+valor+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'nombre_modulo_puc='+nombre_modulo_puc+'&'+'campo_incre='+campo_incre+'&'+'pagina='+pagina;

            $.ajax({
                type: "POST",
                url: "../admin/guardar_info_factura_y_compra_producto_temporal_json_ajax.php",
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
        $("#fecha_entrega").on('change', function () {
            var id = "<?php echo $cod_info_factura_compra; ?>";
            var valor = $(this).val();
            var campo = "fecha_entrega";
            var tipo_ajax = "tbl15_info_factura_compra";
            var campo_incre = campo;
            var pagina = "<?php echo $pagina; ?>";
            var nombre_modulo_puc = "<?php echo $nombre_modulo_puc; ?>";

            var datos_url_ajax = 'id='+id+'&'+'valor='+valor+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'nombre_modulo_puc='+nombre_modulo_puc+'&'+'campo_incre='+campo_incre+'&'+'pagina='+pagina;

            $.ajax({
                type: "POST",
                url: "../admin/guardar_info_factura_y_compra_producto_temporal_json_ajax.php",
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
        $("#fecha_pago").on('change', function () {
            var id = "<?php echo $cod_info_factura_compra; ?>";
            var valor = $(this).val();
            var campo = "fecha_pago";
            var tipo_ajax = "tbl15_info_factura_compra";
            var campo_incre = campo;
            var pagina = "<?php echo $pagina; ?>";
            var nombre_modulo_puc = "<?php echo $nombre_modulo_puc; ?>";

            var datos_url_ajax = 'id='+id+'&'+'valor='+valor+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'nombre_modulo_puc='+nombre_modulo_puc+'&'+'campo_incre='+campo_incre+'&'+'pagina='+pagina;

            $.ajax({
                type: "POST",
                url: "../admin/guardar_info_factura_y_compra_producto_temporal_json_ajax.php",
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
        $("#observacion").on('change', function () {
            var id = "<?php echo $cod_info_factura_compra; ?>";
            var valor = $(this).val();
            var campo = "observacion";
            var tipo_ajax = "tbl15_info_factura_compra";
            var campo_incre = campo;
            var pagina = "<?php echo $pagina; ?>";
            var nombre_modulo_puc = "<?php echo $nombre_modulo_puc; ?>";

            var datos_url_ajax = 'id='+id+'&'+'valor='+valor+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'nombre_modulo_puc='+nombre_modulo_puc+'&'+'campo_incre='+campo_incre+'&'+'pagina='+pagina;

            $.ajax({
                type: "POST",
                url: "../admin/guardar_info_factura_y_compra_producto_temporal_json_ajax.php",
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
        $("#nombre_tipo_moneda").on('change', function () {
            var id = "<?php echo $cod_info_factura_compra; ?>";
            var valor = $(this).val();
            var campo = "nombre_tipo_moneda";
            var tipo_ajax = "tbl15_info_factura_compra";
            var campo_incre = campo;
            var pagina = "<?php echo $pagina; ?>";
            var nombre_modulo_puc = "<?php echo $nombre_modulo_puc; ?>";

            var datos_url_ajax = 'id='+id+'&'+'valor='+valor+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'nombre_modulo_puc='+nombre_modulo_puc+'&'+'campo_incre='+campo_incre+'&'+'pagina='+pagina;

            $.ajax({
                type: "POST",
                url: "../admin/guardar_info_factura_y_compra_producto_temporal_json_ajax.php",
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
        $("#cod_tipo_forma_pago").on('change', function () {
            var id = "<?php echo $cod_info_factura_compra; ?>";
            var valor = $(this).val();
            var campo = "cod_tipo_forma_pago";
            var tipo_ajax = "tbl15_info_factura_compra";
            var campo_incre = campo;
            var pagina = "<?php echo $pagina; ?>";
            var nombre_modulo_puc = "<?php echo $nombre_modulo_puc; ?>";
            var pagina_local = "<?php echo $pagina_local; ?>";

            var datos_url_ajax = 'id='+id+'&'+'valor='+valor+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'nombre_modulo_puc='+nombre_modulo_puc+'&'+'campo_incre='+campo_incre+'&'+'pagina='+pagina;

            $.ajax({
                type: "POST",
                url: "../admin/guardar_info_factura_y_compra_producto_temporal_json_ajax.php",
                data: datos_url_ajax,
                //dataType: 'json',
                beforeSend: function(objeto){
                    $('#loader').html('<img src="../imagenes/ajax-loader.gif"> Cargando...');
                },
                success:function(respuesta){
                    window.location.href = pagina_local;
                    //$("#cod_puc").html(respuesta);
                    //var ok_ajax = respuesta.ok_ajax;
                }
            });
        });
    });
    </script>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
    <script language="javascript">
    $(document).ready(function(){
        $("#cod_puc").on('change', function () {
            var id = "<?php echo $cod_info_factura_compra; ?>";
            var valor = $(this).val();
            var campo = "cod_puc";
            var tipo_ajax = "tbl15_info_factura_compra";
            var campo_incre = campo;
            var pagina = "<?php echo $pagina; ?>";
            var nombre_modulo_puc = "<?php echo $nombre_modulo_puc; ?>";

            var datos_url_ajax = 'id='+id+'&'+'valor='+valor+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'nombre_modulo_puc='+nombre_modulo_puc+'&'+'campo_incre='+campo_incre+'&'+'pagina='+pagina;

            $.ajax({
                type: "POST",
                url: "../admin/guardar_info_factura_y_compra_producto_temporal_json_ajax.php",
                data: datos_url_ajax,
                //dataType: 'json',
                beforeSend: function(objeto){
                    $('#loader').html('<img src="../imagenes/ajax-loader.gif"> Cargando...');
                },
                success:function(respuesta){
                    //$("#cod_puc").html(respuesta);
                    //var ok_ajax = respuesta.ok_ajax;
                }
            });
        });
    });
    </script>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
    <script language="javascript">
    $(document).ready(function(){
        $("#nombre_tipo_forma_pago").on('change', function () {
            var id = "<?php echo $cod_info_factura_compra; ?>";
            var valor = $(this).val();
            var campo = "nombre_tipo_forma_pago";
            var tipo_ajax = "tbl15_info_factura_compra";
            var campo_incre = campo;
            var pagina = "<?php echo $pagina; ?>";
            var nombre_modulo_puc = "<?php echo $nombre_modulo_puc; ?>";

            var datos_url_ajax = 'id='+id+'&'+'valor='+valor+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'nombre_modulo_puc='+nombre_modulo_puc+'&'+'campo_incre='+campo_incre+'&'+'pagina='+pagina;

            $.ajax({
                type: "POST",
                url: "../admin/guardar_info_factura_y_compra_producto_temporal_json_ajax.php",
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
        $("#cod_tipo_inventario").on('change', function () {
            var id = "<?php echo $cod_info_factura_compra; ?>";
            var valor = $(this).val();
            var campo = "cod_tipo_inventario";
            var tipo_ajax = "tbl15_info_factura_compra";
            var campo_incre = campo;
            var pagina = "<?php echo $pagina; ?>";
            var nombre_modulo_puc = "<?php echo $nombre_modulo_puc; ?>";

            var datos_url_ajax = 'id='+id+'&'+'valor='+valor+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'nombre_modulo_puc='+nombre_modulo_puc+'&'+'campo_incre='+campo_incre+'&'+'pagina='+pagina;

            $.ajax({
                type: "POST",
                url: "../admin/guardar_info_factura_y_compra_producto_temporal_json_ajax.php",
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
        $("#cod_tipo_pago").on('change', function () {
            var id = "<?php echo $cod_info_factura_compra; ?>";
            var valor = $(this).val();
            var campo = "cod_tipo_pago";
            var tipo_ajax = "tbl15_info_factura_compra";
            var campo_incre = campo;
            var pagina = "<?php echo $pagina; ?>";
            var nombre_modulo_puc = "<?php echo $nombre_modulo_puc; ?>";

            var datos_url_ajax = 'id='+id+'&'+'valor='+valor+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'nombre_modulo_puc='+nombre_modulo_puc+'&'+'campo_incre='+campo_incre+'&'+'pagina='+pagina;

            $.ajax({
                type: "POST",
                url: "../admin/guardar_info_factura_y_compra_producto_temporal_json_ajax.php",
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
        $("#nombre_tipo_factura").on('change', function () {
            var id = "<?php echo $cod_info_factura_compra; ?>";
            var valor = $(this).val();
            var campo = "nombre_tipo_factura";
            var tipo_ajax = "tbl15_info_factura_compra";
            var campo_incre = campo;
            var pagina = "<?php echo $pagina; ?>";
            var nombre_modulo_puc = "<?php echo $nombre_modulo_puc; ?>";

            var datos_url_ajax = 'id='+id+'&'+'valor='+valor+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'nombre_modulo_puc='+nombre_modulo_puc+'&'+'campo_incre='+campo_incre+'&'+'pagina='+pagina;

            $.ajax({
                type: "POST",
                url: "../admin/guardar_info_factura_y_compra_producto_temporal_json_ajax.php",
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
        $("#nombre_tipo_cargue_factura").on('change', function () {
            var id = "<?php echo $cod_info_factura_compra; ?>";
            var valor = $(this).val();
            var campo = "nombre_tipo_cargue_factura";
            var tipo_ajax = "tbl15_info_factura_compra";
            var campo_incre = campo;
            var pagina = "<?php echo $pagina; ?>";
            var nombre_modulo_puc = "<?php echo $nombre_modulo_puc; ?>";

            var datos_url_ajax = 'id='+id+'&'+'valor='+valor+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'nombre_modulo_puc='+nombre_modulo_puc+'&'+'campo_incre='+campo_incre+'&'+'pagina='+pagina;

            $.ajax({
                type: "POST",
                url: "../admin/guardar_info_factura_y_compra_producto_temporal_json_ajax.php",
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
        $("#cod_factura").on('change', function () {
            var id = "<?php echo $cod_info_factura_compra; ?>";
            var valor = $(this).val();
            var campo = "cod_factura";
            var tipo_ajax = "tbl15_info_factura_compra";
            var campo_incre = campo;
            var pagina = "<?php echo $pagina; ?>";
            var nombre_modulo_puc = "<?php echo $nombre_modulo_puc; ?>";

            var datos_url_ajax = 'id='+id+'&'+'valor='+valor+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'nombre_modulo_puc='+nombre_modulo_puc+'&'+'campo_incre='+campo_incre+'&'+'pagina='+pagina;

            $.ajax({
                type: "POST",
                url: "../admin/guardar_info_factura_y_compra_producto_temporal_json_ajax.php",
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
        $("#nombre_rete_fuente_ptj").on('change', function () {
            var id = "<?php echo $cod_info_factura_compra; ?>";
            var valor = $(this).val();
            var campo = "nombre_rete_fuente_ptj";
            var tipo_ajax = "tbl15_info_factura_compra";
            var campo_incre = campo;
            var pagina = "<?php echo $pagina; ?>";
            var nombre_modulo_puc = "<?php echo $nombre_modulo_puc; ?>";

            var datos_url_ajax = 'id='+id+'&'+'valor='+valor+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'nombre_modulo_puc='+nombre_modulo_puc+'&'+'campo_incre='+campo_incre+'&'+'pagina='+pagina;

            $.ajax({
                type: "POST",
                url: "../admin/guardar_info_factura_y_compra_producto_temporal_json_ajax.php",
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
        $("#ret_ica_ptj").on('change', function () {
            var id = "<?php echo $cod_info_factura_compra; ?>";
            var valor = $(this).val();
            var campo = "ret_ica_ptj";
            var tipo_ajax = "tbl15_info_factura_compra";
            var campo_incre = campo;
            var pagina = "<?php echo $pagina; ?>";
            var nombre_modulo_puc = "<?php echo $nombre_modulo_puc; ?>";

            var datos_url_ajax = 'id='+id+'&'+'valor='+valor+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'nombre_modulo_puc='+nombre_modulo_puc+'&'+'campo_incre='+campo_incre+'&'+'pagina='+pagina;

            $.ajax({
                type: "POST",
                url: "../admin/guardar_info_factura_y_compra_producto_temporal_json_ajax.php",
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
        $("#total_compra").on('change', function () {
            var id = "<?php echo $cod_info_factura_compra; ?>";
            var valor = $(this).val();
            var campo = "total_compra";
            var tipo_ajax = "tbl15_info_factura_compra";
            var campo_incre = campo;
            var pagina = "<?php echo $pagina; ?>";
            var nombre_modulo_puc = "<?php echo $nombre_modulo_puc; ?>";

            var datos_url_ajax = 'id='+id+'&'+'valor='+valor+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'nombre_modulo_puc='+nombre_modulo_puc+'&'+'campo_incre='+campo_incre+'&'+'pagina='+pagina;

            $.ajax({
                type: "POST",
                url: "../admin/guardar_info_factura_y_compra_producto_temporal_json_ajax.php",
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
        $("#subtotal").on('change', function () {
            var id = "<?php echo $cod_info_factura_compra; ?>";
            var valor = $(this).val();
            var campo = "subtotal";
            var tipo_ajax = "tbl15_info_factura_compra";
            var campo_incre = campo;
            var pagina = "<?php echo $pagina; ?>";
            var nombre_modulo_puc = "<?php echo $nombre_modulo_puc; ?>";

            var datos_url_ajax = 'id='+id+'&'+'valor='+valor+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'nombre_modulo_puc='+nombre_modulo_puc+'&'+'campo_incre='+campo_incre+'&'+'pagina='+pagina;

            $.ajax({
                type: "POST",
                url: "../admin/guardar_info_factura_y_compra_producto_temporal_json_ajax.php",
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
        $("#valor_iva").on('change', function () {
            var id = "<?php echo $cod_info_factura_compra; ?>";
            var valor = $(this).val();
            var campo = "valor_iva";
            var tipo_ajax = "tbl15_info_factura_compra";
            var campo_incre = campo;
            var pagina = "<?php echo $pagina; ?>";
            var nombre_modulo_puc = "<?php echo $nombre_modulo_puc; ?>";

            var datos_url_ajax = 'id='+id+'&'+'valor='+valor+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'nombre_modulo_puc='+nombre_modulo_puc+'&'+'campo_incre='+campo_incre+'&'+'pagina='+pagina;

            $.ajax({
                type: "POST",
                url: "../admin/guardar_info_factura_y_compra_producto_temporal_json_ajax.php",
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
        $("#total_descuento").on('change', function () {
            var id = "<?php echo $cod_info_factura_compra; ?>";
            var valor = $(this).val();
            var campo = "total_descuento";
            var tipo_ajax = "tbl15_info_factura_compra";
            var campo_incre = campo;
            var pagina = "<?php echo $pagina; ?>";
            var nombre_modulo_puc = "<?php echo $nombre_modulo_puc; ?>";

            var datos_url_ajax = 'id='+id+'&'+'valor='+valor+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'nombre_modulo_puc='+nombre_modulo_puc+'&'+'campo_incre='+campo_incre+'&'+'pagina='+pagina;

            $.ajax({
                type: "POST",
                url: "../admin/guardar_info_factura_y_compra_producto_temporal_json_ajax.php",
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
        $("#total_precio_ipc").on('change', function () {
            var id = "<?php echo $cod_info_factura_compra; ?>";
            var valor = $(this).val();
            var campo = "total_precio_ipc";
            var tipo_ajax = "tbl15_info_factura_compra";
            var campo_incre = campo;
            var pagina = "<?php echo $pagina; ?>";
            var nombre_modulo_puc = "<?php echo $nombre_modulo_puc; ?>";

            var datos_url_ajax = 'id='+id+'&'+'valor='+valor+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'nombre_modulo_puc='+nombre_modulo_puc+'&'+'campo_incre='+campo_incre+'&'+'pagina='+pagina;

            $.ajax({
                type: "POST",
                url: "../admin/guardar_info_factura_y_compra_producto_temporal_json_ajax.php",
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
        $("#total_compra_imp").on('change', function () {
            var id = "<?php echo $cod_info_factura_compra; ?>";
            var valor = $(this).val();
            var campo = "total_compra_imp";
            var tipo_ajax = "tbl15_info_factura_compra";
            var campo_incre = campo;
            var pagina = "<?php echo $pagina; ?>";
            var nombre_modulo_puc = "<?php echo $nombre_modulo_puc; ?>";

            var datos_url_ajax = 'id='+id+'&'+'valor='+valor+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'nombre_modulo_puc='+nombre_modulo_puc+'&'+'campo_incre='+campo_incre+'&'+'pagina='+pagina;

            $.ajax({
                type: "POST",
                url: "../admin/guardar_info_factura_y_compra_producto_temporal_json_ajax.php",
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
        $("#total_rete_fuente").on('change', function () {
            var id = "<?php echo $cod_info_factura_compra; ?>";
            var valor = $(this).val();
            var campo = "total_rete_fuente";
            var tipo_ajax = "tbl15_info_factura_compra";
            var campo_incre = campo;
            var pagina = "<?php echo $pagina; ?>";
            var nombre_modulo_puc = "<?php echo $nombre_modulo_puc; ?>";

            var datos_url_ajax = 'id='+id+'&'+'valor='+valor+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'nombre_modulo_puc='+nombre_modulo_puc+'&'+'campo_incre='+campo_incre+'&'+'pagina='+pagina;

            $.ajax({
                type: "POST",
                url: "../admin/guardar_info_factura_y_compra_producto_temporal_json_ajax.php",
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
        $("#total_ret_ica").on('change', function () {
            var id = "<?php echo $cod_info_factura_compra; ?>";
            var valor = $(this).val();
            var campo = "total_ret_ica";
            var tipo_ajax = "tbl15_info_factura_compra";
            var campo_incre = campo;
            var pagina = "<?php echo $pagina; ?>";
            var nombre_modulo_puc = "<?php echo $nombre_modulo_puc; ?>";

            var datos_url_ajax = 'id='+id+'&'+'valor='+valor+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'nombre_modulo_puc='+nombre_modulo_puc+'&'+'campo_incre='+campo_incre+'&'+'pagina='+pagina;

            $.ajax({
                type: "POST",
                url: "../admin/guardar_info_factura_y_compra_producto_temporal_json_ajax.php",
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
        $("#total_factura_compra_retefuente").on('change', function () {
            var id = "<?php echo $cod_info_factura_compra; ?>";
            var valor = $(this).val();
            var campo = "total_factura_compra_retefuente";
            var tipo_ajax = "tbl15_info_factura_compra";
            var campo_incre = campo;
            var pagina = "<?php echo $pagina; ?>";
            var nombre_modulo_puc = "<?php echo $nombre_modulo_puc; ?>";

            var datos_url_ajax = 'id='+id+'&'+'valor='+valor+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'nombre_modulo_puc='+nombre_modulo_puc+'&'+'campo_incre='+campo_incre+'&'+'pagina='+pagina;

            $.ajax({
                type: "POST",
                url: "../admin/guardar_info_factura_y_compra_producto_temporal_json_ajax.php",
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
        $("#cod_administrador").on('change', function () {
            var id = "<?php echo $cod_info_factura_compra; ?>";
            var valor = $(this).val();
            var campo = "cod_administrador";
            var tipo_ajax = "tbl15_info_factura_compra";
            var campo_incre = campo;
            var pagina = "<?php echo $pagina; ?>";
            var nombre_modulo_puc = "<?php echo $nombre_modulo_puc; ?>";

            var datos_url_ajax = 'id='+id+'&'+'valor='+valor+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'nombre_modulo_puc='+nombre_modulo_puc+'&'+'campo_incre='+campo_incre+'&'+'pagina='+pagina;

            $.ajax({
                type: "POST",
                url: "../admin/guardar_info_factura_y_compra_producto_temporal_json_ajax.php",
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
        $("#cod_tercero").on('change', function () {
            $("#cod_tercero option:selected").each(function () {
                var id = "<?php echo $cod_info_factura_compra; ?>";
                var valor = $(this).val();
                var campo = "cod_tercero";
                var tipo_ajax = "tbl15_info_factura_compra";
                var campo_incre = campo;
                var pagina = "<?php echo $pagina; ?>";
                var nombre_modulo_puc = "<?php echo $nombre_modulo_puc; ?>";

                var datos_url_ajax = 'id='+id+'&'+'valor='+valor+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'nombre_modulo_puc='+nombre_modulo_puc+'&'+'campo_incre='+campo_incre+'&'+'pagina='+pagina;

                $.ajax({
                    type: "POST",
                    url: "../admin/guardar_info_factura_y_compra_producto_temporal_json_ajax.php",
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
    });
    </script>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
    <script language="javascript">
    $(document).ready(function(){
        $("#nombre_tipo_compra").on('change', function () {
            var id = "<?php echo $cod_info_factura_compra; ?>";
            var valor = $(this).val();
            var campo = "nombre_tipo_compra";
            var tipo_ajax = "tbl15_info_factura_compra";
            var campo_incre = campo;
            var pagina = "<?php echo $pagina; ?>";
            var nombre_modulo_puc = "<?php echo $nombre_modulo_puc; ?>";

            var datos_url_ajax = 'id='+id+'&'+'valor='+valor+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'nombre_modulo_puc='+nombre_modulo_puc+'&'+'campo_incre='+campo_incre+'&'+'pagina='+pagina;

            $.ajax({
                type: "POST",
                url: "../admin/guardar_info_factura_y_compra_producto_temporal_json_ajax.php",
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
        $("#cod_tipo_producto_consumo").on('change', function () {
            var id = "<?php echo $cod_info_factura_compra; ?>";
            var valor = $(this).val();
            var campo = "cod_tipo_producto_consumo";
            var tipo_ajax = "tbl15_info_factura_compra";
            var campo_incre = campo;
            var pagina = "<?php echo $pagina; ?>";
            var nombre_modulo_puc = "<?php echo $nombre_modulo_puc; ?>";

            var datos_url_ajax = 'id='+id+'&'+'valor='+valor+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'nombre_modulo_puc='+nombre_modulo_puc+'&'+'campo_incre='+campo_incre+'&'+'pagina='+pagina;

            $.ajax({
                type: "POST",
                url: "../admin/guardar_info_factura_y_compra_producto_temporal_json_ajax.php",
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
        $("#cod_sino_crear_mov_contable").on('change', function () {
            var id = "<?php echo $cod_info_factura_compra; ?>";
            var valor = $(this).val();
            var campo = "cod_sino_crear_mov_contable";
            var tipo_ajax = "tbl15_info_factura_compra";
            var campo_incre = campo;
            var pagina = "<?php echo $pagina; ?>";
            var nombre_modulo_puc = "<?php echo $nombre_modulo_puc; ?>";

            var datos_url_ajax = 'id='+id+'&'+'valor='+valor+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'nombre_modulo_puc='+nombre_modulo_puc+'&'+'campo_incre='+campo_incre+'&'+'pagina='+pagina;

            $.ajax({
                type: "POST",
                url: "../admin/guardar_info_factura_y_compra_producto_temporal_json_ajax.php",
                data: datos_url_ajax,
                //dataType: 'json',
                beforeSend: function(objeto){
                    $('#loader').html('<img src="../imagenes/ajax-loader.gif"> Cargando...');
                },
                success:function(respuesta){
                    $("#cod_puc").html(respuesta);
                    //var ok_ajax = respuesta.ok_ajax;
                }
            });
        });
    });
    </script>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
    <script language="javascript">
    $(document).ready(function(){
        $("#cod_resolucion_facturacion").on('change', function () {
            var id = "<?php echo $cod_info_factura_compra; ?>";
            var valor = $(this).val();
            var campo = "cod_resolucion_facturacion";
            var tipo_ajax = "tbl15_info_factura_compra";
            var campo_incre = campo;
            var pagina = "<?php echo $pagina; ?>";
            var nombre_modulo_puc = "<?php echo $nombre_modulo_puc; ?>";

            var datos_url_ajax = 'id='+id+'&'+'valor='+valor+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'nombre_modulo_puc='+nombre_modulo_puc+'&'+'campo_incre='+campo_incre+'&'+'pagina='+pagina;

            $.ajax({
                type: "POST",
                url: "../admin/guardar_info_factura_y_compra_producto_temporal_json_ajax.php",
                data: datos_url_ajax,
                //dataType: 'json',
                beforeSend: function(objeto){
                    $('#loader').html('<img src="../imagenes/ajax-loader.gif"> Cargando...');
                },
                success:function(respuesta){
                    $("#cod_puc").html(respuesta);
                    //var ok_ajax = respuesta.ok_ajax;
                }
            });
        });
    });
    </script>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
    <script language="javascript">
    $(document).ready(function(){
        $("#cod_movimiento_contable_cuenta_personal").on('change', function () {
            var id = "<?php echo $cod_info_factura_compra; ?>";
            var valor = $(this).val();
            var campo = "cod_movimiento_contable_cuenta_personal";
            var tipo_ajax = "tbl15_info_factura_compra";
            var campo_incre = campo;
            var pagina = "<?php echo $pagina; ?>";
            var nombre_modulo_puc = "<?php echo $nombre_modulo_puc; ?>";

            var datos_url_ajax = 'id='+id+'&'+'valor='+valor+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'nombre_modulo_puc='+nombre_modulo_puc+'&'+'campo_incre='+campo_incre+'&'+'pagina='+pagina;

            $.ajax({
                type: "POST",
                url: "../admin/guardar_info_factura_y_compra_producto_temporal_json_ajax.php",
                data: datos_url_ajax,
                //dataType: 'json',
                beforeSend: function(objeto){
                    $('#loader').html('<img src="../imagenes/ajax-loader.gif"> Cargando...');
                },
                success:function(respuesta){
                    //$("#cod_movimiento_contable_cuenta_personal").html(respuesta);
                    //var ok_ajax = respuesta.ok_ajax;
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
            var tipo_ajax = "tbl15_compra_producto_temporal";
            var id = $(this).attr("class");
            var campo_incre = $(this).attr("id");
            var pagina = "<?php echo $pagina; ?>";
            var nombre_modulo_puc = "<?php echo $nombre_modulo_puc; ?>";
            //let id = this.id;
            if (campo == 'chk') { if( $('#chk'+id).prop('checked') ) { valor = 1; $('#chk'+id).prop('checked',true); } else { valor = 0; $('#chk'+id).prop('checked',false); } }

            var datos_url_ajax = 'id='+id+'&'+'valor='+valor+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'nombre_modulo_puc='+nombre_modulo_puc+'&'+'campo_incre='+campo_incre+'&'+'pagina='+pagina;

            $.ajax({
                type: "POST",
                url: "../admin/guardar_info_factura_y_compra_producto_temporal_json_ajax.php",
                data: datos_url_ajax,
                //dataType: 'json',
                beforeSend: function(objeto){
                    $('#loader').html('<img src="../imagenes/ajax-loader.gif"> Cargando...');
                },
                success:function(respuesta){
                    var afectado = respuesta.afectado;
                    var campo = respuesta.emisor;
                    var mensaje = respuesta.mensaje;

                    if ((campo == 'und_compra') && (afectado == 'SI')) {
                        var subtotal = respuesta.subtotal;
                        var total_precio_ipc = respuesta.total_precio_ipc;
                        var valor_iva = respuesta.valor_iva;
                        var total_rete_fuente = respuesta.total_rete_fuente;
                        var total_ret_ica = respuesta.total_ret_ica;
                        var total_factura_compra_retefuente = respuesta.total_factura_compra_retefuente;
                        var total_descuento = respuesta.total_descuento;
                        var total_compra_imp = respuesta.total_compra_imp;
                        var precio_ipc_total = respuesta.precio_ipc_total;
                        var und_compra = respuesta.und_compra;
                        var incre = respuesta.incre;

                        $("#subtotal").val(subtotal);
                        $("#valor_iva").val(valor_iva);
                        $("#total_descuento").val(total_descuento);
                        $("#total_precio_ipc").val(total_precio_ipc);
                        $("#total_compra_imp").val(total_compra_imp);
                        $("#total_rete_fuente").val(total_rete_fuente);
                        $("#total_ret_ica").val(total_ret_ica);
                        $("#total_factura_compra_retefuente").val(total_factura_compra_retefuente);
                        //$("#subtotal").html(''+subtotal);
                    }
                    if ((campo == 'und_unidades') && (afectado == 'SI')) {
                        var subtotal = respuesta.subtotal;
                        var total_precio_ipc = respuesta.total_precio_ipc;
                        var valor_iva = respuesta.valor_iva;
                        var total_rete_fuente = respuesta.total_rete_fuente;
                        var total_ret_ica = respuesta.total_ret_ica;
                        var total_factura_compra_retefuente = respuesta.total_factura_compra_retefuente;
                        var total_descuento = respuesta.total_descuento;
                        var total_compra_imp = respuesta.total_compra_imp;
                        var precio_ipc_total = respuesta.precio_ipc_total;
                        var und_compra = respuesta.und_compra;
                        var total_compra_producto = respuesta.total_compra_producto;
                        var incre = respuesta.incre;

                        $("#subtotal").val(subtotal);
                        $("#valor_iva").val(valor_iva);
                        $("#total_descuento").val(total_descuento);
                        $("#total_precio_ipc").val(total_precio_ipc);
                        $("#total_compra_imp").val(total_compra_imp);
                        $("#total_rete_fuente").val(total_rete_fuente);
                        $("#total_ret_ica").val(total_ret_ica);
                        $("#total_factura_compra_retefuente").val(total_factura_compra_retefuente);
                        $("#und_compra"+incre).val(und_compra);
                        $("#total_compra_producto"+incre).html(''+total_compra_producto);
                    }
                    if ((campo == 'und_caja') && (afectado == 'SI')) {
                        var subtotal = respuesta.subtotal;
                        var total_precio_ipc = respuesta.total_precio_ipc;
                        var valor_iva = respuesta.valor_iva;
                        var total_rete_fuente = respuesta.total_rete_fuente;
                        var total_ret_ica = respuesta.total_ret_ica;
                        var total_factura_compra_retefuente = respuesta.total_factura_compra_retefuente;
                        var total_descuento = respuesta.total_descuento;
                        var total_compra_imp = respuesta.total_compra_imp;
                        var precio_ipc_total = respuesta.precio_ipc_total;
                        var und_compra = respuesta.und_compra;
                        var total_compra_producto = respuesta.total_compra_producto;
                        var incre = respuesta.incre;

                        $("#subtotal").val(subtotal);
                        $("#valor_iva").val(valor_iva);
                        $("#total_descuento").val(total_descuento);
                        $("#total_precio_ipc").val(total_precio_ipc);
                        $("#total_compra_imp").val(total_compra_imp);
                        $("#total_rete_fuente").val(total_rete_fuente);
                        $("#total_ret_ica").val(total_ret_ica);
                        $("#total_factura_compra_retefuente").val(total_factura_compra_retefuente);
                        $("#und_compra"+incre).val(und_compra);
                        $("#total_compra_producto"+incre).html(''+total_compra_producto);
                    }
                    if ((campo == 'precio_compra_producto') && (afectado == 'SI')) {
                        var subtotal = respuesta.subtotal;
                        var total_precio_ipc = respuesta.total_precio_ipc;
                        var valor_iva = respuesta.valor_iva;
                        var total_rete_fuente = respuesta.total_rete_fuente;
                        var total_ret_ica = respuesta.total_ret_ica;
                        var total_factura_compra_retefuente = respuesta.total_factura_compra_retefuente;
                        var total_descuento = respuesta.total_descuento;
                        var total_compra_imp = respuesta.total_compra_imp;
                        var incre = respuesta.incre;
                        var ganancia_ptj = respuesta.ganancia_ptj;
                        var precio_compra_producto_promedio = respuesta.precio_compra_producto_promedio;

                        $("#subtotal").val(subtotal);
                        $("#valor_iva").val(valor_iva);
                        $("#total_descuento").val(total_descuento);
                        $("#total_precio_ipc").val(total_precio_ipc);
                        $("#total_compra_imp").val(total_compra_imp);
                        $("#total_rete_fuente").val(total_rete_fuente);
                        $("#total_ret_ica").val(total_ret_ica);
                        $("#total_factura_compra_retefuente").val(total_factura_compra_retefuente);
                        $("#ganancia_ptj"+incre).val(ganancia_ptj);
                        $("#precio_compra_producto_promedio"+incre).html(''+precio_compra_producto_promedio);
                        //$("#subtotal").html(''+subtotal);
                    }
                    if ((campo == 'precio_venta_producto') && (afectado == 'SI')) {
                        var incre = respuesta.incre;
                        var ganancia_ptj = respuesta.ganancia_ptj;
                        $("#ganancia_ptj"+incre).val(ganancia_ptj);
                        //$("#subtotal").html(''+subtotal);
                    }
                    if ((campo == 'ganancia_ptj') && (afectado == 'SI')) {
                        var incre = respuesta.incre;
                        var precio_venta_producto = respuesta.precio_venta_producto;
                        $("#precio_venta_producto"+incre).val(precio_venta_producto);
                        //$("#subtotal").html(''+subtotal);
                    }
                    if ((campo == 'dto1') && (afectado == 'SI')) {
                        var subtotal = respuesta.subtotal;
                        var total_precio_ipc = respuesta.total_precio_ipc;
                        var valor_iva = respuesta.valor_iva;
                        var total_rete_fuente = respuesta.total_rete_fuente;
                        var total_ret_ica = respuesta.total_ret_ica;
                        var total_factura_compra_retefuente = respuesta.total_factura_compra_retefuente;
                        var total_descuento = respuesta.total_descuento;
                        var total_compra_imp = respuesta.total_compra_imp;
                        var precio_ipc_total = respuesta.precio_ipc_total;
                        var und_compra = respuesta.und_compra;
                        var incre = respuesta.incre;

                        $("#subtotal").val(subtotal);
                        $("#valor_iva").val(valor_iva);
                        $("#total_descuento").val(total_descuento);
                        $("#total_precio_ipc").val(total_precio_ipc);
                        $("#total_compra_imp").val(total_compra_imp);
                        $("#total_rete_fuente").val(total_rete_fuente);
                        $("#total_ret_ica").val(total_ret_ica);
                        $("#total_factura_compra_retefuente").val(total_factura_compra_retefuente);
                        //$("#subtotal").html(''+subtotal);
                    }
                    if ((campo == 'dto2') && (afectado == 'SI')) {
                        var subtotal = respuesta.subtotal;
                        var total_precio_ipc = respuesta.total_precio_ipc;
                        var valor_iva = respuesta.valor_iva;
                        var total_rete_fuente = respuesta.total_rete_fuente;
                        var total_ret_ica = respuesta.total_ret_ica;
                        var total_factura_compra_retefuente = respuesta.total_factura_compra_retefuente;
                        var total_descuento = respuesta.total_descuento;
                        var total_compra_imp = respuesta.total_compra_imp;
                        var precio_ipc_total = respuesta.precio_ipc_total;
                        var und_compra = respuesta.und_compra;
                        var incre = respuesta.incre;

                        $("#subtotal").val(subtotal);
                        $("#valor_iva").val(valor_iva);
                        $("#total_descuento").val(total_descuento);
                        $("#total_precio_ipc").val(total_precio_ipc);
                        $("#total_compra_imp").val(total_compra_imp);
                        $("#total_rete_fuente").val(total_rete_fuente);
                        $("#total_ret_ica").val(total_ret_ica);
                        $("#total_factura_compra_retefuente").val(total_factura_compra_retefuente);
                        //$("#subtotal").html(''+subtotal);
                    }
                    if ((campo == 'iva_ptj') && (afectado == 'SI')) {
                        var subtotal = respuesta.subtotal;
                        var total_precio_ipc = respuesta.total_precio_ipc;
                        var valor_iva = respuesta.valor_iva;
                        var total_rete_fuente = respuesta.total_rete_fuente;
                        var total_ret_ica = respuesta.total_ret_ica;
                        var total_factura_compra_retefuente = respuesta.total_factura_compra_retefuente;
                        var total_descuento = respuesta.total_descuento;
                        var total_compra_imp = respuesta.total_compra_imp;
                        var precio_ipc_total = respuesta.precio_ipc_total;
                        var und_compra = respuesta.und_compra;
                        var incre = respuesta.incre;

                        $("#subtotal").val(subtotal);
                        $("#valor_iva").val(valor_iva);
                        $("#total_descuento").val(total_descuento);
                        $("#total_precio_ipc").val(total_precio_ipc);
                        $("#total_compra_imp").val(total_compra_imp);
                        $("#total_rete_fuente").val(total_rete_fuente);
                        $("#total_ret_ica").val(total_ret_ica);
                        $("#total_factura_compra_retefuente").val(total_factura_compra_retefuente);
                        //$("#subtotal").html(''+subtotal);
                    }
                }
            });
        });
    });
    </script>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
    <form name="formulario" method="post" enctype="multipart/form-data" action="../admin/factura_compra_producto_reg.php">
    <table class="table table-striped" border="1" cellspacing="0" cellpadding="20">
      <tr>
        <th style="text-align:center;"></th>
        <th style="text-align:center;">ID</th>
        <th style="text-align:center;">CAJA</th>
        <th style="text-align:center;">FECHA COMPRA</th>

        <?php if ($cod_estado_fecha_entrega_factura_compra == '1') { ?>
        <th style="text-align:center;">FECHA ENTREGA</th>
        <?php } ?>

        <?php if ($cod_estado_generar_movimiento_contable_automatico_global == '1') { ?>
        <?php if ($cod_estado_mov_contable_antes_de_guardar == '0') { ?>
        <th style="text-align:center;">CREAR MOV CONTABLE</th>
        <?php } ?>
        <?php } ?>

        <th style="text-align:center;">TIPO CARGUE</th>

        <?php if ($cod_estado_tipo_compra_global == '1') { ?>
        <th style="text-align:center;">TIPO COMPRA</th>
        <?php } ?>

        <?php if ($cod_estado_observacion_factura_compra == '1') { ?>
        <th style="text-align:center;">OBSERVACION</th>
        <?php } ?>

        <?php if ($cod_estado_producto_consumo_global == '1') { ?>
        <th style="text-align:center;">TIPO CONSUMIBLE</th>
        <?php } ?>

        <?php if ($cod_estado_inventario_bodega_global == '1') { ?>
        <th style="text-align:center;">TIPO INVENTARIO</th>
        <?php } ?>
        <th style="text-align:center;">FORMA PAGO</th>
        <th style="text-align:center;">TIPO PAGO</th>
        <th style="text-align:center;">TERCERO</th>
    <?php if ($cod_estado_soporte_factura_compra_global == '1') { ?>
        <th style="text-align:center;">SOPORTE</th>
    <?php } ?>
        <th style="text-align:center;">FACTURA</th>

    <?php if ($total_datos_temp_compra <> '0' && $cod_estado_deshabilitar_btn_guardar_cargar_factura_compra == '0') { ?>
        <th style="text-align:center;">GUARDAR</th>
    <?php } ?>

        <th style="text-align:center;"></th>
      </tr>
      <tr>
        <th style="text-align:center;"></th>
        <th style="text-align:center;"><?php echo $cod_info_factura_compra ?></th>
        <th style="text-align:center;"><?php echo $cod_caja_virtual ?></th>

    <?php if ($cod_seguridad==1) { ?>
        <td style="text-align:center;"><input name="fecha_anyo" id="fecha_anyo" type="date" value="<?php echo $fecha_anyo ?>" style="width: 110px;" required/></td>
    <?php } else { ?>
        <td style="text-align:center;"><?php echo $fecha_anyo ?></td>
        <input name="fecha_anyo" id="fecha_anyo" type="hidden" value="<?php echo $fecha_anyo ?>" required/>
    <?php } ?>

    <?php if ($cod_estado_fecha_entrega_factura_compra == '1') { ?>
        <td style="text-align:center;"><input name="fecha_entrega" id="fecha_entrega" type="date" value="<?php echo $fecha_entrega ?>" style="width: 110px;"/></td>
    <?php } ?>

        <?php if ($cod_estado_generar_movimiento_contable_automatico_global == '1') { ?>
        <?php if ($cod_estado_mov_contable_antes_de_guardar == '0') { ?>
        <td style="text-align:center;">
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
            <br>
            <a href="../admin/generar_mov_contable_antes_de_guardar_reg.php?cod_info_factura_compra=<?php echo $cod_info_factura_compra ?>&pagina=<?php echo $pagina_local ?>">Generar Mov Contable Antes de Guardar</a>
        </td>
        <?php } ?>
        <?php } ?>

        <input name="nombre_tipo_moneda" id="nombre_tipo_moneda" type="hidden" value="COP" style="width: 110px;" required/>
        <input name="nombre_tipo_factura" id="nombre_tipo_factura" type="hidden" value="POS" style="width: 110px;" required/>

        <td style="text-align:center;">
            <select name="nombre_tipo_cargue_factura" id="nombre_tipo_cargue_factura" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 170px;" required>
                <?php if (isset($nombre_tipo_cargue_factura)) { echo ""; } else { echo  ""; }
                $consulta2_sql = "SELECT nombre_tipo_cargue_factura, cod_tipo_cargue_factura FROM tbl15_tipo_cargue_factura WHERE (nombre_tipo_cargue_factura = '$nombre_tipo_cargue_factura') ORDER BY nombre_tipo_cargue_factura ASC";
                $consulta2 = mysqli_query($conectar, $consulta2_sql);
                while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                if(isset($nombre_tipo_cargue_factura) AND $nombre_tipo_cargue_factura == $datos2['nombre_tipo_cargue_factura']) {
                $seleccionado = "selected"; } else { $seleccionado = ""; }
                $codigo = $datos2['nombre_tipo_cargue_factura'];
                $nombre = $datos2['nombre_tipo_cargue_factura'];
                echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
            </select>
        </td>

        <?php if ($cod_estado_tipo_compra_global == '1') { ?>
        <td style="text-align:center;">
            <select name="nombre_tipo_compra" id="nombre_tipo_compra" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 170px;" required>
                <?php if (isset($nombre_tipo_compra)) { echo ""; } else { echo  ""; }
                $consulta2_sql = "SELECT nombre_tipo_compra, cod_tipo_compra FROM tbl15_tipo_compra WHERE (cod_estado = '1') ORDER BY nombre_tipo_compra DESC";
                $consulta2 = mysqli_query($conectar, $consulta2_sql);
                while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                if(isset($nombre_tipo_compra) AND $nombre_tipo_compra == $datos2['nombre_tipo_compra']) {
                $seleccionado = "selected"; } else { $seleccionado = ""; }
                $codigo = $datos2['nombre_tipo_compra'];
                $nombre = $datos2['nombre_tipo_compra'];
                echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
            </select>
        </td>
        <?php } ?>

        <?php if ($cod_estado_observacion_factura_compra == '1') { ?>
        <td style="text-align:center;"><input name="observacion" id="observacion" type="text" value="<?php echo $observacion ?>" style="width: 110px;"/></td>
        <?php } ?>

        <?php if ($cod_estado_producto_consumo_global == '1') { ?>
        <td style="text-align:center;">
            <select name="cod_tipo_producto_consumo" id="cod_tipo_producto_consumo" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 170px;" required>
                <?php if (isset($cod_tipo_producto_consumo)) { echo ""; } else { echo  ""; }
                $consulta2_sql = "SELECT cod_tipo_producto_consumo, nombre_tipo_producto_consumo FROM tbl15_tipo_producto_consumo ORDER BY cod_tipo_producto_consumo ASC";
                $consulta2 = mysqli_query($conectar, $consulta2_sql);
                while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                if(isset($cod_tipo_producto_consumo) AND $cod_tipo_producto_consumo == $datos2['cod_tipo_producto_consumo']) {
                $seleccionado = "selected"; } else { $seleccionado = ""; }
                $codigo = $datos2['cod_tipo_producto_consumo'];
                $nombre = $datos2['nombre_tipo_producto_consumo'];
                echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
            </select>
        </td>
        <?php } ?>

        <?php if ($cod_estado_inventario_bodega_global == '1') { ?>
        <td style="text-align:center;">
            <select name="cod_tipo_inventario" id="cod_tipo_inventario" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 190px;" required>
                <?php if (isset($cod_tipo_inventario)) { echo "<option value='' >...</option>"; } else { echo  "<option value='' >...</option>"; }
                $consulta2_sql = "SELECT nombre_tipo_inventario, cod_tipo_inventario FROM tbl15_tipo_inventario ORDER BY cod_tipo_inventario ASC";
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
            <select name="cod_tipo_forma_pago" id="cod_tipo_forma_pago" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 170px;" required>
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
            <?php if ($cod_estado_movimiento_contable_cuenta_personal_global == '1') { ?>
            <br><b>CUENTA PERSONAL:</b><br>
            <select name="cod_movimiento_contable_cuenta_personal" id="cod_movimiento_contable_cuenta_personal" class="cod_movimiento_contable_cuenta_personal" data-show-subtext="true" data-live-search="true" style="width: 170px;" tabindex="1">
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

            <?php if ($cod_estado_modulo_puc_global == '1') { ?>
            <br>
            <select name="cod_puc" id="cod_puc" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 170px;" tabindex="1">
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
        </td>

        <td style="text-align:center;">
            <select name="cod_tipo_pago" id="cod_tipo_pago" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 140px;" required>
                <?php if (isset($cod_tipo_pago)) { echo ""; } else { echo  ""; }
                $consulta2_sql = "SELECT cod_tipo_pago, nombre_tipo_pago FROM tbl15_tipo_pago ORDER BY cod_tipo_pago ASC";
                $consulta2 = mysqli_query($conectar, $consulta2_sql);
                while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                if(isset($cod_tipo_pago) AND $cod_tipo_pago == $datos2['cod_tipo_pago']) {
                $seleccionado = "selected"; } else { $seleccionado = ""; }
                $codigo = $datos2['cod_tipo_pago'];
                $nombre = $datos2['nombre_tipo_pago'];
                echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
            </select>
            <br>
            <input name="fecha_pago" id="fecha_pago" type="date" value="<?php echo $fecha_pago ?>" style="width: 110px;" tabindex="1"/>
        </td>

        <td style="text-align:left;">
            <select name="cod_tercero" id="cod_tercero" class="chosen-select" data-show-subtext="true" data-live-search="true" style="width: 200px;" required>
                <?php if (isset($cod_tercero)) { echo "<option value='' >...</option>"; } else { echo  "<option value='' selected ></option>"; }
                $consulta2_sql = "SELECT cod_tercero, identificacion_tercero, nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero 
                FROM tbl15_tercero WHERE (nombre_tipo_tercero='PROVEEDOR') OR (nombre_tipo_tercero='AMBOS') ORDER BY nombre1_tercero ASC";
                $consulta2 = mysqli_query($conectar, $consulta2_sql);
                while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                if(isset($cod_tercero) AND $cod_tercero == $datos2['cod_tercero']) {
                $seleccionado = "selected"; } else { $seleccionado = ""; }
                $codigo = $datos2['cod_tercero'];
                $nombre = $datos2['nombre1_tercero'].' '.$datos2['nombre2_tercero'].' '.$datos2['apellido1_tercero'].' '.$datos2['apellido2_tercero'].' - '.$datos2['identificacion_tercero'];
                echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
            </select>
            <a href="#" id="aaaa">.........</a>
            <p><a href="#" id="modal_abrir"><img src="../imagenes/boton_mas_blanco.png"></a></p>
        </td>
    <?php if ($cod_estado_soporte_factura_compra_global == '1') { ?>
        <td style="text-align:center"><a href="<?php echo $url_img_orig_producto?>" target="_blank"><img src="../imagenes/pdf_peq.png" class="img-polaroid" alt=""><a/><br>
            <a href="../admin/cargar_soporte_archivo_adjunto_info_factura_compra_nota_observacion.php?cuenta=<?php echo $cuenta_actual ?>&cod_caja_virtual=<?php echo $cod_caja_virtual ?>&cod_info_factura_compra=<?php echo $cod_info_factura_compra ?>&pagina=<?php echo $pagina_local ?>">CARGAR SOPORTE</a></td>
    <?php } ?>

        <td style="text-align:center;"><input name="cod_factura" id="cod_factura" type="text" value="<?php echo $cod_factura ?>" style="width: 110px;" required/></td>

    <?php if ($total_datos_temp_compra <> '0' && $cod_estado_deshabilitar_btn_guardar_cargar_factura_compra == '0') { ?>
        <td style="text-align:center;"><input type="image" src="../imagenes/guardar.png" tabindex=3 name="vender" value="Guardar" /></td>
    <?php } ?>
        
        <td style="text-align:center;"></td>
      </tr>
    </table>

    <table class="table table-striped" border="1" cellspacing="0" cellpadding="20">
      <tr>
        <th style="text-align:center;"></th>
        <th style="text-align:center;">TIPO FACTURA</th>
        <th style="text-align:center;">VENDEDOR</th>
        <th style="text-align:center;">%RETE FUENTE</th>
        <th style="text-align:center;">%RETE ICA</th>
        <th style="text-align:center;">SUBTOTAL</th>
        <th style="text-align:center;">TOTAL IVA</th>
        <th style="text-align:center;">DESCUENTO</th>
        <th style="text-align:center;">IMPOCONSUMO</th>
        <th style="text-align:center;">TOTAL COMPRA + IVA</th>
        <th style="text-align:center;">TOTAL RETEFUENTE</th>
        <th style="text-align:center;">TOTAL RETEICA</th>
        <th style="text-align:center;">TOTAL COMPRA</th>
        <th style="text-align:center;"></th>
      </tr>
      <tr>
        <td style="text-align:center;"></td>

        <td style="text-align:center;">
            <select name="cod_resolucion_facturacion" id="cod_resolucion_facturacion" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 170px;" required>
                <?php if (isset($cod_resolucion_facturacion)) { echo ""; } else { echo  ""; }
                $consulta2_sql = "SELECT * FROM tbl15_resolucion_facturacion WHERE (cod_origen_resolucion_facturacion = '2') AND (nombre_tipo_estado = 'ACTIVO') ORDER BY cod_resolucion_facturacion ASC";
                $consulta2 = mysqli_query($conectar, $consulta2_sql);
                while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                if(isset($cod_resolucion_facturacion) AND $cod_resolucion_facturacion == $datos2['cod_resolucion_facturacion']) {
                $seleccionado = "selected"; } else { $seleccionado = ""; }
                $codigo = $datos2['cod_resolucion_facturacion'];
                $nombre = $datos2['nombre_tipo_resolucion_facturacion'].' | '.$datos2['numero_resolucion_facturacion'].' | '.$datos2['prefijo_resolucion_facturacion'].' | '.$datos2['cod_resolucion_facturacion'];
                echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
            </select>
        </td>
        
        <td style="text-align:center;">
            <select name="cod_administrador" id="cod_administrador" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 140px;" required>
                <?php if (isset($cod_tipo_forma_pago)) { echo ""; } else { echo  ""; }
                $consulta2_sql = "SELECT cod_administrador, cuenta FROM tbl15_administrador ORDER BY cod_administrador ASC";
                $consulta2 = mysqli_query($conectar, $consulta2_sql);
                while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                if(isset($cod_administrador) AND $cod_administrador == $datos2['cod_administrador']) {
                $seleccionado = "selected"; } else { $seleccionado = ""; }
                $codigo = $datos2['cod_administrador'];
                $nombre = $datos2['cuenta'];
                echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
            </select>
        </td>
       <td style="text-align:center;"><input name="nombre_rete_fuente_ptj" id="nombre_rete_fuente_ptj" type="text" value="<?php echo $nombre_rete_fuente_ptj ?>" style="width: 30px;" required/></td>
       <td style="text-align:center;"><input name="ret_ica_ptj" id="ret_ica_ptj" type="text" value="<?php echo $ret_ica_ptj ?>" style="width: 30px;" required/></td>
       <td style="text-align:center;"><input name="subtotal" id="subtotal" type="text" value="<?php echo $subtotal ?>" style="width: 110px;" <?php echo $readonly_html ?> required/></td>
       <td style="text-align:center;"><input name="valor_iva" id="valor_iva" type="text" value="<?php echo $valor_iva ?>" style="width: 110px;" <?php echo $readonly_html ?> required/></td>
       <td style="text-align:center;"><input name="total_descuento" id="total_descuento" type="text" value="<?php echo $total_descuento ?>" style="width: 110px;" <?php echo $readonly_html ?> required/></td>
       <td style="text-align:center;"><input name="total_precio_ipc" id="total_precio_ipc" type="text" value="<?php echo $total_precio_ipc ?>" style="width: 110px;" <?php echo $readonly_html ?> required/></td>
       <td style="text-align:center;"><input name="total_compra_imp" id="total_compra_imp" type="text" value="<?php echo $total_compra_imp ?>" style="width: 110px;" <?php echo $readonly_html ?> required/></td>
       <td style="text-align:center;"><input name="total_rete_fuente" id="total_rete_fuente" type="text" value="<?php echo $total_rete_fuente ?>" style="width: 110px;" <?php echo $readonly_html ?> required/></td>
       <td style="text-align:center;"><input name="total_ret_ica" id="total_ret_ica" type="text" value="<?php echo $total_ret_ica ?>" style="width: 110px;" <?php echo $readonly_html ?> required/></td>
       <td style="text-align:center;"><input name="total_factura_compra_retefuente" id="total_factura_compra_retefuente" type="number" value="<?php echo $total_factura_compra_retefuente ?>" style="width: 110px;" step="any" min="1" <?php echo $readonly_html ?> required/></td>
       <td style="text-align:center;"><a href="../admin/actualizar_totales_facturas_compra.php?cuenta=<?php echo $cuenta ?>&cod_caja_virtual=<?php echo $cod_caja_virtual ?>&cod_info_factura_compra=<?php echo $cod_info_factura_compra ?>&pagina=<?php echo $pagina ?>"><img src=../imagenes/correctok.png alt="Listo"></a></td>
      </tr>
    </table>
    <?php $pagina ='facturacion_cotizacion_compra_temporal_producto_manual_pos.php'; ?>
    <input type="hidden" name="cod_info_factura_compra" value="<?php echo $cod_info_factura_compra ?>" size="10">
    <input type="hidden" name="total_datos" value="<?php echo $total_datos; ?>" size="4">
    <input type="hidden" name="pagina" value="<?php echo $pagina_local?>" size="15">
    <input type="hidden" name="flete" value="0" size="15">
    <input type="hidden" name="verificacion_envio" value="1" size="15">
    <input type="hidden" name="cod_estado_vacuna" value="0" size="15">
    </form>
<?php } else { } ?>