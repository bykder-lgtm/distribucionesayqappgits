<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
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
$tab                               = 'tbl15_transferencia_bodega_producto_temporal';
$campo                             = 'cod_transferencia_bodega_producto_temporal';
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

$datos_factura = "SELECT cod_transferencia_bodega_producto_temporal FROM tbl15_transferencia_bodega_producto_temporal WHERE (cuenta = '$cuenta_actual') AND (cod_caja_virtual = '$cod_caja_virtual')";
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
xmlhttp.open("POST","../admin/busqueda_inmediata_transferencia_bodega_producto_php.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("buscar="+valor_buscar+"&buscar_por="+buscar_por+"&nombre_tipo_moneda="+nombre_tipo_moneda+"&nombre_tipo_factura="+nombre_tipo_factura+"&tipo_busqueda="+tipo_busqueda+"&cod_estado_vacuna="+cod_estado_vacuna+"&pagina="+pagina);
}
</script>

<div class="table-responsive">

<table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; width:100%">
    <tbody><tr>
        <td bgcolor="#fff" align="center"><strong><a href="../admin/lista_info_factura_trasnferencia_bodega.php">LISTA DE TRANSFRENCIAS</a></strong></td>
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
            <strong>Transfrencia Manual: [<?php echo $cod_caja_virtual ?>]<input type="text" id="busqueda" name="busqueda" onkeyup="hacer_busqueda()" style="height:40" placeholder="Buscar"/><input type="hidden" id="pagina" name="pagina" value="<?php echo $pagina_local ?>"/></strong><div id="logo_cargador"></div>
            </td>
    	</tr>
    </tbody>
</table>
<!-- ***************************************************************************************************************************** -->
<?php include_once('../admin/info_factura_transferencia_bodega_pos.php'); ?>
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
<th style="text-align:center;">MED</th>
<?php if ($cod_estado_und_inv_ventatemp == '1') { ?><th style="text-align:center;">INV</th><?php } ?>

<!--
<th style="text-align:center;">VALOR COMPRA</th>
<th style="text-align:center;">VALOR VENTA</th>
-->
<th style="text-align:center;">OK</th>
<td style="text-align:center;"></td>
</tr>
</thead>
<tbody>
<?php
$sql_transferencia_bodega_producto_temporal = "SELECT * FROM tbl15_transferencia_bodega_producto_temporal WHERE (cuenta = '$cuenta_actual') AND (cod_caja_virtual = '$cod_caja_virtual') 
ORDER BY cod_transferencia_bodega_producto_temporal DESC";
$consulta_transferencia_bodega_producto_temporal = mysqli_query($conectar, $sql_transferencia_bodega_producto_temporal);
while ($datos_transferencia_bodega_producto_temporal = mysqli_fetch_assoc($consulta_transferencia_bodega_producto_temporal)) {

$cod_transferencia_bodega_producto_temporal       = $datos_transferencia_bodega_producto_temporal['cod_transferencia_bodega_producto_temporal'];
$cod_producto                                     = $datos_transferencia_bodega_producto_temporal['cod_producto'];
$cod_producto_barra                               = $datos_transferencia_bodega_producto_temporal['cod_producto_barra'];
$nombre_producto                                  = $datos_transferencia_bodega_producto_temporal['nombre_producto'];
$cedula                                           = $datos_transferencia_bodega_producto_temporal['cedula'];
$nombre_cliente                                   = $datos_transferencia_bodega_producto_temporal['nombre_cliente'];
$und_venta                                        = $datos_transferencia_bodega_producto_temporal['und_venta'];
$precio_compra_producto                           = $datos_transferencia_bodega_producto_temporal['precio_compra_producto'];
$total_costo_producto                             = $datos_transferencia_bodega_producto_temporal['total_costo_producto'];
$precio_venta_producto                            = $datos_transferencia_bodega_producto_temporal['precio_venta_producto'];
$total_venta_producto                             = $datos_transferencia_bodega_producto_temporal['total_venta_producto'];
$nombre_tipo_producto                             = $datos_transferencia_bodega_producto_temporal['nombre_tipo_producto'];
$nombre_tipo_unidad_medida                        = $datos_transferencia_bodega_producto_temporal['nombre_tipo_unidad_medida'];
$posologia_cantidad                               = $datos_transferencia_bodega_producto_temporal['posologia_cantidad'];
$posologia_peso                                   = $datos_transferencia_bodega_producto_temporal['posologia_peso'];
$nombre_tipo_presentacion                         = $datos_transferencia_bodega_producto_temporal['nombre_tipo_presentacion'];
$nombre_via_administracion                        = $datos_transferencia_bodega_producto_temporal['nombre_via_administracion'];
$nombre_frec_duracion                             = $datos_transferencia_bodega_producto_temporal['nombre_frec_duracion'];
$cod_tipo_cobrar                                  = $datos_transferencia_bodega_producto_temporal['cod_tipo_cobrar'];
$cod_info_factura_transferencia_bodega            = $datos_transferencia_bodega_producto_temporal['cod_info_factura_transferencia_bodega'];
$nombre_tipo_precio_venta                         = $datos_transferencia_bodega_producto_temporal['nombre_tipo_precio_venta'];
$cod_estado_permitir_venta                        = $datos_transferencia_bodega_producto_temporal['cod_estado_permitir_venta'];
$und_producto                                     = $datos_transferencia_bodega_producto_temporal['und_producto'];

if ($cod_tipo_sistema_numeracion_und_compra == '2') { $und_venta = intval($und_venta); } else { $und_venta = $und_venta; }
if ($cod_tipo_sistema_numeracion_precio_compra == '2') { $precio_compra_producto = intval($precio_compra_producto); } else { $precio_compra_producto = $precio_compra_producto; }
if ($cod_tipo_sistema_numeracion_precio_venta == '2') { $precio_venta_producto = intval($precio_venta_producto); } else { $precio_venta_producto = $precio_venta_producto; }

if ($cod_estado_permitir_venta == 1) { $imagen = '<img src=../imagenes/incorrecto.png alt="Listo">'; } else { $imagen = '<img src=../imagenes/correctok.png alt="Listo">'; }

$incre++;
?>
<tr style="text-align:center;" id="tr<?php echo $cod_transferencia_bodega_producto_temporal;?>">
<td style="text-align:center;"></td>
<td  style="text-align:center;"><a href="../admin/eliminar.php?llave=<?php echo $cod_transferencia_bodega_producto_temporal?>&tab=<?php echo $tab ?>&tipo=<?php echo $tipo ?>&campo=<?php echo $campo ?>&pagina=<?php echo $pagina_local ?>"><img src="../imagenes/eliminar.png" class="img-polaroid" alt=""></a></td>
<!--<td style="text-align:center"><input name="cod_tipo_cobrar" class="cod_tipo_cobrar__<?php echo $cod_transferencia_bodega_producto_temporal;?>" id="cod_tipo_cobrar_<?php echo $cod_transferencia_bodega_producto_temporal;?>" type="checkbox" value="1" <?php if($cod_tipo_cobrar=='1'){ echo "checked"; } ?>></td>-->
<!--<td style="text-align:center;" id="cod_transferencia_bodega_producto_temporal_<?php echo $cod_transferencia_bodega_producto_temporal ?>" class="service_list" data="<?php echo $cod_transferencia_bodega_producto_temporal ?>"><a class="eliminar" id="cod_transferencia_bodega_producto_temporal<?php echo $cod_transferencia_bodega_producto_temporal ?>"><img src="../imagenes/eliminar.png" class="img-polaroid" alt=""></a></td>-->
<td style="text-align:center;" id="cod_producto_barra_<?php echo $incre;?>"><?php echo $cod_producto_barra ?></td>
<td style="text-align:left;"  id="nombre_producto_<?php echo $incre;?>"><?php echo $nombre_producto ?></td>
<td style="text-align:center;" id="und_venta_<?php echo $incre;?>"><input name="und_venta" type="number" id="und_venta<?php echo $incre;?>" class="<?php echo $cod_transferencia_bodega_producto_temporal;?>" value="<?php echo $und_venta;?>" min="1" max="<?php echo $und_producto;?>" lang="en" oninput="validity.valid||(value='');" style="width: 70px;" /></td>

<td style="text-align:center;">
<select name="nombre_tipo_unidad_medida" id="<?php echo $cod_transferencia_bodega_producto_temporal;?>" class="<?php echo $cod_transferencia_bodega_producto_temporal;?>" style="width: 70px;">
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
<?php if ($cod_estado_und_inv_ventatemp == '1') { ?><td style="text-align:center;"><?php echo $und_producto;?></td><?php } ?>

<!--
<td style="text-align:right;" id="precio_venta_producto_<?php echo $incre;?>"><?php echo number_format($precio_compra_producto, 0, ",", "."); ?></td>
<td style="text-align:right;" id="precio_venta_producto_<?php echo $incre;?>"><?php echo number_format($precio_venta_producto, 0, ",", "."); ?></td>
-->
<td style="text-align:center;" id="btn_listo<?php echo $incre;?>"><a href="<?php $_SERVER['PHP_SELF']?>"><?php echo $imagen;?></a></td>
<td style="text-align:center;"></td>
</tr style="text-align:right;" id="tr<?php echo $cod_transferencia_bodega_producto_temporal;?>">
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

<script type="text/javascript">
$(document).ready(function() {

    $('.eliminar').click(function(){

        var parent = $(this).parent().attr('id');
        var cod_transferencia_bodega_producto_temporal = $(this).parent().attr('data');
        var dataString = 'llave='+cod_transferencia_bodega_producto_temporal+'&'+'tab='+'<?php echo $tab ?>'+'&'+'campo='+'<?php echo $campo ?>'+'&'+'tipo='+'<?php echo $tipo ?>';

        $.ajax({
            type: "POST",
            url: "../admin/eliminar_ajax.php",
            data: dataString,
            success: function() {           
                $('#eliminar-ok').empty();
                $('#eliminar-ok').append('<div align="center" class="correcto">Se ha eliminado correctamente el codigo = '+cod_transferencia_bodega_producto_temporal+'.</div>').fadeIn("slow");
                $('#'+parent).fadeOut("slow");
                $('#cod_transferencia_bodega_producto_temporal'+cod_transferencia_bodega_producto_temporal).fadeOut("slow");
                $('#cod_producto_barra_'+cod_transferencia_bodega_producto_temporal).fadeOut("slow");
                $('#nombre_cliente_'+cod_transferencia_bodega_producto_temporal).fadeOut("slow");
                $('#nombre_producto_'+cod_transferencia_bodega_producto_temporal).fadeOut("slow");
                $('#und_venta_'+cod_transferencia_bodega_producto_temporal).fadeOut("slow");
                $('#precio_venta_producto_'+cod_transferencia_bodega_producto_temporal).fadeOut("slow");
                $('#mensaje_alerta_'+cod_transferencia_bodega_producto_temporal).fadeOut("slow");
                $('#total_venta_producto_'+cod_transferencia_bodega_producto_temporal).fadeOut("slow");
                $('#nombre_tipo_unidad_medida_'+cod_transferencia_bodega_producto_temporal).fadeOut("slow");
                $('#nombre_frec_duracion_'+cod_transferencia_bodega_producto_temporal).fadeOut("slow");
                $('#tr'+cod_transferencia_bodega_producto_temporal).fadeOut("slow");
            }
        });

    });

});
</script>

 <script>  
 $(document).ready(function(){  

  $('select[name="nombre_tipo_unidad_medida"]').change(function(){ 
  var nombre_tipo_unidad_medida = $(this).val();  
  let id = this.id;
  var tipo_ajax = "tbl15_transferencia_bodega_producto_temporal";
    $.ajax({ url:"guardar_info_factura_transferencia_bodega_temporal_producto_ajax.php", method:"GET", data:{valor:nombre_tipo_unidad_medida, campo:"nombre_tipo_unidad_medida", tipo_ajax:tipo_ajax, id:id }, success:function(data){ $('#result').html(data); }  
    });  
  });
 });  
 </script>

</body>
</html>