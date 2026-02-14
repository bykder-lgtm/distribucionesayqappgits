$basePath = "c:\xampp\htdocs\sistemaseditaxe\mysqli\distribucionesayqapp\app"

# Define file mapping: source -> destination
$fileMapping = @{
    # Session & Info modules
    "admin\01_admin_modulo_inicio_sesion_adm_asesor.php" = "admin\01_admin_modulo_inicio_sesion_adm_coordinador.php"
    "admin\01_admin_modulo_info_empresa_adm_asesor.php" = "admin\01_admin_modulo_info_empresa_adm_coordinador.php"
    
    # Main pages
    "admin\dashboard_asesor_movil.php" = "admin\dashboard_coordinador_movil.php"
    "admin\lista_aliado_asesor_movil.php" = "admin\lista_aliado_coordinador_movil.php"
    "admin\lista_tienda_asesor_movil.php" = "admin\lista_tienda_coordinador_movil.php"
    "admin\lista_producto_asesor_movil.php" = "admin\lista_producto_coordinador_movil.php"
    "admin\lista_info_factura_venta_asesor_movil.php" = "admin\lista_info_factura_venta_coordinador_movil.php"
    "admin\lista_consultas_asesor_movil.php" = "admin\lista_consultas_coordinador_movil.php"
    "admin\lista_notificacion_alerta_renovacion_asesor_movil.php" = "admin\lista_notificacion_alerta_renovacion_coordinador_movil.php"
    "admin\config_asesor_movil.php" = "admin\config_coordinador_movil.php"
    "admin\cambiar_contrasena_asesor_movil.php" = "admin\cambiar_contrasena_coordinador_movil.php"
    "admin\edit_perfil_asesor.php" = "admin\edit_perfil_coordinador.php"
    "admin\entrar_asesor_intern.php" = "admin\entrar_coordinador_intern.php"
    
    # AJAX scripts
    "admin\actualizar_perfil_asesor_ajax.php" = "admin\actualizar_perfil_coordinador_ajax.php"
    "admin\cambiar_contrasena_asesor_ajax.php" = "admin\cambiar_contrasena_coordinador_ajax.php"
    "admin\reg_aliado_modal_asesor_ajax_reg.php" = "admin\reg_aliado_modal_coordinador_ajax_reg.php"
    "admin\act_aliado_modal_asesor_ajax_reg.php" = "admin\act_aliado_modal_coordinador_ajax_reg.php"
    "admin\reg_tienda_modal_asesor_ajax_reg.php" = "admin\reg_tienda_modal_coordinador_ajax_reg.php"
    "admin\reg_tienda_modal_asesor_movil_ajax_reg.php" = "admin\reg_tienda_modal_coordinador_movil_ajax_reg.php"
    "admin\reg_edit_tienda_modal_asesor_movil_ajax_reg.php" = "admin\reg_edit_tienda_modal_coordinador_movil_ajax_reg.php"
    "admin\reg_edit_tienda_modal_asesor_movil_ajax_edit.php" = "admin\reg_edit_tienda_modal_coordinador_movil_ajax_edit.php"
    "admin\edit_tienda_modal_asesor_ajax_reg.php" = "admin\edit_tienda_modal_coordinador_ajax_reg.php"
    "admin\edit_tienda_modal_asesor_movil_ajax_reg.php" = "admin\edit_tienda_modal_coordinador_movil_ajax_reg2.php"
    "admin\reg_producto_modal_asesor_ajax_reg.php" = "admin\reg_producto_modal_coordinador_ajax_reg.php"
    "admin\edit_producto_modal_asesor_ajax_reg.php" = "admin\edit_producto_modal_coordinador_ajax_reg.php"
    "admin\get_producto_modal_asesor_ajax.php" = "admin\get_producto_modal_coordinador_ajax.php"
    "admin\get_tienda_modal_asesor_ajax.php" = "admin\get_tienda_modal_coordinador_ajax.php"
    "admin\agregar_banco_tienda_asesor_ajax.php" = "admin\agregar_banco_tienda_coordinador_ajax.php"
    "admin\agregar_vendedor_tienda_asesor_ajax.php" = "admin\agregar_vendedor_tienda_coordinador_ajax.php"
    "admin\reg_banco_modal_asesor_movil_ajax.php" = "admin\reg_banco_modal_coordinador_movil_ajax.php"
    
    # Vertical design pages
    "admin\lista_aliado_asesor_diseno_vertical.php" = "admin\lista_aliado_coordinador_diseno_vertical.php"
    "admin\lista_tienda_asesor_diseno_vertical.php" = "admin\lista_tienda_coordinador_diseno_vertical.php"
    "admin\lista_producto_asesor_diseno_vertical.php" = "admin\lista_producto_coordinador_diseno_vertical.php"
    "admin\lista_info_factura_venta_asesor_diseno_vertical.php" = "admin\lista_info_factura_venta_coordinador_diseno_vertical.php"
    
    # AJAX search/pagination
    "admin\tabla_busqueda_paginacion_aliado_asesor_diseno_vertical_ajax.php" = "admin\tabla_busqueda_paginacion_aliado_coordinador_diseno_vertical_ajax.php"
    "admin\tabla_busqueda_paginacion_aliado_asesor_diseno_vertical_modo_tienda_detalle_ajax.php" = "admin\tabla_busqueda_paginacion_aliado_coordinador_diseno_vertical_modo_tienda_detalle_ajax.php"
    "admin\tabla_busqueda_paginacion_info_factura_venta_asesor_diseno_vertical_ajax.php" = "admin\tabla_busqueda_paginacion_info_factura_venta_coordinador_diseno_vertical_ajax.php"
    "admin\tabla_busqueda_paginacion_producto_asesor_diseno_vertical_ajax.php" = "admin\tabla_busqueda_paginacion_producto_coordinador_diseno_vertical_ajax.php"
    "admin\tabla_busqueda_paginacion_tienda_asesor_diseno_vertical_ajax.php" = "admin\tabla_busqueda_paginacion_tienda_coordinador_diseno_vertical_ajax.php"
    
    # Menu
    "menu\05_modulo_menu_asesor_movil.php" = "menu\05_modulo_menu_coordinador_movil.php"
    
    # CSS
    "estilo_css\custom_adm_tick_asesor.css" = "estilo_css\custom_adm_tick_coordinador.css"
    "estilo_css\custom_theme_adm_tick_asesor.css" = "estilo_css\custom_theme_adm_tick_coordinador.css"
}

# Also handle the _viejo file if it exists
$viejoSrc = "admin\tabla_busqueda_paginacion_info_factura_venta_asesor_diseno_vertical_ajax_viejo.php"
$viejoDst = "admin\tabla_busqueda_paginacion_info_factura_venta_coordinador_diseno_vertical_ajax_viejo.php"
if (Test-Path (Join-Path $basePath $viejoSrc)) {
    $fileMapping[$viejoSrc] = $viejoDst
}

# Additional module files
$additionalFiles = @{
    "admin\02_admin_modulo_estilo_css_adm_asesor.php" = "admin\02_admin_modulo_estilo_css_adm_coordinador.php"
    "admin\03_admin_modulo_menu_navegacion_adm_asesor.php" = "admin\03_admin_modulo_menu_navegacion_adm_coordinador.php"
    "admin\04_admin_modulo_footer_adm_asesor.php" = "admin\04_admin_modulo_footer_adm_coordinador.php"
    "admin\05_admin_modulo_js_adm_asesor.php" = "admin\05_admin_modulo_js_adm_coordinador.php"
    "menu\05_modulo_menu_visitante_intern_asesor.php" = "menu\05_modulo_menu_visitante_intern_coordinador.php"
}

foreach ($key in $additionalFiles.Keys) {
    if (Test-Path (Join-Path $basePath $key)) {
        $fileMapping[$key] = $additionalFiles[$key]
    }
}

$created = 0
$skipped = 0
$errors = 0

foreach ($src in $fileMapping.Keys) {
    $srcPath = Join-Path $basePath $src
    $dstPath = Join-Path $basePath $fileMapping[$src]
    
    if (-not (Test-Path $srcPath)) {
        Write-Host "SKIP (no existe): $src" -ForegroundColor Yellow
        $skipped++
        continue
    }
    
    try {
        $content = Get-Content $srcPath -Raw -Encoding UTF8
        
        # ============================
        # 1. Replace file references (asesor -> coordinador)
        # ============================
        
        # File name references in includes, hrefs, URLs, AJAX calls
        $content = $content -replace 'dashboard_asesor_movil\.php', 'dashboard_coordinador_movil.php'
        $content = $content -replace 'lista_aliado_asesor_movil\.php', 'lista_aliado_coordinador_movil.php'
        $content = $content -replace 'lista_tienda_asesor_movil\.php', 'lista_tienda_coordinador_movil.php'
        $content = $content -replace 'lista_producto_asesor_movil\.php', 'lista_producto_coordinador_movil.php'
        $content = $content -replace 'lista_info_factura_venta_asesor_movil\.php', 'lista_info_factura_venta_coordinador_movil.php'
        $content = $content -replace 'lista_consultas_asesor_movil\.php', 'lista_consultas_coordinador_movil.php'
        $content = $content -replace 'lista_notificacion_alerta_renovacion_asesor_movil\.php', 'lista_notificacion_alerta_renovacion_coordinador_movil.php'
        $content = $content -replace 'config_asesor_movil\.php', 'config_coordinador_movil.php'
        $content = $content -replace 'cambiar_contrasena_asesor_movil\.php', 'cambiar_contrasena_coordinador_movil.php'
        $content = $content -replace 'cambiar_contrasena_asesor_ajax\.php', 'cambiar_contrasena_coordinador_ajax.php'
        $content = $content -replace 'edit_perfil_asesor\.php', 'edit_perfil_coordinador.php'
        $content = $content -replace 'actualizar_perfil_asesor_ajax\.php', 'actualizar_perfil_coordinador_ajax.php'
        $content = $content -replace 'entrar_asesor_intern\.php', 'entrar_coordinador_intern.php'
        
        # Module includes  
        $content = $content -replace '01_admin_modulo_inicio_sesion_adm_asesor\.php', '01_admin_modulo_inicio_sesion_adm_coordinador.php'
        $content = $content -replace '01_admin_modulo_info_empresa_adm_asesor\.php', '01_admin_modulo_info_empresa_adm_coordinador.php'
        $content = $content -replace '02_admin_modulo_estilo_css_adm_asesor\.php', '02_admin_modulo_estilo_css_adm_coordinador.php'
        $content = $content -replace '03_admin_modulo_menu_navegacion_adm_asesor\.php', '03_admin_modulo_menu_navegacion_adm_coordinador.php'
        $content = $content -replace '04_admin_modulo_footer_adm_asesor\.php', '04_admin_modulo_footer_adm_coordinador.php'
        $content = $content -replace '05_admin_modulo_js_adm_asesor\.php', '05_admin_modulo_js_adm_coordinador.php'
        
        # Menu includes
        $content = $content -replace '05_modulo_menu_asesor_movil\.php', '05_modulo_menu_coordinador_movil.php'
        $content = $content -replace '05_modulo_menu_visitante_intern_asesor\.php', '05_modulo_menu_visitante_intern_coordinador.php'
        
        # AJAX file references
        $content = $content -replace 'reg_aliado_modal_asesor_ajax_reg\.php', 'reg_aliado_modal_coordinador_ajax_reg.php'
        $content = $content -replace 'act_aliado_modal_asesor_ajax_reg\.php', 'act_aliado_modal_coordinador_ajax_reg.php'
        $content = $content -replace 'reg_tienda_modal_asesor_ajax_reg\.php', 'reg_tienda_modal_coordinador_ajax_reg.php'
        $content = $content -replace 'reg_tienda_modal_asesor_movil_ajax_reg\.php', 'reg_tienda_modal_coordinador_movil_ajax_reg.php'
        $content = $content -replace 'reg_edit_tienda_modal_asesor_movil_ajax_reg\.php', 'reg_edit_tienda_modal_coordinador_movil_ajax_reg.php'
        $content = $content -replace 'reg_edit_tienda_modal_asesor_movil_ajax_edit\.php', 'reg_edit_tienda_modal_coordinador_movil_ajax_edit.php'
        $content = $content -replace 'edit_tienda_modal_asesor_ajax_reg\.php', 'edit_tienda_modal_coordinador_ajax_reg.php'
        $content = $content -replace 'edit_tienda_modal_asesor_movil_ajax_reg\.php', 'edit_tienda_modal_coordinador_movil_ajax_reg2.php'
        $content = $content -replace 'reg_producto_modal_asesor_ajax_reg\.php', 'reg_producto_modal_coordinador_ajax_reg.php'
        $content = $content -replace 'edit_producto_modal_asesor_ajax_reg\.php', 'edit_producto_modal_coordinador_ajax_reg.php'
        $content = $content -replace 'get_producto_modal_asesor_ajax\.php', 'get_producto_modal_coordinador_ajax.php'
        $content = $content -replace 'get_tienda_modal_asesor_ajax\.php', 'get_tienda_modal_coordinador_ajax.php'
        $content = $content -replace 'agregar_banco_tienda_asesor_ajax\.php', 'agregar_banco_tienda_coordinador_ajax.php'
        $content = $content -replace 'agregar_vendedor_tienda_asesor_ajax\.php', 'agregar_vendedor_tienda_coordinador_ajax.php'
        $content = $content -replace 'reg_banco_modal_asesor_movil_ajax\.php', 'reg_banco_modal_coordinador_movil_ajax.php'
        
        # Desktop/vertical design file references
        $content = $content -replace 'lista_aliado_asesor_diseno_vertical\.php', 'lista_aliado_coordinador_diseno_vertical.php'
        $content = $content -replace 'lista_tienda_asesor_diseno_vertical\.php', 'lista_tienda_coordinador_diseno_vertical.php'
        $content = $content -replace 'lista_producto_asesor_diseno_vertical\.php', 'lista_producto_coordinador_diseno_vertical.php'
        $content = $content -replace 'lista_info_factura_venta_asesor_diseno_vertical\.php', 'lista_info_factura_venta_coordinador_diseno_vertical.php'
        
        # AJAX table references
        $content = $content -replace 'tabla_busqueda_paginacion_aliado_asesor_diseno_vertical_ajax\.php', 'tabla_busqueda_paginacion_aliado_coordinador_diseno_vertical_ajax.php'
        $content = $content -replace 'tabla_busqueda_paginacion_aliado_asesor_diseno_vertical_modo_tienda_detalle_ajax\.php', 'tabla_busqueda_paginacion_aliado_coordinador_diseno_vertical_modo_tienda_detalle_ajax.php'
        $content = $content -replace 'tabla_busqueda_paginacion_info_factura_venta_asesor_diseno_vertical_ajax\.php', 'tabla_busqueda_paginacion_info_factura_venta_coordinador_diseno_vertical_ajax.php'
        $content = $content -replace 'tabla_busqueda_paginacion_producto_asesor_diseno_vertical_ajax\.php', 'tabla_busqueda_paginacion_producto_coordinador_diseno_vertical_ajax.php'
        $content = $content -replace 'tabla_busqueda_paginacion_tienda_asesor_diseno_vertical_ajax\.php', 'tabla_busqueda_paginacion_tienda_coordinador_diseno_vertical_ajax.php'
        
        # CSS file references
        $content = $content -replace 'custom_adm_tick_asesor\.css', 'custom_adm_tick_coordinador.css'
        $content = $content -replace 'custom_theme_adm_tick_asesor\.css', 'custom_theme_adm_tick_coordinador.css'
        
        # ============================
        # 2. Replace text labels
        # ============================
        $content = $content -replace 'Dashboard Asesor', 'Dashboard Coordinador'
        $content = $content -replace 'Asesor Comercial', 'Coordinador'
        $content = $content -replace 'Entrar Como Asesor', 'Entrar Como Coordinador'
        $content = $content -replace 'TEMA VERDE ESMERALDA', 'TEMA AZUL INDIGO'
        $content = $content -replace 'LISTA TIENDAS ASESOR', 'LISTA TIENDAS COORDINADOR'
        $content = $content -replace 'LISTA PRODUCTOS ASESOR', 'LISTA PRODUCTOS COORDINADOR'
        $content = $content -replace 'LISTA CR..DITOS ASESOR', 'LISTA CREDITOS COORDINADOR'
        $content = $content -replace 'CONFIG ASESOR', 'CONFIG COORDINADOR'
        $content = $content -replace 'CAMBIAR PASSWORD ASESOR', 'CAMBIAR PASSWORD COORDINADOR'
        $content = $content -replace 'EDIT PERFIL ASESOR', 'EDIT PERFIL COORDINADOR'
        $content = $content -replace 'NOTIFICACIONES ASESOR', 'NOTIFICACIONES COORDINADOR'
        $content = $content -replace 'CONSULTAS ASESOR', 'CONSULTAS COORDINADOR'
        # Handle accented characters - using literal replacement
        $content = $content.Replace('LISTA CRÉDITOS ASESOR', 'LISTA CRÉDITOS COORDINADOR')
        
        # cod_administrador_asesor references in SQL
        $content = $content -replace 'cod_administrador_asesor', 'cod_administrador_coordinador'
        
        # ============================
        # 3. Replace GREEN colors with INDIGO/BLUE colors
        # ============================
        
        # Primary green colors -> Indigo
        $content = $content -replace '#10b981', '#6366f1'
        $content = $content -replace '#059669', '#4f46e5'
        $content = $content -replace '#047857', '#4338ca'
        
        # Secondary green shades
        $content = $content -replace '#22c55e', '#818cf8'
        $content = $content -replace '#34d399', '#a5b4fc'
        
        # RGBA green values -> RGBA indigo values
        # rgba(16, 185, 129, ...) -> rgba(99, 102, 241, ...)
        $content = $content -replace 'rgba\(16,\s*185,\s*129,', 'rgba(99, 102, 241,'
        $content = $content -replace 'rgba\(16, 185, 129,', 'rgba(99, 102, 241,'
        
        # rgba(5, 150, 105, ...) -> rgba(79, 70, 229, ...)
        $content = $content -replace 'rgba\(5,\s*150,\s*105,', 'rgba(79, 70, 229,'
        $content = $content -replace 'rgba\(5, 150, 105,', 'rgba(79, 70, 229,'
        
        # rgba(34, 197, 94, ...) -> rgba(129, 140, 248, ...)
        $content = $content -replace 'rgba\(34,\s*197,\s*94,', 'rgba(129, 140, 248,'
        $content = $content -replace 'rgba\(34, 197, 94,', 'rgba(129, 140, 248,'
        
        # rgba(4, 120, 87, ...) -> rgba(67, 56, 202, ...)
        $content = $content -replace 'rgba\(4,\s*120,\s*87,', 'rgba(67, 56, 202,'
        $content = $content -replace 'rgba\(4, 120, 87,', 'rgba(67, 56, 202,'
        
        # rgba(20, 184, 166, ...) -> rgba(99, 102, 241, ...) (teal to indigo)
        $content = $content -replace 'rgba\(20,\s*184,\s*166,', 'rgba(99, 102, 241,'
        $content = $content -replace 'rgba\(20, 184, 166,', 'rgba(99, 102, 241,'
        
        # Hex colors for teal variants used in some places
        $content = $content -replace '#14b8a6', '#6366f1'
        $content = $content -replace '#0d9488', '#4f46e5'
        
        # WhatsApp green in notification system -> keep as is (branding)
        # $content = $content -replace '#25D366', '#25D366'  # Keep WhatsApp green
        
        # Save the file
        $dstDir = Split-Path $dstPath -Parent
        if (-not (Test-Path $dstDir)) {
            New-Item -ItemType Directory -Path $dstDir -Force | Out-Null
        }
        
        [System.IO.File]::WriteAllText($dstPath, $content, [System.Text.Encoding]::UTF8)
        Write-Host "CREADO: $($fileMapping[$src])" -ForegroundColor Green
        $created++
    }
    catch {
        Write-Host "ERROR: $src -> $($_.Exception.Message)" -ForegroundColor Red
        $errors++
    }
}

Write-Host ""
Write-Host "========================================" -ForegroundColor Cyan
Write-Host "Resumen:" -ForegroundColor Cyan
Write-Host "  Archivos creados: $created" -ForegroundColor Green
Write-Host "  Archivos saltados: $skipped" -ForegroundColor Yellow
Write-Host "  Errores: $errors" -ForegroundColor Red
Write-Host "========================================" -ForegroundColor Cyan
