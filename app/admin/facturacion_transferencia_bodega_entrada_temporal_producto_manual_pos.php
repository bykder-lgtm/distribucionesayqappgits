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
$tab                               = 'tbl15_transferencia_bodega_entrada_producto_temporal';
$campo                             = 'cod_transferencia_bodega_entrada_producto_temporal';
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

$datos_factura = "SELECT cod_transferencia_bodega_entrada_producto_temporal FROM tbl15_transferencia_bodega_entrada_producto_temporal WHERE (cod_info_factura_transferencia_bodega_entrada = '$cod_info_factura_transferencia_bodega_entrada')";
$consulta = mysqli_query($conectar, $datos_factura);
$total_datos = mysqli_num_rows($consulta);
?>

<script language="javascript">
$(document).ready(function(){
    $("input").on('change', function () {
            var valor = $(this).val();
            var campo = $(this).attr("name");
            var tipo_ajax = "tbl15_transferencia_bodega_entrada_producto_temporal";
            var id = $(this).attr("class");
            //let id = this.id;
            $.post("guardar_info_factura_transferencia_bodega_entrada_producto_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:id }, function(data){
                $("#error_identificacion_repetida").html(data);
        });
   });
});
</script>
<input type="hidden" id="pagina" value="<?php echo $pagina_local ?>">

<div class="table-responsive">

<table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; width:100%">
    <tbody><tr>
        <td bgcolor="#fff" align="center"><strong><a href="../admin/importar_archivo_csv_transferencia_bodega_entrada_xlsx_ajax.php">LISTA DE TRANSFRENCIAS ENTRADA</a></strong></td>
    </tr></tbody>
</table>
<br>
<!-- ***************************************************************************************************************************** -->
<?php include_once('../admin/info_factura_transferencia_bodega_entrada_pos.php'); ?>
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php if ($total_datos <> 0) { ?>

<table class="table table-striped" border="1" cellspacing="0" cellpadding="20">
    <thead>
        <tr>
            <td style="text-align:center;"></td>
            <?php if ($cod_estado_existe_producto_factura_compra_global == '1') { ?>
            <th style="text-align:center;">...</th>
            <?php } ?>
            <th style="text-align:center;">CODIGO</th>
            <th style="text-align:center;">NOMBRE CONCEPTO</th>
            <th style="text-align:center;">CANTIDAD</th>
            
            <?php if ($cod_estado_promediar_precio_compra_y_venta_cargar_factura_global == '1') { ?>
            <th style="text-align:center;">PRECIO COMPRA PROMEDIO</th>
            <?php } ?>
            <?php if ($cod_estado_prod_transferencia_extern_editar == '1') { ?><th style="text-align:center;">VALOR VENTA</th><?php } ?>
            <td style="text-align:center;"></td>
        </tr>
    </thead>
    <tbody>
<?php
$sql_transferencia_bodega_entrada_producto_temporal = "SELECT * FROM tbl15_transferencia_bodega_entrada_producto_temporal WHERE (cod_info_factura_transferencia_bodega_entrada = '$cod_info_factura_transferencia_bodega_entrada') 
ORDER BY cod_transferencia_bodega_entrada_producto_temporal DESC";
$consulta_transferencia_bodega_entrada_producto_temporal = mysqli_query($conectar, $sql_transferencia_bodega_entrada_producto_temporal);
while ($datos_transferencia_bodega_entrada_producto_temporal = mysqli_fetch_assoc($consulta_transferencia_bodega_entrada_producto_temporal)) {

    $cod_transferencia_bodega_entrada_producto_temporal       = $datos_transferencia_bodega_entrada_producto_temporal['cod_transferencia_bodega_entrada_producto_temporal'];
    $cod_producto                                             = $datos_transferencia_bodega_entrada_producto_temporal['cod_producto'];
    $cod_producto_barra                                       = $datos_transferencia_bodega_entrada_producto_temporal['cod_producto_barra'];
    $nombre_producto                                          = $datos_transferencia_bodega_entrada_producto_temporal['nombre_producto'];
    $cedula                                                   = $datos_transferencia_bodega_entrada_producto_temporal['cedula'];
    $nombre_cliente                                           = $datos_transferencia_bodega_entrada_producto_temporal['nombre_cliente'];
    $und_venta                                                = $datos_transferencia_bodega_entrada_producto_temporal['und_venta'];
    $precio_compra_producto                                   = $datos_transferencia_bodega_entrada_producto_temporal['precio_compra_producto'];
    $total_costo_producto                                     = $datos_transferencia_bodega_entrada_producto_temporal['total_costo_producto'];
    $precio_venta_producto                                    = $datos_transferencia_bodega_entrada_producto_temporal['precio_venta_producto'];
    $total_venta_producto                                     = $datos_transferencia_bodega_entrada_producto_temporal['total_venta_producto'];
    $nombre_tipo_producto                                     = $datos_transferencia_bodega_entrada_producto_temporal['nombre_tipo_producto'];
    $nombre_tipo_unidad_medida                                = $datos_transferencia_bodega_entrada_producto_temporal['nombre_tipo_unidad_medida'];
    $nombre_tipo_precio_venta                                 = $datos_transferencia_bodega_entrada_producto_temporal['nombre_tipo_precio_venta'];
    $precio_compra_producto_promedio                          = $datos_transferencia_bodega_entrada_producto_temporal['precio_compra_producto_promedio'];

    $sql_producto = "SELECT cod_producto, cod_producto_barra FROM tbl15_producto WHERE cod_producto_barra = '$cod_producto_barra'";
    $consulta_producto = mysqli_query($conectar, $sql_producto) or die(mysqli_error($conectar));
    $existe_producto = mysqli_num_rows($consulta_producto);

    $incre++;
?>
        <tr style="text-align:center;" id="tr<?php echo $cod_transferencia_bodega_entrada_producto_temporal;?>">
            <td style="text-align:center;"></td>
            <?php if ($cod_estado_existe_producto_factura_compra_global == '1') { ?>
            <?php if ($existe_producto == '0') { ?> <td style="text-align:center;"><a href="../admin/registrar_producto_desde_transferencia_bodega_entrada_temporal_producto_reg.php?cod_transferencia_bodega_entrada_producto_temporal=<?php echo $cod_transferencia_bodega_entrada_producto_temporal?>&cod_info_factura_transferencia_bodega_entrada=<?php echo $cod_info_factura_transferencia_bodega_entrada ?>&pagina=<?php echo $pagina_local ?>"><img src="../imagenes/advertencia1.gif" alt="advertencia"></a></td><?php } else { ?> <td style="text-align:center;"><img src="../imagenes/bien.png" alt="bien"></td><?php } ?>
            <?php } ?>
            <td style="text-align:center;" id="cod_producto_barra_<?php echo $incre;?>"><?php echo $cod_producto_barra ?></td>
            <td style="text-align:left;"  id="nombre_producto_<?php echo $incre;?>"><?php echo $nombre_producto ?></td>
            <td style="text-align:center;"  id="nombre_producto_<?php echo $incre;?>"><?php echo $und_venta ?></td>

            <?php if ($cod_estado_promediar_precio_compra_y_venta_cargar_factura_global == '1') { ?>
            <td style="text-align:center;"><?php echo number_format($precio_compra_producto_promedio, 0, ",", ".") ?></td>
            <?php } ?>

            <?php if ($cod_estado_prod_transferencia_extern_editar == '1') { ?><td style="text-align:center;" id="precio_venta_producto<?php echo $incre;?>"><input name="precio_venta_producto" type="number" id="precio_venta_producto<?php echo $incre;?>" class="<?php echo $cod_transferencia_bodega_entrada_producto_temporal;?>" value="<?php echo $precio_venta_producto;?>" min="1" style="width: 100px;" /></td><?php } ?>
            <td style="text-align:center;"></td>
        </tr style="text-align:right;" id="tr<?php echo $cod_transferencia_bodega_entrada_producto_temporal;?>">
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
        var cod_transferencia_bodega_entrada_producto_temporal = $(this).parent().attr('data');
        var dataString = 'llave='+cod_transferencia_bodega_entrada_producto_temporal+'&'+'tab='+'<?php echo $tab ?>'+'&'+'campo='+'<?php echo $campo ?>'+'&'+'tipo='+'<?php echo $tipo ?>';

        $.ajax({
            type: "POST",
            url: "../admin/eliminar_ajax.php",
            data: dataString,
            success: function() {           
                $('#eliminar-ok').empty();
                $('#eliminar-ok').append('<div align="center" class="correcto">Se ha eliminado correctamente el codigo = '+cod_transferencia_bodega_entrada_producto_temporal+'.</div>').fadeIn("slow");
                $('#'+parent).fadeOut("slow");
                $('#cod_transferencia_bodega_entrada_producto_temporal'+cod_transferencia_bodega_entrada_producto_temporal).fadeOut("slow");
                $('#cod_producto_barra_'+cod_transferencia_bodega_entrada_producto_temporal).fadeOut("slow");
                $('#nombre_cliente_'+cod_transferencia_bodega_entrada_producto_temporal).fadeOut("slow");
                $('#nombre_producto_'+cod_transferencia_bodega_entrada_producto_temporal).fadeOut("slow");
                $('#und_venta_'+cod_transferencia_bodega_entrada_producto_temporal).fadeOut("slow");
                $('#precio_venta_producto_'+cod_transferencia_bodega_entrada_producto_temporal).fadeOut("slow");
                $('#mensaje_alerta_'+cod_transferencia_bodega_entrada_producto_temporal).fadeOut("slow");
                $('#total_venta_producto_'+cod_transferencia_bodega_entrada_producto_temporal).fadeOut("slow");
                $('#nombre_tipo_unidad_medida_'+cod_transferencia_bodega_entrada_producto_temporal).fadeOut("slow");
                $('#nombre_frec_duracion_'+cod_transferencia_bodega_entrada_producto_temporal).fadeOut("slow");
                $('#tr'+cod_transferencia_bodega_entrada_producto_temporal).fadeOut("slow");
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
  var tipo_ajax = "tbl15_transferencia_bodega_entrada_producto_temporal";
    $.ajax({ url:"guardar_info_factura_transferencia_bodega_temporal_producto_ajax.php", method:"GET", data:{valor:nombre_tipo_unidad_medida, campo:"nombre_tipo_unidad_medida", tipo_ajax:tipo_ajax, id:id }, success:function(data){ $('#result').html(data); }  
    });  
  });
 });  
 </script>

</body>
</html>