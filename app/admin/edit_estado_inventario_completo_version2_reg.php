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

if (isset($_GET['cod_producto_copia_inventario'])) {

	$cod_producto_copia_inventario              = intval($_GET['cod_producto_copia_inventario']);
	$cod_info_producto_copia_inventario         = intval($_GET['cod_info_producto_copia_inventario']);
	$pagina                                     = addslashes($_GET['pagina']);
	$foco_check                                 = "resultado_foco".$cod_producto_copia_inventario;

    $sql_info_factura = "SELECT cod_estado FROM tbl15_producto_copia_inventario WHERE (cod_producto_copia_inventario = '$cod_producto_copia_inventario')";
    $resultado_info_factura = mysqli_query($conectar, $sql_info_factura) or die(mysqli_error($conectar));
    $info_info_factura = mysqli_fetch_assoc($resultado_info_factura);

    $cod_estado                                 = $info_info_factura['cod_estado'];
    if ($cod_estado == '1') { $cod_estado = 0; } else { $cod_estado = 1; }

	$agregar_reg_pyg = "UPDATE tbl15_producto_copia_inventario SET cod_estado = '$cod_estado' WHERE cod_producto_copia_inventario = '$cod_producto_copia_inventario'";
	$resultado_pyg = mysqli_query($conectar, $agregar_reg_pyg) or die(mysqli_error($conectar));
	//-----------------------------------------------------------------------------------------------------------------//
	//-----------------------------------------------------------------------------------------------------------------//
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/producto_copia_inventario_completo_version2.php?cod_info_producto_copia_inventario=<?php echo $cod_info_producto_copia_inventario?>&cod_producto_copia_inventario_get=<?php echo $cod_producto_copia_inventario?>&foco_check=<?php echo $foco_check?>">
<?php } ?>