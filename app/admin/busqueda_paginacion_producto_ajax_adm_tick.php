<?php
include_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_codif_cryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
//include_once('../admin/fecha_en_espanol.php');
/*
include_once("../session/funciones_admin.php");
if (verificar_usuario()){
  } else { header("Location:../index.php");
}
*/
$pagina_complt            = $_SERVER['PHP_SELF'];
$fragm                    = explode("/", $pagina_complt);
$ultimo                   = end($fragm);
$total_elementos          = count($fragm) - 1;
$concatenador             = '';
foreach ($fragm as $key => $element) { if ($key <> $total_elementos) { $concatenador .= $element."/"; } }

$pagina                   = $concatenador."lista_producto_adm_tick..php";
//---------------------------------------------------------------------------------------------------------------------------------//
//$cuenta_actual      = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
//$cod_seguridad_des  = DAXCRYPTOR::descriptardax($_SESSION['cs_cryp']);

//$cod_seguridad_codif = ($cod_seguridad_des);
//$frag1 = str_split($cod_seguridad_codif);
//$numero_de_digitos1 = $frag1[0];
//if ($numero_de_digitos1 == 1) { $cod_seguridad = $frag1[5]; } 
//if ($numero_de_digitos1 == 2) { $cod_seguridad = $frag1[5].$frag1[6]; } 
//if ($numero_de_digitos1 == 3) { $cod_seguridad = $frag1[5].$frag1[6].$frag1[7]; } 
//if ($numero_de_digitos1 == 4) { $cod_seguridad = $frag1[5].$frag1[6].$frag1[7].$frag1[8]; } 
//if ($numero_de_digitos1 == 5) { $cod_seguridad = $frag1[5].$frag1[6].$frag1[7].$frag1[8].$frag1[9]; } 
//if ($numero_de_digitos1 == 6) { $cod_seguridad = $frag1[5].$frag1[6].$frag1[7].$frag1[8].$frag1[9].$frag1[10]; } 
//if ($numero_de_digitos1 == 7) { $cod_seguridad = $frag1[5].$frag1[6].$frag1[7].$frag1[8].$frag1[9].$frag1[10].$frag1[11]; }
//if ($numero_de_digitos1 == 8) { $cod_seguridad = $frag1[5].$frag1[6].$frag1[7].$frag1[8].$frag1[9].$frag1[10].$frag1[11].$frag1[12]; }
//if ($numero_de_digitos1 == 9) { $cod_seguridad = $frag1[5].$frag1[6].$frag1[7].$frag1[8].$frag1[9].$frag1[10].$frag1[11].$frag1[12].$frag1[13]; }
//---------------------------------------------------------------------------------------------------------------------------------//
    $action = (isset($_REQUEST['action']) && $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
    if($action == 'ajax'){
    // escaping, additionally removing everything that could be (html/javascript-) code
     $busqueda_ajax                  = mysqli_real_escape_string($conectar,(strip_tags($_REQUEST['busqueda_ajax'], ENT_QUOTES)));
     $registro_por_pagina            = intval($_REQUEST['numero_registro_por_pagina']);
     $buscar_por                     = mysqli_real_escape_string($conectar,(strip_tags($_REQUEST['buscar_por'], ENT_QUOTES)));
     $sTable                         = "tbl15_producto";

     if ($buscar_por=='cod_producto_barra') { $columnas_busqueda = array('cod_producto_barra'); } elseif ($buscar_por=='nombre_producto') { $columnas_busqueda = array('nombre_producto'); } elseif ($buscar_por=='nombre_categoria') { $columnas_busqueda = array('nombre_categoria'); } elseif ($buscar_por=='nombre_marca') { $columnas_busqueda = array('nombre_marca'); } else {  }
    //SELECT campo1, campo2 FROM table WHERE MATCH(vcampo1, vcampo2) AGAINST ('criterio') ;
$sWhere = "";
if ( $_REQUEST['busqueda_ajax'] != "" ) {
    $sWhere = "WHERE (";
    for ( $i=0 ; $i<count($columnas_busqueda) ; $i++ ) {
        $sWhere .= $columnas_busqueda[$i]." LIKE '%".$busqueda_ajax."%' OR ";
    }
    $sWhere = substr_replace( $sWhere, "", -3 );
    $sWhere .= ')';
}

if ($_REQUEST['busqueda_ajax'] == "") { $sWhere.=" ORDER BY cod_producto DESC"; } else { $sWhere.=" ORDER BY cod_producto DESC"; }
include '../ajax/paginador_paginacion_adm_tick.php'; //include pagination file
//pagination variables
$pagina_paginacion               = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
//$pagina_paginacion               = 1;
$numero_registro_por_pagina      = $registro_por_pagina; //cuantos registros quieres mostrar
$adyacentes                      = 4; //espacio entre páginas después del número de adyacentes
//if (isset($_REQUEST['inicio_pagina'])) { $inicio_pagina = intval($_REQUEST['inicio_pagina']); } else { $inicio_pagina = ($pagina_paginacion - 1) * $numero_registro_por_pagina; }
$inicio_pagina = ($pagina_paginacion - 1) * $numero_registro_por_pagina;
//Cuente el número total de filas en su tabla*/
$consulta_recuento               = mysqli_query($conectar, "SELECT count(*) AS numrows FROM $sTable $sWhere");
$row                             = mysqli_fetch_array($consulta_recuento);
$numero_datos                    = $row['numrows'];
$total_paginas                   = ceil($numero_datos/$numero_registro_por_pagina);
$recargar_pagina                 = '../admin/lista_producto_adm_tick.php';
//recorrer los datos recuperados
if ($numero_datos>0) { ?>
<table class="table table-striped jambo_table bulk_action">
    <thead>
        <tr class="headings">
        <th style="text-align:center" class="column-title">IMG</th>
        <th style="text-align:center" class="column-title">CODIGO</th>
        <th style="text-align:center" class="column-title">NOMBRE</th>
        <th style="text-align:center" class="column-title">PRECIO VENTA</th>
        <th style="text-align:center" class="column-title">ESTADO</th>
        <th style="text-align:center" class="column-title">COD</th>
        <th style="text-align:center" class="column-title">EDIT</th>
        <th style="text-align:center" class="column-title">ELIM</th>
    </tr>
    </thead>
<tbody>
<?php
$fecha_hoy = time();
//main query to fetch the data
$sql_consulta = "SELECT * FROM $sTable $sWhere LIMIT $inicio_pagina, $numero_registro_por_pagina";
$query_consulta = mysqli_query($conectar, $sql_consulta);
while ($datos_consulta = mysqli_fetch_array($query_consulta)) {

    $cod_producto                         = $datos_consulta['cod_producto'];
    $cod_producto_codif                   = DAXCODIFCRYPTOR::encodifdax($cod_producto);
    $cod_producto_codifcryp               = DAXCODIFCRYPTOR::encriptardax($cod_producto_codif);
    $cod_producto_barra                  = $datos_consulta['cod_producto_barra'];
    $nombre_producto                      = $datos_consulta['nombre_producto'];
    $precio_compra_producto               = $datos_consulta['precio_compra_producto'];
    $precio_venta_producto                = $datos_consulta['precio_venta_producto'];
    $precio_venta_producto2               = $datos_consulta['precio_venta_producto2'];
    $precio_venta_producto3               = $datos_consulta['precio_venta_producto3'];
    $url_img_producto_min                 = $datos_consulta['url_img_producto_min'];
    $url_img_producto_orig                = $datos_consulta['url_img_producto_orig'];
    $iva_ptj                              = $datos_consulta['iva_ptj'];
    $nombre_estado                        = $datos_consulta['nombre_estado'];
    ?>
    <input type='hidden' value='<?php echo $cod_producto;?>' id='cod_producto<?php echo $cod_producto;?>'>
    <input type='hidden' value='<?php echo $cod_producto_barra;?>' id='cod_producto_barra<?php echo $cod_producto;?>'>
    <input type='hidden' value='<?php echo $nombre_producto;?>' id='nombre_producto<?php echo $cod_producto;?>'>
    <input type='hidden' value='<?php echo $precio_compra_producto;?>' id='precio_compra_producto<?php echo $cod_producto;?>'>
    <input type='hidden' value='<?php echo $precio_venta_producto;?>' id='precio_venta_producto<?php echo $cod_producto;?>'>
    <input type='hidden' value='<?php echo $precio_venta_producto2;?>' id='precio_venta_producto2<?php echo $cod_producto;?>'>
    <input type='hidden' value='<?php echo $precio_venta_producto3;?>' id='precio_venta_producto3<?php echo $cod_producto;?>'>
    <input type='hidden' value='<?php echo $url_img_producto_min;?>' id='url_img_producto_min<?php echo $cod_producto;?>'>
    <input type='hidden' value='<?php echo $url_img_producto_orig;?>' id='url_img_producto_orig<?php echo $cod_producto;?>'>
    <input type='hidden' value='<?php echo $detalle_producto;?>' id='detalle_producto<?php echo $cod_producto;?>'>
    <input type='hidden' value='<?php echo $descripcion_producto;?>' id='descripcion_producto<?php echo $cod_producto;?>'>
    <input type='hidden' value='<?php echo $url_pagina_descripcion;?>' id='url_pagina_descripcion<?php echo $cod_producto;?>'>
    <input type='hidden' value='<?php echo $codificacion;?>' id='codificacion<?php echo $cod_producto;?>'>
    <input type='hidden' value='<?php echo $nombre_estado;?>' id='nombre_estado<?php echo $cod_producto;?>'>

    <tr class="even pointer">
        <?php if ($url_img_producto_orig == '') { ?>
        <td style="text-align:center"><a href="../admin/edit_cargar_foto_producto.php?cod_producto_codifcryp=<?php echo $cod_producto_codifcryp?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/img_nodisponible.png" class="img-polaroid" alt=""></a></td>
        <?php } else { ?>
        <td style="text-align:center"><a href="../admin/edit_cargar_foto_producto.php?cod_producto_codifcryp=<?php echo $cod_producto_codifcryp?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/img_disponible.png" class="img-polaroid" alt=""></a></td>
        <?php } ?>
        <td style="text-align:left"><?php echo $cod_producto_barra?></td>
        <td style="text-align:left"><?php echo $nombre_producto?></td>
        <td style="text-align:right"><?php echo number_format($precio_venta_producto, 0, ",", ".")?></td>
        <td style="text-align:center"><?php echo $nombre_estado?></td>
        <td style="text-align:center"><?php echo $cod_producto?></td>
        <td style="text-align:center"><a href="../admin/edit_producto.php?cod_producto_codifcryp=<?php echo $cod_producto_codifcryp?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/editar.png" class="img-polaroid" alt=""></a></td>
        <td style="text-align:center"><a class="btn btn-sm btn-danger" id="cod_producto" data-id="<?php echo $cod_producto; ?>|<?php echo $nombre_producto; ?>|<?php echo $cod_producto_barra; ?>|<?php echo $action; ?>|<?php echo $pagina_paginacion; ?>|<?php echo $busqueda_ajax; ?>|<?php echo $numero_registro_por_pagina; ?>|<?php echo $buscar_por; ?>" href="javascript:void(0)"><i class="glyphicon glyphicon-trash"></i></a></td>
    </tr>
<?php } //end while ?>
<tr>
<td colspan="12"><span class="pull-right"><?php echo paginador_clase($recargar_pagina, $pagina_paginacion, $total_paginas, $adyacentes);?></span></td>
</tr>
</table>
            </div>
            <?php } else { ?> 
            <div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Aviso!</strong> No hay datos para mostrar</div>
        <?php
        }
    }
?>