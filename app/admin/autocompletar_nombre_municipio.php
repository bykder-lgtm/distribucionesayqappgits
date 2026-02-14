<?php
include_once('../conexiones/conexione.php');
include_once("../session/funciones_admin.php");
//include("../tbl03_notificacion_alerta/mostrar_noficacion_alerta.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
  } else { header("Location:../index.php");
}
//----------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------//
if(isset($_REQUEST['term'])) {

	$buscar                      = mysqli_real_escape_string($conectar, ($_REQUEST['term']));
	$nombre_campo                = mysqli_real_escape_string($conectar, ($_REQUEST['nombre_campo']));
	$nombre_departamento         = mysqli_real_escape_string($conectar, ($_REQUEST['nombre_departamento']));
	$nombre_tipo_producto        = mysqli_real_escape_string($conectar, ($_REQUEST['nombre_tipo_producto']));

	$sql_id_departamento = "SELECT * FROM tbl15_departamento WHERE (nombre_departamento = '$nombre_departamento')";
	$consulta_id_departamento = mysqli_query($conectar, $sql_id_departamento);
	$datos_departamento = mysqli_fetch_assoc($consulta_id_departamento);

	$cod_departamento            = $datos_departamento['cod_departamento'];

	$retorno_array               = array();
	$retorno_array2              = array();

	$sql_id_macho = "SELECT * FROM tbl15_municipio WHERE (nombre_municipio LIKE '%$buscar%') AND (cod_departamento = '$cod_departamento')";
	$consulta_id_macho = mysqli_query($conectar, $sql_id_macho);
	$total_resul = mysqli_num_rows($consulta_id_macho);
	while ($datos_macho = mysqli_fetch_assoc($consulta_id_macho)) {

		$datos_array['value']                          = $datos_macho['nombre_municipio'];
		$datos_array['cod_municipio']                  = $datos_macho['cod_municipio'];
		$datos_array['nombre_municipio']               = $datos_macho['nombre_municipio'];

		array_push($retorno_array, $datos_array);
	}
	//echo json_encode($retorno_array);
	echo json_encode($retorno_array);
} else { } ?>