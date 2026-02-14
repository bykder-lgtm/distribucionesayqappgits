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

<div class="breadcrumbs">
<a href="../admin/menu_lista.php"><h4>Lista de Cargo a Laborar&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
<a href="../admin/reg_grupo_area_cargo.php">Registrar Cargo a Laborar</h4></a>
</div>
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina = $_SERVER['PHP_SELF'];
$tab = 'tbl15_grupo_area_cargo';
$tipo = 'eliminar';
$campo = 'cod_grupo_area_cargo';

$sql_cliente = "SELECT tbl15_grupo_area.nombre_grupo_area, tbl15_grupo_area.nombre_grupo, tbl15_grupo_area_cargo.nombre_grupo_area_cargo, 
tbl15_grupo_area_cargo.cod_grupo_area_cargo, tbl15_grupo_area.cod_grupo_area 
FROM tbl15_grupo_area RIGHT JOIN tbl15_grupo_area_cargo ON tbl15_grupo_area.cod_grupo_area = tbl15_grupo_area_cargo.cod_grupo_area ORDER BY nombre_grupo_area ASC";
$resultado_cliente = mysqli_query($conectar, $sql_cliente);
//$info_cliente = mysqli_fetch_assoc($resultado_cliente);
?>
<div class="table-responsive">
<div id="eliminar-ok" style="display:none;">&nbsp;</div>

<table class="table table-striped">
<thead>
<tr>
<th>Elim</th>
<th>Area a Laborar</th>
<th>Cargo a Laborar</th>
<th>Cod</th>
</tr>
</thead>
<tbody>
<?php
while ($info_cliente = mysqli_fetch_assoc($resultado_cliente)) {
 	
$cod_grupo_area_cargo = $info_cliente['cod_grupo_area_cargo'];
$nombre_grupo_area_cargo = $info_cliente['nombre_grupo_area_cargo'];
$nombre_grupo_area = $info_cliente['nombre_grupo_area'];
?>
<tr id="<?php echo $cod_cliente;?>">
<td class="service_list" id="cod_grupo_area_cargo<?php echo $cod_grupo_area_cargo ?>" data="<?php echo $cod_grupo_area_cargo ?>"><a class="eliminar" id="cod_grupo_area_cargo<?php echo $cod_grupo_area_cargo ?>"><img src="../imagenes/eliminar_grand.png" class="img-polaroid" alt=""></a></td>
<td id="nombre_grupo_area<?php echo $cod_grupo_area_cargo;?>"><?php echo $nombre_grupo_area?></td>
<td id="nombre_grupo_area_cargo<?php echo $cod_grupo_area_cargo;?>"><?php echo $nombre_grupo_area_cargo?></td>
<td id="cod_grupo_area_cargo_<?php echo $cod_grupo_area_cargo;?>"><?php echo $cod_grupo_area_cargo?></td>
</tr id="<?php echo $cod_cliente;?>">
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
        var cod_grupo_area_cargo = $(this).parent().attr('data');
        var dataString = 'llave='+cod_grupo_area_cargo+'&'+'tab='+'<?php echo $tab ?>'+'&'+'campo='+'<?php echo $campo ?>'+'&'+'tipo='+'<?php echo $tipo ?>';

        $.ajax({
            type: "POST",
            url: "../admin/eliminar_ajax.php",
            data: dataString,
            success: function() {           
                $('#eliminar-ok').empty();
                $('#eliminar-ok').append('<div align="center" class="correcto">Se ha eliminado correctamente el codigo = '+cod_grupo_area_cargo+'.</div>').fadeIn("slow");
                $('#'+parent).fadeOut("slow");
                $('#cod_grupo_area_cargo_'+cod_grupo_area_cargo).fadeOut("slow");
                $('#nombre_grupo_area'+cod_grupo_area_cargo).fadeOut("slow");
                $('#nombre_grupo_area_cargo'+cod_grupo_area_cargo).fadeOut("slow");
                $('#cod_grupo_area_cargo'+cod_grupo_area_cargo).fadeOut("slow");
                $('#tr'+cod_grupo_area_cargo).fadeOut("slow");
                //$('#'+parent).remove();
            }
        });
    });

});
</script>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
</body>
</html>