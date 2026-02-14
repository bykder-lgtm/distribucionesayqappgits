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

$pagina                   = $concatenador."lista_crear_nuevo_registro.php?tabla=tbl15_remision";
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
     $busqueda_ajax         = mysqli_real_escape_string($conectar,(strip_tags($_REQUEST['busqueda_ajax'], ENT_QUOTES)));
     $tabla                 = mysqli_real_escape_string($conectar,(strip_tags($_REQUEST['tabla'], ENT_QUOTES)));
     $boton_registrar       = mysqli_real_escape_string($conectar,(strip_tags($_REQUEST['boton_registrar'], ENT_QUOTES)));
     $texto_enunciado       = mysqli_real_escape_string($conectar,(strip_tags($_REQUEST['texto_enunciado'], ENT_QUOTES)));
     
     $sTable = "(tbl15_cliente LEFT JOIN tbl15_historia_clinica ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente)";

     $aColumns = array('tbl15_cliente.cedula', 'tbl15_cliente.nombres', 'tbl15_cliente.apellido1'); //Columnas de busqueda

     $sWhere = "";
    if ( $_GET['busqueda_ajax'] != "" ) {
        $sWhere = "WHERE (";
        for ( $i=0 ; $i<count($aColumns) ; $i++ ) {
            $sWhere .= $aColumns[$i]." LIKE '%".$busqueda_ajax."%' OR ";
        }
        $sWhere = substr_replace( $sWhere, "", -3 );
        $sWhere .= ')';
    }
if ($_GET['busqueda_ajax'] == "") {
    $sWhere.=" ORDER BY tbl15_historia_clinica.fecha_reg_time DESC";
} else {
    $sWhere.=" ORDER BY tbl15_historia_clinica.fecha_reg_time DESC";
}
    include '../ajax/pagination.php'; //include pagination file
    //pagination variables
    $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
    $per_page = 70; //how much records you want to show
    $adjacents  = 4; //gap between pages after number of adjacents
    $registro_inicio = ($page - 1) * $per_page;
    //Count the total number of row in your table*/
    $count_query   = mysqli_query($conectar, "SELECT count(*) AS numrows FROM $sTable $sWhere");
    $row = mysqli_fetch_array($count_query);
    $numrows = $row['numrows'];
    $total_pages = ceil($numrows/$per_page);
    $reload = '../admin/lista_crear_nuevo_registro.php';
    //loop through fetched data
    if ($numrows>0) { ?>
<table class="table table-striped jambo_table bulk_action">
<thead>
<tr class="headings">
<th class="column-title">Crear</th>
<th class="column-title">Cedula</th>
<th class="column-title">Nombres y Apellidos</th>
<th class="column-title">Teléfono</th>
<th class="column-title">Correo</th>
<th class="column-title">Dirección</th>
</tr>
</thead>
<tbody>
<?php
$fecha_hoy = time();
//main query to fetch the data
$sql_consulta = "SELECT tbl15_cliente.cod_cliente, tbl15_historia_clinica.cod_historia_clinica, tbl15_cliente.cedula, tbl15_cliente.nombres, 
tbl15_cliente.apellido1, tbl15_cliente.apellido2, tbl15_cliente.tel_cliente, tbl15_cliente.correo, tbl15_cliente.direccion, tbl15_historia_clinica.fecha_reg_time
FROM $sTable $sWhere LIMIT $registro_inicio,$per_page";
$query_consulta = mysqli_query($conectar, $sql_consulta);
while ($datos_consulta = mysqli_fetch_array($query_consulta)) {

$cod_cliente            = $datos_consulta['cod_cliente'];
$cedula                 = $datos_consulta['cedula'];
$nombres                = $datos_consulta['nombres'];
$apellido1              = $datos_consulta['apellido1'];
$apellido2              = $datos_consulta['apellido2'];
$tel_cliente            = $datos_consulta['tel_cliente'];
$correo                 = $datos_consulta['correo'];
$direccion              = $datos_consulta['direccion'];
?>
<tr class="even pointer">
<td style="text-align:center"><a href="../admin/lista_crear_nuevo_registro_reg.php?tabla=<?php echo $tabla?>&cod_cliente=<?php echo $cod_cliente?>&pagina=<?php echo $pagina ?>"><img src="<?php echo $boton_registrar ?>" class="img-polaroid" alt=""></a></td>
<td><?php echo $cedula?></td>
<td><?php echo $nombres.' '.$apellido1.' '.$apellido2?></td>
<td><?php echo $tel_cliente?></td>
<td><?php echo $correo?></td>
<td><?php echo $direccion?></td>
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