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
$tab                               = 'tbl15_auditoria_producto_temporal';
$campo                             = 'cod_auditoria_producto_temporal';
$tipo                              = 'eliminar';
$cod_estado_vacuna                 = '0';

$nombre_tipo_moneda                = "COP";
$nombre_tipo_factura               = "POS";
$cod_estado_vacuna                 = "0";
$nombre_tipo_cargue_factura        = "FACTURA_COMPRA_NORMAL";

if (isset($_GET['foco'])) { $foco = addslashes($_GET['foco']); } else { $foco = 'busqueda'; }
if (isset($_GET['buscar_por'])) { $buscar_por = addslashes($_GET['buscar_por']); } else { $buscar_por = $nombre_buscar_por; }

$datos_factura = "SELECT cod_auditoria_producto_temporal FROM tbl15_auditoria_producto_temporal WHERE (cuenta = '$cuenta_actual') AND (nombre_tipo_cargue_factura = '$nombre_tipo_cargue_factura') AND (cod_caja_virtual = '$cod_caja_virtual')";
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
var buscar_por= $("#buscar_por").val();

if(valor_buscar=='') { document.getElementById("logo_cargador").innerHTML=""; return; }

if (window.XMLHttpRequest) { xmlhttp=new XMLHttpRequest(); } else { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); }
xmlhttp.onreadystatechange=function() {
  if (xmlhttp.readyState==4 && xmlhttp.status==200) { document.getElementById("logo_cargador").innerHTML=xmlhttp.responseText; } else { document.getElementById("logo_cargador").innerHTML='<center><img src="../imagenes/loader.gif"/></center>'; }
}
xmlhttp.open("POST","../admin/busqueda_inmediata_auditoria_temporal_producto_php.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("buscar="+valor_buscar+"&buscar_por="+buscar_por+"&nombre_tipo_cargue_factura="+nombre_tipo_cargue_factura+"&nombre_tipo_moneda="+nombre_tipo_moneda+"&nombre_tipo_factura="+nombre_tipo_factura+"&cod_estado_vacuna="+cod_estado_vacuna+"&pagina="+pagina);
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
        <td bgcolor="#fff" align="center"><strong><a href="../admin/lista_info_factura_auditoria.php">LISTA DE AUDITORIAS</a></strong></td>
    </tr></tbody>
</table>
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
                <strong>Auditoria Manual: [<?php echo $cod_caja_virtual ?>]<input type="text" id="busqueda" name="busqueda" onkeyup="hacer_busqueda()" style="height:40" placeholder="Buscar"/><input type="hidden" id="pagina" name="pagina" value="<?php echo $pagina_local ?>"/></strong><div id="logo_cargador"></div>
            </td>
    	</tr>
    </tbody>
</table>
<!-- ***************************************************************************************************************************** -->
<?php include_once('../admin/info_factura_auditoria_temporal_pos.php'); ?>
<!-- ***************************************************************************************************************************** -->
<?php if ($total_datos <> 0) { include_once("../admin/modal_registrar_tercero_auditoria_temporal.php"); } ?>
<!-- ***************************************************************************************************************************** -->
<?php if ($total_datos <> 0) { ?>
<table class="table table-striped" border="1" cellspacing="0" cellpadding="20">
<thead>
<tr>
<th style="text-align:center;"></th>
<th style="text-align:center;">ELM</th>
<th style="text-align:center;">CODIGO</th>
<th style="text-align:center;">NOMBRE CONCEPTO</th>
<th style="text-align:center;">T.UND</th>
<th style="text-align:center;">P.VENTA</th>
<th style="text-align:center;">ID</th>
<th style="text-align:center;"></th>
</tr>
</thead>
<tbody>
<?php
$sql_auditoria_producto_temporal = "SELECT * FROM tbl15_auditoria_producto_temporal WHERE (cuenta = '$cuenta_actual') AND (nombre_tipo_cargue_factura = '$nombre_tipo_cargue_factura') AND (cod_caja_virtual = '$cod_caja_virtual') 
ORDER BY cod_auditoria_producto_temporal DESC";
$consulta_auditoria_producto_temporal = mysqli_query($conectar, $sql_auditoria_producto_temporal);
while ($datos_auditoria_producto_temporal = mysqli_fetch_assoc($consulta_auditoria_producto_temporal)) {

$cod_auditoria_producto_temporal               = $datos_auditoria_producto_temporal['cod_auditoria_producto_temporal'];
$cod_producto                                  = $datos_auditoria_producto_temporal['cod_producto'];
$cod_producto_barra                            = $datos_auditoria_producto_temporal['cod_producto_barra'];
$nombre_producto                               = $datos_auditoria_producto_temporal['nombre_producto'];
$cedula                                        = $datos_auditoria_producto_temporal['cedula'];
$nombre_cliente                                = $datos_auditoria_producto_temporal['nombre_cliente'];
$und_compra                                    = $datos_auditoria_producto_temporal['und_compra'];
$und_unidades                                  = $datos_auditoria_producto_temporal['und_unidades'];
$und_caja                                      = $datos_auditoria_producto_temporal['und_caja'];
$precio_costo_producto                         = $datos_auditoria_producto_temporal['precio_costo_producto'];
$precio_compra_producto                        = $datos_auditoria_producto_temporal['precio_compra_producto'];
$precio_compra_producto                        = $datos_auditoria_producto_temporal['precio_compra_producto'];
$total_costo_producto                          = $datos_auditoria_producto_temporal['total_costo_producto'];
$total_compra_producto                         = $datos_auditoria_producto_temporal['total_compra_producto'];
$precio_venta_producto                         = $datos_auditoria_producto_temporal['precio_venta_producto'];
$precio_venta_producto2                        = $datos_auditoria_producto_temporal['precio_venta_producto2'];
$precio_venta_producto3                        = $datos_auditoria_producto_temporal['precio_venta_producto3'];
$precio_venta_producto4                        = $datos_auditoria_producto_temporal['precio_venta_producto4'];
$precio_venta_producto5                        = $datos_auditoria_producto_temporal['precio_venta_producto5'];
$iva_ptj                                       = $datos_auditoria_producto_temporal['iva_ptj'];
$dto1                                          = $datos_auditoria_producto_temporal['dto1'];
$dto2                                          = $datos_auditoria_producto_temporal['dto2'];
$precio_ipc                                    = $datos_auditoria_producto_temporal['precio_ipc'];
$total_venta_producto                          = $datos_auditoria_producto_temporal['total_venta_producto'];
$nombre_tipo_producto                          = $datos_auditoria_producto_temporal['nombre_tipo_producto'];
$nombre_tipo_unidad_medida                     = $datos_auditoria_producto_temporal['nombre_tipo_unidad_medida'];
$posologia_cantidad                            = $datos_auditoria_producto_temporal['posologia_cantidad'];
$posologia_peso                                = $datos_auditoria_producto_temporal['posologia_peso'];
$nombre_tipo_presentacion                      = $datos_auditoria_producto_temporal['nombre_tipo_presentacion'];
$nombre_via_administracion                     = $datos_auditoria_producto_temporal['nombre_via_administracion'];
$nombre_frec_duracion                          = $datos_auditoria_producto_temporal['nombre_frec_duracion'];
$cod_tipo_cobrar                               = $datos_auditoria_producto_temporal['cod_tipo_cobrar'];
$nombre_tipo_precio_venta                      = $datos_auditoria_producto_temporal['nombre_tipo_precio_venta'];
$cod_estado_permitir_venta                     = $datos_auditoria_producto_temporal['cod_estado_permitir_venta'];
$fecha_vencimiento                             = $datos_auditoria_producto_temporal['fecha_vencimiento'];
$lote_vencimiento                              = $datos_auditoria_producto_temporal['lote_vencimiento'];
$comision_ptj                                  = $datos_auditoria_producto_temporal['comision_ptj'];
$nombre_tipo_unidad_medida                     = $datos_auditoria_producto_temporal['nombre_tipo_unidad_medida'];
$ganancia_ptj                                  = $datos_auditoria_producto_temporal['ganancia_ptj'];
$fecha_mantenimiento                           = $datos_auditoria_producto_temporal['fecha_mantenimiento'];

if ($cod_tipo_sistema_numeracion_und_compra == '2') { $und_compra = intval($und_compra); } else { $und_compra = $und_compra; }
if ($cod_tipo_sistema_numeracion_precio_compra == '2') { $precio_compra_producto = intval($precio_compra_producto); } else { $precio_compra_producto = $precio_compra_producto; }
if ($cod_tipo_sistema_numeracion_precio_venta == '2') { $precio_venta_producto = intval($precio_venta_producto); } else { $precio_venta_producto = $precio_venta_producto; }

if ($cod_estado_permitir_venta == 1) { $imagen = '<img src=../imagenes/incorrecto.png alt="Listo">'; } else { $imagen = '<img src=../imagenes/correctok.png alt="Listo">'; }

$incre++;
?>
<tr>
<td style="text-align:center;"></td>
<td  style="text-align:center;"><a href="../admin/eliminar.php?llave=<?php echo $cod_auditoria_producto_temporal?>&tab=<?php echo $tab ?>&tipo=<?php echo $tipo ?>&campo=<?php echo $campo ?>&pagina=<?php echo $pagina_local ?>"><img src="../imagenes/eliminar.png" class="img-polaroid" alt=""></a></td>
<td style="text-align:left;" ><?php echo $cod_producto_barra ?></td>
<td style="text-align:left;"><?php echo $nombre_producto ?></td>
<td style="text-align:center;"><input name="und_compra" type="number" id="und_compra<?php echo $incre;?>" class="<?php echo $cod_auditoria_producto_temporal;?>" value="<?php echo $und_compra;?>" step="any" min=0 oninput="validity.valid||(value='');" style="width: 60px;" /></td>
<td style="text-align:right;"><?php echo  number_format($precio_venta_producto, 0, ",", ".") ?></td>
<td style="text-align:center;" ><?php echo $cod_auditoria_producto_temporal ?></td>
<td style="text-align:center;"></td>
</tr>
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