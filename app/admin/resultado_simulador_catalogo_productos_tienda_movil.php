<?php
error_reporting(E_ALL & ~E_NOTICE);
include_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../admin/detectar_tipo_dispositivo.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");

$nombre_pagina          = "Resulatdo Simulacion de Crédito";
$cod_seguridad_pag      = "1";
$pagina_local           = $_SERVER['PHP_SELF'];
$cod_base_caja          = "1";
?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include_once("../admin/01_info_empresa_visitante_intern_movil.php"); ?>
<!-- **************************************************** MODULO DE INFO EMPRESA ******************************************** -->
<?php //include_once("../admin/01_rastreador.php"); ?>

<!DOCTYPE html>
<html lang="es">
<!-- Basic -->
<head>
<title><?php echo ($nombre_pagina) ?> - <?php echo ($keywords) ?> - <?php echo ($titulo) ?></title>
<meta http-equiv="Content-Type"        content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible"     content="IE=edge">
<meta name="viewport"                  content="width=device-width, initial-scale=1">
<meta name="keywords"                  content="<?php echo $keywords ?>">
<meta name="description"               content="<?php echo $nombre_pagina ?>">
<meta name="author"                    content="<?php echo $author ?>">
<meta property="og:url"                content="<?php echo $pagina_local ?>" />
<meta property="og:type"               content="website" />
<meta property="og:title"              content="<?php echo $nombre_pagina ?>" />
<meta property="og:description"        content="<?php echo $nombre_pagina ?>" />
<meta property="og:image"              content="<?php echo ($url_pag) ?>/<?php echo ($nombre_carpeta_pagina) ?>/imagenes/quienes_somos.jpg" />
<meta property="og:site_name"          content="<?php echo $nombre ?>"/>
<meta property="fb:admins"             content="editaxe"/>
<meta name="twitter:card"              content="<?php echo $nombre_pagina ?>">
<meta name="twitter:url"               contnet="<?php echo $pagina_local ?>">
<meta name="twitter:title"             content="<?php echo $nombre_pagina ?>">
<meta name="twitter:description"       content="<?php echo $descripcion_producto ?>">
<meta name="twitter:image"             content="<?php echo ($url_pag) ?>/<?php echo ($nombre_carpeta_pagina) ?>/imagenes/quienes_somos.jpg">

<?php include_once("../admin/03_modulo_css_visitante_intern_movil.php"); ?>
<link rel="stylesheet" href="../estilo_css/modal_solicitud_credito.css">
<script src="../js/jquery-3.2.1.min_visitante.js"></script>

<style>
/* Estilos para el acordeón */
.acordeon-simulador {
    border-radius: 12px;
    overflow: hidden;
}
.acordeon-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    cursor: pointer;
    padding: 0;
    transition: background 0.3s ease;
}
.acordeon-header:hover {
    background: rgba(255, 255, 255, 0.05);
}
.acordeon-header h3 {
    margin: 0;
    flex: 1;
}
.acordeon-icon {
    font-size: 1rem;
    transition: transform 0.3s ease;
    color: #667eea;
}
.acordeon-icon.rotated {
    transform: rotate(180deg);
}
.acordeon-content {
    padding-top: 1rem;
    animation: slideDown 0.3s ease;
}
@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>

<script>
function toggleAcordeon(header) {
    var content = header.nextElementSibling;
    var icon = header.querySelector('.acordeon-icon');
    
    if (content.style.display === 'none') {
        content.style.display = 'block';
        icon.classList.add('rotated');
    } else {
        content.style.display = 'none';
        icon.classList.remove('rotated');
    }
}
</script>

</head>
<body>
<?php include_once("../admin/01_modulo_encabezado_superior_visitante_intern_movil.php"); ?>

<?php
if (isset($_REQUEST['nombre_tipo_origen_simulacion'])) { 

    $nombre_tipo_origen_simulacion            = addslashes($_REQUEST['nombre_tipo_origen_simulacion']);
    if (isset($_REQUEST['cod_categoria'])) { $cod_categoria = intval($_REQUEST['cod_categoria']); } else { $cod_categoria = 2; }
    if (isset($_REQUEST['cod_entidad_crediticia'])) { $cod_entidad_crediticia = addslashes($_REQUEST['cod_entidad_crediticia']); } else { $cod_entidad_crediticia = '0'; }
    if (isset($_REQUEST['cod_tipo_cobro'])) { $cod_tipo_cobro = addslashes($_REQUEST['cod_tipo_cobro']); } else { $cod_tipo_cobro = '4'; }
    if (isset($_REQUEST['cod_meses_credito'])) { $cod_meses_credito = addslashes($_REQUEST['cod_meses_credito']); } else { $cod_meses_credito = '1'; }
    if (isset($_REQUEST['cod_tipo_simulacion_credito'])) { $cod_tipo_simulacion_credito = intval($_REQUEST['cod_tipo_simulacion_credito']); } else { $cod_tipo_simulacion_credito = 1; }
    //if (isset($_REQUEST['valor_credito'])) { $valor_credito = addslashes($_REQUEST['valor_credito']); } else { $valor_credito = $precio_venta_producto; }
    //---------------------------------------------------------------------------------------------------------------------------------//
    $sql_entidad_crediticia_predeterminada_interes_defect = "SELECT entidad_crediticia_interes_ptj FROM tbl15_entidad_crediticia WHERE cod_estado_entidad_predeterminada_interes_defect = '1'";
    $consulta_entidad_crediticia_predeterminada_interes_defect = mysqli_query($conectar, $sql_entidad_crediticia_predeterminada_interes_defect) or die(mysqli_error($conectar));
    $matriz_entidad_crediticia_predeterminada_interes_defect = mysqli_fetch_assoc($consulta_entidad_crediticia_predeterminada_interes_defect);

    $entidad_crediticia_interes_ptj                                   = $matriz_entidad_crediticia_predeterminada_interes_defect['entidad_crediticia_interes_ptj'];
    $cod_aliado_estrategico                                           = $cod_administrador;
    //---------------------------------------------------------------------------------------------------------------------------------//
    // Determinar origen de la simulación
    //---------------------------------------------------------------------------------------------------------------------------------//
    if ($nombre_tipo_origen_simulacion == 'TIENDA_VIRTUAL' || $nombre_tipo_origen_simulacion == 'TIENDA_VIRTUAL_MOVIL') {
        $cod_producto_codifcryp                                       = ($_REQUEST['cod_producto_codifcryp']);
        $cod_producto_codif                                           = DAXCODIFCRYPTOR::descriptardax($cod_producto_codifcryp);
        $cod_producto                                                 = intval(DAXCODIFCRYPTOR::descodifdax($cod_producto_codif));

        $sql_producto = "SELECT cod_producto, cod_producto_barra, nombre_producto, und_producto, precio_venta_producto, descripcion_producto, 
        precio_venta_producto2, url_img_min_producto, url_img_orig_producto, nombre_promocion, nombre_promocion_ing, 
        cod_categoria, cod_estado, cod_tienda FROM tbl15_producto WHERE (cod_producto = '$cod_producto')";
        $consulta_producto = mysqli_query($conectar, $sql_producto) or die(mysqli_error($conectar));
        $datos_producto = mysqli_fetch_assoc($consulta_producto);

        $cod_producto_barra                                           = $datos_producto['cod_producto_barra'];
        $nombre_producto                                              = $datos_producto['nombre_producto'];
        $precio_venta_producto                                        = $datos_producto['precio_venta_producto'];
        $cod_categoria                                                = $datos_producto['cod_categoria'];
        $cod_tienda                                                   = $datos_producto['cod_tienda'];

        $sql_tienda = "SELECT cod_aliado_estrategico FROM tbl15_tienda WHERE (cod_tienda = '$cod_tienda')";
        $consulta_tienda = mysqli_query($conectar, $sql_tienda) or die(mysqli_error($conectar));
        $datos_tienda = mysqli_fetch_assoc($consulta_tienda);

         $cod_aliado_estrategico                                      = $datos_tienda['cod_aliado_estrategico'];

        // Solo aplicar interés si es precio de contado (cod_tipo_simulacion_credito == 1)
        if ($cod_tipo_simulacion_credito == 1 || $cod_tipo_simulacion_credito == 0) {
            $precio_venta_producto_mas_comision_funcionamiento        = round($precio_venta_producto / ((100/100) - ($entidad_crediticia_interes_ptj/100)), -3);
            $precio_venta_contado_visual                              = $precio_venta_producto;
        } else {
            // Si es precio a crédito, el valor ya incluye el interés
            $precio_venta_producto_mas_comision_funcionamiento        = $precio_venta_producto;
            $precio_venta_contado_visual                              = round($precio_venta_producto * ((100/100) - ($entidad_crediticia_interes_ptj/100)), -3);
        }
    } elseif ($nombre_tipo_origen_simulacion == 'SIMULACION_VALOR_LIBRE') {
        $cod_producto_barra                                           = "";
        $nombre_producto                                              = strtoupper(addslashes($_REQUEST['nombre_producto']));
        $precio_venta_producto                                        = intval($_REQUEST['precio_venta_producto']);
        $cod_producto_codifcryp                                       = ''; 
        $cod_producto_codif                                           = ''; 
        $cod_producto                                                 = ''; 
        $cod_categoria                                                = ''; 
        $cod_tienda                                                   = '';
        
        // Para simulación libre, obtener el cod_aliado_estrategico desde la sesión del usuario
        // Si el usuario es un aliado (cod_seguridad == 23), usar su cod_administrador
        /*
        if ($cod_seguridad == '23') {
            $cod_aliado_estrategico                                   = $cod_administrador;
        } else {
            // Si no es aliado, intentar obtener desde el parámetro o usar valor por defecto
            if (isset($_REQUEST['cod_aliado_estrategico'])) {
                $cod_aliado_estrategico                               = intval($_REQUEST['cod_aliado_estrategico']);
            } else {
                // Si no hay parámetro, obtener del administrador en sesión
                $cod_aliado_estrategico                               = $cod_administrador;
            }
        }
        */
        
        if ($cod_tipo_simulacion_credito == 1 || $cod_tipo_simulacion_credito == 0) {
            $precio_venta_producto_mas_comision_funcionamiento        = round($precio_venta_producto / ((100/100) - ($entidad_crediticia_interes_ptj/100)), -3);
            $precio_venta_contado_visual                              = $precio_venta_producto;
        } else {
            // Si es precio a crédito, el valor ya incluye el interés
            $precio_venta_producto_mas_comision_funcionamiento        = $precio_venta_producto;
            $precio_venta_contado_visual                              = round($precio_venta_producto * ((100/100) - ($entidad_crediticia_interes_ptj/100)), -3);
        }
    } else {
        $cod_producto_barra                                           = "";
        $nombre_producto                                              = "";
        $precio_venta_producto                                        = 0;
        $cod_producto_codifcryp                                       = ''; 
        $cod_producto_codif                                           = ''; 
        $cod_producto                                                 = ''; 
        $cod_categoria                                                = ''; 
        $precio_venta_producto_mas_comision_funcionamiento            = 0;
        $precio_venta_contado_visual                                  = 0;
    }
    //---------------------------------------------------------------------------------------------------------------------------------//
    $valor_credito                                                    = $precio_venta_producto_mas_comision_funcionamiento;

    $sql_tipo_cobro = "SELECT cod_tipo_cobro, nombre_tipo_cobro FROM tbl15_tipo_cobro WHERE (cod_tipo_cobro = '$cod_tipo_cobro')";
    $consulta_tipo_cobro = mysqli_query($conectar, $sql_tipo_cobro) or die(mysqli_error($conectar));
    $datos_tipo_cobro = mysqli_fetch_assoc($consulta_tipo_cobro);

    $nombre_tipo_cobro                                                = $datos_tipo_cobro['nombre_tipo_cobro'];
    if ($nombre_tipo_cobro == 'MENSUAL') { $numero_tipo_cobro = 1; } else { $numero_tipo_cobro = 2; }

    $sql_meses_credito = "SELECT * FROM tbl15_meses_credito WHERE (cod_meses_credito = '$cod_meses_credito')";
    $consulta_meses_credito = mysqli_query($conectar, $sql_meses_credito) or die(mysqli_error($conectar));
    $datos_meses_credito = mysqli_fetch_assoc($consulta_meses_credito);

    $codigo_meses_credito                                             = $datos_meses_credito['codigo_meses_credito'];
    $nombre_meses_credito                                             = $datos_meses_credito['nombre_meses_credito'];
    
    if ($cod_seguridad == '23') { //ALIADO ESTRATEGICO
        $nombre_compo_interes_ptj = 'aliado_estrategico_interes_ptj';
        $nombre_compo_aval_ptj = 'aliado_estrategico_aval_ptj';
    } elseif ($cod_seguridad == '22') { //ASESOR
        $nombre_compo_interes_ptj = 'asesor_interes_ptj';
        $nombre_compo_aval_ptj = 'asesor_aval_ptj';
    } else { //ALIADO ESTRATEGICO
        $nombre_compo_interes_ptj = 'aliado_estrategico_interes_ptj';
        $nombre_compo_aval_ptj = 'aliado_estrategico_aval_ptj';
    }
    $sql_tipo_cobro = "SELECT aliado_estrategico_interes_ptj FROM tbl15_entidad_crediticia WHERE (cod_estado_entidad_predeterminada_interes_defect = '1')";
    $consulta_tipo_cobro = mysqli_query($conectar, $sql_tipo_cobro) or die(mysqli_error($conectar));
    $datos_tipo_cobro = mysqli_fetch_assoc($consulta_tipo_cobro);

    $aliado_estrategico_interes_ptj                                   = $datos_tipo_cobro['aliado_estrategico_interes_ptj'];
?>
<script language="javascript">
$(document).ready(function(){
    var nombre_tipo_origen_simulacion = "<?php echo $nombre_tipo_origen_simulacion; ?>";
    var cod_producto_barra = "<?php echo $cod_producto_barra; ?>";
    var nombre_producto = "<?php echo $nombre_producto; ?>";
    var precio_venta_producto = "<?php echo $precio_venta_producto; ?>";
    var entidad_crediticia_interes_ptj = "<?php echo $entidad_crediticia_interes_ptj; ?>";
    var precio_venta_producto_mas_comision_funcionamiento = "<?php echo $precio_venta_producto_mas_comision_funcionamiento; ?>";

    var nombre_producto_txt = nombre_producto;
    var precio_venta_producto_mas_comision_funcionamiento_txt = parseFloat(precio_venta_producto_mas_comision_funcionamiento).toLocaleString('es-CO');

    $('#nombre_producto').val(nombre_producto);
    $('#nombre_producto_txt').text(nombre_producto_txt);
    $('#precio_venta_producto_mas_comision_funcionamiento_txt').text('$'+precio_venta_producto_mas_comision_funcionamiento_txt);
});
</script>
    <!-- Información del Producto -->
    <main class="container pb-5 mb-5">
    <!-- Header de Resultados -->
        <!--
        <div class="resultado-header-simulador"><h1><i class="fa fa-check-circle"></i> Resultados de tu Simulación</h1><p>Elige la mejor opción de financiamiento</p></div>
        -->
        <div class="info-producto-card-simulador acordeon-simulador">
            <div class="acordeon-header" onclick="toggleAcordeon(this)">
                <h3><i class="fa fa-info-circle"></i> Información del Crédito</h3>
                <i class="fa fa-chevron-down acordeon-icon"></i>
            </div>
            <div class="acordeon-content" style="display: none;">
                <div class="info-item-simulador">
                    <i class="fa fa-box"></i>
                    <span class="label">Producto:</span>
                    <span class="value" id="nombre_producto_txt"></span>
                </div>
                <div class="info-item-simulador">
                    <i class="fa fa-cogs"></i>
                    <span class="label">Tipo de Simulación:</span>
                    <span class="value"><?php if($cod_tipo_simulacion_credito == 1 || $cod_tipo_simulacion_credito == 0){ echo "PRECIO DE CONTADO"; } else { echo "PRECIO A CREDITO"; } ?></span>
                </div>
                
                <div class="info-item-simulador">
                    <i class="fa fa-dollar-sign"></i>
                    <span class="label">Valor de contado:</span>
                    <span class="value">$<?php echo number_format($precio_venta_contado_visual, 0, ",", ".") ?></span>
                </div>
                <div class="info-item-simulador">
                    <i class="fa fa-credit-card"></i>
                    <span class="label">Valor a crédito:</span>
                    <span class="value" id="precio_venta_producto_mas_comision_funcionamiento_txt"></span>
                </div>
            </div>
        </div>
        <!-- Líneas de Crédito -->
        <?php
        // Consulta con JOIN para obtener las líneas de crédito parametrizadas para este aliado
        $sql_parametrizacion_entidad_crediticia_aliado = "SELECT * FROM tbl15_parametrizacion_entidad_crediticia_aliado WHERE (cod_aliado_estrategico = '$cod_aliado_estrategico') ORDER BY cod_posicion ASC";
        $consulta_parametrizacion_entidad_crediticia_aliado = mysqli_query($conectar, $sql_parametrizacion_entidad_crediticia_aliado) or die(mysqli_error($conectar));
        $total_parametrizacion_entidad_crediticia_aliado = mysqli_num_rows($consulta_parametrizacion_entidad_crediticia_aliado);
        
        if ($total_parametrizacion_entidad_crediticia_aliado > 0) {
        ?>
        <div class="entidades-grid-simulador">
        <?php
            while ($datos_parametrizacion_entidad_crediticia_aliado = mysqli_fetch_assoc($consulta_parametrizacion_entidad_crediticia_aliado)) {
                
                $cod_entidad_crediticia                                           = $datos_parametrizacion_entidad_crediticia_aliado['cod_entidad_crediticia'];
                $cod_entidad_crediticia_db                                        = $datos_parametrizacion_entidad_crediticia_aliado['cod_entidad_crediticia'];
                $nombre_entidad_crediticia                                        = $datos_parametrizacion_entidad_crediticia_aliado['nombre_entidad_crediticia'];
                $url_pagina_web_consulta                                          = $datos_parametrizacion_entidad_crediticia_aliado['url_pagina_web_consulta'];
                $cod_estado_entrar_portal                                         = $datos_parametrizacion_entidad_crediticia_aliado['cod_estado_entrar_portal'];
                $interes_ptj_aliado                                               = $datos_parametrizacion_entidad_crediticia_aliado['interes_ptj'];
                $aval_ptj_aliado                                           = $datos_parametrizacion_entidad_crediticia_aliado['aval_ptj'];

                $sql_entidad_crediticia_db = "SELECT * FROM tbl15_entidad_crediticia WHERE (cod_entidad_crediticia = '$cod_entidad_crediticia')";
                $consulta_entidad_crediticia_db = mysqli_query($conectar, $sql_entidad_crediticia_db) or die(mysqli_error($conectar));
                $datos_entidad_crediticia_db = mysqli_fetch_assoc($consulta_entidad_crediticia_db);

                $texto_ini_mensaje_para_descuento_entidad_crediticia              = $datos_entidad_crediticia_db['texto_ini_mensaje_para_descuento_entidad_crediticia'];
                $texto_fin_mensaje_para_descuento_entidad_crediticia              = $datos_entidad_crediticia_db['texto_fin_mensaje_para_descuento_entidad_crediticia'];
                $observaciones_entidad_crediticia                                 = $datos_entidad_crediticia_db['observaciones_entidad_crediticia'];
                $cod_estado_aplicar_cuota_max                                     = $datos_entidad_crediticia_db['cod_estado_aplicar_cuota_max'];
                $url_entidad_crediticia_imag_min                                  = $datos_entidad_crediticia_db['url_entidad_crediticia_imag_min'];
                $url_entidad_crediticia_imag_orig                                 = $datos_entidad_crediticia_db['url_entidad_crediticia_imag_orig'];
                $quicenal_max_entidad_crediticia                                  = $datos_entidad_crediticia_db['quicenal_max_entidad_crediticia'];
                $meses_max_entidad_crediticia                                     = $datos_entidad_crediticia_db['meses_max_entidad_crediticia'];

                // Usar el interés de la tabla de parametrización (específico del aliado)
                //$interes_ptj_aliado                                               = $datos_parametrizacion_entidad_crediticia_aliado['interes_ptj'];
                //$aval_ptj_aliado                                                  = $datos_entidad_crediticia['aval_ptj'];

                if (($meses_max_entidad_crediticia <> '0' && $quicenal_max_entidad_crediticia == '0')) {
                    $nombre_tipo_cobro = 'MENSUAL';
                    $numero_tipo_cobro = 1;
                    $numero_cuotas = $numero_tipo_cobro * $codigo_meses_credito;
                    $condicional_mostrar_numero_maximo_cuotas = "AND (cod_meses_credito <= '$meses_max_entidad_crediticia')";
                    $condicional_cod_meses_credito = $numero_cuotas;
                    if ($numero_cuotas > $meses_max_entidad_crediticia) {
                        $numero_cuotas = $meses_max_entidad_crediticia * $numero_tipo_cobro;
                    }
                } elseif (($meses_max_entidad_crediticia == '0' && $quicenal_max_entidad_crediticia <> '0')) {
                    $nombre_tipo_cobro = 'QUINCENAL';
                    $numero_tipo_cobro = 2;
                    $numero_cuotas = $numero_tipo_cobro * $codigo_meses_credito;
                    $condicional_mostrar_numero_maximo_cuotas = "AND (cod_meses_credito <= '$quicenal_max_entidad_crediticia')";
                    $condicional_cod_meses_credito = $numero_cuotas;
                    if ($numero_cuotas > $quicenal_max_entidad_crediticia) {
                        $numero_cuotas = $quicenal_max_entidad_crediticia;
                    }
                } else {
                    $nombre_tipo_cobro = 'MENSUAL';
                    $numero_tipo_cobro = 1;
                    $numero_cuotas = $numero_tipo_cobro * $codigo_meses_credito;
                    $condicional_mostrar_numero_maximo_cuotas = "AND (cod_meses_credito <= '$meses_max_entidad_crediticia')";
                    $condicional_cod_meses_credito = $numero_cuotas;
                }
                //---------------------------------------------------------------------------------------------------------------------------------//
                // Para Bancolombia (cod_entidad_crediticia = 1), forzar cuotas al valor de meses_max_entidad_crediticia
                if ($cod_estado_aplicar_cuota_max == '1') { $numero_cuotas = $meses_max_entidad_crediticia; }
                //---------------------------------------------------------------------------------------------------------------------------------//
                // Usar el interés de la parametrización del aliado (si existe), sino usar el de la entidad
                $interes_ptj                                                      = ($interes_ptj_aliado > 0) ? $interes_ptj_aliado : $datos_entidad_crediticia['ec_interes_ptj'];
                $aval_ptj                                                         = ($aval_ptj_aliado > 0) ? $aval_ptj_aliado : $datos_entidad_crediticia['ec_aval_ptj'];
                $total_pagar                                                      = round($precio_venta_producto / ((100/100) - ($interes_ptj / 100)), -3);
                $total_interes                                                    = $total_pagar - $precio_venta_producto;
                $cuota_credito                                                    = $total_pagar / $numero_cuotas;
                $calculo_diferencia_de_precios                                    = $precio_venta_producto_mas_comision_funcionamiento - $total_pagar;
                $calculo_descuento_respecto_al_mayor                              = round((($calculo_diferencia_de_precios / $precio_venta_producto_mas_comision_funcionamiento) * 100), 2);
                //---------------------------------------------------------------------------------------------------------------------------------//
                if ($cod_tipo_simulacion_credito == 1 || $cod_tipo_simulacion_credito == 0) { // OPCIÓN 1: Calcular crédito CON intereses (partir del valor de contado)
                    $total_pagar_calc                                              = ($precio_venta_producto) / ((100/100) - ($interes_ptj / 100));
                    $total_pagar                                                   = round($total_pagar_calc, -3);
                    $total_interes                                                 = $total_pagar - $precio_venta_producto;
                    $cuota_credito                                                 = $total_pagar / $numero_cuotas;
                    $text_label_valor                                              = 'Valor de Contado';
                } else { // OPCIÓN 2: Calcular crédito con PRECIO A CRÉDITO (el valor ingresado ya incluye intereses)
                    $total_pagar                                                   = $precio_venta_producto; // El valor ingresado YA es el total a pagar
                    $valor_contado_calc                                            = ($total_pagar) * ((100/100) - ($interes_ptj / 100));
                    $valor_contado                                                 = round($valor_contado_calc, -3);
                    $total_interes                                                 = $total_pagar - $valor_contado;
                    $cuota_credito                                                 = $total_pagar / $numero_cuotas;
                    $text_label_valor                                              = 'Valor a Crédito';
                }
        ?>
        <div class="entidad-card-simulador">
            <!-- Logo de la Entidad -->
            <div class="entidad-logo-simulador"><img src="<?php echo $url_entidad_crediticia_imag_orig ?>" alt="<?php echo $nombre_entidad_crediticia ?>"></div>
            <!-- Badge de Descuento -->
            <?php if ($calculo_descuento_respecto_al_mayor > 0) { ?>
            <div class="descuento-badge-simulador"><i class="fa fa-tag"></i><?php echo $texto_ini_mensaje_para_descuento_entidad_crediticia ?> <?php echo $calculo_descuento_respecto_al_mayor ?>% <?php echo $texto_fin_mensaje_para_descuento_entidad_crediticia ?></div>
            <?php } else { ?>
            <div class="descuento-badge-simulador_vacio"><i class=""></i></div>
            <?php } ?>

            <!-- Valor del Crédito -->
            <div class="valor-credito-simulador">💰 $<?php echo number_format($total_pagar, 0, ",", ".") ?></div>

            <!-- Formulario -->
            <form name="formulario_<?php echo $cod_entidad_crediticia_db ?>" method="GET" action="../admin/reg_siscredito_tercero_cliente_simulador_por_cuotas_max_entidad_crediticia.php">
                <!-- Selector de Cuotas -->
                <div class="cuotas-selector-simulador">
                    <label for="cuotas_<?php echo $cod_entidad_crediticia_db ?>"><i class="fa fa-calendar-alt"></i> Número de cuotas: </label>
                    <?php if ($cod_estado_aplicar_cuota_max == '1') { 
                        // Para Bancolombia (cod_entidad_crediticia = 1), cuotas fijas según meses_max_entidad_crediticia
                        $cuotas_fijas_bancolombia = $meses_max_entidad_crediticia;
                        $numero_cuotas = $cuotas_fijas_bancolombia; // Forzar número de cuotas
                    ?>
                    <select id="<?php echo $cod_entidad_crediticia_db ?>" data="<?php echo $nombre_tipo_cobro ?>" valorcredito="<?php echo $valor_credito ?>" class="selector-cuotas" disabled style="background-color: #e9ecef; cursor: not-allowed;">
                        <option value="<?php echo $cuotas_fijas_bancolombia ?>" selected><?php echo $cuotas_fijas_bancolombia ?> cuotas</option>
                    </select>
                    <input type="hidden" name="cod_meses_credito" value="<?php echo $cuotas_fijas_bancolombia ?>">
                    <?php } else { ?>
                    <select name="cod_meses_credito" id="<?php echo $cod_entidad_crediticia_db ?>" data="<?php echo $nombre_tipo_cobro ?>" valorcredito="<?php echo $valor_credito ?>" class="selector-cuotas" required>
                        <option value="">Selecciona las cuotas</option>
                        <?php 
                        $consulta2_sql = "SELECT cod_meses_credito, nombre_meses_credito FROM tbl15_meses_credito WHERE (cod_estado = '1') $condicional_mostrar_numero_maximo_cuotas ORDER BY cod_meses_credito ASC";
                        $consulta2 = mysqli_query($conectar, $consulta2_sql);
                        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                            $seleccionado = (isset($condicional_cod_meses_credito) && $condicional_cod_meses_credito == $datos2['cod_meses_credito']) ? "selected" : "";
                            $codigo = $datos2['cod_meses_credito'];
                            $nombre = $datos2['nombre_meses_credito'];
                            echo "<option value='".$codigo."' $seleccionado>".$codigo." cuotas</option>";
                        } 
                        ?>
                    </select>
                    <?php } ?>
                </div>
                <!-- Resultado de Cuota -->
                <div class="resultado_url_pagina_web_consulta_simulador">
                    <?php if ($cod_estado_entrar_portal == '1') { ?>
                    <div class="label"><a href="<?php echo $url_pagina_web_consulta ?>" target="_blank">Entrar al Portal</a></div>
                    <?php } ?>
                </div>
                <!-- Resultado de Cuota -->
                <div class="cuota-resultado-simulador" id="cod_entidad_crediticia<?php echo $cod_entidad_crediticia_db ?>">
                    <div class="label">Cuota <strong><?php echo strtolower($nombre_tipo_cobro) ?></strong> aproximada:</div>
                    <div class="valor">$<?php echo number_format($cuota_credito, 0, ",", ".") ?></div>
                </div>
                <!-- Botón de Solicitud -->
                <!--<button class="btn-solicitar-simulador btn-abrir-modal-solicitud" type="button" data-entidad="<?php echo $nombre_entidad_crediticia ?>" data-total-credito="<?php echo $total_pagar ?>" data-cuota="<?php echo $cuota_credito ?>" data-num-cuotas="<?php echo $numero_cuotas ?>" data-producto="<?php echo $nombre_producto ?>" data-cod-entidad="<?php echo $cod_entidad_crediticia_db ?>" data-cod-producto="<?php echo $cod_producto_codifcryp ?>" data-precio-venta="<?php echo $precio_venta_producto ?>" data-tipo-origen="<?php echo $nombre_tipo_origen_simulacion ?>" data-cod-seguridad="<?php echo $cod_seguridad ?>" data-cod-tipo-cobro="<?php echo $cod_tipo_cobro ?>" data-nombre-tipo-cobro="<?php echo $nombre_tipo_cobro ?>" data-cod-categoria="<?php echo $cod_categoria ?>" data-cod-tipo-simulacion-credito="<?php echo $cod_tipo_simulacion_credito ?>" data-observaciones-entidad-crediticia="<?php echo $observaciones_entidad_crediticia ?>"><i class="fa fa-paper-plane"></i><span>Solicitar a Crédito</span></button>-->
            </form>
        </div>
        <?php } ?>
        </div>
        <?php } else { ?>
        <div class="no-resultados-simulador"><i class="fa fa-exclamation-circle"></i><h3>No hay opciones disponibles</h3><p>No se encontraron líneas de crédito configuradas para este aliado.</p></div>
        <?php } ?>
    </main>
<?php } else { ?>
    <main class="container py-5">
        <div class="no-resultados-simulador">
            <i class="fa fa-exclamation-triangle"></i>
            <h3>Error en la simulación</h3>
            <p>No se recibieron los datos necesarios para calcular el crédito.</p>
            <a href="../admin/simulador_credito_visitante_intern_interes_max_entidad_crediticia_libre_aliado_movil.php" class="btn-solicitar-simulador" style="display: inline-flex; width: auto; margin-top: 1rem;"><i class="fa fa-arrow-left"></i>Volver al simulador</a>
        </div>
    </main>
<?php } ?>

<?php //include_once("../seguridad/seguridad_diseno_plantillas_visitante_intern.php"); ?>
<?php include_once("../admin/10_modulo_sin_js_visitante_intern_movil.php"); ?>

<?php
$nombre_tipo_identificacion   = 'CC';
$nombre_estado_civil          = 'SOLTERO/A';
?>

</body>
</html>

<!-- Bootstrap Bundle JS (incluye Popper) -->
<script src="../js/bootstrap.bundle.min.js"></script>

<style>
    .resultado-header-simulador {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 1.5rem;
        border-radius: 0 0 20px 20px;
        margin-bottom: 1.5rem;
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    }
    .resultado-header-simulador h1 {
        font-size: 1.3rem;
        font-weight: 800;
        margin: 0 0 0.5rem 0;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .info-producto-card-simulador {
        background: white;
        border-radius: 15px;
        padding: 1.25rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    }
    .info-producto-card-simulador h3 {
        font-size: 1.1rem;
        color: #2d3748;
        margin: 0 0 0.75rem 0;
        font-weight: 700;
    }
    .info-item-simulador {
        display: flex;
        align-items: center;
        padding: 0.5rem 0;
        border-bottom: 1px solid #f7fafc;
    }
    .info-item-simulador:last-child {
        border-bottom: none;
    }
    .info-item-simulador i {
        color: #667eea;
        margin-right: 0.75rem;
        font-size: 1.1rem;
        width: 20px;
        text-align: center;
    }
    .info-item-simulador .label {
        font-weight: 600;
        color: #4a5568;
        font-size: 0.85rem;
    }
    .info-item-simulador .value {
        font-weight: 700;
        color: #2d3748;
        font-size: 0.95rem;
        margin-left: auto;
    }
    .entidades-grid-simulador {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 0.75rem;
        margin-bottom: 1rem;
    }
    .entidad-card-simulador {
        background: white;
        border-radius: 12px;
        padding: 0.75rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        display: flex;
        flex-direction: column;
    }
    .entidad-card-simulador::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 3px;
        height: 100%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    .entidad-card-simulador:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(0,0,0,0.12);
    }
    @media (min-width: 768px) {
        .entidades-grid-simulador {
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
        }
    }
    @media (min-width: 992px) {
        .entidades-grid-simulador {
            grid-template-columns: repeat(4, 1fr);
        }
    }
    .entidad-logo-simulador {
        text-align: center;
        margin-bottom: 0.5rem;
        padding: 0.5rem;
        background: #f7fafc;
        border-radius: 8px;
    }
    .entidad-logo-simulador img {
        max-width: 100%;
        height: auto;
        max-height: 50px;
        object-fit: contain;
    }
    .descuento-badge-simulador {
        background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
        color: white;
        padding: 0.25rem 0.5rem;
        border-radius: 15px;
        font-size: 0.65rem;
        font-weight: 700;
        display: inline-block;
        margin-bottom: 0.5rem;
        box-shadow: 0 2px 4px rgba(72, 187, 120, 0.3);
    }
    .descuento-badge-simulador i {
        margin-right: 0.2rem;
        font-size: 0.6rem;
    }
    .descuento-badge-simulador_vacio {
        background: linear-gradient(135deg, #ffffffff 0%, #ffffffff 100%);
        color: white;
        padding: 0.25rem 0.5rem;
        border-radius: 15px;
        font-size: 0.65rem;
        font-weight: 700;
        display: inline-block;
        margin-bottom: 0.5rem;
        box-shadow: 0 2px 4px rgba(255, 255, 255, 0.0);
    }
    .descuento-badge-simulador_vacio i {
        margin-right: 0.2rem;
        font-size: 0.6rem;
    }
    .valor-credito-simulador {
        font-size: 1rem;
        font-weight: 800;
        color: #667eea;
        margin-bottom: 0.5rem;
        text-align: center;
    }
    .cuotas-selector-simulador {
        background: #f7fafc;
        padding: 0.5rem;
        border-radius: 8px;
        margin-bottom: 0.5rem;
    }
    .cuotas-selector-simulador label {
        display: block;
        font-weight: 600;
        color: #4a5568;
        margin-bottom: 0.35rem;
        font-size: 0.7rem;
    }
    .cuotas-selector-simulador select {
        width: 100%;
        padding: 0.5rem;
        border: 2px solid #e2e8f0;
        border-radius: 6px;
        font-size: 0.85rem;
        background: white;
        transition: all 0.3s ease;
    }
    .cuotas-selector-simulador select:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 2px rgba(102, 126, 234, 0.1);
    }
    .cuota-resultado-simulador {
        background: linear-gradient(135deg, #667eea15 0%, #764ba215 100%);
        padding: 0.5rem;
        border-radius: 8px;
        text-align: center;
        margin-bottom: 0.5rem;
    }
    .cuota-resultado-simulador .label {
        font-size: 0.65rem;
        color: #4a5568;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        margin-bottom: 0.15rem;
    }
    .cuota-resultado-simulador .valor {
        font-size: 1.1rem;
        font-weight: 800;
        color: #667eea;
    }
    .resultado_url_pagina_web_consulta_simulador {
        text-align: center;
        padding: 0.15rem;
        min-height: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 0.15rem;
    }
    .resultado_url_pagina_web_consulta_simulador .label {
        width: 100%;
    }
    .resultado_url_pagina_web_consulta_simulador a {
        color: #667eea;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.85rem;
        transition: all 0.3s ease;
    }
    .resultado_url_pagina_web_consulta_simulador a:hover {
        color: #764ba2;
        text-decoration: underline;
    }
    .btn-solicitar-simulador {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        padding: 0.65rem 0.5rem;
        border-radius: 8px;
        font-weight: 700;
        font-size: 0.75rem;
        width: 100%;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 3px 8px rgba(102, 126, 234, 0.3);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.35rem;
        margin-top: auto;
    }
    .btn-solicitar-simulador:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.5);
    }
    .btn-solicitar-simulador i {
        font-size: 0.7rem;
    }
    .loading-cuota-simulador {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0.5rem;
    }
    .loading-cuota-simulador img {
        width: 30px;
        height: 30px;
    }
    .no-resultados-simulador {
        text-align: center;
        padding: 3rem 1.5rem;
        background: white;
        border-radius: 15px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    }
    .no-resultados-simulador i {
        font-size: 4rem;
        color: #cbd5e0;
        margin-bottom: 1rem;
    }
    .no-resultados-simulador h3 {
        color: #4a5568;
        margin-bottom: 0.5rem;
    }
    @media (max-width: 576px) {
        .resultado-header-simulador h1 {
            font-size: 1.1rem;
        }
        .entidades-grid-simulador {
            gap: 0.5rem;
        }
        .entidad-card-simulador {
            padding: 0.6rem;
        }
        .valor-credito-simulador {
            font-size: 0.95rem;
        }
        .cuota-resultado-simulador .valor {
            font-size: 1rem;
        }
        .btn-solicitar-simulador {
            font-size: 0.7rem;
            padding: 0.6rem 0.4rem;
        }
    }
    @media (min-width: 1200px) {
        .entidades-grid-simulador {
            grid-template-columns: repeat(5, 1fr);
        }
    }
    /* Animación para mensajes de verificación */
    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    /* Estilos para inputs y selects en fondo púrpura */
    #productoModal::placeholder {
        color: rgba(255, 255, 255, 0.6) !important;
    }
    #productoModal:focus {
        background: rgba(255, 255, 255, 0.25) !important;
        border-color: rgba(255, 255, 255, 0.5) !important;
        color: white !important;
        outline: none !important;
    }
    #cod_categoria:focus {
        background: rgba(255, 255, 255, 0.25) !important;
        border-color: rgba(255, 255, 255, 0.5) !important;
        outline: none !important;
    }
    #cod_categoria option {
        background: #764ba2 !important;
        color: white !important;
    }
    /* Responsive para grid de resumen */
    @media (max-width: 768px) {
        .credito-resumen-modal-solicitud {
            grid-template-columns: repeat(2, 1fr) !important;
        }
    }
    @media (max-width: 576px) {
        .credito-resumen-modal-solicitud {
            grid-template-columns: 1fr !important;
        }
    }
</style>