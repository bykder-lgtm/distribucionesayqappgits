<?php
	session_start();
include_once('../conexiones/conexione.php'); //Contiene funcion que conecta a la base de datos
include("../admin/class_php/class.upload.php");

if (isset($_POST['cod_producto_barra']) <> '') { $cod_producto_barra = mysqli_real_escape_string($conectar,(($_POST['cod_producto_barra']))); } else { $cod_producto_barra = ''; }

$obtener_cedula = "SELECT cod_producto_barra, nombre_producto FROM tbl15_producto WHERE cod_producto_barra = '".($cod_producto_barra)."'";
$consultar_cedula = mysqli_query($conectar, $obtener_cedula) or die(mysqli_error($conectar));
$info_cliente = mysqli_fetch_assoc($consultar_cedula);

$nombre_producto_db = $info_cliente['nombre_producto'];
	/*Inicia validacion del lado del servidor*/
if (empty($_POST['cod_producto_barra'])) { $errores[] = "Referencia vacía"; } 
else if (empty($_POST['nombre_producto'])) { $errores[] = "Nombre vacío"; }
else if (mysqli_num_rows(@$consultar_cedula) > 0) { $errores[] = "La referencia ".$cod_producto_barra." ya esta registrada: ".$nombre_producto_db; }
else if (!empty($_POST['cod_producto_barra']) && !empty($_POST['nombre_producto'])) {

	$sql_autoincremento_sesion = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_producto'";
	$exec_autoincremento_sesion = mysqli_query($conectar, $sql_autoincremento_sesion) or die(mysqli_error($conectar));
	$datos_autoincremento_sesion = mysqli_fetch_assoc($exec_autoincremento_sesion);
	$cod_producto = $datos_autoincremento_sesion['AUTO_INCREMENT'];

	if (isset($_POST['cod_producto_barra']) <> '') { $cod_producto_barra = mysqli_real_escape_string($conectar,(($_POST['cod_producto_barra']))); } else { $cod_producto_barra = ''; }
	if (isset($_POST['cod_producto_barra2']) <> '') { $cod_producto_barra2 = mysqli_real_escape_string($conectar,(($_POST['cod_producto_barra2']))); } else { $cod_producto_barra2 = ''; }
	if (isset($_POST['nombre_producto']) <> '') { $nombre_producto = mysqli_real_escape_string($conectar,(strip_tags(strtoupper($_POST['nombre_producto']), ENT_QUOTES))); } else { $nombre_producto = ''; }
	if (isset($_POST['nombre_categoria']) <> '') { $nombre_categoria = mysqli_real_escape_string($conectar,(strtoupper($_POST['nombre_categoria']))); } else { $nombre_categoria = ''; }
	if (isset($_POST['nombre_marca']) <> '') { $nombre_marca = mysqli_real_escape_string($conectar,(strtoupper($_POST['nombre_marca']))); } else { $nombre_marca = ''; }
	if (isset($_POST['nombre_tipo_aplicacion']) <> '') { $nombre_tipo_aplicacion = mysqli_real_escape_string($conectar,(strtoupper($_POST['nombre_tipo_aplicacion']))); } else { $nombre_tipo_aplicacion = ''; }
	if (isset($_POST['descripcion_tipo_aplicacion']) <> '') { $descripcion_tipo_aplicacion = mysqli_real_escape_string($conectar,(strtoupper($_POST['descripcion_tipo_aplicacion']))); } else { $descripcion_tipo_aplicacion = ''; }
	if (isset($_POST['nombre_tipo_referencia']) <> '') { $nombre_tipo_referencia = mysqli_real_escape_string($conectar,(strtoupper($_POST['nombre_tipo_referencia']))); } else { $nombre_tipo_referencia = ''; }
	if (isset($_POST['nombre_promocion']) <> '') { $nombre_promocion = mysqli_real_escape_string($conectar,(($_POST['nombre_promocion']))); } else { $nombre_promocion = ''; }
	if (isset($_POST['und_inv']) <> '') { $und_inv = intval($_POST['und_inv']); } else { $und_inv = ''; }
	if (isset($_POST['precio_compra_producto']) <> '') { $precio_compra_producto = intval($_POST['precio_compra_producto']); } else { $precio_compra_producto = ''; }
	if (isset($_POST['precio_venta_producto']) <> '') { $precio_venta_producto = intval($_POST['precio_venta_producto']); } else { $precio_venta_producto = ''; }
	if (isset($_POST['precio_venta_producto2']) <> '') { $precio_venta_producto2 = intval($_POST['precio_venta_producto2']); } else { $precio_venta_producto2 = ''; }
	if (isset($_POST['iva_ptj']) <> '') { $iva_ptj = intval($_POST['iva_ptj']); } else { $iva_ptj = ''; }
	if (isset($_POST['url_pagina_descripcion']) <> '') { $url_pagina_descripcion = mysqli_real_escape_string($conectar,(($_POST['url_pagina_descripcion']))); } else { $url_pagina_descripcion = ''; }
	if (isset($_POST['descripcion_producto']) <> '') { $descripcion_producto = mysqli_real_escape_string($conectar,(($_POST['descripcion_producto']))); } else { $descripcion_producto = ''; }
	//if (isset($_GET['descripcion_producto2']) <> '') { $descripcion_producto = addslashes($_GET['descripcion_producto2']); } else { $descripcion_producto = ''; }
	if (isset($_POST['nombre_estado']) <> '') { $nombre_estado = mysqli_real_escape_string($conectar,(strtoupper($_POST['nombre_estado']))); } else { $nombre_estado = ''; }

	$time                            = time();
	$fecha_ymdHis                    = date("YmdHis");
	$formato                         = 'jpg';
	/* ----------------------------------------------------------------------------------------------------------/ */
	$ruta_foto_miniatura             = '../archivador/img_producto/min/';
	$ruta_foto_orig                  = '../archivador/img_producto/orig/';
	/* ----------------------------------------------------------------------------------------------------------/ */
	$url_img1                        = $_FILES['url_img1']['name'];
	/* ----------------------------------------------------------------------------------------------------------/ */
	if ($url_img1 <> '') { 
		$formato_img2                    = explode(".", $url_img1);
		$formato_img2                    = end($formato_img2);
		$formato_orig2                   = strtolower($formato_img2);
		$nombre_foto_cryp                = crc32($url_img1);
		$nombre_normal2                  = $fecha_ymdHis.'_'.$cod_producto.'_'.$cod_producto_barra.'_ori'.'.'.$formato_orig2;
		$url_img_producto_orig           = $ruta_foto_orig.$nombre_normal2;
		copy($_FILES['url_img1']['tmp_name'], $url_img_producto_orig);

		$imagen_foto_miniatura                              = new upload($_FILES['url_img1']);
		if ($imagen_foto_miniatura->uploaded) {
			$imagen_foto_miniatura->image_resize         		= true; // default is true
			$imagen_foto_miniatura->image_convert               = $formato;
			$imagen_foto_miniatura->image_x              		= 200; // para el ancho a cortar
			$imagen_foto_miniatura->image_ratio_y        		= true; // para que se ajuste dependiendo del ancho definido
			$imagen_foto_miniatura->file_new_name_body   		= $fecha_ymdHis.'_'.$cod_producto.'_'.$cod_producto_barra.'_min'; // agregamos un nuevo nombre
			$imagen_foto_miniatura->process($ruta_foto_miniatura);

			$nombre_miniatura = $fecha_ymdHis.'_'.$cod_producto.'_'.$cod_producto_barra.'_min'.'.'.$formato;
			$url_img_producto_min = $ruta_foto_miniatura.$nombre_miniatura;
		} else { 
			echo 'error : ' . $imagen_foto_miniatura->error;
		}
	} else {
		$url_img_producto_orig = "";
		$url_img_producto_min = "";
	}
	/* ----------------------------------------------------------------------------------------------------------/ */
	$obtener_existencia = "SELECT nombre_promocion_ing FROM tbl15_promocion WHERE nombre_promocion = '".($nombre_promocion)."'";
	$consultar_existencia = mysqli_query($conectar, $obtener_existencia) or die(mysqli_error($conectar));
	$info_existencia = mysqli_fetch_assoc($consultar_existencia);

	$nombre_promocion_ing      = $info_existencia['nombre_promocion_ing'];
	$active                    = "";

	$sql = "INSERT INTO tbl15_producto (cod_producto_barra, cod_producto_barra2, nombre_producto, nombre_categoria, 
	nombre_marca, nombre_tipo_aplicacion, descripcion_tipo_aplicacion, nombre_tipo_referencia, 
	nombre_promocion, nombre_promocion_ing, und_inv, precio_compra_producto, precio_venta_producto, 
	precio_venta_producto2, iva_ptj, url_pagina_descripcion, descripcion_producto, nombre_estado, 
	url_img_producto_min, url_img_producto_orig) 
	VALUE (\"$cod_producto_barra\",\"$cod_producto_barra2\",\"$nombre_producto\",\"$nombre_categoria\",
	\"$nombre_marca\",\"$nombre_tipo_aplicacion\",\"$descripcion_tipo_aplicacion\",\"$nombre_tipo_referencia\",
	\"$nombre_promocion\",\"$nombre_promocion_ing\",\"$und_inv\",\"$precio_compra_producto\",\"$precio_venta_producto\",
	\"$precio_venta_producto2\",\"$iva_ptj\",\"$url_pagina_descripcion\",\"$descripcion_producto\",\"$nombre_estado\",
	\"$url_img_producto_min\",\"$url_img_producto_orig\")";
	$insertar_datos = mysqli_query($conectar,$sql);
	 	 	 	
	$sql = "INSERT INTO tbl15_producto_url_img (cod_producto, url_img_producto_min, url_img_producto_orig, active) VALUE (\"$cod_producto\",\"$url_img_producto_min\",\"$url_img_producto_orig\",\"$active\")";
	$insertar_datos = mysqli_query($conectar,$sql);

	if ($insertar_datos) { $mensaje_salida[] = "Tu producto ha sido ingresado satisfactoriamente."; } else { $errores[]= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($conectar); }
} else {
	$errores[]= "Error desconocido.";
}
?>

<?php if (isset($errores)){ ?>
	<div class="alert alert-danger" role="alert">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>Error!</strong> 
			<?php foreach ($errores as $error) { echo $error; } ?>
	</div>
<?php } ?>

<?php if (isset($mensaje_salida)) {	?>
	<div class="alert alert-success" role="alert">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong>¡Bien hecho!</strong>
		<?php foreach ($mensaje_salida as $mensaje) { echo $mensaje; } ?>
	</div>
<?php } ?>