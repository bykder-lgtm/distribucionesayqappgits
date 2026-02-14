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
if (isset($_GET['cod_info_factura_transferencia_bodega_entrada'])) { $cod_info_factura_transferencia_bodega_entrada = intval($_GET['cod_info_factura_transferencia_bodega_entrada']); } else { $cod_info_factura_transferencia_bodega_entrada = '0'; }

$pagina                            = $_SERVER['PHP_SELF'];
$pagina_local                      = $_SERVER['PHP_SELF'];
$incre                             = 0;
$tab                               = 'tbl15_transferencia_bodega_entrada_producto';
$campo                             = 'cod_transferencia_bodega_entrada_producto';
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

$datos_factura = "SELECT cod_transferencia_bodega_entrada_producto FROM tbl15_transferencia_bodega_entrada_producto WHERE (cod_info_factura_transferencia_bodega_entrada = '$cod_info_factura_transferencia_bodega_entrada')";
$consulta = mysqli_query($conectar, $datos_factura);
$total_datos = mysqli_num_rows($consulta);
?>
<input type="hidden" id="pagina" value="<?php echo $pagina_local ?>">

<div class="table-responsive">

<table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; width:100%">
    <tbody><tr>
        <td bgcolor="#fff" align="center"><strong><a href="../admin/lista_info_factura_trasnferencia_bodega.php">LISTA DE TRANSFRENCIAS ENTRADA</a></strong></td>
    </tr></tbody>
</table>
<br>
<!-- ***************************************************************************************************************************** -->
<?php include_once('../admin/info_factura_transferencia_bodega_entrada_bodega_pos.php'); ?>
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php if ($total_datos <> 0) { ?>

<table class="table table-striped" border="1" cellspacing="0" cellpadding="20">
<thead>
<tr>
<td style="text-align:center;"></td>
<!--<th style="text-align:center;">COBRAR</th>-->
<th style="text-align:center;">CODIGO</th>
<th style="text-align:center;">NOMBRE CONCEPTO</th>
<th style="text-align:center;">CANTIDAD</th>
<!--
<th style="text-align:center;">VALOR COMPRA</th>
<th style="text-align:center;">VALOR VENTA</th>
-->
<td style="text-align:center;"></td>
</tr>
</thead>
<tbody>
<?php
$sql_transferencia_bodega_entrada_producto = "SELECT * FROM tbl15_transferencia_bodega_entrada_producto WHERE (cod_info_factura_transferencia_bodega_entrada = '$cod_info_factura_transferencia_bodega_entrada') 
ORDER BY cod_transferencia_bodega_entrada_producto DESC";
$consulta_transferencia_bodega_entrada_producto = mysqli_query($conectar, $sql_transferencia_bodega_entrada_producto);
while ($datos_transferencia_bodega_entrada_producto = mysqli_fetch_assoc($consulta_transferencia_bodega_entrada_producto)) {

$cod_transferencia_bodega_entrada_producto       = $datos_transferencia_bodega_entrada_producto['cod_transferencia_bodega_entrada_producto'];
$cod_producto                                    = $datos_transferencia_bodega_entrada_producto['cod_producto'];
$cod_producto_barra                              = $datos_transferencia_bodega_entrada_producto['cod_producto_barra'];
$nombre_producto                                 = $datos_transferencia_bodega_entrada_producto['nombre_producto'];
$cedula                                          = $datos_transferencia_bodega_entrada_producto['cedula'];
$nombre_cliente                                  = $datos_transferencia_bodega_entrada_producto['nombre_cliente'];
$und_venta                                       = $datos_transferencia_bodega_entrada_producto['und_venta'];
$precio_compra_producto                          = $datos_transferencia_bodega_entrada_producto['precio_compra_producto'];
$total_costo_producto                            = $datos_transferencia_bodega_entrada_producto['total_costo_producto'];
$precio_venta_producto                           = $datos_transferencia_bodega_entrada_producto['precio_venta_producto'];
$total_venta_producto                            = $datos_transferencia_bodega_entrada_producto['total_venta_producto'];
$nombre_tipo_producto                            = $datos_transferencia_bodega_entrada_producto['nombre_tipo_producto'];
$nombre_tipo_unidad_medida                       = $datos_transferencia_bodega_entrada_producto['nombre_tipo_unidad_medida'];
$nombre_tipo_precio_venta                        = $datos_transferencia_bodega_entrada_producto['nombre_tipo_precio_venta'];

$incre++;
?>
<tr style="text-align:center;" id="tr<?php echo $cod_transferencia_bodega_entrada_producto;?>">
<td style="text-align:center;"></td>
<!--<td style="text-align:center"><input name="cod_tipo_cobrar" class="cod_tipo_cobrar__<?php echo $cod_transferencia_bodega_entrada_producto;?>" id="cod_tipo_cobrar_<?php echo $cod_transferencia_bodega_entrada_producto;?>" type="checkbox" value="1" <?php if($cod_tipo_cobrar=='1'){ echo "checked"; } ?>></td>-->
<!--<td style="text-align:center;" id="cod_transferencia_bodega_entrada_producto_<?php echo $cod_transferencia_bodega_entrada_producto ?>" class="service_list" data="<?php echo $cod_transferencia_bodega_entrada_producto ?>"><a class="eliminar" id="cod_transferencia_bodega_entrada_producto<?php echo $cod_transferencia_bodega_entrada_producto ?>"><img src="../imagenes/eliminar.png" class="img-polaroid" alt=""></a></td>-->
<td style="text-align:center;" id="cod_producto_barra_<?php echo $incre;?>"><?php echo $cod_producto_barra ?></td>
<td style="text-align:left;"  id="nombre_producto_<?php echo $incre;?>"><?php echo $nombre_producto ?></td>
<td style="text-align:center;"  id="nombre_producto_<?php echo $incre;?>"><?php echo $und_venta ?></td>
<!--
<td style="text-align:right;" id="precio_venta_producto_<?php echo $incre;?>"><?php echo number_format($precio_compra_producto, 0, ",", "."); ?></td>
<td style="text-align:right;" id="precio_venta_producto_<?php echo $incre;?>"><?php echo number_format($precio_venta_producto, 0, ",", "."); ?></td>
-->
<td style="text-align:center;"></td>
</tr style="text-align:right;" id="tr<?php echo $cod_transferencia_bodega_entrada_producto;?>">
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
        var cod_transferencia_bodega_entrada_producto = $(this).parent().attr('data');
        var dataString = 'llave='+cod_transferencia_bodega_entrada_producto+'&'+'tab='+'<?php echo $tab ?>'+'&'+'campo='+'<?php echo $campo ?>'+'&'+'tipo='+'<?php echo $tipo ?>';

        $.ajax({
            type: "POST",
            url: "../admin/eliminar_ajax.php",
            data: dataString,
            success: function() {           
                $('#eliminar-ok').empty();
                $('#eliminar-ok').append('<div align="center" class="correcto">Se ha eliminado correctamente el codigo = '+cod_transferencia_bodega_entrada_producto+'.</div>').fadeIn("slow");
                $('#'+parent).fadeOut("slow");
                $('#cod_transferencia_bodega_entrada_producto'+cod_transferencia_bodega_entrada_producto).fadeOut("slow");
                $('#cod_producto_barra_'+cod_transferencia_bodega_entrada_producto).fadeOut("slow");
                $('#nombre_cliente_'+cod_transferencia_bodega_entrada_producto).fadeOut("slow");
                $('#nombre_producto_'+cod_transferencia_bodega_entrada_producto).fadeOut("slow");
                $('#und_venta_'+cod_transferencia_bodega_entrada_producto).fadeOut("slow");
                $('#precio_venta_producto_'+cod_transferencia_bodega_entrada_producto).fadeOut("slow");
                $('#mensaje_alerta_'+cod_transferencia_bodega_entrada_producto).fadeOut("slow");
                $('#total_venta_producto_'+cod_transferencia_bodega_entrada_producto).fadeOut("slow");
                $('#nombre_tipo_unidad_medida_'+cod_transferencia_bodega_entrada_producto).fadeOut("slow");
                $('#nombre_frec_duracion_'+cod_transferencia_bodega_entrada_producto).fadeOut("slow");
                $('#tr'+cod_transferencia_bodega_entrada_producto).fadeOut("slow");
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
  var tipo_ajax = "tbl15_transferencia_bodega_entrada_producto";
    $.ajax({ url:"guardar_info_factura_transferencia_bodega_temporal_producto_ajax.php", method:"GET", data:{valor:nombre_tipo_unidad_medida, campo:"nombre_tipo_unidad_medida", tipo_ajax:tipo_ajax, id:id }, success:function(data){ $('#result').html(data); }  
    });  
  });
 });  
 </script>

</body>
</html>