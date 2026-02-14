<?php
require_once('../conexiones/conexione.php');
include_once('../admin/class_php/fecha_en_espanol_mes.php');
include_once('../admin/class_php/fecha_en_espanol_mes_anyo.php');
include_once('../admin/class_php/numeros_a_letras_funcion.php');
date_default_timezone_set("America/Bogota");
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
$nombre_empresa                                                    = strtoupper($info_empresa_data['nombre']);
//-----------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------//
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
$nombre_archivo                      = "INVENTARIO_".$nombre_empresa."_".$nombre_dependencia_get.'_'.$fecha.'_'.$hora;

if ($cod_dependencia==0) {
    $filtro_consulta_dependencia = "";
    $filtro_consulta_dependencia_and = "";
    $filtro_consulta_dependencia_rel = "";
} else {
    $filtro_consulta_dependencia = "WHERE (cod_dependencia = '$cod_dependencia')";
    $filtro_consulta_dependencia_and = "AND (cod_dependencia = '$cod_dependencia')";
    $filtro_consulta_dependencia_rel = "WHERE (tbl15_producto.cod_dependencia = '$cod_dependencia')";
}
//-----------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------//
$fecha                       = date("Y_m_d");
$hora                        = date("H_i_s");
//-----------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------//
$cabecera_emp               = "VENTAS_TODO";
//-----------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------//
require_once __DIR__ . '/class_php/Spout-2.7.3/Spout/Autoloader/autoload.php';
use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;
$writer = WriterFactory::create(Type::XLSX);
$writer->openToBrowser($nombre_archivo);
// Headers
$writer->addRow(array('0ID', 'CODIGO_BARRAS', 'CODIGO_BARRAS2', 'NOMBRE_PRODUCTO', 'UNIDADES_'.$nombre_campo_undidades_inv1, 'UNIDADES_'.$nombre_campo_undidades_inv2, 'UNIDADES_BODEGA2', 'PRECIO_COMPRA', 'TOTAL_PCOMPRA', 
'PRECIO_VENTA1', 'TOTAL_PVENTA', 'PRECIO_VENTA2', 'PRECIO_VENTA3', 'PRECIO_VENTA4', 'PRECIO_VENTA5', 'IVA', 'IVA_SALUDABLE', 'COMISION_PTJ', 'IMPOCONSUMO', 'DEPENDENCIA', 'COD_SUBDEPENDENCIA', 
'PESO_PRODUCTO', 'UNIDAD_MEDIDA', 'TIPO_PRODUCTO', 'TIPO_PRECIO_VENTA', 'PRESENTACION_UND', 'PRESENTACION_CAJA', 'PRESENTACION_UND_CAJA', 'PRESENTACION_UND_SOBRE', 'COD_CATEGORIA', 'COD_SUBCATEGORIA', 
'COD_MARCA', 'COD_PROVEEDOR', 'URL_IMAGEN_PRODUCTO_ORIG', 'URL_IMAGEN_PRODUCTO_MIN', 'ESATADO_PRODUCTO'));
// Then a foreach
$mostrar_datos_sql = "SELECT * 
FROM tbl15_producto WHERE (cod_producto >= '0') 
$filtro_cod_barra_nombre_producto $filtro_dependencia $filtro_tipo_producto $filtro_tipo_precio_venta $filtro_tipo_unidad_medida $filtro_nombre_estado $filtro_categoria
$filtro_tipo_compra $filtro_tipo_producto_cocina $filtro_promocion $filtro_opcion_descontable_inv ORDER BY $campo_ordenamiento $tipo_ordenamiento";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
while ($datos = mysqli_fetch_assoc($consulta)) {

    $cod_producto                         = $datos['cod_producto'];
    $cod_producto_barra                   = $datos['cod_producto_barra'];
    $cod_producto_barra2                  = $datos['cod_producto_barra2'];
    $nombre_producto                      = $datos['nombre_producto'];
    $und_producto                         = $datos['und_producto'];
    $und_producto_bodega                  = $datos['und_producto_bodega'];
    $und_producto_bodega2                 = $datos['und_producto_bodega2'];
    $precio_compra_producto               = $datos['precio_compra_producto'];
    $precio_costo_producto                = $datos['precio_costo_producto'];
    $precio_venta_producto                = $datos['precio_venta_producto'];
    $precio_venta_producto2               = $datos['precio_venta_producto2'];
    $precio_venta_producto3               = $datos['precio_venta_producto3'];
    $precio_venta_producto4               = $datos['precio_venta_producto4'];
    $precio_venta_producto5               = $datos['precio_venta_producto5'];
    $iva_ptj                              = $datos['iva_ptj'];
    $iva_saludable_ptj                    = $datos['iva_saludable_ptj'];
    $comision_ptj                         = $datos['comision_ptj'];
    $precio_ipc                           = $datos['precio_ipc'];
    $cod_dependencia                      = $datos['cod_dependencia'];
    $cod_dependencia_sub                  = $datos['cod_dependencia_sub'];
    $peso_producto                        = $datos['peso_producto'];
    $nombre_tipo_unidad_medida            = $datos['nombre_tipo_unidad_medida'];
    $nombre_tipo_producto                 = $datos['nombre_tipo_producto'];
    $nombre_tipo_precio_venta             = $datos['nombre_tipo_precio_venta'];
    $und_unidades                         = $datos['und_unidades'];
    $und_caja                             = $datos['und_caja'];
    $cajas_sobre                          = $datos['cajas_sobre'];
    $und_sobre                            = $datos['und_sobre'];
    $cod_categoria                        = $datos['cod_categoria'];
    $cod_categoria_sub                    = $datos['cod_categoria_sub'];
    $cod_marca                            = $datos['cod_marca'];
    $cod_tercero                          = $datos['cod_tercero'];
    $cod_proveedor                        = $datos['cod_proveedor'];
    $url_img_orig_producto                = $datos['url_img_orig_producto'];
    $url_img_min_producto                 = $datos['url_img_min_producto'];
    $nombre_estado                        = $datos['nombre_estado'];

    if ($und_producto > 0) { $total_pcompra = $und_producto * $precio_compra_producto; } else { $total_pcompra = 0; }
    if ($und_producto > 0) { $total_pventa = $und_producto * $precio_venta_producto; } else { $total_pventa = 0; }

    if ($cod_tipo_sistema_numeracion_und_compra == '2') { $und_producto = intval($und_producto); } else { $und_producto = $und_producto; }
    if ($cod_tipo_sistema_numeracion_und_compra == '2') { $und_producto_bodega = intval($und_producto_bodega); } else { $und_producto_bodega = $und_producto_bodega; }
    if ($cod_tipo_sistema_numeracion_precio_compra == '2') { $precio_costo_producto = intval($precio_costo_producto); } else { $precio_costo_producto = $precio_costo_producto; }
    if ($cod_tipo_sistema_numeracion_precio_compra == '2') { $precio_compra_producto = intval($precio_compra_producto); } else { $precio_compra_producto = $precio_compra_producto; }
    if ($cod_tipo_sistema_numeracion_precio_venta == '2') { $precio_venta_producto = intval($precio_venta_producto); } else { $precio_venta_producto = $precio_venta_producto; }

    $sql_dependencia = "SELECT nombre_dependencia FROM tbl15_dependencia WHERE (cod_dependencia = '$cod_dependencia')";
    $consulta_dependencia = mysqli_query($conectar, $sql_dependencia) or die(mysqli_error($conectar));
    $datos_dependencia = mysqli_fetch_assoc($consulta_dependencia);

    $nombre_dependencia            = $datos_dependencia['cod_dependencia'];

    $writer->addRow(array($cod_producto, $cod_producto_barra, $cod_producto_barra2, $nombre_producto, $und_producto, $und_producto_bodega, $und_producto_bodega2, $precio_compra_producto, $total_pcompra, 
    $precio_venta_producto, $total_pventa, $precio_venta_producto2, $precio_venta_producto3, $precio_venta_producto4, $precio_venta_producto5, $iva_ptj, $iva_saludable_ptj, $comision_ptj, $precio_ipc, $cod_dependencia, $cod_dependencia_sub, 
    $peso_producto, $nombre_tipo_unidad_medida, $nombre_tipo_producto, $nombre_tipo_precio_venta, $und_unidades, $und_caja, $cajas_sobre, $und_sobre, $cod_categoria, $cod_categoria_sub, 
    $cod_marca, $cod_tercero, $url_img_orig_producto, $url_img_min_producto, $nombre_estado));
    //$writer->addRow(array((int) 00, 'Customer name', (double) 23.12, '20-01-2016'));
}
$writer->close();