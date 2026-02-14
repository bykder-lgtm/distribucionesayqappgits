<?php
if (isset($_REQUEST['id'])) {
include_once('../conexiones/conexione.php'); 
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include ("../session/funciones_admin.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
    } else { header("Location:../index.php");
}
$cod_historia_clinica            = intval($_REQUEST['id']);
$campo                           = ($_REQUEST['campo']); 
if ($campo == 'cod_cie10[]') { $campo = addslashes($_REQUEST['campo']); $valor_intro = 0; } else { $campo = addslashes($_REQUEST['campo']); $valor_intro = addslashes($_REQUEST['valor']); }
/* -------------------------------------------------------------------------------------------------------------- */
/* -------------------------------------------------------------------------------------------------------------- */
if (isset($_REQUEST['cod_cliente']) <> '') { $cod_cliente = intval($_REQUEST['cod_cliente']); } else { $cod_cliente = '0'; }

$sql_hist_cliente = "SELECT cod_cliente FROM tbl15_historia_clinica WHERE cod_historia_clinica = '$cod_historia_clinica'";
$consulta_hist_cliente = mysqli_query($conectar, $sql_hist_cliente) or die(mysqli_error($conectar));
$datos_hist_cliente = mysqli_fetch_assoc($consulta_hist_cliente);

$cod_cliente                     = $datos_hist_cliente['cod_cliente'];
/* -------------------------------------------------------------------------------------------------------------- */
if ($campo=='exa_fis_talla') {

$sql_producto = "SELECT exa_fis_peso FROM tbl15_historia_clinica WHERE cod_historia_clinica = '$cod_historia_clinica'";
$consulta_producto = mysqli_query($conectar, $sql_producto) or die(mysqli_error($conectar));
$datos_producto = mysqli_fetch_assoc($consulta_producto);

$exa_fis_talla                   = $valor_intro;
$exa_fis_peso                    = $datos_producto['exa_fis_peso'];
$exa_fis_imc                     = round($exa_fis_peso / pow($exa_fis_talla, 2), 2);

if (($exa_fis_imc  < 18.50)) { $exa_fis_interpreimc = "BAJO PESO"; }
if (($exa_fis_imc  >= 18.50) && ($exa_fis_imc  <= 24.99)) { $exa_fis_interpreimc = "PESO NORMAL"; }
if (($exa_fis_imc  >= 25.0) && ($exa_fis_imc  <= 29.99)) { $exa_fis_interpreimc = "SOBREPESO"; }
if (($exa_fis_imc  >= 30.0) && ($exa_fis_imc  <= 34.99)) { $exa_fis_interpreimc = "OBESIDAD I"; }
if (($exa_fis_imc  >= 35.0) && ($exa_fis_imc  <= 39.99)) { $exa_fis_interpreimc = "OBESIDAD II"; }
if (($exa_fis_imc  >= 40.0) && ($exa_fis_imc  <= 49.99)) { $exa_fis_interpreimc = "OBESIDAD III"; }
if (($exa_fis_imc  >= 50.0)) { $exa_fis_interpreimc = "OBESIDAD EXTREMA"; }

$data_sql = ("UPDATE tbl15_historia_clinica SET exa_fis_talla = '$exa_fis_talla', exa_fis_imc = '$exa_fis_imc', exa_fis_interpreimc = '$exa_fis_interpreimc' WHERE cod_historia_clinica = '$cod_historia_clinica'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
/* -------------------------------------------------------------------------------------------------------------- */
elseif ($campo=='exa_fis_peso') {

$sql_producto = "SELECT exa_fis_talla FROM tbl15_historia_clinica WHERE cod_historia_clinica = '$cod_historia_clinica'";
$consulta_producto = mysqli_query($conectar, $sql_producto) or die(mysqli_error($conectar));
$datos_producto = mysqli_fetch_assoc($consulta_producto);

$exa_fis_peso                     = $valor_intro;
$exa_fis_talla                    = $datos_producto['exa_fis_talla'];
$exa_fis_imc                      = round($exa_fis_peso / pow($exa_fis_talla, 2), 2);

if (($exa_fis_imc  < 18.50)) { $exa_fis_interpreimc = "BAJO PESO"; }
if (($exa_fis_imc  >= 18.50) && ($exa_fis_imc  <= 24.99)) { $exa_fis_interpreimc = "PESO NORMAL"; }
if (($exa_fis_imc  >= 25.0) && ($exa_fis_imc  <= 29.99)) { $exa_fis_interpreimc = "SOBREPESO"; }
if (($exa_fis_imc  >= 30.0) && ($exa_fis_imc  <= 34.99)) { $exa_fis_interpreimc = "OBESIDAD I"; }
if (($exa_fis_imc  >= 35.0) && ($exa_fis_imc  <= 39.99)) { $exa_fis_interpreimc = "OBESIDAD II"; }
if (($exa_fis_imc  >= 40.0) && ($exa_fis_imc  <= 49.99)) { $exa_fis_interpreimc = "OBESIDAD III"; }
if (($exa_fis_imc  >= 50.0)) { $exa_fis_interpreimc = "OBESIDAD EXTREMA"; }

$data_sql = ("UPDATE tbl15_historia_clinica SET exa_fis_peso = '$exa_fis_peso', exa_fis_imc = '$exa_fis_imc', exa_fis_interpreimc = '$exa_fis_interpreimc' WHERE cod_historia_clinica = '$cod_historia_clinica'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
} 
/* -------------------------------------------------------------------------------------------------------------- */
elseif ($campo=='fecha_ymd_hora') {
$fecha_ymd_hora                  = $valor_intro;
$fecha_time                      = strtotime($fecha_ymd_hora);
$fecha_ymd                       = date("Y/m/d", $fecha_time);
$fecha_mes                       = date("m/Y", $fecha_time);
$fecha_anyo                      = date("Y", $fecha_time);
$fecha_dmy                       = date("d/m/Y", $fecha_time);
$hora                            = date("H:i:s", $fecha_time);
$fecha_reg_time                  = time();

$data_sql = ("UPDATE tbl15_historia_clinica SET fecha_ymd = '$fecha_ymd', fecha_time = '$fecha_time', fecha_mes = '$fecha_mes', 
fecha_anyo = '$fecha_anyo', fecha_dmy = '$fecha_dmy', fecha_reg_time = '$fecha_reg_time', hora = '$hora'
WHERE cod_historia_clinica = '$cod_historia_clinica'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
/* -------------------------------------------------------------------------------------------------------------- */
/* -------------------------------------------------------------------------------------------------------------- */
elseif ($campo=='exaosteo_norm_anorm') {
$exaosteo_norm_anorm                  = $valor_intro;

if ($exaosteo_norm_anorm == 'Normal') {

$exaosteo_homb_movart                 = "Normal";
$exaosteo_homb_fuerza                 = "Normal";
$exaosteo_manjobe_movart              = "Normal";
$exaosteo_manjobe_fuerza              = "Normal";
$exaosteo_manyega_movart              = "Normal";
$exaosteo_manyega_fuerza              = "Normal";
$exaosteo_manjobe_sig                 = "Neg";
$exaosteo_manjobe_lat                 = "AM";
$exaosteo_epicond_sig                 = "Neg";
$exaosteo_epicond_lat                 = "AM";
$exaosteo_laseg_sig                   = "Neg";
$exaosteo_phalen_sig                  = "Neg";
$exaosteo_phalen_lat                  = "AM";
$exaosteo_cajon_sig                   = "Neg";
$exaosteo_cajon_lat                   = "AM";

$data_sql = ("UPDATE tbl15_historia_clinica SET exaosteo_homb_movart = '$exaosteo_homb_movart', exaosteo_homb_fuerza = '$exaosteo_homb_fuerza', 
exaosteo_manjobe_movart = '$exaosteo_manjobe_movart', exaosteo_manjobe_fuerza = '$exaosteo_manjobe_fuerza', 
exaosteo_manyega_movart = '$exaosteo_manyega_movart', exaosteo_manyega_fuerza = '$exaosteo_manyega_fuerza',
exaosteo_norm_anorm = '$exaosteo_norm_anorm', exaosteo_manjobe_sig = '$exaosteo_manjobe_sig', 
exaosteo_manjobe_lat = '$exaosteo_manjobe_lat', exaosteo_epicond_sig = '$exaosteo_epicond_sig', exaosteo_epicond_lat = '$exaosteo_epicond_lat', 
exaosteo_laseg_sig = '$exaosteo_laseg_sig', exaosteo_phalen_sig = '$exaosteo_phalen_sig', exaosteo_phalen_lat = '$exaosteo_phalen_lat', 
exaosteo_cajon_sig = '$exaosteo_cajon_sig', exaosteo_cajon_lat = '$exaosteo_cajon_lat'
WHERE cod_historia_clinica = '$cod_historia_clinica'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));
if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }

} else { 
$exaosteo_homb_movart                 = "";
$exaosteo_homb_fuerza                 = "";
$exaosteo_manjobe_movart              = "";
$exaosteo_manjobe_fuerza              = "";
$exaosteo_manyega_movart              = "";
$exaosteo_manyega_fuerza              = "";
$exaosteo_manjobe_sig                 = "";
$exaosteo_manjobe_lat                 = "";
$exaosteo_epicond_sig                 = "";
$exaosteo_epicond_lat                 = "";
$exaosteo_laseg_sig                   = "";
$exaosteo_phalen_sig                  = "";
$exaosteo_phalen_lat                  = "";
$exaosteo_cajon_sig                   = "";
$exaosteo_cajon_lat                   = "";

$data_sql = ("UPDATE tbl15_historia_clinica SET exaosteo_homb_movart = '$exaosteo_homb_movart', exaosteo_homb_fuerza = '$exaosteo_homb_fuerza', 
exaosteo_manjobe_movart = '$exaosteo_manjobe_movart', exaosteo_manjobe_fuerza = '$exaosteo_manjobe_fuerza', 
exaosteo_manyega_movart = '$exaosteo_manyega_movart', exaosteo_manyega_fuerza = '$exaosteo_manyega_fuerza', 
exaosteo_norm_anorm = '$exaosteo_norm_anorm', exaosteo_manjobe_sig = '$exaosteo_manjobe_sig', 
exaosteo_manjobe_lat = '$exaosteo_manjobe_lat', exaosteo_epicond_sig = '$exaosteo_epicond_sig', exaosteo_epicond_lat = '$exaosteo_epicond_lat', 
exaosteo_laseg_sig = '$exaosteo_laseg_sig', exaosteo_phalen_sig = '$exaosteo_phalen_sig', exaosteo_phalen_lat = '$exaosteo_phalen_lat', 
exaosteo_cajon_sig = '$exaosteo_cajon_sig', exaosteo_cajon_lat = '$exaosteo_cajon_lat'
WHERE cod_historia_clinica = '$cod_historia_clinica'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));
if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
}
/* -------------------------------------------------------------------------------------------------------------- */
/* -------------------------------------------------------------------------------------------------------------- */
elseif ($campo=='sintoma_covid19_todo') {
$sintoma_covid19_todo                 = $valor_intro;

if ($sintoma_covid19_todo == 'SI') {
$covid19_fiebre                         = 'SI';
$covid19_escolofrio                     = 'SI';
$covid19_cansansio                      = 'SI';
$covid19_malestar_gral                  = 'SI';
$covid19_fatiga                         = 'SI';
$covid19_tos_seca                       = 'SI';
$covid19_cefaleas                       = 'SI';
$covid19_congestion_nasal               = 'SI';
$covid19_secrecion_nasal                = 'SI';
$covid19_dorlor_garganta                = 'SI';
$covid19_diarrea                        = 'SI';
$covid19_dificul_resp                   = 'SI';
$covid19_inapetencia                    = 'SI';
$covid19_perdida_olfato                 = 'SI';
$covid19_perdida_gusto                  = 'SI';
$covid19_dedos_covid                    = 'SI';
$covid19_dolor_pecho                    = 'SI';
$covid19_confusion                      = 'SI';
$covid19_color_azul_labios              = 'SI';

$covid19_artralgia                      = 'SI';
$covid19_mialgia                        = 'SI';
$covid19_astenia                        = 'SI';
$covid19_odinofagia                     = 'SI';
$covid19_irritacion_ardor_ojos          = 'SI';
$covid19_nauseas                        = 'SI';
$covid19_contacto_person_sospech_covid  = 'SI';

$data_sql = ("UPDATE tbl15_historia_clinica SET sintoma_covid19_todo = '$sintoma_covid19_todo', covid19_fiebre = '$covid19_fiebre', 
covid19_escolofrio = '$covid19_escolofrio', covid19_cansansio = '$covid19_cansansio', 
covid19_malestar_gral = '$covid19_malestar_gral', covid19_fatiga = '$covid19_fatiga',
covid19_tos_seca = '$covid19_tos_seca', covid19_cefaleas = '$covid19_cefaleas', 
covid19_congestion_nasal = '$covid19_congestion_nasal', covid19_secrecion_nasal = '$covid19_secrecion_nasal', 
covid19_dorlor_garganta = '$covid19_dorlor_garganta', covid19_diarrea = '$covid19_diarrea', 
covid19_dificul_resp = '$covid19_dificul_resp', covid19_inapetencia = '$covid19_inapetencia', 
covid19_perdida_olfato = '$covid19_perdida_olfato', covid19_perdida_gusto = '$covid19_perdida_gusto', 
covid19_dedos_covid = '$covid19_dedos_covid', covid19_dolor_pecho = '$covid19_dolor_pecho', 
covid19_confusion = '$covid19_confusion', covid19_color_azul_labios = '$covid19_color_azul_labios', 
covid19_artralgia = '$covid19_artralgia', covid19_mialgia = '$covid19_mialgia', covid19_astenia = '$covid19_astenia', 
covid19_odinofagia = '$covid19_odinofagia', covid19_irritacion_ardor_ojos = '$covid19_irritacion_ardor_ojos', 
covid19_nauseas = '$covid19_nauseas', covid19_contacto_person_sospech_covid = '$covid19_contacto_person_sospech_covid'
WHERE cod_historia_clinica = '$cod_historia_clinica'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));
if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
} else { 
$covid19_fiebre                         = 'NO';
$covid19_escolofrio                     = 'NO';
$covid19_cansansio                      = 'NO';
$covid19_malestar_gral                  = 'NO';
$covid19_fatiga                         = 'NO';
$covid19_tos_seca                       = 'NO';
$covid19_cefaleas                       = 'NO';
$covid19_congestion_nasal               = 'NO';
$covid19_secrecion_nasal                = 'NO';
$covid19_dorlor_garganta                = 'NO';
$covid19_diarrea                        = 'NO';
$covid19_dificul_resp                   = 'NO';
$covid19_inapetencia                    = 'NO';
$covid19_perdida_olfato                 = 'NO';
$covid19_perdida_gusto                  = 'NO';
$covid19_dedos_covid                    = 'NO';
$covid19_dolor_pecho                    = 'NO';
$covid19_confusion                      = 'NO';
$covid19_color_azul_labios              = 'NO';

$covid19_artralgia                      = 'NO';
$covid19_mialgia                        = 'NO';
$covid19_astenia                        = 'NO';
$covid19_odinofagia                     = 'NO';
$covid19_irritacion_ardor_ojos          = 'NO';
$covid19_nauseas                        = 'NO';
$covid19_contacto_person_sospech_covid  = 'NO';

$data_sql = ("UPDATE tbl15_historia_clinica SET sintoma_covid19_todo = '$sintoma_covid19_todo', covid19_fiebre = '$covid19_fiebre', 
covid19_escolofrio = '$covid19_escolofrio', covid19_cansansio = '$covid19_cansansio', 
covid19_malestar_gral = '$covid19_malestar_gral', covid19_fatiga = '$covid19_fatiga',
covid19_tos_seca = '$covid19_tos_seca', covid19_cefaleas = '$covid19_cefaleas', 
covid19_congestion_nasal = '$covid19_congestion_nasal', covid19_secrecion_nasal = '$covid19_secrecion_nasal', 
covid19_dorlor_garganta = '$covid19_dorlor_garganta', covid19_diarrea = '$covid19_diarrea', 
covid19_dificul_resp = '$covid19_dificul_resp', covid19_inapetencia = '$covid19_inapetencia', 
covid19_perdida_olfato = '$covid19_perdida_olfato', covid19_perdida_gusto = '$covid19_perdida_gusto', 
covid19_dedos_covid = '$covid19_dedos_covid', covid19_dolor_pecho = '$covid19_dolor_pecho', 
covid19_confusion = '$covid19_confusion', covid19_color_azul_labios = '$covid19_color_azul_labios', 
covid19_artralgia = '$covid19_artralgia', covid19_mialgia = '$covid19_mialgia', covid19_astenia = '$covid19_astenia', 
covid19_odinofagia = '$covid19_odinofagia', covid19_irritacion_ardor_ojos = '$covid19_irritacion_ardor_ojos', 
covid19_nauseas = '$covid19_nauseas', covid19_contacto_person_sospech_covid = '$covid19_contacto_person_sospech_covid' 
WHERE cod_historia_clinica = '$cod_historia_clinica'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));
if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
}
/* -------------------------------------------------------------------------------------------------------------- */
/* -------------------------------------------------------------------------------------------------------------- */
elseif ($campo=='cod_grupo_area_cargo') {
$cod_grupo_area_cargo            = $valor_intro;

$sql_grupo_area_cargo = "SELECT * FROM tbl15_grupo_area_cargo WHERE cod_grupo_area_cargo = '$cod_grupo_area_cargo'";
$consulta_grupo_area_cargo = mysqli_query($conectar, $sql_grupo_area_cargo);
$datos_grupo_area_cargo = mysqli_fetch_assoc($consulta_grupo_area_cargo);

$nombre_grupo_area_cargo               = $datos_grupo_area_cargo['nombre_grupo_area_cargo'];
$clasrieg_fis1_ruid                    = $datos_grupo_area_cargo['clasrieg_fis1_ruid'];
$clasrieg_fis1_ilum                    = $datos_grupo_area_cargo['clasrieg_fis1_ilum'];
$clasrieg_fis1_noionic                 = $datos_grupo_area_cargo['clasrieg_fis1_noionic'];
$clasrieg_fis1_vibra                   = $datos_grupo_area_cargo['clasrieg_fis1_vibra'];
$clasrieg_fis1_tempextrem              = $datos_grupo_area_cargo['clasrieg_fis1_tempextrem'];
$clasrieg_fis1_cambpres                = $datos_grupo_area_cargo['clasrieg_fis1_cambpres'];
$clasrieg_quim1_gasvapor               = $datos_grupo_area_cargo['clasrieg_quim1_gasvapor'];
$clasrieg_quim1_aeroliq                = $datos_grupo_area_cargo['clasrieg_quim1_aeroliq'];
$clasrieg_quim1_solid                  = $datos_grupo_area_cargo['clasrieg_quim1_solid'];
$clasrieg_quim1_liquid                 = $datos_grupo_area_cargo['clasrieg_quim1_liquid'];
$clasrieg_biolog1_viru                 = $datos_grupo_area_cargo['clasrieg_biolog1_viru'];
$clasrieg_biolog1_bacter               = $datos_grupo_area_cargo['clasrieg_biolog1_bacter'];
$clasrieg_biolog1_parasi               = $datos_grupo_area_cargo['clasrieg_biolog1_parasi'];
$clasrieg_biolog1_morde                = $datos_grupo_area_cargo['clasrieg_biolog1_morde'];
$clasrieg_biolog1_picad                = $datos_grupo_area_cargo['clasrieg_biolog1_picad'];
$clasrieg_biolog1_hongo                = $datos_grupo_area_cargo['clasrieg_biolog1_hongo'];
$clasrieg_ergo1_trabestat              = $datos_grupo_area_cargo['clasrieg_ergo1_trabestat'];
$clasrieg_ergo1_esfuerfis              = $datos_grupo_area_cargo['clasrieg_ergo1_esfuerfis'];
$clasrieg_ergo1_carga                  = $datos_grupo_area_cargo['clasrieg_ergo1_carga'];
$clasrieg_ergo1_postforz               = $datos_grupo_area_cargo['clasrieg_ergo1_postforz'];
$clasrieg_ergo1_movrepet               = $datos_grupo_area_cargo['clasrieg_ergo1_movrepet'];
$clasrieg_ergo1_jortrab                = $datos_grupo_area_cargo['clasrieg_ergo1_jortrab'];
$clasrieg_psi1_monoto                  = $datos_grupo_area_cargo['clasrieg_psi1_monoto'];
$clasrieg_psi1_relhuman                = $datos_grupo_area_cargo['clasrieg_psi1_relhuman'];
$clasrieg_psi1_contentarea             = $datos_grupo_area_cargo['clasrieg_psi1_contentarea'];
$clasrieg_psi1_orgtiemptrab            = $datos_grupo_area_cargo['clasrieg_psi1_orgtiemptrab'];
$clasrieg_segur1_mecanic               = $datos_grupo_area_cargo['clasrieg_segur1_mecanic'];
$clasrieg_segur1_electri               = $datos_grupo_area_cargo['clasrieg_segur1_electri'];
$clasrieg_segur1_locat                 = $datos_grupo_area_cargo['clasrieg_segur1_locat'];
$clasrieg_segur1_fisiquim              = $datos_grupo_area_cargo['clasrieg_segur1_fisiquim'];
$clasrieg_segur1_public                = $datos_grupo_area_cargo['clasrieg_segur1_public'];
$clasrieg_segur1_espconfi              = $datos_grupo_area_cargo['clasrieg_segur1_espconfi'];
$clasrieg_segur1_trabaltura            = $datos_grupo_area_cargo['clasrieg_segur1_trabaltura'];
$clasrieg_segur1_sismo                 = $datos_grupo_area_cargo['clasrieg_segur1_sismo'];
$clasrieg_segur1_delincuenciacomun     = $datos_grupo_area_cargo['clasrieg_segur1_delincuenciacomun'];
$clasrieg_segur1_accitransito          = $datos_grupo_area_cargo['clasrieg_segur1_accitransito'];
$clasrieg_segur1_caidaobjetos          = $datos_grupo_area_cargo['clasrieg_segur1_caidaobjetos'];
$clasrieg_segur1_puestotrabdesorden    = $datos_grupo_area_cargo['clasrieg_segur1_puestotrabdesorden'];
$clasrieg_observ1_otro                 = $datos_grupo_area_cargo['clasrieg_observ1_otro'];

$dat_ocupa_visu1                       = $datos_grupo_area_cargo['dat_ocupa_visu1'];
$dat_ocupa_audi1                       = $datos_grupo_area_cargo['dat_ocupa_audi1'];
$dat_ocupa_resp1                       = $datos_grupo_area_cargo['dat_ocupa_resp1'];
$dat_ocupa_cabeza1                     = $datos_grupo_area_cargo['dat_ocupa_cabeza1'];
$dat_ocupa_manos1                      = $datos_grupo_area_cargo['dat_ocupa_manos1'];
$dat_ocupa_tronco1                     = $datos_grupo_area_cargo['dat_ocupa_tronco1'];
$dat_ocupa_pies1                       = $datos_grupo_area_cargo['dat_ocupa_pies1'];
$dat_ocupa_altu1                       = $datos_grupo_area_cargo['dat_ocupa_altu1'];

$data_sql = ("UPDATE tbl15_historia_clinica SET cod_grupo_area_cargo = '$cod_grupo_area_cargo', 
clasrieg_fis1_ruid = '$clasrieg_fis1_ruid', clasrieg_fis1_ilum = '$clasrieg_fis1_ilum', 
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
clasrieg_segur1_trabaltura = '$clasrieg_segur1_trabaltura', 
clasrieg_segur1_sismo = '$clasrieg_segur1_sismo', clasrieg_segur1_delincuenciacomun = '$clasrieg_segur1_delincuenciacomun', 
clasrieg_segur1_accitransito = '$clasrieg_segur1_accitransito', clasrieg_segur1_caidaobjetos = '$clasrieg_segur1_caidaobjetos', 
clasrieg_segur1_puestotrabdesorden = '$clasrieg_segur1_puestotrabdesorden', 
clasrieg_observ1_otro = '$clasrieg_observ1_otro', 
dat_ocupa_visu1 = '$dat_ocupa_visu1', dat_ocupa_audi1 = '$dat_ocupa_audi1', dat_ocupa_resp1 = '$dat_ocupa_resp1', 
dat_ocupa_cabeza1 = '$dat_ocupa_cabeza1', dat_ocupa_manos1 = '$dat_ocupa_manos1', dat_ocupa_tronco1 = '$dat_ocupa_tronco1', 
dat_ocupa_pies1 = '$dat_ocupa_pies1', dat_ocupa_altu1 = '$dat_ocupa_altu1' 
WHERE cod_historia_clinica = '$cod_historia_clinica'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
elseif ($campo=='000') {

$data_sql = ("UPDATE tbl15_cliente SET $campo = '$valor_intro' WHERE cod_cliente = '$cod_cliente'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
/* -------------------------------------------------------------------------------------------------------------- */
/* -------------------------------------------------------------------------------------------------------------- */
elseif ($campo=='nombre_grupo_area') {

$nombre_grupo_area            = strtoupper($valor_intro);

$sql_autoincremento_grupo_area = "SELECT nombre_grupo_area FROM tbl15_grupo_area WHERE nombre_grupo_area = '$nombre_grupo_area'";
$exec_autoincremento_grupo_area = mysqli_query($conectar, $sql_autoincremento_grupo_area) or die(mysqli_error($conectar));
$existe_grupo_area = mysqli_num_rows($exec_autoincremento_grupo_area);

if ($existe_grupo_area == 0) {

$sql_autoincremento_grupo_area = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_grupo_area'";
$exec_autoincremento_grupo_area = mysqli_query($conectar, $sql_autoincremento_grupo_area) or die(mysqli_error($conectar));
$datos_autoincremento_grupo_area = mysqli_fetch_assoc($exec_autoincremento_grupo_area);
$cod_grupo_area = $datos_autoincremento_grupo_area['AUTO_INCREMENT'];

$sql_data = "INSERT INTO tbl15_grupo_area (cod_grupo_area, nombre_grupo_area) VALUES ('$cod_grupo_area', '$nombre_grupo_area')";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
} else {
$sql_grupo_area = "SELECT cod_grupo_area FROM tbl15_grupo_area WHERE nombre_grupo_area = '$nombre_grupo_area'";
$exec_grupo_area = mysqli_query($conectar, $sql_grupo_area) or die(mysqli_error($conectar));
$datos_grupo_area = mysqli_fetch_assoc($exec_grupo_area);
$cod_grupo_area                    = $datos_grupo_area['cod_grupo_area'];
}
$data_sql = ("UPDATE tbl15_historia_clinica SET cod_grupo_area = '$cod_grupo_area' WHERE cod_historia_clinica = '$cod_historia_clinica'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
/* -------------------------------------------------------------------------------------------------------------- */
/* -------------------------------------------------------------------------------------------------------------- */
elseif ($campo=='nombre_grupo_area_cargo') {

$nombre_grupo_area_cargo       = strtoupper($valor_intro);

$sql_autoincremento_grupo_area_cargo = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_grupo_area_cargo'";
$exec_autoincremento_grupo_area_cargo = mysqli_query($conectar, $sql_autoincremento_grupo_area_cargo) or die(mysqli_error($conectar));
$datos_autoincremento_grupo_area_cargo = mysqli_fetch_assoc($exec_autoincremento_grupo_area_cargo);
$cod_grupo_area_cargo = $datos_autoincremento_grupo_area_cargo['AUTO_INCREMENT'];

$sql_grupo_area = "SELECT cod_grupo_area FROM tbl15_historia_clinica WHERE cod_historia_clinica = '$cod_historia_clinica'";
$consulta_grupo_area = mysqli_query($conectar, $sql_grupo_area) or die(mysqli_error($conectar));
$datos_grupo_area = mysqli_fetch_assoc($consulta_grupo_area);

$cod_grupo_area                    = $datos_grupo_area['cod_grupo_area'];
$clasrieg_fis1_ruid                = 'N';
$clasrieg_fis1_ilum                = 'N';
$clasrieg_fis1_noionic             = 'N';
$clasrieg_fis1_vibra               = 'N';
$clasrieg_fis1_tempextrem          = 'N';
$clasrieg_fis1_cambpres            = 'N';
$clasrieg_quim1_gasvapor           = 'N';
$clasrieg_quim1_aeroliq            = 'N';
$clasrieg_quim1_solid              = 'N';
$clasrieg_quim1_liquid             = 'N';
$clasrieg_biolog1_viru             = 'N';
$clasrieg_biolog1_bacter           = 'N';
$clasrieg_biolog1_parasi           = 'N';
$clasrieg_biolog1_morde            = 'N';
$clasrieg_biolog1_picad            = 'N';
$clasrieg_biolog1_hongo            = 'N';
$clasrieg_ergo1_trabestat          = 'N';
$clasrieg_ergo1_esfuerfis          = 'N';
$clasrieg_ergo1_carga              = 'N';
$clasrieg_ergo1_postforz           = 'N';
$clasrieg_ergo1_movrepet           = 'N';
$clasrieg_ergo1_jortrab            = 'N';
$clasrieg_psi1_monoto              = 'N';
$clasrieg_psi1_relhuman            = 'N';
$clasrieg_psi1_contentarea         = 'N';
$clasrieg_psi1_orgtiemptrab        = 'N';
$clasrieg_segur1_mecanic           = 'N';
$clasrieg_segur1_electri           = 'N';
$clasrieg_segur1_locat             = 'N';
$clasrieg_segur1_fisiquim          = 'N';
$clasrieg_segur1_public            = 'N';
$clasrieg_segur1_espconfi          = 'N';
$clasrieg_segur1_trabaltura        = 'N';
$clasrieg_observ1_otro             = 'N';
$chek_diligenciar                  = 'N';

$sql_data = "INSERT INTO tbl15_grupo_area_cargo (cod_grupo_area_cargo, nombre_grupo_area_cargo, cod_grupo_area, 
clasrieg_fis1_ruid, clasrieg_fis1_ilum, clasrieg_fis1_noionic, clasrieg_fis1_vibra, clasrieg_fis1_tempextrem, clasrieg_fis1_cambpres, 
clasrieg_quim1_gasvapor, clasrieg_quim1_aeroliq, clasrieg_quim1_solid, clasrieg_quim1_liquid, clasrieg_biolog1_viru, 
clasrieg_biolog1_bacter, clasrieg_biolog1_parasi, clasrieg_biolog1_morde, clasrieg_biolog1_picad, clasrieg_biolog1_hongo, 
clasrieg_ergo1_trabestat, clasrieg_ergo1_esfuerfis, clasrieg_ergo1_carga, clasrieg_ergo1_postforz, clasrieg_ergo1_movrepet, 
clasrieg_ergo1_jortrab, clasrieg_psi1_monoto, clasrieg_psi1_relhuman, clasrieg_psi1_contentarea, clasrieg_psi1_orgtiemptrab, 
clasrieg_segur1_mecanic, clasrieg_segur1_electri, clasrieg_segur1_locat, clasrieg_segur1_fisiquim, clasrieg_segur1_public, 
clasrieg_segur1_espconfi, clasrieg_segur1_trabaltura, clasrieg_observ1_otro, chek_diligenciar) 
VALUES ('$cod_grupo_area_cargo', '$nombre_grupo_area_cargo', '$cod_grupo_area', 
'$clasrieg_fis1_ruid', '$clasrieg_fis1_ilum', '$clasrieg_fis1_noionic', '$clasrieg_fis1_vibra', '$clasrieg_fis1_tempextrem', '$clasrieg_fis1_cambpres', 
'$clasrieg_quim1_gasvapor', '$clasrieg_quim1_aeroliq', '$clasrieg_quim1_solid', '$clasrieg_quim1_liquid', '$clasrieg_biolog1_viru', 
'$clasrieg_biolog1_bacter', '$clasrieg_biolog1_parasi', '$clasrieg_biolog1_morde', '$clasrieg_biolog1_picad', '$clasrieg_biolog1_hongo', 
'$clasrieg_ergo1_trabestat', '$clasrieg_ergo1_esfuerfis', '$clasrieg_ergo1_carga', '$clasrieg_ergo1_postforz', '$clasrieg_ergo1_movrepet', 
'$clasrieg_ergo1_jortrab', '$clasrieg_psi1_monoto', '$clasrieg_psi1_relhuman', '$clasrieg_psi1_contentarea', '$clasrieg_psi1_orgtiemptrab', 
'$clasrieg_segur1_mecanic', '$clasrieg_segur1_electri', '$clasrieg_segur1_locat', '$clasrieg_segur1_fisiquim', '$clasrieg_segur1_public', 
'$clasrieg_segur1_espconfi', '$clasrieg_segur1_trabaltura', '$clasrieg_observ1_otro', '$chek_diligenciar')";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

$data_sql = ("UPDATE tbl15_historia_clinica SET cod_grupo_area_cargo = '$cod_grupo_area_cargo', cod_grupo_area = '$cod_grupo_area' WHERE cod_historia_clinica = '$cod_historia_clinica'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
/* -------------------------------------------------------------------------------------------------------------- */
/* -------------------------------------------------------------------------------------------------------------- */
elseif ($campo=='motivo') {
$motivo                          = $valor_intro;

$data_sql1 = ("UPDATE tbl15_actitud_laboral SET motivo_actilab = '$motivo' WHERE cod_historia_clinica = '$cod_historia_clinica'");
$exec_data1 = mysqli_query($conectar, $data_sql1) or die(mysqli_error($conectar));

$data_sql2 = ("UPDATE tbl15_manipulacion_alimento SET motivo_manipulacion_alimento = '$motivo' WHERE cod_historia_clinica = '$cod_historia_clinica'");
$exec_data2 = mysqli_query($conectar, $data_sql2) or die(mysqli_error($conectar));

$data_sql3 = ("UPDATE tbl15_trabajo_altura SET motivo_trabajo_altura = '$motivo' WHERE cod_historia_clinica = '$cod_historia_clinica'");
$exec_data3 = mysqli_query($conectar, $data_sql3) or die(mysqli_error($conectar));

$data_sql = ("UPDATE tbl15_historia_clinica SET motivo = '$motivo' WHERE cod_historia_clinica = '$cod_historia_clinica'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
/* -------------------------------------------------------------------------------------------------------------- */
/* -------------------------------------------------------------------------------------------------------------- */
elseif ($campo=='cod_empresa') {
$cod_empresa                     = $valor_intro;

$data_sql1 = ("UPDATE tbl15_actitud_laboral SET cod_empresa = '$cod_empresa' WHERE cod_historia_clinica = '$cod_historia_clinica'");
$exec_data1 = mysqli_query($conectar, $data_sql1) or die(mysqli_error($conectar));

$data_sql2 = ("UPDATE tbl15_manipulacion_alimento SET cod_empresa = '$cod_empresa' WHERE cod_historia_clinica = '$cod_historia_clinica'");
$exec_data2 = mysqli_query($conectar, $data_sql2) or die(mysqli_error($conectar));

$data_sql3 = ("UPDATE tbl15_trabajo_altura SET cod_empresa = '$cod_empresa' WHERE cod_historia_clinica = '$cod_historia_clinica'");
$exec_data3 = mysqli_query($conectar, $data_sql3) or die(mysqli_error($conectar));

$sql_empresa = "SELECT * FROM tbl15_empresa WHERE cod_empresa = '$cod_empresa'";
$consulta_empresa = mysqli_query($conectar, $sql_empresa) or die(mysqli_error($conectar));
$datos_empresa = mysqli_fetch_assoc($consulta_empresa);

$nombre_empresa                  = $datos_empresa['nombre_empresa'];
$nombre1_empresa                 = $datos_empresa['nombre1_empresa'];
$nombre2_empresa                 = $datos_empresa['nombre2_empresa'];
$apellido1_empresa               = $datos_empresa['apellido1_empresa'];
$apellido2_empresa               = $datos_empresa['apellido2_empresa'];
$razonsocial_empresa             = $datos_empresa['razonsocial_empresa'];
$direccion_empresa               = $datos_empresa['direccion_empresa'];
$telefono_empresa                = $datos_empresa['telefono_empresa'];
$nit_empresa                     = $datos_empresa['nit_empresa'];
$correo_empresa                  = $datos_empresa['correo_empresa'];
$municipio_empresa               = $datos_empresa['municipio_empresa'];
$estrato_empresa                 = $datos_empresa['estrato_empresa'];
$ocupacion_empresa               = $datos_empresa['ocupacion_empresa'];
$nombre_tipo_tercero             = $datos_empresa['nombre_tipo_tercero'];
$contacto                        = $datos_empresa['contacto'];
$fax                             = $datos_empresa['fax'];
$nombre_pais                     = $datos_empresa['nombre_pais'];
$nombre_departamento             = $datos_empresa['nombre_departamento'];
$ciudad                          = $datos_empresa['ciudad'];
$telefono                        = $datos_empresa['telefono'];
$telefono2                       = $datos_empresa['telefono2'];
$nombre_tipo_identificacion      = $datos_empresa['nombre_tipo_identificacion'];
$nombre_tipo_cliente             = $datos_empresa['nombre_tipo_cliente'];
$nombre_tipo_regimen             = $datos_empresa['nombre_tipo_regimen'];
$nombre_tipo_impuesto            = $datos_empresa['nombre_tipo_impuesto'];
$digito                          = $datos_empresa['digito'];
$cod_tipo_facturacion            = $datos_empresa['cod_tipo_facturacion'];

$data_sql = ("UPDATE tbl15_historia_clinica SET cod_empresa = '$cod_empresa', nombre_contacto1 = '$nombre_empresa', identificacion_contacto1 = '$nit_empresa', 
estrato_contacto1 = '$estrato_empresa', municipio_contacto1 = '$municipio_empresa', ocupacion_contacto1 = '$ocupacion_empresa', tel_contacto1 = '$telefono_empresa', 
correo_contacto1 = '$correo_empresa', nombre_empresa = '$nombre_empresa', razonsocial_empresa = '$razonsocial_empresa', cargo_empresa = '$ocupacion_empresa', 
ciudad_empresa = '$municipio_empresa' , nombre_pais = '$nombre_pais', nombre_departamento = '$nombre_departamento', nombre_municipio = '$ciudad'
WHERE cod_historia_clinica = '$cod_historia_clinica'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
/* -------------------------------------------------------------------------------------------------------------- */
/* -------------------------------------------------------------------------------------------------------------- */
elseif ($campo=='nombre_empresa') {
$nombre_empresa                  = $valor_intro;

$data_sql1 = ("UPDATE tbl15_actitud_laboral SET nombre_empresa = '$nombre_empresa' WHERE cod_historia_clinica = '$cod_historia_clinica'");
$exec_data1 = mysqli_query($conectar, $data_sql1) or die(mysqli_error($conectar));

$data_sql2 = ("UPDATE tbl15_manipulacion_alimento SET nombre_empresa = '$nombre_empresa' WHERE cod_historia_clinica = '$cod_historia_clinica'");
$exec_data2 = mysqli_query($conectar, $data_sql2) or die(mysqli_error($conectar));

$data_sql3 = ("UPDATE tbl15_trabajo_altura SET nombre_empresa = '$nombre_empresa' WHERE cod_historia_clinica = '$cod_historia_clinica'");
$exec_data3 = mysqli_query($conectar, $data_sql3) or die(mysqli_error($conectar));

$sql_razon_soc_empresa = "SELECT razonsocial_empresa FROM tbl15_empresa WHERE nombre_empresa = '$nombre_empresa'";
$consulta_razon_soc_empresa = mysqli_query($conectar, $sql_razon_soc_empresa) or die(mysqli_error($conectar));
$datos_razon_soc_empresa = mysqli_fetch_assoc($consulta_razon_soc_empresa);

$razonsocial_empresa             = $datos_razon_soc_empresa['razonsocial_empresa'];

$data_sql = ("UPDATE tbl15_historia_clinica SET nombre_empresa = '$nombre_empresa', razonsocial_empresa = '$razonsocial_empresa'
WHERE cod_historia_clinica = '$cod_historia_clinica'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
/* -------------------------------------------------------------------------------------------------------------- */
/* -------------------------------------------------------------------------------------------------------------- */
elseif ($campo=='nombre_empresa_contratante') {
$nombre_empresa_contratante      = $valor_intro;

$data_sql1 = ("UPDATE tbl15_actitud_laboral SET nombre_empresa_contratante = '$nombre_empresa_contratante' WHERE cod_historia_clinica = '$cod_historia_clinica'");
$exec_data1 = mysqli_query($conectar, $data_sql1) or die(mysqli_error($conectar));

$data_sql2 = ("UPDATE tbl15_manipulacion_alimento SET nombre_empresa_contratante = '$nombre_empresa_contratante' WHERE cod_historia_clinica = '$cod_historia_clinica'");
$exec_data2 = mysqli_query($conectar, $data_sql2) or die(mysqli_error($conectar));

$data_sql3 = ("UPDATE tbl15_trabajo_altura SET nombre_empresa_contratante = '$nombre_empresa_contratante' WHERE cod_historia_clinica = '$cod_historia_clinica'");
$exec_data3 = mysqli_query($conectar, $data_sql3) or die(mysqli_error($conectar));

$data_sql = ("UPDATE tbl15_historia_clinica SET nombre_empresa_contratante = '$nombre_empresa_contratante' WHERE cod_historia_clinica = '$cod_historia_clinica'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
/* -------------------------------------------------------------------------------------------------------------- */
/* -------------------------------------------------------------------------------------------------------------- */
elseif ($campo=='nombre_lista_problema[]') {
$nombre_lista_problema               = $valor_intro;
$cod_lista_problema                 = intval($_REQUEST['id']);

$data_sql = ("UPDATE tbl15_lista_problema SET nombre_lista_problema = '$nombre_lista_problema' WHERE cod_lista_problema = '$cod_lista_problema'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
/* -------------------------------------------------------------------------------------------------------------- */
/* -------------------------------------------------------------------------------------------------------------- */
elseif ($campo=='nombre_lista_maestra[]') {
$nombre_lista_maestra                = $valor_intro;
$cod_lista_problema                  = intval($_REQUEST['id']);

$data_sql = ("UPDATE tbl15_lista_problema SET nombre_lista_maestra = '$nombre_lista_maestra' WHERE cod_lista_problema = '$cod_lista_problema'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
/* -------------------------------------------------------------------------------------------------------------- */
/* -------------------------------------------------------------------------------------------------------------- */
elseif ($campo=='nombre_diagnostico_diferencial[]') {
$nombre_diagnostico_diferencial      = $valor_intro;
$cod_lista_problema                  = intval($_REQUEST['id']);

$data_sql = ("UPDATE tbl15_lista_problema SET nombre_diagnostico_diferencial = '$nombre_diagnostico_diferencial' WHERE cod_lista_problema = '$cod_lista_problema'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
/* -------------------------------------------------------------------------------------------------------------- */
/* -------------------------------------------------------------------------------------------------------------- */
elseif ($campo=='plan_terapeutico_ts[]') {
$plan_terapeutico_ts                 = $valor_intro;
$cod_plan_terapeutico                = intval($_REQUEST['id']);

$data_sql = ("UPDATE tbl15_plan_terapeutico SET plan_terapeutico_ts = '$plan_terapeutico_ts' WHERE cod_plan_terapeutico = '$cod_plan_terapeutico'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
/* -------------------------------------------------------------------------------------------------------------- */
/* -------------------------------------------------------------------------------------------------------------- */
elseif ($campo=='plan_terapeutico_p[]') {
$plan_terapeutico_p                  = $valor_intro;
$cod_plan_terapeutico                = intval($_REQUEST['id']);

$data_sql = ("UPDATE tbl15_plan_terapeutico SET plan_terapeutico_p = '$plan_terapeutico_p' WHERE cod_plan_terapeutico = '$cod_plan_terapeutico'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
/* -------------------------------------------------------------------------------------------------------------- */
/* -------------------------------------------------------------------------------------------------------------- */
elseif ($campo=='plan_terapeutico_s[]') {
$plan_terapeutico_s                  = $valor_intro;
$cod_plan_terapeutico                = intval($_REQUEST['id']);

$data_sql = ("UPDATE tbl15_plan_terapeutico SET plan_terapeutico_s = '$plan_terapeutico_s' WHERE cod_plan_terapeutico = '$cod_plan_terapeutico'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
/* -------------------------------------------------------------------------------------------------------------- */
/* -------------------------------------------------------------------------------------------------------------- */
elseif ($campo=='plan_terapeutico_e[]') {
$plan_terapeutico_e                  = $valor_intro;
$cod_plan_terapeutico                = intval($_REQUEST['id']);

$data_sql = ("UPDATE tbl15_plan_terapeutico SET plan_terapeutico_e = '$plan_terapeutico_e' WHERE cod_plan_terapeutico = '$cod_plan_terapeutico'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
/* -------------------------------------------------------------------------------------------------------------- */
/* -------------------------------------------------------------------------------------------------------------- */
elseif ($campo=='facturar[]') {
$facturar                             = $valor_intro;
$frag                                 = explode("__", $_REQUEST['id']);
$campo                                = $frag[0];
$cod_plan_terapeutico                 = intval($frag[1]);

$data_sql = ("UPDATE tbl15_plan_terapeutico SET facturar = '$facturar' WHERE cod_plan_terapeutico = '$cod_plan_terapeutico'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
/* -------------------------------------------------------------------------------------------------------------- */
/* -------------------------------------------------------------------------------------------------------------- */
elseif ($campo=='nombre_producto[]') {
$nombre_producto                      = $valor_intro;
$frag                                 = explode("__", $_REQUEST['id']);
$campo                                = $frag[0];
$cod_plan_terapeutico                 = intval($frag[1]);

$data_sql = ("UPDATE tbl15_plan_terapeutico SET nombre_producto = '$nombre_producto' WHERE cod_plan_terapeutico = '$cod_plan_terapeutico'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
/* -------------------------------------------------------------------------------------------------------------- */
/* -------------------------------------------------------------------------------------------------------------- */
elseif ($campo=='nombre_tipo_presentacion[]') {
$nombre_tipo_presentacion       = $valor_intro;
$cod_plan_terapeutico                = intval($_REQUEST['id']);

$data_sql = ("UPDATE tbl15_plan_terapeutico SET nombre_tipo_presentacion = '$nombre_tipo_presentacion' WHERE cod_plan_terapeutico = '$cod_plan_terapeutico'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
/* -------------------------------------------------------------------------------------------------------------- */
/* -------------------------------------------------------------------------------------------------------------- */
elseif ($campo=='posologia_cantidad[]') {
$posologia_cantidad         = $valor_intro;
$cod_plan_terapeutico               = intval($_REQUEST['id']);

$sql_plan_terapeutico = "SELECT cod_historia_clinica, posologia_peso FROM tbl15_plan_terapeutico WHERE cod_plan_terapeutico = '$cod_plan_terapeutico'";
$consulta_plan_terapeutico = mysqli_query($conectar, $sql_plan_terapeutico) or die(mysqli_error($conectar));
$datos_plan_terapeutico = mysqli_fetch_assoc($consulta_plan_terapeutico);

$cod_historia_clinica               = $datos_plan_terapeutico['cod_historia_clinica'];
$posologia_peso    = $datos_plan_terapeutico['posologia_peso'];

$sql_historia_clinica = "SELECT exa_fis_peso FROM tbl15_historia_clinica WHERE cod_historia_clinica = '$cod_historia_clinica'";
$consulta_historia_clinica = mysqli_query($conectar, $sql_historia_clinica) or die(mysqli_error($conectar));
$datos_historia_clinica = mysqli_fetch_assoc($consulta_historia_clinica);

$exa_fis_peso                       = $datos_historia_clinica['exa_fis_peso'];
$und_producto       = ($posologia_cantidad * $exa_fis_peso) / $posologia_peso;

$data_sql = ("UPDATE tbl15_plan_terapeutico SET posologia_cantidad = '$posologia_cantidad', und_producto = '$und_producto' WHERE cod_plan_terapeutico = '$cod_plan_terapeutico'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
/* -------------------------------------------------------------------------------------------------------------- */
/* -------------------------------------------------------------------------------------------------------------- */
elseif ($campo=='posologia_peso[]') {
$posologia_peso    = $valor_intro;
$cod_plan_terapeutico               = intval($_REQUEST['id']);

$sql_plan_terapeutico = "SELECT cod_historia_clinica, posologia_cantidad FROM tbl15_plan_terapeutico WHERE cod_plan_terapeutico = '$cod_plan_terapeutico'";
$consulta_plan_terapeutico = mysqli_query($conectar, $sql_plan_terapeutico) or die(mysqli_error($conectar));
$datos_plan_terapeutico = mysqli_fetch_assoc($consulta_plan_terapeutico);

$cod_historia_clinica               = $datos_plan_terapeutico['cod_historia_clinica'];
$posologia_cantidad         = $datos_plan_terapeutico['posologia_cantidad'];

$sql_historia_clinica = "SELECT exa_fis_peso FROM tbl15_historia_clinica WHERE cod_historia_clinica = '$cod_historia_clinica'";
$consulta_historia_clinica = mysqli_query($conectar, $sql_historia_clinica) or die(mysqli_error($conectar));
$datos_historia_clinica = mysqli_fetch_assoc($consulta_historia_clinica);

$exa_fis_peso                       = $datos_historia_clinica['exa_fis_peso'];
$und_producto       = ($posologia_cantidad * $exa_fis_peso) / $posologia_peso;

$data_sql = ("UPDATE tbl15_plan_terapeutico SET posologia_peso = '$posologia_peso', und_producto = '$und_producto' WHERE cod_plan_terapeutico = '$cod_plan_terapeutico'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
/* -------------------------------------------------------------------------------------------------------------- */
/* -------------------------------------------------------------------------------------------------------------- */
elseif ($campo=='und_producto[]') {
$und_producto       = $valor_intro;
$cod_plan_terapeutico               = intval($_REQUEST['id']);

$data_sql = ("UPDATE tbl15_plan_terapeutico SET und_producto = '$und_producto' WHERE cod_plan_terapeutico = '$cod_plan_terapeutico'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
/* -------------------------------------------------------------------------------------------------------------- */
/* -------------------------------------------------------------------------------------------------------------- */
elseif ($campo=='nombre_via_administracion[]') {
$nombre_via_administracion               = $valor_intro;
$cod_plan_terapeutico               = intval($_REQUEST['id']);

$data_sql = ("UPDATE tbl15_plan_terapeutico SET nombre_via_administracion = '$nombre_via_administracion' WHERE cod_plan_terapeutico = '$cod_plan_terapeutico'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
/* -------------------------------------------------------------------------------------------------------------- */
/* -------------------------------------------------------------------------------------------------------------- */
elseif ($campo=='nombre_frec_duracion[]') {
$nombre_frec_duracion      = $valor_intro;
$cod_plan_terapeutico                = intval($_REQUEST['id']);

$data_sql = ("UPDATE tbl15_plan_terapeutico SET nombre_frec_duracion = '$nombre_frec_duracion' WHERE cod_plan_terapeutico = '$cod_plan_terapeutico'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
/* -------------------------------------------------------------------------------------------------------------- */
/* -------------------------------------------------------------------------------------------------------------- */
elseif ($campo=='nombre_auxiliar_pasante[]') {
$nombre_auxiliar_pasante               = $valor_intro;
$cod_auxiliar_pasante                  = intval($_REQUEST['id']);

$data_sql = ("UPDATE tbl15_auxiliar_pasante SET nombre_auxiliar_pasante = '$nombre_auxiliar_pasante' WHERE cod_auxiliar_pasante = '$cod_auxiliar_pasante'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
/* -------------------------------------------------------------------------------------------------------------- */
/* -------------------------------------------------------------------------------------------------------------- */
elseif ($campo=='doc_auxiliar_pasante[]') {
$doc_auxiliar_pasante               = $valor_intro;
$cod_auxiliar_pasante                  = intval($_REQUEST['id']);

$data_sql = ("UPDATE tbl15_auxiliar_pasante SET doc_auxiliar_pasante = '$doc_auxiliar_pasante' WHERE cod_auxiliar_pasante = '$cod_auxiliar_pasante'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
/* -------------------------------------------------------------------------------------------------------------- */
/* -------------------------------------------------------------------------------------------------------------- */
elseif ($campo=='semestre_auxiliar_pasante[]') {
$semestre_auxiliar_pasante               = $valor_intro;
$cod_auxiliar_pasante                  = intval($_REQUEST['id']);

$data_sql = ("UPDATE tbl15_auxiliar_pasante SET semestre_auxiliar_pasante = '$semestre_auxiliar_pasante' WHERE cod_auxiliar_pasante = '$cod_auxiliar_pasante'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
/* -------------------------------------------------------------------------------------------------------------- */
/* -------------------------------------------------------------------------------------------------------------- */
elseif ($campo=='url_firma_auxiliar_pasante[]') {
$url_firma_auxiliar_pasante               = $valor_intro;
$cod_auxiliar_pasante                  = intval($_REQUEST['id']);

$data_sql = ("UPDATE tbl15_auxiliar_pasante SET url_firma_auxiliar_pasante = '$url_firma_auxiliar_pasante' WHERE cod_auxiliar_pasante = '$cod_auxiliar_pasante'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
/* -------------------------------------------------------------------------------------------------------------- */
/* -------------------------------------------------------------------------------------------------------------- */
elseif ($campo=='cod_cie10[]') { }
/* -------------------------------------------------------------------------------------------------------------- */
/* -------------------------------------------------------------------------------------------------------------- */
elseif ($campo=='mucosas') {
$mucosas                  = $valor_intro;

if ($mucosas == 'NORMAL') {

$conjuntival                          = "NORMAL";
$oral                                 = "NORMAL";
$vulvar_prepucial                     = "NORMAL";
$rectal                               = "NORMAL";
$ojos                                 = "NORMAL";
$oidos                                = "NORMAL";
$nodulos_linfa                        = "NORMAL";
$piel_anexos                          = "NORMAL";
$locomocion                           = "NORMAL";
$aparato_musculoesquelet              = "NORMAL";
$sistem_nervioso                      = "NORMAL";
$aparato_cardiovascu                  = "NORMAL";
$aparato_respirat                     = "NORMAL";
$aparato_digestivo                    = "NORMAL";
$aparato_genitourinario               = "NORMAL";

$data_sql = ("UPDATE tbl15_historia_clinica SET mucosas = '$mucosas', conjuntival = '$conjuntival', oral = '$oral', vulvar_prepucial = '$vulvar_prepucial', rectal = '$rectal', 
ojos = '$ojos', oidos = '$oidos', nodulos_linfa = '$nodulos_linfa', piel_anexos = '$piel_anexos', locomocion = '$locomocion', 
aparato_musculoesquelet = '$aparato_musculoesquelet', sistem_nervioso = '$sistem_nervioso', aparato_cardiovascu = '$aparato_cardiovascu', 
aparato_respirat = '$aparato_respirat', aparato_digestivo = '$aparato_digestivo', aparato_genitourinario = '$aparato_genitourinario' 
WHERE cod_historia_clinica = '$cod_historia_clinica'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));
if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }

} else { 
$conjuntival                          = "ANORMAL";
$oral                                 = "ANORMAL";
$vulvar_prepucial                     = "ANORMAL";
$rectal                               = "ANORMAL";
$ojos                                 = "ANORMAL";
$oidos                                = "ANORMAL";
$nodulos_linfa                        = "ANORMAL";
$piel_anexos                          = "ANORMAL";
$locomocion                           = "ANORMAL";
$aparato_musculoesquelet              = "ANORMAL";
$sistem_nervioso                      = "ANORMAL";
$aparato_cardiovascu                  = "ANORMAL";
$aparato_respirat                     = "ANORMAL";
$aparato_digestivo                    = "ANORMAL";
$aparato_genitourinario               = "ANORMAL";

$data_sql = ("UPDATE tbl15_historia_clinica SET mucosas = '$mucosas', conjuntival = '$conjuntival', oral = '$oral', vulvar_prepucial = '$vulvar_prepucial', rectal = '$rectal', 
ojos = '$ojos', oidos = '$oidos', nodulos_linfa = '$nodulos_linfa', piel_anexos = '$piel_anexos', locomocion = '$locomocion', 
aparato_musculoesquelet = '$aparato_musculoesquelet', sistem_nervioso = '$sistem_nervioso', aparato_cardiovascu = '$aparato_cardiovascu', 
aparato_respirat = '$aparato_respirat', aparato_digestivo = '$aparato_digestivo', aparato_genitourinario = '$aparato_genitourinario' 
WHERE cod_historia_clinica = '$cod_historia_clinica'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));
if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
}
/* -------------------------------------------------------------------------------------------------------------- */
/* -------------------------------------------------------------------------------------------------------------- */
elseif ($campo=='plan_diag') {
$plan_diag                  = $valor_intro;

if ($plan_diag == 'SI') {
$plan_diag_cuadhemat                  = "SI";
$plan_diag_parcialorina               = "SI";
$plan_diag_coprologico                = "SI";
$plan_diag_citologfecal               = "SI";
$plan_diag_citolog                    = "SI";
$plan_diag_quimicsang1                = "SI";
$plan_diag_quimicsang2                = "SI";
$plan_diag_quimicsang3                = "SI";
$plan_diag_quimicsang4                = "SI";
$plan_diag_rayx                       = "SI";
$plan_diag_usg                        = "SI";
$plan_diag_cultivo                    = "SI";
$plan_diag_antibiograma               = "SI";
$plan_diag_encima_hepatica            = "SI";
$plan_diag_otro                       = "SI";

$data_sql = ("UPDATE tbl15_historia_clinica SET plan_diag = '$plan_diag', plan_diag_cuadhemat = '$plan_diag_cuadhemat', plan_diag_parcialorina = '$plan_diag_parcialorina', 
plan_diag_coprologico = '$plan_diag_coprologico', plan_diag_citologfecal = '$plan_diag_citologfecal', plan_diag_citolog = '$plan_diag_citolog', 
plan_diag_quimicsang1 = '$plan_diag_quimicsang1', plan_diag_quimicsang2 = '$plan_diag_quimicsang2', plan_diag_quimicsang3 = '$plan_diag_quimicsang3', 
plan_diag_quimicsang4 = '$plan_diag_quimicsang4', plan_diag_rayx = '$plan_diag_rayx', plan_diag_usg = '$plan_diag_usg', plan_diag_cultivo = '$plan_diag_cultivo', 
plan_diag_antibiograma = '$plan_diag_antibiograma', plan_diag_encima_hepatica = '$plan_diag_encima_hepatica', plan_diag_otro = '$plan_diag_otro' 
WHERE cod_historia_clinica = '$cod_historia_clinica'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));
if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }

} else { 
$plan_diag_cuadhemat                  = "NO";
$plan_diag_parcialorina               = "NO";
$plan_diag_coprologico                = "NO";
$plan_diag_citologfecal               = "NO";
$plan_diag_citolog                    = "NO";
$plan_diag_quimicsang1                = "NO";
$plan_diag_quimicsang2                = "NO";
$plan_diag_quimicsang3                = "NO";
$plan_diag_quimicsang4                = "NO";
$plan_diag_rayx                       = "NO";
$plan_diag_usg                        = "NO";
$plan_diag_cultivo                    = "NO";
$plan_diag_antibiograma               = "NO";
$plan_diag_encima_hepatica            = "NO";
$plan_diag_otro                       = "NO";

$data_sql = ("UPDATE tbl15_historia_clinica SET plan_diag = '$plan_diag', plan_diag_cuadhemat = '$plan_diag_cuadhemat', plan_diag_parcialorina = '$plan_diag_parcialorina', 
plan_diag_coprologico = '$plan_diag_coprologico', plan_diag_citologfecal = '$plan_diag_citologfecal', plan_diag_citolog = '$plan_diag_citolog', 
plan_diag_quimicsang1 = '$plan_diag_quimicsang1', plan_diag_quimicsang2 = '$plan_diag_quimicsang2', plan_diag_quimicsang3 = '$plan_diag_quimicsang3', 
plan_diag_quimicsang4 = '$plan_diag_quimicsang4', plan_diag_rayx = '$plan_diag_rayx', plan_diag_usg = '$plan_diag_usg', plan_diag_cultivo = '$plan_diag_cultivo', 
plan_diag_antibiograma = '$plan_diag_antibiograma', plan_diag_encima_hepatica = '$plan_diag_encima_hepatica', plan_diag_otro = '$plan_diag_otro' 
WHERE cod_historia_clinica = '$cod_historia_clinica'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));
if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
}
/* -------------------------------------------------------------------------------------------------------------- */
/* -------------------------------------------------------------------------------------------------------------- */
elseif ($campo=='plan_diag_autorizado') {
$plan_diag_autorizado                  = $valor_intro;

if ($plan_diag_autorizado == 'SI') {
$plan_diag_cuadhemat_autorizado       = "SI";
$plan_diag_parcialorina_autorizado    = "SI";
$plan_diag_coprologico_autorizado     = "SI";
$plan_diag_citologfecal_autorizado    = "SI";
$plan_diag_citolog_autorizado         = "SI";
$plan_diag_quimicsang1_autorizado     = "SI";
$plan_diag_quimicsang2_autorizado     = "SI";
$plan_diag_quimicsang3_autorizado     = "SI";
$plan_diag_quimicsang4_autorizado     = "SI";
$plan_diag_rayx_autorizado            = "SI";
$plan_diag_usg_autorizado             = "SI";
$plan_diag_cultivo_autorizado         = "SI";
$plan_diag_antibiograma_autorizado    = "SI";
$plan_diag_encima_hepatica_autorizado = "SI";
$plan_diag_otro_autorizado            = "SI";

$data_sql = ("UPDATE tbl15_historia_clinica SET plan_diag_autorizado = '$plan_diag_autorizado', plan_diag_cuadhemat_autorizado = '$plan_diag_cuadhemat_autorizado', 
plan_diag_parcialorina_autorizado = '$plan_diag_parcialorina_autorizado', plan_diag_coprologico_autorizado = '$plan_diag_coprologico_autorizado', 
plan_diag_citologfecal_autorizado = '$plan_diag_citologfecal_autorizado', plan_diag_citolog_autorizado = '$plan_diag_citolog_autorizado', 
plan_diag_quimicsang1_autorizado = '$plan_diag_quimicsang1_autorizado', plan_diag_quimicsang2_autorizado = '$plan_diag_quimicsang2_autorizado', 
plan_diag_quimicsang3_autorizado = '$plan_diag_quimicsang3_autorizado', plan_diag_quimicsang4_autorizado = '$plan_diag_quimicsang4_autorizado', 
plan_diag_rayx_autorizado = '$plan_diag_rayx_autorizado', plan_diag_usg_autorizado = '$plan_diag_usg_autorizado', plan_diag_cultivo_autorizado = '$plan_diag_cultivo_autorizado', 
plan_diag_antibiograma_autorizado = '$plan_diag_antibiograma_autorizado', plan_diag_encima_hepatica_autorizado = '$plan_diag_encima_hepatica_autorizado', 
plan_diag_otro_autorizado = '$plan_diag_otro_autorizado' 
WHERE cod_historia_clinica = '$cod_historia_clinica'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));
if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }

} else { 
$plan_diag_cuadhemat_autorizado       = "NO";
$plan_diag_parcialorina_autorizado    = "NO";
$plan_diag_coprologico_autorizado     = "NO";
$plan_diag_citologfecal_autorizado    = "NO";
$plan_diag_citolog_autorizado         = "NO";
$plan_diag_quimicsang1_autorizado     = "NO";
$plan_diag_quimicsang2_autorizado     = "NO";
$plan_diag_quimicsang3_autorizado     = "NO";
$plan_diag_quimicsang4_autorizado     = "NO";
$plan_diag_rayx_autorizado            = "NO";
$plan_diag_usg_autorizado             = "NO";
$plan_diag_cultivo_autorizado         = "NO";
$plan_diag_antibiograma_autorizado    = "NO";
$plan_diag_encima_hepatica_autorizado = "NO";
$plan_diag_otro_autorizado            = "NO";

$data_sql = ("UPDATE tbl15_historia_clinica SET plan_diag_autorizado = '$plan_diag_autorizado', plan_diag_cuadhemat_autorizado = '$plan_diag_cuadhemat_autorizado', 
plan_diag_parcialorina_autorizado = '$plan_diag_parcialorina_autorizado', plan_diag_coprologico_autorizado = '$plan_diag_coprologico_autorizado', 
plan_diag_citologfecal_autorizado = '$plan_diag_citologfecal_autorizado', plan_diag_citolog_autorizado = '$plan_diag_citolog_autorizado', 
plan_diag_quimicsang1_autorizado = '$plan_diag_quimicsang1_autorizado', plan_diag_quimicsang2_autorizado = '$plan_diag_quimicsang2_autorizado', 
plan_diag_quimicsang3_autorizado = '$plan_diag_quimicsang3_autorizado', plan_diag_quimicsang4_autorizado = '$plan_diag_quimicsang4_autorizado', 
plan_diag_rayx_autorizado = '$plan_diag_rayx_autorizado', plan_diag_usg_autorizado = '$plan_diag_usg_autorizado', plan_diag_cultivo_autorizado = '$plan_diag_cultivo_autorizado', 
plan_diag_antibiograma_autorizado = '$plan_diag_antibiograma_autorizado', plan_diag_encima_hepatica_autorizado = '$plan_diag_encima_hepatica_autorizado', 
plan_diag_otro_autorizado = '$plan_diag_otro_autorizado' 
WHERE cod_historia_clinica = '$cod_historia_clinica'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));
if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
}
/* -------------------------------------------------------------------------------------------------------------- */
/* -------------------------------------------------------------------------------------------------------------- */
else {
$data_sql = ("UPDATE tbl15_historia_clinica SET $campo = '$valor_intro' WHERE cod_historia_clinica = '$cod_historia_clinica'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
/* -------------------------------------------------------------------------------------------------------------- */
}
?>