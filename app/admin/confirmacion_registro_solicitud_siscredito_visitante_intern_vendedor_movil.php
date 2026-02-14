<?php 
$nombre_pagina          = "Gestión de Solicitudes";
$cod_seguridad_pag      = "1";
$pagina_local           = $_SERVER['PHP_SELF'];
$cod_base_caja          = "1";
?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include_once("../admin/01_modulo_diseno_superior_visitante_intern_movil.php"); ?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include_once("../admin/01_info_empresa_visitante_intern_movil.php"); ?>
<!-- **************************************************** MODULO DE INFO EMPRESA ******************************************** -->
<?php //include_once("../admin/01_rastreador.php"); ?>

<!DOCTYPE html>
<html lang="es">
<!-- Basic -->
<head>
<title><?php echo ($nombre_pagina) ?> - <?php echo ($keywords) ?> - <?php echo ($titulo) ?></title>
<meta http-equiv="Content-Type"        content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible"     content="IE=edge">
<meta name="viewport"                  content="width=device-width, initial-scale=1">
<meta name="keywords"                  content="<?php echo $keywords ?>">
<meta name="description"               content="<?php echo $nombre_pagina ?>">
<meta name="author"                    content="<?php echo $author ?>">
<meta property="og:url"                content="<?php echo $pagina_local ?>" />
<meta property="og:type"               content="website" />
<meta property="og:title"              content="<?php echo $nombre_pagina ?>" />
<meta property="og:description"        content="<?php echo $nombre_pagina ?>" />
<meta property="og:image"              content="<?php echo ($url_pag) ?>/<?php echo ($nombre_carpeta_pagina) ?>/imagenes/quienes_somos.jpg" />
<meta property="og:site_name"          content="<?php echo $nombre ?>"/>
<meta property="fb:admins"             content="editaxe"/>
<meta name="twitter:card"              content="<?php echo $nombre_pagina ?>">
<meta name="twitter:url"               contnet="<?php echo $pagina_local ?>">
<meta name="twitter:title"             content="<?php echo $nombre_pagina ?>">
<meta name="twitter:description"       content="<?php echo $descripcion_producto ?>">
<meta name="twitter:image"             content="<?php echo ($url_pag) ?>/<?php echo ($nombre_carpeta_pagina) ?>/imagenes/quienes_somos.jpg">

<?php include_once("../admin/03_modulo_css_visitante_intern_movil.php"); ?>
<link rel="stylesheet" href="../estilo_css/normalize_visitante.css">

<link rel="stylesheet" href="../estilo_css/font-awesome.min.css">
<script src="../js/jquery-3.2.1.min_visitante.js"></script>
</head>
<body>
<?php include_once("../admin/01_modulo_encabezado_superior_visitante_intern_movil.php"); ?>
    <!-- Start Cart -->
<?php 
if(isset($_GET['cod_info_factura_venta']) && $_GET['cod_info_factura_venta'] != '') {
    $cod_info_factura_venta = $_GET['cod_info_factura_venta'];


	$calcular_datos_cuenta_cobrar = "SELECT * FROM tbl15_info_factura_venta WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
	$consulta_datos_cuenta_cobrar = mysqli_query($conectar, $calcular_datos_cuenta_cobrar) or die(mysqli_error($conectar));
	$datos_cuenta_cobrar = mysqli_fetch_assoc($consulta_datos_cuenta_cobrar);

    $cod_info_factura_venta                                         = $datos_cuenta_cobrar['cod_info_factura_venta'];
    $monto_deuda                                                    = $datos_cuenta_cobrar['monto_deuda'];
    $monto_cuota                                                    = $datos_cuenta_cobrar['monto_cuota'];
    $cod_tercero                                                    = $datos_cuenta_cobrar['cod_tercero'];
    $cod_factura                                                    = $datos_cuenta_cobrar['cod_factura'];
    $nombres_apellidos                                              = trim($datos_cuenta_cobrar['nombre1_tercero']." ".$datos_cuenta_cobrar['nombre2_tercero']." ".$datos_cuenta_cobrar['apellido1_tercero']." ".$datos_cuenta_cobrar['apellido2_tercero']);
    $direccion_tercero                                              = $datos_cuenta_cobrar['direccion_tercero'];
    $telefono1_tercero                                              = $datos_cuenta_cobrar['telefono1_tercero'];
    $identificacion_tercero                                         = $datos_cuenta_cobrar['identificacion_tercero'];
    $nombre_tipo_cobro                                              = $datos_cuenta_cobrar['nombre_tipo_cobro'];
    $correo_tercero                                                 = $datos_cuenta_cobrar['correo_tercero'];
    $nombre_estado_factura                                          = $datos_cuenta_cobrar['nombre_estado_factura'];
    $cod_resolucion_facturacion                                     = $datos_cuenta_cobrar['cod_resolucion_facturacion'];
    $cod_estado_factura                                             = $datos_cuenta_cobrar['cod_estado_factura'];
    $fecha_creacion                                                 = $datos_cuenta_cobrar['fecha_creacion'];
    $cod_administrador_factura                                      = $datos_cuenta_cobrar['cod_administrador'];
    $cod_tipo_pago                                                  = $datos_cuenta_cobrar['cod_tipo_pago'];
    $cod_tipo_forma_pago                                            = $datos_cuenta_cobrar['cod_tipo_forma_pago'];
    $cod_entidad_crediticia                                         = $datos_cuenta_cobrar['cod_entidad_crediticia'];
    $cod_tienda                                                     = $datos_cuenta_cobrar['cod_tienda'];
    $cod_operador_credito                                           = $datos_cuenta_cobrar['cod_operador_credito'];
    $cod_tipo_forma_pago_operador_credito                           = $datos_cuenta_cobrar['cod_tipo_forma_pago_operador_credito'];
    $cod_administrador_lider                                        = $datos_cuenta_cobrar['cod_administrador_lider'];
    $cod_administrador_coordinador                                  = $datos_cuenta_cobrar['cod_administrador_coordinador'];
    $cod_administrador_asesor                                       = $datos_cuenta_cobrar['cod_administrador_asesor'];
    $cod_administrador_aliado_estrategico                           = $datos_cuenta_cobrar['cod_administrador_aliado_estrategico'];
    $cod_administrador_revisor                                      = $datos_cuenta_cobrar['cod_administrador_revisor'];
    $cod_vendedor                                                   = $datos_cuenta_cobrar['cod_vendedor'];
    $cod_banco_cuenta                                               = $datos_cuenta_cobrar['cod_banco_cuenta'];
    $observacion_tercero                                            = $datos_cuenta_cobrar['observacion_tercero'];
    /* ----------------------------------------------------------------------------------------------------------/ */
    $sql_administrador_lider = "SELECT nombres, apellidos FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador_lider')";
    $consulta_administrador_lider = mysqli_query($conectar, $sql_administrador_lider) or die(mysqli_error($conectar));
    $datos_administrador_lider = mysqli_fetch_assoc($consulta_administrador_lider);

    $nombres_apellidos_lider                                        = $datos_administrador_lider['nombres'].' '.$datos_administrador_lider['apellidos'];
    /* ----------------------------------------------------------------------------------------------------------/ */
    $sql_administrador_coordinador = "SELECT nombres, apellidos FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador_coordinador')";
    $consulta_administrador_coordinador = mysqli_query($conectar, $sql_administrador_coordinador) or die(mysqli_error($conectar));
    $datos_administrador_coordinador = mysqli_fetch_assoc($consulta_administrador_coordinador);

    $nombres_apellidos_coordinador                                  = $datos_administrador_coordinador['nombres'].' '.$datos_administrador_coordinador['apellidos'];
    /* ----------------------------------------------------------------------------------------------------------/ */
    $sql_administrador_asesor = "SELECT nombres, apellidos FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador_asesor')";
    $consulta_administrador_asesor = mysqli_query($conectar, $sql_administrador_asesor) or die(mysqli_error($conectar));
    $datos_administrador_asesor = mysqli_fetch_assoc($consulta_administrador_asesor);

    $nombres_apellidos_asesor                                       = $datos_administrador_asesor['nombres'].' '.$datos_administrador_asesor['apellidos'];
    /* ----------------------------------------------------------------------------------------------------------/ */
    $sql_administrador_aliado_estrategico = "SELECT nombres, apellidos FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador_aliado_estrategico')";
    $consulta_administrador_aliado_estrategico = mysqli_query($conectar, $sql_administrador_aliado_estrategico) or die(mysqli_error($conectar));
    $datos_administrador_aliado_estrategico = mysqli_fetch_assoc($consulta_administrador_aliado_estrategico);

    $nombres_apellidos_aliado_estrategico                           = $datos_administrador_aliado_estrategico['nombres'].' '.$datos_administrador_aliado_estrategico['apellidos'];
    /* ----------------------------------------------------------------------------------------------------------/ */
    $sql_administrador_revisor = "SELECT nombres, apellidos FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador_revisor')";
    $consulta_administrador_revisor = mysqli_query($conectar, $sql_administrador_revisor) or die(mysqli_error($conectar));
    $datos_administrador_revisor = mysqli_fetch_assoc($consulta_administrador_revisor);

    $nombres_apellidos_revisor                                       = $datos_administrador_revisor['nombres'].' '.$datos_administrador_revisor['apellidos'];
    /* ----------------------------------------------------------------------------------------------------------/ */
    $sql_entidad_crediticia = "SELECT * FROM tbl15_entidad_crediticia WHERE (cod_entidad_crediticia = '$cod_entidad_crediticia')";
    $consulta_entidad_crediticia = mysqli_query($conectar, $sql_entidad_crediticia) or die(mysqli_error($conectar));
    $datos_entidad_crediticia = mysqli_fetch_assoc($consulta_entidad_crediticia);

    $nombre_entidad_crediticia                                      = $datos_entidad_crediticia['nombre_entidad_crediticia'];
    /* ----------------------------------------------------------------------------------------------------------/ */
    $sql_tienda = "SELECT nombre_tienda FROM tbl15_tienda WHERE cod_tienda = '$cod_tienda'";
    $consulta_tienda = mysqli_query($conectar, $sql_tienda);
    $datos_tienda = mysqli_fetch_assoc($consulta_tienda);

    $nombre_tienda = $datos_tienda['nombre_tienda'] ? $datos_tienda['nombre_tienda'] : 'Sin tienda';
    /* ----------------------------------------------------------------------------------------------------------/ */
    $sql_operador_credito = "SELECT * FROM tbl15_operador_credito WHERE (cod_operador_credito = '$cod_operador_credito')";
    $consulta_operador_credito = mysqli_query($conectar, $sql_operador_credito) or die(mysqli_error($conectar));
    $datos_operador_credito = mysqli_fetch_assoc($consulta_operador_credito);

    $nombre_operador_credito                                      = $datos_operador_credito['nombre_operador_credito'];
    /* ----------------------------------------------------------------------------------------------------------/ */
    $sql_banco_cuenta = "SELECT * FROM tbl15_banco_cuenta WHERE (cod_banco_cuenta = '$cod_banco_cuenta')";
    $consulta_banco_cuenta = mysqli_query($conectar, $sql_banco_cuenta) or die(mysqli_error($conectar));
    $datos_banco_cuenta = mysqli_fetch_assoc($consulta_banco_cuenta);

    $nombre_banco_cuenta                                          = $datos_banco_cuenta['nombre_banco_cuenta'].' | '.$datos_banco_cuenta['numero_banco_cuenta'];
    /* ----------------------------------------------------------------------------------------------------------/ */
    $sql_vendedor = "SELECT * FROM tbl15_vendedor WHERE (cod_vendedor = '$cod_vendedor')";
    $consulta_vendedor = mysqli_query($conectar, $sql_vendedor) or die(mysqli_error($conectar));
    $datos_vendedor = mysqli_fetch_assoc($consulta_vendedor);

    $nombre_vendedor                                               = $datos_vendedor['nombres'].' '.$datos_vendedor['apellidos'];
    /* ----------------------------------------------------------------------------------------------------------/ */
    $sql_tipo_pago = "SELECT * FROM tbl15_tipo_pago WHERE (cod_tipo_pago = '$cod_tipo_pago')";
    $consulta_tipo_pago = mysqli_query($conectar, $sql_tipo_pago) or die(mysqli_error($conectar));
    $datos_tipo_pago = mysqli_fetch_assoc($consulta_tipo_pago);

    $nombre_tipo_pago                                              = $datos_tipo_pago['nombre_tipo_pago'];
    /* ----------------------------------------------------------------------------------------------------------/ */
    $sql_tipo_forma_pago = "SELECT * FROM tbl15_tipo_forma_pago WHERE (cod_tipo_forma_pago = '$cod_tipo_forma_pago')";
    $consulta_tipo_forma_pago = mysqli_query($conectar, $sql_tipo_forma_pago) or die(mysqli_error($conectar));
    $datos_tipo_forma_pago = mysqli_fetch_assoc($consulta_tipo_forma_pago);

    $nombre_tipo_forma_pago                                        = $datos_tipo_forma_pago['nombre_tipo_forma_pago'];
    /* ----------------------------------------------------------------------------------------------------------/ */
    $sql_tipo_forma_pago_operador_credito = "SELECT * FROM tbl15_tipo_forma_pago WHERE (cod_tipo_forma_pago = '$cod_tipo_forma_pago_operador_credito')";
    $consulta_tipo_forma_pago_operador_credito = mysqli_query($conectar, $sql_tipo_forma_pago_operador_credito) or die(mysqli_error($conectar));
    $datos_tipo_forma_pago_operador_credito = mysqli_fetch_assoc($consulta_tipo_forma_pago_operador_credito);

    $nombre_tipo_forma_pago_operador_credito                        = $datos_tipo_forma_pago_operador_credito['nombre_tipo_forma_pago'];
    /* ----------------------------------------------------------------------------------------------------------/ */
    // Obtener nombre del administrador (aliado)
    $sql_admin = "SELECT nombre1_tercero, apellido1_tercero FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador_factura'";
    $consulta_admin = mysqli_query($conectar, $sql_admin);
    $datos_admin = mysqli_fetch_assoc($consulta_admin);

    $nombre_aliado                                                  = trim($datos_admin['nombre1_tercero'].' '.$datos_admin['apellido1_tercero']);
    if (!$nombre_aliado) $nombre_aliado = 'Sin asignar';
    /* ----------------------------------------------------------------------------------------------------------/ */
    $sql_estado_facturacion = "SELECT * FROM tbl15_estado_facturacion WHERE (codigo_estado_facturacion = '$cod_estado_factura')";
    $consulta_estado_facturacion = mysqli_query($conectar, $sql_estado_facturacion) or die(mysqli_error($conectar));
    $datos_estado_facturacion = mysqli_fetch_assoc($consulta_estado_facturacion);

    $nombre_estado_facturacion                                      = $datos_estado_facturacion['nombre_estado_facturacion'];
    $estilo_css_estado_factura                                      = $datos_estado_facturacion['color_fondo_celda_estado'];
    /* ----------------------------------------------------------------------------------------------------------/ */
    $sql_tipo_pago = "SELECT nombre_tipo_pago FROM tbl15_tipo_pago WHERE cod_tipo_pago = '$cod_tipo_pago'";
    $consulta_tipo_pago = mysqli_query($conectar, $sql_tipo_pago);
    $datos_tipo_pago = mysqli_fetch_assoc($consulta_tipo_pago);

    $nombre_tipo_pago                                               = $datos_tipo_pago['nombre_tipo_pago'] ? $datos_tipo_pago['nombre_tipo_pago'] : 'Sin tipo de pago';
    /* ----------------------------------------------------------------------------------------------------------/ */
    $mostrar_datos_sql = "SELECT * FROM tbl15_nota_observacion WHERE (cod_info_factura_venta = '$cod_info_factura_venta') ORDER BY cod_nota_observacion DESC";
    $consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
    $matriz_consulta = mysqli_fetch_assoc($consulta);

    $cod_nota_observacion                                           = $matriz_consulta['cod_nota_observacion'];
    $nombre_nota_observacion                                        = $matriz_consulta['nombre_nota_observacion'];
    $fecha_ymd                                                      = $matriz_consulta['fecha_ymd'];
    $fecha_hora                                                     = $matriz_consulta['fecha_hora'];
    $cuenta                                                         = $matriz_consulta['cuenta'];
    $url_img_orig_producto                                          = $matriz_consulta['url_img_orig_producto'];
    $url_img_min_producto                                           = $matriz_consulta['url_img_min_producto'];
    $cod_posicion                                                   = $matriz_consulta['cod_posicion'];
    $active                                                         = $matriz_consulta['active'];
    $codigo_estado_revision                                         = $matriz_consulta['codigo_estado_revision'];
    //---------------------------------------------------------------------------------------------------------------------------------//
    $sql_estado_revision = "SELECT * FROM tbl15_estado_revision WHERE (codigo_estado_revision = '$codigo_estado_revision')";
    $consulta_estado_revision = mysqli_query($conectar, $sql_estado_revision);
    $datos_estado_revision = mysqli_fetch_assoc($consulta_estado_revision);

    $nombre_estado_revision                                         = $datos_estado_revision['nombre_estado_revision'];
    //---------------------------------------------------------------------------------------------------------------------------------//
    $obtener_resolucion_facturacion = "SELECT nombre_tipo_resolucion_facturacion FROM tbl15_resolucion_facturacion WHERE cod_resolucion_facturacion = '$cod_resolucion_facturacion'";
    $resultado_resolucion_facturacion = mysqli_query($conectar, $obtener_resolucion_facturacion) or die(mysqli_error($conectar));
    $info_resolucion_facturacion = mysqli_fetch_assoc($resultado_resolucion_facturacion);

    $nombre_tipo_factura                                            = $info_resolucion_facturacion['nombre_tipo_resolucion_facturacion'];
//---------------------------------------------------------------------------------------------------------------------------------//
    $obtener_nota_observacion_cedula_en_mano = "SELECT url_img_min_producto FROM tbl15_nota_observacion WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (nombre_nota_observacion = 'FOTO DEL CLIENTE CON CEDULA EN MANO')";
    $resultado_nota_observacion_cedula_en_mano = mysqli_query($conectar, $obtener_nota_observacion_cedula_en_mano) or die(mysqli_error($conectar));
    $info_nota_observacion_cedula_en_mano = mysqli_fetch_assoc($resultado_nota_observacion_cedula_en_mano);

    $url_img_min_producto_cedula_en_mano                            = $info_nota_observacion_cedula_en_mano['url_img_min_producto'];
//---------------------------------------------------------------------------------------------------------------------------------//
    $obtener_nota_observacion_prod_const_entrega = "SELECT url_img_min_producto FROM tbl15_nota_observacion WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (nombre_nota_observacion = 'FOTO CON EL PRODUCTO COMO CONSTANCIA DE ENTREGA')";
    $resultado_nota_observacion_prod_const_entrega = mysqli_query($conectar, $obtener_nota_observacion_prod_const_entrega) or die(mysqli_error($conectar));
    $info_nota_observacion_prod_const_entrega = mysqli_fetch_assoc($resultado_nota_observacion_prod_const_entrega);

    $url_img_min_producto_prod_const_entrega                        = $info_nota_observacion_prod_const_entrega['url_img_min_producto'];
    /* ----------------------------------------------------------------------------------------------------------/ */
    if ($nombre_estado_factura == 'ABIERTA') { $tabla_productos_venta = 'tbl15_venta_producto_temporal'; } else { $tabla_productos_venta = 'tbl15_venta_producto'; }

    $sql_venta_producto_temporal = "SELECT cod_producto_barra, nombre_producto, serial1_producto, serial2_producto FROM $tabla_productos_venta WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
    $consulta_venta_producto_temporal = mysqli_query($conectar, $sql_venta_producto_temporal) or die(mysqli_error($conectar));
    $datos_venta_producto_temporal = mysqli_fetch_assoc($consulta_venta_producto_temporal);

    $cod_producto_barra                                             = $datos_venta_producto_temporal['cod_producto_barra'];
    $nombre_producto                                                = $datos_venta_producto_temporal['nombre_producto'];
    $serial1_producto                                               = $datos_venta_producto_temporal['serial1_producto'];
    $serial2_producto                                               = $datos_venta_producto_temporal['serial2_producto'];
    /* ----------------------------------------------------------------------------------------------------------/ */
    $fecha_formateada                                               = date('M d, Y', strtotime($fecha_creacion));
    $hora_formateada                                                = date('h:i A', strtotime($fecha_creacion));
?>
    
<!-- INICIO -->
    <div class="mobile-credit-container">
        <!-- Header Card -->
        <div class="credit-header-card">
            <div class="credit-status-badge">
                <i class="fa fa-check-circle"></i>
                <span>SOLICITUD REGISTRADA</span>
            </div>
            <div class="credit-id">
                <h2>No. <?php echo $cod_info_factura_venta; ?></h2>
                <p><?php echo $fecha_formateada; ?> - <?php echo $hora_formateada; ?></p>
            </div>
        </div>

        <!-- Client Info Card -->
        <div class="info-card">
            <div class="card-header">
                <i class="fa fa-user"></i>
                <h3>INFORMACIÓN DEL CLIENTE</h3>
            </div>
            <div class="card-content">
                <div class="info-row">
                    <div class="info-label">Nombre</div>
                    <div class="info-value"><?php echo $nombres_apellidos; ?></div>
                </div>
                <div class="info-row">
                    <div class="info-label">Identificación</div>
                    <div class="info-value"><?php echo $identificacion_tercero; ?></div>
                </div>
                <div class="info-row">
                    <div class="info-label">Estado</div>
                    <div class="info-value">
                        <span class="status-badge status-<?php echo strtolower(str_replace(' ', '-', $nombre_estado_facturacion)); ?>">
                            <?php echo $nombre_estado_facturacion; ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Credit Info Card -->
        <div class="info-card">
            <div class="card-header">
                <i class="fa fa-credit-card"></i>
                <h3>DETALLES DEL CRÉDITO</h3>
            </div>
            <div class="card-content">
                <div class="amount-display">
                    <div class="main-amount">
                        <span class="currency">$</span>
                        <span class="amount"><?php echo number_format($monto_deuda, 0, ",", "."); ?></span>
                        <span class="amount-label">Monto Total</span>
                    </div>
                    <div class="installment-amount">
                        <span>Cuota: $<?php echo number_format($monto_cuota, 0, ",", "."); ?></span>
                    </div>
                </div>
                <div class="info-row">
                    <div class="info-label">Tipo de Pago</div>
                    <div class="info-value"><?php echo $nombre_tipo_pago; ?></div>
                </div>
                <div class="info-row">
                    <div class="info-label">Entidad Crediticia</div>
                    <div class="info-value"><?php echo $nombre_entidad_crediticia; ?></div>
                </div>
                <div class="info-row">
                    <div class="info-label">Operador</div>
                    <div class="info-value"><?php echo $nombre_operador_credito; ?></div>
                </div>
            </div>
        </div>

        <!-- Product Info Card -->
        <div class="info-card">
            <div class="card-header">
                <i class="fa fa-box"></i>
                <h3>PRODUCTO SOLICITADO</h3>
            </div>
            <div class="card-content">
                <div class="product-info">
                    <div class="product-name"><?php echo $nombre_producto; ?></div>
                    <div class="product-code">Código: <?php echo $cod_producto_barra; ?></div>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="action-buttons">
            <a href="../admin/lista_info_factura_venta_siscredito_visitante_intern_aliado_movil.php?cod_info_factura_venta=<?php echo $cod_info_factura_venta; ?>" class="btn-action btn-back">
                <i class="fa fa-arrow-left"></i>
                <span>Volver</span>
            </a>
            <a href="../admin/contactar_por_whatapp_registro_cliente_y_precredito_revisor_siscredito_visitante_intern.php?cod_info_factura_venta=<?php echo $cod_info_factura_venta ?>&notificar=REVISOR>" target="_blank" class="btn-action btn-share">
                <i class="fa fa-print"></i>
                <span>Notificar al WhatsApp del Revisor</span>
            </a>
            <a href="../admin/contactar_por_whatapp_registro_cliente_y_precredito_revisor_siscredito_visitante_intern.php?cod_info_factura_venta=<?php echo $cod_info_factura_venta ?>&notificar=CLIENTE" target="_blank" class="btn-action btn-share">
                <i class="fa fa-share"></i>
                <span>Notificar al WhatsApp del Cliente</span>
            </a>
        </div>
    </div>

    <style>
    .mobile-credit-container {
        max-width: 100%;
        margin: 0 auto;
        padding: 8px;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
    }

    .credit-header-card {
        background: white;
        border-radius: 12px;
        padding: 15px;
        margin-bottom: 8px;
        text-align: center;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        position: relative;
        overflow: hidden;
    }

    .credit-header-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, #4CAF50, #8BC34A);
    }

    .credit-status-badge {
        display: inline-flex;
        align-items: center;
        background: #4CAF50;
        color: white;
        padding: 4px 12px;
        border-radius: 15px;
        font-size: 10px;
        font-weight: 600;
        margin-bottom: 8px;
        box-shadow: 0 2px 8px rgba(76, 175, 80, 0.2);
    }

    .credit-status-badge i {
        margin-right: 5px;
        font-size: 11px;
    }

    .credit-id h2 {
        font-size: 22px;
        color: #2c3e50;
        margin: 0 0 3px 0;
        font-weight: 700;
    }

    .credit-id p {
        color: #7f8c8d;
        margin: 0;
        font-size: 12px;
    }

    .info-card {
        background: white;
        border-radius: 10px;
        margin-bottom: 8px;
        overflow: hidden;
        box-shadow: 0 2px 12px rgba(0,0,0,0.06);
        border: 1px solid rgba(0,0,0,0.03);
    }

    .card-header {
        background: linear-gradient(135deg, #f8f9fa, #e9ecef);
        padding: 10px 15px;
        display: flex;
        align-items: center;
        border-bottom: 1px solid #dee2e6;
    }

    .card-header i {
        font-size: 14px;
        color: #6c757d;
        margin-right: 8px;
        width: 16px;
        text-align: center;
    }

    .card-header h3 {
        margin: 0;
        font-size: 12px;
        font-weight: 600;
        color: #495057;
        letter-spacing: 0.3px;
    }

    .card-content {
        padding: 12px 15px;
    }

    .info-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 6px 0;
        border-bottom: 1px solid #f1f3f4;
    }

    .info-row:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }

    .info-label {
        font-size: 12px;
        color: #6c757d;
        font-weight: 500;
        flex: 1;
    }

    .info-value {
        font-size: 12px;
        color: #2c3e50;
        font-weight: 600;
        text-align: right;
        flex: 1;
        word-break: break-word;
    }
    .amount-display {
        background: linear-gradient(135deg, #667eea, #764ba2);
        border-radius: 10px;
        padding: 15px;
        margin-bottom: 12px;
        text-align: center;
        color: white;
    }
    .main-amount {
        margin-bottom: 5px;
    }
    .currency {
        font-size: 16px;
        vertical-align: top;
        opacity: 0.9;
    }
    .amount {
        font-size: 24px;
        font-weight: 700;
        margin: 0 3px;
    }
    .amount-label {
        display: block;
        font-size: 10px;
        opacity: 0.9;
        margin-top: 2px;
    }
    .installment-amount {
        font-size: 13px;
        opacity: 0.9;
    }
    .product-info {
        text-align: center;
        padding: 5px 0;
    }
    .product-name {
        font-size: 14px;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 5px;
        line-height: 1.3;
    }
    .product-code {
        font-size: 11px;
        color: #7f8c8d;
        background: #f8f9fa;
        padding: 3px 8px;
        border-radius: 12px;
        display: inline-block;
    }
    .status-badge {
        padding: 3px 8px;
        border-radius: 12px;
        font-size: 10px;
        font-weight: 600;
        text-transform: uppercase;
    }
    .status-en-solicitud { background: #e3f2fd; color: #1565c0; }
    .status-en-proceso { background: #fff3e0; color: #f57c00; }
    .status-venta-aprobada { background: #e8f5e8; color: #2e7d32; }
    .status-credito-exitoso { background: #e8f5e8; color: #2e7d32; }
    .status-abandonado { background: #ffebee; color: #c62828; }
    .action-buttons {
        display: flex;
        gap: 6px;
        margin-top: 12px;
        padding: 0 3px;
    }
    .btn-action {
        flex: 1;
        background: white;
        border: none;
        border-radius: 10px;
        padding: 12px 8px;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 4px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.06);
        transition: all 0.3s ease;
        cursor: pointer;
        text-decoration: none;
        color: #495057;
    }
    .btn-action:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 16px rgba(0,0,0,0.12);
    }
    .btn-action:active {
        transform: translateY(0);
    }
    .btn-action i {
        font-size: 16px;
        color: #6c757d;
    }
    .btn-action span {
        font-size: 10px;
        font-weight: 600;
        color: #495057;
    }
    .btn-back i { color: #dc3545; }
    .btn-print i { color: #007bff; }
    .btn-share i { color: #28a745; }

    /* Responsive adjustments */
    @media (max-width: 480px) {
        .mobile-credit-container {
            padding: 5px;
        }
        .credit-header-card {
            padding: 12px;
            margin-bottom: 6px;
        }
        .credit-id h2 {
            font-size: 20px;
        }
        .amount {
            font-size: 22px;
        }
        .info-row {
            flex-direction: column;
            align-items: flex-start;
            gap: 2px;
            padding: 4px 0;
        }
        .info-value {
            text-align: left;
        }
        .btn-action {
            flex-direction: row;
            justify-content: center;
            padding: 10px;
            gap: 6px;
        }
        .btn-action i {
            margin-bottom: 0;
        }
    }
    /* Animation for cards */
    .info-card {
        animation: slideUp 0.4s ease-out;
    }
    .info-card:nth-child(2) { animation-delay: 0.05s; }
    .info-card:nth-child(3) { animation-delay: 0.1s; }
    .info-card:nth-child(4) { animation-delay: 0.15s; }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Hide scrollbar but keep functionality */
    .mobile-credit-container {
        scrollbar-width: none;
        -ms-overflow-style: none;
    }
    
    .mobile-credit-container::-webkit-scrollbar {
        display: none;
    }
    </style>
<!-- FINAL -->

    <!-- Área imprimible invisible -->
    <div id="area_imprimible_invisible" style="display:none;">
        <div style="text-align: center; padding: 20px;">
            <h2><?php echo $nombre_emp; ?></h2>
            <p><?php echo $direccion_emp; ?> - <?php echo $ciudad_emp; ?></p>
            <p>Tel: <?php echo $telefono_emp; ?> - NIT: <?php echo $nit_empresa_emp; ?></p>
            <hr>
            <h3>SOLICITUD DE CRÉDITO</h3>
            <p><strong>No. Solicitud:</strong> <?php echo $cod_info_factura_venta; ?></p>
            <p><strong>Fecha:</strong> <?php echo $fecha_formateada; ?> - <?php echo $hora_formateada; ?></p>
            <hr>
            <div style="text-align: left;">
                <p><strong>Cliente:</strong> <?php echo $nombres_apellidos; ?></p>
                <p><strong>Identificación:</strong> <?php echo $identificacion_tercero; ?></p>
                <p><strong>Dirección:</strong> <?php echo $direccion_tercero; ?></p>
                <p><strong>Teléfono:</strong> <?php echo $telefono1_tercero; ?></p>
                <p><strong>Email:</strong> <?php echo $correo_tercero; ?></p>
                <hr>
                <p><strong>Monto del Crédito:</strong> $<?php echo number_format($monto_deuda, 0, ",", "."); ?></p>
                <p><strong>Cuota:</strong> $<?php echo number_format($monto_cuota, 0, ",", "."); ?></p>
                <p><strong>Tipo de Pago:</strong> <?php echo $nombre_tipo_pago; ?></p>
                <p><strong>Entidad Crediticia:</strong> <?php echo $nombre_entidad_crediticia; ?></p>
                <p><strong>Operador:</strong> <?php echo $nombre_operador_credito; ?></p>
                <p><strong>Producto:</strong> <?php echo $nombre_producto; ?></p>
                <p><strong>Código Producto:</strong> <?php echo $cod_producto_barra; ?></p>
                <p><strong>Estado:</strong> <?php echo $nombre_estado_facturacion; ?></p>
                <hr>
                <p><strong>Vendedor:</strong> <?php echo $nombre_vendedor; ?></p>
                <p><strong>Aliado:</strong> <?php echo $nombre_aliado; ?></p>
                <p><strong>Tienda:</strong> <?php echo $nombre_tienda; ?></p>
                <?php if (!empty($observacion_tercero)) { ?>
                <hr>
                <p><strong>Observaciones:</strong></p>
                <p><?php echo nl2br($observacion_tercero); ?></p>
                <?php } ?>
            </div>
        </div>
    </div>

<?php } ?>
<?php //include_once("../seguridad/seguridad_diseno_plantillas_visitante_intern.php"); ?>
<?php include_once("../menu/05_modulo_menu_visitante_intern_movil.php"); ?>
<?php include_once("../admin/10_modulo_sin_js_visitante_intern_movil.php"); ?>
</body>
</html>

<script>
function printPageArea(areaID){
    var cod_info_factura_venta = <?php echo $cod_info_factura_venta; ?>;
    var printContent = document.getElementById(areaID);
    
    var WinPrint = window.open('', '', 'width=400,height=1000');
    WinPrint.document.write(printContent.innerHTML);
    WinPrint.document.close();
    WinPrint.focus();
    WinPrint.print();
    WinPrint.close();
}
</script>