<?php
include_once('../conexiones/conexione.php');
//----------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------//
$buscar                                              = addslashes($_POST['buscar']);
$valor_campos                                        = addslashes($_POST['valor_campos']);
$cod_cuentas_cobrar_factura_comision_propietario     = intval($_POST['cod_cuentas_cobrar_factura_comision_propietario']);
$cod_cuentas_cobrar                                  = intval($_POST['cod_cuentas_cobrar']);
$cod_cuentas_cobrar_alerta                           = intval($_POST['cod_cuentas_cobrar_alerta']);
$fecha_mes                                           = addslashes($_POST['fecha_mes']);
$nombre_tabla_mes                                    = addslashes($_POST['nombre_tabla_mes']);
$nombre_tabla_anyo                                   = addslashes($_POST['nombre_tabla_anyo']);
$cod_estado_envio_correo_cuenta_cobro                = intval($_POST['cod_estado_envio_correo_cuenta_cobro']);
$cod_factura                                         = intval($_POST['cod_factura']);
$numero_alerta                                       = intval($_POST['numero_alerta']);
$cod_tercero                                         = intval($_POST['cod_tercero']);
$cliente                                             = addslashes($_POST['cliente']);
$cod_estado_hoy                                      = intval($_POST['cod_estado_hoy']);
$cod_estado_pago                                     = intval($_POST['cod_estado_pago']);
$buscar_por                                          = addslashes($_POST['buscar_por']);
$foco                                                = addslashes($_POST['foco']);
$pagina                                              = addslashes($_POST['pagina']);

if($buscar <> NULL) {

$mostrar_datos_sql = "SELECT * FROM tbl15_gasto_inmueble WHERE (nombre_gasto_inmueble LIKE '%$buscar%') AND (cod_estado = '1') ORDER BY nombre_gasto_inmueble ASC";
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
        <th style="text-align:left;">Id</th>
        <th style="text-align:left;">Nombre Examen</th>
    </tr>
<?php
$tab                      = 'tbl15_gasto_inmueble';
$campo                    = 'cod_gasto_inmueble';
$tipo                     = 'insertar';
$foco                     = 'busqueda_gasto_inmueble';

while ($matriz_consulta = mysqli_fetch_assoc($consulta)) {

$cod_gasto_inmueble                = $matriz_consulta['cod_gasto_inmueble'];
$nombre_gasto_inmueble             = $matriz_consulta['nombre_gasto_inmueble'];
?>
        <td style="text-align:left;"><?php echo $cod_gasto_inmueble; ?></td>
        <td style="text-align:left;"><a href="../admin/reg_gasto_inmueble_detalle_reg.php?cod_gasto_inmueble=<?php echo $cod_gasto_inmueble?>&cod_cuentas_cobrar_factura_comision_propietario=<?php echo $cod_cuentas_cobrar_factura_comision_propietario?>&cod_cuentas_cobrar=<?php echo $cod_cuentas_cobrar?>&cod_cuentas_cobrar_alerta=<?php echo $cod_cuentas_cobrar_alerta?>&fecha_mes=<?php echo $fecha_mes?>&nombre_tabla_mes=<?php echo $nombre_tabla_mes?>&nombre_tabla_anyo=<?php echo $nombre_tabla_anyo?>&cod_estado_envio_correo_cuenta_cobro=<?php echo $cod_estado_envio_correo_cuenta_cobro?>&cod_factura=<?php echo $cod_factura?>&numero_alerta=<?php echo $numero_alerta?>&cod_tercero=<?php echo $cod_tercero?>&cliente=<?php echo $cliente?>&cod_estado_hoy=<?php echo $cod_estado_hoy?>&cod_estado_pago=<?php echo $cod_estado_pago?>&buscar_por=<?php echo $buscar_por?>&foco=<?php echo $foco?>&pagina=<?php echo $pagina?>" tabindex=3><?php echo $nombre_gasto_inmueble ?></a></td>
    </tr>
<?php } ?>
</table>
</div>
<?php } else { } ?>