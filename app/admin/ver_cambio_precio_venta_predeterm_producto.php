<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<!--
<link rel="stylesheet" type="text/css" href="../estilo_css/estilo_modal.css">
<script type="text/javascript" src="js/jquery.number.js"></script>
-->
<script src="js/jquery.js" type="text/javascript"></script> 
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
$cod_info_cambio_precio_venta_predeterm_producto = intval($_GET['cod_info_cambio_precio_venta_predeterm_producto']);
$pagina                                          = $_SERVER['PHP_SELF'];
$pagina_local                                    = $_SERVER['PHP_SELF'];
$incre                                           = 0;
$tab                                             = 'tbl15_cambio_precio_venta_predeterm_producto_temporal';
$campo                                           = 'cod_cambio_precio_venta_predeterm_producto_temporal';
$tipo                                            = 'eliminar';
$cod_estado_vacuna                               = '0';

$nombre_tipo_moneda                              = "COP";
$nombre_tipo_factura                             = "POS";
$cod_estado_vacuna                               = "0";
$nombre_tipo_cargue_factura                      = "FACTURA_COMPRA_NORMAL";

$datos_factura = "SELECT cod_cambio_precio_venta_predeterm_producto_temporal FROM tbl15_cambio_precio_venta_predeterm_producto_temporal WHERE (cod_info_cambio_precio_venta_predeterm_producto = '$cod_info_cambio_precio_venta_predeterm_producto')";
$consulta = mysqli_query($conectar, $datos_factura);
$total_datos = mysqli_num_rows($consulta);
?>
<input type="hidden" id="pagina" value="<?php echo $pagina_local ?>">

<div class="table-responsive">
<!--
<table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; width:100%">
    <tbody><tr>
        <td bgcolor="#fff" align="center"><strong><a href="../admin/lista_info_factura_cotizacion_compra.php">LISTA DE COTIZACIONES COMPRA</a></strong></td>
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
-->
<!-- ***************************************************************************************************************************** -->
<?php include_once('../admin/info_ver_factura_transferencia_bodega.php'); ?>
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php if ($total_datos <> 0) { ?>
<table class="table table-striped" border="1" cellspacing="0" cellpadding="20">
<thead>
<tr>
<th style="text-align:center;"></th>
<th style="text-align:center;">CODIGO</th>
<th style="text-align:center;">NOMBRE CONCEPTO</th>
<th style="text-align:center;">T.UND</th>
<th style="text-align:center;">.</th>
<th style="text-align:center;">P.COMPRA+IVA</th>
<?php if ($cod_estado_dto1_global == '1') { ?>
<th style="text-align:center;">%DTO1</th>
<?php } ?>
<?php if ($cod_estado_dto2_global == '1') { ?>
<th style="text-align:center;">%DTO2</th>
<?php } ?>
<th style="text-align:center;">%IVA</th>
<?php if ($cod_estado_impoconsumo_global == '1') { ?>
<th style="text-align:center;">IMPOCONSUMO</th>
<?php } ?>

<?php for ($i=1; $i <= $numero_precio; $i++) { $contador = 1; if ($i==1) { $contador = ""; } else { $contador = $i; } ?>
<th style="text-align:center">P.VENTA<?php echo $contador; ?></th>
<?php } ?>
<th style="text-align:center;">TOTAL COMPRA</th>
<th style="text-align:center;"></th>
</tr>
</thead>
<tbody>
<?php
$sql_cambio_precio_venta_predeterm_producto_temporal = "SELECT * FROM tbl15_cambio_precio_venta_predeterm_producto_temporal WHERE (cod_info_cambio_precio_venta_predeterm_producto = '$cod_info_cambio_precio_venta_predeterm_producto') 
ORDER BY cod_cambio_precio_venta_predeterm_producto_temporal DESC";
$consulta_cambio_precio_venta_predeterm_producto_temporal = mysqli_query($conectar, $sql_cambio_precio_venta_predeterm_producto_temporal);
while ($datos_cambio_precio_venta_predeterm_producto_temporal = mysqli_fetch_assoc($consulta_cambio_precio_venta_predeterm_producto_temporal)) {

$cod_cambio_precio_venta_predeterm_producto_temporal      = $datos_cambio_precio_venta_predeterm_producto_temporal['cod_cambio_precio_venta_predeterm_producto_temporal'];
$cod_producto                                             = $datos_cambio_precio_venta_predeterm_producto_temporal['cod_producto'];
$cod_producto_barra                                       = $datos_cambio_precio_venta_predeterm_producto_temporal['cod_producto_barra'];
$nombre_producto                                          = $datos_cambio_precio_venta_predeterm_producto_temporal['nombre_producto'];
$cedula                                                   = $datos_cambio_precio_venta_predeterm_producto_temporal['cedula'];
$nombre_cliente                                           = $datos_cambio_precio_venta_predeterm_producto_temporal['nombre_cliente'];
$und_compra                                               = $datos_cambio_precio_venta_predeterm_producto_temporal['und_compra'];
$und_unidades                                             = $datos_cambio_precio_venta_predeterm_producto_temporal['und_unidades'];
$und_caja                                                 = $datos_cambio_precio_venta_predeterm_producto_temporal['und_caja'];
$precio_costo_producto                                    = $datos_cambio_precio_venta_predeterm_producto_temporal['precio_costo_producto'];
$precio_compra_producto                                   = $datos_cambio_precio_venta_predeterm_producto_temporal['precio_compra_producto'];
$total_costo_producto                                     = $datos_cambio_precio_venta_predeterm_producto_temporal['total_costo_producto'];
$total_compra_producto                                    = $datos_cambio_precio_venta_predeterm_producto_temporal['total_compra_producto'];
$precio_venta_producto                                    = $datos_cambio_precio_venta_predeterm_producto_temporal['precio_venta_producto'];
$precio_venta_producto2                                   = $datos_cambio_precio_venta_predeterm_producto_temporal['precio_venta_producto2'];
$precio_venta_producto3                                   = $datos_cambio_precio_venta_predeterm_producto_temporal['precio_venta_producto3'];
$precio_venta_producto4                                   = $datos_cambio_precio_venta_predeterm_producto_temporal['precio_venta_producto4'];
$precio_venta_producto5                                   = $datos_cambio_precio_venta_predeterm_producto_temporal['precio_venta_producto5'];
$iva_ptj                                                  = $datos_cambio_precio_venta_predeterm_producto_temporal['iva_ptj'];
$dto1                                                     = $datos_cambio_precio_venta_predeterm_producto_temporal['dto1'];
$dto2                                                     = $datos_cambio_precio_venta_predeterm_producto_temporal['dto2'];
$precio_ipc                                               = $datos_cambio_precio_venta_predeterm_producto_temporal['precio_ipc'];
$total_venta_producto                                     = $datos_cambio_precio_venta_predeterm_producto_temporal['total_venta_producto'];
$nombre_tipo_producto                                     = $datos_cambio_precio_venta_predeterm_producto_temporal['nombre_tipo_producto'];
$nombre_tipo_unidad_medida                                = $datos_cambio_precio_venta_predeterm_producto_temporal['nombre_tipo_unidad_medida'];
$posologia_cantidad                                       = $datos_cambio_precio_venta_predeterm_producto_temporal['posologia_cantidad'];
$posologia_peso                                           = $datos_cambio_precio_venta_predeterm_producto_temporal['posologia_peso'];
$nombre_tipo_presentacion                                 = $datos_cambio_precio_venta_predeterm_producto_temporal['nombre_tipo_presentacion'];
$nombre_via_administracion                                = $datos_cambio_precio_venta_predeterm_producto_temporal['nombre_via_administracion'];
$nombre_frec_duracion                                     = $datos_cambio_precio_venta_predeterm_producto_temporal['nombre_frec_duracion'];
$cod_tipo_cobrar                                          = $datos_cambio_precio_venta_predeterm_producto_temporal['cod_tipo_cobrar'];
$nombre_tipo_precio_venta                                 = $datos_cambio_precio_venta_predeterm_producto_temporal['nombre_tipo_precio_venta'];
$cod_estado_permitir_venta                                = $datos_cambio_precio_venta_predeterm_producto_temporal['cod_estado_permitir_venta'];
$und_venta                                                = $datos_cambio_precio_venta_predeterm_producto_temporal['und_venta'];

if ($cod_tipo_sistema_numeracion_und_compra == '2') { $und_venta = intval($und_venta); } else { $und_venta = $und_venta; }
if ($cod_tipo_sistema_numeracion_und_compra == '2') { $und_compra = intval($und_compra); } else { $und_compra = $und_compra; }
if ($cod_tipo_sistema_numeracion_precio_compra == '2') { $precio_compra_producto = intval($precio_compra_producto); } else { $precio_compra_producto = $precio_compra_producto; }
if ($cod_tipo_sistema_numeracion_precio_venta == '2') { $precio_venta_producto = intval($precio_venta_producto); } else { $precio_venta_producto = $precio_venta_producto; }

$incre++;
?>
<tr style="text-align:center;" id="tr<?php echo $cod_cambio_precio_venta_predeterm_producto_temporal;?>">
<th style="text-align:center;"></th>
<td style="text-align:left;" ><?php echo $cod_producto_barra ?></td>
<td style="text-align:left;"><?php echo $nombre_producto ?></td>
<td style="text-align:center;"><?php echo $und_venta;?></td>
<td style="text-align:left;"><?php echo $nombre_tipo_unidad_medida;?></td>
<td style="text-align:right;"><?php echo number_format($precio_compra_producto, 0, ",", ".");?></td>
<?php if ($cod_estado_dto1_global == '1') { ?>
<td style="text-align:center;"><?php echo $dto1;?></td>
<?php } ?>
<?php if ($cod_estado_dto2_global == '1') { ?>
<td style="text-align:center;"><?php echo $dto2;?></td>
<?php } ?>
<td style="text-align:center;"><?php echo $iva_ptj;?></td>
<?php if ($cod_estado_impoconsumo_global == '1') { ?>
<td style="text-align:right;"><?php echo number_format($precio_ipc, 0, ",", ".");?></td>
<?php } ?>

<?php for ($i=1; $i <= $numero_precio; $i++) { $contador = 1; $precio_ventas = 0; 
if ($i==1) { $contador = ""; $precio_ventas = $precio_venta_producto; } elseif ($i==2) { $contador = $i; $precio_ventas = $precio_venta_producto2; } elseif ($i==3) { $contador = $i; $precio_ventas = $precio_venta_producto3;
} elseif ($i==4) { $contador = $i; $precio_ventas = $precio_venta_producto4; } elseif ($i==5) { $contador = $i; $precio_ventas = $precio_venta_producto5; } else { $contador = ""; $precio_ventas = $precio_venta_producto; } ?>
<td style="text-align:center;"><?php echo number_format($precio_ventas, 0, ",", ".");?></td>
<?php } ?>

<td style="text-align:right;" id="total_compra_producto<?php echo $incre;?>"><?php echo number_format($total_compra_producto, 0, ",", ".");?></td>
<th style="text-align:center;"></th>
</tr style="text-align:right;" id="tr<?php echo $cod_cambio_precio_venta_predeterm_producto_temporal;?>">
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