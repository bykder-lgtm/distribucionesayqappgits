<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css_chosen_600px.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
</head>
<body id="pageBody">
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php 
$pagina                         = addslashes($_GET['pagina']); 
$pagina_local                   = $_SERVER['PHP_SELF'];
$cod_cuentas_cobrar             = intval($_GET['cod_cuentas_cobrar']);
$cod_tercero                    = intval($_GET['cod_tercero']);
$cod_factura                    = intval($_GET['cod_factura']);
$pagina_regresar                = $pagina.'?cod_cuentas_cobrar='.$cod_cuentas_cobrar.'&cod_tercero='.$cod_tercero.'&cod_factura='.$cod_factura.'&pagina='.$pagina;
$pagina_regresar2               = $pagina;
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$fecha_impr                     = date("Ymd");
$hora_impr                      = date("His");
$fecha_hoy                      = date("Y-m-d");

$tab                            = "tbl15_cuentas_cobrar_eliminar_inmobiliaria";
$tipo                           = "eliminar";
$campo                          = "cod_cuentas_cobrar";
$nombre_tipo_tercero            = 'INQUILINO';
?>
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">

<div class="breadcrumbs">
<!--<a class="btn btn-info" href="../admin/menu_lista.php">Lista de Inmuebles</a>-->
<h4>
<a href="#">Editar Contrato</a>
<a class="btn btn-primary" href="<?php echo $pagina_regresar ?>">Regresar</a>
</h4>
</div>
<!--
<div class="breadcrumbs">
<a href="#"><h4>Cuentas por Cobrar</h4></a>
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
$monto_deuda_smtr                         = 0;
$abonado_smtr                             = 0;
$subtotal_smtr                            = 0;
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
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
$cod_tercero                    = $datos_total_facturas['cod_tercero'];
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
$sql_consulta_tipo_moneda = "SELECT nombre_tipo_moneda FROM tbl15_tipo_moneda WHERE cod_tipo_moneda = '$cod_tipo_moneda'";
$consulta_tipo_moneda = mysqli_query($conectar, $sql_consulta_tipo_moneda) or die(mysqli_error($conectar));
$total_tipo_moneda = mysqli_fetch_assoc($consulta_tipo_moneda);

$nombre_tipo_moneda             = $total_tipo_moneda['nombre_tipo_moneda'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_consulta_producto = "SELECT cod_producto_barra, nombre_tipo_producto, direccion_producto, descripcion_producto, cod_tercero FROM tbl15_producto WHERE (cod_producto = '$cod_producto')";
$consulta_producto = mysqli_query($conectar, $sql_consulta_producto) or die(mysqli_error($conectar));
$total_producto = mysqli_fetch_assoc($consulta_producto);

$cod_producto_barra                        = $total_producto['cod_producto_barra'];
$nombre_tipo_producto                      = $total_producto['nombre_tipo_producto'];
$direccion_producto                        = $total_producto['direccion_producto'];
$descripcion_producto                      = $total_producto['descripcion_producto'];
$cod_tercero_propietario                   = $total_producto['cod_tercero'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_consulta_estado_contrato = "SELECT nombre_estado_contrato FROM tbl15_estado_contrato WHERE cod_estado_contrato = '$cod_estado_contrato'";
$consulta_estado_contrato = mysqli_query($conectar, $sql_consulta_estado_contrato) or die(mysqli_error($conectar));
$total_estado_contrato = mysqli_fetch_assoc($consulta_estado_contrato);

$nombre_estado_contrato          = $total_estado_contrato['nombre_estado_contrato'];
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
?>
<script>
function printPageArea(areaID){

var cod_factura = "<?php echo $cod_factura_strpad ?>";
var estandar_barras = "code128";
var renderer = "css";

var settings = { output:renderer, bgColor: "#FFFFFF", color: "#000000", barWidth: 2, barHeight: 40, moduleSize: 5, posX: 10, posY: 20, addQuietZone: 1 };
$("#barcodeTarget").html("").show().barcode(cod_factura, estandar_barras, settings);

var printContent = document.getElementById(areaID);
var WinPrint = window.open('', '', 'width=400,height=1000');
WinPrint.document.write(printContent.innerHTML);
WinPrint.document.close();
WinPrint.focus();
WinPrint.print();
WinPrint.close();
}
</script>
<div class="table-responsive">
<!--
<table class="table table-striped">
<tr>
<td style="text-align: center;"><a href="javascript:void(0);" id="foco_btn_imprimir" onclick="printPageArea('area_imprimible_invisible')"><img src="../imagenes/imprimir_directa_pos.png" alt="imprimir"></a></td>
</tr>
</table>
-->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<form name="formulario_insersion" method="post" enctype="multipart/form-data" action="../admin/edit_cuentas_cobrar_detalle_factura_alquiler_reg.php">
    <fieldset>
<legend>INFORMACION DEL CONTRATO DE ALQUILER</legend>
<table border="1" class="table table-responsive">
    <thead>
        <tr>
            <th style="text-align:center">CODIGO CONTRATO</th>
            <?php if ($url_img_orig_producto <> '') { ?><th style="text-align:center">SOPORTE CONTRATO</th><?php } ?>
            <th style="text-align:center">ESTADO</th>
            <th style="text-align:center">ARCHIVAR CONTRATO</th>
            <th style="text-align:center">ID</th>
        </tr>
        <tr>
            <td style="text-align:center"><input class="form-control" name="cod_factura" type="number" value="<?php echo $cod_factura ?>" min="0" size="10" required></td>
            <?php if ($url_img_orig_producto <> '') { ?><td style="text-align:center"><a href="<?php echo $url_img_orig_producto ?>" target="_blank"><img src="../imagenes/adjuntar_archivo.png" class="img-polaroid" alt=""></a></td><?php } ?>          

            <td style="text-align:left">
                <select name="cod_estado_contrato" id="cod_estado_contrato" class="input-block-level" data-show-subtext="true" data-live-search="true" required>
                    <?php if (isset($cod_estado_contrato)) { echo ""; } else { echo ""; }
                    $consulta2_sql = ("SELECT cod_estado_contrato, nombre_estado_contrato FROM tbl15_estado_contrato");
                    $consulta2 = mysqli_query($conectar, $consulta2_sql);
                    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                    if(isset($cod_estado_contrato) and $cod_estado_contrato == $datos2['cod_estado_contrato']) {
                    $seleccionado = "selected"; } else { $seleccionado = ""; }
                    $codigo = $datos2['cod_estado_contrato'];
                    $nombre = $datos2['nombre_estado_contrato'];
                    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                </select>
            </td>
            <td style="text-align:center"><a href="../admin/eliminar.php?llave=<?php echo $cod_cuentas_cobrar ?>&tab=<?php echo $tab ?>&tipo=<?php echo $tipo ?>&campo=<?php echo $campo ?>&cod_tercero=<?php echo $cod_tercero ?>&cod_factura=<?php echo $cod_factura ?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/eliminar.png" class="img-polaroid" alt=""></a></td>         
            <td style="text-align:center"><?php echo $cod_cuentas_cobrar ?></td>
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
            <th style="text-align:left">NOMBRE INQUILINO</th>
        </tr>
        <tr>
            <td style="text-align:left">
                <select name="cod_tercero" id="cod_tercero" class="chosen-select" data-show-subtext="true" data-live-search="true" required>
                    <?php if (isset($cod_tercero)) { echo ""; } else { echo ""; }
                    $consulta2_sql = ("SELECT cod_tercero, identificacion_tercero, digito_tercero, nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero 
                    FROM tbl15_tercero WHERE ((nombre_tipo_tercero = '$nombre_tipo_tercero') OR (nombre_tipo_tercero = 'AMBOS')) ORDER BY cod_tercero ASC");
                    $consulta2 = mysqli_query($conectar, $consulta2_sql);
                    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                    if(isset($cod_tercero) and $cod_tercero == $datos2['cod_tercero']) {
                    $seleccionado = "selected"; } else { $seleccionado = ""; }
                    $codigo = $datos2['cod_tercero'];
                    $nombre = $datos2['nombre1_tercero'].' - '.$datos2['identificacion_tercero'];
                    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                </select>
            </td>
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
            <th style="text-align:left">PROPIETARIO - CODIGO - NOMBRE INMUEBLE</th>
        </tr>
        <tr>
            <td style="text-align:left">
                <select name="cod_producto_barra" id="cod_producto_barra" class="chosen-select" data-show-subtext="true" data-live-search="true" required>
                    <?php if (isset($cod_producto_barra)) { echo ""; } else { echo ""; }
                    $consulta2_sql = ("SELECT tbl15_producto.cod_producto, tbl15_producto.cod_producto_barra, tbl15_producto.nombre_producto, tbl15_tercero.nombre1_tercero
                    FROM tbl15_tercero RIGHT JOIN tbl15_producto ON tbl15_tercero.cod_tercero = tbl15_producto.cod_tercero WHERE (tbl15_producto.cod_estado_inmueble = '1') ORDER BY tbl15_tercero.cod_tercero ASC");
                    $consulta2 = mysqli_query($conectar, $consulta2_sql);
                    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                    if(isset($cod_producto_barra) and $cod_producto_barra == $datos2['cod_producto_barra']) {
                    $seleccionado = "selected"; } else { $seleccionado = ""; }
                    $codigo = $datos2['cod_producto_barra'];
                    $nombre = $datos2['nombre1_tercero'].' - '.$datos2['cod_producto_barra'].' - '.$datos2['nombre_producto'];
                    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                </select>
            </td>
        </tr>
    </thead>
</table>

<table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; width:100%">
    <tbody>
        <tr>
        <input type="hidden" name="cod_cuentas_cobrar" value="<?php echo $cod_cuentas_cobrar ?>">
        <input type="hidden" name="pagina" value="<?php echo $pagina_regresar ?>">
        <input type="hidden" name="pagina2" value="<?php echo $pagina_regresar2 ?>">       
        <input type="hidden" name="cod_administrador" value="<?php echo $cod_administrador ?>">
        <input type="hidden" name="ins_edit" value="formulario_insert_edit">
        <hr>
        <div class="actions">
            <td style="text-align:center"><input type="submit" value="Guardar Información" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" /></td>
        </div>
        </tr>
    </tbody>
</table>
</form>
<br><br>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
    <thead>
        <tr>
            <th style="text-align:center">TIPO ALQUILER</th>
            <th style="text-align:center">CANTIDAD DE PERIODOS</th>
            <th style="text-align:center">TIPO MONEDA</th>
            <th style="text-align:center">PRECIO ALQUILER</th>
            <th style="text-align:center">EDITAR</th>
        </tr>
        <tr>
            <td style="text-align:center"><?php echo $nombre_tipo_cobro ?></td>
            <td style="text-align:center"><?php echo $numero_cuota ?></td>
            <td style="text-align:center"><?php echo $nombre_tipo_moneda ?></td>
            <td style="text-align:center"><?php echo number_format($monto_cuota, 0, ",", ".") ?></td>
            <td style="text-align:center"><a href="../admin/edit_cuentas_cobrar_detalle_factura_alquiler_rango_pago.php?cod_cuentas_cobrar=<?php echo $cod_cuentas_cobrar ?>&cod_tercero=<?php echo $cod_tercero ?>&cod_factura=<?php echo $cod_factura ?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/editar.png" class="img-polaroid" alt=""></a></td>         
        </tr>
    </thead>
</table>
</fieldset>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<fieldset>
<legend>HISTORIAL DE PAGO</legend>
<table class="table table-striped">
<tr>
<td style="text-align: center;"><strong>NUMERO DE PERIODO</strong></td>
<td style="text-align: center;"><strong>MES</strong></td>
<td style="text-align: center;"><strong>PRECIO ALQUILER</strong></td>
<td style="text-align: center;"><strong>FECHA LIMITE PAGO</strong></td>
<td style="text-align: center;"><strong>REG PAGO</strong></td>
<td style="text-align: center;"><strong>ESTADO PAGO</strong></td>
</tr>
<?php
$calcular_datos_cuenta_cobrar = "SELECT * FROM tbl15_cuentas_cobrar_alerta WHERE (cod_cuentas_cobrar='$cod_cuentas_cobrar') ORDER BY fecha_pago ASC";
$consulta_datos_cuenta_cobrar = mysqli_query($conectar, $calcular_datos_cuenta_cobrar);
$total_datos = mysqli_num_rows($consulta_datos_cuenta_cobrar);
while ($datos_cuenta_cobrar = mysqli_fetch_assoc($consulta_datos_cuenta_cobrar)) {

$cod_cuentas_cobrar_alerta      = $datos_cuenta_cobrar['cod_cuentas_cobrar_alerta'];
$cod_cuentas_cobrar             = $datos_cuenta_cobrar['cod_cuentas_cobrar'];
$numero_alerta                  = $datos_cuenta_cobrar['numero_alerta'];
$cod_factura                    = $datos_cuenta_cobrar['cod_factura'];
$monto_deuda                    = $datos_cuenta_cobrar['monto_deuda'];
$abonado                        = $datos_cuenta_cobrar['abonado'];
$subtotal                       = $datos_cuenta_cobrar['subtotal'];
$mensaje                        = $datos_cuenta_cobrar['mensaje'];
$fecha_pago                     = $datos_cuenta_cobrar['fecha_pago'];
$vendedor                       = $datos_cuenta_cobrar['vendedor'];
$monto_deuda_smtr               = $monto_deuda_smtr + $monto_deuda;
$monto_cuota                    = $datos_cuenta_cobrar['monto_cuota'];
$cod_estado                     = $datos_cuenta_cobrar['cod_estado'];
$fecha_pago_reg                 = $datos_cuenta_cobrar['fecha_pago_reg'];
$hora_pago_reg                  = $datos_cuenta_cobrar['hora_pago_reg'];
$cod_cuentas_cobrar_abonos      = $datos_cuenta_cobrar['cod_cuentas_cobrar_abonos'];

$abonado_smtr                   = $abonado_smtr + $abonado;
$subtotal_smtr                  = $subtotal_smtr + $subtotal;

$nombre_tabla_mes               = date("m", strtotime($fecha_pago));

$mostrar_datos_sql = "SELECT nombre_letra_tabla_mes FROM tbl15_tabla_mes WHERE nombre_tabla_mes  = '$nombre_tabla_mes'";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
$matriz_consulta = mysqli_fetch_assoc($consulta);

$nombre_letra_tabla_mes         = $matriz_consulta['nombre_letra_tabla_mes'];

if ($fecha_hoy == $fecha_pago) { $btn_imagen = 'base_caja_pago_hoy.gif'; } elseif ($fecha_hoy > $fecha_pago) { $btn_imagen = 'base_caja_pago_atrasado.gif'; } else { $btn_imagen = 'base_caja.png'; }
if ($cod_estado == '0') { $nombre_estado = 'PENDIENTE'; $estilo_letra = 'class="text-success"'; } elseif ($cod_estado == '1') { $nombre_estado = 'CANCELADO'; $estilo_letra = 'class="text-warning"'; } else { $nombre_estado = 'EN DEUDA'; $estilo_letra = 'class="text-danger"'; }
?>
<tr>
<td style="text-align: center;"><font size='3'><?php echo $numero_alerta;?></font></td>
<td style="text-align: center;"><font size='3'><?php echo $nombre_letra_tabla_mes ;?></font></td>
<td style="text-align: center;"><font size='3'><?php echo number_format($monto_cuota, 0, ",", ".") ?></font></a></td>
<td style="text-align: center;"><font size='3'><?php echo $fecha_pago;?></font></td>
<td style="text-align: center;"><font size='3'><?php echo $fecha_pago_reg;?></font></td>
<td style="text-align: center;" <?php echo $estilo_letra;?>><font size='3'><?php echo $nombre_estado;?></font></td>
</tr>
<?php } ?>
</table>
</fieldset>
<br>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
	</div>
</div>
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
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