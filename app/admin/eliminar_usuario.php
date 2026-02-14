<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->

<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->

<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->

<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">
<div class="breadcrumbs"><a href="../admin/menu_eliminar.php"><h4>Eliminar Usuario</h4></a></div>
<div class="row-fluid">
<div class="span12" id="divMain">
<?php
$pagina = $_SERVER['PHP_SELF'];
$tab = 'tbl15_administrador';
$tipo = 'eliminar';
$campo = 'cod_administrador';

$mostrar_datos_sql = "SELECT * FROM tbl15_administrador LEFT JOIN seguridad ON tbl15_administrador.cod_seguridad = tbl15_seguridad.cod_seguridad";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
?>
<div class="table-responsive">
<div id="eliminar-ok" style="display:none;">&nbsp;</div>

<table class="table table-hover">
<thead>
<tr>
<th>Elm</th>
<th>Cuenta</th>
<th>Nombres</th>
<th>Apellidos</th>
<th>Tipo</th>
<th>Correo</th>
<th>Diseño</th>
<th>Creador</th>
<th>Fecha</th>
</tr>
</thead>
<tbody>
<?php
while ($matriz_consulta = mysqli_fetch_assoc($consulta)) {

$cod_administrador = $matriz_consulta['cod_administrador'];
$cuenta = $matriz_consulta['cuenta'];
$nombres = $matriz_consulta['nombres'];
$apellidos = $matriz_consulta['apellidos'];
$correo = $matriz_consulta['correo'];
$nombre_seguridad = $matriz_consulta['nombre_seguridad'];
$estilo_css = $matriz_consulta['estilo_css'];
$creador = $matriz_consulta['creador'];
$fecha = $matriz_consulta['fecha'];
?>
<tr id="<?php echo $cod_administrador;?>">
<td class="service_list" id="cod_administrador<?php echo $cod_administrador ?>" data="<?php echo $cod_administrador ?>"><a class="eliminar" id="cod_administrador<?php echo $cod_administrador ?>"><img src="../imagenes/eliminar_grand.png" class="img-polaroid" alt=""></a></td>
<td id="cuenta_<?php echo $cod_administrador;?>"><?php echo $cuenta?></td>
<td id="nombres_<?php echo $cod_administrador;?>"><?php echo $nombres?></td>
<td id="apellidos_<?php echo $cod_administrador;?>"><?php echo $apellidos?></td>
<td id="nombre_seguridad_<?php echo $cod_administrador;?>"><?php echo $nombre_seguridad?></td>
<td id="correo_<?php echo $cod_administrador;?>"><?php echo $correo?></td>
<td id="estilo_css_<?php echo $cod_administrador;?>"><?php echo $estilo_css?></td>
<td id="creador_<?php echo $cod_administrador;?>"><?php echo $creador?></td>
<td id="fecha_<?php echo $cod_administrador;?>"><?php echo $fecha?></td>
</tr id="<?php echo $cod_administrador;?>">
<?php
}
?>
</tr>
</tbody>
</table>
</div>
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* FIN MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->

</div>
</div>
<div id="footerInnerSeparator"></div>
</div>
</div>
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* FIN MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->

  <!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<?php include_once('../admin/04_modulo_footer.php'); ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->

<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include_once('../admin/05_modulo_js.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
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
                $('#cod_administrador_'+cod_administrador).fadeOut("slow");
                $('#cuenta_'+cod_administrador).fadeOut("slow");
                $('#nombres_'+cod_administrador).fadeOut("slow");
                $('#apellidos_'+cod_administrador).fadeOut("slow");
                $('#nombre_seguridad_'+cod_administrador).fadeOut("slow");
                $('#correo_'+cod_administrador).fadeOut("slow");
                $('#estilo_css_'+cod_administrador).fadeOut("slow");
                $('#creador_'+cod_administrador).fadeOut("slow");
                $('#fecha_'+cod_administrador).fadeOut("slow");
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