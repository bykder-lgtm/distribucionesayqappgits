<?php
include_once('../conexiones/conexione.php');
//----------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------//
$buscar                                = addslashes($_GET['term']);
$cod_tipo_nota_observacion             = addslashes($_GET['cod_tipo_nota_observacion']);

if($buscar <> NULL) {

	$retorno_array = array();
	$retorno_array2 = array();

	if ($cod_tipo_nota_observacion == '2') {

		$sql_id_animal = "SELECT tbl15_info_factura_venta.cod_info_factura_venta, tbl15_info_factura_venta.cod_factura, tbl15_info_factura_venta.cod_tercero, 
		tbl15_info_factura_venta.nombre_estado_factura, tbl15_info_factura_venta.fecha_anyo, tbl15_info_factura_venta.fecha_hora, tbl15_info_factura_venta.cod_tipo_pago, 
		tbl15_info_factura_venta.total_precio_venta, tbl15_info_factura_venta.cod_tipo_forma_pago, tbl15_tercero.identificacion_tercero, tbl15_tercero.nombre1_tercero, 
		tbl15_tercero.nombre2_tercero, tbl15_tercero.apellido1_tercero, tbl15_tercero.apellido2_tercero
		FROM tbl15_tercero RIGHT JOIN tbl15_info_factura_venta ON tbl15_tercero.cod_tercero = tbl15_info_factura_venta.cod_tercero
		WHERE ((tbl15_info_factura_venta.cod_factura = '$buscar') OR (tbl15_tercero.nombre1_tercero LIKE '%$buscar%') OR (tbl15_info_factura_venta.fecha_anyo = '%$buscar%')) 
		ORDER BY tbl15_info_factura_venta.cod_info_factura_venta DESC LIMIT 0, 100";
		$consulta_id_animal = mysqli_query($conectar, $sql_id_animal) or die(mysqli_error($conectar));
		$total_resul = mysqli_num_rows($consulta_id_animal);
		while ($datos_animal = mysqli_fetch_assoc($consulta_id_animal)) {
		 	 	 	 
			$cod_info_factura_venta                        = $datos_animal['cod_info_factura_venta'];
			$cod_factura                                   = $datos_animal['cod_factura'];
			$fecha_anyo                                    = $datos_animal['fecha_anyo'];
			$fecha_hora                                    = $datos_animal['fecha_hora'];
			$cod_tipo_pago                                 = $datos_animal['cod_tipo_pago'];
			$cod_tipo_forma_pago                           = $datos_animal['cod_tipo_forma_pago'];
			$total_precio_venta                            = $datos_animal['total_precio_venta'];
			$nombre_estado_factura                         = $datos_animal['nombre_estado_factura'];
			$identificacion_tercero                        = $datos_animal['identificacion_tercero'];
			$nombre1_tercero                               = $datos_animal['nombre1_tercero'];
			$nombre2_tercero                               = $datos_animal['nombre2_tercero'];
			$apellido1_tercero                             = $datos_animal['apellido1_tercero'];
			$apellido2_tercero                             = $datos_animal['apellido2_tercero'];
			$tercero                                       = $nombre1_tercero." ".$nombre2_tercero." ".$apellido1_tercero." ".$apellido2_tercero;

			$obtener_info_cod_tipo_pago = "SELECT * FROM tbl15_tipo_pago WHERE cod_tipo_pago = '$cod_tipo_pago'";
			$resultado_info_cod_tipo_pago = mysqli_query($conectar, $obtener_info_cod_tipo_pago) or die(mysqli_error($conectar));
			$info_cod_tipo_pago = mysqli_fetch_assoc($resultado_info_cod_tipo_pago);

			$nombre_tipo_pago                              = $info_cod_tipo_pago['nombre_tipo_pago'];

			$obtener_info_cod_tipo_forma_pago = "SELECT * FROM tbl15_tipo_forma_pago WHERE cod_tipo_forma_pago = '$cod_tipo_forma_pago'";
			$resultado_info_cod_tipo_forma_pago = mysqli_query($conectar, $obtener_info_cod_tipo_forma_pago) or die(mysqli_error($conectar));
			$info_cod_tipo_forma_pago = mysqli_fetch_assoc($resultado_info_cod_tipo_forma_pago);

			$nombre_tipo_forma_pago                        = $info_cod_tipo_forma_pago['nombre_tipo_forma_pago'];

			$datos_array['id']                             = $cod_info_factura_venta;
			$datos_array['value']                          = "FACTURA: ".$cod_factura." | ".$tercero." | ".number_format($total_precio_venta, 0, ",", ".")." | ".$fecha_anyo." | ".$nombre_tipo_pago." | ".$nombre_tipo_forma_pago." | ID ".$cod_info_factura_venta." | ".$nombre_estado_factura;
			$datos_array['doc_modifica']                   = "FACTURA: ".$cod_factura." | ".$tercero." | ".number_format($total_precio_venta, 0, ",", ".")." | ".$fecha_anyo." | ".$nombre_tipo_pago." | ".$nombre_tipo_forma_pago." | ID ".$cod_info_factura_venta." | ".$nombre_estado_factura;
			$datos_array['cod_factura']                    = $cod_factura;
			$datos_array['cod_tipo_nota_observacion']      = $cod_tipo_nota_observacion;
			$datos_array['llave']                          = $cod_info_factura_venta;
			$datos_array['fecha_anyo']                     = $fecha_anyo;

			array_push($retorno_array, $datos_array);
		}
	} elseif ($cod_tipo_nota_observacion == '3') {
		$sql_id_animal = "SELECT tbl15_info_factura_compra.cod_info_factura_compra, tbl15_info_factura_compra.cod_factura, tbl15_info_factura_compra.cod_tercero, tbl15_info_factura_compra.nombre_estado_factura, 
		tbl15_info_factura_compra.cuenta, tbl15_info_factura_compra.fecha_anyo, tbl15_info_factura_compra.fecha_hora, tbl15_info_factura_compra.cod_tipo_pago, tbl15_info_factura_compra.cod_tipo_forma_pago, 
		tbl15_info_factura_compra.total_factura_compra_retefuente, tbl15_tercero.identificacion_tercero, tbl15_tercero.nombre1_tercero
		FROM tbl15_tercero RIGHT JOIN tbl15_info_factura_compra ON tbl15_tercero.cod_tercero = tbl15_info_factura_compra.cod_tercero
		WHERE ((tbl15_info_factura_compra.cod_factura = '$buscar') OR (tbl15_tercero.nombre1_tercero LIKE '%$buscar%') OR (tbl15_info_factura_compra.fecha_anyo = '%$buscar%')) 
		ORDER BY tbl15_info_factura_compra.cod_info_factura_compra DESC LIMIT 0, 100";
		$consulta_id_animal = mysqli_query($conectar, $sql_id_animal) or die(mysqli_error($conectar));
		$total_resul = mysqli_num_rows($consulta_id_animal);
		while ($datos_animal = mysqli_fetch_assoc($consulta_id_animal)) {
		 	 	 	 
			$cod_info_factura_compra                       = $datos_animal['cod_info_factura_compra'];
			$cod_factura                                   = $datos_animal['cod_factura'];
			$fecha_anyo                                    = $datos_animal['fecha_anyo'];
			$fecha_hora                                    = $datos_animal['fecha_hora'];
			$cod_tipo_pago                                 = $datos_animal['cod_tipo_pago'];
			$cod_tipo_forma_pago                           = $datos_animal['cod_tipo_forma_pago'];
			$total_factura_compra_retefuente               = $datos_animal['total_factura_compra_retefuente'];
			$identificacion_tercero                        = $datos_animal['identificacion_tercero'];
			$nombre1_tercero                               = $datos_animal['nombre1_tercero'];
			$tercero                                       = $nombre1_tercero;
			$nombre_estado_factura                         = $datos_animal['nombre_estado_factura'];

			$obtener_info_cod_tipo_pago = "SELECT * FROM tbl15_tipo_pago WHERE cod_tipo_pago = '$cod_tipo_pago'";
			$resultado_info_cod_tipo_pago = mysqli_query($conectar, $obtener_info_cod_tipo_pago) or die(mysqli_error($conectar));
			$info_cod_tipo_pago = mysqli_fetch_assoc($resultado_info_cod_tipo_pago);

			$nombre_tipo_pago                              = $info_cod_tipo_pago['nombre_tipo_pago'];

			$obtener_info_cod_tipo_forma_pago = "SELECT * FROM tbl15_tipo_forma_pago WHERE cod_tipo_forma_pago = '$cod_tipo_forma_pago'";
			$resultado_info_cod_tipo_forma_pago = mysqli_query($conectar, $obtener_info_cod_tipo_forma_pago) or die(mysqli_error($conectar));
			$info_cod_tipo_forma_pago = mysqli_fetch_assoc($resultado_info_cod_tipo_forma_pago);

			$nombre_tipo_forma_pago                        = $info_cod_tipo_forma_pago['nombre_tipo_forma_pago'];

			$datos_array['id']                             = $cod_info_factura_compra;
			$datos_array['value']                          = "FACTURA: ".$cod_factura." | ".$tercero." | ".number_format($total_factura_compra_retefuente, 0, ",", ".")." | ".$fecha_anyo." | ".$nombre_tipo_pago." | ".$nombre_tipo_forma_pago." | ID ".$cod_info_factura_compra." | ".$nombre_estado_factura;
			$datos_array['doc_modifica']                   = "FACTURA: ".$cod_factura." | ".$tercero." | ".number_format($total_factura_compra_retefuente, 0, ",", ".")." | ".$fecha_anyo." | ".$nombre_tipo_pago." | ".$nombre_tipo_forma_pago." | ID ".$cod_info_factura_compra." | ".$nombre_estado_factura;
			$datos_array['cod_factura']                    = $cod_factura;
			$datos_array['cod_tipo_nota_observacion']      = $cod_tipo_nota_observacion;
			$datos_array['llave']                          = $cod_info_factura_compra;
			$datos_array['fecha_anyo']                     = $fecha_anyo;

			array_push($retorno_array, $datos_array);
		}
	} else {
			$datos_array['id']                             = "";
			$datos_array['value']                          = "";
			$datos_array['doc_modifica']                   = "";
			$datos_array['cod_factura']                    = "";
			$datos_array['cod_tipo_nota_observacion']      = "0";
			$datos_array['llave']                          = "0";
			$datos_array['fecha_anyo']                     = "";

			array_push($retorno_array, $datos_array);
	}
	echo json_encode($retorno_array);
}
?>