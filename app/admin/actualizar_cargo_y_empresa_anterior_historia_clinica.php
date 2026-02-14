<?php
if (isset($_REQUEST['cod_grupo_area_cargo'])) {
include_once('../conexiones/conexione.php'); 
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include ("../session/funciones_admin.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
    } else { header("Location:../index.php");
}

$cod_historia_clinica_anterior            = intval($_REQUEST['cod_historia_clinica_anterior']);
$cod_historia_clinica                     = intval($_REQUEST['cod_historia_clinica']);
$cod_cliente                              = intval($_REQUEST['cod_cliente']);
$cod_grupo_area_cargo                     = intval($_REQUEST['cod_grupo_area_cargo']);
$cod_grupo_area_cargo_anterior            = intval($_REQUEST['cod_grupo_area_cargo_anterior']);
$nombre_empresa_anterior                  = addslashes($_REQUEST['nombre_empresa_anterior']);
$pagina_simple                            = addslashes($_REQUEST['pagina']);
$clasrieg_carg2                           = $nombre_empresa_anterior;

$pagina = $pagina_simple."?cod_historia_clinica=".$cod_historia_clinica."&cod_cliente=".$cod_cliente."&pagina=".$pagina_simple;
/* -------------------------------------------------------------------------------------------------------------- */
/* -------------------------------------------------------------------------------------------------------------- */
$sql_grupo_area_cargo = "SELECT * FROM tbl15_grupo_area_cargo WHERE cod_grupo_area_cargo = '$cod_grupo_area_cargo'";
$consulta_grupo_area_cargo = mysqli_query($conectar, $sql_grupo_area_cargo);
$datos_grupo_area_cargo = mysqli_fetch_assoc($consulta_grupo_area_cargo);

$nombre_grupo_area_cargo        = $datos_grupo_area_cargo['nombre_grupo_area_cargo'];
$clasrieg_fis1_ruid             = $datos_grupo_area_cargo['clasrieg_fis1_ruid'];
$clasrieg_fis1_ilum             = $datos_grupo_area_cargo['clasrieg_fis1_ilum'];
$clasrieg_fis1_noionic          = $datos_grupo_area_cargo['clasrieg_fis1_noionic'];
$clasrieg_fis1_vibra            = $datos_grupo_area_cargo['clasrieg_fis1_vibra'];
$clasrieg_fis1_tempextrem       = $datos_grupo_area_cargo['clasrieg_fis1_tempextrem'];
$clasrieg_fis1_cambpres         = $datos_grupo_area_cargo['clasrieg_fis1_cambpres'];
$clasrieg_quim1_gasvapor        = $datos_grupo_area_cargo['clasrieg_quim1_gasvapor'];
$clasrieg_quim1_aeroliq         = $datos_grupo_area_cargo['clasrieg_quim1_aeroliq'];
$clasrieg_quim1_solid           = $datos_grupo_area_cargo['clasrieg_quim1_solid'];
$clasrieg_quim1_liquid          = $datos_grupo_area_cargo['clasrieg_quim1_liquid'];
$clasrieg_biolog1_viru          = $datos_grupo_area_cargo['clasrieg_biolog1_viru'];
$clasrieg_biolog1_bacter        = $datos_grupo_area_cargo['clasrieg_biolog1_bacter'];
$clasrieg_biolog1_parasi        = $datos_grupo_area_cargo['clasrieg_biolog1_parasi'];
$clasrieg_biolog1_morde         = $datos_grupo_area_cargo['clasrieg_biolog1_morde'];
$clasrieg_biolog1_picad         = $datos_grupo_area_cargo['clasrieg_biolog1_picad'];
$clasrieg_biolog1_hongo         = $datos_grupo_area_cargo['clasrieg_biolog1_hongo'];
$clasrieg_ergo1_trabestat       = $datos_grupo_area_cargo['clasrieg_ergo1_trabestat'];
$clasrieg_ergo1_esfuerfis       = $datos_grupo_area_cargo['clasrieg_ergo1_esfuerfis'];
$clasrieg_ergo1_carga           = $datos_grupo_area_cargo['clasrieg_ergo1_carga'];
$clasrieg_ergo1_postforz        = $datos_grupo_area_cargo['clasrieg_ergo1_postforz'];
$clasrieg_ergo1_movrepet        = $datos_grupo_area_cargo['clasrieg_ergo1_movrepet'];
$clasrieg_ergo1_jortrab         = $datos_grupo_area_cargo['clasrieg_ergo1_jortrab'];
$clasrieg_psi1_monoto           = $datos_grupo_area_cargo['clasrieg_psi1_monoto'];
$clasrieg_psi1_relhuman         = $datos_grupo_area_cargo['clasrieg_psi1_relhuman'];
$clasrieg_psi1_contentarea      = $datos_grupo_area_cargo['clasrieg_psi1_contentarea'];
$clasrieg_psi1_orgtiemptrab     = $datos_grupo_area_cargo['clasrieg_psi1_orgtiemptrab'];
$clasrieg_segur1_mecanic        = $datos_grupo_area_cargo['clasrieg_segur1_mecanic'];
$clasrieg_segur1_electri        = $datos_grupo_area_cargo['clasrieg_segur1_electri'];
$clasrieg_segur1_locat          = $datos_grupo_area_cargo['clasrieg_segur1_locat'];
$clasrieg_segur1_fisiquim       = $datos_grupo_area_cargo['clasrieg_segur1_fisiquim'];
$clasrieg_segur1_public         = $datos_grupo_area_cargo['clasrieg_segur1_public'];
$clasrieg_segur1_espconfi       = $datos_grupo_area_cargo['clasrieg_segur1_espconfi'];
$clasrieg_segur1_trabaltura     = $datos_grupo_area_cargo['clasrieg_segur1_trabaltura'];
$clasrieg_observ1_otro          = $datos_grupo_area_cargo['clasrieg_observ1_otro'];

$data_sql = ("UPDATE tbl15_historia_clinica SET cod_grupo_area_cargo = '$cod_grupo_area_cargo', clasrieg_carg2 = '$clasrieg_carg2',
clasrieg_fis2_ruid = '$clasrieg_fis1_ruid', clasrieg_fis2_ilum = '$clasrieg_fis1_ilum', 
clasrieg_fis2_noionic = '$clasrieg_fis1_noionic', clasrieg_fis2_vibra = '$clasrieg_fis1_vibra', 
clasrieg_fis2_tempextrem = '$clasrieg_fis1_tempextrem', clasrieg_fis2_cambpres = '$clasrieg_fis1_cambpres', 
clasrieg_quim2_gasvapor = '$clasrieg_quim1_gasvapor', clasrieg_quim2_aeroliq = '$clasrieg_quim1_aeroliq', 
clasrieg_quim2_solid = '$clasrieg_quim1_solid', clasrieg_quim2_liquid = '$clasrieg_quim1_liquid', 
clasrieg_biolog2_viru = '$clasrieg_biolog1_viru', clasrieg_biolog2_bacter = '$clasrieg_biolog1_bacter', 
clasrieg_biolog2_parasi = '$clasrieg_biolog1_parasi', clasrieg_biolog2_morde = '$clasrieg_biolog1_morde', 
clasrieg_biolog2_picad = '$clasrieg_biolog1_picad', clasrieg_biolog2_hongo = '$clasrieg_biolog1_hongo', 
clasrieg_ergo2_trabestat = '$clasrieg_ergo1_trabestat', clasrieg_ergo2_esfuerfis = '$clasrieg_ergo1_esfuerfis', 
clasrieg_ergo2_carga = '$clasrieg_ergo1_carga', clasrieg_ergo2_postforz = '$clasrieg_ergo1_postforz', 
clasrieg_ergo2_movrepet = '$clasrieg_ergo1_movrepet', clasrieg_ergo2_jortrab = '$clasrieg_ergo1_jortrab', 
clasrieg_psi2_monoto = '$clasrieg_psi1_monoto', clasrieg_psi2_relhuman = '$clasrieg_psi1_relhuman', 
clasrieg_psi2_contentarea = '$clasrieg_psi1_contentarea', clasrieg_psi2_orgtiemptrab = '$clasrieg_psi1_orgtiemptrab', 
clasrieg_segur2_mecanic = '$clasrieg_segur1_mecanic', clasrieg_segur2_electri = '$clasrieg_segur1_electri', 
clasrieg_segur2_locat = '$clasrieg_segur1_locat', clasrieg_segur2_fisiquim = '$clasrieg_segur1_fisiquim', 
clasrieg_segur2_public = '$clasrieg_segur1_public', clasrieg_segur2_espconfi = '$clasrieg_segur1_espconfi', 
clasrieg_segur2_trabaltura = '$clasrieg_segur1_trabaltura', clasrieg_observ2_otro = '$clasrieg_observ1_otro' 
WHERE cod_historia_clinica = '$cod_historia_clinica'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0.1; <?php echo $pagina?>">
<?php } ?>