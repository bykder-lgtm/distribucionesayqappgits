<?php 
$nombre_pagina          = "Dashboard Promotora";
$cod_seguridad_pag      = "29";
$pagina_local           = $_SERVER['PHP_SELF'];
?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include_once("../admin/01_admin_modulo_inicio_sesion_adm_promotora.php"); ?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include_once("../admin/01_info_empresa_visitante_intern_movil.php"); ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title><?php echo ($nombre_pagina) ?> - Módulo Promotora</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <?php include_once("../admin/03_modulo_css_visitante_intern_movil.php"); ?>
    <script src="../js/jquery-3.2.1.min_visitante.js"></script>
    <style>
        .dashboard-header { background: linear-gradient(135deg, #4169e1 0%, #5b7ce6 50%, #00d4ff 100%); border-radius: 20px; padding: 1.5rem; margin-bottom: 1.5rem; color: white; }
    </style>
</head>
<body>
<?php include_once("../admin/01_modulo_header_top_movil.php"); ?>
<?php // Removido el 01_modulo_encabezado_superior_visitante_intern_movil.php porque generaba variables indefinidas en el home ?>

<main class="container py-4 mb-5">
    <div class="dashboard-header animate-in">
        <h1><i class="fa fa-users"></i> Bienvenida, Promotora</h1>
        <p>Resumen de tu cuenta</p>
    </div>

    <!-- Acciones Rápidas -->
    <div class="quick-actions animate-in">
        <div style="background: linear-gradient(135deg, #1a1d3a 0%, #0a0e27 100%); padding: 2rem; border-radius: 16px; border: 1px solid rgba(65, 105, 225, 0.3); text-align: center;">
            <a href="lista_aliado_promotora_movil.php" style="color: #00d4ff; text-decoration: none; font-size: 1.1rem;">
                <i class="fa fa-handshake-o" style="font-size: 3rem; margin-bottom: 1rem; display: block;"></i>
                Ver Información del Aliado y Créditos
            </a>
        </div>
    </div>
</main>

<?php include_once("../menu/05_modulo_menu_promotora_movil.php"); ?>
</body>
</html>
