-- ============================================
-- SCRIPT SQL PARA SISTEMA DE FIRMA DIGITAL SEGURO
-- ============================================
-- Fecha: 16 de febrero de 2026
-- Propósito: Crear tabla de logs y actualizar tabla principal

-- 1. CREAR TABLA DE LOGS DE AUDITORÍA
-- Esta tabla registra todos los intentos de firma para detectar patrones sospechosos
CREATE TABLE IF NOT EXISTS `tbl15_log_firma_digital` (
  `cod_log_firma_digital` int(9) NOT NULL AUTO_INCREMENT,
  `cod_firma_digital_documento` int(9) NOT NULL DEFAULT 0,
  `accion` varchar(50) NOT NULL COMMENT 'TOKEN_GENERADO, INTENTO_FIRMA, FIRMA_EXITOSA, FIRMA_FALLIDA',
  `ip_origen` varchar(45) NOT NULL,
  `user_agent` text NOT NULL,
  `fecha_accion` datetime NOT NULL,
  `descripcion` text,
  PRIMARY KEY (`cod_log_firma_digital`),
  KEY `idx_cod_firma` (`cod_firma_digital_documento`),
  KEY `idx_ip_fecha` (`ip_origen`, `fecha_accion`),
  KEY `idx_accion` (`accion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 2. ACTUALIZAR TABLA PRINCIPAL SI ES NECESARIO
-- Agregar columna para el hash de seguridad del servidor (ejecutar solo si no existe)
-- Si la columna ya existe, este comando dará error pero no afectará el resto del script

-- Verificar si la columna existe antes de agregarla
SET @column_exists = (
    SELECT COUNT(*) 
    FROM INFORMATION_SCHEMA.COLUMNS 
    WHERE TABLE_SCHEMA = DATABASE() 
    AND TABLE_NAME = 'tbl15_firma_digital_documento' 
    AND COLUMN_NAME = 'hash_seguridad_servidor'
);

SET @sql = IF(@column_exists = 0,
    'ALTER TABLE `tbl15_firma_digital_documento` ADD COLUMN `hash_seguridad_servidor` varchar(64) NOT NULL DEFAULT '''' COMMENT ''HMAC SHA256 del servidor'' AFTER `url_firma_digital_documento`',
    'SELECT ''La columna hash_seguridad_servidor ya existe'' AS mensaje'
);

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- 3. CREAR ÍNDICES PARA OPTIMIZAR BÚSQUEDAS DE SEGURIDAD
-- Nota: MySQL no soporta IF NOT EXISTS en CREATE INDEX, por lo que ignoraremos errores

-- Índice para búsquedas por token y estado
SET @index_exists = (
    SELECT COUNT(*) 
    FROM INFORMATION_SCHEMA.STATISTICS 
    WHERE TABLE_SCHEMA = DATABASE() 
    AND TABLE_NAME = 'tbl15_firma_digital_documento' 
    AND INDEX_NAME = 'idx_token_estado'
);

SET @sql = IF(@index_exists = 0,
    'ALTER TABLE `tbl15_firma_digital_documento` ADD INDEX `idx_token_estado` (`token_firma_digital_documento`, `cod_estado`, `cod_estado_firma_signature`)',
    'SELECT ''El índice idx_token_estado ya existe'' AS mensaje'
);

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- Índice para búsquedas por aliado y estado
SET @index_exists = (
    SELECT COUNT(*) 
    FROM INFORMATION_SCHEMA.STATISTICS 
    WHERE TABLE_SCHEMA = DATABASE() 
    AND TABLE_NAME = 'tbl15_firma_digital_documento' 
    AND INDEX_NAME = 'idx_aliado_estado'
);

SET @sql = IF(@index_exists = 0,
    'ALTER TABLE `tbl15_firma_digital_documento` ADD INDEX `idx_aliado_estado` (`cod_aliado_estrategico`, `cod_estado_firma_signature`, `fecha_creacion_registro_firma_digital_documento`)',
    'SELECT ''El índice idx_aliado_estado ya existe'' AS mensaje'
);

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- Índice para búsquedas por fecha de creación
SET @index_exists = (
    SELECT COUNT(*) 
    FROM INFORMATION_SCHEMA.STATISTICS 
    WHERE TABLE_SCHEMA = DATABASE() 
    AND TABLE_NAME = 'tbl15_firma_digital_documento' 
    AND INDEX_NAME = 'idx_fecha_creacion'
);

SET @sql = IF(@index_exists = 0,
    'ALTER TABLE `tbl15_firma_digital_documento` ADD INDEX `idx_fecha_creacion` (`fecha_creacion_registro_firma_digital_documento`)',
    'SELECT ''El índice idx_fecha_creacion ya existe'' AS mensaje'
);

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- 4. AGREGAR RESTRICCIONES DE INTEGRIDAD
-- Verificar si la foreign key ya existe antes de crearla
SET @fk_exists = (
    SELECT COUNT(*) 
    FROM INFORMATION_SCHEMA.TABLE_CONSTRAINTS 
    WHERE TABLE_SCHEMA = DATABASE() 
    AND TABLE_NAME = 'tbl15_log_firma_digital' 
    AND CONSTRAINT_NAME = 'fk_log_firma_documento'
    AND CONSTRAINT_TYPE = 'FOREIGN KEY'
);

SET @sql = IF(@fk_exists = 0,
    'ALTER TABLE `tbl15_log_firma_digital` ADD CONSTRAINT `fk_log_firma_documento` FOREIGN KEY (`cod_firma_digital_documento`) REFERENCES `tbl15_firma_digital_documento`(`cod_firma_digital_documento`) ON DELETE CASCADE ON UPDATE CASCADE',
    'SELECT ''La foreign key fk_log_firma_documento ya existe'' AS mensaje'
);

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- ============================================
-- CONSULTAS ÚTILES PARA MONITOREO DE SEGURIDAD
-- ============================================

-- Ver intentos fallidos por IP (detectar ataques)
-- SELECT 
--     ip_origen, 
--     COUNT(*) as intentos,
--     MAX(fecha_accion) as ultimo_intento
-- FROM tbl15_log_firma_digital
-- WHERE accion IN ('INTENTO_FIRMA', 'FIRMA_FALLIDA')
-- AND fecha_accion > DATE_SUB(NOW(), INTERVAL 1 HOUR)
-- GROUP BY ip_origen
-- HAVING intentos > 3
-- ORDER BY intentos DESC;

-- Ver documentos expirados que deben limpiarse
-- SELECT 
--     cod_firma_digital_documento,
--     token_firma_digital_documento,
--     fecha_creacion_registro_firma_digital_documento,
--     TIMESTAMPDIFF(HOUR, fecha_creacion_registro_firma_digital_documento, NOW()) as horas_transcurridas
-- FROM tbl15_firma_digital_documento
-- WHERE cod_estado = 1
-- AND cod_estado_firma_signature = 0
-- AND fecha_creacion_registro_firma_digital_documento < DATE_SUB(NOW(), INTERVAL 48 HOUR);

-- Ver estadísticas de firmas por asesor
-- SELECT 
--     a.nombres,
--     a.apellidos,
--     COUNT(f.cod_firma_digital_documento) as total_generados,
--     SUM(CASE WHEN f.cod_estado_firma_signature = 1 THEN 1 ELSE 0 END) as firmados,
--     SUM(CASE WHEN f.cod_estado_firma_signature = 0 THEN 1 ELSE 0 END) as pendientes
-- FROM tbl15_administrador a
-- LEFT JOIN tbl15_firma_digital_documento f ON a.cod_asesor = f.cod_asesor
-- WHERE a.cod_seguridad = 3
-- GROUP BY a.cod_administrador
-- ORDER BY total_generados DESC;

-- ============================================
-- PROCEDIMIENTO ALMACENADO PARA LIMPIEZA AUTOMÁTICA
-- ============================================

-- Eliminar procedimiento si ya existe
DROP PROCEDURE IF EXISTS limpiar_documentos_expirados;

DELIMITER //

CREATE PROCEDURE limpiar_documentos_expirados()
BEGIN
    -- Desactivar documentos expirados no firmados
    UPDATE tbl15_firma_digital_documento
    SET cod_estado = 0
    WHERE cod_estado = 1
    AND cod_estado_firma_signature = 0
    AND fecha_creacion_registro_firma_digital_documento < DATE_SUB(NOW(), INTERVAL 48 HOUR);
    
    -- Registrar en log (evitando duplicados)
    INSERT INTO tbl15_log_firma_digital (
        cod_firma_digital_documento,
        accion,
        ip_origen,
        user_agent,
        fecha_accion,
        descripcion
    )
    SELECT 
        f.cod_firma_digital_documento,
        'DOCUMENTO_EXPIRADO',
        '0.0.0.0',
        'SISTEMA_AUTOMATICO',
        NOW(),
        'Documento expirado por límite de 48 horas'
    FROM tbl15_firma_digital_documento f
    WHERE f.cod_estado = 0
    AND f.cod_estado_firma_signature = 0
    AND f.fecha_creacion_registro_firma_digital_documento < DATE_SUB(NOW(), INTERVAL 48 HOUR)
    AND NOT EXISTS (
        SELECT 1 
        FROM tbl15_log_firma_digital l
        WHERE l.cod_firma_digital_documento = f.cod_firma_digital_documento
        AND l.accion = 'DOCUMENTO_EXPIRADO'
    );
END //

DELIMITER ;

-- ============================================
-- EVENTO PROGRAMADO PARA EJECUTAR LIMPIEZA CADA HORA
-- ============================================

-- Habilitar el programador de eventos
SET GLOBAL event_scheduler = ON;

-- Eliminar evento si ya existe
DROP EVENT IF EXISTS evento_limpiar_documentos_expirados;

-- Crear evento para limpieza automática
CREATE EVENT evento_limpiar_documentos_expirados
ON SCHEDULE EVERY 1 HOUR
STARTS CURRENT_TIMESTAMP
DO
   CALL limpiar_documentos_expirados();

-- ============================================
-- COMENTARIOS SOBRE SEGURIDAD IMPLEMENTADA
-- ============================================

/*
CAPAS DE SEGURIDAD IMPLEMENTADAS:

1. VALIDACIÓN DE ORIGEN
   - Verificación de HTTP_ORIGIN y HTTP_REFERER
   - Solo permite requests desde el servidor autorizado

2. RATE LIMITING
   - Límite de 10 solicitudes por usuario en 5 minutos
   - Límite de 5 intentos de firma por IP en 10 minutos
   - Previene ataques de fuerza bruta

3. TOKEN DE USO ÚNICO (ONE-TIME USE)
   - Token solo puede ser usado una vez
   - Se marca como usado después de firmar
   - No puede ser reutilizado

4. EXPIRACIÓN TEMPORAL
   - Tokens expiran en 48 horas
   - Limpieza automática de tokens expirados
   - Contador visible para el usuario

5. HASH HMAC DEL SERVIDOR
   - Firma digital del servidor usando HMAC-SHA256
   - Incluye: token + cod_aliado + timestamp + IP
   - Previene manipulación del enlace

6. VALIDACIÓN DE IDENTIDAD
   - Verifica que el aliado pertenezca al asesor
   - Valida que el aliado esté activo
   - Previene firma por personas no autorizadas

7. SQL INJECTION PROTECTION
   - Uso de prepared statements en todas las consultas
   - mysqli_real_escape_string para datos no parametrizados
   - Validación de tipos de datos

8. AUDITORÍA COMPLETA
   - Registro de todas las acciones
   - Tracking de IP y User Agent
   - Detección de patrones sospechosos

9. VALIDACIÓN DEL LADO DEL CLIENTE
   - Verificación de existencia de firma
   - Confirmación antes de enviar
   - Validación de formato de imagen

10. PROTECCIÓN CSRF
    - Validación de Content-Type
    - Token único por documento
    - Verificación de origen del request

11. PREVENCIÓN DE DUPLICADOS
    - Solo un token activo por aliado
    - Validación antes de generar nuevo token

12. ENCRIPTACIÓN DE DATOS
    - Token encriptado en URL
    - Firma almacenada en base64
    - Uso de HTTPS recomendado
*/
