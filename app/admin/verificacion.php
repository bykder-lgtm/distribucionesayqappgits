<?php
include_once('../conexiones/conexione.php'); 
include_once('../evitar_mensaje_error/error.php');
include ("../session/funciones_admin.php");
date_default_timezone_set("America/Bogota");

$usuario             = stripslashes($_POST['cuenta']);
$usuario             = strip_tags($usuario);
$clave               = addslashes($_POST['contrasena']);
$nombre_maquina      = gethostname();

if (conexiones($usuario, $clave)) {

	if ($_SERVER) {
		if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) { $ip = $_SERVER["HTTP_X_FORWARDED_FOR"]; } 
		elseif (isset($_SERVER["HTTP_CLIENT_IP"])) { $ip = $_SERVER["HTTP_CLIENT_IP"]; } 
		else { $ip = $_SERVER["REMOTE_ADDR"]; }
	} else {  
		if (getenv('HTTP_X_FORWARDED_FOR') ) { $ip = getenv('HTTP_X_FORWARDED_FOR'); } 
		elseif (getenv('HTTP_CLIENT_IP') ) { $ip = getenv('HTTP_CLIENT_IP'); } 
		else { $ip = getenv('REMOTE_ADDR'); }  
	} 

	if ($ip == '127.0.0.1') {
		$ciudad                      = "0";
		$region                      = "0";
		$cod_area                    = "0";
		$cod_dma                     = "0";
		$nombre_pais                 = "0";
		$cod_pais                    = "0";
		$longitud                    = "0";
		$latitud                     = "0";
	} else {
		include_once('../admin/class_php/geoplugin.class.php');

		$geoplugin = new geoPlugin();
		$geoplugin->locate();
		//$ip                        = {$geoplugin->ip};
		$ciudad                      = "{$geoplugin->city}";
		$region                      = "{$geoplugin->region}";
		$cod_area                    = "{$geoplugin->areaCode}";
		$cod_dma                     = "{$geoplugin->dmaCode}";
		$nombre_pais                 = "{$geoplugin->countryName}";
		$cod_pais                    = "{$geoplugin->countryCode}";
		$longitud                    = "{$geoplugin->longitude}";
		$latitud                     = "{$geoplugin->latitude}";
	}

	$navegador                   = $_SERVER['HTTP_USER_AGENT'];
	$fecha_entrada_time          = time();
	$fecha_entrada               = date("Y-m-d H:i:s");

	$pag_redirec_sesion_ini      = DAXCRYPTOR::descriptardax($_SESSION['pag_redirec_sesion_cryp']);

	$agregar_registros_sesion = "INSERT INTO tbl15_sesion (usuario, ip, navegador, fecha_entrada_time, ciudad, region, cod_area, cod_dma, 
	nombre_pais, cod_pais, longitud, latitud, fecha_entrada, nombre_maquina)
	VALUES ('$usuario', '$ip', '$navegador', '$fecha_entrada_time', '$ciudad', '$region', '$cod_area', '$cod_dma', '$nombre_pais', 
	'$cod_pais', '$longitud', '$latitud', '$fecha_entrada', '$nombre_maquina')";
	$resultado_sql1 = mysqli_query($conectar, $agregar_registros_sesion) or die(mysqli_error($conectar));

	if ($res_conexion === 'MULTIROL') {
		// En lugar de redirigir, mostramos la interfaz del selector de roles
		?>
		<!DOCTYPE html>
		<html lang="es">
		<head>
			<meta charset="UTF-8">
			<title>Seleccionar Rol</title>
			<script src="../admin/js/jquery.js"></script>
			<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
			<style>
				body { background-color: #2c3e50; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; display:flex; justify-content:center; align-items:center; height:100vh; margin:0; }
				.swal2-styled.swal2-confirm { background-color: #1abc9c !important; }
				.swal2-styled.swal2-cancel { background-color: #34495e !important; }
				.swal2-container { z-index: 100000 !important; }
				.role-btn { width: 100%; margin: 8px 0; padding: 15px; border-radius: 8px; border: none; font-size: 16px; font-weight: bold; cursor: pointer; transition: 0.3s; background-color: #ecf0f1; color: #2c3e50; box-shadow: 0 4px 6px rgba(0,0,0,0.1); text-transform: uppercase; }
				.role-btn:hover { background-color: #bdc3c7; transform: translateY(-2px); }
				.role-btn.lider { border-left: 5px solid #e74c3c; }
				.role-btn.coordinador { border-left: 5px solid #f39c12; }
				.role-btn.asesor { border-left: 5px solid #3498db; }
			</style>
		</head>
		<body>
			<script>
				$(document).ready(function() {
					// Disparar AJAX para traer los roles disponibles para el ID padre del usuario actual
					Swal.fire({	title: 'Identificando perfiles...',	allowOutsideClick: false, didOpen: () => { Swal.showLoading(); } });

					$.ajax({
						url: 'obtener_perfiles_multirol_ajax.php', type: 'POST', dataType: 'json',
						success: function(res) {
							if (res.status === 'success') {
								let htmlBotones = '<div style="margin-top:20px; text-align:left;">';
								// Renderizar tarjeta del perfil actual
								let claseBase = res.perfil_actual.nombre_tipo_tercero.toLowerCase();
								htmlBotones += `<button class="role-btn ${claseBase}" onclick="seleccionarRol('${res.perfil_actual.cod_administrador}')">` + `<i class="fa fa-user" style="margin-right:10px;"></i> ${res.perfil_actual.cargo} (Actual)` + `</button>`;
								
								// Renderizar los demás roles
								if (res.otros_perfiles && res.otros_perfiles.length > 0) {
									res.otros_perfiles.forEach(function(perfil) {
										let clase = perfil.nombre_tipo_tercero.toLowerCase();
										htmlBotones += `<button class="role-btn ${clase}" onclick="seleccionarRol('${perfil.cod_administrador}')">` + `<i class="fa fa-users" style="margin-right:10px;"></i> ${perfil.cargo}` +	`</button>`;
									});
								}
								htmlBotones += '</div>';

								Swal.fire({	title: 'Bienvenido de nuevo', html: '<p style="font-size:16px;">Tienes varios roles habilitados. <br> ¿Con cuál perfil deseas iniciar sesión?</p>' + htmlBotones, showConfirmButton: false, allowOutsideClick: false, background: '#ffffff',	customClass: { title: 'swal2-title' } });
							} else {
								Swal.fire('Error', res.message || 'No se pudieron recuperar los perfiles.', 'error').then(() => {
									window.location.href = '../admin/index.php';
								});
							}
						},
						error: function() {
							Swal.fire('Error', 'Fallo de conexión al cargar perfiles.', 'error').then(() => {
								window.location.href = '../admin/index.php';
							});
						}
					});
				});

				function seleccionarRol(cod_administrador_seleccionado) {
					Swal.fire({ title: 'Cargando módulo...', allowOutsideClick: false, didOpen: () => { Swal.showLoading(); } });
					$.ajax({
						url: 'procesar_seleccion_multirol_ajax.php', type: 'POST', data: { cod_administrador: cod_administrador_seleccionado },	dataType: 'json',
						success: function(res) {
							if (res.status === 'success') {	window.location.href = res.redirect_url; } else { Swal.fire('Error', res.message, 'error'); }
						},
						error: function() {
							Swal.fire('Error', 'Fallo de conexión al cambiar de rol.', 'error');
						}
					});
				}
			</script>
		</body>
		</html>
		<?php
		exit;
	} else {
		header("Location:../admin/$pag_redirec_sesion_ini");
	}
} else {
$error = 'El nombre de usuario o la contraseña no son correctos';
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0.1; ../admin/index.php?error=<?php echo $error ?>">
<?php
}
?>
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* FIN MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->