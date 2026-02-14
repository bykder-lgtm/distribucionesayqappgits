<?php
include_once('../conexiones/conexione.php'); //Contiene funcion que conecta a la base de datos

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

		$cod_producto                    = intval($_POST["cod_producto"]);
		$cod_producto_barra              = mysqli_real_escape_string($conectar, $_POST['cod_producto_barra']);
		$nombre_producto                 = mysqli_real_escape_string($conectar,(strip_tags(strtoupper($_POST['nombre_producto']), ENT_QUOTES)));
		$und_producto                    = mysqli_real_escape_string($conectar, $_POST['und_producto']);
		$precio_costo_producto           = intval($_POST["precio_costo_producto"]);
		$precio_venta_producto           = intval($_POST["precio_venta_producto"]);
		$posologia_cantidad              = mysqli_real_escape_string($conectar, $_POST['posologia_cantidad']);
		$posologia_peso                  = mysqli_real_escape_string($conectar, $_POST['posologia_peso']);
		$nombre_tipo_producto            = mysqli_real_escape_string($conectar, $_POST['nombre_tipo_producto']);
		$nombre_tipo_unidad_medida       = mysqli_real_escape_string($conectar, $_POST['nombre_tipo_unidad_medida']);
		$nombre_tipo_presentacion        = mysqli_real_escape_string($conectar, $_POST['nombre_tipo_presentacion']);
		$nombre_via_administracion       = mysqli_real_escape_string($conectar, $_POST['nombre_via_administracion']);
		$nombre_frec_duracion            = mysqli_real_escape_string($conectar, $_POST['nombre_frec_duracion']);
		$fecha_vencimiento1              = mysqli_real_escape_string($conectar, $_POST['fecha_vencimiento1']);
		$vencimiento_lote1               = mysqli_real_escape_string($conectar, $_POST['vencimiento_lote1']);
		$fecha_vencimiento2              = mysqli_real_escape_string($conectar, $_POST['fecha_vencimiento2']);
		$vencimiento_lote2               = mysqli_real_escape_string($conectar, $_POST['vencimiento_lote2']);
		$iva_ptj                         = mysqli_real_escape_string($conectar, $_POST['iva_ptj']);
		$tope_min                        = mysqli_real_escape_string($conectar, $_POST['tope_min']);

$sql = "UPDATE tbl15_producto SET cod_producto_barra=\"$cod_producto_barra\",nombre_producto=\"$nombre_producto\",
und_producto=\"$und_producto\",precio_costo_producto=\"$precio_costo_producto\",precio_venta_producto=\"$precio_venta_producto\",
posologia_cantidad=\"$posologia_cantidad\", posologia_peso=\"$posologia_peso\", nombre_tipo_producto=\"$nombre_tipo_producto\", 
nombre_tipo_unidad_medida=\"$nombre_tipo_unidad_medida\", nombre_tipo_presentacion=\"$nombre_tipo_presentacion\", 
nombre_via_administracion=\"$nombre_via_administracion\", nombre_frec_duracion=\"$nombre_frec_duracion\" , 
fecha_vencimiento1=\"$fecha_vencimiento1\", vencimiento_lote1=\"$vencimiento_lote1\", fecha_vencimiento2=\"$fecha_vencimiento2\",
vencimiento_lote2=\"$vencimiento_lote2\", iva_ptj=\"$iva_ptj\", tope_min=\"$tope_min\"
WHERE cod_producto = $cod_producto";
$query_update = mysqli_query($conectar,$sql);

			if ($query_update) { $messages[] = "EL tbl15_producto ha sido actualizado satisfactoriamente."; } 
			else { $errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($conectar); }
		} 
		else { $errors []= "Error desconocido."; }
		
		if (isset($errors)) { ?>

			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> 
					<?php
						foreach ($errors as $error) {
								echo $error;
							}
						?>
			</div>
			<?php
			}
			if (isset($messages)) { ?>

				<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>¡Bien hecho!</strong>
						<?php
							foreach ($messages as $message) {
									echo $message;
								}
							?>
				</div>
				<?php
			}
?>