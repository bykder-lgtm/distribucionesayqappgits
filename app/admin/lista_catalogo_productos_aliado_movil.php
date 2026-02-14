<?php 
$nombre_pagina          = "Catálogo de Productos";
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
<script src="../js/jquery-3.2.1.min_visitante.js"></script>

<style>
    .producto-card-movil-catalogo {
        background: white;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        overflow: hidden;
        margin-bottom: 0;
        transition: all 0.3s ease;
    }
    .producto-card-movil-catalogo:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 16px rgba(0,0,0,0.12);
    }
    .producto-imagen-container-catalogo {
        position: relative;
        width: 100%;
        padding-top: 85%; /* Aspecto más compacto */
        overflow: hidden;
        background: #f8f9fa;
    }
    .producto-imagen-catalogo {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .producto-badge-catalogo {
        position: absolute;
        top: 8px;
        right: 8px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 0.25rem 0.5rem;
        border-radius: 15px;
        font-size: 0.65rem;
        font-weight: 700;
        text-transform: uppercase;
        box-shadow: 0 2px 6px rgba(102, 126, 234, 0.4);
    }
    .producto-info-catalogo {
        padding: 0.75rem;
    }
    .producto-nombre-catalogo {
        font-size: 0.85rem;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 0.4rem;
        line-height: 1.3;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        min-height: 2.2rem;
    }
    .producto-tienda-catalogo {
        font-size: 0.7rem;
        color: #718096;
        margin-bottom: 0.4rem;
        display: flex;
        align-items: center;
    }
    .producto-tienda-catalogo i {
        margin-right: 0.25rem;
        color: #667eea;
        font-size: 0.7rem;
    }
    .producto-precios-catalogo {
        margin-bottom: 0.75rem;
    }
    .precio-credito-catalogo {
        font-size: 1.1rem;
        font-weight: 800;
        color: #667eea;
        margin-bottom: 0.15rem;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-wrap: nowrap;
        text-align: center;
        gap: 0.3rem;
    }
    .precio-contado-catalogo {
        font-size: 0.7rem;
        color: #48bb78;
        font-weight: 600;
    }
    .precio-contado-catalogo i {
        font-size: 0.65rem;
    }
    .btn-cotizar-producto-catalogo {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        padding: 0.6rem 0.75rem;
        border-radius: 6px;
        font-weight: 700;
        font-size: 0.75rem;
        width: 100%;
        text-align: center;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        box-shadow: 0 3px 10px rgba(102, 126, 234, 0.3);
    }
    .btn-cotizar-producto-catalogo:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 14px rgba(102, 126, 234, 0.5);
        text-decoration: none;
        color: white;
    }
    .btn-cotizar-producto-catalogo i {
        margin-right: 0.4rem;
        font-size: 0.8rem;
    }
    /* Filtros Compactos - Pills Horizontales */
    .filtros-container-compacto {
        margin-bottom: 1.5rem;
        padding: 0;
    }
    .filtros-scroll {
        display: flex;
        gap: 0.5rem;
        overflow-x: auto;
        padding: 0.5rem 0;
        -webkit-overflow-scrolling: touch;
        scrollbar-width: none; /* Firefox */
    }
    .filtros-scroll::-webkit-scrollbar {
        display: none; /* Chrome, Safari, Opera */
    }
    .categoria-pill-catalogo {
        display: inline-flex;
        align-items: center;
        padding: 0.6rem 1rem;
        background: white;
        border: 2px solid #e2e8f0;
        border-radius: 25px;
        font-size: 0.85rem;
        font-weight: 600;
        color: #4a5568;
        text-decoration: none;
        white-space: nowrap;
        transition: all 0.3s ease;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }
    .categoria-pill-catalogo i {
        margin-right: 0.4rem;
        font-size: 0.9rem;
    }
    .categoria-pill-catalogo:hover {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-color: #667eea;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(102, 126, 234, 0.3);
        text-decoration: none;
    }
    .categoria-pill-catalogo.active {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-color: #667eea;
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
    }
    .productos-grid-catalogo {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 0.75rem;
    }
    
    /* Móvil pequeño */
    @media (max-width: 576px) {
        .productos-grid-catalogo {
            grid-template-columns: repeat(2, 1fr);
            gap: 0.5rem;
        }
    }
    
    /* Tablet */
    @media (min-width: 768px) {
        .productos-grid-catalogo {
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
        }
    }
    
    /* Desktop y pantallas grandes */
    @media (min-width: 992px) {
        .productos-grid-catalogo {
            grid-template-columns: repeat(4, 1fr);
            gap: 1rem;
        }
    }
    
    /* Pantallas extra grandes */
    @media (min-width: 1200px) {
        .productos-grid-catalogo {
            grid-template-columns: repeat(5, 1fr);
            gap: 1.25rem;
        }
    }
    .header-catalogo {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 1.5rem 1rem;
        margin-bottom: 1.5rem;
        border-radius: 0 0 20px 20px;
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    }
    .header-catalogo h1 {
        font-size: 1.5rem;
        font-weight: 800;
        margin-bottom: 0.5rem;
        text-align: center;
    }
    .header-catalogo p {
        text-align: center;
        margin: 0;
        opacity: 0.9;
    }
    .empty-state {
        text-align: center;
        padding: 3rem 1rem;
        color: #718096;
    }
    .empty-state i {
        font-size: 4rem;
        margin-bottom: 1rem;
        color: #cbd5e0;
    }
    
    /* Diseño Buscador Compacto */
    .search_bar_app_movil_enrollment {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 0.75rem 0;
        box-shadow: 0 2px 8px rgba(102, 126, 234, 0.2);
        position: sticky;
        top: 0;
        z-index: 100;
    }
    
    .search-container-custom {
        position: relative;
        max-width: 100%;
        margin: 0 auto;
        z-index: 1;
    }
    
    .search-form-custom {
        position: relative;
        display: flex;
        align-items: center;
        background: white;
        border-radius: 25px;
        padding: 0.25rem;
        box-shadow: 0 3px 12px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }
    
    .search-form-custom:focus-within {
        box-shadow: 0 4px 16px rgba(0,0,0,0.15);
    }
    
    .search-icon-left {
        position: absolute;
        left: 1rem;
        color: #667eea;
        font-size: 0.95rem;
        z-index: 2;
        transition: all 0.3s ease;
    }
    .search-form-custom:focus-within .search-icon-left {
        color: #764ba2;
    }
    .search-input-custom {
        flex: 1;
        border: none;
        outline: none;
        padding: 0.6rem 0.8rem 0.6rem 2.5rem;
        font-size: 0.85rem;
        color: #2d3748;
        background: transparent;
        border-radius: 25px;
    }
    
    .search-input-custom::placeholder {
        color: #a0aec0;
    }
    
    .search-btn-custom {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        border-radius: 20px;
        padding: 0.6rem 1rem;
        font-weight: 600;
        font-size: 0.8rem;
        display: flex;
        align-items: center;
        gap: 0.4rem;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(102, 126, 234, 0.3);
    }
    
    .search-btn-custom:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.5);
    }
    
    .search-btn-custom:active {
        transform: scale(0.98);
    }
    
    .search-btn-custom i {
        font-size: 0.85rem;
    }
    
    .search-clear-btn {
        position: absolute;
        right: 100px;
        background: #e2e8f0;
        color: #718096;
        border: none;
        border-radius: 50%;
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        opacity: 0;
        visibility: hidden;
        font-size: 0.7rem;
    }
    
    .search-clear-btn.show {
        opacity: 1;
        visibility: visible;
    }
    
    .search-clear-btn:hover {
        background: #cbd5e0;
        transform: rotate(90deg);
    }
    
    @media (max-width: 576px) {
        .search-form-custom {
            padding: 0.2rem;
        }
        .search-input-custom {
            font-size: 0.8rem;
            padding: 0.55rem 0.5rem 0.55rem 2.2rem;
        }
        .search-btn-custom {
            padding: 0.6rem;
            font-size: 0.9rem;
            min-width: 40px;
            border-radius: 18px;
            gap: 0;
        }
        .search-btn-custom span {
            display: none;
        }
        .search-btn-custom i {
            margin: 0;
        }
        .search-icon-left {
            left: 0.75rem;
            font-size: 0.85rem;
        }
        .search-clear-btn {
            right: 50px;
            width: 22px;
            height: 22px;
        }
    }
    
    @media (max-width: 400px) {
        .search-input-custom {
            font-size: 0.75rem;
            padding: 0.5rem 0.4rem 0.5rem 2rem;
        }
        .search-btn-custom {
            padding: 0.55rem;
            min-width: 38px;
        }
        .search-icon-left {
            left: 0.65rem;
            font-size: 0.8rem;
        }
        .search-clear-btn {
            right: 48px;
            width: 20px;
            height: 20px;
            font-size: 0.65rem;
        }
    }
    
    /* Estilo para texto sujeto a línea de crédito */
    #prev_entidades_crediticias_container_part1 {
        display: inline-flex;
        align-items: center;
        justify-content: flex-start;
        gap: 0.3rem;
        margin-left: 0;
        vertical-align: middle;
        flex-shrink: 0;
    }
    
    #prev_entidades_crediticias_container_part1 .prev_entidades_crediticias {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 5px;
        background: rgba(102, 126, 234, 0.05);
        padding: 0.2rem 0.25rem;
        transition: all 0.2s ease;
    }
    
    #prev_entidades_crediticias_container_part1 .prev_entidades_crediticias:hover {
        background: rgba(102, 126, 234, 0.1);
        transform: scale(1.05);
    }
    
    #prev_entidades_crediticias_container_part1 .prev_entidades_crediticias img {
        display: block;
        max-height: 24px;
        width: auto;
        object-fit: contain;
        transition: all 0.2s ease;
    }
    
    /* Responsive para el contenedor de entidades crediticias en el precio */
    @media (max-width: 576px) {
        #prev_entidades_crediticias_container_part1 {
            gap: 0.2rem;
            margin-left: 0.3rem;
        }
        
        #prev_entidades_crediticias_container_part1 .prev_entidades_crediticias {
            padding: 0.15rem 0.2rem;
        }
        
        #prev_entidades_crediticias_container_part1 .prev_entidades_crediticias img {
            max-height: 24px;
        }
    }
    
    @media (max-width: 400px) {
        #prev_entidades_crediticias_container_part1 {
            gap: 0.15rem;
            margin-left: 0.25rem;
        }
        
        #prev_entidades_crediticias_container_part1 .prev_entidades_crediticias {
            padding: 0.12rem 0.15rem;
            border-radius: 4px;
        }
        
        #prev_entidades_crediticias_container_part1 .prev_entidades_crediticias img {
            max-height: 23px;
        }
        
        .precio-credito-catalogo {
            font-size: 1rem;
        }
    }
    
    @media (max-width: 320px) {
        #prev_entidades_crediticias_container_part1 {
            gap: 0.12rem;
            margin-left: 0.2rem;
        }
        
        #prev_entidades_crediticias_container_part1 .prev_entidades_crediticias img {
            max-height: 22px;
        }
        
        .precio-credito-catalogo {
            font-size: 0.95rem;
        }
    }
    /* Mostrar logos de entidades crediticias en una fila centrada */
    .prev_entidades_crediticias_container_part2 {
        display: flex;
        justify-content: center; /* Centrar horizontalmente */
        align-items: center;     /* Alinear verticalmente */
        gap: 0.25rem;            /* Separación reducida entre logos */
        flex-wrap: wrap;         /* Permitir salto en pantallas muy pequeñas */
        margin: 0.15rem 0;       /* Espacio vertical reducido */
        padding: 0.05rem;        /* Padding interno más pequeño */
    }
        .prev_entidades_crediticias_container_part3 {
        display: flex;
        justify-content: center; /* Centrar horizontalmente */
        align-items: center;     /* Alinear verticalmente */
        gap: 0.25rem;            /* Separación reducida entre logos */
        flex-wrap: wrap;         /* Permitir salto en pantallas muy pequeñas */
        margin: 0.15rem 0;       /* Espacio vertical reducido */
        padding: 0.05rem;        /* Padding interno más pequeño */
    }
    
    /* Estilos específicos para imágenes más pequeñas en part3 */
    .prev_entidades_crediticias_container_part3 .prev_entidades_crediticias img {
        max-height: 18px;        /* Imágenes más pequeñas que el estándar de 24px */
    }
    .prev_entidades_crediticias {
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 4px;      /* Bordes redondeados suaves */
        background: rgba(102, 126, 234, 0.05); /* Fondo sutil */
        padding: 0.1rem 0.2rem;  /* Padding interno reducido */
        transition: all 0.2s ease;
    }
    .prev_entidades_crediticias:hover {
        background: rgba(102, 126, 234, 0.1);
        transform: scale(1.05);  /* Efecto hover sutil */
    }
    .prev_entidades_crediticias img {
        display: block;
        max-height: 24px;        /* Altura estándar */
        width: auto;
        object-fit: contain;
        transition: all 0.2s ease;
    }

    /* Responsive para móviles medianos (576px y menos) */
    @media (max-width: 576px) {
        .prev_entidades_crediticias_container_part2 {
            gap: 0.15rem;        /* Separación más reducida */
            margin: 0.1rem 0;    /* Margen vertical muy reducido */
        }
        .prev_entidades_crediticias_container_part3 {
            gap: 0.15rem;        /* Separación más reducida */
            margin: 0.1rem 0;    /* Margen vertical muy reducido */
        }
        .prev_entidades_crediticias {
            padding: 0.08rem 0.15rem; /* Padding más compacto */
        }
        .prev_entidades_crediticias img {
            max-height: 20px;    /* Logos más pequeños */
        }
        /* Imágenes más pequeñas específicas para part3 en móviles medianos */
        .prev_entidades_crediticias_container_part3 .prev_entidades_crediticias img {
            max-height: 16px;
        }
    }

    /* Responsive para móviles pequeños (400px y menos) */
    @media (max-width: 400px) {
        .prev_entidades_crediticias_container_part2 {
            gap: 0.1rem;         /* Separación muy mínima */
            margin: 0.08rem 0;   /* Margen ultra mínimo */
            padding: 0.03rem;    /* Padding ultra mínimo */
        }
        .prev_entidades_crediticias_container_part3 {
            gap: 0.1rem;         /* Separación muy mínima */
            margin: 0.08rem 0;   /* Margen ultra mínimo */
            padding: 0.03rem;    /* Padding ultra mínimo */
        }
        .prev_entidades_crediticias {
            padding: 0.05rem 0.1rem; /* Máximo compacto */
            border-radius: 3px;     /* Bordes más pequeños */
        }
        .prev_entidades_crediticias img {
            max-height: 18px;    /* Logos muy pequeños para pantallas diminutas */
        }
        /* Imágenes más pequeñas específicas para part3 en móviles pequeños */
        .prev_entidades_crediticias_container_part3 .prev_entidades_crediticias img {
            max-height: 14px;
        }
    }

    /* Responsive para pantallas muy pequeñas (320px y menos) */
    @media (max-width: 320px) {
        .prev_entidades_crediticias_container_part2 {
            gap: 0.05rem;        /* Separación ultra mínima */
            flex-direction: row; /* Forzar fila aunque sean muchos logos */
            overflow-x: auto;    /* Scroll horizontal si no caben */
            padding: 0.02rem 0;  /* Padding mínimo vertical */
            margin: 0.05rem 0;   /* Margen vertical ultra compacto */
        }
        .prev_entidades_crediticias_container_part3 {
            gap: 0.05rem;        /* Separación ultra mínima */
            flex-direction: row; /* Forzar fila aunque sean muchos logos */
            overflow-x: auto;    /* Scroll horizontal si no caben */
            padding: 0.02rem 0;  /* Padding mínimo vertical */
            margin: 0.05rem 0;   /* Margen vertical ultra compacto */
        }
        .prev_entidades_crediticias {
            padding: 0.03rem 0.08rem; /* Ultra compacto */
            min-width: 30px;         /* Ancho mínimo para evitar colapso */
        }
        .prev_entidades_crediticias img {
            max-height: 16px;    /* Logos extra pequeños */
            min-width: 20px;     /* Ancho mínimo para legibilidad */
        }
        /* Imágenes más pequeñas específicas para part3 en pantallas muy pequeñas */
        .prev_entidades_crediticias_container_part3 .prev_entidades_crediticias img {
            max-height: 12px;
            min-width: 16px;
        }
    }
</style>
</head>
<body>
<?php include_once("../admin/01_modulo_encabezado_superior_visitante_intern_movil.php"); ?>

<?php
// Variables de encriptación y configuración
$tab                               = "producto";
$tab_codif                         = DAXCODIFCRYPTOR::encodiftextodax($tab);
$tab_codifcryp                     = DAXCODIFCRYPTOR::encriptardax($tab_codif);

$campo                             = "cod_producto";
$campo_codif                       = DAXCODIFCRYPTOR::encodiftextodax($campo);
$campo_codifcryp                   = DAXCODIFCRYPTOR::encriptardax($campo_codif);

$tipo                              = "carrito";
$tipo_codif                        = DAXCODIFCRYPTOR::encodiftextodax($tipo);
$tipo_codifcryp                    = DAXCODIFCRYPTOR::encriptardax($tipo_codif);

$accion                            = "registrar";
$accion_codif                      = DAXCODIFCRYPTOR::encodiftextodax($accion);
$accion_codifcryp                  = DAXCODIFCRYPTOR::encriptardax($accion_codif);

$origen                            = "carrito";
$origen_codif                      = DAXCODIFCRYPTOR::encodiftextodax($origen);
$origen_codifcryp                  = DAXCODIFCRYPTOR::encriptardax($origen_codif);

$und_vendida                       = 1;
$nombre_tipo_origen_simulacion     = "TIENDA_VIRTUAL";

// Obtener el interés predeterminado
$sql_entidad_crediticia_predeterminada = "SELECT entidad_crediticia_interes_ptj FROM tbl15_entidad_crediticia WHERE cod_estado_entidad_predeterminada_interes_defect = '1'";
$consulta_entidad_crediticia = mysqli_query($conectar, $sql_entidad_crediticia_predeterminada) or die(mysqli_error($conectar));
$matriz_entidad_crediticia = mysqli_fetch_assoc($consulta_entidad_crediticia);
$entidad_crediticia_interes_ptj = $matriz_entidad_crediticia['entidad_crediticia_interes_ptj'];

if (isset($_GET['buscador'])) { $buscador_get = addslashes($_GET['buscador']); } else { $buscador_get = ''; }
?>

    <!-- Header del Catálogo -->
<!--
    <div class="header-catalogo">
        <h1><i class="fa fa-shopping-bag"></i> Catálogo de Productos</h1>
        <p>Encuentra los mejores productos con crédito</p>
    </div>
-->
    <!-- Contenido Principal -->
    <main class="container py-2 mb-5">
        <!-- Buscador Interactivo -->
        <section class="search_bar_app_movil_enrollment">
            <div class="container">
                <div class="search-container-custom">
                    <form action="" method="GET" class="search-form-custom">
                        <i class="fa fa-search search-icon-left"></i>
                        <input type="search" class="search-input-custom" name="buscador" id="buscador" value="<?php echo $buscador_get ?>" placeholder="Busca por nombre, código o descripción..." autocomplete="on">
                        <button type="button" class="search-clear-btn" id="clearSearch" title="Limpiar búsqueda"><i class="fa fa-times"></i></button>
                        <button class="search-btn-custom" type="submit"><i class="fa fa-search"></i><span>Buscar</span></button>
                    </form>
                </div>
            </div>
        </section>

        <!-- Filtro de Categorías Compacto (Pills Horizontales) -->
        <div class="filtros-container-compacto">
            <div class="filtros-scroll">
                <a href="?todos=1" class="categoria-pill-catalogo <?php echo (!isset($_GET['cod_categoria']) ? 'active' : ''); ?>">
                    <i class="fa fa-th"></i> Todos
                </a>
<?php
$sql_categorias = "SELECT cod_categoria, nombre_categoria FROM tbl15_categoria WHERE cod_estado = '1' ORDER BY nombre_categoria ASC";
$consulta_categorias = mysqli_query($conectar, $sql_categorias);
while($categoria = mysqli_fetch_assoc($consulta_categorias)) {
    $cod_cat = $categoria['cod_categoria'];
    $nombre_cat = $categoria['nombre_categoria'];
    $is_active = (isset($_GET['cod_categoria']) && $_GET['cod_categoria'] == $cod_cat) ? 'active' : '';
?>
                <a href="?cod_categoria=<?php echo $cod_cat; ?>" class="categoria-pill-catalogo <?php echo $is_active; ?>">
                    <i class="fa fa-tag"></i> <?php echo $nombre_cat; ?>
                </a>
<?php } ?>
            </div>
        </div>
        <!-- Grid de Productos -->
        <div class="productos-grid-catalogo">
<?php
$contador = 0;

// Construir consulta según filtros
$sql_producto = "SELECT cod_producto, cod_producto_barra, nombre_producto, und_producto, precio_venta_producto, descripcion_producto, 
    precio_venta_producto2, url_img_min_producto, url_img_orig_producto, nombre_promocion, nombre_promocion_ing, 
    cod_categoria, cod_estado, cod_tienda FROM tbl15_producto WHERE (nombre_estado = 'HABILITADO') AND (cod_tienda = '$cod_tienda')";

// Filtro por categoría
if (isset($_GET['cod_categoria']) && $_GET['cod_categoria'] != '') { $cod_categoria = intval($_GET['cod_categoria']); $sql_producto .= " AND (cod_categoria = '$cod_categoria')"; }
// Filtro por búsqueda
if (isset($_GET['buscador']) && trim($_GET['buscador']) != '') { $buscador_get = mysqli_real_escape_string($conectar, trim($_GET['buscador'])); $sql_producto .= " AND (nombre_producto LIKE '%$buscador_get%' OR descripcion_producto LIKE '%$buscador_get%' OR cod_producto_barra LIKE '%$buscador_get%')"; }
$sql_producto .= " ORDER BY nombre_producto DESC";
// Si no hay filtros, limitar resultados
if (!isset($_GET['cod_categoria']) && (!isset($_GET['buscador']) || trim($_GET['buscador']) == '')) { $sql_producto .= " LIMIT 50"; }

$consulta_producto = mysqli_query($conectar, $sql_producto) or die(mysqli_error($conectar));
$total_productos = mysqli_num_rows($consulta_producto);

if($total_productos > 0) {
    while ($datos_producto = mysqli_fetch_assoc($consulta_producto)) {

        $contador++;
        $cod_producto                                                 = $datos_producto['cod_producto'];
        $cod_producto_codif                                           = DAXCODIFCRYPTOR::encodifdax($cod_producto);
        $cod_producto_codifcryp                                       = DAXCODIFCRYPTOR::encriptardax($cod_producto_codif);

        $cod_producto_barra                                           = $datos_producto['cod_producto_barra'];
        $nombre_producto                                              = $datos_producto['nombre_producto'];
        $und_producto                                                 = $datos_producto['und_producto'];
        $precio_venta_producto                                        = $datos_producto['precio_venta_producto'];
        $precio_venta_producto2                                       = $datos_producto['precio_venta_producto2'];
        $descripcion_producto                                         = $datos_producto['descripcion_producto'];
        $cod_categoria                                                = $datos_producto['cod_categoria'];
        $url_img_min_producto                                         = $datos_producto['url_img_min_producto'];
        $url_img_orig_producto                                        = $datos_producto['url_img_orig_producto'];
        $nombre_promocion                                             = $datos_producto['nombre_promocion'];
        $nombre_promocion_ing                                         = $datos_producto['nombre_promocion_ing'];
        $cod_estado                                                   = $datos_producto['cod_estado'];
        $cod_tienda_db                                                = $datos_producto['cod_tienda'];
        $precio_venta_producto_mas_comision_funcionamiento            = round($precio_venta_producto / ((100/100) - ($entidad_crediticia_interes_ptj/100)), -3);
        
        if ($url_img_min_producto=='') { $url_img_min_producto = '../archivador/img_producto/orig/sin_imagen.jpg'; }

        $sql_promocion = "SELECT * FROM tbl15_tienda WHERE cod_tienda = '$cod_tienda_db'";
        $consulta_promocion = mysqli_query($conectar, $sql_promocion) or die(mysqli_error($conectar));
        $matriz_promocion = mysqli_fetch_assoc($consulta_promocion);
        $nombre_tienda = $matriz_promocion['nombre_tienda'];
?>
            <div class="producto-card-movil-catalogo">
                <div class="producto-imagen-container-catalogo">
                    <img src="<?php echo $url_img_min_producto ?>" alt="<?php echo $nombre_producto ?>" class="producto-imagen-catalogo">
                    <?php if($nombre_promocion != ''): ?>
                    <div class="producto-badge-catalogo"><?php echo $nombre_promocion ?></div>
                    <?php endif; ?>
                </div>
                <div class="producto-info-catalogo">
                    <h3 class="producto-nombre-catalogo"><?php echo $nombre_producto ?></h3>
                    <!--
                    <div class="producto-tienda-catalogo">
                        <i class="fa fa-store"></i> <?php echo $nombre_tienda ?>
                    </div>
                    -->
                    <div class="producto-precios-catalogo">
                        <div class="precio-credito-catalogo">
                            <i class="fa fa-credit-card"></i> $<?php echo number_format($precio_venta_producto_mas_comision_funcionamiento, 0, ",", ".") ?> 
                            <span id="prev_entidades_crediticias_container_part1">
                            <?php
                            $sql_entidad_crediticia_part1 = "SELECT * FROM tbl15_entidad_crediticia WHERE (cod_estado = '1') AND (cod_posicion_frag_catalogo = '1') ORDER BY cod_posicion ASC";
                            $consulta_entidad_crediticia_part1 = mysqli_query($conectar, $sql_entidad_crediticia_part1) or die(mysqli_error($conectar));
                            while ($datos_entidad_crediticia_part1 = mysqli_fetch_assoc($consulta_entidad_crediticia_part1)) {

                                $cod_entidad_crediticia_db                                        = $datos_entidad_crediticia_part1['cod_entidad_crediticia'];
                                $nombre_entidad_crediticia                                        = $datos_entidad_crediticia_part1['nombre_entidad_crediticia'];
                                $url_entidad_crediticia_imag_min                                  = $datos_entidad_crediticia_part1['url_entidad_crediticia_imag_min'];
                            ?>
                                <div class="prev_entidades_crediticias">
                                    <img src="<?php echo $url_entidad_crediticia_imag_min ?>" alt="<?php echo $nombre_entidad_crediticia ?>">
                                </div>
                            <?php } ?> 
                            </span>
                        </div>
                        <div class="precio-contado-catalogo">
                            <i class="fa fa-money-bill-wave"></i> Desde: $<?php echo number_format($precio_venta_producto, 0, ",", ".") ?>
                        </div>
                        <!--Contenedor para mostrar los logos en fila y centrados-->
                        <div class="prev_entidades_crediticias_container_part2">
                            <?php
                            $sql_entidad_crediticia = "SELECT * FROM tbl15_entidad_crediticia WHERE (cod_estado = '1') AND (cod_posicion_frag_catalogo = '2') ORDER BY cod_posicion ASC";
                            $consulta_entidad_crediticia = mysqli_query($conectar, $sql_entidad_crediticia) or die(mysqli_error($conectar));
                            $total_entidades = mysqli_num_rows($consulta_entidad_crediticia);
                            while ($datos_entidad_crediticia = mysqli_fetch_assoc($consulta_entidad_crediticia)) {

                                $cod_entidad_crediticia_db                                        = $datos_entidad_crediticia['cod_entidad_crediticia'];
                                $nombre_entidad_crediticia                                        = $datos_entidad_crediticia['nombre_entidad_crediticia'];
                                $url_entidad_crediticia_imag_min                                  = $datos_entidad_crediticia['url_entidad_crediticia_imag_min'];
                            ?>
                                <div class="prev_entidades_crediticias">
                                    <img src="<?php echo $url_entidad_crediticia_imag_min ?>" alt="<?php echo $nombre_entidad_crediticia ?>" class="">
                                </div>
                            <?php } ?>
                        </div>
                        <div class="prev_entidades_crediticias_container_part3">
                            <?php
                            $sql_entidad_crediticia = "SELECT * FROM tbl15_entidad_crediticia WHERE (cod_estado = '1') AND (cod_posicion_frag_catalogo = '3') ORDER BY cod_posicion ASC";
                            $consulta_entidad_crediticia = mysqli_query($conectar, $sql_entidad_crediticia) or die(mysqli_error($conectar));
                            $total_entidades = mysqli_num_rows($consulta_entidad_crediticia);
                            while ($datos_entidad_crediticia = mysqli_fetch_assoc($consulta_entidad_crediticia)) {

                                $cod_entidad_crediticia_db                                        = $datos_entidad_crediticia['cod_entidad_crediticia'];
                                $nombre_entidad_crediticia                                        = $datos_entidad_crediticia['nombre_entidad_crediticia'];
                                $url_entidad_crediticia_imag_min                                  = $datos_entidad_crediticia['url_entidad_crediticia_imag_min'];
                            ?>
                                <div class="prev_entidades_crediticias">
                                    <img src="<?php echo $url_entidad_crediticia_imag_min ?>" alt="<?php echo $nombre_entidad_crediticia ?>" class="">
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <a href="../admin/resultado_simulador_credito_aliado_movil.php?cod_producto_codifcryp=<?php echo $cod_producto_codifcryp ?>&cod_categoria=<?php echo $cod_categoria ?>&nombre_tipo_origen_simulacion=<?php echo $nombre_tipo_origen_simulacion ?>" id="btn-cotizar-producto-catalogo" class="btn-cotizar-producto-catalogo"><i class="fa fa-calculator"></i> Cotizar a Crédito</a>
                </div>
            </div>
<?php 
    }
} else {
?>
    <div class="col-12">
        <div class="empty-state">
            <i class="fa fa-box-open"></i><h3>No se encontraron productos</h3><p>Intenta con otra búsqueda o categoría</p>
        </div>
    </div>
<?php
}
?>
        </div>
    </main>

<?php //include_once("../seguridad/seguridad_diseno_plantillas_visitante_intern.php"); ?>
<?php include_once("../menu/05_modulo_menu_aliado_movil.php"); ?>
<?php include_once("../admin/10_modulo_sin_js_visitante_intern_movil.php"); ?>
</body>
</html>

<script>
// Script para interactividad del buscador
$(document).ready(function() {
    const searchInput = $('#buscador');
    const clearBtn = $('#clearSearch');
    const searchForm = $('.search-form-custom');
    
    // Mostrar/ocultar botón de limpiar
    function toggleClearButton() {
        if(searchInput.val().trim() !== '') {
            clearBtn.addClass('show');
        } else {
            clearBtn.removeClass('show');
        }
    }
    
    // Verificar al cargar la página
    toggleClearButton();
    
    // Verificar mientras se escribe
    searchInput.on('input', function() {
        toggleClearButton();
    });
    
    // Limpiar búsqueda
    clearBtn.on('click', function() {
        searchInput.val('');
        toggleClearButton();
        searchInput.focus();
        
        // Si hay parámetros en la URL, recargar sin el buscador
        const currentUrl = window.location.href;
        if(currentUrl.includes('buscador=')) {
            const url = new URL(currentUrl);
            url.searchParams.delete('buscador');
            window.location.href = url.toString();
        }
    });
    
    // Buscar al presionar Enter
    searchInput.on('keypress', function(e) {
        if(e.which === 13) {
            searchForm.submit();
        }
    });
    
    // Efecto de foco en el input
    searchInput.on('focus', function() {
        $(this).attr('placeholder', 'Escribe aquí...');
    }).on('blur', function() {
        $(this).attr('placeholder', 'Busca por nombre, código o descripción...');
    });
    
    // Animación al enviar formulario
    searchForm.on('submit', function() {
        if(searchInput.val().trim() !== '') {
            $('.search-btn-custom').html('<i class="fa fa-spinner fa-spin"></i> Buscando...');
        }
    });
});
</script>
