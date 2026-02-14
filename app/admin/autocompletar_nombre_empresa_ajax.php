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


$sql_id_animal = "SELECT * FROM tbl15_empresa WHERE ((nit_empresa LIKE '%$buscar%') OR (nombre_empresa LIKE '%$buscar%'))";
$consulta_id_animal = mysqli_query($conectar, $sql_id_animal);
$total_resul = mysqli_num_rows($consulta_id_animal);

while ($datos_animal = mysqli_fetch_assoc($consulta_id_animal)) {
$cod_empresa                                   = $datos_animal['cod_empresa'];
$nombre_empresa                                = $datos_animal['nombre_empresa'];
$nombre1_empresa                               = $datos_animal['nombre1_empresa'];
$nombre2_empresa                               = $datos_animal['nombre2_empresa'];
$apellido1_empresa                             = $datos_animal['apellido1_empresa'];
$apellido2_empresa                             = $datos_animal['apellido2_empresa'];
$razonsocial_empresa                           = $datos_animal['razonsocial_empresa'];
$direccion_empresa                             = $datos_animal['direccion_empresa'];
$telefono_empresa                              = $datos_animal['telefono_empresa'];
$nit_empresa                                   = $datos_animal['nit_empresa'];
$correo_empresa                                = $datos_animal['correo_empresa'];
$municipio_empresa                             = $datos_animal['municipio_empresa'];
$estrato_empresa                               = $datos_animal['estrato_empresa'];
$ocupacion_empresa                             = $datos_animal['ocupacion_empresa'];
$nombre_tipo_tercero                           = $datos_animal['nombre_tipo_tercero'];
$contacto                                      = $datos_animal['contacto'];
$fax                                           = $datos_animal['fax'];
$nombre_pais                                   = $datos_animal['nombre_pais'];
$nombre_departamento                           = $datos_animal['nombre_departamento'];
$ciudad                                        = $datos_animal['ciudad'];
$telefono                                      = $datos_animal['telefono'];
$telefono2                                     = $datos_animal['telefono2'];
$nombre_tipo_identificacion                    = $datos_animal['nombre_tipo_identificacion'];
$nombre_tipo_cliente                           = $datos_animal['nombre_tipo_cliente'];
$nombre_tipo_regimen                           = $datos_animal['nombre_tipo_regimen'];
$nombre_tipo_impuesto                          = $datos_animal['nombre_tipo_impuesto'];
$digito                                        = $datos_animal['digito'];

$datos_array['id']                             = $cod_empresa;
$datos_array['value']                          = $nit_empresa." | ".$nombre_empresa;
$datos_array['cod_empresa']                    = $cod_empresa;
$datos_array['nombre_empresa']                 = $nombre_empresa;
$datos_array['nit_empresa']                    = $nit_empresa;
$datos_array['direccion_empresa']              = $direccion_empresa;
$datos_array['estrato_empresa']                = $estrato_empresa;
$datos_array['municipio_empresa']              = $municipio_empresa;
$datos_array['telefono_empresa']               = $telefono_empresa;
$datos_array['correo_empresa']                 = $correo_empresa;
$datos_array['ocupacion_empresa']              = $ocupacion_empresa;

array_push($retorno_array, $datos_array);
}
//echo json_encode($retorno_array);
echo json_encode($retorno_array);
} else { } ?>