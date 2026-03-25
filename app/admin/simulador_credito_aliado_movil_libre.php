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
<script src="../js/jquery-3.2.1.min_visitante.js"></script>

<style><?php include_once("../estilo_css/estilo_simulador_credito_libre_aliado.css"); ?></style>

</head>
<body>
<?php include_once("../admin/01_modulo_encabezado_superior_visitante_intern_movil.php"); ?>

<?php
$nombre_tipo_origen_simulacion     = "SIMULACION_VALOR_LIBRE";
$cod_categoria                     = 2;
?>

<main class="simulator-wrapper">
    <!-- Hero Header -->
    <div class="simulator-hero">
        <div class="hero-icon"><i class="fa fa-calculator"></i></div>
        <h1>Simulador de Crédito</h1>
        <p>Calcula tu cuota mensual y descubre las mejores opciones de financiamiento</p>
    </div>

    <!-- Stats Row -->
<!--
    <div class="stats-row">
        <div class="stat-card">
            <i class="fa fa-percent"></i>
            <div class="stat-value">0%</div>
            <div class="stat-label">Cuota Inicial</div>
        </div>
        <div class="stat-card">
            <i class="fa fa-calendar-check"></i>
            <div class="stat-value">36</div>
            <div class="stat-label">Meses Máx</div>
        </div>
        <div class="stat-card">
            <i class="fa fa-bolt"></i>
            <div class="stat-value">24h</div>
            <div class="stat-label">Aprobación</div>
        </div>
    </div>
-->

    <!-- Form Card -->
    <div class="form-card">
        <div class="form-card-header">
            <div class="form-card-icon"><i class="fa fa-sliders-h"></i></div>
            <div>
                <div class="form-card-title">Configura tu Crédito</div>
                <div class="form-card-subtitle">Completa los datos para simular</div>
            </div>
        </div>
<!--
        <div class="info-box-sim">
            <i class="fa fa-lightbulb"></i>
            <p>Ingresa el valor del producto y te mostraremos todas las opciones de financiamiento disponibles.</p>
        </div>
-->

        <form name="formulario_de_actualizacion" method="POST" autocomplete="off" action="../admin/resultado_simulador_credito_aliado_movil.php">
            <div class="form-group-sim">
                <label><i class="fa fa-list"></i> Tipo de Simulación *</label>
                <select id="cod_tipo_simulacion_credito" name="cod_tipo_simulacion_credito" class="form-control-sim">
                    <?php if (isset($cod_tipo_simulacion_credito)) { echo ""; } else { echo ""; }
                    $consulta2_sql = "SELECT cod_tipo_simulacion_credito, nombre_tipo_simulacion_credito FROM tbl15_tipo_simulacion_credito WHERE (cod_estado = '1')";
                    $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysql_error());
                    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                    if(isset($cod_tipo_simulacion_credito) and $cod_tipo_simulacion_credito == $datos2['cod_tipo_simulacion_credito']) {
                    $seleccionado = "selected"; } else { $seleccionado = ""; }
                    $codigo           = $datos2['cod_tipo_simulacion_credito'];
                    $nombre           = $datos2['nombre_tipo_simulacion_credito'];
                    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                </select>
            </div>

            <div class="form-group-sim">
                <label id="label_valor_producto"><i class="fa fa-dollar-sign"></i> Valor del Producto (Contado) *</label>
                <i class="fa fa-coins input-icon-sim"></i>
                <input type="text" class="form-control-sim" name="precio_venta_producto_formateado" id="precio_venta_producto_formateado" placeholder="Ej: 1.000.000" inputmode="numeric" required>
                <input type="hidden" name="precio_venta_producto" id="precio_venta_producto" required>
            </div>

            <button class="btn-submit-sim" id="submit" type="submit"><i class="fa fa-calculator"></i><span>Calcular Crédito</span></button>
            
            <input type="hidden" name="nombre_tipo_origen_simulacion" value="<?php echo $nombre_tipo_origen_simulacion ?>">
            <input type="hidden" name="cod_producto_codifcryp" value="">
            <input type="hidden" name="MM_update" value="formulario_de_actualizacion">
            <input type="hidden" name="insertar_datos" value="formulario">
        </form>
    </div>

    <!-- Features -->
<!--
    <div class="features-row-sim">
        <div class="feature-item-sim">
            <i class="fa fa-shield-alt"></i>
            <span>100% Seguro</span>
        </div>
        <div class="feature-item-sim">
            <i class="fa fa-clock"></i>
            <span>Respuesta Rápida</span>
        </div>
    </div>
-->
</main>

<?php //include_once("../seguridad/seguridad_diseno_plantillas_visitante_intern.php"); ?>
<?php include_once("../menu/05_modulo_menu_aliado_movil.php"); ?>
<?php include_once("../admin/10_modulo_sin_js_visitante_intern_movil.php"); ?>
</body>
</html>

<script language="javascript">
// Formatear precio mientras se escribe
const precio_venta_producto_formateado = document.getElementById('precio_venta_producto_formateado');

precio_venta_producto_formateado.addEventListener('keyup', (e) => {
    const numero_entrada_sin_formato_precio_venta_producto = e.target.value;
    const numero_formateado_precio_venta_producto = formatearNumero(numero_entrada_sin_formato_precio_venta_producto);
    e.target.value = numero_formateado_precio_venta_producto;
    // Guardar valor sin formato en campo oculto
    valor_no_formateado_punto = numero_formateado_precio_venta_producto.replace(/\./g, "");
    valor_no_formateado_coma = valor_no_formateado_punto.replace(/,/g, "");
    valor_no_formateado = valor_no_formateado_coma;
    document.getElementById('precio_venta_producto').value = valor_no_formateado;
});

function formatearNumero(numero) {
    // Elimina todos los caracteres que no sean dígitos
    let valorNumerico = String(numero).replace(/\D/g, '');
    // Formatea el número según la configuración regional del navegador
    return valorNumerico === '' ? valorNumerico : Number(valorNumerico).toLocaleString('es-ES');
}

// Función para actualizar el label según la selección
const selectTipoSimulacion = document.getElementById('cod_tipo_simulacion_credito');
const labelValorProducto = document.getElementById('label_valor_producto');
const inputMonto = document.getElementById('precio_venta_producto_formateado');

function actualizarLabelSimulacion() {
    if (!selectTipoSimulacion || !labelValorProducto) return;
    
    // Obtenemos el texto de la opción seleccionada
    const textoOpcion = selectTipoSimulacion.options[selectTipoSimulacion.selectedIndex].text.toLowerCase();
    
    // Palabras clave para detectar si es crédito de dinero/monto y no producto específico
    const keywordsDinero = ['dinero', 'libre', 'efectivo', 'monto', 'préstamo', 'prestamo'];
    const esDinero = keywordsDinero.some(k => textoOpcion.includes(k));
    
    if (esDinero) {
        labelValorProducto.innerHTML = '<i class="fa fa-hand-holding-usd"></i> Valor a Solicitar *';
        if (inputMonto) inputMonto.placeholder = "Ej: 2.000.000";
    } else {
        // Verificar si es Valor a Crédito o Contado
        if (textoOpcion.includes('credito') || textoOpcion.includes('crédito')) {
            labelValorProducto.innerHTML = '<i class="fa fa-tag"></i> Valor del Producto (Crédito) *';
        } else {
            // Por defecto asumimos Contado si no dice explícitamente Crédito
            labelValorProducto.innerHTML = '<i class="fa fa-tag"></i> Valor del Producto (Contado) *';
        }
        if (inputMonto) inputMonto.placeholder = "Ej: 1.000.000";
    }
}

// Escuchar cambios en el selector
if (selectTipoSimulacion) {
    selectTipoSimulacion.addEventListener('change', actualizarLabelSimulacion);
    // Ejecutar también al cargar para establecer estado inicial
    actualizarLabelSimulacion();
}

// Validación del formulario
document.querySelector('form[name="formulario_de_actualizacion"]').addEventListener('submit', function(e) {
    const precio = document.getElementById('precio_venta_producto').value;
    
    if (!precio || precio == '0') {
        e.preventDefault();
        alert('Por favor ingresa un valor válido para el producto');
        return false;
    }
    
    // Mostrar loading en el botón
    const btnSubmit = document.getElementById('submit');
    btnSubmit.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Calculando...';
    btnSubmit.disabled = true;
});
</script>
