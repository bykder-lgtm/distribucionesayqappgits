<?php
date_default_timezone_set("America/Bogota");
require_once('../conexiones/conexione.php');
include_once('../admin/class_php/fecha_en_espanol_mes.php');
include_once('../admin/class_php/fecha_en_espanol_mes_anyo.php');

$sql_info_empresa = "SELECT * FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$resultado_info_empresa = mysqli_query($conectar, $sql_info_empresa);
$info_empresa_data = mysqli_fetch_assoc($resultado_info_empresa);

$titulo_emp                          = $info_empresa_data['titulo'];
$nombre_emp                          = $info_empresa_data['nombre'];
$eslogan_emp                         = $info_empresa_data['eslogan'];
$direccion_emp                       = $info_empresa_data['direccion'];
$ciudad_emp                          = $info_empresa_data['ciudad'];
$correo_emp                          = $info_empresa_data['correo'];
$img_cabecera_emp                    = $info_empresa_data['img_cabecera'];
$telefono_emp                        = $info_empresa_data['telefono'];
$info_legal_emp                      = $info_empresa_data['info_legal'];
$propietario_nombres_apellidos_emp   = $info_empresa_data['propietario_nombres_apellidos'];
$propietario_nit_emp                 = $info_empresa_data['propietario_nit'];
$nit_empresa_emp                     = $info_empresa_data['nit_empresa'];
$cabecera_emp                        = $info_empresa_data['cabecera'];
$icono_emp                           = $info_empresa_data['icono'];
$nombre_font_emp                     = $info_empresa_data['nombre_font'];
$tamano_font_hc_emp                  = $info_empresa_data['tamano_font_hc'];
$tamano_font_aptlab_emp              = $info_empresa_data['tamano_font_aptlab'];
$tamano_font_trabaltu_emp            = $info_empresa_data['tamano_font_trabaltu'];
$tamano_font_manaliment_emp          = $info_empresa_data['tamano_font_manaliment'];
$tamano_font_informe_emp             = $info_empresa_data['tamano_font_informe'];
$tamano_font_remision_emp            = $info_empresa_data['tamano_font_remision'];
$tamano_font_factura_emp             = $info_empresa_data['tamano_font_factura'];
$departamento_emp                    = $info_empresa_data['departamento'];
$localidad_emp                       = $info_empresa_data['localidad'];
$reg_medico_emp                      = $info_empresa_data['reg_medico'];
$regimen_emp                         = $info_empresa_data['regimen'];
$propietario_url_firma_emp           = $info_empresa_data['propietario_url_firma'];
$fecha_time_emp                      = $info_empresa_data['fecha_time'];
$licencia_emp                        = $info_empresa_data['licencia'];
$info_histclinic_emp                 = $info_empresa_data['info_histclinic'];
$info_aptlaboral_emp                 = $info_empresa_data['info_aptlaboral'];

$serguridad_pagina                   = 1; 
$fecha                               = addslashes($_GET['fecha']);
$tipo_fecha                          = addslashes($_GET['tipo_fecha']);
$nombre_empresa                      = addslashes($_GET['nombre_empresa']);
$fecha_hoy_ymd_seg                   = strtotime(date("Y/m/d"));

$fecha_mes_llegada                   = '01/'.$fecha;
$fragment                            = explode('/', $fecha_mes_llegada);
$dia_frag                            = $fragment[0];
$mes_frag                            = $fragment[1];
$any_frag                            = $fragment[2];
$fecha_time                          = strtotime($any_frag.'/'.$mes_frag.'/'.$dia_frag);
$fecha_mes_ini_esp                   = fecha_en_espanol_mes($fecha_time);
$fecha_mes_anyo_ini_esp              = fecha_en_espanol_mes_anyo($fecha_time);

if ($tipo_fecha == "fecha_mes") {
$frag_ini                    = explode('/', $fecha);
$mes_ini                     = $frag_ini[0];
$anyo_ini                    = $frag_ini[1];
}
?>
<!DOCTYPE HTML>
<head>
<meta charset="utf-8">
<title><?php echo $nombre_emp;?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<link href="<?php echo $icono_emp;?>" type="image/x-icon" rel="shortcut icon" />
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php //include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<style>
#chartdiv01 { width: 100%; height: 600px; font-size: 15px; }
#chartdiv02 { width: 100%; height: 600px; font-size: 15px; }
#chartdiv03 { width: 100%; height: 600px; font-size: 15px; }
#chartdiv04 { width: 100%; height: 600px; font-size: 15px; }
#chartdiv05 { width: 100%; height: 600px; font-size: 15px; }
#chartdiv06 { width: 100%; height: 600px; font-size: 15px; }
#chartdiv07 { width: 100%; height: 600px; font-size: 15px; }
#chartdiv08 { width: 100%; height: 600px; font-size: 15px; }
#chartdiv09 { width: 100%; height: 600px; font-size: 15px; }
#chartdiv10 { width: 100%; height: 600px; font-size: 15px; }
#chartdiv11 { width: 100%; height: 600px; font-size: 15px; }
#chartdiv12 { width: 100%; height: 600px; font-size: 15px; }
#chartdiv13 { width: 100%; height: 600px; font-size: 15px; }
#chartdiv14 { width: 100%; height: 600px; font-size: 15px; }
#chartdiv15 { width: 100%; height: 600px; font-size: 15px; }

.amcharts-pie-slice {
transform: scale(1); transform-origin: 50% 50%; transition-duration: 0.3s; transition: all .3s ease-out; -webkit-transition: all .3s ease-out; 
-moz-transition: all .3s ease-out; -o-transition: all .3s ease-out; cursor: pointer; box-shadow: 0 0 30px 0 #000;
}
.amcharts-pie-slice:hover { transform: scale(1.1); filter: url(#shadow); }             
</style>
<!-- Resources -->

<script src="../js/amcharts_graf/amcharts.js"></script>
<script src="../js/amcharts_graf/funnel.js"></script>
<script src="../js/amcharts_graf/pie.js"></script>
<script src="../js/amcharts_graf/serial.js" type="text/javascript"></script>
<script type="text/javascript" src="../js/amcharts_graf/dataloader.min.js"></script>
<script src="../js/amcharts_graf/plugins/export/export.min.js"></script>
<link rel="stylesheet" href="../js/amcharts_graf/plugins/export/export.css" type="text/css" media="all" />
<script src="../js/amcharts_graf/themes/light.js"></script>
<script src="../js/amcharts_graf/themes/black.js"></script>
<script src="../js/amcharts_graf/themes/chalk.js"></script>
<script src="../js/amcharts_graf/themes/dark.js"></script>
<script src="../js/amcharts_graf/themes/patterns.js"></script>

</head>
<body id="pageBody">
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php //include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php //$pagina = addslashes($_GET['pagina']); ?>
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">
<div class="breadcrumbs"><a href="#"><h4>Informe Mensual Por Empresa</h4></a></div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$query1 = "SELECT Count(cod_estado_facturacion) AS conteo_estado_facturacion, cod_estado_facturacion FROM tbl15_historia_clinica 
WHERE ((($tipo_fecha)='$fecha')  AND (cod_estado_facturacion=1) AND ((nombre_empresa)='$nombre_empresa')) GROUP BY cod_estado_facturacion";
$result1 = mysqli_query($conectar, $query1);
$datos1 = mysqli_fetch_assoc($result1);

$query2 = "SELECT Count(cod_estado_facturacion) AS conteo_estado_facturacion, cod_estado_facturacion FROM tbl15_historia_clinica 
WHERE ((($tipo_fecha)='$fecha')  AND ((cod_estado_facturacion)=2) AND ((nombre_empresa)='$nombre_empresa')) GROUP BY cod_estado_facturacion";
$result2 = mysqli_query($conectar, $query2);
$datos2 = mysqli_fetch_assoc($result2);

$poblacion_eval              = $datos1['conteo_estado_facturacion'];
$poblacion_no_eval           = $datos2['conteo_estado_facturacion'];
$total_poblacion             = $poblacion_eval + $poblacion_no_eval;
?>
<div class="table-responsive">
<table class="table table-striped" style="font-family:mono;  font-size:<?php echo $tamano_font_informe_emp ?>pt">
<tbody>
<tr><td style="text-align:center"><strong>DIAGNÓSTICO DE CONDICIONES DE SALUD</strong></td></tr>
<tr><td style="text-align:center"><strong><?php echo $nombre_empresa ?></strong></td></tr>
<tr><td style="text-align:center"><strong>ELABORADO POR: <?php echo $nombre_emp ?></strong></td></tr>
<tr><td style="text-align:center"><strong><?php echo $fecha_mes_anyo_ini_esp ?></strong></td></tr>


<tr><td style="text-align:center"><strong>INTRODUCCIÓN</strong></td></tr>
<tr><td style="text-align:justify">El Diagnóstico de Salud constituye una de las tareas claves dentro del análisis de información de Salud y 
Seguridad en el Trabajo. Esta fundamentado en la información recolectada durante la realización de las actividades de Medicina del trabajo y 
hoy en día constituye una herramienta básica para el equipo de Salud y Seguridad en el Trabajo en la toma de decisiones.
<br><br>
Se realiza con base en la información recolectada a partir de los exámenes médicos y paraclìnicos, su importancia radica en los hallazgos, las 
asociaciones exposición-efecto y análisis del comportamiento de las diferentes variables a través del tiempo.
<br><br>
Su realización comprende varias etapas sucesivas donde se determinan las fuentes de información, se establecen los formatos de recolección 
de información, se identifican y priorizan las variables a estudiar, posteriormente se realiza un análisis cruzando las variables más relevantes 
para el área de Salud y Seguridad en el Trabajo.
<br><br>
Las variables a evaluar se pueden clasificar en grandes grupos, las asociadas al individuo, las asociadas al puesto de trabajo y los hallazgos 
clínicos, buscando siempre la correlación de los factores de riesgo del puesto de trabajo y la condición clínica de cada persona.
<br><br>
Finalmente se establecen una serie de recomendaciones generales para ser ejecutadas por parte de todos los actores del Sistema de Gestión de Salud 
y Seguridad en el Trabajo. Las personas asignadas a la administración del sistema de gestión se encargarán de la vigilancia y control del cumplimiento de dichas recomendaciones.
</td></tr>


<tr><td style="text-align:left"><strong>1. OBJETIVOS</strong></td></tr>
<tr><td style="text-align:justify">Caracterizar la población del <?php echo $nombre_empresa ?> mediante el análisis de información contenida en 
  la Historia Clínica Ocupacional, evaluando variables sociodemográficas, laborales, antecedentes médicos,  hábitos de vida, morbilidad sentida, 
  resultados y análisis de pruebas complementarias y diagnósticos realizados.
<br><br>
Establecer las patologías de origen común y profesional de mayor incidencia y prevalencia con el fin de diseñar actividades de prevención de la 
enfermedad tendientes a disminuir su aparición y evitando el deterioro y/o las complicaciones de las que ya estuvieren presentes.
<br><br>
Establecer la asociación entre los factores de riesgo del puesto de trabajo con la morbilidad sentida y los hallazgos clínicos realizados por los 
profesionales de salud, para determinar las estrategias de control en la fuente, el medio y el trabajador.
<br><br>
Recomendar actividades de Promoción de la salud y Prevención de la enfermedad, de aplicación colectiva, a seguir en los próximos meses de acuerdo 
con la situación diagnosticada.
</td></tr>

<tr><td style="text-align:left"><strong>2. MATERIALES Y MÉTODOS</strong></td></tr>
<tr><td style="text-align:left">Fuentes de Información</td></tr>
<tr><td style="text-align:left">Las fuentes de información utilizadas para realizar el diagnóstico de salud fueron las siguientes:</td></tr>
<tr><td style="text-align:left"><img src="../imagenes/carpeta_logo.png"> Historias clínicas de exámenes médicos ocupacionales, realizadas entre mes de año a mes de año a la población trabajadora. </td></tr>
<tr><td style="text-align:left"><img src="../imagenes/carpeta_logo.png"> Perfiles médicos y psicológicos de cargo. </td></tr>
<tr><td style="text-align:left"><img src="../imagenes/carpeta_logo.png"> Profesiogramas realizados en el año. </td></tr>
<tr><td style="text-align:left"><img src="../imagenes/carpeta_logo.png"> Planta de personal de la tbl15_empresa.</td></tr>
<tr><td style="text-align:left"><img src="../imagenes/carpeta_logo.png"> Informes de Accidentalidad consolidados año-año.</td></tr>
<tr><td style="text-align:left"><img src="../imagenes/carpeta_logo.png"> Informe de Enfermedades profesionales año-año.</td></tr>

<tr><td style="text-align:left">Procesamiento de Datos:</td></tr>
<tr><td style="text-align:left">•	Herramienta usada para el almacenamiento y procesamiento de la información</td></tr>


<tr><td style="text-align:left"><strong>3. RESULTADOS CONSOLIDADOS</strong></td></tr>
<tr><td style="text-align:justify">Los hallazgos de la Evaluación Médica Ocupacional de la población trabajadora del <?php echo $nombre_empresa ?>, se presentan a continuación en tablas y gráficas que reflejan la situación general de salud de la Empresa.</td></tr>

<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

<tr><td style="text-align:left"><strong>3.1. CARACTERÍSTICAS SOCIODEMOGRÁFICAS DE LA POBLACIÓN</strong></td></tr>
<tr><td style="text-align:left">3.1.1. Población Evaluada</td></tr>

<tr><td style="text-align:justify">Se evaluó a los trabajadores del <?php echo $nombre_empresa ?>, teniendo como base una población objeto de 
<?php echo $total_poblacion ?> funcionarios, practicando <?php echo $poblacion_eval ?> exámenes médicos ocupacionales 
entre mes de <?php echo $fecha_mes_ini_esp ?> del año <?php echo $anyo_ini ?> a mes de <?php echo $fecha_mes_ini_esp ?> del año <?php echo $anyo_ini ?>, con una cobertura del 100%. </td></tr>

<center>
<?php
$query1 = "SELECT tbl15_historia_clinica.$tipo_fecha, tbl15_historia_clinica.cod_estado_facturacion, 
Count(tbl15_historia_clinica.dat_ocupa_carg1) AS conteo_dat_ocupa_carg1, tbl15_historia_clinica.dat_ocupa_carg1, tbl15_historia_clinica.nombre_empresa
FROM tbl15_historia_clinica
GROUP BY tbl15_historia_clinica.$tipo_fecha, tbl15_historia_clinica.cod_estado_facturacion, tbl15_historia_clinica.dat_ocupa_carg1, tbl15_historia_clinica.nombre_empresa
HAVING (((tbl15_historia_clinica.$tipo_fecha)='$fecha') AND ((tbl15_historia_clinica.cod_estado_facturacion)=1) AND ((tbl15_historia_clinica.nombre_empresa)='$nombre_empresa'))";
$result1 = mysqli_query($conectar, $query1);

$query2 = "SELECT tbl15_historia_clinica.$tipo_fecha, tbl15_historia_clinica.cod_estado_facturacion, 
Count(tbl15_historia_clinica.dat_ocupa_carg1) AS conteo_dat_ocupa_carg1, tbl15_historia_clinica.dat_ocupa_carg1, tbl15_historia_clinica.nombre_empresa
FROM tbl15_historia_clinica
GROUP BY tbl15_historia_clinica.$tipo_fecha, tbl15_historia_clinica.cod_estado_facturacion, tbl15_historia_clinica.nombre_empresa
HAVING (((tbl15_historia_clinica.$tipo_fecha)='$fecha') AND ((tbl15_historia_clinica.cod_estado_facturacion)=1) AND ((tbl15_historia_clinica.nombre_empresa)='$nombre_empresa'))";
$result2 = mysqli_query($conectar, $query2);
$datos2 = mysqli_fetch_assoc($result2);
?>
<div class="table-responsive">
<table class="table table-bordered" style="font-family:mono;  font-size:<?php echo $tamano_font_informe_emp ?>pt">
<thead class="thead-dark">
<tr>
    <th style="text-align:center">ÁREA O SECCIÓN</th>
    <th style="text-align:center">POBLACION TOTAL</th>
    <th style="text-align:center">POBLACIÓN EXAMINADA</th>
    <th style="text-align:center">%</th>
</tr>
</thead>
<tbody>
<?php
$total_smtr_dat_ocupa_carg1     = $datos2['conteo_dat_ocupa_carg1'];
$smtr_porcentaje                = 0;

while ($datos = mysqli_fetch_assoc($result1) ) { 

$dat_ocupa_carg1              = $datos['dat_ocupa_carg1'];
$conteo_dat_ocupa_carg1       = $datos['conteo_dat_ocupa_carg1'];
$porcentaje_dat_ocupa_carg1   = (($conteo_dat_ocupa_carg1 / $total_smtr_dat_ocupa_carg1) * 100);
$smtr_porcentaje             += $porcentaje_dat_ocupa_carg1;
?>
<tr>
    <td><?php echo $dat_ocupa_carg1 ?></td>
    <td style="text-align:center"><?php echo $conteo_dat_ocupa_carg1 ?></td>
    <td style="text-align:center"><?php echo $conteo_dat_ocupa_carg1 ?></td>
    <td style="text-align:center"><?php echo  round($porcentaje_dat_ocupa_carg1, 2) ?>%</td>
</tr>
<?php } ?>
<tr class="table-dark">
    <th style="text-align:center">TOTAL</th>
    <th style="text-align:center"><?php echo $total_poblacion ?></th>
    <th style="text-align:center"><?php echo $total_poblacion ?></th>
    <th style="text-align:center"><?php echo intval($smtr_porcentaje) ?>%</th>
</tr>
</tbody>
</table>
</div>

<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script>
var chartdiv01 = AmCharts.makeChart("chartdiv01", {
"type": "pie",
dataLoader: { "url": "data_Pie_Chart_with_Legend_mes_personevaluada_json.php?fecha=<?php echo $fecha ?>&tipo_fecha=<?php echo $tipo_fecha ?>&nombre_empresa=<?php echo $nombre_empresa ?>" },
    "titleField": "nombre_person_eval",
    "valueField": "conteo_estado_facturacion",
    "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
    "legend": {
        "align": "center",
        "markerType": "circle"
    }
});
</script>
<div id="chartdiv01"></div>

<p>Ilustración 1: Proporción de personas evaluadas<br><br></p>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<?php
$query1 = "SELECT Count(tbl15_cliente.nombre_sexo) AS conteo_nombre_sexo, tbl15_cliente.nombre_sexo, tbl15_historia_clinica.nombre_empresa
FROM tbl15_cliente RIGHT JOIN tbl15_historia_clinica ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente 
WHERE (((tbl15_historia_clinica.$tipo_fecha)='$fecha') AND ((tbl15_historia_clinica.cod_estado_facturacion)=1) AND ((tbl15_cliente.nombre_sexo)='M') AND ((tbl15_historia_clinica.nombre_empresa)='$nombre_empresa'))
GROUP BY tbl15_cliente.nombre_sexo";
$result1 = mysqli_query($conectar, $query1);
$datos1 = mysqli_fetch_assoc($result1);

$query2= "SELECT Count(tbl15_cliente.nombre_sexo) AS conteo_nombre_sexo, tbl15_cliente.nombre_sexo, tbl15_historia_clinica.nombre_empresa
FROM tbl15_cliente RIGHT JOIN tbl15_historia_clinica ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente 
WHERE (((tbl15_historia_clinica.$tipo_fecha)='$fecha') AND ((tbl15_historia_clinica.cod_estado_facturacion)=1) AND ((tbl15_cliente.nombre_sexo)='F') AND ((tbl15_historia_clinica.nombre_empresa)='$nombre_empresa'))
GROUP BY tbl15_cliente.nombre_sexo";
$result2 = mysqli_query($conectar, $query2);
$datos2 = mysqli_fetch_assoc($result2);

$sexo_masculino         = $datos1['conteo_nombre_sexo'];
$sexo_femenino          = $datos2['conteo_nombre_sexo'];
$total_smtr_sexo             = $sexo_masculino + $sexo_femenino;

if ($sexo_masculino > $sexo_femenino) {
$sexo_txt = 'MASCULINO';
$porcentaje_sexo = ($sexo_masculino / $total_smtr_sexo) * 100;
} else {
$sexo_txt = 'FEMENINO';
$porcentaje_sexo = ($sexo_femenino / $total_smtr_sexo) * 100;
}
?>
<tr><td style="text-align:left"><strong>3.1.2. Distribución por Sexo</strong></td></tr>
<tr><td style="text-align:left"><br><br>Se encontró predominio del tbl15_sexo <?php echo $sexo_txt ?> con el <?php echo round($porcentaje_sexo, 2) ?>%.<br>La siguiente tabla muestra la distribución por tbl15_sexo y áreas (o secciones, cargos, etc.).</td></tr>

<script>
var chartdiv02 = AmCharts.makeChart("chartdiv02", {
"type": "pie",
dataLoader: { "url": "data_Pie_Chart_with_Legend_mes_sexo_json.php?fecha=<?php echo $fecha ?>&tipo_fecha=<?php echo $tipo_fecha ?>&nombre_empresa=<?php echo $nombre_empresa ?>" },
    "titleField": "nombre_sexo",
    "valueField": "conteo_nombre_sexo",
    "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
    "legend": {
        "align": "center",
        "markerType": "circle"
    }
});
</script>
<div id="chartdiv02"></div>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<?php
$query1 = "SELECT tbl15_historia_clinica.$tipo_fecha, tbl15_cliente.fecha_nac_time, 
tbl15_cliente.fecha_nac_ymd, tbl15_historia_clinica.cod_estado_facturacion, tbl15_historia_clinica.nombre_empresa
FROM tbl15_cliente RIGHT JOIN tbl15_historia_clinica ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente
HAVING (((tbl15_historia_clinica.$tipo_fecha)='$fecha') AND ((tbl15_historia_clinica.cod_estado_facturacion)=1) AND ((tbl15_historia_clinica.nombre_empresa)='$nombre_empresa'))";
$result1 = mysqli_query($conectar, $query1);

$conteo1              = 0;
$conteo2              = 0;
$conteo3              = 0;
$conteo4              = 0;
$conteo5              = 0;
$total_edad_20_00     = 0;
$total_edad_20_29     = 0;
$total_edad_30_39     = 0;
$total_edad_40_49     = 0;
$total_edad_50_00     = 0;

while ($dato01 = mysqli_fetch_assoc($result1)) {

$fecha_nac_time       = $dato01['fecha_nac_time'];
$diferencia_edad      = abs($fecha_hoy_ymd_seg - $fecha_nac_time);
$edad_anyo            = floor($diferencia_edad / (365*24*60*60));

if (($edad_anyo < 20))                        {   $total_edad_20_00   = $total_edad_20_00 + 1;  }
if (($edad_anyo >= 20) && ($edad_anyo <= 29)) {   $total_edad_20_29   = $total_edad_20_29 + 1;  }
if (($edad_anyo >= 30) && ($edad_anyo <= 39)) {   $total_edad_30_39   = $total_edad_30_39 + 1;  }
if (($edad_anyo >= 40) && ($edad_anyo <= 49)) {   $total_edad_40_49   = $total_edad_40_49 + 1;  }
if (($edad_anyo >= 50))                       {   $total_edad_50_00   = $total_edad_50_00 + 1;  }
}
$vector_edad             = array($total_edad_20_00, $total_edad_20_29, $total_edad_30_39, $total_edad_40_49, $total_edad_50_00);
$rango_mas_valores       = max($vector_edad);
$suma_edad               = array_sum($vector_edad);

for($i=0;$i<count($vector_edad);$i++) {
    if($vector_edad[$i]==$rango_mas_valores) {
        $posicion_indice = $i;
        }
}

$contador = 0;
$ptj_edad_final = 0;

foreach ($vector_edad as &$conteo_vector_edad) {
$contador ++;

        if ($contador == 0) { $ptj_edad = ($total_edad_20_00 / $total_poblacion) * 100; $nombre_posicion_vector = 'Menor 20'; }
        if ($contador == 1) { $ptj_edad = ($total_edad_20_29 / $total_poblacion) * 100; $nombre_posicion_vector = '20 - 29'; }
        if ($contador == 2) { $ptj_edad = ($total_edad_30_39 / $total_poblacion) * 100; $nombre_posicion_vector = '30 - 39'; }
        if ($contador == 3) { $ptj_edad = ($total_edad_40_49 / $total_poblacion) * 100; $nombre_posicion_vector = '40 - 49'; }
        if ($contador == 4) { $ptj_edad = ($total_edad_50_00 / $total_poblacion) * 100; $nombre_posicion_vector = 'MAYOR 50'; }

        if ($ptj_edad > $ptj_edad_final) {
            $ptj_edad_final = $ptj_edad;
            $conteo = $contador;
        }
}
unset($conteo_vector_edad);

        if ($posicion_indice == 0) { $ptj_edad = ($total_edad_20_00 / $total_poblacion) * 100; $nombre_posicion_vector = 'Menor 20'; }
        if ($posicion_indice == 1) { $ptj_edad = ($total_edad_20_29 / $total_poblacion) * 100; $nombre_posicion_vector = '20 - 29'; }
        if ($posicion_indice == 2) { $ptj_edad = ($total_edad_30_39 / $total_poblacion) * 100; $nombre_posicion_vector = '30 - 39'; }
        if ($posicion_indice == 3) { $ptj_edad = ($total_edad_40_49 / $total_poblacion) * 100; $nombre_posicion_vector = '40 - 49'; }
        if ($posicion_indice == 4) { $ptj_edad = ($total_edad_50_00 / $total_poblacion) * 100; $nombre_posicion_vector = 'MAYOR 50'; }
?>
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

<br>

<tr><td style="text-align:left"><strong>3.1.3. Distribución de la población según Grupo Etário</strong></td></tr>
<br><br>
<tr><td style="text-align:left">Un <?php echo round($ptj_edad_final, 2) ?> % de las personas evaluadas se encuentran en el rango de <?php echo $nombre_posicion_vector ?> años</td></tr>

<script>
var chartdiv03 = AmCharts.makeChart("chartdiv03", {
"type": "pie",
dataLoader: { "url": "data_Pie_Chart_with_Legend_mes_edad_json.php?fecha=<?php echo $fecha ?>&tipo_fecha=<?php echo $tipo_fecha ?>&nombre_empresa=<?php echo $nombre_empresa ?>" },
    "titleField": "nombre_edad_anyo",
    "valueField": "conteo_edad_anyo",
    "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
    "legend": {
        "align": "center",
        "markerType": "circle"
    }
});
</script>
<div id="chartdiv03"></div>


<div class="table-responsive">
<table class="table table-bordered" style="font-family:mono;  font-size:<?php echo $tamano_font_informe_emp ?>pt">
<thead class="thead-dark">
<tr>
<th style="text-align:center">RANGO EDAD</th>
<th style="text-align:center">No</th>
<th style="text-align:center">%</th>
</tr>
</thead>
<tbody>
<?php
for($i=0; $i<count($vector_edad); $i++) {

  $posicion_vector = $i;

  if ($posicion_vector == 0) { $ptj_edad = ($total_edad_20_00 / $total_poblacion) * 100; $nombre_posicion_vector = 'Menor 20'; }
  if ($posicion_vector == 1) { $ptj_edad = ($total_edad_20_29 / $total_poblacion) * 100; $nombre_posicion_vector = '20 - 29'; }
  if ($posicion_vector == 2) { $ptj_edad = ($total_edad_30_39 / $total_poblacion) * 100; $nombre_posicion_vector = '30 - 39'; }
  if ($posicion_vector == 3) { $ptj_edad = ($total_edad_40_49 / $total_poblacion) * 100; $nombre_posicion_vector = '40 - 49'; }
  if ($posicion_vector == 4) { $ptj_edad = ($total_edad_50_00 / $total_poblacion) * 100; $nombre_posicion_vector = 'MAYOR 50'; }
?>
<tr>
<td><?php echo $nombre_posicion_vector ?></td>
<td style="text-align:center"><?php echo $vector_edad[$i] ?></td>
<td style="text-align:center"><?php echo round($ptj_edad, 2) ?>%</td>
</tr>
<?php } ?>
<tr class="table-dark">
<th>TOTAL</th>
<th style="text-align:center"><?php echo $total_poblacion ?></th>
<th style="text-align:center">100%</th>
</tr>
</tbody>
</table>
</div>
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<?php
$query1 = "SELECT $tipo_fecha, cod_estado_facturacion, Count(nombre_escolaridad) AS conteo_nombre_escolaridad, nombre_escolaridad, nombre_empresa
FROM tbl15_historia_clinica
GROUP BY tbl15_historia_clinica.$tipo_fecha, cod_estado_facturacion, nombre_escolaridad, nombre_empresa
HAVING (((tbl15_historia_clinica.$tipo_fecha)='$fecha') AND (cod_estado_facturacion=1) AND ((nombre_empresa)='$nombre_empresa')) ORDER BY conteo_nombre_escolaridad DESC LIMIT 0,3";
$result1 = mysqli_query($conectar, $query1);

$contador            = 0;

while ($datos1 = mysqli_fetch_assoc($result1) ) {
$contador++;

$nombre_escolaridad           = $datos1['nombre_escolaridad'];
$conteo_nombre_escolaridad    = $datos1['conteo_nombre_escolaridad'];

if ($contador == 1) { $pos1_nombre_escolaridad = $nombre_escolaridad; $pos1_conteo_escolaridad = $conteo_nombre_escolaridad; $pos1_ptj_escolaridad = ($pos1_conteo_escolaridad / $total_poblacion) * 100; }
if ($contador == 2) { $pos2_nombre_escolaridad = $nombre_escolaridad; $pos2_conteo_escolaridad = $conteo_nombre_escolaridad; $pos2_ptj_escolaridad = ($pos2_conteo_escolaridad / $total_poblacion) * 100; }
if ($contador == 3) { $pos3_nombre_escolaridad = $nombre_escolaridad; $pos3_conteo_escolaridad = $conteo_nombre_escolaridad; $pos3_ptj_escolaridad = ($pos3_conteo_escolaridad / $total_poblacion) * 100; }
}
?>

<br>

<tr><td style="text-align:left"><strong>3.1.4 Distribución del Nivel de Escolaridad de la población</strong></td></tr>
<br><br>
<tr><td style="text-align:center">El Nivel de tbl15_escolaridad, con mayor porcentaje dentro de la Empresa corresponde a 
<?php echo $pos1_nombre_escolaridad ?> con un <?php echo round($pos1_ptj_escolaridad, 2) ?>%; 
en segundo lugar está <?php echo $pos2_nombre_escolaridad ?>, con <?php echo round($pos2_conteo_escolaridad, 2) ?>%; 
en tercer lugar <?php echo $pos3_nombre_escolaridad ?>, con <?php echo round($pos3_ptj_escolaridad, 2) ?>%.</td></tr>

<script>
var chartdiv04 = AmCharts.makeChart("chartdiv04", {
    "theme": "light",
    "type": "serial",
    "titles": [ {
     "text": "ESCOLARIDAD",
     "size": 16
    } ],
    dataLoader: { "url": "data_3D_Column_Chart_mes_escolaridad.php?fecha=<?php echo $fecha ?>&tipo_fecha=<?php echo $tipo_fecha ?>&nombre_empresa=<?php echo $nombre_empresa ?>" },

    "valueAxes": [{
        "title": "Total"
    }],
    "graphs": [{
        "balloonText": "ESCOLARIDAD: [[category]] - [[value]]",
        "fillAlphas": 1,
        "lineAlpha": 0.2,
        "title": "ESCOLARIDAD",
        "type": "column",
        "valueField": "conteo_nombre_escolaridad"
    }],
    "depth3D": 20,
    "angle": 30,
    "rotate": true,
    "categoryField": "nombre_escolaridad",
    "categoryAxis": {
        "gridPosition": "start",
        "fillAlpha": 0.05,
        "position": "left"
    },
    "export": {
      "enabled": true
     }
});
</script>
<div id="chartdiv04"></div> 

<div class="table-responsive">
<table class="table table-bordered" style="font-family:mono;  font-size:<?php echo $tamano_font_informe_emp ?>pt">
<thead class="thead-dark">
<tr>
    <th style="text-align:center">NIVEL DE ESCOLARIDAD</th>
    <th style="text-align:center">Total</th>
    <th style="text-align:center">%</th>
</tr>
</thead>
<tbody>
<?php
$query2 = "SELECT $tipo_fecha, cod_estado_facturacion, Count(nombre_escolaridad) AS conteo_nombre_escolaridad, nombre_escolaridad, nombre_empresa
FROM tbl15_historia_clinica
GROUP BY tbl15_historia_clinica.$tipo_fecha, cod_estado_facturacion, nombre_escolaridad, nombre_empresa
HAVING (((tbl15_historia_clinica.$tipo_fecha)='$fecha') AND (cod_estado_facturacion=1) AND ((nombre_empresa)='$nombre_empresa')) ORDER BY conteo_nombre_escolaridad DESC";
$result2 = mysqli_query($conectar, $query2);

$smtr_porcentaje            = 0;

while ($datos2 = mysqli_fetch_assoc($result2) ) {

$nombre_escolaridad           = $datos2['nombre_escolaridad'];
$conteo_nombre_escolaridad    = $datos2['conteo_nombre_escolaridad'];
$porcentaje_escolaridad       = ((($conteo_nombre_escolaridad / $total_poblacion) * 100));
$smtr_porcentaje             += $porcentaje_escolaridad;
?>
<tr>
    <td style="text-align:left"><?php echo $nombre_escolaridad ?></td>
    <td style="text-align:center"><?php echo $conteo_nombre_escolaridad ?></td>
    <td style="text-align:center"><?php echo round($porcentaje_escolaridad, 2) ?>%</td>
</tr>
<?php } ?>
<tr class="table-dark">
    <th style="text-align:center">TOTAL</th>
    <th style="text-align:center"><?php echo $total_poblacion ?></th>
    <th style="text-align:center"><?php echo $smtr_porcentaje ?>%</th>
</tr>
</tbody>
</table>
</div>

<br>
<?php
$query2 = "SELECT $tipo_fecha, cod_estado_facturacion, Count(dat_ocupa_carg1) AS contar_dat_ocupa_carg1, dat_ocupa_carg1, nombre_empresa
FROM tbl15_historia_clinica
GROUP BY $tipo_fecha, cod_estado_facturacion, dat_ocupa_carg1, nombre_empresa
HAVING ((($tipo_fecha)='$fecha') AND (cod_estado_facturacion=1) AND ((nombre_empresa)='$nombre_empresa')) ORDER BY conteo_dat_ocupa_carg1 DESC";
$result2 = mysqli_query($conectar, $query2);

$query1 = "SELECT $tipo_fecha, cod_estado_facturacion, Count(dat_ocupa_carg1) AS conteo_dat_ocupa_carg1, dat_ocupa_carg1, nombre_empresa
FROM tbl15_historia_clinica
GROUP BY $tipo_fecha, cod_estado_facturacion, dat_ocupa_carg1, nombre_empresa
HAVING ((($tipo_fecha)='$fecha') AND (cod_estado_facturacion=1) AND ((nombre_empresa)='$nombre_empresa')) ORDER BY conteo_dat_ocupa_carg1 DESC";
$result1 = mysqli_query($conectar, $query1);
?>
<tr><td style="text-align:left"><strong>3.2. CARACTERÍSTICAS LABORALES</strong></td></tr>
<br><br>
<tr><td style="text-align:left"><strong>3.2.1. Distribución de la población según Cargos</strong></td></tr>
<br>
<tr><td style="text-align:center">Los cargos predominantes en los evaluados fueron:</td></tr>
<br>

<div class="table-responsive">
<table class="table table-bordered" style="font-family:mono;  font-size:<?php echo $tamano_font_informe_emp ?>pt">
<thead class="thead-dark">
<tr>
    <th style="text-align:center">#</th>
    <th style="text-align:center">CARGO</th>
    <th style="text-align:center">Total</th>
    <th style="text-align:center">%</th>
</tr>
</thead>
<tbody>
<?php
$conteo = 0;
while ($datos = mysqli_fetch_assoc($result1) ) {
$conteo++;
$dat_ocupa_carg1          = $datos['dat_ocupa_carg1'];
$conteo_dat_ocupa_carg1   = $datos['conteo_dat_ocupa_carg1'];
$ptj_carg                 = ($conteo_dat_ocupa_carg1 / $total_poblacion) * 100;
?>
<tr>
    <td style="text-align:center"><?php echo $conteo ?></td>
    <td style="text-align:left"><?php echo $dat_ocupa_carg1 ?></td>
    <td style="text-align:center"><?php echo $conteo_dat_ocupa_carg1 ?></td>
    <td style="text-align:center"><?php echo round($ptj_carg, 2) ?>%</td>

</tr>
<?php } ?>
</tbody>
</table>
</div>
<br>

<script>
var chartdiv05 = AmCharts.makeChart("chartdiv05", {
    "theme": "light",
    "type": "serial",
    "titles": [ {
     "text": "DENOMINACIÓN DEL CARGO",
     "size": 16
    } ],
    dataLoader: { "url": "data_3D_Column_Chart_mes_cargo.php?fecha=<?php echo $fecha ?>&tipo_fecha=<?php echo $tipo_fecha ?>&nombre_empresa=<?php echo $nombre_empresa ?>" },

    "valueAxes": [{
        "title": "Total"
    }],
    "graphs": [{
        "balloonText": "CARGO: [[category]] - [[value]]",
        "fillAlphas": 1,
        "lineAlpha": 0.2,
        "title": "CARGO",
        "type": "column",
        "valueField": "conteo_dat_ocupa_carg1"
    }],
    "depth3D": 20,
    "angle": 30,
    "rotate": true,
    "categoryField": "dat_ocupa_carg1",
    "categoryAxis": {
        "gridPosition": "start",
        "fillAlpha": 0.05,
        "position": "left"
    },
    "export": {
      "enabled": true
     }
});
</script>
<div id="chartdiv05"></div> 

<?php
$query1 = "SELECT $tipo_fecha, dat_ocupa_dura_anyo1, cod_estado_facturacion, nombre_empresa
FROM tbl15_historia_clinica
HAVING (((tbl15_historia_clinica.$tipo_fecha)='$fecha') AND (cod_estado_facturacion=1) AND ((nombre_empresa)='$nombre_empresa'))";
$result1 = mysqli_query($conectar, $query1);

$total_edad_02_00  = 0;
$total_edad_02_05  = 0;
$total_edad_06_10  = 0;
$total_edad_11_15  = 0;
$total_edad_16_20  = 0;
$total_edad_21_00  = 0;

while ($dato01 = mysqli_fetch_assoc($result1)) {

$dat_ocupa_dura_anyo1           = $dato01['dat_ocupa_dura_anyo1'];

if ($dat_ocupa_dura_anyo1 < 2)                                      { $total_edad_02_00 = $total_edad_02_00 + 1; }
if (($dat_ocupa_dura_anyo1 >= 2) && ($dat_ocupa_dura_anyo1 <= 5))   { $total_edad_02_05 = $total_edad_02_05 + 1; }
if (($dat_ocupa_dura_anyo1 >= 6) && ($dat_ocupa_dura_anyo1 <= 10))  { $total_edad_06_10 = $total_edad_06_10 + 1; }
if (($dat_ocupa_dura_anyo1 >= 11) && ($dat_ocupa_dura_anyo1 <= 15)) { $total_edad_11_15 = $total_edad_11_15 + 1; }
if (($dat_ocupa_dura_anyo1 >= 16) && ($dat_ocupa_dura_anyo1 <= 20)) { $total_edad_16_20 = $total_edad_16_20 + 1; }
if (($dat_ocupa_dura_anyo1 >= 21))                                  { $total_edad_21_00 = $total_edad_21_00 + 1; }
}
$vector_edad_distrib             = array($total_edad_02_00, $total_edad_02_05, $total_edad_06_10, $total_edad_11_15, $total_edad_16_20, $total_edad_21_00);
$rango_mas_valores               = max($vector_edad_distrib);

$posicion_indice = 0;
for($i=0;$i<count($vector_edad_distrib);$i++) {
    if($vector_edad_distrib[$i] == $rango_mas_valores) {
        $posicion_indice = $i;
        }
}

if ($posicion_indice == 0) { $ptj_edad = ($total_edad_20_00 / $total_poblacion) * 100; $nombre_posicion_vector = 'Menor de 2 Años'; }
if ($posicion_indice == 1) { $ptj_edad = ($total_edad_20_29 / $total_poblacion) * 100; $nombre_posicion_vector = 'De 2 a 5 Años'; }
if ($posicion_indice == 2) { $ptj_edad = ($total_edad_30_39 / $total_poblacion) * 100; $nombre_posicion_vector = 'De 6 a 10 Años'; }
if ($posicion_indice == 3) { $ptj_edad = ($total_edad_40_49 / $total_poblacion) * 100; $nombre_posicion_vector = 'De 11 a 15 Años'; }
if ($posicion_indice == 4) { $ptj_edad = ($total_edad_50_00 / $total_poblacion) * 100; $nombre_posicion_vector = 'De 16 a 20 Años'; }
if ($posicion_indice == 5) { $ptj_edad = ($total_edad_50_00 / $total_poblacion) * 100; $nombre_posicion_vector = 'Mayor de 20 Años'; }
?>
<br><br>
<tr><td style="text-align:left"><strong>3.2.2 Distribución de la Población por Antigüedad </strong></td></tr>
<br><br>
<tr><td style="text-align:center">El porcentaje predominante corresponde a los Trabajadores <?php echo $nombre_posicion_vector ?> de antigüedad en la Empresa.</td></tr>


<script>
var chartdiv06 = AmCharts.makeChart("chartdiv06", {
  "type": "pie", 
  "startDuration": 0,
  "theme": "light",
  "addClassNames": true,
  "titles": [ {
  "text": "DISTRIBUCION POR ANTIGUEDAD",
  "size": 16
  } ],
  "legend":{
  "position":"right",
  "marginRight":100,
  "autoMargins":false
  },
  "innerRadius": "30%",
  "defs": {
    "filter": [{
      "id": "shadow",
      "width": "200%",
      "height": "200%",
      "feOffset": {
        "result": "offOut",
        "in": "SourceAlpha",
        "dx": 0,
        "dy": 0
      },
      "feGaussianBlur": {
        "result": "blurOut",
        "in": "offOut",
        "stdDeviation": 5
      },
      "feBlend": {
        "in": "SourceGraphic",
        "in2": "blurOut",
        "mode": "normal"
      }
    }]
  },
dataLoader: { "url": "data_Pie_Chart_with_Legend_mes_distribucion_edad_json.php?fecha=<?php echo $fecha ?>&tipo_fecha=<?php echo $tipo_fecha ?>&nombre_empresa=<?php echo $nombre_empresa ?>" },
  "angle": 20,
  "valueField": "conteo_edad_distrib",
  "titleField": "edad_anyo_distrib",
  "export": {
  "enabled": true
  }
});
chartdiv06.addListener("init", handleInit);
chartdiv06.addListener("rollOverSlice", function(e) {
  handleRollOver(e);
});
function handleInit(){
  chartdiv06.legend.addListener("rollOverItem", handleRollOver);
}
function handleRollOver(e){
  var wedge = e.dataItem.wedge.node;
  wedge.parentNode.appendChild(wedge);
}
</script>
<div id="chartdiv06"></div>


<tr><td style="text-align:left"><strong>3.2.3. Peligros percibidos</strong></td></tr>
<br><br>
<tr><td style="text-align:center">Los resultados aquí mostrados se basan en el auto-reporte de los trabajadores donde se evalúa la percepción que tienen con respecto a los peligros en el ambiente de trabajo. Es importante cruzar esta información con la matriz de peligros de la Empresa.
En orden descendente, los peligros reportados son:
</td></tr>
<?php
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
?>
<div class="table-responsive">
<table class="table table-bordered" style="font-family:mono;  font-size:<?php echo $tamano_font_informe_emp ?>pt">
<thead class="thead-dark">
<tr>
    <th style="text-align:center">Peligro</th>
    <th style="text-align:center"># declarantes</th>
    <th style="text-align:center">% declarantes</th>
</tr>
</thead>
<tbody>
<?php
$contador = 0;

foreach ($vector_riesgo as &$conteo_riesgo) {
$contador ++;
?>
  <tr>
<?php
if ($contador == 1 && $conteo_riesgo <> 0) { $nombre_riesgo = 'Ruido'; ?>
<td><?php echo $nombre_riesgo ?></td>
<td style="text-align:center"><?php echo intval($conteo_riesgo) ?></td>
<td style="text-align:center"><?php echo round((($conteo_riesgo / $total_poblacion) *100), 2) ?></td>
<?php }
if ($contador == 2 && $conteo_riesgo <> 0) { $nombre_riesgo = 'Iluminación'; ?>
<td><?php echo $nombre_riesgo ?></td>
<td style="text-align:center"><?php echo intval($conteo_riesgo) ?></td>
<td style="text-align:center"><?php echo round((($conteo_riesgo / $total_poblacion) *100), 2) ?></td>
<?php }
if ($contador == 3 && $conteo_riesgo <> 0) { $nombre_riesgo = 'Rad no Ionic'; ?>
<td><?php echo $nombre_riesgo ?></td>
<td style="text-align:center"><?php echo intval($conteo_riesgo) ?></td>
<td style="text-align:center"><?php echo round((($conteo_riesgo / $total_poblacion) *100), 2) ?></td>
<?php }
if ($contador == 4 && $conteo_riesgo <> 0) { $nombre_riesgo = 'Vibraciones'; ?>
<td><?php echo $nombre_riesgo ?></td>
<td style="text-align:center"><?php echo intval($conteo_riesgo) ?></td>
<td style="text-align:center"><?php echo round((($conteo_riesgo / $total_poblacion) *100), 2) ?></td>
<?php }
if ($contador == 5 && $conteo_riesgo <> 0) { $nombre_riesgo = 'Temp Extremas'; ?>
<td><?php echo $nombre_riesgo ?></td>
<td style="text-align:center"><?php echo intval($conteo_riesgo) ?></td>
<td style="text-align:center"><?php echo round((($conteo_riesgo / $total_poblacion) *100), 2) ?></td>
<?php }
if ($contador == 6 && $conteo_riesgo <> 0) { $nombre_riesgo = 'Cambios de Presión'; ?>
<td><?php echo $nombre_riesgo ?></td>
<td style="text-align:center"><?php echo intval($conteo_riesgo) ?></td>
<td style="text-align:center"><?php echo round((($conteo_riesgo / $total_poblacion) *100), 2) ?></td>
<?php }
if ($contador == 7 && $conteo_riesgo <> 0) { $nombre_riesgo = 'Gases y Vapores'; ?>
<td><?php echo $nombre_riesgo ?></td>
<td style="text-align:center"><?php echo intval($conteo_riesgo) ?></td>
<td style="text-align:center"><?php echo round((($conteo_riesgo / $total_poblacion) *100), 2) ?></td>
<?php }
if ($contador == 8 && $conteo_riesgo <> 0) { $nombre_riesgo = 'Aerosoles Líquidos'; ?>
<td><?php echo $nombre_riesgo ?></td>
<td style="text-align:center"><?php echo intval($conteo_riesgo) ?></td>
<td style="text-align:center"><?php echo round((($conteo_riesgo / $total_poblacion) *100), 2) ?></td>
<?php }
if ($contador == 9 && $conteo_riesgo <> 0) { $nombre_riesgo = 'Sólidos'; ?>
<td><?php echo $nombre_riesgo ?></td>
<td style="text-align:center"><?php echo intval($conteo_riesgo) ?></td>
<td style="text-align:center"><?php echo round((($conteo_riesgo / $total_poblacion) *100), 2) ?></td>
<?php }
if ($contador == 10 && $conteo_riesgo <> 0) { $nombre_riesgo = 'Líquidos'; ?>
<td><?php echo $nombre_riesgo ?></td>
<td style="text-align:center"><?php echo intval($conteo_riesgo) ?></td>
<td style="text-align:center"><?php echo round((($conteo_riesgo / $total_poblacion) *100), 2) ?></td>
<?php }
if ($contador == 11 && $conteo_riesgo <> 0) { $nombre_riesgo = 'Virus'; ?>
<td><?php echo $nombre_riesgo ?></td>
<td style="text-align:center"><?php echo intval($conteo_riesgo) ?></td>
<td style="text-align:center"><?php echo round((($conteo_riesgo / $total_poblacion) *100), 2) ?></td>
<?php }
if ($contador == 12 && $conteo_riesgo <> 0) { $nombre_riesgo = 'Bacterias'; ?>
<td><?php echo $nombre_riesgo ?></td>
<td style="text-align:center"><?php echo intval($conteo_riesgo) ?></td>
<td style="text-align:center"><?php echo round((($conteo_riesgo / $total_poblacion) *100), 2) ?></td>
<?php }
if ($contador == 13 && $conteo_riesgo <> 0) { $nombre_riesgo = 'Parásitos'; ?>
<td><?php echo $nombre_riesgo ?></td>
<td style="text-align:center"><?php echo intval($conteo_riesgo) ?></td>
<td style="text-align:center"><?php echo round((($conteo_riesgo / $total_poblacion) *100), 2) ?></td>
<?php }
if ($contador == 14 && $conteo_riesgo <> 0) { $nombre_riesgo = 'Mordeduras'; ?>
<td><?php echo $nombre_riesgo ?></td>
<td style="text-align:center"><?php echo intval($conteo_riesgo) ?></td>
<td style="text-align:center"><?php echo round((($conteo_riesgo / $total_poblacion) *100), 2) ?></td>
<?php }
if ($contador == 15 && $conteo_riesgo <> 0) { $nombre_riesgo = 'Picaduras'; ?>
<td><?php echo $nombre_riesgo ?></td>
<td style="text-align:center"><?php echo intval($conteo_riesgo) ?></td>
<td style="text-align:center"><?php echo round((($conteo_riesgo / $total_poblacion) *100), 2) ?></td>
<?php }
if ($contador == 16 && $conteo_riesgo <> 0) { $nombre_riesgo = 'Hongos'; ?>
<td><?php echo $nombre_riesgo ?></td>
<td style="text-align:center"><?php echo intval($conteo_riesgo) ?></td>
<td style="text-align:center"><?php echo round((($conteo_riesgo / $total_poblacion) *100), 2) ?></td>
<?php }
if ($contador == 17 && $conteo_riesgo <> 0) { $nombre_riesgo = 'Trabajo Estático'; ?>
<td><?php echo $nombre_riesgo ?></td>
<td style="text-align:center"><?php echo intval($conteo_riesgo) ?></td>
<td style="text-align:center"><?php echo round((($conteo_riesgo / $total_poblacion) *100), 2) ?></td>
<?php }
if ($contador == 18 && $conteo_riesgo <> 0) { $nombre_riesgo = 'Esfuerzo Físico'; ?>
<td><?php echo $nombre_riesgo ?></td>
<td style="text-align:center"><?php echo intval($conteo_riesgo) ?></td>
<td style="text-align:center"><?php echo round((($conteo_riesgo / $total_poblacion) *100), 2) ?></td>
<?php }
if ($contador == 19 && $conteo_riesgo <> 0) { $nombre_riesgo = 'Cargas'; ?>
<td><?php echo $nombre_riesgo ?></td>
<td style="text-align:center"><?php echo intval($conteo_riesgo) ?></td>
<td style="text-align:center"><?php echo round((($conteo_riesgo / $total_poblacion) *100), 2) ?></td>
<?php }
if ($contador == 20 && $conteo_riesgo <> 0) { $nombre_riesgo = 'Posturas Forzadas'; ?>
<td><?php echo $nombre_riesgo ?></td>
<td style="text-align:center"><?php echo intval($conteo_riesgo) ?></td>
<td style="text-align:center"><?php echo round((($conteo_riesgo / $total_poblacion) *100), 2) ?></td>
<?php }
if ($contador == 21 && $conteo_riesgo <> 0) { $nombre_riesgo = 'Movimientos Repetitivos'; ?>
<td><?php echo $nombre_riesgo ?></td>
<td style="text-align:center"><?php echo intval($conteo_riesgo) ?></td>
<td style="text-align:center"><?php echo round((($conteo_riesgo / $total_poblacion) *100), 2) ?></td>
<?php }
if ($contador == 22 && $conteo_riesgo <> 0) { $nombre_riesgo = 'Jornada de Trabajo'; ?>
<td><?php echo $nombre_riesgo ?></td>
<td style="text-align:center"><?php echo intval($conteo_riesgo) ?></td>
<td style="text-align:center"><?php echo round((($conteo_riesgo / $total_poblacion) *100), 2) ?></td>
<?php }
if ($contador == 23 && $conteo_riesgo <> 0) { $nombre_riesgo = 'Monotonía'; ?>
<td><?php echo $nombre_riesgo ?></td>
<td style="text-align:center"><?php echo intval($conteo_riesgo) ?></td>
<td style="text-align:center"><?php echo round((($conteo_riesgo / $total_poblacion) *100), 2) ?></td>
<?php }
if ($contador == 24 && $conteo_riesgo <> 0) { $nombre_riesgo = 'Relaciones Humanas'; ?>
<td><?php echo $nombre_riesgo ?></td>
<td style="text-align:center"><?php echo intval($conteo_riesgo) ?></td>
<td style="text-align:center"><?php echo round((($conteo_riesgo / $total_poblacion) *100), 2) ?></td>
<?php }
if ($contador == 25 && $conteo_riesgo <> 0) { $nombre_riesgo = 'Contenido de la Terea'; ?>
<td><?php echo $nombre_riesgo ?></td>
<td style="text-align:center"><?php echo intval($conteo_riesgo) ?></td>
<td style="text-align:center"><?php echo round((($conteo_riesgo / $total_poblacion) *100), 2) ?></td>
<?php }
if ($contador == 26 && $conteo_riesgo <> 0) { $nombre_riesgo = 'Org. del Tiempo de Trabajo'; ?>
<td><?php echo $nombre_riesgo ?></td>
<td style="text-align:center"><?php echo intval($conteo_riesgo) ?></td>
<td style="text-align:center"><?php echo round((($conteo_riesgo / $total_poblacion) *100), 2) ?></td>
<?php }
if ($contador == 27 && $conteo_riesgo <> 0) { $nombre_riesgo = 'Mecánicos'; ?>
<td><?php echo $nombre_riesgo ?></td>
<td style="text-align:center"><?php echo intval($conteo_riesgo) ?></td>
<td style="text-align:center"><?php echo round((($conteo_riesgo / $total_poblacion) *100), 2) ?></td>
<?php }
if ($contador == 28 && $conteo_riesgo <> 0) { $nombre_riesgo = 'Eléctricos'; ?>
<td><?php echo $nombre_riesgo ?></td>
<td style="text-align:center"><?php echo intval($conteo_riesgo) ?></td>
<td style="text-align:center"><?php echo round((($conteo_riesgo / $total_poblacion) *100), 2) ?></td>
<?php }
if ($contador == 29 && $conteo_riesgo <> 0) { $nombre_riesgo = 'Locativos'; ?>
<td><?php echo $nombre_riesgo ?></td>
<td style="text-align:center"><?php echo intval($conteo_riesgo) ?></td>
<td style="text-align:center"><?php echo round((($conteo_riesgo / $total_poblacion) *100), 2) ?></td>
<?php }
if ($contador == 30 && $conteo_riesgo <> 0) { $nombre_riesgo = 'Físicoquimicos'; ?>
<td><?php echo $nombre_riesgo ?></td>
<td style="text-align:center"><?php echo intval($conteo_riesgo) ?></td>
<td style="text-align:center"><?php echo round((($conteo_riesgo / $total_poblacion) *100), 2) ?></td>
<?php }
if ($contador == 31 && $conteo_riesgo <> 0) { $nombre_riesgo = 'Público'; ?>
<td><?php echo $nombre_riesgo ?></td>
<td style="text-align:center"><?php echo intval($conteo_riesgo) ?></td>
<td style="text-align:center"><?php echo round((($conteo_riesgo / $total_poblacion) *100), 2) ?></td>
<?php }
if ($contador == 32 && $conteo_riesgo <> 0) { $nombre_riesgo = 'Espacios Confinados'; ?>
<td><?php echo $nombre_riesgo ?></td>
<td style="text-align:center"><?php echo intval($conteo_riesgo) ?></td>
<td style="text-align:center"><?php echo round((($conteo_riesgo / $total_poblacion) *100), 2) ?></td>
<?php }
if ($contador == 33 && $conteo_riesgo <> 0) { $nombre_riesgo = 'Trabajos en Alturas'; ?>
<td><?php echo $nombre_riesgo ?></td>
<td style="text-align:center"><?php echo intval($conteo_riesgo) ?></td>
<td style="text-align:center"><?php echo round((($conteo_riesgo / $total_poblacion) *100), 2) ?></td>
<?php }
if ($contador == 34 && $conteo_riesgo <> 0) { $nombre_riesgo = 'Otros'; ?>
<td><?php echo $nombre_riesgo ?></td>
<td style="text-align:center"><?php echo intval($conteo_riesgo) ?></td>
<td style="text-align:center"><?php echo round((($conteo_riesgo / $total_poblacion) *100), 2) ?></td>
<?php
}
}
unset($conteo_riesgo); // rompe la referencia con el último elemento
?>
  </tr>
</tbody>
</table>
</div>


<script>
var chartdiv07 = AmCharts.makeChart( "chartdiv07", {
  "type": "pie",
  "theme": "light",
  "titles": [ {
    "text": "FACTOR DE RIESGO OCUPACIONAL",
    "size": 16
  } ],
dataLoader: { "url": "data_Simple_Column_Chart_mes_peligros.php?fecha=<?php echo $fecha ?>&tipo_fecha=<?php echo $tipo_fecha ?>&nombre_empresa=<?php echo $nombre_empresa ?>" },

  "valueField": "conteo_riesgo",
  "titleField": "nombre_riesgo",
  "startEffect": "elastic",
  "startDuration": 2,
  "labelRadius": 15,
  "innerRadius": "50%",
  "depth3D": 10,
  "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
  "angle": 15,
  "export": {
    "enabled": true
  }
} );
</script>
<div id="chartdiv07"></div>

<?php
$query1 = "SELECT $tipo_fecha, cod_estado_facturacion, Count(habit_tox_fum_nofum_exfum) AS habit_tox_fum_nofum_exfum, nombre_empresa
FROM tbl15_historia_clinica 
GROUP BY habit_tox_fum_nofum_exfum, $tipo_fecha, cod_estado_facturacion, nombre_empresa
HAVING ((($tipo_fecha)='$fecha') AND (cod_estado_facturacion=1) AND (habit_tox_fum_nofum_exfum='Fuma') AND ((nombre_empresa)='$nombre_empresa'))";
$result1 = mysqli_query($conectar, $query1);
$dato01 = mysqli_fetch_assoc($result1);

$query2 = "SELECT $tipo_fecha, cod_estado_facturacion, Count(habit_tox_fum_nofum_exfum) AS habit_tox_fum_nofum_exfum, nombre_empresa
FROM tbl15_historia_clinica 
GROUP BY habit_tox_fum_nofum_exfum, $tipo_fecha, cod_estado_facturacion, nombre_empresa
HAVING ((($tipo_fecha)='$fecha') AND (cod_estado_facturacion=1) AND (habit_tox_fum_nofum_exfum='No Fuma') AND ((nombre_empresa)='$nombre_empresa'))";
$result2 = mysqli_query($conectar, $query2);
$dato02 = mysqli_fetch_assoc($result2);

$query3 = "SELECT $tipo_fecha, cod_estado_facturacion, Count(habit_tox_fum_nofum_exfum) AS habit_tox_fum_nofum_exfum, nombre_empresa
FROM tbl15_historia_clinica 
GROUP BY habit_tox_fum_nofum_exfum, $tipo_fecha, cod_estado_facturacion, nombre_empresa
HAVING ((($tipo_fecha)='$fecha') AND (cod_estado_facturacion=1) AND (habit_tox_fum_nofum_exfum='Exfumador') AND ((nombre_empresa)='$nombre_empresa'))";
$result3 = mysqli_query($conectar, $query3);
$dato03 = mysqli_fetch_assoc($result3);

$Fuma                        = $dato01['habit_tox_fum_nofum_exfum'];
$nofum                       = $dato02['habit_tox_fum_nofum_exfum'];
$exfum                       = $dato03['habit_tox_fum_nofum_exfum'];
$Fuma_ptj                    = ($Fuma / $total_poblacion) * 100;
$nofum_ptj                   = ($nofum / $total_poblacion) * 100;
$exfum_ptj                   = ($exfum / $total_poblacion) * 100;

$vector_habitos_extra_lab    = array($Fuma, $nofum, $exfum);
?>
<tr><td style="text-align:left"><strong>3.4. HÁBITOS EXTRALABORALES</strong></td></tr>
<br><br>
<tr><td style="text-align:center">3.4.1. Tabaquismo</td></tr>
<br><br>
<tr><td style="text-align:center">El <?php echo $Fuma_ptj ?>% de las personas evaluadas refirió fumar, un  <?php echo $exfum_ptj ?>% ser exfumadores y un <?php echo $nofum_ptj ?> % refirió no ser fumador.</td></tr>

<script>
var chartdiv08 = AmCharts.makeChart("chartdiv08", {
  "type": "pie", 
  "startDuration": 0,
  "theme": "light",
  "addClassNames": true,
  "titles": [ {
  "text": "CONSUMO DE CIGARRILLO",
  "size": 16
  } ],
  "legend":{
  "position":"right",
  "marginRight":100,
  "autoMargins":false
  },
  "innerRadius": "30%",
  "defs": {
    "filter": [{
      "id": "shadow",
      "width": "200%",
      "height": "200%",
      "feOffset": {
        "result": "offOut",
        "in": "SourceAlpha",
        "dx": 0,
        "dy": 0
      },
      "feGaussianBlur": {
        "result": "blurOut",
        "in": "offOut",
        "stdDeviation": 5
      },
      "feBlend": {
        "in": "SourceGraphic",
        "in2": "blurOut",
        "mode": "normal"
      }
    }]
  },
dataLoader: { "url": "data_Pie_Chart_with_Legend_mes_habito_extra_lab_json.php?fecha=<?php echo $fecha ?>&tipo_fecha=<?php echo $tipo_fecha ?>&nombre_empresa=<?php echo $nombre_empresa ?>" },
  "angle": 20,
  "valueField": "conteo_habit_extra_lab",
  "titleField": "nombre_habit_extra_lab",
  "export": {
  "enabled": true
  }
});
chartdiv08.addListener("init", handleInit);
chartdiv08.addListener("rollOverSlice", function(e) {
  handleRollOver(e);
});
function handleInit(){
  chartdiv08.legend.addListener("rollOverItem", handleRollOver);
}
function handleRollOver(e){
  var wedge = e.dataItem.wedge.node;
  wedge.parentNode.appendChild(wedge);
}
</script>
<div id="chartdiv08"></div>

<div class="table-responsive">
<table class="table table-bordered" style="font-family:mono;  font-size:<?php echo $tamano_font_informe_emp ?>pt">
<thead class="thead-dark">
<tr>
    <th style="text-align:center">Consumo de cigarrillo</th>
    <th style="text-align:center">#</th>
    <th style="text-align:center">%</th>
</tr>
</thead>
<tbody>
<tr>
    <td style="text-align:left">SI</td>
    <td style="text-align:center"><?php echo intval($Fuma)?></td>
    <td style="text-align:center"><?php echo round($Fuma_ptj, 2) ?>%</td>
</tr>
<tr>
    <td style="text-align:left">NO</td>
    <td style="text-align:center"><?php echo intval($nofum) ?></td>
    <td style="text-align:center"><?php echo round($nofum_ptj, 2) ?>%</td>
</tr>
<tr>
    <td style="text-align:left">EX</td>
    <td style="text-align:center"><?php echo intval($exfum) ?></td>
    <td style="text-align:center"><?php echo round($exfum_ptj, 2) ?>%</td>
</tr>

<tr class="table-dark">
    <th style="text-align:center">TOTAL</th>
    <th style="text-align:center"><?php echo $total_poblacion ?></th>
    <th style="text-align:center">100%</th>
</tr>
</tbody>
</table>
</div>


<?php
$query1 = "SELECT $tipo_fecha, cod_estado_facturacion, Count(habit_tox_activfis) AS habit_tox_activfis, nombre_empresa
FROM tbl15_historia_clinica 
GROUP BY habit_tox_activfis, $tipo_fecha, cod_estado_facturacion, nombre_empresa
HAVING ((($tipo_fecha)='$fecha') AND (cod_estado_facturacion=1) AND (habit_tox_activfis='Fisicamente activo') AND ((nombre_empresa)='$nombre_empresa'))";
$result1 = mysqli_query($conectar, $query1);
$dato01 = mysqli_fetch_assoc($result1);

$query2 = "SELECT $tipo_fecha, cod_estado_facturacion, Count(habit_tox_activfis) AS habit_tox_activfis, nombre_empresa
FROM tbl15_historia_clinica 
GROUP BY habit_tox_activfis, $tipo_fecha, cod_estado_facturacion, nombre_empresa
HAVING ((($tipo_fecha)='$fecha') AND (cod_estado_facturacion=1) AND (habit_tox_activfis='Sedentario') AND ((nombre_empresa)='$nombre_empresa'))";
$result2 = mysqli_query($conectar, $query2);
$dato02 = mysqli_fetch_assoc($result2);

$fisicamente_activo          = $dato01['habit_tox_activfis'];
$sedentario                  = $dato02['habit_tox_activfis'];
$fisicamente_activo_ptj      = ($fisicamente_activo / $total_poblacion) * 100;
$sedentario_ptj              = ($sedentario / $total_poblacion) * 100;
?>
<tr><td style="text-align:left"><strong>3.4.2. Actividad Física</strong></td></tr>
<br><br>
<tr><td style="text-align:center">Un <?php echo round($fisicamente_activo_ptj, 2) ?>% de la población evaluada refirió realizar algún tipo de actividad física, 
en forma periódica, un <?php echo round($sedentario_ptj, 2) ?>% no la realiza.</td></tr>

<script>
var chartdiv09 = AmCharts.makeChart("chartdiv09", {
  "type": "pie", 
  "startDuration": 0,
  "theme": "light",
  "addClassNames": true,
  "titles": [ {
  "text": "PRACTICA DE ACTIVIDAD FÍSICA",
  "size": 16
  } ],
  "legend":{
  "position":"right",
  "marginRight":100,
  "autoMargins":false
  },
  "innerRadius": "30%",
  "defs": {
    "filter": [{
      "id": "shadow",
      "width": "200%",
      "height": "200%",
      "feOffset": {
        "result": "offOut",
        "in": "SourceAlpha",
        "dx": 0,
        "dy": 0
      },
      "feGaussianBlur": {
        "result": "blurOut",
        "in": "offOut",
        "stdDeviation": 5
      },
      "feBlend": {
        "in": "SourceGraphic",
        "in2": "blurOut",
        "mode": "normal"
      }
    }]
  },
dataLoader: { "url": "data_Pie_Chart_with_Legend_mes_actividad_fisica_json.php?fecha=<?php echo $fecha ?>&tipo_fecha=<?php echo $tipo_fecha ?>&nombre_empresa=<?php echo $nombre_empresa ?>" },
  "angle": 20,
  "valueField": "conteo_actividad_fisica",
  "titleField": "nombre_actividad_fisica",
  "export": {
  "enabled": true
  }
});
chartdiv09.addListener("init", handleInit);
chartdiv09.addListener("rollOverSlice", function(e) {
  handleRollOver(e);
});
function handleInit(){
  chartdiv09.legend.addListener("rollOverItem", handleRollOver);
}
function handleRollOver(e){
  var wedge = e.dataItem.wedge.node;
  wedge.parentNode.appendChild(wedge);
}
</script>
<div id="chartdiv09"></div>

<?php
$query1 = "SELECT $tipo_fecha, cod_estado_facturacion, Count(exa_fis_interpreimc) AS exa_fis_interpreimc, nombre_empresa
FROM tbl15_historia_clinica 
GROUP BY exa_fis_interpreimc, $tipo_fecha, cod_estado_facturacion, nombre_empresa
HAVING ((($tipo_fecha)='$fecha') AND (cod_estado_facturacion=1) AND (exa_fis_interpreimc='BAJO PESO') AND ((nombre_empresa)='$nombre_empresa'))";
$result1 = mysqli_query($conectar, $query1);
$dato01 = mysqli_fetch_assoc($result1);

$query2 = "SELECT $tipo_fecha, cod_estado_facturacion, Count(exa_fis_interpreimc) AS exa_fis_interpreimc, nombre_empresa
FROM tbl15_historia_clinica 
GROUP BY exa_fis_interpreimc, $tipo_fecha, cod_estado_facturacion, nombre_empresa
HAVING ((($tipo_fecha)='$fecha') AND (cod_estado_facturacion=1) AND (exa_fis_interpreimc='PESO NORMAL') AND ((nombre_empresa)='$nombre_empresa'))";
$result2 = mysqli_query($conectar, $query2);
$dato02 = mysqli_fetch_assoc($result2);

$query3 = "SELECT $tipo_fecha, cod_estado_facturacion, Count(exa_fis_interpreimc) AS exa_fis_interpreimc, nombre_empresa
FROM tbl15_historia_clinica 
GROUP BY exa_fis_interpreimc, $tipo_fecha, cod_estado_facturacion, nombre_empresa
HAVING ((($tipo_fecha)='$fecha') AND (cod_estado_facturacion=1) AND (exa_fis_interpreimc='SOBREPESO') AND ((nombre_empresa)='$nombre_empresa'))";
$result3 = mysqli_query($conectar, $query3);
$dato03 = mysqli_fetch_assoc($result3);

$query4 = "SELECT $tipo_fecha, cod_estado_facturacion, Count(exa_fis_interpreimc) AS exa_fis_interpreimc, nombre_empresa
FROM tbl15_historia_clinica 
GROUP BY exa_fis_interpreimc, $tipo_fecha, cod_estado_facturacion, nombre_empresa
HAVING ((($tipo_fecha)='$fecha') AND (cod_estado_facturacion=1) AND (exa_fis_interpreimc='OBESIDAD I') AND ((nombre_empresa)='$nombre_empresa'))";
$result4 = mysqli_query($conectar, $query4);
$dato04 = mysqli_fetch_assoc($result4);

$query5 = "SELECT $tipo_fecha, cod_estado_facturacion, Count(exa_fis_interpreimc) AS exa_fis_interpreimc, nombre_empresa
FROM tbl15_historia_clinica 
GROUP BY exa_fis_interpreimc, $tipo_fecha, cod_estado_facturacion, nombre_empresa
HAVING ((($tipo_fecha)='$fecha') AND (cod_estado_facturacion=1) AND (exa_fis_interpreimc='OBESIDAD II') AND ((nombre_empresa)='$nombre_empresa'))";
$result5 = mysqli_query($conectar, $query5);
$dato05 = mysqli_fetch_assoc($result5);

$query6 = "SELECT $tipo_fecha, cod_estado_facturacion, Count(exa_fis_interpreimc) AS exa_fis_interpreimc, nombre_empresa
FROM tbl15_historia_clinica 
GROUP BY exa_fis_interpreimc, $tipo_fecha, cod_estado_facturacion, nombre_empresa
HAVING ((($tipo_fecha)='$fecha') AND (cod_estado_facturacion=1) AND (exa_fis_interpreimc='OBESIDAD III') AND ((nombre_empresa)='$nombre_empresa'))";
$result6 = mysqli_query($conectar, $query6);
$dato06 = mysqli_fetch_assoc($result6);

$query7 = "SELECT $tipo_fecha, cod_estado_facturacion, Count(exa_fis_interpreimc) AS exa_fis_interpreimc, nombre_empresa
FROM tbl15_historia_clinica 
GROUP BY exa_fis_interpreimc, $tipo_fecha, cod_estado_facturacion, nombre_empresa
HAVING ((($tipo_fecha)='$fecha') AND (cod_estado_facturacion=1) AND (exa_fis_interpreimc='OBESIDAD EXTREMA') AND ((nombre_empresa)='$nombre_empresa'))";
$result7 = mysqli_query($conectar, $query7);
$dato07 = mysqli_fetch_assoc($result7);

$bajo_peso                  = $dato01['exa_fis_interpreimc'];
$peso_normal                = $dato02['exa_fis_interpreimc'];
$sobreso                    = $dato03['exa_fis_interpreimc'];
$obesidad1                  = $dato04['exa_fis_interpreimc'];
$obesidad2                  = $dato05['exa_fis_interpreimc'];
$obesidad3                  = $dato06['exa_fis_interpreimc'];
$obesidad_extrema           = $dato07['exa_fis_interpreimc'];

$bajo_peso_ptj              = ($bajo_peso / $total_poblacion) * 100;
$peso_normal_ptj            = ($peso_normal / $total_poblacion) * 100;
$sobreso_ptj                = ($sobreso / $total_poblacion) * 100;
$obesidad1_ptj              = ($obesidad1 / $total_poblacion) * 100;
$obesidad2_ptj              = ($obesidad2 / $total_poblacion) * 100;
$obesidad3_ptj              = ($obesidad3 / $total_poblacion) * 100;
$obesidad_extrema_ptj       = ($obesidad_extrema / $total_poblacion) * 100;
$obesidad_total             = $obesidad1_ptj + $obesidad2_ptj + $obesidad3_ptj + $obesidad_extrema_ptj;
?>
<tr><td style="text-align:left"><strong>3.4.3 Indice de Masa Corporal </strong></td></tr>
<br><br>
<tr><td style="text-align:center">El <?php echo round($sobreso_ptj, 2) ?>% de la población presenta sobrepeso y el <?php echo round($obesidad_total, 2) ?>% obesidad.</td></tr>

<script>
var chartdiv10 = AmCharts.makeChart("chartdiv10", {
  "type": "pie", 
  "startDuration": 0,
  "theme": "light",
  "addClassNames": true,
  "titles": [ {
  "text": "INDICE DE MASA CORPORAL",
  "size": 16
  } ],
  "legend":{
  "position":"right",
  "marginRight":100,
  "autoMargins":false
  },
  "innerRadius": "30%",
  "defs": {
    "filter": [{
      "id": "shadow",
      "width": "200%",
      "height": "200%",
      "feOffset": {
        "result": "offOut",
        "in": "SourceAlpha",
        "dx": 0,
        "dy": 0
      },
      "feGaussianBlur": {
        "result": "blurOut",
        "in": "offOut",
        "stdDeviation": 5
      },
      "feBlend": {
        "in": "SourceGraphic",
        "in2": "blurOut",
        "mode": "normal"
      }
    }]
  },
dataLoader: { "url": "data_Pie_Chart_with_Legend_mes_imc_json.php?fecha=<?php echo $fecha ?>&tipo_fecha=<?php echo $tipo_fecha ?>&nombre_empresa=<?php echo $nombre_empresa ?>" },
  "angle": 20,
  "valueField": "conteo_imc",
  "titleField": "nombre_imc",
  "export": {
  "enabled": true
  }
});
chartdiv10.addListener("init", handleInit);
chartdiv10.addListener("rollOverSlice", function(e) {
  handleRollOver(e);
});
function handleInit(){
  chartdiv10.legend.addListener("rollOverItem", handleRollOver);
}
function handleRollOver(e){
  var wedge = e.dataItem.wedge.node;
  wedge.parentNode.appendChild(wedge);
}
</script>
<div id="chartdiv10"></div>


<tr><td style="text-align:left"><strong>3.5. PATOLOGÍA OCUPACIONAL REPORTADA</strong></td></tr>
<br><br>
<tr><td style="text-align:center">La patología ocupacional se refiere a los antecedentes de accidentalidad laboral y enfermedad de origen laboral que hayan referido los trabajadores en el último año dentro de la Empresa.</td></tr>

<script>
var chartdiv11 = AmCharts.makeChart("chartdiv11", {
  "type": "pie", 
  "startDuration": 0,
  "theme": "light",
  "addClassNames": true,
  "titles": [ {
  "text": "ENFERMEDAD PROFESIONAL",
  "size": 16
  } ],
  "legend":{
  "position":"right",
  "marginRight":100,
  "autoMargins":false
  },
  "innerRadius": "30%",
  "defs": {
    "filter": [{
      "id": "shadow",
      "width": "200%",
      "height": "200%",
      "feOffset": {
        "result": "offOut",
        "in": "SourceAlpha",
        "dx": 0,
        "dy": 0
      },
      "feGaussianBlur": {
        "result": "blurOut",
        "in": "offOut",
        "stdDeviation": 5
      },
      "feBlend": {
        "in": "SourceGraphic",
        "in2": "blurOut",
        "mode": "normal"
      }
    }]
  },
dataLoader: { "url": "data_Pie_Chart_with_Legend_mes_enfermedad_laboral_json.php?fecha=<?php echo $fecha ?>&tipo_fecha=<?php echo $tipo_fecha ?>&nombre_empresa=<?php echo $nombre_empresa ?>" },
  "angle": 20,
  "valueField": "conteo_enf_lab",
  "titleField": "nombre_enf_lab",
  "export": {
  "enabled": true
  }
});
chartdiv11.addListener("init", handleInit);
chartdiv11.addListener("rollOverSlice", function(e) {
  handleRollOver(e);
});
function handleInit(){
  chartdiv11.legend.addListener("rollOverItem", handleRollOver);
}
function handleRollOver(e){
  var wedge = e.dataItem.wedge.node;
  wedge.parentNode.appendChild(wedge);
}
</script>
<div id="chartdiv11"></div>


<?php 
$query1 = "SELECT $tipo_fecha, cod_estado_facturacion, Count(enf_lab) AS enf_lab, nombre_empresa
FROM tbl15_historia_clinica 
GROUP BY enf_lab, $tipo_fecha, cod_estado_facturacion, nombre_empresa
HAVING ((($tipo_fecha)='$fecha') AND (cod_estado_facturacion=1) AND (enf_lab='SI') AND ((nombre_empresa)='$nombre_empresa'))";
$result1 = mysqli_query($conectar, $query1);
$dato01 = mysqli_fetch_assoc($result1);

$query2 = "SELECT $tipo_fecha, cod_estado_facturacion, Count(enf_lab) AS enf_lab, nombre_empresa
FROM tbl15_historia_clinica 
GROUP BY enf_lab, $tipo_fecha, cod_estado_facturacion, nombre_empresa
HAVING ((($tipo_fecha)='$fecha') AND (cod_estado_facturacion=1) AND (enf_lab='NO') AND ((nombre_empresa)='$nombre_empresa'))";
$result2 = mysqli_query($conectar, $query2);
$dato02 = mysqli_fetch_assoc($result2);

$enf_lab_si                = $dato01['enf_lab'];
$enf_lab_no                = $dato02['enf_lab'];
$enf_lab_si_ptj            = ($enf_lab_si / $total_poblacion) * 100;
$enf_lab_no_ptj            = ($enf_lab_no / $total_poblacion) * 100;
?>

<div class="table-responsive">
<table class="table table-bordered" style="font-family:mono;  font-size:<?php echo $tamano_font_informe_emp ?>pt">
<thead class="thead-dark">
<tr>
    <th style="text-align:center">Enfermedad laboral reportada</th>
    <th style="text-align:center">#</th>
    <th style="text-align:center">%</th>
</tr>
</thead>
<tbody>
<tr>
    <td style="text-align:center">Con enfermedad</td>
    <td style="text-align:center"><?php echo intval($enf_lab_si)?></td>
    <td style="text-align:center"><?php echo round($enf_lab_si_ptj, 2) ?>%</td>
</tr>
<tr>
    <td style="text-align:center">Sin enfermedad</td>
    <td style="text-align:center"><?php echo intval($enf_lab_no) ?></td>
    <td style="text-align:center"><?php echo round($enf_lab_no_ptj, 2) ?>%</td>
</tr>

<tr class="table-dark">
    <th style="text-align:center">TOTAL</th>
    <th style="text-align:center"><?php echo $total_poblacion ?></th>
    <th style="text-align:center">100%</th>
</tr>
</tbody>
</table>
</div>

<br><br>
<tr><td style="text-align:center">Del total de las Enfermedades reportadas (xx) se tienen xx calificadas, xx objetadas y una de origen pendiente.</td></tr>

<table border="1" cellspacing="0" cellpadding="0">
  <tr><td>A&Ntilde;O</td><td>Aprobado</td><td>Objetado</td><td>Pendiente</td><td>Total general</td></tr>
  <tr><td>2007</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
  <tr><td>2008</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
  <tr><td>2009</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
  <tr><td>2010</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
  <tr><td>2011</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
  <tr><td>2012</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
  <tr><td>2013</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
  <tr><td>2014</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
  <tr><td>Total general</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
</table>


<?php
$query1 = "SELECT $tipo_fecha, cod_estado_facturacion, Count(ant_impor_accilab) AS ant_impor_accilab, nombre_empresa
FROM tbl15_historia_clinica 
GROUP BY ant_impor_accilab, $tipo_fecha, cod_estado_facturacion, nombre_empresa
HAVING ((($tipo_fecha)='$fecha') AND (cod_estado_facturacion=1) AND ((ant_impor_accilab)='SI') AND ((nombre_empresa)='$nombre_empresa'))";
$result1 = mysqli_query($conectar, $query1);
$dato01 = mysqli_fetch_assoc($result1);

$query2 = "SELECT $tipo_fecha, cod_estado_facturacion, Count(ant_impor_accilab) AS ant_impor_accilab, nombre_empresa
FROM tbl15_historia_clinica 
GROUP BY ant_impor_accilab, $tipo_fecha, cod_estado_facturacion, nombre_empresa
HAVING ((($tipo_fecha)='$fecha') AND (cod_estado_facturacion=1) AND ((ant_impor_accilab)='NO') AND ((nombre_empresa)='$nombre_empresa'))";
$result2 = mysqli_query($conectar, $query2);
$dato02 = mysqli_fetch_assoc($result2);

$ant_impor_accilab_si                = $dato01['ant_impor_accilab'];
$ant_impor_accilab_no                = $dato02['ant_impor_accilab'];
$ant_impor_accilab_si_ptj            = ($ant_impor_accilab_si / $total_poblacion) * 100;
$ant_impor_accilab_no_ptj            = ($ant_impor_accilab_no / $total_poblacion) * 100;
?>
<script>
var chartdiv12 = AmCharts.makeChart("chartdiv12", {
  "type": "pie", 
  "startDuration": 0,
  "theme": "light",
  "addClassNames": true,
  "titles": [ {
  "text": "ACCIDENTE LABORAL",
  "size": 16
  } ],
  "legend":{
  "position":"right",
  "marginRight":100,
  "autoMargins":false
  },
  "innerRadius": "30%",
  "defs": {
    "filter": [{
      "id": "shadow",
      "width": "200%",
      "height": "200%",
      "feOffset": {
        "result": "offOut",
        "in": "SourceAlpha",
        "dx": 0,
        "dy": 0
      },
      "feGaussianBlur": {
        "result": "blurOut",
        "in": "offOut",
        "stdDeviation": 5
      },
      "feBlend": {
        "in": "SourceGraphic",
        "in2": "blurOut",
        "mode": "normal"
      }
    }]
  },
dataLoader: { "url": "data_Pie_Chart_with_Legend_mes_accidente_laboral_json.php?fecha=<?php echo $fecha ?>&tipo_fecha=<?php echo $tipo_fecha ?>&nombre_empresa=<?php echo $nombre_empresa ?>" },
  "angle": 20,
  "valueField": "conteo_accidente_laboral",
  "titleField": "nombre_accidente_laboral",
  "export": {
  "enabled": true
  }
});
chartdiv12.addListener("init", handleInit);
chartdiv12.addListener("rollOverSlice", function(e) {
  handleRollOver(e);
});
function handleInit(){
  chartdiv12.legend.addListener("rollOverItem", handleRollOver);
}
function handleRollOver(e){
  var wedge = e.dataItem.wedge.node;
  wedge.parentNode.appendChild(wedge);
}
</script>
<div id="chartdiv12"></div>

<div class="table-responsive">
<table class="table table-bordered" style="font-family:mono;  font-size:<?php echo $tamano_font_informe_emp ?>pt">
<thead class="thead-dark">
<tr>
    <th style="text-align:center">Accidente de trabajo</th>
    <th style="text-align:center">#</th>
    <th style="text-align:center">%</th>
</tr>
</thead>
<tbody>
<tr>
    <td style="text-align:center">Accidentado</td>
    <td style="text-align:center"><?php echo intval($ant_impor_accilab_si)?></td>
    <td style="text-align:center"><?php echo round($ant_impor_accilab_si_ptj, 2) ?>%</td>
</tr>
<tr>
    <td style="text-align:center">No accidentado</td>
    <td style="text-align:center"><?php echo intval($ant_impor_accilab_no) ?></td>
    <td style="text-align:center"><?php echo round($ant_impor_accilab_no_ptj, 2) ?>%</td>
</tr>

<tr class="table-dark">
    <th style="text-align:center">TOTAL</th>
    <th style="text-align:center"><?php echo $total_poblacion ?></th>
    <th style="text-align:center">100%</th>
</tr>
</tbody>
</table>
</div>

<?php
$query1 = "SELECT tbl15_historia_clinica.$tipo_fecha, tbl15_historia_clinica.cod_estado_facturacion, tbl15_historia_clinica.nombre_empresa, Count(tbl15_cie10diag.cie10_diag) AS conteo_cie10_cod, tbl15_cie10diag.cie10_diag
FROM tbl15_historia_clinica LEFT JOIN tbl15_cie10diag ON tbl15_historia_clinica.cod_historia_clinica = tbl15_cie10diag.cod_historia_clinica
GROUP BY tbl15_historia_clinica.$tipo_fecha, tbl15_historia_clinica.cod_estado_facturacion, tbl15_historia_clinica.nombre_empresa, tbl15_cie10diag.cie10_diag
HAVING (((tbl15_historia_clinica.fecha_mes)='$fecha') AND ((tbl15_historia_clinica.cod_estado_facturacion)=1) AND ((tbl15_historia_clinica.nombre_empresa)='$nombre_empresa')) ORDER BY conteo_cie10_cod DESC";
$result1 = mysqli_query($conectar, $query1);
?>

<tr><td style="text-align:left"><strong>3.6. PRINCIPALES DIAGNÓSTICOS</strong></td></tr>
<br><br>
<tr><td style="text-align:center">Los diagnósticos de mayor incidencia encontradas en los Trabajadores evaluados en el <?php echo $nombre_empresa ?>, se presentan a continuación:<br></td></tr>

<?php
$contador = 0;
while ($dato01 = mysqli_fetch_assoc($result1)) { 
$contador++;

$conteo_cie10_cod          = $dato01['conteo_cie10_cod'];
$nombre_cie10_diag         = $dato01['cie10_diag'];
$conteo_cie10_cod_ptj      = ($conteo_cie10_cod / $total_poblacion) * 100;
?>
<tr>
    <td style="text-align:center"><?php echo $contador ?>. <?php echo $nombre_cie10_diag ?>, personas afectadas, equivalentes al <?php echo round($conteo_cie10_cod_ptj, 2) ?>% de la Población.<br></td>
</tr>
<?php
}
?>

<script>
var chartdiv13 = AmCharts.makeChart( "chartdiv13", {
  "theme": "light",
  "type": "serial",
    "titles": [ {
     "text": "PRINCIPALES DIAGNÓSTICOS",
     "size": 16
    } ],
    dataLoader: { "url": "data_Pie_Chart_with_Legend_mes_diagnostico_cie10_json.php?fecha=<?php echo $fecha ?>&tipo_fecha=<?php echo $tipo_fecha ?>&nombre_empresa=<?php echo $nombre_empresa ?>" },

  "categoryField": "nombre_cie10_diag",
  "depth3D": 20,
  "angle": 30,

  "categoryAxis": {
    "labelRotation": 60,
    "gridPosition": "start"
  },

  "valueAxes": [ {
    "title": "Valores"
  } ],

  "graphs": [ {
    "balloonText": "[[category]]: <b>[[value]]</b>",
    "valueField": "conteo_cie10_cod",
    "colorField": "color",
    "type": "column",
    "lineAlpha": 0.1,
    "fillAlphas": 1
  } ],

  "chartCursor": {
    "cursorAlpha": 0,
    "zoomable": false,
    "categoryBalloonEnabled": false
  },

  "export": {
    "enabled": true
  }
} );
</script>
<div id="chartdiv13"></div>

<!--
<script>
var chartdiv13 = AmCharts.makeChart("chartdiv13", {
    "theme": "light",
    "type": "serial",
    "titles": [ {
     "text": "PRINCIPALES DIAGNÓSTICOS",
     "size": 16
    } ],
    dataLoader: { "url": "data_Pie_Chart_with_Legend_mes_diagnostico_cie10_json.php?fecha=<?php echo $fecha ?>&tipo_fecha=<?php echo $tipo_fecha ?>&nombre_empresa=<?php echo $nombre_empresa ?>" },

    "valueAxes": [{
        "title": "Total"
    }],
    "graphs": [{
        "balloonText": "ESCOLARIDAD: [[category]] - [[value]]",
        "fillAlphas": 1,
        "lineAlpha": 0.2,
        "title": "ESCOLARIDAD",
        "type": "column",
        "valueField": "conteo_cie10_cod"
    }],
    "depth3D": 20,
    "angle": 30,
    "rotate": true,
    "categoryField": "nombre_cie10_diag",
    "categoryAxis": {
        "gridPosition": "start",
        "fillAlpha": 0.05,
        "position": "left"
    },
    "export": {
      "enabled": true
     }
});
</script>
<div id="chartdiv13"></div> 
-->
<tr><td style="text-align:left"><strong>3.6. DIAGNÓSTICOS CON PROBABLE ASOCIAICÓN LABORAL</strong></td></tr>
<br><br>
<tr><td style="text-align:center">Las patologías que requieren evaluación por medicina del trabajo para determinar si hay o no asociación con los peligros existentes, debido a los peligros registrados en la matriz de peligros, son:<br></td></tr>


<tr><td style="text-align:center">1.  Diagnóstico 1:<br></td></tr>
<tr><td style="text-align:center">a.   Áreas y peligros potencialmente asociados:<br></td></tr>
<tr><td style="text-align:center">b.  __ personas afectadas, equivalentes al  __% de la Población.<br></td></tr>
<tr><td style="text-align:center">2.  Diagnóstico 2:<br></td></tr>
<tr><td style="text-align:center">a.   Áreas y peligros potencialmente asociados:<br></td></tr>
<tr><td style="text-align:center">b.  __ personas afectadas, equivalentes al  __% de la Población.<br></td></tr>
<tr><td style="text-align:center">3.  Diagnóstico 3:<br></td></tr>
<tr><td style="text-align:center">a.   Áreas y peligros potencialmente asociados:<br></td></tr>
<tr><td style="text-align:center">b.  __ personas afectadas, equivalentes al  __% de la Población.<br></td></tr>
<tr><td style="text-align:center">4.  Diagnóstico 4:<br></td></tr>
<tr><td style="text-align:center">a.   Áreas y peligros potencialmente asociados:<br></td></tr>
<tr><td style="text-align:center">b.  __ personas afectadas, equivalentes al  __% de la Población.<br></td></tr>
<tr><td style="text-align:center">5.  Diagnóstico 5:<br></td></tr>
<tr><td style="text-align:center">a.   Áreas y peligros potencialmente asociados:<br></td></tr>
<tr><td style="text-align:center">b.  __ personas afectadas, equivalentes al  __% de la Población.<br></td></tr>
<tr><td style="text-align:center">6.  Diagnóstico 6:<br></td></tr>
<tr><td style="text-align:center">a.   Áreas y peligros potencialmente asociados:<br></td></tr>
<tr><td style="text-align:center">b.  __ personas afectadas, equivalentes al  __% de la Población.<br></td></tr>

<!--
<tr><td style="text-align:left"><strong>3.6.1 Pruebas Complementarias </strong></td></tr>
<br><br>
<tr><td style="text-align:center">Se realizaron pruebas complementarias según los Profesiogramas definidos conjuntamente con la Empresa.<br></td></tr>


<script>
var chartdiv14 = AmCharts.makeChart( "chartdiv14", {
  "theme": "light",
  "type": "serial",
    "titles": [ {
     "text": "PRUEBAS COMPLEMENTARIAS",
     "size": 16
    } ],
    dataLoader: { "url": "data_Pie_Chart_with_Legend_mes_prueba_complement_paracli_json.php?fecha=<?php echo $fecha ?>&tipo_fecha=<?php echo $tipo_fecha ?>&nombre_empresa=<?php echo $nombre_empresa ?>" },
  "categoryField": "nombre_paraclinic",
  "depth3D": 20,
  "angle": 30,
  "categoryAxis": {
    "labelRotation": 30,
    "gridPosition": "start"
  },
  "valueAxes": [ {
    "title": "Valores"
  } ],
  "graphs": [ {
    "balloonText": "[[category]]: <b>[[value]]</b>",
    "valueField": "conteo_paraclinic",
    "colorField": "color",
    "type": "column",
    "lineAlpha": 0.1,
    "fillAlphas": 1
  } ],
  "chartCursor": {
    "cursorAlpha": 0,
    "zoomable": false,
    "categoryBalloonEnabled": false
  },
  "export": {
    "enabled": true
  }
} );
</script>
<div id="chartdiv14"></div>

<script>
var chartdiv14 = AmCharts.makeChart("chartdiv14", {
    "theme": "light",
    "type": "serial",
    dataLoader: { "url": "data_Pie_Chart_with_Legend_mes_prueba_complement_paracli_dos_datos_json.php?fecha=<?php echo $fecha ?>&tipo_fecha=<?php echo $tipo_fecha ?>&nombre_empresa=<?php echo $nombre_empresa ?>" },

    "dataProvider": [{
        "country": "USA",
        "year2004": 3.5,
        "year2005": 4.2
    }, {
        "country": "UK",
        "year2004": 1.7,
        "year2005": 3.1
    }, {
        "country": "Canada",
        "year2004": 2.8,
        "year2005": 2.9
    }, {
        "country": "Japan",
        "year2004": 2.6,
        "year2005": 2.3
    }, {
        "country": "France",
        "year2004": 1.4,
        "year2005": 2.1
    }, {
        "country": "Brazil",
        "year2004": 2.6,
        "year2005": 4.9
    }],
    "valueAxes": [{
        "unit": "%",
        "position": "left",
        "title": "GDP growth rate",
    }],
    "startDuration": 1,
    "graphs": [{
        "balloonText": "GDP grow in [[category]] (2004): <b>[[value]]</b>",
        "fillAlphas": 0.9,
        "lineAlpha": 0.2,
        "title": "2004",
        "type": "column",
        "valueField": "year2004"
    }, {
        "balloonText": "GDP grow in [[category]] (2005): <b>[[value]]</b>",
        "fillAlphas": 0.9,
        "lineAlpha": 0.2,
        "title": "2005",
        "type": "column",
        "clustered":false,
        "columnWidth":0.5,
        "valueField": "year2005"
    }],
    "plotAreaFillAlphas": 0.1,
    "categoryField": "country",
    "categoryAxis": {
        "gridPosition": "start"
    },
    "export": {
      "enabled": true
     }

});
</script>
<div id="chartdiv14"></div> 

<table border="1" cellspacing="0" cellpadding="0">
  <tr><td>PRUEBAS COMPLEMENTARIAS</td><td>&nbsp;# pruebas</td><td>% de poblaci&oacute;n objeto</td><td># pruebas anormales</td><td>% pruebas anormales</td></tr>
  <tr><td>TOTAL</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
  <tr><td>PRUEBA 1</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
  <tr><td>PRUEBA 2</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
  <tr><td>PRUEBA 3</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
  <tr><td>PRUEBA 4</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
  <tr><td>PRUEBA 5</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
  <tr><td>PRUEBA 6</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
</table>
-->
<br><br>

<tr><td style="text-align:left"><strong>9. RECOMENDACIONES </strong></td></tr>
<br><br>
<tr><td style="text-align:left"><strong>9.1. RECOMENDACIONES GENERALES</strong></td></tr>

<tr><td style="text-align:center"><br>El área o las personas asignadas a la gestión de salud y tbl15_seguridaden el trabajo deben promover y facilitar la generación de entornos de trabajo saludables, mediante estrategias dirigidas a las condiciones específicas de la tbl15_empresa, según su distribución por tbl15_sexo, grupos etarios, tbl15_escolaridad, área de residencia y demás indicadores sociodemográficos.
La promoción del autocuidado de la salud es costo-efectiva. La población trabajadora debe tener una creciente conciencia sobre la necesidad de proteger su salud , modificar los hábitos de vida no saludables como el consumo de cigarrillo y el sedentarismo y participar activamente en el control de riesgos ocupacionales, con mecanismos como el auto reporte de condiciones inseguras en àreas de trabajo, el uso permanente de elementos de protección personal durante la exposición, las prácticas seguras y la formalización de  procedimientos seguros en el trabajo diario. 
</td></tr>

<br><br>

<tr><td style="text-align:left"><strong>9.2. RECOMENDACIONES ESPECÍFICAS</strong></td></tr>
<br>
<tr><td style="text-align:center"><br>De acuerdo con los resultados del presente análisis se sugiere proponer las siguientes actividades:</td></tr>

<br><br>

<tr><td style="text-align:left"><strong>PROMOCION Y PREVENCION EN SALUD</strong></td></tr>
<br>
<tr><td style="text-align:center"><br>• Realizar campañas de capacitación en cuidado visual en conjunto con el departamento de Bienestar Social dirigidas a concientizar a los Trabajadores en la Higiene visual y la importancia del control y evaluación anual en la EPS tratante. 
</td></tr>
<tr><td style="text-align:center"><br>• Implementar campañas de sensibilización por medios escritos o impresos que indiquen la Importancia de la actividad física regular dentro de la población.</td></tr>
<tr><td style="text-align:center"><br>• Implementar un programa de acondicionamiento físico dentro de la Empresa que fomente la práctica regular de ejercicio. </td></tr>
<tr><td style="text-align:center"><br>• Realizar periódicamente campañas de control de peso y toma de Tensión arterial como mecanismo primario de tamizaje y control del riesgo cardiovascular.</td></tr>
<tr><td style="text-align:center"><br>• Capacitar a los trabajadores en la prevención de los factores de riesgo cardiovascular, promover pautas de autocuidado y estilos de vida saludables, control del estrés.</td></tr>
<tr><td style="text-align:center"><br>• Realización de campañas de capacitación en Higiene Postural dirigidas a concientizar a los Trabajadores en la adopción de posturas adecuadas durante la jornada laboral.</td></tr>

<br><br>

<tr><td style="text-align:left"><strong>CONTROL DE RIESGOS OCUPACIONALES</strong></td></tr>
<br>
<tr><td style="text-align:center"><br>• Verificar el cumplimiento de las recomendaciones dadas en los estudios y mediciones de iluminación realizadas en los puestos de trabajo evaluados por solicitud a los encargados de la gestión de Salud y Seguridad en el Trabajo.</td></tr>

<tr><td style="text-align:center"><br>Recomendaciones específicas para los riesgos prioritarios según matriz de peligros.
Recomendaciones específicas para las enfermedades y condiciones adversas probablemente relacionadas con los riesgos documentados en la matriz de peligros.
</td></tr>

<br><br>

<tr><td style="text-align:left"><strong>DIVULGACIÓN DE LA ACTIVIDAD Y RESULTADOS</strong></td></tr>
<br>
<tr><td style="text-align:center"><br>• Es importante que los trabajadores conozcan los resultados de la actividad de tal manera que se refleje en las políticas para Salud y Seguridad en el Trabajo. Para lograr un impacto en la población es importante retroalimentar dicha información individualmente garantizando así el cumplimiento de las recomendaciones realizadas.</td></tr>

<br><br>

<tr><td style="text-align:left"><strong>MEDIDAS DE CONTROL</strong></td></tr>
<br>
<tr><td style="text-align:center"><br>• Para los trabajadores que resultaron con anormalidad en los exámenes deben cumplir con los tratamientos y recomendaciones. Las actividades de control no solamente deben incluir al trabajador si no a todos los factores de riesgo a que se encuentra expuesto durante sus jornadas de trabajo.</td></tr>

<br><br>

<tr><td style="text-align:left"><strong>SEGUIMIENTO</strong></td></tr>
<br>
<tr><td style="text-align:center"><br>• Para todos los trabajadores a los que se les implementó una medida de control se debe controlar en un tiempo prudencial no mayor a seis meses. Es importante realizar un seguimiento, no solo médico sino del puesto de trabajo y de los factores de riesgo a los que se encuentra expuesto.</td></tr>

</tbody>
</table>
</div>
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* FIN MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
</div>
<!--End Main Content Area-->
</div>
<div id="footerInnerSeparator"></div>
</div>
</div>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<?php //include_once('../admin/04_modulo_footer.php'); ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php //include_once('../admin/05_modulo_js.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
</body>
</html>