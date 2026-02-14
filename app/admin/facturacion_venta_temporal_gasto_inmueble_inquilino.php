<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<?php include_once('../admin/02_modulo_estilo_css_chosen_600px.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="../estilo_css/estilo_modal.css">
<script type="text/javascript" src="js/jquery.number.js"></script>



<?php
if (isset($_GET['cuenta'])) { $cuenta_actual = addslashes($_GET['cuenta']); } else { $cuenta_actual = $cuenta_actual; }
if (isset($_GET['cod_caja_virtual'])) { $cod_caja_virtual = addslashes($_GET['cod_caja_virtual']); } else { $cod_caja_virtual = $cod_caja_virtual; }
if (isset($_GET['cuenta'])) { $url_visit_user_extern = '?cuenta='.$cuenta_actual.'&cod_caja_virtual='.$cod_caja_virtual; } else { $url_visit_user_extern = ""; }

if (isset($_GET['cod_cuentas_cobrar_alerta'])) { $cod_cuentas_cobrar_alerta = intval($_GET['cod_cuentas_cobrar_alerta']); } else { $cod_cuentas_cobrar_alerta = ''; }
if (isset($_GET['cod_cuentas_cobrar'])) { $cod_cuentas_cobrar = intval($_GET['cod_cuentas_cobrar']); } else { $cod_cuentas_cobrar = ''; }
//if (isset($_GET['cod_factura'])) { $cod_factura = intval($_GET['cod_factura']); } else { $cod_factura = ''; }
if (isset($_GET['numero_alerta'])) { $numero_alerta = intval($_GET['numero_alerta']); } else { $numero_alerta = ''; }
if (isset($_GET['cod_tercero'])) { $cod_tercero = intval($_GET['cod_tercero']); } else { $cod_tercero = ''; }
if (isset($_GET['cliente'])) { $cliente = addslashes($_GET['cliente']); } else { $cliente = ''; }
if (isset($_GET['pagina'])) { $pagina = addslashes($_GET['pagina']); } else { $pagina = ''; }
if (isset($_GET['palabra'])) { $palabra = addslashes($_GET['palabra']); } else { $palabra = ''; }

$incren_sup = 0;
$sql_gasto_inmueble_scrip = "SELECT cod_gasto_inmueble_inquilino_venta_temporal FROM tbl15_gasto_inmueble_inquilino_venta_temporal WHERE (cuenta = '$cuenta_actual') AND (cod_caja_virtual = '$cod_caja_virtual') 
ORDER BY cod_gasto_inmueble_inquilino_venta_temporal DESC";
$consulta_gasto_inmueble_scrip = mysqli_query($conectar, $sql_gasto_inmueble_scrip);
while ($datos_gasto_inmueble_scrip = mysqli_fetch_assoc($consulta_gasto_inmueble_scrip)) {

    $incren_sup++;
    $nombre_id_venta                      = 'precio_venta_producto'.$incren_sup;
    $nombre_id_compra                     = 'precio_compra_producto'.$incren_sup;
    ?>
    <script type="text/javascript">
    $(function(){
        $('#<?php echo $nombre_id_venta ?>').number( true, 0 );
        $("#<?php echo $nombre_id_venta ?>").keyup(function () {
            var <?php echo $nombre_id_venta ?> = $(this).val();
        });

        $('#<?php echo $nombre_id_compra ?>').number( true, 0 );
        $("#<?php echo $nombre_id_compra ?>").keyup(function () {
            var <?php echo $nombre_id_compra ?> = $(this).val();
        });
    });
    </script>
<?php } ?>
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
$pagina                            = $_SERVER['PHP_SELF'];
$pagina_local                      = $_SERVER['PHP_SELF'];
$incre                             = 0;
$tab                               = 'tbl15_gasto_inmueble_inquilino_venta_temporal';
$campo                             = 'cod_gasto_inmueble_inquilino_venta_temporal';
$tipo                              = 'eliminar';
$nombre_tipo_moneda                = "COP";
$nombre_tipo_factura               = "POS";
$cod_estado_vacuna                 = "0";

$time_seg                          = time();
$fecha                             = date("Ymd");
$hora                              = date("His");

if (isset($_GET['foco'])) { $foco = addslashes($_GET['foco']); } else { $foco = 'busqueda'; }
if (isset($_GET['buscar_por'])) { $buscar_por = addslashes($_GET['buscar_por']); } else { $buscar_por = $nombre_buscar_por; }

$datos_factura = "SELECT cod_gasto_inmueble_inquilino_venta_temporal FROM tbl15_gasto_inmueble_inquilino_venta_temporal WHERE (cuenta = '$cuenta_actual') AND (cod_caja_virtual = '$cod_caja_virtual')";
$consulta = mysqli_query($conectar, $datos_factura);
$total_datos = mysqli_num_rows($consulta);

$datos_data_info_gasto_inmueble_detalle = "SELECT * FROM tbl15_info_gasto_inmueble_inquilino_venta WHERE (nombre_estado_factura = 'ABIERTA') AND (cuenta = '$cuenta_actual') AND (cod_caja_virtual = '$cod_caja_virtual')";
$consulta_data_info_gasto_inmueble_detalle = mysqli_query($conectar, $datos_data_info_gasto_inmueble_detalle);
$data_info_gasto_inmueble_detalle = mysqli_fetch_assoc($consulta_data_info_gasto_inmueble_detalle);

$cod_factura                             = $data_info_gasto_inmueble_detalle['cod_factura'];
?>
<input type="hidden" id="pagina" value="<?php echo $pagina_local ?>">

<script>
window.onload = function() {
document.getElementById("<?php echo $foco ?>").focus();
}
</script>

<script type="text/javascript">
function hacer_busqueda() {
var xmlhttp;

var valor_buscar = document.getElementById('busqueda').value;
var pagina = document.getElementById('pagina').value;
var nombre_tipo_moneda = "COP";
var nombre_tipo_factura = "POS";
var cod_estado_vacuna = "0";
var tipo_busqueda = "parcial";
var buscar_por = $("#buscar_por").val();
var cuenta = "<?php echo $cuenta_actual ?>";
var cod_caja_virtual = "<?php echo $cod_caja_virtual ?>";
var cod_factura = "<?php echo $cod_factura ?>";


if(valor_buscar=='') { document.getElementById("logo_cargador").innerHTML=""; return; }

if (window.XMLHttpRequest) { xmlhttp=new XMLHttpRequest(); } else { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); }
xmlhttp.onreadystatechange=function() {
  if (xmlhttp.readyState==4 && xmlhttp.status==200) { document.getElementById("logo_cargador").innerHTML=xmlhttp.responseText; } else { document.getElementById("logo_cargador").innerHTML='<center><img src="../imagenes/loader.gif"/></center>'; }
}
xmlhttp.open("POST","../admin/busqueda_inmediata_venta_temporal_gasto_inmueble_inquilino_php.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("buscar="+valor_buscar+"&buscar_por="+buscar_por+"&cod_factura="+cod_factura+"&nombre_tipo_moneda="+nombre_tipo_moneda+"&nombre_tipo_factura="+nombre_tipo_factura+"&tipo_busqueda="+tipo_busqueda+"&cod_estado_vacuna="+cod_estado_vacuna+"&cuenta="+cuenta+"&cod_caja_virtual="+cod_caja_virtual+"&pagina="+pagina);
}
</script>

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

<div class="table-responsive">

<table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; width:100%">
    <tbody><tr>
        <td bgcolor="#fff" align="center"><strong><a href="../admin/lista_gasto_inmueble_inquilino_temporal_virtual.php?pagina=<?php echo $pagina ?>">LISTA DE GASTOS PENDIENTES | </a></strong></td>
        <?php if ($cod_seguridad==1) { ?>
        <td bgcolor="#fff" align="center"><strong><a href="../admin/reporte_gasto_inmueble_venta_relacionado_deducido_inquilino.php">LISTA DE GASTOS DEDUCIDOS A ARRENDATARIOS</a></strong></td>
        <?php } else { ?>
        <td bgcolor="#fff" align="center"><strong><a href="../admin/reporte_gasto_inmueble_venta_relacionado_deducido_inquilino.php">LISTA DE GASTOS DEDUCIDOS A ARRENDATARIOS</a></strong></td>
        <?php } ?>
    </tr></tbody>
</table>
<br>

<?php if ($cod_estado_venta_manual == '1') { ?>
<table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; width:100%">
    <tbody>
    	<tr>
            <td bgcolor="#fff" align="center"><strong>Buscar por:</strong>
            <select class="form-control" name="buscar_por" id="buscar_por" onchange="hacer_busqueda()" style="width: 180px;">
            <?php if (isset($buscar_por)) { echo ""; } else { echo  "<option value='' selected >Selecione</option>"; }
            $consulta2_sql = ("SELECT cod_buscar_por, nombre_buscar_por, titulo_buscar_por FROM tbl15_buscar_por WHERE (cod_tipo_busqueda = '1') ORDER BY cod_buscar_por ASC");
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($buscar_por) and $buscar_por == $datos2['nombre_buscar_por']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['nombre_buscar_por'];
            $nombre = $datos2['titulo_buscar_por'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select>
            <strong>Manual:[<?php echo $cod_base_caja ?>]<input type="text" id="busqueda" name="busqueda" onkeyup="hacer_busqueda()" style="height:40" placeholder="Buscar"/><input type="hidden" id="pagina" name="pagina" value="<?php echo $pagina_local ?>"/></strong><div id="logo_cargador"></div>
            </td>
    	</tr>
    </tbody>
</table>
<?php } ?>
<!-- ***************************************************************************************************************************** -->
<?php include_once('../admin/info_factura_venta_gasto_inmueble_inquilino.php'); ?>
<!-- ***************************************************************************************************************************** -->
<?php if ($total_datos <> 0) { include_once("../admin/modal_registrar_tercero_vacio.php"); } ?>
<!-- ***************************************************************************************************************************** -->
<?php if ($total_datos <> 0) { ?>

<?php if (isset($_GET['cod_cuentas_cobrar_alerta'])) { ?>
<table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; width:100%">
    <tbody>
        <tr>
            <th style="text-align:center;"><a href="../admin/reg_comision_propietario_detalle_factura_alquiler.php?cod_cuentas_cobrar_alerta=<?php echo $cod_cuentas_cobrar_alerta ?>&cod_cuentas_cobrar=<?php echo $cod_cuentas_cobrar ?>&cod_factura=<?php echo $cod_factura ?>&numero_alerta=<?php echo $numero_alerta ?>&cod_tercero=<?php echo $cod_tercero ?>&cliente=<?php echo $cliente ?>&pagina=<?php echo $pagina ?>&palabra=<?php echo $palabra ?>">Regresar al Contrato</a></th>
        </tr>
    </tbody>
</table>
<?php } ?>

<table <table class="table table-hover" border="" cellspacing="0" cellpadding="0">
<thead>
	<tr>
		<td style="text-align:center;"></td>
		<?php if ($cod_estado_eliminar_caja_mesa_virtual == '1') { ?><th style="text-align:center;">ELM</th><?php } ?>
		<!--<th style="text-align:center;">COBRAR</th>-->
		<th style="text-align:center;">CODIGO</th>
		<th style="text-align:center;">NOMBRE CONCEPTO</th>
		<th style="text-align:center;">OBSERVACION</th>
		<th style="text-align:center;">COSTO ADMINISTRACION DE REPARACION (P.COMPRA)</th>
        <th style="text-align:center;">COSTO FINAL (P.VENTA)</th>
        <th style="text-align:center;">FECHA</th>
        <th style="text-align:center;">CARGAR SOPORTE</th>
        <th style="text-align:center;">...</th>
        <th style="text-align:center;">DEDUCIR GASTO</th>
		<td style="text-align:center;"></td>
	</tr>
</thead>
<tbody>
<?php
$incre_inf = 0;
$total_ganancia = 0;

$sql_gasto_inmueble_inquilino_venta_temporal = "SELECT * FROM tbl15_gasto_inmueble_inquilino_venta_temporal WHERE (cuenta = '$cuenta_actual') AND (cod_caja_virtual = '$cod_caja_virtual') 
ORDER BY cod_gasto_inmueble_inquilino_venta_temporal DESC";
$consulta_gasto_inmueble_inquilino_venta_temporal = mysqli_query($conectar, $sql_gasto_inmueble_inquilino_venta_temporal);
while ($datos_gasto_inmueble_inquilino_venta_temporal = mysqli_fetch_assoc($consulta_gasto_inmueble_inquilino_venta_temporal)) {

$cod_gasto_inmueble_inquilino_venta_temporal     = $datos_gasto_inmueble_inquilino_venta_temporal['cod_gasto_inmueble_inquilino_venta_temporal'];
$und_venta                                       = $datos_gasto_inmueble_inquilino_venta_temporal['und_venta'];
$cod_gasto_inmueble                              = $datos_gasto_inmueble_inquilino_venta_temporal['cod_gasto_inmueble'];
$nombre_gasto_inmueble_detalle                   = $datos_gasto_inmueble_inquilino_venta_temporal['nombre_gasto_inmueble_detalle'];
$descripcion_gasto_inmueble_detalle              = $datos_gasto_inmueble_inquilino_venta_temporal['descripcion_gasto_inmueble_detalle'];
$precio_venta_producto                           = $datos_gasto_inmueble_inquilino_venta_temporal['precio_venta_producto'];
$precio_compra_producto                          = $datos_gasto_inmueble_inquilino_venta_temporal['precio_compra_producto'];
$fecha_gasto_inmueble_detalle                    = $datos_gasto_inmueble_inquilino_venta_temporal['fecha_gasto_inmueble_detalle'];
$cod_tipo_estado_incluido                        = $datos_gasto_inmueble_inquilino_venta_temporal['cod_tipo_estado_incluido'];
$cod_tipo_forma_pago                             = $datos_gasto_inmueble_inquilino_venta_temporal['cod_tipo_forma_pago'];
$url_img_orig_producto                           = $datos_gasto_inmueble_inquilino_venta_temporal['url_img_orig_producto'];
$ganancia                                        = $precio_venta_producto - $precio_compra_producto;
$total_ganancia                                 += $ganancia;

if ($url_img_orig_producto == '') { $existe_archivo_cargado = '0'; } else { $existe_archivo_cargado = '1'; }

$sql_tipo_estado_incluido = "SELECT * FROM tbl15_tipo_estado_incluido WHERE (cod_tipo_estado_incluido = '$cod_tipo_estado_incluido')";
$consulta_tipo_estado_incluido = mysqli_query($conectar, $sql_tipo_estado_incluido);
$datos_tipo_estado_incluido = mysqli_fetch_assoc($consulta_tipo_estado_incluido);

$nombre_tipo_estado_incluido                     = $datos_tipo_estado_incluido['nombre_tipo_estado_incluido'];

$incre_inf++;
?>
	<tr id="tr<?php echo $cod_gasto_inmueble_inquilino_venta_temporal;?>">
		<td style="text-align:center;"></td>
		<?php if ($cod_estado_eliminar_caja_mesa_virtual == '1') { ?><td  style="text-align:center;"><a href="../admin/eliminar.php?llave=<?php echo $cod_gasto_inmueble_inquilino_venta_temporal?>&tab=<?php echo $tab ?>&tipo=<?php echo $tipo ?>&campo=<?php echo $campo ?>&cuenta=<?php echo $cuenta ?>&cod_caja_virtual=<?php echo $cod_caja_virtual ?>&cod_cuentas_cobrar_alerta=<?php echo $cod_cuentas_cobrar_alerta ?>&cod_cuentas_cobrar=<?php echo $cod_cuentas_cobrar ?>&cod_factura=<?php echo $cod_factura ?>&numero_alerta=<?php echo $numero_alerta ?>&cod_tercero=<?php echo $cod_tercero ?>&cliente=<?php echo $cliente ?>&palabra=<?php echo $palabra ?>&pagina=<?php echo $pagina_local ?>"><img src="../imagenes/eliminar.png" class="img-polaroid" alt=""></a></td><?php } ?>
		<td style="text-align:center;"><?php echo $cod_gasto_inmueble ?></td>
		<td style="text-align:left;"><?php echo $nombre_gasto_inmueble_detalle ?></td>
        <td style="text-align:center;"><textarea name="descripcion_gasto_inmueble_detalle" id="descripcion_gasto_inmueble_detalle<?php echo $incre_inf;?>" class="<?php echo $cod_gasto_inmueble_inquilino_venta_temporal;?>" rows="1" cols="100" style="font-size:24px; width: 500px;"><?php echo $descripcion_gasto_inmueble_detalle;?></textarea></td>
        <td style="text-align:center;"><input name="precio_compra_producto" type="text" id="precio_compra_producto<?php echo $incre_inf;?>" class="<?php echo $cod_gasto_inmueble_inquilino_venta_temporal;?>" value="<?php echo $precio_compra_producto;?>" style="font-size:24px; width: 130px;" /></td>
        <td style="text-align:center;"><input name="precio_venta_producto" type="text" id="precio_venta_producto<?php echo $incre_inf;?>" class="<?php echo $cod_gasto_inmueble_inquilino_venta_temporal;?>" value="<?php echo $precio_venta_producto;?>" style="font-size:24px; width: 130px;" /></td>
        <td style="text-align:center;"><input name="fecha_gasto_inmueble_detalle" type="date" id="fecha_gasto_inmueble_detalle<?php echo $incre_inf;?>" class="<?php echo $cod_gasto_inmueble_inquilino_venta_temporal;?>" value="<?php echo $fecha_gasto_inmueble_detalle;?>" style="font-size:24px; width: 180px;" /></td>
        <!--<td style="text-align:center"><input type="file" name="url_img1" id="fecha_gasto_inmueble_detalle<?php echo $incre_inf;?>" class="<?php echo $cod_gasto_inmueble_inquilino_venta_temporal;?>"></td></td>-->
        <td style="text-align: center;"><a href="../admin/gasto_venta_temporal_gasto_inmueble_inquilino_soporte_archivo_adjunto.php?cod_gasto_inmueble_inquilino_venta_temporal=<?php echo $cod_gasto_inmueble_inquilino_venta_temporal;?>&cod_info_gasto_inmueble_inquilino_venta=<?php echo $cod_info_gasto_inmueble_inquilino_venta;?>&cod_caja_virtual=<?php echo $cod_caja_virtual;?>&cod_factura=<?php echo $cod_factura;?>&cuenta=<?php echo $cuenta_actual;?>&pagina=<?php echo $pagina_local;?>"><img src=../imagenes/adjuntar_archivo.png alt="Adjuntar"><?php echo $existe_archivo_cargado;?></a></td>
        <?php if ($url_img_orig_producto <> '') { ?><td style="text-align:center"><a href="<?php echo $url_img_orig_producto ?>" target="_blank"><img src="../imagenes/pdf_peq.png" class="img-polaroid" alt=""></a></td><?php } else { ?><td style="text-align:center"></td><?php } ?>
        <td style="text-align:center;"><a href="../admin/gasto_inmueble_inquilino_venta_reg.php?cod_gasto_inmueble_inquilino_venta_temporal=<?php echo $cod_gasto_inmueble_inquilino_venta_temporal?>&cod_tipo_estado_incluido=<?php echo $cod_tipo_estado_incluido ?>&cod_info_gasto_inmueble_inquilino_venta=<?php echo $cod_info_gasto_inmueble_inquilino_venta ?>&cuenta=<?php echo $cuenta_actual ?>&cod_caja_virtual=<?php echo $cod_caja_virtual ?>&tab=<?php echo $tab ?>&tipo=<?php echo $tipo ?>&campo=<?php echo $campo ?>&cod_cuentas_cobrar_alerta=<?php echo $cod_cuentas_cobrar_alerta ?>&cod_cuentas_cobrar=<?php echo $cod_cuentas_cobrar ?>&cod_factura=<?php echo $cod_factura ?>&numero_alerta=<?php echo $numero_alerta ?>&cod_tercero=<?php echo $cod_tercero ?>&cliente=<?php echo $cliente ?>&palabra=<?php echo $palabra ?>&pagina=<?php echo $pagina_local ?>">DEDUCIR</a></td>
        <td style="text-align:center;"></td>
	</tr id="tr<?php echo $cod_gasto_inmueble_inquilino_venta_temporal;?>">
<?php } ?>
</tbody>
</table>

<?php } else { } ?>

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
<script type="text/javascript">
$(document).ready(function() {

    $('.eliminar').click(function(){

        var parent = $(this).parent().attr('id');
        var cod_gasto_inmueble_inquilino_venta_temporal = $(this).parent().attr('data');
        var dataString = 'llave='+cod_gasto_inmueble_inquilino_venta_temporal+'&'+'tab='+'<?php echo $tab ?>'+'&'+'campo='+'<?php echo $campo ?>'+'&'+'tipo='+'<?php echo $tipo ?>';

        $.ajax({
            type: "POST",
            url: "../admin/eliminar_ajax.php",
            data: dataString,
            success: function() {           
                $('#eliminar-ok').empty();
                $('#eliminar-ok').append('<div align="center" class="correcto">Se ha eliminado correctamente el codigo = '+cod_gasto_inmueble_inquilino_venta_temporal+'.</div>').fadeIn("slow");
                $('#'+parent).fadeOut("slow");
                $('#cod_gasto_inmueble_inquilino_venta_temporal'+cod_gasto_inmueble_inquilino_venta_temporal).fadeOut("slow");
                $('#cod_producto_barra_'+cod_gasto_inmueble_inquilino_venta_temporal).fadeOut("slow");
                $('#nombre_cliente_'+cod_gasto_inmueble_inquilino_venta_temporal).fadeOut("slow");
                $('#nombre_producto_'+cod_gasto_inmueble_inquilino_venta_temporal).fadeOut("slow");
                $('#und_venta_'+cod_gasto_inmueble_inquilino_venta_temporal).fadeOut("slow");
                $('#precio_venta_producto_'+cod_gasto_inmueble_inquilino_venta_temporal).fadeOut("slow");
                $('#mensaje_alerta_'+cod_gasto_inmueble_inquilino_venta_temporal).fadeOut("slow");
                $('#total_venta_producto_'+cod_gasto_inmueble_inquilino_venta_temporal).fadeOut("slow");
                $('#nombre_tipo_unidad_medida_'+cod_gasto_inmueble_inquilino_venta_temporal).fadeOut("slow");
                $('#nombre_frec_duracion_'+cod_gasto_inmueble_inquilino_venta_temporal).fadeOut("slow");
                $('#tr'+cod_gasto_inmueble_inquilino_venta_temporal).fadeOut("slow");
            }
        });

    });

});
</script>


<?php if ($cod_estado_bascula_balanza_electronica_pesar_producto_global == '1') { ?>
<script type="text/javascript">
    document.getElementById("<?php echo $foco ?>").select();
</script>
<?php } ?>


<?php if ($cod_estado_bascula_balanza_cod_barras_pesar_producto_global == '1') { ?>
<script type="text/javascript">
$(document).ready(function() {

    var incrent = <?php echo $total_datos;?>;
    var pesar_producto_input_text = "";

    for (i=1; i<=incrent; i++){
        pesar_producto_input_text = "pesar_producto_input"+i;
        document.getElementById(pesar_producto_input_text).style.display = 'none';
    }

    $('.btn_pesar_producto').click(function(){
        var nombre_incre = $(this).attr("id");
        var frag = nombre_incre.split("btn_pesar_producto");
        var id_incre = frag[1];

        document.getElementById("btn_pesar_producto"+id_incre).style.display = 'none';
        document.getElementById("pesar_producto_input"+id_incre).style.display = 'block';
        document.getElementById("pesar_producto_input"+id_incre).focus();
    });

    $("input[name='pesar_producto_input']").change(function(){
        var valor = $(this).val();
        var campo = $(this).attr("name");
        var tipo_ajax = "tbl15_gasto_inmueble_inquilino_venta_temporal";
        var id = $(this).attr("class");
        var foco = '';
        var pagina = '';
        var cod_gasto_inmueble_inquilino_venta_temporal = id;
        var datos_url_ajax = 'id='+id+'&'+'valor='+valor+'&'+'campo='+campo+'&'+'tipo='+tipo_ajax+'foco='+foco+'&'+'pagina='+pagina;

        $.ajax({
            type: "POST",
            url: "../admin/reg_venta_temporal_pesar_producto_ajax_reg.php",
            data: datos_url_ajax,
            //dataType: 'json',
            beforeSend: function(objeto){
                $('#loader').html('<img src="../imagenes/ajax-loader.gif"> Cargando...');
            },
            success:function(respuesta){
                var ok_ajax = respuesta.ok_ajax;
                //window.location.href = window.location.href;
                window.location.reload();
            }
        });

    });

});
</script>
<?php } ?>

</body>
</html>