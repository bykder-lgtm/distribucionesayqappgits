<?php
include_once('../conexiones/conexione.php');
include_once('../evitar_mensaje_error/error.php');
header('Content-Type: application/json');
date_default_timezone_set("America/Bogota");

$cod_tienda                          = isset($_POST['cod_tienda']) ? intval($_POST['cod_tienda']) : 0;
$identificacion_tercero              = isset($_POST['identificacion_tercero']) ? intval($_POST['identificacion_tercero']) : 0;
$nombre_tienda                       = isset($_POST['nombre_tienda']) ? mysqli_real_escape_string($conectar, trim($_POST['nombre_tienda'])) : '';
$telefono1_tercero                   = isset($_POST['telefono1_tercero']) ? mysqli_real_escape_string($conectar, trim($_POST['telefono1_tercero'])) : '';
$correo_tercero                      = isset($_POST['correo_tercero']) ? mysqli_real_escape_string($conectar, trim($_POST['correo_tercero'])) : '';
$direccion_tercero                   = isset($_POST['direccion_tercero']) ? mysqli_real_escape_string($conectar, trim($_POST['direccion_tercero'])) : '';
$barrio_tercero                      = isset($_POST['barrio_tercero']) ? mysqli_real_escape_string($conectar, trim($_POST['barrio_tercero'])) : '';
$cod_departamento                    = isset($_POST['cod_departamento']) ? intval($_POST['cod_departamento']) : 0;
$cod_municipio                       = isset($_POST['cod_municipio']) ? intval($_POST['cod_municipio']) : 0;
$ubicacion_gps_tienda                = isset($_POST['ubicacion_gps_tienda']) ? mysqli_real_escape_string($conectar, trim($_POST['ubicacion_gps_tienda'])) : '';
$cod_aliado_estrategico              = isset($_POST['cod_aliado_estrategico']) ? intval($_POST['cod_aliado_estrategico']) : 0;
// Nuevos campos
$nombre_representante                = isset($_POST['nombre_representante']) ? mysqli_real_escape_string($conectar, trim($_POST['nombre_representante'])) : '';
$documento_representante             = isset($_POST['documento_representante']) ? intval($_POST['documento_representante']) : 0;
$correo_representante                = isset($_POST['correo_representante']) ? mysqli_real_escape_string($conectar, trim($_POST['correo_representante'])) : '';
$nombre_tipo_industria               = isset($_POST['nombre_tipo_industria']) ? mysqli_real_escape_string($conectar, trim($_POST['nombre_tipo_industria'])) : '';
$nombre_tipo_subindustria            = isset($_POST['nombre_tipo_subindustria']) ? mysqli_real_escape_string($conectar, trim($_POST['nombre_tipo_subindustria'])) : '';
$nombre_tipo_otraindustria           = isset($_POST['nombre_tipo_otraindustria']) ? mysqli_real_escape_string($conectar, trim($_POST['nombre_tipo_otraindustria'])) : '';
$numero_comercios                    = isset($_POST['numero_comercios']) ? intval($_POST['numero_comercios']) : 1;
$existe_rues                         = isset($_POST['existe_rues']) ? mysqli_real_escape_string($conectar, trim($_POST['existe_rues'])) : '';
$venta_presencial                    = isset($_POST['venta_presencial']) ? mysqli_real_escape_string($conectar, trim($_POST['venta_presencial'])) : '';
$venta_online                        = isset($_POST['venta_online']) ? mysqli_real_escape_string($conectar, trim($_POST['venta_online'])) : '';
$nombre_plataforma_ecommerce         = isset($_POST['nombre_plataforma_ecommerce']) ? mysqli_real_escape_string($conectar, trim($_POST['nombre_plataforma_ecommerce'])) : '';
$nombre_sistema_contable             = isset($_POST['nombre_sistema_contable']) ? mysqli_real_escape_string($conectar, trim($_POST['nombre_sistema_contable'])) : '';
$comision_ptj                        = isset($_POST['comision_ptj']) ? floatval($_POST['comision_ptj']) : 0;
$cod_banco_cuenta                    = isset($_POST['cod_banco_cuenta']) ? intval($_POST['cod_banco_cuenta']) : 0;
$cod_estado                          = isset($_POST['cod_estado']) ? intval($_POST['cod_estado']) : 1;
// Validar campos requeridos
if ($cod_tienda <= 0) { echo json_encode(array('success' => false, 'message' => 'Código de tienda inválido')); exit; }
if (empty($nombre_tienda) || $identificacion_tercero <= 0) { echo json_encode(array('success' => false, 'message' => 'Los campos Nombre de Tienda y NIT son obligatorios')); exit; }
// Actualizar tienda
$sql = "UPDATE tbl15_tienda SET 
identificacion_tercero = '$identificacion_tercero', nombre_tienda = UPPER('$nombre_tienda'), nombre1_tercero = UPPER('$nombre_tienda'), telefono1_tercero = '$telefono1_tercero',
correo_tercero = '$correo_tercero', direccion_tercero = UPPER('$direccion_tercero'), barrio_tercero = UPPER('$barrio_tercero'), cod_departamento = '$cod_departamento', cod_municipio = '$cod_municipio', ubicacion_gps_tienda = '$ubicacion_gps_tienda', cod_aliado_estrategico = '$cod_aliado_estrategico', nombre_representante = UPPER('$nombre_representante'),
documento_representante = '$documento_representante', correo_representante = '$correo_representante', nombre_tipo_industria = UPPER('$nombre_tipo_industria'),
nombre_tipo_subindustria = UPPER('$nombre_tipo_subindustria'), nombre_tipo_otraindustria = UPPER('$nombre_tipo_otraindustria'), numero_comercios = '$numero_comercios',
existe_rues = '$existe_rues', venta_presencial = '$venta_presencial', venta_online = '$venta_online', nombre_plataforma_ecommerce = '$nombre_plataforma_ecommerce',
nombre_sistema_contable = '$nombre_sistema_contable', comision_ptj = '$comision_ptj', cod_banco_cuenta = '$cod_banco_cuenta', cod_estado = '$cod_estado' WHERE cod_tienda = '$cod_tienda'";
$resultado = mysqli_query($conectar, $sql);
if ($resultado) { echo json_encode(array('success' => true, 'message' => 'Tienda actualizada correctamente', 'cod_tienda' => $cod_tienda)); } else { echo json_encode(array('success' => false, 'message' => 'Error al actualizar la tienda: ' . mysqli_error($conectar))); }
mysqli_close($conectar);
?>
