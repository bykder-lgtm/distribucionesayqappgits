<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<link rel="stylesheet" type="text/css" href="../estilo_css/estilo_modal.css">
<script src="js/jquery.js" type="text/javascript"></script> 
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

if (isset($_GET['foco'])) { $foco = addslashes($_GET['foco']); } else { $foco = 'busqueda'; }

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

if(valor_buscar=='') { document.getElementById("logo_cargador").innerHTML=""; return; }

if (window.XMLHttpRequest) { xmlhttp=new XMLHttpRequest(); } else { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); }
xmlhttp.onreadystatechange=function() {
  if (xmlhttp.readyState==4 && xmlhttp.status==200) { document.getElementById("logo_cargador").innerHTML=xmlhttp.responseText; } else { document.getElementById("logo_cargador").innerHTML='<center><img src="../imagenes/loader.gif"/></center>'; }
}
xmlhttp.open("POST","../admin/busqueda_inmediata_plan_accion_correctiva_preventiva_mejora_venta_temporal_producto_php.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("buscar="+valor_buscar+"&nombre_tipo_moneda="+nombre_tipo_moneda+"&nombre_tipo_factura="+nombre_tipo_factura+"&cod_estado_vacuna="+cod_estado_vacuna+"&pagina="+pagina);
}
</script>

<div class="table-responsive">

<table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; width:100%">
    <tbody><tr>
        <td bgcolor="#fff" align="center"><strong><a href="../admin/lista_info_factura_plan_accion_correctiva_preventiva_mejora_venta.php">LISTA DE PLAN ACCIONES CORRECTIVAS, PREVENTIVAS Y DE MEJORAS</a></strong></td>
    </tr></tbody>
</table>
<br>
<table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; width:100%">
    <tbody>
    	<tr>
    		<td bgcolor="#fff" align="center"><strong>Plan Acciones Correctivas Manual: [<?php echo $cod_caja_virtual ?>]<input type="text" id="busqueda" name="busqueda" onkeyup="hacer_busqueda()" style="height:40" placeholder="Buscar"/><input type="hidden" id="pagina" name="pagina" value="<?php echo $pagina_local ?>"/></strong><div id="logo_cargador"></div></td>
    	</tr>
    </tbody>
</table>
<!-- ***************************************************************************************************************************** -->
<?php include_once('../admin/info_factura_plan_accion_correctiva_preventiva_mejora_venta_temporal_pos.php'); ?>
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php if ($total_datos <> 0) { ?>
<table class="table table-striped" border="1" cellspacing="0" cellpadding="0">
<thead>
  <tr>
    <th style="text-align:center;"></th>
    <th style="text-align:center;" colspan="9"></th>
    <th style="text-align:center;" colspan="3">RECURSOS</th>
    <th style="text-align:center;" colspan="4"></th>
    <th style="text-align:center;" colspan="3">SEGUIMIENTO</th>
  </tr>
  <tr>
    <th style="text-align:center;">ELIM</th>
    <th style="text-align:center;">#</th>
    <th style="text-align:center;">TIPO DE ACCIÓN</th>
    <th style="text-align:center;">FUENTE</th>
    <th style="text-align:center;">ACTIVIDAD</th>
    <th style="text-align:center;" colspan="3">DESCRIPCION HALLAZGO</th>
    <th style="text-align:center;" colspan="2">ACCION TOMADA</th>
    <th style="text-align:center;">HUMANO</th>
    <th style="text-align:center;">FINANCIERO</th>
    <th style="text-align:center;">TECNOLOGICO</th>
    <th style="text-align:center;" colspan="2">RESPONSABLE DE IMPLANTAR LA ACCION</th>
    <th style="text-align:center;" colspan="2">FECHA PREVISTA</th>
    <th style="text-align:center;">CUMPLIMIENTO</th>
    <th style="text-align:center;">EFICACIA</th>
    <th style="text-align:center;">SOPORTES</th>
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

$incre++;
?>
<tbody>
  <tr style="text-align:center;" id="tr<?php echo $cod_plan_accion_correctiva_preventiva_mejora_temporal;?>">
    <td  style="text-align:center;"><a href="../admin/eliminar.php?llave=<?php echo $cod_plan_accion_correctiva_preventiva_mejora_temporal?>&tab=<?php echo $tab ?>&tipo=<?php echo $tipo ?>&campo=<?php echo $campo ?>&pagina=<?php echo $pagina_local ?>"><img src="../imagenes/eliminar.png" class="img-polaroid" alt=""></a></td>
    <td style="text-align:center;"><?php echo $incre;?></td>
    <td style="text-align:center;" id="nombre_tipo_accion_<?php echo $incre;?>"><input name="nombre_tipo_accion" type="text" id="nombre_tipo_accion<?php echo $incre;?>" llave="<?php echo $cod_plan_accion_correctiva_preventiva_mejora_temporal;?>" class="input-block-level" value="<?php echo $nombre_tipo_accion;?>"/></td>
    <td style="text-align:center;" id="nombre_tipo_fuente_<?php echo $incre;?>"><input name="nombre_tipo_fuente" type="text" id="nombre_tipo_fuente<?php echo $incre;?>" llave="<?php echo $cod_plan_accion_correctiva_preventiva_mejora_temporal;?>" class="input-block-level" value="<?php echo $nombre_tipo_fuente;?>"/></td>
    <td style="text-align:center;" id="nombre_tipo_actividad_<?php echo $incre;?>"><input name="nombre_tipo_actividad" type="text" id="nombre_tipo_actividad<?php echo $incre;?>" llave="<?php echo $cod_plan_accion_correctiva_preventiva_mejora_temporal;?>" class="input-block-level" value="<?php echo $nombre_tipo_actividad;?>"/></td>
    <td style="text-align:center;" colspan="3" id="descripcion_hallazgo_<?php echo $incre;?>"><input name="descripcion_hallazgo" type="text" id="descripcion_hallazgo<?php echo $incre;?>" llave="<?php echo $cod_plan_accion_correctiva_preventiva_mejora_temporal;?>" class="input-block-level" value="<?php echo $descripcion_hallazgo;?>"/></td>
    <td style="text-align:center;" colspan="2" id="nombre_tipo_accion_tomada_<?php echo $incre;?>"><input name="nombre_tipo_accion_tomada" type="text" id="nombre_tipo_accion_tomada<?php echo $incre;?>" llave="<?php echo $cod_plan_accion_correctiva_preventiva_mejora_temporal;?>" class="input-block-level" value="<?php echo $nombre_tipo_accion_tomada;?>"/></td>
    <td style="text-align:center;" id="recurso_humano_<?php echo $incre;?>"><input name="recurso_humano" type="text" id="recurso_humano<?php echo $incre;?>" llave="<?php echo $cod_plan_accion_correctiva_preventiva_mejora_temporal;?>" class="input-block-level" value="<?php echo $recurso_humano;?>"/></td>
    <td style="text-align:center;" id="recurso_financiero_<?php echo $incre;?>"><input name="recurso_financiero" type="text" id="recurso_financiero<?php echo $incre;?>" llave="<?php echo $cod_plan_accion_correctiva_preventiva_mejora_temporal;?>" class="input-block-level" value="<?php echo $recurso_financiero;?>"/></td>
    <td style="text-align:center;" id="recurso_tecnologico_<?php echo $incre;?>"><input name="recurso_tecnologico" type="text" id="recurso_tecnologico<?php echo $incre;?>" llave="<?php echo $cod_plan_accion_correctiva_preventiva_mejora_temporal;?>" class="input-block-level" value="<?php echo $recurso_tecnologico;?>"/></td>
    <td style="text-align:center;" colspan="2" id="nombre_responsable_implantar_accion_<?php echo $incre;?>"><input name="nombre_responsable_implantar_accion" type="text" id="nombre_responsable_implantar_accion<?php echo $incre;?>" llave="<?php echo $cod_plan_accion_correctiva_preventiva_mejora_temporal;?>" class="input-block-level" value="<?php echo $nombre_responsable_implantar_accion;?>"/></td>
    <td style="text-align:center;" colspan="2" id="fecha_prevista_<?php echo $incre;?>"><input name="fecha_prevista" type="date" id="fecha_prevista<?php echo $incre;?>" llave="<?php echo $cod_plan_accion_correctiva_preventiva_mejora_temporal;?>" class="input-block-level" value="<?php echo $fecha_prevista;?>"/></td>
    <td style="text-align:center;" id="seguimiento_cumplimiento_<?php echo $incre;?>"><input name="seguimiento_cumplimiento" type="text" id="seguimiento_cumplimiento<?php echo $incre;?>" llave="<?php echo $cod_plan_accion_correctiva_preventiva_mejora_temporal;?>" class="input-block-level" value="<?php echo $seguimiento_cumplimiento;?>"/></td>
    <td style="text-align:center;" id="seguimiento_eficacia_<?php echo $incre;?>"><input name="seguimiento_eficacia" type="text" id="seguimiento_eficacia<?php echo $incre;?>" llave="<?php echo $cod_plan_accion_correctiva_preventiva_mejora_temporal;?>" class="input-block-level" value="<?php echo $seguimiento_eficacia;?>"/></td>
    <td style="text-align:center;" id="seguimiento_soporte_<?php echo $incre;?>"><input name="seguimiento_soporte" type="text" id="seguimiento_soporte<?php echo $incre;?>" llave="<?php echo $cod_plan_accion_correctiva_preventiva_mejora_temporal;?>" class="input-block-level" value="<?php echo $seguimiento_soporte;?>"/></td>
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
<!--
<script type="text/javascript">
$(document).ready(function() {
    var cod_tipo_cobrar = $('#cod_tipo_cobrar').val();
    if (cod_tipo_cobrar=='1') { $('#cod_tipo_cobrar').val('1'); $('#cod_tipo_cobrar').prop('checked',true); } else { $('#cod_tipo_cobrar').val('0'); $('#cod_tipo_cobrar').prop('checked',false); } 
    $(".cod_tipo_cobrar").change(function(){ if( $(this).is(':checked') ){ $(".cod_tipo_cobrar").val("1"); } else { $(".cod_tipo_cobrar").val("0"); } });
});
</script>
-->
<script>
function calc_total_venta(){

var i=0;
var incre = <?php echo $total_datos;?>;
var und_venta_text = "";
var precio_venta_producto_text = "";
var total_venta_producto_text = "";
var total_venta = 0;
var und_venta = 0;
var precio_venta_producto = 0;
var total_venta_producto = 0;
var smtr_total_venta = 0;
var Max_Length = 4;
var length = 0;

for (i=1; i<=incre; i++){

und_venta_text = "und_venta"+i;
precio_venta_producto_text = "precio_venta_producto"+i;
total_venta_producto_text = "total_venta_producto"+i;
//mensaje_alerta_text = "mensaje_alerta"+i;

//mensaje_alerta = document.getElementById(mensaje_alerta_text).value;
und_venta = document.getElementById(und_venta_text).value;
precio_venta_producto = document.getElementById(precio_venta_producto_text).value;
total_venta_producto = (und_venta * precio_venta_producto);
smtr_total_venta = smtr_total_venta + total_venta_producto;
<!-- ////////////////////////////////////////////////////////////////////////////////////////////////// -->
length = document.getElementById(und_venta_text).value.length;
if (length > Max_Length) {
//var objeto_mostrar_mensaje = document.getElementById("mensaje_alerta_"+i);
//objeto_mostrar_mensaje.parentNode.innerHTML = objeto_mostrar_mensaje.parentNode.innerHTML + "<p style='color:yellow'>Verificar</p>";
//  address1.parentNode.innerHTML = address1.parentNode.innerHTML + "<p style='color:red'>the max length of "+Max_Length + " characters is reached, you typed in  " + length + "characters</p>";
console.log(length);
} else {  }
<!-- ////////////////////////////////////////////////////////////////////////////////////////////////// -->

document.getElementById(total_venta_producto_text).innerHTML=total_venta_producto.toLocaleString("es-ES");
}
total_venta = smtr_total_venta;
document.getElementById("total_venta").innerHTML=total_venta.toLocaleString("es-ES");
}
</script>

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