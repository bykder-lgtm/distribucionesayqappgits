<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
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
$tab                               = 'tbl15_sticker_producto';
$campo                             = 'cod_sticker_producto';
$tipo                              = 'eliminar';
$cod_estado_vacuna                 = '0';

$nombre_tipo_moneda                = "COP";
$nombre_tipo_factura               = "POS";
$cod_estado_vacuna                 = "0";

if (isset($_GET['foco'])) { $foco = addslashes($_GET['foco']); } else { $foco = 'busqueda'; }

if (isset($_GET['cod_info_factura_sticker'])) { $cod_info_factura_sticker = addslashes($_GET['cod_info_factura_sticker']); } else { $cod_info_factura_sticker = '0'; }

$datos_factura = "SELECT cod_sticker_producto FROM tbl15_sticker_producto WHERE (cod_info_factura_sticker = '$cod_info_factura_sticker')";
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
var buscar_por= $("#buscar_por").val();
var nombre_tipo_moneda = "COP";
var nombre_tipo_factura = "POS";
var cod_estado_vacuna = "0";
var cod_info_factura_sticker = <?php echo $cod_info_factura_sticker ?>;

if(valor_buscar=='') { document.getElementById("logo_cargador").innerHTML=""; return; }

if (window.XMLHttpRequest) { xmlhttp=new XMLHttpRequest(); } else { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); }
xmlhttp.onreadystatechange=function() {
  if (xmlhttp.readyState==4 && xmlhttp.status==200) { document.getElementById("logo_cargador").innerHTML=xmlhttp.responseText; } else { document.getElementById("logo_cargador").innerHTML='<center><img src="../imagenes/loader.gif"/></center>'; }
}
xmlhttp.open("POST","../admin/busqueda_inmediata_sticker_producto_php.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("buscar="+valor_buscar+"&buscar_por="+buscar_por+"&cod_info_factura_sticker="+cod_info_factura_sticker+"&nombre_tipo_moneda="+nombre_tipo_moneda+"&nombre_tipo_factura="+nombre_tipo_factura+"&cod_estado_vacuna="+cod_estado_vacuna+"&pagina="+pagina);
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
        <td bgcolor="#fff" align="center"><strong><a href="../admin/lista_info_factura_sticker.php">LISTA DE STIKERS</a></strong></td>
    </tr></tbody>
</table>
<br>

<table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; width:100%">
    <tbody>
        <tr>
            <td bgcolor="#fff" align="center"><strong>Buscar por:</strong>
            <select class="form-control" name="buscar_por" id="buscar_por" onchange="hacer_busqueda()" style="width: 180px;">
                <option value="nombre_producto">Nombre de Producto</option>
                <option value="cod_producto_barra">Codigo de Barras</option>
                <option value="todo">Todo</option>
            </select>
            <strong>Sticker Manual: [<?php echo $cod_caja_virtual ?>]<input type="text" id="busqueda" name="busqueda" onkeyup="hacer_busqueda()" style="height:40" placeholder="Buscar"/><input type="hidden" id="pagina" name="pagina" value="<?php echo $pagina_local ?>"/></strong><div id="logo_cargador"></div>
            </td>
        </tr>
    </tbody>
</table>
<!-- ***************************************************************************************************************************** -->
<?php include_once('../admin/info_factura_sticker_pos.php'); ?>
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php if ($total_datos <> 0) { ?>
<table class="table table-striped" border="1" cellspacing="0" cellpadding="20">
<thead>
<tr>
<td style="text-align:center;"></td>
<th style="text-align:center;">ELM</th>
<!--<th style="text-align:center;">COBRAR</th>-->
<th style="text-align:center;">CODIGO</th>
<th style="text-align:center;">NOMBRE CONCEPTO</th>
<th style="text-align:center;">CANTIDAD</th>
<th style="text-align:center;">PRECIO VENTA</th>
<td style="text-align:center;"></td>
</tr>
</thead>
<tbody>
<?php
$sql_sticker_producto = "SELECT * FROM tbl15_sticker_producto WHERE (cod_info_factura_sticker = '$cod_info_factura_sticker') 
ORDER BY cod_sticker_producto DESC";
$consulta_sticker_producto = mysqli_query($conectar, $sql_sticker_producto);
while ($datos_sticker_producto = mysqli_fetch_assoc($consulta_sticker_producto)) {

$cod_sticker_producto              = $datos_sticker_producto['cod_sticker_producto'];
$cod_producto                      = $datos_sticker_producto['cod_producto'];
$cod_producto_barra                = $datos_sticker_producto['cod_producto_barra'];
$nombre_producto                   = $datos_sticker_producto['nombre_producto'];
$cedula                            = $datos_sticker_producto['cedula'];
$nombre_cliente                    = $datos_sticker_producto['nombre_cliente'];
$und_venta                         = $datos_sticker_producto['und_venta'];
$precio_costo_producto             = $datos_sticker_producto['precio_costo_producto'];
$total_costo_producto              = $datos_sticker_producto['total_costo_producto'];
$precio_venta_producto             = $datos_sticker_producto['precio_venta_producto'];
$total_venta_producto              = $datos_sticker_producto['total_venta_producto'];
$nombre_tipo_producto              = $datos_sticker_producto['nombre_tipo_producto'];
$nombre_tipo_unidad_medida         = $datos_sticker_producto['nombre_tipo_unidad_medida'];
$posologia_cantidad                = $datos_sticker_producto['posologia_cantidad'];
$posologia_peso                    = $datos_sticker_producto['posologia_peso'];
$nombre_tipo_presentacion          = $datos_sticker_producto['nombre_tipo_presentacion'];
$nombre_via_administracion         = $datos_sticker_producto['nombre_via_administracion'];
$nombre_frec_duracion              = $datos_sticker_producto['nombre_frec_duracion'];
$cod_tipo_cobrar                   = $datos_sticker_producto['cod_tipo_cobrar'];
$nombre_tipo_precio_venta          = $datos_sticker_producto['nombre_tipo_precio_venta'];

$incre++;
?>
<tr style="text-align:center;" id="tr<?php echo $cod_sticker_producto;?>">
<td style="text-align:center;"></td>
<td  style="text-align:center;"><a href="../admin/eliminar.php?llave=<?php echo $cod_sticker_producto?>&tab=<?php echo $tab ?>&tipo=<?php echo $tipo ?>&campo=<?php echo $campo ?>&pagina=<?php echo $pagina_local ?>"><img src="../imagenes/eliminar.png" class="img-polaroid" alt=""></a></td>
<!--<td style="text-align:center"><input name="cod_tipo_cobrar" class="cod_tipo_cobrar__<?php echo $cod_sticker_producto;?>" id="cod_tipo_cobrar_<?php echo $cod_sticker_producto;?>" type="checkbox" value="1" <?php if($cod_tipo_cobrar=='1'){ echo "checked"; } ?>></td>-->
<!--<td style="text-align:center;" id="cod_sticker_producto_<?php echo $cod_sticker_producto ?>" class="service_list" data="<?php echo $cod_sticker_producto ?>"><a class="eliminar" id="cod_sticker_producto<?php echo $cod_sticker_producto ?>"><img src="../imagenes/eliminar.png" class="img-polaroid" alt=""></a></td>-->
<td style="text-align:center;" id="cod_producto_barra_<?php echo $incre;?>"><?php echo $cod_producto_barra ?></td>
<td style="text-align:left;" id="und_venta_<?php echo $incre;?>"><input name="nombre_producto" type="text" id="nombre_producto<?php echo $incre;?>" class="<?php echo $cod_sticker_producto;?>" value="<?php echo $nombre_producto;?>" style="width: 700px;" /></td>
<td style="text-align:center;" id="und_venta_<?php echo $incre;?>"><input name="und_venta" type="number" id="und_venta<?php echo $incre;?>" class="<?php echo $cod_sticker_producto;?>" value="<?php echo $und_venta;?>" style="width: 70px;" /></td>
<td style="text-align:center;" id="und_venta_<?php echo $incre;?>"><input name="precio_venta_producto" type="text" id="precio_venta_producto<?php echo $incre;?>" class="<?php echo $cod_sticker_producto;?>" value="<?php echo $precio_venta_producto;?>" style="width: 70px;" /></td>
<td style="text-align:center;"></td>
</tr style="text-align:right;" id="tr<?php echo $cod_sticker_producto;?>">
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
</body>
</html>