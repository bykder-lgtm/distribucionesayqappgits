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
$pagina_local                   = $_SERVER['PHP_SELF'];
$cod_administrador_sesion       = $cod_administrador;

$cod_cuentas_cobrar             = intval($_GET['cod_cuentas_cobrar']);
$cod_tercero                    = intval($_GET['cod_tercero']);
$cod_factura                    = intval($_GET['cod_factura']);
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
if (isset($_GET['cod_cuentas_cobrar_alerta'])) { 

$cod_cuentas_cobrar_alerta                = intval($_GET['cod_cuentas_cobrar_alerta']);
$fecha_mes                                = addslashes($_GET['fecha_mes']);
$nombre_tabla_mes                         = addslashes($_GET['nombre_tabla_mes']);
$nombre_tabla_anyo                        = addslashes($_GET['nombre_tabla_anyo']);
$cod_estado_envio_correo_cuenta_cobro     = addslashes($_GET['cod_estado_envio_correo_cuenta_cobro']);
$pagina                                   = addslashes($_GET['pagina']);


if (isset($_GET['cod_cuentas_cobrar']) <> '') { $cod_cuentas_cobrar = addslashes($_GET['cod_cuentas_cobrar']); } else { $cod_cuentas_cobrar = ''; }
if (isset($_GET['cod_cuentas_cobrar_abonos']) <> '') { $cod_cuentas_cobrar_abonos = addslashes($_GET['cod_cuentas_cobrar_abonos']); } else { $cod_cuentas_cobrar_abonos = ''; }
if (isset($_GET['cod_factura']) <> '') { $cod_factura = addslashes($_GET['cod_factura']); } else { $cod_factura = ''; }
if (isset($_GET['cod_tercero']) <> '') { $cod_tercero = addslashes($_GET['cod_tercero']); } else { $cod_tercero = ''; }
if (isset($_GET['cliente']) <> '') { $cliente = addslashes($_GET['cliente']); } else { $cliente = ''; }
if (isset($_GET['cod_estado_pago']) <> '') { $cod_estado_pago = addslashes($_GET['cod_estado_pago']); } else { $cod_estado_pago = ''; }
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$pagina_redirect                   = '../admin/cuenta_cobro_agrupado_alquiler_historial_detalle.php?fecha_mes='.$fecha_mes.'&nombre_tabla_mes='.$nombre_tabla_mes.'&nombre_tabla_anyo='.$nombre_tabla_anyo.'&cod_estado_envio_correo_cuenta_cobro='.$cod_estado_envio_correo_cuenta_cobro.'&pagina='.$pagina.'&cod_cuentas_cobrar='.$cod_cuentas_cobrar.'&cod_cuentas_cobrar_abonos='.$cod_cuentas_cobrar_abonos.'&cod_factura='.$cod_factura.'&cod_tercero='.$cod_tercero.'&cod_estado_pago='.$cod_estado_pago.'&cliente='.$cliente;
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
$fecha_pago_reg                       = $datos_fecha_pago_alert['fecha_pago_reg'];
$monto_cuota_interes                  = $datos_fecha_pago_alert['monto_cuota_interes'];
$total_pagar                          = $datos_fecha_pago_alert['total_pagar'];

$deduccion_servicio                   = $datos_fecha_pago_alert['deduccion_servicio'];
$deduccion_otro_concepto              = $datos_fecha_pago_alert['deduccion_otro_concepto'];
$ingreso_otro_concepto                = $datos_fecha_pago_alert['ingreso_otro_concepto'];
$cod_estado_pago                      = $datos_fecha_pago_alert['cod_estado_pago'];
$cod_estado_pago_propietario          = $datos_fecha_pago_alert['cod_estado_pago_propietario'];
$cod_estado_envio_correo_cuenta_cobro = $datos_fecha_pago_alert['cod_estado_envio_correo_cuenta_cobro'];

$deduccion_servicio_energia           = $datos_fecha_pago_alert['deduccion_servicio_energia'];
$deduccion_servicio_agua              = $datos_fecha_pago_alert['deduccion_servicio_agua'];
$deduccion_servicio_gas               = $datos_fecha_pago_alert['deduccion_servicio_gas'];
$deduccion_deudas_anteriores          = $datos_fecha_pago_alert['deduccion_deudas_anteriores'];
$cod_tipo_forma_pago                  = $datos_fecha_pago_alert['cod_tipo_forma_pago'];
$mensaje                              = $datos_fecha_pago_alert['mensaje'];
$fecha_alerta_pago_comision_prop      = $datos_fecha_pago_alert['fecha_alerta_pago_comision_prop'];
$fecha_mes_complet                    = $fecha_mes.'-01';
$nombre_tabla_mes                     = date("m", strtotime($fecha_mes_complet));

$mostrar_datos_sql = "SELECT nombre_letra_tabla_mes FROM tbl15_tabla_mes WHERE nombre_tabla_mes  = '$nombre_tabla_mes'";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
$matriz_consulta = mysqli_fetch_assoc($consulta);

$nombre_letra_tabla_mes               = $matriz_consulta['nombre_letra_tabla_mes'];
} else { 
$calcular_datos_cuenta_cobrar = "SELECT MAX(numero_alerta) AS numero_alerta FROM tbl15_cuentas_cobrar_abonos WHERE (cod_cuentas_cobrar = '$cod_cuentas_cobrar')";
$consulta_datos_cuenta_cobrar = mysqli_query($conectar, $calcular_datos_cuenta_cobrar) or die(mysqli_error($conectar));
$datos_cuenta_cobrar = mysqli_fetch_assoc($consulta_datos_cuenta_cobrar);

$numero_alerta                        = $datos_cuenta_cobrar['numero_alerta']+1;

$calcular_datos_cuenta_cobrar = "SELECT * FROM tbl15_cuentas_cobrar_alerta WHERE (cod_cuentas_cobrar = '$cod_cuentas_cobrar') AND (numero_alerta = '$numero_alerta')";
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
$fecha_pago_reg                       = $datos_fecha_pago_alert['fecha_pago_reg'];
$monto_cuota_interes                  = $datos_fecha_pago_alert['monto_cuota_interes'];
$total_pagar                          = $datos_fecha_pago_alert['total_pagar'];

$deduccion_servicio                   = $datos_fecha_pago_alert['deduccion_servicio'];
$deduccion_otro_concepto              = $datos_fecha_pago_alert['deduccion_otro_concepto'];
$ingreso_otro_concepto                = $datos_fecha_pago_alert['ingreso_otro_concepto'];
$cod_estado_pago                      = $datos_fecha_pago_alert['cod_estado_pago'];
$cod_estado_pago_propietario          = $datos_fecha_pago_alert['cod_estado_pago_propietario'];
$cod_estado_envio_correo_cuenta_cobro = $datos_fecha_pago_alert['cod_estado_envio_correo_cuenta_cobro'];

$deduccion_servicio_energia           = $datos_fecha_pago_alert['deduccion_servicio_energia'];
$deduccion_servicio_agua              = $datos_fecha_pago_alert['deduccion_servicio_agua'];
$deduccion_servicio_gas               = $datos_fecha_pago_alert['deduccion_servicio_gas'];
$deduccion_deudas_anteriores          = $datos_fecha_pago_alert['deduccion_deudas_anteriores'];
$cod_tipo_forma_pago                  = $datos_fecha_pago_alert['cod_tipo_forma_pago'];
$mensaje                              = $datos_fecha_pago_alert['mensaje'];
$fecha_alerta_pago_comision_prop      = $datos_fecha_pago_alert['fecha_alerta_pago_comision_prop'];
$fecha_mes_complet                    = $fecha_mes.'-01';
$nombre_tabla_mes                     = date("m", strtotime($fecha_mes_complet));

$mostrar_datos_sql = "SELECT nombre_letra_tabla_mes FROM tbl15_tabla_mes WHERE nombre_tabla_mes  = '$nombre_tabla_mes'";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
$matriz_consulta = mysqli_fetch_assoc($consulta);

$nombre_letra_tabla_mes               = $matriz_consulta['nombre_letra_tabla_mes'];
}
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
$sql_consulta_producto = "SELECT cod_producto_barra, nombre_tipo_producto, direccion_producto, descripcion_producto, cod_tercero, referencia_catastral_inmueble, 
numero_matricula_inmueble, dia_pago_propietario_inmueble, nombre_tipo_cobro_propietario_inmueble
FROM tbl15_producto WHERE (cod_producto = '$cod_producto')";
$consulta_producto = mysqli_query($conectar, $sql_consulta_producto) or die(mysqli_error($conectar));
$total_producto = mysqli_fetch_assoc($consulta_producto);

$cod_producto_barra                            = $total_producto['cod_producto_barra'];
$nombre_tipo_producto                          = $total_producto['nombre_tipo_producto'];
$direccion_producto                            = $total_producto['direccion_producto'];
$descripcion_producto                          = $total_producto['descripcion_producto'];
$cod_tercero_propietario                       = $total_producto['cod_tercero'];
$referencia_catastral_inmueble                 = $total_producto['referencia_catastral_inmueble'];
$numero_matricula_inmueble                     = $total_producto['numero_matricula_inmueble'];
$dia_pago_propietario_inmueble                 = $total_producto['dia_pago_propietario_inmueble'];
$nombre_tipo_cobro_propietario_inmueble        = $total_producto['nombre_tipo_cobro_propietario_inmueble'];
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
?>
<div class="table-responsive">
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
            <th style="text-align:center">ESTADO PAGO</th>
            <th style="text-align:center">MES</th>
            <th style="text-align:center">DIA DE PAGO</th>
            <th style="text-align:center">TIPO</th>
            <th style="text-align:center">FECHA ALERTA PAGO</th>
            <th style="text-align:center">BANCO</th>
        </tr>
        <tr>
            <td style="text-align:center">
                <select name="cod_estado_pago_propietario" id="cod_estado_pago_propietario" class="<?php echo $cod_cuentas_cobrar_alerta;?>" data-show-subtext="true" data-live-search="true" required>
                    <?php if (isset($cod_estado_pago_propietario)) { echo ""; } else { echo  ""; }
                    $consulta2_sql = "SELECT cod_estado_pago, nombre_estado_pago FROM tbl15_estado_pago WHERE (cod_estado = '1') ORDER BY cod_estado_pago ASC";
                    $consulta2 = mysqli_query($conectar, $consulta2_sql);
                    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                    if(isset($cod_estado_pago_propietario) AND $cod_estado_pago_propietario == $datos2['cod_estado_pago']) {
                    $seleccionado = "selected"; } else { $seleccionado = ""; }
                    $codigo = $datos2['cod_estado_pago'];
                    $nombre = $datos2['nombre_estado_pago'];
                    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                </select>
            </td>
            <td style="text-align:center"><?php echo $nombre_letra_tabla_mes;?></td>
            <td style="text-align:center"><?php echo date("d", strtotime($dia_pago_propietario_inmueble)); ?></td>
            <td style="text-align:center"><?php echo $nombre_tipo_cobro_propietario_inmueble;?></td>
            <td style="text-align:center"><input class="<?php echo $cod_cuentas_cobrar_alerta;?>" type="date" name="fecha_alerta_pago_comision_prop" id="fecha_alerta_pago_comision_prop" value="<?php echo $fecha_alerta_pago_comision_prop;?>"></td>
            <td style="text-align:center"><a href="https://sucursalpersonas.transaccionesbancolombia.com/" target="_blank"><img src=../imagenes/btn_bancolobia.png alt="btn_bancolobia"></a></td>
        </tr>

    </thead>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
    <thead>
        <tr>
            <th style="text-align:center;">ACTUALIZAR</th>
        </tr>
        <tr>
            <th style="text-align:center;"><a href="<?php echo $pagina_local ?>?cod_cuentas_cobrar_alerta=<?php echo $cod_cuentas_cobrar_alerta; ?>&cod_cuentas_cobrar=<?php echo $cod_cuentas_cobrar; ?>&cod_tercero=<?php echo $cod_tercero; ?>&cod_factura=<?php echo $cod_factura; ?>&fecha_mes=<?php echo $fecha_mes; ?>&nombre_tabla_mes=<?php echo $nombre_tabla_mes; ?>&nombre_tabla_anyo=<?php echo $nombre_tabla_anyo; ?>&cod_estado_envio_correo_cuenta_cobro=<?php echo $cod_estado_envio_correo_cuenta_cobro; ?>&pagina=<?php echo $pagina_local; ?>"><img src="../imagenes/boton_actualizar.png" class="img-polaroid" alt=""></a></th>
        </tr>
    </thead>
</table>

<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
</div>

<script>  
 $(document).ready(function(){  

  $('select[name="cod_estado_pago_propietario"]').change(function(){ 
  var cod_estado_pago_propietario = $(this).val();  
  var cod_cuentas_cobrar_alerta = $(this).attr('class');

  var tab = "tbl15_cuentas_cobrar_alerta";
  var tipo = "editar";
  var campo = "cod_estado_pago_propietario";

  let ids = this.id;
    $.ajax({ url:"edit_cuentas_cobro_estado_factura_alquiler_ajax_reg.php", method:"GET", data:{valor:cod_estado_pago_propietario, campo:"cod_estado_pago_propietario", tab:tab, tipo:tipo, campo:campo, id:cod_cuentas_cobrar_alerta }, success:function(data){ $('#result').html(data); }  
    });  
  });
 });  
 </script>

<script>  
 $(document).ready(function(){  

  $('select[name="cod_estado_envio_correo"]').change(function(){ 
  var cod_estado_envio_correo = $(this).val();  
  var cod_cuentas_cobrar_alerta = $(this).attr('class');

  var tab = "tbl15_cuentas_cobrar_alerta";
  var tipo = "editar";
  var campo = "cod_estado_envio_correo";

  let ids = this.id;
    $.ajax({ url:"edit_cuentas_cobro_estado_factura_alquiler_ajax_reg.php", method:"GET", data:{valor:cod_estado_envio_correo, campo:"cod_estado_envio_correo", tab:tab, tipo:tipo, campo:campo, id:cod_cuentas_cobrar_alerta }, success:function(data){ $('#result').html(data); }  
    });  
  });
 });  
 </script>

<script>  
 $(document).ready(function(){  

  $('select[name="cod_tipo_forma_pago"]').change(function(){ 
  var cod_tipo_forma_pago = $(this).val();  
  var cod_cuentas_cobrar_alerta = $(this).attr('class');

  var tab = "tbl15_cuentas_cobrar_alerta";
  var tipo = "editar";
  var campo = "cod_tipo_forma_pago";

  let ids = this.id;
    $.ajax({ url:"edit_cuentas_cobro_estado_factura_alquiler_ajax_reg.php", method:"GET", data:{valor:cod_tipo_forma_pago, campo:"cod_tipo_forma_pago", tab:tab, tipo:tipo, campo:campo, id:cod_cuentas_cobrar_alerta }, success:function(data){ $('#result').html(data); }  
    });  
  });
 });  
 </script>

 <script>  
 $(document).ready(function(){  

  $('textarea[name="mensaje"]').change(function(){ 
  var mensaje = $(this).val();  
  var cod_cuentas_cobrar_alerta = $(this).attr('class');

  var tab = "tbl15_cuentas_cobrar_alerta";
  var tipo = "editar";
  var campo = "mensaje";

  let ids = this.id;
    $.ajax({ url:"edit_cuentas_cobro_estado_factura_alquiler_ajax_reg.php", method:"GET", data:{valor:mensaje, campo:"mensaje", tab:tab, tipo:tipo, campo:campo, id:cod_cuentas_cobrar_alerta }, success:function(data){ $('#result').html(data); }  
    });  
  });
 });  
 </script>

 <script>  
 $(document).ready(function(){  

    $('input[name="fecha_alerta_pago_comision_prop"]').change(function(){ 
  var mensaje = $(this).val();  
  var cod_cuentas_cobrar_alerta = $(this).attr('class');

  var tab = "tbl15_cuentas_cobrar_alerta";
  var tipo = "editar";
  var campo = "fecha_alerta_pago_comision_prop";

  let ids = this.id;
    $.ajax({ url:"edit_cuentas_cobro_estado_factura_alquiler_ajax_reg.php", method:"GET", data:{valor:mensaje, campo:"fecha_alerta_pago_comision_prop", tab:tab, tipo:tipo, campo:campo, id:cod_cuentas_cobrar_alerta }, success:function(data){ $('#result').html(data); }  
    });  
  });
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