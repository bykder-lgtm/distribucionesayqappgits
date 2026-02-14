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
$tab                               = 'tbl15_compra_producto_temporal';
$campo                             = 'cod_compra_producto_temporal';
$tipo                              = 'eliminar';
$cod_estado_vacuna                 = '0';

$nombre_tipo_moneda                = "COP";
$nombre_tipo_factura               = "POS";
$cod_estado_vacuna                 = "0";
$nombre_tipo_cargue_factura        = "FACTURA_COMPRA_NORMAL";

if (isset($_GET['cod_info_producto_copia_inventario'])) { 
$cod_info_producto_copia_inventario    = intval($_GET['cod_info_producto_copia_inventario']); 
if (isset($_GET['foco'])) { $foco = addslashes($_GET['foco']); } else { $foco = 'busqueda'; }
if (isset($_GET['buscar_por'])) { $buscar_por = addslashes($_GET['buscar_por']); } else { $buscar_por = $nombre_buscar_por; }
//***************************************************************************************************************************//
//***************************************************************************************************************************//
$sql_producto_con_existencia_no_cargado = "SELECT * FROM tbl15_producto_copia_inventario WHERE (cod_info_producto_copia_inventario = '$cod_info_producto_copia_inventario') 
AND (und_producto_viejo <> '0.00') AND (fecha_actualizacion = '') ORDER BY fecha_modificacion DESC";
$resultado_producto_con_existencia_no_cargado = mysqli_query($conectar, $sql_producto_con_existencia_no_cargado) or die(mysqli_error($conectar));
$total_producto_con_existencia_no_cargado = mysqli_num_rows($resultado_producto_con_existencia_no_cargado);
//***************************************************************************************************************************//
//***************************************************************************************************************************//
$sql_productos_cargados = "SELECT * FROM tbl15_producto_copia_inventario WHERE (cod_info_producto_copia_inventario = '$cod_info_producto_copia_inventario') 
AND (fecha_actualizacion <> '') ORDER BY fecha_modificacion DESC";
$resultado_productos_cargados = mysqli_query($conectar, $sql_productos_cargados) or die(mysqli_error($conectar));
$total_productos_cargados = mysqli_num_rows($resultado_productos_cargados);
//***************************************************************************************************************************//
//***************************************************************************************************************************//
$sql_productos_faltan_por_cargar = "SELECT tbl15_producto_copia_inventario.cod_producto_copia_inventario, tbl15_producto_copia_inventario.cod_producto_barra, 
tbl15_producto_copia_inventario.nombre_producto,  tbl15_producto_copia_inventario.und_producto_nuevo, tbl15_producto_copia_inventario.und_producto_viejo, 
tbl15_producto_copia_inventario.precio_compra_producto, tbl15_producto_copia_inventario.precio_venta_producto, 
tbl15_producto_copia_inventario.comentario_copia_inventario, tbl15_producto_copia_inventario.fecha_actualizacion, tbl15_producto_copia_inventario.cuenta 
FROM tbl15_producto RIGHT JOIN tbl15_producto_copia_inventario ON tbl15_producto.cod_producto_barra = tbl15_producto_copia_inventario.cod_producto_barra
WHERE ((tbl15_producto_copia_inventario.cod_info_producto_copia_inventario)='$cod_info_producto_copia_inventario') AND (fecha_actualizacion = '')";
$resultado_productos_faltan_por_cargar = mysqli_query($conectar, $sql_productos_faltan_por_cargar) or die(mysqli_error($conectar));
$total_productos_faltan_por_cargar = mysqlI_num_rows($resultado_productos_faltan_por_cargar);
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
var buscar_por = $("#buscar_por").val();
var cod_info_producto_copia_inventario = <?php echo $cod_info_producto_copia_inventario ?>;

if(valor_buscar=='') { document.getElementById("logo_cargador").innerHTML=""; return; }

if (window.XMLHttpRequest) { xmlhttp=new XMLHttpRequest(); } else { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); }
xmlhttp.onreadystatechange=function() {
  if (xmlhttp.readyState==4 && xmlhttp.status==200) { document.getElementById("logo_cargador").innerHTML=xmlhttp.responseText; } else { document.getElementById("logo_cargador").innerHTML='<center><img src="../imagenes/loader.gif"/></center>'; }
}
xmlhttp.open("POST","../admin/busqueda_inmediata_cargar_producto_copia_inventario_php.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("buscar="+valor_buscar+"&buscar_por="+buscar_por+"&cod_info_producto_copia_inventario="+cod_info_producto_copia_inventario+"&nombre_tipo_cargue_factura="+nombre_tipo_cargue_factura+"&nombre_tipo_moneda="+nombre_tipo_moneda+"&nombre_tipo_factura="+nombre_tipo_factura+"&cod_estado_vacuna="+cod_estado_vacuna+"&pagina="+pagina);
}
</script>

<div class="table-responsive">

<table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; width:100%">
    <tbody><tr>
        <th style="text-align:center"><a href="../admin/producto_copia_inventario_con_existencia_no_cargados.php?cod_info_producto_copia_inventario=<?php echo $cod_info_producto_copia_inventario ?>">CON EXISTENCIA NO CARGADO [<?php echo $total_producto_con_existencia_no_cargado ?>]</a></th>
        <th style="text-align:center"><a href="../admin/producto_copia_inventario_cargados.php?cod_info_producto_copia_inventario=<?php echo $cod_info_producto_copia_inventario ?>">PRODUCTOS CARGADOS [<?php echo $total_productos_cargados ?>]</a></th>
        <th style="text-align:center"><a href="../admin/producto_copia_inventario_sin_cargar.php?cod_info_producto_copia_inventario=<?php echo $cod_info_producto_copia_inventario ?>">FALTAN POR CARGAR [<?php echo $total_productos_faltan_por_cargar ?>]</a></th>
    </tr></tbody>
</table>

<br>
<form method="GET" name="formulario" action="../admin/cargar_producto_copia_inventario_producto_barras_transito.php">
    <table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; width:100%">
        <tbody>
        	<tr>
                <th style="text-align:center"><a href="../admin/cargar_producto_copia_inventario.php?cod_info_producto_copia_inventario=<?php echo $cod_info_producto_copia_inventario ?>&pagina=<?php echo $pagina ?>">Manual</a></th>
                <td bgcolor="#fff" align="center"><strong>Por Barras: [<?php echo $cod_info_producto_copia_inventario ?>]<input name="cod_producto_barra" id="busqueda" style="height:26" placeholder="C&oacute;digo del producto" required autofocus/><input type="submit" style="font-size:15px" name="buscador" tabindex=3 value="Vender Producto" /></td>
        	</tr>
        </tbody>
    </table>
    <input type="hidden" name="cod_info_producto_copia_inventario" value="<?php echo $cod_info_producto_copia_inventario; ?>">
    <input type="hidden" name="buscar_por" value="cod_producto_barra">
    <input type="hidden" name="nombre_tipo_cargue_factura" value="FACTURA_COMPRA_NORMAL">
    <input type="hidden" name="nombre_tipo_moneda" value="COP">
    <input type="hidden" name="nombre_tipo_factura" value="POS">
    <input type="hidden" name="foco" value="busqueda">
    <input type="hidden" name="cod_estado_vacuna" value="0">
    <input type="hidden" name="cod_estado_vacuna" value="0">
    <input type="hidden" name="pagina" value="<?php echo $pagina_local; ?>">
</table>
</div>
<?php } ?>
<!-- ***************************************************************************************************************************** -->
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