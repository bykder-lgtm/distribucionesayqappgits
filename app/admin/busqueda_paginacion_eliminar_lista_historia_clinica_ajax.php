<?php
include_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
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

$pagina                   = $concatenador."eliminar_lista_historia_clinica_individual.php";
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
     $busqueda_ajax = mysqli_real_escape_string($conectar,(strip_tags($_REQUEST['busqueda_ajax'], ENT_QUOTES)));
     $registro_por_pagina = intval($_REQUEST['numero_registro_por_pagina']);
     $buscar_por = mysqli_real_escape_string($conectar,(strip_tags($_REQUEST['buscar_por'], ENT_QUOTES)));
     
     $sTable = "tbl15_tipo_historia_clinica RIGHT JOIN (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_historia_clinica ON tbl15_administrador.cod_administrador = tbl15_historia_clinica.cod_administrador) ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) ON tbl15_tipo_historia_clinica.cod_tipo_historia_clinica = tbl15_historia_clinica.cod_tipo_historia_clinica";

     if ($buscar_por=='nombres_apellidos') { $columnas_busqueda = array('tbl15_cliente.nombres', 'tbl15_cliente.apellido1'); } 
     elseif ($buscar_por=='cedula') { $columnas_busqueda = array('tbl15_cliente.cedula'); } 
     elseif ($buscar_por=='motivo') { $columnas_busqueda = array('tbl15_historia_clinica.motivo'); }
     elseif ($buscar_por=='nombre_empresa') { $columnas_busqueda = array('tbl15_historia_clinica.nombre_empresa'); }
     elseif ($buscar_por=='fecha_ymd') { $columnas_busqueda = array('tbl15_historia_clinica.fecha_ymd'); }
     elseif ($buscar_por=='cod_historia_clinica') { $columnas_busqueda = array('tbl15_historia_clinica.cod_historia_clinica'); }
     else {  }
     

     $sWhere = "";
    if ( $_REQUEST['busqueda_ajax'] != "" ) {
        $sWhere = "WHERE (";
        for ( $i=0 ; $i<count($columnas_busqueda) ; $i++ ) {
            $sWhere .= $columnas_busqueda[$i]." LIKE '%".$busqueda_ajax."%' OR ";
        }
        $sWhere = substr_replace( $sWhere, "", -3 );
        $sWhere .= ')';
    }
if ($_REQUEST['busqueda_ajax'] == "") {
    $sWhere.=" WHERE (tbl15_historia_clinica.cod_estado_facturacion = '1') ORDER BY tbl15_historia_clinica.fecha_time DESC";
} else {
    $sWhere.=" AND (tbl15_historia_clinica.cod_estado_facturacion = '1') ORDER BY tbl15_historia_clinica.fecha_time DESC";
}
    include '../ajax/pagination.php'; //include pagination file
    //pagination variables
    $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
    $pagina_paginacion               = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
    $numero_registro_por_pagina      = $registro_por_pagina; //how much records you want to show
    $adjacents                       = 4; //gap between pages after number of adjacents
    $inicio_pagina                   = ($pagina_paginacion - 1) * $numero_registro_por_pagina;
    //Count the total number of row in your table*/
    $consulta_recuento               = mysqli_query($conectar, "SELECT count(*) AS numrows FROM $sTable $sWhere");
    $row                             = mysqli_fetch_array($consulta_recuento);
    $numero_datos                    = $row['numrows'];
    $total_paginas                   = ceil($numero_datos/$numero_registro_por_pagina);
    $recargar_pagina                 = '../admin/eliminar_lista_historia_clinica_individual.php';
    //loop through fetched data
    if ($numero_datos>0) { ?>
<table class="table table-striped jambo_table bulk_action">
<thead>
<tr class="headings">
<th class="column-title">Elim</th>
<th class="column-title">HC</th>
<th class="column-title">Cedula</th>
<th class="column-title">Nombre Paciente</th>
<th class="column-title">Motivo</th>
<th class="column-title">Empresa Laborar</th>
<th class="column-title">Nombre Profesional</th>
<th class="column-title">Fecha</th>
<th class="column-title">Hora</th>
</tr>
</thead>
<tbody>
<?php
$fecha_hoy = time();
//main query to fetch the data
$sql_consulta = "SELECT tbl15_historia_clinica.cod_historia_clinica, tbl15_historia_clinica.cod_cliente, tbl15_historia_clinica.cod_administrador, 
tbl15_historia_clinica.cod_tipo_historia_clinica, tbl15_historia_clinica.cod_estado_facturacion, 
tbl15_historia_clinica.motivo, tbl15_historia_clinica.url_img_firma_min, tbl15_historia_clinica.url_img_firma_orig, 
tbl15_historia_clinica.url_img_foto_min, tbl15_historia_clinica.url_img_foto_orig, 
tbl15_historia_clinica.fecha_time, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_cliente.url_img_firma, tbl15_cliente.url_img_foto, tbl15_cliente.fecha_nac_time,
tbl15_cliente.apellido2, tbl15_administrador.cuenta, tbl15_administrador.nombres AS nombre_prof, tbl15_administrador.apellidos AS apellidos_prof, 
tbl15_tipo_historia_clinica.nombre_tipo_historia_clinica, tbl15_historia_clinica.nombre_empresa FROM $sTable $sWhere LIMIT $inicio_pagina,$numero_registro_por_pagina";
$query_consulta = mysqli_query($conectar, $sql_consulta);
while ($datos_consulta = mysqli_fetch_array($query_consulta)) {

$cod_historia_clinica            = $datos_consulta['cod_historia_clinica'];
$cod_cliente                     = $datos_consulta['cod_cliente'];
$cod_administrador_hist          = $datos_consulta['cod_administrador'];
$cedula                          = $datos_consulta['cedula'];
$nombres                         = $datos_consulta['nombres'];
$apellido1                       = $datos_consulta['apellido1'];
$apellido2                       = $datos_consulta['apellido2'];
$motivo                          = $datos_consulta['motivo'];
$nombre_prof                     = $datos_consulta['nombre_prof'];
$apellidos_prof                  = $datos_consulta['apellidos_prof'];
$nombre_tipo_historia_clinica    = $datos_consulta['nombre_tipo_historia_clinica'];
$url_img_firma_min               = $datos_consulta['url_img_firma_min'];
$url_img_firma_orig              = $datos_consulta['url_img_firma_orig'];
$url_img_foto_min                = $datos_consulta['url_img_foto_min'];
$url_img_foto_orig               = $datos_consulta['url_img_foto_orig'];
$url_img_firma                   = $datos_consulta['url_img_firma'];
$url_img_foto                    = $datos_consulta['url_img_foto'];
$nombre_empresa                  = $datos_consulta['nombre_empresa'];
$fecha_nac_time                  = $datos_consulta['fecha_nac_time'];
$diferencia_edad                 = abs($fecha_hoy - $fecha_nac_time);
$edad_anyo                       = floor($diferencia_edad / (365*60*60*24));
$fecha_time                      = $datos_consulta['fecha_time'];
$fecha_ymd                       = date("Y/m/d", $fecha_time);
$hora                            = date("H:i", $fecha_time);
$nombres_apellidos               = $nombres.' '.$apellido1.' '.$apellido2;
?>
<tr class="even pointer">
<td style="text-align:center"><a class="btn btn-sm btn-warning" id="cod_concatenado" data-id="<?php echo $cod_historia_clinica; ?>|<?php echo $nombres_apellidos; ?>|<?php echo $cedula; ?>|<?php echo $action; ?>|<?php echo $pagina_paginacion; ?>|<?php echo $busqueda_ajax; ?>|<?php echo $numero_registro_por_pagina; ?>|<?php echo $buscar_por; ?>" href="javascript:void(0)"><img src="../imagenes/eliminar.png" alt=""></a></td>
<td align="center"><?php echo $cod_historia_clinica?></td>
<td><?php echo $cedula?></td>
<td><?php echo $nombres_apellidos?></td>
<td><?php echo $motivo?></td>
<td><?php echo $nombre_empresa?></td>
<td><?php echo $nombre_prof.' '.$apellidos_prof?></td>
<td><?php echo $fecha_ymd?></td>
<td><?php echo $hora?></td>
</tr>
<?php } //end while ?>
<tr>
<td colspan=6><span class="pull-right"><?php echo paginate($recargar_pagina, $page, $total_paginas, $adjacents);?></span></td>
</tr>
</table>
            </div>
            <?php } else { ?> 
            <div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Aviso!</strong> No hay datos para mostrar</div>
        <?php    
        }
    }
?>