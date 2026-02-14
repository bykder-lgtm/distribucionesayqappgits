<?php
include_once('../conexiones/conexione.php');
//----------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------//
$buscar = addslashes($_GET['term']);
$tipo_puc = addslashes($_GET['tipo_puc']);

if($buscar <> NULL) {

	$retorno_array = array();
	$retorno_array2 = array();

	$sql_id_animal = "SELECT tbl15_cuentas_pagar.cod_cuentas_pagar, tbl15_cuentas_pagar.cod_factura, tbl15_cuentas_pagar.cod_tercero, 
	tbl15_cuentas_pagar.monto_deuda, tbl15_cuentas_pagar.subtotal, tbl15_cuentas_pagar.abonado, tbl15_cuentas_pagar.fecha_pago, tbl15_tercero.nombre1_tercero
	FROM tbl15_tercero RIGHT JOIN tbl15_cuentas_pagar ON tbl15_tercero.cod_tercero = tbl15_cuentas_pagar.cod_tercero 
	WHERE ((tbl15_tercero.nombre1_tercero LIKE '%$buscar%') OR (tbl15_cuentas_pagar.cod_factura LIKE '%$buscar%')) AND (tbl15_cuentas_pagar.subtotal > '0')";
	$consulta_id_animal = mysqli_query($conectar, $sql_id_animal) or die(mysqli_error($conectar));
	$total_resul = mysqli_num_rows($consulta_id_animal);
	while ($datos_animal = mysqli_fetch_assoc($consulta_id_animal)) {
	 	 	 	 
		$cod_cuentas_pagar                             = $datos_animal['cod_cuentas_pagar'];
		$cod_factura                                   = $datos_animal['cod_factura'];
		$nombre1_tercero                               = $datos_animal['nombre1_tercero'];
		$monto_deuda                                   = $datos_animal['monto_deuda'];
		$subtotal                                      = $datos_animal['subtotal'];

		$datos_array['id']                             = $cod_factura;
		$datos_array['value']                          = "FACTURA: ".$cod_factura." | PROV: ".$nombre1_tercero." | TOTAL: ".number_format($monto_deuda, 0, ",", ".")." | PENDIENTE: ".number_format($subtotal, 0, ",", ".")." | ID: ".$cod_cuentas_pagar;
		$datos_array['cod_cuentas_pagar']              = $cod_cuentas_pagar;
		$datos_array['cod_factura']                    = $cod_factura;
		$datos_array['nombre1_tercero']                = $nombre1_tercero;
		$datos_array['monto_deuda']                    = number_format($monto_deuda, 0, ",", ".");
		$datos_array['subtotal']                       = number_format($subtotal, 0, ",", ".");
		$datos_array['costo']                          = $subtotal;

		array_push($retorno_array, $datos_array);
	}
echo json_encode($retorno_array);
} else { } ?>