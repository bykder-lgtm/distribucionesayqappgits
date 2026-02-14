<?php
include_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_codif_cryptor_class.php');
include_once("../session/funciones_admin.php");
//include("../tbl15_notificacion_alerta/mostrar_noficacion_alerta.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
  } else { header("Location:../index.php");
}
//----------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------//
$buscar = addslashes($_REQUEST['term']);

if($buscar <> NULL) {

$retorno_array                                 = array();
$retorno_array2                                = array();
$nombre_tipo_tercero                           = 'CLIENTE';


$sql_id_animal = "SELECT * FROM tbl15_administrador WHERE ((cedula LIKE '%$buscar%') OR (nombres LIKE '%$buscar%'))";
$consulta_id_animal = mysqli_query($conectar, $sql_id_animal);
$total_resul = mysqli_num_rows($consulta_id_animal);

while ($datos_animal = mysqli_fetch_assoc($consulta_id_animal)) {
$cod_administrador                             = $datos_animal['cod_administrador'];
$cedula                                        = $datos_animal['cedula'];
$nombres                                       = $datos_animal['nombres'];
$apellidos                                     = $datos_animal['apellidos'];

$datos_array['id']                             = $cod_administrador;
$datos_array['value']                          = $nombres." ".$apellidos;
$datos_array['cod_administrador']              = $cod_administrador;
$datos_array['nombre_auxiliar_pasante']        = $nombres." ".$apellidos;
$datos_array['doc_auxiliar_pasante']           = $cedula;

array_push($retorno_array, $datos_array);
}
//echo json_encode($retorno_array);
echo json_encode($retorno_array);
} else { } ?>