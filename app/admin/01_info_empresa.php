<?php
$sql_infos_empresas = "SELECT * FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$resultado_infos_empresas = mysqli_query($conectar, $sql_infos_empresas);
$datos_info_empresa = mysqli_fetch_assoc($resultado_infos_empresas);

$titulo                              = $datos_info_empresa['titulo'];
$nombre                              = $datos_info_empresa['nombre'];
$eslogan                             = $datos_info_empresa['eslogan'];
$res                                 = $datos_info_empresa['res'];
$res1                                = $datos_info_empresa['res1'];
$res2                                = $datos_info_empresa['res2'];
$fecha_res                           = $datos_info_empresa['fecha_res'];
$direccion                           = $datos_info_empresa['direccion'];
$ciudad                              = $datos_info_empresa['ciudad'];
$departamento                        = $datos_info_empresa['departamento'];
$cabecera                            = $datos_info_empresa['cabecera'];
$img_cabecera                        = $datos_info_empresa['img_cabecera'];
$telefono                            = $datos_info_empresa['telefono'];
$regimen                             = $datos_info_empresa['regimen'];
$logotipo                            = $datos_info_empresa['logotipo'];
$icono                               = $datos_info_empresa['icono'];
$version                             = $datos_info_empresa['version'];
?>