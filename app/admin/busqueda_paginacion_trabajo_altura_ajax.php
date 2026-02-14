<?php
include_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
//include_once('../admin/fecha_en_espanol.php');
include_once("../session/funciones_admin.php");
//include("../tbl15_notificacion_alerta/mostrar_noficacion_alerta.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
  } else { header("Location:../index.php");
}
$pagina_complt            = $_SERVER['PHP_SELF'];
$fragm                    = explode("/", $pagina_complt);
$ultimo                   = end($fragm);
$total_elementos          = count($fragm) - 1;
$concatenador             = '';
foreach ($fragm as $key => $element) { if ($key <> $total_elementos) { $concatenador .= $element."/"; } }

$pagina                   = $concatenador."lista_manipulacion_alimento.php";
//---------------------------------------------------------------------------------------------------------------------------------//
$cuenta_actual      = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$cod_seguridad_des  = DAXCRYPTOR::descriptardax($_SESSION['cs_cryp']);

$cod_seguridad_codif = ($cod_seguridad_des);
$frag1 = str_split($cod_seguridad_codif);
$numero_de_digitos1 = $frag1[0];
if ($numero_de_digitos1 == 1) { $cod_seguridad = $frag1[5]; } 
if ($numero_de_digitos1 == 2) { $cod_seguridad = $frag1[5].$frag1[6]; } 
if ($numero_de_digitos1 == 3) { $cod_seguridad = $frag1[5].$frag1[6].$frag1[7]; } 
if ($numero_de_digitos1 == 4) { $cod_seguridad = $frag1[5].$frag1[6].$frag1[7].$frag1[8]; } 
if ($numero_de_digitos1 == 5) { $cod_seguridad = $frag1[5].$frag1[6].$frag1[7].$frag1[8].$frag1[9]; } 
if ($numero_de_digitos1 == 6) { $cod_seguridad = $frag1[5].$frag1[6].$frag1[7].$frag1[8].$frag1[9].$frag1[10]; } 
if ($numero_de_digitos1 == 7) { $cod_seguridad = $frag1[5].$frag1[6].$frag1[7].$frag1[8].$frag1[9].$frag1[10].$frag1[11]; }
if ($numero_de_digitos1 == 8) { $cod_seguridad = $frag1[5].$frag1[6].$frag1[7].$frag1[8].$frag1[9].$frag1[10].$frag1[11].$frag1[12]; }
if ($numero_de_digitos1 == 9) { $cod_seguridad = $frag1[5].$frag1[6].$frag1[7].$frag1[8].$frag1[9].$frag1[10].$frag1[11].$frag1[12].$frag1[13]; }
//---------------------------------------------------------------------------------------------------------------------------------//
    $action = (isset($_REQUEST['action']) && $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';

    if($action == 'ajax'){
    // escaping, additionally removing everything that could be (html/javascript-) code
     $busqueda_ajax = mysqli_real_escape_string($conectar,(strip_tags($_REQUEST['busqueda_ajax'], ENT_QUOTES)));
     $registro_por_pagina = intval($_REQUEST['numero_registro_por_pagina']);
     $buscar_por = mysqli_real_escape_string($conectar,(strip_tags($_REQUEST['buscar_por'], ENT_QUOTES)));

     $sTable = "tbl15_historia_clinica RIGHT JOIN (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_trabajo_altura ON tbl15_administrador.cod_administrador = tbl15_trabajo_altura.cod_administrador) ON tbl15_cliente.cod_cliente = tbl15_trabajo_altura.cod_cliente) ON tbl15_historia_clinica.cod_historia_clinica = tbl15_trabajo_altura.cod_historia_clinica";

     if ($buscar_por=='nombres_apellidos') { $columnas_busqueda = array('tbl15_cliente.nombres', 'tbl15_cliente.apellido1'); } 
     elseif ($buscar_por=='cedula') { $columnas_busqueda = array('tbl15_cliente.cedula'); } 
     elseif ($buscar_por=='motivo') { $columnas_busqueda = array('tbl15_trabajo_altura.motivo_trabajo_altura'); }
     elseif ($buscar_por=='nombre_empresa') { $columnas_busqueda = array('tbl15_trabajo_altura.nombre_empresa'); }
     elseif ($buscar_por=='fecha_ymd') { $columnas_busqueda = array('tbl15_trabajo_altura.fecha_ymd'); }
     elseif ($buscar_por=='cod_historia_clinica') { $columnas_busqueda = array('tbl15_trabajo_altura.cod_historia_clinica'); }
     elseif ($buscar_por=='cod_trabajo_altura') { $columnas_busqueda = array('tbl15_trabajo_altura.cod_trabajo_altura'); }
     else {  }

     $sWhere = "";
    if ( $_GET['busqueda_ajax'] != "" ) {
        $sWhere = "WHERE (";
        for ( $i=0 ; $i<count($columnas_busqueda) ; $i++ ) {
            $sWhere .= $columnas_busqueda[$i]." LIKE '%".$busqueda_ajax."%' OR ";
        }
        $sWhere = substr_replace( $sWhere, "", -3 );
        $sWhere .= ')';
    }
if ($_GET['busqueda_ajax'] == "") {
    $sWhere.=" ORDER BY tbl15_trabajo_altura.fecha_time DESC";
} else {
    $sWhere.=" ORDER BY tbl15_trabajo_altura.fecha_time DESC";
}
    include '../ajax/pagination.php'; //include pagination file
    //pagination variables
    $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
    $numero_registro_por_pagina = $registro_por_pagina; //how much records you want to show
    $adjacents  = 4; //gap between pages after number of adjacents
    $registro_inicio = ($page - 1) * $numero_registro_por_pagina;
    //Count the total number of row in your table*/
    $count_query   = mysqli_query($conectar, "SELECT count(*) AS numrows FROM $sTable $sWhere");
    $row = mysqli_fetch_array($count_query);
    $numrows = $row['numrows'];
    $total_pages = ceil($numrows/$numero_registro_por_pagina);
    $reload = '../admin/lista_manipulacion_alimento.php';
    //loop through fetched data
    if ($numrows>0) { ?>
<table class="table table-striped jambo_table bulk_action">
<thead>
<tr class="headings">
<th class="column-title">TBA</th>
<th class="column-title">Crear</th>
<th class="column-title">Cedula</th>
<th class="column-title">Nombre Paciente</th>
<th class="column-title">Motivo</th>
<th class="column-title">Nombre Profesional</th>
<th class="column-title">Fecha</th>
<th class="column-title">HC</th>
<th class="column-title">Imp</th>
<th class="column-title">Edit</th>
</tr>
</thead>
<tbody>
<?php
$fecha_hoy = time();
//main query to fetch the data
$sql_consulta = "SELECT tbl15_trabajo_altura.cod_trabajo_altura, tbl15_trabajo_altura.cod_historia_clinica, 
tbl15_trabajo_altura.cod_cliente, tbl15_trabajo_altura.cod_administrador, tbl15_trabajo_altura.motivo_trabajo_altura, 
tbl15_administrador.nombres AS nombre_prof, tbl15_administrador.apellidos AS apellidos_prof, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, 
tbl15_trabajo_altura.fecha_time, tbl15_cliente.url_img_foto_min, tbl15_cliente.url_img_firma_min 
FROM $sTable $sWhere LIMIT $registro_inicio,$numero_registro_por_pagina";
$query_consulta = mysqli_query($conectar, $sql_consulta);
while ($datos_consulta = mysqli_fetch_array($query_consulta)) {

$cod_trabajo_altura        = $datos_consulta['cod_trabajo_altura'];
$cod_historia_clinica      = $datos_consulta['cod_historia_clinica'];
$cod_cliente               = $datos_consulta['cod_cliente'];
$cod_administrador_hist    = $datos_consulta['cod_administrador'];
$cedula                    = $datos_consulta['cedula'];
$nombres                   = $datos_consulta['nombres'];
$apellido1                 = $datos_consulta['apellido1'];
$motivo_trabajo_altura     = $datos_consulta['motivo_trabajo_altura'];
$nombre_prof               = $datos_consulta['nombre_prof'];
$apellidos_prof            = $datos_consulta['apellidos_prof'];
$url_img_firma_min         = $datos_consulta['url_img_firma_min'];
$url_img_foto_min          = $datos_consulta['url_img_foto_min'];
$fecha_time                = $datos_consulta['fecha_time'];
$fecha_dmy                 = date("Y/m/d", $fecha_time);
$hora                      = date("H:i", $fecha_time);
?>
<tr class="even pointer">
<td align="center"><?php echo $cod_trabajo_altura?></td>
<td align="center"><a href="../admin/edit_trabajo_altura.php?cod_trabajo_altura=<?php echo $cod_trabajo_altura?>&cod_cliente=<?php echo $cod_cliente?>&cod_historia_clinica=<?php echo $cod_historia_clinica?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/tbl15_trabajo_altura.png" class="img-polaroid" alt=""></a></td>
<td><?php echo $cedula?></td>
<td><?php echo $nombres.' '.$apellido1?></td>
<td><?php echo $motivo_trabajo_altura?></td>
<td><?php echo $nombre_prof.' '.$apellidos_prof?></td>
<td><?php echo $fecha_dmy?></td>
<td><?php echo $cod_historia_clinica?></td>
<td align="center"><a href="../admin/ver_trabajo_altura_version_pdf.php?cod_trabajo_altura=<?php echo $cod_trabajo_altura?>&cod_cliente=<?php echo $cod_cliente?>&cod_historia_clinica=<?php echo $cod_historia_clinica?>" target="_blank"><img src="../imagenes/imprimir_peq.png" class="img-polaroid" alt=""></a></td>
<td align="center"><a href="../admin/edit_trabajo_altura.php?cod_trabajo_altura=<?php echo $cod_trabajo_altura?>&cod_cliente=<?php echo $cod_cliente?>&cod_historia_clinica=<?php echo $cod_historia_clinica?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/editar.png" class="img-polaroid" alt=""></a></td>
</tr>
<?php } //end while ?>
<tr>
<td colspan=6><span class="pull-right"><?php echo paginate($reload, $page, $total_pages, $adjacents);?></span></td>
</tr>
</table>
            </div>
            <?php } else { ?> 
            <div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Aviso!</strong> No hay datos para mostrar</div>
        <?php    
        }
    }
?>