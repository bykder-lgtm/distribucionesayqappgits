<?php
date_default_timezone_set("America/Bogota");
//header( 'Content-Type: application/json' );
require_once('../conexiones/conexione.php');

$fecha_ini                   = addslashes($_GET['fecha_ini']);
$fecha_fin                   = addslashes($_GET['fecha_fin']);
$nombre_empresa              = addslashes($_GET['nombre_empresa']);
$motivo                      = addslashes($_GET['motivo']);
$fecha_hoy_ymd_seg           = strtotime(date("Y/m/d"));

$query1 = "SELECT fecha_ymd, cod_estado_facturacion, nombre_empresa, Count(paracli_audimet) AS conteo_paracli_audimet, paracli_audimet FROM tbl15_historia_clinica
WHERE ((fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (nombre_empresa='$nombre_empresa') AND (motivo='$motivo') AND (cod_estado_facturacion=1) AND ((paracli_audimet)='N'))
GROUP BY paracli_audimet, nombre_empresa";
$result1 = mysqli_query($conectar, $query1);
$dato01 = mysqli_fetch_assoc($result1);

$query2 = "SELECT fecha_ymd, cod_estado_facturacion, nombre_empresa, Count(paracli_visiomet) AS conteo_paracli_visiomet, paracli_visiomet FROM tbl15_historia_clinica
WHERE ((fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (nombre_empresa='$nombre_empresa') AND (motivo='$motivo') AND (cod_estado_facturacion=1) AND ((paracli_visiomet)='N'))
GROUP BY paracli_audimet, nombre_empresa";
$result2 = mysqli_query($conectar, $query2);
$dato02 = mysqli_fetch_assoc($result2);

$query3 = "SELECT fecha_ymd, cod_estado_facturacion, nombre_empresa, Count(paracli_torax) AS conteo_paracli_torax, paracli_torax FROM tbl15_historia_clinica
WHERE ((fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (nombre_empresa='$nombre_empresa') AND (motivo='$motivo') AND (cod_estado_facturacion=1) AND ((paracli_torax)='N'))
GROUP BY paracli_audimet, nombre_empresa";
$result3 = mysqli_query($conectar, $query3);
$dato03 = mysqli_fetch_assoc($result3);

$query4 = "SELECT fecha_ymd, cod_estado_facturacion, nombre_empresa, Count(paracli_espiro) AS conteo_paracli_espiro, paracli_espiro FROM tbl15_historia_clinica
WHERE ((fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (nombre_empresa='$nombre_empresa') AND (motivo='$motivo') AND (cod_estado_facturacion=1) AND ((paracli_espiro)='N'))
GROUP BY paracli_audimet, nombre_empresa";
$result4 = mysqli_query($conectar, $query4);
$dato04 = mysqli_fetch_assoc($result4);

$query5 = "SELECT fecha_ymd, cod_estado_facturacion, nombre_empresa, Count(paracli_ekg) AS conteo_paracli_ekg, paracli_ekg FROM tbl15_historia_clinica
WHERE ((fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (nombre_empresa='$nombre_empresa') AND (motivo='$motivo') AND (cod_estado_facturacion=1) AND ((paracli_ekg)='N'))
GROUP BY paracli_audimet, nombre_empresa";
$result5 = mysqli_query($conectar, $query5);
$dato05 = mysqli_fetch_assoc($result5);

$query6 = "SELECT fecha_ymd, cod_estado_facturacion, nombre_empresa, Count(paracli_rxcolum) AS conteo_paracli_rxcolum, paracli_rxcolum FROM tbl15_historia_clinica
WHERE ((fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (nombre_empresa='$nombre_empresa') AND (motivo='$motivo') AND (cod_estado_facturacion=1) AND ((paracli_rxcolum)='N'))
GROUP BY paracli_audimet, nombre_empresa";
$result6 = mysqli_query($conectar, $query6);
$dato06 = mysqli_fetch_assoc($result6);

$query7 = "SELECT fecha_ymd, cod_estado_facturacion, nombre_empresa, Count(paracli_otrcomplement) AS conteo_paracli_otrcomplement, paracli_otrcomplement FROM tbl15_historia_clinica
WHERE ((fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (nombre_empresa='$nombre_empresa') AND (motivo='$motivo') AND (cod_estado_facturacion=1) AND ((paracli_otrcomplement)='N'))
GROUP BY paracli_audimet, nombre_empresa";
$result7 = mysqli_query($conectar, $query7);
$dato07 = mysqli_fetch_assoc($result7);

$query8 = "SELECT fecha_ymd, cod_estado_facturacion, nombre_empresa, Count(paracli_fisiote) AS conteo_paracli_fisiote, paracli_fisiote FROM tbl15_historia_clinica
WHERE ((fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (nombre_empresa='$nombre_empresa') AND (motivo='$motivo') AND (cod_estado_facturacion=1) AND ((paracli_fisiote)='N'))
GROUP BY paracli_audimet, nombre_empresa";
$result8 = mysqli_query($conectar, $query8);
$dato08 = mysqli_fetch_assoc($result8);

$query9 = "SELECT fecha_ymd, cod_estado_facturacion, nombre_empresa, Count(paracli_lab) AS conteo_paracli_lab, paracli_lab FROM tbl15_historia_clinica
WHERE ((fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (nombre_empresa='$nombre_empresa') AND (motivo='$motivo') AND (cod_estado_facturacion=1) AND ((paracli_lab)='N'))
GROUP BY paracli_audimet, nombre_empresa";
$result9 = mysqli_query($conectar, $query9);
$dato09 = mysqli_fetch_assoc($result9);

$query10 = "SELECT fecha_ymd, cod_estado_facturacion, nombre_empresa, Count(paracli_otro) AS conteo_paracli_otro, paracli_otro FROM tbl15_historia_clinica
WHERE ((fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (nombre_empresa='$nombre_empresa') AND (motivo='$motivo') AND (cod_estado_facturacion=1) AND ((paracli_otro)='N'))
GROUP BY paracli_audimet, nombre_empresa";
$result10 = mysqli_query($conectar, $query10);
$dato10 = mysqli_fetch_assoc($result10);


$query11 = "SELECT fecha_ymd, cod_estado_facturacion, nombre_empresa, Count(paracli_audimet) AS conteo_paracli_audimet, paracli_audimet FROM tbl15_historia_clinica
WHERE ((fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (nombre_empresa='$nombre_empresa') AND (motivo='$motivo') AND (cod_estado_facturacion=1) AND ((paracli_audimet)='A'))
GROUP BY paracli_audimet, nombre_empresa";
$result11 = mysqli_query($conectar, $query11);
$dato11 = mysqli_fetch_assoc($result11);

$query12 = "SELECT fecha_ymd, cod_estado_facturacion, nombre_empresa, Count(paracli_visiomet) AS conteo_paracli_visiomet, paracli_visiomet FROM tbl15_historia_clinica
WHERE ((fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (nombre_empresa='$nombre_empresa') AND (motivo='$motivo') AND (cod_estado_facturacion=1) AND ((paracli_visiomet)='A'))
GROUP BY paracli_audimet, nombre_empresa";
$result12 = mysqli_query($conectar, $query12);
$dato12 = mysqli_fetch_assoc($result12);

$query13 = "SELECT fecha_ymd, cod_estado_facturacion, nombre_empresa, Count(paracli_torax) AS conteo_paracli_torax, paracli_torax FROM tbl15_historia_clinica
WHERE ((fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (nombre_empresa='$nombre_empresa') AND (motivo='$motivo') AND (cod_estado_facturacion=1) AND ((paracli_torax)='A'))
GROUP BY paracli_audimet, nombre_empresa";
$result13 = mysqli_query($conectar, $query13);
$dato13 = mysqli_fetch_assoc($result13);

$query14 = "SELECT fecha_ymd, cod_estado_facturacion, nombre_empresa, Count(paracli_espiro) AS conteo_paracli_espiro, paracli_espiro FROM tbl15_historia_clinica
WHERE ((fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (nombre_empresa='$nombre_empresa') AND (motivo='$motivo') AND (cod_estado_facturacion=1) AND ((paracli_espiro)='A'))
GROUP BY paracli_audimet, nombre_empresa";
$result14 = mysqli_query($conectar, $query14);
$dato14 = mysqli_fetch_assoc($result14);

$query15 = "SELECT fecha_ymd, cod_estado_facturacion, nombre_empresa, Count(paracli_ekg) AS conteo_paracli_ekg, paracli_ekg FROM tbl15_historia_clinica
WHERE ((fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (nombre_empresa='$nombre_empresa') AND (motivo='$motivo') AND (cod_estado_facturacion=1) AND ((paracli_ekg)='A'))
GROUP BY paracli_audimet, nombre_empresa";
$result15 = mysqli_query($conectar, $query15);
$dato15 = mysqli_fetch_assoc($result15);

$query16 = "SELECT fecha_ymd, cod_estado_facturacion, nombre_empresa, Count(paracli_rxcolum) AS conteo_paracli_rxcolum, paracli_rxcolum FROM tbl15_historia_clinica
WHERE ((fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (nombre_empresa='$nombre_empresa') AND (motivo='$motivo') AND (cod_estado_facturacion=1) AND ((paracli_rxcolum)='A'))
GROUP BY paracli_audimet, nombre_empresa";
$result16 = mysqli_query($conectar, $query16);
$dato16 = mysqli_fetch_assoc($result16);

$query17 = "SELECT fecha_ymd, cod_estado_facturacion, nombre_empresa, Count(paracli_otrcomplement) AS conteo_paracli_otrcomplement, paracli_otrcomplement FROM tbl15_historia_clinica
WHERE ((fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (nombre_empresa='$nombre_empresa') AND (motivo='$motivo') AND (cod_estado_facturacion=1) AND ((paracli_otrcomplement)='A'))
GROUP BY paracli_audimet, nombre_empresa";
$result17 = mysqli_query($conectar, $query17);
$dato17 = mysqli_fetch_assoc($result17);

$query18 = "SELECT fecha_ymd, cod_estado_facturacion, nombre_empresa, Count(paracli_fisiote) AS conteo_paracli_fisiote, paracli_fisiote FROM tbl15_historia_clinica
WHERE ((fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (nombre_empresa='$nombre_empresa') AND (motivo='$motivo') AND (cod_estado_facturacion=1) AND ((paracli_fisiote)='A'))
GROUP BY paracli_audimet, nombre_empresa";
$result18 = mysqli_query($conectar, $query18);
$dato18 = mysqli_fetch_assoc($result18);

$query19 = "SELECT fecha_ymd, cod_estado_facturacion, nombre_empresa, Count(paracli_lab) AS conteo_paracli_lab, paracli_lab FROM tbl15_historia_clinica
WHERE ((fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (nombre_empresa='$nombre_empresa') AND (motivo='$motivo') AND (cod_estado_facturacion=1) AND ((paracli_lab)='A'))
GROUP BY paracli_audimet, nombre_empresa";
$result9 = mysqli_query($conectar, $query19);
$dato19 = mysqli_fetch_assoc($result9);

$query20 = "SELECT fecha_ymd, cod_estado_facturacion, nombre_empresa, Count(paracli_otro) AS conteo_paracli_otro, paracli_otro FROM tbl15_historia_clinica
WHERE ((fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (nombre_empresa='$nombre_empresa') AND (motivo='$motivo') AND (cod_estado_facturacion=1) AND ((paracli_otro)='A'))
GROUP BY paracli_audimet, nombre_empresa";
$result20 = mysqli_query($conectar, $query20);
$dato20 = mysqli_fetch_assoc($result20);

$paracli_audimet_n          = $dato01['conteo_paracli_audimet'];
$paracli_visiomet_n         = $dato02['conteo_paracli_visiomet'];
$paracli_torax_n            = $dato03['conteo_paracli_torax'];
$paracli_espiro_n           = $dato04['conteo_paracli_espiro'];
$paracli_ekg_n              = $dato05['conteo_paracli_ekg'];
$paracli_rxcolum_n          = $dato06['conteo_paracli_rxcolum'];
$paracli_otrcomplement_n    = $dato07['conteo_paracli_otrcomplement'];
$paracli_fisiote_n          = $dato08['conteo_paracli_fisiote'];
$paracli_lab_n              = $dato09['conteo_paracli_lab'];
$paracli_otro_n             = $dato10['conteo_paracli_otro'];

$paracli_audimet_a          = $dato11['conteo_paracli_audimet'];
$paracli_visiomet_a         = $dato12['conteo_paracli_visiomet'];
$paracli_torax_a            = $dato13['conteo_paracli_torax'];
$paracli_espiro_a           = $dato14['conteo_paracli_espiro'];
$paracli_ekg_a              = $dato15['conteo_paracli_ekg'];
$paracli_rxcolum_a          = $dato16['conteo_paracli_rxcolum'];
$paracli_otrcomplement_a    = $dato17['conteo_paracli_otrcomplement'];
$paracli_fisiote_a          = $dato18['conteo_paracli_fisiote'];
$paracli_lab_a              = $dato19['conteo_paracli_lab'];
$paracli_otro_a             = $dato20['conteo_paracli_otro'];

$vector_paraclinic_n           = array($paracli_audimet_n, $paracli_visiomet_n, $paracli_torax_n, $paracli_espiro_n, $paracli_ekg_n, $paracli_rxcolum_n, $paracli_otrcomplement_n, $paracli_fisiote_n, $paracli_lab_n, $paracli_otro_n);
$vector_paraclinic_a           = array($paracli_audimet_a, $paracli_visiomet_a, $paracli_torax_a, $paracli_espiro_a, $paracli_ekg_a, $paracli_rxcolum_a, $paracli_otrcomplement_a, $paracli_fisiote_a, $paracli_lab_a, $paracli_otro_a);


$prefix = '';
echo "[\n";
$contador = 0;

$contador_int = 0;
$contador_ext = 0;

foreach($vector_paraclinic_n as $conteo_paraclinic_n) {
	$contador_int++;
		if ($contador_int == 1) {
			$nombre_paraclinic = 'Audiometría';
			echo ' "nombre_paraclinic": "' .$nombre_paraclinic. '",';
			echo ' "conteo_paraclinic_n": '  .intval($conteo_paraclinic_n). ',';
		}
		if ($contador_int == 2) {
			$nombre_paraclinic = 'Visiometría / Optometría';
			echo ' "nombre_paraclinic": "' .$nombre_paraclinic. '",';
			echo ' "conteo_paraclinic_n": '  .intval($conteo_paraclinic_n). ',';
	    }
		if ($contador_int == 3) {
			$nombre_paraclinic = 'Rx de Tórax';
			echo ' "nombre_paraclinic": "' .$nombre_paraclinic. '",';
			echo ' "conteo_paraclinic_n": '  .intval($conteo_paraclinic_n). ',';
		}
echo "<br>";

foreach($vector_paraclinic_a as $conteo_paraclinic_a) {
	$contador_ext++;

		if ($contador_ext == 1) {
		$nombre_paraclinic = 'Audiometría';
		echo ' "nombre_paraclinic": "' .$nombre_paraclinic. '",';
		echo ' "conteo_paraclinic_a": '  .intval($conteo_paraclinic_a). ',';
	    }
		if ($contador_ext == 2) {
		$nombre_paraclinic = 'Visiometría / Optometría';
		echo ' "nombre_paraclinic": "' .$nombre_paraclinic. '",';
		echo ' "conteo_paraclinic_a": '  .intval($conteo_paraclinic_a). ',';
	    }
		if ($contador_ext == 3) {
		$nombre_paraclinic = 'Rx de Tórax';
		echo ' "nombre_paraclinic": "' .$nombre_paraclinic. '",';
		echo ' "conteo_paraclinic_a": '  .intval($conteo_paraclinic_a). ',';
	    }
echo "<br>";
}

}
echo " }";
$prefix = ",\n";

echo "\n]";
/*
foreach ($vector_paraclinic_n as &$conteo_paraclinic) {

$rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
$color = '#'.$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)];

echo $prefix . " {\n";

$contador ++;

if ($contador == 1 || $contador == 11) {
$nombre_paraclinic = 'Audiometría';
echo ' "color": "' .$color. '",';
echo ' "nombre_paraclinic": "' .$nombre_paraclinic. '",';
echo ' "conteo_paraclinic_n": '  .intval($conteo_paraclinic_n). ',';
echo ' "conteo_paraclinic_a": '  .intval($conteo_paraclinic_n). '';

}
if ($contador == 2 || $contador == 12) {
echo ' "color": "' .$color. '",';
$nombre_paraclinic = 'Visiometría / Optometría';
echo ' "nombre_paraclinic": "' .$nombre_paraclinic. '",';
echo ' "conteo_paraclinic_n": '  .intval($conteo_paraclinic_n). ',';
echo ' "conteo_paraclinic_a": '  .intval($conteo_paraclinic_n). '';
}
if ($contador == 3 || $contador == 13) {
echo ' "color": "' .$color. '",';
$nombre_paraclinic = 'Rx de Tórax';
echo ' "nombre_paraclinic": "' .$nombre_paraclinic. '",';
echo ' "conteo_paraclinic_n": '  .intval($conteo_paraclinic_n). ',';
echo ' "conteo_paraclinic_a": '  .intval($conteo_paraclinic_n). '';
}
if ($contador == 4 || $contador == 14) {
echo ' "color": "' .$color. '",';
$nombre_paraclinic = 'Espirometría';
echo ' "nombre_paraclinic": "' .$nombre_paraclinic. '",';
echo ' "conteo_paraclinic_n": '  .intval($conteo_paraclinic_n). ',';
echo ' "conteo_paraclinic_a": '  .intval($conteo_paraclinic_n). '';
}
if ($contador == 5 || $contador == 15) {
echo ' "color": "' .$color. '",';
$nombre_paraclinic = 'Audiometría';
echo ' "nombre_paraclinic": "' .$nombre_paraclinic. '",';
echo ' "conteo_paraclinic_n": '  .intval($conteo_paraclinic_n). ',';
echo ' "conteo_paraclinic_a": '  .intval($conteo_paraclinic_n). '';
}
if ($contador == 6 || $contador == 16) {
echo ' "color": "' .$color. '",';
$nombre_paraclinic = 'EKG';
echo ' "nombre_paraclinic": "' .$nombre_paraclinic. '",';
echo ' "conteo_paraclinic_n": '  .intval($conteo_paraclinic_n). ',';
echo ' "conteo_paraclinic_a": '  .intval($conteo_paraclinic_n). '';
}
if ($contador == 7 || $contador == 17) {
echo ' "color": "' .$color. '",';
$nombre_paraclinic = 'Rx de Columna';
echo ' "nombre_paraclinic": "' .$nombre_paraclinic. '",';
echo ' "conteo_paraclinic_n": '  .intval($conteo_paraclinic_n). ',';
echo ' "conteo_paraclinic_a": '  .intval($conteo_paraclinic_n). '';
}
if ($contador == 8 || $contador == 18) {
echo ' "color": "' .$color. '",';
$nombre_paraclinic = 'Otras pruebas complementarias';
echo ' "nombre_paraclinic": "' .$nombre_paraclinic. '",';
echo ' "conteo_paraclinic_n": '  .intval($conteo_paraclinic_n). ',';
echo ' "conteo_paraclinic_a": '  .intval($conteo_paraclinic_n). '';
}
if ($contador == 9 || $contador == 19) {
echo ' "color": "' .$color. '",';
$nombre_paraclinic = 'Examen por Fisioterapia';
echo ' "nombre_paraclinic": "' .$nombre_paraclinic. '",';
echo ' "conteo_paraclinic_n": '  .intval($conteo_paraclinic_n). ',';
echo ' "conteo_paraclinic_a": '  .intval($conteo_paraclinic_n). '';
}
if ($contador == 10 || $contador == 20) {
echo ' "color": "' .$color. '",';
$nombre_paraclinic = 'Laboratorios';
echo ' "nombre_paraclinic": "' .$nombre_paraclinic. '",';
echo ' "conteo_paraclinic_n": '  .intval($conteo_paraclinic_n). ',';
echo ' "conteo_paraclinic_a": '  .intval($conteo_paraclinic_n). '';
}

echo " }";
$prefix = ",\n";
}
*/

echo "\n]";
?>