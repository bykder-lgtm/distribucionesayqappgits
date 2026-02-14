<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="../estilo_css/estilo_modal.css">
<script type="text/javascript" src="js/jquery.number.js"></script>


<script type="text/javascript">
$(function(){

$('#monto_deuda_sin_interes').number( true, 0 );

    $("#monto_deuda_sin_interes").keyup(function () {
        var monto_deuda_sin_interes = parseFloat($(this).val());
        $('#monto_deuda_sin_interes_hidden').val(monto_deuda_sin_interes);
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
<!--<div class="container">-->
<div class="divPanel page-content">
<!--
<div class="breadcrumbs">
<a href="../admin/menu_lista.php"><h4>Lista de Area a Laborar&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
<a href="../admin/reg_grupo_area.php">Registrar Area a Laborar</h4></a>
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
if (isset($_GET['cuenta'])) { $cuenta_actual = addslashes($_GET['cuenta']); } else { $cuenta_actual = $cuenta_actual; }
if (isset($_GET['cod_caja_virtual'])) { $cod_caja_virtual = addslashes($_GET['cod_caja_virtual']); } else { $cod_caja_virtual = $cod_caja_virtual; }
if (isset($_GET['cuenta'])) { $url_visit_user_extern = '?cuenta='.$cuenta_actual.'&cod_caja_virtual='.$cod_caja_virtual; } else { $url_visit_user_extern = ""; }

$pagina                            = $_SERVER['PHP_SELF'];
$pagina_local                      = $_SERVER['PHP_SELF'];
$incre                             = 0;
$tab                               = 'tbl15_venta_producto_temporal';
$campo                             = 'cod_venta_producto_temporal';
$tipo                              = 'eliminar';
$nombre_tipo_moneda                = "COP";
$nombre_tipo_factura               = "POS";
$cod_estado_vacuna                 = "0";

$time_seg                          = time();
$fecha                             = date("Ymd");
$hora                              = date("His");

if (isset($_GET['foco'])) { $foco = addslashes($_GET['foco']); } else { $foco = 'busqueda_tercero_inquilino'; }
if (isset($_GET['buscar_por'])) { $buscar_por = addslashes($_GET['buscar_por']); } else { $buscar_por = 'documento_nombre_inquilino'; }
if (isset($_GET['cod_tercero'])) { $cod_tercero = intval($_GET['cod_tercero']); } else { $cod_tercero = 0; }

$datos_factura = "SELECT cod_venta_producto_temporal FROM tbl15_venta_producto_temporal WHERE (cuenta = '$cuenta_actual') AND (cod_caja_virtual = '$cod_caja_virtual')";
$consulta = mysqli_query($conectar, $datos_factura);
$total_datos_temporal = mysqli_num_rows($consulta);

$sql_info_cuentas_cobrar = "SELECT MAX(cod_factura) AS cod_factura FROM tbl15_cuentas_cobrar";
$consulta_info_cuentas_cobrar = mysqli_query($conectar, $sql_info_cuentas_cobrar);
$total_datos_info_cuentas_cobrar = mysqli_num_rows($consulta_info_cuentas_cobrar);
$datos_info_cuentas_cobrar = mysqli_fetch_assoc($consulta_info_cuentas_cobrar);

$cod_factura        = $datos_info_cuentas_cobrar['cod_factura'] + 1;
?>
<input type="hidden" id="pagina" value="<?php echo $pagina_local ?>">

<script>
window.onload = function() {
document.getElementById("<?php echo $foco ?>").focus();
}
</script>

<script type="text/javascript">
function hacer_busqueda_tercero_inquilino() {
var xmlhttp;

var valor_buscar = document.getElementById('busqueda_tercero_inquilino').value;
var pagina = document.getElementById('pagina').value;
var nombre_tipo_moneda = "COP";
var nombre_tipo_factura = "POS";
var nombre_tipo_tercero = "INQUILINO";
var cod_estado_vacuna = "0";
var tipo_busqueda = "parcial";
var buscar_por = $("#buscar_por").val();
var cuenta = "<?php echo $cuenta_actual ?>";
var cod_caja_virtual = "<?php echo $cod_caja_virtual ?>";

if(valor_buscar=='') { document.getElementById("logo_cargador").innerHTML=""; return; }

if (window.XMLHttpRequest) { xmlhttp=new XMLHttpRequest(); } else { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); }
xmlhttp.onreadystatechange=function() {
  if (xmlhttp.readyState==4 && xmlhttp.status==200) { document.getElementById("logo_cargador").innerHTML=xmlhttp.responseText; } else { document.getElementById("logo_cargador").innerHTML='<center><img src="../imagenes/loader.gif"/></center>'; }
}
xmlhttp.open("POST","../admin/busqueda_inmediata_agrupado_alquiler_temporal_manual_inquilino_php.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("buscar="+valor_buscar+"&buscar_por="+buscar_por+"&nombre_tipo_moneda="+nombre_tipo_moneda+"&nombre_tipo_factura="+nombre_tipo_factura+"&tipo_busqueda="+tipo_busqueda+"&cod_estado_vacuna="+cod_estado_vacuna+"&cuenta="+cuenta+"&cod_caja_virtual="+cod_caja_virtual+"&pagina="+pagina+"&nombre_tipo_tercero="+nombre_tipo_tercero);
}
</script>

<script type="text/javascript">
function hacer_busqueda_producto_inmueble() {
var xmlhttp;

var valor_buscar = document.getElementById('busqueda_producto_inmueble').value;
var pagina = document.getElementById('pagina').value;
var nombre_tipo_moneda = "COP";
var nombre_tipo_factura = "POS";
var nombre_tipo_tercero = "INQUILINO";
var cod_estado_vacuna = "0";
var tipo_busqueda = "parcial";
var buscar_por = $("#buscar_por").val();
var cuenta = "<?php echo $cuenta_actual ?>";
var cod_caja_virtual = "<?php echo $cod_caja_virtual ?>";
var cod_tercero = "<?php echo $cod_tercero ?>";

if(valor_buscar=='') { document.getElementById("logo_cargador_producto_inmueble").innerHTML=""; return; }

if (window.XMLHttpRequest) { xmlhttp=new XMLHttpRequest(); } else { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); }
xmlhttp.onreadystatechange=function() {
  if (xmlhttp.readyState==4 && xmlhttp.status==200) { document.getElementById("logo_cargador_producto_inmueble").innerHTML=xmlhttp.responseText; } else { document.getElementById("logo_cargador_producto_inmueble").innerHTML='<center><img src="../imagenes/loader.gif"/></center>'; }
}
xmlhttp.open("POST","../admin/busqueda_inmediata_agrupado_alquiler_temporal_manual_producto_inmueble_php.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("buscar="+valor_buscar+"&cod_tercero="+cod_tercero+"&buscar_por="+buscar_por+"&nombre_tipo_moneda="+nombre_tipo_moneda+"&nombre_tipo_factura="+nombre_tipo_factura+"&tipo_busqueda="+tipo_busqueda+"&cod_estado_vacuna="+cod_estado_vacuna+"&cuenta="+cuenta+"&cod_caja_virtual="+cod_caja_virtual+"&pagina="+pagina+"&nombre_tipo_tercero="+nombre_tipo_tercero);
}
</script>


<div class="table-responsive">

<?php 
if (isset($_GET['cod_producto'])) { ?>
<form name="formulario_insersion" method="post" enctype="multipart/form-data" action="../admin/facturacion_agrupado_alquiler_temporal_manual_reg.php">
    <fieldset>
<legend>INFORMACION DEL CONTRATO</legend>
<table border="1" class="table table-responsive">
    <thead>
        <tr>
            <th style="text-align:center">CODIGO CONTRATO</th>
        </tr>
        <tr>
            <td style="text-align:center"><input class="form-control" name="cod_factura" type="number" value="<?php echo $cod_factura ?>" min="0" size="10" required></td>
        </tr>
    </thead>
</table>
</fieldset>
<?php } ?>

<?php 
if (isset($_GET['cod_tercero'])) { 

$cod_tercero                       = intval($_GET['cod_tercero']);

$mostrar_datos_sql = "SELECT * FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
$total_resultados = mysqli_num_rows($consulta);
$matriz_consulta = mysqli_fetch_assoc($consulta);

$identificacion_tercero            = $matriz_consulta['identificacion_tercero'];
$nombre_tipo_identificacion        = $matriz_consulta['nombre_tipo_identificacion'];
$nombre1_tercero                   = $matriz_consulta['nombre1_tercero'];
$nombre_tipo_tercero               = $matriz_consulta['nombre_tipo_tercero'];
$direccion_tercero                 = $matriz_consulta['direccion_tercero'];
$telefono1_tercero                 = $matriz_consulta['telefono1_tercero'];
$correo_tercero                    = $matriz_consulta['correo_tercero'];
$nombre_pais                       = $matriz_consulta['nombre_pais'];
$deduccion_retefuente              = $matriz_consulta['deduccion_retefuente'];
$deduccion_otro_concepto           = $matriz_consulta['deduccion_otro_concepto'];
?>
<fieldset>
<legend>INFORMACION DEL INQUILINO</legend>
<table border="1" class="table table-responsive">
    <thead>
        <tr>
            <th style="text-align:center">NOMBRE COMPLETO</th>
            <th style="text-align:center">TIPO DOCUMENTO</th>
            <th style="text-align:center">NUMERO DOCUMENTO</th>
            <th style="text-align:center">TELEFONO / CELULAR</th>
            <th style="text-align:center">CORREO ELECTRONICO</th>
            <!--<th style="text-align:center">NACIONALIDAD</th>-->
        </tr>
        <tr>
            <td style="text-align:center"><?php echo $nombre1_tercero ?></td>
            <td style="text-align:center"><?php echo $nombre_tipo_identificacion ?></td>
            <td style="text-align:center"><?php echo $identificacion_tercero ?></td>
            <td style="text-align:center"><?php echo $telefono1_tercero ?></td>
            <td style="text-align:center"><?php echo $correo_tercero ?></td>
            <!--<td style="text-align:center"><?php echo $nombre_pais ?></td>-->
        </tr>
    </thead>
</table>
</fieldset>

<table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; width:100%">
    <tbody>
        <tr>
            <!--<td bgcolor="#fff" align="center"><a href="../admin/facturacion_venta_temporal_producto_barras_pos.php<?php echo $url_visit_user_extern ?>"><strong>Venta Barras</strong></a></td>-->
            <td bgcolor="#fff" align="center">
            <select class="form-control" name="buscar_por" id="buscar_por" onchange="hacer_busqueda()" style="width: 250px;">
            <?php if (isset($buscar_por)) { echo ""; } else { echo  "<option value='' selected >Selecione</option>"; }
            $consulta2_sql = ("SELECT cod_buscar_por, nombre_buscar_por, titulo_buscar_por FROM tbl15_buscar_por WHERE (cod_tipo_busqueda = '3') AND (cod_estado = '1') ORDER BY cod_buscar_por ASC");
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($buscar_por) and $buscar_por == $datos2['nombre_buscar_por']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['nombre_buscar_por'];
            $nombre = $datos2['titulo_buscar_por'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select>
            <input type="text" id="busqueda_producto_inmueble" name="busqueda_producto_inmueble" onkeyup="hacer_busqueda_producto_inmueble()" style="height:40" placeholder="Buscar"/><input type="hidden" id="pagina" name="pagina" value="<?php echo $pagina_local ?>"/><div id="logo_cargador_producto_inmueble"></div>
            </td>
        </tr>
    </tbody>
</table>

<?php 
if (isset($_GET['cod_producto'])) { 

$cod_producto                 = intval($_GET['cod_producto']);

$mostrar_datos_sql = "SELECT * FROM tbl15_producto WHERE cod_producto = '$cod_producto'";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
$matriz_consulta = mysqli_fetch_assoc($consulta);

$cod_producto_barra           = $matriz_consulta['cod_producto_barra'];
$nombre_producto              = $matriz_consulta['nombre_producto'];
$nombre_tipo_producto         = $matriz_consulta['nombre_tipo_producto'];
$precio_venta_producto        = $matriz_consulta['precio_venta_producto'];

$direccion_producto           = $matriz_consulta['direccion_producto'];
$descripcion_producto         = $matriz_consulta['descripcion_producto'];
$cod_tercero_propietario      = $matriz_consulta['cod_tercero'];
$url_img_producto_min         = $matriz_consulta['url_img_producto_min'];
$url_img_producto_orig        = $matriz_consulta['url_img_producto_orig'];
$latitud_producto             = $matriz_consulta['latitud_producto'];
$longitud_producto            = $matriz_consulta['longitud_producto'];
$deduccion_comision_ptj       = $matriz_consulta['deduccion_comision_ptj_inmueble'];

$sql_marca = "SELECT cod_tercero, nombre1_tercero FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero_propietario')";
$query_marca = mysqli_query($conectar, $sql_marca);
$datos_marca = mysqli_fetch_array($query_marca);

$nombre1_tercero_propietario  = $datos_marca['nombre1_tercero'];
?>
<fieldset>
    <legend>INFORMACION DEL INMUEBLE</legend>
    <table border="1" class="table table-responsive">
        <thead>
            <tr>
                <th style="text-align:center">TIPO INMUEBLE</th>
                <th style="text-align:center">CODIGO INMUEBLE</th>
                <th style="text-align:center">NOMBRE INMUEBLE</th>
                <th style="text-align:center">DIRECCION INMUEBLE</th>
                <th style="text-align:center">DESCRIPCION INMUEBLE</th>
                <th style="text-align:center">PROPIETARIO</th>
            </tr>
            <tr>
                <td style="text-align:center"><?php echo $nombre_tipo_producto ?></td>
                <td style="text-align:center"><?php echo $cod_producto_barra ?></td>
                <td style="text-align:center"><?php echo $nombre_producto ?></td>
                <td style="text-align:center"><?php echo $direccion_producto ?></td>
                <td style="text-align:center"><?php echo $descripcion_producto ?></td>
                <td style="text-align:center"><?php echo $nombre1_tercero_propietario ?></td>
            </tr>
        </thead>
    </table>

    <table border="1" class="table table-responsive">
        <thead>
            <tr>
                <th style="text-align:center; width:200px;">TIPO ALQUILER</th>
                <th style="text-align:center; width:200px;">RETEFUENTE PARA TERCEROS (DEDUCCION)</th>
                <th style="text-align:center; width:200px;">OTROS CONCEPTOS (DEDUCCION DESCUENTO A INQUILINO)</th>
                <th style="text-align:center; width:200px;">CANTIDAD DE PERIODOS</th>
                <th style="text-align:center; width:200px;">PORCENTAJE DE COMISION DEL INMUEBLE</th>
                <!--<th style="text-align:center">TIPO MONEDA</th>-->
                <th style="text-align:center; width:200px;">PRECIO ALQUILER (COP)</th>
                <th style="text-align:center; width:200px;">FECHA INICIO ALQUILER</th>
                <!--<th style="text-align:center">CLAUSULAS</th>-->
                <th style="text-align:center; width:200px;">SOPORTE CONTRATO</th>
            </tr>
            <tr>
                <td style="text-align:center">
                    <select name="nombre_tipo_cobro" class="input-block-level" data-show-subtext="true" data-live-search="true" required>
                    <?php if (isset($nombre_tipo_cobro)) { echo ""; } else { echo  ""; }
                    $consulta2_sql = ("SELECT * FROM tbl15_tipo_cobro WHERE (cod_estado = '1')");
                    $consulta2 = mysqli_query($conectar, $consulta2_sql);
                    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                    if(isset($nombre_tipo_cobro) and $nombre_tipo_cobro == $datos2['nombre_tipo_cobro']) {
                    $seleccionado = "selected"; } else { $seleccionado = ""; }
                    $codigo = $datos2['nombre_tipo_cobro'];
                    $nombre = $datos2['nombre_tipo_cobro'];
                    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select>
                </td>

                <td style="text-align:center"><input style="font-size:24px;" class="input-block-level" name="deduccion_retefuente" type="number" value="<?php echo $deduccion_retefuente ?>" min="0" size="10" required></td>
                <td style="text-align:center"><input style="font-size:24px;" class="input-block-level" name="deduccion_otro_concepto" type="number" value="<?php echo $deduccion_otro_concepto ?>" min="0" size="10" required></td>
                <td style="text-align:center"><input style="font-size:24px;" class="input-block-level" name="numero_cuota" type="number" value="" min="1" max="99" size="10" step="any" required></td>
                <td style="text-align:center"><input style="font-size:24px;" class="input-block-level" name="deduccion_comision_ptj" type="number" value="<?php echo $deduccion_comision_ptj ?>" min="0" max="99" size="10" step="any" required></td>
<!--
                <td style="text-align:center">
                    <select name="cod_tipo_moneda" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 100px;" required>
                        <?php if (isset($cod_tipo_moneda)) { echo ""; } else { echo ""; }
                        $consulta2_sql = ("SELECT cod_tipo_moneda, nombre_tipo_moneda FROM tbl15_tipo_moneda WHERE (cod_estado = '1') ORDER BY cod_tipo_moneda ASC");
                        $consulta2 = mysqli_query($conectar, $consulta2_sql);
                        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                        if(isset($cod_tipo_moneda) and $cod_tipo_moneda == $datos2['cod_tipo_moneda']) {
                        $seleccionado = "selected"; } else { $seleccionado = ""; }
                        $codigo = $datos2['cod_tipo_moneda'];
                        $nombre = $datos2['nombre_tipo_moneda'];
                        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                    </select>
                </td>
-->
                <td style="text-align:center"><input style="font-size:24px" class="input-block-level" name="monto_deuda_sin_interes" id="monto_deuda_sin_interes" type="text" value="<?php echo $precio_venta_producto ?>" min="1" size="10" required></td>
                <input name="monto_deuda_sin_interes_hidden" id="monto_deuda_sin_interes_hidden" type="hidden" value="<?php echo $precio_venta_producto ?>" min="1" size="10" required>
                <td style="text-align:center"><input class="input-block-level" name="fecha_pago" type="date" value="" size="10" required></td>
                <!--<td style="text-align:center"><textarea class="input-block-level" name="clausula_alquiler" rows="2" cols="80"></textarea></td>-->
                <td style="text-align:center"><input class="input-block-level" type="file" name="url_img1" id="url_img1"></td>            
            </tr>
        </thead>
    </table>
</fieldset>


<table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; width:100%">
    <tbody>
        <tr>
        <input type="hidden" name="pagina" value="<?php echo $pagina ?>">
        <input type="hidden" name="insersion" value="formulario_de_insersion">
        <input type="hidden" name="cod_tercero" value="<?php echo $cod_tercero ?>">
        <input type="hidden" name="cod_producto" value="<?php echo $cod_producto ?>">
        <input type="hidden" name="cod_producto_barra" value="<?php echo $cod_producto_barra ?>">
        <input type="hidden" name="nombre_producto" value="<?php echo $nombre_producto ?>">
        <input type="hidden" name="cod_administrador" value="<?php echo $cod_administrador ?>">
        <input type="hidden" name="cod_tipo_moneda" value="1">

        <hr>
        <div class="actions">
            <td style="text-align:center"><input type="submit" value="Registrar Información" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" /></td>
        </div>
        </tr>
    </tbody>
</table>
</form>
<?php } ?>

<?php } else { ?>
<table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; width:100%">
    <tbody>
        <tr>
            <!--<td bgcolor="#fff" align="center"><a href="../admin/facturacion_venta_temporal_producto_barras_pos.php<?php echo $url_visit_user_extern ?>"><strong>Venta Barras</strong></a></td>-->
            <td bgcolor="#fff" align="center"><strong>Buscar por:</strong>
            <select class="form-control" name="buscar_por" id="buscar_por" onchange="hacer_busqueda_tercero_inquilino()" style="width: 180px;">
            <?php if (isset($buscar_por)) { echo ""; } else { echo  "<option value='' selected >Selecione</option>"; }
            $consulta2_sql = ("SELECT cod_buscar_por, nombre_buscar_por, titulo_buscar_por FROM tbl15_buscar_por WHERE (cod_tipo_busqueda = '2') AND (cod_estado = '1') ORDER BY cod_buscar_por ASC");
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($buscar_por) and $buscar_por == $datos2['nombre_buscar_por']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['nombre_buscar_por'];
            $nombre = $datos2['titulo_buscar_por'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select>
            <strong><input type="text" id="busqueda_tercero_inquilino" name="busqueda_tercero_inquilino" onkeyup="hacer_busqueda_tercero_inquilino()" style="height:40" placeholder="Buscar"/><input type="hidden" id="pagina" name="pagina" value="<?php echo $pagina_local ?>"/></strong><div id="logo_cargador"></div>
            </td>
        </tr>
    </tbody>
</table>
<?php } ?>
<!-- ***************************************************************************************************************************** -->
<?php //include_once('../admin/info_factura_alquiler_temporal_pos.php'); ?>
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->


</div>
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* FIN MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
</div>
<!--End Main Content Area-->
<!--</div>-->
<div id="footerInnerSeparator"></div>
</div>
</div>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<?php include_once('../admin/04_modulo_footer.php'); ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include_once('../admin/05_modulo_js_sin_jquery.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php
$cod_estado_revisado              = "1";
$cuenta_actual_sesion             = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
?>
</body>
</html>