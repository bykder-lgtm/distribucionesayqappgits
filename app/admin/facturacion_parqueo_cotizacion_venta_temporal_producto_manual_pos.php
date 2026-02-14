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
$tab                               = 'tbl15_parqueo_cotizacion_venta_producto_temporal';
$campo                             = 'cod_parqueo_cotizacion_venta_producto_temporal';
$tipo                              = 'eliminar';
$cod_estado_vacuna                 = '0';

$nombre_tipo_moneda                = "COP";
$nombre_tipo_factura               = "POS";
$cod_estado_vacuna                 = "0";

if (isset($_GET['foco'])) { $foco = addslashes($_GET['foco']); } else { $foco = 'busqueda'; }

$datos_factura = "SELECT cod_parqueo_cotizacion_venta_producto_temporal FROM tbl15_parqueo_cotizacion_venta_producto_temporal WHERE (cuenta = '$cuenta_actual') AND (cod_caja_virtual = '$cod_caja_virtual')";
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
xmlhttp.open("POST","../admin/busqueda_inmediata_parqueo_cotizacion_venta_temporal_producto_php.php",true);
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
        <td bgcolor="#fff" align="center"><strong><a href="../admin/lista_info_factura_parqueo_cotizacion_venta.php">LISTA DE PARQUEO INGRESO</a></strong></td>
    </tr></tbody>
</table>
<br>
<table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; width:100%">
    <tbody>
    	<tr>
    		<td bgcolor="#fff" align="center"><strong>Parqueo Manual: [<?php echo $cod_caja_virtual ?>]<input type="text" id="busqueda" name="busqueda" onkeyup="hacer_busqueda()" style="height:40" placeholder="Buscar"/><input type="hidden" id="pagina" name="pagina" value="<?php echo $pagina_local ?>"/></strong><div id="logo_cargador"></div></td>
    	</tr>
    </tbody>
</table>
<!-- ***************************************************************************************************************************** -->
<?php include_once('../admin/info_factura_parqueo_cotizacion_venta_temporal_pos.php'); ?>
<!-- ***************************************************************************************************************************** -->
<?php if ($total_datos <> 0) { include_once("../admin/modal_registrar_tercero_parqueo_cotizacion_venta.php"); } ?>
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
<th style="text-align:center;">PLACA</th>
<th style="text-align:center;">COMENTARIO</th>
<!--
<th style="text-align:center;">CANTIDAD</th>
<th style="text-align:center;">MED</th>
-->
<th style="text-align:center;">FECHA INGRESO</th>
<th style="text-align:center;">HORA INGRESO</th>
<th style="text-align:center;">VALOR UNITARIO</th>
<td align="center"></td>
<th style="text-align:center;">VALOR TOTAL</th>
<th style="text-align:center;">OK</th>
<th style="text-align:center;"></th>
</tr>
</thead>
<tbody>
<?php
$sql_parqueo_cotizacion_venta_producto_temporal = "SELECT * FROM tbl15_parqueo_cotizacion_venta_producto_temporal WHERE (cuenta = '$cuenta_actual') AND (cod_caja_virtual = '$cod_caja_virtual') 
ORDER BY cod_parqueo_cotizacion_venta_producto_temporal DESC";
$consulta_parqueo_cotizacion_venta_producto_temporal = mysqli_query($conectar, $sql_parqueo_cotizacion_venta_producto_temporal);
while ($datos_parqueo_cotizacion_venta_producto_temporal = mysqli_fetch_assoc($consulta_parqueo_cotizacion_venta_producto_temporal)) {

$cod_parqueo_cotizacion_venta_producto_temporal       = $datos_parqueo_cotizacion_venta_producto_temporal['cod_parqueo_cotizacion_venta_producto_temporal'];
$cod_producto                      = $datos_parqueo_cotizacion_venta_producto_temporal['cod_producto'];
$cod_producto_barra                = $datos_parqueo_cotizacion_venta_producto_temporal['cod_producto_barra'];
$nombre_producto                   = $datos_parqueo_cotizacion_venta_producto_temporal['nombre_producto'];
$cedula                            = $datos_parqueo_cotizacion_venta_producto_temporal['cedula'];
$nombre_cliente                    = $datos_parqueo_cotizacion_venta_producto_temporal['nombre_cliente'];
$und_venta                         = $datos_parqueo_cotizacion_venta_producto_temporal['und_venta'];
$precio_costo_producto             = $datos_parqueo_cotizacion_venta_producto_temporal['precio_costo_producto'];
$total_costo_producto              = $datos_parqueo_cotizacion_venta_producto_temporal['total_costo_producto'];
$precio_venta_producto             = $datos_parqueo_cotizacion_venta_producto_temporal['precio_venta_producto'];
$total_venta_producto              = $datos_parqueo_cotizacion_venta_producto_temporal['total_venta_producto'];
$nombre_tipo_producto              = $datos_parqueo_cotizacion_venta_producto_temporal['nombre_tipo_producto'];
$nombre_tipo_unidad_medida         = $datos_parqueo_cotizacion_venta_producto_temporal['nombre_tipo_unidad_medida'];
$posologia_cantidad                = $datos_parqueo_cotizacion_venta_producto_temporal['posologia_cantidad'];
$posologia_peso                    = $datos_parqueo_cotizacion_venta_producto_temporal['posologia_peso'];
$nombre_tipo_presentacion          = $datos_parqueo_cotizacion_venta_producto_temporal['nombre_tipo_presentacion'];
$nombre_via_administracion         = $datos_parqueo_cotizacion_venta_producto_temporal['nombre_via_administracion'];
$nombre_frec_duracion              = $datos_parqueo_cotizacion_venta_producto_temporal['nombre_frec_duracion'];
$cod_tipo_cobrar                   = $datos_parqueo_cotizacion_venta_producto_temporal['cod_tipo_cobrar'];
$cod_info_parqueo_cotizacion_factura_venta            = $datos_parqueo_cotizacion_venta_producto_temporal['cod_info_parqueo_cotizacion_factura_venta'];
$nombre_tipo_precio_venta          = $datos_parqueo_cotizacion_venta_producto_temporal['nombre_tipo_precio_venta'];
$cod_estado_permitir_venta         = $datos_parqueo_cotizacion_venta_producto_temporal['cod_estado_permitir_venta'];

$placa_producto                    = $datos_parqueo_cotizacion_venta_producto_temporal['placa_producto'];
$comentario_producto               = $datos_parqueo_cotizacion_venta_producto_temporal['comentario_producto'];
$fecha_ymd_parqueo_ini             = $datos_parqueo_cotizacion_venta_producto_temporal['fecha_ymd_parqueo_ini'];
$fecha_hora_parqueo_ini            = $datos_parqueo_cotizacion_venta_producto_temporal['fecha_hora_parqueo_ini'];
$fecha_ymd_parqueo_fin             = $datos_parqueo_cotizacion_venta_producto_temporal['fecha_ymd_parqueo_fin'];
$fecha_hora_parqueo_fin            = $datos_parqueo_cotizacion_venta_producto_temporal['fecha_hora_parqueo_fin'];
        
if ($cod_estado_permitir_venta == 1) { $imagen = '<img src=../imagenes/incorrecto.png alt="Listo">'; } else { $imagen = '<img src=../imagenes/correctok.png alt="Listo">'; }

$incre++;
?>
<tr id="tr<?php echo $cod_parqueo_cotizacion_venta_producto_temporal;?>">
<th style="text-align:center;"></th>
<td style="text-align:center;"><a href="../admin/eliminar.php?llave=<?php echo $cod_parqueo_cotizacion_venta_producto_temporal?>&tab=<?php echo $tab ?>&tipo=<?php echo $tipo ?>&campo=<?php echo $campo ?>&pagina=<?php echo $pagina_local ?>"><img src="../imagenes/eliminar.png" class="img-polaroid" alt=""></a></td>
<!--<td style="text-align:center"><input name="cod_tipo_cobrar" class="cod_tipo_cobrar__<?php echo $cod_parqueo_cotizacion_venta_producto_temporal;?>" id="cod_tipo_cobrar_<?php echo $cod_parqueo_cotizacion_venta_producto_temporal;?>" type="checkbox" value="1" <?php if($cod_tipo_cobrar=='1'){ echo "checked"; } ?>></td>-->
<!--<td style="text-align:center;" id="cod_parqueo_cotizacion_venta_producto_temporal_<?php echo $cod_parqueo_cotizacion_venta_producto_temporal ?>" class="service_list" data="<?php echo $cod_parqueo_cotizacion_venta_producto_temporal ?>"><a class="eliminar" id="cod_parqueo_cotizacion_venta_producto_temporal<?php echo $cod_parqueo_cotizacion_venta_producto_temporal ?>"><img src="../imagenes/eliminar.png" class="img-polaroid" alt=""></a></td>-->
<td style="text-align:center;" id="cod_producto_barra_<?php echo $incre;?>"><?php echo $cod_producto_barra ?></td>
<td style="text-align:left;"  id="nombre_producto_<?php echo $incre;?>"><?php echo $nombre_producto ?></td>

<input name="und_venta" type="hidden" id="und_venta<?php echo $incre;?>" class="<?php echo $cod_parqueo_cotizacion_venta_producto_temporal;?>" onChange="calc_total_venta();" value="<?php echo $und_venta;?>" style="width: 70px;" />
<!--
<td style="text-align:center;" id="und_venta_<?php echo $incre;?>"><input name="und_venta" type="number" id="und_venta<?php echo $incre;?>" class="<?php echo $cod_parqueo_cotizacion_venta_producto_temporal;?>" onChange="calc_total_venta();" value="<?php echo $und_venta;?>" style="width: 70px;" /></td>
<td style="text-align:center;" id="nombre_tipo_unidad_medida_<?php echo $incre;?>"><?php echo $nombre_tipo_unidad_medida;?></td>
-->
<td style="text-align:center;" id="placa_producto_<?php echo $incre;?>"><input name="placa_producto" type="text" id="placa_producto<?php echo $incre;?>" class="<?php echo $cod_parqueo_cotizacion_venta_producto_temporal;?>" value="<?php echo $placa_producto;?>" style="width: 100px;" /></td>
<td style="text-align:center;" id="comentario_producto_<?php echo $incre;?>"><input name="comentario_producto" type="text" id="comentario_producto<?php echo $incre;?>" class="<?php echo $cod_parqueo_cotizacion_venta_producto_temporal;?>" value="<?php echo $comentario_producto;?>" style="width: 200px;" /></td>
<td style="text-align:center;" id="fecha_ymd_parqueo_ini_<?php echo $incre;?>"><input name="fecha_ymd_parqueo_ini" type="date" id="fecha_ymd_parqueo_ini<?php echo $incre;?>" class="<?php echo $cod_parqueo_cotizacion_venta_producto_temporal;?>" onChange="calc_total_venta();" value="<?php echo $fecha_ymd_parqueo_ini;?>" style="width: 120px;" /></td>
<td style="text-align:center;" id="fecha_hora_parqueo_ini_<?php echo $incre;?>"><input name="fecha_hora_parqueo_ini" type="time" id="fecha_hora_parqueo_ini<?php echo $incre;?>" class="<?php echo $cod_parqueo_cotizacion_venta_producto_temporal;?>" onChange="calc_total_venta();" value="<?php echo $fecha_hora_parqueo_ini;?>" style="width: 90px;" /></td>

<td style="text-align:center;" id="precio_venta_producto_<?php echo $incre;?>"><input name="precio_venta_producto" type="number" id="precio_venta_producto<?php echo $incre;?>" class="<?php echo $cod_parqueo_cotizacion_venta_producto_temporal;?>" onChange="calc_total_venta();" value="<?php echo $precio_venta_producto;?>" style="width: 100px;" /></td>
<td style="text-align:center;" id="mensaje_alerta<?php echo $incre;?>"></td>
<td style="text-align:center;" id="total_venta_producto<?php echo $incre;?>"><?php echo number_format($total_venta_producto, 0, ",", ".");?></td>
<td style="text-align:center;" id="btn_listo<?php echo $incre;?>"><a href="<?php $_SERVER['PHP_SELF']?>"><?php echo $imagen;?></a></td>
<th style="text-align:center;"></th>
</tr id="tr<?php echo $cod_parqueo_cotizacion_venta_producto_temporal;?>">
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
var costo_parqueo = <?php echo $costo_parqueo;?>;

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
        var cod_parqueo_cotizacion_venta_producto_temporal = $(this).parent().attr('data');
        var dataString = 'llave='+cod_parqueo_cotizacion_venta_producto_temporal+'&'+'tab='+'<?php echo $tab ?>'+'&'+'campo='+'<?php echo $campo ?>'+'&'+'tipo='+'<?php echo $tipo ?>';

        $.ajax({
            type: "POST",
            url: "../admin/eliminar_ajax.php",
            data: dataString,
            success: function() {           
                $('#eliminar-ok').empty();
                $('#eliminar-ok').append('<div align="center" class="correcto">Se ha eliminado correctamente el codigo = '+cod_parqueo_cotizacion_venta_producto_temporal+'.</div>').fadeIn("slow");
                $('#'+parent).fadeOut("slow");
                $('#cod_parqueo_cotizacion_venta_producto_temporal'+cod_parqueo_cotizacion_venta_producto_temporal).fadeOut("slow");
                $('#cod_producto_barra_'+cod_parqueo_cotizacion_venta_producto_temporal).fadeOut("slow");
                $('#nombre_cliente_'+cod_parqueo_cotizacion_venta_producto_temporal).fadeOut("slow");
                $('#nombre_producto_'+cod_parqueo_cotizacion_venta_producto_temporal).fadeOut("slow");
                $('#und_venta_'+cod_parqueo_cotizacion_venta_producto_temporal).fadeOut("slow");
                $('#precio_venta_producto_'+cod_parqueo_cotizacion_venta_producto_temporal).fadeOut("slow");
                $('#mensaje_alerta_'+cod_parqueo_cotizacion_venta_producto_temporal).fadeOut("slow");
                $('#total_venta_producto_'+cod_parqueo_cotizacion_venta_producto_temporal).fadeOut("slow");
                $('#nombre_tipo_unidad_medida_'+cod_parqueo_cotizacion_venta_producto_temporal).fadeOut("slow");
                $('#nombre_frec_duracion_'+cod_parqueo_cotizacion_venta_producto_temporal).fadeOut("slow");
                $('#tr'+cod_parqueo_cotizacion_venta_producto_temporal).fadeOut("slow");
            }
        });

    });

});
</script>
</body>
</html>