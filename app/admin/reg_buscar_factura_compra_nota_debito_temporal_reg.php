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
<a href="../admin/menu_lista.php"><h4></a>
</div>
-->
<table class="table table-striped">
    <tr>
        <th style="text-align:center"><font size='+1'><a href="../admin/buscar_info_factura_compra_nota_debito.php">Nota Debito Para Factura de Compra (Devolución Factura Compra)</a></font></th>
    </tr>
</table>

<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
if (isset($_GET['cod_info_factura_compra'])) {

    $pagina                            = $_SERVER['PHP_SELF'];
    $pagina_local                      = $_SERVER['PHP_SELF'];
    $cod_info_factura_compra            = intval($_GET['cod_info_factura_compra']);
    $origen                            = 'PARACLINICOS';

    $incre                             = 0;
    $tab                               = 'tbl15_factura_compra_producto';
    $campo                             = 'cod_factura_compra_producto';
    $tipo                              = 'eliminar';
    $tab2                              = 'tbl15_factura_compra_producto_eliminar_sin_devolucion';
    $tab3                              = 'tbl15_info_factura_compra';
    $campo3                            = 'cod_info_factura_compra';
    $nombre_modulo_puc                 = 'COMPRAS';
    $fecha_ymd                         = date("Y-m-d");

    $sql_resol_fact = "SELECT MAX(cod_resolucion_facturacion) AS cod_resolucion_facturacion FROM tbl15_resolucion_facturacion WHERE (nombre_tipo_resolucion_facturacion = 'NOTA DEBITO')";
    $consulta_resol_fact = mysqli_query($conectar, $sql_resol_fact) or die(mysqli_error($conectar));
    $total_datos_resol_fact = mysqli_num_rows($consulta_resol_fact);
    $matriz_resol_fact = mysqli_fetch_assoc($consulta_resol_fact);

    $cod_resolucion_facturacion_nota_debito       = $matriz_resol_fact['cod_resolucion_facturacion'];
    ?>
    <!-- ***************************************************************************************************************************** -->
    <?php
    $datos_factura = "SELECT cod_factura_compra_producto FROM tbl15_factura_compra_producto WHERE (cod_info_factura_compra = '$cod_info_factura_compra')";
    $consulta = mysqli_query($conectar, $datos_factura);
    $total_datos = mysqli_num_rows($consulta);

    $suma_temporal = "SELECT  Sum(total_compra_producto) As total_compra_producto, Sum(total_costo_producto) As total_compra, Sum(peso_producto * und_venta) As total_peso_producto 
    FROM tbl15_factura_compra_producto WHERE (cod_info_factura_compra = '$cod_info_factura_compra')";
    $consulta_temporal = mysqli_query($conectar, $suma_temporal);
    $matriz_temporal = mysqli_fetch_assoc($consulta_temporal);

    $total_compra_producto                         = $matriz_temporal['total_compra_producto'];
    $total_peso_producto                 = $matriz_temporal['total_peso_producto'];

    $datos_data_info_factura = "SELECT * FROM tbl15_info_factura_compra WHERE (cod_info_factura_compra = '$cod_info_factura_compra')";
    $consulta_data_info_factura = mysqli_query($conectar, $datos_data_info_factura);
    $data_info_factura = mysqli_fetch_assoc($consulta_data_info_factura);
    $factura_ocupada = mysqli_num_rows($consulta_data_info_factura);

    $cod_info_factura_compra                                     = $data_info_factura['cod_info_factura_compra'];
    $cod_factura                                                 = $data_info_factura['cod_factura'];
    $cod_tercero                                                 = $data_info_factura['cod_tercero'];
    $cod_empresa                                                 = $data_info_factura['cod_empresa'];
    $nombre_empresa                                              = $data_info_factura['nombre_empresa'];
    $razonsocial_empresa                                         = $data_info_factura['razonsocial_empresa'];
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
    $fecha_entrega                                               = $data_info_factura['fecha_entrega'];
    $url_img_orig_producto                                       = $data_info_factura['url_img_orig_producto'];
    $tiempo_ejecucion                                            = $data_info_factura['tiempo_ejecucion'];
    $tiempo_ejecucion_dian_dataico                               = $data_info_factura['tiempo_ejecucion_dian_dataico'];
    $cod_puc                                                     = $data_info_factura['cod_puc'];
    $cod_movimiento_contable_cuenta_personal                     = $data_info_factura['cod_movimiento_contable_cuenta_personal'];
    $cod_movimiento_caja                                         = $data_info_factura['cod_movimiento_caja'];

    $obtener_cliente = "SELECT * FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
    $resultado_cliente = mysqli_query($conectar, $obtener_cliente) or die(mysqli_error($conectar));
    $matriz_cliente = mysqli_fetch_assoc($resultado_cliente);

    $cliente                             = $matriz_cliente['nombre1_tercero'].' '.$matriz_cliente['nombre2_tercero'].' '.$matriz_cliente['apellido1_tercero'].' '.$matriz_cliente['apellido2_tercero'].' - '.$matriz_cliente['identificacion_tercero'];
    $cedula_cli                          = $matriz_cliente['identificacion_tercero'];
    $direccion_cli                       = $matriz_cliente['direccion_tercero'];
    $nombre_tipo_identificacion          = $matriz_cliente['nombre_tipo_identificacion'];
    $digito_tercero                      = $matriz_cliente['digito_tercero'];
    if (($digito_tercero == '0') || ($digito_tercero == '')) { $digito_tercero = ''; } else { $digito_tercero = '-'.$matriz_cliente['digito_tercero']; }


    $datos_info_cli = "SELECT * FROM tbl15_empresa WHERE nombre_empresa = '$nombre_empresa'";
    $consulta_info_cli = mysqli_query($conectar, $datos_info_cli);
    $info_cli = mysqli_fetch_assoc($consulta_info_cli);

    $razonsocial_empresa                 = $info_cli['razonsocial_empresa'];
    $direccion_empresa                   = $info_cli['direccion_empresa'];
    $telefono_empresa                    = $info_cli['telefono_empresa'];
    $nit_empresa                         = $info_cli['nit_empresa'];
    $cod_tipo_facturacion                = $info_cli['cod_tipo_facturacion'];

    $datos_info_admin = "SELECT cuenta FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador'";
    $consulta_info_admin = mysqli_query($conectar, $datos_info_admin);
    $info_admin = mysqli_fetch_assoc($consulta_info_admin);

    $cuenta                      = $info_admin['cuenta'];

    $datos_info_resolucion_facturacion = "SELECT * FROM tbl15_resolucion_facturacion WHERE cod_resolucion_facturacion = '$cod_resolucion_facturacion'";
    $consulta_info_resolucion_facturacion = mysqli_query($conectar, $datos_info_resolucion_facturacion);
    $info_resolucion_facturacion = mysqli_fetch_assoc($consulta_info_resolucion_facturacion);

    $nombre_tipo_resolucion_facturacion = $info_resolucion_facturacion['nombre_tipo_resolucion_facturacion'];
    $prefijo_resolucion_facturacion = $info_resolucion_facturacion['prefijo_resolucion_facturacion'];

    $sql_tipo_pago = "SELECT nombre_tipo_pago FROM tbl15_tipo_pago WHERE cod_tipo_pago = '$cod_tipo_pago'";
    $consulta_tipo_pago = mysqli_query($conectar, $sql_tipo_pago) or die(mysqli_error($conectar));
    $datos_tipo_pago = mysqli_fetch_assoc($consulta_tipo_pago);

    $nombre_tipo_pago              = $datos_tipo_pago['nombre_tipo_pago'];

    $sql_forma_pago = "SELECT nombre_tipo_forma_pago FROM tbl15_tipo_forma_pago WHERE cod_tipo_forma_pago = '$cod_tipo_forma_pago'";
    $consulta_forma_pago = mysqli_query($conectar, $sql_forma_pago) or die(mysqli_error($conectar));
    $datos_forma_pago = mysqli_fetch_assoc($consulta_forma_pago);

    $nombre_tipo_forma_pago        = $datos_forma_pago['nombre_tipo_forma_pago'];
    ?>
    <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
    <div class="table-responsive">
    <!-- ***************************************************************************************************************************** -->
    <table class="table table-striped" border="1" cellspacing="0" cellpadding="0">
    <thead>
        <tr>
            <th style="text-align:center;">CODIGO</th>
            <th style="text-align:center;">NOMBRE CONCEPTO</th>
            <th style="text-align:center;">CANTIDAD</th>
            <th style="text-align:center;">U/M</th>
            <th style="text-align:center;">PRECIO VENTA</th>
            <th style="text-align:center;">VALOR TOTAL</th>
        </tr>
    </thead>
    <tbody>
    <?php
    $sql_factura_compra_producto = "SELECT * FROM tbl15_factura_compra_producto WHERE (cod_info_factura_compra = '$cod_info_factura_compra') ORDER BY cod_factura_compra_producto DESC";
    $consulta_factura_compra_producto = mysqli_query($conectar, $sql_factura_compra_producto);
    while ($datos_factura_compra_producto = mysqli_fetch_assoc($consulta_factura_compra_producto)) {

        $cod_factura_compra_producto       = $datos_factura_compra_producto['cod_factura_compra_producto'];
        $cod_producto                      = $datos_factura_compra_producto['cod_producto'];
        $cod_producto_barra                = $datos_factura_compra_producto['cod_producto_barra'];
        $nombre_producto                   = $datos_factura_compra_producto['nombre_producto'];
        $cedula                            = $datos_factura_compra_producto['cedula'];
        $nombre_cliente                    = $datos_factura_compra_producto['nombre_cliente'];
        $und_compra                         = $datos_factura_compra_producto['und_compra'];
        $precio_compra_producto            = $datos_factura_compra_producto['precio_compra_producto'];
        $precio_costo_producto             = $datos_factura_compra_producto['precio_costo_producto'];
        $total_costo_producto              = $datos_factura_compra_producto['total_costo_producto'];
        $total_compra_producto             = $datos_factura_compra_producto['total_compra_producto'];
        $nombre_tipo_producto              = $datos_factura_compra_producto['nombre_tipo_producto'];
        $nombre_tipo_unidad_medida         = $datos_factura_compra_producto['nombre_tipo_unidad_medida'];
        $posologia_cantidad                = $datos_factura_compra_producto['posologia_cantidad'];
        $posologia_peso                    = $datos_factura_compra_producto['posologia_peso'];
        $nombre_tipo_presentacion          = $datos_factura_compra_producto['nombre_tipo_presentacion'];
        $nombre_via_administracion         = $datos_factura_compra_producto['nombre_via_administracion'];
        $nombre_frec_duracion              = $datos_factura_compra_producto['nombre_frec_duracion'];
        $cod_tipo_cobrar                   = $datos_factura_compra_producto['cod_tipo_cobrar'];
        $cod_info_factura_compra           = $datos_factura_compra_producto['cod_info_factura_compra'];
        $nombre_tipo_precio_venta          = $datos_factura_compra_producto['nombre_tipo_precio_venta'];
        $peso_producto                     = $datos_factura_compra_producto['peso_producto'];
        $unidad_medida_peso                = $datos_factura_compra_producto['unidad_medida_peso'];
    ?>
        <tr>
            <td style="text-align:center;"><?php echo $cod_producto_barra ?></td>
            <td style="text-align:left;" ><?php echo $nombre_producto ?></td>
            <td style="text-align:center;"><?php echo $und_compra;?></td>
            <td style="text-align:center;"><?php echo $nombre_tipo_unidad_medida;?></td>
            <td style="text-align:right;"><?php echo number_format($precio_compra_producto, 0, ",", "."); ?></td>
            <td style="text-align:right;"><?php echo number_format($total_compra_producto, 0, ",", ".");?></td>
        </tr>
    <?php } ?>
    </tbody>
    </table>
    </div>
<?php
}
?>
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
