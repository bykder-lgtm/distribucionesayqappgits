<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<script src="js/jquery.min.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/json2.min.js"></script>
<script type="text/javascript" src="js/jquery.number.js"></script>

<link rel="stylesheet" href="../estilo_css/jquery-ui.css">

<script type="text/javascript">
$(function(){
//$('#deduccion_retefuente').on('change',function(){
//});
//$('#the_number').text( deduccion_retefuente !== '' ? deduccion_retefuente : '(empty)' );
$('#monto_deuda_alerta').number( true, 0 );
$('#deduccion_retefuente').number( true, 0 );
$('#monto_cuota_interes').number( true, 0 );
$('#deduccion_reparacion').number( true, 0 );
$('#ingreso_gasto_juridica').number( true, 0 );
$('#deduccion_otro_impuesto_dian').number( true, 0 );
$('#ingreso_administracion_incluida').number( true, 0 );
$('#deduccion_saldo_favor').number( true, 0 );
$('#ingreso_deudas_anteriores').number( true, 0 );
$('#abonado').number( true, 0 );
$('#deduccion_servicio').number( true, 0 );
$('#deduccion_otro_concepto').number( true, 0 );
$('#ingreso_otro_concepto').number( true, 0 );

$("#monto_deuda_alerta").keyup(function () {
    var monto_deuda_alerta = $(this).val();
    $("#monto_deuda_alerta_hidden").val(monto_deuda_alerta);
});

$("#deduccion_retefuente").keyup(function () {
    var deduccion_retefuente = $(this).val();
    $("#deduccion_retefuente_hidden").val(deduccion_retefuente);
});

$("#monto_cuota_interes").keyup(function () {
    var monto_cuota_interes = $(this).val();
    $("#monto_cuota_interes_hidden").val(monto_cuota_interes);
});


$("#deduccion_reparacion").keyup(function () {
    var deduccion_reparacion = $(this).val();
    $("#deduccion_reparacion_hidden").val(deduccion_reparacion);
});


$("#ingreso_gasto_juridica").keyup(function () {
    var ingreso_gasto_juridica = $(this).val();
    $("#ingreso_gasto_juridica_hidden").val(ingreso_gasto_juridica);
});


$("#deduccion_otro_impuesto_dian").keyup(function () {
    var deduccion_otro_impuesto_dian = $(this).val();
    $("#deduccion_otro_impuesto_dian_hidden").val(deduccion_otro_impuesto_dian);
});


$("#ingreso_administracion_incluida").keyup(function () {
    var ingreso_administracion_incluida = $(this).val();
    $("#ingreso_administracion_incluida_hidden").val(ingreso_administracion_incluida);
});


$("#deduccion_saldo_favor").keyup(function () {
    var deduccion_saldo_favor = $(this).val();
    $("#deduccion_saldo_favor_hidden").val(deduccion_saldo_favor);
});

$("#ingreso_deudas_anteriores").keyup(function () {
    var ingreso_deudas_anteriores = $(this).val();
    $("#ingreso_deudas_anteriores_hidden").val(ingreso_deudas_anteriores);
});


$("#deduccion_servicio").keyup(function () {
    var deduccion_servicio = $(this).val();
    $("#deduccion_servicio_hidden").val(deduccion_servicio);
});


$("#deduccion_otro_concepto").keyup(function () {
    var deduccion_otro_concepto = $(this).val();
    $("#deduccion_otro_concepto_hidden").val(deduccion_otro_concepto);
});


$("#ingreso_otro_concepto").keyup(function () {
    var ingreso_otro_concepto = $(this).val();
    $("#ingreso_otro_concepto_hidden").val(ingreso_otro_concepto);
});


$("#abonado").keyup(function () {
    var abonado = $(this).val();
    $("#total_recibido_hidden").val(abonado);
});

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
<!--
<div class="breadcrumbs">
<a href="#"><h4>Cuentas por Cobrar</a>
</div>
-->
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina                               = $_SERVER['PHP_SELF'];
$cod_administrador_sesion             = $cod_administrador;

$cod_cuentas_cobrar                   = intval($_GET['cod_cuentas_cobrar']);
$cod_tercero                          = intval($_GET['cod_tercero']);
$cod_factura                          = intval($_GET['cod_factura']);
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
if (isset($_GET['cod_cuentas_cobrar_alerta'])) { 
$cod_cuentas_cobrar_alerta            = intval($_GET['cod_cuentas_cobrar_alerta']);
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_fecha_pago_alert = "SELECT * FROM tbl15_cuentas_cobrar_alerta WHERE (cod_cuentas_cobrar_alerta = '$cod_cuentas_cobrar_alerta')";
$consulta_fecha_pago_alert = mysqli_query($conectar, $sql_fecha_pago_alert) or die(mysqli_error($conectar));
$datos_fecha_pago_alert = mysqli_fetch_assoc($consulta_fecha_pago_alert);

$numero_alerta                        = $datos_fecha_pago_alert['numero_alerta'];
$fecha_pago_limite                    = $datos_fecha_pago_alert['fecha_pago'];
$monto_deuda_alerta                   = $datos_fecha_pago_alert['monto_deuda'];

$deduccion_retefuente                 = $datos_fecha_pago_alert['deduccion_retefuente'];
$deduccion_reparacion                 = $datos_fecha_pago_alert['deduccion_reparacion'];
$deduccion_otro_impuesto_dian         = $datos_fecha_pago_alert['deduccion_otro_impuesto_dian'];
$ingreso_administracion_incluida      = $datos_fecha_pago_alert['ingreso_administracion_incluida'];
$ingreso_gasto_juridica               = $datos_fecha_pago_alert['ingreso_gasto_juridica'];
$deduccion_saldo_favor                = $datos_fecha_pago_alert['deduccion_saldo_favor'];
$total_recibido                       = $datos_fecha_pago_alert['total_recibido'];
$total_pendiente                      = $datos_fecha_pago_alert['total_pendiente'];
$fecha_mes                            = $datos_fecha_pago_alert['fecha_mes'];
$ingreso_deudas_anteriores            = $datos_fecha_pago_alert['ingreso_deudas_anteriores'];

$deduccion_servicio                   = $datos_fecha_pago_alert['deduccion_servicio'];
$deduccion_otro_concepto              = $datos_fecha_pago_alert['deduccion_otro_concepto'];
$ingreso_otro_concepto                = $datos_fecha_pago_alert['ingreso_otro_concepto'];
} else { 
$calcular_datos_cuenta_cobrar = "SELECT MAX(numero_alerta) AS numero_alerta FROM tbl15_cuentas_cobrar_abonos WHERE (cod_cuentas_cobrar = '$cod_cuentas_cobrar')";
$consulta_datos_cuenta_cobrar = mysqli_query($conectar, $calcular_datos_cuenta_cobrar) or die(mysqli_error($conectar));
$datos_cuenta_cobrar = mysqli_fetch_assoc($consulta_datos_cuenta_cobrar);

$numero_alerta                        = $datos_cuenta_cobrar['numero_alerta']+1;

$calcular_datos_cuenta_cobrar = "SELECT * FROM tbl15_cuentas_cobrar_alerta 
WHERE (cod_cuentas_cobrar = '$cod_cuentas_cobrar') AND (numero_alerta = '$numero_alerta')";
$consulta_datos_cuenta_cobrar = mysqli_query($conectar, $calcular_datos_cuenta_cobrar) or die(mysqli_error($conectar));
$datos_fecha_pago_alert = mysqli_fetch_assoc($consulta_datos_cuenta_cobrar);

$cod_cuentas_cobrar_alerta            = $datos_fecha_pago_alert['cod_cuentas_cobrar_alerta'];
$fecha_pago_limite                    = $datos_fecha_pago_alert['fecha_pago'];
$monto_deuda_alerta                   = $datos_fecha_pago_alert['monto_deuda'];

$deduccion_retefuente                 = $datos_fecha_pago_alert['deduccion_retefuente'];
$deduccion_reparacion                 = $datos_fecha_pago_alert['deduccion_reparacion'];
$deduccion_otro_impuesto_dian         = $datos_fecha_pago_alert['deduccion_otro_impuesto_dian'];
$ingreso_administracion_incluida      = $datos_fecha_pago_alert['ingreso_administracion_incluida'];
$ingreso_gasto_juridica               = $datos_fecha_pago_alert['ingreso_gasto_juridica'];
$deduccion_saldo_favor                = $datos_fecha_pago_alert['deduccion_saldo_favor'];
$total_recibido                       = $datos_fecha_pago_alert['total_recibido'];
$total_pendiente                      = $datos_fecha_pago_alert['total_pendiente'];
$fecha_mes                            = $datos_fecha_pago_alert['fecha_mes'];
$ingreso_deudas_anteriores            = $datos_fecha_pago_alert['ingreso_deudas_anteriores'];

$deduccion_servicio                   = $datos_fecha_pago_alert['deduccion_servicio'];
$deduccion_otro_concepto              = $datos_fecha_pago_alert['deduccion_otro_concepto'];
$ingreso_otro_concepto                = $datos_fecha_pago_alert['ingreso_otro_concepto'];
}
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$nombre_tabla_mes               = date("m", strtotime($fecha_pago_limite));

$mostrar_datos_sql = "SELECT nombre_letra_tabla_mes FROM tbl15_tabla_mes WHERE nombre_tabla_mes  = '$nombre_tabla_mes'";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
$matriz_consulta = mysqli_fetch_assoc($consulta);

$nombre_letra_tabla_mes         = $matriz_consulta['nombre_letra_tabla_mes'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$fecha_impr                     = date("Ymd");
$hora_impr                      = date("His");
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_consulta_inquilino = "SELECT * FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero'";
$consulta_inquilino = mysqli_query($conectar, $sql_consulta_inquilino) or die(mysqli_error($conectar));
$total_inquilino = mysqli_fetch_assoc($consulta_inquilino);

$identificacion_tercero_inquilino         = $total_inquilino['identificacion_tercero'];
$nombre1_tercero_inquilino                = $total_inquilino['nombre1_tercero'];
$nombre2_tercero_inquilino                = $total_inquilino['nombre2_tercero'];
$apellido1_tercero_inquilino              = $total_inquilino['apellido1_tercero'];
$apellido2_tercero_inquilino              = $total_inquilino['apellido2_tercero'];
$nombre_cliente_inquilino                 = $nombre1_tercero_inquilino.' '.$nombre2_tercero_inquilino.' '.$apellido1_tercero_inquilino.' '.$apellido2_tercero_inquilino;
$cliente_inquilino                        = $nombre1_tercero_inquilino.' '.$nombre2_tercero_inquilino.' '.$apellido1_tercero_inquilino.' '.$apellido2_tercero_inquilino;
$nombre_tipo_identificacion_inquilino     = $total_inquilino['nombre_tipo_identificacion'];
$telefono1_tercero_inquilino              = $total_inquilino['telefono1_tercero'];
$correo_tercero_inquilino                 = $total_inquilino['correo_tercero'];
$nombre_pais_inquilino                    = $total_inquilino['nombre_pais'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$monto_deuda_smtr       = 0;
$abonado_smtr           = 0;
$subtotal_smtr          = 0;

$sql_total_facturas = "SELECT tbl15_cuentas_cobrar.cod_cuentas_cobrar, tbl15_cuentas_cobrar.cod_factura, tbl15_cuentas_cobrar.cod_tercero, 
tbl15_cuentas_cobrar.monto_deuda, tbl15_cuentas_cobrar.abonado, tbl15_cuentas_cobrar.subtotal, tbl15_tercero.nombre1_tercero, tbl15_tercero.apellido1_tercero, 
tbl15_cuentas_cobrar.mensaje, tbl15_cuentas_cobrar.fecha_pago, tbl15_cuentas_cobrar.vendedor, tbl15_cuentas_cobrar.cod_info_factura_venta,
tbl15_cuentas_cobrar.monto_deuda_sin_interes, tbl15_cuentas_cobrar.subtotal_sin_interes, tbl15_cuentas_cobrar.numero_cuota, tbl15_cuentas_cobrar.monto_cuota, 
tbl15_cuentas_cobrar.monto_cuota_sin_interes, tbl15_cuentas_cobrar.interes_ptj, tbl15_cuentas_cobrar.monto_cuota_interes,
tbl15_cuentas_cobrar.nombre_tipo_cobro, 
tbl15_cuentas_cobrar.cod_tipo_moneda, tbl15_cuentas_cobrar.clausula_alquiler, tbl15_cuentas_cobrar.cod_producto, 
tbl15_cuentas_cobrar.cod_producto_barra, tbl15_cuentas_cobrar.nombre_producto, tbl15_cuentas_cobrar.cod_administrador, 
tbl15_cuentas_cobrar.url_img_orig_producto, tbl15_cuentas_cobrar.cod_estado_contrato
FROM tbl15_tercero RIGHT JOIN tbl15_cuentas_cobrar ON tbl15_tercero.cod_tercero = tbl15_cuentas_cobrar.cod_tercero 
WHERE (tbl15_cuentas_cobrar.cod_cuentas_cobrar='$cod_cuentas_cobrar') ORDER BY tbl15_cuentas_cobrar.fecha_invert DESC";
$consulta_total_facturas = mysqli_query($conectar, $sql_total_facturas);
$total_facturas = mysqli_num_rows($consulta_total_facturas);
$datos_total_facturas = mysqli_fetch_assoc($consulta_total_facturas);

$cod_factura                    = $datos_total_facturas['cod_factura'];
$monto_deuda                    = $datos_total_facturas['monto_deuda'];
$monto_deuda_sin_interes        = $datos_total_facturas['monto_deuda_sin_interes'];
$subtotal                       = $datos_total_facturas['subtotal'];
$subtotal_sin_interes           = $datos_total_facturas['subtotal_sin_interes'];
$numero_cuota                   = $datos_total_facturas['numero_cuota'];
$monto_cuota                    = $datos_total_facturas['monto_cuota'];
$monto_cuota_sin_interes        = $datos_total_facturas['monto_cuota_sin_interes'];
$interes_ptj                    = $datos_total_facturas['interes_ptj'];
$monto_cuota_interes            = $datos_total_facturas['monto_cuota_interes'];
$nombre_tipo_cobro              = $datos_total_facturas['nombre_tipo_cobro'];
$abonado                        = $datos_total_facturas['abonado'];

$cod_tipo_moneda                = $datos_total_facturas['cod_tipo_moneda'];
$clausula_alquiler              = $datos_total_facturas['clausula_alquiler'];
$cod_producto                   = $datos_total_facturas['cod_producto'];
$cod_producto_barra             = $datos_total_facturas['cod_producto_barra'];
$nombre_producto                = $datos_total_facturas['nombre_producto'];
$cod_estado_contrato            = $datos_total_facturas['cod_estado_contrato'];

$url_img_orig_producto          = $datos_total_facturas['url_img_orig_producto'];
$cod_factura_strpad             = str_pad($cod_factura, 4, "0", STR_PAD_LEFT);
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_consulta_tipo_moneda = "SELECT nombre_tipo_moneda FROM tbl15_tipo_moneda WHERE cod_tipo_moneda = '$cod_tipo_moneda'";
$consulta_tipo_moneda = mysqli_query($conectar, $sql_consulta_tipo_moneda) or die(mysqli_error($conectar));
$total_tipo_moneda = mysqli_fetch_assoc($consulta_tipo_moneda);

$nombre_tipo_moneda             = $total_tipo_moneda['nombre_tipo_moneda'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_consulta_producto = "SELECT nombre_tipo_producto, direccion_producto, descripcion_producto, cod_tercero, referencia_catastral_inmueble, numero_matricula_inmueble 
FROM tbl15_producto WHERE cod_producto_barra = '$cod_producto_barra'";
$consulta_producto = mysqli_query($conectar, $sql_consulta_producto) or die(mysqli_error($conectar));
$total_producto = mysqli_fetch_assoc($consulta_producto);

$nombre_tipo_producto             = $total_producto['nombre_tipo_producto'];
$direccion_producto               = $total_producto['direccion_producto'];
$descripcion_producto             = $total_producto['descripcion_producto'];
$cod_tercero_propietario          = $total_producto['cod_tercero'];
$referencia_catastral_inmueble    = $total_producto['referencia_catastral_inmueble'];
$numero_matricula_inmueble        = $total_producto['numero_matricula_inmueble'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_consulta_estado_contrato = "SELECT nombre_estado_contrato FROM tbl15_estado_contrato WHERE cod_estado_contrato = '$cod_estado_contrato'";
$consulta_estado_contrato = mysqli_query($conectar, $sql_consulta_estado_contrato) or die(mysqli_error($conectar));
$total_estado_contrato = mysqli_fetch_assoc($consulta_estado_contrato);

$nombre_estado_contrato                    = $total_estado_contrato['nombre_estado_contrato'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_consulta_propietario = "SELECT * FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero_propietario'";
$consulta_propietario = mysqli_query($conectar, $sql_consulta_propietario) or die(mysqli_error($conectar));
$total_propietario = mysqli_fetch_assoc($consulta_propietario);

$identificacion_tercero_propietario         = $total_propietario['identificacion_tercero'];
$nombre1_tercero_propietario                = $total_propietario['nombre1_tercero'];
$nombre2_tercero_propietario                = $total_propietario['nombre2_tercero'];
$apellido1_tercero_propietario              = $total_propietario['apellido1_tercero'];
$apellido2_tercero_propietario              = $total_propietario['apellido2_tercero'];
$nombre_cliente_propietario                 = $nombre1_tercero_propietario.' '.$nombre2_tercero_propietario.' '.$apellido1_tercero_propietario.' '.$apellido2_tercero_propietario;
$cliente_propietario                        = $nombre1_tercero_propietario.' '.$nombre2_tercero_propietario.' '.$apellido1_tercero_propietario.' '.$apellido2_tercero_propietario;
$nombre_tipo_identificacion_propietario     = $total_propietario['nombre_tipo_identificacion'];
$telefono1_tercero_propietario              = $total_propietario['telefono1_tercero'];
$correo_tercero_propietario                 = $total_propietario['correo_tercero'];
$nombre_pais_propietario                    = $total_propietario['nombre_pais'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
//*******************************************************************************************************************//
if ($cod_seguridad == '1') { $condicional_consulta_admin = ''; } else { $condicional_consulta_admin = 'WHERE cod_administrador = "'.$cod_administrador.'"'; }

if (($cod_estado_habilitar_tercero_por_usuario_global == '1')) {

    if ($cod_seguridad == '1') {
        $condicional_consulta_tercero = ''; 
    } else { 
        $condicional_consulta_tercero = 'WHERE cod_administrador = "'.$cod_administrador.'"'; 
    }

} else { 
$condicional_consulta_tercero = ''; 
}
//*******************************************************************************************************************//
$calcular_datos_cuenta_cobrar = "SELECT tbl15_cuentas_cobrar.cod_cuentas_cobrar, tbl15_cuentas_cobrar.cod_factura, tbl15_cuentas_cobrar.cod_tercero, 
tbl15_cuentas_cobrar.monto_deuda  AS total_venta, tbl15_tercero.nombre1_tercero, tbl15_tercero.nombre2_tercero, tbl15_tercero.apellido1_tercero, tbl15_tercero.apellido2_tercero, 
Sum(tbl15_cuentas_cobrar_abonos.abonado) AS total_abonado, tbl15_cuentas_cobrar.monto_cuota
FROM tbl15_cuentas_cobrar_abonos RIGHT JOIN (tbl15_tercero RIGHT JOIN tbl15_cuentas_cobrar ON tbl15_tercero.cod_tercero = tbl15_cuentas_cobrar.cod_tercero) 
ON tbl15_cuentas_cobrar_abonos.cod_cuentas_cobrar = tbl15_cuentas_cobrar.cod_cuentas_cobrar
GROUP BY tbl15_cuentas_cobrar.cod_cuentas_cobrar, tbl15_cuentas_cobrar.cod_factura, tbl15_cuentas_cobrar.cod_tercero, tbl15_cuentas_cobrar.monto_deuda, 
tbl15_tercero.nombre1_tercero, tbl15_tercero.apellido1_tercero HAVING (((tbl15_cuentas_cobrar.cod_cuentas_cobrar)='$cod_cuentas_cobrar'))";
$consulta_datos_cuenta_cobrar = mysqli_query($conectar, $calcular_datos_cuenta_cobrar) or die(mysqli_error($conectar));
$total_datos = mysqli_num_rows($consulta_datos_cuenta_cobrar);
$datos_cuenta_cobrar = mysqli_fetch_assoc($consulta_datos_cuenta_cobrar);

$total_venta                    = $datos_cuenta_cobrar['total_venta'];
$total_abonado                  = $datos_cuenta_cobrar['total_abonado'];
$monto_cuota                    = $datos_cuenta_cobrar['monto_cuota'];
$total_deuda                    = $total_venta - $total_abonado;
$cliente                        = $datos_cuenta_cobrar['nombre1_tercero']." ".$datos_cuenta_cobrar['nombre2_tercero']." ".$datos_cuenta_cobrar['apellido1_tercero']." ".$datos_cuenta_cobrar['apellido2_tercero'];
$cod_tipo_forma_pago            = '1';
?>
<div class="table-responsive">

<form name="formulario_de_actualizacion" method="post" enctype="multipart/form-data" action="../admin/reg_cuentas_cobrar_agrupado_detalle_factura_alquiler_reg.php">
<fieldset>
<legend>PAGO DE ALQUILER</legend>
<table border="1" class="table table-responsive">
    <thead>
        <tr>
            <th style="text-align:center">CODIGO CONTRATO</th>
            <?php if ($url_img_orig_producto <> '') { ?><th style="text-align:center">SOPORTE CONTRATO</th><?php } ?>
            <th style="text-align:center">ESTADO</th>
            <th style="text-align:center">INFO CONTRATO</th>
            <th style="text-align:center">ID</th>
        </tr>
        <tr>
            <td style="text-align:center"><?php echo $cod_factura ?></td>
            <?php if ($url_img_orig_producto <> '') { ?><td style="text-align:center"><a href="<?php echo $url_img_orig_producto ?>" target="_blank"><img src="../imagenes/adjuntar_archivo.png" class="img-polaroid" alt=""></a></td><?php } ?>          
            <td style="text-align:center"><?php echo $nombre_estado_contrato ?></td>
            <td style="text-align:center"><a href="../admin/cuentas_cobrar_agrupado_detalle_factura_alquiler.php?cod_cuentas_cobrar=<?php echo $cod_cuentas_cobrar ?>&cod_tercero=<?php echo $cod_tercero ?>&cod_factura=<?php echo $cod_factura ?>&pagina=<?php echo $pagina ?>">VER</a></td>
            <td style="text-align:center"><?php echo $cod_cuentas_cobrar_alerta ?></td>
        </tr>
    </thead>
</table>
</fieldset>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<fieldset>
<legend>INFORMACION DEL INQUILINO</legend>
<table border="1" class="table table-responsive">
    <thead>
        <tr>
            <th style="text-align:center">NOMBRE INQUILINO</th>
            <th style="text-align:center">TIPO DOCUMENTO</th>
            <th style="text-align:center">NUMERO DOCUMENTO</th>
            <th style="text-align:center">TELEFONO / CELULAR</th>
            <th style="text-align:center">CORREO ELECTRONICO</th>
            <!--<th style="text-align:center">NACIONALIDAD</th>-->
        </tr>
        <tr>
            <td style="text-align:center"><?php echo $nombre1_tercero_inquilino ?></td>
            <td style="text-align:center"><?php echo $nombre_tipo_identificacion_inquilino ?></td>
            <td style="text-align:center"><?php echo $identificacion_tercero_inquilino ?></td>
            <td style="text-align:center"><?php echo $telefono1_tercero_inquilino ?></td>
            <td style="text-align:center"><?php echo $correo_tercero_inquilino ?></td>
            <!--<td style="text-align:center"><?php echo $nombre_pais_inquilino ?></td>-->
        </tr>
    </thead>
</table>
</fieldset>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<fieldset>
<legend>INFORMACION DEL INMUEBLE</legend>
<table border="1" class="table table-responsive">
    <thead>
        <tr>
            <th style="text-align:center">TIPO INMUEBLE</th>
            <th style="text-align:center">CODIGO INMUEBLE</th>
            <th style="text-align:center">NOMBRE INMUEBLE</th>
            <th style="text-align:center">DIRECCION INMUEBLE</th>
            <th style="text-align:center">REFERENCIA CATASTRAL INMUEBLE</th>
            <th style="text-align:center">NUMERO MATRICULA INMUEBLE</th>
        </tr>
        <tr>
            <td style="text-align:center"><?php echo $nombre_tipo_producto ?></td>
            <td style="text-align:center"><?php echo $cod_producto_barra ?></td>
            <td style="text-align:center"><?php echo $nombre_producto ?></td>
            <td style="text-align:center"><?php echo $direccion_producto ?></td>
            <td style="text-align:center"><?php echo $referencia_catastral_inmueble ?></td>
            <td style="text-align:center"><?php echo $numero_matricula_inmueble ?></td>

        </tr>
    </thead>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
    <thead>
<?php
$sql_consulta = "SELECT * FROM tbl15_archivo_adjunto WHERE (cod_producto = '$cod_producto') ORDER BY fecha_modificacion DESC";
$query_consulta = mysqli_query($conectar, $sql_consulta);
while ($datos_consulta = mysqli_fetch_array($query_consulta)) {

$cod_archivo_adjunto            = $datos_consulta['cod_archivo_adjunto'];
$cod_producto                   = $datos_consulta['cod_producto'];
$cod_producto_barra             = $datos_consulta['cod_producto_barra'];
$fecha_creacion                 = $datos_consulta['fecha_creacion'];
$fecha_hora                     = $datos_consulta['fecha_hora'];
$url_archivo_adjunto            = $datos_consulta['url_archivo_adjunto'];
$nombre_archivo_adjunto         = $datos_consulta['nombre_archivo_adjunto'];
$descripcion_archivo_adjunto    = $datos_consulta['descripcion_archivo_adjunto'];
$formato                        = $datos_consulta['formato'];
?>
            <td style="text-align:center"><!--<a href="<?php echo $url_archivo_adjunto?>" target="_blank">--><?php echo $descripcion_archivo_adjunto; ?><!--</a>--></td>
<?php } ?>
    </thead>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<fieldset>
<legend>INFORMACION DEL PROPIETARIO</legend>
<table border="1" class="table table-responsive">
    <thead>
        <tr>
            <th style="text-align:center">NOMBRE PROPIETARIO</th>
            <th style="text-align:center">TIPO DOCUMENTO</th>
            <th style="text-align:center">NUMERO DOCUMENTO</th>
            <th style="text-align:center">TELEFONO / CELULAR</th>
            <th style="text-align:center">CORREO ELECTRONICO</th>
            <!--<th style="text-align:center">NACIONALIDAD</th>-->
        </tr>
        <tr>
            <td style="text-align:center"><?php echo $nombre1_tercero_propietario ?></td>
            <td style="text-align:center"><?php echo $nombre_tipo_identificacion_propietario ?></td>
            <td style="text-align:center"><?php echo $identificacion_tercero_propietario ?></td>
            <td style="text-align:center"><?php echo $telefono1_tercero_propietario ?></td>
            <td style="text-align:center"><?php echo $correo_tercero_propietario ?></td>
            <!--<td style="text-align:center"><?php echo $nombre_pais_propietario ?></td>-->
        </tr>
    </thead>
</table>
</fieldset>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
    <thead>
        <tr>
            <th style="text-align:center">TIPO ALQUILER</th>
            <th style="text-align:center">CANTIDAD DE PERIODOS</th>
            <th style="text-align:center">TIPO MONEDA</th>
            <!--<th style="text-align:center">CLAUSULAS</th>-->
        </tr>
        <tr>
            <td style="text-align:center"><?php echo $nombre_tipo_cobro ?></td>
            <td style="text-align:center"><?php echo $numero_cuota ?></td>
            <td style="text-align:center"><?php echo $nombre_tipo_moneda ?></td>
            <!--<td style="text-align:center"><?php echo $clausula_alquiler ?></td>-->
        </tr>
    </thead>
</table>
</fieldset>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<fieldset>
<legend>INFORMACION DE PAGO</legend>

<table border="1" class="table table-responsive">
    <thead>
        <tr>
            <th style="text-align:center">MES ATRASADO</th>
            <th style="text-align:center">VALOR ATRASADO</th>
            <th style="text-align:center">FECHA</th>

        </tr>
<?php
$sql_cuentas_cobrar_viejas = "SELECT * FROM tbl15_cuentas_cobrar_alerta WHERE  (cod_tercero = '$cod_tercero') AND (fecha_mes < '$fecha_mes') AND (cod_estado <> '1')";
$consulta_cuentas_cobrar_viejas = mysqli_query($conectar, $sql_cuentas_cobrar_viejas);
while ($datos_cuentas_cobrar_viejas = mysqli_fetch_assoc($consulta_cuentas_cobrar_viejas)) {

$cuentas_cobrar_viejas_concat             = '';
$monto_cuota_concat                       = $datos_cuentas_cobrar_viejas['monto_cuota'];
$fecha_pago_concat                        = $datos_cuentas_cobrar_viejas['fecha_pago'];

$nombre_tabla_mes                         = date("m", strtotime($fecha_pago_concat));

$mostrar_datos_sql = "SELECT nombre_letra_tabla_mes FROM tbl15_tabla_mes WHERE nombre_tabla_mes  = '$nombre_tabla_mes'";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
$matriz_consulta = mysqli_fetch_assoc($consulta);

$nombre_letra_tabla_mes                   = $matriz_consulta['nombre_letra_tabla_mes'];

$cuentas_cobrar_viejas_concat            .= "".$nombre_letra_tabla_mes.'|'.number_format($monto_cuota_concat, 0, ",", ".")."|".$fecha_pago_concat.''.'<br>';
?>
        <tr>
            <td style="text-align:center"><?php echo $nombre_letra_tabla_mes ?></td>
            <td style="text-align:center"><?php echo number_format($monto_cuota_concat, 0, ",", ".") ?></td>
            <td style="text-align:center"><?php echo $fecha_pago_concat ?></td>

        </tr>
<?php } ?>
    </thead>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
    <thead>
        <tr>
            <th style="text-align:center">SALDO A FAVOR</th>
            <td style="text-align:left"><input style="font-size:24px" class="input-block-level" type="text" name="deduccion_saldo_favor" id="deduccion_saldo_favor" value="0" min="0" size="5" required></td>
            <input type="hidden" name="deduccion_saldo_favor_hidden" id="deduccion_saldo_favor_hidden" value="" required>
            
        </tr>

    </thead>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
    <thead>
	  <tr>
		<th style="text-align:center;" colspan="2">DEDUCCIONES</th>
		<th style="text-align:center;" colspan="2">INGRESOS</th>
	  </tr>
      <tr>
        <th style="text-align:left; width:25%">RETEFUENTE: </th>
        <td style="text-align:left; width:25%"><span>.</span><input style="font-size:24px" class="input-block-level" type="text" name="deduccion_retefuente" id="deduccion_retefuente" value="0" min="0" size="5" required></td>
        <input type="hidden" name="deduccion_retefuente_hidden" id="deduccion_retefuente_hidden" value="" required>
        <th style="text-align:left">CANON DE ARRIENDO: </th>
        <td style="text-align:left"><br><input style="font-size:24px" class="input-block-level" type="text" name="monto_deuda_alerta" id="monto_deuda_alerta" value="<?php echo $monto_deuda_alerta ?>" min="0" size="5" required></td>
        <input style="font-size:24px" class="input-block-level" type="hidden" name="monto_deuda_alerta_hidden" id="monto_deuda_alerta_hidden" value="" min="0" size="5">
      </tr>
      <tr>
        <th style="text-align:left">REPARACIONES: </th>
        <td style="text-align:left"><input style="font-size:24px" class="input-block-level" type="text" name="deduccion_reparacion" id="deduccion_reparacion" value="0" min="0" size="5" required></td>
        <input type="hidden" name="deduccion_reparacion_hidden" id="deduccion_reparacion_hidden" value="" required>
        <th style="text-align:left; width:25%">INTERESES (<?php echo $ptj_interes_inmobiliaria ?>%): </th>
        <td style="text-align:left; width:25%">ATRASO <span id="dias_atraso"></span><input style="font-size:24px" class="input-block-level" type="text" name="monto_cuota_interes" id="monto_cuota_interes" value="0" min="0" size="5" required></td>
        <input type="hidden" name="monto_cuota_interes_hidden" id="monto_cuota_interes_hidden" value="" required>
      </tr>
      <tr>
        <th style="text-align:left">OTROS IMPUESTOS (DIAN): </th>
        <td style="text-align:left"><input style="font-size:24px" class="input-block-level" type="text" name="deduccion_otro_impuesto_dian" id="deduccion_otro_impuesto_dian" value="0" min="0" size="5" required></td>
        <input type="hidden" name="deduccion_otro_impuesto_dian_hidden" id="deduccion_otro_impuesto_dian_hidden" value="" required>
        <th style="text-align:left">GASTOS JURIDICA: </th>
        <td style="text-align:left"><input style="font-size:24px" class="input-block-level" type="text" name="ingreso_gasto_juridica" id="ingreso_gasto_juridica" value="0" min="0" size="5" required></td>
        <input type="hidden" name="ingreso_gasto_juridica_hidden" id="ingreso_gasto_juridica_hidden" value="" required>
      </tr>
      <tr>
        <th style="text-align:left">SERVICIOS: </th>
        <td style="text-align:left"><input style="font-size:24px" class="input-block-level" type="text" name="deduccion_servicio" id="deduccion_servicio" value="0" min="0" size="5" required></td>
        <input type="hidden" name="deduccion_servicio_hidden" id="deduccion_servicio_hidden" value="" required>
        <th style="text-align:left">ADMINISTRACION INCLUIDA: </th>
        <td style="text-align:left"><input style="font-size:24px" class="input-block-level" type="text" name="ingreso_administracion_incluida" id="ingreso_administracion_incluida" value="0" min="0" size="5" required></td>
        <input type="hidden" name="ingreso_administracion_incluida_hidden" id="ingreso_administracion_incluida_hidden" value="" required>
      </tr>
      <tr>
        <th style="text-align:left">OTROS CONCEPTOS: </th>
        <td style="text-align:left"><input style="font-size:24px" class="input-block-level" type="text" name="deduccion_otro_concepto" id="deduccion_otro_concepto" value="0" min="0" size="5" required></td>
        <input type="hidden" name="deduccion_otro_concepto_hidden" id="deduccion_otro_concepto_hidden" value="" required>
        <th style="text-align:left">DEUDAS ANTERIORES: </th>
        <td style="text-align:left"><input style="font-size:24px" class="input-block-level" type="text" name="ingreso_deudas_anteriores" id="ingreso_deudas_anteriores" value="0" min="0" size="5" required></td>
        <input type="hidden" name="ingreso_deudas_anteriores_hidden" id="ingreso_deudas_anteriores_hidden" value="" required>
        </tr>
      <tr>
        <th style="text-align:left"></th>
        <td style="text-align:left; font-size:24px"></td>
        <input type="hidden" name="" id="" value="0" required>
        <th style="text-align:left">OTROS CONCEPTOS: </th>
        <td style="text-align:left"><input style="font-size:24px" class="input-block-level" type="text" name="ingreso_otro_concepto" id="ingreso_otro_concepto" value="0" min="0" size="5" required></td>
        <input type="hidden" name="ingreso_otro_concepto_hidden" id="ingreso_otro_concepto_hidden" value="" required>
      </tr>
      <tr>
        <th style="text-align:center">TOTAL DEDUCCIONES: </th>
        <td style="text-align:left; font-size:24px" id="total_deduccion"></td>
        <input type="hidden" name="total_deduccion_hidden" id="total_deduccion_hidden" value="0" required>
        <th style="text-align:center">TOTAL INGRESOS: </th>
        <td style="text-align:left; font-size:24px" id="total_ingreso"></td>
        <input type="hidden" name="total_ingreso_hidden" id="total_ingreso_hidden" value="0" required>
      </tr>
    </thead>
</table>
<!-- 
<td style="text-align:center"><input style="font-size:24px" class="input-block-level" type="text" name="abonado_number" id="abonado_number" value="<?php echo $monto_cuota ?>" size="5"  required></td>
<input type="hidden" name="abonado" id="abonado" value="<?php echo $monto_cuota ?>" />
-->
<table border="1" class="table table-responsive">
    <thead>
        <tr>
            <th style="text-align:center">PERIODO A PAGAR</th>
            <th style="text-align:center">FORMA DE PAGO</th>
            <th style="text-align:center">OBSERVACION</th>
            <th style="text-align:center">USUARIO</th>
            <!--<th style="text-align:center">SOPORTE PAGO</th>-->
            <th style="text-align:center">FECHA LIMITE PERIODO</th>
            <th style="text-align:center">FECHA PAGO</th>
        </tr>
        <tr>
            <td style="text-align:center; font-size:28px"><?php echo $nombre_letra_tabla_mes ?></td>
            <td style="text-align:center">
                <select name="cod_tipo_forma_pago" id="cod_tipo_forma_pago" class="input-block-level" data-show-subtext="true" data-live-search="true" required>
                    <?php if (isset($cod_tipo_forma_pago)) { echo ""; } else { echo  ""; }
                    $consulta2_sql = "SELECT cod_tipo_forma_pago, nombre_tipo_forma_pago FROM tbl15_tipo_forma_pago WHERE (cod_estado = '1') ORDER BY cod_tipo_forma_pago ASC";
                    $consulta2 = mysqli_query($conectar, $consulta2_sql);
                    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                    if(isset($cod_tipo_forma_pago) AND $cod_tipo_forma_pago == $datos2['cod_tipo_forma_pago']) {
                    $seleccionado = "selected"; } else { $seleccionado = ""; }
                    $codigo = $datos2['cod_tipo_forma_pago'];
                    $nombre = $datos2['nombre_tipo_forma_pago'];
                    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                </select>
            </td>
            <td style="text-align:center"><input style="font-size:24px" class="input-block-level" type="text" name="mensaje" value="" size="50"></td>
            <td style="text-align:center">
                <select name="cod_administrador" class="input-block-level" data-show-subtext="true" data-live-search="true" required>
                    <?php if (isset($cod_administrador_sesion)) { echo ""; } else { echo  ""; }
                    $consulta2_sql = ("SELECT * FROM tbl15_administrador $condicional_consulta_admin");
                    $consulta2 = mysqli_query($conectar, $consulta2_sql);
                    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                    if(isset($cod_administrador_sesion) and $cod_administrador_sesion == $datos2['cod_administrador']) {
                    $seleccionado = "selected"; } else { $seleccionado = ""; }
                    $codigo = $datos2['cod_administrador'];
                    $nombre = $datos2['nombres'].' '.$datos2['apellidos'].' | '.$datos2['cuenta'];
                    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                </select>
            </td>
            <td style="text-align:center; font-size:28px"><?php echo date("d-m-Y", strtotime($fecha_pago_limite)) ?></td>
            <!--<td style="text-align:center"><input type="file" name="url_img1" id="url_img1"></td>-->
            <td style="text-align:center"><input class="input-block-level" type="date" name="fecha_pago" id="fecha_pago" style="font-size:24px" value="<?php echo date("Y-m-d");?>" size="10" required></td>
        </tr>
    </thead>
</table>

<table border="1" class="table table-responsive">
    <thead>
        <tr>
            <th style="text-align:right; width: 50%; font-size:28px;">TOTAL A PAGAR:</th>
            <th style="text-align:left; width: 50%; font-size:28px;" id="total_pagar"></th>
            <input type="hidden" name="total_pagar_hidden" id="total_pagar_hidden" value="" required>
        </tr>
        <tr>
            <th style="text-align:right; font-size:28px;">TOTAL RECIBIDO:</th>
            <td style="text-align:left"><input style="font-size:28px" class="input-block-level" type="text" name="abonado" id="abonado" value="" min="1" size="5"  required></td>
            <input type="hidden" name="total_recibido_hidden" id="total_recibido_hidden" value="" required></td>
        </tr>
        <tr>
            <th style="text-align:right; font-size:28px;">TOTAL PENDIENTE:</th>
            <th style="text-align:left; width: 50%; font-size:28px;" id="total_pendiente"></th>
            <input type="hidden" name="total_pendiente_hidden" id="total_pendiente_hidden" value="" required>        
        </tr>
    </thead>
</table>

<table border="1" class="table table-responsive">
    <thead>
        <tr>
            <th style="text-align:center">REGISTRAR PAGO</th>
        </tr>
        <tr>
            <td style="text-align:center"><input type="image" src="../imagenes/guardar.png" name="vender" value="Guardar" /></td>
        </tr>
    </thead>
</table>

</fieldset>

<input type="hidden" name="MM_update" value="formulario_de_actualizacion">
<input type="hidden" name="cod_cuentas_cobrar" value="<?php echo $cod_cuentas_cobrar; ?>">
<input type="hidden" name="cod_factura" value="<?php echo $cod_factura; ?>">
<input type="hidden" name="cod_tercero" value="<?php echo $cod_tercero; ?>">
<input type="hidden" name="numero_alerta" value="<?php echo $numero_alerta; ?>">
<input type="hidden" name="cod_cuentas_cobrar_alerta" value="<?php echo $cod_cuentas_cobrar_alerta; ?>">
<input type="hidden" name="insertar_datos" value="formulario">
</form>

</div>

<script type="text/javascript">
$(document).ready(function() {
//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------//
        var monto_deuda_alerta = parseFloat($('#monto_deuda_alerta').val());
        var fecha_pago = new Date($('#fecha_pago').val()).getTime();
        var fecha_pago_limite = new Date('<?php echo $fecha_pago_limite; ?>').getTime();
        var dias_atraso_miliseg = fecha_pago - fecha_pago_limite;
        var dias_atraso = dias_atraso_miliseg/(1000*60*60*24);
        var ptj_interes_inmobiliaria = '<?php echo $ptj_interes_inmobiliaria; ?>';
        var deduccion_retefuente = parseFloat($('#deduccion_retefuente').val());
        var deduccion_reparacion = parseFloat($('#deduccion_reparacion').val());

        var deduccion_otro_impuesto_dian = parseFloat($('#deduccion_otro_impuesto_dian').val());
        var ingreso_administracion_incluida = parseFloat($('#ingreso_administracion_incluida').val());
        var total_recibido = 0;
        var total_pendiente = 0;
        var ingreso_gasto_juridica = parseFloat($('#ingreso_gasto_juridica').val());
        var deduccion_saldo_favor = parseFloat($('#deduccion_saldo_favor').val());
        var ingreso_deudas_anteriores = parseFloat($('#ingreso_deudas_anteriores').val());

        var deduccion_servicio = parseFloat($('#deduccion_servicio').val());
        var deduccion_otro_concepto = parseFloat($('#deduccion_otro_concepto').val());
        var ingreso_otro_concepto = parseFloat($('#ingreso_otro_concepto').val());

	    if (dias_atraso > 0) {
	        var monto_cuota_interes = (monto_deuda_alerta * ((ptj_interes_inmobiliaria/30)/100)) * dias_atraso;
	        var abonado_total = monto_deuda_alerta + monto_cuota_interes;
	    } else {
	        var monto_cuota_interes = 0;
	        var abonado_total = monto_deuda_alerta + monto_cuota_interes;
	    }

	    var total_deduccion = deduccion_retefuente + deduccion_reparacion + deduccion_servicio + deduccion_otro_impuesto_dian + deduccion_otro_concepto;
	    var total_ingreso = monto_cuota_interes + ingreso_gasto_juridica + ingreso_administracion_incluida + monto_deuda_alerta + ingreso_deudas_anteriores + ingreso_otro_concepto;
	    var subtotal_deduccion_ingreso = total_ingreso - total_deduccion;
	    var total_pagar = subtotal_deduccion_ingreso;

	    $('#abonado').val(total_pagar);
	    var abonado = parseFloat($('#abonado').val());
	    var total_pendiente = total_pagar - abonado;
	    $('#monto_cuota_interes').val(monto_cuota_interes);
	    $('#dias_atraso').html(dias_atraso+" DIAS");
	    $('#total_pagar_hidden').val(total_pagar);
	    $('#total_pendiente_hidden').val(total_pendiente);
	    $('#total_recibido_hidden').val(abonado);
	    $('#total_deduccion_hidden').val(total_deduccion);
	    $('#total_ingreso_hidden').val(total_ingreso);

	    $('#deduccion_retefuente_hidden').val(deduccion_retefuente);
	    $('#monto_cuota_interes_hidden').val(monto_cuota_interes);
	    $('#deduccion_reparacion_hidden').val(deduccion_reparacion);

	    $('#ingreso_gasto_juridica_hidden').val(ingreso_gasto_juridica);
	    $('#deduccion_otro_impuesto_dian_hidden').val(deduccion_otro_impuesto_dian);
	    $('#ingreso_administracion_incluida_hidden').val(ingreso_administracion_incluida);
	    $('#deduccion_saldo_favor_hidden').val(deduccion_saldo_favor);
        $('#ingreso_deudas_anteriores_hidden').val(ingreso_deudas_anteriores);

        $('#deduccion_servicio_hidden').val(deduccion_servicio);
        $('#deduccion_otro_concepto_hidden').val(deduccion_otro_concepto);
        $('#ingreso_otro_concepto_hidden').val(ingreso_otro_concepto);
        $('#monto_deuda_alerta_hidden').val(monto_deuda_alerta);

	    document.getElementById("total_deduccion").innerHTML=total_deduccion.toLocaleString("es-ES");
	    document.getElementById("total_ingreso").innerHTML=total_ingreso.toLocaleString("es-ES");
	    document.getElementById("total_pagar").innerHTML=total_pagar.toLocaleString("es-ES");
	    document.getElementById("total_pendiente").innerHTML=total_pendiente.toLocaleString("es-ES");
//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    $('#fecha_pago').change(function(){
        var monto_deuda_alerta = parseFloat($('#monto_deuda_alerta').val());
        var fecha_pago = new Date($('#fecha_pago').val()).getTime();
        var fecha_pago_limite = new Date('<?php echo $fecha_pago_limite; ?>').getTime();
        var dias_atraso_miliseg = fecha_pago - fecha_pago_limite;
        var dias_atraso = dias_atraso_miliseg/(1000*60*60*24);
        var ptj_interes_inmobiliaria = '<?php echo $ptj_interes_inmobiliaria; ?>';
        var deduccion_retefuente = parseFloat($('#deduccion_retefuente').val());
        var deduccion_reparacion = parseFloat($('#deduccion_reparacion').val());

        var deduccion_otro_impuesto_dian = parseFloat($('#deduccion_otro_impuesto_dian').val());
        var ingreso_administracion_incluida = parseFloat($('#ingreso_administracion_incluida').val());
	    var total_recibido = 0;
	    var total_pendiente = 0;
	    var ingreso_gasto_juridica = parseFloat($('#ingreso_gasto_juridica').val());
	    var deduccion_saldo_favor = parseFloat($('#deduccion_saldo_favor').val());
        var ingreso_deudas_anteriores = parseFloat($('#ingreso_deudas_anteriores').val());

        var deduccion_servicio = parseFloat($('#deduccion_servicio').val());
        var deduccion_otro_concepto = parseFloat($('#deduccion_otro_concepto').val());
        var ingreso_otro_concepto = parseFloat($('#ingreso_otro_concepto').val());

        if (dias_atraso > 0) {
            var monto_cuota_interes = (monto_deuda_alerta * ((ptj_interes_inmobiliaria/30)/100)) * dias_atraso;
            var abonado_total = monto_deuda_alerta + monto_cuota_interes;
        } else {
            var monto_cuota_interes = 0;
            var abonado_total = monto_deuda_alerta + monto_cuota_interes;
        }
        var total_deduccion = deduccion_retefuente + deduccion_reparacion + deduccion_servicio + deduccion_otro_impuesto_dian + deduccion_otro_concepto;
        var total_ingreso = monto_cuota_interes + ingreso_gasto_juridica + ingreso_administracion_incluida + monto_deuda_alerta + ingreso_deudas_anteriores + ingreso_otro_concepto;
        var subtotal_deduccion_ingreso = total_ingreso - total_deduccion;
        var total_pagar = subtotal_deduccion_ingreso;

	    $('#abonado').val(total_pagar);
	    var abonado = parseFloat($('#abonado').val());
	    var total_pendiente = total_pagar - abonado;
	    $('#monto_cuota_interes').val(monto_cuota_interes);
	    $('#dias_atraso').html(dias_atraso+" DIAS");
	    $('#total_pagar_hidden').val(total_pagar);
	    $('#total_pendiente_hidden').val(total_pendiente);
	    $('#total_recibido_hidden').val(abonado);
	    $('#total_deduccion_hidden').val(total_deduccion);
	    $('#total_ingreso_hidden').val(total_ingreso);

	    $('#deduccion_retefuente_hidden').val(deduccion_retefuente);
	    $('#monto_cuota_interes_hidden').val(monto_cuota_interes);
	    $('#deduccion_reparacion_hidden').val(deduccion_reparacion);

	    $('#ingreso_gasto_juridica_hidden').val(ingreso_gasto_juridica);
	    $('#deduccion_otro_impuesto_dian_hidden').val(deduccion_otro_impuesto_dian);
	    $('#ingreso_administracion_incluida_hidden').val(ingreso_administracion_incluida);
	    $('#deduccion_saldo_favor_hidden').val(deduccion_saldo_favor);
        $('#ingreso_deudas_anteriores_hidden').val(ingreso_deudas_anteriores);

        $('#deduccion_servicio_hidden').val(deduccion_servicio);
        $('#deduccion_otro_concepto_hidden').val(deduccion_otro_concepto);
        $('#ingreso_otro_concepto_hidden').val(ingreso_otro_concepto);
        $('#monto_deuda_alerta_hidden').val(monto_deuda_alerta);

    	document.getElementById("total_deduccion").innerHTML=total_deduccion.toLocaleString("es-ES");
    	document.getElementById("total_ingreso").innerHTML=total_ingreso.toLocaleString("es-ES");
        document.getElementById("total_pagar").innerHTML=total_pagar.toLocaleString("es-ES");
        document.getElementById("total_pendiente").innerHTML=total_pendiente.toLocaleString("es-ES");
    });
//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    $('#monto_cuota_interes').change(function(){
        var monto_deuda_alerta = parseFloat($('#monto_deuda_alerta').val());
        var fecha_pago = new Date($('#fecha_pago').val()).getTime();
        var fecha_pago_limite = new Date('<?php echo $fecha_pago_limite; ?>').getTime();
        var dias_atraso_miliseg = fecha_pago - fecha_pago_limite;
        var dias_atraso = dias_atraso_miliseg/(1000*60*60*24);
        var ptj_interes_inmobiliaria = '<?php echo $ptj_interes_inmobiliaria; ?>';
        var monto_cuota_interes = parseFloat($('#monto_cuota_interes').val());
        var deduccion_retefuente = parseFloat($('#deduccion_retefuente').val());
        var deduccion_reparacion = parseFloat($('#deduccion_reparacion').val());

        var deduccion_otro_impuesto_dian = parseFloat($('#deduccion_otro_impuesto_dian').val());
        var ingreso_administracion_incluida = parseFloat($('#ingreso_administracion_incluida').val());
	    var total_recibido = 0;
	    var total_pendiente = 0;
	    var ingreso_gasto_juridica = parseFloat($('#ingreso_gasto_juridica').val());
	    var deduccion_saldo_favor = parseFloat($('#deduccion_saldo_favor').val());
        var ingreso_deudas_anteriores = parseFloat($('#ingreso_deudas_anteriores').val());

        var deduccion_servicio = parseFloat($('#deduccion_servicio').val());
        var deduccion_otro_concepto = parseFloat($('#deduccion_otro_concepto').val());
        var ingreso_otro_concepto = parseFloat($('#ingreso_otro_concepto').val());

        var total_deduccion = deduccion_retefuente + deduccion_reparacion + deduccion_servicio + deduccion_otro_impuesto_dian + deduccion_otro_concepto;
        var total_ingreso = monto_cuota_interes + ingreso_gasto_juridica + ingreso_administracion_incluida + monto_deuda_alerta + ingreso_deudas_anteriores + ingreso_otro_concepto;
        var subtotal_deduccion_ingreso = total_ingreso - total_deduccion;
        var total_pagar = subtotal_deduccion_ingreso;

	    $('#abonado').val(total_pagar);
	    var abonado = parseFloat($('#abonado').val());
	    var total_pendiente = total_pagar - abonado;
	    $('#monto_cuota_interes').val(monto_cuota_interes);
	    $('#dias_atraso').html(dias_atraso+" DIAS");
	    $('#total_pagar_hidden').val(total_pagar);
	    $('#total_pendiente_hidden').val(total_pendiente);
	    $('#total_recibido_hidden').val(abonado);
	    $('#total_deduccion_hidden').val(total_deduccion);
	    $('#total_ingreso_hidden').val(total_ingreso);

	    $('#deduccion_retefuente_hidden').val(deduccion_retefuente);
	    $('#monto_cuota_interes_hidden').val(monto_cuota_interes);
	    $('#deduccion_reparacion_hidden').val(deduccion_reparacion);

	    $('#ingreso_gasto_juridica_hidden').val(ingreso_gasto_juridica);
	    $('#deduccion_otro_impuesto_dian_hidden').val(deduccion_otro_impuesto_dian);
	    $('#ingreso_administracion_incluida_hidden').val(ingreso_administracion_incluida);
	    $('#deduccion_saldo_favor_hidden').val(deduccion_saldo_favor);
        $('#ingreso_deudas_anteriores_hidden').val(ingreso_deudas_anteriores);

        $('#deduccion_servicio_hidden').val(deduccion_servicio);
        $('#deduccion_otro_concepto_hidden').val(deduccion_otro_concepto);
        $('#ingreso_otro_concepto_hidden').val(ingreso_otro_concepto);
        $('#monto_deuda_alerta_hidden').val(monto_deuda_alerta);

    	document.getElementById("total_deduccion").innerHTML=total_deduccion.toLocaleString("es-ES");
    	document.getElementById("total_ingreso").innerHTML=total_ingreso.toLocaleString("es-ES");
        document.getElementById("total_pagar").innerHTML=total_pagar.toLocaleString("es-ES");
        document.getElementById("total_pendiente").innerHTML=total_pendiente.toLocaleString("es-ES");
    });
//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    $('#deduccion_retefuente').change(function(){
        var monto_deuda_alerta = parseFloat($('#monto_deuda_alerta').val());
        var fecha_pago = new Date($('#fecha_pago').val()).getTime();
        var fecha_pago_limite = new Date('<?php echo $fecha_pago_limite; ?>').getTime();
        var dias_atraso_miliseg = fecha_pago - fecha_pago_limite;
        var dias_atraso = dias_atraso_miliseg/(1000*60*60*24);
        var ptj_interes_inmobiliaria = '<?php echo $ptj_interes_inmobiliaria; ?>';
        var monto_cuota_interes = parseFloat($('#monto_cuota_interes').val());
        var deduccion_retefuente = parseFloat($('#deduccion_retefuente').val());
        var deduccion_reparacion = parseFloat($('#deduccion_reparacion').val());

        var deduccion_otro_impuesto_dian = parseFloat($('#deduccion_otro_impuesto_dian').val());
        var ingreso_administracion_incluida = parseFloat($('#ingreso_administracion_incluida').val());
	    var total_recibido = 0;
	    var total_pendiente = 0;
	    var ingreso_gasto_juridica = parseFloat($('#ingreso_gasto_juridica').val());
	    var deduccion_saldo_favor = parseFloat($('#deduccion_saldo_favor').val());
        var ingreso_deudas_anteriores = parseFloat($('#ingreso_deudas_anteriores').val());

        var deduccion_servicio = parseFloat($('#deduccion_servicio').val());
        var deduccion_otro_concepto = parseFloat($('#deduccion_otro_concepto').val());
        var ingreso_otro_concepto = parseFloat($('#ingreso_otro_concepto').val());

        var total_deduccion = deduccion_retefuente + deduccion_reparacion + deduccion_servicio + deduccion_otro_impuesto_dian + deduccion_otro_concepto;
        var total_ingreso = monto_cuota_interes + ingreso_gasto_juridica + ingreso_administracion_incluida + monto_deuda_alerta + ingreso_deudas_anteriores + ingreso_otro_concepto;
        var subtotal_deduccion_ingreso = total_ingreso - total_deduccion;
        var total_pagar = subtotal_deduccion_ingreso;

	    $('#abonado').val(total_pagar);
	    var abonado = parseFloat($('#abonado').val());
	    var total_pendiente = total_pagar - abonado;
	    $('#monto_cuota_interes').val(monto_cuota_interes);
	    $('#dias_atraso').html(dias_atraso+" DIAS");
	    $('#total_pagar_hidden').val(total_pagar);
	    $('#total_pendiente_hidden').val(total_pendiente);
	    $('#total_recibido_hidden').val(abonado);
	    $('#total_deduccion_hidden').val(total_deduccion);
	    $('#total_ingreso_hidden').val(total_ingreso);

	    $('#deduccion_retefuente_hidden').val(deduccion_retefuente);
	    $('#monto_cuota_interes_hidden').val(monto_cuota_interes);
	    $('#deduccion_reparacion_hidden').val(deduccion_reparacion);

	    $('#ingreso_gasto_juridica_hidden').val(ingreso_gasto_juridica);
	    $('#deduccion_otro_impuesto_dian_hidden').val(deduccion_otro_impuesto_dian);
	    $('#ingreso_administracion_incluida_hidden').val(ingreso_administracion_incluida);
	    $('#deduccion_saldo_favor_hidden').val(deduccion_saldo_favor);
        $('#ingreso_deudas_anteriores_hidden').val(ingreso_deudas_anteriores);

        $('#deduccion_servicio_hidden').val(deduccion_servicio);
        $('#deduccion_otro_concepto_hidden').val(deduccion_otro_concepto);
        $('#ingreso_otro_concepto_hidden').val(ingreso_otro_concepto);
        $('#monto_deuda_alerta_hidden').val(monto_deuda_alerta);

    	document.getElementById("total_deduccion").innerHTML=total_deduccion.toLocaleString("es-ES");
    	document.getElementById("total_ingreso").innerHTML=total_ingreso.toLocaleString("es-ES");
        document.getElementById("total_pagar").innerHTML=total_pagar.toLocaleString("es-ES");
        document.getElementById("total_pendiente").innerHTML=total_pendiente.toLocaleString("es-ES");
    });
//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    $('#deduccion_reparacion').change(function(){
        var monto_deuda_alerta = parseFloat($('#monto_deuda_alerta').val());
        var fecha_pago = new Date($('#fecha_pago').val()).getTime();
        var fecha_pago_limite = new Date('<?php echo $fecha_pago_limite; ?>').getTime();
        var dias_atraso_miliseg = fecha_pago - fecha_pago_limite;
        var dias_atraso = dias_atraso_miliseg/(1000*60*60*24);
        var ptj_interes_inmobiliaria = '<?php echo $ptj_interes_inmobiliaria; ?>';
        var monto_cuota_interes = parseFloat($('#monto_cuota_interes').val());
        var deduccion_retefuente = parseFloat($('#deduccion_retefuente').val());
        var deduccion_reparacion = parseFloat($('#deduccion_reparacion').val());

        var deduccion_otro_impuesto_dian = parseFloat($('#deduccion_otro_impuesto_dian').val());
        var ingreso_administracion_incluida = parseFloat($('#ingreso_administracion_incluida').val());
	    var total_recibido = 0;
	    var total_pendiente = 0;
	    var ingreso_gasto_juridica = parseFloat($('#ingreso_gasto_juridica').val());
	    var deduccion_saldo_favor = parseFloat($('#deduccion_saldo_favor').val());
        var ingreso_deudas_anteriores = parseFloat($('#ingreso_deudas_anteriores').val());

        var deduccion_servicio = parseFloat($('#deduccion_servicio').val());
        var deduccion_otro_concepto = parseFloat($('#deduccion_otro_concepto').val());
        var ingreso_otro_concepto = parseFloat($('#ingreso_otro_concepto').val());

        var total_deduccion = deduccion_retefuente + deduccion_reparacion + deduccion_servicio + deduccion_otro_impuesto_dian + deduccion_otro_concepto;
        var total_ingreso = monto_cuota_interes + ingreso_gasto_juridica + ingreso_administracion_incluida + monto_deuda_alerta + ingreso_deudas_anteriores + ingreso_otro_concepto;
        var subtotal_deduccion_ingreso = total_ingreso - total_deduccion;
        var total_pagar = subtotal_deduccion_ingreso;

	    $('#abonado').val(total_pagar);
	    var abonado = parseFloat($('#abonado').val());
	    var total_pendiente = total_pagar - abonado;
	    $('#monto_cuota_interes').val(monto_cuota_interes);
	    $('#dias_atraso').html(dias_atraso+" DIAS");
	    $('#total_pagar_hidden').val(total_pagar);
	    $('#total_pendiente_hidden').val(total_pendiente);
	    $('#total_recibido_hidden').val(abonado);
	    $('#total_deduccion_hidden').val(total_deduccion);
	    $('#total_ingreso_hidden').val(total_ingreso);

	    $('#deduccion_retefuente_hidden').val(deduccion_retefuente);
	    $('#monto_cuota_interes_hidden').val(monto_cuota_interes);
	    $('#deduccion_reparacion_hidden').val(deduccion_reparacion);

	    $('#ingreso_gasto_juridica_hidden').val(ingreso_gasto_juridica);
	    $('#deduccion_otro_impuesto_dian_hidden').val(deduccion_otro_impuesto_dian);
	    $('#ingreso_administracion_incluida_hidden').val(ingreso_administracion_incluida);
	    $('#deduccion_saldo_favor_hidden').val(deduccion_saldo_favor);
        $('#ingreso_deudas_anteriores_hidden').val(ingreso_deudas_anteriores);

        $('#deduccion_servicio_hidden').val(deduccion_servicio);
        $('#deduccion_otro_concepto_hidden').val(deduccion_otro_concepto);
        $('#ingreso_otro_concepto_hidden').val(ingreso_otro_concepto);
        $('#monto_deuda_alerta_hidden').val(monto_deuda_alerta);

    	document.getElementById("total_deduccion").innerHTML=total_deduccion.toLocaleString("es-ES");
    	document.getElementById("total_ingreso").innerHTML=total_ingreso.toLocaleString("es-ES");
        document.getElementById("total_pagar").innerHTML=total_pagar.toLocaleString("es-ES");
        document.getElementById("total_pendiente").innerHTML=total_pendiente.toLocaleString("es-ES");
    });
//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    $('#deduccion_servicio').change(function(){
        var monto_deuda_alerta = parseFloat($('#monto_deuda_alerta').val());
        var fecha_pago = new Date($('#fecha_pago').val()).getTime();
        var fecha_pago_limite = new Date('<?php echo $fecha_pago_limite; ?>').getTime();
        var dias_atraso_miliseg = fecha_pago - fecha_pago_limite;
        var dias_atraso = dias_atraso_miliseg/(1000*60*60*24);
        var ptj_interes_inmobiliaria = '<?php echo $ptj_interes_inmobiliaria; ?>';
        var monto_cuota_interes = parseFloat($('#monto_cuota_interes').val());
        var deduccion_retefuente = parseFloat($('#deduccion_retefuente').val());
        var deduccion_reparacion = parseFloat($('#deduccion_reparacion').val());

        var deduccion_otro_impuesto_dian = parseFloat($('#deduccion_otro_impuesto_dian').val());
        var ingreso_administracion_incluida = parseFloat($('#ingreso_administracion_incluida').val());
        var total_recibido = 0;
        var total_pendiente = 0;
        var ingreso_gasto_juridica = parseFloat($('#ingreso_gasto_juridica').val());
        var deduccion_saldo_favor = parseFloat($('#deduccion_saldo_favor').val());
        var ingreso_deudas_anteriores = parseFloat($('#ingreso_deudas_anteriores').val());

        var deduccion_servicio = parseFloat($('#deduccion_servicio').val());
        var deduccion_otro_concepto = parseFloat($('#deduccion_otro_concepto').val());
        var ingreso_otro_concepto = parseFloat($('#ingreso_otro_concepto').val());

        var total_deduccion = deduccion_retefuente + deduccion_reparacion + deduccion_servicio + deduccion_otro_impuesto_dian + deduccion_otro_concepto;
        var total_ingreso = monto_cuota_interes + ingreso_gasto_juridica + ingreso_administracion_incluida + monto_deuda_alerta + ingreso_deudas_anteriores + ingreso_otro_concepto;
        var subtotal_deduccion_ingreso = total_ingreso - total_deduccion;
        var total_pagar = subtotal_deduccion_ingreso;

        $('#abonado').val(total_pagar);
        var abonado = parseFloat($('#abonado').val());
        var total_pendiente = total_pagar - abonado;
        $('#monto_cuota_interes').val(monto_cuota_interes);
        $('#dias_atraso').html(dias_atraso+" DIAS");
        $('#total_pagar_hidden').val(total_pagar);
        $('#total_pendiente_hidden').val(total_pendiente);
        $('#total_recibido_hidden').val(abonado);
        $('#total_deduccion_hidden').val(total_deduccion);
        $('#total_ingreso_hidden').val(total_ingreso);

        $('#deduccion_retefuente_hidden').val(deduccion_retefuente);
        $('#monto_cuota_interes_hidden').val(monto_cuota_interes);
        $('#deduccion_reparacion_hidden').val(deduccion_reparacion);

        $('#ingreso_gasto_juridica_hidden').val(ingreso_gasto_juridica);
        $('#deduccion_otro_impuesto_dian_hidden').val(deduccion_otro_impuesto_dian);
        $('#ingreso_administracion_incluida_hidden').val(ingreso_administracion_incluida);
        $('#deduccion_saldo_favor_hidden').val(deduccion_saldo_favor);
        $('#ingreso_deudas_anteriores_hidden').val(ingreso_deudas_anteriores);

        $('#deduccion_servicio_hidden').val(deduccion_servicio);
        $('#deduccion_otro_concepto_hidden').val(deduccion_otro_concepto);
        $('#ingreso_otro_concepto_hidden').val(ingreso_otro_concepto);
        $('#monto_deuda_alerta_hidden').val(monto_deuda_alerta);

        document.getElementById("total_deduccion").innerHTML=total_deduccion.toLocaleString("es-ES");
        document.getElementById("total_ingreso").innerHTML=total_ingreso.toLocaleString("es-ES");
        document.getElementById("total_pagar").innerHTML=total_pagar.toLocaleString("es-ES");
        document.getElementById("total_pendiente").innerHTML=total_pendiente.toLocaleString("es-ES");
    });
//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    $('#deduccion_otro_concepto').change(function(){
        var monto_deuda_alerta = parseFloat($('#monto_deuda_alerta').val());
        var fecha_pago = new Date($('#fecha_pago').val()).getTime();
        var fecha_pago_limite = new Date('<?php echo $fecha_pago_limite; ?>').getTime();
        var dias_atraso_miliseg = fecha_pago - fecha_pago_limite;
        var dias_atraso = dias_atraso_miliseg/(1000*60*60*24);
        var ptj_interes_inmobiliaria = '<?php echo $ptj_interes_inmobiliaria; ?>';
        var monto_cuota_interes = parseFloat($('#monto_cuota_interes').val());
        var deduccion_retefuente = parseFloat($('#deduccion_retefuente').val());
        var deduccion_reparacion = parseFloat($('#deduccion_reparacion').val());

        var deduccion_otro_impuesto_dian = parseFloat($('#deduccion_otro_impuesto_dian').val());
        var ingreso_administracion_incluida = parseFloat($('#ingreso_administracion_incluida').val());
        var total_recibido = 0;
        var total_pendiente = 0;
        var ingreso_gasto_juridica = parseFloat($('#ingreso_gasto_juridica').val());
        var deduccion_saldo_favor = parseFloat($('#deduccion_saldo_favor').val());
        var ingreso_deudas_anteriores = parseFloat($('#ingreso_deudas_anteriores').val());

        var deduccion_servicio = parseFloat($('#deduccion_servicio').val());
        var deduccion_otro_concepto = parseFloat($('#deduccion_otro_concepto').val());
        var ingreso_otro_concepto = parseFloat($('#ingreso_otro_concepto').val());

        var total_deduccion = deduccion_retefuente + deduccion_reparacion + deduccion_servicio + deduccion_otro_impuesto_dian + deduccion_otro_concepto;
        var total_ingreso = monto_cuota_interes + ingreso_gasto_juridica + ingreso_administracion_incluida + monto_deuda_alerta + ingreso_deudas_anteriores + ingreso_otro_concepto;
        var subtotal_deduccion_ingreso = total_ingreso - total_deduccion;
        var total_pagar = subtotal_deduccion_ingreso;

        $('#abonado').val(total_pagar);
        var abonado = parseFloat($('#abonado').val());
        var total_pendiente = total_pagar - abonado;
        $('#monto_cuota_interes').val(monto_cuota_interes);
        $('#dias_atraso').html(dias_atraso+" DIAS");
        $('#total_pagar_hidden').val(total_pagar);
        $('#total_pendiente_hidden').val(total_pendiente);
        $('#total_recibido_hidden').val(abonado);
        $('#total_deduccion_hidden').val(total_deduccion);
        $('#total_ingreso_hidden').val(total_ingreso);

        $('#deduccion_retefuente_hidden').val(deduccion_retefuente);
        $('#monto_cuota_interes_hidden').val(monto_cuota_interes);
        $('#deduccion_reparacion_hidden').val(deduccion_reparacion);

        $('#ingreso_gasto_juridica_hidden').val(ingreso_gasto_juridica);
        $('#deduccion_otro_impuesto_dian_hidden').val(deduccion_otro_impuesto_dian);
        $('#ingreso_administracion_incluida_hidden').val(ingreso_administracion_incluida);
        $('#deduccion_saldo_favor_hidden').val(deduccion_saldo_favor);
        $('#ingreso_deudas_anteriores_hidden').val(ingreso_deudas_anteriores);

        $('#deduccion_servicio_hidden').val(deduccion_servicio);
        $('#deduccion_otro_concepto_hidden').val(deduccion_otro_concepto);
        $('#ingreso_otro_concepto_hidden').val(ingreso_otro_concepto);
        $('#monto_deuda_alerta_hidden').val(monto_deuda_alerta);

        document.getElementById("total_deduccion").innerHTML=total_deduccion.toLocaleString("es-ES");
        document.getElementById("total_ingreso").innerHTML=total_ingreso.toLocaleString("es-ES");
        document.getElementById("total_pagar").innerHTML=total_pagar.toLocaleString("es-ES");
        document.getElementById("total_pendiente").innerHTML=total_pendiente.toLocaleString("es-ES");
    });
//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    $('#monto_deuda_alerta').change(function(){
        var monto_deuda_alerta = parseFloat($('#monto_deuda_alerta').val());
        var fecha_pago = new Date($('#fecha_pago').val()).getTime();
        var fecha_pago_limite = new Date('<?php echo $fecha_pago_limite; ?>').getTime();
        var dias_atraso_miliseg = fecha_pago - fecha_pago_limite;
        var dias_atraso = dias_atraso_miliseg/(1000*60*60*24);
        var ptj_interes_inmobiliaria = '<?php echo $ptj_interes_inmobiliaria; ?>';
        var monto_cuota_interes = parseFloat($('#monto_cuota_interes').val());
        var deduccion_retefuente = parseFloat($('#deduccion_retefuente').val());
        var deduccion_reparacion = parseFloat($('#deduccion_reparacion').val());

        var deduccion_otro_impuesto_dian = parseFloat($('#deduccion_otro_impuesto_dian').val());
        var ingreso_administracion_incluida = parseFloat($('#ingreso_administracion_incluida').val());
        var total_recibido = 0;
        var total_pendiente = 0;
        var ingreso_gasto_juridica = parseFloat($('#ingreso_gasto_juridica').val());
        var deduccion_saldo_favor = parseFloat($('#deduccion_saldo_favor').val());
        var ingreso_deudas_anteriores = parseFloat($('#ingreso_deudas_anteriores').val());

        var deduccion_servicio = parseFloat($('#deduccion_servicio').val());
        var deduccion_otro_concepto = parseFloat($('#deduccion_otro_concepto').val());
        var ingreso_otro_concepto = parseFloat($('#ingreso_otro_concepto').val());

        var total_deduccion = deduccion_retefuente + deduccion_reparacion + deduccion_servicio + deduccion_otro_impuesto_dian + deduccion_otro_concepto;
        var total_ingreso = monto_cuota_interes + ingreso_gasto_juridica + ingreso_administracion_incluida + monto_deuda_alerta + ingreso_deudas_anteriores + ingreso_otro_concepto;
        var subtotal_deduccion_ingreso = total_ingreso - total_deduccion;
        var total_pagar = subtotal_deduccion_ingreso;

        $('#abonado').val(total_pagar);
        var abonado = parseFloat($('#abonado').val());
        var total_pendiente = total_pagar - abonado;
        $('#monto_cuota_interes').val(monto_cuota_interes);
        $('#dias_atraso').html(dias_atraso+" DIAS");
        $('#total_pagar_hidden').val(total_pagar);
        $('#total_pendiente_hidden').val(total_pendiente);
        $('#total_recibido_hidden').val(abonado);
        $('#total_deduccion_hidden').val(total_deduccion);
        $('#total_ingreso_hidden').val(total_ingreso);

        $('#deduccion_retefuente_hidden').val(deduccion_retefuente);
        $('#monto_cuota_interes_hidden').val(monto_cuota_interes);
        $('#deduccion_reparacion_hidden').val(deduccion_reparacion);

        $('#ingreso_gasto_juridica_hidden').val(ingreso_gasto_juridica);
        $('#deduccion_otro_impuesto_dian_hidden').val(deduccion_otro_impuesto_dian);
        $('#ingreso_administracion_incluida_hidden').val(ingreso_administracion_incluida);
        $('#deduccion_saldo_favor_hidden').val(deduccion_saldo_favor);
        $('#ingreso_deudas_anteriores_hidden').val(ingreso_deudas_anteriores);

        $('#deduccion_servicio_hidden').val(deduccion_servicio);
        $('#deduccion_otro_concepto_hidden').val(deduccion_otro_concepto);
        $('#ingreso_otro_concepto_hidden').val(ingreso_otro_concepto);
        $('#monto_deuda_alerta_hidden').val(monto_deuda_alerta);

        document.getElementById("total_deduccion").innerHTML=total_deduccion.toLocaleString("es-ES");
        document.getElementById("total_ingreso").innerHTML=total_ingreso.toLocaleString("es-ES");
        document.getElementById("total_pagar").innerHTML=total_pagar.toLocaleString("es-ES");
        document.getElementById("total_pendiente").innerHTML=total_pendiente.toLocaleString("es-ES");
    });
//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    $('#ingreso_otro_concepto').change(function(){
        var monto_deuda_alerta = parseFloat($('#monto_deuda_alerta').val());
        var fecha_pago = new Date($('#fecha_pago').val()).getTime();
        var fecha_pago_limite = new Date('<?php echo $fecha_pago_limite; ?>').getTime();
        var dias_atraso_miliseg = fecha_pago - fecha_pago_limite;
        var dias_atraso = dias_atraso_miliseg/(1000*60*60*24);
        var ptj_interes_inmobiliaria = '<?php echo $ptj_interes_inmobiliaria; ?>';
        var monto_cuota_interes = parseFloat($('#monto_cuota_interes').val());
        var deduccion_retefuente = parseFloat($('#deduccion_retefuente').val());
        var deduccion_reparacion = parseFloat($('#deduccion_reparacion').val());

        var deduccion_otro_impuesto_dian = parseFloat($('#deduccion_otro_impuesto_dian').val());
        var ingreso_administracion_incluida = parseFloat($('#ingreso_administracion_incluida').val());
        var total_recibido = 0;
        var total_pendiente = 0;
        var ingreso_gasto_juridica = parseFloat($('#ingreso_gasto_juridica').val());
        var deduccion_saldo_favor = parseFloat($('#deduccion_saldo_favor').val());
        var ingreso_deudas_anteriores = parseFloat($('#ingreso_deudas_anteriores').val());

        var deduccion_servicio = parseFloat($('#deduccion_servicio').val());
        var deduccion_otro_concepto = parseFloat($('#deduccion_otro_concepto').val());
        var ingreso_otro_concepto = parseFloat($('#ingreso_otro_concepto').val());

        var total_deduccion = deduccion_retefuente + deduccion_reparacion + deduccion_servicio + deduccion_otro_impuesto_dian + deduccion_otro_concepto;
        var total_ingreso = monto_cuota_interes + ingreso_gasto_juridica + ingreso_administracion_incluida + monto_deuda_alerta + ingreso_deudas_anteriores + ingreso_otro_concepto;
        var subtotal_deduccion_ingreso = total_ingreso - total_deduccion;
        var total_pagar = subtotal_deduccion_ingreso;

        $('#abonado').val(total_pagar);
        var abonado = parseFloat($('#abonado').val());
        var total_pendiente = total_pagar - abonado;
        $('#monto_cuota_interes').val(monto_cuota_interes);
        $('#dias_atraso').html(dias_atraso+" DIAS");
        $('#total_pagar_hidden').val(total_pagar);
        $('#total_pendiente_hidden').val(total_pendiente);
        $('#total_recibido_hidden').val(abonado);
        $('#total_deduccion_hidden').val(total_deduccion);
        $('#total_ingreso_hidden').val(total_ingreso);

        $('#deduccion_retefuente_hidden').val(deduccion_retefuente);
        $('#monto_cuota_interes_hidden').val(monto_cuota_interes);
        $('#deduccion_reparacion_hidden').val(deduccion_reparacion);

        $('#ingreso_gasto_juridica_hidden').val(ingreso_gasto_juridica);
        $('#deduccion_otro_impuesto_dian_hidden').val(deduccion_otro_impuesto_dian);
        $('#ingreso_administracion_incluida_hidden').val(ingreso_administracion_incluida);
        $('#deduccion_saldo_favor_hidden').val(deduccion_saldo_favor);
        $('#ingreso_deudas_anteriores_hidden').val(ingreso_deudas_anteriores);

        $('#deduccion_servicio_hidden').val(deduccion_servicio);
        $('#deduccion_otro_concepto_hidden').val(deduccion_otro_concepto);
        $('#ingreso_otro_concepto_hidden').val(ingreso_otro_concepto);
        $('#monto_deuda_alerta_hidden').val(monto_deuda_alerta);

        document.getElementById("total_deduccion").innerHTML=total_deduccion.toLocaleString("es-ES");
        document.getElementById("total_ingreso").innerHTML=total_ingreso.toLocaleString("es-ES");
        document.getElementById("total_pagar").innerHTML=total_pagar.toLocaleString("es-ES");
        document.getElementById("total_pendiente").innerHTML=total_pendiente.toLocaleString("es-ES");
    });
//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    $('#deduccion_otro_impuesto_dian').change(function(){
        var monto_deuda_alerta = parseFloat($('#monto_deuda_alerta').val());
        var fecha_pago = new Date($('#fecha_pago').val()).getTime();
        var fecha_pago_limite = new Date('<?php echo $fecha_pago_limite; ?>').getTime();
        var dias_atraso_miliseg = fecha_pago - fecha_pago_limite;
        var dias_atraso = dias_atraso_miliseg/(1000*60*60*24);
        var ptj_interes_inmobiliaria = '<?php echo $ptj_interes_inmobiliaria; ?>';
        var monto_cuota_interes = parseFloat($('#monto_cuota_interes').val());
        var deduccion_retefuente = parseFloat($('#deduccion_retefuente').val());
        var deduccion_reparacion = parseFloat($('#deduccion_reparacion').val());

        var deduccion_otro_impuesto_dian = parseFloat($('#deduccion_otro_impuesto_dian').val());
        var ingreso_administracion_incluida = parseFloat($('#ingreso_administracion_incluida').val());
	    var total_recibido = 0;
	    var total_pendiente = 0;
	    var ingreso_gasto_juridica = parseFloat($('#ingreso_gasto_juridica').val());
	    var deduccion_saldo_favor = parseFloat($('#deduccion_saldo_favor').val());
        var ingreso_deudas_anteriores = parseFloat($('#ingreso_deudas_anteriores').val());

        var deduccion_servicio = parseFloat($('#deduccion_servicio').val());
        var deduccion_otro_concepto = parseFloat($('#deduccion_otro_concepto').val());
        var ingreso_otro_concepto = parseFloat($('#ingreso_otro_concepto').val());

        var total_deduccion = deduccion_retefuente + deduccion_reparacion + deduccion_servicio + deduccion_otro_impuesto_dian + deduccion_otro_concepto;
        var total_ingreso = monto_cuota_interes + ingreso_gasto_juridica + ingreso_administracion_incluida + monto_deuda_alerta + ingreso_deudas_anteriores + ingreso_otro_concepto;
        var subtotal_deduccion_ingreso = total_ingreso - total_deduccion;
        var total_pagar = subtotal_deduccion_ingreso;

	    $('#abonado').val(total_pagar);
	    var abonado = parseFloat($('#abonado').val());
	    var total_pendiente = total_pagar - abonado;
	    $('#monto_cuota_interes').val(monto_cuota_interes);
	    $('#dias_atraso').html(dias_atraso+" DIAS");
	    $('#total_pagar_hidden').val(total_pagar);
	    $('#total_pendiente_hidden').val(total_pendiente);
	    $('#total_recibido_hidden').val(abonado);
	    $('#total_deduccion_hidden').val(total_deduccion);
	    $('#total_ingreso_hidden').val(total_ingreso);

	    $('#deduccion_retefuente_hidden').val(deduccion_retefuente);
	    $('#monto_cuota_interes_hidden').val(monto_cuota_interes);
	    $('#deduccion_reparacion_hidden').val(deduccion_reparacion);

	    $('#ingreso_gasto_juridica_hidden').val(ingreso_gasto_juridica);
	    $('#deduccion_otro_impuesto_dian_hidden').val(deduccion_otro_impuesto_dian);
	    $('#ingreso_administracion_incluida_hidden').val(ingreso_administracion_incluida);
	    $('#deduccion_saldo_favor_hidden').val(deduccion_saldo_favor);
        $('#ingreso_deudas_anteriores_hidden').val(ingreso_deudas_anteriores);

        $('#deduccion_servicio_hidden').val(deduccion_servicio);
        $('#deduccion_otro_concepto_hidden').val(deduccion_otro_concepto);
        $('#ingreso_otro_concepto_hidden').val(ingreso_otro_concepto);
        $('#monto_deuda_alerta_hidden').val(monto_deuda_alerta);

    	document.getElementById("total_deduccion").innerHTML=total_deduccion.toLocaleString("es-ES");
    	document.getElementById("total_ingreso").innerHTML=total_ingreso.toLocaleString("es-ES");
        document.getElementById("total_pagar").innerHTML=total_pagar.toLocaleString("es-ES");
        document.getElementById("total_pendiente").innerHTML=total_pendiente.toLocaleString("es-ES");
    });
//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    $('#ingreso_administracion_incluida').change(function(){
        var monto_deuda_alerta = parseFloat($('#monto_deuda_alerta').val());
        var fecha_pago = new Date($('#fecha_pago').val()).getTime();
        var fecha_pago_limite = new Date('<?php echo $fecha_pago_limite; ?>').getTime();
        var dias_atraso_miliseg = fecha_pago - fecha_pago_limite;
        var dias_atraso = dias_atraso_miliseg/(1000*60*60*24);
        var ptj_interes_inmobiliaria = '<?php echo $ptj_interes_inmobiliaria; ?>';
        var monto_cuota_interes = parseFloat($('#monto_cuota_interes').val());
        var deduccion_retefuente = parseFloat($('#deduccion_retefuente').val());
        var deduccion_reparacion = parseFloat($('#deduccion_reparacion').val());

        var deduccion_otro_impuesto_dian = parseFloat($('#deduccion_otro_impuesto_dian').val());
        var ingreso_administracion_incluida = parseFloat($('#ingreso_administracion_incluida').val());
	    var total_recibido = 0;
	    var total_pendiente = 0;
	    var ingreso_gasto_juridica = parseFloat($('#ingreso_gasto_juridica').val());
	    var deduccion_saldo_favor = parseFloat($('#deduccion_saldo_favor').val());
        var ingreso_deudas_anteriores = parseFloat($('#ingreso_deudas_anteriores').val());

        var deduccion_servicio = parseFloat($('#deduccion_servicio').val());
        var deduccion_otro_concepto = parseFloat($('#deduccion_otro_concepto').val());
        var ingreso_otro_concepto = parseFloat($('#ingreso_otro_concepto').val());

        var total_deduccion = deduccion_retefuente + deduccion_reparacion + deduccion_servicio + deduccion_otro_impuesto_dian + deduccion_otro_concepto;
        var total_ingreso = monto_cuota_interes + ingreso_gasto_juridica + ingreso_administracion_incluida + monto_deuda_alerta + ingreso_deudas_anteriores + ingreso_otro_concepto;
        var subtotal_deduccion_ingreso = total_ingreso - total_deduccion;
        var total_pagar = subtotal_deduccion_ingreso;

	    $('#abonado').val(total_pagar);
	    var abonado = parseFloat($('#abonado').val());
	    var total_pendiente = total_pagar - abonado;
	    $('#monto_cuota_interes').val(monto_cuota_interes);
	    $('#dias_atraso').html(dias_atraso+" DIAS");
	    $('#total_pagar_hidden').val(total_pagar);
	    $('#total_pendiente_hidden').val(total_pendiente);
	    $('#total_recibido_hidden').val(abonado);
	    $('#total_deduccion_hidden').val(total_deduccion);
	    $('#total_ingreso_hidden').val(total_ingreso);

	    $('#deduccion_retefuente_hidden').val(deduccion_retefuente);
	    $('#monto_cuota_interes_hidden').val(monto_cuota_interes);
	    $('#deduccion_reparacion_hidden').val(deduccion_reparacion);

	    $('#ingreso_gasto_juridica_hidden').val(ingreso_gasto_juridica);
	    $('#deduccion_otro_impuesto_dian_hidden').val(deduccion_otro_impuesto_dian);
	    $('#ingreso_administracion_incluida_hidden').val(ingreso_administracion_incluida);
	    $('#deduccion_saldo_favor_hidden').val(deduccion_saldo_favor);
        $('#ingreso_deudas_anteriores_hidden').val(ingreso_deudas_anteriores);

        $('#deduccion_servicio_hidden').val(deduccion_servicio);
        $('#deduccion_otro_concepto_hidden').val(deduccion_otro_concepto);
        $('#ingreso_otro_concepto_hidden').val(ingreso_otro_concepto);
        $('#monto_deuda_alerta_hidden').val(monto_deuda_alerta);

    	document.getElementById("total_deduccion").innerHTML=total_deduccion.toLocaleString("es-ES");
    	document.getElementById("total_ingreso").innerHTML=total_ingreso.toLocaleString("es-ES");
        document.getElementById("total_pagar").innerHTML=total_pagar.toLocaleString("es-ES");
        document.getElementById("total_pendiente").innerHTML=total_pendiente.toLocaleString("es-ES");
    });
//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    $('#ingreso_gasto_juridica').change(function(){
        var monto_deuda_alerta = parseFloat($('#monto_deuda_alerta').val());
        var fecha_pago = new Date($('#fecha_pago').val()).getTime();
        var fecha_pago_limite = new Date('<?php echo $fecha_pago_limite; ?>').getTime();
        var dias_atraso_miliseg = fecha_pago - fecha_pago_limite;
        var dias_atraso = dias_atraso_miliseg/(1000*60*60*24);
        var ptj_interes_inmobiliaria = '<?php echo $ptj_interes_inmobiliaria; ?>';
        var monto_cuota_interes = parseFloat($('#monto_cuota_interes').val());
        var deduccion_retefuente = parseFloat($('#deduccion_retefuente').val());
        var deduccion_reparacion = parseFloat($('#deduccion_reparacion').val());

        var deduccion_otro_impuesto_dian = parseFloat($('#deduccion_otro_impuesto_dian').val());
        var ingreso_administracion_incluida = parseFloat($('#ingreso_administracion_incluida').val());
	    var total_recibido = 0;
	    var total_pendiente = 0;
	    var ingreso_gasto_juridica = parseFloat($('#ingreso_gasto_juridica').val());
	    var deduccion_saldo_favor = parseFloat($('#deduccion_saldo_favor').val());
        var ingreso_deudas_anteriores = parseFloat($('#ingreso_deudas_anteriores').val());

        var deduccion_servicio = parseFloat($('#deduccion_servicio').val());
        var deduccion_otro_concepto = parseFloat($('#deduccion_otro_concepto').val());
        var ingreso_otro_concepto = parseFloat($('#ingreso_otro_concepto').val());

        var total_deduccion = deduccion_retefuente + deduccion_reparacion + deduccion_servicio + deduccion_otro_impuesto_dian + deduccion_otro_concepto;
        var total_ingreso = monto_cuota_interes + ingreso_gasto_juridica + ingreso_administracion_incluida + monto_deuda_alerta + ingreso_deudas_anteriores + ingreso_otro_concepto;
        var subtotal_deduccion_ingreso = total_ingreso - total_deduccion;
        var total_pagar = subtotal_deduccion_ingreso;

	    $('#abonado').val(total_pagar);
	    var abonado = parseFloat($('#abonado').val());
	    var total_pendiente = total_pagar - abonado;
	    $('#monto_cuota_interes').val(monto_cuota_interes);
	    $('#dias_atraso').html(dias_atraso+" DIAS");
	    $('#total_pagar_hidden').val(total_pagar);
	    $('#total_pendiente_hidden').val(total_pendiente);
	    $('#total_recibido_hidden').val(abonado);
	    $('#total_deduccion_hidden').val(total_deduccion);
	    $('#total_ingreso_hidden').val(total_ingreso);

	    $('#deduccion_retefuente_hidden').val(deduccion_retefuente);
	    $('#monto_cuota_interes_hidden').val(monto_cuota_interes);
	    $('#deduccion_reparacion_hidden').val(deduccion_reparacion);

	    $('#ingreso_gasto_juridica_hidden').val(ingreso_gasto_juridica);
	    $('#deduccion_otro_impuesto_dian_hidden').val(deduccion_otro_impuesto_dian);
	    $('#ingreso_administracion_incluida_hidden').val(ingreso_administracion_incluida);
	    $('#deduccion_saldo_favor_hidden').val(deduccion_saldo_favor);
        $('#ingreso_deudas_anteriores_hidden').val(ingreso_deudas_anteriores);

        $('#deduccion_servicio_hidden').val(deduccion_servicio);
        $('#deduccion_otro_concepto_hidden').val(deduccion_otro_concepto);
        $('#ingreso_otro_concepto_hidden').val(ingreso_otro_concepto);
        $('#monto_deuda_alerta_hidden').val(monto_deuda_alerta);

    	document.getElementById("total_deduccion").innerHTML=total_deduccion.toLocaleString("es-ES");
    	document.getElementById("total_ingreso").innerHTML=total_ingreso.toLocaleString("es-ES");
        document.getElementById("total_pagar").innerHTML=total_pagar.toLocaleString("es-ES");
        document.getElementById("total_pendiente").innerHTML=total_pendiente.toLocaleString("es-ES");
    });
//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    $('#ingreso_deudas_anteriores').change(function(){
        var monto_deuda_alerta = parseFloat($('#monto_deuda_alerta').val());
        var fecha_pago = new Date($('#fecha_pago').val()).getTime();
        var fecha_pago_limite = new Date('<?php echo $fecha_pago_limite; ?>').getTime();
        var dias_atraso_miliseg = fecha_pago - fecha_pago_limite;
        var dias_atraso = dias_atraso_miliseg/(1000*60*60*24);
        var ptj_interes_inmobiliaria = '<?php echo $ptj_interes_inmobiliaria; ?>';
        var monto_cuota_interes = parseFloat($('#monto_cuota_interes').val());
        var deduccion_retefuente = parseFloat($('#deduccion_retefuente').val());
        var deduccion_reparacion = parseFloat($('#deduccion_reparacion').val());

        var deduccion_otro_impuesto_dian = parseFloat($('#deduccion_otro_impuesto_dian').val());
        var ingreso_administracion_incluida = parseFloat($('#ingreso_administracion_incluida').val());
        var total_recibido = 0;
        var total_pendiente = 0;
        var ingreso_gasto_juridica = parseFloat($('#ingreso_gasto_juridica').val());
        var deduccion_saldo_favor = parseFloat($('#deduccion_saldo_favor').val());
        var ingreso_deudas_anteriores = parseFloat($('#ingreso_deudas_anteriores').val());

        var deduccion_servicio = parseFloat($('#deduccion_servicio').val());
        var deduccion_otro_concepto = parseFloat($('#deduccion_otro_concepto').val());
        var ingreso_otro_concepto = parseFloat($('#ingreso_otro_concepto').val());

        var total_deduccion = deduccion_retefuente + deduccion_reparacion + deduccion_servicio + deduccion_otro_impuesto_dian + deduccion_otro_concepto;
        var total_ingreso = monto_cuota_interes + ingreso_gasto_juridica + ingreso_administracion_incluida + monto_deuda_alerta + ingreso_deudas_anteriores + ingreso_otro_concepto;
        var subtotal_deduccion_ingreso = total_ingreso - total_deduccion;
        var total_pagar = subtotal_deduccion_ingreso;

        $('#abonado').val(total_pagar);
        var abonado = parseFloat($('#abonado').val());
        var total_pendiente = total_pagar - abonado;
        $('#monto_cuota_interes').val(monto_cuota_interes);
        $('#dias_atraso').html(dias_atraso+" DIAS");
        $('#total_pagar_hidden').val(total_pagar);
        $('#total_pendiente_hidden').val(total_pendiente);
        $('#total_recibido_hidden').val(abonado);
        $('#total_deduccion_hidden').val(total_deduccion);
        $('#total_ingreso_hidden').val(total_ingreso);

        $('#deduccion_retefuente_hidden').val(deduccion_retefuente);
        $('#monto_cuota_interes_hidden').val(monto_cuota_interes);
        $('#deduccion_reparacion_hidden').val(deduccion_reparacion);

        $('#ingreso_gasto_juridica_hidden').val(ingreso_gasto_juridica);
        $('#deduccion_otro_impuesto_dian_hidden').val(deduccion_otro_impuesto_dian);
        $('#ingreso_administracion_incluida_hidden').val(ingreso_administracion_incluida);
        $('#deduccion_saldo_favor_hidden').val(deduccion_saldo_favor);
        $('#ingreso_deudas_anteriores_hidden').val(ingreso_deudas_anteriores);

        $('#deduccion_servicio_hidden').val(deduccion_servicio);
        $('#deduccion_otro_concepto_hidden').val(deduccion_otro_concepto);
        $('#ingreso_otro_concepto_hidden').val(ingreso_otro_concepto);
        $('#monto_deuda_alerta_hidden').val(monto_deuda_alerta);

        document.getElementById("total_deduccion").innerHTML=total_deduccion.toLocaleString("es-ES");
        document.getElementById("total_ingreso").innerHTML=total_ingreso.toLocaleString("es-ES");
        document.getElementById("total_pagar").innerHTML=total_pagar.toLocaleString("es-ES");
        document.getElementById("total_pendiente").innerHTML=total_pendiente.toLocaleString("es-ES");
    });
//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    $('#abonado').change(function(){
        var total_pagar_hidden = parseFloat($('#total_pagar_hidden').val());

	    var abonado = parseFloat($('#abonado').val());
	    var total_pendiente = total_pagar_hidden - abonado;
	    $('#total_pendiente_hidden').val(total_pendiente);
	    $('#total_recibido_hidden').val(abonado);

        document.getElementById("total_pendiente").innerHTML=total_pendiente.toLocaleString("es-ES");
    });
//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    $('#deduccion_saldo_favor').change(function(){
        var deduccion_reparacion = parseFloat($('#deduccion_reparacion').val());
        $('#deduccion_reparacion_hidden').val(deduccion_reparacion);
    });
//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------//
});
</script>
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
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
</body>
</html>