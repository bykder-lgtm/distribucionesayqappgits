<?php 
$nombre_pagina          = "Simulador de CrÃ©dito";
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
/* ============================================ */
/* SIMULADOR DE CRÃ‰DITO - DISEÃ‘O PREMIUM       */
/* ============================================ */

.simulator-wrapper {
    padding: 1rem;
    padding-bottom: 100px;
    max-width: 550px;
    margin: 0 auto;
}

/* Hero Header */
.simulator-hero {
    background: linear-gradient(135deg, rgba(255,255,255,0.12) 0%, rgba(255,255,255,0.05) 100%);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255,255,255,0.18);
    border-radius: 24px;
    padding: 2rem 1.5rem;
    margin-bottom: 1.5rem;
    text-align: center;
    position: relative;
    overflow: hidden;
    animation: slideDown 0.6s ease;
}

@keyframes slideDown {
    from { opacity: 0; transform: translateY(-30px); }
    to { opacity: 1; transform: translateY(0); }
}

.simulator-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(90deg, #f59e0b, #d97706, #48dbfb, #f59e0b);
    background-size: 200% 100%;
    animation: gradientMove 3s linear infinite;
}

@keyframes gradientMove {
    0% { background-position: 0% 0%; }
    100% { background-position: 200% 0%; }
}

.hero-icon {
    width: 75px;
    height: 75px;
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.25rem;
    box-shadow: 0 10px 40px rgba(245, 158, 11, 0.4);
    animation: pulse 2s ease-in-out infinite;
}

@keyframes pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
}

.hero-icon i {
    font-size: 1.8rem;
    color: white;
}

.simulator-hero h1 {
    font-size: 1.6rem;
    font-weight: 800;
    color: white;
    margin-bottom: 0.5rem;
}

.simulator-hero p {
    color: rgba(255,255,255,0.8);
    font-size: 0.9rem;
    line-height: 1.5;
    margin: 0;
}

/* Stats Cards */
.stats-row {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 0.75rem;
    margin-bottom: 1.5rem;
    animation: slideUp 0.6s ease 0.2s backwards;
}

@keyframes slideUp {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}

.stat-card {
    background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.05) 100%);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 16px;
    padding: 1rem 0.5rem;
    text-align: center;
    transition: all 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-3px);
    border-color: rgba(255,255,255,0.25);
}

.stat-card i {
    font-size: 1.2rem;
    margin-bottom: 0.4rem;
    display: block;
}

.stat-card:nth-child(1) i { color: #48dbfb; }
.stat-card:nth-child(2) i { color: #feca57; }
.stat-card:nth-child(3) i { color: #ff6b6b; }

.stat-value {
    font-size: 1.1rem;
    font-weight: 700;
    color: white;
}

.stat-label {
    font-size: 0.65rem;
    color: rgba(255,255,255,0.6);
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-top: 0.2rem;
}

/* Form Card */
.form-card {
    background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.05) 100%);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255,255,255,0.15);
    border-radius: 24px;
    padding: 1.5rem;
    animation: slideUp 0.6s ease 0.3s backwards;
}

.form-card-header {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1.25rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid rgba(255,255,255,0.1);
}

.form-card-icon {
    width: 42px;
    height: 42px;
    background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 5px 20px rgba(56, 239, 125, 0.3);
}

.form-card-icon i { font-size: 1.1rem; color: white; }
.form-card-title { font-size: 1rem; font-weight: 700; color: white; }
.form-card-subtitle { font-size: 0.75rem; color: rgba(255,255,255,0.6); }

/* Form Groups */
.form-group-sim {
    margin-bottom: 1.25rem;
    position: relative;
}

.form-group-sim label {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 600;
    color: rgba(255,255,255,0.9);
    margin-bottom: 0.6rem;
    font-size: 0.85rem;
}

.form-group-sim label i { color: #48dbfb; font-size: 0.8rem; }

.form-control-sim {
    width: 100%;
    padding: 0.9rem 1rem;
    padding-left: 2.75rem;
    border: 2px solid rgba(255,255,255,0.15);
    border-radius: 12px;
    background: rgba(255,255,255,0.08);
    color: white;
    font-size: 1rem;
    font-weight: 500;
    transition: all 0.3s ease;
}

.form-control-sim:focus {
    outline: none;
    border-color: #f59e0b;
    background: rgba(255,255,255,0.12);
    box-shadow: 0 0 0 4px rgba(245, 158, 11, 0.2);
}

.form-control-sim::placeholder { color: rgba(255,255,255,0.4); }

.input-icon-sim {
    position: absolute;
    left: 0.9rem;
    bottom: 0.95rem;
    color: rgba(255,255,255,0.5);
    font-size: 0.95rem;
}

.form-group-sim:focus-within .input-icon-sim { color: #f59e0b; }

select.form-control-sim {
    padding-left: 1rem;
    cursor: pointer;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='white' viewBox='0 0 16 16'%3E%3Cpath d='M8 11L3 6h10l-5 5z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 1rem center;
    -webkit-appearance: none;
    appearance: none;
}

select.form-control-sim option { background: #1a1d3a; color: white; }

/* Info Box */
.info-box-sim {
    background: linear-gradient(135deg, rgba(245, 158, 11, 0.2) 0%, rgba(118, 75, 162, 0.1) 100%);
    border: 1px solid rgba(245, 158, 11, 0.3);
    border-radius: 12px;
    padding: 0.9rem 1rem;
    margin-bottom: 1.25rem;
    display: flex;
    align-items: flex-start;
    gap: 0.6rem;
}

.info-box-sim i { color: #f59e0b; font-size: 1rem; margin-top: 0.1rem; }
.info-box-sim p { color: rgba(255,255,255,0.85); font-size: 0.8rem; line-height: 1.5; margin: 0; }

/* Submit Button */
.btn-submit-sim {
    width: 100%;
    padding: 1rem;
    border: none;
    border-radius: 12px;
    font-size: 1rem;
    font-weight: 700;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.6rem;
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    color: white;
    box-shadow: 0 8px 25px rgba(245, 158, 11, 0.4);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.btn-submit-sim::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.5s ease;
}

.btn-submit-sim:hover::before { left: 100%; }
.btn-submit-sim:hover { transform: translateY(-2px); box-shadow: 0 12px 35px rgba(245, 158, 11, 0.5); }
.btn-submit-sim:active { transform: translateY(-1px); }
.btn-submit-sim:disabled { opacity: 0.7; cursor: not-allowed; transform: none; }

/* Features */
.features-row-sim {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 0.75rem;
    margin-top: 1.25rem;
}

.feature-item-sim {
    background: linear-gradient(135deg, rgba(255,255,255,0.08) 0%, rgba(255,255,255,0.03) 100%);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 10px;
    padding: 0.85rem;
    display: flex;
    align-items: center;
    gap: 0.6rem;
}

.feature-item-sim i { font-size: 1.1rem; color: #38ef7d; }
.feature-item-sim span { font-size: 0.75rem; color: rgba(255,255,255,0.8); font-weight: 500; }

@media (max-width: 380px) {
    .simulator-hero h1 { font-size: 1.4rem; }
    .stats-row { gap: 0.5rem; }
    .stat-card { padding: 0.7rem 0.2rem; }
}
</style>
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
        <h1>Simulador de CrÃ©dito</h1>
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
            <div class="stat-label">Meses MÃ¡x</div>
        </div>
        <div class="stat-card">
            <i class="fa fa-bolt"></i>
            <div class="stat-value">24h</div>
            <div class="stat-label">AprobaciÃ³n</div>
        </div>
    </div>
-->

    <!-- Form Card -->
    <div class="form-card">
        <div class="form-card-header">
            <div class="form-card-icon"><i class="fa fa-sliders-h"></i></div>
            <div>
                <div class="form-card-title">Configura tu CrÃ©dito</div>
                <div class="form-card-subtitle">Completa los datos para simular</div>
            </div>
        </div>
<!--
        <div class="info-box-sim">
            <i class="fa fa-lightbulb"></i>
            <p>Ingresa el valor del producto y te mostraremos todas las opciones de financiamiento disponibles.</p>
        </div>
-->

        <form name="formulario_de_actualizacion" method="POST" autocomplete="off" action="../admin/resultado_simulador_credito_vendedor_movil.php">
            <div class="form-group-sim">
                <label><i class="fa fa-list"></i> Tipo de SimulaciÃ³n *</label>
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

            <button class="btn-submit-sim" id="submit" type="submit"><i class="fa fa-calculator"></i><span>Calcular CrÃ©dito</span></button>
            
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
            <span>Respuesta RÃ¡pida</span>
        </div>
    </div>
-->
</main>

<?php //include_once("../seguridad/seguridad_diseno_plantillas_visitante_intern.php"); ?>
<?php include_once("../menu/05_modulo_menu_vendedor_movil.php"); ?>
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
    // Elimina todos los caracteres que no sean dÃ­gitos
    let valorNumerico = String(numero).replace(/\D/g, '');
    // Formatea el nÃºmero segÃºn la configuraciÃ³n regional del navegador
    return valorNumerico === '' ? valorNumerico : Number(valorNumerico).toLocaleString('es-ES');
}

// FunciÃ³n para actualizar el label segÃºn la selecciÃ³n
const selectTipoSimulacion = document.getElementById('cod_tipo_simulacion_credito');
const labelValorProducto = document.getElementById('label_valor_producto');
const inputMonto = document.getElementById('precio_venta_producto_formateado');

function actualizarLabelSimulacion() {
    if (!selectTipoSimulacion || !labelValorProducto) return;
    
    // Obtenemos el texto de la opciÃ³n seleccionada
    const textoOpcion = selectTipoSimulacion.options[selectTipoSimulacion.selectedIndex].text.toLowerCase();
    
    // Palabras clave para detectar si es crÃ©dito de dinero/monto y no producto especÃ­fico
    const keywordsDinero = ['dinero', 'libre', 'efectivo', 'monto', 'prÃ©stamo', 'prestamo'];
    const esDinero = keywordsDinero.some(k => textoOpcion.includes(k));
    
    if (esDinero) {
        labelValorProducto.innerHTML = '<i class="fa fa-hand-holding-usd"></i> Valor a Solicitar *';
        if (inputMonto) inputMonto.placeholder = "Ej: 2.000.000";
    } else {
        // Verificar si es Valor a CrÃ©dito o Contado
        if (textoOpcion.includes('credito') || textoOpcion.includes('crÃ©dito')) {
            labelValorProducto.innerHTML = '<i class="fa fa-tag"></i> Valor del Producto (CrÃ©dito) *';
        } else {
            // Por defecto asumimos Contado si no dice explÃ­citamente CrÃ©dito
            labelValorProducto.innerHTML = '<i class="fa fa-tag"></i> Valor del Producto (Contado) *';
        }
        if (inputMonto) inputMonto.placeholder = "Ej: 1.000.000";
    }
}

// Escuchar cambios en el selector
if (selectTipoSimulacion) {
    selectTipoSimulacion.addEventListener('change', actualizarLabelSimulacion);
    // Ejecutar tambiÃ©n al cargar para establecer estado inicial
    actualizarLabelSimulacion();
}

// ValidaciÃ³n del formulario
document.querySelector('form[name="formulario_de_actualizacion"]').addEventListener('submit', function(e) {
    const precio = document.getElementById('precio_venta_producto').value;
    
    if (!precio || precio == '0') {
        e.preventDefault();
        alert('Por favor ingresa un valor vÃ¡lido para el producto');
        return false;
    }
    
    // Mostrar loading en el botÃ³n
    const btnSubmit = document.getElementById('submit');
    btnSubmit.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Calculando...';
    btnSubmit.disabled = true;
});
</script>

