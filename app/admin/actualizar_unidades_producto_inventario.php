<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="../estilo_css/estilo_modal.css">
<script type="text/javascript" src="js/jquery.number.js"></script>
</head>
<body id="pageBody">
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php //$pagina = addslashes($_GET['pagina']); ?>
<div id="contentOuterSeparator"></div>
<div class="container">
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
$tab                               = 'tbl15_venta_producto_temporal';
$campo                             = 'cod_venta_producto_temporal';
$tipo                              = 'eliminar';
$nombre_tipo_moneda                = "COP";
$nombre_tipo_factura               = "POS";
$cod_estado_vacuna                 = "0";

$time_seg                          = time();
$fecha                             = date("Ymd");
$hora                              = date("His");
$foco                              = 'und_producto_nueva';

if (isset($_GET['buscar_por'])) { $buscar_por = addslashes($_GET['buscar_por']); } else { $buscar_por = $nombre_buscar_por; }
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


if(valor_buscar=='') { document.getElementById("logo_cargador").innerHTML=""; return; }

if (window.XMLHttpRequest) { xmlhttp=new XMLHttpRequest(); } else { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); }
xmlhttp.onreadystatechange=function() {
  if (xmlhttp.readyState==4 && xmlhttp.status==200) { document.getElementById("logo_cargador").innerHTML=xmlhttp.responseText; } else { document.getElementById("logo_cargador").innerHTML='<center><img src="../imagenes/loader.gif"/></center>'; }
}
xmlhttp.open("POST","../admin/busqueda_inmediata_actualizar_unidades_producto_inventario.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("buscar="+valor_buscar+"&buscar_por="+buscar_por+"&nombre_tipo_moneda="+nombre_tipo_moneda+"&nombre_tipo_factura="+nombre_tipo_factura+"&tipo_busqueda="+tipo_busqueda+"&cod_estado_vacuna="+cod_estado_vacuna+"&cuenta="+cuenta+"&cod_caja_virtual="+cod_caja_virtual+"&pagina="+pagina);
}
</script>


<div class="table-responsive">
<?php 
if (isset($_GET['cod_producto_barra'])) { 
$cod_producto_barra           = addslashes($_GET['cod_producto_barra']); 

$mostrar_datos_sql = "SELECT * FROM tbl15_producto WHERE cod_producto_barra = '$cod_producto_barra'";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
$matriz_consulta = mysqli_fetch_assoc($consulta);

$nombre_producto              = $matriz_consulta['nombre_producto'];
$und_producto                 = $matriz_consulta['und_producto'];
$precio_compra_producto       = $matriz_consulta['precio_compra_producto'];
$precio_costo_producto        = $matriz_consulta['precio_costo_producto'];
$precio_venta_producto        = $matriz_consulta['precio_venta_producto'];
$precio_venta_producto2       = $matriz_consulta['precio_venta_producto2'];
$precio_venta_producto3       = $matriz_consulta['precio_venta_producto3'];
$precio_venta_producto4       = $matriz_consulta['precio_venta_producto4'];
$precio_venta_producto5       = $matriz_consulta['precio_venta_producto5'];

$nombre_tipo_producto         = $matriz_consulta['nombre_tipo_producto'];
$nombre_tipo_unidad_medida    = $matriz_consulta['nombre_tipo_unidad_medida'];
$nombre_tipo_presentacion     = $matriz_consulta['nombre_tipo_presentacion'];
$nombre_tipo_precio_venta     = $matriz_consulta['nombre_tipo_precio_venta'];
$tope_min                     = $matriz_consulta['tope_min'];
$iva_ptj                      = $matriz_consulta['iva_ptj'];
$fecha_vencimiento1           = $matriz_consulta['fecha_vencimiento1'];
$vencimiento_lote1            = $matriz_consulta['vencimiento_lote1'];
$fecha_mantenimiento          = $matriz_consulta['fecha_mantenimiento'];
$comision_ptj                 = $matriz_consulta['comision_ptj'];
$cod_dependencia              = $matriz_consulta['cod_dependencia'];
$cod_producto_serial          = $matriz_consulta['cod_producto_serial'];

$descripcion_producto         = $matriz_consulta['descripcion_producto'];
$und_producto_bodega          = $matriz_consulta['und_producto_bodega'];

$cajas_sobre                  = $matriz_consulta['cajas_sobre'];
$und_sobre                    = $matriz_consulta['und_sobre'];

$meses_mantenimiento          = $matriz_consulta['meses_mantenimiento'];
$meses_garantia               = $matriz_consulta['meses_garantia'];
$cod_factura                  = $matriz_consulta['cod_factura'];
$cod_marca                    = $matriz_consulta['cod_marca'];
$cod_tercero                  = $matriz_consulta['cod_tercero'];
$lote_compra                  = $matriz_consulta['lote_compra'];
$cod_categoria                = $matriz_consulta['cod_categoria'];
$cod_origen_produccion        = $matriz_consulta['cod_origen_produccion'];
$cod_marca                    = $matriz_consulta['cod_marca'];

$sql_marca = "SELECT cod_marca, nombre_marca FROM tbl15_marca WHERE (cod_marca = '$cod_marca')";
$query_marca = mysqli_query($conectar, $sql_marca);
$datos_marca = mysqli_fetch_array($query_marca);

$nombre_marca                  = $datos_marca['nombre_marca'];

if ($cod_tipo_sistema_numeracion_und_compra == '2') { $und_producto = intval($und_producto); } else { $und_producto = $und_producto; }
if ($cod_tipo_sistema_numeracion_precio_compra == '2') { $precio_compra_producto = intval($precio_compra_producto); } else { $precio_compra_producto = $precio_compra_producto; }
if ($cod_tipo_sistema_numeracion_precio_venta == '2') { $precio_venta_producto = intval($precio_venta_producto); } else { $precio_venta_producto = $precio_venta_producto; }
?>
<form name="formulario_edicion" accept-charset="utf-8" method="post" action="../admin/actualizar_unidades_producto_inventario_reg.php">
<fieldset>
<table border="1" class="table table-responsive">
    <thead>
        <tr>
            <th style="text-align:center"><a href="<?php $pagina?>?COD=1">REGRESAR</th>
        </tr>
    </thead>
</table>

<form name="formulario_edicion" accept-charset="utf-8" method="post" action="../admin/actualizar_unidades_producto_inventario_reg.php">
<fieldset>
<table border="1" class="table table-responsive">
    <thead>
        <tr>
            <th style="text-align:center">CODIGO PRODUCTO</th>
            <th style="text-align:center">NOMBRE PRODUCTO</th>
            <?php if ($cod_estado_marca_global == '1') { ?><th style="text-align:center">MARCA</th><?php } ?>
            <th style="text-align:center">UND ACTUALES</th>
            <th style="text-align:center">UND NUEVAS</th>
            <th style="text-align:center">OBSERVACION</th>
            <th style="text-align:center">PRECIO COMPRA</th>
            <th style="text-align:center">PRECIO VENTA</th>
        </tr>
        <tr>
            <td style="text-align:center"><?php echo $cod_producto_barra ?></td>
            <td style="text-align:center"><?php echo $nombre_producto ?></td>
            <?php if ($cod_estado_marca_global == '1') { ?><td style="text-align:center"><?php echo $nombre_marca; ?></td><?php } ?>
            <td style="text-align:center"><?php echo $und_producto ?></td>
            <td style="text-align:center"><input class="input-block-level" name="und_producto_nueva" id="und_producto_nueva" type="number" value="" size="10" required/></td>
            <td style="text-align:center"><input class="input-block-level" name="comentario" type="text" value=""/></td>

            <td style="text-align:center"><?php echo number_format($precio_compra_producto, 0, ",", ".") ?></td>
            <td style="text-align:center"><?php echo number_format($precio_venta_producto, 0, ",", ".") ?></td>
        </tr>
    </thead>
</table>

<hr>
<input type="hidden" name="cod_producto_barra" value="<?php echo $cod_producto_barra ?>"/>
<input type="hidden" name="pagina" value="<?php echo $pagina ?>"/>
<input type="hidden" name="ins_edit" value="formulario_insert_edit">

<div class="actions"><td><input type="submit" value="Actualizar Información" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" /></td></div>
</fieldset>
</form>
<?php } else { ?>
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
            <strong>Buscar Producto: <input type="text" id="busqueda" name="busqueda" onkeyup="hacer_busqueda()" style="height:40" placeholder="Buscar"/><input type="hidden" id="pagina" name="pagina" value="<?php echo $pagina_local ?>"/></strong><div id="logo_cargador"></div>
            </td>
        </tr>
    </tbody>
</table>
<?php } ?>
<!-- ***************************************************************************************************************************** -->
</div>
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* FIN MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
</div>
<!--End Main Content Area-->
</div>
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