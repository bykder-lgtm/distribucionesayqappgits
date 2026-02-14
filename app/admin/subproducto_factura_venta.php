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
<!--<div class="container">-->
<div class="divPanel page-content">
<!--
<div class="breadcrumbs">
<a href="../admin/menu_lista.php"><h4>Lista de Area a Laborar&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
<a href="../admin/reg_grupo_area.php">Registrar Area a Laborar</h4></a>
</div>
-->
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina                            = $_SERVER['PHP_SELF'];
$pagina_local                      = $_SERVER['PHP_SELF'];
$cod_producto_barra_madre          = addslashes($_GET['cod_producto_barra_madre']);
$cod_info_factura_venta            = intval($_GET['cod_info_factura_venta']);

$origen                            = 'PARACLINICOS';
$incre                             = 0;
$tab                               = 'tbl15_venta_producto';
$campo                             = 'cod_venta_producto';
$tipo                              = 'eliminar';
$tab2                              = 'tbl15_venta_producto_eliminar_sin_devolucion';
$tab3                              = 'tbl15_info_factura_venta';
$campo3                            = 'cod_info_factura_venta';
?>
<div class="table-responsive">
<!-- ***************************************************************************************************************************** -->
<?php
$suma_producto = "SELECT nombre_producto FROM tbl15_producto WHERE (cod_producto_barra = '$cod_producto_barra_madre')";
$consulta_producto = mysqli_query($conectar, $suma_producto);
$matriz_producto = mysqli_fetch_assoc($consulta_producto);

$nombre_producto_madre                                        = $matriz_producto['nombre_producto'];

$datos_factura = "SELECT cod_venta_producto FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
$consulta = mysqli_query($conectar, $datos_factura);
$total_datos = mysqli_num_rows($consulta);

$suma_temporal = "SELECT  Sum(total_venta_producto) As total_venta, Sum(total_costo_producto) As total_compra, Sum(peso_producto * und_venta) As total_peso_producto 
FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
$consulta_temporal = mysqli_query($conectar, $suma_temporal);
$matriz_temporal = mysqli_fetch_assoc($consulta_temporal);

$total_venta                                                 = $matriz_temporal['total_venta'];
$total_peso_producto                                         = $matriz_temporal['total_peso_producto'];

$datos_data_info_factura = "SELECT * FROM tbl15_info_factura_venta WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
$consulta_data_info_factura = mysqli_query($conectar, $datos_data_info_factura);
$data_info_factura = mysqli_fetch_assoc($consulta_data_info_factura);
$factura_ocupada = mysqli_num_rows($consulta_data_info_factura);

$cod_info_factura_venta                                      = $data_info_factura['cod_info_factura_venta'];
$cod_factura                                                 = $data_info_factura['cod_factura'];
$cod_tercero                                                 = $data_info_factura['cod_tercero'];
$cod_historia_clinica                                        = $data_info_factura['cod_historia_clinica'];
$fecha_ini                                                   = $data_info_factura['fecha_ini'];
$fecha_fin                                                   = $data_info_factura['fecha_fin'];
$cod_empresa                                                 = $data_info_factura['cod_empresa'];
$nombre_empresa                                              = $data_info_factura['nombre_empresa'];
$razonsocial_empresa                                         = $data_info_factura['razonsocial_empresa'];
$total_motivo                                                = $data_info_factura['total_motivo'];
$total_muestra                                               = $data_info_factura['total_muestra'];
$fecha_ymdhis                                                = $data_info_factura['fecha_ymdhis'];
$cuenta                                                      = $data_info_factura['cuenta'];
$cod_estado_factura                                          = $data_info_factura['cod_estado_factura'];
$cod_base_caja                                               = $data_info_factura['cod_base_caja'];
$descuento_ptj                                               = $data_info_factura['descuento_ptj'];
$iva_ptj                                                     = $data_info_factura['iva_ptj'];
$flete_ptj                                                   = $data_info_factura['flete_ptj'];
$cod_cliente                                                 = $data_info_factura['cod_cliente'];
$vlr_cancelado                                               = $data_info_factura['vlr_cancelado'];
$vlr_vuelto                                                  = $data_info_factura['vlr_vuelto'];
$fecha_dia                                                   = $data_info_factura['fecha_dia'];
$fecha_mes                                                   = $data_info_factura['fecha_mes'];
$fecha_anyo                                                  = $data_info_factura['fecha_anyo'];
$anyo                                                        = $data_info_factura['anyo'];
$fecha_hora                                                  = $data_info_factura['fecha_hora'];
$fecha_remision                                              = $data_info_factura['fecha_remision'];
$nombre_ccosto                                               = $data_info_factura['nombre_ccosto'];
$garantia_meses                                              = $data_info_factura['garantia_meses'];
$observacion                                                 = $data_info_factura['observacion'];
$cod_tipo_pago                                               = $data_info_factura['cod_tipo_pago'];
$cod_administrador                                           = $data_info_factura['cod_administrador'];
$nombre_tipo_producto                                        = $data_info_factura['nombre_tipo_producto'];
$total_precio_compra                                         = $data_info_factura['total_precio_compra'];
$total_precio_venta                                          = $data_info_factura['total_precio_venta'];
$cod_dependencia                                             = $data_info_factura['cod_dependencia'];
$servicio                                                    = $data_info_factura['servicio'];
$cod_tipo_forma_pago                                         = $data_info_factura['cod_tipo_forma_pago'];
$nombre_tipo_forma_pago                                      = $data_info_factura['nombre_tipo_forma_pago'];
$descripcion_tipo_forma_pago                                 = $data_info_factura['descripcion_tipo_forma_pago'];
$nombre_tipo_factura                                         = $data_info_factura['nombre_tipo_factura'];
$nombre_tipo_moneda                                          = $data_info_factura['nombre_tipo_moneda'];
$cod_cierre_caja                                             = $data_info_factura['cod_cierre_caja'];
$fecha_creacion                                              = $data_info_factura['fecha_creacion'];
$fecha_modificacion                                          = $data_info_factura['fecha_modificacion'];
$nombre_maquina                                              = $data_info_factura['nombre_maquina'];
$cod_tipo_cobrar                                             = $data_info_factura['cod_tipo_cobrar'];
$cod_estado_vacuna                                           = $data_info_factura['cod_estado_vacuna'];
$cod_resolucion_facturacion                                  = $data_info_factura['cod_resolucion_facturacion'];
$cod_cufe                                                    = $data_info_factura['cod_cufe'];
$observacion_tercero                                         = $data_info_factura['observacion_tercero'];
$cod_cuentas_cobrar                                          = $data_info_factura['cod_cuentas_cobrar'];
$fecha_entrega                                               = $data_info_factura['fecha_entrega'];
$url_img_orig_producto                                       = $data_info_factura['url_img_orig_producto'];
$tiempo_ejecucion                                            = $data_info_factura['tiempo_ejecucion'];
$tiempo_ejecucion_dian_dataico                               = $data_info_factura['tiempo_ejecucion_dian_dataico'];
$cod_estado_alquiler_renta                                   = $data_info_factura['cod_estado_alquiler_renta'];
$fecha_ini_renta_alquiler                                    = $data_info_factura['fecha_ini_renta_alquiler'];
$fecha_fin_renta_alquiler                                    = $data_info_factura['fecha_fin_renta_alquiler'];
$cod_domiciliario                                            = $data_info_factura['cod_domiciliario'];
$fecha_pago                                                  = $data_info_factura['fecha_pago'];

$obtener_cliente = "SELECT * FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
$resultado_cliente = mysqli_query($conectar, $obtener_cliente) or die(mysqli_error($conectar));
$matriz_cliente = mysqli_fetch_assoc($resultado_cliente);

$cliente                                                     = $matriz_cliente['nombre1_tercero'].' '.$matriz_cliente['apellido1_tercero'];
$cedula_cli                                                  = $matriz_cliente['identificacion_tercero'];
$direccion_cli                                               = $matriz_cliente['direccion_tercero'];
$nombre_tipo_identificacion                                  = $matriz_cliente['nombre_tipo_identificacion'];
$digito_tercero                                              = $matriz_cliente['digito_tercero'];
if (($digito_tercero == '0') || ($digito_tercero == '')) { $digito_tercero = ''; } else { $digito_tercero = '-'.$matriz_cliente['digito_tercero']; }

$datos_info_admin = "SELECT cuenta FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador'";
$consulta_info_admin = mysqli_query($conectar, $datos_info_admin);
$info_admin = mysqli_fetch_assoc($consulta_info_admin);

$cuenta                                                      = $info_admin['cuenta'];

$nombre_modulo_puc                                           = "";

?>
<script src="../js/jquery-3.2.1.min.js"></script>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table class="table table-striped" border="1" cellspacing="0" cellpadding="20">
  <tr>
    <th style="text-align:center;">PRODUCTO MADRE PRINCIPAL</th>
    <th style="text-align:center;">ID</th>
    <th style="text-align:center;">FECHA VENTA</th>
    <th style="text-align:center;">FACTURA</th>
    <th style="text-align:center;">CLIENTE</th>
    <th style="text-align:center;">TOTAL FACTURA</th>
  </tr>
  <tr>
    <td style="text-align:center;"><?php echo $nombre_producto_madre ?> | <?php echo $cod_producto_barra_madre ?></td>
    <td style="text-align:center;"><?php echo $cod_info_factura_venta ?></td>
    <td style="text-align:center;"><?php echo $fecha_anyo ?><br>HORA: <?php echo $fecha_hora ?></td>
    <td style="text-align:center;"><?php echo $cod_factura ?></td>
    <td style="text-align:center;"><?php echo $cliente ?></td>
    <td style="text-align:center; font-size:30;" id="total_venta"><?php echo number_format($total_venta, 0, ",", "."); ?></td>
  </tr>
</table>

<table class="table table-striped" border="1" cellspacing="0" cellpadding="20">
  <tr>
    <th style="text-align:center;">LISTA DE SUBRPDUCTOS</th>
  </tr>
</table>
<!-- ***************************************************************************************************************************** -->
<table class="table table-striped" border="1" cellspacing="0" cellpadding="0">
<thead>
    <tr>
        <th style="text-align:center;">CODIGO</th>
        <th style="text-align:center;">NOMBRE CONCEPTO</th>
        <th style="text-align:center;">CANTIDAD</th>
        <th style="text-align:center;">U/M</th>
        <th style="text-align:center;">INV</th>
        <th style="text-align:center;">#</th>
    </tr>
</thead>
<tbody>
<?php
$incre = 0;

$sql_venta_producto = "SELECT * FROM tbl15_venta_producto_sub WHERE (cod_producto_barra_madre = '$cod_producto_barra_madre') AND (cod_info_factura_venta = '$cod_info_factura_venta') ORDER BY cod_venta_producto DESC";
$consulta_venta_producto = mysqli_query($conectar, $sql_venta_producto);
while ($datos_venta_producto = mysqli_fetch_assoc($consulta_venta_producto)) {

    $cod_venta_producto                = $datos_venta_producto['cod_venta_producto'];
    $cod_producto                      = $datos_venta_producto['cod_producto'];
    $cod_producto_barra                = $datos_venta_producto['cod_producto_barra'];
    $nombre_producto                   = $datos_venta_producto['nombre_producto'];
    $cedula                            = $datos_venta_producto['cedula'];
    $nombre_cliente                    = $datos_venta_producto['nombre_cliente'];
    $und_venta                         = $datos_venta_producto['und_venta'];
    $precio_compra_producto            = $datos_venta_producto['precio_compra_producto'];
    $precio_costo_producto             = $datos_venta_producto['precio_costo_producto'];
    $total_costo_producto              = $datos_venta_producto['total_costo_producto'];
    $precio_venta_producto             = $datos_venta_producto['precio_venta_producto'];
    $total_venta_producto              = $datos_venta_producto['total_venta_producto'];
    $nombre_tipo_producto              = $datos_venta_producto['nombre_tipo_producto'];
    $nombre_tipo_unidad_medida         = $datos_venta_producto['nombre_tipo_unidad_medida'];
    $posologia_cantidad                = $datos_venta_producto['posologia_cantidad'];
    $posologia_peso                    = $datos_venta_producto['posologia_peso'];
    $nombre_tipo_presentacion          = $datos_venta_producto['nombre_tipo_presentacion'];
    $nombre_via_administracion         = $datos_venta_producto['nombre_via_administracion'];
    $nombre_frec_duracion              = $datos_venta_producto['nombre_frec_duracion'];
    $cod_tipo_cobrar                   = $datos_venta_producto['cod_tipo_cobrar'];
    $cod_info_factura_venta            = $datos_venta_producto['cod_info_factura_venta'];
    $nombre_tipo_precio_venta          = $datos_venta_producto['nombre_tipo_precio_venta'];
    $comentario_producto               = $datos_venta_producto['comentario_producto'];
    $peso_producto                     = $datos_venta_producto['peso_producto'];
    $unidad_medida_peso                = $datos_venta_producto['unidad_medida_peso'];
    $cod_estado_cava                   = $datos_venta_producto['cod_estado_cava'];
    $cajas_sobre                       = intval($datos_venta_producto['cajas_sobre']);
    $und_producto_inv                  = $datos_venta_producto['und_producto_inv'];

    if ($cajas_sobre == '0') { $cajas_sobre = 1; }
    if ($cod_estado_converir_und_a_caja_mostrar_imprimir_global == '1') { 
        if (($nombre_tipo_unidad_medida == '') || ($nombre_tipo_unidad_medida == 'UND')) { 
            $und_venta_presentacion = ($und_venta); 
        } else { 
            $und_venta_presentacion = ($und_venta / $cajas_sobre); 
        }
    } else { 
        if (($nombre_tipo_unidad_medida == '') || ($nombre_tipo_unidad_medida == 'UND')) { 
            $und_venta_presentacion = ($und_venta); 
        } else { 
            $und_venta_presentacion = ($und_venta / $cajas_sobre); 
        }
    }

    if ($cod_estado_cava == '1') { $img_entrega_cava = "<img src=../imagenes/sem_no_atendido_peq.png>"; $url_entrega_cava = "../admin/marcar_cava_entregada.php?cod_info_factura_venta=".$cod_info_factura_venta."&cod_venta_producto=".$cod_venta_producto; } else { $img_entrega_cava = ""; $url_entrega_cava = "#"; }

    $cod_producto_barra_madre = $cod_producto_barra;

    $obtener_producto_principal = "SELECT * FROM tbl15_venta_producto_sub WHERE (cod_producto_barra_madre = '$cod_producto_barra_madre') AND (cod_info_factura_venta = '$cod_info_factura_venta')";
    $resultado_producto_principal = mysqli_query($conectar, $obtener_producto_principal);
    $producto_principal = mysqli_fetch_assoc($resultado_producto_principal);
    $existe_subproducto = mysqli_num_rows($resultado_producto_principal);

    if ($existe_subproducto <> '0') {
        $previsualizar_subproducto_venta = '<a href="#" onclick="obtener_datos_mostrar_subproducto_venta_modal('.$cod_producto_barra_madre.', '.$cod_info_factura_venta.');" data-toggle="modal" data-target=".abrir_previsualizacion_subproducto_venta">'.$nombre_producto.'</a>';
        $url_subproducto_venta = '<a href="../admin/aaaaa.php?cod_producto_barra_madre='.$cod_producto_barra_madre.'&cod_info_factura_venta='.$cod_info_factura_venta.'" target="_blank">'.$nombre_producto.'</a>';
    } else {
        $previsualizar_subproducto_venta = $nombre_producto;
        $url_subproducto_venta = $nombre_producto;
    }
    $incre++;
?>
    <tr style="text-align:center;" id="tr<?php echo $cod_venta_producto;?>">
        <td style="text-align:center;" id="cod_producto_barra_<?php echo $incre;?>"><?php echo $cod_producto_barra ?></td>
        <td style="text-align:left;"  id="nombre_producto_<?php echo $incre;?>"><?php echo $nombre_producto ?></td>
        <td style="text-align:center;" id="und_venta_<?php echo $incre;?>"><?php echo $und_venta;?></td>
        <td style="text-align:center" id="nombre_tipo_unidad_medida_<?php echo $incre;?>"><?php echo $nombre_tipo_unidad_medida;?></td>
        <td style="text-align:center" id="und_producto_inv<?php echo $incre;?>"><?php echo $und_producto_inv;?></td>
        <td style="text-align:center" id="incre<?php echo $incre;?>"><?php echo $incre;?></td>
    </tr style="text-align:right;" id="tr<?php echo $cod_venta_producto;?>">
<?php } ?>
</tbody>
</table>
</div>
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* FIN MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
</div>
<!--End Main Content Area-->
<!--</div>-->
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

<script>
function obtener_datos_mostrar_subproducto_venta_modal(cod_producto_barra_madre, cod_info_factura_venta){

    var cod_producto_barra_madre = cod_producto_barra_madre;
    var cod_info_factura_venta = cod_info_factura_venta;
    //$("#mod_"+"cod_nota_observacion").val(id);
}
</script>