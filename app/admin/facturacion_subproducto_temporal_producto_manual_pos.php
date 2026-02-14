<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css_02.php'); ?>
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
$tab                               = 'tbl15_subproducto_temporal';
$campo                             = 'cod_subproducto_temporal';
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

$datos_factura = "SELECT cod_subproducto_temporal FROM tbl15_subproducto_temporal WHERE (cuenta = '$cuenta_actual') AND (cod_caja_virtual = '$cod_caja_virtual')";
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
xmlhttp.open("POST","../admin/busqueda_inmediata_subproducto_temporal_producto_php.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("buscar="+valor_buscar+"&buscar_por="+buscar_por+"&nombre_tipo_moneda="+nombre_tipo_moneda+"&nombre_tipo_factura="+nombre_tipo_factura+"&tipo_busqueda="+tipo_busqueda+"&cod_estado_vacuna="+cod_estado_vacuna+"&pagina="+pagina);
}
</script>

<table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; width:100%">
    <tbody><tr>
        <td bgcolor="#fff" align="center"><strong><a href="../admin/lista_subproducto.php">LISTA DE SUBPRODUCTOS</a></strong></td>
    </tr></tbody>
</table>

<div class="table-responsive">

<br>
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
            <strong>SubProducto Manual: [<?php echo $cod_caja_virtual ?>]<input type="text" id="busqueda" name="busqueda" onkeyup="hacer_busqueda()" style="height:40" placeholder="Buscar"/><input type="hidden" id="pagina" name="pagina" value="<?php echo $pagina_local ?>"/></strong><div id="logo_cargador"></div>
            </td>
    	</tr>
    </tbody>
</table>
<!-- ***************************************************************************************************************************** -->
<?php include_once('../admin/info_factura_subproducto_temporal_pos.php'); ?>
<!-- ***************************************************************************************************************************** -->
<?php if ($total_datos <> 0) { include_once("../admin/modal_registrar_tercero.php"); } ?>
<!-- ***************************************************************************************************************************** -->
<?php if ($total_datos <> 0) { ?>

<table class="table table-striped" border="1" cellspacing="0" cellpadding="20">
<thead>
<tr>
<td style="text-align:center;"></td>
<th style="text-align:center;">ELM</th>
<!--<th style="text-align:center;">COBRAR</th>-->
<th style="text-align:center;">CODIGO SUBPRODUCTO</th>
<th style="text-align:center;">NOMBRE SUBPRODUCTO</th>
<th style="text-align:center;">CANTIDAD</th>
<th style="text-align:center;">MED</th>
<td style="text-align:center;"></td>
</tr>
</thead>
<tbody>
<?php
$sql_subproducto_temporal = "SELECT * FROM tbl15_subproducto_temporal WHERE (cuenta = '$cuenta_actual') AND (cod_caja_virtual = '$cod_caja_virtual') 
ORDER BY cod_subproducto_temporal DESC";
$consulta_subproducto_temporal = mysqli_query($conectar, $sql_subproducto_temporal);
while ($datos_subproducto_temporal = mysqli_fetch_assoc($consulta_subproducto_temporal)) {

$cod_subproducto_temporal          = $datos_subproducto_temporal['cod_subproducto_temporal'];
$cod_producto                      = $datos_subproducto_temporal['cod_producto'];
$cod_producto_barra                = $datos_subproducto_temporal['cod_producto_barra'];
$nombre_producto                   = $datos_subproducto_temporal['nombre_producto'];
$cedula                            = $datos_subproducto_temporal['cedula'];
$nombre_cliente                    = $datos_subproducto_temporal['nombre_cliente'];
$und_venta                         = $datos_subproducto_temporal['und_venta'];
$precio_costo_producto             = $datos_subproducto_temporal['precio_costo_producto'];
$total_costo_producto              = $datos_subproducto_temporal['total_costo_producto'];
$precio_venta_producto             = $datos_subproducto_temporal['precio_venta_producto'];
$total_venta_producto              = $datos_subproducto_temporal['total_venta_producto'];
$nombre_tipo_producto              = $datos_subproducto_temporal['nombre_tipo_producto'];
$nombre_tipo_unidad_medida         = $datos_subproducto_temporal['nombre_tipo_unidad_medida'];
$posologia_cantidad                = $datos_subproducto_temporal['posologia_cantidad'];
$posologia_peso                    = $datos_subproducto_temporal['posologia_peso'];
$nombre_tipo_presentacion          = $datos_subproducto_temporal['nombre_tipo_presentacion'];
$nombre_via_administracion         = $datos_subproducto_temporal['nombre_via_administracion'];
$nombre_frec_duracion              = $datos_subproducto_temporal['nombre_frec_duracion'];
$cod_tipo_cobrar                   = $datos_subproducto_temporal['cod_tipo_cobrar'];
$cod_info_factura_subproducto      = $datos_subproducto_temporal['cod_info_factura_subproducto'];
$nombre_tipo_precio_venta          = $datos_subproducto_temporal['nombre_tipo_precio_venta'];
$cod_estado_permitir_venta         = $datos_subproducto_temporal['cod_estado_permitir_venta'];
$comentario_producto               = $datos_subproducto_temporal['comentario_producto'];

if ($cod_estado_permitir_venta == 1) { $imagen = '<img src=../imagenes/incorrecto.png alt="Listo">'; } else { $imagen = '<img src=../imagenes/correctok.png alt="Listo">'; }

$incre++;
?>
<tr style="text-align:center;" id="tr<?php echo $cod_subproducto_temporal;?>">
<td style="text-align:center;"></td>
<td  style="text-align:center;"><a href="../admin/eliminar.php?llave=<?php echo $cod_subproducto_temporal?>&tab=<?php echo $tab ?>&tipo=<?php echo $tipo ?>&campo=<?php echo $campo ?>&pagina=<?php echo $pagina_local ?>"><img src="../imagenes/eliminar.png" class="img-polaroid" alt=""></a></td>
<!--<td style="text-align:center"><input name="cod_tipo_cobrar" class="cod_tipo_cobrar__<?php echo $cod_subproducto_temporal;?>" id="cod_tipo_cobrar_<?php echo $cod_subproducto_temporal;?>" type="checkbox" value="1" <?php if($cod_tipo_cobrar=='1'){ echo "checked"; } ?>></td>-->
<!--<td style="text-align:center;" id="cod_subproducto_temporal_<?php echo $cod_subproducto_temporal ?>" class="service_list" data="<?php echo $cod_subproducto_temporal ?>"><a class="eliminar" id="cod_subproducto_temporal<?php echo $cod_subproducto_temporal ?>"><img src="../imagenes/eliminar.png" class="img-polaroid" alt=""></a></td>-->
<td style="text-align:center;" id="cod_producto_barra_<?php echo $incre;?>"><?php echo $cod_producto_barra ?></td>
<td style="text-align:left;"  id="nombre_producto_<?php echo $incre;?>"><?php echo $nombre_producto ?></td>
<td style="text-align:center;" id="und_venta_<?php echo $incre;?>"><input name="und_venta" type="number" id="und_venta<?php echo $incre;?>" class="<?php echo $cod_subproducto_temporal;?>" onChange="calc_total_venta();" value="<?php echo $und_venta;?>" style="width: 70px;" /></td>
<td style="text-align:center;" id="nombre_tipo_unidad_medida_<?php echo $incre;?>"><?php echo $nombre_tipo_unidad_medida;?></td>

<td style="text-align:right;" id="mensaje_alerta<?php echo $incre;?>"></td>
</tr style="text-align:right;" id="tr<?php echo $cod_subproducto_temporal;?>">
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
        var cod_subproducto_temporal = $(this).parent().attr('data');
        var dataString = 'llave='+cod_subproducto_temporal+'&'+'tab='+'<?php echo $tab ?>'+'&'+'campo='+'<?php echo $campo ?>'+'&'+'tipo='+'<?php echo $tipo ?>';

        $.ajax({
            type: "POST",
            url: "../admin/eliminar_ajax.php",
            data: dataString,
            success: function() {           
                $('#eliminar-ok').empty();
                $('#eliminar-ok').append('<div align="center" class="correcto">Se ha eliminado correctamente el codigo = '+cod_subproducto_temporal+'.</div>').fadeIn("slow");
                $('#'+parent).fadeOut("slow");
                $('#cod_subproducto_temporal'+cod_subproducto_temporal).fadeOut("slow");
                $('#cod_producto_barra_'+cod_subproducto_temporal).fadeOut("slow");
                $('#nombre_cliente_'+cod_subproducto_temporal).fadeOut("slow");
                $('#nombre_producto_'+cod_subproducto_temporal).fadeOut("slow");
                $('#und_venta_'+cod_subproducto_temporal).fadeOut("slow");
                $('#precio_venta_producto_'+cod_subproducto_temporal).fadeOut("slow");
                $('#mensaje_alerta_'+cod_subproducto_temporal).fadeOut("slow");
                $('#total_venta_producto_'+cod_subproducto_temporal).fadeOut("slow");
                $('#nombre_tipo_unidad_medida_'+cod_subproducto_temporal).fadeOut("slow");
                $('#nombre_frec_duracion_'+cod_subproducto_temporal).fadeOut("slow");
                $('#tr'+cod_subproducto_temporal).fadeOut("slow");
            }
        });

    });

});
</script>
</body>
</html>