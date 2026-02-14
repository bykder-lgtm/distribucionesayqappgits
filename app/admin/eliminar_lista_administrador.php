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

<div class="breadcrumbs"><a href="../admin/menu_eliminar.php"><h4>Eliminar Usuarios</h4></a></div>
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina              = $_SERVER['PHP_SELF'];
$tab                 = 'tbl15_administrador';
$tipo                = 'eliminar';
$campo               = 'cod_administrador';
?>
<div class="table-responsive">
<div id="eliminar-ok" style="display:none;">&nbsp;</div>

<table class="table table-striped">
<thead>
<tr>
<th style="text-align:center;">Elm</th>
<th style="text-align:center;">Usuario</th>
<th style="text-align:center;">Nombres</th>
<th style="text-align:center;">Cod</th>
</tr>
</thead>
<tbody>
<?php
$sql_cliente = "SELECT * FROM tbl15_administrador";
$resultado_cliente = mysqli_query($conectar, $sql_cliente);
while ($info_cliente = mysqli_fetch_assoc($resultado_cliente)) {

$cod_administrador                = $info_cliente['cod_administrador'];
$cuenta                           = $info_cliente['cuenta'];
$nombres                          = $info_cliente['nombres'];
$apellidos                        = $info_cliente['apellidos'];
$nombre_administrador             = $nombres.' '.$apellidos;
?>
<tr id="<?php echo $cod_administrador;?>">
<td style="text-align:center;" class="service_list" id="cod_administrador<?php echo $cod_administrador ?>" data="<?php echo $cod_administrador ?>"><a class="eliminar" id="cod_administrador<?php echo $cod_administrador ?>"><img src="../imagenes/eliminar_grand.png" class="img-polaroid" alt=""></a></td>
<td style="text-align:center;" id="cuenta<?php echo $cod_administrador;?>"><?php echo $cuenta?></td>
<td style="text-align:left;" id="nombre_administrador<?php echo $cod_administrador;?>"><?php echo $nombre_administrador?></td>
<td style="text-align:center;" id="cod_administrador_<?php echo $cod_administrador;?>"><?php echo $cod_administrador?></td>
</tr id="<?php echo $cod_administrador;?>">
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
        var cod_administrador = $(this).parent().attr('data');
        var dataString = 'llave='+cod_administrador+'&'+'tab='+'<?php echo $tab ?>'+'&'+'campo='+'<?php echo $campo ?>'+'&'+'tipo='+'<?php echo $tipo ?>';

        $.ajax({
            type: "POST",
            url: "../admin/eliminar_ajax.php",
            data: dataString,
            success: function() {           
                $('#eliminar-ok').empty();
                $('#eliminar-ok').append('<div align="center" class="correcto">Se ha eliminado correctamente el codigo = '+cod_administrador+'.</div>').fadeIn("slow");
                $('#'+parent).fadeOut("slow");
                $('#cuenta'+cod_administrador).fadeOut("slow");
                $('#nombre_administrador'+cod_administrador).fadeOut("slow");
                $('#cod_administrador_'+cod_administrador).fadeOut("slow");
                $('#tr'+cod_administrador).fadeOut("slow");
                //$('#'+parent).remove();
            }
        });
    });

});
</script>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
</body>
</html>