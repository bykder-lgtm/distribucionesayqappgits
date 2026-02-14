<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="../estilo_css/area_imprimible_invisible.css">
<link rel="stylesheet" type="text/css" href="../estilo_css/estilo_modal.css">
<script type="text/javascript" src="js/jquery.number.js"></script>
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
$tab                               = 'tbl15_plan_accion_correctiva_preventiva_mejora_temporal';
$campo                             = 'cod_plan_accion_correctiva_preventiva_mejora_temporal';
$tipo                              = 'eliminar';
$cod_estado_vacuna                 = '0';

$nombre_tipo_moneda                = "COP";
$nombre_tipo_factura               = "POS";
$cod_estado_vacuna                 = "0";

$time_seg                          = time();
$fecha                             = date("Ymd");
$hora                              = date("His");

if (isset($_GET['foco'])) { $foco = addslashes($_GET['foco']); } else { $foco = 'busqueda'; }
if (isset($_GET['buscar_por'])) { $buscar_por = addslashes($_GET['buscar_por']); } else { $buscar_por = $nombre_buscar_por; }

$datos_factura = "SELECT cod_plan_accion_correctiva_preventiva_mejora_temporal FROM tbl15_plan_accion_correctiva_preventiva_mejora_temporal WHERE (cuenta = '$cuenta_actual') AND (cod_caja_virtual = '$cod_caja_virtual')";
$consulta = mysqli_query($conectar, $datos_factura);
$total_datos = mysqli_num_rows($consulta);
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
var buscar_por= $("#buscar_por").val();


if(valor_buscar=='') { document.getElementById("logo_cargador").innerHTML=""; return; }

if (window.XMLHttpRequest) { xmlhttp=new XMLHttpRequest(); } else { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); }
xmlhttp.onreadystatechange=function() {
  if (xmlhttp.readyState==4 && xmlhttp.status==200) { document.getElementById("logo_cargador").innerHTML=xmlhttp.responseText; } else { document.getElementById("logo_cargador").innerHTML='<center><img src="../imagenes/loader.gif"/></center>'; }
}
xmlhttp.open("POST","../admin/busqueda_inmediata_plan_accion_correctiva_preventiva_mejora_temporal_producto_php.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("buscar="+valor_buscar+"&buscar_por="+buscar_por+"&nombre_tipo_moneda="+nombre_tipo_moneda+"&nombre_tipo_factura="+nombre_tipo_factura+"&tipo_busqueda="+tipo_busqueda+"&cod_estado_vacuna="+cod_estado_vacuna+"&pagina="+pagina);
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
        <td bgcolor="#fff" align="center"><strong><a href="../admin/lista_info_plan_accion_correctiva_preventiva_mejora.php">LISTA DE FACTURAS VENTA</a></strong></td>
    </tr></tbody>
</table>
<br>
<table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; width:100%">
    <tbody>
    	<tr>
            <td bgcolor="#fff" align="center"><a href="../admin/facturacion_venta_temporal_producto_barras_pos.php"><strong>Venta Barras</strong></a></td>
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
            <strong>Venta Manual:<a href="../admin/facturacion_venta_temporal_producto_manual_pos_completa.php">%%</a> [<?php echo $cod_caja_virtual ?>]<input type="text" id="busqueda" name="busqueda" onkeyup="hacer_busqueda()" style="height:40" placeholder="Buscar"/><input type="hidden" id="pagina" name="pagina" value="<?php echo $pagina_local ?>"/></strong><div id="logo_cargador"></div>
            </td>
    	</tr>
    </tbody>
</table>
<!-- ***************************************************************************************************************************** -->
<?php include_once('../admin/info_plan_accion_correctiva_preventiva_mejora_temporal_pos.php'); ?>
<!-- ***************************************************************************************************************************** -->
<?php if ($total_datos <> 0) { include_once("../admin/modal_registrar_tercero.php"); } ?>
<!-- ***************************************************************************************************************************** -->
<?php if ($total_datos <> 0) { ?>


<table class="table table-striped" border="1" cellspacing="0" cellpadding="20">
<thead>
  <tr>
    <td style="text-align:center;"></td>
    <td style="text-align:center;" colspan="9"></td>
    <td style="text-align:center;" colspan="3">RECURSOS</td>
    <td style="text-align:center;" colspan="4"></td>
    <td style="text-align:center;" colspan="3">SEGUIMIENTO</td>
  </tr>
  <tr>
    <td style="text-align:center;">ELIM</td>
    <td style="text-align:center;">#</td>
    <td style="text-align:center;">TIPO DE ACCIÓN</td>
    <td style="text-align:center;">FUENTE</td>
    <td style="text-align:center;">ACTIVIDAD</td>
    <td style="text-align:center;" colspan="3">DESCRIPCION HALLAZGO</td>
    <td style="text-align:center;" colspan="2">ACCION TOMADA</td>
    <td style="text-align:center;">HUMANO</td>
    <td style="text-align:center;">FINANCIERO</td>
    <td style="text-align:center;">TECNOLOGICO</td>
    <td style="text-align:center;" colspan="2">RESPONSABLE DE IMPLANTAR LA ACCION</td>
    <td style="text-align:center;" colspan="2">FECHA    PREVISTA</td>
    <td style="text-align:center;">CUMPLIMIENTO</td>
    <td style="text-align:center;">EFICACIA</td>
    <td style="text-align:center;">SOPORTES</td>
  </tr>
<thead>
<?php
$sql_plan_accion_correctiva_preventiva_mejora_temporal = "SELECT * FROM tbl15_plan_accion_correctiva_preventiva_mejora_temporal WHERE (cuenta = '$cuenta_actual') AND (cod_caja_virtual = '$cod_caja_virtual') 
ORDER BY cod_plan_accion_correctiva_preventiva_mejora_temporal DESC";
$consulta_plan_accion_correctiva_preventiva_mejora_temporal = mysqli_query($conectar, $sql_plan_accion_correctiva_preventiva_mejora_temporal);
while ($datos_plan_accion_correctiva_preventiva_mejora_temporal = mysqli_fetch_assoc($consulta_plan_accion_correctiva_preventiva_mejora_temporal)) {

$cod_plan_accion_correctiva_preventiva_mejora_temporal       = $datos_plan_accion_correctiva_preventiva_mejora_temporal['cod_plan_accion_correctiva_preventiva_mejora_temporal'];
$nombre_tipo_accion                                          = $datos_plan_accion_correctiva_preventiva_mejora_temporal['nombre_tipo_accion'];
$nombre_tipo_fuente                                          = $datos_plan_accion_correctiva_preventiva_mejora_temporal['nombre_tipo_fuente'];
$nombre_tipo_actividad                                       = $datos_plan_accion_correctiva_preventiva_mejora_temporal['nombre_tipo_actividad'];
$descripcion_hallazgo                                        = $datos_plan_accion_correctiva_preventiva_mejora_temporal['descripcion_hallazgo'];
$nombre_tipo_accion_tomada                                   = $datos_plan_accion_correctiva_preventiva_mejora_temporal['nombre_tipo_accion_tomada'];
$recurso_humano                                              = $datos_plan_accion_correctiva_preventiva_mejora_temporal['recurso_humano'];
$recurso_financiero                                          = $datos_plan_accion_correctiva_preventiva_mejora_temporal['recurso_financiero'];
$recurso_tecnologico                                         = $datos_plan_accion_correctiva_preventiva_mejora_temporal['recurso_tecnologico'];
$nombre_responsable_implantar_accion                         = $datos_plan_accion_correctiva_preventiva_mejora_temporal['nombre_responsable_implantar_accion'];
$fecha_prevista                                              = $datos_plan_accion_correctiva_preventiva_mejora_temporal['fecha_prevista'];
$seguimiento_cumplimiento                                    = $datos_plan_accion_correctiva_preventiva_mejora_temporal['seguimiento_cumplimiento'];
$seguimiento_eficacia                                        = $datos_plan_accion_correctiva_preventiva_mejora_temporal['seguimiento_eficacia'];
$seguimiento_soporte                                         = $datos_plan_accion_correctiva_preventiva_mejora_temporal['seguimiento_soporte'];
/*
nombre_tipo_accion
nombre_tipo_fuente
nombre_tipo_actividad
descripcion_hallazgo
nombre_tipo_accion_tomada
recurso_humano
recurso_financiero
recurso_tecnologico
nombre_responsable_implantar_accion
fecha_prevista
seguimiento_cumplimiento
seguimiento_eficacia
seguimiento_soporte
cuenta
cod_administrador
fecha_creacion
fecha_modificacion
fecha_ymd_venta_producto
fecha_hora_venta_producto
fecha_time
cod_estado
*/
$incre++;
?>
<tbody>
  <tr style="text-align:center;" id="tr<?php echo $cod_plan_accion_correctiva_preventiva_mejora_temporal;?>">
    <td  style="text-align:center;"><a href="../admin/eliminar.php?llave=<?php echo $cod_plan_accion_correctiva_preventiva_mejora_temporal?>&tab=<?php echo $tab ?>&tipo=<?php echo $tipo ?>&campo=<?php echo $campo ?>&pagina=<?php echo $pagina_local ?>"><img src="../imagenes/eliminar.png" class="img-polaroid" alt=""></a></td>
    <td style="text-align:center;"><?php echo $incre;?></td>
    <td style="text-align:center;" id="nombre_tipo_accion_<?php echo $incre;?>"><input name="nombre_tipo_accion" type="text" id="nombre_tipo_accion<?php echo $incre;?>" class="<?php echo $cod_plan_accion_correctiva_preventiva_mejora_temporal;?>" value="<?php echo $nombre_tipo_accion;?>"/></td>
    <td style="text-align:center;" id="nombre_tipo_fuente_<?php echo $incre;?>"><input name="nombre_tipo_fuente" type="text" id="nombre_tipo_fuente<?php echo $incre;?>" class="<?php echo $cod_plan_accion_correctiva_preventiva_mejora_temporal;?>" value="<?php echo $nombre_tipo_fuente;?>"/></td>
    <td style="text-align:center;" id="nombre_tipo_actividad_<?php echo $incre;?>"><input name="nombre_tipo_actividad" type="text" id="nombre_tipo_actividad<?php echo $incre;?>" class="<?php echo $cod_plan_accion_correctiva_preventiva_mejora_temporal;?>" value="<?php echo $nombre_tipo_actividad;?>"/></td>
    <td style="text-align:center;" colspan="3" id="descripcion_hallazgo_<?php echo $incre;?>"><input name="descripcion_hallazgo" type="text" id="descripcion_hallazgo<?php echo $incre;?>" class="<?php echo $cod_plan_accion_correctiva_preventiva_mejora_temporal;?>" value="<?php echo $descripcion_hallazgo;?>"/></td>
    <td style="text-align:center;" colspan="2" id="nombre_tipo_accion_tomada_<?php echo $incre;?>"><input name="nombre_tipo_accion_tomada" type="text" id="nombre_tipo_accion_tomada<?php echo $incre;?>" class="<?php echo $cod_plan_accion_correctiva_preventiva_mejora_temporal;?>" value="<?php echo $nombre_tipo_accion_tomada;?>"/></td>
    <td style="text-align:center;" id="recurso_humano_<?php echo $incre;?>"><input name="recurso_humano" type="text" id="recurso_humano<?php echo $incre;?>" class="<?php echo $cod_plan_accion_correctiva_preventiva_mejora_temporal;?>" value="<?php echo $recurso_humano;?>"/></td>
    <td style="text-align:center;" id="recurso_financiero_<?php echo $incre;?>"><input name="recurso_financiero" type="text" id="recurso_financiero<?php echo $incre;?>" class="<?php echo $cod_plan_accion_correctiva_preventiva_mejora_temporal;?>" value="<?php echo $recurso_financiero;?>"/></td>
    <td style="text-align:center;" id="recurso_tecnologico_<?php echo $incre;?>"><input name="recurso_tecnologico" type="text" id="recurso_tecnologico<?php echo $incre;?>" class="<?php echo $cod_plan_accion_correctiva_preventiva_mejora_temporal;?>" value="<?php echo $recurso_tecnologico;?>"/></td>
    <td style="text-align:center;" colspan="2" id="nombre_responsable_implantar_accion_<?php echo $incre;?>"><input name="nombre_responsable_implantar_accion" type="text" id="nombre_responsable_implantar_accion<?php echo $incre;?>" class="<?php echo $cod_plan_accion_correctiva_preventiva_mejora_temporal;?>" value="<?php echo $nombre_responsable_implantar_accion;?>"/></td>
    <td style="text-align:center;" colspan="2" id="fecha_prevista_<?php echo $incre;?>"><input name="fecha_prevista" type="text" id="fecha_prevista<?php echo $incre;?>" class="<?php echo $cod_plan_accion_correctiva_preventiva_mejora_temporal;?>" value="<?php echo $fecha_prevista;?>"/></td>
    <td style="text-align:center;" id="seguimiento_cumplimiento_<?php echo $incre;?>"><input name="seguimiento_cumplimiento" type="text" id="seguimiento_cumplimiento<?php echo $incre;?>" class="<?php echo $cod_plan_accion_correctiva_preventiva_mejora_temporal;?>" value="<?php echo $seguimiento_cumplimiento;?>"/></td>
    <td style="text-align:center;" id="seguimiento_eficacia_<?php echo $incre;?>"><input name="seguimiento_eficacia" type="text" id="seguimiento_eficacia<?php echo $incre;?>" class="<?php echo $cod_plan_accion_correctiva_preventiva_mejora_temporal;?>" value="<?php echo $seguimiento_eficacia;?>"/></td>
    <td style="text-align:center;" id="seguimiento_soporte_<?php echo $incre;?>"><input name="seguimiento_soporte" type="text" id="seguimiento_soporte<?php echo $incre;?>" class="<?php echo $cod_plan_accion_correctiva_preventiva_mejora_temporal;?>" value="<?php echo $seguimiento_soporte;?>"/></td>
  </tr style="text-align:right;" id="tr<?php echo $cod_plan_accion_correctiva_preventiva_mejora_temporal;?>">
</tbody>
<?php } ?>
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
        var cod_plan_accion_correctiva_preventiva_mejora_temporal = $(this).parent().attr('data');
        var dataString = 'llave='+cod_plan_accion_correctiva_preventiva_mejora_temporal+'&'+'tab='+'<?php echo $tab ?>'+'&'+'campo='+'<?php echo $campo ?>'+'&'+'tipo='+'<?php echo $tipo ?>';

        $.ajax({
            type: "POST",
            url: "../admin/eliminar_ajax.php",
            data: dataString,
            success: function() {           
                $('#eliminar-ok').empty();
                $('#eliminar-ok').append('<div align="center" class="correcto">Se ha eliminado correctamente el codigo = '+cod_plan_accion_correctiva_preventiva_mejora_temporal+'.</div>').fadeIn("slow");
                $('#'+parent).fadeOut("slow");
                $('#cod_plan_accion_correctiva_preventiva_mejora_temporal'+cod_plan_accion_correctiva_preventiva_mejora_temporal).fadeOut("slow");
                $('#cod_producto_barra_'+cod_plan_accion_correctiva_preventiva_mejora_temporal).fadeOut("slow");
                $('#nombre_cliente_'+cod_plan_accion_correctiva_preventiva_mejora_temporal).fadeOut("slow");
                $('#nombre_producto_'+cod_plan_accion_correctiva_preventiva_mejora_temporal).fadeOut("slow");
                $('#und_venta_'+cod_plan_accion_correctiva_preventiva_mejora_temporal).fadeOut("slow");
                $('#precio_venta_producto_'+cod_plan_accion_correctiva_preventiva_mejora_temporal).fadeOut("slow");
                $('#mensaje_alerta_'+cod_plan_accion_correctiva_preventiva_mejora_temporal).fadeOut("slow");
                $('#total_venta_producto_'+cod_plan_accion_correctiva_preventiva_mejora_temporal).fadeOut("slow");
                $('#nombre_tipo_unidad_medida_'+cod_plan_accion_correctiva_preventiva_mejora_temporal).fadeOut("slow");
                $('#nombre_frec_duracion_'+cod_plan_accion_correctiva_preventiva_mejora_temporal).fadeOut("slow");
                $('#tr'+cod_plan_accion_correctiva_preventiva_mejora_temporal).fadeOut("slow");
            }
        });

    });

});
</script>
</body>
</html>