<?php
include_once('../conexiones/conexione.php'); 
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include ("../session/funciones_admin.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
    } else { header("Location:../index.php");
}
$cuenta_actual                = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$cuenta                       = $_SESSION['usuario'];
$cod_administrador            = $_SESSION['cod_administrador'];
$tipo_ajax                    = addslashes($_REQUEST['tipo_ajax']);
$campo                        = addslashes($_REQUEST['campo']);

$datos_info = "SELECT * FROM tbl15_info_factura_transferencia WHERE (cod_estado_factura = '1') AND (cuenta = '$cuenta_actual')";
$consulta_info = mysqli_query($conectar, $datos_info) or die(mysqli_error($conectar));
$info = mysqli_fetch_assoc($consulta_info);
$factura_ocupada = mysqli_num_rows($consulta_info);
// ------------------------------------------------------------------------------------------------- //
if (($campo=='cod_historia_clinica') && ($tipo_ajax=='tbl15_info_factura_transferencia')) {
$cod_historia_clinica         = intval($_REQUEST['valor']);
$cod_info_factura_transferencia             = intval($_REQUEST['id']);

$data_sql = ("UPDATE tbl15_transferencia_producto SET cod_historia_clinica = '$cod_historia_clinica' WHERE cod_info_factura_transferencia = '$cod_info_factura_transferencia'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

$data_sql = ("UPDATE tbl15_info_factura_transferencia SET cod_historia_clinica = '$cod_historia_clinica' WHERE cod_info_factura_transferencia = '$cod_info_factura_transferencia'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='fecha_anyo') && ($tipo_ajax=='tbl15_info_factura_transferencia')) {
$fecha_anyo                   = addslashes($_REQUEST['valor']);
$cod_info_factura_transferencia       = intval($_REQUEST['id']);
$fecha_anyo_seg               = strtotime($fecha_anyo);
$fecha_dia                    = date("Y-m-d", $fecha_anyo_seg);
$fecha_mes                    = date("m-Y", $fecha_anyo_seg);
$anyo                         = date("Y", $fecha_anyo_seg);
$fecha_ymd_venta_producto     = $fecha_anyo;
$fecha_mes_venta_producto     = $fecha_mes;
$fecha_anyo_venta_producto    = $anyo;
$fecha_seg_venta_producto     = $fecha_anyo_seg;

$data_sql = ("UPDATE tbl15_transferencia_producto SET fecha_ymd_venta_producto = '$fecha_ymd_venta_producto', fecha_mes_venta_producto = '$fecha_mes_venta_producto', 
fecha_anyo_venta_producto = '$fecha_anyo_venta_producto', fecha_seg_venta_producto = '$fecha_seg_venta_producto' 
WHERE cod_info_factura_transferencia = '$cod_info_factura_transferencia'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

$data_sql = ("UPDATE tbl15_info_factura_transferencia SET fecha_anyo = '$fecha_anyo', fecha_dia = '$fecha_dia', fecha_mes = '$fecha_mes', anyo = '$anyo' 
WHERE cod_info_factura_transferencia = '$cod_info_factura_transferencia'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='nombre_tipo_moneda') && ($tipo_ajax=='tbl15_info_factura_transferencia')) {
$nombre_tipo_moneda           = addslashes($_REQUEST['valor']);
$cod_info_factura_transferencia             = intval($_REQUEST['id']);

$data_sql = ("UPDATE tbl15_info_factura_transferencia SET nombre_tipo_moneda = '$nombre_tipo_moneda' WHERE cod_info_factura_transferencia = '$cod_info_factura_transferencia'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='nombre_tipo_factura') && ($tipo_ajax=='tbl15_info_factura_transferencia')) {
$nombre_tipo_factura         = addslashes($_REQUEST['valor']);
$cod_info_factura_transferencia             = intval($_REQUEST['id']);

$data_sql = ("UPDATE tbl15_info_factura_transferencia SET nombre_tipo_factura = '$nombre_tipo_factura' WHERE cod_info_factura_transferencia = '$cod_info_factura_transferencia'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='nombre_tipo_forma_pago') && ($tipo_ajax=='tbl15_info_factura_transferencia')) {
$nombre_tipo_forma_pago         = addslashes($_REQUEST['valor']);
$cod_info_factura_transferencia             = intval($_REQUEST['id']);

$data_sql = ("UPDATE tbl15_info_factura_transferencia SET nombre_tipo_forma_pago = '$nombre_tipo_forma_pago' WHERE cod_info_factura_transferencia = '$cod_info_factura_transferencia'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='cod_tipo_inventario') && ($tipo_ajax=='tbl15_info_factura_transferencia')) {
$cod_tipo_inventario                = intval($_REQUEST['valor']);
$cod_info_factura_transferencia             = intval($_REQUEST['id']);

$data_sql = ("UPDATE tbl15_info_factura_transferencia SET cod_tipo_inventario = '$cod_tipo_inventario' WHERE cod_info_factura_transferencia = '$cod_info_factura_transferencia'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='cod_tipo_forma_pago') && ($tipo_ajax=='tbl15_info_factura_transferencia')) {
$cod_tipo_forma_pago                = intval($_REQUEST['valor']);
$cod_info_factura_transferencia             = intval($_REQUEST['id']);

$data_sql = ("UPDATE tbl15_info_factura_transferencia SET cod_tipo_forma_pago = '$cod_tipo_forma_pago' WHERE cod_info_factura_transferencia = '$cod_info_factura_transferencia'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='cod_tipo_pago') && ($tipo_ajax=='tbl15_info_factura_transferencia')) {
$cod_tipo_pago         = addslashes($_REQUEST['valor']);
$cod_info_factura_transferencia             = intval($_REQUEST['id']);

$data_sql = ("UPDATE tbl15_info_factura_transferencia SET cod_tipo_pago = '$cod_tipo_pago' WHERE cod_info_factura_transferencia = '$cod_info_factura_transferencia'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='cod_tercero') && ($tipo_ajax=='tbl15_info_factura_transferencia')) {
$cod_tercero                        = addslashes($_REQUEST['valor']);
$cod_info_factura_transferencia             = intval($_REQUEST['id']);

$data_sql = ("UPDATE tbl15_transferencia_producto_temporal SET cod_tercero = '$cod_tercero' WHERE cod_info_factura_transferencia = '$cod_info_factura_transferencia'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

$data_sql = ("UPDATE tbl15_info_factura_transferencia SET cod_tercero = '$cod_tercero' WHERE cod_info_factura_transferencia = '$cod_info_factura_transferencia'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='cod_tipo_producto_consumo') && ($tipo_ajax=='tbl15_info_factura_transferencia')) {
$cod_tipo_producto_consumo               = addslashes($_REQUEST['valor']);
$cod_info_factura_transferencia             = intval($_REQUEST['id']);

$data_sql = ("UPDATE tbl15_info_factura_transferencia SET cod_tipo_producto_consumo = '$cod_tipo_producto_consumo' WHERE cod_info_factura_transferencia = '$cod_info_factura_transferencia'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='cod_administrador') && ($tipo_ajax=='tbl15_info_factura_transferencia')) {
$cod_administrador                  = intval($_REQUEST['valor']);
$cod_info_factura_transferencia             = intval($_REQUEST['id']);

$data_sql = ("UPDATE tbl15_info_factura_transferencia SET cod_administrador = '$cod_administrador' WHERE cod_info_factura_transferencia = '$cod_info_factura_transferencia'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }

$data_sql = ("UPDATE tbl15_transferencia_producto SET cod_administrador = '$cod_administrador' WHERE cod_info_factura_transferencia = '$cod_info_factura_transferencia'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='nombre_tipo_moneda') && ($tipo_ajax=='tbl15_info_factura_transferencia')) {
$nombre_tipo_moneda                 = addslashes($_REQUEST['valor']);
$cod_info_factura_transferencia             = intval($_REQUEST['id']);

$data_sql = ("UPDATE tbl15_info_factura_transferencia SET nombre_tipo_moneda = '$nombre_tipo_moneda' WHERE cod_info_factura_transferencia = '$cod_info_factura_transferencia'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='nombre_tipo_factura') && ($tipo_ajax=='tbl15_info_factura_transferencia')) {
$nombre_tipo_factura                = addslashes($_REQUEST['valor']);
$cod_info_factura_transferencia             = intval($_REQUEST['id']);

$data_sql = ("UPDATE tbl15_info_factura_transferencia SET nombre_tipo_factura = '$nombre_tipo_factura' WHERE cod_info_factura_transferencia = '$cod_info_factura_transferencia'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}

// ------------------------------------------------------------------------------------------------- //
if (($campo=='cod_cliente') && ($tipo_ajax=='tbl15_info_factura_transferencia')) {
$cod_cliente                  = intval($_REQUEST['valor']);
$cod_info_factura_transferencia             = intval($_REQUEST['id']);

$data_sql = ("UPDATE tbl15_info_factura_transferencia SET cod_cliente = '$cod_cliente' WHERE cod_info_factura_transferencia = '$cod_info_factura_transferencia'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='cod_empresa') && ($tipo_ajax=='tbl15_info_factura_transferencia')) {
$cod_empresa                  = intval($_REQUEST['valor']);
$cod_info_factura_transferencia             = intval($_REQUEST['id']);

$obtener_empresa = "SELECT nombre_empresa, razonsocial_empresa FROM tbl15_empresa WHERE cod_empresa = '$cod_empresa'";
$resultado_empresa = mysqli_query($conectar, $obtener_empresa) or die(mysqli_error($conectar));
$matriz_empresa = mysqli_fetch_assoc($resultado_empresa);

$nombre_empresa                = $matriz_empresa['nombre_empresa'];
$razonsocial_empresa           = $matriz_empresa['razonsocial_empresa'];

$obtener_cliente = "SELECT cod_cliente FROM tbl15_cliente WHERE cod_empresa = '$cod_empresa'";
$resultado_cliente = mysqli_query($conectar, $obtener_cliente) or die(mysqli_error($conectar));
$matriz_cliente = mysqli_fetch_assoc($resultado_cliente);

$cod_cliente                   = $matriz_cliente['cod_cliente'];

$data_sql = ("UPDATE tbl15_info_factura_transferencia SET cod_empresa = '$cod_empresa', cod_cliente = '$cod_cliente', nombre_empresa = '$nombre_empresa', razonsocial_empresa = '$razonsocial_empresa' 
	WHERE cod_info_factura_transferencia = '$cod_info_factura_transferencia'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));
?>
        <select name="cod_cliente" id="cod_cliente" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
            <?php if (isset($cod_cliente)) { echo "<option value='' >...</option>";
            } else { echo  "<option value='' selected ></option>"; }
            $consulta2_sql = "SELECT cod_cliente, nombres, nombre_raza FROM tbl15_cliente WHERE (cod_empresa = '$cod_empresa') ORDER BY nombres ASC";
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($cod_cliente) AND $cod_cliente == $datos2['cod_cliente']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['cod_cliente'];
            $nombre = $datos2['nombres'].' | '.$datos2['nombre_raza'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
<?php
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='nombre_tipo_producto') && ($tipo_ajax=='tbl15_info_factura_transferencia')) {
$nombre_tipo_producto         = addslashes($_REQUEST['valor']);
$cod_info_factura_transferencia             = intval($_REQUEST['id']);

$data_sql = ("UPDATE tbl15_info_factura_transferencia SET nombre_tipo_producto = '$nombre_tipo_producto' WHERE cod_info_factura_transferencia = '$cod_info_factura_transferencia'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
// ------------------------------------------------------------------------------------------------- //
// ------------------------------------------------------------------------------------------------- //
// ------------------------------------------------------------------------------------------------- //
if (($campo=='cod_producto_barra') && ($tipo_ajax=='tbl15_transferencia_producto_temporal')) {
$cod_producto_barra           = addslashes($_REQUEST['valor']);
$cod_transferencia_producto_temporal  = intval($_REQUEST['id']);

$data_sql = ("UPDATE tbl15_transferencia_producto_temporal SET cod_producto_barra = '$cod_producto_barra' WHERE cod_transferencia_producto_temporal = '$cod_transferencia_producto_temporal'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='nombre_producto') && ($tipo_ajax=='tbl15_transferencia_producto_temporal')) {
$nombre_producto              = addslashes(strtoupper($_REQUEST['valor']));
$cod_transferencia_producto_temporal  = intval($_REQUEST['id']);

$data_sql = ("UPDATE tbl15_transferencia_producto_temporal SET nombre_producto = '$nombre_producto' WHERE cod_transferencia_producto_temporal = '$cod_transferencia_producto_temporal'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='nombre_frec_duracion') && ($tipo_ajax=='tbl15_transferencia_producto_temporal')) {
$nombre_frec_duracion         = addslashes(strtoupper($_REQUEST['valor']));
$cod_transferencia_producto_temporal  = intval($_REQUEST['id']);

$data_sql = ("UPDATE tbl15_transferencia_producto_temporal SET nombre_frec_duracion = '$nombre_frec_duracion' WHERE cod_transferencia_producto_temporal = '$cod_transferencia_producto_temporal'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='und_venta') && ($tipo_ajax=='tbl15_transferencia_producto_temporal')) {
$und_venta                    = addslashes($_REQUEST['valor']);
$cod_transferencia_producto_temporal  = intval($_REQUEST['id']);

$datos_info_temporal = "SELECT precio_costo_producto, precio_venta_producto FROM tbl15_transferencia_producto_temporal WHERE (cod_transferencia_producto_temporal = '$cod_transferencia_producto_temporal')";
$consulta_info_temporal = mysqli_query($conectar, $datos_info_temporal) or die(mysqli_error($conectar));
$info_temporal = mysqli_fetch_assoc($consulta_info_temporal);

$total_costo_producto         = $info_temporal['precio_costo_producto'] * $und_venta;
$total_venta_producto         = $info_temporal['precio_venta_producto'] * $und_venta;

if ($total_costo_producto > $total_venta_producto) { $cod_estado_permitir_venta = '1'; } else { $cod_estado_permitir_venta = '0'; }

$data_sql = ("UPDATE tbl15_transferencia_producto_temporal SET und_venta = '$und_venta', total_costo_producto = '$total_costo_producto', total_venta_producto = '$total_venta_producto', 
cod_estado_permitir_venta = '$cod_estado_permitir_venta' WHERE cod_transferencia_producto_temporal = '$cod_transferencia_producto_temporal'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='nombre_tipo_unidad_medida') && ($tipo_ajax=='tbl15_transferencia_producto_temporal')) {
$nombre_tipo_unidad_medida            = addslashes($_REQUEST['valor']);
$cod_transferencia_producto_temporal  = intval($_REQUEST['id']);

$data_sql = ("UPDATE tbl15_transferencia_producto_temporal SET nombre_tipo_unidad_medida = '$nombre_tipo_unidad_medida' WHERE cod_transferencia_producto_temporal = '$cod_transferencia_producto_temporal'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='precio_venta_producto') && ($tipo_ajax=='tbl15_transferencia_producto_temporal')) {
$precio_venta_producto        = intval($_REQUEST['valor']);
$cod_transferencia_producto_temporal  = intval($_REQUEST['id']);

$datos_info_temporal = "SELECT und_venta, precio_costo_producto FROM tbl15_transferencia_producto_temporal WHERE (cod_transferencia_producto_temporal = '$cod_transferencia_producto_temporal')";
$consulta_info_temporal = mysqli_query($conectar, $datos_info_temporal) or die(mysqli_error($conectar));
$info_temporal = mysqli_fetch_assoc($consulta_info_temporal);

$total_costo_producto         = $info_temporal['precio_costo_producto'] * $info_temporal['und_venta'];
$total_venta_producto         = $precio_venta_producto * $info_temporal['und_venta'];

if ($total_costo_producto > $total_venta_producto) { $cod_estado_permitir_venta = '1'; } else { $cod_estado_permitir_venta = '0'; }

$data_sql = ("UPDATE tbl15_transferencia_producto_temporal SET precio_venta_producto = '$precio_venta_producto', total_venta_producto = '$total_venta_producto',
cod_estado_permitir_venta = '$cod_estado_permitir_venta' WHERE cod_transferencia_producto_temporal = '$cod_transferencia_producto_temporal'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='nombre_cliente') && ($tipo_ajax=='tbl15_transferencia_producto_temporal')) {
$nombre_cliente              = addslashes(strtoupper($_REQUEST['valor']));
$cod_transferencia_producto_temporal = intval($_REQUEST['id']);

$data_sql = ("UPDATE tbl15_transferencia_producto_temporal SET nombre_cliente = '$nombre_cliente' WHERE cod_transferencia_producto_temporal = '$cod_transferencia_producto_temporal'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='cod_tipo_cobrar') && ($tipo_ajax=='tbl15_transferencia_producto_temporal')) {
$cod_tipo_cobrar             = addslashes(($_REQUEST['valor']));
$id                          = addslashes($_REQUEST['id']);
$frag                        = explode("__", $id);
$cod_transferencia_producto_temporal = $frag[1];

$data_sql = ("UPDATE tbl15_transferencia_producto_temporal SET cod_tipo_cobrar = '$cod_tipo_cobrar' WHERE cod_transferencia_producto_temporal = '$cod_transferencia_producto_temporal'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='fecha_alerta') && ($tipo_ajax=='tbl15_transferencia_producto_temporal')) {
$fecha_alerta                = addslashes(($_REQUEST['valor']));
$cod_transferencia_producto_temporal = intval($_REQUEST['id']);

$data_sql = ("UPDATE tbl15_transferencia_producto_temporal SET fecha_alerta = '$fecha_alerta' WHERE cod_transferencia_producto_temporal = '$cod_transferencia_producto_temporal'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='identificacion_tercero') && ($tipo_ajax=='tbl15_transferencia_producto_temporal')) {
$identificacion_tercero           = addslashes($_REQUEST['valor']);

$sql_datos = "SELECT * FROM tbl15_tercero WHERE identificacion_tercero = '$identificacion_tercero'";
$resultado_datos = mysqli_query($conectar, $sql_datos);
$existe_reg = mysqli_num_rows($resultado_datos);
$info_datos = mysqli_fetch_assoc($resultado_datos);

$nombre1_tercero                = $info_datos['nombre1_tercero'];
$nombre2_tercero                = $info_datos['nombre2_tercero'];
$apellido1_tercero              = $info_datos['apellido1_tercero'];
$apellido2_tercero              = $info_datos['apellido2_tercero'];

$nombre_tercero                 = $nombre1_tercero.' '.$nombre2_tercero.' '.$apellido1_tercero.' '.$apellido2_tercero;

if ($existe_reg <> 0) { 
echo "<img src='../imagenes/advertencia1.gif'>Error: el documento ".$identificacion_tercero." ya existe para: ".$nombre_tercero.'. Intente con otro numero de documento '."<img src='../imagenes/advertencia1.gif'>"; 
} else { echo ""; }
}
// ------------------------------------------------------------------------------------------------- //
// ------------------------------------------------------------------------------------------------- //
// ------------------------------------------------------------------------------------------------- //
// ------------------------------------------------------------------------------------------------- //
if (($campo=='cod_historia_clinica') && ($tipo_ajax=='tbl15_info_factura_transferencia')) {
$cod_historia_clinica         = intval($_REQUEST['valor']);
$cod_transferencia_producto           = intval($_REQUEST['id']);

$data_sql = ("UPDATE tbl15_transferencia_producto SET cod_historia_clinica = '$cod_historia_clinica' WHERE cod_info_factura_transferencia = '$cod_info_factura_transferencia'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

$data_sql = ("UPDATE tbl15_info_factura_transferencia SET cod_historia_clinica = '$cod_historia_clinica' WHERE cod_info_factura_transferencia = '$cod_info_factura_transferencia'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
// ------------------------------------------------------------------------------------------------- //
if (($campo=='cod_producto_barra') && ($tipo_ajax=='tbl15_transferencia_producto')) {
$cod_producto_barra           = addslashes($_REQUEST['valor']);
$cod_transferencia_producto           = intval($_REQUEST['id']);

$data_sql = ("UPDATE tbl15_transferencia_producto SET cod_producto_barra = '$cod_producto_barra' WHERE cod_transferencia_producto = '$cod_transferencia_producto'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}

// ------------------------------------------------------------------------------------------------- //
if (($campo=='nombre_producto') && ($tipo_ajax=='tbl15_transferencia_producto')) {
$nombre_producto              = addslashes(strtoupper($_REQUEST['valor']));
$cod_transferencia_producto           = intval($_REQUEST['id']);

$data_sql = ("UPDATE tbl15_transferencia_producto SET nombre_producto = '$nombre_producto' WHERE cod_transferencia_producto = '$cod_transferencia_producto'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='und_venta') && ($tipo_ajax=='tbl15_transferencia_producto')) {
$und_venta                    = addslashes($_REQUEST['valor']);
$cod_transferencia_producto           = intval($_REQUEST['id']);
$origen_operacion             = 'ventas';
$fecha_devolucion             = date("Y-m-d");
$hora_devolucion              = date("H:i:s");
$fecha_time                   = time();

$sql_datos = "SELECT cod_producto, cod_producto_barra, nombre_producto, cod_tercero, precio_compra_producto, precio_costo_producto, precio_venta_producto, 
cod_tipo_pago, cod_info_factura_transferencia, cod_factura, precio_costo_producto, precio_venta_producto, und_venta, iva_ptj, fecha_ymd_venta_producto, fecha_hora_venta_producto, cuenta 
FROM tbl15_transferencia_producto WHERE cod_transferencia_producto = '$cod_transferencia_producto'";
$resultado_datos = mysqli_query($conectar, $sql_datos);
$info_datos = mysqli_fetch_assoc($resultado_datos);

//$und_venta                      = $info_datos['und_venta']; 
$cod_producto                   = $info_datos['cod_producto'];
$cod_producto_barra             = $info_datos['cod_producto_barra'];
$nombre_producto                = $info_datos['nombre_producto'];
$cod_tercero                    = $info_datos['cod_tercero'];
$precio_compra_producto         = $info_datos['precio_compra_producto'];
$precio_costo_producto          = $info_datos['precio_costo_producto'];
$precio_venta_producto          = $info_datos['precio_venta_producto'];
$iva_ptj                        = $info_datos['iva_ptj'];
$fecha_ymd_venta_producto       = $info_datos['fecha_ymd_venta_producto'];
$fecha_hora_venta_producto      = $info_datos['fecha_hora_venta_producto'];
$vendedor                       = $info_datos['cuenta'];
$cod_tipo_pago                  = $info_datos['cod_tipo_pago'];
$cod_info_factura_transferencia         = $info_datos['cod_info_factura_transferencia'];
$cod_factura                    = $info_datos['cod_factura'];
$total_costo_producto           = $info_datos['precio_costo_producto'] * $und_venta;
$total_compra_producto          = $info_datos['precio_compra_producto'] * $und_venta;
$total_venta_producto           = $info_datos['precio_venta_producto'] * $und_venta;
$unidades_vendidas              = $und_venta;
$und_vend_orig                  = $und_venta;
$vlr_total_venta                = $precio_venta_producto * $und_venta;
$vlr_total_compra               = $precio_compra_producto * $und_venta;
$devoluciones                   = $und_vend_orig - $und_venta;
$comentario                     = 'devolucion venta input ajax';
$fecha                          = $fecha_time;
$fecha_mes                      = date("Y-m");

$data_sql = ("UPDATE tbl15_transferencia_producto SET und_venta = '$und_venta', total_costo_producto = '$total_costo_producto', total_compra_producto = '$total_compra_producto' , total_venta_producto = '$total_venta_producto'
WHERE cod_transferencia_producto = '$cod_transferencia_producto'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

$sql_datos_venta_sum = "SELECT SUM(precio_costo_producto * und_venta) AS total_precio_compra, SUM(precio_venta_producto * und_venta) AS total_precio_venta 
FROM tbl15_transferencia_producto WHERE cod_info_factura_transferencia = '$cod_info_factura_transferencia'";
$resultado_datos_venta_sum = mysqli_query($conectar, $sql_datos_venta_sum);
$total_datos_data = mysqli_num_rows($resultado_datos_venta_sum);
$info_datos_venta_sum = mysqli_fetch_assoc($resultado_datos_venta_sum);

$total_precio_compra      = $info_datos_venta_sum['total_precio_compra']; 
$total_precio_venta       = $info_datos_venta_sum['total_precio_venta']; 

$agregar_regis = sprintf("UPDATE tbl15_info_factura_transferencia SET total_precio_compra = '$total_precio_compra', total_precio_venta = '$total_precio_venta', 
total_datos_data = '$total_datos_data' WHERE cod_info_factura_transferencia = '$cod_info_factura_transferencia'");

$sql_datos_producto = "SELECT und_producto FROM tbl15_producto WHERE cod_producto_barra = '$cod_producto_barra'";
$resultado_datos_producto = mysqli_query($conectar, $sql_datos_producto);
$info_datos_producto = mysqli_fetch_assoc($resultado_datos_producto);

$und_producto_inv      = $info_datos_producto['und_producto']; 
$und_producto          = $und_producto_inv + $und_venta;
$und_inventario        = $und_producto_inv;
$und_nuevas            = $und_venta;

$data_sql = ("UPDATE tbl15_producto SET und_producto = '$und_producto' WHERE cod_producto_barra = '$cod_producto_barra'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

$sql_datos_producto_desp = "SELECT und_producto FROM tbl15_producto WHERE cod_producto_barra = '$cod_producto_barra'";
$resultado_datos_producto_desp = mysqli_query($conectar, $sql_datos_producto_desp);
$info_datos_producto_desp = mysqli_fetch_assoc($resultado_datos_producto_desp);

$unidades_faltantes      = $info_datos_producto_desp['und_producto']; 

$agregar_operacion = "INSERT INTO tbl15_operacion (cod_transferencia_producto, cod_producto_barra, nombre_producto, origen_operacion, cod_factura, 
unidades_vendidas, und_vend_orig, devoluciones, precio_compra_producto, precio_costo_producto, precio_venta_producto, 
vlr_total_compra, vlr_total_venta, cod_tercero, iva_ptj, fecha_devolucion, hora_devolucion, fecha_orig, fecha_anyo, 
fecha_hora, vendedor, cuenta, fecha_time, und_inventario, unidades_faltantes, und_nuevas, comentario, fecha, fecha_mes) 
VALUES ('$cod_transferencia_producto', '$cod_producto_barra', '$nombre_producto', '$origen_operacion', '$cod_factura', 
'$unidades_vendidas', '$und_vend_orig', '$devoluciones', '$precio_compra_producto', '$precio_costo_producto', '$precio_venta_producto', 
'$vlr_total_compra', '$vlr_total_venta', '$cod_tercero', '$iva_ptj', '$fecha_devolucion', '$hora_devolucion', '$fecha_ymd_venta_producto', '$fecha_ymd_venta_producto', 
'$fecha_hora_venta_producto', '$vendedor', '$cuenta', '$fecha_time', '$und_inventario', '$unidades_faltantes', '$und_nuevas', '$comentario', '$fecha', '$fecha_mes')";
$resultado_operacion = mysqli_query($conectar, $agregar_operacion) or die(mysqli_error($conectar));

if ($cod_tipo_pago == '2') {
$sql_total_deuda_credito = "SELECT SUM(total_venta_producto) AS monto_deuda FROM tbl15_transferencia_producto WHERE (cod_info_factura_transferencia = '$cod_info_factura_transferencia')";
$consulta_total_deuda_credito = mysqli_query($conectar, $sql_total_deuda_credito) or die(mysqli_error($conectar));
$info_total_deuda_credito = mysqli_fetch_assoc($consulta_total_deuda_credito);

$monto_deuda                  = $info_total_deuda_credito['monto_deuda'];

$sql_total_abonado_credito = "SELECT SUM(abonado) AS abonado FROM tbl15_cuentas_cobrar_abonos WHERE (cod_factura = '$cod_factura')";
$consulta_total_abonado_credito = mysqli_query($conectar, $sql_total_abonado_credito) or die(mysqli_error($conectar));
$info_total_abonado_credito = mysqli_fetch_assoc($consulta_total_abonado_credito);

$abonado                      = $info_total_abonado_credito['abonado'];
$subtotal                     = $monto_deuda - $abonado;

$data_sql = ("UPDATE tbl15_cuentas_cobrar SET monto_deuda = '$monto_deuda', subtotal = '$subtotal', abonado = '$abonado' WHERE cod_factura = '$cod_factura'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));
}
if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='precio_venta_producto') && ($tipo_ajax=='tbl15_transferencia_producto')) {
$precio_venta_producto        = intval($_REQUEST['valor']);
$cod_venta_producto           = intval($_REQUEST['id']);

$datos_info_temporal = "SELECT und_venta FROM tbl15_transferencia_producto WHERE (cod_transferencia_producto = '$cod_transferencia_producto')";
$consulta_info_temporal = mysqli_query($conectar, $datos_info_temporal) or die(mysqli_error($conectar));
$info_temporal = mysqli_fetch_assoc($consulta_info_temporal);

$total_venta_producto           = $precio_venta_producto * $info_temporal['und_venta'];
//$total_venta_audiometria        = $precio_venta_producto * $info_temporal['und_audiometria'];
//$total_venta_optometria         = $precio_venta_producto * $info_temporal['und_optometria'];
//$total_venta_electrocardiograma = $precio_venta_producto * $info_temporal['und_electrocardiograma'];

$data_sql = ("UPDATE tbl15_transferencia_producto SET precio_venta_producto = '$precio_venta_producto', total_venta_producto = '$total_venta_producto'
WHERE cod_transferencia_producto = '$cod_transferencia_producto'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='und_audiometria') && ($tipo_ajax=='tbl15_transferencia_producto')) {
$und_audiometria              = intval($_REQUEST['valor']);
$cod_transferencia_producto           = intval($_REQUEST['id']);

$datos_info_temporal = "SELECT precio_venta_producto FROM tbl15_transferencia_producto WHERE (cod_transferencia_producto = '$cod_transferencia_producto')";
$consulta_info_temporal = mysqli_query($conectar, $datos_info_temporal) or die(mysqli_error($conectar));
$info_temporal = mysqli_fetch_assoc($consulta_info_temporal);

$precio_venta_producto        = $info_temporal['precio_venta_producto'];
$total_venta_audiometria      = $precio_venta_producto * $und_audiometria;
$total_venta_producto         = $precio_venta_producto * $und_audiometria;

$data_sql = ("UPDATE tbl15_transferencia_producto SET und_audiometria = '$und_audiometria', total_venta_audiometria = '$total_venta_audiometria',  
total_venta_producto = '$total_venta_producto' WHERE cod_transferencia_producto = '$cod_transferencia_producto'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='und_audiometria') && ($tipo_ajax=='tbl15_transferencia_producto')) {
$und_audiometria               = intval($_REQUEST['valor']);
$cod_transferencia_producto           = intval($_REQUEST['id']);

$datos_info_temporal = "SELECT precio_venta_producto FROM tbl15_transferencia_producto WHERE (cod_transferencia_producto = '$cod_transferencia_producto')";
$consulta_info_temporal = mysqli_query($conectar, $datos_info_temporal) or die(mysqli_error($conectar));
$info_temporal = mysqli_fetch_assoc($consulta_info_temporal);

$precio_venta_producto        = $info_temporal['precio_venta_producto'];
$total_venta_audiometria      = $precio_venta_producto * $und_audiometria;
$total_venta_producto         = $precio_venta_producto * $und_audiometria;

$data_sql = ("UPDATE tbl15_transferencia_producto SET und_audiometria = '$und_audiometria', total_venta_audiometria = '$total_venta_audiometria',  
total_venta_producto = '$total_venta_producto' WHERE cod_transferencia_producto = '$cod_transferencia_producto'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='und_optometria') && ($tipo_ajax=='tbl15_transferencia_producto')) {
$und_optometria               = intval($_REQUEST['valor']);
$cod_transferencia_producto           = intval($_REQUEST['id']);

$datos_info_temporal = "SELECT precio_venta_producto FROM tbl15_transferencia_producto WHERE (cod_transferencia_producto = '$cod_transferencia_producto')";
$consulta_info_temporal = mysqli_query($conectar, $datos_info_temporal) or die(mysqli_error($conectar));
$info_temporal = mysqli_fetch_assoc($consulta_info_temporal);

$precio_venta_producto        = $info_temporal['precio_venta_producto'];
$total_venta_optometria       = $precio_venta_producto * $und_optometria;
$total_venta_producto         = $precio_venta_producto * $und_optometria;

$data_sql = ("UPDATE tbl15_transferencia_producto SET und_optometria = '$und_optometria', total_venta_optometria = '$total_venta_optometria',  
total_venta_producto = '$total_venta_producto' WHERE cod_transferencia_producto = '$cod_transferencia_producto'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='und_electrocardiograma') && ($tipo_ajax=='tbl15_transferencia_producto')) {
$und_electrocardiograma       = intval($_REQUEST['valor']);
$cod_transferencia_producto           = intval($_REQUEST['id']);

$datos_info_temporal = "SELECT precio_venta_producto FROM tbl15_transferencia_producto WHERE (cod_transferencia_producto = '$cod_transferencia_producto')";
$consulta_info_temporal = mysqli_query($conectar, $datos_info_temporal) or die(mysqli_error($conectar));
$info_temporal = mysqli_fetch_assoc($consulta_info_temporal);

$precio_venta_producto            = $info_temporal['precio_venta_producto'];
$total_venta_electrocardiograma   = $precio_venta_producto * $und_electrocardiograma;
$total_venta_producto             = $precio_venta_producto * $und_electrocardiograma;

$data_sql = ("UPDATE tbl15_transferencia_producto SET und_electrocardiograma = '$und_electrocardiograma', total_venta_electrocardiograma = '$total_venta_electrocardiograma',  
total_venta_producto = '$total_venta_producto' WHERE cod_transferencia_producto = '$cod_transferencia_producto'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='nombre_cliente') && ($tipo_ajax=='tbl15_transferencia_producto')) {
$nombre_cliente               = addslashes(strtoupper($_REQUEST['valor']));
$cod_transferencia_producto           = intval($_REQUEST['id']);

$data_sql = ("UPDATE tbl15_transferencia_producto SET nombre_cliente = '$nombre_cliente' WHERE cod_transferencia_producto = '$cod_transferencia_producto'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='fecha_alerta') && ($tipo_ajax=='tbl15_transferencia_producto')) {
$fecha_alerta                = addslashes(($_REQUEST['valor']));
$cod_transferencia_producto_temporal = intval($_REQUEST['id']);

$data_sql = ("UPDATE tbl15_transferencia_producto SET fecha_alerta = '$fecha_alerta' WHERE cod_transferencia_producto = '$cod_transferencia_producto'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
?>