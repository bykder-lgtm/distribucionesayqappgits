<?php
/**
 * DayqLiquidacionService - Servicio de cálculos de liquidación
 * Liquidación comercial vs interna, cálculo de utilidad y márgenes
 */
class DayqLiquidacionService {
    private $con;

    public function __construct(mysqli $con) {
        $this->con = $con;
    }

    /**
     * Calcula liquidación comercial (cliente)
     * Valor contado → recargo → valor financiado → cuota → total a pagar
     */
    public function getLiquidacionComercial($cod_cuentas_cobrar) {
        $cod = (int)$cod_cuentas_cobrar;
        
        $sql = "SELECT 
                    cc.monto_deuda_sin_interes AS valor_contado,
                    cc.interes_ptj,
                    cc.monto_deuda,
                    cc.numero_cuota,
                    cc.monto_cuota,
                    cc.abonado,
                    (cc.monto_deuda - cc.abonado) AS pendiente
                FROM tbl15_cuentas_cobrar cc
                WHERE cc.cod_cuentas_cobrar = $cod";
        
        $r = $this->con->query($sql);
        if (!$r) return null;
        
        $row = $r->fetch_assoc();
        if (!$row) return null;
        
        $valor_contado = (float)(isset($row['valor_contado']) ? $row['valor_contado'] : 0);
        $interes_ptj = (float)(isset($row['interes_ptj']) ? $row['interes_ptj'] : 0);
        $recargo = ($valor_contado * $interes_ptj) / 100;
        $valor_financiado = $valor_contado + $recargo;
        
        return [
            'valor_contado' => $valor_contado,
            'interes_ptj' => $interes_ptj,
            'recargo' => $recargo,
            'valor_financiado' => $valor_financiado,
            'numero_cuota' => (int)(isset($row['numero_cuota']) ? $row['numero_cuota'] : 0),
            'monto_cuota' => (float)(isset($row['monto_cuota']) ? $row['monto_cuota'] : 0),
            'abonado' => (float)(isset($row['abonado']) ? $row['abonado'] : 0),
            'pendiente' => (float)(isset($row['pendiente']) ? $row['pendiente'] : 0)
        ];
    }

    /**
     * Calcula liquidación interna (Flexitech)
     * Valor habilitador → comisión → utilidad → margen
     */
    public function getLiquidacionInterna($cod_info_factura_venta, $porcentaje_habilitador = 70) {
        $cod = (int)$cod_info_factura_venta;
        
        $sql = "SELECT 
                    ifv.total_precio_venta AS valor_cliente,
                    cc.monto_deuda_sin_interes AS valor_contado,
                    cc.interes_ptj,
                    cc.monto_deuda,
                    ec.comision_ptj
                FROM tbl15_info_factura_venta ifv
                LEFT JOIN tbl15_cuentas_cobrar cc ON cc.cod_info_factura_venta = ifv.cod_info_factura_venta
                LEFT JOIN tbl15_entidad_crediticia ec ON ec.cod_entidad_crediticia = ifv.cod_tercero
                WHERE ifv.cod_info_factura_venta = $cod";
        
        $r = $this->con->query($sql);
        if (!$r) return null;
        
        $row = $r->fetch_assoc();
        if (!$row) return null;
        
        $valor_cliente = (float)(isset($row['valor_cliente']) ? $row['valor_cliente'] : 0);
        $valor_habilitador = ($valor_cliente * $porcentaje_habilitador) / 100;
        $comision_ptj = (float)(isset($row['comision_ptj']) ? $row['comision_ptj'] : 0);
        $comision = ($valor_habilitador * $comision_ptj) / 100;
        $utilidad = $valor_cliente - $valor_habilitador - $comision;
        $margen = $valor_cliente > 0 ? ($utilidad / $valor_cliente) * 100 : 0;
        
        return [
            'valor_cliente' => $valor_cliente,
            'valor_habilitador' => $valor_habilitador,
            'porcentaje_habilitador' => $porcentaje_habilitador,
            'comision_ptj' => $comision_ptj,
            'comision' => $comision,
            'utilidad' => $utilidad,
            'margen_real' => round($margen, 2)
        ];
    }

    /**
     * Comparativo liquidación comercial vs interna
     */
    public function getComparativoLiquidacion($cod_cuentas_cobrar, $cod_info_factura_venta) {
        $liq_comercial = $this->getLiquidacionComercial($cod_cuentas_cobrar);
        $liq_interna = $this->getLiquidacionInterna($cod_info_factura_venta);
        
        if (!$liq_comercial || !$liq_interna) return null;
        
        return [
            'comercial' => $liq_comercial,
            'interna' => $liq_interna,
            'diferencia_utilidad' => abs($liq_comercial['recargo'] - $liq_interna['comision']),
            'margen_cumple_minimo' => $liq_interna['margen_real'] >= 15  // Asumiendo margen mínimo de 15%
        ];
    }

    /**
     * Calcula el impacto de una anulación
     */
    public function getImpactoAnulacion($cod_info_factura_venta, $tipo_anulacion = 'ANTES_APROBACION') {
        $cod = (int)$cod_info_factura_venta;
        
        $sql = "SELECT 
                    ifv.total_precio_venta,
                    cc.monto_deuda,
                    cc.abonado,
                    cc.interes_ptj,
                    ec.comision_ptj,
                    ec.aval_ptj
                FROM tbl15_info_factura_venta ifv
                LEFT JOIN tbl15_cuentas_cobrar cc ON cc.cod_info_factura_venta = ifv.cod_info_factura_venta
                LEFT JOIN tbl15_entidad_crediticia ec ON ec.cod_entidad_crediticia = ifv.cod_tercero
                WHERE ifv.cod_info_factura_venta = $cod";
        
        $r = $this->con->query($sql);
        if (!$r) return null;
        
        $row = $r->fetch_assoc();
        if (!$row) return null;
        
        $valor_financiado = (float)(isset($row['monto_deuda']) ? $row['monto_deuda'] : 0);
        $abonado = (float)(isset($row['abonado']) ? $row['abonado'] : 0);
        $comision_ptj = (float)(isset($row['comision_ptj']) ? $row['comision_ptj'] : 0);
        $aval_ptj = (float)(isset($row['aval_ptj']) ? $row['aval_ptj'] : 0);
        
        // Penalidad = comisión + aval si es antes de aprobación
        $penalidad = ($tipo_anulacion === 'ANTES_APROBACION') 
            ? ($valor_financiado * ($comision_ptj + $aval_ptj)) / 100
            : ($abonado * 0.05);  // 5% de lo abonado si es después
        
        $perdida_total = $valor_financiado + $penalidad;
        
        return [
            'valor_financiado' => $valor_financiado,
            'abonado' => $abonado,
            'saldo_no_cobrado' => $valor_financiado - $abonado,
            'comision_ptj' => $comision_ptj,
            'aval_ptj' => $aval_ptj,
            'penalidad' => $penalidad,
            'perdida_total' => $perdida_total,
            'tipo_anulacion' => $tipo_anulacion
        ];
    }

    public function escape($str) {
        return $this->con->real_escape_string($str);
    }
}
?>
