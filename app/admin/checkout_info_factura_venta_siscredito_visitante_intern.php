<?php 
$nombre_pagina          = "Compras";
$cod_seguridad_pag      = "1";
$pagina_local           = $_SERVER['PHP_SELF'];
$cod_base_caja          = "1";
?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include_once("../admin/01_modulo_diseno_superior_visitante_intern.php"); ?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include_once("../admin/01_info_empresa_visitante_intern.php"); ?>
<!-- **************************************************** MODULO DE INFO EMPRESA ******************************************** -->
<?php //include_once("../admin/01_rastreador.php"); ?>

<!DOCTYPE html>
<html lang="es">
<!-- Basic -->
<head>
<title><?php echo ($nombre_pagina) ?> - <?php echo ($keywords) ?> - <?php echo ($titulo) ?></title>
<meta http-equiv="Content-Type"        content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible"     content="IE=edge">
<meta name="viewport"                  content="width=device-width, initial-scale=1">
<meta name="keywords"                  content="<?php echo $keywords ?>">
<meta name="description"               content="<?php echo $nombre_pagina ?>">
<meta name="author"                    content="<?php echo $author ?>">
<meta property="og:url"                content="<?php echo $pagina_local ?>" />
<meta property="og:type"               content="website" />
<meta property="og:title"              content="<?php echo $nombre_pagina ?>" />
<meta property="og:description"        content="<?php echo $nombre_pagina ?>" />
<meta property="og:image"              content="<?php echo ($url_pag) ?>/<?php echo ($nombre_carpeta_pagina) ?>/imagenes/quienes_somos.jpg" />
<meta property="og:site_name"          content="<?php echo $nombre ?>"/>
<meta property="fb:admins"             content="editaxe"/>
<meta name="twitter:card"              content="<?php echo $nombre_pagina ?>">
<meta name="twitter:url"               contnet="<?php echo $pagina_local ?>">
<meta name="twitter:title"             content="<?php echo $nombre_pagina ?>">
<meta name="twitter:description"       content="<?php echo $descripcion_producto ?>">
<meta name="twitter:image"             content="<?php echo ($url_pag) ?>/<?php echo ($nombre_carpeta_pagina) ?>/imagenes/quienes_somos.jpg">

<?php include_once("../admin/03_modulo_css_visitante_intern.php"); ?>
<link rel="stylesheet" href="../estilo_css/font-awesome.min.css">
<link rel="stylesheet" href="../estilo_css/normalize_visitante.css">
<link rel="stylesheet" href="../estilo_css/facebook_messenger_flotante.css">
<link rel="stylesheet" href="../estilo_css/whatsapp_messenger_flotante.css">
<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>

<?php //include_once("../pixel_facebook_js/pixel_editaxe.php"); ?>
</head>

<body>
    <!-- End Main Top -->
<?php //include_once("04_modulo_main_top_visitante.php"); ?>
    <!-- Start Main Top -->
<?php include_once("../seguridad/seguridad_diseno_plantillas_visitante_intern.php"); ?>
    <!-- End Main Top -->
<?php //include_once("06_modulo_imagen_head.php"); ?>

<?php
if (isset($_GET['cod_info_factura_venta'])) {

    $cod_info_factura_venta                                         = intval($_GET['cod_info_factura_venta']);
    //$pagina                                                         = addslashes($_GET['pagina']);
    if (isset($_GET['pagina'])) { $pagina = addslashes($_GET['pagina']); } else { $pagina = '../admin/lista_soportes_info_factura_venta_siscredito_visitante_intern'; }

    $pagina_redirect                                                = $pagina.'?cod_info_factura_venta='.$cod_info_factura_venta.'&pagina='.$pagina;
    $modo_venta_por_defecto                                         = 'manual';
    /* ----------------------------------------------------------------------------------------------------------/ */
    $datos_data_info_factura = "SELECT * FROM tbl15_info_factura_venta WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
    $consulta_data_info_factura = mysqli_query($conectar, $datos_data_info_factura) or die(mysqli_error($conectar));
    $data_info_factura = mysqli_fetch_assoc($consulta_data_info_factura);

    $cod_info_factura_venta                                         = $data_info_factura['cod_info_factura_venta'];
    $cod_factura                                                    = $data_info_factura['cod_factura'];
    $cod_tercero                                                    = $data_info_factura['cod_tercero'];
    $fecha_ini                                                      = $data_info_factura['fecha_ini'];
    $fecha_fin                                                      = $data_info_factura['fecha_fin'];
    $cod_empresa                                                    = $data_info_factura['cod_empresa'];
    $nombre_empresa                                                 = $data_info_factura['nombre_empresa'];
    $razonsocial_empresa                                            = $data_info_factura['razonsocial_empresa'];
    $total_motivo                                                   = $data_info_factura['total_motivo'];
    $total_muestra                                                  = $data_info_factura['total_muestra'];
    $fecha_ymdhis                                                   = $data_info_factura['fecha_ymdhis'];
    $cuenta                                                         = $data_info_factura['cuenta'];
    $cod_estado_factura                                             = $data_info_factura['cod_estado_factura'];
    $cod_base_caja                                                  = $data_info_factura['cod_base_caja'];
    $descuento_ptj                                                  = $data_info_factura['descuento_ptj'];
    $iva_ptj                                                        = $data_info_factura['iva_ptj'];
    $flete_ptj                                                      = $data_info_factura['flete_ptj'];
    $cod_cliente                                                    = $data_info_factura['cod_cliente'];
    $vlr_cancelado                                                  = $data_info_factura['vlr_cancelado'];
    $vlr_vuelto                                                     = $data_info_factura['vlr_vuelto'];
    $fecha_dia                                                      = $data_info_factura['fecha_dia'];
    $fecha_mes                                                      = $data_info_factura['fecha_mes'];
    $fecha_anyo                                                     = $data_info_factura['fecha_anyo'];
    $anyo                                                           = $data_info_factura['anyo'];
    $fecha_hora                                                     = $data_info_factura['fecha_hora'];
    $fecha_remision                                                 = $data_info_factura['fecha_remision'];
    $nombre_ccosto                                                  = $data_info_factura['nombre_ccosto'];
    $garantia_meses                                                 = $data_info_factura['garantia_meses'];
    $observacion                                                    = $data_info_factura['observacion'];
    $cod_tipo_pago                                                  = $data_info_factura['cod_tipo_pago'];
    $cod_administrador                                              = $data_info_factura['cod_administrador'];
    $nombre_tipo_producto                                           = $data_info_factura['nombre_tipo_producto'];
    $total_precio_compra                                            = $data_info_factura['total_precio_compra'];
    $total_precio_venta                                             = $data_info_factura['total_precio_venta'];
    $cod_dependencia                                                = $data_info_factura['cod_dependencia'];
    $servicio                                                       = $data_info_factura['servicio'];
    $cod_tipo_forma_pago                                            = $data_info_factura['cod_tipo_forma_pago'];
    $nombre_tipo_forma_pago                                         = $data_info_factura['nombre_tipo_forma_pago'];
    $descripcion_tipo_forma_pago                                    = $data_info_factura['descripcion_tipo_forma_pago'];
    $nombre_tipo_factura                                            = $data_info_factura['nombre_tipo_factura'];
    $nombre_tipo_moneda                                             = $data_info_factura['nombre_tipo_moneda'];
    $cod_cierre_caja                                                = $data_info_factura['cod_cierre_caja'];
    $fecha_creacion                                                 = $data_info_factura['fecha_creacion'];
    $fecha_modificacion                                             = $data_info_factura['fecha_modificacion'];
    $nombre_maquina                                                 = $data_info_factura['nombre_maquina'];
    $cod_tipo_cobrar                                                = $data_info_factura['cod_tipo_cobrar'];
    $cod_estado_vacuna                                              = $data_info_factura['cod_estado_vacuna'];
    $cod_resolucion_facturacion                                     = $data_info_factura['cod_resolucion_facturacion'];
    $cod_tipo_inventario                                            = $data_info_factura['cod_tipo_inventario'];
    $observacion_tercero                                            = $data_info_factura['observacion_tercero'];
    $cod_tipo_metodo_envio                                          = $data_info_factura['cod_tipo_metodo_envio'];
    $nombre1_tercero_ext                                            = $data_info_factura['nombre1_tercero'];
    $nombre_factura_remision                                        = $data_info_factura['nombre_factura_remision'];
    $nombre_tipo_pendiente                                          = $data_info_factura['nombre_tipo_pendiente'];
    $descripcion_tipo_pendiente                                     = $data_info_factura['descripcion_tipo_pendiente'];
    $fecha_entrega                                                  = $data_info_factura['fecha_entrega'];
    $hora_entrega                                                   = $data_info_factura['hora_entrega'];
    $nombre_elaboro                                                 = $data_info_factura['nombre_elaboro'];
    $fecha_pago                                                     = $data_info_factura['fecha_pago'];
    $cod_domiciliario                                               = $data_info_factura['cod_domiciliario'];
    $cod_puc                                                        = $data_info_factura['cod_puc'];
    $cod_sino_crear_mov_contable                                    = $data_info_factura['cod_sino_crear_mov_contable'];
    $cod_puntos_redimibles_campanya                                 = $data_info_factura['cod_puntos_redimibles_campanya'];
    $cod_movimiento_contable_cuenta_personal                        = $data_info_factura['cod_movimiento_contable_cuenta_personal'];
    $cod_movimiento_caja                                            = $data_info_factura['cod_movimiento_caja'];
    $retefuente_ptj                                                 = $data_info_factura['retefuente_ptj'];
    $reteica_ptj                                                    = $data_info_factura['reteica_ptj'];
    $reteiva_ptj                                                    = $data_info_factura['reteiva_ptj'];
    $cod_estado_alquiler_renta                                      = $data_info_factura['cod_estado_alquiler_renta'];
    $fecha_ini_renta_alquiler                                       = $data_info_factura['fecha_ini_renta_alquiler'];
    $fecha_fin_renta_alquiler                                       = $data_info_factura['fecha_fin_renta_alquiler'];
    $cod_info_factura_strpad                                        = str_pad($cod_info_factura_venta, 6, "0", STR_PAD_LEFT);

    $monto_deuda                                                    = $data_info_factura['monto_deuda'];
    $monto_cuota                                                    = $data_info_factura['monto_cuota'];
    $numero_cuota                                                   = $data_info_factura['numero_cuota'];
    $nombre_tipo_cobro                                              = $data_info_factura['nombre_tipo_cobro'];
    $cod_tercero                                                    = $data_info_factura['cod_tercero'];
    $cod_factura                                                    = $data_info_factura['cod_factura'];
    $direccion_tercero                                              = $data_info_factura['direccion_tercero'];
    $telefono1_tercero                                              = $data_info_factura['telefono1_tercero'];
    $identificacion_tercero                                         = $data_info_factura['identificacion_tercero'];
    $nombre_tipo_cobro                                              = $data_info_factura['nombre_tipo_cobro'];
    $correo_tercero                                                 = $data_info_factura['correo_tercero'];
    $nombre_estado_factura                                          = $data_info_factura['nombre_estado_factura'];
    $cuenta                                                         = $data_info_factura['cuenta'];
    $cod_caja_virtual                                               = $data_info_factura['cod_caja_virtual'];
    $cod_entidad_crediticia                                         = $data_info_factura['cod_entidad_crediticia'];
    $cod_tienda                                                     = $data_info_factura['cod_tienda'];
    $cod_operador_credito                                           = $data_info_factura['cod_operador_credito'];
    $cod_tipo_forma_pago_operador_credito                           = $data_info_factura['cod_tipo_forma_pago_operador_credito'];
    $descripcion_tipo_forma_pago_operador_credito                   = $data_info_factura['descripcion_tipo_forma_pago_operador_credito'];
    $nombre_modulo_puc                                              = "";
    /* ----------------------------------------------------------------------------------------------------------/ */
    $sql_entidad_crediticia = "SELECT * FROM tbl15_entidad_crediticia WHERE (cod_entidad_crediticia = '$cod_entidad_crediticia')";
    $consulta_entidad_crediticia = mysqli_query($conectar, $sql_entidad_crediticia) or die(mysqli_error($conectar));
    $datos_entidad_crediticia = mysqli_fetch_assoc($consulta_entidad_crediticia);

    $nombre_entidad_crediticia                                      = $datos_entidad_crediticia['nombre_entidad_crediticia'];
    /* ----------------------------------------------------------------------------------------------------------/ */
    $sql_tienda = "SELECT * FROM tbl15_tienda WHERE (cod_tienda = '$cod_tienda')";
    $consulta_tienda = mysqli_query($conectar, $sql_tienda) or die(mysqli_error($conectar));
    $datos_tienda = mysqli_fetch_assoc($consulta_tienda);

    $nombre_tienda                                      = $datos_tienda['nombre_tienda'];
    /* ----------------------------------------------------------------------------------------------------------/ */
    $sql_operador_credito = "SELECT * FROM tbl15_operador_credito WHERE (cod_operador_credito = '$cod_operador_credito')";
    $consulta_operador_credito = mysqli_query($conectar, $sql_operador_credito) or die(mysqli_error($conectar));
    $datos_operador_credito = mysqli_fetch_assoc($consulta_operador_credito);

    $nombre_operador_credito                                      = $datos_operador_credito['nombre_operador_credito'];
    /* ----------------------------------------------------------------------------------------------------------/ */
    $sql_venta_producto_temporal = "SELECT * FROM tbl15_venta_producto_temporal WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
    $consulta_venta_producto_temporal = mysqli_query($conectar, $sql_venta_producto_temporal) or die(mysqli_error($conectar));
    $datos_venta_producto_temporal = mysqli_fetch_assoc($consulta_venta_producto_temporal);

    $cod_producto_barra                                             = $datos_venta_producto_temporal['cod_producto_barra'];
    $nombre_producto                                                = $datos_venta_producto_temporal['nombre_producto'];
    /* ----------------------------------------------------------------------------------------------------------/ */
    $datos_data_info_factura = "SELECT * FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
    $consulta_data_info_factura = mysqli_query($conectar, $datos_data_info_factura);
    $data_info_factura = mysqli_fetch_assoc($consulta_data_info_factura);
    $factura_ocupada = mysqli_num_rows($consulta_data_info_factura);

    $identificacion_tercero                                         = $data_info_factura['identificacion_tercero'];
    $nombre1_tercero                                                = $data_info_factura['nombre1_tercero'];
    $nombre2_tercero                                                = $data_info_factura['nombre2_tercero'];
    $apellido1_tercero                                              = $data_info_factura['apellido1_tercero'];
    $apellido2_tercero                                              = $data_info_factura['apellido2_tercero'];
    $nombre_cliente                                                 = trim($nombre1_tercero.' '.$nombre2_tercero.' '.$apellido1_tercero.' '.$apellido2_tercero).' - '.$identificacion_tercero;
    /* ----------------------------------------------------------------------------------------------------------/ */
    $sql_venta_producto_temporal = "SELECT * FROM tbl15_venta_producto_temporal WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
    $consulta_venta_producto_temporal = mysqli_query($conectar, $sql_venta_producto_temporal) or die(mysqli_error($conectar));
    $datos_venta_producto_temporal = mysqli_fetch_assoc($consulta_venta_producto_temporal);

    $cod_producto_barra                                             = $datos_venta_producto_temporal['cod_producto_barra'];
    $nombre_producto                                                = $datos_venta_producto_temporal['nombre_producto'];


    $suma_temporal = "SELECT Sum(total_venta_producto) As total_precio_venta_info, Sum(total_costo_producto) As total_compra, Sum(peso_producto * und_venta) As total_peso_producto, 
    Count(cod_venta_producto_temporal) As total_art_temp FROM tbl15_venta_producto_temporal WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
    $consulta_temporal = mysqli_query($conectar, $suma_temporal);
    $matriz_temporal = mysqli_fetch_assoc($consulta_temporal);

    $total_precio_venta_info      = $matriz_temporal['total_precio_venta_info'];
    $total_venta                  = $matriz_temporal['total_precio_venta_info'];
    $total_peso_producto          = $matriz_temporal['total_peso_producto'];
    $total_art_temp               = $matriz_temporal['total_art_temp'];
?>

<script language="javascript">
$(document).ready(function(){
    $("#fecha_anyo").on('change', function () {
            var valor = $(this).val();
            var campo = "fecha_anyo";
            var tipo_ajax = "tbl15_info_factura_venta";
            $.post("guardar_info_factura_y_venta_producto_temporal_siscredito_visitante_intern_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, nombre_modulo_puc:"<?php echo $nombre_modulo_puc; ?>", id:<?php echo $cod_info_factura_venta; ?> }, function(data){
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
            $.post("guardar_info_factura_y_venta_producto_temporal_siscredito_visitante_intern_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, nombre_modulo_puc:"<?php echo $nombre_modulo_puc; ?>", id:<?php echo $cod_info_factura_venta; ?> }, function(data){
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
            $.post("guardar_info_factura_y_venta_producto_temporal_siscredito_visitante_intern_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, nombre_modulo_puc:"<?php echo $nombre_modulo_puc; ?>", id:<?php echo $cod_info_factura_venta; ?> }, function(data){
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
            $.post("guardar_info_factura_y_venta_producto_temporal_siscredito_visitante_intern_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, nombre_modulo_puc:"<?php echo $nombre_modulo_puc; ?>", id:<?php echo $cod_info_factura_venta; ?> }, function(data){
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
            $.post("guardar_info_factura_y_venta_producto_temporal_siscredito_visitante_intern_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, nombre_modulo_puc:"<?php echo $nombre_modulo_puc; ?>", id:<?php echo $cod_info_factura_venta; ?> }, function(data){
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
            $.post("guardar_info_factura_y_venta_producto_temporal_siscredito_visitante_intern_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, nombre_modulo_puc:"<?php echo $nombre_modulo_puc; ?>", id:<?php echo $cod_info_factura_venta; ?> }, function(data){
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
            url: "../admin/guardar_info_factura_y_venta_producto_temporal_siscredito_visitante_intern_ajax.php",
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
            $.post("guardar_info_factura_y_venta_producto_temporal_siscredito_visitante_intern_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, nombre_modulo_puc:"<?php echo $nombre_modulo_puc; ?>", id:<?php echo $cod_info_factura_venta; ?> }, function(data){
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
            $.post("guardar_info_factura_y_venta_producto_temporal_siscredito_visitante_intern_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, nombre_modulo_puc:"<?php echo $nombre_modulo_puc; ?>", id:<?php echo $cod_info_factura_venta; ?> }, function(data){
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
            $.post("guardar_info_factura_y_venta_producto_temporal_siscredito_visitante_intern_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, nombre_modulo_puc:"<?php echo $nombre_modulo_puc; ?>", id:<?php echo $cod_info_factura_venta; ?> }, function(data){
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
            $.post("guardar_info_factura_y_venta_producto_temporal_siscredito_visitante_intern_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, nombre_modulo_puc:"<?php echo $nombre_modulo_puc; ?>", id:<?php echo $cod_info_factura_venta; ?> }, function(data){
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
            url: "../admin/guardar_info_factura_y_venta_producto_temporal_siscredito_visitante_intern_ajax.php",
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
            url: "../admin/guardar_info_factura_y_venta_producto_temporal_siscredito_visitante_intern_ajax.php",
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

        console.log("id atrib class = "+id);
        console.log("id atrib class = "+id);

        var nombre_campo_incre = $(this).attr("id");
        let framentador_nombre = nombre_campo_incre.split("und_venta");
        var nombre_campo = framentador_nombre[0];
        var increm = framentador_nombre[1];

        var datos_url_ajax = 'valor='+valor+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'id='+id+'&'+'foco='+foco+'&'+'nombre_campo_incre='+nombre_campo_incre;

        $.ajax({
            type: "POST",
            url: "../admin/guardar_info_factura_y_venta_producto_temporal_siscredito_visitante_intern_ajax.php",
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
            url: "../admin/guardar_info_factura_y_venta_producto_temporal_siscredito_visitante_intern_ajax.php",
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
            $.post("guardar_info_factura_y_venta_producto_temporal_siscredito_visitante_intern_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, nombre_modulo_puc:"<?php echo $nombre_modulo_puc; ?>", id:<?php echo $cod_info_factura_venta; ?> }, function(data){
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
            $.post("guardar_info_factura_y_venta_producto_temporal_siscredito_visitante_intern_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, nombre_modulo_puc:"<?php echo $nombre_modulo_puc; ?>", id:<?php echo $cod_info_factura_venta; ?> }, function(data){
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
            $.post("guardar_info_factura_y_venta_producto_temporal_siscredito_visitante_intern_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:id }, function(data){
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
            $.post("guardar_info_factura_y_venta_producto_temporal_siscredito_visitante_intern_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:id }, function(data){
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

        $.post("guardar_info_factura_y_venta_producto_temporal_siscredito_visitante_intern_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, nombre_modulo_puc:"<?php echo $nombre_modulo_puc; ?>", id:<?php echo $cod_info_factura_venta; ?> }, function(data){
            $("#modelo").html(data);
            window.location.href = pagina_local;
        });
   });
});
</script>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!--
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
-->
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script language="javascript">
$(document).ready(function(){
    $("#cod_tipo_forma_pago").on('change', function () {
        var valor = $(this).val();
        var campo = "cod_tipo_forma_pago";
        var tipo_ajax = "tbl15_info_factura_venta";
        var pagina_local = "<?php echo $pagina_local;?>";

        $.post("guardar_info_factura_y_venta_producto_temporal_siscredito_visitante_intern_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, nombre_modulo_puc:"<?php echo $nombre_modulo_puc; ?>", id:<?php echo $cod_info_factura_venta; ?> }, function(data){
            $("#modelo").html(data);

            window.location.href = pagina_local;
        });
   });
});
</script>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!--
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
-->
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script language="javascript">
$(document).ready(function(){
    $("#cod_resolucion_facturacion").on('change', function () {
        var valor = $(this).val();
        var campo = "cod_resolucion_facturacion";
        var tipo_ajax = "tbl15_info_factura_venta";
        var pagina_local = "<?php echo $pagina_local;?>";

        $.post("guardar_info_factura_y_venta_producto_temporal_siscredito_visitante_intern_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, nombre_modulo_puc:"<?php echo $nombre_modulo_puc; ?>", id:<?php echo $cod_info_factura_venta; ?> }, function(data){
            //$("#modelo").html(data);
        });
   });
});
</script>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script language="javascript">
$(document).ready(function(){
    $("#cod_entidad_crediticia").on('change', function () {
        var valor = $(this).val();
        var campo = "cod_entidad_crediticia";
        var tipo_ajax = "tbl15_info_factura_venta";
        var pagina_local = "<?php echo $pagina_local;?>";

        $.post("guardar_info_factura_y_venta_producto_temporal_siscredito_visitante_intern_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, nombre_modulo_puc:"<?php echo $nombre_modulo_puc; ?>", id:<?php echo $cod_info_factura_venta; ?> }, function(data){
            //$("#modelo").html(data);
        });
   });
});
</script>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script language="javascript">
$(document).ready(function(){
    $("#cod_tienda").on('change', function () {
        var valor = $(this).val();
        var campo = "cod_tienda";
        var tipo_ajax = "tbl15_info_factura_venta";
        var pagina_local = "<?php echo $pagina_local;?>";

        $.post("guardar_info_factura_y_venta_producto_temporal_siscredito_visitante_intern_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, nombre_modulo_puc:"<?php echo $nombre_modulo_puc; ?>", id:<?php echo $cod_info_factura_venta; ?> }, function(data){
            //$("#modelo").html(data);
        });
   });
});
</script>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script language="javascript">
$(document).ready(function(){
    $("#cod_operador_credito").on('change', function () {
        var valor = $(this).val();
        var campo = "cod_operador_credito";
        var tipo_ajax = "tbl15_info_factura_venta";
        var pagina_local = "<?php echo $pagina_local;?>";

        $.post("guardar_info_factura_y_venta_producto_temporal_siscredito_visitante_intern_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, nombre_modulo_puc:"<?php echo $nombre_modulo_puc; ?>", id:<?php echo $cod_info_factura_venta; ?> }, function(data){
            //$("#modelo").html(data);
        });
   });
});
</script>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script language="javascript">
$(document).ready(function(){
    $("#cod_tipo_forma_pago_operador_credito").on('change', function () {
        var valor = $(this).val();
        var campo = "cod_tipo_forma_pago_operador_credito";
        var tipo_ajax = "tbl15_info_factura_venta";
        var pagina_local = "<?php echo $pagina_local;?>";

        $.post("guardar_info_factura_y_venta_producto_temporal_siscredito_visitante_intern_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, nombre_modulo_puc:"<?php echo $nombre_modulo_puc; ?>", id:<?php echo $cod_info_factura_venta; ?> }, function(data){
            //$("#modelo").html(data);
        });
   });
});
</script>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- Start Cart -->
    <div class="cart-box-main">
        <div class="container">
            <div class="col-sm-12 col-lg-12 mb-12">
                <div class="checkout-address">
                    <div class="mb-12">
                        <div class="title-left">
                            <h3>Factura de Venta</h3>
                        </div>
                    </div>
                 </div>
            </div>
        </div>
    </div>

    <div class="">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="contact-form-right">
                        <form action="../admin/reg_siscredito_tercero_cliente_simulador_por_cuotas_max_entidad_crediticia_reg.php" method="post" id="contactForm">
                            <div class="row">

                                <div class="col-md-2">
                                    <div class="form-group"><strong>Fecha</strong>
                                        <input type="date" class="form-control" id="fecha_anyo" name="fecha_anyo" value="<?php echo $fecha_anyo ?>" required/>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group"><strong>Vendedor</strong>
                                        <select name="cod_administrador" id="cod_administrador" class="form-control" data-show-subtext="true" data-live-search="true" tabindex="1" required>
                                            <?php if (isset($cod_administrador)) { echo ""; } else { echo ""; }
                                            $consulta2_sql = "SELECT cod_administrador, cuenta FROM tbl15_administrador ORDER BY cod_administrador ASC";
                                            $consulta2 = mysqli_query($conectar, $consulta2_sql);
                                            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                                            if(isset($cod_administrador) AND $cod_administrador == $datos2['cod_administrador']) {
                                            $seleccionado = "selected"; } else { $seleccionado = ""; }
                                            $codigo = $datos2['cod_administrador'];
                                            $nombre = $datos2['cuenta'];
                                            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                                        </select>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group"><strong>Forma de Pago</strong>
                                        <select name="cod_tipo_forma_pago" id="cod_tipo_forma_pago" class="form-control" data-show-subtext="true" data-live-search="true" tabindex="1" required>
                                            <?php if (isset($cod_tipo_forma_pago)) { echo "<option value='' selected ></option>"; } else { echo "<option value='' selected ></option>"; }
                                            $consulta2_sql = "SELECT cod_tipo_forma_pago, nombre_tipo_forma_pago FROM tbl15_tipo_forma_pago WHERE (cod_estado = '1') ORDER BY cod_tipo_forma_pago ASC";
                                            $consulta2 = mysqli_query($conectar, $consulta2_sql);
                                            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                                            if(isset($cod_tipo_forma_pago) AND $cod_tipo_forma_pago == $datos2['cod_tipo_forma_pago']) {
                                            $seleccionado = "selected"; } else { $seleccionado = ""; }
                                            $codigo = $datos2['cod_tipo_forma_pago'];
                                            $nombre = $datos2['nombre_tipo_forma_pago'];
                                            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                                        </select>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group"><strong>Tipo de Pago</strong>
                                        <select name="cod_tipo_pago" id="cod_tipo_pago" class="form-control" data-show-subtext="true" data-live-search="true" tabindex="1" required>
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
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>


                                <div class="col-md-2">
                                    <div class="form-group"><strong>Cliente / Comprador</strong>
                                        <br><?php echo $nombre_cliente ?>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group"><strong>Tienda</strong>
                                        <br><?php echo $nombre_tienda ?>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group"><strong>Linea de Credito</strong>
                                        <br><?php echo $nombre_entidad_crediticia ?>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group"><strong>Operador del Credito</strong>
                                        <select name="cod_operador_credito" id="cod_operador_credito" class="form-control" data-show-subtext="true" data-live-search="true" tabindex="1" required>
                                            <?php if (isset($cod_operador_credito)) { echo "<option value='' selected ></option>"; } else { echo "<option value='' selected ></option>"; }
                                            $consulta2_sql = "SELECT cod_operador_credito, nombre_operador_credito FROM tbl15_operador_credito ORDER BY cod_operador_credito ASC";
                                            $consulta2 = mysqli_query($conectar, $consulta2_sql);
                                            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                                            if(isset($cod_operador_credito) AND $cod_operador_credito == $datos2['cod_operador_credito']) {
                                            $seleccionado = "selected"; } else { $seleccionado = ""; }
                                            $codigo = $datos2['cod_operador_credito'];
                                            $nombre = $datos2['nombre_operador_credito'];
                                            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                                        </select>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group"><strong>Medio de Pago Credito</strong>
                                        <select name="cod_tipo_forma_pago_operador_credito" id="cod_tipo_forma_pago_operador_credito" class="form-control" data-show-subtext="true" data-live-search="true" tabindex="1" required>
                                            <?php if (isset($cod_tipo_forma_pago_operador_credito)) { echo "<option value='' selected ></option>"; } else { echo "<option value='' selected ></option>"; }
                                            $consulta2_sql = "SELECT cod_tipo_forma_pago, nombre_tipo_forma_pago FROM tbl15_tipo_forma_pago WHERE (cod_estado = '1') ORDER BY cod_tipo_forma_pago ASC";
                                            $consulta2 = mysqli_query($conectar, $consulta2_sql);
                                            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                                            if(isset($cod_tipo_forma_pago_operador_credito) AND $cod_tipo_forma_pago_operador_credito == $datos2['cod_tipo_forma_pago']) {
                                            $seleccionado = "selected"; } else { $seleccionado = ""; }
                                            $codigo = $datos2['cod_tipo_forma_pago'];
                                            $nombre = $datos2['nombre_tipo_forma_pago'];
                                            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                                        </select>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group"><strong>Observaciones</strong>
                                        <textarea class="form-control" name="observacion_tercero" id="observacion_tercero" placeholder="" rows="2" cols="5"><?php echo $observacion_tercero ?></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group"><strong>Detalle del Credito</strong>
                                        <br>Cuota: <?php echo number_format($monto_cuota, 0, ",", "."); ?>
                                        <br>Numero de Cuotas: <?php echo $numero_cuota.' '.$nombre_tipo_cobro; ?>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group"><strong>Total Factura</strong>
                                        <br><?php echo number_format($total_venta, 0, ",", "."); ?>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <hr>

                                <div class="col-md-12 col-lg-12">
                                    <div class="odr-box">
                                        <div class="title-left">
                                            <h3>Productos en compras</h3>
                                        </div>
                                        <div class="rounded p-2 bg-light">
        <?php
        //----------------------------------------------------------------------------------------------------------------------------------//
        //----------------------------------------------------------------------------------------------------------------------------------//
        $conteo = 0;
        $incre = 0;

        if ($nombre_estado_factura == 'ABIERTA') { $tabla_productos_venta = 'tbl15_venta_producto_temporal'; } else { $tabla_productos_venta = 'tbl15_venta_producto'; }

        $sql_venta_producto_temporal = "SELECT * FROM tbl15_venta_producto_temporal WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
        $consulta_venta_producto_temporal = mysqli_query($conectar, $sql_venta_producto_temporal) or die(mysqli_error($conectar));
        while ($datos_venta_producto_temporal = mysqli_fetch_assoc($consulta_venta_producto_temporal)) {

            $cod_venta_producto_temporal                                    = $datos_venta_producto_temporal['cod_venta_producto_temporal'];
            $cod_producto_barra                                             = $datos_venta_producto_temporal['cod_producto_barra'];
            $nombre_producto                                                = $datos_venta_producto_temporal['nombre_producto'];
            $precio_venta_producto                                          = $datos_venta_producto_temporal['precio_venta_producto'];
            $und_venta                                                      = $datos_venta_producto_temporal['und_venta'];
            $serial1_producto                                               = $datos_venta_producto_temporal['serial1_producto'];
            $serial2_producto                                               = $datos_venta_producto_temporal['serial2_producto'];
            $incre++;
        ?>
                                            <div class="media mb-2 border-bottom">
                                                <div class="media-body"> <a href="detail.html"> <?php echo $nombre_producto ?></a>
                                                    <!--<div class="small text-muted">Precio: $<?php echo number_format($precio_venta_producto, 0, ",", ".") ?> <span class="mx-2">|</span> Cant: <?php echo $und_venta ?> <span class="mx-2">|</span> Total: $<?php echo number_format($precio_venta_producto, 0, ",", ".") ?></div>-->
                                                    <div class="small text-muted">
                                                        <span class="mx-2">
                                                        Imei 1: <input type="text" name="serial1_producto" id="serial1_producto<?php echo $incre;?>" class="<?php echo $cod_venta_producto_temporal;?>" value="<?php echo $serial1_producto ?>">
                                                        Imei 2: <input type="text" name="serial2_producto" id="serial2_producto<?php echo $incre;?>" class="<?php echo $cod_venta_producto_temporal;?>" value="<?php echo $serial2_producto ?>">
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
        <!--<input type="hidden" name="cod_carrito_compra_temporal[]" value="<?php echo $cod_carrito_compra_temporal;?>">-->
        <?php } ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 col-lg-12">
                                    <div class="order-box">
                                        <div class="title-left">
                                            <h3>Su orden</h3>
                                        </div>
                                        <hr class="my-1">
                                        <div class="d-flex">
                                            <h4>SubTotal</h4>
                                            <div class="ml-auto font-weight-bold"> $ <?php echo number_format($total_venta, 0, ",", ".") ?> </div>
                                        </div>
                                        <hr>
                                        <div class="d-flex gr-total">
                                            <h5>Total</h5>
                                            <div class="ml-auto h5"> $ <?php echo number_format($total_venta, 0, ",", ".") ?> </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <a href="<?php echo $pagina ?>" class="btn hvr-hover btn-lg btn-block" id="submit" type="submit"><div id="nombre_boton_accion">Guardar Cambios</div></a>
                                        <!--<button class="btn hvr-hover btn-lg btn-block" id="submit" type="submit"><div id="nombre_boton_accion">Crear Registro</div></button>-->
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>






<?php } ?>

    <!-- End Cart -->

<?php //include_once("../admin/09_modulo_footer_visitante_intern.php"); ?>

<?php include_once("../admin/10_modulo_js_visitante_intern_sin_jquery.php"); ?>

</body>
</html>
