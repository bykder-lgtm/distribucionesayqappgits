<?php
include_once('../conexiones/conexione.php');
//----------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------//
$buscar = addslashes($_REQUEST['term']);

if($buscar <> NULL) {

$retorno_array = array();
$retorno_array2 = array();

$sql_grupo_area_cargo = "SELECT tbl15_grupo_area.nombre_grupo_area, tbl15_grupo_area_cargo.nombre_grupo_area_cargo, tbl15_grupo_area_cargo.cod_grupo_area_cargo, 
tbl15_grupo_area_cargo.cod_grupo_area, tbl15_grupo_area_cargo.clasrieg_fis1_ruid, tbl15_grupo_area_cargo.clasrieg_fis1_ilum, tbl15_grupo_area_cargo.clasrieg_fis1_noionic, 
tbl15_grupo_area_cargo.clasrieg_fis1_vibra, tbl15_grupo_area_cargo.clasrieg_fis1_tempextrem, tbl15_grupo_area_cargo.clasrieg_fis1_cambpres, 
tbl15_grupo_area_cargo.clasrieg_quim1_gasvapor, tbl15_grupo_area_cargo.clasrieg_quim1_aeroliq, tbl15_grupo_area_cargo.clasrieg_quim1_solid, 
tbl15_grupo_area_cargo.clasrieg_quim1_liquid, tbl15_grupo_area_cargo.clasrieg_biolog1_viru, tbl15_grupo_area_cargo.clasrieg_biolog1_bacter, 
tbl15_grupo_area_cargo.clasrieg_biolog1_parasi, tbl15_grupo_area_cargo.clasrieg_biolog1_morde, tbl15_grupo_area_cargo.clasrieg_biolog1_picad, 
tbl15_grupo_area_cargo.clasrieg_biolog1_hongo, tbl15_grupo_area_cargo.clasrieg_ergo1_trabestat, tbl15_grupo_area_cargo.clasrieg_ergo1_esfuerfis, 
tbl15_grupo_area_cargo.clasrieg_ergo1_carga, tbl15_grupo_area_cargo.clasrieg_ergo1_postforz, tbl15_grupo_area_cargo.clasrieg_ergo1_movrepet, 
tbl15_grupo_area_cargo.clasrieg_ergo1_jortrab, tbl15_grupo_area_cargo.clasrieg_psi1_monoto, tbl15_grupo_area_cargo.clasrieg_psi1_relhuman, 
tbl15_grupo_area_cargo.clasrieg_psi1_contentarea, tbl15_grupo_area_cargo.clasrieg_psi1_orgtiemptrab, tbl15_grupo_area_cargo.clasrieg_segur1_mecanic, 
tbl15_grupo_area_cargo.clasrieg_segur1_electri, tbl15_grupo_area_cargo.clasrieg_segur1_locat, tbl15_grupo_area_cargo.clasrieg_segur1_fisiquim, 
tbl15_grupo_area_cargo.clasrieg_segur1_public, tbl15_grupo_area_cargo.clasrieg_segur1_espconfi, tbl15_grupo_area_cargo.clasrieg_segur1_trabaltura, 
tbl15_grupo_area_cargo.clasrieg_observ1_otro, 
tbl15_grupo_area_cargo.clasrieg_segur1_sismo, tbl15_grupo_area_cargo.clasrieg_segur1_delincuenciacomun, tbl15_grupo_area_cargo.clasrieg_segur1_accitransito, 
tbl15_grupo_area_cargo.clasrieg_segur1_caidaobjetos, tbl15_grupo_area_cargo.clasrieg_segur1_puestotrabdesorden, 
tbl15_grupo_area_cargo.dat_ocupa_visu1, tbl15_grupo_area_cargo.dat_ocupa_audi1, tbl15_grupo_area_cargo.dat_ocupa_resp1, 
tbl15_grupo_area_cargo.dat_ocupa_cabeza1, tbl15_grupo_area_cargo.dat_ocupa_manos1, tbl15_grupo_area_cargo.dat_ocupa_tronco1, 
tbl15_grupo_area_cargo.dat_ocupa_pies1, tbl15_grupo_area_cargo.dat_ocupa_altu1 
FROM tbl15_grupo_area RIGHT JOIN tbl15_grupo_area_cargo ON tbl15_grupo_area.cod_grupo_area = tbl15_grupo_area_cargo.cod_grupo_area
WHERE (tbl15_grupo_area.nombre_grupo_area LIKE '%$buscar%') OR (tbl15_grupo_area_cargo.nombre_grupo_area_cargo LIKE '%$buscar%')";
$consulta_grupo_area_cargo = mysqli_query($conectar, $sql_grupo_area_cargo);
$total_resul = mysqli_num_rows($consulta_grupo_area_cargo);

while ($datos_grupo_area_cargo = mysqli_fetch_assoc($consulta_grupo_area_cargo)) {
$cod_grupo_area_cargo                                 = $datos_grupo_area_cargo['cod_grupo_area_cargo'];
$nombre_grupo_area                                    = $datos_grupo_area_cargo['nombre_grupo_area'];
$nombre_grupo_area_cargo                              = $datos_grupo_area_cargo['nombre_grupo_area_cargo'];
$datos_array['id']                                    = $cod_grupo_area_cargo;
$datos_array['value']                                 = $nombre_grupo_area." | ".$nombre_grupo_area_cargo;
$datos_array['cod_grupo_area_cargo']                  = $cod_grupo_area_cargo;
$datos_array['nombre_grupo_area_cargo']               = $nombre_grupo_area_cargo;
$datos_array['cod_grupo_area']                        = $datos_grupo_area_cargo['cod_grupo_area'];
$datos_array['clasrieg_fis1_ruid']                    = $datos_grupo_area_cargo['clasrieg_fis1_ruid'];
$datos_array['clasrieg_fis1_ilum']                    = $datos_grupo_area_cargo['clasrieg_fis1_ilum'];
$datos_array['clasrieg_fis1_noionic']                 = $datos_grupo_area_cargo['clasrieg_fis1_noionic'];
$datos_array['clasrieg_fis1_vibra']                   = $datos_grupo_area_cargo['clasrieg_fis1_vibra'];
$datos_array['clasrieg_fis1_tempextrem']              = $datos_grupo_area_cargo['clasrieg_fis1_tempextrem'];
$datos_array['clasrieg_fis1_cambpres']                = $datos_grupo_area_cargo['clasrieg_fis1_cambpres'];
$datos_array['clasrieg_quim1_gasvapor']               = $datos_grupo_area_cargo['clasrieg_quim1_gasvapor'];
$datos_array['clasrieg_quim1_aeroliq']                = $datos_grupo_area_cargo['clasrieg_quim1_aeroliq'];
$datos_array['clasrieg_quim1_solid']                  = $datos_grupo_area_cargo['clasrieg_quim1_solid'];
$datos_array['clasrieg_quim1_liquid']                 = $datos_grupo_area_cargo['clasrieg_quim1_liquid'];
$datos_array['clasrieg_biolog1_viru']                 = $datos_grupo_area_cargo['clasrieg_biolog1_viru'];
$datos_array['clasrieg_biolog1_bacter']               = $datos_grupo_area_cargo['clasrieg_biolog1_bacter'];
$datos_array['clasrieg_biolog1_parasi']               = $datos_grupo_area_cargo['clasrieg_biolog1_parasi'];
$datos_array['clasrieg_biolog1_morde']                = $datos_grupo_area_cargo['clasrieg_biolog1_morde'];
$datos_array['clasrieg_biolog1_picad']                = $datos_grupo_area_cargo['clasrieg_biolog1_picad'];
$datos_array['clasrieg_biolog1_hongo']                = $datos_grupo_area_cargo['clasrieg_biolog1_hongo'];
$datos_array['clasrieg_ergo1_trabestat']              = $datos_grupo_area_cargo['clasrieg_ergo1_trabestat'];
$datos_array['clasrieg_ergo1_esfuerfis']              = $datos_grupo_area_cargo['clasrieg_ergo1_esfuerfis'];
$datos_array['clasrieg_ergo1_carga']                  = $datos_grupo_area_cargo['clasrieg_ergo1_carga'];
$datos_array['clasrieg_ergo1_postforz']               = $datos_grupo_area_cargo['clasrieg_ergo1_postforz'];
$datos_array['clasrieg_ergo1_movrepet']               = $datos_grupo_area_cargo['clasrieg_ergo1_movrepet'];
$datos_array['clasrieg_ergo1_jortrab']                = $datos_grupo_area_cargo['clasrieg_ergo1_jortrab'];
$datos_array['clasrieg_psi1_monoto']                  = $datos_grupo_area_cargo['clasrieg_psi1_monoto'];
$datos_array['clasrieg_psi1_relhuman']                = $datos_grupo_area_cargo['clasrieg_psi1_relhuman'];
$datos_array['clasrieg_psi1_contentarea']             = $datos_grupo_area_cargo['clasrieg_psi1_contentarea'];
$datos_array['clasrieg_psi1_orgtiemptrab']            = $datos_grupo_area_cargo['clasrieg_psi1_orgtiemptrab'];
$datos_array['clasrieg_segur1_mecanic']               = $datos_grupo_area_cargo['clasrieg_segur1_mecanic'];
$datos_array['clasrieg_segur1_electri']               = $datos_grupo_area_cargo['clasrieg_segur1_electri'];
$datos_array['clasrieg_segur1_locat']                 = $datos_grupo_area_cargo['clasrieg_segur1_locat'];
$datos_array['clasrieg_segur1_fisiquim']              = $datos_grupo_area_cargo['clasrieg_segur1_fisiquim'];
$datos_array['clasrieg_segur1_public']                = $datos_grupo_area_cargo['clasrieg_segur1_public'];
$datos_array['clasrieg_segur1_espconfi']              = $datos_grupo_area_cargo['clasrieg_segur1_espconfi'];
$datos_array['clasrieg_segur1_trabaltura']            = $datos_grupo_area_cargo['clasrieg_segur1_trabaltura'];
$datos_array['clasrieg_observ1_otro']                 = $datos_grupo_area_cargo['clasrieg_observ1_otro'];
$datos_array['clasrieg_segur1_sismo']                 = $datos_grupo_area_cargo['clasrieg_segur1_sismo'];
$datos_array['clasrieg_segur1_delincuenciacomun']     = $datos_grupo_area_cargo['clasrieg_segur1_delincuenciacomun'];
$datos_array['clasrieg_segur1_accitransito']          = $datos_grupo_area_cargo['clasrieg_segur1_accitransito'];
$datos_array['clasrieg_segur1_caidaobjetos']          = $datos_grupo_area_cargo['clasrieg_segur1_caidaobjetos'];
$datos_array['clasrieg_segur1_puestotrabdesorden']    = $datos_grupo_area_cargo['clasrieg_segur1_puestotrabdesorden'];
$datos_array['dat_ocupa_visu1']                       = $datos_grupo_area_cargo['dat_ocupa_visu1'];
$datos_array['dat_ocupa_audi1']                       = $datos_grupo_area_cargo['dat_ocupa_audi1'];
$datos_array['dat_ocupa_resp1']                       = $datos_grupo_area_cargo['dat_ocupa_resp1'];
$datos_array['dat_ocupa_cabeza1']                     = $datos_grupo_area_cargo['dat_ocupa_cabeza1'];
$datos_array['dat_ocupa_manos1']                      = $datos_grupo_area_cargo['dat_ocupa_manos1'];
$datos_array['dat_ocupa_tronco1']                     = $datos_grupo_area_cargo['dat_ocupa_tronco1'];
$datos_array['dat_ocupa_pies1']                       = $datos_grupo_area_cargo['dat_ocupa_pies1'];
$datos_array['dat_ocupa_altu1']                       = $datos_grupo_area_cargo['dat_ocupa_altu1'];

array_push($retorno_array, $datos_array);
}
echo json_encode($retorno_array);
} else { } ?>