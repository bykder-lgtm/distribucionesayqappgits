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
include_once('../admin/funcion_eliminar_acentos.php');

$cuenta_actual                                      = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$nombres_des                                        = DAXCRYPTOR::descriptardax($_SESSION['nombres_cryp']);
$apellidos_des                                      = DAXCRYPTOR::descriptardax($_SESSION['apellidos_cryp']);
$nombre_sexo_des                                    = DAXCRYPTOR::descriptardax($_SESSION['nombre_sexo_cryp']);
$url_img_firma_sesion                               = ($_SESSION['url_img_firma_sesion']);
$url_img_foto_sesion                                = ($_SESSION['url_img_foto_sesion']);
$tipo_dispositivo                                   = ($_SESSION['tipo_dispositivo']);
$cod_cliente_sesion                                 = ($_SESSION['cod_cliente_sesion']);
//$cod_administrador                                  = ($_SESSION['cod_administrador']);
$cod_base_caja                                      = ($_SESSION['cod_base_caja']);
$tipo_soporte                                       = "ARCHIVADOR";

/* ----------------------------------------------------------------------------------------------------------/ */
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "formulario_de_actualizacion")) {

	$cod_archivador                                     = intval($_POST['cod_archivador']);
	$descripcion_archivador                             = addslashes($_POST['descripcion_archivador']);
	$cuenta                                             = addslashes($_POST['cuenta']);
	$cod_caja_virtual                                   = addslashes($_POST['cod_caja_virtual']);
	$cod_tipo_nota_observacion                          = intval($_POST['cod_tipo_nota_observacion']);
	$pagina                                             = addslashes($_POST['pagina']);
	$nombre_nota_observacion                            = 'SOPORTES ARCHIVADOR';

	if (isset($_POST['cod_entidad_origen_archivo']) <> '') { $cod_entidad_origen_archivo = addslashes($_POST['cod_entidad_origen_archivo']); } else { $cod_entidad_origen_archivo = ''; }
	if (isset($_POST['nombre_paciente']) <> '') { $nombre_paciente = addslashes($_POST['nombre_paciente']); } else { $nombre_paciente = ''; }
	if (isset($_POST['nombre_medico_tratante']) <> '') { $nombre_medico_tratante = addslashes($_POST['nombre_medico_tratante']); } else { $nombre_medico_tratante = ''; }
	if (isset($_POST['cod_historia_clinica']) <> '') { $cod_historia_clinica = addslashes($_POST['cod_historia_clinica']); } else { $cod_historia_clinica = '0'; }
	if (isset($_POST['cod_factura']) <> '') { $cod_factura = addslashes($_POST['cod_factura']); } else { $cod_factura = ''; }
	if (isset($_POST['cod_tipo_ambito']) <> '') { $cod_tipo_ambito = addslashes($_POST['cod_tipo_ambito']); } else { $cod_tipo_ambito = '0'; }
	if (isset($_POST['cod_tipo_estante']) <> '') { $cod_tipo_estante = addslashes($_POST['cod_tipo_estante']); } else { $cod_tipo_estante = '0'; }
	if (isset($_POST['cod_tipo_cubiculo']) <> '') { $cod_tipo_cubiculo = addslashes($_POST['cod_tipo_cubiculo']); } else { $cod_tipo_cubiculo = '0'; }
	if (isset($_POST['cod_tipo_carpeta']) <> '') { $cod_tipo_carpeta = addslashes($_POST['cod_tipo_carpeta']); } else { $cod_tipo_carpeta = '0'; }
	if (isset($_POST['cod_tipo_archivo']) <> '') { $cod_tipo_archivo = addslashes($_POST['cod_tipo_archivo']); } else { $cod_tipo_archivo = '0'; }
	if (isset($_POST['cod_tabla_retencion_documental']) <> '') { $cod_tabla_retencion_documental = addslashes($_POST['cod_tabla_retencion_documental']); } else { $cod_tabla_retencion_documental = '0'; }
	if (isset($_POST['cantidad_folios']) <> '') { $cantidad_folios = addslashes($_POST['cantidad_folios']); } else { $cantidad_folios = ''; }
	if (isset($_POST['cod_tipo_nota_observacion']) <> '') { $cod_tipo_nota_observacion = intval($_POST['cod_tipo_nota_observacion']); } else { $cod_tipo_nota_observacion = '1'; }
	$observacion_archivador                                         = $descripcion_archivador;
	$nombre_archivo_adjunto                                         = $descripcion_archivador;
	$descripcion_archivo_adjunto                                    = $descripcion_archivador;
/* ----------------------------------------------------------------------------------------------------------/ */
	$pagina_redirect                                    = $pagina.'?cod_archivador='.$cod_archivador.'&cuenta='.$cuenta.'&cod_caja_virtual='.$cod_caja_virtual.'&pagina='.$pagina;
	if (isset($_FILES['url_img1']) <> '') { $url_img1 = $_FILES['url_img1']['name']; } else { $url_img1 = ''; }
/* ----------------------------------------------------------------------------------------------------------/ */
	$sql_autoincremento_archivo_adjunto = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_archivo_adjunto'";
	$exec_autoincremento_archivo_adjunto = mysqli_query($conectar, $sql_autoincremento_archivo_adjunto) or die(mysqli_error($conectar));
	$datos_autoincremento_archivo_adjunto = mysqli_fetch_assoc($exec_autoincremento_archivo_adjunto);
	$cod_archivo_adjunto                                = $datos_autoincremento_archivo_adjunto['AUTO_INCREMENT'];
/* ----------------------------------------------------------------------------------------------------------/ */
	$sql_autoincremento_nota_observacion = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_nota_observacion'";
	$exec_autoincremento_nota_observacion = mysqli_query($conectar, $sql_autoincremento_nota_observacion) or die(mysqli_error($conectar));
	$datos_autoincremento_nota_observacion = mysqli_fetch_assoc($exec_autoincremento_nota_observacion);
	$cod_nota_observacion                                = $datos_autoincremento_nota_observacion['AUTO_INCREMENT'];
/* ----------------------------------------------------------------------------------------------------------/ */
	$sql_archivo_adjunto = "SELECT MAX(cod_guia) AS cod_guia FROM tbl15_archivo_adjunto WHERE (cod_archivador = '$cod_archivador')";
	$consulta_archivo_adjunto = mysqli_query($conectar, $sql_archivo_adjunto);
	$datos_archivo_adjunto = mysqli_fetch_assoc($consulta_archivo_adjunto);

	$cod_guia                                         = $datos_archivo_adjunto['cod_guia'] + 1;
/* ----------------------------------------------------------------------------------------------------------/ */
	$datos_data_info_factura = "SELECT * FROM tbl15_archivador WHERE (cod_archivador = '$cod_archivador')";
	$consulta_data_info_factura = mysqli_query($conectar, $datos_data_info_factura);
	$data_info_factura = mysqli_fetch_assoc($consulta_data_info_factura);
	$factura_ocupada = mysqli_num_rows($consulta_data_info_factura);

	$cod_administrador                                  = $data_info_factura['cod_administrador'];
	$cod_tercero                                        = $data_info_factura['cod_tercero'];

	$limpiar_descripcion_archivador                     = str_replace(' ','_', funcion_eliminar_acentos(trim(substr($descripcion_archivador, 0, 30))));
/* ----------------------------------------------------------------------------------------------------------/ */
	$time                                               = time();
	$fecha_ymdHis                                       = date("YmdHis");
	$formato                                            = 'jpg';
	$fecha_hora                                         = date("H:i:s");
	$fecha_ymd                                          = date("Y-m-d");
	$fecha_creacion                                     = date("Y-m-d");

	$ruta_firma_miniatura                               = '../archivador/firma/miniatura/';
	$ruta_foto_miniatura                                = '../archivador/foto/miniatura/';
	$ruta_firma_orig                                    = '../archivador/firma/original/';
	$ruta_foto_orig                                     = '../archivador/documentos/';
/* ----------------------------------------------------------------------------------------------------------/ */
	if ($url_img1 <> '') { 
		$formato_img2                                       = explode(".", $url_img1);
		$formato_img2                                       = end($formato_img2);
		$nombre_normal2                                     = $limpiar_descripcion_archivador.'__'.$cod_archivador.'__'.$cod_nota_observacion.'__'.$fecha_ymdHis.'.'.$formato_img2;
		$url_img_orig_producto                              = $ruta_foto_orig.$nombre_normal2;
		$url_img_min_producto                               = $ruta_foto_orig.$nombre_normal2;
		$peso_archivo                                       = $_FILES["url_img1"]["size"];
	} else { 
		$formato_img2                                       = "";
		$formato_img2                                       = "";
		$nombre_normal2                                     = "";
		$url_img_orig_producto                              = "";
		$url_img_min_producto                               = "";
		$peso_archivo                                       = 0;
	}
/* ----------------------------------------------------------------------------------------------------------/ */
	$nombre_tipo_extencion_archivo                      = $formato_img2;
	$nombre_archivo_adjunto                             = $_FILES['url_img1']['name'];
	$nombre_original_archivo                            = $_FILES['url_img1']['name'];
	$descripcion_archivo_adjunto                        = $observacion_archivador;
	$nombre_nota_observacion                            = $descripcion_archivador;
 	$nombre_origen_archivo                              = $cod_entidad_origen_archivo;
 	$numero_historia_clinica                            = $cod_historia_clinica;
//-------------------------------------- -----------------------------------------------------------------//
//-------------------------------------- -----------------------------------------------------------------//
		$sql_archivo_adjunto = "INSERT INTO tbl15_archivo_adjunto (cod_archivador, cod_historia_clinica, nombre_archivo_adjunto, descripcion_archivo_adjunto, nombre_paciente, nombre_medico_tratante, 
		observacion_archivador, cod_factura, cod_tipo_ambito, cod_tipo_estante, cod_tipo_cubiculo, cod_tipo_carpeta, cod_tabla_retencion_documental, cod_entidad_origen_archivo, cod_tipo_archivo, 
		cod_tipo_nota_observacion, nombre_original_archivo, cantidad_folios, nombre_tipo_extencion_archivo, nombre_nota_observacion, numero_historia_clinica, fecha_creacion, fecha_ymd, fecha_hora, peso_archivo, 
		cuenta, cod_administrador, cod_guia, url_img_orig_producto, url_img_min_producto) 
		VALUES ('$cod_archivador', '$cod_historia_clinica', '$nombre_archivo_adjunto', '$descripcion_archivo_adjunto', UPPER('$nombre_paciente'), UPPER('$nombre_medico_tratante'), 
		'$observacion_archivador', '$cod_factura', '$cod_tipo_ambito', '$cod_tipo_estante', '$cod_tipo_cubiculo', '$cod_tipo_carpeta', '$cod_tabla_retencion_documental', '$cod_entidad_origen_archivo', '$cod_tipo_archivo', 
		'$cod_tipo_nota_observacion', '$nombre_original_archivo', '$cantidad_folios', '$nombre_tipo_extencion_archivo', UPPER('$nombre_nota_observacion'), '$numero_historia_clinica', '$fecha_creacion', '$fecha_ymd', '$fecha_hora', '$peso_archivo',
		'$cuenta_actual', '$cod_administrador', '$cod_guia', '$url_img_orig_producto', '$url_img_min_producto')";
		$resultado_archivo_adjunto = mysqli_query($conectar, $sql_archivo_adjunto) or die(mysqli_error($conectar));

		$agreg = "INSERT INTO tbl15_nota_observacion (nombre_nota_observacion, fecha_ymd, fecha_hora, cuenta, cod_administrador, fecha_creacion, cod_tipo_nota_observacion, cod_archivador, url_img_orig_producto, url_img_min_producto, 
		cod_tipo_ambito, cod_tipo_estante, cod_tipo_cubiculo, cod_tipo_carpeta, cod_entidad_origen_archivo, cod_tipo_archivo, cod_tabla_retencion_documental, cantidad_folios) 
		VALUES (UPPER('$nombre_nota_observacion'), '$fecha_ymd', '$fecha_hora', '$cuenta_actual', '$cod_administrador', '$fecha_creacion', '$cod_tipo_nota_observacion', '$cod_archivador', '$url_img_orig_producto', '$url_img_min_producto', 
		'$cod_tipo_ambito', '$cod_tipo_estante', '$cod_tipo_cubiculo', '$cod_tipo_carpeta', '$cod_entidad_origen_archivo', '$cod_tipo_archivo', '$cod_tabla_retencion_documental', '$cantidad_folios')";
		$resultado_sql1 = mysqli_query($conectar, $agreg) or die(mysqli_error($conectar));
//-------------------------------------- -----------------------------------------------------------------//
//-------------------------------------- -----------------------------------------------------------------//
	if ($url_img1 <> '') { copy($_FILES['url_img1']['tmp_name'], $url_img_orig_producto); }
?>
	<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina_redirect ?>">
<?php } ?>