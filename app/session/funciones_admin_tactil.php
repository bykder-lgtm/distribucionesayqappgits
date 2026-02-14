<?php 
//include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../admin/detectar_tipo_dispositivo.php');
session_set_cookie_params(60*60*24*2); //la sesion dura 2 dias
session_start();

if (isset($_GET['cod_mesa'])) {

	$sql_animal = "SELECT MAX(cod_caja_virtual) AS cod_caja_virtual, MAX(cod_base_caja) AS cod_base_caja FROM tbl15_info_factura_venta_carrito_compra WHERE (nombre_estado_factura = 'ABIERTA')";
	$resultado_animal = mysqli_query($conectar, $sql_animal);
	$info_animal = mysqli_fetch_assoc($resultado_animal);

	$cod_caja_virtual                      = $info_animal['cod_caja_virtual'] + 1;
	//$cod_caja_virtual                      = intval($_GET['cod_mesa']);
	$cod_base_caja                         = intval($_GET['cod_mesa']);
	$cuenta                                = rand(1000, 9999).time().rand(1000, 9999);
	//---------------------------------------------------------------------------------------------------------------------------------//
	//---------------------------------------------------------------------------------------------------------------------------------//

	$_SESSION['cod_administrador']                = 0;
	$_SESSION['usuario']                          = $cuenta;
	$_SESSION['cuenta_actual']                    = $cuenta;
	$_SESSION['usuario_cryp']                     = $cuenta;
	$_SESSION['cs_cryp']                          = 0;
	$_SESSION['ca_cryp']                          = 0;
	$_SESSION['tokn_cryp']                        = 0;
	$_SESSION['pag_redirec_sesion_cryp']          = 0;
	$_SESSION['cod_tipo_historia_clinica_cryp']   = 0;
	$_SESSION['nombres_cryp']                     = "visitante";
	$_SESSION['apellidos_cryp']                   = "ext";
	$_SESSION['nombre_sexo_cryp']                 = 0;
	$_SESSION['url_img_firma_sesion']             = '';
	$_SESSION['url_img_foto_sesion']              = '';
	$_SESSION['tipo_dispositivo']                 = $tipo_dispositivo_encontrado;
	$_SESSION['cod_cliente_sesion']               = '';
	$_SESSION['cod_base_caja']                    = $cod_base_caja;
	$_SESSION['cod_seguridad']                    = 0;
	$_SESSION['cod_caja_virtual']                 = $cod_caja_virtual;
	$_SESSION['cod_sesion']                       = 0;
	$_SESSION['token']                            = sha1(uniqid(mt_rand(), true));
	$_SESSION['estilo_css']                       = '';
	$_SESSION['tipo_usuario']                     = 'visitante';
	$_SESSION['tipo_menu']                        = 'usuario';
	$_SESSION['vendedor_codifcryp']               = '';
	$_SESSION['inicio_sesion']                    = 'SI';
	$_SESSION['pagina_salir_visitante']           = '../admin/iniciar_sesion_visitante.php';

	header("Location:../admin/facturacion_venta_temporal_producto_manual_pos_tactil.php"); 
}
?>