<?php 
$nombre_pagina          = "Información de Aliado";
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
        .dashboard-container { padding: 1rem; padding-bottom: 100px; }
        .info-card { background: linear-gradient(135deg, #1a1d3a 0%, #0a0e27 100%); border: 1px solid rgba(65, 105, 225, 0.3); border-radius: 16px; padding: 1.5rem; margin-bottom: 1.5rem; box-shadow: 0 4px 15px rgba(65,105,225,0.2); }
        .info-card h3 { color: #00d4ff; font-size: 1.25rem; margin-bottom: 1rem; border-bottom: 1px solid rgba(65, 105, 225, 0.2); padding-bottom: 0.5rem; }
        
        .list-item { background: rgba(255,255,255,0.05); padding: 1rem; border-radius: 8px; margin-bottom: 0.5rem; border: 1px solid rgba(65,105,225,0.1); }
        .list-item h4 { color: white; font-size: 1rem; margin: 0 0 0.5rem 0; }
        .list-item p { color: rgba(255,255,255,0.7); margin: 0; font-size: 0.85rem; }
    </style>
</head>
<body>
<?php include_once("../admin/01_modulo_header_top_movil.php"); ?>
<?php 
// Top navigation could be different or use default
include_once("../admin/01_modulo_encabezado_superior_visitante_intern_movil.php"); 
?>

<main class="dashboard-container">
    <div style="background: linear-gradient(135deg, #4169e1 0%, #5b7ce6 100%); border-radius: 20px; padding: 1.5rem; margin-bottom: 1.5rem;">
        <h2 style="color: white; margin: 0;"><i class="fa fa-handshake-o"></i> Mi Aliado</h2>
    </div>

    <?php
    $sql_aliado = "SELECT a.cod_administrador, a.nombres, a.apellidos, a.cedula, a.correo FROM tbl15_administrador a WHERE a.cod_administrador = '$cod_aliado_estrategico'";
    $res_aliado = mysqli_query($conectar, $sql_aliado);
    if($aliado = mysqli_fetch_assoc($res_aliado)) {
    ?>
    <div class="info-card">
        <h3><i class="fa fa-user"></i> Datos del Aliado</h3>
        <p style="color:white; margin-bottom:5px;"><strong>Nombre:</strong> <?php echo $aliado['nombres'].' '.$aliado['apellidos']; ?></p>
        <p style="color:white; margin-bottom:5px;"><strong>Cédula:</strong> <?php echo $aliado['cedula']; ?></p>
        <p style="color:white; margin-bottom:5px;"><strong>Correo:</strong> <?php echo $aliado['correo']; ?></p>
    </div>

    <div class="info-card">
        <h3><i class="fa fa-file-pdf-o"></i> Documentos Cargados</h3>
        <?php
        $sql_docs = "SELECT nombre_archivo, url_archivo FROM tbl15_documentacion_aliado WHERE cod_administrador = '$cod_aliado_estrategico'";
        $res_docs = mysqli_query($conectar, $sql_docs);
        if($res_docs && mysqli_num_rows($res_docs) > 0) {
            while($doc = mysqli_fetch_assoc($res_docs)) { echo '<div class="list-item"><h4><a href="'.$doc['url_archivo'].'" style="color:#00d4ff;" target="_blank"><i class="fa fa-download"></i> '.$doc['nombre_archivo'].'</a></h4></div>'; }
        } else {
            echo '<p style="color: white;">No hay documentos registrados para este aliado.</p>';
        }
        ?>
    </div>

    <div class="info-card">
        <h3><i class="fa fa-credit-card"></i> Créditos del Aliado</h3>
        <?php
        $sql_cred = "SELECT ifv.cod_info_factura_venta, ifv.monto_deuda, ifv.fecha_ymdhis, ifv.nombre_estado_factura FROM tbl15_info_factura_venta ifv INNER JOIN tbl15_tienda t ON ifv.cod_tienda = t.cod_tienda WHERE ifv.cod_administrador_aliado_estrategico = '$cod_aliado_estrategico' ORDER BY ifv.fecha_ymdhis DESC LIMIT 10";
        $res_cred = mysqli_query($conectar, $sql_cred);
        if($res_cred && mysqli_num_rows($res_cred) > 0) {
            while($cred = mysqli_fetch_assoc($res_cred)) {
                echo '<div class="list-item">
                        <h4>Crédito #'.$cred['cod_info_factura_venta'].'</h4>
                        <p><strong>Monto:</strong> $'.number_format($cred['monto_deuda']).' - <strong>Estado:</strong> '.$cred['nombre_estado_factura'].'</p>
                        <p><small>'.$cred['fecha_ymdhis'].'</small></p>
                      </div>';
            }
        } else {
            echo '<p style="color: white;">No hay créditos asociados a este aliado.</p>';
        }
        ?>
    </div>
    
    <?php } else { ?>
        <p style="color: white;">No se encontró información del aliado vinculado.</p>
    <?php } ?>

</main>

<?php include_once("../menu/05_modulo_menu_promotora_movil.php"); ?>
<?php //include_once("../admin/10_modulo_sin_js_visitante_intern_movil.php"); ?>
</body>
</html>
