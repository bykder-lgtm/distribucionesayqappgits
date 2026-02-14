<?php 
$nombre_pagina          = "Simulador de Crédito";
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
<link rel="stylesheet" href="../estilo_css/normalize_visitante.css">
<link rel="stylesheet" href="../estilo_css/font-awesome.min.css">
<script src="../js/jquery-3.2.1.min_visitante.js"></script>

<style>
    body {
        background: linear-gradient(135deg, #0a0e27 0%, #1a1d3a 100%);
        min-height: 100vh;
    }
    
    .simulador-header {
        background: linear-gradient(135deg, #4169e1 0%, #5b7ce6 100%);
        color: white;
        padding: 1.5rem;
        border-radius: 0 0 20px 20px;
        margin-bottom: 1.5rem;
        box-shadow: 0 4px 15px rgba(65, 105, 225, 0.4);
        text-align: center;
    }
    
    .simulador-header h1 {
        font-size: 1.4rem;
        font-weight: 800;
        margin: 0;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    }
    
    .simulador-card-resultado {
        background: linear-gradient(135deg, #1a1d3a 0%, #0a0e27 100%);
        border: 1px solid rgba(65, 105, 225, 0.3);
        border-radius: 15px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 4px 15px rgba(65, 105, 225, 0.2);
    }
    
    .info-group {
        margin-bottom: 1.5rem;
    }
    
    .info-group label {
        display: block;
        font-weight: 700;
        color: #00d4ff;
        margin-bottom: 0.5rem;
        font-size: 0.9rem;
    }
    
    .info-display {
        background: rgba(65, 105, 225, 0.1);
        padding: 1rem;
        border-radius: 10px;
        border: 2px solid #4169e1;
        font-size: 1rem;
        color: white;
        font-weight: 600;
    }
    
    .form-group-resultado {
        margin-bottom: 1.25rem;
    }
    
    .form-group-resultado label {
        display: block;
        font-weight: 700;
        color: #00d4ff;
        margin-bottom: 0.5rem;
        font-size: 0.9rem;
    }
    
    .form-group-resultado input,
    .form-group-resultado select {
        width: 100%;
        padding: 0.875rem;
        border: 2px solid #4169e1;
        border-radius: 10px;
        font-size: 1rem;
        background: rgba(26, 29, 58, 0.8);
        color: white;
        transition: all 0.3s ease;
    }
    
    .form-group-resultado input:focus,
    .form-group-resultado select:focus {
        outline: none;
        border-color: #00d4ff;
        box-shadow: 0 0 0 3px rgba(0, 212, 255, 0.2);
        background: rgba(26, 29, 58, 1);
    }
    
    .btn-simular-resultado {
        background: linear-gradient(135deg, #4169e1 0%, #5b7ce6 100%);
        color: white;
        border: none;
        padding: 1rem;
        border-radius: 12px;
        font-weight: 700;
        font-size: 1rem;
        width: 100%;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(65, 105, 225, 0.4);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }
    
    .btn-simular-resultado:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 212, 255, 0.6);
        background: linear-gradient(135deg, #00d4ff 0%, #4169e1 100%);
    }
    
    .btn-simular-resultado:active {
        transform: translateY(0);
    }
    
    .btn-simular-resultado i {
        font-size: 1.1rem;
    }
    
    .error-mensaje {
        text-align: center;
        padding: 3rem 1.5rem;
        background: linear-gradient(135deg, #1a1d3a 0%, #0a0e27 100%);
        border: 1px solid rgba(65, 105, 225, 0.3);
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(65, 105, 225, 0.2);
        color: white;
    }
    
    .error-mensaje i {
        font-size: 4rem;
        color: #ff6f00;
    }
        color: #cbd5e0;
        margin-bottom: 1rem;
    }
    
    .error-mensaje h3 {
        color: #4a5568;
        margin-bottom: 0.5rem;
    }
    
    @media (max-width: 576px) {
        .simulador-header h1 {
            font-size: 1.2rem;
        }
        
        .simulador-card-resultado {
            padding: 1.25rem;
        }
    }
</style>
</head>
<body>
<?php include_once("../admin/01_modulo_encabezado_superior_visitante_intern_movil.php"); ?>

<!-- Start Cart -->
<?php
if (isset($_REQUEST['precio_venta_producto'])) {

    if (isset($_REQUEST['valor_credito'])) { $valor_credito = addslashes($_REQUEST['valor_credito']); } else { $valor_credito = ''; }
    if (isset($_REQUEST['cod_entidad_crediticia'])) { $cod_entidad_crediticia = addslashes($_REQUEST['cod_entidad_crediticia']); } else { $cod_entidad_crediticia = '0'; }
    if (isset($_REQUEST['cod_tipo_cobro'])) { $cod_tipo_cobro = addslashes($_REQUEST['cod_tipo_cobro']); } else { $cod_tipo_cobro = '0'; }
    if (isset($_REQUEST['cod_meses_credito'])) { $cod_meses_credito = addslashes($_REQUEST['cod_meses_credito']); } else { $cod_meses_credito = '1'; }
    if (isset($_REQUEST['nombre_tipo_origen_simulacion'])) { $nombre_tipo_origen_simulacion = addslashes($_REQUEST['nombre_tipo_origen_simulacion']); } else { $nombre_tipo_origen_simulacion = ''; }
    if (isset($_REQUEST['nombre_producto'])) { $nombre_producto = addslashes($_REQUEST['nombre_producto']); } else { $nombre_producto = ''; }
    //---------------------------------------------------------------------------------------------------------------------------------//
    //---------------------------------------------------------------------------------------------------------------------------------//
    $sql_entidad_crediticia_predeterminada_interes_defect = "SELECT entidad_crediticia_interes_ptj FROM tbl15_entidad_crediticia WHERE cod_estado_entidad_predeterminada_interes_defect = '1'";
    $consulta_entidad_crediticia_predeterminada_interes_defect = mysqli_query($conectar, $sql_entidad_crediticia_predeterminada_interes_defect) or die(mysqli_error($conectar));
    $matriz_entidad_crediticia_predeterminada_interes_defect = mysqli_fetch_assoc($consulta_entidad_crediticia_predeterminada_interes_defect);

    $entidad_crediticia_interes_ptj                               = $matriz_entidad_crediticia_predeterminada_interes_defect['entidad_crediticia_interes_ptj'];
    //---------------------------------------------------------------------------------------------------------------------------------//
    if ($nombre_tipo_origen_simulacion == 'TIENDA_VIRTUAL') {
        $cod_producto_codifcryp            = ($_REQUEST['cod_producto_codifcryp']);
        $cod_producto_codif                = DAXCODIFCRYPTOR::descriptardax($cod_producto_codifcryp);
        $cod_producto                      = intval(DAXCODIFCRYPTOR::descodifdax($cod_producto_codif));

        $sql_producto = "SELECT cod_producto, cod_producto_barra, nombre_producto, und_producto, precio_venta_producto, descripcion_producto, 
        precio_venta_producto2, url_img_min_producto, url_img_orig_producto, nombre_promocion, nombre_promocion_ing, 
        cod_categoria, cod_estado FROM tbl15_producto WHERE (cod_producto = '$cod_producto')";
        $consulta_producto = mysqli_query($conectar, $sql_producto) or die(mysqli_error($conectar));
        $datos_producto = mysqli_fetch_assoc($consulta_producto);

        $cod_producto_barra                                           = $datos_producto['cod_producto_barra'];
        $nombre_producto                                              = $datos_producto['nombre_producto'];
        $cod_categoria                                                = $datos_producto['cod_categoria'];
        $precio_venta_producto                                        = $datos_producto['precio_venta_producto'];
        $precio_venta_producto_mas_comision_funcionamiento            = round($precio_venta_producto / ((100/100) - ($entidad_crediticia_interes_ptj/100)), -3);
    } elseif ($nombre_tipo_origen_simulacion == 'SIMULACION_VALOR_LIBRE') {
        $cod_producto_barra                                           = "";
        $nombre_producto                                              = addslashes($_REQUEST['nombre_producto']);
        $cod_categoria                                                = '';
        $precio_venta_producto                                        = intval($_REQUEST['precio_venta_producto']);
        $cod_producto_codifcryp                                       = ''; 
        $cod_producto_codif                                           = ''; 
        $cod_producto                                                 = ''; 
        $precio_venta_producto_mas_comision_funcionamiento            = round($precio_venta_producto / ((100/100) - ($entidad_crediticia_interes_ptj/100)), -3);
    } else {
        $cod_producto_barra                                           = "";
        $nombre_producto                                              = "";
        $cod_categoria                                                = '';
        $precio_venta_producto                                        = 0;
        $cod_producto_codifcryp                                       = ''; 
        $cod_producto_codif                                           = ''; 
        $cod_producto                                                 = ''; 
        $precio_venta_producto_mas_comision_funcionamiento            = 0;
    }
    //---------------------------------------------------------------------------------------------------------------------------------//
    //---------------------------------------------------------------------------------------------------------------------------------//
    ?>
    
    <!-- Header -->
    <div class="simulador-header">
        <h1><i class="fa fa-calculator"></i> Simulador de Crédito</h1>
        <p style="margin: 0.5rem 0 0 0; font-size: 0.9rem; opacity: 0.95;">Completa la información para continuar</p>
    </div>
    
    <!-- Formulario -->
    <main class="container pb-5 mb-5">
        <form name="formulario_de_actualizacion" method="POST" action="../admin/simulador_credito_producto_visitante_intern_interes_max_entidad_crediticia_resultado_get_movil.php">
            <div class="simulador-card-resultado">
                
                <!-- Nombre del Producto -->
                <div class="info-group">
                    <label><i class="fa fa-cube"></i> Nombre del producto</label>
                    <?php if ($nombre_producto != '') { ?>
                        <div class="info-display"><?php echo $nombre_producto ?></div>
                    <?php } else { ?>
                        <div class="form-group-resultado">
                            <input type="text" class="form-control" name="nombre_producto" id="nombre_producto" placeholder="Ingresa el nombre del producto" required>
                        </div>
                    <?php } ?>
                </div>
                
                <!-- Valor del Crédito -->
                <div class="info-group">
                    <label><i class="fa fa-dollar"></i> Valor del crédito</label>
                    <div class="info-display">$<?php echo number_format($precio_venta_producto_mas_comision_funcionamiento, 0, ",", ".") ?></div>
                </div>
                
                <!-- Categoría -->
                <div class="form-group-resultado">
                    <label><i class="fa fa-tag"></i> Categoría *</label>
                    <select id="cod_categoria" name="cod_categoria" required>
                        <option value="">Selecciona una categoría</option>
                        <?php 
                        $consulta2_sql = "SELECT cod_categoria, nombre_categoria FROM tbl15_categoria WHERE (cod_estado = '1') ORDER BY nombre_categoria ASC";
                        $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysqli_error($conectar));
                        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                            if(isset($cod_categoria) and $cod_categoria == $datos2['cod_categoria']) {
                                $seleccionado = "selected"; 
                            } else { 
                                $seleccionado = ""; 
                            }
                            $codigo = $datos2['cod_categoria'];
                            $nombre = $datos2['nombre_categoria'];
                            echo "<option value='".$codigo."' $seleccionado>".$nombre."</option>"; 
                        } 
                        ?>
                    </select>
                </div>
                
                <!-- Campos Ocultos -->
                <input type="hidden" name="nombre_tipo_origen_simulacion" value="<?php echo $nombre_tipo_origen_simulacion ?>">
                <input type="hidden" name="precio_venta_producto" value="<?php echo $precio_venta_producto ?>">
                <input type="hidden" name="cod_producto_codifcryp" id="cod_producto_codifcryp" value="<?php echo $cod_producto_codifcryp ?>">
                <input type="hidden" name="cod_meses_credito" value="<?php echo $cod_meses_credito ?>">
                <input type="hidden" name="precio_venta_producto_mas_comision_funcionamiento" value="<?php echo $precio_venta_producto_mas_comision_funcionamiento ?>">
                <input type="hidden" name="MM_update" value="formulario_de_actualizacion">
                <input type="hidden" name="insertar_datos" value="formulario">
                
                <!-- Botón de Simulación -->
                <button class="btn-simular-resultado" type="submit">
                    <i class="fa fa-play-circle"></i>
                    <span>Simular Crédito</span>
                </button>
                
            </div>
        </form>
    </main>
    
<?php } else { ?>
    
    <!-- Mensaje de Error -->
    <main class="container py-5">
        <div class="error-mensaje">
            <i class="fa fa-exclamation-triangle"></i>
            <h3>Datos incompletos</h3>
            <p>No se recibieron los datos necesarios para realizar la simulación.</p>
            <a href="../admin/simulador_credito_visitante_intern_interes_max_entidad_crediticia_libre_aliado_movil.php" class="btn-simular-resultado" style="display: inline-flex; width: auto; margin-top: 1rem; padding: 0.75rem 1.5rem;">
                <i class="fa fa-arrow-left"></i>
                <span>Volver al inicio</span>
            </a>
        </div>
    </main>
    
<?php } ?>
<!-- End Cart -->
<?php //include_once("../seguridad/seguridad_diseno_plantillas_visitante_intern.php"); ?>
<?php include_once("../menu/05_modulo_menu_aliado_movil.php"); ?>
<?php include_once("../admin/10_modulo_sin_js_visitante_intern_movil.php"); ?>

</body>
</html>
