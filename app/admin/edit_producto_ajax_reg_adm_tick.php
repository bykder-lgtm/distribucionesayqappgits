<?php
include_once('../conexiones/conexione.php'); //Contiene funcion que conecta a la base de datos
include_once('../admin/01_admin_modulo_inicio_sesion.php');
date_default_timezone_set("America/Bogota");

if (empty($_POST['cod_producto_barra'])) { $errors[] = "Referencia vacía"; } else if (empty($_POST['nombre_producto'])) { $errors[] = "Nombre vacío"; } else if (!empty($_POST['cod_producto_barra']) && !empty($_POST['nombre_producto'])) {

	if (isset($_POST['cod_producto']) <> '') { $cod_producto = intval($_POST["cod_producto"]); } else { $cod_producto = ''; }
	if (isset($_POST['cod_producto_barra']) <> '') { $cod_producto_barra = mysqli_real_escape_string($conectar,(strip_tags(($_POST['cod_producto_barra']), ENT_QUOTES))); } else { $cod_producto_barra = ''; }
	if (isset($_POST['cod_producto_barra2']) <> '') { $cod_producto_barra2 = mysqli_real_escape_string($conectar,(strip_tags(($_POST['cod_producto_barra2']), ENT_QUOTES))); } else { $cod_producto_barra2 = ''; }
	if (isset($_POST['nombre_producto']) <> '') { $nombre_producto = mysqli_real_escape_string($conectar,(strip_tags(strtoupper($_POST['nombre_producto']), ENT_QUOTES))); } else { $nombre_producto = ''; }
	if (isset($_POST['nombre_categoria']) <> '') { $nombre_categoria = mysqli_real_escape_string($conectar,(strip_tags(strtoupper($_POST['nombre_categoria']), ENT_QUOTES))); } else { $nombre_categoria = ''; }
	if (isset($_POST['nombre_categoria_sub']) <> '') { $nombre_categoria_sub = mysqli_real_escape_string($conectar,(strip_tags(strtoupper($_POST['nombre_categoria_sub']), ENT_QUOTES))); } else { $nombre_categoria_sub = ''; }
	if (isset($_POST['nombre_marca']) <> '') { $nombre_marca = mysqli_real_escape_string($conectar,(strip_tags(strtoupper($_POST['nombre_marca']), ENT_QUOTES))); } else { $nombre_marca = ''; }
	if (isset($_POST['nombre_tipo_aplicacion']) <> '') { $nombre_tipo_aplicacion = mysqli_real_escape_string($conectar,(strip_tags(strtoupper($_POST['nombre_tipo_aplicacion']), ENT_QUOTES))); } else { $nombre_tipo_aplicacion = ''; }
	if (isset($_POST['descripcion_tipo_aplicacion']) <> '') { $descripcion_tipo_aplicacion = mysqli_real_escape_string($conectar,(strip_tags(($_POST['descripcion_tipo_aplicacion']), ENT_QUOTES))); } else { $descripcion_tipo_aplicacion = ''; }
	if (isset($_POST['nombre_tipo_referencia']) <> '') { $nombre_tipo_referencia = mysqli_real_escape_string($conectar,(strip_tags(strtoupper($_POST['nombre_tipo_referencia']), ENT_QUOTES))); } else { $nombre_tipo_referencia = ''; }
	if (isset($_POST['nombre_promocion']) <> '') { $nombre_promocion = mysqli_real_escape_string($conectar,(strip_tags(($_POST['nombre_promocion']), ENT_QUOTES))); } else { $nombre_promocion = ''; }
	if (isset($_POST['und_inv']) <> '') { $und_inv = intval($_POST["und_inv"]); } else { $und_inv = ''; }
	if (isset($_POST['precio_compra_producto']) <> '') { $precio_compra_producto = intval($_POST["precio_compra_producto"]); } else { $precio_compra_producto = ''; }
	if (isset($_POST['precio_venta_producto']) <> '') { $precio_venta_producto = intval($_POST["precio_venta_producto"]); } else { $precio_venta_producto = ''; }
	if (isset($_POST['precio_venta_producto2']) <> '') { $precio_venta_producto2 = intval($_POST["precio_venta_producto2"]); } else { $precio_venta_producto2 = ''; }
	if (isset($_POST['iva_ptj']) <> '') { $iva_ptj = intval($_POST["iva_ptj"]); } else { $iva_ptj = ''; }
	if (isset($_POST['url_pagina_descripcion']) <> '') { $url_pagina_descripcion = mysqli_real_escape_string($conectar,(strip_tags(($_POST['url_pagina_descripcion']), ENT_QUOTES))); } else { $url_pagina_descripcion = ''; }
	if (isset($_POST['nombre_estado']) <> '') { $nombre_estado = mysqli_real_escape_string($conectar,(strip_tags(strtoupper($_POST['nombre_estado']), ENT_QUOTES))); } else { $nombre_estado = ''; }
	//if (isset($_GET['descripcion_producto3']) <> '') { $descripcion_producto = addslashes($_GET['descripcion_producto3']); } else { $descripcion_producto = ''; }

	$sql_info_tabla = "SELECT nombre_promocion_ing FROM tbl15_promocion WHERE nombre_promocion = '$nombre_promocion'";
	$consulta_info_tabla = mysqli_query($conectar, $sql_info_tabla);
	$info_tabla = mysqli_fetch_array($consulta_info_tabla);

	$nombre_promocion_ing               = $info_tabla['nombre_promocion_ing'];
	$fecha_time                         = time();
	$fecha_ultima_modif                 = date("Y-m-d H:i:s");
	$cuenta_ultima_modif                = $cuenta_usuario;

	$sql = "UPDATE tbl15_producto SET cod_producto_barra=\"$cod_producto_barra\",cod_producto_barra2=\"$cod_producto_barra2\",
	nombre_producto=\"$nombre_producto\",nombre_categoria=\"$nombre_categoria\",nombre_categoria_sub=\"$nombre_categoria_sub\",
	nombre_marca=\"$nombre_marca\",nombre_tipo_aplicacion=\"$nombre_tipo_aplicacion\",descripcion_tipo_aplicacion=\"$descripcion_tipo_aplicacion\",
	nombre_tipo_referencia=\"$nombre_tipo_referencia\",nombre_promocion=\"$nombre_promocion\",nombre_promocion_ing=\"$nombre_promocion_ing\",
	und_inv=\"$und_inv\",precio_compra_producto=\"$precio_compra_producto\", precio_venta_producto=\"$precio_venta_producto\",
	precio_venta_producto2=\"$precio_venta_producto2\",iva_ptj=\"$iva_ptj\", 
	url_pagina_descripcion=\"$url_pagina_descripcion\",nombre_estado=\"$nombre_estado\",fecha_time=\"$fecha_time\",fecha_ultima_modif=\"$fecha_ultima_modif\",
	cuenta_ultima_modif=\"$cuenta_ultima_modif\" WHERE cod_producto = $cod_producto";
	$query_update = mysqli_query($conectar,$sql);

	if ($query_update) { $messages[] = "EL producto ha sido actualizado satisfactoriamente."; } else { $errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($conectar); }
} else { 
	$errors []= "Error desconocido."; 
}
?>

<?php if (isset($errors)) { ?>
	<div class="alert alert-danger" role="alert">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong>Error!</strong> 
		<?php foreach ($errors as $error) { echo $error; } ?>
	</div>
<?php } ?>

<?php if (isset($messages)) { ?>
	<div class="alert alert-success" role="alert">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong>¡Bien hecho!</strong>
		<?php foreach ($messages as $message) { echo $message; } ?>
	</div>
<?php } ?>