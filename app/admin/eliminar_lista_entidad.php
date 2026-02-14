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

<div class="breadcrumbs"><a href="../admin/menu_eliminar.php"><h4>Eliminar Entidad Eps</h4></a></div>
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina = $_SERVER['PHP_SELF'];
$tab = 'tbl15_entidad';
$tipo = 'eliminar';
$campo = 'cod_entidad';

$sql_cliente = "SELECT * FROM tbl15_entidad";
$resultado_cliente = mysqli_query($conectar, $sql_cliente);
//$info_cliente = mysqli_fetch_assoc($resultado_cliente);
?>
<div class="table-responsive">
<div id="eliminar-ok" style="display:none;">&nbsp;</div>

<table class="table table-striped">
<thead>
<tr>
<th>Elm</th>
<th>Entidad Eps</th>
<th>Dirección</th>
<th>Teléfono</th>
<th>Correo</th>
<th>Cod</th>
</tr>
</thead>
<tbody>
<?php
while ($info_cliente = mysqli_fetch_assoc($resultado_cliente)) {

$cod_entidad           = $info_cliente['cod_entidad'];
$cod_eps               = $info_cliente['cod_eps'];
$nombre_entidad        = $info_cliente['nombre_entidad'];
$direccion             = $info_cliente['direccion'];
$telefono              = $info_cliente['telefono'];
$correo                = $info_cliente['correo'];
$atiende               = $info_cliente['atiende'];
?>
<tr id="<?php echo $cod_entidad;?>">
<td class="service_list" id="cod_entidad<?php echo $cod_entidad ?>" data="<?php echo $cod_entidad ?>"><a class="eliminar" id="cod_entidad<?php echo $cod_entidad ?>"><img src="../imagenes/eliminar_grand.png" class="img-polaroid" alt=""></a></td>
<td id="nombre_entidad_<?php echo $cod_remision;?>"><?php echo $nombre_entidad?></td>
<td id="direccion_<?php echo $cod_remision;?>"><?php echo $direccion?></td>
<td id="telefono_<?php echo $cod_remision;?>"><?php echo $telefono?></td>
<td id="correo_<?php echo $cod_remision;?>"><?php echo $correo?></td>
<td id="cod_entidad_<?php echo $cod_remision;?>"><?php echo $cod_entidad?></td>
</tr id="<?php echo $cod_entidad;?>">
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
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<script type="text/javascript">
$(document).ready(function() {

    $('.eliminar').click(function(){
    
        var parent = $(this).parent().attr('id');
        var cod_entidad = $(this).parent().attr('data');
        var dataString = 'llave='+cod_entidad+'&'+'tab='+'<?php echo $tab ?>'+'&'+'campo='+'<?php echo $campo ?>'+'&'+'tipo='+'<?php echo $tipo ?>';

        $.ajax({
            type: "POST",
            url: "../admin/eliminar_ajax.php",
            data: dataString,
            success: function() {           
                $('#eliminar-ok').empty();
                $('#eliminar-ok').append('<div align="center" class="correcto">Se ha eliminado correctamente el codigo = '+cod_entidad+'.</div>').fadeIn("slow");
                $('#'+parent).fadeOut("slow");
                $('#cod_entidad_'+cod_entidad).fadeOut("slow");
                $('#nombre_entidad_'+cod_entidad).fadeOut("slow");
                $('#direccion_'+cod_entidad).fadeOut("slow");
                $('#telefono_'+cod_entidad).fadeOut("slow");
                $('#correo_'+cod_entidad).fadeOut("slow");
                $('#tr'+cod_entidad).fadeOut("slow");
                //$('#'+parent).remove();
            }
        });
    });

});
</script>

</body>
</html>