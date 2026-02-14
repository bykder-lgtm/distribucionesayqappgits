<?php include_once('../admin/01_modulo_diseno_superior_aplicacion_tv.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
<?php include_once('../admin/02_modulo_estilo_css_aplicacion_tv.php'); ?>
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
        </div>
        <!-- Sidebar End -->

        <!-- Content Start -->
        <div class="content">

            <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-user-edit"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <h5 class="text-primary">App Tv</h5>
            </nav>
<?php
$cod_info_factura_venta            = intval($_GET['cod_info_factura_venta']);
$pagina                            = $_GET['pagina'];
$pagina_local                      = $_SERVER['PHP_SELF'];
$incre                             = 0;
$tab                               = 'tbl15_venta_producto_temporal';
$campo                             = 'cod_venta_producto_temporal';
$tipo                              = 'eliminar';
$cod_estado_vacuna                 = '0';

$nombre_tipo_moneda                = "COP";
$nombre_tipo_factura               = "POS";
$cod_estado_vacuna                 = "0";

$time_seg                          = time();
$fecha                             = date("Ymd");
$hora                              = date("His");

if (isset($_GET['foco'])) { $foco = addslashes($_GET['foco']); } else { $foco = 'busqueda'; }
if (isset($_GET['buscar_por'])) { $buscar_por = addslashes($_GET['buscar_por']); } else { $buscar_por = $nombre_buscar_por; }


$datos_factura = "SELECT cod_venta_producto_temporal FROM tbl15_venta_producto_temporal WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
$consulta = mysqli_query($conectar, $datos_factura);
$total_datos = mysqli_num_rows($consulta);

$suma_temporal = "SELECT Sum(total_venta_producto) As total_venta, Sum(total_costo_producto) As total_compra FROM tbl15_venta_producto_temporal 
WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
$consulta_temporal = mysqli_query($conectar, $suma_temporal);
$matriz_temporal = mysqli_fetch_assoc($consulta_temporal);

$total_venta                 = $matriz_temporal['total_venta'];

$datos_data_info_factura = "SELECT * FROM tbl15_info_factura_venta WHERE (nombre_estado_factura = 'ABIERTA') AND (cod_info_factura_venta = '$cod_info_factura_venta')";
$consulta_data_info_factura = mysqli_query($conectar, $datos_data_info_factura);
$data_info_factura = mysqli_fetch_assoc($consulta_data_info_factura);
$factura_ocupada = mysqli_num_rows($consulta_data_info_factura);

$cod_info_factura_venta      = $data_info_factura['cod_info_factura_venta'];
$cod_factura                 = $data_info_factura['cod_factura'];
$cod_tercero                 = $data_info_factura['cod_tercero'];
$cod_historia_clinica        = $data_info_factura['cod_historia_clinica'];
$fecha_ini                   = $data_info_factura['fecha_ini'];
$fecha_fin                   = $data_info_factura['fecha_fin'];
$cod_empresa                 = $data_info_factura['cod_empresa'];
$nombre_empresa              = $data_info_factura['nombre_empresa'];
$razonsocial_empresa         = $data_info_factura['razonsocial_empresa'];
$total_motivo                = $data_info_factura['total_motivo'];
$total_muestra               = $data_info_factura['total_muestra'];
$fecha_ymdhis                = $data_info_factura['fecha_ymdhis'];
$cuenta                      = $data_info_factura['cuenta'];
$cod_estado_factura          = $data_info_factura['cod_estado_factura'];
$cod_base_caja               = $data_info_factura['cod_base_caja'];
$descuento_ptj               = $data_info_factura['descuento_ptj'];
$iva_ptj                     = $data_info_factura['iva_ptj'];
$flete_ptj                   = $data_info_factura['flete_ptj'];
$cod_cliente                 = $data_info_factura['cod_cliente'];
$vlr_cancelado               = $data_info_factura['vlr_cancelado'];
$vlr_vuelto                  = $data_info_factura['vlr_vuelto'];
$fecha_dia                   = $data_info_factura['fecha_dia'];
$fecha_mes                   = $data_info_factura['fecha_mes'];
$fecha_anyo                  = $data_info_factura['fecha_anyo'];
$anyo                        = $data_info_factura['anyo'];
$fecha_hora                  = $data_info_factura['fecha_hora'];
$fecha_remision              = $data_info_factura['fecha_remision'];
$nombre_ccosto               = $data_info_factura['nombre_ccosto'];
$garantia_meses              = $data_info_factura['garantia_meses'];
$observacion                 = $data_info_factura['observacion'];
$cod_tipo_pago               = $data_info_factura['cod_tipo_pago'];
$cod_administrador           = $data_info_factura['cod_administrador'];
$nombre_tipo_producto        = $data_info_factura['nombre_tipo_producto'];
$total_precio_compra         = $data_info_factura['total_precio_compra'];
$total_precio_venta          = $data_info_factura['total_precio_venta'];
$cod_dependencia             = $data_info_factura['cod_dependencia'];
$servicio                    = $data_info_factura['servicio'];
$cod_tipo_forma_pago         = $data_info_factura['cod_tipo_forma_pago'];
$nombre_tipo_forma_pago      = $data_info_factura['nombre_tipo_forma_pago'];
$descripcion_tipo_forma_pago = $data_info_factura['descripcion_tipo_forma_pago'];
$nombre_tipo_factura         = $data_info_factura['nombre_tipo_factura'];
$nombre_tipo_moneda          = $data_info_factura['nombre_tipo_moneda'];
$cod_cierre_caja             = $data_info_factura['cod_cierre_caja'];
$fecha_creacion              = $data_info_factura['fecha_creacion'];
$fecha_modificacion          = $data_info_factura['fecha_modificacion'];
$nombre_maquina              = $data_info_factura['nombre_maquina'];
$cod_tipo_cobrar             = $data_info_factura['cod_tipo_cobrar'];
$cod_estado_vacuna           = $data_info_factura['cod_estado_vacuna'];
$cod_resolucion_facturacion  = $data_info_factura['cod_resolucion_facturacion'];
$cod_tipo_inventario         = $data_info_factura['cod_tipo_inventario'];
$observacion_tercero         = $data_info_factura['observacion_tercero'];
$cod_prioridad               = $data_info_factura['cod_prioridad'];
$cod_info_factura_strpad     = str_pad($cod_info_factura_venta, 6, "0", STR_PAD_LEFT);

$sql_user_tercero = "SELECT nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
$consulta_user_tercero = mysqli_query($conectar, $sql_user_tercero);
$matriz_user_tercero = mysqli_fetch_assoc($consulta_user_tercero);

$nombres_tercero             = $matriz_user_tercero['nombre1_tercero'].' '.$matriz_user_tercero['nombre2_tercero'].' '.$matriz_user_tercero['apellido1_tercero'].' '.$matriz_user_tercero['apellido2_tercero'];

$tab                         = 'tbl15_venta_producto_temporal';
$tipo                        = 'eliminar';
$campo                       = 'cod_venta_producto_temporal';

if ($cod_seguridad == '1') { $condicion_inventario = 'cod_tipo_inventario = "1" OR cod_tipo_inventario = "2"'; } else { $condicion_inventario = 'cod_tipo_inventario = "1"'; }

if (($cod_origen_produccion_user == '1') && ($cod_estado_filtro_aplicacion_chef_bartender_global == '1')) { //1 ES COCINA
    $condic_estado_info = "AND (cod_estado_cocina = '0')"; 
    $condic_estado_venta_temp = "AND (cod_estado_revisado_cocina = '0')"; 
    $condic_origen_produccion_user = "AND (cod_origen_produccion = '".$cod_origen_produccion_user."')"; 
    $condic_estado_revisado_info = ", cod_estado_revisado = '0'"; 
    $condic_estado_revisado_venta_temp = ", cod_estado_revisado = '0'"; 
} 
elseif (($cod_origen_produccion_user == '2') && ($cod_estado_filtro_aplicacion_chef_bartender_global == '1')) { //2 ES BARTENDER
    $condic_estado_info = "AND (cod_estado_bartender = '0')"; 
    $condic_estado_venta_temp = "AND (cod_estado_revisado_bartender = '0')"; 
    $condic_origen_produccion_user = "AND (cod_origen_produccion = '".$cod_origen_produccion_user."')"; 
    $condic_estado_revisado_info = ", cod_estado_revisado = '0'"; 
    $condic_estado_revisado_venta_temp = ", cod_estado_revisado = '0'"; 
} 
elseif (($cod_origen_produccion_user == '3') && ($cod_estado_filtro_aplicacion_chef_bartender_global == '1')) { //3 ES JUGUERIA
    $condic_estado_info = "AND (cod_estado_jugueria = '0')"; 
    $condic_estado_venta_temp = "AND (cod_estado_revisado_jugueria = '0')"; 
    $condic_origen_produccion_user = "AND (cod_origen_produccion = '".$cod_origen_produccion_user."')"; 
    $condic_estado_revisado_info = ", cod_estado_revisado = '0'"; 
    $condic_estado_revisado_venta_temp = ", cod_estado_revisado = '0'"; 
} 
else { 
    $condic_estado_info = "AND (cod_estado_revisado_universal = '0')"; 
    $condic_estado_venta_temp = "AND (cod_estado_revisado_universal = '0')"; 
    $condic_origen_produccion_user = ""; 
    $condic_estado_revisado_info = ", cod_estado_revisado = '0'"; 
}

$sql_permiso_usuario = "SELECT nombres, apellidos, cod_estado_origen_produccion, cod_origen_produccion_user FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador')";
$consulta_permiso_usuario = mysqli_query($conectar, $sql_permiso_usuario) or die(mysqli_error($conectar));
$matriz_permiso_usuario = mysqli_fetch_assoc($consulta_permiso_usuario);

$nombres_vendedor                                                  = $matriz_permiso_usuario['nombres'].' '.$matriz_permiso_usuario['apellidos'];

?>
            <!-- Table Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">

                    <div class="col-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h3 class="text-primary"><a href="../admin/lista_caja_virtual_cocina_aplicacion_tv.php?pagina=<?php echo $pagina ?>"><?php echo $nombre_concepto_multi_virtual; ?>S PEDIDOS</a></h3>
                            <div class="table-responsive">

                            <table class="table table-dark table-hover table-bordered">
                              <tr>
                                <th style="text-align:center;">REGRESAR</th>
                                <th style="text-align:center;">ID</th>
                                <th style="text-align:center;"><?php echo $nombre_concepto_multi_virtual; ?></th>
                                <th style="text-align:center;">PRIORIDAD</th>
                                <th style="text-align:center;">VENDEDOR</th>
                                <th style="text-align:center;">FECHA</th>
                                <th style="text-align:center;">ATENDIDO</th>
                                <!--<th style="text-align:center;">TERCERO</th>-->
                                <!--<th style="text-align:center;">TOTAL FACTURA</th>-->
                              </tr>
                              <tr>
                                <td style="text-align:center;"><a href="../admin/lista_caja_virtual_cocina_aplicacion_tv.php"><img src=../imagenes/btn_regresar.png alt="btn_regresar"></td>
                                <td style="text-align:center;"><?php echo $cod_info_factura_venta ?></td>
                                <td style="text-align:center;"><?php echo $cod_base_caja ?></td>
                                <td style="text-align:center;"><?php echo $cod_prioridad ?></td>
                                <td style="text-align:center;"><?php echo $nombres_vendedor ?></td>
                                <td style="text-align:center;"><?php echo $fecha_anyo ?></td>
                                <td style="text-align:center;"><a href="../admin/entregar_servicio_comida_caja_virtual.php?cod_info_factura_venta=<?php echo $cod_info_factura_venta ?>&cod_caja_virtual=<?php echo $cod_caja_virtual ?>&pagina=<?php echo $pagina ?>"><img src=../imagenes/entregar_servicio_comida.png alt="entregar_servicio_comida"></td>
                               <!--<td style="text-align:center;"><?php echo $nombres_tercero ?></td>-->
                                <!--<td style="text-align:center; font-size:30;" id="total_venta"><?php echo number_format($total_venta, 0, ",", "."); ?></td>-->
                              </tr>
                            </table>

                                <div id="refrescar_automatico_ajax">
                                    <table class="table table-dark table-hover table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="text-align:center;">CODIGO</th>
                                                <th style="text-align:center;">NOMBRE CONCEPTO</th>
                                                <th style="text-align:center;">CANTIDAD</th>
                                                <?php if ($cod_estado_comentario_venta_global == '1') { ?><th style="text-align:center;">OBSERVACION</th><?php } ?>
                                                <th style="text-align:center;">FECHA - HORA</th>
                                                <!--<th style="text-align:center;">ATENDIDO</th>-->
                                                <!--
                                                <th style="text-align:center;">VALOR UNITARIO</th>
                                                <th align="center"></th>
                                                <th style="text-align:center;">VALOR TOTAL</th>
                                                -->
                                            </tr>
                                        </thead>
                                        <tbody>
<?php
$nombre_producto_concat             = '';
$salida_tra                         = '';

$sql_venta_producto_temporal = "SELECT * FROM tbl15_venta_producto_temporal WHERE (cod_info_factura_venta = '$cod_info_factura_venta' $condic_origen_produccion_user) 
ORDER BY cod_venta_producto_temporal DESC";
$consulta_venta_producto_temporal = mysqli_query($conectar, $sql_venta_producto_temporal);
while ($datos_venta_producto_temporal = mysqli_fetch_assoc($consulta_venta_producto_temporal)) {

    $cod_venta_producto_temporal       = $datos_venta_producto_temporal['cod_venta_producto_temporal'];
    $cod_producto                      = $datos_venta_producto_temporal['cod_producto'];
    $cod_producto_barra                = $datos_venta_producto_temporal['cod_producto_barra'];
    $nombre_producto                   = $datos_venta_producto_temporal['nombre_producto'];
    $cedula                            = $datos_venta_producto_temporal['cedula'];
    $nombre_cliente                    = $datos_venta_producto_temporal['nombre_cliente'];
    $und_venta                         = $datos_venta_producto_temporal['und_venta'];
    $precio_costo_producto             = $datos_venta_producto_temporal['precio_costo_producto'];
    $precio_compra_producto            = $datos_venta_producto_temporal['precio_compra_producto'];
    $total_costo_producto              = $datos_venta_producto_temporal['total_costo_producto'];
    $precio_venta_producto             = $datos_venta_producto_temporal['precio_venta_producto'];
    $total_venta_producto              = $datos_venta_producto_temporal['total_venta_producto'];
    $nombre_tipo_producto              = $datos_venta_producto_temporal['nombre_tipo_producto'];
    $nombre_tipo_unidad_medida         = $datos_venta_producto_temporal['nombre_tipo_unidad_medida'];
    $posologia_cantidad                = $datos_venta_producto_temporal['posologia_cantidad'];
    $posologia_peso                    = $datos_venta_producto_temporal['posologia_peso'];
    $nombre_tipo_presentacion          = $datos_venta_producto_temporal['nombre_tipo_presentacion'];
    $nombre_via_administracion         = $datos_venta_producto_temporal['nombre_via_administracion'];
    $nombre_frec_duracion              = $datos_venta_producto_temporal['nombre_frec_duracion'];
    $cod_tipo_cobrar                   = $datos_venta_producto_temporal['cod_tipo_cobrar'];
    //$cod_info_factura_venta            = $datos_venta_producto_temporal['cod_info_factura_venta'];
    $nombre_tipo_precio_venta          = $datos_venta_producto_temporal['nombre_tipo_precio_venta'];
    $cod_estado_permitir_venta         = $datos_venta_producto_temporal['cod_estado_permitir_venta'];
    $und_producto                      = $datos_venta_producto_temporal['und_producto'];

    $comentario_producto               = $datos_venta_producto_temporal['comentario_producto'];
    $placa_producto                    = $datos_venta_producto_temporal['placa_producto'];
    $fecha_ymd_parqueo_ini             = $datos_venta_producto_temporal['fecha_ymd_parqueo_ini'];
    $fecha_hora_parqueo_ini            = $datos_venta_producto_temporal['fecha_hora_parqueo_ini'];
    $fecha_ymd_parqueo_fin             = $datos_venta_producto_temporal['fecha_ymd_parqueo_fin'];
    $fecha_hora_parqueo_fin            = $datos_venta_producto_temporal['fecha_hora_parqueo_fin'];
    $cod_estado_revisado_cocina        = $datos_venta_producto_temporal['cod_estado_revisado_cocina'];
    $fecha_seg_venta_producto          = date("Y-m-d H:i:s", $datos_venta_producto_temporal['fecha_seg_venta_producto']);

    if ($cod_estado_permitir_venta == 1) { $imagen = '<img src=../imagenes/incorrecto.png alt="Listo">'; } else { $imagen = '<img src=../imagenes/correctok.png alt="Listo">'; }
    if ($cod_estado_venta_prod_en_cero_global == '1') { $max_und_venta = "max=".$und_producto; } else { $max_und_venta = ""; }
    if ($cod_estado_venta_precio_min_venta_global == '1') { $min_precio_venta = "min=".$precio_compra_producto; } else { $min_precio_venta = ""; }

    if ($cod_tipo_sistema_numeracion_und_venta == '2') { $und_venta = intval($und_venta); } else { $und_venta = $und_venta; }
    if ($cod_tipo_sistema_numeracion_precio_compra == '2') { $precio_compra_producto = intval($precio_compra_producto); } else { $precio_compra_producto = $precio_compra_producto; }
    if ($cod_tipo_sistema_numeracion_precio_venta == '2') { $precio_venta_producto = intval($precio_venta_producto); } else { $precio_venta_producto = $precio_venta_producto; }

    if ($cod_estado_revisado_cocina == '0') { 
        $cod_producto_barra = "<mark>".$cod_producto_barra.'</mark>'; 
        $nombre_producto = "<mark>".$nombre_producto.'</mark>'; 
        $und_venta = "<mark>".$und_venta.'</mark>'; 
        $comentario_producto = "<mark>".$comentario_producto.'</mark>'; 
        $fecha_seg_venta_producto = "<mark>".$fecha_seg_venta_producto.'</mark>'; 
    }
    $incre++;
?>
                                            <tr style="text-align:center;" id="tr<?php echo $cod_venta_producto_temporal;?>">
                                                <td style="text-align:center;" id="cod_producto_barra_<?php echo $incre;?>"><?php echo $cod_producto_barra ?></td>
                                                <td style="text-align:left;"  id="nombre_producto_<?php echo $incre;?>"><?php echo $nombre_producto ?></td>
                                                <td style="text-align:center;" id="cod_producto_barra_<?php echo $incre;?>"><?php echo $und_venta ?></td>
                                                <td style="text-align:center;" id="comentario_producto_<?php echo $incre;?>"><?php echo $comentario_producto;?></td>
                                                <td style="text-align:center;" id="fecha_seg_venta_producto_<?php echo $incre;?>"><?php echo $fecha_seg_venta_producto;?></td>
                                                <!--<th style="text-align:center;"><a href="../admin/cocina_facturacion_venta_temporal_producto_manual_pos_aplicacion_tv.php?cod_venta_producto_temporal=<?php echo $cod_venta_producto_temporal ?>&cod_info_factura_venta=<?php echo $cod_info_factura_venta ?>&cuenta=<?php echo $cuenta ?>&cod_caja_virtual=<?php echo $cod_caja_virtual ?>&cod_base_caja=<?php echo $cod_base_caja ?>&pagina=<?php echo $pagina_local ?>"><img src=../imagenes/entregar_servicio_comida.png alt="ver"></th>-->
                                                <!--
                                                <td style="text-align:right;" id="precio_venta_producto_<?php echo $incre;?>"><?php echo number_format($precio_venta_producto, 0, ",", "."); ?></td>
                                                <td style="text-align:right;" id="mensaje_alerta<?php echo $incre;?>"></td>
                                                <td style="text-align:right;" id="total_venta_producto<?php echo $incre;?>"><?php echo number_format($total_venta_producto, 0, ",", ".");?></td>
                                                -->
                                            </tr style="text-align:right;" id="tr<?php echo $cod_venta_producto_temporal;?>">
<?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Table End -->
<?php include_once('../admin/04_modulo_footer_aplicacion_tv.php'); ?>
            <!-- Footer End -->
        </div>
        <!-- Content End -->
        <!-- Back to Top -->
    </div>
<?php include_once('../admin/05_modulo_js_aplicacion_tv.php'); ?>
</body>
</html>

<script language="javascript">
setInterval("refrescar_pagina_ajax()",5000);

function refrescar_pagina_ajax(){

    var nombre_estado_factura = 'ABIERTA';
    var cod_estado_cocina = '0';
    var tipo_ajax = 'refrescar';
    var cod_info_factura_venta = <?php echo $cod_info_factura_venta;?>;

    $.ajax({
        type: "POST",
        dataType: 'html',
        url: "../admin/refrescar_pagina_cocina_facturacion_venta_temporal_producto_manual_pos_aplicacion_tv_ajax.php",
        data: "nombre_estado_factura="+nombre_estado_factura+"&cod_estado_cocina="+cod_estado_cocina+"&cod_info_factura_venta="+cod_info_factura_venta+"&tipo_ajax="+tipo_ajax,
        success: function(resp){
            $('#refrescar_automatico_ajax').html(resp);
        }
    })
//console.log("refresco div")
}
</script>