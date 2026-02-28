<?php
include_once('../conexiones/conexione.php');
include_once('../evitar_mensaje_error/error.php');
include_once('../session/funciones_admin.php');
header('Content-Type: application/json');

if (!verificar_usuario()) { echo json_encode(array('success' => false, 'message' => 'Sesión no válida')); exit; }
$cod_tienda = isset($_GET['cod_tienda']) ? intval($_GET['cod_tienda']) : 0;
if ($cod_tienda <= 0) { echo json_encode(array('success' => false, 'message' => 'Código de tienda inválido')); exit; }
// En este sistema, cod_vendedor en tbl15_administrador se usa para vincular el vendedor (cod_seguridad=2) con una tienda
$sql = "SELECT cod_administrador, nombres_apellidos_tercero, cuenta, telefono1_tercero, url_img_foto_prof_min FROM tbl15_administrador WHERE cod_seguridad = '2' AND 
cod_vendedor = '$cod_tienda' ORDER BY nombres_apellidos_tercero ASC";
$resultado = mysqli_query($conectar, $sql);
$vendedores = array();

if ($resultado) {
    while ($fila = mysqli_fetch_assoc($resultado)) {
        // Asegurar que la ruta de la imagen sea correcta o un placeholder
        if (empty($fila['url_img_foto_prof_min']) || !file_exists($fila['url_img_foto_prof_min'])) { $fila['url_img_foto_prof_min'] = ''; }
        $vendedores[] = $fila;
    }
    echo json_encode(array('success' => true, 'vendedores' => $vendedores));
} else {
    echo json_encode(array('success' => false, 'message' => 'Error al consultar vendedores: ' . mysqli_error($conectar)));
}
mysqli_close($conectar);
?>
