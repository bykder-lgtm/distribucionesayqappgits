<?php
require_once('../conexiones/conexione.php'); 
include ("../session/funciones_admin.php");
//-----------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------//
$sql_infos_empresas = "SELECT * FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$resultado_infos_empresas = mysqli_query($conectar, $sql_infos_empresas);
$info_empresa_data = mysqli_fetch_assoc($resultado_infos_empresas);

$nombre_campo_undidades_inv1                                       = $info_empresa_data['nombre_campo_undidades_inv1'];
$nombre_campo_undidades_inv2                                       = $info_empresa_data['nombre_campo_undidades_inv2'];
$nombre_campo_undidades_inv3                                       = $info_empresa_data['nombre_campo_undidades_inv3'];
$cod_tipo_sistema_numeracion                                       = $info_empresa_data['cod_tipo_sistema_numeracion'];

$cod_tipo_sistema_numeracion_und_compra                            = $info_empresa_data['cod_tipo_sistema_numeracion_und_compra'];
$cod_tipo_sistema_numeracion_und_venta                             = $info_empresa_data['cod_tipo_sistema_numeracion_und_venta'];
$cod_tipo_sistema_numeracion_precio_compra                         = $info_empresa_data['cod_tipo_sistema_numeracion_precio_compra'];
$cod_tipo_sistema_numeracion_precio_venta                          = $info_empresa_data['cod_tipo_sistema_numeracion_precio_venta'];

$nombre_tipo_campo_componente_html_und_venta                       = $info_empresa_data['nombre_tipo_campo_componente_html_und_venta'];
$nombre_tipo_campo_componente_html_und_compra                      = $info_empresa_data['nombre_tipo_campo_componente_html_und_compra'];
$nombre_tipo_campo_componente_html_precio_compra                   = $info_empresa_data['nombre_tipo_campo_componente_html_precio_compra'];
$nombre_tipo_campo_componente_html_precio_venta                    = $info_empresa_data['nombre_tipo_campo_componente_html_precio_venta'];
//-----------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------//
if (isset($_GET['cod_administrador'])) {

$cod_administrador                   = intval($_GET['cod_administrador']);

if (isset($_GET['cod_barra_nombre_producto'])) { 
    $cod_barra_nombre_producto = addslashes($_GET['cod_barra_nombre_producto']); 
    if ($cod_barra_nombre_producto <> '') { 
        $filtro_cod_barra_nombre_producto = "AND ((cod_producto_barra = '$cod_barra_nombre_producto') OR (nombre_producto LIKE '%$cod_barra_nombre_producto%'))"; 
    } else { 
        $filtro_cod_barra_nombre_producto = "";  
    }
} else { 
    $cod_barra_nombre_producto = ''; 
    $filtro_cod_barra_nombre_producto = ""; 
}


if (isset($_GET['cod_dependencia'])) { 
    $cod_dependencia = intval($_GET['cod_dependencia']); 
    if ($cod_dependencia <> '') { 
        $filtro_dependencia = "AND (cod_dependencia = '$cod_dependencia')"; 
    } else { 
        $filtro_dependencia = "";  
    }
} else { 
    $cod_dependencia = ''; 
    $filtro_dependencia = ""; 
}


if (isset($_GET['nombre_tipo_producto'])) { 
    $nombre_tipo_producto = addslashes($_GET['nombre_tipo_producto']); 
    if ($nombre_tipo_producto <> '') { 
        $filtro_tipo_producto = "AND (nombre_tipo_producto = '$nombre_tipo_producto')"; 
    } else { 
        $filtro_tipo_producto = "";  
    }
} else { 
    $nombre_tipo_producto = ''; 
    $filtro_tipo_producto = ""; 
}

if (isset($_GET['nombre_tipo_precio_venta'])) { 
    $nombre_tipo_precio_venta = addslashes($_GET['nombre_tipo_precio_venta']); 
    if ($nombre_tipo_precio_venta <> '') { 
        $filtro_tipo_precio_venta = "AND (nombre_tipo_precio_venta = '$nombre_tipo_precio_venta')"; 
    } else { 
        $filtro_tipo_precio_venta = "";  
    }
} else { 
    $nombre_tipo_precio_venta = ''; 
    $filtro_tipo_precio_venta = ""; 
}


if (isset($_GET['nombre_tipo_unidad_medida'])) { 
    $nombre_tipo_unidad_medida = addslashes($_GET['nombre_tipo_unidad_medida']); 
    if ($nombre_tipo_unidad_medida <> '') { 
        $filtro_tipo_unidad_medida = "AND (nombre_tipo_unidad_medida = '$nombre_tipo_unidad_medida')"; 
    } else { 
        $filtro_tipo_unidad_medida = "";  
    }
} else { 
    $nombre_tipo_unidad_medida = ''; 
    $filtro_tipo_unidad_medida = ""; 
}

if (isset($_GET['nombre_estado'])) { 
    $nombre_estado = addslashes($_GET['nombre_estado']); 
    if ($nombre_estado <> '') { 
        $filtro_nombre_estado = "AND (nombre_estado = '$nombre_estado')"; 
    } else { 
        $filtro_nombre_estado = "";  
    }
} else { 
    $nombre_estado = ''; 
    $filtro_nombre_estado = ""; 
}


if (isset($_GET['cod_categoria'])) { 
    $cod_categoria = intval($_GET['cod_categoria']); 
    if ($cod_categoria <> '') { 
        $filtro_categoria = "AND (cod_categoria = '$cod_categoria')"; 
    } else { 
        $filtro_categoria = "";  
    }
} else { 
    $cod_categoria = ''; 
    $filtro_categoria = ""; 
}

if (isset($_GET['nombre_tipo_compra'])) { 
    $nombre_tipo_compra = addslashes($_GET['nombre_tipo_compra']); 
    if ($nombre_tipo_compra <> '') { 
        $filtro_tipo_compra = "AND (nombre_tipo_compra = '$nombre_tipo_compra')"; 
    } else { 
        $filtro_tipo_compra = "";  
    }
} else { 
    $nombre_tipo_compra = ''; 
    $filtro_tipo_compra = ""; 
}

if (isset($_GET['cod_tipo_producto_cocina'])) { 
    $cod_tipo_producto_cocina = intval($_GET['cod_tipo_producto_cocina']); 
    if ($cod_tipo_producto_cocina <> '') { 
        $filtro_tipo_producto_cocina = "AND (cod_tipo_producto_cocina = '$cod_tipo_producto_cocina')"; 
    } else { 
        $filtro_tipo_producto_cocina = "";  
    }
} else { 
    $cod_tipo_producto_cocina = ''; 
    $filtro_tipo_producto_cocina = ""; 
}

if (isset($_GET['nombre_promocion'])) { 
    $nombre_promocion = addslashes($_GET['nombre_promocion']); 
    if ($nombre_promocion <> '') { 
        $filtro_promocion = "AND (nombre_promocion = '$nombre_promocion')"; 
    } else { 
        $filtro_promocion = "";  
    }
} else { 
    $nombre_promocion = ''; 
    $filtro_promocion = ""; 
}

if (isset($_GET['cod_opcion_descontable_inv'])) { 
    $cod_opcion_descontable_inv = intval($_GET['cod_opcion_descontable_inv']); 
    if ($cod_opcion_descontable_inv <> '') { 
        $filtro_opcion_descontable_inv = "AND (cod_opcion_descontable_inv = '$cod_opcion_descontable_inv')"; 
    } else { 
        $filtro_opcion_descontable_inv = "";  
    }
} else { 
    $cod_opcion_descontable_inv = ''; 
    $filtro_opcion_descontable_inv = ""; 
}

if (isset($_GET['campo_ordenamiento'])) {
    $campo_ordenamiento = addslashes($_GET['campo_ordenamiento']);
    $tipo_ordenamiento = addslashes($_GET['tipo_ordenamiento']);
    $buscar = '';
    $cod_dependencias = '0';
} else {
    $campo_ordenamiento = 'nombre_producto';
    $tipo_ordenamiento = 'DESC';
    $buscar = '';
    $cod_dependencias = '0';
}
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_dependencia_get = "SELECT nombre_dependencia FROM tbl15_dependencia WHERE (cod_dependencia = '$cod_dependencia')";
$consulta_dependencia_get = mysqli_query($conectar, $sql_dependencia_get) or die(mysqli_error($conectar));
$datos_dependencia_get = mysqli_fetch_assoc($consulta_dependencia_get);

$nombre_dependencia_get            = $datos_dependencia_get['nombre_dependencia'];
//---------------------------------------------------------------------------------------------------------------------------------//

$fecha_hora                          = date("H:i:s");
$fecha                               = date("Ymd");
$hora                                = date("His");
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_infos_empresas = "SELECT * FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$resultado_infos_empresas = mysqli_query($conectar, $sql_infos_empresas);
$info_empresa_data = mysqli_fetch_assoc($resultado_infos_empresas);

$titulo_emp                                 = $info_empresa_data['titulo'];
$nombre_emp                                 = $info_empresa_data['nombre'];
$eslogan_emp                                = $info_empresa_data['eslogan'];
$direccion_emp                              = $info_empresa_data['direccion'];
$ciudad_emp                                 = $info_empresa_data['ciudad'];
$pais_emp                                   = $info_empresa_data['pais'];
$correo_emp                                 = $info_empresa_data['correo'];
$img_cabecera_emp                           = $info_empresa_data['img_cabecera'];
$telefono_emp                               = $info_empresa_data['telefono'];
$info_legal_emp                             = $info_empresa_data['info_legal'];
$logotipo_emp                               = $info_empresa_data['logotipo'];
$propietario_nombres_apellidos_emp          = $info_empresa_data['propietario_nombres_apellidos'];
$propietario_nit_emp                        = $info_empresa_data['propietario_nit'];
$nit_empresa_emp                            = $info_empresa_data['nit_empresa'];
$cabecera_emp                               = $info_empresa_data['cabecera'];
$icono_emp                                  = $info_empresa_data['icono'];
$desarrollador_emp                          = $info_empresa_data['desarrollador'];
$pag_desarrollador_emp                      = $info_empresa_data['pag_desarrollador'];
$anyo_emp                                   = $info_empresa_data['anyo'];
$url_pag                                    = $info_empresa_data['url_pag'];
$nombre_font                                = $info_empresa_data['nombre_font'];
$res_emp                                    = $info_empresa_data['res'];
$res1_emp                                   = $info_empresa_data['res1'];
$res2_emp                                   = $info_empresa_data['res2'];
$departamento_emp                           = $info_empresa_data['departamento'];
$localidad_emp                              = $info_empresa_data['localidad'];
$reg_medico_emp                             = $info_empresa_data['reg_medico'];
$regimen_emp                                = $info_empresa_data['regimen'];
$version_emp                                = $info_empresa_data['version'];
$propietario_url_firma_emp                  = $info_empresa_data['propietario_url_firma'];
$fecha_time_emp                             = $info_empresa_data['fecha_time'];
$licencia_emp                               = $info_empresa_data['licencia'];
$tamano_font_emp                            = $info_empresa_data['tamano_font'];
$info_histclinic_emp                        = $info_empresa_data['info_histclinic'];
$info_aptlaboral_emp                        = $info_empresa_data['info_aptlaboral'];
$dia_ini_facturacion_emp                    = $info_empresa_data['dia_ini_facturacion'];
$dia_fin_facturacion_emp                    = $info_empresa_data['dia_fin_facturacion'];
$smtp_correo_host_emp                       = $info_empresa_data['smtp_correo_host'];
$smtp_correo_auth_emp                       = $info_empresa_data['smtp_correo_auth'];
$smtp_correo_username_emp                   = $info_empresa_data['smtp_correo_username'];
$smtp_correo_password_emp                   = $info_empresa_data['smtp_correo_password'];
$smtp_correo_secure_emp                     = $info_empresa_data['smtp_correo_secure'];
$smtp_correo_port_emp                       = $info_empresa_data['smtp_correo_port'];
$nombre_concepto_multi_virtual              = $info_empresa_data['nombre_concepto_multi_virtual'];
$nombre_tipo_precio_venta                   = $info_empresa_data['nombre_tipo_precio_venta'];
$numero_precio                              = $info_empresa_data['numero_precio'];
$nombre_tipo_empresa                        = $info_empresa_data['nombre_tipo_empresa'];
$dias_vencimiento_producto_alerta           = $info_empresa_data['dias_vencimiento_producto_alerta'];
$cod_estado_fecha_vencimiento_global               = $info_empresa_data['cod_estado_fecha_vencimiento_global'];
$cod_estado_ptj_comision_global                    = $info_empresa_data['cod_estado_ptj_comision_global'];
$cod_estado_impoconsumo_global                     = $info_empresa_data['cod_estado_impoconsumo_global'];
$cod_estado_dto1_global                            = $info_empresa_data['cod_estado_dto1_global'];
$cod_estado_dto2_global                            = $info_empresa_data['cod_estado_dto2_global'];
$cod_estado_preventa_global                        = $info_empresa_data['cod_estado_preventa_global'];
$cod_estado_propina_global                         = $info_empresa_data['cod_estado_propina_global'];
$cod_estado_img_impimir_factura_global             = $info_empresa_data['cod_estado_img_impimir_factura_global'];
$url_encuesta_experiencia_compra            = $info_empresa_data['url_encuesta_experiencia_compra'];
$cod_estado_encuesta_experiencia_compra_global     = $info_empresa_data['cod_estado_encuesta_experiencia_compra_global'];
$cod_estado_codif_precio_compra_global             = $info_empresa_data['cod_estado_codif_precio_compra_global'];
$cod_estado_codif_precio_venta_global              = $info_empresa_data['cod_estado_codif_precio_venta_global'];
$cod_estado_inventario_bodega_global               = $info_empresa_data['cod_estado_inventario_bodega_global'];
$cod_estado_sticker_barras_global                  = $info_empresa_data['cod_estado_sticker_barras_global'];
$cod_estado_modulo_contabilidad_global             = $info_empresa_data['cod_estado_modulo_contabilidad_global'];
$cod_estado_modulo_cotizacion_global               = $info_empresa_data['cod_estado_modulo_cotizacion_global'];
//---------------------------------------------------------------------------------------------------------------------------------//
$nombre                      = "INVENTARIO_PRODUCTOS_".$nombre_dependencia_get.'_'.$fecha.''.$hora.'.xls';

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$nombre");


echo "<table border=1>";
echo "<tr>";
echo "<td>CODIGO</td>";
echo "<td>NOMBRE_PRODUCTO</td>";
echo "<td>UNIDADES ".$nombre_campo_undidades_inv1."</td>";
if ($cod_estado_inventario_bodega_global == '1') { echo "<td>UNIDADES_".$nombre_campo_undidades_inv2."</td>"; }
echo "<td>PRECIO_COMPRA</td>";
echo "<td>PRECIO_VENTA1</td>";
echo "<td>PRECIO_VENTA2</td>";
echo "<td>PRECIO_VENTA3</td>";
echo "<td>PRECIO_VENTA4</td>";
echo "<td>PRECIO_VENTA5</td>";
echo "<td>IVA</td>";
echo "<td>IMPOCONSUMO</td>";
echo "<td>DEPENDENCIA</td>";
echo "<td>COD_MARCA</td>";
echo "<td>COD_PROVEEDOR</td>";
echo "</tr>";

$sql_cliente = "SELECT * FROM tbl15_producto WHERE (cod_producto >= '0') 
$filtro_cod_barra_nombre_producto $filtro_dependencia $filtro_tipo_producto $filtro_tipo_precio_venta $filtro_tipo_unidad_medida $filtro_nombre_estado $filtro_categoria
$filtro_tipo_compra $filtro_tipo_producto_cocina $filtro_promocion $filtro_opcion_descontable_inv ORDER BY $campo_ordenamiento $tipo_ordenamiento";
$resultado_cliente = mysqli_query($conectar, $sql_cliente) or die(mysqli_error($conectar));
while ($info_cliente = mysqli_fetch_assoc($resultado_cliente)) {
			
$cod_producto                  = $info_cliente['cod_producto'];
$cod_producto_barra            = $info_cliente['cod_producto_barra'];
$nombre_producto               = $info_cliente['nombre_producto'];
$und_producto                  = $info_cliente['und_producto'];
$precio_compra_producto        = $info_cliente['precio_compra_producto'];
$precio_costo_producto         = $info_cliente['precio_costo_producto'];
$precio_venta_producto         = $info_cliente['precio_venta_producto'];
$precio_venta_producto2        = $info_cliente['precio_venta_producto2'];
$precio_venta_producto3        = $info_cliente['precio_venta_producto3'];
$precio_venta_producto4        = $info_cliente['precio_venta_producto4'];
$precio_venta_producto5        = $info_cliente['precio_venta_producto5'];
$iva_ptj                       = $info_cliente['iva_ptj'];
$cod_marca                     = $info_cliente['cod_marca'];
$cod_proveedor                 = $info_cliente['cod_proveedor'];
$cod_tercero                   = $info_cliente['cod_tercero'];
$cod_dependencia               = $info_cliente['cod_dependencia'];
$precio_ipc                    = $info_cliente['precio_ipc'];
$und_producto_bodega           = $info_cliente['und_producto_bodega'];

if ($cod_tipo_sistema_numeracion_und_compra == '2') { $und_producto = intval($und_producto); } else { $und_producto = $und_producto; }
if ($cod_tipo_sistema_numeracion_und_compra == '2') { $und_producto_bodega = intval($und_producto_bodega); } else { $und_producto_bodega = $und_producto_bodega; }
if ($cod_tipo_sistema_numeracion_precio_compra == '2') { $precio_costo_producto = intval($precio_costo_producto); } else { $precio_costo_producto = $precio_costo_producto; }
if ($cod_tipo_sistema_numeracion_precio_compra == '2') { $precio_compra_producto = intval($precio_compra_producto); } else { $precio_compra_producto = $precio_compra_producto; }
if ($cod_tipo_sistema_numeracion_precio_venta == '2') { $precio_venta_producto = intval($precio_venta_producto); } else { $precio_venta_producto = $precio_venta_producto; }

$sql_dependencia = "SELECT nombre_dependencia FROM tbl15_dependencia WHERE (cod_dependencia = '$cod_dependencia')";
$consulta_dependencia = mysqli_query($conectar, $sql_dependencia) or die(mysqli_error($conectar));
$datos_dependencia = mysqli_fetch_assoc($consulta_dependencia);

$nombre_dependencia            = $datos_dependencia['nombre_dependencia'];

echo "<tr>";
echo "<td>".$cod_producto_barra."</td>";
echo "<td>".$nombre_producto."</td>";
echo "<td>".$und_producto."</td>";
if ($cod_estado_inventario_bodega_global == '1') { echo "<td>".$und_producto_bodega."</td>"; }
echo "<td>".$precio_compra_producto."</td>";
echo "<td>".$precio_venta_producto."</td>";
echo "<td>".$precio_venta_producto2."</td>";
echo "<td>".$precio_venta_producto3."</td>";
echo "<td>".$precio_venta_producto4."</td>";
echo "<td>".$precio_venta_producto5."</td>";
echo "<td>".$iva_ptj."</td>";
echo "<td>".$precio_ipc."</td>";
echo "<td>".$nombre_dependencia."</td>";
echo "<td>".$cod_marca."</td>";
echo "<td>".$cod_tercero."</td>";
echo "</tr>";
}
echo "</table>";
}
?>

