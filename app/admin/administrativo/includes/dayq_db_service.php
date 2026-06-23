<?php
/**
 * DayqDbService - Servicio centralizado de consultas a tablas tbl15_*
 * Reutilización de queries para Dashboard, Créditos, Tesorería, Reportes
 */
class DayqDbService {
    private $con;

    public function __construct(mysqli $con) {
        $this->con = $con;
    }

    // ========== DASHBOARD KPIs ==========
    
    public function getVentasDia($fecha = null) {
        if (!$fecha) $fecha = date('Y-m-d');
        $fecha_sql = $this->con->real_escape_string($fecha);
        
        $sql = "SELECT 
                    COALESCE(SUM(total_precio_venta), 0) AS ventas_hoy,
                    (SELECT COALESCE(SUM(total_precio_venta), 0) 
                     FROM tbl15_info_factura_venta 
                     WHERE DATE(fecha_creacion) = DATE_SUB('$fecha_sql', INTERVAL 1 DAY)) AS ventas_ayer
                FROM tbl15_info_factura_venta 
                WHERE DATE(fecha_creacion) = '$fecha_sql'";
        
        $r = $this->con->query($sql);
        if (!$r) return ['ventas' => 0, 'delta' => 0, 'ayer' => 0];
        
        $row = $r->fetch_assoc();
        $ventas = (float)(isset($row['ventas_hoy']) ? $row['ventas_hoy'] : 0);
        $ayer = (float)(isset($row['ventas_ayer']) ? $row['ventas_ayer'] : 0);
        $delta = $ayer > 0 ? (($ventas - $ayer) / $ayer) * 100 : 0;
        
        return ['ventas' => $ventas, 'delta' => round($delta, 2), 'ayer' => $ayer];
    }

    public function getCreditosAprobados($fecha_desde = null, $fecha_hasta = null) {
        if (!$fecha_desde) $fecha_desde = date('Y-m-01');
        if (!$fecha_hasta) $fecha_hasta = date('Y-m-d');
        
        $desde = $this->con->real_escape_string($fecha_desde);
        $hasta = $this->con->real_escape_string($fecha_hasta);
        
        $sql = "SELECT 
                    COUNT(*) AS total_creditos,
                    SUM(CASE WHEN nombre_estado_factura = 'ABIERTA' THEN 1 ELSE 0 END) AS aprobados,
                    SUM(CASE WHEN nombre_estado_factura = 'PENDIENTE' THEN 1 ELSE 0 END) AS pendientes,
                    COALESCE(SUM(total_precio_venta), 0) AS valor_total
                FROM tbl15_info_factura_venta
                WHERE DATE(fecha_creacion) BETWEEN '$desde' AND '$hasta'";
        
        $r = $this->con->query($sql);
        if (!$r) return ['total' => 0, 'aprobados' => 0, 'pendientes' => 0, 'valor' => 0];
        
        $row = $r->fetch_assoc();
        return [
            'total' => (int)(isset($row['total_creditos']) ? $row['total_creditos'] : 0),
            'aprobados' => (int)(isset($row['aprobados']) ? $row['aprobados'] : 0),
            'pendientes' => (int)(isset($row['pendientes']) ? $row['pendientes'] : 0),
            'valor' => (float)(isset($row['valor_total']) ? $row['valor_total'] : 0)
        ];
    }

    public function getValorFinanciado($fecha_desde = null, $fecha_hasta = null) {
        if (!$fecha_desde) $fecha_desde = date('Y-m-01');
        if (!$fecha_hasta) $fecha_hasta = date('Y-m-d');
        
        $desde = $this->con->real_escape_string($fecha_desde);
        $hasta = $this->con->real_escape_string($fecha_hasta);
        
        $sql = "SELECT COALESCE(SUM(cc.monto_deuda), 0) AS valor_financiado
                FROM tbl15_cuentas_cobrar cc
                INNER JOIN tbl15_info_factura_venta ifv ON ifv.cod_info_factura_venta = cc.cod_info_factura_venta
                WHERE DATE(ifv.fecha_creacion) BETWEEN '$desde' AND '$hasta'";
        
        $r = $this->con->query($sql);
        if (!$r) return 0;
        
        $row = $r->fetch_assoc();
        return (float)(isset($row['valor_financiado']) ? $row['valor_financiado'] : 0);
    }

    public function getFlujoCajaHoy($fecha = null) {
        if (!$fecha) $fecha = date('Y-m-d');
        $fecha_sql = $this->con->real_escape_string($fecha);
        
        $sql = "SELECT 
                    COALESCE(SUM(total_debitos), 0) AS entradas,
                    COALESCE(SUM(total_creditos), 0) AS salidas
                FROM tbl15_movimiento_caja
                WHERE DATE(fecha_ymd_movimiento_caja) = '$fecha_sql'";
        
        $r = $this->con->query($sql);
        if (!$r) return ['entradas' => 0, 'salidas' => 0, 'neto' => 0];
        
        $row = $r->fetch_assoc();
        $entradas = (float)(isset($row['entradas']) ? $row['entradas'] : 0);
        $salidas = (float)(isset($row['salidas']) ? $row['salidas'] : 0);
        return ['entradas' => $entradas, 'salidas' => $salidas, 'neto' => $entradas - $salidas];
    }

    /**
     * getCreditosTable — Consulta paginada de créditos con conteo total.
     * Reemplaza el patrón getUltimosCreditosPaginados + getUltimosCreditosTotal.
     *
     * @return array{items: array, total: int, pagina: int, por_pagina: int, total_paginas: int, desde: int, hasta: int}
     */
    public function getCreditosTable($pagina = 1, $por_pagina = 10, $fecha_desde = null, $fecha_hasta = null, $buscar = '') {
        $pagina = max(1, (int) $pagina);

        $where = '';
        if ($fecha_desde !== null && $fecha_hasta !== null && $fecha_desde !== '' && $fecha_hasta !== '') {
            $desde = $this->con->real_escape_string($fecha_desde);
            $hasta = $this->con->real_escape_string($fecha_hasta);
            $where = "WHERE DATE(ifv.fecha_creacion) BETWEEN '$desde' AND '$hasta'";
        }

        if ($buscar !== '') {
            $q = $this->con->real_escape_string("%$buscar%");
            $where .= " AND (ifv.cod_factura LIKE '$q'
                       OR t.nombres_apellidos_tercero LIKE '$q'
                       OR ti.nombre_tienda LIKE '$q')";
        }

        // Total de registros
        $r_tot = $this->con->query("SELECT COUNT(*) AS total FROM tbl15_info_factura_venta ifv $where");
        $total = 0;
        if ($r_tot && ($row = $r_tot->fetch_assoc())) {
            $total = (int) $row['total'];
        }

        $total_paginas = $total > 0 ? (int) ceil($total / $por_pagina) : 1;
        $pagina = min($pagina, $total_paginas);
        $offset = ($pagina - 1) * $por_pagina;

        $sql = "SELECT
                    ifv.cod_info_factura_venta,
                    ifv.cod_factura,
                    ifv.nombre_estado_factura,
                    ifv.total_precio_venta AS valor,
                    ifv.fecha_creacion,
                    t.nombres_apellidos_tercero AS cliente,
                    ti.nombre_tienda AS comercio,
                    ec.nombre_entidad_crediticia AS linea,
                    cc.monto_deuda,
                    cc.abonado,
                    (cc.monto_deuda - cc.abonado) AS saldo
                FROM tbl15_info_factura_venta ifv
                LEFT JOIN tbl15_tercero t ON t.cod_tercero = ifv.cod_tercero
                LEFT JOIN tbl15_tienda ti ON ti.cod_tienda = ifv.cod_tercero
                LEFT JOIN tbl15_cuentas_cobrar cc ON cc.cod_info_factura_venta = ifv.cod_info_factura_venta
                LEFT JOIN tbl15_entidad_crediticia ec ON ec.cod_entidad_crediticia = ifv.cod_tercero
                $where
                ORDER BY ifv.fecha_creacion DESC
                LIMIT $offset, $por_pagina";

        $items = array();
        $r = $this->con->query($sql);
        if ($r) {
            while ($row = $r->fetch_assoc()) {
                $items[] = $row;
            }
        }

        $desde_num = $total === 0 ? 0 : $offset + 1;
        $hasta_num = $total === 0 ? 0 : min($offset + $por_pagina, $total);

        return array(
            'items' => $items,
            'total' => $total,
            'pagina' => $pagina,
            'por_pagina' => $por_pagina,
            'total_paginas' => $total_paginas,
            'desde' => $desde_num,
            'hasta' => $hasta_num,
        );
    }

    // ========== ALERTAS ==========
    
    public function getAlertasOperativas($fecha = null) {
        if (!$fecha) $fecha = date('Y-m-d');
        $fecha_sql = $this->con->real_escape_string($fecha);
        
        $alertas = [
            'sin_documentos' => 0,
            'sin_voucher' => 0,
            'habilitadores_sin_girar' => 0,
            'creditos_perdida' => 0
        ];
        
        // Créditos sin documentos
        $r = $this->con->query("SELECT COUNT(*) AS cnt FROM tbl15_info_factura_venta ifv 
                                WHERE DATE(ifv.fecha_creacion) = '$fecha_sql' 
                                AND NOT EXISTS (SELECT 1 FROM tbl15_archivo_adjunto WHERE cod_info_factura_venta = ifv.cod_info_factura_venta)");
        if ($r) { $_d = $r->fetch_assoc(); $alertas['sin_documentos'] = (int)(isset($_d['cnt']) ? $_d['cnt'] : 0); }
        
        // Créditos sin voucher de pago
        $r = $this->con->query("SELECT COUNT(*) AS cnt FROM tbl15_cuentas_cobrar cc 
                                WHERE DATE(cc.fecha_creacion) = '$fecha_sql' 
                                AND cc.abonado > 0 
                                AND NOT EXISTS (SELECT 1 FROM tbl15_archivo_adjunto WHERE cod_cuentas_cobrar = cc.cod_cuentas_cobrar)");
        if ($r) { $_d = $r->fetch_assoc(); $alertas['sin_voucher'] = (int)(isset($_d['cnt']) ? $_d['cnt'] : 0); }
        
        return $alertas;
    }

    // ========== DETALLE DE CRÉDITO ==========
    
    public function getCreditoDetalle($cod_info_factura_venta) {
        $cod = (int)$cod_info_factura_venta;
        
        $sql = "SELECT 
                    ifv.*,
                    t.nombres_apellidos_tercero,
                    t.identificacion_tercero,
                    t.telefono1_tercero,
                    t.correo_tercero,
                    ti.nombre_tienda,
                    ti.identificacion_tercero AS tienda_nit,
                    ti.direccion_tercero AS tienda_direccion,
                    cc.cod_cuentas_cobrar,
                    cc.monto_deuda,
                    cc.abonado,
                    cc.total_pendiente,
                    cc.numero_cuota,
                    cc.monto_cuota,
                    cc.interes_ptj,
                    ec.nombre_entidad_crediticia
                FROM tbl15_info_factura_venta ifv
                LEFT JOIN tbl15_tercero t ON t.cod_tercero = ifv.cod_tercero
                LEFT JOIN tbl15_tienda ti ON ti.cod_tienda = ifv.cod_tercero
                LEFT JOIN tbl15_cuentas_cobrar cc ON cc.cod_info_factura_venta = ifv.cod_info_factura_venta
                LEFT JOIN tbl15_entidad_crediticia ec ON ec.cod_entidad_crediticia = ifv.cod_tercero
                WHERE ifv.cod_info_factura_venta = $cod";
        
        $r = $this->con->query($sql);
        if (!$r) return null;
        
        return $r->fetch_assoc();
    }

    public function getCuentaAbonos($cod_cuentas_cobrar) {
        $cod = (int)$cod_cuentas_cobrar;
        
        $sql = "SELECT 
                    cod_cuentas_cobrar_abonos,
                    abonado,
                    cod_tipo_forma_pago,
                    fecha_pago,
                    fecha_creacion
                FROM tbl15_cuentas_cobrar_abonos
                WHERE cod_cuentas_cobrar = $cod
                ORDER BY fecha_pago DESC";
        
        $r = $this->con->query($sql);
        $out = [];
        if ($r) {
            while ($row = $r->fetch_assoc()) {
                $out[] = $row;
            }
        }
        return $out;
    }

    public function getCreditoNotas($cod_info_factura_venta) {
        $cod = (int)$cod_info_factura_venta;
        
        $sql = "SELECT 
                    cod_nota_observacion,
                    nombre_nota_observacion AS observacion,
                    cod_administrador,
                    fecha_creacion
                FROM tbl15_nota_observacion
                WHERE cod_info_factura_venta = $cod
                ORDER BY fecha_creacion DESC";
        
        $r = $this->con->query($sql);
        $out = [];
        if ($r) {
            while ($row = $r->fetch_assoc()) {
                $out[] = $row;
            }
        }
        return $out;
    }

    public function getCreditoArchivos($cod_info_factura_venta) {
        $cod = (int)$cod_info_factura_venta;
        
        $sql = "SELECT 
                    cod_archivo_adjunto,
                    archivo_adjunto_nombre,
                    archivo_adjunto_tipo,
                    archivo_adjunto_ruta,
                    fecha_creacion
                FROM tbl15_archivo_adjunto
                WHERE cod_info_factura_venta = $cod
                ORDER BY fecha_creacion DESC";
        
        $r = $this->con->query($sql);
        $out = [];
        if ($r) {
            while ($row = $r->fetch_assoc()) {
                $out[] = $row;
            }
        }
        return $out;
    }

    // ========== TESORERÍA ==========
    
    public function getMovimientosCajaPaginados($pagina = 1, $por_pagina = 20, $fecha_desde = null, $fecha_hasta = null) {
        $offset = ($pagina - 1) * $por_pagina;
        if (!$fecha_desde) $fecha_desde = date('Y-m-d', strtotime('-3 months'));
        if (!$fecha_hasta) $fecha_hasta = date('Y-m-d');
        
        $desde = $this->con->real_escape_string($fecha_desde);
        $hasta = $this->con->real_escape_string($fecha_hasta);
        
        $sql = "SELECT 
                    cod_movimiento_caja,
                    descripcion_movimiento AS concepto,
                    total_debitos AS entrada,
                    total_creditos AS salida,
                    fecha_ymd_movimiento_caja AS fecha_movimiento,
                    fecha_hora_movimiento_caja AS fecha_creacion,
                    cod_tercero,
                    nombre_puc
                FROM tbl15_movimiento_caja
                WHERE DATE(fecha_ymd_movimiento_caja) BETWEEN '$desde' AND '$hasta'
                ORDER BY fecha_ymd_movimiento_caja DESC, fecha_hora_movimiento_caja DESC
                LIMIT $offset, $por_pagina";
        
        $r = $this->con->query($sql);
        $out = [];
        if ($r) {
            while ($row = $r->fetch_assoc()) {
                $out[] = $row;
            }
        }
        return $out;
    }

    public function getMovimientosCajaTotal($fecha_desde = null, $fecha_hasta = null) {
        if (!$fecha_desde) $fecha_desde = date('Y-m-d', strtotime('-3 months'));
        if (!$fecha_hasta) $fecha_hasta = date('Y-m-d');
        
        $desde = $this->con->real_escape_string($fecha_desde);
        $hasta = $this->con->real_escape_string($fecha_hasta);
        
        $sql = "SELECT COUNT(*) AS total FROM tbl15_movimiento_caja WHERE DATE(fecha_ymd_movimiento_caja) BETWEEN '$desde' AND '$hasta'";
        $r = $this->con->query($sql);
        if (!$r) return 0;
        
        $row = $r->fetch_assoc();
        return (int)(isset($row['total']) ? $row['total'] : 0);
    }

    public function getSaldoTesoreria($fecha_hasta = null) {
        if (!$fecha_hasta) $fecha_hasta = date('Y-m-d');
        $hasta = $this->con->real_escape_string($fecha_hasta);
        
        $sql = "SELECT 
                    COALESCE(SUM(total_debitos), 0) AS total_entradas,
                    COALESCE(SUM(total_creditos), 0) AS total_salidas
                FROM tbl15_movimiento_caja
                WHERE DATE(fecha_ymd_movimiento_caja) <= '$hasta'";
        
        $r = $this->con->query($sql);
        if (!$r) return ['entradas' => 0, 'salidas' => 0, 'saldo' => 0];
        
        $row = $r->fetch_assoc();
        $entradas = (float)(isset($row['total_entradas']) ? $row['total_entradas'] : 0);
        $salidas = (float)(isset($row['total_salidas']) ? $row['total_salidas'] : 0);
        
        return ['entradas' => $entradas, 'salidas' => $salidas, 'saldo' => $entradas - $salidas];
    }

    // ========== COMERCIOS ==========
    
    public function getComerciosPaginados($pagina = 1, $por_pagina = 20, $busca = '') {
        $offset = ($pagina - 1) * $por_pagina;
        $q = $busca ? $this->con->real_escape_string("%$busca%") : '%%';
        
        $sql = "SELECT 
                    cod_tienda,
                    nombre_tienda,
                    identificacion_tercero AS nit,
                    direccion_tercero,
                    telefono1_tercero,
                    correo_tercero,
                    cod_estado,
                    (SELECT COUNT(*) FROM tbl15_info_factura_venta WHERE cod_tercero = ti.cod_tienda) AS total_creditos,
                    (SELECT COALESCE(SUM(total_precio_venta), 0) FROM tbl15_info_factura_venta WHERE cod_tercero = ti.cod_tienda) AS ventas_total
                FROM tbl15_tienda ti
                WHERE nombre_tienda LIKE '$q' OR identificacion_tercero LIKE '$q'
                LIMIT $offset, $por_pagina";
        
        $r = $this->con->query($sql);
        $out = [];
        if ($r) {
            while ($row = $r->fetch_assoc()) {
                $out[] = $row;
            }
        }
        return $out;
    }

    public function getComerciosTotal($busca = '') {
        $q = $busca ? $this->con->real_escape_string("%$busca%") : '%%';
        $sql = "SELECT COUNT(*) AS total FROM tbl15_tienda WHERE nombre_tienda LIKE '$q' OR identificacion_tercero LIKE '$q'";
        $r = $this->con->query($sql);
        if (!$r) return 0;
        $_d = $r->fetch_assoc(); return (int)(isset($_d['total']) ? $_d['total'] : 0);
    }

    // ========== CLIENTES ==========
    
    public function getClientesPaginados($pagina = 1, $por_pagina = 20, $busca = '') {
        $offset = ($pagina - 1) * $por_pagina;
        $q = $busca ? $this->con->real_escape_string("%$busca%") : '%%';
        
        $sql = "SELECT 
                    cod_tercero,
                    identificacion_tercero,
                    nombres_apellidos_tercero,
                    telefono1_tercero,
                    correo_tercero,
                    monto_deuda,
                    cod_estado,
                    (SELECT COUNT(*) FROM tbl15_info_factura_venta WHERE cod_tercero = t.cod_tercero) AS total_creditos,
                    (SELECT COALESCE(SUM(total_precio_venta), 0) FROM tbl15_info_factura_venta WHERE cod_tercero = t.cod_tercero) AS valor_total
                FROM tbl15_tercero t
                WHERE nombre_tipo_tercero = 'CLIENTE'
                AND (nombres_apellidos_tercero LIKE '$q' OR identificacion_tercero LIKE '$q')
                LIMIT $offset, $por_pagina";
        
        $r = $this->con->query($sql);
        $out = [];
        if ($r) {
            while ($row = $r->fetch_assoc()) {
                $out[] = $row;
            }
        }
        return $out;
    }

    public function getClientesTotal($busca = '') {
        $q = $busca ? $this->con->real_escape_string("%$busca%") : '%%';
        $sql = "SELECT COUNT(*) AS total FROM tbl15_tercero WHERE nombre_tipo_tercero = 'CLIENTE' AND (nombres_apellidos_tercero LIKE '$q' OR identificacion_tercero LIKE '$q')";
        $r = $this->con->query($sql);
        if (!$r) return 0;
        $_d = $r->fetch_assoc(); return (int)(isset($_d['total']) ? $_d['total'] : 0);
    }

    // ========== DETALLE HABILITADOR ==========

    /**
     * Obtiene el detalle de una entidad crediticia (habilitador) por su ID.
     */
    public function getHabilitadorDetalle($cod_entidad) {
        $cod = (int)$cod_entidad;

        $sql = "SELECT 
                    ec.cod_entidad_crediticia,
                    ec.nombre_entidad_crediticia,
                    ec.identificacion_tercero AS nit,
                    ec.telefono1_tercero AS telefono,
                    ec.correo_tercero AS email,
                    ec.interes_ptj,
                    ec.comision_ptj,
                    ec.cod_estado,
                    (SELECT COUNT(*) FROM tbl15_info_factura_venta WHERE cod_tercero = ec.cod_entidad_crediticia) AS total_creditos,
                    (SELECT COALESCE(SUM(total_precio_venta), 0) FROM tbl15_info_factura_venta WHERE cod_tercero = ec.cod_entidad_crediticia) AS valor_total,
                    (SELECT COALESCE(SUM(total_debitos), 0) FROM tbl15_movimiento_caja WHERE cod_tercero = ec.cod_entidad_crediticia) AS total_girar
                FROM tbl15_entidad_crediticia ec
                WHERE ec.cod_entidad_crediticia = $cod";

        $r = $this->con->query($sql);
        if (!$r) return null;
        return $r->fetch_assoc();
    }

    public function getCreditosPorHabilitador($cod_entidad, $pagina = 1, $por_pagina = 20) {
        $cod = (int)$cod_entidad;
        $offset = ($pagina - 1) * $por_pagina;

        $sql = "SELECT 
                    ifv.cod_info_factura_venta,
                    ifv.cod_factura,
                    ifv.nombre_estado_factura,
                    ifv.total_precio_venta AS valor,
                    ifv.fecha_creacion,
                    t.nombres_apellidos_tercero AS cliente,
                    ti.nombre_tienda AS comercio,
                    cc.monto_deuda,
                    cc.abonado,
                    (cc.monto_deuda - cc.abonado) AS saldo
                FROM tbl15_info_factura_venta ifv
                LEFT JOIN tbl15_tercero t ON t.cod_tercero = ifv.cod_tercero
                LEFT JOIN tbl15_tienda ti ON ti.cod_tienda = ifv.cod_tercero
                LEFT JOIN tbl15_cuentas_cobrar cc ON cc.cod_info_factura_venta = ifv.cod_info_factura_venta
                WHERE ifv.cod_tercero = $cod
                ORDER BY ifv.fecha_creacion DESC
                LIMIT $offset, $por_pagina";

        $r = $this->con->query($sql);
        $items = array();
        if ($r) {
            while ($row = $r->fetch_assoc()) {
                $items[] = $row;
            }
        }

        $r_tot = $this->con->query("SELECT COUNT(*) AS total FROM tbl15_info_factura_venta WHERE cod_tercero = $cod");
        $total = 0;
        if ($r_tot && ($row = $r_tot->fetch_assoc())) {
            $total = (int) $row['total'];
        }

        return array(
            'items' => $items,
            'total' => $total,
            'pagina' => $pagina,
            'por_pagina' => $por_pagina,
            'total_paginas' => $total > 0 ? (int) ceil($total / $por_pagina) : 1
        );
    }

    // ========== HABILITADORES ==========
    
    public function getHabilitadoresPaginados($pagina = 1, $por_pagina = 20, $busca = '') {
        $offset = ($pagina - 1) * $por_pagina;
        $q = $busca ? $this->con->real_escape_string("%$busca%") : '%%';
        
        $sql = "SELECT 
                    cod_entidad_crediticia,
                    nombre_entidad_crediticia,
                    identificacion_tercero AS nit,
                    telefono1_tercero,
                    correo_tercero,
                    interes_ptj,
                    comision_ptj,
                    cod_estado,
                    (SELECT COUNT(*) FROM tbl15_info_factura_venta WHERE cod_tercero = ec.cod_entidad_crediticia) AS total_creditos,
                    (SELECT COALESCE(SUM(total_precio_venta), 0) FROM tbl15_info_factura_venta WHERE cod_tercero = ec.cod_entidad_crediticia) AS valor_total
                FROM tbl15_entidad_crediticia ec
                WHERE nombre_entidad_crediticia LIKE '$q' OR identificacion_tercero LIKE '$q'
                LIMIT $offset, $por_pagina";
        
        $r = $this->con->query($sql);
        $out = [];
        if ($r) {
            while ($row = $r->fetch_assoc()) {
                $out[] = $row;
            }
        }
        return $out;
    }

    public function getHabilitadoresTotal($busca = '') {
        $q = $busca ? $this->con->real_escape_string("%$busca%") : '%%';
        $sql = "SELECT COUNT(*) AS total FROM tbl15_entidad_crediticia WHERE nombre_entidad_crediticia LIKE '$q' OR identificacion_tercero LIKE '$q'";
        $r = $this->con->query($sql);
        if (!$r) return 0;
        $_d = $r->fetch_assoc(); return (int)(isset($_d['total']) ? $_d['total'] : 0);
    }

    // ========== CHART DATA ==========

    /**
     * Ventas por línea de crédito (donut chart)
     */
    public function getVentasPorLinea($fecha_desde = null, $fecha_hasta = null) {
        if (!$fecha_desde) $fecha_desde = date('Y-m-d', strtotime('-6 months'));
        if (!$fecha_hasta) $fecha_hasta = date('Y-m-d');
        $desde = $this->con->real_escape_string($fecha_desde);
        $hasta = $this->con->real_escape_string($fecha_hasta);

        $sql = "SELECT 
                    ec.nombre_entidad_crediticia,
                    COALESCE(SUM(ifv.total_precio_venta), 0) AS total_ventas,
                    COUNT(ifv.cod_info_factura_venta) AS total_creditos
                FROM tbl15_entidad_crediticia ec
                LEFT JOIN tbl15_info_factura_venta ifv ON ifv.cod_tercero = ec.cod_entidad_crediticia
                    AND DATE(ifv.fecha_creacion) BETWEEN '$desde' AND '$hasta'
                GROUP BY ec.cod_entidad_crediticia
                HAVING total_ventas > 0
                ORDER BY total_ventas DESC";

        $r = $this->con->query($sql);
        $out = array();
        $total = 0;
        if ($r) {
            while ($row = $r->fetch_assoc()) {
                $out[] = $row;
                $total += (float) $row['total_ventas'];
            }
        }
        // Agrupar los pequeños como "Otros" si hay mas de 5
        if (count($out) > 5) {
            $top = array_slice($out, 0, 4);
            $otros_total = 0;
            $otros_creditos = 0;
            for ($i = 4; $i < count($out); $i++) {
                $otros_total += (float) $out[$i]['total_ventas'];
                $otros_creditos += (int) $out[$i]['total_creditos'];
            }
            $top[] = array(
                'nombre_entidad_crediticia' => 'Otros',
                'total_ventas' => $otros_total,
                'total_creditos' => $otros_creditos
            );
            $out = $top;
        }
        return array('items' => $out, 'total' => $total);
    }

    /**
     * Utilidad por habilitador (bar chart)
     * Utilidad ≈ total_ventas * 0.30 (70% habilitador, 0% comisión)
     */
    public function getUtilidadPorHabilitador($fecha_desde = null, $fecha_hasta = null) {
        if (!$fecha_desde) $fecha_desde = date('Y-m-d', strtotime('-6 months'));
        if (!$fecha_hasta) $fecha_hasta = date('Y-m-d');
        $desde = $this->con->real_escape_string($fecha_desde);
        $hasta = $this->con->real_escape_string($fecha_hasta);

        $sql = "SELECT 
                    ec.nombre_entidad_crediticia,
                    COALESCE(SUM(ifv.total_precio_venta), 0) AS total_ventas
                FROM tbl15_entidad_crediticia ec
                LEFT JOIN tbl15_info_factura_venta ifv ON ifv.cod_tercero = ec.cod_entidad_crediticia
                    AND DATE(ifv.fecha_creacion) BETWEEN '$desde' AND '$hasta'
                GROUP BY ec.cod_entidad_crediticia
                HAVING total_ventas > 0
                ORDER BY total_ventas DESC";

        $r = $this->con->query($sql);
        $out = array();
        $max_utilidad = 0;
        if ($r) {
            while ($row = $r->fetch_assoc()) {
                $ventas = (float) $row['total_ventas'];
                $utilidad = $ventas * 0.30; // 30% margen estimado
                $nombre_corto = $row['nombre_entidad_crediticia'];
                // Abreviar nombres largos
                if (strlen($nombre_corto) > 10) {
                    $palabras = explode(' ', $nombre_corto);
                    $nombre_corto = isset($palabras[0]) ? $palabras[0] : $nombre_corto;
                }
                $out[] = array(
                    'nombre' => $row['nombre_entidad_crediticia'],
                    'nombre_corto' => $nombre_corto,
                    'utilidad' => $utilidad
                );
                if ($utilidad > $max_utilidad) $max_utilidad = $utilidad;
            }
        }
        // Agrupar pequeños como "Otros"
        if (count($out) > 6) {
            $top = array_slice($out, 0, 5);
            $otros_util = 0;
            for ($i = 5; $i < count($out); $i++) {
                $otros_util += $out[$i]['utilidad'];
            }
            $top[] = array(
                'nombre' => 'Otros',
                'nombre_corto' => 'Otros',
                'utilidad' => $otros_util
            );
            $out = $top;
            if ($otros_util > $max_utilidad) $max_utilidad = $otros_util;
        }
        return array('items' => $out, 'max_utilidad' => $max_utilidad);
    }

    // ========== DETALLE COMERCIO ==========

    public function getComercioDetalle($cod_tienda) {
        $cod = (int)$cod_tienda;

        $sql = "SELECT 
                    cod_tienda,
                    nombre_tienda,
                    identificacion_tercero AS nit,
                    direccion_tercero AS direccion,
                    telefono1_tercero AS telefono,
                    correo_tercero AS email,
                    cod_estado,
                    (SELECT COUNT(*) FROM tbl15_info_factura_venta WHERE cod_tercero = ti.cod_tienda) AS total_creditos,
                    (SELECT COALESCE(SUM(total_precio_venta), 0) FROM tbl15_info_factura_venta WHERE cod_tercero = ti.cod_tienda) AS valor_total
                FROM tbl15_tienda ti
                WHERE ti.cod_tienda = $cod";

        $r = $this->con->query($sql);
        if (!$r) return null;
        return $r->fetch_assoc();
    }

    public function getCreditosPorComercio($cod_tienda, $pagina = 1, $por_pagina = 20) {
        $cod = (int)$cod_tienda;
        $offset = ($pagina - 1) * $por_pagina;

        $sql = "SELECT 
                    ifv.cod_info_factura_venta,
                    ifv.cod_factura,
                    ifv.nombre_estado_factura,
                    ifv.total_precio_venta AS valor,
                    ifv.fecha_creacion,
                    t.nombres_apellidos_tercero AS cliente,
                    ec.nombre_entidad_crediticia AS linea,
                    cc.monto_deuda,
                    cc.abonado,
                    (cc.monto_deuda - cc.abonado) AS saldo
                FROM tbl15_info_factura_venta ifv
                LEFT JOIN tbl15_tercero t ON t.cod_tercero = ifv.cod_tercero
                LEFT JOIN tbl15_cuentas_cobrar cc ON cc.cod_info_factura_venta = ifv.cod_info_factura_venta
                LEFT JOIN tbl15_entidad_crediticia ec ON ec.cod_entidad_crediticia = ifv.cod_tercero
                WHERE ifv.cod_tercero = $cod
                ORDER BY ifv.fecha_creacion DESC
                LIMIT $offset, $por_pagina";

        $r = $this->con->query($sql);
        $items = array();
        if ($r) {
            while ($row = $r->fetch_assoc()) {
                $items[] = $row;
            }
        }

        $r_tot = $this->con->query("SELECT COUNT(*) AS total FROM tbl15_info_factura_venta WHERE cod_tercero = $cod");
        $total = 0;
        if ($r_tot && ($row = $r_tot->fetch_assoc())) {
            $total = (int) $row['total'];
        }

        return array(
            'items' => $items,
            'total' => $total,
            'pagina' => $pagina,
            'por_pagina' => $por_pagina,
            'total_paginas' => $total > 0 ? (int) ceil($total / $por_pagina) : 1
        );
    }

    // ========== DETALLE CLIENTE ==========

    public function getClienteDetalle($cod_tercero) {
        $cod = (int)$cod_tercero;

        $sql = "SELECT 
                    cod_tercero,
                    identificacion_tercero AS identificacion,
                    nombres_apellidos_tercero AS nombre,
                    telefono1_tercero AS telefono,
                    correo_tercero AS email,
                    monto_deuda,
                    cod_estado,
                    (SELECT COUNT(*) FROM tbl15_info_factura_venta WHERE cod_tercero = t.cod_tercero) AS total_creditos,
                    (SELECT COALESCE(SUM(total_precio_venta), 0) FROM tbl15_info_factura_venta WHERE cod_tercero = t.cod_tercero) AS valor_total
                FROM tbl15_tercero t
                WHERE t.cod_tercero = $cod";

        $r = $this->con->query($sql);
        if (!$r) return null;
        return $r->fetch_assoc();
    }

    public function getCreditosPorCliente($cod_tercero, $pagina = 1, $por_pagina = 20) {
        $cod = (int)$cod_tercero;
        $offset = ($pagina - 1) * $por_pagina;

        $sql = "SELECT 
                    ifv.cod_info_factura_venta,
                    ifv.cod_factura,
                    ifv.nombre_estado_factura,
                    ifv.total_precio_venta AS valor,
                    ifv.fecha_creacion,
                    ti.nombre_tienda AS comercio,
                    ec.nombre_entidad_crediticia AS linea,
                    cc.monto_deuda,
                    cc.abonado,
                    (cc.monto_deuda - cc.abonado) AS saldo
                FROM tbl15_info_factura_venta ifv
                LEFT JOIN tbl15_tienda ti ON ti.cod_tienda = ifv.cod_tercero
                LEFT JOIN tbl15_cuentas_cobrar cc ON cc.cod_info_factura_venta = ifv.cod_info_factura_venta
                LEFT JOIN tbl15_entidad_crediticia ec ON ec.cod_entidad_crediticia = ifv.cod_tercero
                WHERE ifv.cod_tercero = $cod
                ORDER BY ifv.fecha_creacion DESC
                LIMIT $offset, $por_pagina";

        $r = $this->con->query($sql);
        $items = array();
        if ($r) {
            while ($row = $r->fetch_assoc()) {
                $items[] = $row;
            }
        }

        $r_tot = $this->con->query("SELECT COUNT(*) AS total FROM tbl15_info_factura_venta WHERE cod_tercero = $cod");
        $total = 0;
        if ($r_tot && ($row = $r_tot->fetch_assoc())) {
            $total = (int) $row['total'];
        }

        return array(
            'items' => $items,
            'total' => $total,
            'pagina' => $pagina,
            'por_pagina' => $por_pagina,
            'total_paginas' => $total > 0 ? (int) ceil($total / $por_pagina) : 1
        );
    }

    // ========== CUENTAS BANCARIAS (tbl15_banco_cuenta) ==========
    
    /**
     * Obtiene las cuentas bancarias activas desde tbl15_banco_cuenta.
     *
     * @return array Con items, total y tabla_existe
     */
    public function getCuentasBancarias() {
        $sql = "SELECT 
                    bc.cod_banco_cuenta,
                    bc.nombre_banco_cuenta,
                    bc.numero_banco_cuenta,
                    bc.nombre_titular_cuenta,
                    bc.nombre_tipo_cuenta_banco,
                    b.nombre_banco
                FROM tbl15_banco_cuenta bc
                LEFT JOIN tbl15_banco b ON b.cod_banco = bc.cod_banco
                WHERE bc.cod_estado = 1
                ORDER BY bc.nombre_banco_cuenta ASC";
        
        $r = $this->con->query($sql);
        if (!$r) {
            return ['success' => false, 'tabla_existe' => true, 'items' => []];
        }
        
        $items = [];
        while ($row = $r->fetch_assoc()) {
            $items[] = $row;
        }
        
        return [
            'success' => true,
            'tabla_existe' => true,
            'items' => $items,
            'total' => count($items)
        ];
    }

    // ========== UTILIDADES ==========
    
    public function escape($str) {
        return $this->con->real_escape_string($str);
    }

    public function query($sql) {
        return $this->con->query($sql);
    }
}
?>
