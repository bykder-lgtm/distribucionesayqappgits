<?php
include_once('../conexiones/conexione.php');
//----------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------//
$buscar                    = addslashes($_POST['buscar']);
$cod_info_plan_accion_correctiva_preventiva_mejora          = intval($_POST['cod_info_plan_accion_correctiva_preventiva_mejora']);
$pagina                    = addslashes($_POST['pagina']);

if($buscar <> NULL) {

$mostrar_datos_sql = "SELECT * FROM tbl15_producto WHERE (nombre_producto LIKE '%$buscar%') OR (cod_producto_barra LIKE '$buscar%') ORDER BY nombre_producto ASC";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
$total_resultados = mysqli_num_rows($consulta);

//echo $total_resultados." Resultados para: ".$buscar."<br>";
}
if ($total_resultados <> 0) {
?>
<br>
<div class="table-responsive">
<table class="table table-striped">
<tr>
<th>CODIGO</th>
<th>NOMBRE PRODUCTO</th>
<th>PRECIO VENTA</th>
<th>TIPO PRODUCTO</th>
</tr>
<?php
$tab                      = 'tbl15_producto';
$campo                    = 'cod_producto';
$tipo                     = 'insertar';
$foco                     = 'busqueda';
while ($matriz_consulta = mysqli_fetch_assoc($consulta)) {

$cod_producto             = $matriz_consulta['cod_producto'];
$cod_producto_barra       = $matriz_consulta['cod_producto_barra'];
$nombre_producto          = $matriz_consulta['nombre_producto'];
$und_producto             = $matriz_consulta['und_producto'];
$precio_costo_producto    = $matriz_consulta['precio_costo_producto'];
$precio_venta_producto    = $matriz_consulta['precio_venta_producto'];
$nombre_tipo_producto     = $matriz_consulta['nombre_tipo_producto'];
?>
<td align="Left"><?php echo $cod_producto_barra; ?></td>
<td align="Left"><a href="../admin/reg_plan_accion_correctiva_preventiva_mejora_reg.php?cod_producto=<?php echo $cod_producto?>&cod_info_plan_accion_correctiva_preventiva_mejora=<?php echo $cod_info_plan_accion_correctiva_preventiva_mejora?>&foco=<?php echo $foco?>&pagina=<?php echo $pagina?>" tabindex=3><?php echo $nombre_producto ?></a></td>
<td align="right"><?php echo number_format($precio_venta_producto, 0, ",", "."); ?></td>
<td align="center"><?php echo $nombre_tipo_producto; ?></td>
</tr>
<?php } ?>
</table>
</div>
<?php } else { } ?>

<script src="../js/jquery-3.2.1.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {

    $('.insertar').click(function(){
    
        var parent = $(this).parent().attr('id');
        var cod_cie10 = $(this).parent().attr('data');
        var dataString = 'llave='+cod_cie10+'&'+'tab='+'<?php echo $tab ?>'+'&'+'campo='+'<?php echo $campo ?>'+'&'+'tipo='+'<?php echo $tipo ?>';

        $.ajax({
            type: "POST",
            url: "../admin/eliminar_ajax.php",
            data: dataString,
            success: function() {           
                $('#eliminar-ok').empty();
                $('#eliminar-ok').append('<div align="center" class="correcto">Se ha eliminado correctamente el codigo = '+cod_cie10+'.</div>').fadeIn("slow");
                $('#'+parent).fadeOut("slow");
                $('#cod_cie10'+cod_cie10).fadeOut("slow");
                $('#cie10_diag'+cod_cie10).fadeOut("slow");
                $('#cie10_impdiag'+cod_cie10).fadeOut("slow");
                $('#cie10_confirnuev'+cod_cie10).fadeOut("slow");
                $('#cie10_confirepet'+cod_cie10).fadeOut("slow");
                $('#cie10_diagprinc'+cod_cie10).fadeOut("slow");
                $('#tr'+cod_cie10).fadeOut("slow");
                //$('#'+parent).remove();
            }
        });
    });

});
</script>