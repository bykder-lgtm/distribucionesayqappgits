<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<script src="js/jquery-1.12.3.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="../estilo_css/jquery.dataTables.min.css">
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

<div class="breadcrumbs"><a href="../admin/menu_eliminar.php"><h4>Eliminar Empresa Contratante</h4></a></div>
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina = $_SERVER['PHP_SELF'];
$tab = 'tbl15_empresa_contratante';
$tipo = 'eliminar';
$campo = 'cod_empresa_contratante';

$sql_cliente = "SELECT * FROM tbl15_empresa_contratante";
$resultado_cliente = mysqli_query($conectar, $sql_cliente);
//$info_cliente = mysqli_fetch_assoc($resultado_cliente);
?>
<div class="table-responsive">
<div id="eliminar-ok" style="display:none;">&nbsp;</div>

<table class="table table-striped">
<thead>
<tr>
<th>Elm</th>
<th>Nombre Empresa Contratante</th>
<th>Cod</th>
</tr>
</thead>
<tbody>
<?php

while ($info_cliente = mysqli_fetch_assoc($resultado_cliente)) {
$cod_empresa_contratante            = $info_cliente['cod_empresa_contratante'];
$nombre_empresa_contratante         = $info_cliente['nombre_empresa_contratante'];
?>
<tr id="<?php echo $cod_empresa_contratante;?>">
<td class="service_list" id="cod_empresa_contratante<?php echo $cod_empresa_contratante ?>" data="<?php echo $cod_empresa_contratante ?>"><a class="eliminar" id="cod_empresa_contratante<?php echo $cod_empresa_contratante ?>"><img src="../imagenes/eliminar_grand.png" class="img-polaroid" alt=""></a></td>
<td id="nombre_empresa_contratante_<?php echo $cod_empresa_contratante;?>"><?php echo $nombre_empresa_contratante?></td>
<td id="cod_empresa_contratante_<?php echo $cod_empresa_contratante;?>"><?php echo $cod_empresa_contratante?></td>
</tr id="<?php echo $cod_empresa_contratante;?>">
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
<?php include_once('../admin/05_modulo_js_sin_jquery.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<script type="text/javascript">
$(document).ready(function() {

    $('.eliminar').click(function(){
    
        var parent = $(this).parent().attr('id');
        var cod_empresa_contratante = $(this).parent().attr('data');
        var dataString = 'llave='+cod_empresa_contratante+'&'+'tab='+'<?php echo $tab ?>'+'&'+'campo='+'<?php echo $campo ?>'+'&'+'tipo='+'<?php echo $tipo ?>';

        $.ajax({
            type: "POST",
            url: "../admin/eliminar_ajax.php",
            data: dataString,
            success: function() {           
                $('#eliminar-ok').empty();
                $('#eliminar-ok').append('<div align="center" class="correcto">Se ha eliminado correctamente el codigo = '+cod_empresa_contratante+'.</div>').fadeIn("slow");
                $('#'+parent).fadeOut("slow");
                $('#cod_empresa_contratante_'+cod_empresa_contratante).fadeOut("slow");
                $('#nombre_empresa_contratante_'+cod_empresa_contratante).fadeOut("slow");
                $('#tr'+cod_empresa_contratante).fadeOut("slow");
                //$('#'+parent).remove();
            }
        });
    });

});
</script>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
</body>
</html>