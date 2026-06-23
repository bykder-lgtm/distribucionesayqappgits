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
                (cod_info_factura_venta, archivo_adjunto_nombre, archivo_adjunto_tipo, archivo_adjunto_ruta, fecha_creacion)
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
                (cod_cuentas_cobrar_abonos, archivo_adjunto_nombre, archivo_adjunto_tipo, archivo_adjunto_ruta, fecha_creacion)
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
        
        $sql = "SELECT archivo_adjunto_ruta FROM tbl15_archivo_adjunto WHERE cod_archivo_adjunto = $cod";
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

    public function escape($str) {
        return $this->con->real_escape_string($str);
    }
}
?>
