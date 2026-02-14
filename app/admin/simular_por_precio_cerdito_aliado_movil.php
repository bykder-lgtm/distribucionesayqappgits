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
<link rel="stylesheet" href="../estilo_css/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="../estilo_css/font-awesome.min.css">
<script src="../js/jquery-3.2.1.min_visitante.js"></script>

</head>
<body>
<?php include_once("../admin/01_modulo_encabezado_superior_visitante_intern_movil.php"); ?>

<?php
$nombre_tipo_origen_simulacion     = "SIMULACION_VALOR_LIBRE";
$cod_categoria                     = 2;
$cod_tipo_simulacion_credito       = 2;
?>
    <!-- Formulario del Simulador -->
    <main class="container pb-5 mb-5">
        <!-- Header del Simulador -->
        <div class="simulador-header"><h1><i class="fa fa-calculator"></i> Simulador de Crédito</h1><p>Calcula tu cuota mensual y conoce las opciones de financiamiento</p></div>
        <div class="simulador-card-movil"><div class="info-text"><i class="fa fa-info-circle"></i>Completa los datos para simular tu crédito y conocer las cuotas mensuales.</div>
            
            <form name="formulario_de_actualizacion" method="POST" autocomplete="off" action="../admin/simular_por_precio_cerdito_aliado_movil_resultado.php">
                <div class="form-group-simulador">
                    <label for="cod_tipo_simulacion_credito"><i class="fa fa-dollar-sign"></i>Tipo de Simulacion *</label>
                    <select id="cod_tipo_simulacion_credito" name="cod_tipo_simulacion_credito" class="form-control" onchange="calcularValorCredito()" style="border: 2px solid #e2e8f0; border-radius: 8px; padding: 0.75rem; font-size: 1rem; height: auto; min-height: 45px; line-height: 1.5; background: white; color: #2d3748;">
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
                    <label for="precio_venta_producto_formateado"><i class="fa fa-dollar-sign"></i>Valor del producto (Credito) *</label>
                    <input type="text" class="form-control-simulador" name="precio_venta_producto_formateado" id="precio_venta_producto_formateado" placeholder="Ej: 1.000.000" required>
                    <input type="hidden" name="precio_venta_producto" id="precio_venta_producto" required>
                </div>
<!--
                <div class="form-group-simulador">
                    <label for="nombre_producto">
                        <i class="fa fa-box"></i>
                        Nombre del producto *
                    </label>
                    <input type="text" class="form-control-simulador" id="nombre_producto" name="nombre_producto" placeholder="Ej: Televisor Samsung 50 pulgadas" required/>
                </div>

                <div class="form-group-simulador">
                    <label for="cod_categoria">
                        <i class="fa fa-tag"></i>
                        Categoría del producto *
                    </label>
                    <select id="cod_categoria" name="cod_categoria" class="form-control-simulador" required>
                        <option value="">-- Selecciona una categoría --</option>
                        <?php 
                        $consulta2_sql = "SELECT cod_categoria, nombre_categoria FROM tbl15_categoria WHERE (cod_estado = '1') ORDER BY nombre_categoria ASC";
                        $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysqli_error($conectar));
                        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                            $seleccionado = (isset($cod_categoria) && $cod_categoria == $datos2['cod_categoria']) ? "selected" : "";
                            $codigo = $datos2['cod_categoria'];
                            $nombre = $datos2['nombre_categoria'];
                            echo "<option value='".$codigo."' $seleccionado>".$nombre."</option>"; } ?>
                    </select>
                </div>
-->
                <button class="btn-simular" id="submit" type="submit"><i class="fa fa-calculator"></i><span>Calcular Crédito</span></button>
                <input type="hidden" name="nombre_tipo_origen_simulacion" value="<?php echo $nombre_tipo_origen_simulacion ?>">
                <input type="hidden" name="cod_producto_codifcryp" value="">
                <input type="hidden" name="MM_update" value="formulario_de_actualizacion">
                <input type="hidden" name="insertar_datos" value="formulario">
            </form>
        </div>
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
// Redirigir si el tipo de simulación es '2'
var selectTipoSimulacion = document.getElementById('cod_tipo_simulacion_credito');
if (selectTipoSimulacion) {
    selectTipoSimulacion.addEventListener('change', function() {
        try {
            if (this.value === '1') {
                window.location.href = 'simular_por_precio_contado_aliado_movil.php';
            }
        } catch (e) { console.error(e); }
    });
}
function formatearNumero(numero) {
    // Elimina todos los caracteres que no sean dígitos
    let valorNumerico = String(numero).replace(/\D/g, '');
    // Formatea el número según la configuración regional del navegador
    return valorNumerico === '' ? valorNumerico : Number(valorNumerico).toLocaleString('es-ES');
}
// Validación del formulario
document.querySelector('form[name="formulario_de_actualizacion"]').addEventListener('submit', function(e) {
    const precio = document.getElementById('precio_venta_producto').value;
    const nombre = document.getElementById('nombre_producto').value;
    const categoria = document.getElementById('cod_categoria').value;
    
    if (!precio || precio == '0') { e.preventDefault(); alert('Por favor ingresa un valor válido para el producto'); return false; }
    if (!nombre.trim()) { e.preventDefault(); alert('Por favor ingresa el nombre del producto'); return false; }
    if (!categoria) { e.preventDefault(); alert('Por favor selecciona una categoría'); return false; }
    // Mostrar loading en el botón
    const btnSubmit = document.getElementById('submit');
    btnSubmit.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Calculando...';
    btnSubmit.disabled = true;
});
</script>


<style>
    .simulador-card-movil {
        background: white;
        border-radius: 15px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        padding: 1.5rem;
        margin-bottom: 1rem;
    }
    body {
        background: linear-gradient(135deg, #0a0e27 0%, #1a1d3a 100%);
        min-height: 100vh;
    }
    .simulador-header {
        background: linear-gradient(135deg, #4169e1 0%, #5b7ce6 100%);
        color: white;
        padding: 1.5rem;
        border-radius: 15px;
        margin-bottom: 1.5rem;
        text-align: center;
        box-shadow: 0 4px 15px rgba(65, 105, 225, 0.4);
    }
    .simulador-header h1 {
        font-size: 1.5rem;
        font-weight: 800;
        margin: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    }
    .simulador-header p {
        margin: 0.5rem 0 0 0;
        opacity: 0.95;
        font-size: 0.9rem;
    }
    .form-group-simulador {
        margin-bottom: 1.2rem;
    }
    .form-group-simulador label {
        display: block;
        font-weight: 600;
        color: #00d4ff;
        margin-bottom: 0.5rem;
        font-size: 0.9rem;
    }
    .form-group-simulador label i {
        color: #5b7ce6;
        margin-right: 0.5rem;
    }
    .form-control-simulador {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 2px solid #4169e1;
        border-radius: 10px;
        background: rgba(26, 29, 58, 0.8);
        color: white;
        font-size: 1rem;
        transition: all 0.3s ease;
    }
    .form-control-simulador:focus {
        outline: none;
        border-color: #00d4ff;
        background: rgba(26, 29, 58, 1);
        box-shadow: 0 0 0 3px rgba(0, 212, 255, 0.2);
    }
    .btn-simular {
        background: linear-gradient(135deg, #4169e1 0%, #5b7ce6 100%);
        color: white;
        border: none;
        padding: 1rem;
        border-radius: 10px;
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
    .btn-simular:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 212, 255, 0.6);
        background: linear-gradient(135deg, #00d4ff 0%, #4169e1 100%);
    }
    .btn-simular:active {
        transform: translateY(0);
    }
    .info-text {
        background: #edf2f7;
        border-left: 4px solid #667eea;
        padding: 0.75rem 1rem;
        border-radius: 8px;
        margin-bottom: 1rem;
        font-size: 0.85rem;
        color: #4a5568;
    }
    .info-text i {
        color: #667eea;
        margin-right: 0.5rem;
    }
    @media (max-width: 576px) {
        .simulador-header h1 {
            font-size: 1.25rem;
        }
        .simulador-card-movil {
            padding: 1rem;
        }
    }
</style>