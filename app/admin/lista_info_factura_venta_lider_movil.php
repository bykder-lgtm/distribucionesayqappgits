<?php 
$nombre_pagina          = "Créditos";
$cod_seguridad_pag      = "1";
$pagina_local           = $_SERVER['PHP_SELF'];
$cod_base_caja          = "1";
?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include_once("../admin/01_admin_modulo_inicio_sesion_adm_lider.php"); ?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include_once("../admin/01_admin_modulo_info_empresa_adm_lider.php"); ?>

<!DOCTYPE html>
<html lang="es">
<head>
<title><?php echo ($nombre_pagina) ?> - <?php echo ($nombre) ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="../imagenes/favicon.png" type="image/x-icon" rel="shortcut icon" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<script src="../js/jquery-3.2.1.min_visitante.js"></script>
<link rel="stylesheet" href="../estilo_css/sweetalert2.min_adm_tick.css" type="text/css" />
<script src="../js/sweetalert2.min_adm_tick.js"></script>

<style><?php include_once("../estilo_css/estilo_lista_credito_lider.css"); ?></style>

</head>
<body>
<?php include_once("../admin/01_modulo_header_top_movil.php"); ?>

<!-- Contenedor para notificaciones toast -->
<div class="toast-container" id="toastContainer"></div>

<?php
// Filtros
$estado_filtro = isset($_GET['estado']) ? mysqli_real_escape_string($conectar, $_GET['estado']) : 'TODOS';
$busqueda = isset($_GET['busqueda']) ? mysqli_real_escape_string($conectar, $_GET['busqueda']) : '';

// Parámetros de paginación
$registros_por_pagina = 30;
$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
if ($pagina <= 0) $pagina = 1;
$inicio = ($pagina - 1) * $registros_por_pagina;

// Estadísticas
$sql_stats = "SELECT COUNT(*) as total, SUM(CASE WHEN ifv.nombre_estado_factura = 'ABIERTA' THEN 1 ELSE 0 END) as activos,
SUM(CASE WHEN ifv.nombre_estado_factura = 'CERRADA' THEN 1 ELSE 0 END) as cerrados,
COALESCE(SUM(CASE WHEN ifv.nombre_estado_factura = 'ABIERTA' THEN ifv.monto_deuda ELSE 0 END), 0) as cartera
FROM tbl15_info_factura_venta ifv
INNER JOIN tbl15_tienda t ON ifv.cod_tienda = t.cod_tienda
WHERE ifv.cod_administrador_lider = '$cod_administrador' AND t.cod_estado != '0'";
$resultado_stats = mysqli_query($conectar, $sql_stats);
$stats = mysqli_fetch_assoc($resultado_stats);

// Consulta para contar el total según filtros
$sql_conteo = "SELECT COUNT(*) as total
FROM tbl15_info_factura_venta ifv
INNER JOIN tbl15_tienda t ON ifv.cod_tienda = t.cod_tienda
LEFT JOIN tbl15_tercero ter ON ifv.cod_tercero = ter.cod_tercero
WHERE ifv.cod_administrador_lider = '$cod_administrador' AND t.cod_estado != '0'";

if ($estado_filtro != 'TODOS') { $sql_conteo .= " AND ifv.nombre_estado_factura = '$estado_filtro'"; }
if (!empty($busqueda)) { $sql_conteo .= " AND (ter.nombre1_tercero LIKE '%$busqueda%' OR ter.identificacion_tercero LIKE '%$busqueda%' OR t.nombre_tienda LIKE '%$busqueda%')"; }

$resultado_conteo = mysqli_query($conectar, $sql_conteo);
$fila_conteo = mysqli_fetch_assoc($resultado_conteo);
$total_registros_global = $fila_conteo['total'];
$total_paginas = ceil($total_registros_global / $registros_por_pagina);

// Query principal
$sql_creditos = "SELECT ifv.*, t.nombre_tienda, ter.nombre1_tercero, ter.nombre2_tercero, ter.apellido1_tercero, ter.apellido2_tercero, 
ter.identificacion_tercero, ter.telefono1_tercero, ter.correo_tercero, ter.direccion_tercero, ec.nombre_entidad_crediticia, tp.nombre_tipo_pago, op.nombre_operador_credito,
CONCAT(admin_lider.nombres, ' ', admin_lider.apellidos) AS nombre_lider,
CONCAT(admin_asesor.nombres, ' ', admin_asesor.apellidos) AS nombre_asesor,
CONCAT(admin_aliado.nombres, ' ', admin_aliado.apellidos) AS nombre_aliado,
CONCAT(admin_revisor.nombres, ' ', admin_revisor.apellidos) AS nombre_revisor,
CONCAT(vend.nombres, ' ', vend.apellidos) AS nombre_vendedor,
bc.nombre_banco_cuenta
FROM tbl15_info_factura_venta ifv
INNER JOIN tbl15_tienda t ON ifv.cod_tienda = t.cod_tienda
LEFT JOIN tbl15_tercero ter ON ifv.cod_tercero = ter.cod_tercero
LEFT JOIN tbl15_entidad_crediticia ec ON ifv.cod_entidad_crediticia = ec.cod_entidad_crediticia
LEFT JOIN tbl15_tipo_pago tp ON ifv.cod_tipo_pago = tp.cod_tipo_pago
LEFT JOIN tbl15_operador_credito op ON ifv.cod_operador_credito = op.cod_operador_credito
LEFT JOIN tbl15_administrador admin_lider ON ifv.cod_administrador_lider = admin_lider.cod_administrador
LEFT JOIN tbl15_administrador admin_asesor ON ifv.cod_administrador_asesor = admin_asesor.cod_administrador
LEFT JOIN tbl15_administrador admin_aliado ON ifv.cod_administrador_aliado_estrategico = admin_aliado.cod_administrador
LEFT JOIN tbl15_administrador admin_revisor ON ifv.cod_administrador_revisor = admin_revisor.cod_administrador
LEFT JOIN tbl15_vendedor vend ON ifv.cod_vendedor = vend.cod_vendedor
LEFT JOIN tbl15_banco_cuenta bc ON ifv.cod_banco_cuenta = bc.cod_banco_cuenta
WHERE ifv.cod_administrador_lider = '$cod_administrador' AND t.cod_estado != '0'";

if ($estado_filtro != 'TODOS') { $sql_creditos .= " AND ifv.nombre_estado_factura = '$estado_filtro'"; }
if (!empty($busqueda)) { $sql_creditos .= " AND (ter.nombre1_tercero LIKE '%$busqueda%' OR ter.identificacion_tercero LIKE '%$busqueda%' OR t.nombre_tienda LIKE '%$busqueda%')"; }

$sql_creditos .= " ORDER BY ifv.fecha_creacion DESC LIMIT $inicio, $registros_por_pagina";
$resultado_creditos = mysqli_query($conectar, $sql_creditos);
$total_registros_pagina = $resultado_creditos ? mysqli_num_rows($resultado_creditos) : 0;
?>

<main class="page-container">
    <!-- Header -->
    <div class="page-header animate-in">
        <h1><i class="fa-solid fa-credit-card"></i> Créditos</h1>
        <p>Gestiona los créditos de tus tiendas</p>
        <div class="header-stats">
            <div class="header-stat">
                <div class="header-stat-value"><?php echo number_format($stats['total']); ?></div>
                <div class="header-stat-label">Total</div>
            </div>
            <div class="header-stat">
                <div class="header-stat-value"><?php echo number_format($stats['activos']); ?></div>
                <div class="header-stat-label">Activos</div>
            </div>
            <div class="header-stat">
                <div class="header-stat-value"><?php echo number_format($stats['cerrados']); ?></div>
                <div class="header-stat-label">Cerrados</div>
            </div>
            <div class="header-stat">
                <div class="header-stat-value">$<?php echo number_format($stats['cartera'] / 1000000, 1); ?>M</div>
                <div class="header-stat-label">Cartera</div>
            </div>
        </div>
    </div>

    <!-- Filter Tabs -->
    <div class="filter-tabs animate-in delay-1">
        <a href="?estado=TODOS" class="filter-tab <?php echo $estado_filtro == 'TODOS' ? 'active' : ''; ?>">Todos</a>
        <a href="?estado=ABIERTA" class="filter-tab <?php echo $estado_filtro == 'ABIERTA' ? 'active' : ''; ?>">Activos</a>
        <a href="?estado=CERRADA" class="filter-tab <?php echo $estado_filtro == 'CERRADA' ? 'active' : ''; ?>">Cerrados</a>
    </div>

    <!-- Search Bar -->
    <div class="search-bar animate-in delay-1">
        <i class="fa-solid fa-search"></i>
        <input type="text" id="searchInput" placeholder="Buscar por cliente o tienda..." value="<?php echo htmlspecialchars($busqueda); ?>" onkeyup="filtrarCreditos(this.value)">
    </div>

    <!-- Credit List -->
    <div class="credit-list">
        <?php if (mysqli_num_rows($resultado_creditos) > 0): ?>
            <?php while ($credito = mysqli_fetch_assoc($resultado_creditos)): 
                $nombre_cliente = trim(($credito['nombre1_tercero'] ? $credito['nombre1_tercero'] : '') . ' ' . ($credito['apellido1_tercero'] ? $credito['apellido1_tercero'] : ''));
                $monto_deuda = isset($credito['monto_deuda']) ? floatval($credito['monto_deuda']) : 0;
                $monto_abonado = isset($credito['total_abonos_factura']) ? floatval($credito['total_abonos_factura']) : 0;
                $porcentaje_pagado = $monto_deuda > 0 ? min(100, ($monto_abonado / $monto_deuda) * 100) : 0;
                $saldo_pendiente = $monto_deuda - $monto_abonado;
                
                // Obtener productos del crédito
                $cod_info_factura_venta = $credito['cod_info_factura_venta'];
                if ($credito['nombre_estado_factura'] == 'ABIERTA') { $tabla_productos_venta = 'tbl15_venta_producto_temporal'; } else { $tabla_productos_venta = 'tbl15_venta_producto'; }
                
                $contanenar_nombre_producto = "";
                $sql_productos_en_venta = "SELECT cod_producto, nombre_producto, serial1_producto, serial2_producto, cod_categoria 
                FROM $tabla_productos_venta WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
                $consulta_productos_en_venta = mysqli_query($conectar, $sql_productos_en_venta);
                $existe_varios_productos = mysqli_num_rows($consulta_productos_en_venta);
                
                if($existe_varios_productos > 0) {
                    while ($datos_producto = mysqli_fetch_assoc($consulta_productos_en_venta)) {
                        $nombre_producto = $datos_producto['nombre_producto'];
                        $cod_categoria = $datos_producto['cod_categoria'];
                        $serial1_producto = $datos_producto['serial1_producto'];
                        $serial2_producto = $datos_producto['serial2_producto'];
                        
                        // Obtener nombre de categoría
                        $sql_categoria = "SELECT nombre_categoria FROM tbl15_categoria WHERE cod_categoria = '$cod_categoria'";
                        $consulta_categoria = mysqli_query($conectar, $sql_categoria);
                        $datos_categoria = mysqli_fetch_assoc($consulta_categoria);
                        $nombre_categoria = trim($datos_categoria['nombre_categoria']) ?: "Sin categoría";
                        
                        if($cod_categoria == '2') { // Celulares
                            $contanenar_nombre_producto .= $nombre_producto . ' | ' . $nombre_categoria . ' [IMEI1: ' . $serial1_producto . ' - IMEI2: ' . $serial2_producto . '] ';
                        } else {
                            $contanenar_nombre_producto .= $nombre_producto . ' | ' . $nombre_categoria . ' ';
                        }
                        if($existe_varios_productos > 1) { $contanenar_nombre_producto .= "• "; }
                    }
                } else {
                    $contanenar_nombre_producto = "Sin productos registrados";
                }
            ?>
            <div class="credit-card animate-in delay-2">
                <div class="credit-card-header">
                    <!-- Avatar a la izquierda -->
                    <div class="credit-avatar">
                        <i class="fa-solid fa-user"></i>
                    </div>
                    
                    <!-- Información del crédito -->
                    <div class="credit-info">
                        <!-- Fila 1: Nombre + Tipo de Pago -->
                        <div class="credit-name-row">
                            <div class="credit-client"><?php echo ucwords(strtolower($nombre_cliente ?: 'Sin nombre')); ?></div>
                            <span class="credit-tipo-pago <?php echo (isset($credito['nombre_tipo_pago']) && $credito['nombre_tipo_pago'] == 'CONTADO') ? 'contado' : 'credito'; ?>">
                                <?php echo isset($credito['nombre_tipo_pago']) ? $credito['nombre_tipo_pago'] : 'CRÉDITO'; ?>[<?php echo $credito['cod_info_factura_venta']; ?>]
                            </span>
                        </div>
                        
                        <!-- Fila 2: CC + Entidad Crediticia -->
                        <div class="credit-ids-row">
                            <span class="credit-id"><strong>CC:</strong> <?php echo $credito['identificacion_tercero'] ?: 'N/A'; ?></span>
                            <?php if (!empty($credito['nombre_entidad_crediticia'])) { ?>
                            <span class="credit-entidad"><?php echo $credito['nombre_entidad_crediticia']; ?></span>
                            <?php } ?>
                        </div>
                        
                        <!-- Fila 3: ID + Precio -->
                        <div class="credit-code-price-row">
                            <!-- Fila 5: Tienda y Aliado -->
                            <div class="credit-store">
                                <i class="fa-solid fa-store"></i>
                                <?php echo ucwords(strtolower($credito['nombre_tienda'])); ?> - <?php echo ucwords(strtolower($credito['nombre_aliado'])); ?>
                            </div>
                            <?php if ($monto_deuda > 0) { ?>
                            <span class="credit-precio">$<?php echo number_format($monto_deuda, 0, ",", "."); ?></span>
                            <?php } ?>
                        </div>
                        
                        <!-- Fila 4: Producto + Estado -->
                        <div class="credit-product-row">
                            <span class="credit-producto"><strong>Producto:</strong> <?php echo $contanenar_nombre_producto; ?></span>
                            <span class="credit-status <?php echo strtolower($credito['nombre_estado_factura']); ?>"><?php echo $credito['nombre_estado_factura']; ?></span>
                        </div>
                        
                        <!-- Barra de progreso -->
                         <!--
                        <div class="credit-progress">
                            <div class="credit-progress-bar">
                                <div class="credit-progress-fill" style="width: <?php echo $porcentaje_pagado; ?>%"></div>
                            </div>
                            <div class="credit-progress-text">
                                <span><?php echo number_format($porcentaje_pagado, 1); ?>% pagado</span>
                                <span><?php echo date('d/m/Y', strtotime($credito['fecha_creacion'])); ?></span>
                            </div>
                        </div>
                        -->

                        
                        <!-- Botones de acción -->
                        <div class="credit-actions">
                            <button class="action-btn primary btn-ver-detalle" 
                                data-cod="<?php echo $credito['cod_info_factura_venta']; ?>"
                                data-cliente="<?php echo htmlspecialchars($nombre_cliente); ?>"
                                data-identificacion="<?php echo $credito['identificacion_tercero']; ?>"
                                data-telefono="<?php echo isset($credito['telefono1_tercero']) ? $credito['telefono1_tercero'] : ''; ?>"
                                data-correo="<?php echo isset($credito['correo_tercero']) ? $credito['correo_tercero'] : ''; ?>"
                                data-direccion="<?php echo isset($credito['direccion_tercero']) ? htmlspecialchars($credito['direccion_tercero']) : ''; ?>"
                                data-tienda="<?php echo htmlspecialchars($credito['nombre_tienda']); ?>"
                                data-entidad="<?php echo $credito['nombre_entidad_crediticia']; ?>"
                                data-operador="<?php echo isset($credito['nombre_operador_credito']) ? $credito['nombre_operador_credito'] : ''; ?>"
                                data-lider="<?php echo isset($credito['nombre_lider']) ? $credito['nombre_lider'] : ''; ?>"
                                data-lider="<?php echo isset($credito['nombre_lider']) ? $credito['nombre_lider'] : ''; ?>"
                                data-asesor="<?php echo isset($credito['nombre_asesor']) ? $credito['nombre_asesor'] : ''; ?>"
                                data-aliado="<?php echo isset($credito['nombre_aliado']) ? $credito['nombre_aliado'] : ''; ?>"
                                data-revisor="<?php echo isset($credito['nombre_revisor']) ? $credito['nombre_revisor'] : ''; ?>"
                                data-vendedor="<?php echo isset($credito['nombre_vendedor']) ? $credito['nombre_vendedor'] : ''; ?>"
                                data-banco="<?php echo isset($credito['nombre_banco_cuenta']) ? $credito['nombre_banco_cuenta'] : ''; ?>"
                                data-monto="<?php echo $monto_deuda; ?>"
                                data-abonado="<?php echo $monto_abonado; ?>"
                                data-saldo="<?php echo $saldo_pendiente; ?>"
                                data-cuotas="<?php echo isset($credito['numero_cuota']) ? $credito['numero_cuota'] : '-'; ?>"
                                data-tipo-cobro="<?php echo isset($credito['nombre_tipo_pago']) ? $credito['nombre_tipo_pago'] : ''; ?>"
                                data-fecha="<?php echo date('d/m/Y', strtotime($credito['fecha_creacion'])); ?>"
                                data-hora="<?php echo date('h:i A', strtotime($credito['fecha_creacion'])); ?>"
                                data-estado="<?php echo $credito['nombre_estado_factura']; ?>"
                                data-porcentaje="<?php echo number_format($porcentaje_pagado, 1); ?>"
                                data-valor-contado="<?php echo isset($credito['monto_deuda_sin_interes']) ? $credito['monto_deuda_sin_interes'] : 0; ?>"
                                data-cuota-mensual="<?php echo isset($credito['monto_cuota']) ? $credito['monto_cuota'] : 0; ?>"
                                data-interes="<?php echo isset($credito['interes_ptj']) ? $credito['interes_ptj'] : 0; ?>%"
                                data-observaciones="<?php echo isset($credito['observacion_tercero']) ? htmlspecialchars($credito['observacion_tercero']) : ''; ?>"
                                data-producto="<?php echo htmlspecialchars($contanenar_nombre_producto); ?>">
                                <i class="fa-solid fa-eye"></i> Ver Detalle
                            </button>
                            <button class="action-btn secondary btn-contactar" 
                                data-cliente="<?php echo htmlspecialchars($nombre_cliente); ?>"
                                data-telefono="<?php echo isset($credito['telefono1_tercero']) ? $credito['telefono1_tercero'] : ''; ?>"
                                data-saldo="<?php echo $saldo_pendiente; ?>"
                                data-tienda="<?php echo htmlspecialchars($credito['nombre_tienda']); ?>">
                                <i class="fa-brands fa-whatsapp"></i> Contactar
                            </button>
                            <button class="action-btn" 
                                style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: white;"
                                onclick="abrirModalComprobante(<?php echo $credito['cod_info_factura_venta']; ?>, '<?php echo htmlspecialchars($nombre_cliente); ?>')">
                                <i class="fa-solid fa-receipt"></i> Comprobante
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="empty-state">
                <i class="fa-solid fa-file-invoice"></i>
                <h3>No hay créditos</h3>
                <p>No se encontraron registros con los filtros aplicados</p>
            </div>
        <?php endif; ?>
    </div>

    <!-- Paginación -->
    <div class="pagination-container animate-in delay-2">
        <div style="width: 100%; text-align: center; color: rgba(255,255,255,0.6); font-size: 0.85rem; margin-bottom: 0.75rem; font-weight: 500; background: rgba(139, 92, 246, 0.1); padding: 0.5rem; border-radius: 10px; border: 1px solid rgba(139, 92, 246, 0.2);">
            Mostrando <span style="color: #a78bfa; font-weight: 700;"><?php echo $total_registros_pagina; ?></span> de <span style="color: #a78bfa; font-weight: 700;"><?php echo $total_registros_global; ?></span> créditos
        </div>
        
        <?php if ($total_paginas > 1): ?>
            <?php 
            $params = $_GET;
            unset($params['pagina']);
            $query_string = http_build_query($params);
            $base_url = "lista_info_factura_venta_lider_movil.php?" . ($query_string ? $query_string . "&" : "");
            ?>
            
            <a href="<?php echo $base_url; ?>pagina=<?php echo max(1, $pagina - 1); ?>" class="pagination-btn <?php echo ($pagina <= 1) ? 'disabled' : ''; ?>">
                <i class="fa-solid fa-chevron-left"></i>
            </a>

            <?php
            $rango = 2;
            for ($i = 1; $i <= $total_paginas; $i++):
                if ($i == 1 || $i == $total_paginas || ($i >= $pagina - $rango && $i <= $pagina + $rango)):
            ?>
                <a href="<?php echo $base_url; ?>pagina=<?php echo $i; ?>" class="pagination-btn <?php echo ($i == $pagina) ? 'active' : ''; ?>">
                    <?php echo $i; ?>
                </a>
            <?php 
                elseif ($i == $pagina - $rango - 1 || $i == $pagina + $rango + 1):
                    echo '<span style="color: rgba(255,255,255,0.5);">...</span>';
                endif;
            endfor; 
            ?>

            <a href="<?php echo $base_url; ?>pagina=<?php echo min($total_paginas, $pagina + 1); ?>" class="pagination-btn <?php echo ($pagina >= $total_paginas) ? 'disabled' : ''; ?>">
                <i class="fa-solid fa-chevron-right"></i>
            </a>
        <?php endif; ?>
    </div>
</main>

<!-- Modal Ver Detalle -->
<div class="modal-overlay" id="modalDetalleOverlay">
    <div class="modal-container modal-lg">
        <div class="modal-header-custom">
            <h3><i class="fa-solid fa-file-invoice"></i> Detalle Crédito #<span id="detCodCredito"></span></h3>
            <button class="modal-close" onclick="cerrarModalDetalle()">&times;</button>
        </div>
        <div class="modal-body-custom">
            <!-- Sección 1: Información del Cliente -->
            <div class="detail-section">
                <h4><i class="fa-solid fa-user"></i> Información del Cliente</h4>
                <div class="detail-grid">
                    <div class="detail-item">
                        <span class="detail-label">Nombre:</span>
                        <span class="detail-value" id="detCliente"></span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Identificación:</span>
                        <span class="detail-value" id="detIdentificacion"></span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Teléfono:</span>
                        <span class="detail-value" id="detTelefono"></span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Correo:</span>
                        <span class="detail-value" id="detCorreo"></span>
                    </div>
                    <div class="detail-item full-width">
                        <span class="detail-label">Dirección:</span>
                        <span class="detail-value" id="detDireccion"></span>
                    </div>
                </div>
            </div>

            <!-- Sección 2: Información del Producto -->
            <div class="detail-section">
                <h4><i class="fa-solid fa-box"></i> Información del Producto</h4>
                <div class="product-display" id="detProducto">
                    <span class="product-name">Cargando...</span>
                </div>
            </div>

            <!-- Sección 3: Información del Crédito (Valores incluidos) -->
            <div class="detail-section">
                <h4><i class="fa-solid fa-credit-card"></i> Información del Crédito</h4>
                <!-- Primera fila: Valor Crédito, Valor Contado -->
                <div class="values-summary">
                    <div class="value-box">
                        <span class="value-label">Valor a Crédito</span>
                        <span class="value-amount green" id="detMonto"></span>
                    </div>
                    <div class="value-box">
                        <span class="value-label">Valor de Contado</span>
                        <span class="value-amount" style="color: #34d399;" id="detValorContado"></span>
                    </div>
                </div>
                <!-- Segunda fila: Número Cuotas, Cuota Mensual -->
                <div class="values-summary" style="margin-top: 0.5rem;">
                    <div class="value-box">
                        <span class="value-label">Número de Cuotas</span>
                        <span class="value-amount" style="color: #f59e0b;" id="detCuotas"></span>
                    </div>
                    <div class="value-box">
                        <span class="value-label">Cuota Mensual</span>
                        <span class="value-amount" style="color: #64748b;" id="detCuotaMensual"></span>
                    </div>
                </div>
                <!-- Tercera fila: Tipo de Venta, Línea de Crédito, Operador del Crédito -->
                <div class="detail-grid-3" style="margin-top: 1rem;">
                    <div class="detail-item">
                        <span class="detail-label">Tipo de Venta:</span>
                        <span class="detail-value" id="detTipoCobro"></span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Línea de Crédito:</span>
                        <span class="detail-value highlight" id="detEntidad"></span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Operador del Crédito:</span>
                        <span class="detail-value" id="detOperador"></span>
                    </div>
                </div>
                <!-- Barra de progreso -->
<!--
                <div class="progress-section" style="margin-top: 1rem;">
                    <div class="values-summary">
                        <div class="value-box">
                            <span class="value-label">Total Abonado</span>
                            <span class="value-amount blue" id="detAbonado"></span>
                        </div>
                        <div class="value-box">
                            <span class="value-label">Saldo Pendiente</span>
                            <span class="value-amount red" id="detSaldo"></span>
                        </div>
                    </div>
                    <div class="progress-bar-modal" style="margin-top: 0.5rem;">
                        <div class="progress-fill-modal" id="detProgressBar"></div>
                    </div>
                    <span class="progress-text-modal" id="detPorcentaje"></span>
                </div>
-->
            </div>

            <!-- Sección 4: Equipo de Gestión -->
            <div class="detail-section">
                <h4><i class="fa-solid fa-users"></i> Equipo de Gestión</h4>
                <div class="detail-grid">
                    <div class="detail-item">
                        <span class="detail-label">Líder:</span>
                        <span class="detail-value" id="detLider"></span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">lider:</span>
                        <span class="detail-value" id="detlider"></span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Asesor:</span>
                        <span class="detail-value" id="detAsesor"></span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Aliado Estratégico:</span>
                        <span class="detail-value" id="detAliado"></span>
                    </div>
                    <div class="detail-item full-width">
                        <span class="detail-label">Back Office:</span>
                        <span class="detail-value" id="detRevisor"></span>
                    </div>
                </div>
            </div>

            <!-- Sección 5: Información Comercial -->
            <div class="detail-section">
                <h4><i class="fa-solid fa-store"></i> Información Comercial</h4>
                <div class="detail-grid">
                    <div class="detail-item">
                        <span class="detail-label">Tienda:</span>
                        <span class="detail-value" id="detTienda"></span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Vendedor:</span>
                        <span class="detail-value" id="detVendedor"></span>
                    </div>
                    <div class="detail-item full-width">
                        <span class="detail-label">Cuenta de Banco:</span>
                        <span class="detail-value" id="detBanco"></span>
                    </div>
                </div>
            </div>

            <!-- Sección 6: Documentación Fotográfica -->
            <div class="detail-section">
                <h4><i class="fa-solid fa-camera"></i> Documentación Fotográfica</h4>
                <div id="detImagenes" style="text-align: center; padding: 2rem; background: rgba(255, 255, 255, 0.05); border-radius: 8px;">
                    <i class="fa-solid fa-images" style="font-size: 2rem; color: #64748b; margin-bottom: 0.5rem;"></i>
                    <p style="color: #94a3b8; margin: 0;">Sin imágenes adjuntas</p>
                </div>
            </div>

            <!-- Sección 6.5: Comprobante de Pago -->
            <div class="detail-section">
                <h4><i class="fa-solid fa-receipt"></i> Comprobante de Pago</h4>
                <div style="background: rgba(139, 92, 246, 0.05); border: 1px solid rgba(139, 92, 246, 0.2); border-radius: 12px; padding: 1rem;">
                    <!-- Mostrar comprobante actual si existe -->
                    <div id="comprbanteActual" style="display: none; margin-bottom: 1rem; text-align: center;">
                        <div style="background: rgba(139, 92, 246, 0.1); padding: 1rem; border-radius: 8px; margin-bottom: 0.75rem;">
                            <i class="fa-solid fa-file-check" style="font-size: 2rem; color: #8b5cf6; margin-bottom: 0.5rem; display: block;"></i>
                            <p style="color: rgba(255,255,255,0.8); margin: 0; font-size: 0.85rem; font-weight: 600;">Comprobante registrado</p>
                            <a id="linkComprobanteActual" href="#" target="_blank" style="color: #8b5cf6; text-decoration: none; font-size: 0.8rem; display: inline-flex; align-items: center; gap: 0.5rem; margin-top: 0.5rem;">
                                <i class="fa-solid fa-external-link-alt"></i> Ver comprobante
                            </a>
                        </div>
                    </div>
                    
                    <!-- Formulario para cargar nuevo comprobante -->
                    <input type="hidden" id="codCreditoComprobante" value="">
                    <div style="position: relative;">
                        <input type="file" id="inputComprobante" accept="image/*,.pdf,.doc,.docx" style="display: none;" onchange="previsualizarComprobante(this)">
                        <label for="inputComprobante" style="display: block; cursor: pointer; background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%); color: white; text-align: center; padding: 1rem; border-radius: 10px; transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 15px rgba(139, 92, 246, 0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                            <i class="fa-solid fa-cloud-upload-alt" style="font-size: 1.5rem; display: block; margin-bottom: 0.5rem;"></i>
                            <span style="font-weight: 600; font-size: 0.9rem;">Seleccionar Comprobante</span>
                            <span style="display: block; font-size: 0.75rem; margin-top: 0.25rem; opacity: 0.9;">Imagen o documento (JPG, PNG, PDF, DOC)</span>
                        </label>
                    </div>
                    
                    <!-- Preview del archivo seleccionado -->
                    <div id="previewComprobante" style="display: none; margin-top: 1rem; text-align: center;">
                        <div style="background: rgba(139, 92, 246, 0.1); padding: 1rem; border-radius: 8px;">
                            <i class="fa-solid fa-file-alt" style="font-size: 2rem; color: #8b5cf6; margin-bottom: 0.5rem; display: block;"></i>
                            <p id="nombreArchivoComprobante" style="color: #8b5cf6; margin: 0; font-size: 0.85rem; font-weight: 600;"></p>
                            <p id="tamanoArchivoComprobante" style="color: rgba(255,255,255,0.6); margin: 0.25rem 0 0 0; font-size: 0.75rem;"></p>
                        </div>
                        <button type="button" onclick="cargarComprobante()" style="width: 100%; margin-top: 1rem; background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); color: white; border: none; padding: 0.85rem 1.5rem; border-radius: 10px; font-size: 0.9rem; font-weight: 600; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 0.5rem; transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 15px rgba(59, 130, 246, 0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                            <i class="fa-solid fa-upload"></i> Cargar Comprobante
                        </button>
                        <button type="button" onclick="cancelarComprobante()" style="width: 100%; margin-top: 0.5rem; background: rgba(239, 68, 68, 0.2); color: #ef4444; border: 1px solid rgba(239, 68, 68, 0.3); padding: 0.75rem; border-radius: 10px; font-size: 0.85rem; font-weight: 600; cursor: pointer;">
                            <i class="fa-solid fa-times"></i> Cancelar
                        </button>
                    </div>
                    
                    <div style="background: rgba(245, 158, 11, 0.1); border: 1px solid rgba(245, 158, 11, 0.3); border-radius: 8px; padding: 0.75rem; margin-top: 1rem;">
                        <div style="color: rgba(255,255,255,0.8); font-size: 0.75rem; line-height: 1.4;">
                            <i class="fa-solid fa-info-circle" style="color: #f59e0b; margin-right: 0.35rem;"></i>
                            <strong>Nota:</strong> Sube el comprobante de pago del crédito. Se aceptan imágenes (JPG, PNG) y documentos (PDF, DOC, DOCX). Tamaño máximo: 10MB.
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sección 7: Crear Notificación -->
<!--
            <div class="detail-section" style="text-align: center;">
                <button class="btn-primary-custom" style="width: 100%; padding: 1rem;" onclick="abrirModalCrearNotificacion()">
                    <i class="fa-solid fa-plus-circle"></i> Crear Nueva Notificación
                </button>
            </div>
-->

            <!-- Sección 8: Información Adicional -->
            <div class="detail-section">
                <h4><i class="fa-solid fa-info-circle"></i> Información Adicional</h4>
                <div class="detail-grid">
                    <div class="detail-item full-width">
                        <span class="detail-label">Observaciones:</span>
                        <span class="detail-value" id="detObservaciones"></span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">ID Solicitud:</span>
                        <span class="detail-value highlight" id="detIDSolicitud"></span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Fecha:</span>
                        <span class="detail-value" id="detFecha"></span>
                    </div>
                    <div class="detail-item full-width">
                        <span class="detail-label">Hora:</span>
                        <span class="detail-value" id="detHora"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer-custom">
            <button class="btn-modal secondary" onclick="cerrarModalDetalle()"><i class="fa-solid fa-times"></i> Cerrar</button>
        </div>
    </div>
</div>

<!-- Modal Contactar -->
<div class="modal-overlay" id="modalContactarOverlay">
    <div class="modal-container modal-sm">
        <div class="modal-header-custom whatsapp">
            <h3><i class="fa-brands fa-whatsapp"></i> Contactar Cliente</h3>
            <button class="modal-close" onclick="cerrarModalContactar()">&times;</button>
        </div>
        <div class="modal-body-custom">
            <div class="contact-info">
                <div class="contact-avatar">
                    <i class="fa-solid fa-user"></i>
                </div>
                <div class="contact-name" id="contCliente"></div>
                <div class="contact-phone" id="contTelefono"></div>
            </div>
            <div class="message-section">
                <label>Mensaje predefinido:</label>
                <textarea id="mensajeWhatsapp" rows="4" placeholder="Escribe tu mensaje..."></textarea>
            </div>
            <div class="quick-messages">
                <button class="quick-msg" onclick="setMensaje('recordatorio')">📅 Recordatorio de pago</button>
                <button class="quick-msg" onclick="setMensaje('saludo')">👋 Saludo cordial</button>
                <button class="quick-msg" onclick="setMensaje('mora')">⚠️ Cuota en mora</button>
            </div>
        </div>
        <div class="modal-footer-custom">
            <button class="btn-modal secondary" onclick="cerrarModalContactar()"><i class="fa-solid fa-times"></i> Cancelar</button>
            <button class="btn-modal whatsapp" onclick="enviarWhatsApp()"><i class="fa-brands fa-whatsapp"></i> Enviar por WhatsApp</button>
        </div>
    </div>
</div>

<!-- Modal Comprobante de Pago -->
<div class="modal-overlay" id="modalComprobanteOverlay">
    <div class="modal-container modal-sm">
        <div class="modal-header-custom" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);">
            <h3><i class="fa-solid fa-receipt"></i> Comprobante de Pago</h3>
            <button class="modal-close" onclick="cerrarModalComprobante()">&times;</button>
        </div>
        <div class="modal-body-custom">
            <!-- Info del crédito -->
            <div class="contact-info" style="border-bottom: 1px solid rgba(245, 158, 11, 0.2);">
                <div class="contact-avatar" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);">
                    <i class="fa-solid fa-file-invoice"></i>
                </div>
                <div class="contact-name" id="compCliente"></div>
                <div class="contact-phone" style="color: rgba(255,255,255,0.7); font-size: 0.85rem;">
                    Crédito #<span id="compCodigo"></span>
                </div>
            </div>

            <!-- Comprobante actual si existe -->
            <div id="compComprobanteActual" style="display: none; margin-top: 1.5rem;">
                <div style="background: rgba(139, 92, 246, 0.1); border: 1px solid rgba(139, 92, 246, 0.3); padding: 1rem; border-radius: 12px; text-align: center;">
                    <i class="fa-solid fa-file-check" style="font-size: 2rem; color: #8b5cf6; margin-bottom: 0.5rem; display: block;"></i>
                    <p style="color: rgba(255,255,255,0.8); margin: 0 0 0.75rem 0; font-size: 0.85rem; font-weight: 600;">Comprobante registrado</p>
                    <a id="compLinkActual" href="#" target="_blank" style="display: inline-flex; align-items: center; gap: 0.5rem; background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%); color: white; padding: 0.6rem 1.25rem; border-radius: 10px; text-decoration: none; font-size: 0.85rem; font-weight: 600; transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 15px rgba(139, 92, 246, 0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                        <i class="fa-solid fa-external-link-alt"></i> Ver comprobante
                    </a>
                </div>
                <div style="height: 1px; background: rgba(255,255,255,0.1); margin: 1.5rem 0;"></div>
            </div>

            <!-- Formulario para cargar nuevo comprobante -->
            <input type="hidden" id="compCodCredito" value="">
            <div style="margin-top: 1.5rem;">
                <label style="display: block; color: rgba(255,255,255,0.8); font-size: 0.9rem; font-weight: 600; margin-bottom: 1rem;">
                    <i class="fa-solid fa-upload"></i> Cargar nuevo comprobante:
                </label>
                
                <input type="file" id="compInputFile" accept="image/*,.pdf,.doc,.docx" style="display: none;" onchange="compPrevisualizarArchivo(this)">
                <label for="compInputFile" style="display: block; cursor: pointer; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: white; text-align: center; padding: 1.25rem; border-radius: 12px; transition: all 0.3s ease; border: 2px dashed rgba(245, 158, 11, 0.5);" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 15px rgba(245, 158, 11, 0.4)'; this.style.borderColor='rgba(245, 158, 11, 0.8)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'; this.style.borderColor='rgba(245, 158, 11, 0.5)'">
                    <i class="fa-solid fa-cloud-upload-alt" style="font-size: 2rem; display: block; margin-bottom: 0.75rem;"></i>
                    <span style="font-weight: 600; font-size: 0.95rem; display: block;">Seleccionar archivo</span>
                    <span style="display: block; font-size: 0.75rem; margin-top: 0.5rem; opacity: 0.9;">JPG, PNG, PDF, DOC, DOCX (Máx. 10MB)</span>
                </label>

                <!-- Preview del archivo -->
                <div id="compPreview" style="display: none; margin-top: 1rem;">
                    <div style="background: rgba(139, 92, 246, 0.1); border: 1px solid rgba(139, 92, 246, 0.3); padding: 1rem; border-radius: 10px; text-align: center;">
                        <i class="fa-solid fa-file-alt" style="font-size: 2rem; color: #8b5cf6; margin-bottom: 0.5rem; display: block;"></i>
                        <p id="compNombreArchivo" style="color: #8b5cf6; margin: 0; font-size: 0.85rem; font-weight: 600;"></p>
                        <p id="compTamanoArchivo" style="color: rgba(255,255,255,0.6); margin: 0.25rem 0 0 0; font-size: 0.75rem;"></p>
                    </div>
                </div>

                <div style="background: rgba(59, 130, 246, 0.1); border: 1px solid rgba(59, 130, 246, 0.3); border-radius: 10px; padding: 0.75rem; margin-top: 1rem;">
                    <div style="color: rgba(255,255,255,0.8); font-size: 0.75rem; line-height: 1.5;">
                        <i class="fa-solid fa-info-circle" style="color: #3b82f6; margin-right: 0.5rem;"></i>
                        <strong>Nota:</strong> El comprobante de pago puede ser una imagen (foto del recibo) o un documento (PDF, Word). Se guardará en el registro del crédito.
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer-custom">
            <button class="btn-modal secondary" onclick="cerrarModalComprobante()">
                <i class="fa-solid fa-times"></i> Cancelar
            </button>
            <button class="btn-modal" id="compBtnCargar" style="background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%); color: white; display: none;" onclick="compCargarArchivo()">
                <i class="fa-solid fa-upload"></i> Cargar Comprobante
            </button>
        </div>
    </div>
</div>

<!-- Bottom Navigation -->
<?php include_once("../menu/05_modulo_menu_lider_movil.php"); ?>

<script>
function filtrarCreditos(busqueda) {
    clearTimeout(window.searchTimeout);
    window.searchTimeout = setTimeout(function() {
        var estado = '<?php echo $estado_filtro; ?>';
        window.location.href = 'lista_info_factura_venta_lider_movil.php?estado=' + estado + '&busqueda=' + encodeURIComponent(busqueda);
    }, 500);
}

// Variables globales para el modal de contacto
var telefonoContacto = '';
var clienteContacto = '';
var saldoContacto = 0;
var tiendaContacto = '';

// Abrir modal Ver Detalle
$(document).on('click', '.btn-ver-detalle', function() {
    var btn = $(this);
    var codCredito = btn.data('cod');
    
    // ID del crédito
    $('#detCodCredito').text(codCredito || 'N/A');
    
    // Sección 1: Info Cliente
    $('#detCliente').text(btn.data('cliente') || 'N/A');
    $('#detIdentificacion').text(btn.data('identificacion') || 'N/A');
    $('#detTelefono').text(btn.data('telefono') || 'N/A');
    $('#detCorreo').text(btn.data('correo') || 'N/A');
    $('#detDireccion').text(btn.data('direccion') || 'N/A');
    
    // Sección 2: Info Producto
    var producto = btn.data('producto') || 'Sin productos registrados';
    $('#detProducto').html('<span class="product-name">' + producto + '</span>');
    
    // Sección 3: Info Crédito + Valores
    $('#detMonto').text('$' + formatMoney(btn.data('monto')));
    $('#detValorContado').text('$' + formatMoney(btn.data('valor-contado')));
    $('#detCuotas').text(btn.data('cuotas') || 'N/A');
    $('#detCuotaMensual').text('$' + formatMoney(btn.data('cuota-mensual')));
    $('#detTipoCobro').text(btn.data('tipo-cobro') || 'N/A');
    $('#detEntidad').text(btn.data('entidad') || 'N/A');
    $('#detOperador').text(btn.data('operador') || 'N/A');
    $('#detAbonado').text('$' + formatMoney(btn.data('abonado')));
    $('#detSaldo').text('$' + formatMoney(btn.data('saldo')));
    $('#detProgressBar').css('width', btn.data('porcentaje') + '%');
    $('#detPorcentaje').text(btn.data('porcentaje') + '% pagado');
    
    // Sección 4: Equipo de Gestión
    $('#detLider').text(btn.data('lider') || 'N/A');
    $('#detlider').text(btn.data('lider') || 'N/A');
    $('#detAsesor').text(btn.data('asesor') || 'N/A');
    $('#detAliado').text(btn.data('aliado') || 'N/A');
    $('#detRevisor').text(btn.data('revisor') || 'N/A');
    
    // Sección 5: Info Comercial
    $('#detTienda').text(btn.data('tienda') || 'N/A');
    $('#detVendedor').text(btn.data('vendedor') || 'N/A');
    $('#detBanco').text(btn.data('banco') || 'N/A');
    
    // Sección 8: Info Adicional
    $('#detObservaciones').text(btn.data('observaciones') || 'Sin observaciones');
    $('#detIDSolicitud').text(codCredito || 'N/A');
    $('#detFecha').text(btn.data('fecha') || 'N/A');
    $('#detHora').text(btn.data('hora') || 'N/A');
    
    // AJAX para obtener datos frescos y completos
    $.ajax({
        url: 'obtener_detalle_credito_movil_ajax.php', type: 'GET', data: { cod: codCredito }, dataType: 'json',
        success: function(response) {
            if (response.success) {
                var d = response.data;
                // Actualizar campos con la respuesta del servidor
                $('#detLider').text(d.lider);
                $('#detlider').text(d.lider);
                $('#detAsesor').text(d.asesor);
                $('#detAliado').text(d.aliado);
                $('#detRevisor').text(d.revisor);
                $('#detOperador').text(d.operador);
                $('#detVendedor').text(d.vendedor);
                $('#detTipoCobro').text(d.tipo_venta); // Campo corregido
                $('#detBanco').text(d.banco);
                $('#detObservaciones').text(d.observaciones);
            }
        },
        error: function() {
            console.log('Error al actualizar detalles del crédito');
        }
    });

    // AJAX para obtener imágenes
    $('#detImagenes').html('<div style="text-align:center;padding:2rem;"><i class="fa-solid fa-spinner fa-spin"></i> Cargando imágenes...</div>');
    
    $.ajax({
        url: 'obtener_imagenes_nota_observacion_todas_modal_ajax.php', type: 'POST', data: { cod_info_factura_venta: codCredito }, dataType: 'json',
        success: function(response) {
            var container = $('#detImagenes');
            container.empty();
            
            // Obtener estado de la factura desde el botón que abrió el modal
            var estadoFactura = btn.data('estado'); 
            var esCerrada = (estadoFactura === 'CERRADA');

            if (response.success && response.imagenes && response.imagenes.length > 0) {
                var html = '<div style="display: flex; flex-direction: column; gap: 15px;">';
                response.imagenes.forEach(function(img) {
                    var titulo = img.nombre_nota_observacion || 'Sin título';
                    var desc = img.descripcion_nota_observacion || '';
                    var fecha = img.fecha_ymd || '';
                    var hora = img.fecha_hora || '';
                    
                    // Determinar estilos según obligatoriedad (adaptado a tema oscuro)
                    var esPrimario = (img.cod_estado_obligatorio == '1');
                    var esSecundario = (img.cod_estado_obligatorio2 == '1');
                    
                    var borderColor = '#334155';
                    var iconColor = '#94a3b8';
                    var labelText = titulo;
                    
                    if (esPrimario) {
                        borderColor = '#ef4444'; // Rojo para obligatorio
                        iconColor = '#ef4444';
                        labelText = '✓ ' + titulo;
                    } else if (esSecundario) {
                        borderColor = '#f59e0b'; // Naranja para secundario
                        iconColor = '#f59e0b';
                        labelText = '📋 ' + titulo;
                    }

                    // Determinar icono del encabezado
                    var headerIcon = 'fa-image';
                    if (esPrimario) headerIcon = 'fa-exclamation-circle';
                    else if (esSecundario) headerIcon = 'fa-clipboard-list';

                    // Lógica para imagen linkeada o no
                    var imageHtml = '';
                    if (esCerrada) {
                         // Si está cerrada, solo mostrar imagen sin enlace y cursor default
                         imageHtml = `
                            <div style="display: block; width: 100%; text-align: center; cursor: default;" title="No disponible para facturas cerradas">
                                <img src="${img.url_img_min_producto}" style="max-width: 100%; max-height: 250px; border-radius: 8px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); opacity: 0.8;">
                            </div>
                        `;
                    } else {
                         // Si no está cerrada, enlace a original
                         imageHtml = `
                            <a href="${img.url_img_orig_producto}" target="_blank" style="display: block; width: 100%; text-align: center;">
                                <img src="${img.url_img_min_producto}" style="max-width: 100%; max-height: 250px; border-radius: 8px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);">
                            </a>
                        `;
                    }

                    html += `
                        <div class="img-card animate-in" style="background: rgba(255,255,255,0.03); border-radius: 12px; border: 1px solid ${borderColor}; overflow: hidden;">
                            <div style="padding: 10px 15px; background: rgba(0,0,0,0.2); border-bottom: 1px solid ${borderColor}; display: flex; align-items: center; gap: 8px;">
                                <i class="fa ${headerIcon}" style="color: ${iconColor};"></i>
                                <span style="font-weight: 600; color: #e2e8f0; font-size: 14px;">${labelText}</span>
                            </div>
                            
                            <div style="padding: 15px; display: flex; justify-content: center; background: rgba(0,0,0,0.1);">
                                ${imageHtml}
                            </div>

                            <div style="padding: 10px 15px; background: rgba(0,0,0,0.2); border-top: 1px solid rgba(255,255,255,0.05); display: flex; justify-content: space-between; color: #94a3b8; font-size: 11px;">
                                <span><i class="fa fa-calendar" style="margin-right: 4px;"></i>${fecha}</span>
                                <span><i class="fa fa-clock-o" style="margin-right: 4px;"></i>${hora}</span>
                            </div>
                            
                            ${desc ? `<div style="padding: 10px 15px; border-top: 1px solid rgba(255,255,255,0.05); color: #cbd5e1; font-size: 12px; background: rgba(255,255,255,0.02);">
                                <i class="fa fa-comment-dots" style="margin-right: 5px; color: #64748b;"></i>${desc}
                            </div>` : ''}
                        </div>
                    `;
                });
                html += '</div>';
                container.html(html);
            } else {
                container.html(`
                    <div style="text-align: center; padding: 2rem; background: rgba(255, 255, 255, 0.05); border-radius: 8px;">
                        <i class="fa-solid fa-images" style="font-size: 2rem; color: #64748b; margin-bottom: 0.5rem;"></i>
                        <p style="color: #94a3b8; margin: 0;">Sin imágenes adjuntas</p>
                    </div>
                `);
            }
        },
        error: function() {
            $('#detImagenes').html('<div style="text-align:center;padding:2rem;color:#ef4444;">Error al cargar imágenes</div>');
        }
    });
    // Guardar el código del crédito para uso posterior con el comprobante
    $('#codCreditoComprobante').val(codCredito);
    // Cargar comprobante de pago si existe
    cargarComprobanteActual(codCredito);
    // Mostrar modal
    $('#modalDetalleOverlay').addClass('show');
});

// Función para cargar el comprobante actual si existe
function cargarComprobanteActual(codCredito) {
    $.ajax({
        url: 'obtener_comprobante_pago_ajax.php', type: 'POST', data: { cod_info_factura_venta: codCredito }, dataType: 'json',
        success: function(response) {
            if (response.success && response.url_comprobante) {
                $('#linkComprobanteActual').attr('href', response.url_comprobante);
                $('#comprbanteActual').show();
            } else {
                $('#comprbanteActual').hide();
            }
        },
        error: function() {
            $('#comprbanteActual').hide();
        }
    });
}

// Función para previsualizar el comprobante seleccionado
function previsualizarComprobante(input) {
    if (input.files && input.files[0]) {
        var file = input.files[0];
        var fileName = file.name;
        var fileSize = (file.size / 1024 / 1024).toFixed(2); // MB
        
        // Validar tamaño (máximo 10MB)
        if (file.size > 10 * 1024 * 1024) {
            Swal.fire({ icon: 'error', title: 'Archivo muy grande', text: 'El archivo no debe superar los 10MB', background: '#1a1f2e', color: 'white', confirmButtonColor: '#8b5cf6' });
            input.value = '';
            return;
        }
        
        // Validar tipo de archivo
        var allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
        if (!allowedTypes.includes(file.type)) {
            Swal.fire({ icon: 'error', title: 'Tipo de archivo no válido', text: 'Solo se permiten imágenes (JPG, PNG) y documentos (PDF, DOC, DOCX)', background: '#1a1f2e', color: 'white', confirmButtonColor: '#8b5cf6' });
            input.value = '';
            return;
        }
        
        // Mostrar preview
        $('#nombreArchivoComprobante').text(fileName);
        $('#tamanoArchivoComprobante').text(fileSize + ' MB');
        $('#previewComprobante').show();
    }
}

// Función para cargar el comprobante
function cargarComprobante() {
    var input = document.getElementById('inputComprobante');
    var codCredito = $('#codCreditoComprobante').val();
    
    if (!input.files || !input.files[0]) {
        Swal.fire({ icon: 'warning', title: 'Sin archivo', text: 'Por favor seleccione un archivo para cargar', background: '#1a1f2e', color: 'white', confirmButtonColor: '#8b5cf6' });
        return;
    }
    
    if (!codCredito) {
        Swal.fire({ icon: 'error', title: 'Error', text: 'No se pudo identificar el crédito', background: '#1a1f2e', color: 'white', confirmButtonColor: '#8b5cf6' });
        return;
    }
    // Mostrar loading
    Swal.fire({ title: 'Cargando comprobante...', html: '<i class="fa-solid fa-spinner fa-spin" style="font-size: 2rem; color: #8b5cf6;"></i><p style="margin-top: 1rem;">Por favor espere...</p>', showConfirmButton: false, allowOutsideClick: false, background: '#1a1f2e', color: 'white' });
    // Preparar FormData
    var formData = new FormData();
    formData.append('comprobante', input.files[0]);
    formData.append('cod_info_factura_venta', codCredito);
    
    // Enviar archivo
    $.ajax({
        url: 'cargar_comprobante_pago_ajax.php', type: 'POST', data: formData, processData: false, contentType: false, dataType: 'json',
        success: function(response) {
            Swal.close();
            if (response.success) {
                Swal.fire({ icon: 'success', title: '¡Cargado!', text: response.mensaje || 'Comprobante de pago cargado correctamente', background: '#1a1f2e', color: 'white', confirmButtonColor: '#8b5cf6'
                }).then(() => {
                    // Limpiar y ocultar preview
                    cancelarComprobante();
                    // Recargar comprobante actual
                    cargarComprobanteActual(codCredito);
                });
            } else {
                Swal.fire({ icon: 'error', title: 'Error', text: response.mensaje || 'No se pudo cargar el comprobante', background: '#1a1f2e', color: 'white', confirmButtonColor: '#8b5cf6' });
            }
        },
        error: function(xhr, status, error) {
            Swal.close();
            console.error('Error:', status, error);
            console.error('Respuesta:', xhr.responseText);
            Swal.fire({ icon: 'error', title: 'Error de conexión', text: 'No se pudo cargar el comprobante. Intente nuevamente.', background: '#1a1f2e', color: 'white', confirmButtonColor: '#8b5cf6' });
        }
    });
}
// Función para cancelar la carga del comprobante
function cancelarComprobante() {
    $('#inputComprobante').val('');
    $('#previewComprobante').hide();
    $('#nombreArchivoComprobante').text('');
    $('#tamanoArchivoComprobante').text('');
}

// Abrir modal Contactar
$(document).on('click', '.btn-contactar', function() {
    var btn = $(this);
    telefonoContacto = String(btn.data('telefono') || '');
    clienteContacto = btn.data('cliente') || '';
    saldoContacto = btn.data('saldo') || 0;
    tiendaContacto = btn.data('tienda') || '';
    
    if (!telefonoContacto) {
        Swal.fire({ icon: 'warning', title: 'Sin teléfono', text: 'Este cliente no tiene teléfono registrado', confirmButtonColor: '#8b5cf6', background: '#1a1f2e', color: 'white' });
        return;
    }
    
    $('#contCliente').text(clienteContacto);
    $('#contTelefono').text(telefonoContacto);
    $('#mensajeWhatsapp').val('');
    $('#modalContactarOverlay').addClass('show');
});

function cerrarModalDetalle() { $('#modalDetalleOverlay').removeClass('show'); }
function cerrarModalContactar() { $('#modalContactarOverlay').removeClass('show'); }
// Funciones del modal de comprobante
function abrirModalComprobante(codCredito, nombreCliente) {
    $('#compCodCredito').val(codCredito);
    $('#compCodigo').text(codCredito);
    $('#compCliente').text(nombreCliente);
    
    // Resetear el formulario
    $('#compInputFile').val('');
    $('#compPreview').hide();
    $('#compBtnCargar').hide();
    
    // Cargar comprobante actual si existe
    $.ajax({
        url: 'obtener_comprobante_pago_ajax.php', type: 'POST', data: { cod_info_factura_venta: codCredito }, dataType: 'json',
        success: function(response) {
            if (response.success && response.url_comprobante) {
                $('#compLinkActual').attr('href', response.url_comprobante);
                $('#compComprobanteActual').show();
            } else {
                $('#compComprobanteActual').hide();
            }
        },
        error: function() {
            $('#compComprobanteActual').hide();
        }
    });
    // Mostrar modal
    $('#modalComprobanteOverlay').addClass('show');
}

function cerrarModalComprobante() { $('#modalComprobanteOverlay').removeClass('show'); }

function compPrevisualizarArchivo(input) {
    if (input.files && input.files[0]) {
        var file = input.files[0];
        var fileName = file.name;
        var fileSize = (file.size / 1024 / 1024).toFixed(2);
        // Validar tamaño (máximo 10MB)
        if (file.size > 10 * 1024 * 1024) {
            if (typeof Swal !== 'undefined') {
                Swal.fire({ icon: 'error', title: 'Archivo muy grande', text: 'El archivo no debe superar los 10MB', background: '#1a1f2e', color: 'white', confirmButtonColor: '#8b5cf6' });
            } else {
                showToast('error', 'Archivo muy grande', 'El archivo no debe superar los 10MB');
            }
            input.value = '';
            return;
        }
        // Validar tipo de archivo
        var allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
        if (!allowedTypes.includes(file.type)) {
            if (typeof Swal !== 'undefined') {
                Swal.fire({ icon: 'error', title: 'Tipo de archivo no válido', text: 'Solo se permiten imágenes (JPG, PNG) y documentos (PDF, DOC, DOCX)', background: '#1a1f2e', color: 'white', confirmButtonColor: '#8b5cf6' });
            } else {
                showToast('error', 'Tipo de archivo no válido', 'Solo se permiten imágenes (JPG, PNG) y documentos (PDF, DOC, DOCX)');
            }
            input.value = '';
            return;
        }
        // Mostrar preview
        $('#compNombreArchivo').text(fileName);
        $('#compTamanoArchivo').text(fileSize + ' MB');
        $('#compPreview').show();
        $('#compBtnCargar').show();
    }
}

function compCargarArchivo() {
    var input = document.getElementById('compInputFile');
    var codCredito = $('#compCodCredito').val();
    
    if (!input.files || !input.files[0]) {
        if (typeof Swal !== 'undefined') {
            Swal.fire({ icon: 'warning', title: 'Sin archivo', text: 'Por favor seleccione un archivo para cargar', background: '#1a1f2e', color: 'white', confirmButtonColor: '#8b5cf6' });
        } else {
            showToast('warning', 'Sin archivo', 'Por favor seleccione un archivo para cargar');
        }
        return;
    }
    
    // Mostrar loading
    if (typeof Swal !== 'undefined') {
        Swal.fire({ title: 'Cargando comprobante...', html: '<i class="fa-solid fa-spinner fa-spin" style="font-size: 2rem; color: #f59e0b;"></i><p style="margin-top: 1rem;">Por favor espere...</p>', showConfirmButton: false, allowOutsideClick: false, background: '#1a1f2e', color: 'white' });
    }
    
    // Preparar FormData
    var formData = new FormData();
    formData.append('comprobante', input.files[0]);
    formData.append('cod_info_factura_venta', codCredito);
    
    // Enviar archivo
    $.ajax({
        url: 'cargar_comprobante_pago_ajax.php', type: 'POST', data: formData, processData: false, contentType: false, dataType: 'json',
        success: function(response) {
            if (typeof Swal !== 'undefined') { Swal.close(); }
            if (response.success) {
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        icon: 'success', title: '¡Cargado!', text: response.mensaje || 'Comprobante de pago cargado correctamente', background: '#1a1f2e', color: 'white', confirmButtonColor: '#8b5cf6', timer: 2000, timerProgressBar: true
                    }).then(() => {
                        cerrarModalComprobante();
                    });
                } else {
                    showToast('success', '¡Cargado!', 'Comprobante de pago cargado correctamente');
                    cerrarModalComprobante();
                }
            } else {
                if (typeof Swal !== 'undefined') {
                    Swal.fire({ icon: 'error', title: 'Error', text: response.mensaje || 'No se pudo cargar el comprobante', background: '#1a1f2e', color: 'white', confirmButtonColor: '#8b5cf6' });
                } else {
                    showToast('error', 'Error', response.mensaje || 'No se pudo cargar el comprobante');
                }
            }
        },
        error: function(xhr, status, error) {
            if (typeof Swal !== 'undefined') { Swal.close(); }
            console.error('Error:', status, error);
            console.error('Respuesta:', xhr.responseText);
            if (typeof Swal !== 'undefined') {
                Swal.fire({ icon: 'error', title: 'Error de conexión', text: 'No se pudo cargar el comprobante. Intente nuevamente.', background: '#1a1f2e', color: 'white', confirmButtonColor: '#8b5cf6' });
            } else {
                showToast('error', 'Error de conexión', 'No se pudo cargar el comprobante. Intente nuevamente.');
            }
        }
    });
}

// Sistema de notificaciones Toast
function showToast(type, title, message, duration = 4000) {
    var container = document.getElementById('toastContainer');
    if (!container) return;
    
    var icons = {
        success: 'fa-check-circle', error: 'fa-times-circle', warning: 'fa-exclamation-triangle', info: 'fa-info-circle' };
    
    var toast = document.createElement('div');
    toast.className = 'toast ' + type;
    toast.innerHTML = `<i class="fa-solid ${icons[type]} toast-icon"></i><div class="toast-content"><div class="toast-title">${title}</div><div class="toast-message">${message}</div></div><button class="toast-close" onclick="closeToast(this)">&times;</button>`;
    
    container.appendChild(toast);
    
    setTimeout(function() { closeToast(toast.querySelector('.toast-close')); }, duration);
}

function closeToast(button) {
    var toast = button.parentElement;
    toast.classList.add('hiding');
    setTimeout(function() { toast.remove(); }, 300);
}

function formatMoney(value) {
    return parseFloat(value || 0).toLocaleString('es-CO');
}

function setMensaje(tipo) {
    var mensaje = '';
    var saldoFormateado = formatMoney(saldoContacto);
    
    switch(tipo) {
        case 'recordatorio':
            mensaje = 'Hola ' + clienteContacto + ', le recordamos que tiene un saldo pendiente de $' + saldoFormateado + ' en ' + tiendaContacto + '. ¿Cuándo podría realizar el pago? Gracias.';
            break;
        case 'saludo':
            mensaje = 'Hola ' + clienteContacto + ', esperamos que se encuentre bien. Le escribimos de ' + tiendaContacto + ' para saludarle y recordarle que estamos a su disposición. ¡Saludos!';
            break;
        case 'mora':
            mensaje = 'Hola ' + clienteContacto + ', le informamos que su cuota se encuentra en mora. El saldo pendiente es de $' + saldoFormateado + '. Por favor comuníquese con nosotros para regularizar su situación. Gracias.';
            break;
    }
    $('#mensajeWhatsapp').val(mensaje);
}

function enviarWhatsApp() {
    var mensaje = $('#mensajeWhatsapp').val();
    var telefono = String(telefonoContacto).replace(/[^0-9]/g, '');
    if (telefono.length === 10) telefono = '57' + telefono;
    var url = 'https://wa.me/' + telefono + '?text=' + encodeURIComponent(mensaje);
    window.open(url, '_blank');
    cerrarModalContactar();
}

// Cerrar modales al hacer clic fuera
$(document).on('click', '.modal-overlay', function(e) {
    if (e.target === this) {
        $(this).removeClass('show');
    }
});
</script>

<button class="notification-bell-movil" id="notificationBellMovil" onclick="toggleNotificationPanelMovil()">
    <i class="fa-solid fa-bell"></i>
    <span class="notification-badge-movil" id="notificationBadgeMovil" style="display: none;">0</span>
</button>

<div class="notification-panel-movil" id="notificationPanelMovil">
    <div class="notification-header-movil">
        <h4><i class="fa-solid fa-bell"></i> Notificaciones</h4>
        <div class="notification-header-actions-movil">
            <button onclick="marcarTodasLeidasMovil()"><i class="fa-solid fa-check-double"></i> Leer todas</button>
            <button onclick="toggleNotificationPanelMovil()"><i class="fa-solid fa-times"></i></button>
        </div>
    </div>
    <div class="notification-list-movil" id="notificationListMovil">
        <div class="notification-empty-movil">
            <i class="fa-solid fa-bell-slash"></i>
            <p>No hay notificaciones pendientes</p>
        </div>
    </div>
</div>

<script>
var notificationCheckIntervalMovil = null;

$(document).ready(function() {
    cargarNotificacionesMovil();
    notificationCheckIntervalMovil = setInterval(cargarNotificacionesMovil, 30000);
});

function cargarNotificacionesMovil() {
    $.ajax({
        url: '../admin/obtener_notificaciones_ajax.php', type: 'GET', dataType: 'json',
        success: function(response) {
            if (response.success) { actualizarUINotificacionesMovil(response.notificaciones, response.count); }
        }
    });
}

function actualizarUINotificacionesMovil(notificaciones, count) {
    var $badge = $('#notificationBadgeMovil');
    var $bell = $('#notificationBellMovil');
    var $list = $('#notificationListMovil');
    
    if (count > 0) {
        $badge.text(count > 99 ? '99+' : count).show();
        $bell.addClass('has-notifications');
        if (!$bell.hasClass('notified')) {
            $bell.addClass('shake notified');
            setTimeout(function() { $bell.removeClass('shake'); }, 500);
        }
    } else {
        $badge.hide();
        $bell.removeClass('has-notifications notified');
    }
    
    if (notificaciones.length > 0) {
        var html = '';
        notificaciones.forEach(function(notif) {
            var iconClass = 'type-' + (notif.tipo || 1);
            var iconSymbol = getNotificationIconMovil(notif.tipo);
            html += '<div class="notification-item-movil" onclick="marcarNotificacionLeidaMovil(' + notif.id + ', this)">';
            html += '<div class="notification-icon-movil ' + iconClass + '"><i class="fa-solid ' + iconSymbol + '"></i></div>';
            html += '<div class="notification-content-movil">';
            html += '<div class="notification-title-movil">' + escapeHtmlMovil(notif.titulo) + '</div>';
            html += '<div class="notification-desc-movil">' + escapeHtmlMovil(notif.descripcion) + '</div>';
            html += '<div class="notification-time-movil"><i class="fa-regular fa-clock"></i> ' + notif.fecha_corta + '</div>';
            html += '</div></div>';
        });
        $list.html(html);
    } else {
        $list.html('<div class="notification-empty-movil"><i class="fa-solid fa-bell-slash"></i><p>No hay notificaciones pendientes</p></div>');
    }
}

function getNotificationIconMovil(tipo) {
    switch(parseInt(tipo)) {
        case 1: return 'fa-signature';
        case 2: return 'fa-exclamation-circle';
        case 3: return 'fa-info-circle';
        default: return 'fa-bell';
    }
}

function toggleNotificationPanelMovil() { $('#notificationPanelMovil').toggleClass('show'); }

$(document).on('click', function(e) {
    if (!$(e.target).closest('#notificationPanelMovil, #notificationBellMovil').length) { $('#notificationPanelMovil').removeClass('show'); }
});

function marcarNotificacionLeidaMovil(codNotificacion, element) {
    $.ajax({
        url: '../admin/marcar_notificacion_leida_ajax.php', type: 'POST', data: { cod_notificacion: codNotificacion }, dataType: 'json',
        success: function(response) {
            if (response.success) {
                $(element).fadeOut(300, function() {
                    $(this).remove();
                    cargarNotificacionesMovil();
                });
            }
        }
    });
}

function marcarTodasLeidasMovil() {
    Swal.fire({
        title: '¿Marcar todas como leídas?', text: 'Se marcarán todas las notificaciones pendientes como leídas', icon: 'question', showCancelButton: true, confirmButtonColor: '#8b5cf6', cancelButtonColor: '#6c757d', confirmButtonText: 'Sí, marcar todas', cancelButtonText: 'Cancelar', background: '#1a1f2e', color: 'white'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '../admin/marcar_notificacion_leida_ajax.php', type: 'POST', data: { marcar_todas: 'si' }, dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        cargarNotificacionesMovil();
                        Swal.fire({ icon: 'success', title: '¡Listo!', text: 'Todas las notificaciones han sido marcadas como leídas', timer: 2000, showConfirmButton: false, background: '#1a1f2e', color: 'white' });
                    }
                }
            });
        }
    });
}

function escapeHtmlMovil(text) {
    if (!text) return '';
    var div = document.createElement('div');
    div.appendChild(document.createTextNode(text));
    return div.innerHTML;
}
</script>

</body>
</html>

