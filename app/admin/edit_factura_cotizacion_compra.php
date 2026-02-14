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
$tab                               = 'tbl15_cotizacion_compra_producto';
$campo                             = 'cod_cotizacion_compra_producto';
$tipo                              = 'eliminar';
$cod_estado_vacuna                 = '0';

$tab2                              = 'tbl15_info_cotizacion_factura_compra';
$campo2                            = 'cod_info_cotizacion_factura_compra';
$tipo2                             = 'eliminar';

$nombre_tipo_moneda                = "COP";
$nombre_tipo_factura               = "POS";
$cod_estado_vacuna                 = "0";
$nombre_tipo_cargue_factura        = "FACTURA_COMPRA_NORMAL";

if (isset($_GET['foco'])) { $foco = addslashes($_GET['foco']); } else { $foco = 'busqueda'; }

if (isset($_GET['cod_info_cotizacion_factura_compra'])) { $cod_info_cotizacion_factura_compra = intval($_GET['cod_info_cotizacion_factura_compra']); } else { $cod_info_cotizacion_factura_compra = 0; }

$datos_factura = "SELECT cod_cotizacion_compra_producto FROM tbl15_cotizacion_compra_producto WHERE (cod_info_cotizacion_factura_compra = '$cod_info_cotizacion_factura_compra')";
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
var nombre_tipo_cargue_factura = "FACTURA_COMPRA_NORMAL";
var cod_info_cotizacion_factura_compra = <?php echo $cod_info_cotizacion_factura_compra ?>;

if(valor_buscar=='') { document.getElementById("logo_cargador").innerHTML=""; return; }

if (window.XMLHttpRequest) { xmlhttp=new XMLHttpRequest(); } else { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); }
xmlhttp.onreadystatechange=function() {
  if (xmlhttp.readyState==4 && xmlhttp.status==200) { document.getElementById("logo_cargador").innerHTML=xmlhttp.responseText; } else { document.getElementById("logo_cargador").innerHTML='<center><img src="../imagenes/loader.gif"/></center>'; }
}
xmlhttp.open("POST","../admin/busqueda_inmediata_cotizacion_compra_producto_php.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("buscar="+valor_buscar+"&cod_info_cotizacion_factura_compra="+cod_info_cotizacion_factura_compra+"&nombre_tipo_cargue_factura="+nombre_tipo_cargue_factura+"&nombre_tipo_moneda="+nombre_tipo_moneda+"&nombre_tipo_factura="+nombre_tipo_factura+"&cod_estado_vacuna="+cod_estado_vacuna+"&pagina="+pagina);
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
        <td bgcolor="#fff" align="center"><strong><a href="../admin/lista_info_factura_cotizacion_compra.php">LISTA DE COTIZACIONES COMPRA</a></strong></td>
    </tr></tbody>
</table>
<table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; width:100%">
    <tbody><tr>
        <td bgcolor="#fff" align="center"><strong>EDICION COTIZACION DE COMPRA</strong></td>
    </tr></tbody>
</table>
<br>
<table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; width:100%">
    <tbody>
    	<tr>
    		<td bgcolor="#fff" align="center"><strong>Cotizacion Compra Manual: [<?php echo $cod_caja_virtual ?>]<input type="text" id="busqueda" name="busqueda" onkeyup="hacer_busqueda()" style="height:40" placeholder="Buscar"/><input type="hidden" id="pagina" name="pagina" value="<?php echo $pagina_local ?>"/></strong><div id="logo_cargador"></div></td>
    	</tr>
    </tbody>
</table>
<!-- ***************************************************************************************************************************** -->
<?php include_once('../admin/info_factura_cotizacion_compra_pos.php'); ?>
<!-- ***************************************************************************************************************************** -->
<?php if ($total_datos <> 0) { include_once("../admin/modal_registrar_tercero_cotizacion_compra.php"); } ?>
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
<th style="text-align:center;">U.PQ</th>
<th style="text-align:center;">X</th>
<th style="text-align:center;">UND</th>
<th style="text-align:center;">T.UND</th>
<th style="text-align:center;">P.COMPRA+IVA</th>
<th style="text-align:center;">%DTO1</th>
<th style="text-align:center;">%DTO2</th>
<th style="text-align:center;">%IVA</th>
<th style="text-align:center;">IMPOCONSUMO</th>
<?php for ($i=1; $i <= $numero_precio; $i++) { $contador = 1; if ($i==1) { $contador = ""; } else { $contador = $i; } ?>
<th style="text-align:center">P.VENTA<?php echo $contador; ?></th>
<?php } ?>
<th style="text-align:center;">VALOR COMPRA</th>
<th style="text-align:center;">OK</th>
<th style="text-align:center;"></th>
</tr>
</thead>
<tbody>
<?php
$sql_cotizacion_compra_producto = "SELECT * FROM tbl15_cotizacion_compra_producto WHERE (cod_info_cotizacion_factura_compra = '$cod_info_cotizacion_factura_compra') ORDER BY cod_cotizacion_compra_producto DESC";
$consulta_cotizacion_compra_producto = mysqli_query($conectar, $sql_cotizacion_compra_producto);
while ($datos_cotizacion_compra_producto = mysqli_fetch_assoc($consulta_cotizacion_compra_producto)) {

$cod_cotizacion_compra_producto                = $datos_cotizacion_compra_producto['cod_cotizacion_compra_producto'];
$cod_producto                                  = $datos_cotizacion_compra_producto['cod_producto'];
$cod_producto_barra                            = $datos_cotizacion_compra_producto['cod_producto_barra'];
$nombre_producto                               = $datos_cotizacion_compra_producto['nombre_producto'];
$cedula                                        = $datos_cotizacion_compra_producto['cedula'];
$nombre_cliente                                = $datos_cotizacion_compra_producto['nombre_cliente'];
$und_compra                                    = $datos_cotizacion_compra_producto['und_compra'];
$und_unidades                                  = $datos_cotizacion_compra_producto['und_unidades'];
$und_caja                                      = $datos_cotizacion_compra_producto['und_caja'];
$precio_costo_producto                         = $datos_cotizacion_compra_producto['precio_costo_producto'];
$precio_compra_producto                        = $datos_cotizacion_compra_producto['precio_compra_producto'];
$precio_compra_producto                        = $datos_cotizacion_compra_producto['precio_compra_producto'];
$total_costo_producto                          = $datos_cotizacion_compra_producto['total_costo_producto'];
$total_compra_producto                         = $datos_cotizacion_compra_producto['total_compra_producto'];
$precio_venta_producto                         = $datos_cotizacion_compra_producto['precio_venta_producto'];
$precio_venta_producto2                        = $datos_cotizacion_compra_producto['precio_venta_producto2'];
$precio_venta_producto3                        = $datos_cotizacion_compra_producto['precio_venta_producto3'];
$precio_venta_producto4                        = $datos_cotizacion_compra_producto['precio_venta_producto4'];
$precio_venta_producto5                        = $datos_cotizacion_compra_producto['precio_venta_producto5'];
$iva_ptj                                       = $datos_cotizacion_compra_producto['iva_ptj'];
$dto1                                          = $datos_cotizacion_compra_producto['dto1'];
$dto2                                          = $datos_cotizacion_compra_producto['dto2'];
$precio_ipc                                    = $datos_cotizacion_compra_producto['precio_ipc'];
$precio_venta_producto                         = $datos_cotizacion_compra_producto['precio_venta_producto'];
$total_venta_producto                          = $datos_cotizacion_compra_producto['total_venta_producto'];
$nombre_tipo_producto                          = $datos_cotizacion_compra_producto['nombre_tipo_producto'];
$nombre_tipo_unidad_medida                     = $datos_cotizacion_compra_producto['nombre_tipo_unidad_medida'];
$posologia_cantidad                            = $datos_cotizacion_compra_producto['posologia_cantidad'];
$posologia_peso                                = $datos_cotizacion_compra_producto['posologia_peso'];
$nombre_tipo_presentacion                      = $datos_cotizacion_compra_producto['nombre_tipo_presentacion'];
$nombre_via_administracion                     = $datos_cotizacion_compra_producto['nombre_via_administracion'];
$nombre_frec_duracion                          = $datos_cotizacion_compra_producto['nombre_frec_duracion'];
$cod_tipo_cobrar                               = $datos_cotizacion_compra_producto['cod_tipo_cobrar'];
$cod_info_cotizacion_factura_compra            = $datos_cotizacion_compra_producto['cod_info_cotizacion_factura_compra'];
$nombre_tipo_precio_venta                      = $datos_cotizacion_compra_producto['nombre_tipo_precio_venta'];
$cod_estado_permitir_venta                     = $datos_cotizacion_compra_producto['cod_estado_permitir_venta'];

if ($cod_estado_permitir_venta == 1) { $imagen = '<img src=../imagenes/incorrecto.png alt="Listo">'; } else { $imagen = '<img src=../imagenes/correctok.png alt="Listo">'; }

$incre++;
?>
<tr style="text-align:center;" id="tr<?php echo $cod_cotizacion_compra_producto;?>">
<th style="text-align:center;"></th>
<td  style="text-align:center;"><a href="../admin/eliminar.php?llave=<?php echo $cod_cotizacion_compra_producto?>&tab=<?php echo $tab ?>&tipo=<?php echo $tipo ?>&campo=<?php echo $campo ?>&pagina=<?php echo $pagina_local ?>"><img src="../imagenes/eliminar.png" class="img-polaroid" alt=""></a></td>
<td style="text-align:center;" ><?php echo $cod_producto_barra ?></td>
<td style="text-align:left;"><?php echo $nombre_producto ?></td>
<td style="text-align:center;"><input name="und_unidades" type="number" id="und_unidades<?php echo $incre;?>" class="<?php echo $cod_cotizacion_compra_producto;?>" onChange="calc_total_compra();" value="<?php echo $und_unidades;?>" style="width: 40px;" /></td>
<th style="text-align:center;">X</th>
<td style="text-align:center;"><input name="und_caja" type="number" id="und_caja<?php echo $incre;?>" class="<?php echo $cod_cotizacion_compra_producto;?>" onChange="calc_total_compra();" value="<?php echo $und_caja;?>" style="width: 40px;" /></td>
<td style="text-align:center;"><input name="und_compra" type="number" id="und_compra<?php echo $incre;?>" class="<?php echo $cod_cotizacion_compra_producto;?>" onChange="calc_total_compra();" value="<?php echo $und_compra;?>" style="width: 60px;" /></td>
<td style="text-align:center;"><input name="precio_compra_producto" type="text" id="precio_compra_producto<?php echo $incre;?>" class="<?php echo $cod_cotizacion_compra_producto;?>" onChange="calc_total_compra();" value="<?php echo $precio_compra_producto;?>" style="width: 100px;" /></td>
<td style="text-align:center;"><input name="dto1" type="number" id="dto1<?php echo $incre;?>" class="<?php echo $cod_cotizacion_compra_producto;?>" value="<?php echo $dto1;?>" style="width: 40px;" /></td>
<td style="text-align:center;"><input name="dto2" type="number" id="dto2<?php echo $incre;?>" class="<?php echo $cod_cotizacion_compra_producto;?>" value="<?php echo $dto2;?>" style="width: 40px;" /></td>
<td style="text-align:center;"><input name="iva_ptj" type="number" id="iva_ptj<?php echo $incre;?>" class="<?php echo $cod_cotizacion_compra_producto;?>" value="<?php echo $iva_ptj;?>" style="width: 40px;" /></td>
<td style="text-align:center;"><input name="precio_ipc" type="number" id="precio_ipc<?php echo $incre;?>" class="<?php echo $cod_cotizacion_compra_producto;?>" value="<?php echo $precio_ipc;?>" style="width: 100px;" /></td>

<?php for ($i=1; $i <= $numero_precio; $i++) { $contador = 1; $precio_ventas = 0; 
if ($i==1) { $contador = ""; $precio_ventas = $precio_venta_producto; } elseif ($i==2) { $contador = $i; $precio_ventas = $precio_venta_producto2; } elseif ($i==3) { $contador = $i; $precio_ventas = $precio_venta_producto3;
} elseif ($i==4) { $contador = $i; $precio_ventas = $precio_venta_producto4; } elseif ($i==5) { $contador = $i; $precio_ventas = $precio_venta_producto5; } else { $contador = ""; $precio_ventas = $precio_venta_producto; } ?>
<td style="text-align:center;"><input name="precio_venta_producto<?php echo $contador; ?>" type="number" id="precio_venta_producto<?php echo $incre;?>" class="<?php echo $cod_cotizacion_compra_producto;?>" value="<?php echo $precio_ventas;?>" style="width: 100px;" /></td>
<?php } ?>

<td style="text-align:right;" id="total_compra_producto<?php echo $incre;?>"><?php echo number_format($total_compra_producto, 0, ",", ".");?></td>
<td style="text-align:center;" id="btn_listo<?php echo $incre;?>"><a href="<?php $_SERVER['PHP_SELF']?>"><?php echo $imagen;?></a></td>
<th style="text-align:center;"></th>
</tr style="text-align:right;" id="tr<?php echo $cod_cotizacion_compra_producto;?>">
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
function calc_total_compra(){

var i=0;
var incre = <?php echo $total_datos;?>;
var und_compra_text = "";
var precio_compra_producto_text = "";
var total_compra_producto_text = "";
var total_compra = 0;
var und_compra = 0;
var precio_compra_producto = 0;
var total_compra_producto = 0;
var smtr_total_compra = 0;
var Max_Length = 4;
var length = 0;

for (i=1; i<=incre; i++){

und_compra_text = "und_compra"+i;
precio_compra_producto_text = "precio_compra_producto"+i;
total_compra_producto_text = "total_compra_producto"+i;
//mensaje_alerta_text = "mensaje_alerta"+i;

//mensaje_alerta = document.getElementById(mensaje_alerta_text).value;
und_compra = document.getElementById(und_compra_text).value;
precio_compra_producto = document.getElementById(precio_compra_producto_text).value;
total_compra_producto = (und_compra * precio_compra_producto);
smtr_total_compra = smtr_total_compra + total_compra_producto;

console.log(total_compra_producto);

<!-- ////////////////////////////////////////////////////////////////////////////////////////////////// -->
length = document.getElementById(und_compra_text).value.length;
if (length > Max_Length) {
//var objeto_mostrar_mensaje = document.getElementById("mensaje_alerta_"+i);
//objeto_mostrar_mensaje.parentNode.innerHTML = objeto_mostrar_mensaje.parentNode.innerHTML + "<p style='color:yellow'>Verificar</p>";
//  address1.parentNode.innerHTML = address1.parentNode.innerHTML + "<p style='color:red'>the max length of "+Max_Length + " characters is reached, you typed in  " + length + "characters</p>";
console.log(length);
} else {  }
<!-- ////////////////////////////////////////////////////////////////////////////////////////////////// -->

document.getElementById(total_compra_producto_text).innerHTML=total_compra_producto.toLocaleString("es-ES");
}
total_compra = smtr_total_compra;
//document.getElementById("total_compra") = total_compra;
}
</script>

</body>
</html>