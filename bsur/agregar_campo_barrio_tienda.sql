-- Script SQL para agregar el campo barrio_tercero a la tabla tbl15_tienda
-- Ejecutar este script en phpMyAdmin o desde línea de comandos MySQL

-- Verificar si el campo barrio_tercero no existe y agregarlo
SET @dbname = DATABASE();
SET @tablename = 'tbl15_tienda';
SET @columnname = 'barrio_tercero';
SET @preparedStatement = (SELECT IF(
  (
    SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS
    WHERE
      (table_name = @tablename)
      AND (table_schema = @dbname)
      AND (column_name = @columnname)
  ) > 0,
  'SELECT 1',
  CONCAT('ALTER TABLE ', @tablename, ' ADD COLUMN ', @columnname, ' VARCHAR(255) NULL AFTER direccion_tercero')
));
PREPARE alterIfNotExists FROM @preparedStatement;
EXECUTE alterIfNotExists;
DEALLOCATE PREPARE alterIfNotExists;

-- Mensaje de confirmación
SELECT 'Campo barrio_tercero agregado correctamente (o ya existía)' AS resultado;
