<?php
if (isset($_REQUEST['valor']) && isset($_REQUEST['id'])) {
include_once('../conexiones/conexione.php'); 
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");

$valor_intro                           = strtoupper(addslashes($_REQUEST['valor']));
$campo                                 = addslashes($_REQUEST['campo']);
$cod_grupo_area_cargo                  = intval($_REQUEST['id']);
$no                                    = "N";
$si                                    = "S";

$sql_cliente = "SELECT * FROM tbl15_grupo_area_cargo WHERE cod_grupo_area_cargo = '$cod_grupo_area_cargo'";
$consulta_cliente = mysqli_query($conectar, $sql_cliente) or die(mysqli_error($conectar));
$datos = mysqli_fetch_assoc($consulta_cliente);

$clasrieg_fis1_ruid                    = $datos['clasrieg_fis1_ruid'];
$clasrieg_fis1_ilum                    = $datos['clasrieg_fis1_ilum'];
$clasrieg_fis1_noionic                 = $datos['clasrieg_fis1_noionic'];
$clasrieg_fis1_vibra                   = $datos['clasrieg_fis1_vibra'];
$clasrieg_fis1_tempextrem              = $datos['clasrieg_fis1_tempextrem'];
$clasrieg_fis1_cambpres                = $datos['clasrieg_fis1_cambpres'];
$clasrieg_quim1_gasvapor               = $datos['clasrieg_quim1_gasvapor'];
$clasrieg_quim1_aeroliq                = $datos['clasrieg_quim1_aeroliq'];
$clasrieg_quim1_solid                  = $datos['clasrieg_quim1_solid'];
$clasrieg_quim1_liquid                 = $datos['clasrieg_quim1_liquid'];
$clasrieg_biolog1_viru                 = $datos['clasrieg_biolog1_viru'];
$clasrieg_biolog1_bacter               = $datos['clasrieg_biolog1_bacter'];
$clasrieg_biolog1_parasi               = $datos['clasrieg_biolog1_parasi'];
$clasrieg_biolog1_morde                = $datos['clasrieg_biolog1_morde'];
$clasrieg_biolog1_picad                = $datos['clasrieg_biolog1_picad'];
$clasrieg_biolog1_hongo                = $datos['clasrieg_biolog1_hongo'];
$clasrieg_ergo1_trabestat              = $datos['clasrieg_ergo1_trabestat'];
$clasrieg_ergo1_esfuerfis              = $datos['clasrieg_ergo1_esfuerfis'];
$clasrieg_ergo1_carga                  = $datos['clasrieg_ergo1_carga'];
$clasrieg_ergo1_postforz               = $datos['clasrieg_ergo1_postforz'];
$clasrieg_ergo1_movrepet               = $datos['clasrieg_ergo1_movrepet'];
$clasrieg_ergo1_jortrab                = $datos['clasrieg_ergo1_jortrab'];
$clasrieg_psi1_monoto                  = $datos['clasrieg_psi1_monoto'];
$clasrieg_psi1_relhuman                = $datos['clasrieg_psi1_relhuman'];
$clasrieg_psi1_contentarea             = $datos['clasrieg_psi1_contentarea'];
$clasrieg_psi1_orgtiemptrab            = $datos['clasrieg_psi1_orgtiemptrab'];
$clasrieg_segur1_mecanic               = $datos['clasrieg_segur1_mecanic'];
$clasrieg_segur1_electri               = $datos['clasrieg_segur1_electri'];
$clasrieg_segur1_locat                 = $datos['clasrieg_segur1_locat'];
$clasrieg_segur1_fisiquim              = $datos['clasrieg_segur1_fisiquim'];
$clasrieg_segur1_public                = $datos['clasrieg_segur1_public'];
$clasrieg_segur1_espconfi              = $datos['clasrieg_segur1_espconfi'];
$clasrieg_segur1_trabaltura            = $datos['clasrieg_segur1_trabaltura'];
$clasrieg_observ1_otro                 = $datos['clasrieg_observ1_otro'];
//$chek_diligenciar                      = $datos['chek_diligenciar'];

if (($clasrieg_fis1_ruid=="") || ($clasrieg_fis1_ruid=="N")) { $clasrieg_fis1_ruid = $no; } else { $clasrieg_fis1_ruid = $si; }
if (($clasrieg_fis1_ilum=="") || ($clasrieg_fis1_ilum=="N")) { $clasrieg_fis1_ilum = $no; } else { $clasrieg_fis1_ilum = $si; }
if (($clasrieg_fis1_noionic=="") || ($clasrieg_fis1_noionic=="N")) { $clasrieg_fis1_noionic = $no; } else { $clasrieg_fis1_noionic = $si; }
if (($clasrieg_fis1_vibra=="") || ($clasrieg_fis1_vibra=="N")) { $clasrieg_fis1_vibra = $no; } else { $clasrieg_fis1_vibra = $si; }
if (($clasrieg_fis1_tempextrem=="") || ($clasrieg_fis1_tempextrem=="N")) { $clasrieg_fis1_tempextrem = $no; } else { $clasrieg_fis1_tempextrem = $si; }
if (($clasrieg_fis1_cambpres=="") || ($clasrieg_fis1_cambpres=="N")) { $clasrieg_fis1_cambpres = $no; } else { $clasrieg_fis1_cambpres = $si; }
if (($clasrieg_quim1_gasvapor=="") || ($clasrieg_quim1_gasvapor=="N")) { $clasrieg_quim1_gasvapor = $no; } else { $clasrieg_quim1_gasvapor = $si; }
if (($clasrieg_quim1_aeroliq=="") || ($clasrieg_quim1_aeroliq=="N")) { $clasrieg_quim1_aeroliq = $no; } else { $clasrieg_quim1_aeroliq = $si; }
if (($clasrieg_quim1_solid=="") || ($clasrieg_quim1_solid=="N")) { $clasrieg_quim1_solid = $no; } else { $clasrieg_quim1_solid = $si; }
if (($clasrieg_quim1_liquid=="") || ($clasrieg_quim1_liquid=="N")) { $clasrieg_quim1_liquid = $no; } else { $clasrieg_quim1_liquid = $si; }
if (($clasrieg_biolog1_viru=="") || ($clasrieg_biolog1_viru=="N")) { $clasrieg_biolog1_viru = $no; } else { $clasrieg_biolog1_viru = $si; }
if (($clasrieg_biolog1_bacter=="") || ($clasrieg_biolog1_bacter=="N")) { $clasrieg_biolog1_bacter = $no; } else { $clasrieg_biolog1_bacter = $si; }
if (($clasrieg_biolog1_parasi=="") || ($clasrieg_biolog1_parasi=="N")) { $clasrieg_biolog1_parasi = $no; } else { $clasrieg_biolog1_parasi = $si; }
if (($clasrieg_biolog1_morde=="") || ($clasrieg_biolog1_morde=="N")) { $clasrieg_biolog1_morde = $no; } else { $clasrieg_biolog1_morde = $si; }
if (($clasrieg_biolog1_picad=="") || ($clasrieg_biolog1_picad=="N")) { $clasrieg_biolog1_picad = $no; } else { $clasrieg_biolog1_picad = $si; }
if (($clasrieg_biolog1_hongo=="") || ($clasrieg_biolog1_hongo=="N")) { $clasrieg_biolog1_hongo = $no; } else { $clasrieg_biolog1_hongo = $si; }
if (($clasrieg_ergo1_trabestat=="") || ($clasrieg_ergo1_trabestat=="N")) { $clasrieg_ergo1_trabestat = $no; } else { $clasrieg_ergo1_trabestat = $si; }
if (($clasrieg_ergo1_esfuerfis=="") || ($clasrieg_ergo1_esfuerfis=="N")) { $clasrieg_ergo1_esfuerfis = $no; } else { $clasrieg_ergo1_esfuerfis = $si; }
if (($clasrieg_ergo1_carga=="") || ($clasrieg_ergo1_carga=="N")) { $clasrieg_ergo1_carga = $no; } else { $clasrieg_ergo1_carga = $si; }
if (($clasrieg_ergo1_postforz=="") || ($clasrieg_ergo1_postforz=="N")) { $clasrieg_ergo1_postforz = $no; } else { $clasrieg_ergo1_postforz = $si; }
if (($clasrieg_ergo1_movrepet=="") || ($clasrieg_ergo1_movrepet=="N")) { $clasrieg_ergo1_movrepet = $no; } else { $clasrieg_ergo1_movrepet = $si; }
if (($clasrieg_ergo1_jortrab=="") || ($clasrieg_ergo1_jortrab=="N")) { $clasrieg_ergo1_jortrab = $no; } else { $clasrieg_ergo1_jortrab = $si; }
if (($clasrieg_psi1_monoto=="") || ($clasrieg_psi1_monoto=="N")) { $clasrieg_psi1_monoto = $no; } else { $clasrieg_psi1_monoto = $si; }
if (($clasrieg_psi1_relhuman=="") || ($clasrieg_psi1_relhuman=="N")) { $clasrieg_psi1_relhuman = $no; } else { $clasrieg_psi1_relhuman = $si; }
if (($clasrieg_psi1_contentarea=="") || ($clasrieg_psi1_contentarea=="N")) { $clasrieg_psi1_contentarea = $no; } else { $clasrieg_psi1_contentarea = $si; }
if (($clasrieg_psi1_orgtiemptrab=="") || ($clasrieg_psi1_orgtiemptrab=="N")) { $clasrieg_psi1_orgtiemptrab = $no; } else { $clasrieg_psi1_orgtiemptrab = $si; }
if (($clasrieg_segur1_mecanic=="") || ($clasrieg_segur1_mecanic=="N")) { $clasrieg_segur1_mecanic = $no; } else { $clasrieg_segur1_mecanic = $si; }
if (($clasrieg_segur1_electri=="") || ($clasrieg_segur1_electri=="N")) { $clasrieg_segur1_electri = $no; } else { $clasrieg_segur1_electri = $si; }
if (($clasrieg_segur1_locat=="") || ($clasrieg_segur1_locat=="N")) { $clasrieg_segur1_locat = $no; } else { $clasrieg_segur1_locat = $si; }
if (($clasrieg_segur1_fisiquim=="") || ($clasrieg_segur1_fisiquim=="N")) { $clasrieg_segur1_fisiquim = $no; } else { $clasrieg_segur1_fisiquim = $si; }
if (($clasrieg_segur1_public=="") || ($clasrieg_segur1_public=="N")) { $clasrieg_segur1_public = $no; } else { $clasrieg_segur1_public = $si; }
if (($clasrieg_segur1_espconfi=="") || ($clasrieg_segur1_espconfi=="N")) { $clasrieg_segur1_espconfi = $no; } else { $clasrieg_segur1_espconfi = $si; }
if (($clasrieg_segur1_trabaltura=="") || ($clasrieg_segur1_trabaltura=="N")) { $clasrieg_segur1_trabaltura = $no; } else { $clasrieg_segur1_trabaltura = $si; }
if (($clasrieg_observ1_otro=="") || ($clasrieg_observ1_otro=="N")) { $clasrieg_observ1_otro= $no; } else { $clasrieg_observ1_otro = $si; }

if ($campo=='chek_diligenciar') {

$data_sql = ("UPDATE tbl15_grupo_area_cargo SET clasrieg_fis1_ruid = '$clasrieg_fis1_ruid', clasrieg_fis1_ilum = '$clasrieg_fis1_ilum', 
clasrieg_fis1_noionic = '$clasrieg_fis1_noionic', clasrieg_fis1_vibra = '$clasrieg_fis1_vibra', 
clasrieg_fis1_tempextrem = '$clasrieg_fis1_tempextrem', clasrieg_fis1_cambpres = '$clasrieg_fis1_cambpres', 
clasrieg_quim1_gasvapor = '$clasrieg_quim1_gasvapor', clasrieg_quim1_aeroliq = '$clasrieg_quim1_aeroliq', 
clasrieg_quim1_solid = '$clasrieg_quim1_solid', clasrieg_quim1_liquid = '$clasrieg_quim1_liquid', 
clasrieg_biolog1_viru = '$clasrieg_biolog1_viru', clasrieg_biolog1_bacter = '$clasrieg_biolog1_bacter', 
clasrieg_biolog1_parasi = '$clasrieg_biolog1_parasi', clasrieg_biolog1_morde = '$clasrieg_biolog1_morde', 
clasrieg_biolog1_picad = '$clasrieg_biolog1_picad', clasrieg_biolog1_hongo = '$clasrieg_biolog1_hongo', 
clasrieg_ergo1_trabestat = '$clasrieg_ergo1_trabestat', clasrieg_ergo1_esfuerfis = '$clasrieg_ergo1_esfuerfis', 
clasrieg_ergo1_carga = '$clasrieg_ergo1_carga', clasrieg_ergo1_postforz = '$clasrieg_ergo1_postforz', 
clasrieg_ergo1_movrepet = '$clasrieg_ergo1_movrepet', clasrieg_ergo1_jortrab = '$clasrieg_ergo1_jortrab', 
clasrieg_psi1_monoto = '$clasrieg_psi1_monoto', clasrieg_psi1_relhuman = '$clasrieg_psi1_relhuman', 
clasrieg_psi1_contentarea = '$clasrieg_psi1_contentarea', clasrieg_psi1_orgtiemptrab = '$clasrieg_psi1_orgtiemptrab', 
clasrieg_segur1_mecanic = '$clasrieg_segur1_mecanic', clasrieg_segur1_electri = '$clasrieg_segur1_electri', 
clasrieg_segur1_locat = '$clasrieg_segur1_locat', clasrieg_segur1_fisiquim = '$clasrieg_segur1_fisiquim', 
clasrieg_segur1_public = '$clasrieg_segur1_public', clasrieg_segur1_espconfi = '$clasrieg_segur1_espconfi', 
clasrieg_segur1_trabaltura = '$clasrieg_segur1_trabaltura', clasrieg_observ1_otro = '$clasrieg_observ1_otro' 
WHERE cod_grupo_area_cargo = '$cod_grupo_area_cargo'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

$data_sql2 = ("UPDATE tbl15_grupo_area_cargo SET $campo = '$valor_intro' WHERE cod_grupo_area_cargo = '$cod_grupo_area_cargo'");
$exec_data2 = mysqli_query($conectar, $data_sql2) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
elseif ($campo=='objetivo_grupo_area_cargo') {
$valor_intro                           = (addslashes($_REQUEST['valor']));
$data_sql2 = ("UPDATE tbl15_grupo_area_cargo SET $campo = '$valor_intro' WHERE cod_grupo_area_cargo = '$cod_grupo_area_cargo'");
$exec_data2 = mysqli_query($conectar, $data_sql2) or die(mysqli_error($conectar));
if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
elseif ($campo=='funcion_grupo_area_cargo') {
$valor_intro                           = (addslashes($_REQUEST['valor']));
$data_sql2 = ("UPDATE tbl15_grupo_area_cargo SET $campo = '$valor_intro' WHERE cod_grupo_area_cargo = '$cod_grupo_area_cargo'");
$exec_data2 = mysqli_query($conectar, $data_sql2) or die(mysqli_error($conectar));
if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
elseif ($campo=='nombre_escolaridad') {
$valor_intro                           = (addslashes($_REQUEST['valor']));
$data_sql2 = ("UPDATE tbl15_grupo_area_cargo SET $campo = '$valor_intro' WHERE cod_grupo_area_cargo = '$cod_grupo_area_cargo'");
$exec_data2 = mysqli_query($conectar, $data_sql2) or die(mysqli_error($conectar));
if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
elseif ($campo=='conocimientos_especificos') {
$valor_intro                           = (addslashes($_REQUEST['valor']));
$data_sql2 = ("UPDATE tbl15_grupo_area_cargo SET $campo = '$valor_intro' WHERE cod_grupo_area_cargo = '$cod_grupo_area_cargo'");
$exec_data2 = mysqli_query($conectar, $data_sql2) or die(mysqli_error($conectar));
if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
elseif ($campo=='experiencia_previa_requerida') {
$valor_intro                           = (addslashes($_REQUEST['valor']));
$data_sql2 = ("UPDATE tbl15_grupo_area_cargo SET $campo = '$valor_intro' WHERE cod_grupo_area_cargo = '$cod_grupo_area_cargo'");
$exec_data2 = mysqli_query($conectar, $data_sql2) or die(mysqli_error($conectar));
if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
elseif ($campo=='resp_supervision') {
$valor_intro                           = (addslashes($_REQUEST['valor']));
$data_sql2 = ("UPDATE tbl15_grupo_area_cargo SET $campo = '$valor_intro' WHERE cod_grupo_area_cargo = '$cod_grupo_area_cargo'");
$exec_data2 = mysqli_query($conectar, $data_sql2) or die(mysqli_error($conectar));
if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
elseif ($campo=='resp_maquina_equipo_material') {
$valor_intro                           = (addslashes($_REQUEST['valor']));
$data_sql2 = ("UPDATE tbl15_grupo_area_cargo SET $campo = '$valor_intro' WHERE cod_grupo_area_cargo = '$cod_grupo_area_cargo'");
$exec_data2 = mysqli_query($conectar, $data_sql2) or die(mysqli_error($conectar));
if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
elseif ($campo=='resp_relacion') {
$valor_intro                           = (addslashes($_REQUEST['valor']));
$data_sql2 = ("UPDATE tbl15_grupo_area_cargo SET $campo = '$valor_intro' WHERE cod_grupo_area_cargo = '$cod_grupo_area_cargo'");
$exec_data2 = mysqli_query($conectar, $data_sql2) or die(mysqli_error($conectar));
if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
elseif ($campo=='resp_operaciones_tecnica') {
$valor_intro                           = (addslashes($_REQUEST['valor']));
$data_sql2 = ("UPDATE tbl15_grupo_area_cargo SET $campo = '$valor_intro' WHERE cod_grupo_area_cargo = '$cod_grupo_area_cargo'");
$exec_data2 = mysqli_query($conectar, $data_sql2) or die(mysqli_error($conectar));
if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
elseif ($campo=='resp_valores') {
$valor_intro                           = (addslashes($_REQUEST['valor']));
$data_sql2 = ("UPDATE tbl15_grupo_area_cargo SET $campo = '$valor_intro' WHERE cod_grupo_area_cargo = '$cod_grupo_area_cargo'");
$exec_data2 = mysqli_query($conectar, $data_sql2) or die(mysqli_error($conectar));
if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
elseif ($campo=='org_metodo_trabajo') {
$valor_intro                           = (addslashes($_REQUEST['valor']));
$data_sql2 = ("UPDATE tbl15_grupo_area_cargo SET $campo = '$valor_intro' WHERE cod_grupo_area_cargo = '$cod_grupo_area_cargo'");
$exec_data2 = mysqli_query($conectar, $data_sql2) or die(mysqli_error($conectar));
if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
elseif ($campo=='nombre_nivel_esfuerzo') {
$valor_intro                           = (addslashes($_REQUEST['valor']));
$data_sql2 = ("UPDATE tbl15_grupo_area_cargo SET $campo = '$valor_intro' WHERE cod_grupo_area_cargo = '$cod_grupo_area_cargo'");
$exec_data2 = mysqli_query($conectar, $data_sql2) or die(mysqli_error($conectar));
if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
elseif ($campo=='descripcion_ambiente') {
$valor_intro                           = (addslashes($_REQUEST['valor']));
$data_sql2 = ("UPDATE tbl15_grupo_area_cargo SET $campo = '$valor_intro' WHERE cod_grupo_area_cargo = '$cod_grupo_area_cargo'");
$exec_data2 = mysqli_query($conectar, $data_sql2) or die(mysqli_error($conectar));
if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
elseif ($campo=='maquinas_equipo_herramienta') {
$valor_intro                           = (addslashes($_REQUEST['valor']));
$data_sql2 = ("UPDATE tbl15_grupo_area_cargo SET $campo = '$valor_intro' WHERE cod_grupo_area_cargo = '$cod_grupo_area_cargo'");
$exec_data2 = mysqli_query($conectar, $data_sql2) or die(mysqli_error($conectar));
if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
elseif ($campo=='horario') {
$valor_intro                           = (addslashes($_REQUEST['valor']));
$data_sql2 = ("UPDATE tbl15_grupo_area_cargo SET $campo = '$valor_intro' WHERE cod_grupo_area_cargo = '$cod_grupo_area_cargo'");
$exec_data2 = mysqli_query($conectar, $data_sql2) or die(mysqli_error($conectar));
if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
elseif ($campo=='dat_ocupa_cabeza1') {
$valor_intro                           = (addslashes($_REQUEST['valor']));
$data_sql2 = ("UPDATE tbl15_grupo_area_cargo SET $campo = '$valor_intro' WHERE cod_grupo_area_cargo = '$cod_grupo_area_cargo'");
$exec_data2 = mysqli_query($conectar, $data_sql2) or die(mysqli_error($conectar));
if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
elseif ($campo=='dat_ocupa_visu1') {
$valor_intro                           = (addslashes($_REQUEST['valor']));
$data_sql2 = ("UPDATE tbl15_grupo_area_cargo SET $campo = '$valor_intro' WHERE cod_grupo_area_cargo = '$cod_grupo_area_cargo'");
$exec_data2 = mysqli_query($conectar, $data_sql2) or die(mysqli_error($conectar));
if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
elseif ($campo=='dat_ocupa_resp1') {
$valor_intro                           = (addslashes($_REQUEST['valor']));
$data_sql2 = ("UPDATE tbl15_grupo_area_cargo SET $campo = '$valor_intro' WHERE cod_grupo_area_cargo = '$cod_grupo_area_cargo'");
$exec_data2 = mysqli_query($conectar, $data_sql2) or die(mysqli_error($conectar));
if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
elseif ($campo=='dat_ocupa_audi1') {
$valor_intro                           = (addslashes($_REQUEST['valor']));
$data_sql2 = ("UPDATE tbl15_grupo_area_cargo SET $campo = '$valor_intro' WHERE cod_grupo_area_cargo = '$cod_grupo_area_cargo'");
$exec_data2 = mysqli_query($conectar, $data_sql2) or die(mysqli_error($conectar));
if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
elseif ($campo=='dat_ocupa_manos1') {
$valor_intro                           = (addslashes($_REQUEST['valor']));
$data_sql2 = ("UPDATE tbl15_grupo_area_cargo SET $campo = '$valor_intro' WHERE cod_grupo_area_cargo = '$cod_grupo_area_cargo'");
$exec_data2 = mysqli_query($conectar, $data_sql2) or die(mysqli_error($conectar));
if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
elseif ($campo=='dat_ocupa_tronco1') {
$valor_intro                           = (addslashes($_REQUEST['valor']));
$data_sql2 = ("UPDATE tbl15_grupo_area_cargo SET $campo = '$valor_intro' WHERE cod_grupo_area_cargo = '$cod_grupo_area_cargo'");
$exec_data2 = mysqli_query($conectar, $data_sql2) or die(mysqli_error($conectar));
if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
elseif ($campo=='dat_ocupa_pies1') {
$valor_intro                           = (addslashes($_REQUEST['valor']));
$data_sql2 = ("UPDATE tbl15_grupo_area_cargo SET $campo = '$valor_intro' WHERE cod_grupo_area_cargo = '$cod_grupo_area_cargo'");
$exec_data2 = mysqli_query($conectar, $data_sql2) or die(mysqli_error($conectar));
if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
elseif ($campo=='dat_ocupa_altu1') {
$valor_intro                           = (addslashes($_REQUEST['valor']));
$data_sql2 = ("UPDATE tbl15_grupo_area_cargo SET $campo = '$valor_intro' WHERE cod_grupo_area_cargo = '$cod_grupo_area_cargo'");
$exec_data2 = mysqli_query($conectar, $data_sql2) or die(mysqli_error($conectar));
if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
elseif ($campo=='descrip_protec_visual') {
$valor_intro                           = (addslashes($_REQUEST['valor']));
$data_sql2 = ("UPDATE tbl15_grupo_area_cargo SET $campo = '$valor_intro' WHERE cod_grupo_area_cargo = '$cod_grupo_area_cargo'");
$exec_data2 = mysqli_query($conectar, $data_sql2) or die(mysqli_error($conectar));
if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
elseif ($campo=='descrip_protec_audit') {
$valor_intro                           = (addslashes($_REQUEST['valor']));
$data_sql2 = ("UPDATE tbl15_grupo_area_cargo SET $campo = '$valor_intro' WHERE cod_grupo_area_cargo = '$cod_grupo_area_cargo'");
$exec_data2 = mysqli_query($conectar, $data_sql2) or die(mysqli_error($conectar));
if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
elseif ($campo=='descrip_protec_resp') {
$valor_intro                           = (addslashes($_REQUEST['valor']));
$data_sql2 = ("UPDATE tbl15_grupo_area_cargo SET $campo = '$valor_intro' WHERE cod_grupo_area_cargo = '$cod_grupo_area_cargo'");
$exec_data2 = mysqli_query($conectar, $data_sql2) or die(mysqli_error($conectar));
if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
elseif ($campo=='descrip_protec_cabeza') {
$valor_intro                           = (addslashes($_REQUEST['valor']));
$data_sql2 = ("UPDATE tbl15_grupo_area_cargo SET $campo = '$valor_intro' WHERE cod_grupo_area_cargo = '$cod_grupo_area_cargo'");
$exec_data2 = mysqli_query($conectar, $data_sql2) or die(mysqli_error($conectar));
if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
elseif ($campo=='descrip_protec_manos') {
$valor_intro                           = (addslashes($_REQUEST['valor']));
$data_sql2 = ("UPDATE tbl15_grupo_area_cargo SET $campo = '$valor_intro' WHERE cod_grupo_area_cargo = '$cod_grupo_area_cargo'");
$exec_data2 = mysqli_query($conectar, $data_sql2) or die(mysqli_error($conectar));
if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
elseif ($campo=='descrip_protec_tronco') {
$valor_intro                           = (addslashes($_REQUEST['valor']));
$data_sql2 = ("UPDATE tbl15_grupo_area_cargo SET $campo = '$valor_intro' WHERE cod_grupo_area_cargo = '$cod_grupo_area_cargo'");
$exec_data2 = mysqli_query($conectar, $data_sql2) or die(mysqli_error($conectar));
if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
elseif ($campo=='descrip_protec_pies') {
$valor_intro                           = (addslashes($_REQUEST['valor']));
$data_sql2 = ("UPDATE tbl15_grupo_area_cargo SET $campo = '$valor_intro' WHERE cod_grupo_area_cargo = '$cod_grupo_area_cargo'");
$exec_data2 = mysqli_query($conectar, $data_sql2) or die(mysqli_error($conectar));
if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
elseif ($campo=='descrip_protec_altura') {
$valor_intro                           = (addslashes($_REQUEST['valor']));
$data_sql2 = ("UPDATE tbl15_grupo_area_cargo SET $campo = '$valor_intro' WHERE cod_grupo_area_cargo = '$cod_grupo_area_cargo'");
$exec_data2 = mysqli_query($conectar, $data_sql2) or die(mysqli_error($conectar));
if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
elseif ($campo=='ingreso_hemograma') {
$valor_intro                           = (addslashes($_REQUEST['valor']));
$data_sql2 = ("UPDATE tbl15_grupo_area_cargo SET $campo = '$valor_intro' WHERE cod_grupo_area_cargo = '$cod_grupo_area_cargo'");
$exec_data2 = mysqli_query($conectar, $data_sql2) or die(mysqli_error($conectar));
if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
elseif ($campo=='ingreso_perfil_lipidico') {
$valor_intro                           = (addslashes($_REQUEST['valor']));
$data_sql2 = ("UPDATE tbl15_grupo_area_cargo SET $campo = '$valor_intro' WHERE cod_grupo_area_cargo = '$cod_grupo_area_cargo'");
$exec_data2 = mysqli_query($conectar, $data_sql2) or die(mysqli_error($conectar));
if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
elseif ($campo=='ingreso_audiometria') {
$valor_intro                           = (addslashes($_REQUEST['valor']));
$data_sql2 = ("UPDATE tbl15_grupo_area_cargo SET $campo = '$valor_intro' WHERE cod_grupo_area_cargo = '$cod_grupo_area_cargo'");
$exec_data2 = mysqli_query($conectar, $data_sql2) or die(mysqli_error($conectar));
if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
elseif ($campo=='ingreso_visiometria') {
$valor_intro                           = (addslashes($_REQUEST['valor']));
$data_sql2 = ("UPDATE tbl15_grupo_area_cargo SET $campo = '$valor_intro' WHERE cod_grupo_area_cargo = '$cod_grupo_area_cargo'");
$exec_data2 = mysqli_query($conectar, $data_sql2) or die(mysqli_error($conectar));
if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
elseif ($campo=='ingreso_espirometria') {
$valor_intro                           = (addslashes($_REQUEST['valor']));
$data_sql2 = ("UPDATE tbl15_grupo_area_cargo SET $campo = '$valor_intro' WHERE cod_grupo_area_cargo = '$cod_grupo_area_cargo'");
$exec_data2 = mysqli_query($conectar, $data_sql2) or die(mysqli_error($conectar));
if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
elseif ($campo=='ingreso_enfa_osteo') {
$valor_intro                           = (addslashes($_REQUEST['valor']));
$data_sql2 = ("UPDATE tbl15_grupo_area_cargo SET $campo = '$valor_intro' WHERE cod_grupo_area_cargo = '$cod_grupo_area_cargo'");
$exec_data2 = mysqli_query($conectar, $data_sql2) or die(mysqli_error($conectar));
if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
elseif ($campo=='ingreso_manipul_aliment') {
$valor_intro                           = (addslashes($_REQUEST['valor']));
$data_sql2 = ("UPDATE tbl15_grupo_area_cargo SET $campo = '$valor_intro' WHERE cod_grupo_area_cargo = '$cod_grupo_area_cargo'");
$exec_data2 = mysqli_query($conectar, $data_sql2) or die(mysqli_error($conectar));
if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
elseif ($campo=='periodico_anyo_hemograma') {
$valor_intro                           = (addslashes($_REQUEST['valor']));
$data_sql2 = ("UPDATE tbl15_grupo_area_cargo SET $campo = '$valor_intro' WHERE cod_grupo_area_cargo = '$cod_grupo_area_cargo'");
$exec_data2 = mysqli_query($conectar, $data_sql2) or die(mysqli_error($conectar));
if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
elseif ($campo=='periodico_anyo_perfil_lipidico') {
$valor_intro                           = (addslashes($_REQUEST['valor']));
$data_sql2 = ("UPDATE tbl15_grupo_area_cargo SET $campo = '$valor_intro' WHERE cod_grupo_area_cargo = '$cod_grupo_area_cargo'");
$exec_data2 = mysqli_query($conectar, $data_sql2) or die(mysqli_error($conectar));
if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
elseif ($campo=='periodico_anyo_audiometria') {
$valor_intro                           = (addslashes($_REQUEST['valor']));
$data_sql2 = ("UPDATE tbl15_grupo_area_cargo SET $campo = '$valor_intro' WHERE cod_grupo_area_cargo = '$cod_grupo_area_cargo'");
$exec_data2 = mysqli_query($conectar, $data_sql2) or die(mysqli_error($conectar));
if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
elseif ($campo=='periodico_anyo_visiometria') {
$valor_intro                           = (addslashes($_REQUEST['valor']));
$data_sql2 = ("UPDATE tbl15_grupo_area_cargo SET $campo = '$valor_intro' WHERE cod_grupo_area_cargo = '$cod_grupo_area_cargo'");
$exec_data2 = mysqli_query($conectar, $data_sql2) or die(mysqli_error($conectar));
if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
elseif ($campo=='periodico_anyo_espirometria') {
$valor_intro                           = (addslashes($_REQUEST['valor']));
$data_sql2 = ("UPDATE tbl15_grupo_area_cargo SET $campo = '$valor_intro' WHERE cod_grupo_area_cargo = '$cod_grupo_area_cargo'");
$exec_data2 = mysqli_query($conectar, $data_sql2) or die(mysqli_error($conectar));
if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
elseif ($campo=='periodico_anyo_enfa_osteo') {
$valor_intro                           = (addslashes($_REQUEST['valor']));
$data_sql2 = ("UPDATE tbl15_grupo_area_cargo SET $campo = '$valor_intro' WHERE cod_grupo_area_cargo = '$cod_grupo_area_cargo'");
$exec_data2 = mysqli_query($conectar, $data_sql2) or die(mysqli_error($conectar));
if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
elseif ($campo=='periodico_anyo_manipul_aliment') {
$valor_intro                           = (addslashes($_REQUEST['valor']));
$data_sql2 = ("UPDATE tbl15_grupo_area_cargo SET $campo = '$valor_intro' WHERE cod_grupo_area_cargo = '$cod_grupo_area_cargo'");
$exec_data2 = mysqli_query($conectar, $data_sql2) or die(mysqli_error($conectar));
if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
elseif ($campo=='egreso_hemograma') {
$valor_intro                           = (addslashes($_REQUEST['valor']));
$data_sql2 = ("UPDATE tbl15_grupo_area_cargo SET $campo = '$valor_intro' WHERE cod_grupo_area_cargo = '$cod_grupo_area_cargo'");
$exec_data2 = mysqli_query($conectar, $data_sql2) or die(mysqli_error($conectar));
if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
elseif ($campo=='egreso_perfil_lipidico') {
$valor_intro                           = (addslashes($_REQUEST['valor']));
$data_sql2 = ("UPDATE tbl15_grupo_area_cargo SET $campo = '$valor_intro' WHERE cod_grupo_area_cargo = '$cod_grupo_area_cargo'");
$exec_data2 = mysqli_query($conectar, $data_sql2) or die(mysqli_error($conectar));
if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
elseif ($campo=='egreso_audiometria') {
$valor_intro                           = (addslashes($_REQUEST['valor']));
$data_sql2 = ("UPDATE tbl15_grupo_area_cargo SET $campo = '$valor_intro' WHERE cod_grupo_area_cargo = '$cod_grupo_area_cargo'");
$exec_data2 = mysqli_query($conectar, $data_sql2) or die(mysqli_error($conectar));
if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
elseif ($campo=='egreso_visiometria') {
$valor_intro                           = (addslashes($_REQUEST['valor']));
$data_sql2 = ("UPDATE tbl15_grupo_area_cargo SET $campo = '$valor_intro' WHERE cod_grupo_area_cargo = '$cod_grupo_area_cargo'");
$exec_data2 = mysqli_query($conectar, $data_sql2) or die(mysqli_error($conectar));
if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
elseif ($campo=='egreso_espirometria') {
$valor_intro                           = (addslashes($_REQUEST['valor']));
$data_sql2 = ("UPDATE tbl15_grupo_area_cargo SET $campo = '$valor_intro' WHERE cod_grupo_area_cargo = '$cod_grupo_area_cargo'");
$exec_data2 = mysqli_query($conectar, $data_sql2) or die(mysqli_error($conectar));
if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
elseif ($campo=='egreso_enfa_osteo') {
$valor_intro                           = (addslashes($_REQUEST['valor']));
$data_sql2 = ("UPDATE tbl15_grupo_area_cargo SET $campo = '$valor_intro' WHERE cod_grupo_area_cargo = '$cod_grupo_area_cargo'");
$exec_data2 = mysqli_query($conectar, $data_sql2) or die(mysqli_error($conectar));
if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
elseif ($campo=='egreso_manipul_aliment') {
$valor_intro                           = (addslashes($_REQUEST['valor']));
$data_sql2 = ("UPDATE tbl15_grupo_area_cargo SET $campo = '$valor_intro' WHERE cod_grupo_area_cargo = '$cod_grupo_area_cargo'");
$exec_data2 = mysqli_query($conectar, $data_sql2) or die(mysqli_error($conectar));
if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
elseif ($campo=='egreso_manipul_aliment') {
$valor_intro                           = (addslashes($_REQUEST['valor']));
$data_sql2 = ("UPDATE tbl15_grupo_area_cargo SET $campo = '$valor_intro' WHERE cod_grupo_area_cargo = '$cod_grupo_area_cargo'");
$exec_data2 = mysqli_query($conectar, $data_sql2) or die(mysqli_error($conectar));
if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
elseif ($campo=='vacunacion_tetano') {
$valor_intro                           = (addslashes($_REQUEST['valor']));
$data_sql2 = ("UPDATE tbl15_grupo_area_cargo SET $campo = '$valor_intro' WHERE cod_grupo_area_cargo = '$cod_grupo_area_cargo'");
$exec_data2 = mysqli_query($conectar, $data_sql2) or die(mysqli_error($conectar));
if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
elseif ($campo=='vacunacion_fiebre_amarilla') {
$valor_intro                           = (addslashes($_REQUEST['valor']));
$data_sql2 = ("UPDATE tbl15_grupo_area_cargo SET $campo = '$valor_intro' WHERE cod_grupo_area_cargo = '$cod_grupo_area_cargo'");
$exec_data2 = mysqli_query($conectar, $data_sql2) or die(mysqli_error($conectar));
if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
elseif ($campo=='vacunacion_influenza') {
$valor_intro                           = (addslashes($_REQUEST['valor']));
$data_sql2 = ("UPDATE tbl15_grupo_area_cargo SET $campo = '$valor_intro' WHERE cod_grupo_area_cargo = '$cod_grupo_area_cargo'");
$exec_data2 = mysqli_query($conectar, $data_sql2) or die(mysqli_error($conectar));
if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
else {
$data_sql = ("UPDATE tbl15_grupo_area_cargo SET clasrieg_fis1_ruid = '$clasrieg_fis1_ruid', clasrieg_fis1_ilum = '$clasrieg_fis1_ilum', 
clasrieg_fis1_noionic = '$clasrieg_fis1_noionic', clasrieg_fis1_vibra = '$clasrieg_fis1_vibra', 
clasrieg_fis1_tempextrem = '$clasrieg_fis1_tempextrem', clasrieg_fis1_cambpres = '$clasrieg_fis1_cambpres', 
clasrieg_quim1_gasvapor = '$clasrieg_quim1_gasvapor', clasrieg_quim1_aeroliq = '$clasrieg_quim1_aeroliq', 
clasrieg_quim1_solid = '$clasrieg_quim1_solid', clasrieg_quim1_liquid = '$clasrieg_quim1_liquid', 
clasrieg_biolog1_viru = '$clasrieg_biolog1_viru', clasrieg_biolog1_bacter = '$clasrieg_biolog1_bacter', 
clasrieg_biolog1_parasi = '$clasrieg_biolog1_parasi', clasrieg_biolog1_morde = '$clasrieg_biolog1_morde', 
clasrieg_biolog1_picad = '$clasrieg_biolog1_picad', clasrieg_biolog1_hongo = '$clasrieg_biolog1_hongo', 
clasrieg_ergo1_trabestat = '$clasrieg_ergo1_trabestat', clasrieg_ergo1_esfuerfis = '$clasrieg_ergo1_esfuerfis', 
clasrieg_ergo1_carga = '$clasrieg_ergo1_carga', clasrieg_ergo1_postforz = '$clasrieg_ergo1_postforz', 
clasrieg_ergo1_movrepet = '$clasrieg_ergo1_movrepet', clasrieg_ergo1_jortrab = '$clasrieg_ergo1_jortrab', 
clasrieg_psi1_monoto = '$clasrieg_psi1_monoto', clasrieg_psi1_relhuman = '$clasrieg_psi1_relhuman', 
clasrieg_psi1_contentarea = '$clasrieg_psi1_contentarea', clasrieg_psi1_orgtiemptrab = '$clasrieg_psi1_orgtiemptrab', 
clasrieg_segur1_mecanic = '$clasrieg_segur1_mecanic', clasrieg_segur1_electri = '$clasrieg_segur1_electri', 
clasrieg_segur1_locat = '$clasrieg_segur1_locat', clasrieg_segur1_fisiquim = '$clasrieg_segur1_fisiquim', 
clasrieg_segur1_public = '$clasrieg_segur1_public', clasrieg_segur1_espconfi = '$clasrieg_segur1_espconfi', 
clasrieg_segur1_trabaltura = '$clasrieg_segur1_trabaltura', clasrieg_observ1_otro = '$clasrieg_observ1_otro' 
WHERE cod_grupo_area_cargo = '$cod_grupo_area_cargo'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

$data_sql2 = ("UPDATE tbl15_grupo_area_cargo SET $campo = '$valor_intro' WHERE cod_grupo_area_cargo = '$cod_grupo_area_cargo'");
$exec_data2 = mysqli_query($conectar, $data_sql2) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}

}
?>