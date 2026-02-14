<?php
include_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
//include_once('../admin/fecha_en_espanol.php');
include_once("../session/funciones_admin.php");
//include("../tbl15_notificacion_alerta/mostrar_noficacion_alerta.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
  } else { header("Location:../index.php");
}
$cuenta_actual           = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$nombres_des             = DAXCRYPTOR::descriptardax($_SESSION['nombres_cryp']);
$apellidos_des           = DAXCRYPTOR::descriptardax($_SESSION['apellidos_cryp']);
$nombre_sexo_des         = DAXCRYPTOR::descriptardax($_SESSION['nombre_sexo_cryp']);

$url_img_firma_sesion    = ($_SESSION['url_img_firma_sesion']);
$url_img_foto_sesion     = ($_SESSION['url_img_foto_sesion']);
$tipo_dispositivo        = ($_SESSION['tipo_dispositivo']);
$cod_cliente_sesion      = ($_SESSION['cod_cliente_sesion']);
$cod_administrador       = ($_SESSION['cod_administrador']);
$cod_base_caja           = ($_SESSION['cod_base_caja']);
$cod_seguridad           = ($_SESSION['cod_seguridad']);
$token                   = ($_SESSION['token']);

$sql_infos_empresas = "SELECT cod_estado_filtro_aplicacion_chef_bartender_global FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$resultado_infos_empresas = mysqli_query($conectar, $sql_infos_empresas);
$info_empresa_data = mysqli_fetch_assoc($resultado_infos_empresas);

$cod_estado_filtro_aplicacion_chef_bartender_global   = $info_empresa_data['cod_estado_filtro_aplicacion_chef_bartender_global'];

include_once('../admin/01_modulo_permisos.php');

if (isset($_GET["cod_info_factura_venta"])) {
    $cod_info_factura_venta               = intval($_GET['cod_info_factura_venta']);
    $cod_caja_virtual                     = intval($_GET['cod_caja_virtual']);
    $pagina                               = addslashes($_GET['pagina']);
    $cod_estado_cocina                    = '1';
    $cod_estado_componente_und_venta      = '1';

    if (($cod_origen_produccion_user == '1') && ($cod_estado_filtro_aplicacion_chef_bartender_global == '1')) { //1 ES COCINA
        $condic_estado_info = ", cod_estado_cocina = '1'"; 
        $condic_estado_venta_temp = ", cod_estado_revisado_cocina = '1'"; 
        $condic_estado_revisado_info = ", cod_estado_revisado = '1'"; 
        $condic_estado_revisado_venta_temp = ", cod_estado_revisado = '1'"; 
        $condic_estado_revisado_universal_venta_temp = ""; 
        $condic_estado_revisado_notificacion_vendedor_info = ", cod_estado_revisado_notificacion_vendedor = '1'"; 
        $condic_estado_revisado_notificacion_vendedor_venta_temp = ", cod_estado_revisado_notificacion_vendedor = '1'"; 
     } 
    elseif (($cod_origen_produccion_user == '2') && ($cod_estado_filtro_aplicacion_chef_bartender_global == '1')) { //2 ES BARTENDER
        $condic_estado_info = ", cod_estado_bartender = '1'"; 
        $condic_estado_venta_temp = ", cod_estado_revisado_bartender = '1'"; 
        $condic_estado_revisado_info = ", cod_estado_revisado = '1'"; 
        $condic_estado_revisado_venta_temp = ", cod_estado_revisado = '1'"; 
        $condic_estado_revisado_universal_venta_temp = ""; 
        $condic_estado_revisado_notificacion_vendedor_info = ", cod_estado_revisado_notificacion_vendedor = '1'"; 
        $condic_estado_revisado_notificacion_vendedor_venta_temp = ", cod_estado_revisado_notificacion_vendedor = '1'"; 
    } 
    elseif (($cod_origen_produccion_user == '3') && ($cod_estado_filtro_aplicacion_chef_bartender_global == '1')) { //3 ES JUGUERIA
        $condic_estado_info = ", cod_estado_jugueria = '1'"; 
        $condic_estado_venta_temp = ", cod_estado_revisado_jugueria = '1'"; 
        $condic_estado_revisado_info = ", cod_estado_revisado = '1'"; 
        $condic_estado_revisado_venta_temp = ", cod_estado_revisado = '1'"; 
        $condic_estado_revisado_universal_venta_temp = ""; 
        $condic_estado_revisado_notificacion_vendedor_info = ", cod_estado_revisado_notificacion_vendedor = '1'"; 
        $condic_estado_revisado_notificacion_vendedor_venta_temp = ", cod_estado_revisado_notificacion_vendedor = '1'"; 
    } 
    else { 
        $condic_estado_info = ""; 
        $condic_estado_venta_temp = ""; 
        $condic_estado_revisado_info = ", cod_estado_revisado = '1'"; 
        $condic_estado_revisado_venta_temp = ", cod_estado_revisado = '1'"; 
        $condic_estado_revisado_universal_venta_temp = ", cod_estado_revisado_universal = '1'"; 
        $condic_estado_revisado_notificacion_vendedor_info = ", cod_estado_revisado_notificacion_vendedor = '1'"; 
        $condic_estado_revisado_notificacion_vendedor_venta_temp = ", cod_estado_revisado_notificacion_vendedor = '1'"; 
    } 

    $data_sql = ("UPDATE tbl15_info_factura_venta SET flete_ptj = '0' $condic_estado_info $condic_estado_revisado_info $condic_estado_revisado_universal_venta_temp $condic_estado_revisado_notificacion_vendedor_info
    WHERE cod_info_factura_venta = '$cod_info_factura_venta'");
    $exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

    $data_sql = ("UPDATE tbl15_venta_producto_temporal SET nombre_categoria = '' $condic_estado_venta_temp $condic_estado_revisado_venta_temp $condic_estado_revisado_universal_venta_temp $condic_estado_revisado_notificacion_vendedor_venta_temp 
    WHERE (cod_info_factura_venta = '$cod_info_factura_venta')") ;
    $exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

    if ($cod_estado_deshabilitar_und_venta_atendido_cocina_chef == '1') {
        $data_sql = ("UPDATE tbl15_venta_producto_temporal SET cod_estado_componente_und_venta = '$cod_estado_componente_und_venta' WHERE (cod_info_factura_venta = '$cod_info_factura_venta')") ;
        $exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));
    }
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina ?>">
<?php } ?>