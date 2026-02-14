<?php
include_once('../conexiones/conexione.php');

include_once("../session/funciones_admin.php");
//include("../tbl15_notificacion_alerta/mostrar_noficacion_alerta.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
  } else { header("Location:../index.php");
}

$cod_administrador                  = ($_SESSION['cod_administrador']);
$cod_base_caja                      = ($_SESSION['cod_base_caja']);
$cod_seguridad                      = ($_SESSION['cod_seguridad']);
//----------------------------------------------------------------------------------------------------------------//
$sql_infos_empresas = "SELECT cod_estado_marca_global, cod_estado_busqueda_venta_manual_resultado_unico_redirect_global, cod_estado_cod_barra2_global, cod_estado_venta_prod_en_cero_global, modo_venta_por_defecto_global 
FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$resultado_infos_empresas = mysqli_query($conectar, $sql_infos_empresas);
$info_empresa_data = mysqli_fetch_assoc($resultado_infos_empresas);

$cod_estado_marca_global                                           = $info_empresa_data['cod_estado_marca_global'];
$cod_estado_busqueda_venta_manual_resultado_unico_redirect_global  = $info_empresa_data['cod_estado_busqueda_venta_manual_resultado_unico_redirect_global'];
$cod_estado_cod_barra2_global                                      = $info_empresa_data['cod_estado_cod_barra2_global'];
$cod_estado_venta_prod_en_cero_global                              = $info_empresa_data['cod_estado_venta_prod_en_cero_global'];
$modo_venta_por_defecto                                            = $info_empresa_data['modo_venta_por_defecto_global'];
//----------------------------------------------------------------------------------------------------------------//
$sql_permiso_usuario = "SELECT cod_estado_prod_und_producto,cod_estado_prod_precio_compra_producto, cod_estado_prod_precio_costo_producto, cod_estado_prod_precio_venta_producto, cod_estado_comision_ventatemp 
FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador'";
$consulta_permiso_usuario = mysqli_query($conectar, $sql_permiso_usuario) or die(mysqli_error($conectar));
$matriz_permiso_usuario = mysqli_fetch_assoc($consulta_permiso_usuario);

$cod_estado_prod_und_producto                                        = $matriz_permiso_usuario['cod_estado_prod_und_producto'];
$cod_estado_prod_precio_compra_producto                              = $matriz_permiso_usuario['cod_estado_prod_precio_compra_producto'];
$cod_estado_prod_precio_costo_producto                               = $matriz_permiso_usuario['cod_estado_prod_precio_costo_producto'];
$cod_estado_prod_precio_venta_producto                               = $matriz_permiso_usuario['cod_estado_prod_precio_venta_producto'];
$cod_estado_comision_ventatemp                                       = $matriz_permiso_usuario['cod_estado_comision_ventatemp'];
//----------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------//
$buscar                    = addslashes($_POST['buscar']);
$pagina                    = addslashes($_POST['pagina']);
$nombre_tipo_moneda        = addslashes($_POST['nombre_tipo_moneda']);
$nombre_tipo_factura       = addslashes($_POST['nombre_tipo_factura']);
$cod_estado_vacuna         = addslashes($_POST['cod_estado_vacuna']);

if($buscar <> NULL) {
    if ($cod_estado_vacuna=='0') {
        $mostrar_datos_sql = "SELECT * FROM tbl15_producto WHERE ((nombre_producto LIKE '%$buscar%') OR (cod_producto_barra LIKE '$buscar%')) ORDER BY nombre_producto ASC";
        $consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
        $total_resultados = mysqli_num_rows($consulta);
    } else {
        $mostrar_datos_sql = "SELECT * FROM tbl15_producto WHERE ((nombre_producto LIKE '%$buscar%') OR (cod_producto_barra LIKE '$buscar%')) AND (nombre_tipo_producto='VACUNA') ORDER BY nombre_producto ASC";
        $consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
        $total_resultados = mysqli_num_rows($consulta);  
    }
}
if ($total_resultados <> 0) {
?>
<br>
<div class="table-responsive">
<table class="table table-striped">
    <tr>
        <th style="text-align:center;">CODIGO</th>
        <th style="text-align:center;">NOMBRE PRODUCTO</th>
        <?php if ($cod_estado_prod_und_producto == '1') { ?><th style="text-align:center;">UND</th><?php } ?>
        <th style="text-align:center;">PRECIO VENTA</th>
        <th style="text-align:center;">TIPO PRODUCTO</th>
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
    <tr>
        <td style="text-align:left;"><?php echo $cod_producto_barra; ?></td>
        <td  style="text-align:left;"><a href="../admin/reg_cotizacion_venta_temporal_producto_reg.php?cod_producto_barra=<?php echo $cod_producto_barra?>&nombre_tipo_moneda=<?php echo $nombre_tipo_moneda?>&nombre_tipo_factura=<?php echo $nombre_tipo_factura?>&foco=<?php echo $foco?>&cod_estado_vacuna=<?php echo $cod_estado_vacuna?>&pagina=<?php echo $pagina?>" tabindex=3><?php echo $nombre_producto ?></a></td>
        <?php if ($cod_estado_prod_und_producto == '1') { ?><td style="text-align:center;"><?php echo $und_producto; ?></td><?php } ?>
        <td style="text-align:right;"><?php echo number_format($precio_venta_producto, 0, ",", "."); ?></td>
        <td style="text-align:center;"><?php echo $nombre_tipo_producto; ?></td>
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