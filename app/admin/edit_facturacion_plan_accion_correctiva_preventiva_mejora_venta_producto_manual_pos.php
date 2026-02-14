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
$tab                               = 'tbl15_plan_accion_correctiva_preventiva_mejora';
$campo                             = 'cod_plan_accion_correctiva_preventiva_mejora';
$tipo                              = 'eliminar';
$cod_estado_vacuna                 = '0';

$nombre_tipo_moneda                = "COP";
$nombre_tipo_factura               = "POS";
$cod_estado_vacuna                 = "0";

if (isset($_GET['cod_info_plan_accion_correctiva_preventiva_mejora'])) { $cod_info_plan_accion_correctiva_preventiva_mejora = intval($_GET['cod_info_plan_accion_correctiva_preventiva_mejora']); } else { $cod_info_plan_accion_correctiva_preventiva_mejora = '0'; }

$datos_factura = "SELECT cod_plan_accion_correctiva_preventiva_mejora FROM tbl15_plan_accion_correctiva_preventiva_mejora 
WHERE (cod_info_plan_accion_correctiva_preventiva_mejora = '$cod_info_plan_accion_correctiva_preventiva_mejora')";
$consulta = mysqli_query($conectar, $datos_factura);
$total_datos = mysqli_num_rows($consulta);
?>
<input type="hidden" id="pagina" value="<?php echo $pagina_local ?>">

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
        <td bgcolor="#fff" align="center"><strong><a href="../admin/lista_info_factura_plan_accion_correctiva_preventiva_mejora_venta.php">LISTA DE PLAN ACCIONES CORRECTIVAS, PREVENTIVAS Y DE MEJORAS</a></strong></td>
    </tr></tbody>
</table>
<br>
<!--
<table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; width:100%">
    <tbody>
    	<tr>
    		<td bgcolor="#fff" align="center"><strong>Plan Acciones Correctivas Manual: [<?php echo $cod_caja_virtual ?>]<input type="text" id="busqueda" name="busqueda" onkeyup="hacer_busqueda()" style="height:40" placeholder="Buscar"/><input type="hidden" id="pagina" name="pagina" value="<?php echo $pagina_local ?>"/></strong><div id="logo_cargador"></div></td>
    	</tr>
    </tbody>
</table>
-->
<!-- ***************************************************************************************************************************** -->
<?php include_once('../admin/info_factura_plan_accion_correctiva_preventiva_mejora_venta_pos.php'); ?>
<!-- ***************************************************************************************************************************** -->
<?php if ($total_datos <> 0) { include_once("../admin/modal_registrar_tercero_plan_accion_correctiva_preventiva_mejora.php"); } ?>
<!-- ***************************************************************************************************************************** -->
<?php if ($total_datos <> 0) { ?>
<table class="table table-striped" border="1" cellspacing="0" cellpadding="20">
<thead>
<tr>
<th style="text-align:center;"></th>
<th style="text-align:center;">ELM</th>
<!--<th style="text-align:center;">COBRAR</th>-->
<th style="text-align:center;">CODIGO</th>
<th style="text-align:center;">NOMBRE CONCEPTO</th>
<th style="text-align:center;">CANTIDAD</th>
<th style="text-align:center;">MED</th>
<th style="text-align:center;">T.P</th>
<th style="text-align:center;">VALOR UNITARIO</th>
<td align="center"></td>
<th style="text-align:center;">VALOR TOTAL</th>
<th style="text-align:center;"></th>
</tr>
</thead>
<tbody>
<?php
$sql_plan_accion_correctiva_preventiva_mejora = "SELECT * FROM tbl15_plan_accion_correctiva_preventiva_mejora 
WHERE (cod_info_plan_accion_correctiva_preventiva_mejora = '$cod_info_plan_accion_correctiva_preventiva_mejora') ORDER BY cod_plan_accion_correctiva_preventiva_mejora DESC";
$consulta_plan_accion_correctiva_preventiva_mejora = mysqli_query($conectar, $sql_plan_accion_correctiva_preventiva_mejora);
while ($datos_plan_accion_correctiva_preventiva_mejora = mysqli_fetch_assoc($consulta_plan_accion_correctiva_preventiva_mejora)) {

$cod_plan_accion_correctiva_preventiva_mejora       = $datos_plan_accion_correctiva_preventiva_mejora['cod_plan_accion_correctiva_preventiva_mejora'];
$cod_producto                              = $datos_plan_accion_correctiva_preventiva_mejora['cod_producto'];
$cod_producto_barra                        = $datos_plan_accion_correctiva_preventiva_mejora['cod_producto_barra'];
$nombre_producto                           = $datos_plan_accion_correctiva_preventiva_mejora['nombre_producto'];
$cedula                                    = $datos_plan_accion_correctiva_preventiva_mejora['cedula'];
$nombre_cliente                            = $datos_plan_accion_correctiva_preventiva_mejora['nombre_cliente'];
$und_venta                                 = $datos_plan_accion_correctiva_preventiva_mejora['und_venta'];
$precio_costo_producto                     = $datos_plan_accion_correctiva_preventiva_mejora['precio_costo_producto'];
$total_costo_producto                      = $datos_plan_accion_correctiva_preventiva_mejora['total_costo_producto'];
$precio_venta_producto                     = $datos_plan_accion_correctiva_preventiva_mejora['precio_venta_producto'];
$total_venta_producto                      = $datos_plan_accion_correctiva_preventiva_mejora['total_venta_producto'];
$nombre_tipo_producto                      = $datos_plan_accion_correctiva_preventiva_mejora['nombre_tipo_producto'];
$nombre_tipo_unidad_medida                 = $datos_plan_accion_correctiva_preventiva_mejora['nombre_tipo_unidad_medida'];
$posologia_cantidad                        = $datos_plan_accion_correctiva_preventiva_mejora['posologia_cantidad'];
$posologia_peso                            = $datos_plan_accion_correctiva_preventiva_mejora['posologia_peso'];
$nombre_tipo_presentacion                  = $datos_plan_accion_correctiva_preventiva_mejora['nombre_tipo_presentacion'];
$nombre_via_administracion                 = $datos_plan_accion_correctiva_preventiva_mejora['nombre_via_administracion'];
$nombre_frec_duracion                      = $datos_plan_accion_correctiva_preventiva_mejora['nombre_frec_duracion'];
$cod_tipo_cobrar                           = $datos_plan_accion_correctiva_preventiva_mejora['cod_tipo_cobrar'];
$cod_info_plan_accion_correctiva_preventiva_mejora   = $datos_plan_accion_correctiva_preventiva_mejora['cod_info_plan_accion_correctiva_preventiva_mejora'];
$nombre_tipo_precio_venta                  = $datos_plan_accion_correctiva_preventiva_mejora['nombre_tipo_precio_venta'];

$incre++;
?>
<tr style="text-align:center;" id="tr<?php echo $cod_plan_accion_correctiva_preventiva_mejora;?>">
<th style="text-align:center;"></th>
<td  style="text-align:center;"><a href="../admin/eliminar.php?llave=<?php echo $cod_plan_accion_correctiva_preventiva_mejora?>&tab=<?php echo $tab ?>&tipo=<?php echo $tipo ?>&campo=<?php echo $campo ?>&pagina=<?php echo $pagina_local ?>"><img src="../imagenes/eliminar.png" class="img-polaroid" alt=""></a></td>
<!--<td style="text-align:center"><input name="cod_tipo_cobrar" class="cod_tipo_cobrar__<?php echo $cod_plan_accion_correctiva_preventiva_mejora;?>" id="cod_tipo_cobrar_<?php echo $cod_plan_accion_correctiva_preventiva_mejora;?>" type="checkbox" value="1" <?php if($cod_tipo_cobrar=='1'){ echo "checked"; } ?>></td>-->
<!--<td style="text-align:center;" id="cod_plan_accion_correctiva_preventiva_mejora_<?php echo $cod_plan_accion_correctiva_preventiva_mejora ?>" class="service_list" data="<?php echo $cod_plan_accion_correctiva_preventiva_mejora ?>"><a class="eliminar" id="cod_plan_accion_correctiva_preventiva_mejora<?php echo $cod_plan_accion_correctiva_preventiva_mejora ?>"><img src="../imagenes/eliminar.png" class="img-polaroid" alt=""></a></td>-->
<td style="text-align:center;" id="cod_producto_barra_<?php echo $incre;?>"><?php echo $cod_producto_barra ?></td>

<td style="text-align:right;" id="nombre_producto_<?php echo $incre;?>">
<?php if ($nombre_tipo_componente == 'TEXTAREA') { ?>
<textarea name="nombre_producto" id="nombre_producto<?php echo $incre;?>" class="<?php echo $cod_plan_accion_correctiva_preventiva_mejora;?>" rows="9" cols="50"><?php echo $nombre_producto;?></textarea>
<?php } else { ?>
<input name="nombre_producto" type="text" id="nombre_producto<?php echo $incre;?>" class="<?php echo $cod_plan_accion_correctiva_preventiva_mejora;?>" value="<?php echo $nombre_producto;?>" style="width: 70px;" />
<?php } ?>
</td>

<td style="text-align:right;" id="und_venta_<?php echo $incre;?>"><input name="und_venta" type="number" id="und_venta<?php echo $incre;?>" class="<?php echo $cod_plan_accion_correctiva_preventiva_mejora;?>" onChange="calc_total_venta();" value="<?php echo $und_venta;?>" style="width: 70px;" /></td>
<td style="text-align:center;" id="nombre_tipo_unidad_medida_<?php echo $incre;?>"><?php echo $nombre_tipo_unidad_medida;?></td>

<?php if ($nombre_tipo_precio_venta=='PVAR') { ?>
<td style="text-align:center;"><img src="../imagenes/PVAR.png"></td> 
<td style="text-align:right;" id="precio_venta_producto_<?php echo $incre;?>"><input name="precio_venta_producto" type="number" id="precio_venta_producto<?php echo $incre;?>" class="<?php echo $cod_plan_accion_correctiva_preventiva_mejora;?>" onChange="calc_total_venta();" value="<?php echo $precio_venta_producto;?>" style="width: 100px;" /></td>
<?php } else { ?>
<td style="text-align:center;">
<?php for ($i=1; $i <= $numero_precio; $i++) { ?>
<a href="../admin/actualizar_plan_accion_correctiva_preventiva_mejora_precio_venta_temporal_producto.php?nombre_tipo_precio_venta=PV<?php echo $i?>&cod_plan_accion_correctiva_preventiva_mejora=<?php echo $cod_plan_accion_correctiva_preventiva_mejora?>&cod_info_plan_accion_correctiva_preventiva_mejora=<?php echo $cod_info_plan_accion_correctiva_preventiva_mejora?>&pagina=<?php echo $pagina?>"><img src="<?php if ($nombre_tipo_precio_venta=="PV$i") { echo "../imagenes/PV".$i."_R.png"; } else { echo "../imagenes/PV$i.png"; } ?>"></a>
<?php } ?>
<input type="hidden" id="precio_venta_producto<?php echo $incre;?>" value="<?php echo $precio_venta_producto;?>">
</td>
<td style="text-align:right;" id="precio_venta_producto_<?php echo $incre;?>"><?php echo number_format($precio_venta_producto, 0, ",", "."); ?></td>
<?php } ?>

<td style="text-align:right;" id="mensaje_alerta<?php echo $incre;?>"></td>
<td style="text-align:right;" id="total_venta_producto<?php echo $incre;?>"><?php echo number_format($total_venta_producto, 0, ",", ".");?></td>
<th style="text-align:center;"></th>
</tr style="text-align:right;" id="tr<?php echo $cod_plan_accion_correctiva_preventiva_mejora;?>">
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
        var cod_plan_accion_correctiva_preventiva_mejora = $(this).parent().attr('data');
        var dataString = 'llave='+cod_plan_accion_correctiva_preventiva_mejora+'&'+'tab='+'<?php echo $tab ?>'+'&'+'campo='+'<?php echo $campo ?>'+'&'+'tipo='+'<?php echo $tipo ?>';

        $.ajax({
            type: "POST",
            url: "../admin/eliminar_ajax.php",
            data: dataString,
            success: function() {           
                $('#eliminar-ok').empty();
                $('#eliminar-ok').append('<div align="center" class="correcto">Se ha eliminado correctamente el codigo = '+cod_plan_accion_correctiva_preventiva_mejora+'.</div>').fadeIn("slow");
                $('#'+parent).fadeOut("slow");
                $('#cod_plan_accion_correctiva_preventiva_mejora'+cod_plan_accion_correctiva_preventiva_mejora).fadeOut("slow");
                $('#cod_producto_barra_'+cod_plan_accion_correctiva_preventiva_mejora).fadeOut("slow");
                $('#nombre_cliente_'+cod_plan_accion_correctiva_preventiva_mejora).fadeOut("slow");
                $('#nombre_producto_'+cod_plan_accion_correctiva_preventiva_mejora).fadeOut("slow");
                $('#und_venta_'+cod_plan_accion_correctiva_preventiva_mejora).fadeOut("slow");
                $('#precio_venta_producto_'+cod_plan_accion_correctiva_preventiva_mejora).fadeOut("slow");
                $('#mensaje_alerta_'+cod_plan_accion_correctiva_preventiva_mejora).fadeOut("slow");
                $('#total_venta_producto_'+cod_plan_accion_correctiva_preventiva_mejora).fadeOut("slow");
                $('#nombre_tipo_unidad_medida_'+cod_plan_accion_correctiva_preventiva_mejora).fadeOut("slow");
                $('#nombre_frec_duracion_'+cod_plan_accion_correctiva_preventiva_mejora).fadeOut("slow");
                $('#tr'+cod_plan_accion_correctiva_preventiva_mejora).fadeOut("slow");
            }
        });

    });

});
</script>
</body>
</html>