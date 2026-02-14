<?php
include_once('../conexiones/conexione.php');
//----------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------//
$cod_info_producto_copia_inventario            = intval($_GET['cod_info_producto_copia_inventario']);
$cod_producto_barra                            = addslashes($_GET['cod_producto_barra']);
$buscar_por                                    = addslashes($_GET['buscar_por']);
$nombre_tipo_cargue_factura                    = addslashes($_GET['nombre_tipo_cargue_factura']);
$nombre_tipo_moneda                            = addslashes($_GET['nombre_tipo_moneda']);
$nombre_tipo_factura                           = addslashes($_GET['nombre_tipo_factura']);
$foco                                          = addslashes($_GET['foco']);
$cod_estado_vacuna                             = addslashes($_GET['cod_estado_vacuna']);
$pagina                                        = addslashes($_GET['pagina']);


$sql_productos_cargados = "SELECT cod_producto_copia_inventario FROM tbl15_producto_copia_inventario WHERE (cod_info_producto_copia_inventario = '$cod_info_producto_copia_inventario') AND (cod_producto_barra = '$cod_producto_barra')";
$resultado_productos_cargados = mysqli_query($conectar, $sql_productos_cargados) or die(mysqli_error($conectar));
$total_resultados = mysqli_num_rows($resultado_productos_cargados);
$matriz_consulta = mysqli_fetch_assoc($resultado_productos_cargados);

$cod_producto_copia_inventario      = $matriz_consulta['cod_producto_copia_inventario'];

if ($total_resultados <> 0) {
$pagina_redirect = '../admin/reg_cargar_producto_copia_inventario.php?cod_producto_copia_inventario='.$cod_producto_copia_inventario.'&cod_info_producto_copia_inventario='.$cod_info_producto_copia_inventario.'&cod_producto_barra='.$cod_producto_barra.'&buscar_por='.$buscar_por.'&nombre_tipo_cargue_factura='.$nombre_tipo_cargue_factura.'&nombre_tipo_moneda='.$nombre_tipo_moneda.'&nombre_tipo_factura='.$nombre_tipo_factura.'&foco='.$foco.'&cod_estado_vacuna='.$cod_estado_vacuna.'&pagina='.$pagina;
header("Location: $pagina_redirect");
} else {
$pagina_redirect = '../admin/cargar_producto_copia_inventario.php?cod_info_producto_copia_inventario='.$cod_info_producto_copia_inventario.'&pagina='.$pagina;
header("Location: $pagina_redirect");
}
?>