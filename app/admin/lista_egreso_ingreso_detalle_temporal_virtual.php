<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<script language="javascript" src="isiAJAX.js"></script>
<script language="javascript">
var last;
function Focus(elemento, valor) {
$(elemento).className = 'inputon';
last = valor;
}
function Blur(elemento, valor, campo, id) {
$(elemento).className = 'inputoff';
if (last != valor) {
myajax.Link('lista_caja_virtual_editable_ajax_reg.php?valor='+valor+'&campo='+campo+'&id='+id);
}
}
</script>


<?php if ($cod_estado_posicion_mapa_gps_pedidos_info_venta_global=='1') { ?>
<style>#mostrar_mapa { height: 50%; width: 50%; }</style>
<script src="https://maps.google.com/maps/api/js?key=AIzaSyDZCPrONtmISsx6oRvVyxMtRdEVk7RHle0"></script>
<?php } ?>

</head>
<body onLoad="myajax = new isiAJAX();" id="pageBody">
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php //$pagina = addslashes($_GET['pagina']); ?>
<!--<div id="contentOuterSeparator"></div>-->
<div class="container">
<div class="divPanel page-content">
<!--
<div class="breadcrumbs">
<a href="../admin/facturacion_venta_temporal_egreso_ingreso_detalle.php"><h4><?php echo $nombre_concepto_multi_virtual; ?>S VIRTUALES</a>
</div>
<hr>
-->
<div class="row-fluid no-gutters">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">

<?php //include_once("../admin/ver_modal_mapa_domicilio.php"); ?>
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
if (isset($_GET['pagina'])) { $pagina = addslashes($_GET['pagina']); } else { $pagina = 'facturacion_venta_temporal_gasto_inmueble_detalle.php'; }
if (isset($_GET['caja_mesa']) && ($_GET['caja_mesa'] <> '')) {  $caja_mesa = ($_GET['caja_mesa']); $filtro_buscar_mesa = "AND (cod_base_caja = '$caja_mesa')"; } else { $caja_mesa = ''; $filtro_buscar_mesa = ""; }
$pagina_local        = $_SERVER['PHP_SELF'];

if ($cod_seguridad == "1") {
$sql_mesa_caja_uso = "SELECT COUNT(cod_caja_virtual) AS total_caja_mesa_en_uso FROM tbl15_info_gasto_inmueble_detalle_venta WHERE (nombre_estado_factura = 'ABIERTA')";
$consulta_mesa_caja_uso = mysqli_query($conectar, $sql_mesa_caja_uso);
$datos_mesa_caja_uso = mysqli_fetch_assoc($consulta_mesa_caja_uso);

$sql_domicilio = "SELECT cod_info_gasto_inmueble_detalle_venta FROM tbl15_info_gasto_inmueble_detalle_venta WHERE (nombre_estado_factura = 'ABIERTA') AND (cod_tipo_metodo_envio = '2')";
$consulta_domicilio = mysqli_query($conectar, $sql_domicilio);
$total_reg_domicilio = mysqli_num_rows($consulta_domicilio);

$sql_datos_venta_temp_total_sup = "SELECT SUM(total_venta_producto) AS total_venta_producto FROM tbl15_gasto_inmueble_detalle_venta_temporal";
$consulta_datos_venta_temp_total_sup = mysqli_query($conectar, $sql_datos_venta_temp_total_sup);
$datos_venta_temp_total_sup = mysqli_fetch_assoc($consulta_datos_venta_temp_total_sup);
} else {
$sql_mesa_caja_uso = "SELECT COUNT(cod_caja_virtual) AS total_caja_mesa_en_uso FROM tbl15_info_gasto_inmueble_detalle_venta WHERE (nombre_estado_factura = 'ABIERTA') AND (cod_administrador = '$cod_administrador')";
$consulta_mesa_caja_uso = mysqli_query($conectar, $sql_mesa_caja_uso);
$datos_mesa_caja_uso = mysqli_fetch_assoc($consulta_mesa_caja_uso);

$sql_domicilio = "SELECT cod_info_gasto_inmueble_detalle_venta FROM tbl15_info_gasto_inmueble_detalle_venta WHERE (nombre_estado_factura = 'ABIERTA') AND (cod_tipo_metodo_envio = '2') AND (cod_administrador = '$cod_administrador')";
$consulta_domicilio = mysqli_query($conectar, $sql_domicilio);
$total_reg_domicilio = mysqli_num_rows($consulta_domicilio);

$sql_datos_venta_temp_total_sup = "SELECT SUM(total_venta_producto) AS total_venta_producto FROM tbl15_gasto_inmueble_detalle_venta_temporal WHERE (cod_administrador = '$cod_administrador')";
$consulta_datos_venta_temp_total_sup = mysqli_query($conectar, $sql_datos_venta_temp_total_sup);
$datos_venta_temp_total_sup = mysqli_fetch_assoc($consulta_datos_venta_temp_total_sup);
}
$total_caja_mesa_en_uso                 = $datos_mesa_caja_uso['total_caja_mesa_en_uso'];
$total_venta_producto_sup               = $datos_venta_temp_total_sup['total_venta_producto'];

?>
<div class="table-responsive">
<form method="GET" name="formulario" action="">
<div class="container">
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <div class="shop-cat-box">
                <a class="nav-item active" href="#"><input type="text" name="caja_mesa" id="caja_mesa" value="<?php echo $caja_mesa; ?>" style="height:26;" placeholder="" autofocus/><input type="submit" class="btn btn-success"  value="Buscar" /></a>
                <a class="btn btn-success" href="../admin/crear_caja_virtual_sesion_egreso_ingreso_detalle.php?pagina=<?php echo $pagina ?>">CREAR NUEVO GASTO</a>
            </div>
        </div>
    </div>
</div>
</form>


<div id="salida_tabla_caja_mesa_ajax">
<table class="table table-hover">
<tr>
<th style="text-align:center;">CONTRATO</th>
<th style="text-align:center;">DESCRIPCION_DE_LOS_CONCEPTOS_DE_GASTOS_DE_INMUBLES</th>
<th style="text-align:center;">PROPIETARIO | INMUEBLE</th>
<th style="text-align:center;">TOTAL GASTO</th>
<th style="text-align:center;">ID</th>
<?php if ($cod_estado_eliminar_caja_mesa_virtual=='1') { ?>
<th style="text-align:center;">ELIM</th>
<?php } ?>
</tr>
<?php
if ($cod_estado_ordenar_por_fecha_modificacion_caja_mesa_global == '1') { $ordenar_consulta = 'ORDER BY cod_info_gasto_inmueble_detalle_venta DESC'; } else { $ordenar_consulta = 'ORDER BY cod_info_gasto_inmueble_detalle_venta DESC'; }
if ($limite_mostrar_producto_lista_caja_virtual == '0') { $limite_mostrar_registro = ''; } else { $limite_mostrar_registro = 'LIMIT 0,'.$limite_mostrar_producto_lista_caja_virtual; }

$nombre_producto_concat             = '';

if ($cod_seguridad=='1') {
$mostrar_datos_sql = "SELECT cod_caja_virtual, cuenta, cod_info_gasto_inmueble_detalle_venta, cod_tercero, fecha_anyo, cod_administrador, 
fecha_hora, cod_base_caja, nombre_producto, 
fecha_modificacion, cod_tercero_propietario, cod_factura FROM tbl15_info_gasto_inmueble_detalle_venta 
WHERE (nombre_estado_factura = 'ABIERTA') $filtro_buscar_mesa $ordenar_consulta";
} else {
$mostrar_datos_sql = "SELECT cod_caja_virtual, cuenta, cod_info_gasto_inmueble_detalle_venta, cod_tercero, fecha_anyo, cod_administrador, 
fecha_hora, cod_base_caja, nombre_producto, 
fecha_modificacion, cod_tercero_propietario, cod_factura FROM tbl15_info_gasto_inmueble_detalle_venta 
WHERE (cuenta = '$cuenta_actual') AND (nombre_estado_factura = 'ABIERTA') $filtro_buscar_mesa $ordenar_consulta";
}
$consulta = mysqli_query($conectar, $mostrar_datos_sql);
while ($datos = mysqli_fetch_assoc($consulta)) {

    $nombre_producto_concat                     = '';
    $cod_info_gasto_inmueble_detalle_venta      = $datos['cod_info_gasto_inmueble_detalle_venta'];
    $cod_caja_virtual                           = $datos['cod_caja_virtual'];
    $cuenta                                     = $datos['cuenta'];
    $cod_tercero_inquilino                      = $datos['cod_tercero'];
    $cod_tercero_propietario                    = $datos['cod_tercero_propietario'];
    $fecha_anyo                                 = $datos['fecha_anyo'];
    $fecha_hora                                 = $datos['fecha_hora'];
    $cod_administrador                          = $datos['cod_administrador'];
    $cod_base_caja                              = $datos['cod_base_caja'];
    $cod_factura                                = $datos['cod_factura'];
    $nombre_producto                            = $datos['nombre_producto'];

    $sql_info_usuario = "SELECT cuenta, nombres, apellidos FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador')";
    $consulta_info_usuario = mysqli_query($conectar, $sql_info_usuario);
    $datos_info_usuario = mysqli_fetch_assoc($consulta_info_usuario);

    $nombres                            = $datos_info_usuario['nombres'];
    $apellidos                          = $datos_info_usuario['apellidos'];
    $nombre_usuario                     = $nombres.' '.$apellidos;
    $cuenta_usuario                     = $datos_info_usuario['cuenta'];

    $sql_datos_venta_temp = "SELECT nombre_gasto_inmueble_detalle, descripcion_gasto_inmueble_detalle 
    FROM tbl15_gasto_inmueble_detalle_venta_temporal WHERE (cod_info_gasto_inmueble_detalle_venta = '$cod_info_gasto_inmueble_detalle_venta') ORDER BY cod_gasto_inmueble_detalle_venta_temporal DESC $limite_mostrar_registro";
    $consulta_datos_venta_temp = mysqli_query($conectar, $sql_datos_venta_temp);
    while ($datos_venta_temp = mysqli_fetch_assoc($consulta_datos_venta_temp)) {

        $nombre_producto_con                        = $datos_venta_temp['nombre_gasto_inmueble_detalle'];
        $descripcion_gasto_inmueble_detalle_con     = $datos_venta_temp['descripcion_gasto_inmueble_detalle'];
        $nombre_producto_concat                    .= "".$nombre_producto_con.' | '.$descripcion_gasto_inmueble_detalle_con.'<br>';
    }
     
    $sql_datos_venta_temp_total = "SELECT SUM(precio_venta_producto) AS total_precio_venta_producto FROM tbl15_gasto_inmueble_detalle_venta_temporal WHERE (cod_info_gasto_inmueble_detalle_venta = '$cod_info_gasto_inmueble_detalle_venta')";
    $consulta_datos_venta_temp_total = mysqli_query($conectar, $sql_datos_venta_temp_total);
    $datos_venta_temp_total = mysqli_fetch_assoc($consulta_datos_venta_temp_total);

    $total_precio_venta_producto_ciclo       = $datos_venta_temp_total['total_precio_venta_producto'];


    $sql_inquilino = "SELECT nombre1_tercero FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero_inquilino')";
    $consulta_inquilino = mysqli_query($conectar, $sql_inquilino) or die(mysqli_error($conectar));
    $datos_inquilino = mysqli_fetch_assoc($consulta_inquilino);

    $nombre1_tercero_inquilino      = $datos_inquilino['nombre1_tercero'];

    $sql_propietario = "SELECT nombre1_tercero FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero_propietario')";
    $consulta_propietario = mysqli_query($conectar, $sql_propietario) or die(mysqli_error($conectar));
    $datos_propietario = mysqli_fetch_assoc($consulta_propietario);

    $nombre1_tercero_propietario      = $datos_propietario['nombre1_tercero'];
?>
<tr>

<td style="text-align:center;"><h3><?php echo $cod_factura;?></h3></td>

<td style="text-align:left;"><a href="../admin/entrar_sesion_egreso_ingreso_detalle_temporal_caja_virtual.php?cod_info_gasto_inmueble_detalle_venta=<?php echo $cod_info_gasto_inmueble_detalle_venta ?>&cuenta=<?php echo $cuenta ?>&cod_caja_virtual=<?php echo $cod_caja_virtual ?>&cod_base_caja=<?php echo $cod_base_caja ?>&pagina=<?php echo $pagina ?>"><?php echo $nombre_producto_concat; ?></a></td>

<td style="text-align:left;"><a href="../admin/entrar_sesion_egreso_ingreso_detalle_temporal_caja_virtual.php?cod_info_gasto_inmueble_detalle_venta=<?php echo $cod_info_gasto_inmueble_detalle_venta ?>&cuenta=<?php echo $cuenta ?>&cod_caja_virtual=<?php echo $cod_caja_virtual ?>&cod_base_caja=<?php echo $cod_base_caja ?>&pagina=<?php echo $pagina ?>"><?php echo $nombre1_tercero_propietario.' | '.$nombre_producto; ?></a></td>
<td style="text-align:center;"><a href="../admin/entrar_sesion_egreso_ingreso_detalle_temporal_caja_virtual.php?cod_info_gasto_inmueble_detalle_venta=<?php echo $cod_info_gasto_inmueble_detalle_venta ?>&cuenta=<?php echo $cuenta ?>&cod_caja_virtual=<?php echo $cod_caja_virtual ?>&cod_base_caja=<?php echo $cod_base_caja ?>&pagina=<?php echo $pagina ?>"><?php echo number_format($total_precio_venta_producto_ciclo, 0, ",", "."); ?></a></td>
<td style="text-align:center;"><?php echo $cod_info_gasto_inmueble_detalle_venta ?></td>
<?php if ($cod_estado_eliminar_caja_mesa_virtual=='1') { ?>
<td style="text-align:center;"><a href="../admin/eliminar_caja_virtual_info_egreso_ingreso_detalle_venta.php?cod_info_gasto_inmueble_detalle_venta=<?php echo $cod_info_gasto_inmueble_detalle_venta ?>&cuenta=<?php echo $cuenta ?>&cod_caja_virtual=<?php echo $cod_caja_virtual ?>&cod_base_caja=<?php echo $cod_base_caja ?>&pagina=<?php echo $pagina_local ?>"><img src=../imagenes/eliminar.png alt="eliminar"></td>
<?php } ?>
</tr>
<?php } ?>
</table>
</div>
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
</body>
</html>
