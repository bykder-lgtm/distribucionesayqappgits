# =============================================================
# Script: Cambiar colores del módulo Líder (Verde → Púrpura/Violeta)
# =============================================================
# Mapeo de colores:
#   #059669 (emerald-600) → #8b5cf6 (violet-500)
#   #0d9488 (teal-600)    → #7c3aed (violet-600)
#   #047857 (emerald-700)  → #6d28d9 (violet-700)
#   rgba(5, 150, 105, ...) → rgba(139, 92, 246, ...)
# =============================================================

$paths = @(
    "c:\xampp\htdocs\sistemaseditaxe\mysqli\distribucionesayqapp\app\admin",
    "c:\xampp\htdocs\sistemaseditaxe\mysqli\distribucionesayqapp\app\menu"
)

# Collect all lider files
$files = @()
foreach ($p in $paths) {
    $files += Get-ChildItem -Path $p -Filter "*lider*" -File
}

Write-Host "=============================================="
Write-Host " Cambio de colores: Modulo Lider"
Write-Host " Verde (#059669) -> Purpura (#8b5cf6)"
Write-Host "=============================================="
Write-Host "Archivos encontrados: $($files.Count)"
Write-Host ""

$updatedCount = 0

foreach ($file in $files) {
    $content = [System.IO.File]::ReadAllText($file.FullName)
    $original = $content
    
    # --- Replace main green UI colors with purple/violet ---
    
    # Primary: #059669 → #8b5cf6
    $content = $content -replace '#059669', '#8b5cf6'
    
    # Secondary: #0d9488 → #7c3aed
    $content = $content -replace '#0d9488', '#7c3aed'
    
    # Dark: #047857 → #6d28d9
    $content = $content -replace '#047857', '#6d28d9'
    
    # RGBA values: rgba(5, 150, 105, ...) → rgba(139, 92, 246, ...)
    $content = $content -replace 'rgba\(5, 150, 105', 'rgba(139, 92, 246'
    $content = $content -replace 'rgba\(5,150,105', 'rgba(139, 92, 246'
    
    # Check if anything changed
    if ($content -ne $original) {
        [System.IO.File]::WriteAllText($file.FullName, $content)
        $updatedCount++
        Write-Host "  [ACTUALIZADO] $($file.Name)"
    } else {
        Write-Host "  [SIN CAMBIOS] $($file.Name)"
    }
}

Write-Host ""
Write-Host "=============================================="
Write-Host " Resultado: $updatedCount archivos actualizados"
Write-Host "=============================================="
