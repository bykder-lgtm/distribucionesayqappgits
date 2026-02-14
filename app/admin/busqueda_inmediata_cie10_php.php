<?php
include_once('../conexiones/conexione.php');
//----------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------//
$buscar                    = addslashes($_POST['buscar']);
$valor_campos              = addslashes($_POST['valor_campos']);

$fragment                  = explode('-', $valor_campos);
$cod_historia_clinica      = $fragment[0];
$cod_cliente               = $fragment[1];
$pagina                    = $fragment[2];

if($buscar <> NULL) {

$mostrar_datos_sql = "SELECT cod_cie10, codigo_cie10, descripcion_cie10 FROM tbl15_cie10 WHERE descripcion_cie10 LIKE '%$buscar%' AND cod_estado_cie10 = '1' ORDER BY descripcion_cie10 ASC";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
$total_resultados = mysqli_num_rows($consulta);

echo $total_resultados." Resultados para: ".$buscar."<br>";
}
if ($total_resultados <> 0) {
?>
<br>
<div class="table-responsive">
<table class="table table-striped">
<tr>
<th>CIE 10</th>
<th>Diágnostico</th>
<!--<th>.</th>-->
</tr>
<?php
$tab                      = 'tbl15_cie10';
$campo                    = 'cod_cie10';
$tipo                     = 'insertar';
$foco                     = 'busqueda';

while ($matriz_consulta = mysqli_fetch_assoc($consulta)) {

$cod_cie10                = $matriz_consulta['cod_cie10'];
$codigo_cie10             = $matriz_consulta['codigo_cie10'];
$descripcion_cie10        = $matriz_consulta['descripcion_cie10'];
?>
<td align="Left"><?php echo $codigo_cie10; ?></td>
<td ><a href="../admin/reg_cie10_historia_clinica_reg.php?cod_cie10=<?php echo $cod_cie10?>&cod_historia_clinica=<?php echo $cod_historia_clinica?>&cod_cliente=<?php echo $cod_cliente?>&foco=<?php echo $foco?>&pagina=<?php echo $pagina?>" tabindex=3><?php echo $descripcion_cie10 ?></a></td>
<!--<td class="service_list" id="cod_cie10<?php echo $cod_cie10 ?>" data="<?php echo $cod_cie10 ?>"><a class="insertar" id="cod_cie10<?php echo $cod_cie10 ?>"><img src="../imagenes/eliminar_grand.png" class="img-polaroid" alt=""></a></td>-->
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