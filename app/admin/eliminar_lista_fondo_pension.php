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

<div class="breadcrumbs"><a href="../admin/menu_eliminar.php"><h4>Eliminar Fondo de Pension</h4></a></div>
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina = $_SERVER['PHP_SELF'];
$tab = 'tbl15_fondo_pension';
$tipo = 'eliminar';
$campo = 'cod_fondo_pension';

$sql_cliente = "SELECT * FROM tbl15_fondo_pension";
$resultado_cliente = mysqli_query($conectar, $sql_cliente);
//$info_cliente = mysqli_fetch_assoc($resultado_cliente);
?>
<div class="table-responsive">
<div id="eliminar-ok" style="display:none;">&nbsp;</div>

<table class="table table-striped">
<thead>
<tr>
<th>Elm</th>
<th>Nombre Fondo de Pension</th>
<th>Cod</th>
</tr>
</thead>
<tbody>
<?php
while ($info_cliente = mysqli_fetch_assoc($resultado_cliente)) {

$cod_fondo_pension = $info_cliente['cod_fondo_pension'];
$nombre_fondo_pension = $info_cliente['nombre_fondo_pension'];
?>
<tr id="<?php echo $cod_fondo_pension;?>">
<td class="service_list" id="cod_fondo_pension<?php echo $cod_fondo_pension ?>" data="<?php echo $cod_fondo_pension ?>"><a class="eliminar" id="cod_fondo_pension<?php echo $cod_fondo_pension ?>"><img src="../imagenes/eliminar_grand.png" class="img-polaroid" alt=""></a></td>
<!--<td align="center"><a href="../admin/eliminar.php?llave=<?php echo $cod_fondo_pension?>&tab=<?php echo $tab ?>&tipo=<?php echo $tipo ?>&campo=<?php echo $campo ?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/eliminar.png" class="img-polaroid" alt=""></a></td>-->
<td id="nombre_fondo_pension<?php echo $cod_fondo_pension;?>"><?php echo $nombre_fondo_pension?></td>
<td id="cod_fondo_pension_<?php echo $cod_fondo_pension;?>"><?php echo $cod_fondo_pension?></td>
</tr id="<?php echo $cod_fondo_pension;?>">
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
        var cod_fondo_pension = $(this).parent().attr('data');
        var dataString = 'llave='+cod_fondo_pension+'&'+'tab='+'<?php echo $tab ?>'+'&'+'campo='+'<?php echo $campo ?>'+'&'+'tipo='+'<?php echo $tipo ?>';

        $.ajax({
            type: "POST",
            url: "../admin/eliminar_ajax.php",
            data: dataString,
            success: function() {           
                $('#eliminar-ok').empty();
                $('#eliminar-ok').append('<div align="center" class="correcto">Se ha eliminado correctamente el codigo = '+cod_fondo_pension+'.</div>').fadeIn("slow");
                $('#'+parent).fadeOut("slow");
                $('#nombre_fondo_pension'+cod_fondo_pension).fadeOut("slow");
                $('#cod_fondo_pension_'+cod_fondo_pension).fadeOut("slow");
                $('#tr'+cod_fondo_pension).fadeOut("slow");
                //$('#'+parent).remove();
            }
        });
    });

});
</script>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
</body>
</html>