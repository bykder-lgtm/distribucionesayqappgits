<?php
include_once('../conexiones/conexione.php');
//----------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------//
$buscar               = addslashes($_GET['term']);
$tipo_puc             = addslashes($_GET['tipo_puc']);

if($buscar <> NULL) {

	$retorno_array = array();
	$retorno_array2 = array();

	if ($tipo_puc == 'NINGUNO') {
		$sql_id_animal = "SELECT * FROM tbl15_puc WHERE ((codigo_puc LIKE '$buscar%') OR (nombre_puc LIKE '%$buscar%') AND (cod_estado = '1'))";
		$consulta_id_animal = mysqli_query($conectar, $sql_id_animal) or die(mysqli_error($conectar));
		$total_resul = mysqli_num_rows($consulta_id_animal);
	} else {
		$sql_id_animal = "SELECT * FROM tbl15_puc WHERE ((codigo_puc LIKE '$buscar%') OR (nombre_puc LIKE '%$buscar%') AND (tipo_puc = '$tipo_puc') AND (cod_estado = '1'))";
		$consulta_id_animal = mysqli_query($conectar, $sql_id_animal) or die(mysqli_error($conectar));
		$total_resul = mysqli_num_rows($consulta_id_animal);
	}
	while ($datos_animal = mysqli_fetch_assoc($consulta_id_animal)) {
	 	 	 	 
		$cod_puc                                       = $datos_animal['cod_puc'];
		$codigo_puc                                    = $datos_animal['codigo_puc'];
		$nombre_puc                                    = $datos_animal['nombre_puc'];
		$tipo_puc                                      = $datos_animal['tipo_puc'];
		$cod_estado                                    = $datos_animal['cod_estado'];

		$datos_array['id']                             = $codigo_puc;
		$datos_array['value']                          = $codigo_puc." | ".$nombre_puc." | ".$tipo_puc;
		$datos_array['cod_puc']                        = $cod_puc;
		$datos_array['codigo_puc']                     = $codigo_puc;
		$datos_array['nombre_puc']                     = $nombre_puc;
		$datos_array['tipo_puc']                       = $tipo_puc;
		$datos_array['cod_estado']                     = $cod_estado;

		array_push($retorno_array, $datos_array);
	}
	//echo json_encode($retorno_array);
	echo json_encode($retorno_array);
} else { } ?>