<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="../js/qrcode.js"></script>

<link rel="stylesheet" type="text/css" href="../estilo_css/area_imprimible_invisible.css">
</head>
<body id="pageBody">
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php //$pagina = addslashes($_GET['pagina']); ?>
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">

<div class="breadcrumbs">
</div>
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<table class="table table-striped">
    <tr>
        <th style="text-align:left"><a href="#"><font size='+1'>Lista de Subproductos</font></a></th>
        <th style="text-align:right"><a href="../admin/reg_cargar_subproducto_principal.php"><font size='+1'>Registrar Subproductos</font></a></th>
    </tr>
</table>
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<script language="javascript">
$(document).ready(function(){
    $("input").on('change', function () {
            var valor = $(this).val();
            var campo = $(this).attr("name");
            var tipo_ajax = "tbl15_subproducto";
            var id = $(this).attr("class");
            //let id = this.id;
            $.post("guardar_subproducto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:id }, function(data){
                $("#error_identificacion_repetida").html(data);
        });
   });
});
</script>

<?php
$pagina_local        = $_SERVER['PHP_SELF'];
$pagina              = $_SERVER['PHP_SELF'];
$tab                 = 'tbl15_subproducto';
$tipo                = 'eliminar';
$campo               = 'cod_subproducto';

$obtener_producto_principal = "SELECT * FROM tbl15_info_factura_subproducto ORDER BY cod_info_factura_subproducto DESC";
$resultado_producto_principal = mysqli_query($conectar, $obtener_producto_principal);
while ($producto_principal = mysqli_fetch_assoc($resultado_producto_principal)) {

$cod_producto_barra_madre            = $producto_principal['cod_producto_barra'];
$nombre_producto_madre               = $producto_principal['nombre_producto'];
?>
<table border="1" width="100%" cellspacing="0" cellpadding="20">
<thead>
<tr>
<th style="text-align:center;"><a href="../admin/facturacion_subproducto_producto_manual_pos.php?cod_producto_barra_madre=<?php echo $cod_producto_barra_madre?>&pagina=<?php echo $pagina?>"><img src="../imagenes/editar.png"></a>NOMBRE PRODUCTO PRINCIPAL: <?php echo $nombre_producto_madre.' | '.$cod_producto_barra_madre ?></th>
</tr>
</table>

<table class="table table-striped" border="1" cellspacing="0" cellpadding="20">
<thead>
    <tr>
        <td style="text-align:center;">ELIM</td>
        <th style="text-align:center;">CODIGO SUBPRODUCTO</th>
        <th style="text-align:center;">NOMBRE SUBPRODUCTO</th>
        <th style="text-align:center;">CANTIDAD</th>
        <th style="text-align:center;">MED</th>
        <th style="text-align:center;">#</th>
    </tr>
</thead>
<tbody>
<?php
$conteo_reg = 0;
$sql_subproducto = "SELECT * FROM tbl15_subproducto WHERE (cod_producto_barra_madre = '$cod_producto_barra_madre') ORDER BY cod_subproducto DESC";
$consulta_subproducto = mysqli_query($conectar, $sql_subproducto);
while ($datos_subproducto = mysqli_fetch_assoc($consulta_subproducto)) {

    $conteo_reg++;
    $cod_subproducto                   = $datos_subproducto['cod_subproducto'];
    $cod_producto                      = $datos_subproducto['cod_producto'];
    $cod_producto_barra                = $datos_subproducto['cod_producto_barra'];
    $nombre_producto                   = $datos_subproducto['nombre_producto'];
    $und_producto                      = $datos_subproducto['und_producto'];
    $nombre_tipo_unidad_medida         = $datos_subproducto['nombre_tipo_unidad_medida'];
    $cod_info_factura_subproducto      = $datos_subproducto['cod_info_factura_subproducto'];
?>
    <tr id="tr<?php echo $cod_subproducto;?>">
        <td style="text-align:center;" class="service_list" id="cod_subproducto<?php echo $cod_subproducto ?>" data="<?php echo $cod_subproducto ?>"><a class="eliminar" id="cod_subproducto<?php echo $cod_subproducto ?>"><img src="../imagenes/eliminar_grand.png" class="img-polaroid" alt=""></a></td>
        <td style="text-align:left;" id="cod_producto_barra<?php echo $cod_subproducto;?>"><?php echo $cod_producto_barra ?></td>
        <td style="text-align:left;" id="nombre_producto<?php echo $cod_subproducto;?>"><?php echo $nombre_producto ?></td>
        <td style="text-align:center;" id="und_producto<?php echo $cod_subproducto;?>"><input name="und_producto" type="number" id="und_producto<?php echo $cod_subproducto;?>" class="<?php echo $cod_subproducto;?>" value="<?php echo $und_producto;?>" step="any" min=0 oninput="validity.valid||(value='');" style="width: 70px;" /></td>
        <td style="text-align:center;" id="nombre_tipo_unidad_medida<?php echo $cod_subproducto;?>"><?php echo $nombre_tipo_unidad_medida;?></td>
        <td style="text-align:center;" id="conteo_reg<?php echo $cod_subproducto;?>"><?php echo $conteo_reg;?></td>
    </tr id="tr<?php echo $cod_subproducto;?>">
<?php } ?>
</tbody>
</table>
<hr>
<?php } ?>
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
<?php //include_once('../admin/04_modulo_footer.php'); ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include_once('../admin/05_modulo_js.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<script type="text/javascript">
$(document).ready(function() {

    $('.eliminar').click(function(){
    
        var parent = $(this).parent().attr('id');
        var cod_subproducto = $(this).parent().attr('data');
        var dataString = 'llave='+cod_subproducto+'&'+'tab='+'<?php echo $tab ?>'+'&'+'campo='+'<?php echo $campo ?>'+'&'+'tipo='+'<?php echo $tipo ?>';

        $.ajax({
            type: "POST",
            url: "../admin/eliminar_ajax.php",
            data: dataString,
            success: function() {           
                $('#eliminar-ok').empty();
                $('#eliminar-ok').append('<div align="center" class="correcto">Se ha eliminado correctamente el codigo = '+cod_subproducto+'.</div>').fadeIn("slow");
                $('#'+parent).fadeOut("slow");
                $('#cod_producto_barra'+cod_subproducto).fadeOut("slow");
                $('#nombre_producto'+cod_subproducto).fadeOut("slow");
                $('#und_producto'+cod_subproducto).fadeOut("slow");
                $('#nombre_tipo_unidad_medida'+cod_subproducto).fadeOut("slow");
                $('#conteo_reg'+cod_subproducto).fadeOut("slow");
                $('#tr'+cod_subproducto).fadeOut("slow");
                //$('#'+parent).remove();
            }
        });
    });

});
</script>
</body>
</html>