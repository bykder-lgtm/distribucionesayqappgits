<?php
include_once('../conexiones/conexione.php');
//----------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------//
$buscar = addslashes($_GET['term']);
$tipo_puc = addslashes($_GET['tipo_puc']);

if($buscar <> NULL) {

	$retorno_array = array();
	$retorno_array2 = array();

	$sql_id_animal = "SELECT tbl15_info_factura_compra.cod_info_factura_compra, tbl15_info_factura_compra.cod_factura, tbl15_info_factura_compra.cod_tercero, 
	tbl15_info_factura_compra.total_factura_compra_retefuente, tbl15_info_factura_compra.fecha_anyo, tbl15_info_factura_compra.cod_tipo_pago, tbl15_tercero.nombre1_tercero
	FROM tbl15_tercero RIGHT JOIN tbl15_info_factura_compra ON tbl15_tercero.cod_tercero = tbl15_info_factura_compra.cod_tercero
	WHERE ((tbl15_info_factura_compra.cod_factura = '$buscar') OR (tbl15_tercero.nombre1_tercero LIKE '%$buscar%')) AND (tbl15_info_factura_compra.nombre_estado_factura = 'CERRADA') 
	ORDER BY tbl15_info_factura_compra.fecha_anyo DESC";
	$consulta_id_animal = mysqli_query($conectar, $sql_id_animal) or die(mysqli_error($conectar));
	$total_resul = mysqli_num_rows($consulta_id_animal);
	while ($datos_animal = mysqli_fetch_assoc($consulta_id_animal)) {

		$cod_info_factura_compra                               = $datos_animal['cod_info_factura_compra'];
	 	$cod_factura                                           = $datos_animal['cod_factura'];
		$cod_tercero                                           = $datos_animal['cod_tercero'];
		$fecha_anyo                                            = $datos_animal['fecha_anyo'];
		$cod_tipo_pago                                         = $datos_animal['cod_tipo_pago'];
		$total_factura_compra_retefuente                       = number_format($datos_animal['total_factura_compra_retefuente'], 0, ",", ".");

	    $sql_tipo_nota_observacion = "SELECT * FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
	    $consulta_tipo_nota_observacion = mysqli_query($conectar, $sql_tipo_nota_observacion);
	    $datos_tipo_nota_observacion = mysqli_fetch_assoc($consulta_tipo_nota_observacion);

	    $nombre1_tercero                                       = $datos_tipo_nota_observacion['nombre1_tercero'];

	    $sql_tipo_pago = "SELECT * FROM tbl15_tipo_pago WHERE (cod_tipo_pago = '$cod_tipo_pago')";
	    $consulta_tipo_pago = mysqli_query($conectar, $sql_tipo_pago);
	    $datos_tipo_pago = mysqli_fetch_assoc($consulta_tipo_pago);

	    $nombre_tipo_pago                                      = $datos_tipo_pago['nombre_tipo_pago'];

		$datos_array['id']                                     = $cod_factura;
		$datos_array['value']                                  = $nombre1_tercero." | TOTAL: ".$total_factura_compra_retefuente." | FECHA: ".$fecha_anyo." | FACTURA: ".$cod_factura." | ".$nombre_tipo_pago;
		$datos_array['cod_info_factura_compra']                = $cod_info_factura_compra;
		$datos_array['total_factura_compra_retefuente']        = $total_factura_compra_retefuente;
		$datos_array['fecha_anyo']                             = $fecha_anyo;
		$datos_array['cod_factura']                            = $cod_factura;

		array_push($retorno_array, $datos_array);
	}
//echo json_encode($retorno_array);
	echo json_encode($retorno_array);
}
?>