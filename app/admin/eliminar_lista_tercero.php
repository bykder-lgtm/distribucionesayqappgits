<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
</head>
<body id="pageBody">
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php //$pagina = addslashes($_GET['pagina']); ?>
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">

<div class="breadcrumbs"><a href="../admin/menu_eliminar.php"><h4>Eliminar Clientes</h4></a></div>
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina              = $_SERVER['PHP_SELF'];
$tab                 = 'tbl15_tercero';
$tipo                = 'eliminar';
$campo               = 'cod_tercero';
?>
<div class="table-responsive">
<div id="eliminar-ok" style="display:none;">&nbsp;</div>

<table class="table table-striped">
<thead>
<tr>
<th style="text-align:center;">Elm</th>
<th style="text-align:center;">Tipo tercero</th>
<th style="text-align:center;">Documento Cliente</th>
<th style="text-align:center;">Nombre Cliente</th>
<th style="text-align:center;">Cod</th>
</tr>
</thead>
<tbody>
<?php
$sql_cliente = "SELECT * FROM tbl15_tercero";
$resultado_cliente = mysqli_query($conectar, $sql_cliente);
while ($info_cliente = mysqli_fetch_assoc($resultado_cliente)) {

$cod_tercero                = $info_cliente['cod_tercero'];
$nombre_tipo_tercero        = $info_cliente['nombre_tipo_tercero'];
$identificacion_tercero     = $info_cliente['identificacion_tercero'];
$nombre1_tercero            = $info_cliente['nombre1_tercero'];
$nombre2_tercero            = $info_cliente['nombre2_tercero'];
$apellido1_tercero          = $info_cliente['apellido1_tercero'];
$apellido2_tercero          = $info_cliente['apellido2_tercero'];
$nombre_tercero             = $nombre1_tercero.' '.$nombre2_tercero.' '.$apellido1_tercero.' '.$apellido2_tercero;
?>
<tr id="<?php echo $cod_tercero;?>">
<td style="text-align:center;" class="service_list" id="cod_tercero<?php echo $cod_tercero ?>" data="<?php echo $cod_tercero ?>"><a class="eliminar" id="cod_tercero<?php echo $cod_tercero ?>"><img src="../imagenes/eliminar_grand.png" class="img-polaroid" alt=""></a></td>
<td style="text-align:center;" id="nombre_tipo_tercero<?php echo $cod_tercero;?>"><?php echo $nombre_tipo_tercero?></td>
<td style="text-align:left;" id="identificacion_tercero<?php echo $cod_tercero;?>"><?php echo $identificacion_tercero?></td>
<td style="text-align:left;" id="nombre_tercero<?php echo $cod_tercero;?>"><?php echo $nombre_tercero?></td>
<td style="text-align:center;" id="cod_empresa_<?php echo $cod_tercero;?>"><?php echo $cod_tercero?></td>
</tr id="<?php echo $cod_tercero;?>">
<?php } ?>
</tbody>
</table>
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
<?php include_once('../admin/05_modulo_js.php'); ?>

<script type="text/javascript">
$(document).ready(function() {

    $('.eliminar').click(function(){
    
        var parent = $(this).parent().attr('id');
        var cod_tercero = $(this).parent().attr('data');
        var dataString = 'llave='+cod_tercero+'&'+'tab='+'<?php echo $tab ?>'+'&'+'campo='+'<?php echo $campo ?>'+'&'+'tipo='+'<?php echo $tipo ?>';

        $.ajax({
            type: "POST",
            url: "../admin/eliminar_ajax.php",
            data: dataString,
            success: function() {           
                $('#eliminar-ok').empty();
                $('#eliminar-ok').append('<div align="center" class="correcto">Se ha eliminado correctamente el codigo = '+cod_tercero+'.</div>').fadeIn("slow");
                $('#'+parent).fadeOut("slow");
                $('#nombre_tipo_tercero'+cod_tercero).fadeOut("slow");
                $('#identificacion_tercero'+cod_tercero).fadeOut("slow");
                $('#nombre_tercero'+cod_tercero).fadeOut("slow");
                $('#cod_empresa_'+cod_tercero).fadeOut("slow");
                $('#tr'+cod_tercero).fadeOut("slow");
                //$('#'+parent).remove();
            }
        });
    });

});
</script>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
</body>
</html>