<?php include_once("../admin/01_modulo_inicio_sesion.php"); ?>
<?php error_reporting(E_ALL ^ E_NOTICE);
//include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
//include_once('../evitar_mensaje_error/error.php'); 
 
//include_once("../session/funciones_admin.php");
//if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
	//} else { header("Location:../index.php");
//}
//$cuenta_actual                 = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$cod_cliente_codifcryp              = $_POST['cod_cliente_codifcryp'];
$cod_cliente_codif                  = DAXCODIFCRYPTOR::descriptardax($cod_cliente_codifcryp);
$cod_cliente                        = intval(DAXCODIFCRYPTOR::descodiftextodax($cod_cliente_codif));

$tab_codifcryp                      = $_POST['tab_codifcryp'];
$tab_codif                          = DAXCODIFCRYPTOR::descriptardax($tab_codifcryp);
$tab                                = addslashes(DAXCODIFCRYPTOR::descodiftextodax($tab_codif));

$accion_codifcryp                   = $_POST['accion_codifcryp'];
$accion_codif                       = DAXCODIFCRYPTOR::descriptardax($accion_codifcryp);
$accion                             = addslashes(DAXCODIFCRYPTOR::descodiftextodax($accion_codif));

$tipo_codifcryp                     = $_POST['tipo_codifcryp'];
$tipo_codif                         = DAXCODIFCRYPTOR::descriptardax($tipo_codifcryp);
$tipo                               = addslashes(DAXCODIFCRYPTOR::descodiftextodax($tipo_codif));

$origen_codifcryp                   = $_POST['origen_codifcryp'];
$origen_codif                       = DAXCODIFCRYPTOR::descriptardax($origen_codifcryp);
$origen                             = addslashes(DAXCODIFCRYPTOR::descodiftextodax($origen_codif));

$campo_codifcryp                    = $_POST['campo_codifcryp'];
$campo_codif                        = DAXCODIFCRYPTOR::descriptardax($campo_codifcryp);
$campo                              = addslashes(DAXCODIFCRYPTOR::descodiftextodax($campo_codif));

$vendedor_codifcryp                 = $_POST['vendedor_codifcryp'];
$vendedor_codif                     = DAXCODIFCRYPTOR::descriptardax($vendedor_codifcryp);
$vendedor                           = addslashes(DAXCODIFCRYPTOR::descodiftextodax($vendedor_codif));

$cod_info_factura_venta_codifcryp   = $_POST['cod_info_factura_venta_codifcryp'];
$cod_info_factura_venta_codif       = DAXCODIFCRYPTOR::descriptardax($cod_info_factura_venta_codifcryp);
$cod_info_factura_venta             = intval(DAXCODIFCRYPTOR::descodifdax($cod_info_factura_venta_codif));

$cod_factura_codifcryp              = $_POST['cod_factura_codifcryp'];
$cod_factura_codif                  = DAXCODIFCRYPTOR::descriptardax($cod_factura_codifcryp);
$cod_factura                        = intval(DAXCODIFCRYPTOR::descodifdax($cod_factura_codif));

$latitud                            = addslashes($_POST['latitud']);
$longitud                           = addslashes($_POST['longitud']);
$latitud_longitud                   = addslashes($_POST['latitud_longitud']);
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
if ($accion == 'actualizar' && $origen == 'checkout') {

$actualizar_carrito_compra = "UPDATE tbl01_info_factura_venta SET latitud = '$latitud', longitud = '$longitud', 
latitud_longitud = '$latitud_longitud' WHERE cod_info_factura_venta = '$cod_info_factura_venta'";
$resultado_carrito_compra = mysqli_query($conectar, $actualizar_carrito_compra) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "SI"; } else { echo "NO"; }                
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
?>