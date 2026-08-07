<?php
/**
 * DayqArchivoService - Servicio de gestión de archivos adjuntos
 * Carga, almacenamiento y relación con tablas
 */
class DayqArchivoService {
    private $con;
    private $upload_dir;

    public function __construct(mysqli $con, $upload_dir = null) {
        $this->con = $con;
        $this->upload_dir = isset($upload_dir) ? $upload_dir : __DIR__ . '/../../uploads/administrativo';
        if (!is_dir($this->upload_dir)) {
            mkdir($this->upload_dir, 0755, true);
        }
    }

    /**
     * Guarda archivo adjunto para un crédito
     */
    public function guardarArchivoCredito($cod_info_factura_venta, $archivo_tmp, $archivo_nombre, $archivo_tipo) {
        $cod = (int)$cod_info_factura_venta;
        
        // Generar nombre único
        $extension = pathinfo($archivo_nombre, PATHINFO_EXTENSION);
        $nombre_guardado = 'credito_' . $cod . '_' . time() . '.' . $extension;
        $ruta_guardada = $this->upload_dir . '/' . $nombre_guardado;
        
        // Mover archivo
        if (!move_uploaded_file($archivo_tmp, $ruta_guardada)) {
            return ['exito' => false, 'error' => 'No se pudo guardar el archivo'];
        }
        
        // Insertar en BD
        $nombre_esc = $this->con->real_escape_string($archivo_nombre);
        $tipo_esc = $this->con->real_escape_string($archivo_tipo);
        $ruta_esc = $this->con->real_escape_string($nombre_guardado);
        
        $sql = "INSERT INTO tbl15_archivo_adjunto 
                (cod_info_factura_venta, nombre_archivo_adjunto, nombre_tipo_extencion_archivo, url_img_orig_producto, fecha_creacion)
                VALUES ($cod, '$nombre_esc', '$tipo_esc', '$ruta_esc', NOW())";
        
        if ($this->con->query($sql)) {
            return [
                'exito' => true,
                'cod_archivo' => $this->con->insert_id,
                'nombre' => $archivo_nombre,
                'ruta' => $nombre_guardado
            ];
        } else {
            unlink($ruta_guardada);
            return ['exito' => false, 'error' => 'Error al guardar en BD'];
        }
    }

    /**
     * Guarda archivo adjunto para un abono
     */
    public function guardarArchivoAbono($cod_cuentas_cobrar_abonos, $archivo_tmp, $archivo_nombre, $archivo_tipo) {
        $cod = (int)$cod_cuentas_cobrar_abonos;
        
        $extension = pathinfo($archivo_nombre, PATHINFO_EXTENSION);
        $nombre_guardado = 'abono_' . $cod . '_' . time() . '.' . $extension;
        $ruta_guardada = $this->upload_dir . '/' . $nombre_guardado;
        
        if (!move_uploaded_file($archivo_tmp, $ruta_guardada)) {
            return ['exito' => false, 'error' => 'No se pudo guardar el archivo'];
        }
        
        $nombre_esc = $this->con->real_escape_string($archivo_nombre);
        $tipo_esc = $this->con->real_escape_string($archivo_tipo);
        $ruta_esc = $this->con->real_escape_string($nombre_guardado);
        
        $sql = "INSERT INTO tbl15_archivo_adjunto 
                (cod_cuentas_cobrar_abonos, nombre_archivo_adjunto, nombre_tipo_extencion_archivo, url_img_orig_producto, fecha_creacion)
                VALUES ($cod, '$nombre_esc', '$tipo_esc', '$ruta_esc', NOW())";
        
        if ($this->con->query($sql)) {
            return [
                'exito' => true,
                'cod_archivo' => $this->con->insert_id,
                'nombre' => $archivo_nombre,
                'ruta' => $nombre_guardado
            ];
        } else {
            unlink($ruta_guardada);
            return ['exito' => false, 'error' => 'Error al guardar en BD'];
        }
    }

    /**
     * Obtener ruta de archivo para descarga
     */
    public function obtenerRutaArchivo($cod_archivo) {
        $cod = (int)$cod_archivo;
        
        $sql = "SELECT url_img_orig_producto AS archivo_adjunto_ruta FROM tbl15_archivo_adjunto WHERE cod_archivo_adjunto = $cod";
        $r = $this->con->query($sql);
        if (!$r) return null;
        
        $row = $r->fetch_assoc();
        return $row ? $this->upload_dir . '/' . $row['archivo_adjunto_ruta'] : null;
    }

    /**
     * Eliminar archivo
     */
    public function eliminarArchivo($cod_archivo) {
        $cod = (int)$cod_archivo;
        
        $ruta = $this->obtenerRutaArchivo($cod);
        if ($ruta && file_exists($ruta)) {
            unlink($ruta);
        }
        
        $sql = "DELETE FROM tbl15_archivo_adjunto WHERE cod_archivo_adjunto = $cod";
        return $this->con->query($sql);
    }

    /**
     * Lista documentos con paginación y filtros
     */
    public function listarDocumentos($pagina = 1, $por_pagina = 20, $filtros = []) {
        $offset = ($pagina - 1) * $por_pagina;
        $where = 'WHERE 1=1';
        $params = [];

        if (!empty($filtros['cod_info_factura_venta'])) {
            $cod = (int)$filtros['cod_info_factura_venta'];
            $where .= " AND aa.cod_info_factura_venta = $cod";
        }
        if (!empty($filtros['fecha_desde'])) {
            $d = $this->escape($filtros['fecha_desde']);
            $where .= " AND DATE(aa.fecha_creacion) >= '$d'";
        }
        if (!empty($filtros['fecha_hasta'])) {
            $h = $this->escape($filtros['fecha_hasta']);
            $where .= " AND DATE(aa.fecha_creacion) <= '$h'";
        }
        if (!empty($filtros['tipo_archivo'])) {
            $t = $this->escape($filtros['tipo_archivo']);
            $where .= " AND aa.nombre_tipo_extencion_archivo = '$t'";
        }
        if (!empty($filtros['buscar'])) {
            $q = $this->escape('%' . $filtros['buscar'] . '%');
            $where .= " AND (aa.nombre_archivo_adjunto LIKE '$q' OR ifv.cod_factura LIKE '$q')";
        }

        $sql = "SELECT 
                    aa.cod_archivo_adjunto,
                    COALESCE(NULLIF(aa.cod_info_factura_venta, 0), cc.cod_info_factura_venta) AS cod_info_factura_venta,
                    aa.nombre_archivo_adjunto,
                    aa.nombre_tipo_extencion_archivo AS tipo_archivo,
                    aa.url_img_orig_producto AS ruta_archivo,
                    aa.fecha_creacion,
                    COALESCE(NULLIF(ifv.cod_factura, '0'), ifv2.cod_factura) AS cod_factura,
                    COALESCE(NULLIF(t.nombres_apellidos_tercero, ''), t2.nombres_apellidos_tercero) AS cliente,
                    COALESCE(NULLIF(ec.nombre_entidad_crediticia, ''), ec2.nombre_entidad_crediticia) AS linea
                FROM tbl15_archivo_adjunto aa
                LEFT JOIN tbl15_info_factura_venta ifv ON ifv.cod_info_factura_venta = aa.cod_info_factura_venta
                LEFT JOIN tbl15_tercero t ON t.cod_tercero = ifv.cod_tercero
                LEFT JOIN tbl15_operador_credito oc ON oc.cod_operador_credito = ifv.cod_operador_credito
                LEFT JOIN tbl15_entidad_crediticia ec ON ec.cod_entidad_crediticia = oc.cod_entidad_crediticia
                LEFT JOIN tbl15_cuentas_cobrar_abonos cca ON cca.cod_cuentas_cobrar_abonos = aa.cod_cuentas_cobrar_abonos
                LEFT JOIN tbl15_cuentas_cobrar cc ON cc.cod_cuentas_cobrar = cca.cod_cuentas_cobrar
                LEFT JOIN tbl15_info_factura_venta ifv2 ON ifv2.cod_info_factura_venta = cc.cod_info_factura_venta
                LEFT JOIN tbl15_tercero t2 ON t2.cod_tercero = ifv2.cod_tercero
                LEFT JOIN tbl15_operador_credito oc2 ON oc2.cod_operador_credito = ifv2.cod_operador_credito
                LEFT JOIN tbl15_entidad_crediticia ec2 ON ec2.cod_entidad_crediticia = oc2.cod_entidad_crediticia
                $where
                ORDER BY aa.fecha_creacion DESC
                LIMIT $offset, $por_pagina";

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
     * Cuenta total de documentos con filtros
     */
    public function totalDocumentos($filtros = []) {
        $where = 'WHERE 1=1';

        if (!empty($filtros['cod_info_factura_venta'])) {
            $cod = (int)$filtros['cod_info_factura_venta'];
            $where .= " AND aa.cod_info_factura_venta = $cod";
        }
        if (!empty($filtros['fecha_desde'])) {
            $d = $this->escape($filtros['fecha_desde']);
            $where .= " AND DATE(aa.fecha_creacion) >= '$d'";
        }
        if (!empty($filtros['fecha_hasta'])) {
            $h = $this->escape($filtros['fecha_hasta']);
            $where .= " AND DATE(aa.fecha_creacion) <= '$h'";
        }
        if (!empty($filtros['tipo_archivo'])) {
            $t = $this->escape($filtros['tipo_archivo']);
            $where .= " AND aa.nombre_tipo_extencion_archivo = '$t'";
        }
        if (!empty($filtros['buscar'])) {
            $q = $this->escape('%' . $filtros['buscar'] . '%');
            $where .= " AND (aa.nombre_archivo_adjunto LIKE '$q' OR ifv.cod_factura LIKE '$q')";
        }

        $sql = "SELECT COUNT(*) AS total FROM tbl15_archivo_adjunto aa
                LEFT JOIN tbl15_info_factura_venta ifv ON ifv.cod_info_factura_venta = aa.cod_info_factura_venta
                $where";
        $r = $this->con->query($sql);
        if (!$r) return 0;
        $row = $r->fetch_assoc();
        return (int)$row['total'];
    }

    /**
     * Obtiene tipos de archivo distintos para el filtro
     */
    public function getTiposArchivo() {
        $sql = "SELECT DISTINCT nombre_tipo_extencion_archivo AS tipo 
                FROM tbl15_archivo_adjunto 
                WHERE nombre_tipo_extencion_archivo IS NOT NULL 
                AND nombre_tipo_extencion_archivo != ''
                ORDER BY tipo ASC";
        $r = $this->con->query($sql);
        $tipos = [];
        if ($r) {
            while ($row = $r->fetch_assoc()) {
                $tipos[] = $row['tipo'];
            }
        }
        return $tipos;
    }

    /**
     * Obtiene información completa de un documento
     */
    public function getDocumento($cod_archivo) {
        $cod = (int)$cod_archivo;
        $sql = "SELECT 
                    aa.*,
                    ifv.cod_factura,
                    ifv.total_precio_venta,
                    t.nombres_apellidos_tercero AS cliente,
                    t.identificacion_tercero AS cliente_documento,
                    ec.nombre_entidad_crediticia AS linea
                FROM tbl15_archivo_adjunto aa
                LEFT JOIN tbl15_info_factura_venta ifv ON ifv.cod_info_factura_venta = aa.cod_info_factura_venta
                LEFT JOIN tbl15_tercero t ON t.cod_tercero = ifv.cod_tercero
                LEFT JOIN tbl15_operador_credito oc ON oc.cod_operador_credito = ifv.cod_operador_credito
                LEFT JOIN tbl15_entidad_crediticia ec ON ec.cod_entidad_crediticia = oc.cod_entidad_crediticia
                WHERE aa.cod_archivo_adjunto = $cod";
        $r = $this->con->query($sql);
        if (!$r) return null;
        return $r->fetch_assoc();
    }

    public function escape($str) {
        return $this->con->real_escape_string($str);
    }
}
?>
