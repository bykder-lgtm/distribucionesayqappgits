# =============================================================
# Script para crear el modulo del LIDER basado en el COORDINADOR
# =============================================================
# Color del Coordinador: Azul Indigo (#6366f1, #4f46e5, #4338ca, #6258AC)
# Color del Lider: Verde Esmeralda/Teal (#059669, #0d9488, #047857, #10b981)
# =============================================================

$ErrorActionPreference = "Stop"

$adminDir = "c:\xampp\htdocs\sistemaseditaxe\mysqli\distribucionesayqapp\app\admin"
$menuDir = "c:\xampp\htdocs\sistemaseditaxe\mysqli\distribucionesayqapp\app\menu"
$cssDir = "c:\xampp\htdocs\sistemaseditaxe\mysqli\distribucionesayqapp\app\estilo_css"

$filesCreated = 0
$filesSkipped = 0

# --- 1. COPIES FROM ADMIN DIR ---
Write-Host "`n=== Procesando archivos del admin (coordinador -> lider) ===" -ForegroundColor Green

$coordFiles = Get-ChildItem -Path $adminDir -Name -Filter "*coordinador*"

foreach ($file in $coordFiles) {
    $newName = $file -replace "coordinador", "lider"
    $sourcePath = Join-Path $adminDir $file
    $destPath = Join-Path $adminDir $newName
    
    # Skip if already exists
    if (Test-Path $destPath) {
        Write-Host "  [SKIP] $newName (ya existe)" -ForegroundColor Yellow
        $filesSkipped++
        continue
    }
    
    # Read the source file
    $content = Get-Content -Path $sourcePath -Raw -Encoding UTF8
    
    # Replace text references (case-insensitive where needed)
    $content = $content -replace "coordinador", "lider"
    $content = $content -replace "Coordinador", "Lider"
    $content = $content -replace "COORDINADOR", "LIDER"
    
    # Replace coordinador color theme (#6366f1 indigo -> #059669 emerald)
    # Primary colors
    $content = $content -replace "#6366f1", "#059669"
    $content = $content -replace "#4f46e5", "#0d9488"
    $content = $content -replace "#4338ca", "#047857"
    $content = $content -replace "#818cf8", "#34d399"
    $content = $content -replace "#6258AC", "#059669"
    
    # RGBA values for indigo -> emerald
    $content = $content -replace "rgba\(99, 102, 241,", "rgba(5, 150, 105,"
    $content = $content -replace "rgba\(129, 140, 248,", "rgba(52, 211, 153,"
    
    # Background dark gradient (keep similar dark backgrounds but with green tint)
    $content = $content -replace "#393942", "#1a2e2a"
    
    # Dashboard title
    $content = $content -replace "Dashboard Lider", "Dashboard Lider"
    $content = $content -replace "TEMA AZUL INDIGO", "TEMA VERDE ESMERALDA"
    
    # Write the file
    Set-Content -Path $destPath -Value $content -Encoding UTF8 -NoNewline
    Write-Host "  [OK] $newName" -ForegroundColor Green
    $filesCreated++
}

# --- 2. CREATE MENU MOVIL FILE ---
Write-Host "`n=== Procesando menu movil ===" -ForegroundColor Green

$menuSource = Join-Path $menuDir "05_modulo_menu_coordinador_movil.php"
$menuDest = Join-Path $menuDir "05_modulo_menu_lider_movil.php"

if (Test-Path $menuDest) {
    Write-Host "  [SKIP] 05_modulo_menu_lider_movil.php (ya existe)" -ForegroundColor Yellow
    $filesSkipped++
} else {
    $content = Get-Content -Path $menuSource -Raw -Encoding UTF8
    $content = $content -replace "coordinador", "lider"
    $content = $content -replace "Coordinador", "Lider"
    $content = $content -replace "COORDINADOR", "LIDER"
    $content = $content -replace "#6366f1", "#059669"
    $content = $content -replace "#4f46e5", "#0d9488"
    $content = $content -replace "#4338ca", "#047857"
    $content = $content -replace "#818cf8", "#34d399"
    $content = $content -replace "#6258AC", "#059669"
    $content = $content -replace "rgba\(99, 102, 241,", "rgba(5, 150, 105,"
    $content = $content -replace "rgba\(129, 140, 248,", "rgba(52, 211, 153,"
    $content = $content -replace "#393942", "#1a2e2a"
    Set-Content -Path $menuDest -Value $content -Encoding UTF8 -NoNewline
    Write-Host "  [OK] 05_modulo_menu_lider_movil.php" -ForegroundColor Green
    $filesCreated++
}

# --- 3. CREATE CSS FILES FOR LIDER ---
Write-Host "`n=== Procesando archivos CSS ===" -ForegroundColor Green

# custom_adm_tick_lider.css (from coordinador)
$cssSource1 = Join-Path $cssDir "custom_adm_tick_coordinador.css"
$cssDest1 = Join-Path $cssDir "custom_adm_tick_lider.css"

if (Test-Path $cssDest1) {
    Write-Host "  [SKIP] custom_adm_tick_lider.css (ya existe)" -ForegroundColor Yellow
    $filesSkipped++
} else {
    $content = Get-Content -Path $cssSource1 -Raw -Encoding UTF8
    $content = $content -replace "#6258AC", "#059669"
    $content = $content -replace "#393942", "#1a2e2a"
    $content = $content -replace "#6366f1", "#059669"
    $content = $content -replace "#4f46e5", "#0d9488"
    Set-Content -Path $cssDest1 -Value $content -Encoding UTF8 -NoNewline
    Write-Host "  [OK] custom_adm_tick_lider.css" -ForegroundColor Green
    $filesCreated++
}

# custom_theme_adm_tick_lider.css (from coordinador)
$cssSource2 = Join-Path $cssDir "custom_theme_adm_tick_coordinador.css"
$cssDest2 = Join-Path $cssDir "custom_theme_adm_tick_lider.css"

if (Test-Path $cssDest2) {
    Write-Host "  [SKIP] custom_theme_adm_tick_lider.css (ya existe)" -ForegroundColor Yellow
    $filesSkipped++
} else {
    $content = Get-Content -Path $cssSource2 -Raw -Encoding UTF8
    $content = $content -replace "#6258AC", "#059669"
    $content = $content -replace "#393942", "#1a2e2a"
    $content = $content -replace "#6366f1", "#059669"
    $content = $content -replace "#4f46e5", "#0d9488"
    $content = $content -replace "rgba\(98, 88, 172,", "rgba(5, 150, 105,"
    $content = $content -replace "Azul oscuro base", "Verde esmeralda base"
    $content = $content -replace "Azul primario", "Verde primario"
    $content = $content -replace "rpura/Azul claro", "Verde claro"
    $content = $content -replace "Azul medio", "Verde medio"
    $content = $content -replace "PALETA DE COLORES BASADA EN LA IMAGEN", "PALETA DE COLORES - MODULO LIDER"
    Set-Content -Path $cssDest2 -Value $content -Encoding UTF8 -NoNewline
    Write-Host "  [OK] custom_theme_adm_tick_lider.css" -ForegroundColor Green
    $filesCreated++
}

# --- 4. FIX THE EXISTING LIDER CSS MODULE TO POINT TO LIDER CSS FILES ---
Write-Host "`n=== Actualizando archivos existentes del lider ===" -ForegroundColor Green

$liderCssModule = Join-Path $adminDir "02_admin_modulo_estilo_css_adm_lider.php"
if (Test-Path $liderCssModule) {
    $content = Get-Content -Path $liderCssModule -Raw -Encoding UTF8
    $content = $content -replace "custom_adm_tick_revisor\.css", "custom_adm_tick_lider.css"
    $content = $content -replace "custom_theme_adm_tick_revisor\.css", "custom_theme_adm_tick_lider.css"
    Set-Content -Path $liderCssModule -Value $content -Encoding UTF8 -NoNewline
    Write-Host "  [UPDATED] 02_admin_modulo_estilo_css_adm_lider.php (ahora apunta a CSS del lider)" -ForegroundColor Cyan
}

# --- 5. UPDATE THE LIDER MENU NAVIGATION TO INCLUDE ALL SECTIONS ---
Write-Host "`n=== Actualizando menu de navegacion del lider ===" -ForegroundColor Green

$liderMenuNav = Join-Path $adminDir "03_admin_modulo_menu_navegacion_adm_lider.php"
if (Test-Path $liderMenuNav) {
    # Rewrite the menu to include all sections the coordinator has PLUS extra ones for the lider
    $menuContent = @'
        <div class="container body">
            <div class="main_container">
                <div class="col-md-3 left_col">
                    <div class="left_col scroll-view">

                        <div class="navbar nav_title" style="border: 0;"><a href="#" class="site_title"><!--<i class="fa fa-ticket"></i>--><img src="<?php echo $url_img_orig_tienda;?>" style="height: 70px" alt="Logo"></i> <!--<span>DentaClic</span>--></a></div>
                        <div class="clearfix"></div>

                            <!-- menu profile quick info -->
                                <div class="profile clearfix">
                                    <div class="profile_pic">
                                        <img src="<?php echo $url_img_foto_prof_min_usuario;?>" alt="<?php echo $nombres_usuario;?>" class="img-circle profile_img">
                                    </div>
                                    <div class="profile_info"><span>Bienvenido,</span><h2><?php echo $nombres_usuario.' '.$apellidos_usuario;?></h2></div>
                                </div>
                            <!-- /menu profile quick info -->

                        <br />

        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu"><!-- sidebar menu -->
            <div class="menu_section">
                <ul class="nav side-menu">
<li class=""><a href="../admin/lista_info_factura_venta_lider_diseno_vertical.php"><i class="fa fa-list-alt"></i> Lista de Creditos</a></li>
<li class=""><a href="../admin/lista_aliado_lider_diseno_vertical.php"><i class="fa fa-users"></i> Lista de Aliados</a></li>
<li class=""><a href="../admin/lista_tienda_lider_diseno_vertical.php"><i class="fa fa-store"></i> Lista de Tiendas</a></li>
<li class=""><a href="../admin/lista_producto_lider_diseno_vertical.php"><i class="fa fa-boxes-stacked"></i> Lista de Productos</a></li>
                </ul>
            </div>
        </div><!-- /sidebar menu -->

    </div>
</div> 
     
    <div class="top_nav"><!-- top navigation -->
        <div class="nav_menu">

            <nav>
                <div class="nav toggle"><a id="menu_toggle"><i class="fa fa-bars"></i></a></div>
                <ul class="nav navbar-nav navbar-right">
                    <li class="">
                        <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <img src="<?php echo $url_img_foto_prof_min_usuario;?>" alt=""><?php echo $nombres_usuario.' '.$apellidos_usuario;?>
                            <span class=" fa fa-angle-down"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-usermenu pull-right">
                            <!--<li><a href="../admin/usuario.php"><i class="fa fa-user"></i> Mi cuenta</a></li>-->
                            <li><a href="../session/salir_visitante_intern.php?token=<?php echo $token ?>"><i class="fa fa-sign-out pull-right"></i> Cerrar Sesión</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>

        </div>
    </div><!-- /top navigation -->    
'@
    Set-Content -Path $liderMenuNav -Value $menuContent -Encoding UTF8 -NoNewline
    Write-Host "  [UPDATED] 03_admin_modulo_menu_navegacion_adm_lider.php (menu completo del lider)" -ForegroundColor Cyan
}

Write-Host "`n========================================" -ForegroundColor Magenta
Write-Host "  Archivos creados: $filesCreated" -ForegroundColor Green
Write-Host "  Archivos omitidos (ya existian): $filesSkipped" -ForegroundColor Yellow
Write-Host "========================================`n" -ForegroundColor Magenta
