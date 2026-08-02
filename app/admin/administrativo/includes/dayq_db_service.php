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
                LEFT JOIN tbl15_operador_credito oc ON oc.cod_operador_credito = ifv.cod_operador_credito
                LEFT JOIN tbl15_entidad_crediticia ec ON ec.cod_entidad_crediticia = oc.cod_entidad_crediticia
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

    /**
     * buscarCreditosParaSelector — Búsqueda ligera de créditos para el buscador/selector
     * (typeahead) del gestor documental. Devuelve un subconjunto limitado de resultados.
     *
     * @param string $termino Término a buscar (ID, número de factura, cliente o comercio)
     * @param int $limite Máximo de resultados
     * @return array
     */
    public function buscarCreditosParaSelector($termino = '', $limite = 15) {
        $limite = max(1, (int)$limite);
        $where = 'WHERE 1=1';
        if (trim($termino) !== '') {
            $q = $this->con->real_escape_string('%' . trim($termino) . '%');
            $match_id = '';
            $id_num = (int) trim($termino);
            if ($id_num > 0) {
                $match_id = "ifv.cod_info_factura_venta = $id_num OR ";
            }
            $where .= " AND ($match_id ifv.cod_factura LIKE '$q'
                       OR t.nombres_apellidos_tercero LIKE '$q'
                       OR ti.nombre_tienda LIKE '$q')";
        }

        $sql = "SELECT
                    ifv.cod_info_factura_venta,
                    ifv.cod_factura,
                    ifv.nombre_estado_factura,
                    ifv.total_precio_venta AS valor,
                    ifv.fecha_creacion,
                    t.nombres_apellidos_tercero AS cliente,
                    ti.nombre_tienda AS comercio,
                    ec.nombre_entidad_crediticia AS linea
                FROM tbl15_info_factura_venta ifv
                LEFT JOIN tbl15_tercero t ON t.cod_tercero = ifv.cod_tercero
                LEFT JOIN tbl15_tienda ti ON ti.cod_tienda = ifv.cod_tercero
                LEFT JOIN tbl15_operador_credito oc ON oc.cod_operador_credito = ifv.cod_operador_credito
                LEFT JOIN tbl15_entidad_crediticia ec ON ec.cod_entidad_crediticia = oc.cod_entidad_crediticia
                $where
                ORDER BY ifv.fecha_creacion DESC
                LIMIT $limite";

        $r = $this->con->query($sql);
        $items = [];
        if ($r) {
            while ($row = $r->fetch_assoc()) {
                $items[] = $row;
            }
        }
        return $items;
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
                LEFT JOIN tbl15_operador_credito oc ON oc.cod_operador_credito = ifv.cod_operador_credito
                LEFT JOIN tbl15_entidad_crediticia ec ON ec.cod_entidad_crediticia = oc.cod_entidad_crediticia
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
                    nombre_archivo_adjunto,
                    nombre_tipo_extencion_archivo AS tipo_archivo,
                    url_img_orig_producto AS ruta_archivo,
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
     * Obtiene el detalle de una entidad crediticia (línea) por su ID.
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
                    (SELECT COUNT(*) FROM tbl15_info_factura_venta ifv2
                     JOIN tbl15_operador_credito oc2 ON oc2.cod_operador_credito = ifv2.cod_operador_credito
                     WHERE oc2.cod_entidad_crediticia = ec.cod_entidad_crediticia) AS total_creditos,
                    (SELECT COALESCE(SUM(ifv2.total_precio_venta), 0) FROM tbl15_info_factura_venta ifv2
                     JOIN tbl15_operador_credito oc2 ON oc2.cod_operador_credito = ifv2.cod_operador_credito
                     WHERE oc2.cod_entidad_crediticia = ec.cod_entidad_crediticia) AS valor_total,
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
                LEFT JOIN tbl15_operador_credito oc ON oc.cod_operador_credito = ifv.cod_operador_credito
                WHERE oc.cod_entidad_crediticia = $cod
                ORDER BY ifv.fecha_creacion DESC
                LIMIT $offset, $por_pagina";

        $r = $this->con->query($sql);
        $items = array();
        if ($r) {
            while ($row = $r->fetch_assoc()) {
                $items[] = $row;
            }
        }

        $r_tot = $this->con->query("SELECT COUNT(*) AS total FROM tbl15_info_factura_venta ifv
            JOIN tbl15_operador_credito oc ON oc.cod_operador_credito = ifv.cod_operador_credito
            WHERE oc.cod_entidad_crediticia = $cod");
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
    
    public function getHabilitadoresPaginados($pagina = 1, $por_pagina = 20, $busca = '', $estado = null) {
        $offset = ($pagina - 1) * $por_pagina;
        $q = $busca ? $this->con->real_escape_string("%$busca%") : '%%';
        
        $where_estado = '';
        if ($estado !== null && $estado !== '') {
            $est = (int)$estado;
            $where_estado = " AND ec.cod_estado = $est";
        }
        
        $sql = "SELECT 
                    ec.cod_entidad_crediticia,
                    ec.nombre_entidad_crediticia,
                    ec.identificacion_tercero AS nit,
                    ec.telefono1_tercero,
                    ec.correo_tercero,
                    ec.interes_ptj,
                    ec.comision_ptj,
                    ec.cod_estado,
                    ec.nombre_contacto,
                    (SELECT COUNT(*) FROM tbl15_info_factura_venta ifv2
                 JOIN tbl15_operador_credito oc2 ON oc2.cod_operador_credito = ifv2.cod_operador_credito
                 WHERE oc2.cod_entidad_crediticia = ec.cod_entidad_crediticia) AS total_creditos,
                    (SELECT COALESCE(SUM(ifv2.total_precio_venta), 0) FROM tbl15_info_factura_venta ifv2
                     JOIN tbl15_operador_credito oc2 ON oc2.cod_operador_credito = ifv2.cod_operador_credito
                     WHERE oc2.cod_entidad_crediticia = ec.cod_entidad_crediticia) AS valor_total
                FROM tbl15_entidad_crediticia ec
                WHERE (nombre_entidad_crediticia LIKE '$q' OR identificacion_tercero LIKE '$q')
                $where_estado
                ORDER BY ec.cod_estado DESC, ec.nombre_entidad_crediticia ASC
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

    public function getHabilitadoresTotal($busca = '', $estado = null) {
        $q = $busca ? $this->con->real_escape_string("%$busca%") : '%%';
        $where_estado = '';
        if ($estado !== null && $estado !== '') {
            $est = (int)$estado;
            $where_estado = " AND cod_estado = $est";
        }
        $sql = "SELECT COUNT(*) AS total FROM tbl15_entidad_crediticia WHERE (nombre_entidad_crediticia LIKE '$q' OR identificacion_tercero LIKE '$q') $where_estado";
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
                LEFT JOIN tbl15_operador_credito oc ON oc.cod_entidad_crediticia = ec.cod_entidad_crediticia
                LEFT JOIN tbl15_info_factura_venta ifv ON ifv.cod_operador_credito = oc.cod_operador_credito
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
     * Utilidad por Línea (bar chart)
     * Utilidad ≈ total_ventas * 0.30 (70% habilitador, 0% comisión)
     * 
     * @deprecated Usar getUtilidadPorLinea() en su lugar
     */
    public function getUtilidadPorLinea($fecha_desde = null, $fecha_hasta = null) {
        if (!$fecha_desde) $fecha_desde = date('Y-m-d', strtotime('-6 months'));
        if (!$fecha_hasta) $fecha_hasta = date('Y-m-d');
        $desde = $this->con->real_escape_string($fecha_desde);
        $hasta = $this->con->real_escape_string($fecha_hasta);

        $sql = "SELECT 
                    ec.nombre_entidad_crediticia,
                    COALESCE(SUM(ifv.total_precio_venta), 0) AS total_ventas
                FROM tbl15_entidad_crediticia ec
                LEFT JOIN tbl15_operador_credito oc ON oc.cod_entidad_crediticia = ec.cod_entidad_crediticia
                LEFT JOIN tbl15_info_factura_venta ifv ON ifv.cod_operador_credito = oc.cod_operador_credito
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
                LEFT JOIN tbl15_operador_credito oc ON oc.cod_operador_credito = ifv.cod_operador_credito
                LEFT JOIN tbl15_entidad_crediticia ec ON ec.cod_entidad_crediticia = oc.cod_entidad_crediticia
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
                    direccion_tercero,
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
                LEFT JOIN tbl15_operador_credito oc ON oc.cod_operador_credito = ifv.cod_operador_credito
                LEFT JOIN tbl15_entidad_crediticia ec ON ec.cod_entidad_crediticia = oc.cod_entidad_crediticia
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
    // ========== CRUD HABILITADORES (LÍNEAS DE CRÉDITO) ==========

    /**
     * Crea un nuevo habilitador (entidad crediticia)
     */
    public function crearHabilitador($datos) {
        $nombre = $this->escape(isset($datos['nombre']) ? $datos['nombre'] : '');
        $nit = $this->escape(isset($datos['nit']) ? $datos['nit'] : '');
        $telefono = $this->escape(isset($datos['telefono']) ? $datos['telefono'] : '');
        $correo = $this->escape(isset($datos['correo']) ? $datos['correo'] : '');
        $interes = (float)(isset($datos['interes_ptj']) ? $datos['interes_ptj'] : 0);
        $comision = (float)(isset($datos['comision_ptj']) ? $datos['comision_ptj'] : 0);
        $contacto = $this->escape(isset($datos['nombre_contacto']) ? $datos['nombre_contacto'] : '');

        if ($nombre === '') return 0;

        $sql = "INSERT INTO tbl15_entidad_crediticia 
                (nombre_entidad_crediticia, identificacion_tercero, telefono1_tercero, correo_tercero, 
                 interes_ptj, comision_ptj, nombre_contacto, cod_estado)
                VALUES ('$nombre', '$nit', '$telefono', '$correo', 
                        $interes, $comision, '$contacto', 1)";

        $r = $this->con->query($sql);
        if (!$r) return 0;
        return (int)$this->con->insert_id;
    }

    /**
     * Actualiza un habilitador existente
     */
    public function actualizarHabilitador($cod_entidad, $datos) {
        $cod = (int)$cod_entidad;
        $nombre = $this->escape(isset($datos['nombre']) ? $datos['nombre'] : '');
        $nit = $this->escape(isset($datos['nit']) ? $datos['nit'] : '');
        $telefono = $this->escape(isset($datos['telefono']) ? $datos['telefono'] : '');
        $correo = $this->escape(isset($datos['correo']) ? $datos['correo'] : '');
        $interes = (float)(isset($datos['interes_ptj']) ? $datos['interes_ptj'] : 0);
        $comision = (float)(isset($datos['comision_ptj']) ? $datos['comision_ptj'] : 0);
        $contacto = $this->escape(isset($datos['nombre_contacto']) ? $datos['nombre_contacto'] : '');
        $estado = isset($datos['cod_estado']) ? (int)$datos['cod_estado'] : 1;

        if ($nombre === '' || $cod <= 0) return false;

        $sql = "UPDATE tbl15_entidad_crediticia SET 
                    nombre_entidad_crediticia = '$nombre',
                    identificacion_tercero = '$nit',
                    telefono1_tercero = '$telefono',
                    correo_tercero = '$correo',
                    interes_ptj = $interes,
                    comision_ptj = $comision,
                    nombre_contacto = '$contacto',
                    cod_estado = $estado
                WHERE cod_entidad_crediticia = $cod";

        return $this->con->query($sql);
    }

    /**
     * Desactivar (eliminación lógica) un habilitador
     */
    public function desactivarHabilitador($cod_entidad) {
        $cod = (int)$cod_entidad;
        if ($cod <= 0) return false;
        return $this->con->query("UPDATE tbl15_entidad_crediticia SET cod_estado = 0 WHERE cod_entidad_crediticia = $cod");
    }

    /**
     * Reactivar un habilitador
     */
    public function activarHabilitador($cod_entidad) {
        $cod = (int)$cod_entidad;
        if ($cod <= 0) return false;
        return $this->con->query("UPDATE tbl15_entidad_crediticia SET cod_estado = 1 WHERE cod_entidad_crediticia = $cod");
    }

    /**
     * Obtiene datos completos de un habilitador para editar
     */
    public function getHabilitadorParaEditar($cod_entidad) {
        $cod = (int)$cod_entidad;
        $sql = "SELECT * FROM tbl15_entidad_crediticia WHERE cod_entidad_crediticia = $cod";
        $r = $this->con->query($sql);
        if (!$r) return null;
        return $r->fetch_assoc();
    }

    /**
     * Obtiene los estados disponibles para el filtro
     */
    public function getEstadosHabilitador() {
        return [
            ['cod_estado' => 1, 'nombre_estado' => 'Activo'],
            ['cod_estado' => 0, 'nombre_estado' => 'Inactivo']
        ];
    }

    // ========== CRUD CLIENTES ==========

    /**
     * Actualiza datos básicos de un cliente (tercero)
     * Solo actualiza campos permitidos: nombres, teléfono, correo, dirección
     */
    public function actualizarCliente($cod_tercero, $datos) {
        $cod = (int)$cod_tercero;
        if ($cod <= 0) return false;

        $nombre = $this->escape(isset($datos['nombre']) ? $datos['nombre'] : '');
        $telefono = $this->escape(isset($datos['telefono']) ? $datos['telefono'] : '');
        $correo = $this->escape(isset($datos['correo']) ? $datos['correo'] : '');
        $direccion = $this->escape(isset($datos['direccion']) ? $datos['direccion'] : '');
        $cod_estado = isset($datos['cod_estado']) ? (int)$datos['cod_estado'] : 0;

        if ($nombre === '') return false;

        $sql = "UPDATE tbl15_tercero SET 
                    nombres_apellidos_tercero = '$nombre',
                    telefono1_tercero = '$telefono',
                    correo_tercero = '$correo',
                    direccion_tercero = '$direccion'" .
                ($cod_estado > 0 ? ", cod_estado = $cod_estado" : '') .
                " WHERE cod_tercero = $cod";

        return $this->con->query($sql);
    }

    // ========== CREDITOS - CAMBIO DE ESTADO ==========

    /**
     * Cambia el estado de un crédito
     * Validación completa: no permitir cambiar desde ANULADA y validar transiciones
     * Estados del sistema: ABIERTA, PENDIENTE, APROBADA, CERRADA, ANULADA
     * Transiciones válidas:
     *   ABIERTA   → PENDIENTE, APROBADA, CERRADA
     *   PENDIENTE → ABIERTA, APROBADA, CERRADA
     *   APROBADA  → ABIERTA, CERRADA
     *   CERRADA   → ABIERTA
     *   ANULADA   → (ninguna - no se puede cambiar)
     */
    public function cambiarEstadoCredito($cod_credito, $nuevo_estado) {
        $cod = (int)$cod_credito;
        if ($cod <= 0) return false;
        
        $nuevo_estado = $this->escape(strtoupper($nuevo_estado));
        $estados_permitidos = ['ABIERTA', 'PENDIENTE', 'APROBADA', 'CERRADA'];
        if (!in_array($nuevo_estado, $estados_permitidos)) return false;
        
        // Validar crédito existe y no está ANULADO
        $r = $this->con->query("SELECT nombre_estado_factura FROM tbl15_info_factura_venta WHERE cod_info_factura_venta = $cod");
        if (!$r || !($row = $r->fetch_assoc())) return false;
        
        $estado_actual = $row['nombre_estado_factura'];
        if ($estado_actual === 'ANULADA') return false;
        
        // Validar transiciones permitidas
        $transiciones = [
            'ABIERTA'   => ['PENDIENTE', 'APROBADA', 'CERRADA'],
            'PENDIENTE' => ['ABIERTA', 'APROBADA', 'CERRADA'],
            'APROBADA'  => ['ABIERTA', 'CERRADA'],
            'CERRADA'   => ['ABIERTA']
        ];
        
        if (isset($transiciones[$estado_actual]) && !in_array($nuevo_estado, $transiciones[$estado_actual])) {
            return false;
        }
        
        return $this->con->query("UPDATE tbl15_info_factura_venta SET nombre_estado_factura = '$nuevo_estado' WHERE cod_info_factura_venta = $cod");
    }

    // ========== CREDITOS - ANULACIÓN ==========

    /**
     * Registra una anulación en la tabla de anulaciones
     */
    public function registrarAnulacion($cod_credito, $datos) {
        $cod = (int)$cod_credito;
        if ($cod <= 0) return 0;
        
        $motivo = $this->escape(isset($datos['motivo']) ? $datos['motivo'] : '');
        $tipo = $this->escape(isset($datos['tipo_anulacion']) ? $datos['tipo_anulacion'] : 'ANTES_APROBACION');
        $penalidad = (float)(isset($datos['penalidad']) ? $datos['penalidad'] : 0);
        $perdida = (float)(isset($datos['perdida_total']) ? $datos['perdida_total'] : 0);
        $cod_admin = (int)(isset($datos['cod_admin']) ? $datos['cod_admin'] : 0);
        
        if ($motivo === '') return 0;
        
        $sql = "INSERT INTO tbl15_anulacion 
                (cod_info_factura_venta, motivo, tipo_anulacion, penalidad, perdida_total, cod_admin, fecha_creacion)
                VALUES ($cod, '$motivo', '$tipo', $penalidad, $perdida, $cod_admin, NOW())";
        
        $r = $this->con->query($sql);
        if (!$r) return 0;
        
        $anulacion_id = (int)$this->con->insert_id;
        
        // Actualizar estado del crédito
        $this->con->query("UPDATE tbl15_info_factura_venta SET nombre_estado_factura = 'ANULADA' WHERE cod_info_factura_venta = $cod");
        
        return $anulacion_id;
    }

    // ========== KPI METHODS (REQ 18) ==========

    /**
     * Obtiene cartera por cobrar (créditos activos pendientes)
     */
    public function getCarteraPorCobrar($fecha = null) {
        if (!$fecha) $fecha = date('Y-m-d');
        $f = $this->escape($fecha);
        $sql = "SELECT 
                    COUNT(DISTINCT cc.cod_info_factura_venta) AS creditos_pendientes,
                    COALESCE(SUM(cc.monto_deuda - cc.abonado), 0) AS saldo_pendiente
                FROM tbl15_cuentas_cobrar cc
                JOIN tbl15_info_factura_venta ifv ON ifv.cod_info_factura_venta = cc.cod_info_factura_venta
                WHERE ifv.nombre_estado_factura NOT IN ('ANULADA', 'CERRADA')
                AND (cc.monto_deuda - cc.abonado) > 0";
        $r = $this->con->query($sql);
        if (!$r) return ['creditos_pendientes' => 0, 'saldo_pendiente' => 0];
        return $r->fetch_assoc();
    }

    /**
     * Obtiene cartera por pagar a entidades
     */
    public function getCarteraPorPagar($fecha = null) {
        if (!$fecha) $fecha = date('Y-m-d');
        $f = $this->escape($fecha);
        $sql = "SELECT 
                    COUNT(*) AS total_movimientos,
                    COALESCE(SUM(total_creditos), 0) AS saldo_por_pagar
                FROM tbl15_movimiento_caja
                WHERE total_creditos > 0";
        $r = $this->con->query($sql);
        if (!$r) return ['total_movimientos' => 0, 'saldo_por_pagar' => 0];
        return $r->fetch_assoc();
    }

    /**
     * Obtiene saldo total de cuentas bancarias
     */
    public function getSaldoBancarioTotal() {
        $sql = "SELECT COALESCE(SUM(total_debitos - total_creditos), 0) AS saldo_bancario
                FROM tbl15_movimiento_caja
                WHERE cod_banco_cuenta IS NOT NULL";
        $r = $this->con->query($sql);
        if (!$r) return 0;
        $row = $r->fetch_assoc();
        return (float)(isset($row['saldo_bancario']) ? $row['saldo_bancario'] : 0);
    }

    /**
     * Obtiene pagos pendientes de habilitadores
     */
    public function getPagosPendientesHabilitadores() {
        $sql = "SELECT 
                    COUNT(*) AS total_pendientes,
                    COALESCE(SUM(cc.monto_deuda - cc.abonado), 0) AS monto_pendiente
                FROM tbl15_cuentas_cobrar cc
                JOIN tbl15_info_factura_venta ifv ON ifv.cod_info_factura_venta = cc.cod_info_factura_venta
                WHERE ifv.nombre_estado_factura NOT IN ('ANULADA', 'CERRADA')
                AND (cc.monto_deuda - cc.abonado) > 0";
        $r = $this->con->query($sql);
        if (!$r) return ['total_pendientes' => 0, 'monto_pendiente' => 0];
        return $r->fetch_assoc();
    }

    /**
     * Obtiene utilidad acumulada del mes
     */
    public function getUtilidadAcumuladaMes($fecha = null) {
        if (!$fecha) $fecha = date('Y-m-d');
        $desde = date('Y-m-01', strtotime($fecha));
        $hasta = $this->escape($fecha);
        $d = $this->escape($desde);
        
        $sql = "SELECT COALESCE(SUM(ifv.total_precio_venta * 0.30), 0) AS utilidad_estimada
                FROM tbl15_info_factura_venta ifv
                WHERE DATE(ifv.fecha_creacion) BETWEEN '$d' AND '$hasta'";
        $r = $this->con->query($sql);
        if (!$r) return 0;
        $row = $r->fetch_assoc();
        return (float)(isset($row['utilidad_estimada']) ? $row['utilidad_estimada'] : 0);
    }

    /**
     * Obtiene relación ingresos vs gastos del mes
     */
    public function getRelacionIngresosGastos($fecha = null) {
        if (!$fecha) $fecha = date('Y-m-d');
        $desde = date('Y-m-01', strtotime($fecha));
        $hasta = $this->escape($fecha);
        $d = $this->escape($desde);
        
        $r_ing = $this->con->query("SELECT COALESCE(SUM(total_debitos), 0) AS ingresos FROM tbl15_movimiento_caja WHERE DATE(fecha_ymd_movimiento_caja) BETWEEN '$d' AND '$hasta'");
        $ingresos = $r_ing ? (float)$r_ing->fetch_assoc()['ingresos'] : 0;
        
        $r_gas = $this->con->query("SELECT COALESCE(SUM(monto), 0) AS gastos FROM gasto WHERE anulado = 0 AND DATE(fecha) BETWEEN '$d' AND '$hasta 23:59:59'");
        $gastos = $r_gas ? (float)$r_gas->fetch_assoc()['gastos'] : 0;
        
        $relacion = $ingresos > 0 ? round(($gastos / $ingresos) * 100, 2) : 0;
        
        return ['ingresos' => $ingresos, 'gastos' => $gastos, 'relacion' => $relacion];
    }

    /**
     * Obtiene pagos recibidos hoy de habilitadores
     */
    public function getPagosRecibidosHoy($fecha = null) {
        if (!$fecha) $fecha = date('Y-m-d');
        $f = $this->escape($fecha);
        $sql = "SELECT COALESCE(SUM(total_debitos), 0) AS cobrado_hoy
                FROM tbl15_movimiento_caja
                WHERE total_debitos > 0 AND DATE(fecha_ymd_movimiento_caja) = '$f'";
        $r = $this->con->query($sql);
        if (!$r) return 0;
        $row = $r->fetch_assoc();
        return (float)(isset($row['cobrado_hoy']) ? $row['cobrado_hoy'] : 0);
    }

    /**
     * Obtiene promedio de días de pago
     */
    public function getPromedioDiasPago() {
        $sql = "SELECT ROUND(AVG(DATEDIFF(COALESCE(cca.fecha_pago, CURDATE()), ifv.fecha_creacion))) AS promedio_dias
                FROM tbl15_cuentas_cobrar_abonos cca
                JOIN tbl15_cuentas_cobrar cc ON cc.cod_cuentas_cobrar = cca.cod_cuentas_cobrar
                JOIN tbl15_info_factura_venta ifv ON ifv.cod_info_factura_venta = cc.cod_info_factura_venta
                WHERE cca.fecha_pago IS NOT NULL";
        $r = $this->con->query($sql);
        if (!$r) return 0;
        $row = $r->fetch_assoc();
        return (int)(isset($row['promedio_dias']) ? $row['promedio_dias'] : 0);
    }

    /**
     * Obtiene habilitadores con atraso en pagos
     */
    public function getHabilitadoresConAtraso() {
        $sql = "SELECT 
                    ec.nombre_entidad_crediticia,
                    COUNT(DISTINCT ifv.cod_info_factura_venta) AS creditos_atrasados,
                    COALESCE(SUM(cc.monto_deuda - cc.abonado), 0) AS monto_atrasado
                FROM tbl15_entidad_crediticia ec
                JOIN tbl15_operador_credito oc ON oc.cod_entidad_crediticia = ec.cod_entidad_crediticia
                JOIN tbl15_info_factura_venta ifv ON ifv.cod_operador_credito = oc.cod_operador_credito
                JOIN tbl15_cuentas_cobrar cc ON cc.cod_info_factura_venta = ifv.cod_info_factura_venta
                WHERE ifv.nombre_estado_factura NOT IN ('ANULADA', 'CERRADA')
                AND (cc.monto_deuda - cc.abonado) > 0
                AND DATEDIFF(CURDATE(), ifv.fecha_creacion) > 60
                GROUP BY ec.cod_entidad_crediticia
                ORDER BY monto_atrasado DESC";
        $r = $this->con->query($sql);
        $items = [];
        if ($r) {
            while ($row = $r->fetch_assoc()) {
                $items[] = $row;
            }
        }
        return $items;
    }

    // ========== GASTOS AGRUPADOS (REQ 20) ==========

    /**
     * Obtiene gastos agrupados por categoría (subcategoría)
     */
    public function getGastosAgrupadosPorCategoria($desde, $hasta) {
        $d = $this->escape($desde);
        $h = $this->escape($hasta);
        
        $sql = "SELECT 
                    CASE 
                        WHEN c.codigo LIKE '5%' THEN 'Operativos'
                        WHEN c.codigo LIKE '4%' THEN 'Ingresos'
                        WHEN c.codigo LIKE '2%' THEN 'Financieros'
                        ELSE 'Otros'
                    END AS categoria,
                    c.nombre AS subcategoria,
                    COUNT(*) AS cantidad,
                    COALESCE(SUM(g.monto), 0) AS total_monto
                FROM gasto g
                LEFT JOIN cuenta c ON c.id = g.cuenta_id
                WHERE g.anulado = 0
                AND DATE(g.fecha) BETWEEN '$d' AND '$h 23:59:59'
                GROUP BY categoria, c.id
                ORDER BY categoria, total_monto DESC";
        
        $r = $this->con->query($sql);
        $items = [];
        if ($r) {
            while ($row = $r->fetch_assoc()) {
                $items[] = $row;
            }
        }
        return $items;
    }

    /**
     * Obtiene variación mensual de gastos
     */
    public function getGastosVariacionMensual($meses = 6) {
        $sql = "SELECT 
                    DATE_FORMAT(g.fecha, '%Y-%m') AS mes,
                    COALESCE(SUM(g.monto), 0) AS total_monto,
                    COUNT(*) AS total_gastos
                FROM gasto g
                WHERE g.anulado = 0
                AND g.fecha >= DATE_SUB(CURDATE(), INTERVAL $meses MONTH)
                GROUP BY DATE_FORMAT(g.fecha, '%Y-%m')
                ORDER BY mes ASC";
        
        $r = $this->con->query($sql);
        $items = [];
        if ($r) {
            while ($row = $r->fetch_assoc()) {
                $items[] = $row;
            }
        }
        return $items;
    }

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

    /**
     * Asigna una cuenta bancaria a un movimiento existente en tbl15_movimiento_caja
     *
     * @param int $cod_movimiento ID del movimiento
     * @param int $cod_banco_cuenta ID de la cuenta bancaria
     * @return bool True si se asigno correctamente
     */
    public function asignarBancoMovimiento($cod_movimiento, $cod_banco_cuenta) {
        $cod = (int)$cod_movimiento;
        $banco = (int)$cod_banco_cuenta;
        if ($cod <= 0) return false;
        
        $banco_sql = $banco > 0 ? $banco : 'NULL';
        return $this->con->query("UPDATE tbl15_movimiento_caja SET cod_banco_cuenta = $banco_sql WHERE cod_movimiento_caja = $cod");
    }

    // ========== UTILIDADES ==========
    
    // ========== PRÉSTAMOS EMPLEADOS ==========

    /**
     * Obtiene lista paginada de préstamos de empleados
     */
    public function getPrestamosLista($pagina = 1, $por_pagina = 20, $busca = '', $estado = null) {
        $offset = ($pagina - 1) * $por_pagina;
        $where = '';
        if ($busca) {
            $q = $this->escape("%$busca%");
            $where .= " AND (t.nombres_apellidos_tercero LIKE '$q' OR pe.cod_prestamo_empleado LIKE '$q')";
        }
        if ($estado !== null && $estado !== '') {
            $where .= ' AND pe.cod_estado_prestamo = ' . (int)$estado;
        }
        
        $sql = "SELECT 
                    pe.*,
                    t.nombres_apellidos_tercero AS empleado_nombre,
                    t.identificacion_tercero AS empleado_documento
                FROM tbl15_prestamo_empleado pe
                LEFT JOIN tbl15_tercero t ON t.cod_tercero = pe.cod_empleado
                WHERE pe.active = 1 $where
                ORDER BY pe.fecha_creacion DESC
                LIMIT $offset, $por_pagina";
        
        $r = $this->con->query($sql);
        $items = [];
        if ($r) {
            while ($row = $r->fetch_assoc()) {
                $items[] = $row;
            }
        }
        
        $r_tot = $this->con->query("SELECT COUNT(*) AS total FROM tbl15_prestamo_empleado pe WHERE pe.active = 1 $where");
        $total = 0;
        if ($r_tot && ($row = $r_tot->fetch_assoc())) {
            $total = (int) $row['total'];
        }
        
        return ['items' => $items, 'total' => $total, 'pagina' => $pagina, 'total_paginas' => max(1, (int)ceil($total / $por_pagina))];
    }

    /**
     * Obtiene detalle completo de un préstamo
     */
    public function getPrestamoDetalle($cod_prestamo) {
        $cod = (int)$cod_prestamo;
        $sql = "SELECT 
                    pe.*,
                    t.nombres_apellidos_tercero AS empleado_nombre,
                    t.identificacion_tercero AS empleado_documento,
                    t.telefono1_tercero AS empleado_telefono
                FROM tbl15_prestamo_empleado pe
                LEFT JOIN tbl15_tercero t ON t.cod_tercero = pe.cod_empleado
                WHERE pe.cod_prestamo_empleado = $cod";
        $r = $this->con->query($sql);
        if (!$r) return null;
        return $r->fetch_assoc();
    }

    /**
     * Crea un nuevo préstamo y genera las cuotas
     */
    public function crearPrestamo($datos) {
        $cod_empleado = (int)(isset($datos['cod_empleado']) ? $datos['cod_empleado'] : 0);
        $monto = (float)(isset($datos['monto_prestamo']) ? $datos['monto_prestamo'] : 0);
        $num_cuotas = (int)(isset($datos['numero_cuotas']) ? $datos['numero_cuotas'] : 1);
        $interes = (float)(isset($datos['interes_ptj']) ? $datos['interes_ptj'] : 0);
        $metodo_pago = (int)(isset($datos['cod_metodo_pago']) ? $datos['cod_metodo_pago'] : 1);
        $notas = $this->escape(isset($datos['notas']) ? $datos['notas'] : '');
        $cod_admin = (int)(isset($datos['cod_admin_crea']) ? $datos['cod_admin_crea'] : 0);
        
        if ($cod_empleado <= 0 || $monto <= 0 || $num_cuotas <= 0) return 0;
        
        // Calcular total a pagar y valor cuota
        $total_pagar = $monto + ($monto * $interes / 100);
        $valor_cuota = $num_cuotas > 0 ? round($total_pagar / $num_cuotas, 2) : $total_pagar;
        $total_pagar = round($valor_cuota * $num_cuotas, 2);
        
        $fecha = date('Y-m-d H:i:s');
        
        $this->con->begin_transaction();
        try {
            $sql = "INSERT INTO tbl15_prestamo_empleado 
                    (cod_empleado, monto_prestamo, numero_cuotas, valor_cuota, interes_ptj, total_pagar, 
                     fecha_prestamo, cod_estado_prestamo, cod_metodo_pago, cod_admin_crea, notas, fecha_creacion)
                    VALUES ($cod_empleado, $monto, $num_cuotas, $valor_cuota, $interes, $total_pagar,
                            '$fecha', 1, $metodo_pago, $cod_admin, '$notas', '$fecha')";
            
            $r = $this->con->query($sql);
            if (!$r) throw new RuntimeException('Error al crear préstamo');
            
            $prestamo_id = (int)$this->con->insert_id;
            
            // Generar cuotas
            for ($i = 1; $i <= $num_cuotas; $i++) {
                $fecha_venc = date('Y-m-d', strtotime("+$i months"));
                $sql_cuota = "INSERT INTO tbl15_prestamo_empleado_cuota 
                             (cod_prestamo_empleado, numero_cuota, valor_cuota, fecha_vencimiento, cod_estado_cuota)
                             VALUES ($prestamo_id, $i, $valor_cuota, '$fecha_venc', 1)";
                if (!$this->con->query($sql_cuota)) throw new RuntimeException('Error al generar cuota');
            }
            
            $this->con->commit();
            return $prestamo_id;
        } catch (Exception $e) {
            $this->con->rollback();
            return 0;
        }
    }

    /**
     * Obtiene las cuotas de un préstamo
     */
    public function getCuotasPrestamo($cod_prestamo) {
        $cod = (int)$cod_prestamo;
        $sql = "SELECT * FROM tbl15_prestamo_empleado_cuota 
                WHERE cod_prestamo_empleado = $cod AND active = 1
                ORDER BY numero_cuota ASC";
        $r = $this->con->query($sql);
        $items = [];
        if ($r) {
            while ($row = $r->fetch_assoc()) {
                $items[] = $row;
            }
        }
        return $items;
    }

    /**
     * Obtiene KPIs de préstamos
     */
    public function getPrestamosKPIs() {
        $r1 = $this->con->query("SELECT COUNT(*) AS total FROM tbl15_prestamo_empleado WHERE cod_estado_prestamo = 1 AND active = 1");
        $activos = $r1 ? (int)$r1->fetch_assoc()['total'] : 0;
        
        $r2 = $this->con->query("SELECT COALESCE(SUM(total_pagar - (SELECT COALESCE(SUM(valor_cuota), 0) FROM tbl15_prestamo_empleado_cuota WHERE cod_prestamo_empleado = pe.cod_prestamo_empleado AND cod_estado_cuota = 2 AND active = 1)), 0) AS saldo FROM tbl15_prestamo_empleado pe WHERE cod_estado_prestamo = 1 AND active = 1");
        $saldo = $r2 ? (float)$r2->fetch_assoc()['saldo'] : 0;
        
        $r3 = $this->con->query("SELECT COALESCE(SUM(valor_cuota), 0) AS cuotas_mes FROM tbl15_prestamo_empleado_cuota WHERE cod_estado_cuota = 1 AND active = 1 AND MONTH(fecha_vencimiento) = MONTH(CURDATE()) AND YEAR(fecha_vencimiento) = YEAR(CURDATE())");
        $cuotas_mes = $r3 ? (float)$r3->fetch_assoc()['cuotas_mes'] : 0;
        
        $r4 = $this->con->query("SELECT COUNT(*) AS vencidos FROM tbl15_prestamo_empleado_cuota WHERE cod_estado_cuota = 1 AND active = 1 AND fecha_vencimiento < CURDATE()");
        $vencidos = $r4 ? (int)$r4->fetch_assoc()['vencidos'] : 0;
        
        return [
            'prestamos_activos' => $activos,
            'saldo_total' => $saldo,
            'cuotas_mes' => $cuotas_mes,
            'cuotas_vencidas' => $vencidos
        ];
    }

    /**
     * Obtiene empleados activos (terceros con role empleado)
     */
    public function getEmpleadosActivos($buscar = '') {
        $q = $buscar ? $this->escape("%$buscar%") : '%%';
        $sql = "SELECT cod_tercero, nombres_apellidos_tercero AS nombre, identificacion_tercero AS documento
                FROM tbl15_tercero
                WHERE (nombres_apellidos_tercero LIKE '$q' OR identificacion_tercero LIKE '$q')
                AND cod_estado = 1
                ORDER BY nombres_apellidos_tercero ASC
                LIMIT 50";
        $r = $this->con->query($sql);
        $items = [];
        if ($r) {
            while ($row = $r->fetch_assoc()) {
                $items[] = $row;
            }
        }
        return $items;
    }

    /**
     * Registra un empleado nuevo (tercero) en tbl15_tercero.
     * Si ya existe un tercero activo con el mismo documento, lo reutiliza.
     * Retorna array ['id' => int, 'reutilizado' => bool].
     */
    public function crearEmpleado($datos) {
        $resultado = ['id' => 0, 'reutilizado' => false];

        $nombres = trim(isset($datos['nombres']) ? $datos['nombres'] : '');
        $apellidos = trim(isset($datos['apellidos']) ? $datos['apellidos'] : '');
        $documento = trim(isset($datos['documento']) ? $datos['documento'] : '');
        $telefono = trim(isset($datos['telefono']) ? $datos['telefono'] : '');
        $correo = trim(isset($datos['correo']) ? $datos['correo'] : '');
        $direccion = trim(isset($datos['direccion']) ? $datos['direccion'] : '');
        $cod_admin = isset($datos['cod_admin']) ? (int)$datos['cod_admin'] : 0;

        // identificacion_tercero es varchar(14)
        $documento = substr($documento, 0, 14);
        $nombre_completo = trim($nombres . ' ' . $apellidos);
        if ($nombre_completo === '' || $documento === '') return $resultado;

        // Escape para MySQL
        $nombres_e = $this->escape($nombres);
        $apellidos_e = $this->escape($apellidos);
        $documento_e = $this->escape($documento);
        $telefono_e = $this->escape($telefono);
        $correo_e = $this->escape($correo);
        $direccion_e = $this->escape($direccion);
        $nombre_completo_e = $this->escape($nombre_completo);

        // Evitar duplicados: si el documento ya existe activo, reutilizarlo
        $r_dup = $this->con->query("SELECT cod_tercero FROM tbl15_tercero WHERE identificacion_tercero = '$documento_e' AND cod_estado = 1 LIMIT 1");
        if ($r_dup && $row_dup = $r_dup->fetch_assoc()) {
            $resultado['id'] = (int)$row_dup['cod_tercero'];
            $resultado['reutilizado'] = true;
            return $resultado;
        }

        $fecha_creacion = date('Y-m-d'); // columna varchar(11)
        $sql = "INSERT INTO tbl15_tercero 
                (nombre_tipo_tercero, nombre_tipo_tercero_modulo_creacion, nombre_tipo_identificacion, identificacion_tercero,
                 nombres_apellidos_tercero, nombre1_tercero, apellido1_tercero,
                 direccion_tercero, telefono1_tercero, correo_tercero,
                 fecha_creacion, cod_administrador, cod_estado)
                VALUES ('EMPLEADO', 'EMPLEADO', 'CC', '$documento_e',
                        '$nombre_completo_e', '$nombres_e', '$apellidos_e',
                        '$direccion_e', '$telefono_e', '$correo_e',
                        '$fecha_creacion', $cod_admin, 1)";

        $r = $this->con->query($sql);
        if (!$r) return $resultado;
        $resultado['id'] = (int)$this->con->insert_id;
        return $resultado;
    }

    /**
     * Obtiene un empleado activo por su cod_tercero
     */
    public function getEmpleadoPorId($cod_tercero) {
        $cod = (int)$cod_tercero;
        $sql = "SELECT cod_tercero, nombres_apellidos_tercero AS nombre, identificacion_tercero AS documento
                FROM tbl15_tercero WHERE cod_tercero = $cod AND cod_estado = 1";
        $r = $this->con->query($sql);
        if (!$r) return null;
        return $r->fetch_assoc();
    }

    /**
     * Registra el pago de una cuota de préstamo
     */
    public function registrarPagoCuota($cod_cuota, $datos_pago) {
        $cod = (int)$cod_cuota;
        $fecha_pago = $this->escape(isset($datos_pago['fecha_pago']) ? $datos_pago['fecha_pago'] : date('Y-m-d H:i:s'));
        $forma_pago = isset($datos_pago['cod_tipo_forma_pago']) ? (int)$datos_pago['cod_tipo_forma_pago'] : null;
        $banco_cuenta = isset($datos_pago['cod_banco_cuenta']) ? (int)$datos_pago['cod_banco_cuenta'] : null;
        $cod_admin = isset($datos_pago['cod_admin_pago']) ? (int)$datos_pago['cod_admin_pago'] : 0;
        
        if ($cod <= 0) return false;
        
        $banco_sql = $banco_cuenta ? $banco_cuenta : 'NULL';
        $forma_sql = $forma_pago ? $forma_pago : 'NULL';
        
        $sql = "UPDATE tbl15_prestamo_empleado_cuota SET 
                    fecha_pago = '$fecha_pago',
                    cod_estado_cuota = 2,
                    cod_tipo_forma_pago = $forma_sql,
                    cod_banco_cuenta = $banco_sql,
                    cod_admin_pago = $cod_admin
                WHERE cod_prestamo_empleado_cuota = $cod AND active = 1";
        
        $r = $this->con->query($sql);
        if (!$r) return false;
        
        // Verificar si todas las cuotas están pagadas → actualizar estado del préstamo
        $r_prestamo = $this->con->query("SELECT cod_prestamo_empleado FROM tbl15_prestamo_empleado_cuota WHERE cod_prestamo_empleado_cuota = $cod");
        $row = $r_prestamo ? $r_prestamo->fetch_assoc() : null;
        if ($row) {
            $prestamo_id = (int)$row['cod_prestamo_empleado'];
            $r_pend = $this->con->query("SELECT COUNT(*) AS pend FROM tbl15_prestamo_empleado_cuota WHERE cod_prestamo_empleado = $prestamo_id AND cod_estado_cuota = 1 AND active = 1");
            if ($r_pend) {
                $pend = (int)$r_pend->fetch_assoc()['pend'];
                if ($pend === 0) {
                    $this->con->query("UPDATE tbl15_prestamo_empleado SET cod_estado_prestamo = 2 WHERE cod_prestamo_empleado = $prestamo_id");
                }
            }
        }
        
        return true;
    }

    /**
     * Anula un préstamo y todas sus cuotas pendientes
     */
    public function anularPrestamo($cod_prestamo, $motivo = '') {
        $cod = (int)$cod_prestamo;
        $mot = $this->escape($motivo);
        if ($cod <= 0) return false;
        
        $this->con->begin_transaction();
        try {
            $this->con->query("UPDATE tbl15_prestamo_empleado SET cod_estado_prestamo = 3, notas = CONCAT(IFNULL(notas,''), ' | Anulado: $mot') WHERE cod_prestamo_empleado = $cod");
            $this->con->query("UPDATE tbl15_prestamo_empleado_cuota SET cod_estado_cuota = 4 WHERE cod_prestamo_empleado = $cod AND cod_estado_cuota = 1");
            $this->con->commit();
            return true;
        } catch (Exception $e) {
            $this->con->rollback();
            return false;
        }
    }

    // ========== PRÉSTAMOS - HANDLER ==========

    /**
     * Actualiza los datos de un préstamo (método simple)
     */
    public function actualizarPrestamo($cod_prestamo, $datos) {
        $cod = (int)$cod_prestamo;
        if ($cod <= 0) return false;
        
        $notas = $this->escape(isset($datos['notas']) ? $datos['notas'] : '');
        $metodo = isset($datos['cod_metodo_pago']) ? (int)$datos['cod_metodo_pago'] : 0;
        
        $sql = "UPDATE tbl15_prestamo_empleado SET notas = '$notas'";
        if ($metodo > 0) $sql .= ", cod_metodo_pago = $metodo";
        $sql .= " WHERE cod_prestamo_empleado = $cod AND active = 1";
        
        return $this->con->query($sql);
    }

    public function escape($str) {
        return $this->con->real_escape_string($str);
    }

    public function query($sql) {
        return $this->con->query($sql);
    }
}
?>
