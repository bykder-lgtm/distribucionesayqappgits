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
if (isset($_GET['cuenta'])) { $cuenta_actual = addslashes($_GET['cuenta']); } else { $cuenta_actual = $cuenta_actual; }
if (isset($_GET['cod_caja_virtual'])) { $cod_caja_virtual = addslashes($_GET['cod_caja_virtual']); } else { $cod_caja_virtual = $cod_caja_virtual; }
if (isset($_GET['cuenta'])) { $url_visit_user_extern = '?cuenta='.$cuenta_actual.'&cod_caja_virtual='.$cod_caja_virtual; } else { $url_visit_user_extern = ""; }

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

if (isset($_GET['foco'])) { $foco = addslashes($_GET['foco']); } else { $foco = 'busqueda'; }
if (isset($_GET['buscar_por'])) { $buscar_por = addslashes($_GET['buscar_por']); } else { $buscar_por = $nombre_buscar_por; }

$datos_factura = "SELECT cod_info_factura_compra FROM tbl15_info_factura_compra WHERE (nombre_estado_factura = 'ABIERTA') AND (cuenta = '$cuenta_actual') AND (cod_caja_virtual = '$cod_caja_virtual')";
$consulta = mysqli_query($conectar, $datos_factura);
$total_datos = mysqli_num_rows($consulta);

$sql_datos_temp_compra = "SELECT cod_compra_producto_temporal FROM tbl15_compra_producto_temporal WHERE (cuenta = '$cuenta_actual') AND (cod_caja_virtual = '$cod_caja_virtual')";
$consulta_datos_temp_compra = mysqli_query($conectar, $sql_datos_temp_compra);
$total_datos_temp_compra = mysqli_num_rows($consulta_datos_temp_compra);
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
xmlhttp.open("POST","../admin/busqueda_inmediata_compra_temporal_producto_php.php",true);
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
<td bgcolor="#fff" align="center"><strong><a href="../admin/lista_info_factura_compra_externa_copidrogas_abierta_temporal.php">LISTA FACTURA DE COMPRA ABIERTA</a></strong></td> 
<?php if ($cod_estado_facturacion_compra == '1') { ?><td bgcolor="#fff" align="center"><strong><a href="../admin/lista_info_factura_compra.php">LISTA DE COMPRA</a></strong></td><?php } ?>  
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
                <strong>Compra Manual: [<?php echo $cod_caja_virtual ?>]<input type="text" id="busqueda" name="busqueda" onkeyup="hacer_busqueda()" style="height:40" placeholder="Buscar"/><input type="hidden" id="pagina" name="pagina" value="<?php echo $pagina_local ?>"/></strong><div id="logo_cargador"></div>
            </td>
    	</tr>
    </tbody>
</table>
<!-- ***************************************************************************************************************************** -->
<?php include_once('../admin/info_factura_compra_temporal_pos.php'); ?>
<!-- ***************************************************************************************************************************** -->
<?php if ($total_datos <> 0) { include_once("../admin/modal_registrar_tercero_factura_compra.php"); } ?>
<!-- ***************************************************************************************************************************** -->
<?php if ($total_datos <> 0) { ?>
<table class="table table-striped" border="1" cellspacing="0" cellpadding="20">
<thead>
<tr>
<th style="text-align:center;"></th>
<th style="text-align:center;">ELM</th>
<!--<th style="text-align:center;">COBRAR</th>-->
<?php if ($cod_estado_existe_producto_factura_compra_global == '1') { ?>
<th style="text-align:center;">...</th>
<?php } ?>

<?php if ($cod_estado_chk_factura_compra_global == '1') { ?>
<th style="text-align:center;">CHK</th>
<?php } ?>

<th style="text-align:center;">CODIGO</th>
<th style="text-align:center;">NOMBRE CONCEPTO</th>
<?php if ($cod_estado_compra_caja_global == '1') { ?>
<th style="text-align:center;">U.PQ</th>
<th style="text-align:center;">X</th>
<th style="text-align:center;">UND</th>
<?php } ?>
<th style="text-align:center;">T.UND</th>
<th style="text-align:center;">MEDIDA</th>

<?php if ($cod_estado_caja_fraccion_global == '1') { ?>
<!--<th style="text-align:center">CAJ|FRAC</th>-->
<?php } ?>

<th style="text-align:center;">P.COMPRA + IVA</th>

<?php if ($cod_estado_factura_compra_alerta_subio_bajo_precio_compra_global == '1') { ?>
<th style="text-align:center;">...</th>
<?php } ?>

<?php if ($cod_estado_und_producto_factura_compra == '1') { ?>
<th style="text-align:center;">INV</th>
<?php } ?>

<?php if ($cod_estado_factura_compra_cargue_inmediato_global == '1') { ?>
<th style="text-align:center;">INMED</th>
<?php } ?>

<?php if ($cod_estado_dto1_global == '1') { ?>
<th style="text-align:center;">%DTO1</th>
<?php } ?>
<?php if ($cod_estado_dto2_global == '1') { ?>
<th style="text-align:center;">%DTO2</th>
<?php } ?>
<th style="text-align:center;">%IVA</th>
<?php if ($cod_estado_ptj_comision_global == '1') { ?>
<th style="text-align:center;">%COMI</th>
<?php } ?>
<?php if ($cod_estado_impoconsumo_global == '1') { ?>
<th style="text-align:center;">IMPOCONSUMO</th>
<?php } ?>

<?php if ($cod_estado_ganancia_ptj_global  == '1') { ?>
<th style="text-align:center;">%GANAN</th>
<?php } ?>

<?php for ($i=1; $i <= $numero_precio; $i++) { $contador = 1; if ($i==1) { $contador = ""; } else { $contador = $i; } ?>
<th style="text-align:center">P.VENTA<?php echo $contador; ?></th>
<?php } ?>

<?php if ($cod_estado_peso_producto_global == '1') { ?>
<th style="text-align:center">PESO (KG)</th>
<?php } ?>

<?php if ($cod_estado_cajas_sobre_global  == '1') { ?>
<th style="text-align:center;">CAJA</th>
<?php } ?>

<?php if ($cod_estado_und_sobre_global  == '1') { ?>
<th style="text-align:center;">SOBRE</th>
<?php } ?>

<?php if ($cod_estado_dependencia_global  == '1') { ?>
<th style="text-align:center;">DEPENDENCIA</th>
<?php } ?>

<?php if ($cod_estado_fecha_vencimiento_global == '1') { ?>
<th style="text-align:center">VENCIMIENTO</th>
<th style="text-align:center">LOTE</th>
<?php } ?>

<?php if ($cod_estado_fecha_mantenimiento_global == '1') { ?>
<th style="text-align:center">F.MANTENIMIENTO</th>
<th style="text-align:center">MANTENIMIENTO MESES</th>
<?php } ?>

<?php if ($cod_estado_meses_garantia_global  == '1') { ?>
<th style="text-align:center;">GARANTIA MESES</th>
<?php } ?>

<th style="text-align:center;">VALOR COMPRA</th>
<th style="text-align:center;">OK</th>
<th style="text-align:center;"></th>
</tr>
</thead>
<tbody>
<?php
$sql_compra_producto_temporal = "SELECT * FROM tbl15_compra_producto_temporal 
WHERE (cuenta = '$cuenta_actual') AND (cod_caja_virtual = '$cod_caja_virtual') 
ORDER BY cod_compra_producto_temporal DESC";
$consulta_compra_producto_temporal = mysqli_query($conectar, $sql_compra_producto_temporal);
while ($datos_compra_producto_temporal = mysqli_fetch_assoc($consulta_compra_producto_temporal)) {

$cod_compra_producto_temporal                  = $datos_compra_producto_temporal['cod_compra_producto_temporal'];
$cod_info_factura_compra                       = $datos_compra_producto_temporal['cod_info_factura_compra'];
$cod_producto                                  = $datos_compra_producto_temporal['cod_producto'];
$cod_producto_barra                            = $datos_compra_producto_temporal['cod_producto_barra'];
$nombre_producto                               = $datos_compra_producto_temporal['nombre_producto'];
$cedula                                        = $datos_compra_producto_temporal['cedula'];
$nombre_cliente                                = $datos_compra_producto_temporal['nombre_cliente'];
$und_compra                                    = $datos_compra_producto_temporal['und_compra'];
$und_unidades                                  = $datos_compra_producto_temporal['und_unidades'];
$und_caja                                      = $datos_compra_producto_temporal['und_caja'];
$precio_costo_producto                         = $datos_compra_producto_temporal['precio_costo_producto'];
$precio_compra_producto                        = $datos_compra_producto_temporal['precio_compra_producto'];
$precio_compra_producto                        = $datos_compra_producto_temporal['precio_compra_producto'];
$total_costo_producto                          = $datos_compra_producto_temporal['total_costo_producto'];
$total_compra_producto                         = $datos_compra_producto_temporal['total_compra_producto'];
$precio_venta_producto                         = $datos_compra_producto_temporal['precio_venta_producto'];
$precio_venta_producto2                        = $datos_compra_producto_temporal['precio_venta_producto2'];
$precio_venta_producto3                        = $datos_compra_producto_temporal['precio_venta_producto3'];
$precio_venta_producto4                        = $datos_compra_producto_temporal['precio_venta_producto4'];
$precio_venta_producto5                        = $datos_compra_producto_temporal['precio_venta_producto5'];
$iva_ptj                                       = $datos_compra_producto_temporal['iva_ptj'];
$dto1                                          = $datos_compra_producto_temporal['dto1'];
$dto2                                          = $datos_compra_producto_temporal['dto2'];
$precio_ipc                                    = $datos_compra_producto_temporal['precio_ipc'];
$total_venta_producto                          = $datos_compra_producto_temporal['total_venta_producto'];
$nombre_tipo_producto                          = $datos_compra_producto_temporal['nombre_tipo_producto'];
$nombre_tipo_unidad_medida                     = $datos_compra_producto_temporal['nombre_tipo_unidad_medida'];
$posologia_cantidad                            = $datos_compra_producto_temporal['posologia_cantidad'];
$posologia_peso                                = $datos_compra_producto_temporal['posologia_peso'];
$nombre_tipo_presentacion                      = $datos_compra_producto_temporal['nombre_tipo_presentacion'];
$nombre_via_administracion                     = $datos_compra_producto_temporal['nombre_via_administracion'];
$nombre_frec_duracion                          = $datos_compra_producto_temporal['nombre_frec_duracion'];
$cod_tipo_cobrar                               = $datos_compra_producto_temporal['cod_tipo_cobrar'];
$nombre_tipo_precio_venta                      = $datos_compra_producto_temporal['nombre_tipo_precio_venta'];
$cod_estado_permitir_venta                     = $datos_compra_producto_temporal['cod_estado_permitir_venta'];
$fecha_vencimiento                             = $datos_compra_producto_temporal['fecha_vencimiento'];
$lote_vencimiento                              = $datos_compra_producto_temporal['lote_vencimiento'];
$comision_ptj                                  = $datos_compra_producto_temporal['comision_ptj'];
$ganancia_ptj                                  = $datos_compra_producto_temporal['ganancia_ptj'];
$fecha_mantenimiento                           = $datos_compra_producto_temporal['fecha_mantenimiento'];
$cajas_sobre                                   = $datos_compra_producto_temporal['cajas_sobre'];
$und_sobre                                     = $datos_compra_producto_temporal['und_sobre'];
$meses_mantenimiento                           = $datos_compra_producto_temporal['meses_mantenimiento'];
$meses_garantia                                = $datos_compra_producto_temporal['meses_garantia'];
$peso_producto                                 = $datos_compra_producto_temporal['peso_producto'];
$unidad_medida_peso                            = $datos_compra_producto_temporal['unidad_medida_peso'];
$chk                                           = $datos_compra_producto_temporal['chk'];
$check_caja                                    = $datos_compra_producto_temporal['check_caja'];
$check_und                                     = $datos_compra_producto_temporal['check_und'];
$precio_compra_producto_viejo                  = $datos_compra_producto_temporal['precio_compra_producto_viejo'];
$dif_precio                                    = abs($precio_compra_producto - $precio_compra_producto_viejo);

$cod_dependencia                               = $datos_compra_producto_temporal['cod_dependencia'];
$und_producto                                  = $datos_compra_producto_temporal['und_producto'];

if ($cod_tipo_sistema_numeracion_und_compra == '2') { $und_compra = intval($und_compra); } else { $und_compra = $und_compra; }
if ($cod_tipo_sistema_numeracion_precio_compra == '2') { $precio_compra_producto = intval($precio_compra_producto); } else { $precio_compra_producto = $precio_compra_producto; }
if ($cod_tipo_sistema_numeracion_precio_venta == '2') { $precio_venta_producto = intval($precio_venta_producto); } else { $precio_venta_producto = $precio_venta_producto; }
if ($cod_estado_permitir_venta == 1) { $imagen = '<img src=../imagenes/incorrecto.png alt="Listo">'; } else { $imagen = '<img src=../imagenes/correctok.png alt="Listo">'; }
if ($precio_compra_producto > $precio_compra_producto_viejo) { $imagen_dif_precio = '<img src=../imagenes/arriba.gif alt="arriba">'; } elseif ($precio_compra_producto < $precio_compra_producto_viejo) { $imagen_dif_precio = '<img src=../imagenes/abajo.gif alt="abajo">'; } else { $imagen_dif_precio = '<img src=../imagenes/bien.png alt="bien">'; }

if ($cajas_sobre > '1') {
$total_cajas                    = intval($und_compra / $cajas_sobre);
$total_fraccion                 = $und_compra - ($total_cajas * $cajas_sobre);
$total_caja_fraccion            = $total_cajas.'|'.$total_fraccion;
} else {
$total_cajas                    = '';
$total_fraccion                 = '';
$total_caja_fraccion            = '';
}


$sql_producto = "SELECT cod_producto, cod_producto_barra FROM tbl15_producto WHERE cod_producto_barra = '$cod_producto_barra'";
$consulta_producto = mysqli_query($conectar, $sql_producto) or die(mysqli_error($conectar));
$existe_producto = mysqli_num_rows($consulta_producto);

$incre++;
?>
<tr style="text-align:center;" id="tr<?php echo $cod_compra_producto_temporal;?>">
<th style="text-align:center;"></th>
<td  style="text-align:center;"><a href="../admin/eliminar.php?llave=<?php echo $cod_compra_producto_temporal?>&tab=<?php echo $tab ?>&tipo=<?php echo $tipo ?>&campo=<?php echo $campo ?>&pagina=<?php echo $pagina_local ?>"><img src="../imagenes/eliminar.png" class="img-polaroid" alt=""></a></td>

<?php if ($cod_estado_existe_producto_factura_compra_global == '1') { ?>
<?php if ($existe_producto == '0') { ?> <td style="text-align:center;"><a href="../admin/registrar_producto_desde_cargue_factura_compra_reg.php?llave=<?php echo $cod_compra_producto_temporal?>&cuenta=<?php echo $cuenta_actual ?>&cod_caja_virtual=<?php echo $cod_caja_virtual ?>&tab=<?php echo $tab ?>&tipo=<?php echo $tipo ?>&campo=<?php echo $campo ?>&pagina=<?php echo $pagina_local ?>"><img src="../imagenes/advertencia1.gif" alt="advertencia"></a></td><?php } else { ?> <td style="text-align:center;"><img src="../imagenes/bien.png" alt="bien"></td><?php } ?>
<?php } ?>

<?php if ($cod_estado_chk_factura_compra_global == '1') { ?>
<td style="text-align:center;"><div id="listado"><input name="chk" class="<?php echo $cod_compra_producto_temporal;?>" id="chk<?php echo $cod_compra_producto_temporal ?>" type="checkbox" value="0" <?php if($chk=='1'){ echo "checked"; } ?>></div></td>
<?php } ?>

<td style="text-align:center;" ><?php echo $cod_producto_barra ?></td>

<?php if ($cod_estado_nombre_producto_editable_factura_compra_global == '1') { ?>
<td style="text-align:left;">
    <textarea name="nombre_producto" id="nombre_producto<?php echo $incre;?>" class="<?php echo $cod_compra_producto_temporal;?>" rows="2" cols="40"><?php echo $nombre_producto;?></textarea></td>
<?php } else { ?>
<td style="text-align:left;"><?php echo $nombre_producto ?></td>
 <?php } ?>

<?php if ($cod_estado_compra_caja_global == '1') { ?>
<td style="text-align:center;"><input name="und_unidades" type="text" id="und_unidades<?php echo $incre;?>" class="<?php echo $cod_compra_producto_temporal;?>" onChange="calc_total_compra();" value="<?php echo $und_unidades;?>" style="width: 40px;" /></td>
<th style="text-align:center;">X</th>
<td style="text-align:center;"><input name="und_caja" type="text" id="und_caja<?php echo $incre;?>" class="<?php echo $cod_compra_producto_temporal;?>" onChange="calc_total_compra();" value="<?php echo $und_caja;?>" style="width: 40px;" /></td>
<?php } ?>
<td style="text-align:center;"><input name="und_compra" type="number" id="und_compra<?php echo $incre;?>" class="<?php echo $cod_compra_producto_temporal;?>" onChange="calc_total_compra();" value="<?php echo $und_compra;?>" style="width: 60px;" /></td>

<td align="center">
<select name="nombre_tipo_unidad_medida" id="<?php echo $cod_compra_producto_temporal;?>" class="<?php echo $cod_compra_producto_temporal;?>" style="width: 60px;">
<?php if (isset($nombre_tipo_unidad_medida)) { echo "<option value='' >Selecione</option>";
} else { echo  "<option value='' selected >Selecione</option>"; }
$sql_consulta2 = "SELECT nombre_tipo_unidad_medida FROM tbl15_tipo_unidad_medida ORDER BY cod_tipo_unidad_medida ASC";
$consulta2 = mysqli_query($conectar, $sql_consulta2);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($nombre_tipo_unidad_medida) and $nombre_tipo_unidad_medida == $datos2['nombre_tipo_unidad_medida']) {
$seleccionado = "selected";
} else { $seleccionado = ""; }
$codigo = $datos2['nombre_tipo_unidad_medida'];
$nombre = $datos2['nombre_tipo_unidad_medida'];
echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
</td>

<?php if ($cod_estado_caja_fraccion_global == '1') { ?>
<!--<td style="text-align:center"><?php echo $total_caja_fraccion;?></td>-->
<?php } ?>

<td style="text-align:center;"><input name="precio_compra_producto" type="text" id="precio_compra_producto<?php echo $incre;?>" class="<?php echo $cod_compra_producto_temporal;?>" onChange="calc_total_compra();" value="<?php echo $precio_compra_producto;?>" style="width: 70px;" /></td>


<?php if ($cod_estado_factura_compra_alerta_subio_bajo_precio_compra_global == '1') { ?>
<td style="text-align:center;"><?php echo number_format($dif_precio, 0, ",", ".").'<br>'.$imagen_dif_precio; ?></td>
<?php } ?>

<?php if ($cod_estado_und_producto_factura_compra == '1') { ?>
<td style="text-align:center;"><?php echo $und_producto;?></td>
<?php } ?>

<?php if ($cod_estado_factura_compra_cargue_inmediato_global == '1') { ?>
<td  style="text-align:center;"><a href="../admin/enviar_producto_factura_compra_inmediata_reg.php?cod_compra_producto_temporal=<?php echo $cod_compra_producto_temporal?>&cod_info_factura_compra=<?php echo $cod_info_factura_compra ?>&cuenta=<?php echo $cuenta_actual ?>&nombre_tipo_cargue_factura=<?php echo $nombre_tipo_cargue_factura ?>&cod_caja_virtual=<?php echo $cod_caja_virtual ?>&tab=<?php echo $tab ?>&tipo=<?php echo $tipo ?>&campo=<?php echo $campo ?>&pagina=<?php echo $pagina_local ?>"><img src="../imagenes/correcto_verde.png" alt=""></a></td>
<?php } ?>

<?php if ($cod_estado_dto1_global == '1') { ?>
<td style="text-align:center;"><input name="dto1" type="text" id="dto1<?php echo $incre;?>" class="<?php echo $cod_compra_producto_temporal;?>" value="<?php echo $dto1;?>" style="width: 30px;" /></td>
<?php } ?>
<?php if ($cod_estado_dto2_global == '1') { ?>
<td style="text-align:center;"><input name="dto2" type="text" id="dto2<?php echo $incre;?>" class="<?php echo $cod_compra_producto_temporal;?>" value="<?php echo $dto2;?>" style="width: 30px;" /></td>
<?php } ?>

<td style="text-align:center;"><input name="iva_ptj" type="text" id="iva_ptj<?php echo $incre;?>" class="<?php echo $cod_compra_producto_temporal;?>" value="<?php echo $iva_ptj;?>" style="width: 40px;" /></td>
<?php if ($cod_estado_ptj_comision_global == '1') { ?>
<td style="text-align:center;"><input name="comision_ptj" type="text" id="comision_ptj<?php echo $incre;?>" class="<?php echo $cod_compra_producto_temporal;?>" value="<?php echo $comision_ptj;?>" style="width: 30px;" /></td>
<?php } ?>

<?php if ($cod_estado_impoconsumo_global == '1') { ?>
<td style="text-align:center;"><input name="precio_ipc" type="text" id="precio_ipc<?php echo $incre;?>" class="<?php echo $cod_compra_producto_temporal;?>" value="<?php echo $precio_ipc;?>" style="width: 100px;" /></td>
<?php } ?>

<?php if ($cod_estado_ganancia_ptj_global  == '1') { ?>
<td style="text-align:center;"><input name="ganancia_ptj" type="text" id="ganancia_ptj<?php echo $incre;?>" class="<?php echo $cod_compra_producto_temporal;?>" value="<?php echo $ganancia_ptj;?>" style="width: 30px;" /></td>
<?php } ?>

<?php for ($i=1; $i <= $numero_precio; $i++) { $contador = 1; $precio_ventas = 0; 
if ($i==1) { $contador = ""; $precio_ventas = $precio_venta_producto; } elseif ($i==2) { $contador = $i; $precio_ventas = $precio_venta_producto2; } elseif ($i==3) { $contador = $i; $precio_ventas = $precio_venta_producto3;
} elseif ($i==4) { $contador = $i; $precio_ventas = $precio_venta_producto4; } elseif ($i==5) { $contador = $i; $precio_ventas = $precio_venta_producto5; } else { $contador = ""; $precio_ventas = $precio_venta_producto; } ?>
<td style="text-align:center;"><input name="precio_venta_producto<?php echo $contador; ?>" type="text" id="precio_venta_producto<?php echo $incre;?>" class="<?php echo $cod_compra_producto_temporal;?>" value="<?php echo $precio_ventas;?>" style="width: 55px;" /></td>
<?php } ?>

<?php if ($cod_estado_peso_producto_global  == '1') { ?>
<td style="text-align:center;"><input name="peso_producto" type="text" id="peso_producto<?php echo $incre;?>" class="<?php echo $cod_compra_producto_temporal;?>" value="<?php echo $peso_producto;?>" style="width: 30px;" /></td>
<?php } ?>

<?php if ($cod_estado_cajas_sobre_global  == '1') { ?>
<td style="text-align:center;"><input name="cajas_sobre" type="text" id="cajas_sobre<?php echo $incre;?>" class="<?php echo $cod_compra_producto_temporal;?>" value="<?php echo $cajas_sobre;?>" style="width: 30px;" /></td>
<?php } ?>

<?php if ($cod_estado_und_sobre_global  == '1') { ?>
<td style="text-align:center;"><input name="und_sobre" type="text" id="und_sobre<?php echo $incre;?>" class="<?php echo $cod_compra_producto_temporal;?>" value="<?php echo $und_sobre;?>" style="width: 30px;" /></td>
<?php } ?>

<?php if ($cod_estado_dependencia_global  == '1') { ?>
<td style="text-align:center;">
<select name="cod_dependencia" id="<?php echo $cod_compra_producto_temporal;?>" class="<?php echo $cod_compra_producto_temporal;?>" style="width: 70px;">
<?php if (isset($cod_dependencia)) { echo "<option value='' >Selecione</option>";
} else { echo  "<option value='' selected >Selecione</option>"; }
$sql_consulta2 = "SELECT cod_dependencia, nombre_dependencia FROM tbl15_dependencia ORDER BY cod_dependencia ASC";
$consulta2 = mysqli_query($conectar, $sql_consulta2);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($cod_dependencia) and $cod_dependencia == $datos2['cod_dependencia']) {
$seleccionado = "selected";
} else { $seleccionado = ""; }
$codigo = $datos2['cod_dependencia'];
$nombre = $datos2['nombre_dependencia'];
echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
</td>
<?php } ?>

<?php if ($cod_estado_fecha_vencimiento_global == '1') { ?>
<td style="text-align:center;"><input name="fecha_vencimiento" type="date" id="fecha_vencimiento<?php echo $incre;?>" class="<?php echo $cod_compra_producto_temporal;?>" value="<?php echo $fecha_vencimiento;?>" style="width: 130px;" /></td>
<td style="text-align:center;"><input name="lote_vencimiento" type="text" id="lote_vencimiento<?php echo $incre;?>" class="<?php echo $cod_compra_producto_temporal;?>" value="<?php echo $lote_vencimiento;?>" style="width: 50px;" /></td>
<?php } ?>
<?php if ($cod_estado_fecha_mantenimiento_global == '1') { ?>
<td style="text-align:center;"><input name="fecha_mantenimiento" type="date" id="fecha_mantenimiento<?php echo $incre;?>" class="<?php echo $cod_compra_producto_temporal;?>" value="<?php echo $fecha_mantenimiento;?>" style="width: 130px;" /></td>
<td style="text-align:center;"><input name="meses_mantenimiento" type="number" id="meses_mantenimiento<?php echo $incre;?>" class="<?php echo $cod_compra_producto_temporal;?>" value="<?php echo $meses_mantenimiento;?>" style="width: 40px;" /></td>
<?php } ?>

<?php if ($cod_estado_meses_garantia_global  == '1') { ?>
<td style="text-align:center;"><input name="meses_garantia" type="number" id="meses_garantia<?php echo $incre;?>" class="<?php echo $cod_compra_producto_temporal;?>" value="<?php echo $meses_garantia;?>" style="width: 40px;" /></td>
<?php } ?>

<td style="text-align:right;" id="total_compra_producto<?php echo $incre;?>"><?php echo number_format($total_compra_producto, 0, ",", ".");?></td>
<td style="text-align:center;" id="btn_listo<?php echo $incre;?>"><a href="<?php $_SERVER['PHP_SELF']?>"><?php echo $imagen;?></a></td>
<th style="text-align:center;"></th>
</tr style="text-align:right;" id="tr<?php echo $cod_compra_producto_temporal;?>">
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

 <script>  
 $(document).ready(function(){  

  $('select[name="nombre_tipo_unidad_medida"]').change(function(){ 
  var nombre_tipo_unidad_medida = $(this).val();  
  let id = this.id;
  var tipo_ajax = "tbl15_compra_producto_temporal";
    $.ajax({ url:"guardar_info_factura_y_compra_producto_temporal_ajax.php", method:"GET", data:{valor:nombre_tipo_unidad_medida, campo:"nombre_tipo_unidad_medida", tipo_ajax:tipo_ajax, id:id }, success:function(data){ $('#result').html(data); }  
    });  
  });
 });  
 </script>

 <script>  
 $(document).ready(function(){  

  $('select[name="cod_dependencia"]').change(function(){ 
  var cod_dependencia = $(this).val();  
  let id = this.id;
  var tipo_ajax = "tbl15_compra_producto_temporal";
    $.ajax({ url:"guardar_info_factura_y_compra_producto_temporal_ajax.php", method:"GET", data:{valor:cod_dependencia, campo:"cod_dependencia", tipo_ajax:tipo_ajax, id:id }, success:function(data){ $('#result').html(data); }  
    });  
  });
 });  
 </script>

 <script>  
 $(document).ready(function(){  

  $('textarea[name="nombre_producto"]').change(function(){ 
  var nombre_producto = $(this).val();  
  //let id = this.id;
  var id = $(this).attr("class");
  var tipo_ajax = "tbl15_compra_producto_temporal";

    $.ajax({ url:"guardar_info_factura_y_compra_producto_temporal_ajax.php", method:"GET", data:{valor:nombre_producto, campo:"nombre_producto", tipo_ajax:tipo_ajax, id:id }, success:function(data){ $('#result').html(data); }  
    });  
  });
 });  
 </script>

</body>
</html>