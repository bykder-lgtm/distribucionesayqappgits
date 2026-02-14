<?php 
$serguridad_pagina           = 1; 
$fecha                       = addslashes($_GET['fecha']);
$tipo_fecha                  = addslashes($_GET['tipo_fecha']);
$nombre_empresa              = addslashes($_GET['nombre_empresa']);
$fecha_hoy_ymd_seg           = strtotime(date("Y/m/d"));
?>
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
#chartdiv05 { width: 100%; height: 900px; font-size: 15px; }
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
<div class="breadcrumbs"><a href="#"><h4>Concepto de Aptitud Laboral</h4></a></div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<div class="table-responsive">
<table class="table table-striped">
<tbody>
<tr><td style="text-align:center"><strong>DIAGNÓSTICO DE CONDICIONES DE SALUD</strong></td></tr>
<tr><td style="text-align:center"><strong>NOMBRE DE LA EMPRESA</strong></td></tr>
<tr><td style="text-align:center"><strong>ELABORADO POR</strong></td></tr>
<tr><td style="text-align:center"><strong><?php echo $fecha ?></strong></td></tr>


<tr><td style="text-align:center"><strong>INTRODUCCIÓN</strong></td></tr>
<tr><td style="text-align:justify">El Diagnóstico de Salud constituye una de las tareas claves dentro del análisis de información de Salud y Seguridad en el Trabajo. Esta fundamentado en la información recolectada durante la realización de las actividades de Medicina del trabajo y hoy en día constituye una herramienta básica para el equipo de Salud y Seguridad en el Trabajo en la toma de decisiones.
<br><br>
Se realiza con base en la información recolectada a partir de los exámenes médicos y paraclìnicos, su importancia radica en los hallazgos, las asociaciones exposición-efecto y análisis del comportamiento de las diferentes variables a través del tiempo.
<br><br>
Su realización comprende varias etapas sucesivas donde se determinan las fuentes de información, se establecen los formatos de recolección de información, se identifican y priorizan las variables a estudiar, posteriormente se realiza un análisis cruzando las variables más relevantes para el área de Salud y Seguridad en el Trabajo.
<br><br>
Las variables a evaluar se pueden clasificar en grandes grupos, las asociadas al individuo, las asociadas al puesto de trabajo y los hallazgos clínicos, buscando siempre la correlación de los factores de riesgo del puesto de trabajo y la condición clínica de cada persona.
<br><br>
Finalmente se establecen una serie de recomendaciones generales para ser ejecutadas por parte de todos los actores del Sistema de Gestión de Salud y Seguridad en el Trabajo. Las personas asignadas a la administración del sistema de gestión se encargarán de la vigilancia y control del cumplimiento de dichas recomendaciones.
</td></tr>


<tr><td style="text-align:left"><strong>1. OBJETIVOS</strong></td></tr>
<tr><td style="text-align:justify">Caracterizar la población del Nombre de la tbl15_empresa mediante el análisis de información contenida en la Historia Clínica Ocupacional, evaluando variables sociodemográficas, laborales, antecedentes médicos,  hábitos de vida, morbilidad sentida, resultados y análisis de pruebas complementarias y diagnósticos realizados.
<br><br>
Establecer las patologías de origen común y profesional de mayor incidencia y prevalencia con el fin de diseñar actividades de prevención de la enfermedad tendientes a disminuir su aparición y evitando el deterioro y/o las complicaciones de las que ya estuvieren presentes.
<br><br>
Establecer la asociación entre los factores de riesgo del puesto de trabajo con la morbilidad sentida y los hallazgos clínicos realizados por los profesionales de salud, para determinar las estrategias de control en la fuente, el medio y el trabajador.
<br><br>
Recomendar actividades de Promoción de la salud y Prevención de la enfermedad, de aplicación colectiva, a seguir en los próximos meses de acuerdo con la situación diagnosticada.
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
<tr><td style="text-align:justify">Los hallazgos de la Evaluación Médica Ocupacional de la población trabajadora del Nombre de la tbl15_empresa, se presentan a continuación en tablas y gráficas que reflejan la situación general de salud de la Empresa.</td></tr>

<tr><td style="text-align:left"><strong>3.1. CARACTERÍSTICAS SOCIODEMOGRÁFICAS DE LA POBLACIÓN</strong></td></tr>
<tr><td style="text-align:left">3.1.1. Población Evaluada</td></tr>

<tr><td style="text-align:justify">Se evaluó a los trabajadores del Nombre de la tbl15_empresa, teniendo como base una población objeto de xxxxx funcionarios, practicando xxxxx exámenes médicos ocupacionales entre mes del año a mes del año, con una cobertura del xx%. </td></tr>

<center>
<table style="text-align:left" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td>ÁREA O SECCIÓN</td>
    <td>POBLACION TOTAL</td>
    <td>POBLACIÓN EXAMINADA</td>
    <td>%</td>
  </tr>
  <tr> </tr>
  <tr><td>xxxxxxxxxxxxxxx</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
  <tr><td>xxxxxxxxxxxxx</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
  <tr><td>xxxxxxxxxxxxx</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
  <tr><td>xxxxxxxxxxxxx</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
  <tr><td>xxxxxxxxxxxxx</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
  <tr><td>xxxxxxxxxxxxx</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
  <tr><td>xxxxxxxxxxxxx</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
  <tr><td>xxxxxxxxxxxxx</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
  <tr><td>TOTAL</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
</table>
</center>

<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script>
var chartdiv01 = AmCharts.makeChart( "chartdiv01", {
  "type": "funnel",
  "theme": "light",
  "titles": [ {
  "text": "DR. EDINSON CASTRO VALDERRAMA",
  "size": 16
  } ],
dataLoader: { "url": "data_Pie_Chart_with_Legend_mes_personevaluada_json.php?fecha=<?php echo $fecha ?>&tipo_fecha=<?php echo $tipo_fecha ?>" },
  "balloon": {
    "fixedPosition": true
  },
  "valueField": "conteo_estado_facturacion",
  "titleField": "nombre_person_eval",
  "marginRight": 240,
  "marginLeft": 50,
  "startX": -500,
  "depth3D": 100,
  "angle": 40,
  "outlineAlpha": 1,
  "outlineColor": "#FFFFFF",
  "outlineThickness": 2,
  "labelPosition": "right",
  "balloonText": "[[nombre_person_eval]]: [[conteo_estado_facturacion]]n[[description]]",
  "export": {
    "enabled": true
  }
} );
</script>
<div id="chartdiv01"></div>

<!--
<script>
var chartdiv01 = AmCharts.makeChart("chartdiv01", {
  "type": "pie", 
  "startDuration": 0,
  "theme": "light",
  "addClassNames": true,
  "titles": [ {
  "text": "DR. EDINSON CASTRO VALDERRAMA",
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
dataLoader: { "url": "data_Pie_Chart_with_Legend_mes_personevaluada_json.php?fecha=<?php echo $fecha ?>&tipo_fecha=<?php echo $tipo_fecha ?>" },
  "angle": 20,
  "valueField": "conteo_estado_facturacion",
  "titleField": "nombre_person_eval",
  "export": {
  "enabled": true
  }
});
chartdiv01.addListener("init", handleInit);
chartdiv01.addListener("rollOverSlice", function(e) {
  handleRollOver(e);
});
function handleInit(){
  chartdiv01.legend.addListener("rollOverItem", handleRollOver);
}
function handleRollOver(e){
  var wedge = e.dataItem.wedge.node;
  wedge.parentNode.appendChild(wedge);
}
</script>
<div id="chartdiv01"></div>
-->
<p>Ilustración 1: Proporción de personas evaluadas<br><br></p>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<tr><td style="text-align:left"><strong>3.1.2. Distribución por Sexo</strong></td></tr>
<tr><td style="text-align:left"><br><br>Se encontró predominio del tbl15_sexo XXXX con el xx%.<br>La siguiente tabla muestra la distribución por tbl15_sexo y áreas (o secciones, cargos, etc.).</td></tr>

<script>
var chartdiv02 = AmCharts.makeChart("chartdiv02", {
  "type": "pie", 
  "startDuration": 0,
  "theme": "light",
  "addClassNames": true,
  "titles": [ {
  "text": "SEXO",
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
dataLoader: { "url": "data_Pie_Chart_with_Legend_mes_sexo_json.php?fecha=<?php echo $fecha ?>&tipo_fecha=<?php echo $tipo_fecha ?>" },
  "angle": 20,
  "valueField": "conteo_nombre_sexo",
  "titleField": "nombre_sexo",
  "export": {
  "enabled": true
  }
});
chartdiv02.addListener("init", handleInit);
chartdiv02.addListener("rollOverSlice", function(e) {
  handleRollOver(e);
});
function handleInit(){
  chartdiv02.legend.addListener("rollOverItem", handleRollOver);
}
function handleRollOver(e){
  var wedge = e.dataItem.wedge.node;
  wedge.parentNode.appendChild(wedge);
}
</script>
<div id="chartdiv02"></div>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<tr><td style="text-align:left"><strong>3.1.3. Distribución de la población según Grupo Etário</strong></td></tr>
<br><br>
<tr><td style="text-align:left">Un xx % de las personas evaluadas se encuentran en el rango de __ a __ años</td></tr>

<script>
var chartdiv03 = AmCharts.makeChart("chartdiv03", {
  "type": "pie", 
  "startDuration": 0,
  "theme": "light",
  "addClassNames": true,
  "titles": [ {
  "text": "EDAD",
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
dataLoader: { "url": "data_Pie_Chart_with_Legend_mes_edad_json.php?fecha=<?php echo $fecha ?>&tipo_fecha=<?php echo $tipo_fecha ?>" },
  "angle": 20,
  "valueField": "conteo_edad",
  "titleField": "edad_anyo",
  "export": {
  "enabled": true
  }
});
chartdiv03.addListener("init", handleInit);
chartdiv03.addListener("rollOverSlice", function(e) {
  handleRollOver(e);
});
function handleInit(){
  chartdiv03.legend.addListener("rollOverItem", handleRollOver);
}
function handleRollOver(e){
  var wedge = e.dataItem.wedge.node;
  wedge.parentNode.appendChild(wedge);
}
</script>
<div id="chartdiv03"></div>


<table border="1" cellspacing="0" cellpadding="0">
  <tr><td>RANGO EDAD</td><td>No</td><td>%</td></tr>
  <tr><td>MENOR 20</td><td>X</td><td>X</td></tr>
  <tr><td>20 - 29</td><td>X</td><td>X</td></tr>
  <tr><td>30 - 39</td><td>X</td><td>X</td></tr>
  <tr><td>40 - 49</td><td>X</td><td>X</td></tr>
  <tr><td>MAYOR 50</td><td>X</td><td>X</td></tr>
  <tr><td>TOTAL</td><td>X</td><td>X</td></tr>
</table>

<tr><td style="text-align:left"><strong>3.1.4 Distribución del Nivel de Escolaridad de la población</strong></td></tr>
<br><br>
<tr><td style="text-align:center">El Nivel de tbl15_escolaridad, con mayor porcentaje dentro de la Empresa que corresponde a xxxxxxxx con un xx %; en segundo lugar está XXXX, con xx %; en tercer lugar … </td></tr>

<script>
var chartdiv04 = AmCharts.makeChart("chartdiv04", {
    "theme": "light",
    "type": "serial",
    "titles": [ {
     "text": "ESCOLARIDAD",
     "size": 16
    } ],
    dataLoader: { "url": "data_3D_Column_Chart_mes_escolaridad.php?fecha=<?php echo $fecha ?>&tipo_fecha=<?php echo $tipo_fecha ?>" },

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


<table border="1" cellspacing="0" cellpadding="0" width="567">
  <tr><td>NIVEL DE ESCOLARIDAD</td><td>Total</td><td>%</td></tr>
  <tr><td>Analfabeta</td><td>X</td><td>&nbsp;</td></tr>
  <tr><td>Primaria completa o incompleta</td><td>X</td><td>&nbsp;</td></tr>
  <tr><td>Secundaria completa o incompleta</td><td>X</td><td>&nbsp;</td></tr>
  <tr><td>T&eacute;cnico, tecnol&oacute;gico o auxiliar </td><td>X</td><td>&nbsp;</td></tr>
  <tr><td>Profesional</td><td>X</td><td>&nbsp;</td></tr>
  <tr><td>Post grado</td><td>X</td><td>&nbsp;</td></tr>
  <tr><td>Total</td><td>X</td><td>&nbsp;</td></tr>
</table>

<tr><td style="text-align:left"><strong>3.2. CARACTERÍSTICAS LABORALES</strong></td></tr>
<br><br>
<tr><td style="text-align:left"><strong>3.2.1. Distribución de la población según Cargos</strong></td></tr>
<br>
<tr><td style="text-align:center">Los cargos predominantes en los evaluados fueron:</td></tr>
<br>
<tr><td style="text-align:center">1.- xxxxxxxxx con el xx%</td></tr>
<br>
<tr><td style="text-align:center">2.- xxxxxxxxx con el xx%</td></tr>
<br>
<tr><td style="text-align:center">3.- xxxxxxxxx con el xx%</td></tr>
<br>
<tr><td style="text-align:center">4.- xxxxxxxxx con el xx%</td></tr>
<br>
<tr><td style="text-align:center"></td></tr>
<br>

<script>
var chartdiv05 = AmCharts.makeChart("chartdiv05", {
    "theme": "light",
    "type": "serial",
    "titles": [ {
     "text": "DENOMINACIÓN DEL CARGO",
     "size": 16
    } ],
    dataLoader: { "url": "data_3D_Column_Chart_mes_cargo.php?fecha=<?php echo $fecha ?>&tipo_fecha=<?php echo $tipo_fecha ?>" },

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


<table border="1" cellspacing="0" cellpadding="0">
  <tr><td>CARGO</td><td>Total</td><td>%</td></tr>
  <tr><td>cargo 1</td><td>X</td><td>&nbsp;</td></tr>
  <tr><td>Cargo 2</td><td>X</td><td>&nbsp;</td></tr>
  <tr><td>Cargo 3 </td><td>X</td><td>&nbsp;</td></tr>
  <tr><td>Cargo 4 </td><td>X</td><td>&nbsp;</td></tr>
  <tr><td>Cargo 5 </td><td>X</td><td>&nbsp;</td></tr>
  <tr><td>Cargo 6 </td><td>X</td><td>&nbsp;</td></tr>
  <tr><td>Cargo 7 </td><td>X</td><td>&nbsp;</td></tr>
  <tr><td>Cargo 8 </td><td>X</td><td>&nbsp;</td></tr>
  <tr><td>Cargo 9 </td><td>X</td><td>&nbsp;</td></tr>
  <tr><td>Cargo 10 </td><td>X</td><td>&nbsp;</td></tr>
  <tr><td>Cargo 11 </td><td>X</td><td>&nbsp;</td></tr>
  <tr><td>Cargo 12 </td><td>X</td><td>&nbsp;</td></tr>
  <tr><td>Cargo 13 </td><td>X</td><td>&nbsp;</td></tr>
  <tr><td>Cargo 14 </td><td>X</td><td>&nbsp;</td></tr>
  <tr><td>TOTAL</td><td>X</td><td>&nbsp;</td></tr>
</table>

<br><br>
<tr><td style="text-align:left"><strong>3.2.2 Distribución de la Población por Antigüedad </strong></td></tr>
<br><br>
<tr><td style="text-align:center">El porcentaje predominante corresponde a los Trabajadores con xx a xx años de antigüedad en la Empresa.</td></tr>


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
dataLoader: { "url": "data_Pie_Chart_with_Legend_mes_distribucion_edad_json.php?fecha=<?php echo $fecha ?>&tipo_fecha=<?php echo $tipo_fecha ?>" },
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

<table border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td><strong>Peligro</strong></td><td><strong># declarantes</strong></td><td><strong>% declarantes</strong></td>
  </tr>
  <tr>
    <td>Peligro 1</td><td>X</td><td>X</td>
  </tr>
  <tr>
    <td>Peligro 2</td><td>X</td><td>X</td>
  </tr>
  <tr>
    <td>Peligro 3</td><td>x</td><td>X</td>
  </tr>
</table>


<script>
var chartdiv07 = AmCharts.makeChart( "chartdiv07", {
  "type": "pie",
  "theme": "light",
  "titles": [ {
    "text": "FACTOR DE RIESGO OCUPACIONAL",
    "size": 16
  } ],
dataLoader: { "url": "data_Simple_Column_Chart_mes_peligros.php?fecha=<?php echo $fecha ?>&tipo_fecha=<?php echo $tipo_fecha ?>" },

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


<tr><td style="text-align:left"><strong>3.4. HÁBITOS EXTRALABORALES</strong></td></tr>
<br><br>
<tr><td style="text-align:center">3.4.1. Tabaquismo</td></tr>
<br><br>
<tr><td style="text-align:center">El xx % de las personas evaluadas refirió fumar, un  xx % ser exfumadores y un  xx % refirió no ser fumador.</td></tr>

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
dataLoader: { "url": "data_Pie_Chart_with_Legend_mes_habito_extra_lab_json.php?fecha=<?php echo $fecha ?>&tipo_fecha=<?php echo $tipo_fecha ?>" },
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

<table border="1" cellspacing="0" cellpadding="0" width="265">
  <tr><td><strong>Consumo de cigarrillo</strong></td><td><strong>#</strong></td><td><strong>%</strong></td></tr>
  <tr><td>Si</td><td>X</td><td>X</td></tr>
  <tr><td>No</td><td>X</td><td>X</td></tr>
  <tr><td>Ex</td><td>x</td><td>X</td></tr>
  <tr><td>Total</td><td>x</td><td>&nbsp;</td></tr>
</table>

<tr><td style="text-align:left"><strong>3.4.2. Actividad Física</strong></td></tr>
<br><br>
<tr><td style="text-align:center">Un xx % de la población evaluada refirió realizar algún tipo de actividad física, en forma periódica, un xx % no la realiza.</td></tr>

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
dataLoader: { "url": "data_Pie_Chart_with_Legend_mes_actividad_fisica_json.php?fecha=<?php echo $fecha ?>&tipo_fecha=<?php echo $tipo_fecha ?>" },
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

<tr><td style="text-align:left"><strong>3.4.3 Indice de Masa Corporal </strong></td></tr>
<br><br>
<tr><td style="text-align:center">El xx % de la población presenta sobrepeso y el xx % obesidad.</td></tr>

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
dataLoader: { "url": "data_Pie_Chart_with_Legend_mes_imc_json.php?fecha=<?php echo $fecha ?>&tipo_fecha=<?php echo $tipo_fecha ?>" },
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
dataLoader: { "url": "data_Pie_Chart_with_Legend_mes_enfermedad_laboral_json.php?fecha=<?php echo $fecha ?>&tipo_fecha=<?php echo $tipo_fecha ?>" },
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


<table border="1" cellspacing="0" cellpadding="0">
  <tr><td><strong>Enfermedad laboral reportada</strong></td><td><strong>#</strong></td><td><strong>%</strong></td></tr>
  <tr><td>Con enfermedad</td><td>&nbsp;</td><td>&nbsp;</td></tr>
  <tr><td>Sin enfermedad</td><td>&nbsp;</td><td>&nbsp;</td></tr>
  <tr><td>Total</td><td>&nbsp;</td><td>&nbsp;</td></tr>
</table>
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
dataLoader: { "url": "data_Pie_Chart_with_Legend_mes_accidente_laboral_json.php?fecha=<?php echo $fecha ?>&tipo_fecha=<?php echo $tipo_fecha ?>" },
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

<table border="1" cellspacing="0" cellpadding="0">
  <tr><td><strong>Accidente de trabajo</strong></td><td><strong>#</strong></td><td><strong>%</strong></td></tr>
  <tr><td>Accidentado</td><td>&nbsp;</td><td>&nbsp;</td></tr>
  <tr><td>No accidentado</td><td>&nbsp;</td><td>&nbsp;</td></tr>
  <tr><td>Total</td><td>&nbsp;</td><td>&nbsp;</td></tr>
</table>

<tr><td style="text-align:left"><strong>3.6. PRINCIPALES DIAGNÓSTICOS</strong></td></tr>
<br><br>
<tr><td style="text-align:center">Los diagnósticos de mayor incidencia encontradas en los Trabajadores evaluados en el Nombre de la tbl15_empresa, se presentan a continuación:<br></td></tr>

<tr><td style="text-align:center">1. Diagnóstico 1, __ personas afectadas, equivalentes al  __% de la Población.<br></td></tr>
<tr><td style="text-align:center">2. Diagnóstico 2, __ personas afectadas, equivalentes al  __% de la Población.<br></td></tr>
<tr><td style="text-align:center">3. Diagnóstico 3, __ personas afectadas, equivalentes al  __% de la Población.<br></td></tr>
<tr><td style="text-align:center">4. Diagnóstico 4, __ personas afectadas, equivalentes al  __% de la Población.<br></td></tr>
<tr><td style="text-align:center">5. Diagnóstico 5, __ personas afectadas, equivalentes al  __% de la Población.<br></td></tr>
<tr><td style="text-align:center">6. Diagnóstico 6, __ personas afectadas, equivalentes al  __% de la Población.<br></td></tr>

<script>
var chartdiv13 = AmCharts.makeChart( "chartdiv13", {
  "theme": "light",
  "type": "serial",
    "titles": [ {
     "text": "PRINCIPALES DIAGNÓSTICOS",
     "size": 16
    } ],
    dataLoader: { "url": "data_Pie_Chart_with_Legend_mes_diagnostico_cie10_json.php?fecha=<?php echo $fecha ?>&tipo_fecha=<?php echo $tipo_fecha ?>" },

  "categoryField": "nombre_cie10_diag",
  "depth3D": 20,
  "angle": 30,

  "categoryAxis": {
    "labelRotation": 90,
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
    dataLoader: { "url": "data_Pie_Chart_with_Legend_mes_diagnostico_cie10_json.php?fecha=<?php echo $fecha ?>&tipo_fecha=<?php echo $tipo_fecha ?>" },

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
    dataLoader: { "url": "data_Pie_Chart_with_Legend_mes_prueba_complement_paracli_json.php?fecha=<?php echo $fecha ?>&tipo_fecha=<?php echo $tipo_fecha ?>" },

  "categoryField": "nombre_paraclinic",
  "depth3D": 20,
  "angle": 30,

  "categoryAxis": {
    "labelRotation": 90,
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