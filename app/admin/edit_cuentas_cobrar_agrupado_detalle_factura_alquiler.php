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

$tab                            = "tbl15_cuentas_cobrar_agrupado_eliminar_inmobiliaria";
$tab2                           = "tbl15_cuentas_cobrar_agrupado_archivar";
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
WHERE (tbl15_cuentas_cobrar.cod_factura = '$cod_factura') AND (tbl15_cuentas_cobrar.cod_estado_archivado = '0') ORDER BY tbl15_cuentas_cobrar.fecha_invert DESC";
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

<script>
function Eliminar_Archivar_Renovacion_agrupado_cod_cuentas_cobrar (valores_enviados_btn){

    var vector_frag = valores_enviados_btn.split('|');
    var cod_cuentas_cobrar = vector_frag[0];
    var cod_tercero = vector_frag[1];
    var cod_factura = vector_frag[2];
    var cod_renovacion_contrato = vector_frag[3];
    var pagina = vector_frag[4];

    var llave = cod_cuentas_cobrar;
    var tab = 'tbl15_cuentas_cobrar_Eliminar_Archivar_Renovacion_agrupado_cod_cuentas_cobrar_ajax';
    var tipo = 'archivar';
    var campo = 'cod_cuentas_cobrar';

    if (confirm("Realmente deseas archivar la renovacion # "+cod_renovacion_contrato+'?')){ 
        $.ajax({
        type: "GET",
        url: "../admin/eliminar_archivar_editar_cuenta_cobrar_renovacion_ajax.php",
        data: "llave="+llave+'&tab='+tab+'&tipo='+tipo+'&campo='+campo+'&cod_tercero='+cod_tercero+'&cod_factura='+cod_factura+'&pagina='+pagina,
        beforeSend: function(objeto){
            $("#resultados").html("Mensaje: Cargando...");
        },
        success: function(datos){
            $("#resultados").html(datos);
            window.location.reload();
        }
        });
    }
}
</script>

<script>
function Eliminar_Archivar_Renovacion_individual_cod_cuentas_cobrar_alerta (valores_enviados_btn){

    var vector_frag = valores_enviados_btn.split('|');
    var cod_cuentas_cobrar = vector_frag[0];
    var cod_cuentas_cobrar_alerta = vector_frag[1];
    var cod_tercero = vector_frag[2];
    var cod_factura = vector_frag[3];
    var cod_renovacion_contrato = vector_frag[4];
    var pagina = vector_frag[5];

    var llave = cod_cuentas_cobrar_alerta;
    var tab = 'Eliminar_Archivar_Renovacion_agrupado_cod_cuentas_cobrar';
    var tipo = 'archivar';
    var campo = 'cod_cuentas_cobrar_alerta';

    if (confirm("Realmente deseas archivar el registro ?")){ 
        $.ajax({
        type: "GET",
        url: "../admin/eliminar_archivar_editar_cuenta_cobrar_renovacion_ajax.php",
        data: "llave="+llave+'&tab='+tab+'&tipo='+tipo+'&campo='+campo+'&cod_cuentas_cobrar='+cod_cuentas_cobrar+'&cod_tercero='+cod_tercero+'&cod_factura='+cod_factura+'&pagina='+pagina,
        beforeSend: function(objeto){
            $("#resultados").html("Mensaje: Cargando...");
        },
        success: function(datos){
            $("#resultados").html(datos);
            window.location.reload();
        }
        });
    }
}
</script>

<!--
<script>
function Eliminar_Renovacion_agrupado_cod_cuentas_cobrar (valores_enviados_btn){

    var vector_frag = valores_enviados_btn.split('|');
    var cod_cuentas_cobrar = vector_frag[0];
    var cod_tercero = vector_frag[1];
    var cod_factura = vector_frag[2];
    var cod_renovacion_contrato = vector_frag[3];
    var pagina = vector_frag[4];

    var llave = cod_cuentas_cobrar;
    var tab = 'tbl15_cuentas_cobrar_Eliminar_Renovacion_agrupado_cod_cuentas_cobrar_ajax';
    var tipo = 'eliminar';
    var campo = 'cod_cuentas_cobrar';

    if (confirm("Realmente deseas eliminar la renovacion # "+cod_renovacion_contrato+'?')){ 
        $.ajax({
        type: "GET",
        url: "../admin/eliminar_editar_cuenta_cobrar_renovacion_ajax.php",
        data: "llave="+llave+'&tab='+tab+'&tipo='+tipo+'&campo='+campo+'&cod_tercero='+cod_tercero+'&cod_factura='+cod_factura+'&pagina='+pagina,
        beforeSend: function(objeto){
            $("#resultados").html("Mensaje: Cargando...");
        },
        success: function(datos){
            $("#resultados").html(datos);
            window.location.reload();
        }
        });
    }
}
</script>
-->
<!--
<script>
function Eliminar_Renovacion_individual_cod_cuentas_cobrar_alerta (valores_enviados_btn){

    var vector_frag = valores_enviados_btn.split('|');
    var cod_cuentas_cobrar = vector_frag[0];
    var cod_cuentas_cobrar_alerta = vector_frag[1];
    var cod_tercero = vector_frag[2];
    var cod_factura = vector_frag[3];
    var cod_renovacion_contrato = vector_frag[4];
    var pagina = vector_frag[5];

    var llave = cod_cuentas_cobrar_alerta;
    var tab = 'tbl15_cuentas_cobrar_Eliminar_Renovacion_cod_cuentas_cobrar_alerta_ajax';
    var tipo = 'eliminar';
    var campo = 'cod_cuentas_cobrar_alerta';

    if (confirm("Realmente deseas eliminar el registro ?")){ 
        $.ajax({
        type: "GET",
        url: "../admin/eliminar_editar_cuenta_cobrar_renovacion_ajax.php",
        data: "llave="+llave+'&tab='+tab+'&tipo='+tipo+'&campo='+campo+'&cod_cuentas_cobrar='+cod_cuentas_cobrar+'&cod_tercero='+cod_tercero+'&cod_factura='+cod_factura+'&pagina='+pagina,
        beforeSend: function(objeto){
            $("#resultados").html("Mensaje: Cargando...");
        },
        success: function(datos){
            $("#resultados").html(datos);
            window.location.reload();
        }
        });
    }
}
</script>
-->
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
<form name="formulario_insersion" method="post" enctype="multipart/form-data" action="../admin/edit_cuentas_cobrar_agrupado_detalle_factura_alquiler_reg.php">
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
            <!--<td style="text-align:center"><a href="../admin/eliminar.php?llave=<?php echo $cod_cuentas_cobrar ?>&tab=<?php echo $tab ?>&tipo=<?php echo $tipo ?>&campo=<?php echo $campo ?>&cod_tercero=<?php echo $cod_tercero ?>&cod_factura=<?php echo $cod_factura ?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/eliminar.png" class="img-polaroid" alt=""></a></td>-->
            <td style="text-align:center"><a href="../admin/eliminar.php?llave=<?php echo $cod_cuentas_cobrar ?>&tab=<?php echo $tab2 ?>&tipo=<?php echo $tipo ?>&campo=<?php echo $campo ?>&cod_tercero=<?php echo $cod_tercero ?>&cod_factura=<?php echo $cod_factura ?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/eliminar.png" class="img-polaroid" alt=""></a></td>

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
                <select name="cod_producto" id="cod_producto" class="chosen-select" data-show-subtext="true" data-live-search="true" required>
                    <?php if (isset($cod_producto)) { echo ""; } else { echo ""; }
                    $consulta2_sql = ("SELECT tbl15_producto.cod_producto, tbl15_producto.cod_producto_barra, tbl15_producto.nombre_producto, tbl15_tercero.nombre1_tercero, tbl15_tercero.identificacion_tercero
                    FROM tbl15_tercero RIGHT JOIN tbl15_producto ON tbl15_tercero.cod_tercero = tbl15_producto.cod_tercero ORDER BY tbl15_tercero.cod_tercero ASC");
                    $consulta2 = mysqli_query($conectar, $consulta2_sql);
                    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                    if(isset($cod_producto) and $cod_producto == $datos2['cod_producto']) {
                    $seleccionado = "selected"; } else { $seleccionado = ""; }
                    $codigo = $datos2['cod_producto'];
                    $nombre = $datos2['nombre1_tercero'].' - '.$datos2['identificacion_tercero'].' - '.$datos2['cod_producto_barra'].' - '.$datos2['nombre_producto'];
                    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                </select>
            </td>
        </tr>
    </thead>
</table>
<?php
$sql_datos_cuenta_cobrar = "SELECT cod_cuentas_cobrar FROM tbl15_cuentas_cobrar WHERE (cod_factura = '$cod_factura')";
$consulta_datos_cuenta_cobrar = mysqli_query($conectar, $sql_datos_cuenta_cobrar);
while ($datos_cuenta_cobrar = mysqli_fetch_assoc($consulta_datos_cuenta_cobrar)) { 
$cod_cuentas_cobrar            = $datos_cuenta_cobrar['cod_cuentas_cobrar'];
?>
<input type="hidden" name="cod_cuentas_cobrar[]" value="<?php echo $cod_cuentas_cobrar ?>">
<?php } ?>


<table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; width:100%">
    <tbody>
        <tr>
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
<fieldset>
<legend>RENOVACIONES</legend>
<table border="1" class="table table-responsive">
    <thead>
        <tr>
            <th style="text-align:center;">EDITAR GENERAR NUEVAS FECHAS</th>
            <th style="text-align:center;">TIPO ALQUILER</th>
            <th style="text-align:center;">CANTIDAD DE PERIODOS</th>
            <th style="text-align:center;">TIPO MONEDA</th>
            <th style="text-align:center;">PRECIO ALQUILER</th>
            <th style="text-align:center;"># RENOVACION</th>
            <th style="text-align:center;">SALDO A FAVOR</th>
            <th style="text-align:center;">ESTADO</th>
            <th style="text-align:center;">ID</th>
            <th style="text-align:center;">ELIM</th>
        </tr>
<?php
$monto_deuda_smtr                         = 0;
$abonado_smtr                             = 0;
$subtotal_smtr                            = 0;
$incre_inf                                = 0;
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_total_facturas = "SELECT * FROM tbl15_cuentas_cobrar WHERE (cod_factura = '$cod_factura') AND (cod_estado_archivado = '0') ORDER BY fecha_invert ASC";
$consulta_total_facturas = mysqli_query($conectar, $sql_total_facturas);
$total_facturas = mysqli_num_rows($consulta_total_facturas);
while ($datos_total_facturas = mysqli_fetch_array($consulta_total_facturas)) {

$cod_cuentas_cobrar             = $datos_total_facturas['cod_cuentas_cobrar'];
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
$cod_estado_contrato            = $datos_total_facturas['cod_estado_contrato'];
$cod_renovacion_contrato        = $datos_total_facturas['cod_renovacion_contrato'];
$deduccion_saldo_favor          = $datos_total_facturas['deduccion_saldo_favor'];

$sql_estado_contrato = "SELECT nombre_estado_contrato FROM tbl15_estado_contrato WHERE (cod_estado_contrato = '$cod_estado_contrato')";
$resultado_estado_contrato = mysqli_query($conectar, $sql_estado_contrato);
$info_estado_contrato = mysqli_fetch_assoc($resultado_estado_contrato);
    
$nombre_estado_contrato        = $info_estado_contrato['nombre_estado_contrato'];

$incre_inf++;
?>
        <tr>
            <td style="text-align:center"><a href="../admin/edit_cuentas_cobrar_agrupado_detalle_factura_alquiler_rango_pago_solo_actualizar.php?cod_cuentas_cobrar=<?php echo $cod_cuentas_cobrar ?>&cod_tercero=<?php echo $cod_tercero ?>&cod_factura=<?php echo $cod_factura ?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/editar.png" class="img-polaroid" alt=""></a></td>         
            <td style="text-align:center"><?php echo $nombre_tipo_cobro ?></td>
            <td style="text-align:center"><?php echo $numero_cuota ?></td>
            <td style="text-align:center"><?php echo $nombre_tipo_moneda ?></td>
            <td style="text-align:center"><?php echo number_format($monto_cuota, 0, ",", ".") ?></td>
            <td style="text-align:center"><?php echo $cod_renovacion_contrato ?></td>
            <td style="text-align:center;"><input name="deduccion_saldo_favor" type="text" id="deduccion_saldo_favor<?php echo $incre_inf;?>" class="<?php echo $cod_cuentas_cobrar;?>" value="<?php echo $deduccion_saldo_favor;?>" style="font-size:24px; width: 130px;" /></td>
            <td style="text-align:center"><?php echo $nombre_estado_contrato ?></td>
            <td style="text-align:center"><?php echo $cod_cuentas_cobrar ?></td>
            <!--<td style="text-align:center"><a href="#" class='' title='Borrar' onclick="Eliminar_Renovacion_agrupado_cod_cuentas_cobrar('<?php echo $cod_cuentas_cobrar; ?>|<?php echo $cod_tercero; ?>|<?php echo $cod_factura; ?>|<?php echo $cod_renovacion_contrato; ?>|<?php echo $pagina_local; ?>')"><img src="../imagenes/eliminar.png" class="img-polaroid" alt=""></a></span></td>-->
            <td style="text-align:center"><a href="#" class='' title='Borrar' onclick="Eliminar_Archivar_Renovacion_agrupado_cod_cuentas_cobrar('<?php echo $cod_cuentas_cobrar; ?>|<?php echo $cod_tercero; ?>|<?php echo $cod_factura; ?>|<?php echo $cod_renovacion_contrato; ?>|<?php echo $pagina_local; ?>')"><img src="../imagenes/eliminar.png" class="img-polaroid" alt=""></a></span></td>
        </tr>
<?php } ?>
    </thead>
</table>
</fieldset>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<fieldset>
<legend>HISTORIAL DE PAGO</legend>
<table class="table table-bordered table-hover table-sm">
    <thread>
        <tr>
            <th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px">EDITAR</th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px">NUMERO DE PERIODO</th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px">MES</th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px">PRECIO ALQUILER</th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px">FECHA LIMITE PAGO</th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px">REG PAGO</th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px"># RENOVACION</th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px">ESTADO PAGO</th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px">ID</th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px">ELIM</th>
        </tr>
    </thread>
<?php
$calcular_datos_cuenta_cobrar = "SELECT * FROM tbl15_cuentas_cobrar_alerta WHERE (cod_factura = '$cod_factura') AND (cod_estado_archivado = '0') ORDER BY fecha_pago ASC";
$consulta_datos_cuenta_cobrar = mysqli_query($conectar, $calcular_datos_cuenta_cobrar);
$total_datos = mysqli_num_rows($consulta_datos_cuenta_cobrar);
while ($datos_cuenta_cobrar = mysqli_fetch_assoc($consulta_datos_cuenta_cobrar)) {

    $cod_cuentas_cobrar_alerta                     = $datos_cuenta_cobrar['cod_cuentas_cobrar_alerta'];
    $cod_cuentas_cobrar                            = $datos_cuenta_cobrar['cod_cuentas_cobrar'];
    $numero_alerta                                 = $datos_cuenta_cobrar['numero_alerta'];
    //$cod_factura                                 = $datos_cuenta_cobrar['cod_factura'];
    $monto_deuda                                   = $datos_cuenta_cobrar['monto_deuda'];
    $abonado                                       = $datos_cuenta_cobrar['abonado'];
    $subtotal                                      = $datos_cuenta_cobrar['subtotal'];
    $mensaje                                       = $datos_cuenta_cobrar['mensaje'];
    $fecha_pago                                    = $datos_cuenta_cobrar['fecha_pago'];
    $vendedor                                      = $datos_cuenta_cobrar['vendedor'];
    $monto_deuda_smtr                              = $monto_deuda_smtr + $monto_deuda;
    $monto_cuota                                   = $datos_cuenta_cobrar['monto_cuota'];
    $cod_estado                                    = $datos_cuenta_cobrar['cod_estado'];
    $fecha_pago_reg                                = $datos_cuenta_cobrar['fecha_pago_reg'];
    $hora_pago_reg                                 = $datos_cuenta_cobrar['hora_pago_reg'];
    $cod_cuentas_cobrar_abonos                     = $datos_cuenta_cobrar['cod_cuentas_cobrar_abonos'];
    $url_img_orig_producto                         = $datos_cuenta_cobrar['url_img_orig_producto'];
    $total_recibido                                = $datos_cuenta_cobrar['total_recibido'];
    $total_pendiente                               = $datos_cuenta_cobrar['total_pendiente'];
    $cod_renovacion_contrato                       = $datos_cuenta_cobrar['cod_renovacion_contrato'];

    $fecha_mes                                     = $datos_cuenta_cobrar['fecha_mes'];
    $nombre_tabla_anyo                             = $datos_cuenta_cobrar['anyo'];
    $cod_estado_envio_correo_cuenta_cobro          = $datos_cuenta_cobrar['cod_estado_envio_correo_cuenta_cobro'];
    $cod_estado_envio_correo_comprobante_ingreso   = $datos_cuenta_cobrar['cod_estado_envio_correo_comprobante_ingreso'];
    $fecha_mes_complet                             = $fecha_mes.'-01';

    $cod_estado_pago                               = 1;
    $cod_tercero                                   = $datos_cuenta_cobrar['cod_tercero'];
    $fecha_pago_periodo_orig                       = $datos_cuenta_cobrar['fecha_pago_periodo_orig'];
    $fecha_pago_dmy                                = date("d-m-Y", strtotime($fecha_pago_periodo_orig));

    if ($fecha_pago_reg <> '') { $fecha_pago_reg_dmy = date("d-m-Y", strtotime($fecha_pago_reg)); } else { $fecha_pago_reg_dmy = ""; }

    $abonado_smtr                                  = $abonado_smtr + $abonado;
    $subtotal_smtr                                 = $subtotal_smtr + $subtotal;

    //$nombre_tabla_mes                              = date("m", strtotime($fecha_pago));
    $nombre_tabla_mes                              = date("m", strtotime($fecha_mes_complet));


    $mostrar_datos_sql = "SELECT nombre_letra_tabla_mes FROM tbl15_tabla_mes WHERE nombre_tabla_mes  = '$nombre_tabla_mes'";
    $consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
    $matriz_consulta = mysqli_fetch_assoc($consulta);

    $nombre_letra_tabla_mes                   = $matriz_consulta['nombre_letra_tabla_mes'];

    $sql_estado_pago = "SELECT * FROM tbl15_estado_pago WHERE cod_estado_pago = '$cod_estado'";
    $consulta_estado_pago = mysqli_query($conectar, $sql_estado_pago) or die(mysqli_error($conectar));
    $matriz_estado_pago = mysqli_fetch_assoc($consulta_estado_pago);

    $nombre_estado_pago             = $matriz_estado_pago['nombre_estado_pago'];
    $color_fondo_celda_estado_pago  = $matriz_estado_pago['color_fondo_celda_estado_pago'];
    $color_letra_celda_estado_pago  = $matriz_estado_pago['color_letra_celda_estado_pago'];

    if ($url_img_orig_producto == '') { $existe_archivo_cargado = '0'; } else { $existe_archivo_cargado = '1'; }
    if ($fecha_hoy == $fecha_pago) { $btn_imagen = 'base_caja_pago_hoy.gif'; } elseif ($fecha_hoy > $fecha_pago) { $btn_imagen = 'base_caja_pago_atrasado.gif'; } else { $btn_imagen = 'base_caja.png'; }
?>
    <tbody>
        <tr>
            <td style="text-align:center; <?php echo $color_fondo_celda_estado_pago;?>; <?php echo $color_letra_celda_estado_pago;?>; font-size: 20px"><a href="../admin/edit_cuentas_cobrar_detalle_factura_alquiler_info_periodo_pago.php?cod_cuentas_cobrar_alerta=<?php echo $cod_cuentas_cobrar_alerta ?>&cod_cuentas_cobrar=<?php echo $cod_cuentas_cobrar ?>&cod_tercero=<?php echo $cod_tercero ?>&cod_factura=<?php echo $cod_factura ?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/editar.png" class="img-polaroid" alt=""></a></td>         
            <td style="text-align:center; <?php echo $color_fondo_celda_estado_pago;?>; <?php echo $color_letra_celda_estado_pago;?>; font-size: 20px"><?php echo $numero_alerta;?></td>
            <td style="text-align:center; <?php echo $color_fondo_celda_estado_pago;?>; <?php echo $color_letra_celda_estado_pago;?>; font-size: 20px"><?php echo $nombre_letra_tabla_mes ;?></td>
            <td style="text-align:center; <?php echo $color_fondo_celda_estado_pago;?>; <?php echo $color_letra_celda_estado_pago;?>; font-size: 20px"><?php echo number_format($monto_cuota, 0, ",", ".") ?></td>
            <td style="text-align:center; <?php echo $color_fondo_celda_estado_pago;?>; <?php echo $color_letra_celda_estado_pago;?>; font-size: 20px"><?php echo $fecha_pago_dmy;?></font></td>
            <td style="text-align:center; <?php echo $color_fondo_celda_estado_pago;?>; <?php echo $color_letra_celda_estado_pago;?>; font-size: 20px"><?php echo $fecha_pago_reg_dmy;?></td>
            <td style="text-align:center; <?php echo $color_fondo_celda_estado_pago;?>; <?php echo $color_letra_celda_estado_pago;?>; font-size: 20px"><?php echo $cod_renovacion_contrato;?></td>
            <td style="text-align:center; <?php echo $color_fondo_celda_estado_pago;?>; <?php echo $color_letra_celda_estado_pago;?>; font-size: 20px"><?php echo $nombre_estado_pago;?></td>
            <td style="text-align:center; <?php echo $color_fondo_celda_estado_pago;?>; <?php echo $color_letra_celda_estado_pago;?>; font-size: 20px"><?php echo $cod_cuentas_cobrar_alerta;?></td>
            <!--<td style="text-align:center; <?php echo $color_fondo_celda_estado_pago;?>; <?php echo $color_letra_celda_estado_pago;?>; font-size: 20px"><a href="#" class='' title='Borrar' onclick="Eliminar_Renovacion_individual_cod_cuentas_cobrar_alerta('<?php echo $cod_cuentas_cobrar; ?>|<?php echo $cod_cuentas_cobrar_alerta; ?>|<?php echo $cod_tercero; ?>|<?php echo $cod_factura; ?>|<?php echo $cod_renovacion_contrato; ?>|<?php echo $pagina_local; ?>')"><img src="../imagenes/eliminar.png" class="img-polaroid" alt=""></a></span></td>-->
            <td style="text-align:center; <?php echo $color_fondo_celda_estado_pago;?>; <?php echo $color_letra_celda_estado_pago;?>; font-size: 20px"><a href="#" class='' title='Borrar' onclick="Eliminar_Archivar_Renovacion_individual_cod_cuentas_cobrar_alerta('<?php echo $cod_cuentas_cobrar; ?>|<?php echo $cod_cuentas_cobrar_alerta; ?>|<?php echo $cod_tercero; ?>|<?php echo $cod_factura; ?>|<?php echo $cod_renovacion_contrato; ?>|<?php echo $pagina_local; ?>')"><img src="../imagenes/eliminar.png" class="img-polaroid" alt=""></a></span></td>
        </tr>
    </tbody>
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

<script language="javascript">
$(document).ready(function(){
    $("input").on('change', function () {
        var valor = $(this).val();
        var campo = $(this).attr("name");
        var tipo_ajax = "tbl15_cuentas_cobrar";
        var id = $(this).attr("class");
        var cod_seguridad = <?php echo $cod_seguridad;?>;
        var cod_estado_modificar_und_venta_una_sola_vez_global = <?php echo $cod_estado_modificar_und_venta_una_sola_vez_global;?>;
        var cod_estado_bascula_balanza_electronica_pesar_producto_global = <?php echo $cod_estado_bascula_balanza_electronica_pesar_producto_global;?>;
        var pagina_local = "<?php echo $pagina_local;?>";
        var foco = '';
        var filtro = 'global';
        var nombre_campo_incre = $(this).attr("id");

        var datos_url_ajax = 'valor='+valor+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'id='+id+'&'+'foco='+foco+'&'+'nombre_campo_incre='+nombre_campo_incre+'&'+'filtro='+filtro;

        $.ajax({
            type: "POST",
            url: "../admin/edit_cuentas_cobrar_agrupado_detalle_factura_alquiler_saldo_favor_ajax.php",
            data: datos_url_ajax,
            //dataType: 'json',
            beforeSend: function(objeto){
                $('#loader').html('<img src="../imagenes/ajax-loader.gif"> Cargando...');
            },
            success:function(respuesta){

                var afectado = respuesta.afectado;
                var mensaje = respuesta.mensaje;
            }
        });
    });
});
</script>