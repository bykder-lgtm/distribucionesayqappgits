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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Bootstrap JS (Required for Modals) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Quill Editor -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

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
if (isset($_GET['cod_tienda'])) { $cod_tienda_filtro = mysqli_real_escape_string($conectar, $_GET['cod_tienda']); } else { $cod_tienda_filtro = ''; }

// Determinar la tienda para registro: Priorizar filtro GET, luego buscar asociada
$cod_tienda_sesion = 0;

if (!empty($cod_tienda_filtro)) {
    // Si viene por GET, usar esa tienda
    $cod_tienda_sesion = $cod_tienda_filtro;
} elseif (isset($cod_administrador)) {
    // Si no, buscar la primera asociada al aliado
    $sql_tienda_aliado = "SELECT cod_tienda FROM tbl15_tienda WHERE cod_aliado_estrategico = '$cod_administrador' LIMIT 1";
    $consulta_tienda_aliado = mysqli_query($conectar, $sql_tienda_aliado);
    if ($consulta_tienda_aliado && mysqli_num_rows($consulta_tienda_aliado) > 0) {
        $matriz_tienda_aliado = mysqli_fetch_assoc($consulta_tienda_aliado);
        $cod_tienda_sesion = $matriz_tienda_aliado['cod_tienda'];
    }
}

// Obtener nombre de la tienda para mostrarlo
$nombre_tienda_mostrar = "Catálogo de Productos";
if ($cod_tienda_sesion > 0) {
    $sql_nom_tienda = "SELECT nombre_tienda FROM tbl15_tienda WHERE cod_tienda = '$cod_tienda_sesion'";
    $res_nom_tienda = mysqli_query($conectar, $sql_nom_tienda);
    if ($res_nom_tienda && mysqli_num_rows($res_nom_tienda) > 0) {
        $fila_nom = mysqli_fetch_assoc($res_nom_tienda);
        $nombre_tienda_mostrar = $fila_nom['nombre_tienda'];
    }
}
?>

    <!-- Header del Catálogo -->
<!--
    <div class="header-catalogo">
        <h1><i class="fa fa-shopping-bag"></i> Catálogo de Productos</h1>
        <p>Encuentra los mejores productos con crédito</p>
    </div>
-->
    <div class="header-catalogo-tienda">
        <div class="container text-center">
            <h1 class="mb-0" style="font-size: 1.2rem; font-weight: 700;"><i class="fa fa-store"></i> <?php echo $nombre_tienda_mostrar; ?></h1>
            <?php if ($cod_tienda_sesion > 0 && $nombre_tienda_mostrar != "Catálogo de Productos"): ?>
                <p class="mb-0" style="font-size: 0.8rem; opacity: 0.9;">Catálogo de Productos</p>
            <?php endif; ?>
        </div>
    </div>
    <style>
        .header-catalogo-tienda {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 1rem 0;
            margin-bottom: 0;
            border-radius: 0 0 15px 15px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            position: relative;
            z-index: 90;
        }
    </style>

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

        <?php if ($cod_tienda_sesion > 0): ?>
        <!-- Botón Registrar Producto -->
        <div class="container mt-3 mb-2">
            <button type="button" class="btn-nuevo-producto-aliado" data-toggle="modal" data-target="#modalRegistrarProducto">
                <i class="fa fa-plus-circle"></i> Registrar Nuevo Producto
            </button>
        </div>
        <style>
            .btn-nuevo-producto-aliado {
                width: 100%;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
                border: none;
                padding: 0.8rem;
                border-radius: 12px;
                font-weight: 700;
                font-size: 0.9rem;
                text-transform: uppercase;
                box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
                transition: all 0.3s ease;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 0.5rem;
                cursor: pointer;
            }
            .btn-nuevo-producto-aliado:hover {
                transform: translateY(-2px);
                box-shadow: 0 6px 16px rgba(102, 126, 234, 0.5);
                color: white;
            }
        </style>
        <?php endif; ?>

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
    cod_categoria, cod_estado, cod_tienda FROM tbl15_producto WHERE (cod_estado = '1')";

// Filtro por tienda (si viene por GET)
if (!empty($cod_tienda_filtro)) {
    $sql_producto .= " AND (cod_tienda = '$cod_tienda_filtro')";
}

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
<?php include_once("../menu/05_modulo_menu_vendedor_movil.php"); ?>
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
<?php
// Obtener el próximo código de producto si hay tienda
$nuevo_cod_producto_barra = 1;
if ($cod_tienda_sesion > 0) {
    $mostrar_datos_sql = "SELECT cod_producto_barra FROM tbl15_producto ORDER BY LPAD(lower(cod_producto_barra), 20,0) DESC LIMIT 0,1";
    $consulta_codigo = mysqli_query($conectar, $mostrar_datos_sql);
    if ($consulta_codigo && mysqli_num_rows($consulta_codigo) > 0) {
        $matriz_consulta = mysqli_fetch_assoc($consulta_codigo);
        $nuevo_cod_producto_barra = $matriz_consulta['cod_producto_barra'] + 1;
    }
}
?>

<!-- Modal Registrar Producto -->
<div class="modal fade modal-producto-aliado" id="modalRegistrarProducto" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa fa-plus-circle"></i> Registrar Nuevo Producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="result_register"></div>
                <form id="formRegistroProducto" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Código Producto *</label>
                                <input type="text" name="cod_producto_barra" id="reg_cod_producto_barra" value="<?php echo $nuevo_cod_producto_barra; ?>" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nombre Producto *</label>
                                <input type="text" name="nombre_producto" id="reg_nombre_producto" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Precio Compra *</label>
                                <input type="text" name="precio_compra_producto" id="reg_precio_compra_producto" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Precio Venta (Contado) *</label>
                                <input type="text" name="precio_venta_producto" id="reg_precio_venta_producto" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Categoría *</label>
                                <select name="cod_categoria" id="reg_cod_categoria" class="form-control" required>
                                    <option value="">Seleccione</option>
                                    <?php
                                    $consulta_cat_sql = "SELECT cod_categoria, nombre_categoria FROM tbl15_categoria WHERE cod_estado = '1' ORDER BY nombre_categoria ASC";
                                    $consulta_cat = mysqli_query($conectar, $consulta_cat_sql);
                                    if ($consulta_cat) {
                                        while ($datos_cat = mysqli_fetch_assoc($consulta_cat)) { echo "<option value='" . $datos_cat['cod_categoria'] . "'>" . $datos_cat['nombre_categoria'] . "</option>"; }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>IVA *</label>
                                <select name="iva_ptj" id="reg_iva_ptj" class="form-control" required>
                                    <?php
                                    $consulta_iva_sql = "SELECT iva FROM tbl15_tipo_iva WHERE cod_estado = '1' ORDER BY iva ASC";
                                    $consulta_iva = mysqli_query($conectar, $consulta_iva_sql);
                                    if ($consulta_iva) {
                                        while ($datos_iva = mysqli_fetch_assoc($consulta_iva)) { echo "<option value='" . $datos_iva['iva'] . "'>" . $datos_iva['iva'] . "%</option>"; }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Descripción</label>
                                <div id="editor_descripcion_producto" style="background: white; border: 1px solid #ddd; border-radius: 8px; min-height: 120px;"></div>
                                <input type="hidden" name="descripcion_producto" id="hidden_descripcion_producto">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Imagen Producto</label>
                                <input type="file" name="imagen_producto" id="reg_imagen_producto" accept="image/*" class="form-control">
                                <small class="text-muted">Se guardará versión original y miniatura.</small>
                                <img id="preview_img_reg" src="" class="preview-imagen" style="max-width:150px; margin-top:10px; display:none;">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Estado</label>
                                <select name="cod_estado" id="reg_cod_estado" class="form-control" required>
                                    <?php
                                    $consulta_estado_sql = "SELECT cod_estado, nombre_estado FROM tbl15_estado ORDER BY nombre_estado ASC";
                                    $consulta_estado = mysqli_query($conectar, $consulta_estado_sql);
                                    if ($consulta_estado) {
                                        while ($datos_estado = mysqli_fetch_assoc($consulta_estado)) {
                                            $selected = ($datos_estado['nombre_estado'] == 'HABILITADO') ? 'selected' : '';
                                            echo "<option value='" . $datos_estado['cod_estado'] . "' $selected>" . $datos_estado['nombre_estado'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="cod_tienda" value="<?php echo $cod_tienda_sesion; ?>">
                    <input type="hidden" name="cod_administrador" value="<?php echo $cod_administrador; ?>">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="btn_guardar_producto"><i class="fa fa-save"></i> Guardar Producto</button>
            </div>
        </div>
    </div>
</div>

<style>
/* Estilos del modal producto adaptado al Aliado */
.modal-producto-aliado .modal-content {
    border-radius: 15px;
    border: none;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
}

.modal-producto-aliado .modal-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border-radius: 15px 15px 0 0;
    border-bottom: none;
}

.modal-producto-aliado .modal-title {
    font-weight: 700;
    font-size: 1.1rem;
}

.modal-producto-aliado .close {
    color: white;
    opacity: 0.9;
    text-shadow: none;
}

.modal-producto-aliado .close:hover {
    color: white;
    opacity: 1;
}

.modal-producto-aliado .modal-body {
    padding: 1.5rem;
}

.modal-producto-aliado .form-group label {
    font-weight: 600;
    color: #333;
    margin-bottom: 0.5rem;
}

.modal-producto-aliado .form-control {
    border-radius: 8px;
    border: 1px solid #ddd;
    padding: 0.6rem 0.8rem;
    transition: all 0.3s ease;
}

.modal-producto-aliado .form-control:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    outline: none;
}

.modal-producto-aliado .form-control::placeholder {
    color: #999;
}

.modal-producto-aliado select.form-control {
    appearance: none;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
    background-position: right 0.5rem center;
    background-repeat: no-repeat;
    background-size: 1.5em 1.5em;
    padding-right: 2.5rem;
}

.modal-producto-aliado select.form-control option {
    padding: 0.5rem;
}

.modal-producto-aliado .modal-footer {
    border-top: 1px solid #dee2e6;
    padding: 1rem 1.5rem;
}

.modal-producto-aliado .btn-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    padding: 0.5rem 1.5rem;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.modal-producto-aliado .btn-primary:hover {
    background: linear-gradient(135deg, #5a67d8 0%, #6b46c1 100%);
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
}

/* Fix for Quill editor text color */
.ql-editor {
    color: #333 !important;
}
.ql-snow .ql-stroke {
    stroke: #333 !important;
}
.ql-snow .ql-fill {
    fill: #333 !important;
}
.ql-snow .ql-picker {
    color: #333 !important;
}
</style>

<script>
// Función para formatear número con separador de miles
function formatearMiles(valor) {
    valor = valor.replace(/\D/g, '');
    return valor.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
}

// Función para limpiar formato de miles
function limpiarMiles(valor) {
    return valor.replace(/\./g, '');
}

// Variable global para el editor Quill
let quillProducto = null;

document.addEventListener('DOMContentLoaded', function() {
    // Inicializar Quill editor para descripción de producto
    if (document.getElementById('editor_descripcion_producto')) {
        quillProducto = new Quill('#editor_descripcion_producto', {
            theme: 'snow', placeholder: 'Descripción del producto...', 
            modules: { toolbar: [['bold', 'italic', 'underline'], [{ 'list': 'ordered'}, { 'list': 'bullet' }], [{ 'color': [] }], ['clean']] }
        });
    }
    
    // Formatear campos de precio
    const precioCompraInput = document.getElementById('reg_precio_compra_producto');
    const precioVentaInput = document.getElementById('reg_precio_venta_producto');
    
    if (precioCompraInput) {
        precioCompraInput.addEventListener('input', function(e) {
            let valor = this.value;
            let cursorPos = this.selectionStart;
            let valorAnterior = valor;
            this.value = formatearMiles(valor);
            let diff = this.value.length - valorAnterior.length;
            this.setSelectionRange(cursorPos + diff, cursorPos + diff);
        });
        precioCompraInput.addEventListener('paste', function(e) { setTimeout(() => { this.value = formatearMiles(this.value); }, 10); });
    }
    
    if (precioVentaInput) {
        precioVentaInput.addEventListener('input', function(e) {
            let valor = this.value;
            let cursorPos = this.selectionStart;
            let valorAnterior = valor;
            this.value = formatearMiles(valor);
            let diff = this.value.length - valorAnterior.length;
            this.setSelectionRange(cursorPos + diff, cursorPos + diff);
        });
        precioVentaInput.addEventListener('paste', function(e) { setTimeout(() => { this.value = formatearMiles(this.value); }, 10); });
    }
    
    // Preview de imagen
    const imgInput = document.getElementById('reg_imagen_producto');
    if (imgInput) {
        imgInput.addEventListener('change', function() {
            const file = this.files[0];
            const preview = document.getElementById('preview_img_reg');
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            } else {
                preview.style.display = 'none';
            }
        });
    }

    // Registro de producto
    const btnGuardar = document.getElementById('btn_guardar_producto');
    if (btnGuardar) {
        btnGuardar.addEventListener('click', function() {
            const form = document.getElementById('formRegistroProducto');
            
            // Capturar el contenido del editor Quill
            if (quillProducto) {
                const descripcionHTML = quillProducto.root.innerHTML;
                if (quillProducto.getText().trim().length === 0) { document.getElementById('hidden_descripcion_producto').value = ''; } else { document.getElementById('hidden_descripcion_producto').value = descripcionHTML; }
            }
            // Limpiar formato de precios
            const precioCompra = document.getElementById('reg_precio_compra_producto');
            const precioVenta = document.getElementById('reg_precio_venta_producto');
            if (precioCompra) { precioCompra.value = limpiarMiles(precioCompra.value); }
            if (precioVenta) { precioVenta.value = limpiarMiles(precioVenta.value); }
            const formData = new FormData(form);
            // Validar campos requeridos
            const camposRequeridos = ['cod_producto_barra', 'nombre_producto', 'precio_compra_producto', 'precio_venta_producto', 'cod_categoria', 'iva_ptj'];
            let valido = true;
            
            for (let campo of camposRequeridos) {
                const input = document.getElementById('reg_' + campo);
                if (!input.value.trim()) {
                    input.style.borderColor = '#dc3545';
                    valido = false;
                } else {
                    input.style.borderColor = '#ddd';
                }
            }
            
            if (!valido) {
                if (precioCompra && precioCompra.value) { precioCompra.value = formatearMiles(precioCompra.value); }
                if (precioVenta && precioVenta.value) { precioVenta.value = formatearMiles(precioVenta.value); }
                Swal.fire({ icon: 'error', title: 'Campos requeridos', text: 'Por favor complete todos los campos marcados con *', confirmButtonColor: '#667eea' });
                return;
            }
            
            // Mostrar cargando
            const btnOriginal = this.innerHTML;
            this.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Guardando...';
            this.disabled = true;
            
            // Enviar datos
            fetch('reg_producto_tienda_aliado_ajax.php', { method: 'POST', body: formData })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success', title: 'Producto registrado', text: data.message, confirmButtonColor: '#667eea'
                    }).then(() => {
                        $('#modalRegistrarProducto').modal('hide');
                        location.reload();
                    });
                } else {
                    if (precioCompra && precioCompra.value) { precioCompra.value = formatearMiles(precioCompra.value); }
                    if (precioVenta && precioVenta.value) { precioVenta.value = formatearMiles(precioVenta.value); }
                    Swal.fire({ icon: 'error', title: 'Error', text: data.message, confirmButtonColor: '#667eea' });
                }
            })
            .catch(error => {
                if (precioCompra && precioCompra.value) { precioCompra.value = formatearMiles(precioCompra.value); }
                if (precioVenta && precioVenta.value) { precioVenta.value = formatearMiles(precioVenta.value); }
                Swal.fire({ icon: 'error', title: 'Error de conexión', text: 'No se pudo procesar la solicitud', confirmButtonColor: '#667eea' });
            })
            .finally(() => {
                this.innerHTML = btnOriginal;
                this.disabled = false;
            });
        });
    }

    // Limpiar formulario al cerrar modal
    $('#modalRegistrarProducto').on('hidden.bs.modal', function() {
        const form = document.getElementById('formRegistroProducto');
        if (form) form.reset();
        
        const preview = document.getElementById('preview_img_reg');
        if (preview) preview.style.display = 'none';
        
        const result = document.getElementById('result_register');
        if (result) result.innerHTML = '';
        
        if (quillProducto) { quillProducto.setContents([]); }
        
        const inputs = this.querySelectorAll('.form-control');
        inputs.forEach(input => { input.style.borderColor = '#ddd'; });
    });
});
</script>

<?php include_once("../menu/05_modulo_menu_vendedor_movil.php"); ?>
</body>
</html>
