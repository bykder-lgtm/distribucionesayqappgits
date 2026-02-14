<?php
include_once('../conexiones/conexione.php'); //Contiene funcion que conecta a la base de datos

session_start();
/*Inicia validacion del lado del servidor*/
if (empty($_POST['cod_producto_barra'])) {
   $errors[] = "Codigo vacío";
} 
else if (empty($_POST['nombre_producto'])) {
	$errors[] = "Nombre vacío";
}
//else if (empty($_POST['und_producto'])) {
//	$errors[] = "Unidades vacío";
//}
//else if (empty($_POST['precio_costo_producto'])) {
//	$errors[] = "Precio costo vacío";
//}
else if (empty($_POST['precio_venta_producto'])) {
	$errors[] = "Precio venta vacío";
}
else if (empty($_POST['nombre_tipo_producto'])) {
	$errors[] = "Tipo vacío";
}

else if (!empty($_POST['cod_producto_barra']) && !empty($_POST['nombre_producto'])) {

$cod_producto_barra              = intval($_POST["cod_producto_barra"]);
$nombre_producto                 = mysqli_real_escape_string($conectar,(strip_tags(strtoupper($_POST['nombre_producto']), ENT_QUOTES)));
$und_producto                    = intval($_POST["und_producto"]);
$precio_costo_producto           = intval($_POST["precio_costo_producto"]);
$precio_venta_producto           = intval($_POST["precio_venta_producto"]);
$nombre_tipo_producto            = mysqli_real_escape_string($conectar,(strip_tags(strtoupper($_POST['nombre_tipo_producto']), ENT_QUOTES)));

$sql = "INSERT INTO tbl15_producto (cod_producto_barra, nombre_producto, und_producto, precio_costo_producto, precio_venta_producto, nombre_tipo_producto) 
VALUE (\"$cod_producto_barra\",\"$nombre_producto\",\"$und_producto\",\"$precio_costo_producto\",\"$precio_venta_producto\",\"$nombre_tipo_producto\")";
$query_new_insert = mysqli_query($conectar,$sql);

	if ($query_new_insert){
		$messages[] = "Tu tbl15_producto ha sido ingresado satisfactoriamente.";
	} else{
		$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($conectar);
	}
} else {
	$errors []= "Error desconocido.";
}
if (isset($errors)){ ?>
<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error!</strong><?php foreach ($errors as $error) { echo $error; } ?>
</div>
	<?php
	}
	if (isset($messages)) {	?>
<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>¡Bien hecho!</strong><?php foreach ($messages as $message) { echo $message; } ?>
</div>
<?php } ?>