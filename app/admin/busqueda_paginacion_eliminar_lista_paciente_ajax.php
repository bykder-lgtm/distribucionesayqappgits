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

$pagina                   = $concatenador."eliminar_lista_paciente.php";
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
     //$tabla_codifcryp                = strip_tags($_REQUEST['tabla_codifcryp']);
     //$tabla_codif                   = DAXCODIFCRYPTOR::descriptardax($tabla_codifcryp);
     //$tabla                         = addslashes(DAXCODIFCRYPTOR::descodiftextodax($tabla_codif));
     //$pagina_codifcryp               = $_REQUEST['pagina_codifcryp'];
     //$pagina_codif                   = DAXCODIFCRYPTOR::descriptardax($pagina_codifcryp);
     //$pagina                         = addslashes(DAXCODIFCRYPTOR::descodiftextodax($pagina_codif));
     
     $sTable = "tbl15_entidad RIGHT JOIN tbl15_cliente ON tbl15_entidad.cod_entidad = tbl15_cliente.cod_entidad";

     if ($buscar_por=='nombres_apellidos') { $columnas_busqueda = array('tbl15_cliente.nombres', 'tbl15_cliente.apellido1'); } 
     elseif ($buscar_por=='cedula') { $columnas_busqueda = array('tbl15_cliente.cedula'); } 
     elseif ($buscar_por=='cod_cliente') { $columnas_busqueda = array('tbl15_cliente.cod_cliente'); }
     else {  }

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

if ($_REQUEST['busqueda_ajax'] == "") { $sWhere.=" ORDER BY tbl15_cliente.fecha_time DESC"; } else { $sWhere.=" ORDER BY tbl15_cliente.fecha_time DESC"; }
include '../ajax/pagination.php'; //include pagination file
//pagination variables
$pagina_paginacion               = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
$numero_registro_por_pagina      = $registro_por_pagina; //cuantos registros quieres mostrar
$adyacentes                      = 4; //espacio entre páginas después del número de adyacentes
//if (isset($_REQUEST['inicio_pagina'])) { $inicio_pagina = intval($_REQUEST['inicio_pagina']); } else { $inicio_pagina = ($pagina_paginacion - 1) * $numero_registro_por_pagina; }
$inicio_pagina                   = ($pagina_paginacion - 1) * $numero_registro_por_pagina;
//Cuente el número total de filas en su tabla*/
$consulta_recuento               = mysqli_query($conectar, "SELECT count(*) AS numrows FROM $sTable $sWhere");
$row                             = mysqli_fetch_array($consulta_recuento);
$numero_datos                    = $row['numrows'];
$total_paginas                   = ceil($numero_datos/$numero_registro_por_pagina);
$recargar_pagina                 = '../admin/eliminar_lista_paciente.php';
//recorrer los datos recuperados
if ($numero_datos>0) { ?>
<table class="table table-striped jambo_table bulk_action">
<thead>
<tr class="headings">
<th style="text-align:center" class="column-title">Elim</th>
<th style="text-align:center" class="column-title">Cedula</th>
<th style="text-align:center" class="column-title">Nombres</th>
<th style="text-align:center" class="column-title">Entidad</th>
<th style="text-align:center" class="column-title">Telefono</th>
<th style="text-align:center" class="column-title">Correo</th>
<th style="text-align:center" class="column-title">Direccion</th>
<th style="text-align:center" class="column-title">Cod</th>
</tr>
</thead>
<tbody>
<?php
$fecha_hoy = time();
//main query to fetch the data
$sql_consulta = "SELECT tbl15_cliente.cod_cliente, tbl15_cliente.cod_entidad, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_cliente.apellido2, tbl15_cliente.fecha_nac_ymd, 
tbl15_cliente.fecha_nac_time, tbl15_cliente.lugar_nac, tbl15_cliente.nombre_raza, tbl15_cliente.lugar_residencia, tbl15_cliente.nombre_religion, tbl15_cliente.nombre_ocupacion, tbl15_cliente.nombre_estado_civil, 
tbl15_cliente.edad_anyo, tbl15_cliente.nombre_grupo_rh, tbl15_cliente.tel_cliente, tbl15_cliente.tel_contacto1, tbl15_cliente.nombre_contacto2, tbl15_cliente.tel_contacto2, tbl15_cliente.correo, 
tbl15_cliente.nombre_escolaridad, tbl15_cliente.fax, tbl15_cliente.direccion, tbl15_cliente.nombre_ciudad, tbl15_cliente.nombre_pais, tbl15_entidad.nombre_entidad,
tbl15_cliente.nombre_tipo_doc, tbl15_cliente.nombre_sexo, tbl15_cliente.nombre_estrato, tbl15_cliente.nombre_tipo_regimen, 
tbl15_cliente.nombre_fondo_pension, tbl15_cliente.nombre_arl, tbl15_cliente.nombre_contacto1, tbl15_cliente.parentesco_contacto1, 
tbl15_cliente.tel_contacto1, tbl15_cliente.tel_contacto1, tbl15_cliente.direccion_contacto1 
FROM $sTable $sWhere LIMIT $inicio_pagina, $numero_registro_por_pagina";
$query_consulta = mysqli_query($conectar, $sql_consulta);
while ($datos_consulta = mysqli_fetch_array($query_consulta)) {

$cod_cliente                    = $datos_consulta['cod_cliente'];
$cod_cliente_codif              = DAXCODIFCRYPTOR::encodifdax($cod_cliente);
$cod_cliente_codifcryp          = DAXCODIFCRYPTOR::encriptardax($cod_cliente_codif);
$cod_entidad                    = $datos_consulta['cod_entidad'];
$cedula                         = $datos_consulta['cedula'];
$nombres                        = $datos_consulta['nombres'];
$apellido1                      = $datos_consulta['apellido1'];
$apellido2                      = $datos_consulta['apellido2'];
$fecha_nac_ymd                  = $datos_consulta['fecha_nac_ymd'];
$fecha_nac_time                 = $datos_consulta['fecha_nac_time'];
$lugar_nac                      = $datos_consulta['lugar_nac'];
$lugar_residencia               = $datos_consulta['lugar_residencia'];
$nombre_raza                    = $datos_consulta['nombre_raza'];
$nombre_religion                = $datos_consulta['nombre_religion'];
$nombre_ocupacion               = $datos_consulta['nombre_ocupacion'];
$nombre_estado_civil            = $datos_consulta['nombre_estado_civil'];
$nombre_grupo_rh                = $datos_consulta['nombre_grupo_rh'];
$nombre_escolaridad             = $datos_consulta['nombre_escolaridad'];
$edad_anyo                      = $datos_consulta['edad_anyo'];
$tel_cliente                    = $datos_consulta['tel_cliente'];
$nombre_contacto2               = $datos_consulta['nombre_contacto2'];
$nombre_ciudad                  = $datos_consulta['nombre_ciudad'];
$nombre_entidad                 = $datos_consulta['nombre_entidad'];
$correo                         = $datos_consulta['correo'];
$direccion                      = $datos_consulta['direccion'];
$nombre_tipo_doc                = $datos_consulta['nombre_tipo_doc'];
$nombre_sexo                    = $datos_consulta['nombre_sexo'];
$nombre_estrato                 = $datos_consulta['nombre_estrato'];
$nombre_tipo_regimen            = $datos_consulta['nombre_tipo_regimen'];
$nombre_fondo_pension           = $datos_consulta['nombre_fondo_pension'];
$nombre_arl                     = $datos_consulta['nombre_arl'];
$nombre_contacto1               = $datos_consulta['nombre_contacto1'];
$parentesco_contacto1           = $datos_consulta['parentesco_contacto1'];
$tel_contacto1                  = $datos_consulta['tel_contacto1'];
$direccion_contacto1            = $datos_consulta['direccion_contacto1'];
$nombres_apellidos              = $nombres.' '.$apellido1.' '.$apellido2;
?>
<tr class="even pointer">
<td style="text-align:center"><a class="btn btn-sm btn-danger" id="cod_concatenado" data-id="<?php echo $cod_cliente; ?>|<?php echo $nombres_apellidos; ?>|<?php echo $cedula; ?>|<?php echo $action; ?>|<?php echo $pagina_paginacion; ?>|<?php echo $busqueda_ajax; ?>|<?php echo $numero_registro_por_pagina; ?>|<?php echo $buscar_por; ?>" href="javascript:void(0)"><img src="../imagenes/eliminar.png" alt=""></a></td>
<td style="text-align:center"><?php echo $cedula?></td>
<td style="text-align:left"><?php echo $nombres_apellidos?></td>
<td style="text-align:center"><?php echo $nombre_entidad?></td>
<td style="text-align:right"><?php echo $tel_cliente?></td>
<td style="text-align:left"><?php echo $correo?></td>
<td style="text-align:left"><?php echo $direccion?></td>
<td style="text-align:center"><?php echo $cod_cliente?></td>
<!--<td style="text-align:center"><a href="#" class='' title='Borrar paciente' onclick="eliminar_datos_modal('<?php echo $cod_cliente; ?>|<?php echo $nombres_apellidos; ?>|<?php echo $cedula; ?>|<?php echo $inicio_pagina; ?>')"><img src="../imagenes/eliminar.png" class="img-polaroid" alt=""></a></span></td>-->
</tr>
<?php } //end while ?>
<tr>
<td colspan="12"><span class="pull-right"><?php echo paginate($recargar_pagina, $pagina_paginacion, $total_paginas, $adyacentes);?></span></td>
</tr>
</table>
            </div>
            <?php } else { ?> 
            <div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Aviso!</strong> No hay datos para mostrar</div>
        <?php
        }
    }
?>