<?php
/**
 * Script de Limpieza Automática de Archivos ZIP Temporales
 * 
 * Este script elimina archivos ZIP que tengan más de X días de antigüedad.
 * Puede ejecutarse manualmente o programarse como tarea cron.
 * 
 * USO MANUAL:
 * php limpiar_zips_antiguos.php
 * 
 * USO CON PARÁMETRO:
 * php limpiar_zips_antiguos.php 3   (elimina archivos con más de 3 días)
 * 
 * PROGRAMAR EN CRON (Linux):
 * 0 2 * * * /usr/bin/php /ruta/completa/limpiar_zips_antiguos.php >> /ruta/logs/limpieza_zips.log 2>&1
 * (Se ejecuta todos los días a las 2:00 AM)
 * 
 * PROGRAMAR EN WINDOWS (Programador de Tareas):
 * - Programa: C:\xampp\php\php.exe
 * - Argumentos: C:\ruta\completa\limpiar_zips_antiguos.php
 * - Horario: Diario a las 2:00 AM
 */

// Configuración
$dias_antiguedad = isset($argv[1]) ? intval($argv[1]) : 7; // Por defecto 7 días
$directorio_zips = __DIR__ . '/app/archivador/temp_zips/';

// Colores para consola (solo en entornos que lo soporten)
$color_reset = "\033[0m";
$color_azul = "\033[36m";
$color_verde = "\033[32m";
$color_amarillo = "\033[33m";
$color_rojo = "\033[31m";

echo $color_azul . "╔════════════════════════════════════════════════════════════════╗\n" . $color_reset;
echo $color_azul . "║  LIMPIEZA DE ARCHIVOS ZIP TEMPORALES                          ║\n" . $color_reset;
echo $color_azul . "╚════════════════════════════════════════════════════════════════╝\n" . $color_reset;
echo "\n";

// Verificar que el directorio existe
if (!is_dir($directorio_zips)) {
    echo $color_rojo . "❌ Error: No se encontró el directorio $directorio_zips\n" . $color_reset;
    exit(1);
}

echo $color_azul . "🔍 Buscando archivos ZIP con más de $dias_antiguedad días de antigüedad...\n" . $color_reset;
echo "📁 Directorio: $directorio_zips\n";
echo "\n";

// Calcular fecha límite (timestamp)
$fecha_limite = time() - ($dias_antiguedad * 24 * 60 * 60);

// Buscar archivos ZIP
$archivos = glob($directorio_zips . '*.zip');
$archivos_antiguos = [];
$total_tamano = 0;

foreach ($archivos as $archivo) {
    $fecha_modificacion = filemtime($archivo);
    
    if ($fecha_modificacion < $fecha_limite) {
        $archivos_antiguos[] = [
            'ruta' => $archivo,
            'nombre' => basename($archivo),
            'tamano' => filesize($archivo),
            'antiguedad' => floor((time() - $fecha_modificacion) / (24 * 60 * 60))
        ];
        $total_tamano += filesize($archivo);
    }
}

// Si no hay archivos antiguos
if (empty($archivos_antiguos)) {
    echo $color_verde . "✅ No hay archivos ZIP antiguos para eliminar.\n" . $color_reset;
    echo "\n";
    
    // Mostrar información de archivos actuales
    $total_archivos = count($archivos);
    if ($total_archivos > 0) {
        $tamano_total_actual = array_sum(array_map('filesize', $archivos));
        $tamano_mb = round($tamano_total_actual / (1024 * 1024), 2);
        
        echo $color_amarillo . "📊 Archivos ZIP actuales: $total_archivos\n" . $color_reset;
        echo $color_amarillo . "💾 Espacio usado: $tamano_mb MB\n" . $color_reset;
    } else {
        echo $color_amarillo . "📊 No hay archivos ZIP en el directorio.\n" . $color_reset;
    }
    
    echo "\n";
    exit(0);
}

// Mostrar archivos que serán eliminados
$cantidad = count($archivos_antiguos);
echo $color_amarillo . "🗑️  Se eliminarán $cantidad archivo(s):\n" . $color_reset;
echo "\n";

foreach ($archivos_antiguos as $archivo) {
    $tamano_kb = round($archivo['tamano'] / 1024, 2);
    echo "  📄 {$archivo['nombre']}\n";
    echo "     └─ Tamaño: $tamano_kb KB | Antigüedad: {$archivo['antiguedad']} días\n";
}

echo "\n";
echo $color_azul . "💾 Espacio a liberar: " . round($total_tamano / (1024 * 1024), 2) . " MB\n" . $color_reset;
echo "\n";

// En modo CLI interactivo, solicitar confirmación
if (php_sapi_name() === 'cli' && !isset($argv[2])) {
    echo "¿Desea eliminar estos archivos? (S/N): ";
    $handle = fopen("php://stdin", "r");
    $confirmacion = trim(fgets($handle));
    fclose($handle);
    
    if (strtoupper($confirmacion) !== 'S') {
        echo "\n";
        echo $color_amarillo . "❌ Operación cancelada. No se eliminaron archivos.\n" . $color_reset;
        echo "\n";
        exit(0);
    }
}

// Eliminar archivos
echo "\n";
echo $color_amarillo . "🗑️  Eliminando archivos...\n" . $color_reset;
echo "\n";

$eliminados = 0;
$errores = 0;

foreach ($archivos_antiguos as $archivo) {
    if (unlink($archivo['ruta'])) {
        $eliminados++;
        echo $color_verde . "  ✓ Eliminado: {$archivo['nombre']}\n" . $color_reset;
    } else {
        $errores++;
        echo $color_rojo . "  ✗ Error al eliminar: {$archivo['nombre']}\n" . $color_reset;
    }
}

echo "\n";
echo $color_verde . "✅ Limpieza completada!\n" . $color_reset;
echo $color_verde . "   Archivos eliminados: $eliminados\n" . $color_reset;

if ($errores > 0) {
    echo $color_rojo . "   ⚠️  Errores: $errores\n" . $color_reset;
}

// Mostrar estado final
$archivos_restantes = glob($directorio_zips . '*.zip');
$cantidad_restantes = count($archivos_restantes);

echo "\n";
echo $color_azul . "📊 Archivos restantes: $cantidad_restantes\n" . $color_reset;

if ($cantidad_restantes > 0) {
    $tamano_restante = array_sum(array_map('filesize', $archivos_restantes));
    $tamano_mb = round($tamano_restante / (1024 * 1024), 2);
    echo $color_azul . "💾 Espacio usado: $tamano_mb MB\n" . $color_reset;
}

echo "\n";

// Log para cron
if (php_sapi_name() === 'cli') {
    $log_message = date('Y-m-d H:i:s') . " - Limpieza ejecutada: $eliminados archivo(s) eliminado(s), $errores error(es)\n";
    $log_file = __DIR__ . '/app/archivador/temp_zips/limpieza.log';
    file_put_contents($log_file, $log_message, FILE_APPEND);
}

exit(0);
?>
