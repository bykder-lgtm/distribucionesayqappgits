#!/usr/bin/env pwsh
<#
.SYNOPSIS
    Limpia archivos ZIP temporales antiguos

.DESCRIPTION
    Este script elimina archivos ZIP en el directorio temp_zips que tengan
    más de un número específico de días de antigüedad.

.PARAMETER DiasAntiguedad
    Número de días. Los archivos con más antigüedad serán eliminados. Por defecto: 7 días

.EXAMPLE
    .\limpiar_zips_antiguos.ps1
    Elimina archivos con más de 7 días

.EXAMPLE
    .\limpiar_zips_antiguos.ps1 -DiasAntiguedad 3
    Elimina archivos con más de 3 días
#>

param(
    [int]$DiasAntiguedad = 7
)

# Obtener la ruta del directorio de ZIPs temporales
$scriptPath = Split-Path -Parent $MyInvocation.MyCommand.Path
$rutaZips = Join-Path $scriptPath "app\archivador\temp_zips"

# Verificar que el directorio existe
if (-not (Test-Path $rutaZips)) {
    Write-Host "❌ Error: No se encontró el directorio $rutaZips" -ForegroundColor Red
    exit 1
}

Write-Host "🔍 Buscando archivos ZIP con más de $DiasAntiguedad días de antigüedad..." -ForegroundColor Cyan
Write-Host "📁 Directorio: $rutaZips" -ForegroundColor Gray
Write-Host ""

# Calcular la fecha límite
$fechaLimite = (Get-Date).AddDays(-$DiasAntiguedad)

# Buscar archivos antiguos
$archivosAntiguos = Get-ChildItem -Path $rutaZips -Filter "*.zip" | 
    Where-Object { $_.LastWriteTime -lt $fechaLimite }

if ($archivosAntiguos.Count -eq 0) {
    Write-Host "✅ No hay archivos ZIP antiguos para eliminar." -ForegroundColor Green
    Write-Host ""
    
    # Mostrar información de archivos actuales
    $archivosActuales = Get-ChildItem -Path $rutaZips -Filter "*.zip"
    if ($archivosActuales.Count -gt 0) {
        Write-Host "📊 Archivos ZIP actuales: $($archivosActuales.Count)" -ForegroundColor Yellow
        $totalTamanoMB = ($archivosActuales | Measure-Object -Property Length -Sum).Sum / 1MB
        Write-Host "💾 Espacio usado: $([Math]::Round($totalTamanoMB, 2)) MB" -ForegroundColor Yellow
    } else {
        Write-Host "📊 No hay archivos ZIP en el directorio." -ForegroundColor Yellow
    }
    
    exit 0
}

# Mostrar archivos que serán eliminados
Write-Host "🗑️  Se eliminarán $($archivosAntiguos.Count) archivo(s):" -ForegroundColor Yellow
Write-Host ""

$totalTamano = 0
foreach ($archivo in $archivosAntiguos) {
    $tamanoKB = [Math]::Round($archivo.Length / 1KB, 2)
    $totalTamano += $archivo.Length
    $antiguedad = ((Get-Date) - $archivo.LastWriteTime).Days
    
    Write-Host "  📄 $($archivo.Name)" -ForegroundColor White
    Write-Host "     └─ Tamaño: $tamanoKB KB | Antigüedad: $antiguedad días" -ForegroundColor Gray
}

Write-Host ""
Write-Host "💾 Espacio a liberar: $([Math]::Round($totalTamano / 1MB, 2)) MB" -ForegroundColor Cyan
Write-Host ""

# Solicitar confirmación
$confirmacion = Read-Host "¿Desea eliminar estos archivos? (S/N)"

if ($confirmacion -eq "S" -or $confirmacion -eq "s") {
    Write-Host ""
    Write-Host "🗑️  Eliminando archivos..." -ForegroundColor Yellow
    
    $eliminados = 0
    $errores = 0
    
    foreach ($archivo in $archivosAntiguos) {
        try {
            Remove-Item -Path $archivo.FullName -Force
            $eliminados++
            Write-Host "  ✓ Eliminado: $($archivo.Name)" -ForegroundColor Green
        }
        catch {
            $errores++
            Write-Host "  ✗ Error al eliminar: $($archivo.Name)" -ForegroundColor Red
            Write-Host "    $($_.Exception.Message)" -ForegroundColor Red
        }
    }
    
    Write-Host ""
    Write-Host "✅ Limpieza completada!" -ForegroundColor Green
    Write-Host "   Archivos eliminados: $eliminados" -ForegroundColor Green
    
    if ($errores -gt 0) {
        Write-Host "   ⚠️  Errores: $errores" -ForegroundColor Red
    }
    
    # Mostrar estado final
    $archivosRestantes = Get-ChildItem -Path $rutaZips -Filter "*.zip"
    Write-Host ""
    Write-Host "📊 Archivos restantes: $($archivosRestantes.Count)" -ForegroundColor Cyan
    
    if ($archivosRestantes.Count -gt 0) {
        $tamanoRestanteMB = ($archivosRestantes | Measure-Object -Property Length -Sum).Sum / 1MB
        Write-Host "💾 Espacio usado: $([Math]::Round($tamanoRestanteMB, 2)) MB" -ForegroundColor Cyan
    }
}
else {
    Write-Host ""
    Write-Host "❌ Operación cancelada. No se eliminaron archivos." -ForegroundColor Yellow
}

Write-Host ""
