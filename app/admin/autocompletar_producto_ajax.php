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


$sql_id_animal = "SELECT * FROM tbl15_producto WHERE ((cod_producto_barra LIKE '%$buscar%') OR (nombre_producto LIKE '%$buscar%'))";
$consulta_id_animal = mysqli_query($conectar, $sql_id_animal);
$total_resul = mysqli_num_rows($consulta_id_animal);

while ($datos_animal = mysqli_fetch_assoc($consulta_id_animal)) {
$cod_producto                                  = $datos_animal['cod_producto'];
$cod_producto_barra                            = $datos_animal['cod_producto_barra'];
$nombre_producto                               = $datos_animal['nombre_producto'];
$und_producto                                  = $datos_animal['und_producto'];
$precio_costo_producto                         = $datos_animal['precio_costo_producto'];
$precio_venta_producto                         = $datos_animal['precio_venta_producto'];
$nombre_tipo_producto                          = $datos_animal['nombre_tipo_producto'];

$nombre_tipo_unidad_medida                     = $datos_animal['nombre_tipo_unidad_medida'];
$posologia_cantidad                            = $datos_animal['posologia_cantidad'];
$posologia_peso                                = $datos_animal['posologia_peso'];
$nombre_tipo_presentacion                      = $datos_animal['nombre_tipo_presentacion'];
$nombre_via_administracion                     = $datos_animal['nombre_via_administracion'];
$nombre_frec_duracion                          = $datos_animal['nombre_frec_duracion'];

$datos_array['id']                             = $cod_producto;
$datos_array['value']                          = $cod_producto_barra." | ".$nombre_producto;
$datos_array['cod_producto']                   = $cod_producto;
$datos_array['cod_producto_barra']             = $cod_producto_barra;
$datos_array['nombre_producto']                = $nombre_producto;
$datos_array['und_producto']                   = $und_producto;
$datos_array['precio_costo_producto']          = $precio_costo_producto;
$datos_array['precio_venta_producto']          = $precio_venta_producto;
$datos_array['nombre_tipo_producto']           = $nombre_tipo_producto;
$datos_array['nombre_tipo_unidad_medida']      = $nombre_tipo_unidad_medida;
$datos_array['posologia_cantidad']             = $posologia_cantidad;
$datos_array['posologia_peso']                 = $posologia_peso;
$datos_array['nombre_tipo_presentacion']       = $nombre_tipo_presentacion;
$datos_array['nombre_via_administracion']      = $nombre_via_administracion;
$datos_array['nombre_frec_duracion']           = $nombre_frec_duracion;

array_push($retorno_array, $datos_array);
}
//echo json_encode($retorno_array);
echo json_encode($retorno_array);
} else { } ?>