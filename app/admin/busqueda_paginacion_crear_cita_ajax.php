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

$pagina                   = $concatenador."lista_crear_cita.php";
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
     
     $sTable = "tbl15_entidad RIGHT JOIN tbl15_cliente ON tbl15_entidad.cod_entidad = tbl15_cliente.cod_entidad";

     if ($buscar_por=='nombres_apellidos') { $columnas_busqueda = array('tbl15_cliente.nombres', 'tbl15_cliente.apellido1'); } 
     elseif ($buscar_por=='cedula') { $columnas_busqueda = array('tbl15_cliente.cedula'); } 
     elseif ($buscar_por=='cod_cliente') { $columnas_busqueda = array('tbl15_cliente.cod_cliente'); }
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
    $sWhere.=" ORDER BY tbl15_cliente.fecha_time DESC";
} else {
    $sWhere.=" ORDER BY tbl15_cliente.fecha_time DESC";
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
    $reload = '../admin/lista_historia_clinica_individual_medico.php';
    //loop through fetched data
    if ($numrows>0) { ?>
<table class="table table-striped jambo_table bulk_action">
<thead>
<tr class="headings">
<th class="column-title">ProgCita</th>
<th class="column-title">Cedula</th>
<th class="column-title">Nombres</th>
<th class="column-title">Apellidos</th>
<th class="column-title">Entidad</th>
<th class="column-title">Teléfono</th>
<th class="column-title">Correo</th>
<th class="column-title">Dirección</th>
<?php if (($cod_seguridad == 1) || ($cod_seguridad == 2)) { ?>
<th class="column-title">Edit</th>
<?php } else { } ?>
</tr>
</thead>
<tbody>
<?php
$fecha_hoy = time();
//main query to fetch the data
$sql_consulta = "SELECT tbl15_cliente.cod_cliente, tbl15_cliente.cod_entidad, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_cliente.apellido2, tbl15_cliente.fecha_nac_ymd, 
tbl15_cliente.fecha_nac_time, tbl15_cliente.lugar_nac, tbl15_cliente.nombre_raza, tbl15_cliente.lugar_residencia, tbl15_cliente.nombre_religion, tbl15_cliente.nombre_ocupacion, tbl15_cliente.nombre_estado_civil, 
tbl15_cliente.edad_anyo, tbl15_cliente.nombre_grupo_rh, tbl15_cliente.tel_cliente, tbl15_cliente.tel_contacto1, tbl15_cliente.nombre_contacto2, tbl15_cliente.tel_contacto2, tbl15_cliente.correo, 
tbl15_cliente.nombre_escolaridad, tbl15_cliente.fax, tbl15_cliente.direccion, tbl15_cliente.nombre_ciudad, tbl15_cliente.nombre_pais, tbl15_entidad.nombre_entidad 
FROM $sTable $sWhere LIMIT $registro_inicio,$numero_registro_por_pagina";
$query_consulta = mysqli_query($conectar, $sql_consulta);
while ($datos_consulta = mysqli_fetch_array($query_consulta)) {

$cod_cliente                     = $datos_consulta['cod_cliente'];
$cedula                          = $datos_consulta['cedula'];
$nombres                         = $datos_consulta['nombres'];
$apellido1                       = $datos_consulta['apellido1'];
$apellido2                       = $datos_consulta['apellido2'];
$nombre_entidad                  = $datos_consulta['nombre_entidad'];
$tel_cliente                     = $datos_consulta['tel_cliente'];
$correo                          = $datos_consulta['correo'];
$direccion                       = $datos_consulta['direccion'];
?>
<tr class="even pointer">
<td style="text-align:center"><a href="../admin/reg_asignar_profesional_paciente.php?cod_cliente=<?php echo $cod_cliente?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/btn_hc_cita.png" class="img-polaroid" alt=""></a></td>
<td><?php echo $cedula?></td>
<td><?php echo $nombres?></td>
<td><?php echo $apellido1.' '.$apellido2 ?></td>
<td><?php echo $nombre_entidad?></td>
<td><?php echo $tel_cliente?></td>
<td><?php echo $correo?></td>
<td><?php echo $direccion?></td>
<?php if (($cod_seguridad == 1) || ($cod_seguridad == 2)) { ?>
<td style="text-align:center"><a href="../admin/edit_paciente.php?cod_cliente=<?php echo $cod_cliente?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/editar.png" class="img-polaroid" alt=""></a></td>
<?php } else { } ?>
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