<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include_once("../admin/01_modulo_diseno_superior_version_tactil.php"); ?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include_once("../admin/01_info_empresa_version_tactil.php"); ?>
<?php include_once("../admin/01_modulo_permisos.php"); ?>
<!-- **************************************************** MODULO DE INFO EMPRESA ******************************************** -->
<?php
$nombre_pagina          = "Tienda Virtual";
$cod_seguridad_pag      = "1";
$pagina_local           = $_SERVER['PHP_SELF'];
?>
<?php //include_once("../admin/01_rastreador.php"); ?>

<!DOCTYPE html>
<html lang="es">
<!-- Basic -->
<head>
<title><?php echo ($nombre_pagina) ?> - <?php echo ($titulo) ?></title>
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
<meta property="og:site_name"          content="<?php echo $nombre_emp ?>"/>
<meta property="fb:admins"             content="editaxe"/>
<meta name="twitter:card"              content="<?php echo $nombre_pagina ?>">
<meta name="twitter:url"               contnet="<?php echo $pagina_local ?>">
<meta name="twitter:title"             content="<?php echo $nombre_pagina ?>">
<meta name="twitter:description"       content="<?php echo $nombre_pagina ?>">
<meta name="twitter:image"             content="<?php echo ($url_pag) ?>/<?php echo ($nombre_carpeta_pagina) ?>/imagenes/quienes_somos.jpg">

<?php include_once("../admin/03_modulo_css_version_tactil.php"); ?>
<link rel="stylesheet" href="../estilo_css/font-awesome.min.css">
<link rel="stylesheet" href="../estilo_css/normalize_visitante.css">
<link rel="stylesheet" href="../estilo_css/facebook_messenger_flotante.css">
<link rel="stylesheet" href="../estilo_css/whatsapp_messenger_flotante.css">

<?php //include_once("../pixel_facebook_js/pixel_editaxe.php"); ?>
<script src="../js/jquery-3.2.1.min_visitante.js"></script>
<script type="text/javascript" src="js/jquery.number.js"></script>
<script type="text/javascript">
$(function(){
// Set up the number formatting.
$('#vlr_cancelado_number').on('change',function(){
//console.log('Change event.');
var vlr_cancelado_number = $('#vlr_cancelado_number').val();
$('#the_number').text( vlr_cancelado_number !== '' ? vlr_cancelado_number : '(empty)' );
});
//$('#vlr_cancelado').change(function(){ console.log('Second change event...'); });
$('#vlr_cancelado_number').number( true, 0 );

$("#vlr_cancelado_number").keyup(function () {
    var vlr_cancelado = $(this).val();
    $("#vlr_cancelado").val(vlr_cancelado);
});

});
</script>
</head>

<body>
    <!-- End Main Top -->
<?php //include_once("04_modulo_main_top_visitante.php"); ?>
    <!-- Start Main Top -->

<?php if (isset($_GET['buscador'])) { $buscador_get = addslashes($_GET['buscador']); } else { $buscador_get = ''; } ?>

<?php include_once("../seguridad/seguridad_diseno_plantillas_version_tactil.php"); ?>
    <!-- End Main Top -->
<?php //include_once("../admin/06_modulo_imagen_head_visitante.php"); ?>

<?php //include_once("../admin/04_modulo_titulo_pagina_visitante.php"); ?>

<?php //include_once("../admin/05_modulo_slider_visitante.php"); ?>

<?php
$pagina                              = $_SERVER['PHP_SELF'];
$pagina_local                        = $_SERVER['PHP_SELF'];

$tab                                 = "producto";
$tab_codif                           = DAXCODIFCRYPTOR::encodiftextodax($tab);
$tab_codifcryp                       = DAXCODIFCRYPTOR::encriptardax($tab_codif);

$campo                               = "cod_producto";
$campo_codif                         = DAXCODIFCRYPTOR::encodiftextodax($campo);
$campo_codifcryp                     = DAXCODIFCRYPTOR::encriptardax($campo_codif);

$tipo                                = "carrito";
$tipo_codif                          = DAXCODIFCRYPTOR::encodiftextodax($tipo);
$tipo_codifcryp                      = DAXCODIFCRYPTOR::encriptardax($tipo_codif);

$accion                              = "registrar";
$accion_codif                        = DAXCODIFCRYPTOR::encodiftextodax($accion);
$accion_codifcryp                    = DAXCODIFCRYPTOR::encriptardax($accion_codif);

$origen                              = "carrito";
$origen_codif                        = DAXCODIFCRYPTOR::encodiftextodax($origen);
$origen_codifcryp                    = DAXCODIFCRYPTOR::encriptardax($origen_codif);

$accion_whatapp                      = "redirecionar_whatapp";
$accion_whatapp_codif                = DAXCODIFCRYPTOR::encodiftextodax($accion_whatapp);
$accion_whatapp_codifcryp            = DAXCODIFCRYPTOR::encriptardax($accion_whatapp_codif);

$accion_telefono                     = "redirecionar_telefono";
$accion_telefono_codif               = DAXCODIFCRYPTOR::encodiftextodax($accion_telefono);
$accion_telefono_codifcryp           = DAXCODIFCRYPTOR::encriptardax($accion_telefono_codif);

$und_vendida                         = 1;
$und_vendida_codif                   = DAXCODIFCRYPTOR::encodifdax($und_vendida);
$und_vendida_codifcryp               = DAXCODIFCRYPTOR::encriptardax($und_vendida_codif);

$pagina                              = $_SERVER['PHP_SELF'];
$pagina_local                        = $_SERVER['PHP_SELF'];
$incre                               = 0;
$tab                                 = 'tbl15_venta_producto_temporal';
$campo                               = 'cod_venta_producto_temporal';
$tipo                                = 'eliminar';
$nombre_tipo_moneda                  = "COP";
$nombre_tipo_factura                 = "POS";
$cod_estado_vacuna                   = "0";

$time_seg                            = time();
$fecha                               = date("Ymd");
$hora                                = date("His");

$sql_info_factura_venta = "SELECT cod_info_factura_venta, cod_base_caja, cod_tipo_inventario, fecha_anyo, cod_administrador, cod_tipo_metodo_envio, 
nombre_tipo_moneda, nombre_tipo_factura, cod_tipo_forma_pago, descripcion_tipo_forma_pago, cod_tipo_pago, cod_tercero, observacion_tercero 
FROM tbl15_info_factura_venta WHERE (nombre_estado_factura = 'ABIERTA') AND (cuenta = '$cuenta_actual') AND (cod_caja_virtual = '$cod_caja_virtual')";
$consulta_info_factura_venta = mysqli_query($conectar, $sql_info_factura_venta) or die(mysqli_error($conectar));
$datos_info_factura_venta = mysqli_fetch_assoc($consulta_info_factura_venta);

$cod_info_factura_venta              = $datos_info_factura_venta['cod_info_factura_venta'];
$cod_base_caja                       = $datos_info_factura_venta['cod_base_caja'];
$cod_tipo_inventario                 = $datos_info_factura_venta['cod_tipo_inventario'];
$fecha_anyo                          = $datos_info_factura_venta['fecha_anyo'];
$cod_administrador                   = $datos_info_factura_venta['cod_administrador'];
$cod_tipo_metodo_envio               = $datos_info_factura_venta['cod_tipo_metodo_envio'];
$nombre_tipo_moneda                  = $datos_info_factura_venta['nombre_tipo_moneda'];
$nombre_tipo_factura                 = $datos_info_factura_venta['nombre_tipo_factura'];
$cod_tipo_forma_pago                 = $datos_info_factura_venta['cod_tipo_forma_pago'];
$descripcion_tipo_forma_pago         = $datos_info_factura_venta['descripcion_tipo_forma_pago'];
$cod_tipo_pago                       = $datos_info_factura_venta['cod_tipo_pago'];
$cod_tercero                         = $datos_info_factura_venta['cod_tercero'];
$observacion_tercero                 = $datos_info_factura_venta['observacion_tercero'];
$cod_tipo_aplicacion                 = '3';

if (isset($_GET['cuenta'])) { $cuenta_actual = addslashes($_GET['cuenta']); } else { $cuenta_actual = $cuenta_actual; }
if (isset($_GET['cod_caja_virtual'])) { $cod_caja_virtual = addslashes($_GET['cod_caja_virtual']); } else { $cod_caja_virtual = $cod_caja_virtual; }
if (isset($_GET['cuenta'])) { $url_visit_user_extern = '?cuenta='.$cuenta_actual.'&cod_caja_virtual='.$cod_caja_virtual; } else { $url_visit_user_extern = ""; }
if (isset($_GET['foco'])) { $foco = addslashes($_GET['foco']); } else { $foco = 'busqueda'; }
if (isset($_GET['buscar_por'])) { $buscar_por = addslashes($_GET['buscar_por']); } else { $buscar_por = $nombre_buscar_por; }
if (isset($_GET['tipo_busqueda'])) { $tipo_busqueda = addslashes($_GET['tipo_busqueda']); } else { $tipo_busqueda = "todo"; }
if (isset($_GET['cod_estado_vacuna'])) { $cod_estado_vacuna = addslashes($_GET['cod_estado_vacuna']); } else { $cod_estado_vacuna = "0"; }
if (isset($_GET['nombre_tipo_factura'])) { $nombre_tipo_factura = addslashes($_GET['nombre_tipo_factura']); } else { $nombre_tipo_factura = "POS"; }
if (isset($_GET['nombre_tipo_moneda'])) { $nombre_tipo_moneda = addslashes($_GET['nombre_tipo_moneda']); } else { $nombre_tipo_moneda = "COP"; }

$datos_factura = "SELECT cod_venta_producto_temporal FROM tbl15_venta_producto_temporal WHERE (cuenta = '$cuenta_actual') AND (cod_caja_virtual = '$cod_caja_virtual')";
$consulta = mysqli_query($conectar, $datos_factura);
$total_datos = mysqli_num_rows($consulta);

if ($total_datos <> 0) {
$suma_temporal = "SELECT Sum(total_venta_producto) As total_venta, Sum(total_costo_producto) As total_compra, Sum(peso_producto * und_venta) As total_peso_producto 
FROM tbl15_venta_producto_temporal WHERE (cuenta = '$cuenta_actual') AND (cod_caja_virtual = '$cod_caja_virtual')";
$consulta_temporal = mysqli_query($conectar, $suma_temporal);
$matriz_temporal = mysqli_fetch_assoc($consulta_temporal);

$total_venta                 = $matriz_temporal['total_venta'];
$total_peso_producto         = $matriz_temporal['total_peso_producto'];

$datos_data_info_factura = "SELECT * FROM tbl15_info_factura_venta WHERE (nombre_estado_factura = 'ABIERTA') AND (cuenta = '$cuenta_actual') AND (cod_caja_virtual = '$cod_caja_virtual')";
$consulta_data_info_factura = mysqli_query($conectar, $datos_data_info_factura);
$data_info_factura = mysqli_fetch_assoc($consulta_data_info_factura);
$factura_ocupada = mysqli_num_rows($consulta_data_info_factura);

$cod_info_factura_venta      = $data_info_factura['cod_info_factura_venta'];
$cod_factura                 = $data_info_factura['cod_factura'];
$cod_tercero                 = $data_info_factura['cod_tercero'];
$cod_historia_clinica        = $data_info_factura['cod_historia_clinica'];
$fecha_ini                   = $data_info_factura['fecha_ini'];
$fecha_fin                   = $data_info_factura['fecha_fin'];
$cod_empresa                 = $data_info_factura['cod_empresa'];
$nombre_empresa              = $data_info_factura['nombre_empresa'];
$razonsocial_empresa         = $data_info_factura['razonsocial_empresa'];
$total_motivo                = $data_info_factura['total_motivo'];
$total_muestra               = $data_info_factura['total_muestra'];
$fecha_ymdhis                = $data_info_factura['fecha_ymdhis'];
$cuenta                      = $data_info_factura['cuenta'];
$cod_estado_factura          = $data_info_factura['cod_estado_factura'];
$cod_base_caja               = $data_info_factura['cod_base_caja'];
$descuento_ptj               = $data_info_factura['descuento_ptj'];
$iva_ptj                     = $data_info_factura['iva_ptj'];
$flete_ptj                   = $data_info_factura['flete_ptj'];
$cod_cliente                 = $data_info_factura['cod_cliente'];
$vlr_cancelado               = $data_info_factura['vlr_cancelado'];
$vlr_vuelto                  = $data_info_factura['vlr_vuelto'];
$fecha_dia                   = $data_info_factura['fecha_dia'];
$fecha_mes                   = $data_info_factura['fecha_mes'];
$fecha_anyo                  = $data_info_factura['fecha_anyo'];
$anyo                        = $data_info_factura['anyo'];
$fecha_hora                  = $data_info_factura['fecha_hora'];
$fecha_remision              = $data_info_factura['fecha_remision'];
$nombre_ccosto               = $data_info_factura['nombre_ccosto'];
$garantia_meses              = $data_info_factura['garantia_meses'];
$observacion                 = $data_info_factura['observacion'];
$cod_tipo_pago               = $data_info_factura['cod_tipo_pago'];
$cod_administrador           = $data_info_factura['cod_administrador'];
$nombre_tipo_producto        = $data_info_factura['nombre_tipo_producto'];
$total_precio_compra         = $data_info_factura['total_precio_compra'];
$total_precio_venta          = $data_info_factura['total_precio_venta'];
$cod_dependencia             = $data_info_factura['cod_dependencia'];
$servicio                    = $data_info_factura['servicio'];
$cod_tipo_forma_pago         = $data_info_factura['cod_tipo_forma_pago'];
$nombre_tipo_forma_pago      = $data_info_factura['nombre_tipo_forma_pago'];
$descripcion_tipo_forma_pago = $data_info_factura['descripcion_tipo_forma_pago'];
$nombre_tipo_factura         = $data_info_factura['nombre_tipo_factura'];
$nombre_tipo_moneda          = $data_info_factura['nombre_tipo_moneda'];
$cod_cierre_caja             = $data_info_factura['cod_cierre_caja'];
$fecha_creacion              = $data_info_factura['fecha_creacion'];
$fecha_modificacion          = $data_info_factura['fecha_modificacion'];
$nombre_maquina              = $data_info_factura['nombre_maquina'];
$cod_tipo_cobrar             = $data_info_factura['cod_tipo_cobrar'];
$cod_estado_vacuna           = $data_info_factura['cod_estado_vacuna'];
$cod_resolucion_facturacion  = $data_info_factura['cod_resolucion_facturacion'];
$cod_tipo_inventario         = $data_info_factura['cod_tipo_inventario'];
$observacion_tercero         = $data_info_factura['observacion_tercero'];
$cod_tipo_metodo_envio       = $data_info_factura['cod_tipo_metodo_envio'];
$nombre1_tercero_ext         = $data_info_factura['nombre1_tercero'];
$nombre_factura_remision     = $data_info_factura['nombre_factura_remision'];
$nombre_tipo_pendiente       = $data_info_factura['nombre_tipo_pendiente'];
$descripcion_tipo_pendiente  = $data_info_factura['descripcion_tipo_pendiente'];
$fecha_entrega               = $data_info_factura['fecha_entrega'];
$hora_entrega                = $data_info_factura['hora_entrega'];
$nombre_elaboro              = $data_info_factura['nombre_elaboro'];
$fecha_pago                  = $data_info_factura['fecha_pago'];


$cod_info_factura_strpad     = str_pad($cod_info_factura_venta, 6, "0", STR_PAD_LEFT);

$sql_user_vendedor = "SELECT nombres, apellidos FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador')";
$consulta_user_vendedor = mysqli_query($conectar, $sql_user_vendedor);
$matriz_user_vendedor = mysqli_fetch_assoc($consulta_user_vendedor);

$nombres_vendedor            = $matriz_user_vendedor['nombres'].' '.$matriz_user_vendedor['apellidos'];

$tab                         = 'tbl15_venta_producto_temporal';
$tipo                        = 'eliminar';
$campo                       = 'cod_venta_producto_temporal';

if ($cod_seguridad == '1') {
$condicion_inventario = 'cod_tipo_inventario = "1" OR cod_tipo_inventario = "2"';
$condicion_vendedor = '';
} else {
$condicion_inventario = 'cod_tipo_inventario = "1"';
$condicion_vendedor = 'WHERE cod_administrador = '.$cod_administrador;
}
?>
<script language="javascript">
$(document).ready(function(){
    $("#fecha_anyo").on('change', function () {
            var valor = $(this).val();
            var campo = "fecha_anyo";
            var tipo_ajax = "tbl15_info_factura_venta";
            $.post("guardar_info_factura_y_venta_producto_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_venta; ?> }, function(data){
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
            $.post("guardar_info_factura_y_venta_producto_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_venta; ?> }, function(data){
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
            $.post("guardar_info_factura_y_venta_producto_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_venta; ?> }, function(data){
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
            $.post("guardar_info_factura_y_venta_producto_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_venta; ?> }, function(data){
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
            $.post("guardar_info_factura_y_venta_producto_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_venta; ?> }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>

<script language="javascript">
$(document).ready(function(){
    $("#cod_tipo_forma_pago").on('change', function () {
            var valor = $(this).val();
            var campo = "cod_tipo_forma_pago";
            var tipo_ajax = "tbl15_info_factura_venta";
            $.post("guardar_info_factura_y_venta_producto_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_venta; ?> }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>

<script language="javascript">
$(document).ready(function(){
    $("#cod_tipo_pago").on('change', function () {
            var valor = $(this).val();
            var campo = "cod_tipo_pago";
            var tipo_ajax = "tbl15_info_factura_venta";
            $.post("guardar_info_factura_y_venta_producto_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_venta; ?> }, function(data){
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
            $.post("guardar_info_factura_y_venta_producto_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_venta; ?> }, function(data){
                $("#modelo").html(data);
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
            $.post("guardar_info_factura_y_venta_producto_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_venta; ?> }, function(data){
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
            $.post("guardar_info_factura_y_venta_producto_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_venta; ?> }, function(data){
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
            $.post("guardar_info_factura_y_venta_producto_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_venta; ?> }, function(data){
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
            $.post("guardar_info_factura_y_venta_producto_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_venta; ?> }, function(data){
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
            $.post("guardar_info_factura_y_venta_producto_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_venta; ?> }, function(data){
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
            $.post("guardar_info_factura_y_venta_producto_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_venta; ?> }, function(data){
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

<?php } ?>

<?php //include_once("../admin/05_modulo_quienes_somos_y_equipo_visitante.php"); ?>

<?php //include_once("../admin/05_modulo_algunas_categorias_visitante.php"); ?>

<!-- Start Shop Page  -->
    <div class="shop-box-inner">
        <div class="container">
            <div class="row">
                
                <div class="col-xl-4 col-lg-4 col-sm-12 col-xs-12 sidebar-shop-left">
                    <div class="product-categori">
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
                        <div class="search-product">
                            <form method="GET" name="formulario2" action="../admin/reg_venta_temporal_producto_reg.php">
                            <!--
                                <select name="buscar_por" id="buscar_por" class="form-control">
                                    <?php if (isset($buscar_por)) { echo ""; } else { echo  "<option value='' selected >Selecione</option>"; }
                                    $consulta2_sql = ("SELECT cod_buscar_por, nombre_buscar_por, titulo_buscar_por FROM tbl15_buscar_por WHERE (cod_tipo_busqueda = '1') ORDER BY cod_buscar_por ASC");
                                    $consulta2 = mysqli_query($conectar, $consulta2_sql);
                                    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                                    if(isset($buscar_por) and $buscar_por == $datos2['nombre_buscar_por']) {
                                    $seleccionado = "selected"; } else { $seleccionado = ""; }
                                    $codigo = $datos2['nombre_buscar_por'];
                                    $nombre = $datos2['titulo_buscar_por'];
                                    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                                </select>
                            -->
                                <input type="text" name="cod_producto_barra" id="busqueda" value="<?php echo $buscador_get ?>" class="form-control" placeholder="Codigo de Barras" required>
                                <button type="submit"> <i class="fa fa-search"></i> </button>

                                <input type="hidden" name="buscar_por" value="cod_producto_barra">
                                <input type="hidden" name="nombre_tipo_moneda" value="<?php echo $nombre_tipo_moneda; ?>">
                                <input type="hidden" name="nombre_tipo_factura" value="<?php echo $nombre_tipo_factura; ?>">
                                <input type="hidden" name="foco" value="<?php echo $foco; ?>">
                                <input type="hidden" name="cod_estado_vacuna" value="1">
                                <input type="hidden" name="cuenta" value="<?php echo $cuenta_actual; ?>">
                                <input type="hidden" name="cod_caja_virtual" value="<?php echo $cod_caja_virtual; ?>">
                                <input type="hidden" name="pagina" value="<?php echo $pagina; ?>">
                                <input type="hidden" name="cod_tipo_aplicacion" value="<?php echo $cod_tipo_aplicacion; ?>">
                            </form>
                        </div>
<!-- ///////////////////////////////////////////////////////CARRITO COMPRA INI//////////////////////////////////////////////////////////////// -->
<?php
$conteo = 0;

$sql_producto_total = "SELECT SUM(und_venta * precio_venta_producto) as total_venta, nombre_producto FROM tbl15_venta_producto_temporal WHERE (cuenta = '$cuenta_actual') AND (cod_caja_virtual = '$cod_caja_virtual')";
$consulta_producto_total = mysqli_query($conectar, $sql_producto_total) or die(mysqli_error($conectar));
$datos_producto_total = mysqli_fetch_assoc($consulta_producto_total);

$total_venta              = $datos_producto_total['total_venta'];
?>
                <form method="POST" name="formulario" action="../admin/venta_producto_reg.php">
                    <div id="salida_info_actualizada_carrito_compra_ajax">
                        <div class="filter-sidebar-left">
                            <div class="title-left">
                                <h3><a href="#"><?php if ($total_datos <> '0') { ?><?php echo $nombre_concepto_multi_virtual ?> DE VENTA  [<?php echo $cod_base_caja ?>] - ID: <?php echo $cod_info_factura_venta ?><?php } ?></a></h3>
                            </div>

                            <div class="list-group list-group-collapse list-group-sm list-group-tree" id="list-group-men" data-children=".sub-men">
                                <div class="list-group-collapse sub-men">
                                    <div class="collapse show" id="sub-men1" data-parent="#list-group-men">
                                        <div class="list-group">

                                            <div class="col-md-12 col-lg-12">
                                                <div class="odr-box">
                                                    <div class="rounded p-2 bg-light" id="div_madre">
<?php
$sql_venta_producto_temporal = "SELECT * FROM tbl15_venta_producto_temporal WHERE (cuenta = '$cuenta_actual') AND (cod_caja_virtual = '$cod_caja_virtual') 
ORDER BY cod_venta_producto_temporal DESC";
$consulta_venta_producto_temporal = mysqli_query($conectar, $sql_venta_producto_temporal) or die(mysqli_error($conectar));
while ($datos_venta_producto_temporal = mysqli_fetch_assoc($consulta_venta_producto_temporal)) {

$conteo++;
$cod_venta_producto_temporal              = $datos_venta_producto_temporal['cod_venta_producto_temporal'];
$cod_venta_producto_temporal_codif        = DAXCODIFCRYPTOR::encodifdax($cod_venta_producto_temporal);
$cod_venta_producto_temporal_codifcryp    = DAXCODIFCRYPTOR::encriptardax($cod_venta_producto_temporal_codif);
$cod_producto                             = $datos_venta_producto_temporal['cod_producto'];
$cod_producto_barra                       = $datos_venta_producto_temporal['cod_producto_barra'];
$nombre_producto                          = $datos_venta_producto_temporal['nombre_producto'];
$cedula                                   = $datos_venta_producto_temporal['cedula'];
$nombre_cliente                           = $datos_venta_producto_temporal['nombre_cliente'];
$und_venta                                = $datos_venta_producto_temporal['und_venta'];
$precio_costo_producto                    = $datos_venta_producto_temporal['precio_costo_producto'];
$precio_compra_producto                   = $datos_venta_producto_temporal['precio_compra_producto'];
$total_costo_producto                     = $datos_venta_producto_temporal['total_costo_producto'];
$precio_venta_producto                    = $datos_venta_producto_temporal['precio_venta_producto'];
$total_venta_producto                     = $datos_venta_producto_temporal['total_venta_producto'];
///if ($cod_tipo_sistema_numeracion_und_compra == '2') { $und_compra = intval($und_compra); } else { $und_compra = $und_compra; }
if ($cod_tipo_sistema_numeracion_und_venta == '2') { $und_venta = intval($und_venta); } else { $und_venta = $und_venta; }
if ($cod_tipo_sistema_numeracion_precio_compra == '2') { $precio_compra_producto = intval($precio_compra_producto); } else { $precio_compra_producto = $precio_compra_producto; }
if ($cod_tipo_sistema_numeracion_precio_venta == '2') { $precio_venta_producto = intval($precio_venta_producto); } else { $precio_venta_producto = $precio_venta_producto; }
$nombre_tipo_producto                     = $datos_venta_producto_temporal['nombre_tipo_producto'];
$nombre_tipo_unidad_medida                = $datos_venta_producto_temporal['nombre_tipo_unidad_medida'];
$posologia_cantidad                       = $datos_venta_producto_temporal['posologia_cantidad'];
$posologia_peso                           = $datos_venta_producto_temporal['posologia_peso'];
$nombre_tipo_presentacion                 = $datos_venta_producto_temporal['nombre_tipo_presentacion'];
$nombre_via_administracion                = $datos_venta_producto_temporal['nombre_via_administracion'];
$nombre_frec_duracion                     = $datos_venta_producto_temporal['nombre_frec_duracion'];
$cod_tipo_cobrar                          = $datos_venta_producto_temporal['cod_tipo_cobrar'];
$cod_info_factura_venta                   = $datos_venta_producto_temporal['cod_info_factura_venta'];
$nombre_tipo_precio_venta                 = $datos_venta_producto_temporal['nombre_tipo_precio_venta'];
$cod_estado_permitir_venta                = $datos_venta_producto_temporal['cod_estado_permitir_venta'];
$und_producto                             = $datos_venta_producto_temporal['und_producto'];
$cajas_sobre                              = $datos_venta_producto_temporal['cajas_sobre'];
$und_sobre                                = $datos_venta_producto_temporal['und_sobre'];
$fecha_seg_venta_producto                 = $datos_venta_producto_temporal['fecha_seg_venta_producto'];
$hora_cargue                              = date("H:i:s", $fecha_seg_venta_producto);

$comentario_producto                      = $datos_venta_producto_temporal['comentario_producto'];
$placa_producto                           = $datos_venta_producto_temporal['placa_producto'];
$fecha_ymd_parqueo_ini                    = $datos_venta_producto_temporal['fecha_ymd_parqueo_ini'];
$fecha_hora_parqueo_ini                   = $datos_venta_producto_temporal['fecha_hora_parqueo_ini'];
$fecha_ymd_parqueo_fin                    = $datos_venta_producto_temporal['fecha_ymd_parqueo_fin'];
$fecha_hora_parqueo_fin                   = $datos_venta_producto_temporal['fecha_hora_parqueo_fin'];
$cod_estado_componente_und_venta          = $datos_venta_producto_temporal['cod_estado_componente_und_venta'];
$cod_estado_revisado                      = $datos_venta_producto_temporal['cod_estado_revisado'];
$peso_producto                            = $datos_venta_producto_temporal['peso_producto'];
$unidad_medida_peso                       = $datos_venta_producto_temporal['unidad_medida_peso'];
$cod_origen_produccion                    = $datos_venta_producto_temporal['cod_origen_produccion'];
$und_caja_sobre                           = $datos_venta_producto_temporal['und_caja_sobre'];
$nombre_tipo_und_caja_sobre               = $datos_venta_producto_temporal['nombre_tipo_und_caja_sobre'];

$fecha_seg_venta_producto                 = $datos_venta_producto_temporal['fecha_seg_venta_producto'];
$fecha_hora_venta_producto                = date("H:i", $fecha_seg_venta_producto);
$url_img_min_producto                     = $datos_venta_producto_temporal['url_img_min_producto'];
$url_img_orig_producto                    = $datos_venta_producto_temporal['url_img_orig_producto'];
$total_venta_ind                          = $und_venta * $precio_venta_producto;

if ($cod_estado_permitir_venta == 1) { $imagen = '<img src=../imagenes/incorrecto.png alt="Listo">'; } else { $imagen = '<img src=../imagenes/correctok.png alt="Listo">'; }
if ($cod_estado_venta_prod_en_cero_global == '1') { $max_und_venta = "max=".$und_producto; } else { $max_und_venta = ""; }
if ($cod_estado_venta_precio_min_venta_global == '1') { $min_precio_venta = "min=".$precio_compra_producto; } else { $min_precio_venta = ""; }
if ($cod_estado_revisado == '0') { $img_estado_revisado = "<img src=../imagenes/btn_revisado_no.gif>"; } else { $img_estado_revisado = "<img src=../imagenes/btn_revisado.gif>"; }

if ($nombre_tipo_und_caja_sobre == 'CAJA') { $img_caja = "../imagenes/und_caja_R.png"; } else { $img_caja = "../imagenes/und_caja.png"; }
if ($nombre_tipo_und_caja_sobre == 'SOBRE') { $img_sobre = "../imagenes/und_sobre_R.png"; } else { $img_sobre = "../imagenes/und_sobre.png"; }
if (($nombre_tipo_und_caja_sobre=='UND') || ($nombre_tipo_und_caja_sobre=='')) { $img_und = "../imagenes/und_und_R.png"; } else { $img_und = "../imagenes/und_und.png"; }
?>
                                                        <div id="productos_lista_temporal_venta">
                                                        <div class="media mb-2 border-bottom" id="elim<?php echo $cod_venta_producto_temporal ?>">
                                                             <div class="media-body"><?php if ($cod_estado_eliminar_caja_mesa_virtual == '1') { ?><a href="../admin/eliminar.php?llave=<?php echo $cod_venta_producto_temporal?>&tab=<?php echo $tab ?>&tipo=<?php echo $tipo ?>&campo=<?php echo $campo ?>&cuenta=<?php echo $cuenta ?>&cod_caja_virtual=<?php echo $cod_caja_virtual ?>&pagina=<?php echo $pagina_local ?>"><i class="fas fa-times"></i></a><?php } ?></a><span class="mx-2">|</span><a href="#"><?php echo $nombre_producto ?> | <?php echo $cod_producto_barra ?></a><span class="mx-2">|</span><?php echo $fecha_hora_venta_producto ?>
                                                            <!--<div class="media-body"><a class="eliminar" data="<?php echo $cod_venta_producto_temporal ?>" id="cod_venta_producto_temporal<?php echo $cod_venta_producto_temporal ?>"><i class="fas fa-times"></i></a><span class="mx-2">|</span><a href="#"><?php echo $nombre_producto ?> | <?php echo $cod_producto_barra ?></a><span class="mx-2">|</span><?php echo $fecha_hora_venta_producto ?>-->
                                                                <div class="small text-muted">Precio: $<?php echo number_format($precio_venta_producto, 0, ",", ".") ?><span class="mx-2">|</span>Cant: <?php echo $und_venta ?>|<?php echo $nombre_tipo_unidad_medida ?><span class="mx-2">|</span>Total: $<?php echo number_format($total_venta_ind, 0, ",", ".") ?></div>
                                                            </div>
                                                        </div>
                                                        </div>
<?php } ?>
                                                    </div>
                                                </div>
                                            </div>
    
                                            <?php if ($total_datos <> '0') { ?>
                                            <div id="mostrar_si_existe_registro">
                                            <div class="col-md-12 col-lg-12">
                                                <div class="order-box">
                                                    <div class="d-flex gr-total">
                                                        <h5>Total Venta</h5>
                                                        <div class="ml-auto h5" id="total_venta_tactil_ajax">$ <?php echo number_format($total_venta, 0, ",", ".") ?></div>
                                                    </div>
                                                    <div class="d-flex gr-total">
                                                        <h5>Recibido</h5>
                                                        <div class="ml-auto h5"><input type="text" name="vlr_cancelado_number" id="vlr_cancelado_number" value="" class="form-control" style="width: 190px; font-size:30px; height: 50px;" required></div>
                                                        <input type="hidden" name="vlr_cancelado" id="vlr_cancelado" value="">
                                                    </div>
                                                    <hr> 
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex shopping-box"><button type="submit" class="btn hvr-hover">Facturar Venta</button></div>
                                            </div>
                                            <?php } ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="cod_info_factura_venta" value="<?php echo $cod_info_factura_venta ?>">
                    <input type="hidden" name="cod_base_caja" value="<?php echo $cod_base_caja ?>">
                    <input type="hidden" name="cod_tipo_inventario" value="<?php echo $cod_tipo_inventario ?>">
                    <input type="hidden" name="fecha_anyo" value="<?php echo $fecha_anyo ?>">
                    <input type="hidden" name="cod_administrador" value="<?php echo $cod_administrador ?>">
                    <input type="hidden" name="cod_tipo_pago" value="<?php echo $cod_tipo_pago ?>">
                    <input type="hidden" name="cod_tipo_metodo_envio" value="<?php echo $cod_tipo_metodo_envio ?>">
                    <input type="hidden" name="nombre_tipo_moneda" value="<?php echo $nombre_tipo_moneda ?>">
                    <input type="hidden" name="nombre_tipo_factura" value="<?php echo $nombre_tipo_factura ?>">
                    <input type="hidden" name="cod_tipo_forma_pago" value="<?php echo $cod_tipo_forma_pago ?>">
                    <input type="hidden" name="descripcion_tipo_forma_pago" value="<?php echo $descripcion_tipo_forma_pago ?>">
                    <input type="hidden" name="cod_tercero" value="<?php echo $cod_tercero ?>">
                    <input type="hidden" name="observacion_tercero" value="<?php echo $observacion_tercero ?>">
                    <input type="hidden" name="total_datos" value="<?php echo $total_datos ?>">
                    <input type="hidden" name="pagina" value="<?php echo $pagina ?>">
                    <input type="hidden" name="flete" value="0" size="15">
                    <input type="hidden" name="verificacion_envio" value="1">
                    <input type="hidden" name="cod_estado_vacuna" value="0">
                </form>
<!-- ///////////////////////////////////////////////////////CARRITO COMPRA FIN//////////////////////////////////////////////////////////////// -->
                    </div>
                </div>

<!-- ///////////////////////////////////////////////////////PRODUCTOS IMAG MENU INI//////////////////////////////////////////////////////////////// -->
                    <div class="col-xl-8 col-lg-8 col-sm-12 col-xs-12 shop-content-right">
                        <div class="right-product-box">

                            <div class="row product-categorie-box">
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane fade show active" id="grid-view">
                                        <div class="row" id="salida_info_actualizada_productos_menu_imag_ajax">
<?php if ($cod_estado_venta_por_categoria_mod_venta_global == 1) { ?>

<?php if ($cod_estado_btn_categoria_desplegable_global == 1) { ?>
<table class="table table-striped">
    <th style="text-align:center"><a class="btn btn-success" data-toggle="collapse" href="#categorias_collapse" role="button" aria-expanded="false" aria-controls="collapseExample">Ver Categorias</a></th>
</table>
<div id="categorias_collapse" class="collapse">
<?php } ?>

    <table class="table table-striped">
        <tr>
        <?php 
        $smtr = 0;
        $mostrar_datos_sql = "SELECT * FROM tbl15_categoria ORDER BY cod_categoria ASC";
        $consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
        while ($matriz_consulta = mysqli_fetch_assoc($consulta)) {

        $cod_categoria      = $matriz_consulta['cod_categoria'];
        $nombre_categoria   = $matriz_consulta['nombre_categoria'];
        if ($smtr % 4 == 0) { echo "<tr></tr>"; }
        $smtr++; ?>
        <th style="text-align:center"><a href="<?php echo $pagina_local ?>?cod_categoria=<?php echo $cod_categoria?>&cuenta=<?php echo $cuenta_actual?>&cod_caja_virtual=<?php echo $cod_caja_virtual?>"><img src="../imagenes/categoria_producto.png"><br><?php echo $nombre_categoria; ?></a></th>
        <?php } ?>
        </tr>
    </table>
<?php if ($cod_estado_btn_categoria_desplegable_global == 1) { ?>
</div>
<?php } ?>


<?php if (isset($_GET['cod_categoria'])) { 

$cod_categoria                    = intval($_GET['cod_categoria']);

$sql_categoria = "SELECT nombre_categoria FROM tbl15_categoria WHERE (cod_categoria = '$cod_categoria') ORDER BY cod_categoria ASC";
$consulta_categoria = mysqli_query($conectar, $sql_categoria) or die(mysqli_error($conectar));
$matriz_categoria = mysqli_fetch_assoc($consulta_categoria);

$nombre_categoria                 = $matriz_categoria['nombre_categoria'];
?>
<table class="table table-striped">
<th style="text-align:center"><?php echo $nombre_categoria?></th>
</table>
<?php } ?>
<?php } ?>


    <?php
    if (isset($_GET['cod_categoria']) && ($_GET['cod_categoria'] <> '0')) { $cod_categoria = intval($_GET['cod_categoria']); $condicional_categoria = "AND (cod_categoria = '".$cod_categoria."')"; } else { $cod_categoria = 0; $condicional_categoria = ""; }

    if (isset($_GET['cod_categoria'])) {
    //$cod_categoria      = intval($_GET['cod_categoria']);
    //$cod_categoria_codif          = DAXCODIFCRYPTOR::descriptardax($cod_categoria);
    //$cod_categoria                = DAXCODIFCRYPTOR::descodiftextodax($cod_categoria_codif);

    $sql_producto = "SELECT cod_producto, cod_producto_barra, nombre_producto, und_producto, precio_venta_producto, descripcion_producto, 
    precio_venta_producto2, url_img_min_producto, url_img_orig_producto, nombre_promocion, nombre_promocion_ing, 
    cod_categoria, cod_estado FROM tbl15_producto WHERE (nombre_estado = 'HABILITADO') $condicional_categoria AND (nombre_tipo_producto <> 'SUBPRODUCTO') ORDER BY nombre_producto DESC";
    }
    elseif (isset($_GET['buscador'])) { 
    $buscador_get = addslashes($_GET['buscador']); 

    $sql_producto = "SELECT cod_producto, cod_producto_barra, nombre_producto, und_producto, precio_venta_producto, descripcion_producto, 
    precio_venta_producto2, url_img_min_producto, url_img_orig_producto, nombre_promocion, nombre_promocion_ing, 
    cod_categoria, cod_estado FROM tbl15_producto WHERE (nombre_estado = 'HABILITADO') AND (nombre_producto LIKE '%$buscador_get%') AND (nombre_tipo_producto <> 'SUBPRODUCTO') ORDER BY nombre_producto DESC";
    }
    elseif (isset($_GET['nombre_marca_codifcryp'])) { 
    $nombre_marca_codifcryp              = ($_GET['nombre_marca_codifcryp']);
    $nombre_marca_codif                  = DAXCODIFCRYPTOR::descriptardax($nombre_marca_codifcryp);
    $nombre_marca                        = DAXCODIFCRYPTOR::descodiftextodax($nombre_marca_codif);

    $sql_producto = "SELECT cod_producto, cod_producto_barra, nombre_producto, und_producto, precio_venta_producto, descripcion_producto, 
    precio_venta_producto2, url_img_min_producto, url_img_orig_producto, nombre_promocion, nombre_promocion_ing, 
    cod_categoria, cod_estado FROM tbl15_producto WHERE (nombre_estado = 'HABILITADO') AND (nombre_marca LIKE '$nombre_marca') AND (nombre_tipo_producto <> 'SUBPRODUCTO') ORDER BY nombre_producto DESC";
    }
    else { 
    $contador = 0;

    $sql_producto = "SELECT cod_producto, cod_producto_barra, nombre_producto, und_producto, precio_venta_producto, descripcion_producto, 
    precio_venta_producto2, url_img_min_producto, url_img_orig_producto, nombre_promocion, nombre_promocion_ing, 
    cod_categoria, cod_estado FROM tbl15_producto WHERE (nombre_estado = 'HABILITADO') AND (nombre_tipo_producto <> 'SUBPRODUCTO') ORDER BY nombre_producto DESC";
    }
    $consulta_producto = mysqli_query($conectar, $sql_producto) or die(mysqli_error($conectar));
    while ($datos_producto = mysqli_fetch_assoc($consulta_producto)) {

    //$contador++;
    $cod_producto                      = $datos_producto['cod_producto'];
    $cod_producto_codif                = DAXCODIFCRYPTOR::encodifdax($cod_producto);
    $cod_producto_codifcryp            = DAXCODIFCRYPTOR::encriptardax($cod_producto_codif);

    $cod_producto_barra                = $datos_producto['cod_producto_barra'];
    $nombre_producto                   = $datos_producto['nombre_producto'];
    $und_producto                      = $datos_producto['und_producto'];
    $precio_venta_producto             = $datos_producto['precio_venta_producto'];
    $precio_venta_producto2            = $datos_producto['precio_venta_producto2'];
    $descripcion_producto              = $datos_producto['descripcion_producto'];
    $url_img_min_producto              = $datos_producto['url_img_min_producto'];
    $url_img_orig_producto             = $datos_producto['url_img_orig_producto'];
    $nombre_promocion                  = $datos_producto['nombre_promocion'];
    $nombre_promocion_ing              = $datos_producto['nombre_promocion_ing'];
    $cod_estado                        = $datos_producto['cod_estado'];
    if ($url_img_orig_producto=='') { $url_img_orig_producto = '../archivador/img_producto/orig/sin_imagen.jpg'; }
    //$ptj_descuento                     = round((($precio_venta_producto2 - $precio_venta_producto) / $precio_venta_producto), 2) * 100;
    ?>
                                            <div class="col-sm-3 col-md-6 col-lg-4 col-xl-4">
                                                <!--<a href="" class="agregar_carrito_compra" data-id="<?php echo $cod_producto_barra ?>" id="<?php echo $cod_producto_barra ?>">-->
                                                <a href="../admin/reg_venta_temporal_producto_reg.php?cod_producto_barra=<?php echo $cod_producto_barra?>&buscar_por=<?php echo $buscar_por?>&nombre_tipo_moneda=<?php echo $nombre_tipo_moneda?>&nombre_tipo_factura=<?php echo $nombre_tipo_factura?>&foco=<?php echo $foco?>&cod_estado_vacuna=<?php echo $cod_estado_vacuna?>&cuenta=<?php echo $cuenta_actual?>&cod_caja_virtual=<?php echo $cod_caja_virtual?>&cod_categoria=<?php echo $cod_categoria?>&pagina=<?php echo $pagina?>">

                                                    <div class="products-single fix">
                                                        <div class="box-img-hover">
                                                            <div class="type-lb">
                                                                <p class="<?php echo $nombre_promocion_ing ?>"><?php echo $nombre_promocion ?></p>
                                                            </div>
                                                            <img src="<?php echo $url_img_orig_producto ?>" class="img-fluid" alt="<?php echo $nombre_producto ?>">
                                                            
                                                            <div class="mask-icon">
                                                                <ul>
                                                                    <li id="cart-ok<?php echo $cod_producto_barra ?>"></li>
                                                                </ul>
                                                                    <!--<a class="agregar_carrito_compra" data-id="<?php echo $cod_producto_barra ?>" id="<?php echo $cod_producto_barra ?>">Agregar al Carrito</a>-->
                                                            </div>
                                                        </div>
                                                        <div class="why-text">
                                                            <h4><?php echo $nombre_producto ?> | <?php echo $cod_producto_barra ?></h4>
                                                            <h5> $<?php echo number_format($precio_venta_producto, 0, ",", ".") ?></h5>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
    <?php } ?>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>    
<!-- ///////////////////////////////////////////////////////PRODUCTOS IMAG MENU FIN//////////////////////////////////////////////////////////////// -->
            </div>
        </div>
    </div>
    <!-- End Shop Page -->

<?php //include_once("../admin/05_modulo_algunos_productos_visitante.php"); ?>

<?php //include_once("../admin/05_modulo_slider_marcas_footer_visitante.php"); ?>

<?php //include_once("../admin/08_modulo_instagram_visitante.php"); ?>
<?php //include_once("../admin/09_modulo_chat_messenger_facebook_visitante.php"); ?>
<?php //include_once("../admin/09_modulo_chat_whatsapp_visitante.php"); ?>

<?php include_once("../admin/09_modulo_footer_version_tactil.php"); ?>

<?php include_once("../admin/10_modulo_js_sin_jquery_tactil.php"); ?>

<script type="text/javascript">
$(document).ready(function() {

    //$('.agregar_carrito_compra').live(function(){
    $(".agregar_carrito_compra").on("click", function(){
        var cod_producto_barra = $(this).attr('data-id');
        var cuenta = '<?php echo $cuenta_actual ?>';
        var cod_caja_virtual = '<?php echo $cod_caja_virtual ?>';
        var cod_base_caja = '<?php echo $cod_base_caja ?>';
        var nombre_tipo_moneda = 'COP';
        var nombre_tipo_factura = 'POS';
        var foco = 'busqueda';
        var cod_estado_vacuna = '0';
        var buscar_por = 'cod_producto_barra';
        var pagina = '<?php echo $pagina_local ?>';
        var tipo_accion = 'registrar';
        var tab = 'tbl15_venta_producto_temporal';
        var campo = 'cod_producto_barra';
        var id = $(this).attr('data-id');
        var cod_tipo_aplicacion = '<?php echo $cod_tipo_aplicacion ?>';
        var cod_info_factura_venta = '<?php echo $cod_info_factura_venta ?>';

        var datos_url_ajax = 'cod_producto_barra='+cod_producto_barra+'&'+'cod_info_factura_venta='+cod_info_factura_venta+'&'+'cod_tipo_aplicacion='+cod_tipo_aplicacion+'&'+'tipo_accion='+tipo_accion+'&'+'tab='+tab+'&'+'campo='+campo+'&'+'id='+id+'&'+'cuenta='+cuenta+'&'+'cod_caja_virtual='+cod_caja_virtual+'&'+'cod_base_caja='+cod_base_caja+'&'+'nombre_tipo_moneda='+nombre_tipo_moneda+'&'+'nombre_tipo_factura='+nombre_tipo_factura+'&'+'foco='+foco+'&'+'cod_estado_vacuna='+cod_estado_vacuna+'&'+'buscar_por='+buscar_por+'&'+'pagina='+pagina;

        $.ajax({
            type: "POST",
            url: "../admin/venta_temporal_producto_ajax_version_tactil.php",
            data: datos_url_ajax,
            //dataType: 'json',
            beforeSend: function(objeto){
                $('#loader').html('<img src="../imagenes/ajax-loader.gif"> Cargando...');
            },
            success:function(respuesta){
                var venta_producto_temporal_total_reg = respuesta.salida_info_actualizada_carrito_compra_menu_total_reg_ajax;
                var venta_producto_temporal = respuesta.salida_info_actualizada_carrito_compra_menu_ajax;
                var salida_info_actualizada_carrito_compra_ajax = respuesta.salida_info_actualizada_carrito_compra_ajax;
                var total_venta_tactil_ajax = respuesta.total_venta_tactil_ajax;
                var salida_info_actualizada_carrito_compra_menu_total_venta_reg_ajax = respuesta.salida_info_actualizada_carrito_compra_menu_total_venta_reg_ajax;

                var cod_venta_producto_temporal = respuesta.cod_venta_producto_temporal;
                var cod_producto_barra = respuesta.cod_producto_barra;
                var nombre_promocion_ing = respuesta.nombre_promocion_ing;
                var nombre_promocion = respuesta.nombre_promocion;
                var url_img_orig_producto = respuesta.url_img_orig_producto;
                var nombre_producto = respuesta.nombre_producto;
                var precio_venta_producto = respuesta.precio_venta_producto;
                var und_venta = respuesta.und_venta;
                var total_venta_ind = respuesta.total_venta_ind;
                var fecha_hora_venta_producto = respuesta.fecha_hora_venta_producto;


                $("#salida_info_actualizada_carrito_compra_menu_total_reg_ajax").html(venta_producto_temporal_total_reg).fadeIn('fast');
                $("#salida_info_actualizada_carrito_compra_menu_ajax").html(venta_producto_temporal).fadeIn('fast');
                //$("#salida_info_actualizada_carrito_compra_ajax").html(salida_info_actualizada_carrito_compra_ajax).fadeIn('fast');
                $("#total_venta_tactil_ajax").html(total_venta_tactil_ajax).fadeIn('fast');
                $("#salida_info_actualizada_carrito_compra_menu_total_venta_reg_ajax").html(salida_info_actualizada_carrito_compra_menu_total_venta_reg_ajax).fadeIn('fast');
                                                        
                 var productos_lista_temporal_venta = '' +
                '<div class="media mb-2 border-bottom" id="elim'+cod_venta_producto_temporal+'">'+
                    '<div class="media-body"><a class="eliminar" data="'+cod_venta_producto_temporal+'" id="cod_venta_producto_temporal'+cod_venta_producto_temporal+'"><i class="fas fa-times"></i></a><span class="mx-2">|</span><a href="#">'+nombre_producto+'</a><span class="mx-2">|</span>'+fecha_hora_venta_producto+''+
                        '<div class="small text-muted">Precio: $'+precio_venta_producto+'<span class="mx-2">|</span>Cant: '+und_venta+'<span class="mx-2">|</span>Total: $'+total_venta_ind+'</div>'+
                    '</div>'+
                '</div>';

                //console.log(productos_lista_temporal_venta);
                $('#productos_lista_temporal_venta').append(productos_lista_temporal_venta);

                $('#cart-ok'+cod_producto_barra).append('<img src="../imagenes/correcto_visitante.png">').fadeIn("fast");
                $('#loader').html('');
            }
        });
    });

});
</script>

<script type="text/javascript">
$(document).ready(function() {

    $('.eliminar').on("click", function(){
        var cod_venta_producto_temporal = $(this).attr('data');
        var cuenta = '<?php echo $cuenta_actual ?>';
        var cod_caja_virtual = '<?php echo $cod_caja_virtual ?>';
        var cod_base_caja = '<?php echo $cod_base_caja ?>';
        var nombre_tipo_moneda = 'COP';
        var nombre_tipo_factura = 'POS';
        var foco = 'busqueda';
        var cod_estado_vacuna = '0';
        var buscar_por = 'cod_venta_producto_temporal';
        var pagina = '<?php echo $pagina_local ?>';
        var tipo_accion = 'eliminar';
        var tab = 'tbl15_venta_producto_temporal';
        var campo = 'cod_venta_producto_temporal';
        var id = $(this).attr('data');
        var cod_tipo_aplicacion = '<?php echo $cod_tipo_aplicacion ?>';
        var cod_info_factura_venta = '<?php echo $cod_info_factura_venta ?>';

        var datos_url_ajax = 'cod_venta_producto_temporal='+cod_venta_producto_temporal+'&'+'cod_info_factura_venta='+cod_info_factura_venta+'&'+'cod_tipo_aplicacion='+cod_tipo_aplicacion+'&'+'tipo_accion='+tipo_accion+'&'+'tab='+tab+'&'+'campo='+campo+'&'+'id='+id+'&'+'cuenta='+cuenta+'&'+'cod_caja_virtual='+cod_caja_virtual+'&'+'cod_base_caja='+cod_base_caja+'&'+'nombre_tipo_moneda='+nombre_tipo_moneda+'&'+'nombre_tipo_factura='+nombre_tipo_factura+'&'+'foco='+foco+'&'+'cod_estado_vacuna='+cod_estado_vacuna+'&'+'buscar_por='+buscar_por+'&'+'pagina='+pagina;

        $.ajax({
            type: "POST",
            url: "../admin/venta_temporal_producto_ajax_version_tactil.php",
            data: datos_url_ajax,
            //dataType: 'json',
            beforeSend: function(objeto){
                $('#loader').html('<img src="../imagenes/ajax-loader.gif"> Cargando...');
            },
            success:function(respuesta){
                $('#elim'+cod_venta_producto_temporal).fadeOut("fast");

                var venta_producto_temporal_total_reg = respuesta.salida_info_actualizada_carrito_compra_menu_total_reg_ajax;
                var venta_producto_temporal = respuesta.salida_info_actualizada_carrito_compra_menu_ajax;
                var salida_info_actualizada_carrito_compra_ajax = respuesta.salida_info_actualizada_carrito_compra_ajax;
                var total_venta_tactil_ajax = respuesta.total_venta_tactil_ajax;
                var salida_info_actualizada_carrito_compra_menu_total_venta_reg_ajax = respuesta.salida_info_actualizada_carrito_compra_menu_total_venta_reg_ajax;

                $("#salida_info_actualizada_carrito_compra_menu_total_reg_ajax").html(venta_producto_temporal_total_reg).fadeIn('fast');
                $("#salida_info_actualizada_carrito_compra_menu_ajax").html(venta_producto_temporal).fadeIn('fast');
                //$("#salida_info_actualizada_carrito_compra_ajax").html(salida_info_actualizada_carrito_compra_ajax).fadeIn('fast');
                $("#total_venta_tactil_ajax").html(total_venta_tactil_ajax).fadeIn('fast');
                $("#salida_info_actualizada_carrito_compra_menu_total_venta_reg_ajax").html(salida_info_actualizada_carrito_compra_menu_total_venta_reg_ajax).fadeIn('fast');
            }
        });
    });

});
</script>
</body>
</html>

<script>
window.onload = function() {
document.getElementById("<?php echo $foco ?>").focus();
}
</script>