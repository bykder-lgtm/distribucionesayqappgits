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
$tipo_ajax                    = addslashes($_POST['tipo_ajax']);
$campo                        = addslashes($_POST['campo']);

$datos_info = "SELECT * FROM tbl15_info_plan_accion_correctiva_preventiva_mejora WHERE (cod_estado_factura = '1') AND (cuenta = '$cuenta_actual')";
$consulta_info = mysqli_query($conectar, $datos_info) or die(mysqli_error($conectar));
$info = mysqli_fetch_assoc($consulta_info);
$factura_ocupada = mysqli_num_rows($consulta_info);
// ------------------------------------------------------------------------------------------------- //
if (($campo=='cod_historia_clinica') && ($tipo_ajax=='tbl15_info_plan_accion_correctiva_preventiva_mejora')) {
$cod_historia_clinica         = intval($_POST['valor']);
$cod_info_plan_accion_correctiva_preventiva_mejora             = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_plan_accion_correctiva_preventiva_mejora SET cod_historia_clinica = '$cod_historia_clinica' WHERE cod_info_plan_accion_correctiva_preventiva_mejora = '$cod_info_plan_accion_correctiva_preventiva_mejora'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

$data_sql = ("UPDATE tbl15_info_plan_accion_correctiva_preventiva_mejora SET cod_historia_clinica = '$cod_historia_clinica' WHERE cod_info_plan_accion_correctiva_preventiva_mejora = '$cod_info_plan_accion_correctiva_preventiva_mejora'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='fecha_anyo') && ($tipo_ajax=='tbl15_info_plan_accion_correctiva_preventiva_mejora')) {
$fecha_anyo                   = addslashes($_POST['valor']);
$cod_info_plan_accion_correctiva_preventiva_mejora       = intval($_POST['id']);
$fecha_anyo_seg               = strtotime($fecha_anyo);
$fecha_dia                    = date("Y-m-d", $fecha_anyo_seg);
$fecha_mes                    = date("m-Y", $fecha_anyo_seg);
$anyo                         = date("Y", $fecha_anyo_seg);

$data_sql = ("UPDATE tbl15_info_plan_accion_correctiva_preventiva_mejora SET fecha_anyo = '$fecha_anyo', fecha_dia = '$fecha_dia', fecha_mes = '$fecha_mes', anyo = '$anyo' 
WHERE cod_info_plan_accion_correctiva_preventiva_mejora = '$cod_info_plan_accion_correctiva_preventiva_mejora'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='nombre_tipo_moneda') && ($tipo_ajax=='tbl15_info_plan_accion_correctiva_preventiva_mejora')) {
$nombre_tipo_moneda           = addslashes($_POST['valor']);
$cod_info_plan_accion_correctiva_preventiva_mejora             = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_info_plan_accion_correctiva_preventiva_mejora SET nombre_tipo_moneda = '$nombre_tipo_moneda' WHERE cod_info_plan_accion_correctiva_preventiva_mejora = '$cod_info_plan_accion_correctiva_preventiva_mejora'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='nombre_tipo_factura') && ($tipo_ajax=='tbl15_info_plan_accion_correctiva_preventiva_mejora')) {
$nombre_tipo_factura         = addslashes($_POST['valor']);
$cod_info_plan_accion_correctiva_preventiva_mejora             = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_info_plan_accion_correctiva_preventiva_mejora SET nombre_tipo_factura = '$nombre_tipo_factura' WHERE cod_info_plan_accion_correctiva_preventiva_mejora = '$cod_info_plan_accion_correctiva_preventiva_mejora'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='cod_tipo_forma_pago') && ($tipo_ajax=='tbl15_info_plan_accion_correctiva_preventiva_mejora')) {
$cod_tipo_forma_pago                           = intval($_POST['valor']);
$cod_info_plan_accion_correctiva_preventiva_mejora             = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_info_plan_accion_correctiva_preventiva_mejora SET cod_tipo_forma_pago = '$cod_tipo_forma_pago' WHERE cod_info_plan_accion_correctiva_preventiva_mejora = '$cod_info_plan_accion_correctiva_preventiva_mejora'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='cod_tipo_pago') && ($tipo_ajax=='tbl15_info_plan_accion_correctiva_preventiva_mejora')) {
$cod_tipo_pago         = addslashes($_POST['valor']);
$cod_info_plan_accion_correctiva_preventiva_mejora             = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_info_plan_accion_correctiva_preventiva_mejora SET cod_tipo_pago = '$cod_tipo_pago' WHERE cod_info_plan_accion_correctiva_preventiva_mejora = '$cod_info_plan_accion_correctiva_preventiva_mejora'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='nombre_comentario') && ($tipo_ajax=='tbl15_info_plan_accion_correctiva_preventiva_mejora')) {
$nombre_comentario                                   = addslashes($_POST['valor']);
$cod_info_plan_accion_correctiva_preventiva_mejora             = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_info_plan_accion_correctiva_preventiva_mejora SET nombre_comentario = '$nombre_comentario' WHERE cod_info_plan_accion_correctiva_preventiva_mejora = '$cod_info_plan_accion_correctiva_preventiva_mejora'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='descripcion_tipo_pendiente') && ($tipo_ajax=='tbl15_info_plan_accion_correctiva_preventiva_mejora')) {
$descripcion_tipo_pendiente                                   = addslashes($_POST['valor']);
$cod_info_plan_accion_correctiva_preventiva_mejora             = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_info_plan_accion_correctiva_preventiva_mejora SET descripcion_tipo_pendiente = '$descripcion_tipo_pendiente' WHERE cod_info_plan_accion_correctiva_preventiva_mejora = '$cod_info_plan_accion_correctiva_preventiva_mejora'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='cod_version') && ($tipo_ajax=='tbl15_info_plan_accion_correctiva_preventiva_mejora')) {
$cod_version                                                       = addslashes($_POST['valor']);
$cod_info_plan_accion_correctiva_preventiva_mejora             = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_info_plan_accion_correctiva_preventiva_mejora SET cod_version = '$cod_version' WHERE cod_info_plan_accion_correctiva_preventiva_mejora = '$cod_info_plan_accion_correctiva_preventiva_mejora'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='fecha_entrega') && ($tipo_ajax=='tbl15_info_plan_accion_correctiva_preventiva_mejora')) {
$fecha_entrega                                   = addslashes($_POST['valor']);
$cod_info_plan_accion_correctiva_preventiva_mejora             = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_info_plan_accion_correctiva_preventiva_mejora SET fecha_entrega = '$fecha_entrega' WHERE cod_info_plan_accion_correctiva_preventiva_mejora = '$cod_info_plan_accion_correctiva_preventiva_mejora'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='hora_entrega') && ($tipo_ajax=='tbl15_info_plan_accion_correctiva_preventiva_mejora')) {
$hora_entrega                                   = addslashes($_POST['valor']);
$cod_info_plan_accion_correctiva_preventiva_mejora             = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_info_plan_accion_correctiva_preventiva_mejora SET hora_entrega = '$hora_entrega' WHERE cod_info_plan_accion_correctiva_preventiva_mejora = '$cod_info_plan_accion_correctiva_preventiva_mejora'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='nombre_tipo_pendiente') && ($tipo_ajax=='tbl15_info_plan_accion_correctiva_preventiva_mejora')) {
$nombre_tipo_pendiente                                   = addslashes($_POST['valor']);
$cod_info_plan_accion_correctiva_preventiva_mejora             = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_info_plan_accion_correctiva_preventiva_mejora SET nombre_tipo_pendiente = '$nombre_tipo_pendiente' WHERE cod_info_plan_accion_correctiva_preventiva_mejora = '$cod_info_plan_accion_correctiva_preventiva_mejora'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='cod_tercero') && ($tipo_ajax=='tbl15_info_plan_accion_correctiva_preventiva_mejora')) {
$cod_tercero                        = addslashes($_POST['valor']);
$cod_info_plan_accion_correctiva_preventiva_mejora             = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_plan_accion_correctiva_preventiva_mejora SET cod_tercero = '$cod_tercero' WHERE cod_info_plan_accion_correctiva_preventiva_mejora = '$cod_info_plan_accion_correctiva_preventiva_mejora'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

$data_sql = ("UPDATE tbl15_info_plan_accion_correctiva_preventiva_mejora SET cod_tercero = '$cod_tercero' WHERE cod_info_plan_accion_correctiva_preventiva_mejora = '$cod_info_plan_accion_correctiva_preventiva_mejora'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='cod_administrador') && ($tipo_ajax=='tbl15_info_plan_accion_correctiva_preventiva_mejora')) {
$cod_administrador                  = intval($_POST['valor']);
$cod_info_plan_accion_correctiva_preventiva_mejora             = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_info_plan_accion_correctiva_preventiva_mejora SET cod_administrador = '$cod_administrador' WHERE cod_info_plan_accion_correctiva_preventiva_mejora = '$cod_info_plan_accion_correctiva_preventiva_mejora'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='cod_cliente') && ($tipo_ajax=='tbl15_info_plan_accion_correctiva_preventiva_mejora')) {
$cod_cliente                  = intval($_POST['valor']);
$cod_info_plan_accion_correctiva_preventiva_mejora             = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_info_plan_accion_correctiva_preventiva_mejora SET cod_cliente = '$cod_cliente' WHERE cod_info_plan_accion_correctiva_preventiva_mejora = '$cod_info_plan_accion_correctiva_preventiva_mejora'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='cod_empresa') && ($tipo_ajax=='tbl15_info_plan_accion_correctiva_preventiva_mejora')) {
$cod_empresa                  = intval($_POST['valor']);
$cod_info_plan_accion_correctiva_preventiva_mejora             = intval($_POST['id']);

$obtener_empresa = "SELECT nombre_empresa, razonsocial_empresa FROM tbl15_empresa WHERE cod_empresa = '$cod_empresa'";
$resultado_empresa = mysqli_query($conectar, $obtener_empresa) or die(mysqli_error($conectar));
$matriz_empresa = mysqli_fetch_assoc($resultado_empresa);

$nombre_empresa                = $matriz_empresa['nombre_empresa'];
$razonsocial_empresa           = $matriz_empresa['razonsocial_empresa'];

$obtener_cliente = "SELECT cod_cliente FROM tbl15_cliente WHERE cod_empresa = '$cod_empresa'";
$resultado_cliente = mysqli_query($conectar, $obtener_cliente) or die(mysqli_error($conectar));
$matriz_cliente = mysqli_fetch_assoc($resultado_cliente);

$cod_cliente                   = $matriz_cliente['cod_cliente'];

$data_sql = ("UPDATE tbl15_info_plan_accion_correctiva_preventiva_mejora SET cod_empresa = '$cod_empresa', cod_cliente = '$cod_cliente', nombre_empresa = '$nombre_empresa', razonsocial_empresa = '$razonsocial_empresa' 
	WHERE cod_info_plan_accion_correctiva_preventiva_mejora = '$cod_info_plan_accion_correctiva_preventiva_mejora'");
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
if (($campo=='nombre_tipo_producto') && ($tipo_ajax=='tbl15_info_plan_accion_correctiva_preventiva_mejora')) {
$nombre_tipo_producto         = addslashes($_POST['valor']);
$cod_info_plan_accion_correctiva_preventiva_mejora             = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_info_plan_accion_correctiva_preventiva_mejora SET nombre_tipo_producto = '$nombre_tipo_producto' WHERE cod_info_plan_accion_correctiva_preventiva_mejora = '$cod_info_plan_accion_correctiva_preventiva_mejora'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
// ------------------------------------------------------------------------------------------------- //
// ------------------------------------------------------------------------------------------------- //
// ------------------------------------------------------------------------------------------------- //
if (($campo=='cod_producto_barra') && ($tipo_ajax=='tbl15_plan_accion_correctiva_preventiva_mejora')) {
$cod_producto_barra           = addslashes($_POST['valor']);
$cod_plan_accion_correctiva_preventiva_mejora  = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_plan_accion_correctiva_preventiva_mejora SET cod_producto_barra = '$cod_producto_barra' WHERE cod_plan_accion_correctiva_preventiva_mejora = '$cod_plan_accion_correctiva_preventiva_mejora'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='nombre_producto') && ($tipo_ajax=='tbl15_plan_accion_correctiva_preventiva_mejora')) {
$nombre_producto              = addslashes(strtoupper($_POST['valor']));
$cod_plan_accion_correctiva_preventiva_mejora  = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_plan_accion_correctiva_preventiva_mejora SET nombre_producto = '$nombre_producto' WHERE cod_plan_accion_correctiva_preventiva_mejora = '$cod_plan_accion_correctiva_preventiva_mejora'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='nombre_tipo_accion') && ($tipo_ajax=='tbl15_plan_accion_correctiva_preventiva_mejora')) {
$nombre_tipo_accion              = addslashes(strtoupper($_POST['valor']));
$cod_plan_accion_correctiva_preventiva_mejora  = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_plan_accion_correctiva_preventiva_mejora SET nombre_tipo_accion = '$nombre_tipo_accion' WHERE cod_plan_accion_correctiva_preventiva_mejora = '$cod_plan_accion_correctiva_preventiva_mejora'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='nombre_tipo_fuente') && ($tipo_ajax=='tbl15_plan_accion_correctiva_preventiva_mejora')) {
$nombre_tipo_fuente              = addslashes(strtoupper($_POST['valor']));
$cod_plan_accion_correctiva_preventiva_mejora  = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_plan_accion_correctiva_preventiva_mejora SET nombre_tipo_fuente = '$nombre_tipo_fuente' WHERE cod_plan_accion_correctiva_preventiva_mejora = '$cod_plan_accion_correctiva_preventiva_mejora'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='nombre_tipo_actividad') && ($tipo_ajax=='tbl15_plan_accion_correctiva_preventiva_mejora')) {
$nombre_tipo_actividad              = addslashes(strtoupper($_POST['valor']));
$cod_plan_accion_correctiva_preventiva_mejora  = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_plan_accion_correctiva_preventiva_mejora SET nombre_tipo_actividad = '$nombre_tipo_actividad' WHERE cod_plan_accion_correctiva_preventiva_mejora = '$cod_plan_accion_correctiva_preventiva_mejora'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='descripcion_hallazgo') && ($tipo_ajax=='tbl15_plan_accion_correctiva_preventiva_mejora')) {
$descripcion_hallazgo              = addslashes(strtoupper($_POST['valor']));
$cod_plan_accion_correctiva_preventiva_mejora  = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_plan_accion_correctiva_preventiva_mejora SET descripcion_hallazgo = '$descripcion_hallazgo' WHERE cod_plan_accion_correctiva_preventiva_mejora = '$cod_plan_accion_correctiva_preventiva_mejora'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='nombre_tipo_accion_tomada') && ($tipo_ajax=='tbl15_plan_accion_correctiva_preventiva_mejora')) {
$nombre_tipo_accion_tomada              = addslashes(strtoupper($_POST['valor']));
$cod_plan_accion_correctiva_preventiva_mejora  = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_plan_accion_correctiva_preventiva_mejora SET nombre_tipo_accion_tomada = '$nombre_tipo_accion_tomada' WHERE cod_plan_accion_correctiva_preventiva_mejora = '$cod_plan_accion_correctiva_preventiva_mejora'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='recurso_humano') && ($tipo_ajax=='tbl15_plan_accion_correctiva_preventiva_mejora')) {
$recurso_humano              = addslashes(strtoupper($_POST['valor']));
$cod_plan_accion_correctiva_preventiva_mejora  = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_plan_accion_correctiva_preventiva_mejora SET recurso_humano = '$recurso_humano' WHERE cod_plan_accion_correctiva_preventiva_mejora = '$cod_plan_accion_correctiva_preventiva_mejora'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='recurso_financiero') && ($tipo_ajax=='tbl15_plan_accion_correctiva_preventiva_mejora')) {
$recurso_financiero              = addslashes(strtoupper($_POST['valor']));
$cod_plan_accion_correctiva_preventiva_mejora  = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_plan_accion_correctiva_preventiva_mejora SET recurso_financiero = '$recurso_financiero' WHERE cod_plan_accion_correctiva_preventiva_mejora = '$cod_plan_accion_correctiva_preventiva_mejora'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='nombre_responsable_implantar_accion') && ($tipo_ajax=='tbl15_plan_accion_correctiva_preventiva_mejora')) {
$nombre_responsable_implantar_accion              = addslashes(strtoupper($_POST['valor']));
$cod_plan_accion_correctiva_preventiva_mejora  = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_plan_accion_correctiva_preventiva_mejora SET nombre_responsable_implantar_accion = '$nombre_responsable_implantar_accion' WHERE cod_plan_accion_correctiva_preventiva_mejora = '$cod_plan_accion_correctiva_preventiva_mejora'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='fecha_prevista') && ($tipo_ajax=='tbl15_plan_accion_correctiva_preventiva_mejora')) {
$fecha_prevista              = addslashes(strtoupper($_POST['valor']));
$cod_plan_accion_correctiva_preventiva_mejora  = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_plan_accion_correctiva_preventiva_mejora SET fecha_prevista = '$fecha_prevista' WHERE cod_plan_accion_correctiva_preventiva_mejora = '$cod_plan_accion_correctiva_preventiva_mejora'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='seguimiento_cumplimiento') && ($tipo_ajax=='tbl15_plan_accion_correctiva_preventiva_mejora')) {
$seguimiento_cumplimiento              = addslashes(strtoupper($_POST['valor']));
$cod_plan_accion_correctiva_preventiva_mejora  = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_plan_accion_correctiva_preventiva_mejora SET seguimiento_cumplimiento = '$seguimiento_cumplimiento' WHERE cod_plan_accion_correctiva_preventiva_mejora = '$cod_plan_accion_correctiva_preventiva_mejora'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='seguimiento_eficacia') && ($tipo_ajax=='tbl15_plan_accion_correctiva_preventiva_mejora')) {
$seguimiento_eficacia              = addslashes(strtoupper($_POST['valor']));
$cod_plan_accion_correctiva_preventiva_mejora  = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_plan_accion_correctiva_preventiva_mejora SET seguimiento_eficacia = '$seguimiento_eficacia' WHERE cod_plan_accion_correctiva_preventiva_mejora = '$cod_plan_accion_correctiva_preventiva_mejora'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='seguimiento_soporte') && ($tipo_ajax=='tbl15_plan_accion_correctiva_preventiva_mejora')) {
$seguimiento_soporte              = addslashes(strtoupper($_POST['valor']));
$cod_plan_accion_correctiva_preventiva_mejora  = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_plan_accion_correctiva_preventiva_mejora SET seguimiento_soporte = '$seguimiento_soporte' WHERE cod_plan_accion_correctiva_preventiva_mejora = '$cod_plan_accion_correctiva_preventiva_mejora'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='nombre_frec_duracion') && ($tipo_ajax=='tbl15_plan_accion_correctiva_preventiva_mejora')) {
$nombre_frec_duracion         = addslashes(strtoupper($_POST['valor']));
$cod_plan_accion_correctiva_preventiva_mejora  = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_plan_accion_correctiva_preventiva_mejora SET nombre_frec_duracion = '$nombre_frec_duracion' WHERE cod_plan_accion_correctiva_preventiva_mejora = '$cod_plan_accion_correctiva_preventiva_mejora'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='und_venta') && ($tipo_ajax=='tbl15_plan_accion_correctiva_preventiva_mejora')) {
$und_venta                    = intval($_POST['valor']);
$cod_plan_accion_correctiva_preventiva_mejora  = intval($_POST['id']);

$datos_info_temporal = "SELECT precio_costo_producto, precio_venta_producto FROM tbl15_plan_accion_correctiva_preventiva_mejora WHERE (cod_plan_accion_correctiva_preventiva_mejora = '$cod_plan_accion_correctiva_preventiva_mejora')";
$consulta_info_temporal = mysqli_query($conectar, $datos_info_temporal) or die(mysqli_error($conectar));
$info_temporal = mysqli_fetch_assoc($consulta_info_temporal);

$total_costo_producto         = $info_temporal['precio_costo_producto'] * $und_venta;
$total_venta_producto         = $info_temporal['precio_venta_producto'] * $und_venta;

if ($total_costo_producto > $total_venta_producto) { $cod_estado_permitir_venta = '1'; } else { $cod_estado_permitir_venta = '0'; }

$data_sql = ("UPDATE tbl15_plan_accion_correctiva_preventiva_mejora SET und_venta = '$und_venta', total_costo_producto = '$total_costo_producto', total_venta_producto = '$total_venta_producto', 
cod_estado_permitir_venta = '$cod_estado_permitir_venta' WHERE cod_plan_accion_correctiva_preventiva_mejora = '$cod_plan_accion_correctiva_preventiva_mejora'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='precio_venta_producto') && ($tipo_ajax=='tbl15_plan_accion_correctiva_preventiva_mejora')) {
$precio_venta_producto        = intval($_POST['valor']);
$cod_plan_accion_correctiva_preventiva_mejora  = intval($_POST['id']);

$datos_info_temporal = "SELECT und_venta, precio_costo_producto FROM tbl15_plan_accion_correctiva_preventiva_mejora WHERE (cod_plan_accion_correctiva_preventiva_mejora = '$cod_plan_accion_correctiva_preventiva_mejora')";
$consulta_info_temporal = mysqli_query($conectar, $datos_info_temporal) or die(mysqli_error($conectar));
$info_temporal = mysqli_fetch_assoc($consulta_info_temporal);

$total_costo_producto         = $info_temporal['precio_costo_producto'] * $info_temporal['und_venta'];
$total_venta_producto         = $precio_venta_producto * $info_temporal['und_venta'];

if ($total_costo_producto > $total_venta_producto) { $cod_estado_permitir_venta = '1'; } else { $cod_estado_permitir_venta = '0'; }

$data_sql = ("UPDATE tbl15_plan_accion_correctiva_preventiva_mejora SET precio_venta_producto = '$precio_venta_producto', total_venta_producto = '$total_venta_producto',
cod_estado_permitir_venta = '$cod_estado_permitir_venta' WHERE cod_plan_accion_correctiva_preventiva_mejora = '$cod_plan_accion_correctiva_preventiva_mejora'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='nombre_cliente') && ($tipo_ajax=='tbl15_plan_accion_correctiva_preventiva_mejora')) {
$nombre_cliente              = addslashes(strtoupper($_POST['valor']));
$cod_plan_accion_correctiva_preventiva_mejora = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_plan_accion_correctiva_preventiva_mejora SET nombre_cliente = '$nombre_cliente' WHERE cod_plan_accion_correctiva_preventiva_mejora = '$cod_plan_accion_correctiva_preventiva_mejora'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='cod_tipo_cobrar') && ($tipo_ajax=='tbl15_plan_accion_correctiva_preventiva_mejora')) {
$cod_tipo_cobrar             = addslashes(($_POST['valor']));
$id                          = addslashes($_POST['id']);
$frag                        = explode("__", $id);
$cod_plan_accion_correctiva_preventiva_mejora = $frag[1];

$data_sql = ("UPDATE tbl15_plan_accion_correctiva_preventiva_mejora SET cod_tipo_cobrar = '$cod_tipo_cobrar' WHERE cod_plan_accion_correctiva_preventiva_mejora = '$cod_plan_accion_correctiva_preventiva_mejora'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='fecha_alerta') && ($tipo_ajax=='tbl15_plan_accion_correctiva_preventiva_mejora')) {
$fecha_alerta                = addslashes(($_POST['valor']));
$cod_plan_accion_correctiva_preventiva_mejora = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_plan_accion_correctiva_preventiva_mejora SET fecha_alerta = '$fecha_alerta' WHERE cod_plan_accion_correctiva_preventiva_mejora = '$cod_plan_accion_correctiva_preventiva_mejora'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
// ------------------------------------------------------------------------------------------------- //
// ------------------------------------------------------------------------------------------------- //
// ------------------------------------------------------------------------------------------------- //
if (($campo=='cod_historia_clinica') && ($tipo_ajax=='tbl15_info_plan_accion_correctiva_preventiva_mejora')) {
$cod_historia_clinica         = intval($_POST['valor']);
$cod_venta_producto           = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_plan_accion_correctiva_preventiva_mejora SET cod_historia_clinica = '$cod_historia_clinica' WHERE cod_info_plan_accion_correctiva_preventiva_mejora = '$cod_info_plan_accion_correctiva_preventiva_mejora'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

$data_sql = ("UPDATE tbl15_info_plan_accion_correctiva_preventiva_mejora SET cod_historia_clinica = '$cod_historia_clinica' WHERE cod_info_plan_accion_correctiva_preventiva_mejora = '$cod_info_plan_accion_correctiva_preventiva_mejora'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
// ------------------------------------------------------------------------------------------------- //
if (($campo=='cod_producto_barra') && ($tipo_ajax=='tbl15_plan_accion_correctiva_preventiva_mejora')) {
$cod_producto_barra           = addslashes($_POST['valor']);
$cod_plan_accion_correctiva_preventiva_mejora           = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_plan_accion_correctiva_preventiva_mejora SET cod_producto_barra = '$cod_producto_barra' WHERE cod_plan_accion_correctiva_preventiva_mejora = '$cod_plan_accion_correctiva_preventiva_mejora'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}

// ------------------------------------------------------------------------------------------------- //
if (($campo=='nombre_producto') && ($tipo_ajax=='tbl15_plan_accion_correctiva_preventiva_mejora')) {
$nombre_producto              = addslashes(strtoupper($_POST['valor']));
$cod_plan_accion_correctiva_preventiva_mejora           = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_plan_accion_correctiva_preventiva_mejora SET nombre_producto = '$nombre_producto' WHERE cod_plan_accion_correctiva_preventiva_mejora = '$cod_plan_accion_correctiva_preventiva_mejora'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='und_venta') && ($tipo_ajax=='tbl15_plan_accion_correctiva_preventiva_mejora')) {
$und_venta                    = intval($_POST['valor']);
$cod_plan_accion_correctiva_preventiva_mejora           = intval($_POST['id']);

$datos_info_temporal = "SELECT precio_costo_producto, precio_venta_producto FROM tbl15_plan_accion_correctiva_preventiva_mejora WHERE (cod_plan_accion_correctiva_preventiva_mejora = '$cod_plan_accion_correctiva_preventiva_mejora')";
$consulta_info_temporal = mysqli_query($conectar, $datos_info_temporal) or die(mysqli_error($conectar));
$info_temporal = mysqli_fetch_assoc($consulta_info_temporal);

$total_costo_producto         = $info_temporal['precio_costo_producto'] * $und_venta;
$total_venta_producto         = $info_temporal['precio_venta_producto'] * $und_venta;

$data_sql = ("UPDATE tbl15_plan_accion_correctiva_preventiva_mejora SET und_venta = '$und_venta', total_costo_producto = '$total_costo_producto', total_venta_producto = '$total_venta_producto' 
WHERE cod_plan_accion_correctiva_preventiva_mejora = '$cod_plan_accion_correctiva_preventiva_mejora'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='precio_venta_producto') && ($tipo_ajax=='tbl15_plan_accion_correctiva_preventiva_mejora')) {
$precio_venta_producto        = intval($_POST['valor']);
$cod_plan_accion_correctiva_preventiva_mejora           = intval($_POST['id']);

$datos_info_temporal = "SELECT und_venta FROM tbl15_plan_accion_correctiva_preventiva_mejora WHERE (cod_plan_accion_correctiva_preventiva_mejora = '$cod_plan_accion_correctiva_preventiva_mejora')";
$consulta_info_temporal = mysqli_query($conectar, $datos_info_temporal) or die(mysqli_error($conectar));
$info_temporal = mysqli_fetch_assoc($consulta_info_temporal);

$total_venta_producto           = $precio_venta_producto * $info_temporal['und_venta'];
//$total_venta_audiometria        = $precio_venta_producto * $info_temporal['und_audiometria'];
//$total_venta_optometria         = $precio_venta_producto * $info_temporal['und_optometria'];
//$total_venta_electrocardiograma = $precio_venta_producto * $info_temporal['und_electrocardiograma'];

$data_sql = ("UPDATE tbl15_plan_accion_correctiva_preventiva_mejora SET precio_venta_producto = '$precio_venta_producto', total_venta_producto = '$total_venta_producto'
WHERE cod_plan_accion_correctiva_preventiva_mejora = '$cod_plan_accion_correctiva_preventiva_mejora'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='und_audiometria') && ($tipo_ajax=='tbl15_plan_accion_correctiva_preventiva_mejora')) {
$und_audiometria              = intval($_POST['valor']);
$cod_plan_accion_correctiva_preventiva_mejora           = intval($_POST['id']);

$datos_info_temporal = "SELECT precio_venta_producto FROM tbl15_plan_accion_correctiva_preventiva_mejora WHERE (cod_plan_accion_correctiva_preventiva_mejora = '$cod_plan_accion_correctiva_preventiva_mejora')";
$consulta_info_temporal = mysqli_query($conectar, $datos_info_temporal) or die(mysqli_error($conectar));
$info_temporal = mysqli_fetch_assoc($consulta_info_temporal);

$precio_venta_producto        = $info_temporal['precio_venta_producto'];
$total_venta_audiometria      = $precio_venta_producto * $und_audiometria;
$total_venta_producto         = $precio_venta_producto * $und_audiometria;

$data_sql = ("UPDATE tbl15_plan_accion_correctiva_preventiva_mejora SET und_audiometria = '$und_audiometria', total_venta_audiometria = '$total_venta_audiometria',  
total_venta_producto = '$total_venta_producto' WHERE cod_plan_accion_correctiva_preventiva_mejora = '$cod_plan_accion_correctiva_preventiva_mejora'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='und_audiometria') && ($tipo_ajax=='tbl15_plan_accion_correctiva_preventiva_mejora')) {
$und_audiometria               = intval($_POST['valor']);
$cod_venta_producto           = intval($_POST['id']);

$datos_info_temporal = "SELECT precio_venta_producto FROM tbl15_plan_accion_correctiva_preventiva_mejora WHERE (cod_plan_accion_correctiva_preventiva_mejora = '$cod_plan_accion_correctiva_preventiva_mejora')";
$consulta_info_temporal = mysqli_query($conectar, $datos_info_temporal) or die(mysqli_error($conectar));
$info_temporal = mysqli_fetch_assoc($consulta_info_temporal);

$precio_venta_producto        = $info_temporal['precio_venta_producto'];
$total_venta_audiometria      = $precio_venta_producto * $und_audiometria;
$total_venta_producto         = $precio_venta_producto * $und_audiometria;

$data_sql = ("UPDATE tbl15_plan_accion_correctiva_preventiva_mejora SET und_audiometria = '$und_audiometria', total_venta_audiometria = '$total_venta_audiometria',  
total_venta_producto = '$total_venta_producto' WHERE cod_plan_accion_correctiva_preventiva_mejora = '$cod_plan_accion_correctiva_preventiva_mejora'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='und_optometria') && ($tipo_ajax=='tbl15_plan_accion_correctiva_preventiva_mejora')) {
$und_optometria               = intval($_POST['valor']);
$cod_plan_accion_correctiva_preventiva_mejora           = intval($_POST['id']);

$datos_info_temporal = "SELECT precio_venta_producto FROM tbl15_plan_accion_correctiva_preventiva_mejora WHERE (cod_plan_accion_correctiva_preventiva_mejora = '$cod_plan_accion_correctiva_preventiva_mejora')";
$consulta_info_temporal = mysqli_query($conectar, $datos_info_temporal) or die(mysqli_error($conectar));
$info_temporal = mysqli_fetch_assoc($consulta_info_temporal);

$precio_venta_producto        = $info_temporal['precio_venta_producto'];
$total_venta_optometria       = $precio_venta_producto * $und_optometria;
$total_venta_producto         = $precio_venta_producto * $und_optometria;

$data_sql = ("UPDATE tbl15_plan_accion_correctiva_preventiva_mejora SET und_optometria = '$und_optometria', total_venta_optometria = '$total_venta_optometria',  
total_venta_producto = '$total_venta_producto' WHERE cod_plan_accion_correctiva_preventiva_mejora = '$cod_plan_accion_correctiva_preventiva_mejora'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='und_electrocardiograma') && ($tipo_ajax=='tbl15_plan_accion_correctiva_preventiva_mejora')) {
$und_electrocardiograma       = intval($_POST['valor']);
$cod_plan_accion_correctiva_preventiva_mejora           = intval($_POST['id']);

$datos_info_temporal = "SELECT precio_venta_producto FROM tbl15_plan_accion_correctiva_preventiva_mejora WHERE (cod_plan_accion_correctiva_preventiva_mejora = '$cod_plan_accion_correctiva_preventiva_mejora')";
$consulta_info_temporal = mysqli_query($conectar, $datos_info_temporal) or die(mysqli_error($conectar));
$info_temporal = mysqli_fetch_assoc($consulta_info_temporal);

$precio_venta_producto            = $info_temporal['precio_venta_producto'];
$total_venta_electrocardiograma   = $precio_venta_producto * $und_electrocardiograma;
$total_venta_producto             = $precio_venta_producto * $und_electrocardiograma;

$data_sql = ("UPDATE tbl15_plan_accion_correctiva_preventiva_mejora SET und_electrocardiograma = '$und_electrocardiograma', total_venta_electrocardiograma = '$total_venta_electrocardiograma',  
total_venta_producto = '$total_venta_producto' WHERE cod_plan_accion_correctiva_preventiva_mejora = '$cod_plan_accion_correctiva_preventiva_mejora'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='nombre_cliente') && ($tipo_ajax=='tbl15_plan_accion_correctiva_preventiva_mejora')) {
$nombre_cliente               = addslashes(strtoupper($_POST['valor']));
$cod_venta_producto           = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_plan_accion_correctiva_preventiva_mejora SET nombre_cliente = '$nombre_cliente' WHERE cod_plan_accion_correctiva_preventiva_mejora = '$cod_plan_accion_correctiva_preventiva_mejora'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='fecha_alerta') && ($tipo_ajax=='tbl15_plan_accion_correctiva_preventiva_mejora')) {
$fecha_alerta                = addslashes(($_POST['valor']));
$cod_plan_accion_correctiva_preventiva_mejora = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_plan_accion_correctiva_preventiva_mejora SET fecha_alerta = '$fecha_alerta' WHERE cod_plan_accion_correctiva_preventiva_mejora = '$cod_plan_accion_correctiva_preventiva_mejora'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
?>