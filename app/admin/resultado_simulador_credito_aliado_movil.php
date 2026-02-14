<?php 
$nombre_pagina          = "Resultados de Simulación";
$cod_seguridad_pag      = "1";
$pagina_local           = $_SERVER['PHP_SELF'];
$cod_base_caja          = "1";
?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include_once("../admin/01_modulo_diseno_superior_visitante_intern_movil.php"); ?>
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
                <div class="info-item-simulador">
                    <i class="fa fa-credit-card"></i>
                    <span class="label">Valor a crédito: </span>
                    <span class="value" id="precio_venta_producto_mas_comision_funcionamiento_txt"> </span>
                </div>
                <i class="fa fa-chevron-down acordeon-icon"></i>
            </div>
            <div class="acordeon-content" style="display: none;">
                <div class="info-item-simulador">
                    <i class="fa fa-cube"></i>
                    <span class="label">Producto:</span>
                    <span class="value" id="nombre_producto_txt"></span>
                </div>
                <div class="info-item-simulador">
                    <i class="fa fa-cogs"></i>
                    <span class="label">Tipo de Simulación:</span>
                    <span class="value"><?php if($cod_tipo_simulacion_credito == 1 || $cod_tipo_simulacion_credito == 0){ echo "PRECIO DE CONTADO"; } else { echo "PRECIO A CREDITO"; } ?></span>
                </div>
                
                <div class="info-item-simulador">
                    <i class="fa fa-usd"></i>
                    <span class="label">Valor de contado:</span>
                    <span class="value">$<?php echo number_format($precio_venta_contado_visual, 0, ",", ".") ?></span>
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
                <button class="btn-solicitar-simulador btn-abrir-modal-solicitud" type="button" data-entidad="<?php echo $nombre_entidad_crediticia ?>" data-total-credito="<?php echo $total_pagar ?>" data-cuota="<?php echo $cuota_credito ?>" data-num-cuotas="<?php echo $numero_cuotas ?>" data-producto="<?php echo $nombre_producto ?>" data-cod-entidad="<?php echo $cod_entidad_crediticia_db ?>" data-cod-producto="<?php echo $cod_producto_codifcryp ?>" data-precio-venta="<?php echo $precio_venta_producto ?>" data-tipo-origen="<?php echo $nombre_tipo_origen_simulacion ?>" data-cod-seguridad="<?php echo $cod_seguridad ?>" data-cod-tipo-cobro="<?php echo $cod_tipo_cobro ?>" data-nombre-tipo-cobro="<?php echo $nombre_tipo_cobro ?>" data-cod-categoria="<?php echo $cod_categoria ?>" data-cod-tipo-simulacion-credito="<?php echo $cod_tipo_simulacion_credito ?>" data-observaciones-entidad-crediticia="<?php echo $observaciones_entidad_crediticia ?>"><i class="fa fa-paper-plane"></i><span>Solicitar a Crédito</span></button>
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
<?php include_once("../menu/05_modulo_menu_aliado_movil.php"); ?>
<?php include_once("../admin/10_modulo_sin_js_visitante_intern_movil.php"); ?>

<?php
$nombre_tipo_identificacion   = 'CC';
$nombre_estado_civil          = 'SOLTERO/A';
?>
<!-- Modal de Solicitud de Crédito -->
<div class="modal fade" id="modalSolicitudCredito" tabindex="-1" aria-labelledby="modalSolicitudLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content modal-solicitud-credito">
            <div class="modal-header-solicitud">
                <h5 class="modal-title-solicitud" id="modalSolicitudLabel"><i class="fa fa-file-text"></i> Solicitud de Crédito</h5>
                <button type="button" class="close-modal-solicitud" data-bs-dismiss="modal" aria-label="Cerrar">
                    <span style="font-size: 1.5rem; line-height: 1; font-weight: 300;">×</span>
                </button>
            </div>
            <div class="modal-body-solicitud">
                <form id="formSolicitudCredito" method="POST">

                    <!-- Resumen del Crédito y Producto/Categoría -->
                    <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 1.5rem; border-radius: 12px; margin-bottom: 1.5rem;">
                        <!-- Resumen del Crédito -->
                        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem; margin-bottom: 1.5rem;">
                            <div style="text-align: center;">
                                <div style="color: rgba(255, 255, 255, 0.9); font-size: 0.75rem; font-weight: 600; text-transform: uppercase; margin-bottom: 0.25rem;">TOTAL CRÉDITO:</div>
                                <div style="color: #ffffff; font-size: 1.1rem; font-weight: 700;" id="totalCreditoModal"></div>
                            </div>
                            <div style="text-align: center;">
                                <div style="color: rgba(255, 255, 255, 0.9); font-size: 0.75rem; font-weight: 600; text-transform: uppercase; margin-bottom: 0.25rem;">CUOTA MENSUAL:</div>
                                <div style="color: #ffffff; font-size: 1.1rem; font-weight: 700;" id="cuotaMensualModal"></div>
                            </div>
                            <div style="text-align: center;">
                                <div style="color: rgba(255, 255, 255, 0.9); font-size: 0.75rem; font-weight: 600; text-transform: uppercase; margin-bottom: 0.25rem;">LINEA DE CREDITO:</div>
                                <div style="color: #ffffff; font-size: 1.1rem; font-weight: 700;" id="entidadModal"></div>
                            </div>
                            <div style="text-align: center;">
                                <div style="color: rgba(255, 255, 255, 0.9); font-size: 0.75rem; font-weight: 600; text-transform: uppercase; margin-bottom: 0.25rem;">CUOTAS:</div>
                                <div style="color: #ffffff; font-size: 1.1rem; font-weight: 700;" id="cantidadCuotasModal"></div>
                            </div>
                        </div>
                        
                        <!-- Producto y Categoría -->
                        <div class="row">
                            <div class="col-md-6 mb-0">
                                <label style="color: white; font-size: 0.85rem; font-weight: 600; margin-bottom: 0.5rem; display: flex; align-items: center;"><i class="fa fa-box" style="margin-right: 0.5rem;"></i>Producto *</label>
                                <input type="text" name="nombre_producto" id="nombre_producto" class="form-control-solicitud" placeholder="Nombre del producto" required style="background: white !important; border: 2px solid rgba(255, 255, 255, 0.5); color: #2d3748 !important; font-size: 0.95rem; font-weight: 600; text-shadow: none;">
                            </div>
                            
                            <div class="col-md-6 mb-0">
                                <label style="color: white; font-size: 0.85rem; font-weight: 600; margin-bottom: 0.5rem; display: flex; align-items: center;"><i class="fa fa-tags" style="margin-right: 0.5rem;"></i>Categoría *</label>
                                <select name="cod_categoria" id="cod_categoria" class="form-control-solicitud" required style="background: white !important; border: 2px solid rgba(255, 255, 255, 0.5); color: #2d3748 !important; font-size: 0.95rem; font-weight: 600; text-shadow: none;">
                                    <option value="" style="background: white; color: #2d3748;">-- Selecciona una categoría --</option>
                                    <?php $consulta2_sql = "SELECT cod_categoria, nombre_categoria FROM tbl15_categoria WHERE (cod_estado = '1') ORDER BY nombre_categoria ASC";
                                    $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysqli_error($conectar));
                                    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                                        $seleccionado = (isset($cod_categoria) && $cod_categoria == $datos2['cod_categoria']) ? "selected" : "";
                                        $codigo = $datos2['cod_categoria'];
                                        $nombre = $datos2['nombre_categoria'];
                                        echo "<option value='".$codigo."' $seleccionado style='background: #764ba2; color: white;'>".$nombre."</option>"; } ?>
                                </select>
                            </div>
                        </div>

                        <!-- mensaje -->
                        <div class="row" style="margin-top: 1rem;">
                            <div class="col-md-12 mb-0">
                                <div id="observaciones_entidad_crediticia" style="background: rgba(255, 255, 255, 0.15); border-left: 4px solid rgba(255, 255, 255, 0.8); padding: 1rem; border-radius: 8px; color: white; font-size: 0.9rem; line-height: 1.6; display: none;">
                                    <i class="fa fa-info-circle" style="margin-right: 0.5rem; font-size: 1.2rem; vertical-align: middle;"></i>
                                    <span id="observaciones_entidad_crediticia_texto"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <!-- Mensaje de verificación -->
                    <div id="mensaje_verificacion_documento_modal_credito" style="margin-bottom: 1rem;"></div>
                    <!-- Formulario de Datos del Cliente -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="label-form-solicitud"><i class="fa fa-id-card"></i> Tipo de documento *</label>
                            <select class="form-control-solicitud" name="nombre_tipo_identificacion" id="modal_credito_nombre_tipo_identificacion" required>
                                <?php if (isset($nombre_tipo_identificacion)) { echo ""; } else { echo ""; }
                                $consulta2_sql = "SELECT cod_tipo_identificacion, nombre_tipo_identificacion FROM tbl15_tipo_identificacion WHERE (cod_estado = '1')";
                                $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysql_error());
                                while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                                if(isset($nombre_tipo_identificacion) and $nombre_tipo_identificacion == $datos2['nombre_tipo_identificacion']) {
                                $seleccionado = "selected"; } else { $seleccionado = ""; }
                                $codigo           = $datos2['nombre_tipo_identificacion'];
                                $nombre           = $datos2['nombre_tipo_identificacion'];
                                echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                            </select>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="label-form-solicitud"><i class="fa fa-hashtag"></i> Documento *</label>
                            <input type="number" class="form-control-solicitud" name="identificacion_tercero" id="modal_credito_identificacion_tercero" placeholder="Número de identificación" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="label-form-solicitud"><i class="fa fa-user"></i> Primer nombre *</label>
                            <input type="text" class="form-control-solicitud" name="nombre1_tercero" id="modal_credito_nombre1_tercero" placeholder="Primer nombre" required>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="label-form-solicitud"><i class="fa fa-user"></i> Segundo nombre</label>
                            <input type="text" class="form-control-solicitud" name="nombre2_tercero" id="modal_credito_nombre2_tercero" placeholder="Segundo nombre">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="label-form-solicitud"><i class="fa fa-user"></i> Primer apellido *</label>
                            <input type="text" class="form-control-solicitud" name="apellido1_tercero" id="modal_credito_apellido1_tercero" placeholder="Primer apellido" required>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="label-form-solicitud"><i class="fa fa-user"></i> Segundo apellido</label>
                            <input type="text" class="form-control-solicitud" name="apellido2_tercero" id="modal_credito_apellido2_tercero" placeholder="Segundo apellido">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="label-form-solicitud"><i class="fa fa-phone"></i> Celular *</label>
                            <input type="tel" class="form-control-solicitud" name="telefono1_tercero" id="modal_credito_telefono1_tercero" placeholder="Número de celular" required>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="label-form-solicitud"><i class="fa fa-envelope"></i> Correo *</label>
                            <input type="email" class="form-control-solicitud" name="correo_tercero" id="modal_credito_correo_tercero" placeholder="correo@ejemplo.com" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="label-form-solicitud"><i class="fa fa-map-marker-alt"></i> Dirección *</label>
                            <input type="text" class="form-control-solicitud" name="direccion_tercero" id="modal_credito_direccion_tercero" placeholder="Dirección de residencia" required>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="label-form-solicitud"><i class="fa fa-heart"></i> Estado Civil</label>
                            <select class="form-control-solicitud" name="nombre_estado_civil" id="modal_credito_nombre_estado_civil">
                                <?php if (isset($nombre_estado_civil)) { echo ""; } else { echo ""; }
                                $consulta2_sql = "SELECT cod_estado_civil, nombre_estado_civil FROM tbl15_estado_civil";
                                $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysql_error());
                                while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                                if(isset($nombre_estado_civil) and $nombre_estado_civil == $datos2['nombre_estado_civil']) {
                                $seleccionado = "selected"; } else { $seleccionado = ""; }
                                $codigo           = $datos2['nombre_estado_civil'];
                                $nombre           = $datos2['nombre_estado_civil'];
                                echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                            </select>
                        </div>
                    </div>

                    <!-- Checkboxes de Aceptación -->
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="form-check" style="display: flex; align-items: start; padding: 1rem; background: #f7fafc; border-radius: 8px; border: 2px solid #e2e8f0;">
                                <input type="checkbox" class="form-check-input" name="cod_estado_acepta_tratamiento_datos" id="modal_credito_acepta_tratamiento_datos" value="1" required style="margin-top: 0.3rem; margin-right: 0.75rem; width: 20px; height: 20px; cursor: pointer;">
                                <label class="form-check-label" for="modal_credito_acepta_tratamiento_datos" style="cursor: pointer; font-size: 0.9rem; color: #2d3748; line-height: 1.5;">
                                    <i class="fa fa-shield-alt" style="color: #667eea; margin-right: 0.5rem;"></i>
                                    <strong>Acepto el tratamiento de datos personales *</strong>
                                    <small style="display: block; color: #718096; margin-top: 0.25rem;">Autorizo el tratamiento de mis datos personales de acuerdo con la política de privacidad.</small>
                                </label>
                            </div>
                        </div>
                        
                        <div class="col-12 mb-3">
                            <div class="form-check" style="display: flex; align-items: start; padding: 1rem; background: #f7fafc; border-radius: 8px; border: 2px solid #e2e8f0;">
                                <input type="checkbox" class="form-check-input" name="cod_estado_acepta_terminos_condiciones" id="modal_credito_acepta_terminos_condiciones" value="1" required style="margin-top: 0.3rem; margin-right: 0.75rem; width: 20px; height: 20px; cursor: pointer;">
                                <label class="form-check-label" for="modal_credito_acepta_terminos_condiciones" style="cursor: pointer; font-size: 0.9rem; color: #2d3748; line-height: 1.5;">
                                    <i class="fa fa-file-contract" style="color: #667eea; margin-right: 0.5rem;"></i>
                                    <strong>Acepto los términos y condiciones *</strong>
                                    <small style="display: block; color: #718096; margin-top: 0.25rem;">He leído y acepto los términos y condiciones del servicio de crédito.</small>
                                </label>
                            </div>
                        </div>
                    </div>
                    <!-- Campos ocultos -->
                    <input type="hidden" name="cod_producto_barra" id="cod_producto_barra"value="<?php echo $cod_producto_barra ?>" />
                    <!--<input type="hidden" name="nombre_producto" id="nombre_producto" value="<?php echo $nombre_producto ?>" />-->
                    <input type="hidden" name="cod_tipo_simulacion_credito" id="cod_tipo_simulacion_credito"value="<?php echo $cod_tipo_simulacion_credito ?>" />

                    <input type="hidden" name="precio_venta_producto" id="precioVentaHidden" />
                    <input type="hidden" name="nombre_tipo_origen_simulacion" id="tipoOrigenHidden" />
                    <!--<input type="hidden" name="nombre_producto" id="nombreProductoHidden" />-->
                    <input type="hidden" name="cod_producto_codifcryp" id="codProductoHidden" />
                    <input type="hidden" name="cod_entidad_crediticia" id="codEntidadHidden" />
                    <input type="hidden" name="cod_seguridad" id="codSeguridadHidden" />
                    <input type="hidden" name="valor_credito" id="valorCreditoHidden" />
                    <input type="hidden" name="total_pagar" id="totalPagarHidden" />
                    <input type="hidden" name="cod_tipo_cobro" id="codTipoCobroHidden" />
                    <input type="hidden" name="cuota_credito" id="cuotaCreditoHidden" />
                    <input type="hidden" name="nombre_tipo_cobro" id="nombreTipoCobroHidden" />
                    <input type="hidden" name="cod_categoria" id="codCategoriaHidden" />
                    <input type="hidden" name="cod_meses_credito" id="codMesesCreditoHidden" />
                    <input type="hidden" name="nombre_tipo_tercero" value="CLIENTE" />
                    <input type="hidden" name="nombre_tipo_tercero_modulo_creacion" value="SIMULADOR_CREDITO_VISITANTE_INTERN" />
                    <input type="hidden" name="fecha_nac_tercero" value="" />
                    <input type="hidden" name="fecha_expedicion_tercero" value="" />
                    <input type="hidden" name="fecha_pago" value="<?php echo date('Y-m-d') ?>" />
                    
                </form>
            </div>
            <div class="modal-footer-solicitud">
                <button type="button" class="btn-cancelar-solicitud" data-bs-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
                <button type="submit" id="loader" form="formSolicitudCredito" class="btn-enviar-solicitud"><i class="fa fa-check"></i> Enviar Solicitud</button>
            </div>
        </div>
    </div>
</div>

</body>
</html>

<script language="javascript">
$(document).ready(function(){
    $('.selector-cuotas').change(function(){ 
        var numero_cuotas = $(this).val();
        var cod_entidad_crediticia = $(this).attr("id");
        var nombre_tipo_cobro = $(this).attr("data");
        var valor_credito = $(this).attr("valorcredito");
        var campo = "cod_entidad_crediticia";
        var tipo_ajax = "tbl15_entidad_crediticia";
        var cod_producto_codifcryp = "<?php echo $cod_producto_codifcryp; ?>";
        var precio_venta_producto = "<?php echo $precio_venta_producto; ?>";
        var nombre_tipo_origen_simulacion = "<?php echo $nombre_tipo_origen_simulacion; ?>";
        var cod_tipo_simulacion_credito = "<?php echo $cod_tipo_simulacion_credito; ?>";       
        var nombre_producto = "<?php echo $nombre_producto; ?>";
        var pagina = "<?php echo $pagina_local; ?>";

        var datos_url_ajax = 'cod_entidad_crediticia='+cod_entidad_crediticia+'&'+'valor_credito='+valor_credito+'&'+'precio_venta_producto='+precio_venta_producto+'&'+'nombre_tipo_origen_simulacion='+nombre_tipo_origen_simulacion+'&'+'cod_tipo_simulacion_credito='+cod_tipo_simulacion_credito+'&'+'numero_cuotas='+numero_cuotas+'&'+'nombre_tipo_cobro='+nombre_tipo_cobro+'&'+'tipo_ajax='+tipo_ajax+'&'+'cod_producto_codifcryp='+cod_producto_codifcryp+'&'+'pagina='+pagina;
        $.ajax({
            type: "POST",
            url: "../admin/calcular_valor_cuota_simulador_credito_producto_visitante_intern_interes_funcionamiento_resultado_ajax.php",
            data: datos_url_ajax,
            beforeSend: function(objeto){
                $('#'+campo+''+cod_entidad_crediticia).html('<div class="loading-cuota-simulador"><img src="../imagenes/loading.gif"> Calculando...</div>');
            },
            success:function(respuesta){
                var mensaje_cuota_credito = respuesta.mensaje_cuota_credito;
                var total_pagar = respuesta.total_pagar;
                var cuota_credito = respuesta.cuota_credito;
                var numero_cuotas = respuesta.numero_cuotas;
                var mensaje = respuesta.mensaje;
                // Actualizar el display de la cuota
                $('#'+campo+''+cod_entidad_crediticia).html(mensaje_cuota_credito);
            },
            error: function(){
                $('#'+campo+''+cod_entidad_crediticia).html('<div style="color: #e53e3e; text-align: center;">Error al calcular</div>');
            }
        });
    });
    // Validación antes de enviar
    $('form[name^="formulario_"]').submit(function(e){
        var select_cod_meses_credito = $(this).find('select[name="cod_meses_credito"]');
        if(!select_cod_meses_credito.val()){
            e.preventDefault();
            alert('Por favor selecciona el número de cuotas');
            return false;
        }
    });
});
</script>

<!-- Bootstrap Bundle JS (incluye Popper) -->
<script src="../js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function() {
    // Función para formatear números como moneda
    function formatCurrency(value) {
        return '$' + parseFloat(value).toLocaleString('es-CO', {
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
        });
    }
    // Abrir modal al hacer clic en el botón de solicitar
    $(document).on('click', '.btn-abrir-modal-solicitud', function(e) {
        e.preventDefault();
        // Obtener los datos del botón
        var entidad = $(this).data('entidad');
        var totalCredito = $(this).data('total-credito');
        var producto = $(this).data('producto');
        var codEntidad = $(this).data('cod-entidad');
        var codProducto = $(this).data('cod-producto');
        var precioVenta = $(this).data('precio-venta');
        var tipoOrigen = $(this).data('tipo-origen');
        var codSeguridad = $(this).data('cod-seguridad');
        var codTipoCobro = $(this).data('cod-tipo-cobro');
        var nombreTipoCobro = $(this).data('nombre-tipo-cobro');
        var codCategoria = $(this).data('cod-categoria');
        var observacionesEntidadCrediticia = $(this).data('observaciones-entidad-crediticia');

        // Obtener el formulario padre
        var formularioEntidad = $(this).closest('form');
        // Obtener el número de cuotas - primero del input hidden, luego del select
        var inputHiddenCuotas = formularioEntidad.find('input[name="cod_meses_credito"]');
        var selectCuotas = formularioEntidad.find('select[name="cod_meses_credito"]');
        var codMesesCredito = inputHiddenCuotas.length > 0 ? inputHiddenCuotas.val() : selectCuotas.val();
        // Validar que se haya seleccionado las cuotas
        if (!codMesesCredito) { alert('Por favor selecciona el número de cuotas antes de solicitar el crédito'); return false; }
        // Obtener la cuota calculada desde el div cuota-resultado-simulador
        var divCuotaResultado = formularioEntidad.find('.cuota-resultado-simulador');
        var cuotaTexto = divCuotaResultado.find('.valor').text().trim();
        // Extraer solo el valor numérico de la cuota (quitar $, puntos y espacios)
        var cuotaLimpia = cuotaTexto.replace(/[$\s.]/g, '').replace(',', '.');
        var cuotaValor = parseFloat(cuotaLimpia);
        // Si no se pudo obtener la cuota del div, usar el data-attribute como fallback
        if (isNaN(cuotaValor)) { cuotaValor = $(this).data('cuota'); }
        // Rellenar el resumen del crédito en el modal
        $('#totalCreditoModal').text(formatCurrency(totalCredito));
        $('#cuotaMensualModal').text(cuotaTexto); // Usar el texto formateado del div
        $('#cantidadCuotasModal').text(codMesesCredito); // Usar el valor seleccionado del select
        $('#entidadModal').text(entidad);
        //$('#productoModal').val(producto);
        // Preseleccionar la categoría
        $('#cod_categoria').val(codCategoria);
        // Rellenar los campos ocultos
        $('#precioVentaHidden').val(precioVenta);
        $('#tipoOrigenHidden').val(tipoOrigen);
        $('#nombreProductoHidden').val(producto);
        $('#codProductoHidden').val(codProducto);
        $('#codEntidadHidden').val(codEntidad);
        $('#codSeguridadHidden').val(codSeguridad);
        $('#valorCreditoHidden').val(totalCredito);
        $('#totalPagarHidden').val(totalCredito);
        $('#codTipoCobroHidden').val(codTipoCobro);
        $('#cuotaCreditoHidden').val(cuotaValor); // Usar el valor numérico limpio
        $('#nombreTipoCobroHidden').val(nombreTipoCobro);
        $('#codCategoriaHidden').val(codCategoria);
        $('#codMesesCreditoHidden').val(codMesesCredito);
        
        // Mostrar observaciones si existen
        if (observacionesEntidadCrediticia && observacionesEntidadCrediticia.trim() !== '') {
            $('#observaciones_entidad_crediticia_texto').html(observacionesEntidadCrediticia);
            $('#observaciones_entidad_crediticia').show();
        } else {
            $('#observaciones_entidad_crediticia').hide();
        }
        
        // Abrir el modal usando Bootstrap 5
        var modalElement = document.getElementById('modalSolicitudCredito');
        var modal = new bootstrap.Modal(modalElement);
        modal.show();
    });
    
    // Limpiar el formulario cuando se cierra el modal
    var modalElement = document.getElementById('modalSolicitudCredito');
    if (modalElement) {
        modalElement.addEventListener('hidden.bs.modal', function() {
            $('#formSolicitudCredito')[0].reset();
            $('#mensaje_verificacion_documento_modal_credito').html('');
            $('#modal_credito_acepta_tratamiento_datos').prop('checked', false);
            $('#modal_credito_acepta_terminos_condiciones').prop('checked', false);
        });
    }
});
</script>

<script>
$(document).ready(function() {
    // Validación del formulario antes de enviar
    $('#formSolicitudCredito').on('submit', function(e) {
        e.preventDefault(); // Prevenir envío normal del formulario
        var isValid = true;
        var errorMessage = '';
        var estado_registro = 'CLIENTE';
        // Obtener el formulario específico del modal
        var formElement = document.getElementById('formSolicitudCredito');
        // Validar campos requeridos usando JavaScript vanilla dentro del formulario del modal
        var tipoDoc = formElement.querySelector('select[name="nombre_tipo_identificacion"]').value;
        var documento = formElement.querySelector('input[name="identificacion_tercero"]').value;
        var nombre1 = formElement.querySelector('input[name="nombre1_tercero"]').value.trim();
        var apellido1 = formElement.querySelector('input[name="apellido1_tercero"]').value.trim();
        var celular = formElement.querySelector('input[name="telefono1_tercero"]').value.trim();
        var correo = formElement.querySelector('input[name="correo_tercero"]').value.trim();
        var direccion = formElement.querySelector('input[name="direccion_tercero"]').value.trim();
        var nombre_estado_civil = formElement.querySelector('select[name="nombre_estado_civil"]').value;
        var cod_producto_barra = formElement.querySelector('input[name="cod_producto_barra"]').value;
        var nombre_producto = formElement.querySelector('input[name="nombre_producto"]').value;
        var acepta_tratamiento_datos = formElement.querySelector('input[name="cod_estado_acepta_tratamiento_datos"]').checked;
        var acepta_terminos_condiciones = formElement.querySelector('input[name="cod_estado_acepta_terminos_condiciones"]').checked;
        var cod_tipo_simulacion_credito = formElement.querySelector('input[name="cod_tipo_simulacion_credito"]').value.trim();

        if (!tipoDoc || tipoDoc === '') { errorMessage += '- Seleccione el tipo de documento\n'; isValid = false; }
        if (!documento || documento === '' || documento.length === 0) { errorMessage += '- Ingrese el número de documento\n'; isValid = false; }
        if (!nombre1 || nombre1 === '') { errorMessage += '- Ingrese el primer nombre\n'; isValid = false; }
        if (!apellido1 || apellido1 === '') { errorMessage += '- Ingrese el primer apellido\n'; isValid = false; }
        if (!celular) { errorMessage += '- Ingrese el número de celular\n'; isValid = false; } else if (celular.length < 10) { errorMessage += '- El celular debe tener al menos 10 dígitos\n'; isValid = false; }
        
        if (!correo) {
            errorMessage += '- Ingrese el correo electrónico\n'; isValid = false; } else {
            // Validar formato de correo
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(correo)) {
                errorMessage += '- El correo electrónico no es válido\n';
                isValid = false;
            }
        }
        if (!direccion) { errorMessage += '- Ingrese la dirección\n'; isValid = false; }
        if (!acepta_tratamiento_datos) { errorMessage += '- Debe aceptar el tratamiento de datos personales\n'; isValid = false; }
        if (!acepta_terminos_condiciones) { errorMessage += '- Debe aceptar los términos y condiciones\n'; isValid = false; }
        if (!isValid) { alert('Por favor complete los siguientes campos:\n\n' + errorMessage); return false; }
        // Si todo está correcto, mostrar mensaje de procesamiento y enviar por AJAX
        $('.btn-enviar-solicitud').html('<i class="fa fa-spinner fa-spin"></i> Procesando...').prop('disabled', true);
        // Obtener todos los datos del formulario
        var formData = $(this).serialize();    
        var tab = '';
        var campo = '';
        var tipo_ajax = '';
        var pagina = '';  
        // Enviar por AJAX
        $.ajax({
            type: "POST",
            url: "../admin/reg_simulador_por_cuotas_aliado_movil_ajax_reg.php",
            data: formData,
            beforeSend: function() {
                //console.log("Enviando solicitud de crédito...");
            },
            success: function(response) {
                var afectado = response.afectado;
                var cod_info_factura_venta = response.cod_info_factura_venta;
                var cod_tercero = response.cod_tercero;
                var url_redir = response.url_redir;
                var mensaje = response.mensaje;
/*
                if (afectado == 'SI') {
                    // Si la respuesta es positiva, redirigir a la URL correspondiente
                    //location.href = "../admin/lista_info_factura_venta_siscredito_visitante_intern_aliado_movil.php?desplegar_modal_id=modalListaCapturaImagenes&cod_info_factura_venta=" + cod_info_factura_venta + "&cod_tercero=" + cod_tercero;
                } else {

                }
*/
                if(afectado == 'SI') {

                    var datos_url_ajax = 'id='+cod_info_factura_venta+'&'+'cod_info_factura_venta='+cod_info_factura_venta+'&'+'tab='+tab+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'estado_registro='+estado_registro+'&'+'pagina='+pagina;
                    $.ajax({
                        type: "GET",
                        url: "../admin/enviar_notificacion_chatbot_canal_telegram_registro_cliente_simulador_credito_json.php",
                        data: datos_url_ajax,
                        //dataType: 'json',
                        beforeSend: function(objeto){
                            $('#loader').html('<img src="../imagenes/ajax-loader.gif"> Guardando...');
                        },
                        success:function(respuesta){
                            var respuesta_ok = respuesta.ok;

                            if(respuesta_ok == '1') {
                                var cod_estado_enviado = 1;
                            } else {
                                var cod_estado_enviado = 0;
                            }
                            var datos_url_ajax = 'id='+cod_info_factura_venta+'&'+'cod_info_factura_venta='+cod_info_factura_venta+'&'+'respuesta_ok='+respuesta_ok+'&'+'cod_estado_enviado='+cod_estado_enviado+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'pagina='+pagina;
                            $.ajax({
                                type: "POST",
                                url: "../admin/guardar_info_factura_venta_notificacion_chatbot_telegram_registro_cliente_simulador_credito_json_ajax.php",
                                data: datos_url_ajax,
                                beforeSend: function(objeto){
                                    $('#loader').html('<img src="../imagenes/ajax-loader.gif"> Notificando via Telegram...');
                                },
                                success:function(respuesta){
                                    location.href = "../admin/lista_info_factura_venta_siscredito_visitante_intern_aliado_movil.php?desplegar_modal_id=modalListaCapturaImagenes&cod_info_factura_venta=" + cod_info_factura_venta + "&cod_tercero=" + cod_tercero;
                                }
                            });
                        }
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error("Error en AJAX:", error);
                alert('Error al procesar la solicitud. Por favor intente nuevamente.');
                $('.btn-enviar-solicitud').html('<i class="fa fa-check"></i> Enviar Solicitud').prop('disabled', false);
            }
        });
        return false;
    });
    // ============================================
    // Verificación automática de documento existente
    // ============================================
    $("#modal_credito_identificacion_tercero").on('change', function () {
        var identificacion_tercero = $(this).val();
        
        // Validar que tenga al menos 5 dígitos
        if(identificacion_tercero.length < 5) {
            var mensajeHTML = '<div class="alert alert-warning" style="border-radius: 8px; padding: 1rem; display: flex; align-items: center; animation: slideDown 0.4s ease-out;">' + '<i class="fa fa-exclamation-circle" style="font-size: 1.5rem; margin-right: 1rem;"></i>' + '<div><strong>Documento Inválido</strong><br>El documento debe tener al menos 5 dígitos.</div>' + '</div>';
            $("#mensaje_verificacion_documento_modal_credito").html(mensajeHTML);
            return;
        }
        
        var campo = "identificacion_tercero";
        var tipo_ajax = "";

        var datos_url_ajax = 'identificacion_tercero='+identificacion_tercero+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax;
        $.ajax({
            type: "POST",
            url: "../admin/verificar_existencia_siscredito_tercero_cliente_modal_movil_ajax.php",
            data: datos_url_ajax,
            beforeSend: function(objeto){
                var mensajeHTML = '<div class="alert alert-info" style="border-radius: 8px; padding: 1rem; display: flex; align-items: center; animation: slideDown 0.4s ease-out;">' + '<i class="fa fa-spinner fa-spin" style="font-size: 1.5rem; margin-right: 1rem;"></i>' + '<div><strong>Verificando...</strong><br>Buscando documento en la base de datos.</div>' + '</div>';
                $("#mensaje_verificacion_documento_modal_credito").html(mensajeHTML);
            },
            success:function(respuesta){
                var resultado = respuesta.resultado;
                var mensaje = respuesta.mensaje;

                var identificacion_tercero = respuesta.identificacion_tercero;
                var nombre1_tercero = respuesta.nombre1_tercero;
                var nombre2_tercero = respuesta.nombre2_tercero;
                var apellido1_tercero = respuesta.apellido1_tercero;
                var apellido2_tercero = respuesta.apellido2_tercero;
                var telefono1_tercero = respuesta.telefono1_tercero;
                var correo_tercero = respuesta.correo_tercero;
                var direccion_tercero = respuesta.direccion_tercero;

                if (resultado > '0') {
                    // Cliente encontrado - Autocompletar campos
                    $("#modal_credito_nombre1_tercero").val(nombre1_tercero);
                    $("#modal_credito_nombre2_tercero").val(nombre2_tercero);
                    $("#modal_credito_apellido1_tercero").val(apellido1_tercero);
                    $("#modal_credito_apellido2_tercero").val(apellido2_tercero);
                    $("#modal_credito_telefono1_tercero").val(telefono1_tercero);
                    $("#modal_credito_correo_tercero").val(correo_tercero);
                    $("#modal_credito_direccion_tercero").val(direccion_tercero);
                    // Mostrar mensaje de éxito
                    var mensajeHTML = '<div class="alert alert-success" style="border-radius: 8px; padding: 1rem; display: flex; align-items: center; animation: slideDown 0.4s ease-out; background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; border: none;">' + '<i class="fa fa-check-circle" style="font-size: 1.5rem; margin-right: 1rem;"></i>' + '<div><strong>¡Cliente Encontrado!</strong><br>' + mensaje + '</div>' + '</div>';
                    $("#mensaje_verificacion_documento_modal_credito").html(mensajeHTML);
                } else {
                    // Nuevo cliente - Limpiar campos
                    $("#modal_credito_nombre1_tercero").val('');
                    $("#modal_credito_nombre2_tercero").val('');
                    $("#modal_credito_apellido1_tercero").val('');
                    $("#modal_credito_apellido2_tercero").val('');
                    $("#modal_credito_telefono1_tercero").val('');
                    $("#modal_credito_correo_tercero").val('');
                    $("#modal_credito_direccion_tercero").val('');
                    // Mostrar mensaje de nuevo cliente
                    var mensajeHTML = '<div class="alert alert-info" style="border-radius: 8px; padding: 1rem; display: flex; align-items: center; animation: slideDown 0.4s ease-out; background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); color: white; border: none;">' + '<i class="fa fa-info-circle" style="font-size: 1.5rem; margin-right: 1rem;"></i>' + '<div><strong>Nuevo Cliente</strong><br>Complete los datos para registrar.</div>' + '</div>';
                    $("#mensaje_verificacion_documento_modal_credito").html(mensajeHTML);
                }
            },
            error: function(xhr, status, error) {
                var mensajeHTML = '<div class="alert alert-danger" style="border-radius: 8px; padding: 1rem; display: flex; align-items: center; animation: slideDown 0.4s ease-out;">' + '<i class="fa fa-times-circle" style="font-size: 1.5rem; margin-right: 1rem;"></i>' + '<div><strong>Error de Conexión</strong><br>No se pudo verificar el documento. Intente nuevamente.</div>' + '</div>';
                $("#mensaje_verificacion_documento_modal_credito").html(mensajeHTML);
            }
        });
    });
});
</script>


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