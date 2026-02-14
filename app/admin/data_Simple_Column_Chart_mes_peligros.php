<?php
date_default_timezone_set("America/Bogota");
// Set proper HTTP response headers
header( 'Content-Type: application/json' );
require_once('../conexiones/conexione.php');

$fecha                       = addslashes($_GET['fecha']);
$tipo_fecha                  = addslashes($_GET['tipo_fecha']);
$nombre_empresa              = addslashes($_GET['nombre_empresa']);
$fecha_hoy_ymd_seg           = strtotime(date("Y/m/d"));

$query1 = "SELECT $tipo_fecha, cod_estado_facturacion, 
clasrieg_fis1_ruid, clasrieg_fis1_ilum, clasrieg_fis1_noionic, clasrieg_fis1_vibra,
clasrieg_fis1_tempextrem, clasrieg_fis1_cambpres, clasrieg_quim1_gasvapor, clasrieg_quim1_aeroliq, 
clasrieg_quim1_solid, clasrieg_quim1_liquid, clasrieg_biolog1_viru, clasrieg_biolog1_bacter, 
clasrieg_biolog1_parasi, clasrieg_biolog1_morde, clasrieg_biolog1_picad, clasrieg_biolog1_hongo, 
clasrieg_ergo1_trabestat, clasrieg_ergo1_esfuerfis, clasrieg_ergo1_carga, clasrieg_ergo1_postforz, 
clasrieg_ergo1_movrepet, clasrieg_ergo1_jortrab, clasrieg_psi1_monoto, clasrieg_psi1_relhuman, 
clasrieg_psi1_contentarea, clasrieg_psi1_orgtiemptrab, clasrieg_segur1_mecanic, clasrieg_segur1_electri, 
clasrieg_segur1_locat, clasrieg_segur1_fisiquim, clasrieg_segur1_public, clasrieg_segur1_espconfi, 
clasrieg_segur1_trabaltura, clasrieg_observ1_otro, nombre_empresa
FROM tbl15_historia_clinica HAVING ((($tipo_fecha)='$fecha') AND (cod_estado_facturacion=1) AND ((nombre_empresa)='$nombre_empresa'))";
$result1 = mysqli_query($conectar, $query1);

$clasrieg_fis1_ruid__          = 0;
$clasrieg_fis1_ilum__          = 0;
$clasrieg_fis1_noionic__       = 0;
$clasrieg_fis1_vibra__         = 0;
$clasrieg_fis1_tempextrem__    = 0;
$clasrieg_fis1_cambpres__      = 0;
$clasrieg_quim1_gasvapor__     = 0; 
$clasrieg_quim1_aeroliq__      = 0; 
$clasrieg_quim1_solid__        = 0; 
$clasrieg_quim1_liquid__       = 0; 
$clasrieg_biolog1_viru__       = 0; 
$clasrieg_biolog1_bacter__     = 0; 
$clasrieg_biolog1_parasi__     = 0; 
$clasrieg_biolog1_morde__      = 0; 
$clasrieg_biolog1_picad__      = 0; 
$clasrieg_biolog1_hongo__      = 0; 
$clasrieg_ergo1_trabestat__    = 0; 
$clasrieg_ergo1_esfuerfis__    = 0; 
$clasrieg_ergo1_carga__        = 0; 
$clasrieg_ergo1_postforz__     = 0; 
$clasrieg_ergo1_movrepet__     = 0; 
$clasrieg_ergo1_jortrab__      = 0; 
$clasrieg_psi1_monoto__        = 0; 
$clasrieg_psi1_relhuman__      = 0; 
$clasrieg_psi1_contentarea__   = 0; 
$clasrieg_psi1_orgtiemptrab__  = 0; 
$clasrieg_segur1_mecanic__     = 0; 
$clasrieg_segur1_electri__     = 0; 
$clasrieg_segur1_locat__       = 0; 
$clasrieg_segur1_fisiquim__    = 0; 
$clasrieg_segur1_public__      = 0; 
$clasrieg_segur1_espconfi__    = 0; 
$clasrieg_segur1_trabaltura__  = 0; 
$clasrieg_observ1_otro__       = 0; 

while ($datos = mysqli_fetch_assoc($result1)) {

$clasrieg_fis1_ruid          = $datos['clasrieg_fis1_ruid'];
$clasrieg_fis1_ilum          = $datos['clasrieg_fis1_ilum'];
$clasrieg_fis1_noionic       = $datos['clasrieg_fis1_noionic'];
$clasrieg_fis1_vibra         = $datos['clasrieg_fis1_vibra'];
$clasrieg_fis1_tempextrem    = $datos['clasrieg_fis1_tempextrem'];
$clasrieg_fis1_cambpres      = $datos['clasrieg_fis1_cambpres'];
$clasrieg_quim1_gasvapor     = $datos['clasrieg_quim1_gasvapor']; 
$clasrieg_quim1_aeroliq      = $datos['clasrieg_quim1_aeroliq']; 
$clasrieg_quim1_solid        = $datos['clasrieg_quim1_solid']; 
$clasrieg_quim1_liquid       = $datos['clasrieg_quim1_liquid']; 
$clasrieg_biolog1_viru       = $datos['clasrieg_biolog1_viru']; 
$clasrieg_biolog1_bacter     = $datos['clasrieg_biolog1_bacter']; 
$clasrieg_biolog1_parasi     = $datos['clasrieg_biolog1_parasi']; 
$clasrieg_biolog1_morde      = $datos['clasrieg_biolog1_morde']; 
$clasrieg_biolog1_picad      = $datos['clasrieg_biolog1_picad']; 
$clasrieg_biolog1_hongo      = $datos['clasrieg_biolog1_hongo']; 
$clasrieg_ergo1_trabestat    = $datos['clasrieg_ergo1_trabestat']; 
$clasrieg_ergo1_esfuerfis    = $datos['clasrieg_ergo1_esfuerfis']; 
$clasrieg_ergo1_carga        = $datos['clasrieg_ergo1_carga']; 
$clasrieg_ergo1_postforz     = $datos['clasrieg_ergo1_postforz']; 
$clasrieg_ergo1_movrepet     = $datos['clasrieg_ergo1_movrepet']; 
$clasrieg_ergo1_jortrab      = $datos['clasrieg_ergo1_jortrab']; 
$clasrieg_psi1_monoto        = $datos['clasrieg_psi1_monoto']; 
$clasrieg_psi1_relhuman      = $datos['clasrieg_psi1_relhuman']; 
$clasrieg_psi1_contentarea   = $datos['clasrieg_psi1_contentarea']; 
$clasrieg_psi1_orgtiemptrab  = $datos['clasrieg_psi1_orgtiemptrab']; 
$clasrieg_segur1_mecanic     = $datos['clasrieg_segur1_mecanic']; 
$clasrieg_segur1_electri     = $datos['clasrieg_segur1_electri']; 
$clasrieg_segur1_locat       = $datos['clasrieg_segur1_locat']; 
$clasrieg_segur1_fisiquim    = $datos['clasrieg_segur1_fisiquim']; 
$clasrieg_segur1_public      = $datos['clasrieg_segur1_public']; 
$clasrieg_segur1_espconfi    = $datos['clasrieg_segur1_espconfi']; 
$clasrieg_segur1_trabaltura  = $datos['clasrieg_segur1_trabaltura']; 
$clasrieg_observ1_otro       = $datos['clasrieg_observ1_otro']; 

if ($clasrieg_fis1_ruid == "S") { $clasrieg_fis1_ruid__ = $clasrieg_fis1_ruid__ + 1; }
if ($clasrieg_fis1_ilum == "S") { $clasrieg_fis1_ilum__ = $clasrieg_fis1_ilum__ + 1; }
if ($clasrieg_fis1_noionic == "S") { $clasrieg_fis1_noionic__ = $clasrieg_fis1_noionic__ + 1; }
if ($clasrieg_fis1_vibra == "S") { $clasrieg_fis1_vibra__ = $clasrieg_fis1_vibra__ + 1; }
if ($clasrieg_fis1_tempextrem == "S") { $clasrieg_fis1_tempextrem__ = $clasrieg_fis1_tempextrem__ + 1; }
if ($clasrieg_fis1_cambpres == "S") { $clasrieg_fis1_cambpres__ = $clasrieg_fis1_cambpres__ + 1; }
if ($clasrieg_quim1_gasvapor == "S") { $clasrieg_quim1_gasvapor__ = $clasrieg_quim1_gasvapor__ + 1; }
if ($clasrieg_quim1_aeroliq == "S") { $clasrieg_quim1_aeroliq__ = $clasrieg_quim1_aeroliq__ + 1; }
if ($clasrieg_quim1_solid == "S") { $clasrieg_quim1_solid__ = $clasrieg_quim1_solid__ + 1; }
if ($clasrieg_quim1_liquid == "S") { $clasrieg_quim1_liquid__ = $clasrieg_quim1_liquid__ + 1; }
if ($clasrieg_biolog1_viru == "S") { $clasrieg_biolog1_viru__ = $clasrieg_biolog1_viru__ + 1; }
if ($clasrieg_biolog1_bacter == "S") { $clasrieg_biolog1_bacter__ = $clasrieg_biolog1_bacter__ + 1; }
if ($clasrieg_biolog1_parasi == "S") { $clasrieg_biolog1_parasi__ = $clasrieg_biolog1_parasi__ + 1; }
if ($clasrieg_biolog1_morde == "S") { $clasrieg_biolog1_morde__ = $clasrieg_biolog1_morde__ + 1; }
if ($clasrieg_biolog1_picad == "S") { $clasrieg_biolog1_picad__ = $clasrieg_biolog1_picad__ + 1; }
if ($clasrieg_biolog1_hongo == "S") { $clasrieg_biolog1_hongo__ = $clasrieg_biolog1_hongo__ + 1; }
if ($clasrieg_ergo1_trabestat == "S") { $clasrieg_ergo1_trabestat__ = $clasrieg_ergo1_trabestat__ + 1; }
if ($clasrieg_ergo1_esfuerfis == "S") { $clasrieg_ergo1_esfuerfis__ = $clasrieg_ergo1_esfuerfis__ + 1; }
if ($clasrieg_ergo1_carga == "S") { $clasrieg_ergo1_carga__ = $clasrieg_ergo1_carga__ + 1; }
if ($clasrieg_ergo1_postforz == "S") { $clasrieg_ergo1_postforz__ = $clasrieg_ergo1_postforz__ + 1; }
if ($clasrieg_ergo1_movrepet == "S") { $clasrieg_ergo1_movrepet__ = $clasrieg_ergo1_movrepet__ + 1; }
if ($clasrieg_ergo1_jortrab == "S") { $clasrieg_ergo1_jortrab__ = $clasrieg_ergo1_jortrab__ + 1; }
if ($clasrieg_psi1_monoto == "S") { $clasrieg_psi1_monoto__ = $clasrieg_psi1_monoto__ + 1; }
if ($clasrieg_psi1_relhuman == "S") { $clasrieg_psi1_relhuman__ = $clasrieg_psi1_relhuman__ + 1; }
if ($clasrieg_psi1_contentarea == "S") { $clasrieg_psi1_contentarea__ = $clasrieg_psi1_contentarea__ + 1; }
if ($clasrieg_psi1_orgtiemptrab == "S") { $clasrieg_psi1_orgtiemptrab__ = $clasrieg_psi1_orgtiemptrab__ + 1; }
if ($clasrieg_segur1_mecanic == "S") { $clasrieg_segur1_mecanic__ = $clasrieg_segur1_mecanic__ + 1; }
if ($clasrieg_segur1_electri == "S") { $clasrieg_segur1_electri__ = $clasrieg_segur1_electri__ + 1; }
if ($clasrieg_segur1_locat == "S") { $clasrieg_segur1_locat__ = $clasrieg_segur1_locat__ + 1; }
if ($clasrieg_segur1_fisiquim == "S") { $clasrieg_segur1_fisiquim__ = $clasrieg_segur1_fisiquim__ + 1; }
if ($clasrieg_segur1_public == "S") { $clasrieg_segur1_public__ = $clasrieg_segur1_public__ + 1; }
if ($clasrieg_segur1_espconfi == "S") { $clasrieg_segur1_espconfi__ = $clasrieg_segur1_espconfi__ + 1; }
if ($clasrieg_segur1_trabaltura == "S") { $clasrieg_segur1_trabaltura__ = $clasrieg_segur1_trabaltura__ + 1; }
if ($clasrieg_observ1_otro == "S") { $clasrieg_observ1_otro__ = $clasrieg_observ1_otro__ + 1; }
}
$vector_riesgo             = array($clasrieg_fis1_ruid__, $clasrieg_fis1_ilum__, $clasrieg_fis1_noionic__, $clasrieg_fis1_vibra__, $clasrieg_fis1_tempextrem__, $clasrieg_fis1_cambpres__, $clasrieg_quim1_gasvapor__, $clasrieg_quim1_aeroliq__, $clasrieg_quim1_solid__, $clasrieg_quim1_liquid__, $clasrieg_biolog1_viru__, $clasrieg_biolog1_bacter__, $clasrieg_biolog1_parasi__, $clasrieg_biolog1_morde__, $clasrieg_biolog1_picad__, $clasrieg_biolog1_hongo__, $clasrieg_ergo1_trabestat__, $clasrieg_ergo1_esfuerfis__, $clasrieg_ergo1_carga__, $clasrieg_ergo1_postforz__, $clasrieg_ergo1_movrepet__, $clasrieg_ergo1_jortrab__, $clasrieg_psi1_monoto__, $clasrieg_psi1_relhuman__, $clasrieg_psi1_contentarea__, $clasrieg_psi1_orgtiemptrab__, $clasrieg_segur1_mecanic__, $clasrieg_segur1_electri__, $clasrieg_segur1_locat__, $clasrieg_segur1_fisiquim__, $clasrieg_segur1_public__, $clasrieg_segur1_espconfi__, $clasrieg_segur1_trabaltura__, $clasrieg_observ1_otro);

$prefix = '';
echo "[\n";
$contador = 0;

foreach ($vector_riesgo as &$conteo_riesgo) {
$contador ++;

echo $prefix . " {\n";

if ($contador == 1) {
$nombre_riesgo = 'Ruido';
echo ' "nombre_riesgo": "' .$nombre_riesgo. '",';
echo ' "conteo_riesgo": '  .intval($conteo_riesgo). ''. '';
}
if ($contador == 2) {
$nombre_riesgo = 'Iluminación';
echo ' "nombre_riesgo": "' .$nombre_riesgo. '",';
echo ' "conteo_riesgo": '  .intval($conteo_riesgo). ''. '';
}
if ($contador == 3) {
$nombre_riesgo = 'Rad no Ionic';
echo ' "nombre_riesgo": "' .$nombre_riesgo. '",';
echo ' "conteo_riesgo": '  .intval($conteo_riesgo). ''. '';
}
if ($contador == 4) {
$nombre_riesgo = 'Vibraciones';
echo ' "nombre_riesgo": "' .$nombre_riesgo. '",';
echo ' "conteo_riesgo": '  .intval($conteo_riesgo). ''. '';
}
if ($contador == 5) {
$nombre_riesgo = 'Temp Extremas';
echo ' "nombre_riesgo": "' .$nombre_riesgo. '",';
echo ' "conteo_riesgo": '  .intval($conteo_riesgo). ''. '';
}
if ($contador == 6) {
$nombre_riesgo = 'Cambios de Presión';
echo ' "nombre_riesgo": "' .$nombre_riesgo. '",';
echo ' "conteo_riesgo": '  .intval($conteo_riesgo). ''. '';
}
if ($contador == 7) {
$nombre_riesgo = 'Gases y Vapores';
echo ' "nombre_riesgo": "' .$nombre_riesgo. '",';
echo ' "conteo_riesgo": '  .intval($conteo_riesgo). ''. '';
}
if ($contador == 8) {
$nombre_riesgo = 'Aerosoles Líquidos';
echo ' "nombre_riesgo": "' .$nombre_riesgo. '",';
echo ' "conteo_riesgo": '  .intval($conteo_riesgo). ''. '';
}
if ($contador == 9) {
$nombre_riesgo = 'Sólidos';
echo ' "nombre_riesgo": "' .$nombre_riesgo. '",';
echo ' "conteo_riesgo": '  .intval($conteo_riesgo). ''. '';
}
if ($contador == 10) {
$nombre_riesgo = 'Líquidos';
echo ' "nombre_riesgo": "' .$nombre_riesgo. '",';
echo ' "conteo_riesgo": '  .intval($conteo_riesgo). ''. '';
}
if ($contador == 11) {
$nombre_riesgo = 'Virus';
echo ' "nombre_riesgo": "' .$nombre_riesgo. '",';
echo ' "conteo_riesgo": '  .intval($conteo_riesgo). ''. '';
}
if ($contador == 12) {
$nombre_riesgo = 'Bacterias';
echo ' "nombre_riesgo": "' .$nombre_riesgo. '",';
echo ' "conteo_riesgo": '  .intval($conteo_riesgo). ''. '';
}
if ($contador == 13) {
$nombre_riesgo = 'Parásitos';
echo ' "nombre_riesgo": "' .$nombre_riesgo. '",';
echo ' "conteo_riesgo": '  .intval($conteo_riesgo). ''. '';
}
if ($contador == 14) {
$nombre_riesgo = 'Mordeduras';
echo ' "nombre_riesgo": "' .$nombre_riesgo. '",';
echo ' "conteo_riesgo": '  .intval($conteo_riesgo). ''. '';
}
if ($contador == 15) {
$nombre_riesgo = 'Picaduras';
echo ' "nombre_riesgo": "' .$nombre_riesgo. '",';
echo ' "conteo_riesgo": '  .intval($conteo_riesgo). ''. '';
}
if ($contador == 16) {
$nombre_riesgo = 'Hongos';
echo ' "nombre_riesgo": "' .$nombre_riesgo. '",';
echo ' "conteo_riesgo": '  .intval($conteo_riesgo). ''. '';
}
if ($contador == 17) {
$nombre_riesgo = 'Trabajo Estático';
echo ' "nombre_riesgo": "' .$nombre_riesgo. '",';
echo ' "conteo_riesgo": '  .intval($conteo_riesgo). ''. '';
}
if ($contador == 18) {
$nombre_riesgo = 'Esfuerzo Físico';
echo ' "nombre_riesgo": "' .$nombre_riesgo. '",';
echo ' "conteo_riesgo": '  .intval($conteo_riesgo). ''. '';
}
if ($contador == 19) {
$nombre_riesgo = 'Cargas';
echo ' "nombre_riesgo": "' .$nombre_riesgo. '",';
echo ' "conteo_riesgo": '  .intval($conteo_riesgo). ''. '';
}
if ($contador == 20) {
$nombre_riesgo = 'Posturas Forzadas';
echo ' "nombre_riesgo": "' .$nombre_riesgo. '",';
echo ' "conteo_riesgo": '  .intval($conteo_riesgo). ''. '';
}
if ($contador == 21) {
$nombre_riesgo = 'Movimientos Repetitivos';
echo ' "nombre_riesgo": "' .$nombre_riesgo. '",';
echo ' "conteo_riesgo": '  .intval($conteo_riesgo). ''. '';
}
if ($contador == 22) {
$nombre_riesgo = 'Jornada de Trabajo';
echo ' "nombre_riesgo": "' .$nombre_riesgo. '",';
echo ' "conteo_riesgo": '  .intval($conteo_riesgo). ''. '';
}
if ($contador == 23) {
$nombre_riesgo = 'Monotonía';
echo ' "nombre_riesgo": "' .$nombre_riesgo. '",';
echo ' "conteo_riesgo": '  .intval($conteo_riesgo). ''. '';
}
if ($contador == 24) {
$nombre_riesgo = 'Relaciones Humanas';
echo ' "nombre_riesgo": "' .$nombre_riesgo. '",';
echo ' "conteo_riesgo": '  .intval($conteo_riesgo). ''. '';
}
if ($contador == 25) {
$nombre_riesgo = 'Contenido de la Terea';
echo ' "nombre_riesgo": "' .$nombre_riesgo. '",';
echo ' "conteo_riesgo": '  .intval($conteo_riesgo). ''. '';
}
if ($contador == 26) {
$nombre_riesgo = 'Org. del Tiempo de Trabajo';
echo ' "nombre_riesgo": "' .$nombre_riesgo. '",';
echo ' "conteo_riesgo": '  .intval($conteo_riesgo). ''. '';
}
if ($contador == 27) {
$nombre_riesgo = 'Mecánicos';
echo ' "nombre_riesgo": "' .$nombre_riesgo. '",';
echo ' "conteo_riesgo": '  .intval($conteo_riesgo). ''. '';
}
if ($contador == 28) {
$nombre_riesgo = 'Eléctricos';
echo ' "nombre_riesgo": "' .$nombre_riesgo. '",';
echo ' "conteo_riesgo": '  .intval($conteo_riesgo). ''. '';
}
if ($contador == 29) {
$nombre_riesgo = 'Locativos';
echo ' "nombre_riesgo": "' .$nombre_riesgo. '",';
echo ' "conteo_riesgo": '  .intval($conteo_riesgo). ''. '';
}
if ($contador == 30) {
$nombre_riesgo = 'Físicoquimicos';
echo ' "nombre_riesgo": "' .$nombre_riesgo. '",';
echo ' "conteo_riesgo": '  .intval($conteo_riesgo). ''. '';
}
if ($contador == 31) {
$nombre_riesgo = 'Público';
echo ' "nombre_riesgo": "' .$nombre_riesgo. '",';
echo ' "conteo_riesgo": '  .intval($conteo_riesgo). ''. '';
}
if ($contador == 32) {
$nombre_riesgo = 'Espacios Confinados';
echo ' "nombre_riesgo": "' .$nombre_riesgo. '",';
echo ' "conteo_riesgo": '  .intval($conteo_riesgo). ''. '';
}
if ($contador == 33) {
$nombre_riesgo = 'Trabajos en Alturas';
echo ' "nombre_riesgo": "' .$nombre_riesgo. '",';
echo ' "conteo_riesgo": '  .intval($conteo_riesgo). ''. '';
}
if ($contador == 34) {
$nombre_riesgo = 'Otros';
echo ' "nombre_riesgo": "' .$nombre_riesgo. '",';
echo ' "conteo_riesgo": '  .intval($conteo_riesgo). ''. '';
}

unset($conteo_riesgo); // rompe la referencia con el último elemento

echo " }";
$prefix = ",\n";
}

echo "\n]";
?>